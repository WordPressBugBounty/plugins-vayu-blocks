<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

function generate_inline_lottie_styles($attr) {

    if ((new VAYUBLOCKS_DISPLAY_CONDITION($attr))->display()) {
        return '';
    }

    $css = '';

    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];

    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    // $wrapper = '.vayu-blocks-image-main-container' . esc_attr($uniqueId);

    // $inline = '.vb-image-container';

    // if ( isset( $attr['parentBlock'] ) && $attr['parentBlock'] !== 'vayu-blocks/advance-slider' ) {
    //     $css .= $OBJ_STYLE->advanceStyle( $wrapper );
    // }
                
    $css .= "}";

    return $css;
}