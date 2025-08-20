<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
     
class Vayu_blocks_image_flip {

    private $attr; //attributes
    private $content;

    public function __construct($attr,$content) {
        $this->attr = $attr;
        $this->content = $content;
    }

    //Render
    public function render() {
        ob_start(); // Start output buffering
        echo $this->render_image();
        return ob_get_clean(); // Return the buffered output
    }

    //main container containing image and innerblocks
    private function render_image() {
        $attributes = $this->attr; // Access attributes
        $image_html = '';
        $animated = isset($attributes['className']) ? esc_attr($attributes['className']) : ''; // animation
        $uniqueId = isset($attributes['uniqueId']) ? esc_attr($attributes['uniqueId']) : '';
        $innerclass = '';

        $imageEffect = $attributes['imagehvreffect'] ?? '';
        $flipSide    = $attributes['flipside'] ?? '';

        $flipMap = [
            'flip' => [
                'right'  => 'vayu_blocks_flip-box-inner_animation_div_flip-front',
                'left'   => 'vayu_blocks_flip-box-inner_animation_div_flip-front-left',
                'top'    => 'vayu_blocks_flip-box-inner_animation_div_flip-back',
                'bottom' => 'vayu_blocks_flip-box-inner_animation_div_flip-back-bottom',
            ],
            'slide' => [
                'right'  => 'vayu_blocks_flip-box-inner_animation_div_slide_animation-right',
                'left'   => 'vayu_blocks_flip-box-inner_animation_div_slide_animation-left',
                'top'    => 'vayu_blocks_flip-box-inner_animation_div_slide_animation-top',
                'bottom' => 'vayu_blocks_flip-box-inner_animation_div_slide_animation-bottom',
            ],
            'push' => [
                'right'  => 'vayu_blocks_flip-box-inner_animation_div_push_animation-right',
                'left'   => 'vayu_blocks_flip-box-inner_animation_div_push_animation-left',
                'top'    => 'vayu_blocks_flip-box-inner_animation_div_push_animation-top',
                'bottom' => 'vayu_blocks_flip-box-inner_animation_div_push_animation-bottom',
            ],
        ];

        $staticMap = [
            'flip-z'   => 'vayu_blocks_flip-box-inner_animation_div_flip-z',
            'flip-x'   => 'vayu_blocks_flip-box-inner_animation_div_flip-x',
            'zoom-in'  => 'vayu_blocks_flip-box-inner_animation_div_zoom-in',
            'zoom-out' => 'vayu_blocks_flip-box-inner_animation_div_zoom-out',
            'fade-in'  => 'vayu_blocks_flip-box-inner_animation_div_fade-in',
        ];

        // Priority 1: Effects that depend on flip side
        if ( isset($flipMap[$imageEffect]) && isset($flipMap[$imageEffect][$flipSide]) ) {
            $innerclass = $flipMap[$imageEffect][$flipSide];

        // Priority 2: Direct mapping
        } elseif ( isset($staticMap[$imageEffect]) ) {
            $innerclass = $staticMap[$imageEffect];
        }

        $excludedEffects = [ 'zoom-in', 'zoom-out', 'fade-in', 'slide', 'push' ];

        if ( $attributes['dbox'] && ! in_array( $attributes['imagehvreffect'], $excludedEffects, true ) ) {
            $innerclass .= '-dbox';
        }

        $image_html .= '<div class="vb-flip-box-wrapper" id='. $uniqueId .'>';
            $image_html .= '<div class="vb-flip-box-front-inner ' . $innerclass . '" >';            
                $image_html .= $this->content;
            $image_html .= '</div>';
        $image_html .= '</div>';

       $classes = [];

        if ( ! empty( $attributes['advAnimation']['className'] ) ) {
            $classes[] = $attributes['advAnimation']['className'];
        }

        $classes[] = 'vb-flip-' . $uniqueId;

        return '<div  ' . get_block_wrapper_attributes([
            'class' => implode( ' ', $classes ),
        ]) . '>' . $image_html . '</div>';

    }
    
}

// Render callback for the block
function vayu_blocks_flip_box_render($attr,$content) {
    
    if ((new VAYUBLOCKS_DISPLAY_CONDITION($attr))->display()) {
        return '';
    }

    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);
    $image = new Vayu_blocks_image_flip($attr,$content);
    
    return $image->render();   
}

