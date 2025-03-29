<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
 } 

 function vayu_block_swipe_slider_render($attributes, $content, $block){
    $wrapclassnames = 'swipe-scroll-wrapper swipe-fetaure-slider-wrapper';
    $innerclass = 'swiper-wrapper swipe-carousel';
    $wrapper_attributes = get_block_wrapper_attributes( array( 'class' => trim( $wrapclassnames ) ) );
        return sprintf(
            '<div %1$s><div class="%2$s">%3$s</div></div>',
            $wrapper_attributes,
            $innerclass,
            $content
        );
 }