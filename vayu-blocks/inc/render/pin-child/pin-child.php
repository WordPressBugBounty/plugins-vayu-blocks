<?php 
 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
function vayu_block_pin_child_render( $attributes, $content ) {
    // Extract attributes
    $id = isset( $attributes['id'] ) ? esc_attr( $attributes['id'] ) : '';
    $x = isset( $attributes['x'] ) ? floatval( $attributes['x'] ) : 50; // Default to center
    $y = isset( $attributes['y'] ) ? floatval( $attributes['y'] ) : 50; // Default to center
    $tooltipDisplay = isset( $attributes['tooltipDisplay'] ) ? esc_attr( $attributes['tooltipDisplay'] ) : '';
    $triangleArrowColor = isset( $attributes['triangleArrowColor'] ) ? esc_attr( $attributes['triangleArrowColor'] ) : '';
    $parentBlock = isset( $attributes['parentBlock'] ) ? esc_attr( $attributes['parentBlock'] ) : '';
    $className = 'vayu-pin-block';

    ob_start();
    ?>
    <div
        id="<?php echo esc_attr( $id ); ?>"
        class="<?php echo esc_attr( $className ); ?>"
        style="position: absolute; top: <?php echo esc_attr( $y ); ?>%; left: <?php echo esc_attr( $x ); ?>%; transform: none; z-index: 108;"
        data-parent-block="<?php echo esc_attr( $parentBlock ); ?>"
    >
        <div class="vayu-pin-spot-wrapper7 <?php echo esc_attr( 'tooltip-' . $tooltipDisplay ); ?>" style="position: relative;" data-arrow="<?php echo esc_attr( $triangleArrowColor ); ?>">
            <?php echo wp_kses_post( $content ); ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
