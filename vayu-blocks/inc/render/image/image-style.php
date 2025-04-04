<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function generate_inline_image_styles($attr) {

    $css = '';

    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];

    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    // Generate the class selector by concatenating '.' with the unique ID
    $wrapper = '.vayu-blocks-image-block.vayu-blocks-image-main-container' . esc_attr($uniqueId);

    $inline = '.vayu_blocks_image__wrapper';

    // Add media query for tablet screens
    $css .= "@media (max-width: 768px) {";
        $css .= ".th-image-flip-main-wp-editor-wrapper {";
            $css .= "width: " . esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) . ";";
        $css .= "}";
    $css .= "}";

    // Add media query for Mobile screens
    $css .= "@media (max-width: 300px) {";
        $css .= ".th-image-flip-main-wp-editor-wrapper {";
            $css .= "width: " . esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) . ";";
        $css .= "}";
    $css .= "}";

    //Main div
    $css .= "$wrapper{";

        // Position and Z-index
        $css .= isset($attr['position']) ? "position: " . esc_attr($attr['position']) . ";" : '';
        $css .= isset($attr['zIndex']) ? "z-index: " . esc_attr($attr['zIndex']) . ";" : '';

        // Alignment and Order
        $css .= isset($attr['selfAlign']) ? "align-self: " . esc_attr($attr['selfAlign']) . ";" : '';
        $css .= isset($attr['order']) && $attr['order'] === 'custom' && isset($attr['customOrder']) ? "order: " . esc_attr($attr['customOrder']) . ";" : '';

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

        // Box-shadow
        if (!empty($attr['buttonpadding'])) {
            $css .= $OBJ_STYLE->dimensions('buttonpadding', 'padding', 'Desktop');
        }
        
        // Box-shadow
        if (!empty($attr['buttonmargin'])) {
            $css .= $OBJ_STYLE->dimensions('buttonmargin','margin','Desktop');
        }

        $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder', 'advanceborderradius','advancedropshadow', 'Desktop');

        // Background properties
        $css .= isset($attr['backgroundPosition']) ? "background-position: " . esc_attr($attr['backgroundPosition']['x']) . ',' . esc_attr($attr['backgroundPosition']['y']) . ";" : 'background-position: 50%, 50%;';
        $css .= isset($attr['backgroundAttachment']) ? "background-attachment: " . esc_attr($attr['backgroundAttachment']) . ";" : '';
        $css .= isset($attr['backgroundRepeat']) ? "background-repeat: " . esc_attr($attr['backgroundRepeat']) . ";" : '';
        $css .= isset($attr['backgroundSize']) ? "background-size: " . esc_attr($attr['backgroundSize']) . ";" : '';

        // Transition
        $css .= "transition-duration: " . (isset($attr['transitionAll']) ? esc_attr($attr['transitionAll']) : '0') . "s;";
        
    $css .= "}";
     
    // Add media query for tablet screens
    $css .= "@media (max-width: 1024px) {";
        $css .= "$wrapper {";
            $css .= "width: " . esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) . ";";
            // Box-shadow
            if (!empty($attr['buttonpadding'])) {
                $css .= $OBJ_STYLE ->dimensions('buttonpadding','padding',  'Tablet');	
            }

            // Box-shadow
            if (!empty($attr['buttonmargin'])) {
                $css .= $OBJ_STYLE ->dimensions('buttonmargin','margin',  'Tablet');
            }
           
           
            $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder', 'advanceborderradius','advancedropshadow', 'Tablet');
        $css .= "}";

        $css .= "$wrapper:hover {";
            $css .= $OBJ_STYLE->borderRadiusShadow('advanceborderhvr', 'advanceborderradiushvr','advancedropshadowhvr', 'Tablet');
        $css .= "}";

    $css .= "}";

    // Add media query for Mobile screens
    $css .= "@media (max-width: 300px) {";
        $css .= "$wrapper {";
            $css .= "width: " . esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) . ";";

            if (!empty($attr['buttonpadding'])) {
                $css .= $OBJ_STYLE ->dimensions('buttonpadding','padding',  'Mobile');	
            }

            // Box-shadow
            if (!empty($attr['buttonmargin'])) {
                $css .= $OBJ_STYLE ->dimensions('buttonmargin', 'margin', 'Mobile');
            }

            $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder', 'advanceborderradius','advancedropshadow', 'Mobile');
        $css .= "}";

        $css .= "$wrapper:hover {";
            $css .= $OBJ_STYLE->borderRadiusShadow('advanceborderhvr', 'advanceborderradiushvr','advancedropshadowhvr', 'Mobile');
        $css .= "}";

    $css .= "}";

    //Hover 
    $css .= "$wrapper:hover {";
        $css .= $OBJ_STYLE->borderRadiusShadow('advanceborderhvr', 'advanceborderradiushvr','advancedropshadowhvr', 'Desktop');

        // Background
        if (isset($attr['backgroundTypeHvr'])) {
            if ($attr['backgroundTypeHvr'] === 'color' && isset($attr['backgroundColorHvr'])) {
                $css .= "background: " . esc_attr($attr['backgroundColorHvr']) . ";";
            } elseif ($attr['backgroundTypeHvr'] === 'gradient' && isset($attr['backgroundGradientHvr'])) {
                $css .= "background: " . esc_attr($attr['backgroundGradientHvr']) . ";";
            } elseif (isset($attr['backgroundImageHvr']) && isset($attr['backgroundImageHvr']['url'])) {
                $css .= "background: url(" . esc_url($attr['backgroundImageHvr']['url']) . ");";
            } else {
                $css .= "background: none;";
            }
        } elseif(isset($attr['backgroundColorHvr'])) { 
            $css .= "background: " . esc_attr($attr['backgroundColorHvr']) . ";";
        }

        // Background position, attachment, repeat, size
        $css .= isset($attr['backgroundPositionHvr']) ? "background-position: " . esc_attr($attr['backgroundPositionHvr']['x'] . ',' . $attr['backgroundPositionHvr']['y']) . ";" : '';
        $css .= isset($attr['backgroundAttachmentHvr']) ? "background-attachment: " . esc_attr($attr['backgroundAttachmentHvr']) . ";" : '';
        $css .= isset($attr['backgroundRepeatHvr']) ? "background-repeat: " . esc_attr($attr['backgroundRepeatHvr']) . ";" : '';
        $css .= isset($attr['backgroundSizeHvr']) ? "background-size: " . esc_attr($attr['backgroundSizeHvr']) . ";" : '';

        // Transition
        $css .= "transition: all 0.3s ease-in-out;";
            
    $css .= "}";

    $css .= ".vayu_blocks_image_flip-duotone-filters {";
        $css .= "display: none;";
        $css .= "height: 0;";
    $css .= "}";

    // Effect 3 CSS rule
    $css .= "$wrapper .vayu_block_styling-effect3::after {";
        $css .= "background:" . esc_attr($attr['wrapppereffect3color']) . ";";
        $css .= "box-shadow: 1rem 1rem 2rem " . esc_attr($attr['wrapppereffect3color']) . ";";
    $css .= "}";

    // Effect 10 CSS rule
    $css .= "$wrapper .vayu_block_styling-effect10 {";
        $css .= "background:" . esc_attr($attr['wrapppereffect3color']) . ";";
    $css .= "}";

    $css .= "$wrapper .vayu_block_styling-effect10 {";
        $css .= " box-shadow:
        1px 1px 0 1px " . esc_attr($attr['wrapppereffect3color']) . ",
        -1px 0 28px 0 rgba(34, 33, 81, 0.01),
        28px 28px 28px 0 rgba(34, 33, 81, 0.25) !important;";
    $css .= "}";
    
    $css .= "$wrapper .vayu_block_styling-effect10:hover {";
        $css .= " box-shadow:
        1px 1px 0 1px " . esc_attr($attr['wrapppereffect3color']) . ",
        -1px 0 28px 0 rgba(34, 33, 81, 0.01),
        54px 54px 28px -10px rgba(34, 33, 81, 0.15) !important;";
    $css .= "}";

    // Append CSS rules to $css
    $css .= "$wrapper $inline {";
        // $css .= " overflow: hidden;";
        if (!empty($attr['imagewidth'])) {
            $css .= "width: " . esc_attr($attr['imagewidth']) . ";";
        } else {
            $css .= "width: auto;";
        }
        
        if (!empty($attr['imageheight'])) {
            $css .= "height: " . esc_attr($attr['imageheight']) . ";";
        } else {
            $css .= "height: auto";
        }
    
        $css .= " position: relative;";
        $css .= "perspective: 1000px;";
        $css .= "transform-style: preserve-3d;";

        // // Box-shadow
        // if (!empty($attr['imageboxShadow'])) {
        //     $css .= $OBJ_STYLE->borderRadiusShadow('', '', 'imageboxShadow', 'Desktop');
        // }
       
    $css .= "}";

    $css .= "$wrapper .vayu_blocks_rotating_div{";
        $rotation = esc_attr($attr['rotation']) % 360; // This will ensure the value is within 0-359
        $css .= "transform: rotate( " . $rotation . "deg) !important;";
    $css .= "}";
    
    // Assuming $attr['imagetransitiontime'] contains the transition time value
    $transitionTime = isset($attr['imagetransitiontime']) ? esc_attr($attr['imagetransitiontime']) : '0.5'; // Default to 0.5s if not set
    
    // Append CSS rules to $css
    $css .= "$wrapper .vayu_blocks__image_image {";

        if($attr['imagehvreffect'] === 'flip-front' || $attr['imagehvreffect']) {
            $css .= "backface-visibility: hidden;";
        }

        $css .= "width: 100%;";
        $css .= "max-width: 100%;";
        $css .= "height: 100%;";

        $css .= "box-sizing: border-box;";
        
        $css .= "    transition: transform {$transitionTime}s ease, filter {$transitionTime}s ease, opacity {$transitionTime}s ease;";

        $css .= "    opacity: 1;"; // Assuming a default opacity value
        $css .= "    object-fit: " . esc_attr($attr['imagebackgroundSize']) . ";"; // Assuming this controls object-fit

        // Apply focal point if it exists, default to center
        $css .= "    object-position: " . (isset($attr['focalPoint']) ? esc_attr($attr['focalPoint']['x'] * 100) : '50') . "% " . (isset($attr['focalPoint']) ? esc_attr($attr['focalPoint']['y'] * 100) : '50') . "%;";

        // Apply aspect ratio if it exists
        if ($attr['imageaspectratio'] !== 'none') {
            if ($attr['imageaspectratio'] === 'original') {
                $css .= "    aspect-ratio: auto;"; // Maintain original aspect ratio
            } else {
                $css .= "    aspect-ratio: " . str_replace('/', '/', esc_attr($attr['imageaspectratio'])) . ";";
            }
        } else {
            $css .= "    aspect-ratio: auto;";
        }

       // Apply duotone filter if it exists and is a valid array or string
        if (isset($attr['duotone']) && !empty($attr['duotone'])) {
            // If duotone is a string, apply it directly
            if (is_string($attr['duotone'])) {
                $css .= "    filter: url(" . esc_attr($attr['duotone']) . ") !important;";
            } 
            // If duotone is an array with more than one value, apply it as a filter
            elseif (is_array($attr['duotone']) && count($attr['duotone']) > 1) {
                $css .= "    filter: url(" . esc_attr($attr['duotone'][0]) . ") ;";
            }
        }

        if(!empty($attr['imageborderRadius'])){
            $css .= $OBJ_STYLE->borderRadiusShadow('','imageborderRadius','Desktop');
            }

       // Box-shadow
       if (!empty($attr['imageboxShadow'])) {
        $css .= $OBJ_STYLE->borderRadiusShadow('', '', 'imageboxShadow', 'Desktop');
        }

      
    $css .= "}";

    // Append CSS rules to $css
    $css .= "$wrapper .vayu_blocks_image_image-container_image {";
        $css .= "    transition: transform {$transitionTime}s ease, filter {$transitionTime}s ease, opacity {$transitionTime}s ease;";
        $css .= "justify-content: center;";
        $css .= "display: flex;";
        $css .= "align-items: center;";
    
    $css .= "}";

    // Append hover effect CSS rules
    $css .= " $wrapper $inline:hover .vayu_blocks__image_image {";
        $css .= "    transform: var(--image-hover-effect-transform, none);";
        $css .= "    filter: var(--image-filter-effect, none);";
        $css .= "    opacity: var(--image-hover-effect-opacity, 1);";

        
        // Apply individual border-radius values if all values are set and not empty
        if (
            isset($attr['advanceRadiushvr']['top']) && ($attr['advanceRadiushvr']['top'])!='0px' ||
            isset($attr['advanceRadiushvr']['right']) && ($attr['advanceRadiushvr']['right']) !='0px' ||
            isset($attr['advanceRadiushvr']['bottom']) && ($attr['advanceRadiushvr']['bottom']) !='0px' ||
            isset($attr['advanceRadiushvr']['left']) && ($attr['advanceRadiushvr']['left'])!='0px'
        ) {
            $css .= "border-radius: " . esc_attr($attr['advanceRadiushvr']['top']) . " " . esc_attr($attr['advanceRadiushvr']['right']) . " " . esc_attr($attr['advanceRadiushvr']['bottom']) . " " . esc_attr($attr['advanceRadiushvr']['left']) . ";";
        }
        
    $css .= "}";

    $css .= " $wrapper .vayu_blocks_main_image_container_image_image {";
        $css .= "justify-content: " . (
            $attr['imagealignment'] === 'center' ? 'center' :
            ($attr['imagealignment'] === 'left' ? 'flex-start' :
            ($attr['imagealignment'] === 'right' ? 'flex-end' : 'center'))
        ) . ";";
        $css .= "display:flex;";
        $css .= "width:100%;";
        $css .= "height:100%;";
    $css .= "}";

    $css .= "$wrapper .flip-front {";
        $css .= "  --image-hover-effect-transform: rotateY(180deg);";
    $css .= "}";

    $css .= "$wrapper .flip-back {";
        $css .= "  --image-hover-effect-transform: rotateX(180deg);";
    $css .= "}";
        
    $css .= "$wrapper .flip-front-left {";
        $css .= "  --image-hover-effect-transform: rotateY(-180deg);";
    $css .= "}";

    $css .= "$wrapper .flip-back-bottom {";
        $css .= "  --image-hover-effect-transform: rotateX(-180deg);";
    $css .= "}";

    /* Grayscale */
    $css .= "$wrapper .grayScale {";
        $css .= "    --image-filter-effect: grayscale(100%);";
    $css .= "}";

    /* Grayscale reverse hover */
    $css .= "$wrapper .grayScalereverse {";
        $css .= "    filter: grayscale(100%) !important;";
        $css .= "    transition: filter " . esc_attr($attr['imagetransitiontime']) . "s ease;";
    $css .= "}";

    $css .= "$wrapper .grayScalereverse:hover {";
        $css .= "filter: none;";
    $css .= "}";

    /* Sepia */
    $css .= "$wrapper .sepia {";
        $css .= "    --image-filter-effect: sepia(100%);";
    $css .= "}";

    /* Zoom-in and Zoom-out effects */
    $css .= "$wrapper .zoom-in {";
        $css .= "    --image-hover-effect-transform: scale(1.5);";
    $css .= "}";

    $css .= "$wrapper .zoom-out {";
        $css .= "    --image-hover-effect-transform: scale(0.8);";
    $css .= "}";

    /* Fade-in and Fade-out effects */
    $css .= "$wrapper .fade-in {";
        $css .= "    --image-hover-effect-opacity: 1;";
    $css .= "}";

    $css .= "$wrapper .fade-out {";
        $css .= "    --image-hover-effect-opacity: 0.5;";
    $css .= "}";

    /* Slide effects */
    $css .= "$wrapper .slide-up {";
        $css .= "    --image-hover-effect-transform: translateY(-10px);";
    $css .= "}";

    $css .= "$wrapper .slide-down {";
        $css .= "    --image-hover-effect-transform: translateY(10px);";
    $css .= "}";

    $css .= "$wrapper .slide-left {";
        $css .= "    --image-hover-effect-transform: translateX(-10px);";
    $css .= "}";

    $css .= "$wrapper .slide-right {";
        $css .= "    --image-hover-effect-transform: translateX(10px);";
    $css .= "}";

    /* Flip effects */
    $css .= "$wrapper .flip-horizontal {";
        $css .= "    --image-hover-effect-transform: rotateY(180deg);";
    $css .= "}";

    $css .= "$wrapper .flip-vertical {";
        $css .= "    --image-hover-effect-transform: rotateX(180deg);";
    $css .= "}";

    /* Rotate */
    $css .= "$wrapper .rotate {";
        $css .= "    --image-hover-effect-transform: rotate(-30deg);";
    $css .= "}";

    /* Blur */
    $css .= "$wrapper .blur {";
        $css .= "    --image-filter-effect: blur(3px);";
    $css .= "}";

    /* Shine */
    $css .= "$wrapper .shine {";
        $css .= "    --image-filter-effect: grayscale(100%);";
    $css .= "}";

    if($attr['overlayshow']){
        /* Hover the image and show the overlay */
        $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image:hover:after {";
                if($attr['overlayhvrcolor']){
                    $css .= "background: " . esc_attr($attr['overlayhvrcolor']) . " !important;";
                }
                $css .= "opacity: " . esc_attr($attr['overlayOpacityhvr']) . " !important;";
        $css .= "}";
    }

    //inerrblok animation
    /* Initially set the paragraph opacity to 0 and position it below */
    $css .= "$wrapper .vayu-blocks-para-innerblock {";
        $css .= "opacity: 0;";
        $css .= "transform: translateY(20px);";  /* Move paragraph further down */
        $css .= "transition: opacity 0.6s ease, transform 0.6s ease;";  /* Longer and smoother transition */
    $css .= "}";

    /* Heading is in its original place initially */
    $css .= "$wrapper .vayu-blocks-heading-innerblock {";
        $css .= "transform: translate3d(0, 24px, 0);";  /* Move heading slightly down initially */
        $css .= "transition: transform 0.6s ease;";  /* Longer transition */
    $css .= "}";

    /* On hover, move heading up and make paragraph visible with a smooth 3D effect */
    $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image:hover .vayu-blocks-heading-innerblock {";
        $css .= "transform: translateY(0px);";  /* Move heading 10px up for more noticeable movement */
    $css .= "}";

    $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image:hover .vayu-blocks-para-innerblock {";
        $css .= "opacity: 1;";
        $css .= "transform: translateY(0);";  /* Bring paragraph to its original position with smoother 3D effect */
    $css .= "}";

    /* On hover out, move paragraph back down and fade out smoothly */
    $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image:not(:hover) .vayu-blocks-para-innerblock {";
        $css .= "opacity: 0;";
        $css .= "transform: translateY(20px);";  /* Move paragraph back down */
        $css .= "transition: opacity 0.6s ease, transform 0.6s ease;";  /* Smooth transition */
    $css .= "}";
    
    /* Overlay styles */
    $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image {";
        $css .= "width: " . esc_attr($attr['overlaywidth']) . ";";
        $css .= "height: " . esc_attr($attr['overlayheight']) . ";";
        $css .= "position: absolute;";
        $css .= "top: " . esc_attr($attr['overlaytop']) . ";";
        $css .= "left: " . esc_attr($attr['overlayleft']) . ";";
        $css .= "transition: " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
        // $css .= "opacity:  " . esc_attr($attr['overlayOpacity']) . ";";
        $css .= "z-index: 10;";
        $css .= "display: flex;";
        $css .= "box-sizing: border-box;";
        $css .= "overflow:hidden;";

        if (!empty($attr['advanceglobaldropshadow'])) {
            $css .= $OBJ_STYLE->borderRadiusShadow('', '', 'advanceglobaldropshadow', 'Desktop');
        }
        
        if($attr['parentBlock']==="vayu-blocks/advance-slider" && !$attr['frameshow']){

            if ($attr['parentBlockAttributes']['advancebordertype'] === 'color') {

                if(!empty($attr['advanceborderglobal']) && !empty($attr['advanceRadiusglobal'])){
                    $css .= $OBJ_STYLE->borderRadiusShadow('advanceborderglobal','advanceRadiusglobal','Desktop');

                }

            }elseif ($attr['parentBlockAttributes']['advancebordertype'] === 'gradient') {
                
                $css .= "border-image: " . esc_attr($attr['parentBlockAttributes']['advancebordergradient']) . " 30% / " . esc_attr($attr['parentBlockAttributes']['advancegradienttop']) . " " . esc_attr($attr['parentBlockAttributes']['advancegradientbottom']) . " " . esc_attr($attr['parentBlockAttributes']['advancegradientleft']) . " " . esc_attr($attr['parentBlockAttributes']['advancegradientright']) . ";"; // Corrected the syntax

                $css .= "border-width:" . esc_attr($attr['parentBlockAttributes']['advancegradienttop']) . " " . esc_attr($attr['parentBlockAttributes']['advancegradientbottom']) . " " . esc_attr($attr['parentBlockAttributes']['advancegradientleft']) . " " . esc_attr($attr['parentBlockAttributes']['advancegradientright']) . ";";

            }elseif ($attr['parentBlockAttributes']['advancebordertype'] === 'image') {
                $borderImage = $attr['parentBlockAttributes']['advanceborderimagetype'] === 'custom' 
                    ? 'url(' . esc_url($attr['parentBlockAttributes']['advanceborderimage']) . ') ' . esc_attr($attr['parentBlockAttributes']['advanceborderimagesize']) . '% / ' . esc_attr($attr['parentBlockAttributes']['advanceimagetop']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimagebottom']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageleft']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageright']) . ' / ' . esc_attr($attr['parentBlockAttributes']['advanceborderimageoutset']) . 'px ' . esc_attr($attr['parentBlockAttributes']['advancespace'])
                    : ($attr['parentBlockAttributes']['advanceborderimagetype'] === 'image1'
                        ? 'url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKE3oR0_1fMluZWzbUZo_e-0O-Rkdq6xNudQ&s) ' . esc_attr($attr['parentBlockAttributes']['advanceborderimagesize']) . '% / ' . esc_attr($attr['parentBlockAttributes']['advanceimagetop']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimagebottom']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageleft']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageright']) . ' / ' . esc_attr($attr['parentBlockAttributes']['advanceborderimageoutset']) . 'px ' . esc_attr($attr['parentBlockAttributes']['advancespace'])
                        : ($attr['parentBlockAttributes']['advanceborderimagetype'] === 'image2'
                            ? 'url(https://t4.ftcdn.net/jpg/00/90/22/23/360_F_90222304_MnOvAi5X9Rr2ywonhlSpaDPWD0MmLgiY.jpg) ' . esc_attr($attr['parentBlockAttributes']['advanceborderimagesize']) . '% / ' . esc_attr($attr['parentBlockAttributes']['advanceimagetop']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimagebottom']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageleft']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageright']) . ' / ' . esc_attr($attr['parentBlockAttributes']['advanceborderimageoutset']) . 'px ' . esc_attr($attr['parentBlockAttributes']['advancespace'])
                            : ($attr['parentBlockAttributes']['advanceborderimagetype'] === 'image3'
                                ? 'url(https://www.w3schools.com/cssref/border.png) ' . esc_attr($attr['parentBlockAttributes']['advanceborderimagesize']) . '% / ' . esc_attr($attr['parentBlockAttributes']['advanceimagetop']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimagebottom']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageleft']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageright']) . ' /' . esc_attr($attr['parentBlockAttributes']['advanceborderimageoutset']) . 'px ' . esc_attr($attr['parentBlockAttributes']['advancespace'])
                                : ($attr['parentBlockAttributes']['advanceborderimagetype'] === 'image4'
                                    ? 'url(https://w7.pngwing.com/pngs/169/875/png-transparent-frame-diamond-lace-border-border-frame-symmetry-thumbnail.png) ' . esc_attr($attr['parentBlockAttributes']['advanceborderimagesize']) . '% / ' . esc_attr($attr['parentBlockAttributes']['advanceimagetop']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimagebottom']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageleft']) . ' ' . esc_attr($attr['parentBlockAttributes']['advanceimageright']) . '/' . esc_attr($attr['parentBlockAttributes']['advanceborderimageoutset']) . 'px ' . esc_attr($attr['parentBlockAttributes']['advancespace'])
                                    : 'none'))));
            
                $css .= "border-image: " . $borderImage . ";"; // Use the determined border image
            }

        }else{
            if($attr['frameshow']){
                if ($attr['overlaybordertype'] === 'color') {
                    if(!empty($attr['imageborder']) && !empty($attr['imageborderRadius'])){
                    $css .= $OBJ_STYLE->borderRadiusShadow('imageborder','imageborderRadius','Desktop');
                    }
                }elseif ($attr['overlaybordertype'] === 'gradient') {
                    
                    $css .= "border-image: " . esc_attr($attr['overlaybordergradient']) . " 30% / 1 / 0 stretch;"; 

                    $border_width = esc_attr($attr['overlaygradienttop'] ?? '0px') . " " . 
                                    esc_attr($attr['overlaygradientbottom'] ?? '0px') . " " . 
                                    esc_attr($attr['overlaygradientleft'] ?? '0px') . " " . 
                                    esc_attr($attr['overlaygradientright'] ?? '0px');

                    $css .= "border-width: $border_width;";
                    $css .= "border-style: solid;";  // Ensure a border is actually applied
                
                }elseif ($attr['overlaybordertype'] === 'image') {
                    $borderImage = $attr['overlayborderimagetype'] === 'custom' 
                        ? 'url(' . esc_url($attr['overlayborderimage']) . ') ' . esc_attr($attr['borderimagesize']) . '% / ' . esc_attr($attr['overlayimagetop']) . ' ' . esc_attr($attr['overlayimagebottom']) . ' ' . esc_attr($attr['overlayimageleft']) . ' ' . esc_attr($attr['overlayimageright']) . ' / ' . esc_attr($attr['borderimageoutset']) . 'px ' . esc_attr($attr['overlayspace'])
                        : ($attr['overlayborderimagetype'] === 'image1'
                            ? 'url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKE3oR0_1fMluZWzbUZo_e-0O-Rkdq6xNudQ&s) ' . esc_attr($attr['borderimagesize']) . '% / ' . esc_attr($attr['overlayimagetop']) . ' ' . esc_attr($attr['overlayimagebottom']) . ' ' . esc_attr($attr['overlayimageleft']) . ' ' . esc_attr($attr['overlayimageright']) . ' / ' . esc_attr($attr['borderimageoutset']) . 'px ' . esc_attr($attr['overlayspace'])
                            : ($attr['overlayborderimagetype'] === 'image2'
                                ? 'url(https://t4.ftcdn.net/jpg/00/90/22/23/360_F_90222304_MnOvAi5X9Rr2ywonhlSpaDPWD0MmLgiY.jpg) ' . esc_attr($attr['borderimagesize']) . '% / ' . esc_attr($attr['overlayimagetop']) . ' ' . esc_attr($attr['overlayimagebottom']) . ' ' . esc_attr($attr['overlayimageleft']) . ' ' . esc_attr($attr['overlayimageright']) . ' / ' . esc_attr($attr['borderimageoutset']) . 'px ' . esc_attr($attr['overlayspace'])
                                : ($attr['overlayborderimagetype'] === 'image3'
                                    ? 'url(https://www.w3schools.com/cssref/border.png) ' . esc_attr($attr['borderimagesize']) . '% / ' . esc_attr($attr['overlayimagetop']) . ' ' . esc_attr($attr['overlayimagebottom']) . ' ' . esc_attr($attr['overlayimageleft']) . ' ' . esc_attr($attr['overlayimageright']) . ' /' . esc_attr($attr['borderimageoutset']) . 'px ' . esc_attr($attr['overlayspace'])
                                    : ($attr['overlayborderimagetype'] === 'image4'
                                        ? 'url(https://w7.pngwing.com/pngs/169/875/png-transparent-frame-diamond-lace-border-border-frame-symmetry-thumbnail.png) ' . esc_attr($attr['borderimagesize']) . '% / ' . esc_attr($attr['overlayimagetop']) . ' ' . esc_attr($attr['overlayimagebottom']) . ' ' . esc_attr($attr['overlayimageleft']) . ' ' . esc_attr($attr['overlayimageright']) . '/' . esc_attr($attr['borderimageoutset']) . 'px ' . esc_attr($attr['overlayspace'])
                                        : 'none'))));
                
                    $css .= "border-image: " . $borderImage . ";"; // Use the determined border image
                }
            }
        }

        $overlayalignmenttablet = explode(' ', $attr['overlayalignment']); // Split the string
        $vertical = $overlayalignmenttablet[0]; // First part (vertical)
        $horizontal = $overlayalignmenttablet[1]; // Second part (horizontal)

        $css .= "align-items: " . (
            $vertical === 'center' ? 'center' :
            ($vertical === 'top' ? 'self-start' :
            ($vertical === 'bottom' ? 'self-end' : 'center'))
        ) . ";";

        $css .= "justify-content: " . (
            $horizontal === 'center' ? 'center' :
            ($horizontal === 'left' ? 'flex-start' :
            ($horizontal === 'right' ? 'flex-end' : 'center'))
        ) . ";";
        
    $css .= "}";

    /* Tablet Styles */
    $css .= "@media (max-width: 1024px) {";
        $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image {";
        
            if ($attr['parentBlock'] === "vayu-blocks/advance-slider" && !$attr['frameshow']) {
                if ($attr['parentBlockAttributes']['advancebordertype'] === 'color') {
                    if (!empty($attr['advanceborderglobal']) || !empty($attr['advanceRadiusglobal'])) {
                        $css .= $OBJ_STYLE->borderRadiusShadow('advanceborderglobal','advanceRadiusglobal', 'Tablet');
                    }
                }
            }else{
                if($attr['frameshow']){
                    if ($attr['overlaybordertype'] === 'color') {
                        if(!empty($attr['imageborder']) || !empty($attr['imageborderRadius'])){
                        $css .= $OBJ_STYLE->borderRadiusShadow('imageborder','imageborderRadius','Tablet');
                        }
                    }
                }
            }
        $css .= "}";
    $css .= "}";

    /* Mobile Styles */
    $css .= "@media (max-width: 1024px) {";
        $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image {";
        
            if ($attr['parentBlock'] === "vayu-blocks/advance-slider" && !$attr['frameshow']) {
                if ($attr['parentBlockAttributes']['advancebordertype'] === 'color') {
                    if (!empty($attr['advanceborderglobal']) || !empty($attr['advanceRadiusglobal'])) {
                        $css .= $OBJ_STYLE->borderRadiusShadow('advanceborderglobal','advanceRadiusglobal', 'Mobile');
                    }
                }
            }else{
                if($attr['frameshow']){
                    if ($attr['overlaybordertype'] === 'color') {
                        if(!empty($attr['imageborder']) || !empty($attr['imageborderRadius'])){
                        $css .= $OBJ_STYLE->borderRadiusShadow('imageborder','imageborderRadius','Mobile');
                        }
                    }
                }
            }
        $css .= "}";
    $css .= "}";

    $css .= "$wrapper .vayu_blocks_overlay_main_wrapper_image:after {";
        if($attr['overlayshow']){
            $css .= "background-color: " . esc_attr($attr['overlaycolor']) . ";";
            $css .= "opacity: " . esc_attr($attr['overlayOpacity']) . " !important;";
        }

        $css .= 'content: " ";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1; /* Send background behind inner content */ ';
    $css .= "}";
    
    // Determine the SVG based on the maskshape attribute
    switch (esc_attr($attr['maskshape'])) {
        case 'circle':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><circle cx="240" cy="190" r="184"/></svg>';
            break;
        case 'diamond':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><rect x="106.001" y="56.001" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 275.3553 494.0559)" width="267.998" height="267.999"/></svg>';
            break;
        case 'hexagone':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><polygon points="79.386,97.269 240,4.538 400.614,97.269 400.614,282.73 240,375.462 79.386,282.73 "/></svg>';
            break;
        case 'rounded':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><path d="M421,309.436C421,343.437,393.437,371,359.436,371H120.564C86.563,371,59,343.437,59,309.436V70.564C59,36.563,86.563,9,120.564,9h238.871C393.437,9,421,36.563,421,70.564V309.436z"/></svg>';
            break;
        case 'bob1':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><path d="M47.846,184.442c-87.942,134.709,80.073,196.702,186.331,196.702c104.494,0,222.582-39.417,222.582-160.557C456.758-91.25,198.783-46.776,47.846,184.442z"/></svg>';
            break;
        case 'bob2':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><path d="M393.879,31.896c96.935,41.811,41.553,265.103-29.118,320.414c-74.443,58.259-320.428,32.36-330.586-185.032C29.551,68.561,183.588-58.822,393.879,31.896z"/></svg>';
            break;
        case 'bob3':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><path d="M141.699,9.958c37.611-41.211,253.977,90.988,263.995,181.115c10.016,90.134-215.692,232.896-280.453,172.106C69.045,310.428,39.531,121.932,141.699,9.958z"/></svg>';
            break;
        case 'bob4':
            $svg = '<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 480 380" enable-background="new 0 0 480 380" xml:space="preserve"><g><path d="M69.19,26.334C54.496,39.876,42.91,57.185,35.302,75.221c-10.718,25.408-15.268,52.962-18.384,80.363c-10.069,88.57,17.375,190.72,112.557,217.96c63.844,18.273,133.074-0.437,191.492-27.517c85.828-39.789,206.786-163.646,105.685-255.719C372.3,40.81,284.499,59.485,220.248,32.528c-30.103-12.63-58.445-35.896-92.778-33.125C105.078,1.21,85.272,11.517,69.19,26.334z"/></g></svg>';
            break;
        default:
            $svg = '';
            break;
    }

    // Encode the SVG to Base64
    $svgBase64 = base64_encode($svg);

    // Create a Data URL
    $imagePath = "data:image/svg+xml;base64,{$svgBase64}";

    $css .= "$wrapper .maskshapeimage{";
        $css .= "mask-image: url($imagePath);";
        $css .= "-webkit-mask-image: url($imagePath);";
        $css .= "mask-size: " . esc_attr($attr['masksize']) . " ;";
        $css .= "-webkit-mask-size: " . esc_attr($attr['masksize']) . ";";
        $css .= " mask-repeat: " . esc_attr($attr['maskrepeat']) . ";";
        $css .= "-webkit-mask-repeat: " . esc_attr($attr['maskrepeat']) . ";";
        $css .= "mask-position: " . esc_attr($attr['maskposition']) . ";";
        $css .= "-webkit-mask-position: " . esc_attr($attr['maskposition']) . ";";
    $css .= "}";

    /* Custom overlay hover effects */
    $css .= ".overlayfade-in {";
        $css .= "opacity: 0;";
    $css .= "}";

    $css .= "$wrapper .$inline:hover .overlayfade-in {";
        $css .= "opacity: 1;";
    $css .= "}";

    $css .= ".overlayfade-in-up {";
        $css .= "transform: translateY(100%); ";
        $css .= "opacity: 0; ";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= "$wrapper .$inline:hover .overlayfade-in-up {";
        $css .= "transform: translateY(0); ";
        $css .= "opacity: 1;";
    $css .= "}";

    $css .= ".overlayzoom-in-circle {";
        $css .= "transform: scale(0); ";
        $css .= "opacity: 0;";
        $css .= "border-radius: 50%; ";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= "$wrapper .$inline:hover .overlayzoom-in-circle {";
        $css .= "transform: scale(1); ";
        $css .= "opacity: 1;";
        $css .= "border-radius: " . (isset($attr['imageborderRadius']['Desktop']['width']) 
        ? $attr['imageborderRadius']['Desktop']['width'] 
        : ($attr['imageborderRadius']['Desktop']['top']['width'] ?? '0px') . ' ' .
          ($attr['imageborderRadius']['Desktop']['right']['width'] ?? '0px') . ' ' .
          ($attr['imageborderRadius']['Desktop']['bottom']['width'] ?? '0px') . ' ' .
          ($attr['imageborderRadius']['Desktop']['left']['width'] ?? '0px')) . ";";
    
    $css .= "}";

    /* Repeat the same approach for other effects */

    $css .= ".overlayfade-in-down {";
        $css .= "transform: translateY(-100%); ";
        $css .= "opacity: 0; ";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayfade-in-down {";
        $css .= "transform: translateY(0); ";
        $css .= "opacity: 1; ";
    $css .= "}";

    $css .= ".overlayfade-in-left {";
        $css .= "transform: translateX(-100%); ";
        $css .= "opacity: 0; ";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayfade-in-left {";
        $css .= "transform: translateX(0); ";
        $css .= "opacity: 1; ";
    $css .= "}";

    $css .= ".overlayfade-in-right {";
        $css .= "transform: translateX(100%); ";
        $css .= "opacity: 0; ";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
        $css .= "}";

        $css .= ".$inline:hover .overlayfade-in-right {";
        $css .= "transform: translateX(0); ";
        $css .= "opacity: 1; ";
    $css .= "}";

    /* Flip effects */
    $css .= ".overlayflip-horizontal {";
        $css .= "transform: rotateY(-90deg);";
    $css .= "}";

    $css .= ".$inline:hover .overlayflip-horizontal {";
        $css .= "transform: rotateY(0);";
    $css .= "}";

    $css .= ".overlayflip-horizontal-left {";
        $css .= "transform: rotateY(90deg);";
    $css .= "}";

    $css .= ".$inline:hover .overlayflip-horizontal-left {";
        $css .= "transform: rotateY(0);";
    $css .= "}";

    $css .= ".overlayflip-vertical {";
        $css .= "transform: rotateX(-90deg);";
    $css .= "}";

    $css .= ".$inline:hover .overlayflip-vertical {";
        $css .= "transform: rotateX(0);";
    $css .= "}";

    $css .= ".overlayflip-vertical-bottom {";
        $css .= "transform: rotateX(90deg);";
    $css .= "}";

    $css .= ".$inline:hover .overlayflip-vertical-bottom {";
        $css .= "transform: rotateX(0);";
    $css .= "}";
    
    /* Zoom effects */
    $css .= ".overlayzoom-in-up {";
        $css .= "transform: scale(0.5) translateY(-50%);";
        $css .= "opacity: 0;";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayzoom-in-up {";
        $css .= "transform: scale(1) translateY(0);";
        $css .= "opacity: 1;";
    $css .= "}";

    /* Other zoom-in effects with the same pattern... */

    $css .= ".overlayzoom-in-left {";
        $css .= "transform: scale(0.5) translateX(-50%); ";
        $css .= "opacity: 0;";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayzoom-in-left {";
        $css .= "transform: scale(1) translateX(0);";
        $css .= "opacity: 1;";
    $css .= "}";

    $css .= ".overlayzoom-in-right {";
        $css .= "transform: scale(0.5) translateX(50%); ";
        $css .= "opacity: 0;";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayzoom-in-right {";
        $css .= "transform: scale(1) translateX(0);";
        $css .= "opacity: 1;";
    $css .= "}";

    /* Continue the pattern for overlayzoom-in-down */
    $css .= ".overlayzoom-in-down {";
        $css .= "transform: scale(0.5) translateY(50%); ";
        $css .= "opacity: 0;";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayzoom-in-down {";
        $css .= "transform: scale(1) translateY(0);";
        $css .= "opacity: 1;";
    $css .= "}";

    $css .= ".vayu_blocks_inner_content-image {";
        $css .= "position: absolute;";
        $css .= "width: 100%;";
        $css .= "height: 100%;";
        $css .= "top: 0;";
        $css .= "left: 0;";
        $css .= "display: flex;";
        $css .= "align-items: center;";
        $css .= "justify-content: center;";
    $css .= "}";

    $transitionTime = isset($attr['overlaytransitiontime']) ? esc_attr($attr['overlaytransitiontime']) : 0;
    $transitionDelay = max(0, $transitionTime - ($transitionTime / 2));
    
    $css .= "$wrapper .vayu_block_animation_overlay_inside {";
        $css .= "    transition-delay: " . $transitionDelay . "s !important;";
        $css .= "    animation-fill-mode: forwards !important;";
        $css .= "    opacity: 0;";
        $css .= "    transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";
    
    $css .= "$wrapper .$inline:hover .vayu_block_animation_overlay_inside {";
        $css .= "    opacity: 1;";
    $css .= "}";

    $css .= "$wrapper .vayu_block_caption {";
        $css .= "text-align: " . esc_attr($attr['captionalignment']) . ";";
    $css .= "}";

    $css .= "$wrapper .vayu_block_caption_text_para {";
        $css .= "font-size: " . esc_attr($attr['captionsize']) . ";";
        $css .= "font-weight: " . esc_attr($attr['captionfontweight']) . ";";
        $css .= "color: " . esc_attr($attr['captioncolor']) . ";";
    $css .= "}";

    $overlayalignmenttablet = explode(' ', $attr['overlayalignmenttablet']); // Split the string
    $vertical = $overlayalignmenttablet[0]; // First part (vertical)
    $horizontal = $overlayalignmenttablet[1]; // Second part (horizontal)

    if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
        $css .= "@media only screen and (min-width: 1024px) {.wp-block-vayu-blocks-image  {display:none;}}";
    }
    //hide on Tablet
    if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { .wp-block-vayu-blocks-image  {display:none;}}";
    }
    //hide on Mobile
    if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
        $css .= "@media only screen and (max-width: 767px) {.wp-block-vayu-blocks-image  {display:none;}}";
    }


    // for tablet
    $css .= "@media (max-width: 1024px) {

        $wrapper $inline {
            width: " . (isset($attr['imagewidthtablet']) ? esc_attr($attr['imagewidthtablet']) : 'auto') . ";
            height: " . (isset($attr['imageheighttablet']) ? esc_attr($attr['imageheighttablet']) : 'auto') . ";
        }

        $wrapper .vayu_blocks__image_image {
            aspect-ratio: " . ($attr['imageaspectratiotablet'] !== 'none' 
                ? ($attr['imageaspectratiotablet'] === 'original' 
                    ? 'auto' 
                    : str_replace(':', '/', esc_attr($attr['imageaspectratiotablet']))) 
                : 'auto') . ";
        }

        $wrapper .vayu_blocks_overlay_main_wrapper_image  {

            align-items: " . (
                $vertical === 'center' ? 'center' :
                ($vertical === 'top' ? 'self-start' :
                ($vertical === 'bottom' ? 'self-end' : 'center'))
            ) . ";

            justify-content: " . (
                $horizontal === 'center' ? 'center' :
                ($horizontal === 'left' ? 'flex-start' :
                ($horizontal === 'right' ? 'flex-end' : 'center'))
            ) . ";

        }

         .vayu_blocks_image_image-container{
            justify-content: " . (
                $attr['imagealignmenttablet'] === 'center' ? 'center' :
                ($attr['imagealignmenttablet'] === 'left' ? 'flex-start' :
                ($attr['imagealignmenttablet'] === 'right' ? 'flex-end' : 'center'))
            ) . ";
        }
            
        $wrapper .vayu_blocks_overlay_main_wrapper_image{
            width: " . (isset($attr['overlaywidthtablet']) ? esc_attr($attr['overlaywidthtablet']) : 'auto') . ";
            height: " . (isset($attr['overlayheighttablet']) ? esc_attr($attr['overlayheighttablet']) : 'auto') . ";
            left: " . (isset($attr['overlaylefttablet']) ? esc_attr($attr['overlaylefttablet']) : 'auto') . ";
            top: " . (isset($attr['overlaytoptablet']) ? esc_attr($attr['overlaytoptablet']) : 'auto') . ";
        }

        $wrapper .vayu_block_caption {
            text-align:" . (isset($attr['captionalignmentTablet']) ? esc_attr($attr['captionalignmentTablet']) : 'center') . ";
        }

        $wrapper .vayu_block_caption_text_para {
            font-size:" . (isset($attr['captionsizeTablet']) ? esc_attr($attr['captionsizeTablet']) : '') . ";
            font-weight:" . (isset($attr['captionfontweightTablet']) ? esc_attr($attr['captionfontweightTablet']) : '') . ";
        }


    }";

    $overlayalignmentmobile = explode(' ', $attr['overlayalignmentmobile']); // Split the string
    $verticalmobile = $overlayalignmentmobile[0]; // First part (vertical)
    $horizontalmobile = $overlayalignmentmobile[1]; // Second part (horizontal)

   // for mobile
    $css .= "@media (max-width: 500px) {

        $wrapper .vayu_blocks__image_image {
            aspect-ratio: " . ($attr['imageaspectratiomobile'] !== 'none' 
                ? ($attr['imageaspectratiomobile'] === 'original' 
                    ? 'auto' 
                    : str_replace(':', '/', esc_attr($attr['imageaspectratiomobile']))) 
                : 'auto') . ";
        }

        $wrapper .vayu_blocks_overlay_main_wrapper_image  {

            align-items: " . (
                $verticalmobile === 'center' ? 'center' :
                ($verticalmobile === 'top' ? 'self-start' :
                ($verticalmobile === 'bottom' ? 'self-end' : 'center'))
            ) . ";

            justify-content: " . (
                $horizontalmobile === 'center' ? 'center' :
                ($horizontalmobile === 'left' ? 'flex-start' :
                ($horizontalmobile === 'right' ? 'flex-end' : 'center'))
            ) . ";
        }

        .vayu_blocks_image_image-container{

            justify-content: " . (
                $attr['imagealignmentmobile'] === 'center' ? 'center' :
                ($attr['imagealignmentmobile'] === 'left' ? 'flex-start' :
                ($attr['imagealignmentmobile'] === 'right' ? 'flex-end' : 'center'))
            ) . ";
        }

        $wrapper .vayu_blocks_overlay_main_wrapper_image{
            width: " . (isset($attr['overlaywidthmobile']) ? esc_attr($attr['overlaywidthmobile']) : 'auto') . ";
            height: " . (isset($attr['overlayheightmobile']) ? esc_attr($attr['overlayheightmobile']) : 'auto') . ";
            left: " . (isset($attr['overlayleftmobile']) ? esc_attr($attr['overlayleftmobile']) : 'auto') . ";
            top: " . (isset($attr['overlaytopmobile']) ? esc_attr($attr['overlaytopmobile']) : 'auto') . ";
        }

        $wrapper .vayu_block_caption {
            text-align:" . (isset($attr['captionalignmentMobile']) ? esc_attr($attr['captionalignmentMobile']) : 'center') . ";
        }


        $wrapper .vayu_block_caption_text_para {
            font-size:" . (isset($attr['captionsizeMobile']) ? esc_attr($attr['captionsizeMobile']) : '') . ";
            font-weight:" . (isset($attr['captionfontweightMobile']) ? esc_attr($attr['captionfontweightMobile']) : '') . ";
        }
        
            
    }";
    
    return $css;
}         