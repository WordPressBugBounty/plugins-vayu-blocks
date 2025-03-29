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


/**
 * Register and enqueue stylesheet for the editor only.
 */
add_action( 'enqueue_block_assets', 'vayu_blocks_enqueue_panel_styles' );
//add_action( 'enqueue_block_editor_assets', 'vayu_blocks_enqueue_editor_styles' );


function vayu_blocks_enqueue_panel_styles() {
   if ( is_admin() ) {
        wp_enqueue_style( 'vayu-blocks-panel-style',  VAYU_BLOCKS_URL . 'inc/assets/css/editor-panel.css' );
    }
}




function vayu_blocks_editor_assets(){

    $asset_file = require_once VAYU_BLOCKS_DIR_PATH .'public/build/registerPlugin.asset.php';
    $asset_file = require_once VAYU_BLOCKS_DIR_PATH .'public/build/component-editor.asset.php';
    wp_enqueue_style(
        'component-editor-css',
        VAYU_BLOCKS_URL . 'public/build/component-editor.css',
        array_merge(
			$asset_file['dependencies']
		),	'1.0.0'
    );

	wp_enqueue_script(
		'registerPlugin-block',
		VAYU_BLOCKS_URL . 'public/build/registerPlugin.js',
		array_merge(
			$asset_file['dependencies']
		),
		'1.0.0',
		true
	);
    wp_localize_script(
        'registerPlugin-block',
        'vayublock',
        array(
            'homeUrl' => plugins_url( '/', __FILE__ ),
            'showOnboarding' => '',
            'options'=> (new VAYU_BLOCKS_OPTION_PANEL())->get_option()
        )
    );

 
   
}
add_action( 'enqueue_block_editor_assets', 'vayu_blocks_editor_assets' );


function vayu_admin_react_script() {

    $asset_file = require_once VAYU_BLOCKS_DIR_PATH .'public/build/adminDashboard.asset.php';

    $localizeItems = array(
        'homeUrl' => plugins_url( '/', __FILE__ ),
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'homeUrl2' => get_home_url(),
        'nonce' => wp_create_nonce('vayu_blocks_nonce'),
        'options'=> (new VAYU_BLOCKS_OPTION_PANEL())->get_option()
    );
    
    if( class_exists('Vayu_Block_Plugin_Pro') ){
        $localizeItems['vayuProStatus'] = 'activated';
    }

    wp_enqueue_script(
		'adminDashboard-block',
		VAYU_BLOCKS_URL . 'public/build/adminDashboard.js',
		array_merge(
			$asset_file['dependencies']
		),
		'1.0.0',
		true
	);

    wp_localize_script(
        'adminDashboard-block',
        'vayublock',
        $localizeItems
    );


    wp_enqueue_style(
        'adminDashboard-style',
        VAYU_BLOCKS_URL . 'public/build/adminDashboard-style.css',
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





add_action('wp_ajax_vayu_blocks_get_input_values', 'vayu_blocks_get_input_values_callback');

function vayu_blocks_get_input_values_callback() {
    // Retrieve the settings from the database
    $settings = get_option('vayu_blocks_settings', array(
        'container' => array(
            'value' => 1,
            'settings' => array(
                'containerWidth' => 1250,
                'containerGap' => 18,
                'padding' => 20,
            ),
        ),
        'button' => array(
            'value' => 0,
            'settings' => array(
                'buttonColor' => '',
            ),
        ),
        'heading' => array(
            'value' => 0,
            'settings' => array(
               
            ),
        ),
        'spacer' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'product' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'postgrid' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'flipBox' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'image' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'video' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'icon' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'advanceSlider' => array(
            'value' => 0,
            'settings' => array(
            
            ),
        ),
        'queryloop' => array(
            'value' => 0,
            'settings' => array(
            
            ),
        ),
        'imageHotspot' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
        'advanceTimeline' => array(
            'value' => 0,
            'settings' => array(
                
            ),
        ),
    ));

    // Ensure the response is in JSON format
    wp_send_json_success($settings);
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
