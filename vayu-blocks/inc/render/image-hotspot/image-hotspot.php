<?php
function vayu_blocks_render_image_hotspot_block( $attributes, $content ) {
    // Extract attributes.
    $id = isset( $attributes['id'] ) ? esc_attr( $attributes['id'] ) : '';
    $class = isset( $attributes['className'] ) ? esc_attr( $attributes['className'] ) : 'vayu-hots-wrapper';

    // Start the output buffer.
    ob_start();
    ?>
    <div id="<?php echo $id; ?>" class="<?php echo $class; ?>">
        <?php echo $content; // Render the nested blocks (image and pin blocks). ?>
    </div>
    <?php
    return ob_get_clean();
}
