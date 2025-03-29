<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function generate_inline_flip_box_styles($attr) {

    $css = '';

    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];
    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    // Check if the 'innerBlockUniqueIds' attribute is set and has the required index
    if (!empty($attr['innerBlockUniqueIds']) && isset($attr['innerBlockUniqueIds'][1])) {
        $uniqueIdback = $attr['innerBlockUniqueIds'][1];
    } else {
        $uniqueIdback = 'default-value'; // Fallback value if index is missing
    }

    // Check if the 'innerBlockUniqueIds' attribute is set and has the required index
    if (!empty($attr['innerBlockUniqueIds']) && isset($attr['innerBlockUniqueIds'][0])) {
        $uniqueIdfront = $attr['innerBlockUniqueIds'][0];
    } else {
        $uniqueIdfront = 'default-value'; // Fallback value if index is missing
    }

    // Generate the class selector by concatenating '.' with the unique ID
    $wrapper = '.vayu-blocks-image-flip-main-container-for-front' . esc_attr($uniqueId);
    
    //Main div
    $css .= "$wrapper {";

        $css .= "perspective: 1000px;";

        $css .= "width:100%;";
        $css .= "height: " . esc_attr($attr['customHeight']) . esc_attr($attr['customHeightUnit']) . ";";

        $css .= "max-width:100%;";

        $css .= "box-sizing: border-box;";
        
        $css .= "margin-left:auto !important;";
        $css .= "margin-right:auto !important;";
        
       
        $css .= $OBJ_STYLE->dimensions('buttonpadding','padding','Desktop');	
        $css .= $OBJ_STYLE->dimensions('buttonmargin','margin','Desktop');
        $css .= $OBJ_STYLE->borderRadiusShadow('advanceborder', 'advanceborderradius','advancedropshadow', 'Desktop');

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
            $css .= $OBJ_STYLE ->dimensions('buttonpadding','padding',  'Tablet');	
            $css .= $OBJ_STYLE ->dimensions('buttonmargin', 'margin', 'Tablet');
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
            $css .= $OBJ_STYLE ->dimensions('buttonpadding','padding',  'Mobile');	
            $css .= $OBJ_STYLE ->dimensions('buttonmargin','margin',  'Mobile');
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

   $css .= "$wrapper .vayu_blocks_image_flip_wrapper-for-front{";

        if ($attr['imageborderradiuscircle'] === 'circle') {
            // Apply a border-radius of 50% for circular images
            $css .= "border-radius: 50%;";
        } else {
            // Apply individual border-radius values if not a circle
            if (isset($attr['imageborderRadius']['top'], $attr['imageborderRadius']['right'], $attr['imageborderRadius']['bottom'], $attr['imageborderRadius']['left'])) {
                $css .= "border-radius: " . esc_attr($attr['imageborderRadius']['top']) . " " . esc_attr($attr['imageborderRadius']['right']) . " " . esc_attr($attr['imageborderRadius']['bottom']) . " " . esc_attr($attr['imageborderRadius']['left']) . ";";
            }
        }

        $css .= "height: 100%;";

         // Top border
         if (isset($attr['imageborder']['topwidth'], $attr['imageborder']['topstyle'], $attr['imageborder']['topcolor'])) {
            $css .= "border-top: " . esc_attr($attr['imageborder']['topwidth']) . " " . esc_attr($attr['imageborder']['topstyle']) . " " . esc_attr($attr['imageborder']['topcolor']) . ";";
        }

        // Bottom border
        if (isset($attr['imageborder']['bottomwidth'], $attr['imageborder']['bottomstyle'], $attr['imageborder']['bottomcolor'])) {
            $css .= "border-bottom: " . esc_attr($attr['imageborder']['bottomwidth']) . " " . esc_attr($attr['imageborder']['bottomstyle']) . " " . esc_attr($attr['imageborder']['bottomcolor']) . ";";
        }

        // Left border
        if (isset($attr['imageborder']['leftwidth'], $attr['imageborder']['leftstyle'], $attr['imageborder']['leftcolor'])) {
            $css .= "border-left: " . esc_attr($attr['imageborder']['leftwidth']) . " " . esc_attr($attr['imageborder']['leftstyle']) . " " . esc_attr($attr['imageborder']['leftcolor']) . ";";
        }

        // Right border
        if (isset($attr['imageborder']['rightwidth'], $attr['imageborder']['rightstyle'], $attr['imageborder']['rightcolor'])) {
            $css .= "border-right: " . esc_attr($attr['imageborder']['rightwidth']) . " " . esc_attr($attr['imageborder']['rightstyle']) . " " . esc_attr($attr['imageborder']['rightcolor']) . ";";
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


    $transformstyle = 'none';
    // Determine the transform style based on the image hover effect

    if($attr['imagehvreffect'] === 'flip'){
        if ($attr['flipside'] === 'right') {
            $transformstyle = 'rotateY(180deg)';
        } elseif ($attr['flipside'] === 'left') {
            $transformstyle = 'rotateY(-180deg)';
        } elseif ($attr['flipside'] === 'top') {
            $transformstyle = 'rotateX(180deg)';
        } elseif ($attr['flipside'] === 'bottom') {
            $transformstyle = 'rotateX(-180deg)';
        } 
    }elseif ($attr['imagehvreffect'] === 'flip-z') {
        $transformstyle = 'rotateX(180deg) rotateZ(90deg)';
    } elseif ($attr['imagehvreffect'] === 'flip-x') {
        $transformstyle = 'rotateY(180deg) rotateZ(90deg)';
    } elseif ($attr['imagehvreffect'] === 'zoom-in') {
        $transformstyle = 'scale(0.5)';
    } else if($attr['imagehvreffect'] === 'slide'){
        if ($attr['flipside'] === 'right') {
            $transformstyle = 'translateX(105%)';
        } elseif ($attr['flipside'] === 'left') {
            $transformstyle = 'translateX(-105%)';
        } elseif ($attr['flipside'] === 'top') {
            $transformstyle = 'translateY(-105%)';
        } elseif ($attr['flipside'] === 'bottom') {
            $transformstyle = 'translateY(105%)';
        } 
    } else if($attr['imagehvreffect'] === 'push'){
        if ($attr['flipside'] === 'right') {
            $transformstyle = 'translateX(90%)';
        } elseif ($attr['flipside'] === 'left') {
            $transformstyle = 'translateX(-90%)';
        } elseif ($attr['flipside'] === 'top') {
            $transformstyle = 'translateY(90%)';
        } elseif ($attr['flipside'] === 'bottom') {
            $transformstyle = 'translateY(-90%)';
        } 
    }

    if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
        $css .= "@media only screen and (min-width: 1024px) {.wp-block-vayu-blocks-flip-box  {display:none;}}";
    }
    //hide on Tablet
    if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { .wp-block-vayu-blocks-flip-box  {display:none;}}";
    }
    //hide on Mobile
    if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
        $css .= "@media only screen and (max-width: 767px) {.wp-block-vayu-blocks-flip-box  {display:none;}}";
    }
    
    $css .= "$wrapper .vayu_blocks_flip-box-back {";
        $css .= "transform: $transformstyle;"; // Ensure $transformstyle is valid
    $css .= "}";

    $css .=".vayu-blocks-front_image-main-container-for-front$uniqueIdback{";
        $css .= "transform: unset !important;";
    $css .= "}";

    $css .=".vayu-blocks-front_image-main-container-for-front$uniqueIdback .wp-block-vayu-blocks-flip-wrapper{";
        $css .= "transform: unset !important;";
    $css .= "}";

     $css .=".vayu_blocks_image_flip_wrapper-for-front:hover .vayu_blocks_flip-box-inner_animation_div_push_animation-top ..vayu_blocks_front_image_wrapper-for-front .vayu_blocks_flip-box-front{";
         $css .= "transform: unset !important;";
    $css .= "}";

    $css .=".vayu-blocks-front_image-main-container-for-front$uniqueIdfront{";
        $css .= "transform: unset !important;";
    $css .= "}";

   $overlayalignmenttablet = explode(' ', $attr['overlayalignmenttablet']); // Split the string
   $vertical = $overlayalignmenttablet[0]; // First part (vertical)
   $horizontal = $overlayalignmenttablet[1]; // Second part (horizontal)
   
    //for tablet
    $css .= "@media (max-width: 1024px) {


        $wrapper .vayu_blocks_image_flip_wrapper-for-front{
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
        
    }";
    
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
    
    $overlayalignmentmobile = explode(' ', $attr['overlayalignmentmobile']); // Split the string
    $verticalmobile = $overlayalignmentmobile[0]; // First part (vertical)
    $horizontalmobile = $overlayalignmentmobile[1]; // Second part (horizontal)

    //for mobile
    $css .= "@media (max-width: 400px) {

        $wrapper .vayu_blocks_image_flip_wrapper-for-front{
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

    }";

    return $css;
}
