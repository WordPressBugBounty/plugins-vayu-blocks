<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function generate_inline_flip_wrapper_styles($attr) {

    $css = '';

    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];
    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    // Generate the class selector by concatenating '.' with the unique ID
    $wrapper = '.vayu-blocks-front_image-main-container-for-front' . esc_attr($uniqueId);

    $css .= ".vayu_blocks_front_image_wrapper-for-front{";
        if($attr['parentBlock'] === 'vayu-blocks/advance-slider'){
            $css .= "padding: 30px;";
            if (!empty($attr['heightwrapper'])) {
                $css .= "height: " . esc_attr($attr['heightwrapper']) . "px;";
            } else {
                $css .= "height: auto;";
            }            
        }
    $css .= "}";

    $css .= ".wp_block_vayu-blocks-front-image-main {";
        $css .= "backface-visibility: hidden;";
    $css .= "}";
    
    //Main div
    $css .= "$wrapper {";

        if($attr['parentBlock'] === 'vayu-blocks/advance-slider'){
            $css .= "padding: 20px;";
            if (!empty($attr['heightwrapper'])) {
                $css .= "height: " . esc_attr($attr['heightwrapper']) . "px ;";
            } else {
                $css .= "height: auto;";
            }            
        }

        $css .= "box-sizing:border-box;";

        $css .= "perspective: 1000px;";

        $css .= "width: " . esc_attr($attr['customWidth']) . esc_attr($attr['customWidthUnit']) . ";";

        $css .= "max-width:100%;";
        
        $css .= "margin-left:auto !important;";
        $css .= "margin-right:auto !important;";
        
        if ($attr['advancebordertype'] === 'color') {

            if(!empty($attr['advanceborder']) || !empty($attr['advanceRadius'])){
                $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder','advanceRadius','Desktop');
            }

        } elseif ($attr['advancebordertype'] === 'gradient') {
            
            $css .= "border-image: " . esc_attr($attr['advancebordergradient']) . " 30% / " . esc_attr($attr['advancegradienttop']) . " " . esc_attr($attr['advancegradientbottom']) . " " . esc_attr($attr['advancegradientleft']) . " " . esc_attr($attr['advancegradientright']) . ";"; // Corrected the syntax

            $border_outset = esc_attr($attr['advancegradientborderimageoutset']) + esc_attr($attr['advancegradienttop']);
            $css .= 'border-image-outset: ' . $border_outset . 'px;';



        }elseif ($attr['advancebordertype'] === 'image') {
            $borderImage = $attr['advanceborderimagetype'] === 'custom' 
                ? 'url(' . esc_url($attr['advanceborderimage']) . ') ' . esc_attr($attr['advanceborderimagesize']) . '% / ' . esc_attr($attr['advanceimagetop']) . ' ' . esc_attr($attr['advanceimagebottom']) . ' ' . esc_attr($attr['advanceimageleft']) . ' ' . esc_attr($attr['advanceimageright']) . ' / ' . esc_attr($attr['advanceborderimageoutset']) . 'px ' . esc_attr($attr['advancespace'])
                : ($attr['advanceborderimagetype'] === 'image1'
                    ? 'url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKE3oR0_1fMluZWzbUZo_e-0O-Rkdq6xNudQ&s) ' . esc_attr($attr['advanceborderimagesize']) . '% / ' . esc_attr($attr['advanceimagetop']) . ' ' . esc_attr($attr['advanceimagebottom']) . ' ' . esc_attr($attr['advanceimageleft']) . ' ' . esc_attr($attr['advanceimageright']) . ' / ' . esc_attr($attr['advanceborderimageoutset']) . 'px ' . esc_attr($attr['advancespace'])
                    : ($attr['advanceborderimagetype'] === 'image2'
                        ? 'url(https://t4.ftcdn.net/jpg/00/90/22/23/360_F_90222304_MnOvAi5X9Rr2ywonhlSpaDPWD0MmLgiY.jpg) ' . esc_attr($attr['advanceborderimagesize']) . '% / ' . esc_attr($attr['advanceimagetop']) . ' ' . esc_attr($attr['advanceimagebottom']) . ' ' . esc_attr($attr['advanceimageleft']) . ' ' . esc_attr($attr['advanceimageright']) . ' / ' . esc_attr($attr['advanceborderimageoutset']) . 'px ' . esc_attr($attr['advancespace'])
                        : ($attr['advanceborderimagetype'] === 'image3'
                            ? 'url(https://www.w3schools.com/cssref/border.png) ' . esc_attr($attr['advanceborderimagesize']) . '% / ' . esc_attr($attr['advanceimagetop']) . ' ' . esc_attr($attr['advanceimagebottom']) . ' ' . esc_attr($attr['advanceimageleft']) . ' ' . esc_attr($attr['advanceimageright']) . ' /' . esc_attr($attr['advanceborderimageoutset']) . 'px ' . esc_attr($attr['advancespace'])
                            : ($attr['advanceborderimagetype'] === 'image4'
                                ? 'url(https://w7.pngwing.com/pngs/169/875/png-transparent-frame-diamond-lace-border-border-frame-symmetry-thumbnail.png) ' . esc_attr($attr['advanceborderimagesize']) . '% / ' . esc_attr($attr['advanceimagetop']) . ' ' . esc_attr($attr['advanceimagebottom']) . ' ' . esc_attr($attr['advanceimageleft']) . ' ' . esc_attr($attr['advanceimageright']) . '/' . esc_attr($attr['advanceborderimageoutset']) . 'px ' . esc_attr($attr['advancespace'])
                                : 'none'))));
        
            $css .= "border-image: " . $borderImage . ";"; // Use the determined border image
        }
    
        // Box-shadow
        if (!empty($attr['boxShadow'])) {
            $css .= $OBJ_STYLE->borderRadiusShadow('', '', 'boxShadow', 'Desktop');
        }

       // Background
       if (isset($attr['backgroundType'])) {
           if ($attr['backgroundType'] === 'color' && isset($attr['backgroundColor'])) {
               $css .= "background: " . esc_attr($attr['backgroundColor']) . ";";
           } elseif ($attr['backgroundType'] === 'gradient' && isset($attr['backgroundGradient'])) {
               $css .= "background: " . esc_attr($attr['backgroundGradient']) . ";";
           } elseif (isset($attr['backgroundImage']) && isset($attr['backgroundImage']['url'])) {
               $css .= "background: url(" . esc_url($attr['backgroundImage']['url']) . ");";
           } else {
               $css .= "background: none;";
           }
       } elseif(isset($attr['backgroundColor'])) { 
           $css .= "background: " . esc_attr($attr['backgroundColor']) . ";";
       }

       // Background properties
       $css .= isset($attr['backgroundPosition']) ? 
       "background-position: " . (esc_attr($attr['backgroundPosition']['x']) * 100) . '%,' . (esc_attr($attr['backgroundPosition']['y']) * 100) . '%;' : 
       'background-position: 50%, 50%;';
   
       $css .= isset($attr['backgroundAttachment']) ? "background-attachment: " . esc_attr($attr['backgroundAttachment']) . ";" : '';
       $css .= isset($attr['backgroundRepeat']) ? "background-repeat: " . esc_attr($attr['backgroundRepeat']) . ";" : '';
       $css .= isset($attr['backgroundSize']) ? "background-size: " . esc_attr($attr['backgroundSize']) . ";" : '';

       // Transition
       $css .= "transition-duration: " . (isset($attr['transitionAll']) ? esc_attr($attr['transitionAll']) : '0') . "s;";
  
    $css .= "}";
     

     /* Tablet Styles */
     $css .= "@media (max-width: 1024px) {";
        $css .= "$wrapper {";
            if ($attr['advancebordertype'] === 'color') {
                if(!empty($attr['advanceborder']) || !empty($attr['advanceRadius'])){
                $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder','advanceRadius','Tablet');
                }
            }
        $css .= "}";
    $css .= "}";

    /* Tablet Styles */
    $css .= "@media (max-width: 300px) {";
        $css .= "$wrapper {";
            if ($attr['advancebordertype'] === 'color') {
                if(!empty($attr['advanceborder']) || !empty($attr['advanceRadius'])){
                $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder','advanceRadius','Mobile');
                }
            }
        $css .= "}";
     $css .= "}";

    //for tablet
    $css .= "@media (max-width: 1024px) {

        $wrapper {
            width: " . (isset($attr['customWidthTablet']) ? esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) : '') . ";
            grid-template-columns: repeat(" . (isset($attr['pg_postLayoutColumnsTablet']) ? $attr['pg_postLayoutColumnsTablet'] : 2) . ", 1fr);
            grid-gap: " . (isset($attr['pg_gapupTablet']) ? esc_attr($attr['pg_gapupTablet']) . 'px ' . esc_attr($attr['pg_gapTablet']) . 'px' : '') . ";
        }
        
    }";
    
    // Add media query for tablet screens
    $css .= "@media (max-width: 768px) {";
        $css .= ".th-front-image-main-wp-editor-wrapper {";
            $css .= "width: " . esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) . ";";
        $css .= "}";
    $css .= "}";
    
    // Add media query for Mobile screens
    $css .= "@media (max-width: 300px) {";
        $css .= ".th-front-image-main-wp-editor-wrapper {";
            $css .= "width: " . esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) . ";";
        $css .= "}";
    $css .= "}";

    //for mobile
    $css .= "@media (max-width: 400px) {

        $wrapper {
            width: " . (isset($attr['customWidthMobile']) ? esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) : '') . ";
            grid-template-columns: repeat(" . (isset($attr['pg_postLayoutColumnsMobile']) ? $attr['pg_postLayoutColumnsMobile'] : 1) . ", 1fr);
            grid-template-rows: repeat(" . (isset($attr['pg_numberOfRowMobile']) ? $attr['pg_numberOfRowMobile'] : 2) . ", minmax(100px, 1fr));
            grid-gap: " . (isset($attr['pg_gapupMobile']) ? esc_attr($attr['pg_gapupMobile']) . 'px ' . esc_attr($attr['pg_gapMobile']) . 'px' : '') . ";
        }

    }";

    return $css;
}
