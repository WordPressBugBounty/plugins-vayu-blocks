<?php
// Optimized vayu-blocks-api.php
add_action('rest_api_init', function() {
    register_rest_route('vayu-blocks/v1', '/manifest', [
        'methods' => 'GET',
        'callback' => 'vayu_get_manifest',
        'args' => [
            'page' => [
                'validate_callback' => fn($param) => is_numeric($param) && $param > 0,
                'default' => 1
            ],
            'per_page' => [
                'validate_callback' => fn($param) => is_numeric($param) && $param > 0,
                'default' => 10
            ],
            'type' => [
                'sanitize_callback' => 'sanitize_key',
                'default' => ''
            ],
            'category' => [
                'sanitize_callback' => 'sanitize_text_field',
                'default' => 'all'
            ],
            'search' => [
                'sanitize_callback' => 'sanitize_text_field',
                'default' => ''
            ]
        ],
        'permission_callback' => fn() => current_user_can('edit_posts')
    ]);

    register_rest_route('vayu-blocks/v1', '/upload-media', [
        'methods' => 'GET',
        'callback' => 'vayu_upload_media',
        'args' => [
            'url' => [
                'required' => true,
                'validate_callback' => 'wp_http_validate_url'
            ]
        ],
        'permission_callback' => fn() => current_user_can('upload_files')
    ]);
});

function vayu_get_manifest(WP_REST_Request $request) {
    $params = $request->get_params();
    $cache_key = 'vayu_manifest_' . md5(serialize($params));

    // Memory cache fallback
    if ($cached = wp_cache_get($cache_key, 'vayu_data')) {
        return rest_ensure_response($cached);
    }

    $manifest = get_transient('vayu_remote_manifest');
    if (false === $manifest) {
        $response = wp_safe_remote_get('https://themehunk.com/wp-json/vayu/v1/api/', ['timeout' => 10]);
        if (is_wp_error($response)) {
            return new WP_Error('api_error', 'Failed to fetch manifest', ['status' => 502]);
        }
        $manifest = json_decode(wp_remote_retrieve_body($response), true);
        set_transient('vayu_remote_manifest', $manifest, HOUR_IN_SECONDS);
    }

    $types = $params['type'] ? [sanitize_key($params['type'])] : ['patterns', 'pages', 'kits'];
    $results = [];

    foreach ($types as $type) {
        if (empty($manifest[$type])) continue;

        foreach ((array)$manifest[$type] as $url) {
            $url_key = 'vayu_data_' . md5($url);
            $data = wp_cache_get($url_key, 'vayu_data');
            if (false === $data) {
                $res = wp_safe_remote_get($url, ['timeout' => 10]);
                if (!is_wp_error($res)) {
                    $data = json_decode(wp_remote_retrieve_body($res), true);
                    if (is_array($data)) {
                        wp_cache_set($url_key, $data, 'vayu_data', 6 * HOUR_IN_SECONDS);
                    }
                }
            }
            if (is_array($data)) {
                $results = array_merge($results, $data);
            }
        }
    }

	
    $filtered = array_filter($results, function($item) use ($params) {
        if ($params['type'] && strtolower($item['type'] ?? '') !== strtolower($params['type'])) return false;
        if ($params['category'] !== 'all') {
            $cats = array_map('strtolower', (array)($item['category'] ?? []));
            if (!in_array(strtolower($params['category']), $cats)) return false;
        }
        if ($params['search'] && stripos($item['title'] ?? '', $params['search']) === false) return false;
        return true;
    });

    $total = count($filtered);
    $paged = array_slice(array_values($filtered), ($params['page'] - 1) * $params['per_page'], $params['per_page']);

    $response = [
        'templates' => $paged,
        'total' => $total,
        'page' => (int)$params['page'],
        'per_page' => (int)$params['per_page'],
        'categories' => array_values(array_unique(array_reduce($filtered, fn($carry, $item) => array_merge($carry, (array)($item['category'] ?? [])), [])))
    ];

    wp_cache_set($cache_key, $response, 'vayu_data', 15 * MINUTE_IN_SECONDS);
    return rest_ensure_response($response);
}

function vayu_upload_media(WP_REST_Request $request) {
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $url = esc_url_raw($request['url']);
    $filename = basename(parse_url($url, PHP_URL_PATH));

    // ✅ Check for existing attachment by source URL (custom meta) or filename
    $existing = get_posts([
        'post_type'      => 'attachment',
        'post_status'    => 'inherit',
        'posts_per_page' => 1,
        'meta_query'     => [
            [
                'key'   => '_vayu_source_url',
                'value' => $url,
            ]
        ],
        'fields'         => 'ids'
    ]);

    // If not found by meta, check by filename (optional but useful)
    if (empty($existing)) {
        $existing = get_posts([
            'post_type'      => 'attachment',
            'post_status'    => 'inherit',
            'posts_per_page' => 1,
            'title'          => pathinfo($filename, PATHINFO_FILENAME),
            'fields'         => 'ids'
        ]);
    }

    if (!empty($existing)) {
        $id = $existing[0];
        return [
            'id'        => $id,
            'url'       => wp_get_attachment_url($id),
            'mime_type' => get_post_mime_type($id)
        ];
    }

    // 🧩 Download and upload the file
    $tmp = download_url($url, 30);
    if (is_wp_error($tmp)) {
        return new WP_Error('download_failed', $tmp->get_error_message(), ['status' => 400]);
    }

    $file = [
        'name'     => $filename,
        'tmp_name' => $tmp,
        'error'    => 0
    ];

    $id = media_handle_sideload($file, 0);
    if (is_wp_error($id)) {
        @unlink($tmp);
        return new WP_Error('upload_failed', $id->get_error_message(), ['status' => 500]);
    }

    // 📝 Save source URL as custom meta for future detection
    update_post_meta($id, '_vayu_source_url', $url);

    return [
        'id'        => $id,
        'url'       => wp_get_attachment_url($id),
        'mime_type' => get_post_mime_type($id)
    ];
}
