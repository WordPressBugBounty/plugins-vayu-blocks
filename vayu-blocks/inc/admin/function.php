<?php 
if (!defined('ABSPATH')) exit;

function vayu_blocks_categories( $categories ) {
    return array_merge(

        [
            [
                'slug'  => 'vayu-blocks',
                'title' => __( 'Vayu Blocks', 'vayu-blocks' ),
                'icon'  => 'vayu-blocks-icon'
            ],
        ],
        $categories
    );
}
add_filter( 'block_categories_all', 'vayu_blocks_categories', 11, 2);

// Force add type="module"
add_filter('script_loader_tag', function ($tag, $handle, $src) {
    if ($handle === 'vayu-blocks-global') {
        return '<script type="module" src="' . esc_url($src) . '" id="vayu-blocks-global-js"></script>';
    }
    return $tag;
}, 10, 3);


function vayu_admin_react_script($hook) {

    $asset_file = require_once VAYU_BLOCKS_DIR_PATH .'public/build/optional-panel.asset.php';
    $localizeItems = array(
        'homeUrl' =>VAYU_BLOCKS_URL.'inc/',
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'homeUrl2' => get_home_url(),
        'nonce' => wp_create_nonce('vayu_blocks_nonce'),
        'options'=> (new VAYU_BLOCKS_OPTION_PANEL())->get_option()
    );
    
    if( class_exists('Vayu_Block_Plugin_Pro') ){
        $localizeItems['vayuProStatus'] = 'activated';
    }

    wp_enqueue_script(
		'vayu-blocks-optional-panel',
		VAYU_BLOCKS_URL . 'public/build/optional-panel.js',
		isset($asset_file['dependencies'])?$asset_file['dependencies']:array(),
		'1.0.0',
		true
	);

    wp_localize_script(
        'vayu-blocks-optional-panel',
        'vayublock',
        $localizeItems
    );

    $allowed_hooks = [
                'toplevel_page_vayu-blocks',
                'vayu-blocks_page_vayu-sites',
                'vayu-blocks_page_vayu-blocks-settings',
                ];

                    if ( ! in_array( $hook, $allowed_hooks, true ) ) {
                        return;
                    }


        wp_enqueue_style(
        'vayu-blocks-optional-panel',
        VAYU_BLOCKS_URL . 'public/build/optional-panel.css',
        '1.0.0'
    );
      
}
add_action('admin_enqueue_scripts',  'vayu_admin_react_script');

add_action('wp_ajax_vayu_blocks_save_input_values', 'vayu_blocks_save_input_values_callback');

function vayu_blocks_save_input_values_callback() {
    check_ajax_referer('vayu_blocks_nonce', 'security');

    // Decode the JSON string into an associative array
    $inputData = isset($_POST['inputData']) ? json_decode(stripslashes($_POST['inputData']), true) : array();

    // Get the current settings from the database
    $settings = get_option('vayu_blocks_settings', array());

    // Loop through each provided setting
    foreach ($inputData as $key => $value) {
        // Check if only the 'value' key is present, indicating a toggle switch change
        if (isset($value['value']) && !isset($value['settings'])) {
            // Update only the 'value' key
            if (isset($settings[$key])) {
                $settings[$key]['value'] = sanitize_text_field($value['value']);
            } else {
                // If the setting doesn't exist, create a new entry with just 'value'
                $settings[$key] = array(
                    'value' => sanitize_text_field($value['value']),
                    'settings' => array(), // Default empty settings array
                );
            }
        } elseif (isset($value['settings'])) { // If 'settings' key is present, handle block settings
            // Update the 'settings' key and optionally the 'value' key
            if (isset($settings[$key])) {
                $settings[$key]['settings'] = vayu_blocks_array_merge_recursive_distinct($settings[$key]['settings'], array_map('sanitize_text_field', $value['settings']));
                if (isset($value['value'])) {
                    $settings[$key]['value'] = sanitize_text_field($value['value']);
                }
            } else {
                // If the setting doesn't exist, create a new entry with both 'value' and 'settings'
                $settings[$key] = array(
                    'value' => isset($value['value']) ? sanitize_text_field($value['value']) : '',
                    'settings' => array_map('sanitize_text_field', $value['settings']),
                );
            }
        }
    }

    // Update the settings in the database
    update_option('vayu_blocks_settings', $settings);

    // Return success response
    wp_send_json_success(array(
        'success' => true,
        'message' => 'Input values saved successfully',
    ));

    wp_die();
}

// Helper function to merge arrays recursively with distinct values
function vayu_blocks_array_merge_recursive_distinct(array &$array1, array &$array2) {
    $merged = $array1;

    foreach ($array2 as $key => &$value) {
        if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
            $merged[$key] = vayu_blocks_array_merge_recursive_distinct($merged[$key], $value);
        } else {
            $merged[$key] = $value;
        }
    }

    return $merged;
}

add_action('rest_api_init', function() {
    add_filter('rest_post_query', 'vayu_blocks_filter_posts_with_featured_image', 10, 2);
});

function vayu_blocks_filter_posts_with_featured_image($args, $request) {
    if (!empty($request['with_featured_image']) && $request['with_featured_image'] === 'true') {
        $args['meta_query'] = array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'EXISTS'
            ),
        );
    }
    return $args;
}

add_action('rest_api_init', function () {
	register_rest_route('vayu-blocks/v1', '/google-fonts', [
		'methods' => 'GET',
		'callback' => function () {
			$response = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyClGdkPJ1BvgLOol5JAkQY4Mv2lkLYu00k');

			if (is_wp_error($response)) {
				return new WP_REST_Response([
					'error' => 'Failed to fetch Google Fonts',
					'message' => $response->get_error_message()
				], 500);
			}

			$body = wp_remote_retrieve_body($response);
			$data = json_decode($body, true);

			if (empty($data['items'])) {
				return new WP_REST_Response([
					'error' => 'Invalid response from Google Fonts API',
				], 502);
			}

			return rest_ensure_response($data);
		},
		'permission_callback' => '__return_true',
	]);
});




