<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function generate_inline_slider_styles($attr) {
    $css = '';

    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];

    // Generate the class selector by concatenating '.' with the unique ID
    $wrapper = '.wp_block_vayu-blocks-advance-slider-main.vayu-block-' . $uniqueId;
    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    //Main div
    $css .= "$wrapper {";

        $css .= "--swiper-navigation-sizeTablet: " . esc_attr($attr['navigationsizeTablet']) . "px !important;";
        $css .= "--swiper-navigation-sizeMobile: " . esc_attr($attr['navigationsizeMobile']) . "px !important;";
        $css .= "--swiper-navigation-navigationtopTablet: " . esc_attr($attr['navigationtopTablet']) . "% !important;";
        $css .= "--swiper-navigation-navigationtopMobile: " . esc_attr($attr['navigationtopMobile']) . "% !important;";
        $css .= "--swiper-navigation-rightarrowTablet: " . esc_attr($attr['rightarrowTablet']) . "px !important;";
        $css .= "--swiper-navigation-rightarrowMobile: " . esc_attr($attr['rightarrowMobile']) . "px !important;";
        $css .= "--swiper-pagination-bullet-widthTablet: " . esc_attr($attr['bulletsizeTablet']) . "px !important;";
        $css .= "--swiper-pagination-bullet-heightTablet: " . esc_attr($attr['bulletsizeTablet']) . "px !important;";
        $css .= "--swiper-pagination-bullet-widthMobile: " . esc_attr($attr['bulletsizeMobile']) . "px !important;";
        $css .= "--swiper-pagination-bullet-heightMobile: " . esc_attr($attr['bulletsizeMobile']) . "px !important;";
        $css .= "--swiper-pagination-dots-placeTablet: " . esc_attr($attr['dotsplaceTablet']) . "% !important;";
        $css .= "--swiper-pagination-dots-placeMobile: " . esc_attr($attr['dotsplaceMobile']) . "% !important;";    

        $css .= "--swiper-pagination-fraction-color: " . esc_attr($attr['numberscolor']) . " !important;";
        $css .= "--swiper-pagination-color: " . esc_attr($attr['paginationbackground']) . " !important;";
        $css .= "--swiper-pagination-bullet-inactive-color: " . esc_attr($attr['paginationinactivebackground']) . " !important;";
        $css .= "--swiper-pagination-bullet-inactive-opacity: 1 !important;";
        $css .= "--swiper-pagination-top: " . esc_attr($attr['paginationtop']) . "% !important;";
        $css .= "--swiper-pagination-topTablet: " . esc_attr($attr['paginationtopTablet']) . "% !important;";
        $css .= "--swiper-pagination-topMobile: " . esc_attr($attr['paginationtopMobile']) . "% !important;";
        $css .= "--swiper-pagination-bullet-width: " . esc_attr($attr['bulletsize']) . "px !important;";
        $css .= "--swiper-pagination-bullet-height: " . esc_attr($attr['bulletsize']) . "px !important;";
        $css .= "--swiper-navigation-size: " . esc_attr($attr['navigationsize']) . "px !important;";

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

       $css .= "width: 100%;";

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

    //scrollbar
    $css .= ".wp-block-vayu-blocks-advance-slider .swiper-scrollbar-drag {";
        $css .= "height: " . esc_attr($attr['scrollheight']) . "px !important;";
        $css .= "background: " . esc_attr($attr['scroll']) . ";";
    $css .= "}";

    $css .= ".wp-block-vayu-blocks-advance-slider .swiper-scrollbar {";
        $css .= "width: 100% !important;";
        $css .= "background: " . esc_attr($attr['scrollBox']) . ";";
        $css .= "align-content: center !important;"; // This property is not standard for scrollbar
        $css .= "left: 0 !important;"; // Percent not necessary for a scrollbar
        $css .= "top: " . esc_attr($attr['scrolltop']) . "% !important;";
        $css .= "height: " . esc_attr($attr['scrollheight']) . "px !important;";
        $css .= "opacity: 0;";
        $css .= "transition: all 0.5s ease;";
    $css .= "}";

    $css .= ".swiper:hover .swiper-scrollbar {";
        $css .= "opacity: 1 !important;";
    $css .= "}";

    $displayopacity  = 1;

    if ($attr['navigationtype'] === 'hover') {
        $displayopacity = 0;
    }
    
    // Navigation
    $css .= ".swiper-button-next, .swiper-button-prev {";
        $css .= "width:0 !important;";
        $css .= "height:0 !important;";
        $css .= "background: " . esc_attr($attr['navigationbackground']) . " !important;";
        $css .= "color: " . esc_attr($attr['navigationcolor']) . ";";
        $css .= "top: " . esc_attr($attr['navigationtop']) . "% !important;"; // Added space for proper CSS syntax
        $css .= "opacity: $displayopacity;"; // Ensuring displayopacity is escaped correctly

        $css .= $OBJ_STYLE->borderRadiusShadow('arrowborder', 'arrowborderradius', 'Desktop');
        $css .= $OBJ_STYLE->dimensions('arrowpadding', 'Padding',  'Desktop');	

    $css .= "}";
   
    // Tablet Navigation
    $css .= "@media (max-width: 1024px) {";
        $css .= ".swiper-button-next, .swiper-button-prev {";
            $css .= $OBJ_STYLE->borderRadiusShadow('arrowborder', 'arrowborderradius', 'Tablet');
            $css .= $OBJ_STYLE->dimensions('arrowpadding', 'Padding',  'Tablet');	
            $css .= "top: " . esc_attr($attr['navigationtopTablet']) . "% !important;";
        $css .= "}";

        $css .= ".swiper-button-next:after, .swiper-button-prev:after {";
            $css .= "font-size: " . esc_attr($attr['navigationsizeTablet']) . "px !important;";
        $css .= "}";

        $css .= ".swiper-button-next {";
            $css .= "right: " . esc_attr($attr['rightarrowTablet']) . "px !important;"; // Fixed interpolating arrow size
        $css .= "}";
    
        $css .= ".swiper-button-prev {";
            $css .= "left: " . esc_attr($attr['rightarrowTablet']) . "px !important;"; // Fixed interpolating arrow size
        $css .= "}";

            // Pagination
        $css .= ".swiper-pagination-bullets-dynamic {";
            $css .= "font-size: " . esc_attr($attr['bulletsizeTablet']) . "px !important;"; // Fixed interpolation
        $css .= "}";

        $css .= ".swiper-pagination-fraction {";
            $css .= "font-size: " . esc_attr($attr['bulletsizeTablet']) . "px !important;"; // Fixed interpolation
        $css .= "}";

        $css .= ".swiper-pagination {";
            $css .= "left: " . esc_attr($attr['dotsplaceTablet']) . "% !important;"; // Fixed interpolation and added percenarrowe
        $css .= "}";

    $css .= "}";

    // Mobile Navigation
    $css .= "@media (max-width: 768px) {";
        $css .= ".swiper-button-next, .swiper-button-prev {";
            $css .= $OBJ_STYLE->borderRadiusShadow('arrowborder', 'arrowborderradius', 'Mobile');
            $css .= $OBJ_STYLE->dimensions('arrowpadding', 'Padding',  'Mobile');	
            $css .= "top: " . esc_attr($attr['navigationtopMobile']) . "% !important;";
        $css .= "}";

        $css .= ".swiper-button-next:after, .swiper-button-prev:after {";
            $css .= "font-size: " . esc_attr($attr['navigationsizeMobile']) . "px !important;";
        $css .= "}";

        $css .= ".swiper-button-next {";
            $css .= "right: " . esc_attr($attr['rightarrowMobile']) . "px !important;"; // Fixed interpolating arrow size
        $css .= "}";

        $css .= ".swiper-button-prev {";
            $css .= "left: " . esc_attr($attr['rightarrowMobile']) . "px !important;"; // Fixed interpolating arrow size
        $css .= "}";

        // Pagination
        $css .= ".swiper-pagination-bullets-dynamic {";
            $css .= "font-size: " . esc_attr($attr['bulletsizeMobile']) . "px !important;"; // Fixed interpolation
        $css .= "}";

        $css .= ".swiper-pagination-fraction {";
            $css .= "font-size: " . esc_attr($attr['bulletsizeMobile']) . "px !important;"; // Fixed interpolation
        $css .= "}";

        $css .= ".swiper-pagination {";
            $css .= "left: " . esc_attr($attr['dotsplaceMobile']) . "% !important;"; // Fixed interpolation and added percenarrowe
        $css .= "}";

    $css .= "}";

    $css .= ".swiper-button-next:after, .swiper-button-prev:after {";
        $css .= "font-size: " . esc_attr($attr['navigationsize']) . "px !important;";
    $css .= "}";
    
    $css .= ".swiper-button-next {";
        $css .= "right: " . esc_attr($attr['rightarrow']) . "px !important;"; // Fixed interpolating arrow size
        $css .= "transition: all 0.5s ease;";
    $css .= "}";
    
    $css .= ".swiper-button-prev {";
        $css .= "left: " . esc_attr($attr['rightarrow']) . "px !important;"; // Fixed interpolating arrow size
        $css .= "transition: all 0.5s ease;";
    $css .= "}";
    
    $css .= ".swiper-wrapper {";
        $css .= "align-items: center;";
    $css .= "}";
    
    $css .= ".swiper:hover .swiper-button-next {";
        $css .= "opacity: 1 !important;";
    $css .= "}";
    
    $css .= ".swiper:hover .swiper-button-prev {";
        $css .= "opacity: 1 !important;";
    $css .= "}";

    // Pagination
    $css .= ".swiper-pagination-bullets-dynamic {";
        $css .= "font-size: " . esc_attr($attr['bulletsize']) . "px !important;"; // Fixed interpolation
    $css .= "}";

    $css .= ".swiper-pagination {"; // Fixed interpolation and added percenarrowe
        $css .= "width: 100% !important;";
        $css .= "height: 70px !important;";
        $css .= "left: 50% !important;";
        $css .= "transform: translate(-50%);";
        $css .= "left: " . esc_attr($attr['dotsplace']) . "% !important;";
    $css .= "}";

    $displaypaginationprogressopacity = 1;
    if ($attr['progresshover']) {
        $displaypaginationprogressopacity = 0;
    }

    $css .= ".swiper-pagination-progressbar {";
        $css .= "width: 100% !important;";
        $css .= "left: 50% !important;";
        $css .= "opacity: " . esc_attr($displaypaginationprogressopacity) . " !important;"; // Fixed interpolation
        $css .= "transition: all 0.5s ease;";
    $css .= "}";

    $css .= ".swiper-pagination-progressbar-fill {";
        $css .= "background: " . esc_attr($attr['progresscolor']) . " !important;"; // Fixed interpolation
    $css .= "}";

    $css .= ".swiper:hover .swiper-pagination-progressbar {";
        $css .= "opacity: 1 !important;";
    $css .= "}";

    $css .= ".swiper-pagination-fraction {";
        $css .= "font-size: " . esc_attr($attr['bulletsize']) . "px !important;"; // Fixed interpolation
    $css .= "}";

    if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
        $css .= "@media only screen and (min-width: 1024px) {.wp-block-vayu-blocks-advance-slider  {display:none;}}";
    }
    //hide on Tablet
    if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { .wp-block-vayu-blocks-advance-slider  {display:none;}}";
    }
    //hide on Mobile
    if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
        $css .= "@media only screen and (max-width: 767px) {.wp-block-vayu-blocks-advance-slider  {display:none;}}";
    }


    return $css;
}
