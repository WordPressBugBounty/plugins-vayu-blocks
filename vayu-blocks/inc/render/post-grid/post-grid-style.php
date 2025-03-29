<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function generate_inline_styles($attr) {
    $css = '';
    // Generate unique ID
    // Ensure 'pg_posts' key exists and is an array
    if (isset($attr['pg_posts']) && is_array($attr['pg_posts']) 
        && isset($attr['pg_posts'][0]) 
        && isset($attr['pg_posts'][0]['uniqueID'])) {
        
        $uniqueId = $attr['pg_posts'][0]['uniqueID'];
    } else {
        // Handle the case where 'uniqueID' is not available
        $uniqueId = 'default_value'; // Set a default value or handle as needed
    }
    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  

    $wrapper = ".th-post-grid-wrapper-{$uniqueId}";
    $post = ".th-post-grid-inline-{$uniqueId}";
    
    // $css .= ".th-post-grid-main-wp-editor-wrapper {";
    //     // Check if 'widthType' attribute is set to 'customwidth' and apply the width accordingly
    //     $css .= "width: " . esc_attr($attr['customWidth']) . esc_attr($attr['customWidthUnit']) . ";";
        
    // $css .= "}";
    
    //  // Add media query for tablet screens
    //  $css .= "@media (max-width: 768px) {";
    //     $css .= ".th-post-grid-main-wp-editor-wrapper {";
    //         $css .= "width: " . esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) . ";";
    //     $css .= "}";
    // $css .= "}";

    // Add media query for Mobile screens
    // $css .= "@media (max-width: 300px) {";
    //     $css .= ".th-post-grid-main-wp-editor-wrapper {";
    //         $css .= "width: " . esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) . ";";
    //     $css .= "}";
    // $css .= "}";

    //Main div
    $css .= "$wrapper {";

        // Desktop Padding
        $paddingUnit = isset($attr['paddingUnit']) ? esc_attr($attr['paddingUnit']) : 'px';
        $css .= isset($attr['buttonpaddingTop']) ? "padding-top: " . esc_attr($attr['buttonpaddingTop']) . $paddingUnit . ";" : '';
        $css .= isset($attr['buttonpaddingBottom']) ? "padding-bottom: " . esc_attr($attr['buttonpaddingBottom']) . $paddingUnit . ";" : '';
        $css .= isset($attr['buttonpaddingLeft']) ? "padding-left: " . esc_attr($attr['buttonpaddingLeft']) . $paddingUnit . ";" : '';
        $css .= isset($attr['buttonpaddingRight']) ? "padding-right: " . esc_attr($attr['buttonpaddingRight']) . $paddingUnit . ";" : '';

        // Desktop Padding
        $marginUnit = isset($attr['marginUnit']) ? esc_attr($attr['marginUnit']) : 'px';
        $css .= isset($attr['marginTop']) ? "margin-top: " . esc_attr($attr['marginTop']) . $marginUnit . ";" : '';
        $css .= isset($attr['marginBottom']) ? "margin-bottom: " . esc_attr($attr['marginBottom']) . $marginUnit . ";" : '';
        $css .= isset($attr['marginLeft']) ? "margin-left: " . esc_attr($attr['marginLeft']) . $marginUnit . ";" : '';
        $css .= isset($attr['marginRight']) ? "margin-right: " . esc_attr($attr['marginRight']) . $marginUnit . ";" : '';

        // Position and Z-index
        $css .= isset($attr['position']) ? "position: " . esc_attr($attr['position']) . ";" : '';
        $css .= isset($attr['zIndex']) ? "z-index: " . esc_attr($attr['zIndex']) . ";" : '';

        // Alignment and Order
        $css .= isset($attr['selfAlign']) ? "align-self: " . esc_attr($attr['selfAlign']) . ";" : '';
        $css .= isset($attr['order']) && $attr['order'] === 'custom' && isset($attr['customOrder']) ? "order: " . esc_attr($attr['customOrder']) . ";" : '';

       // Top border
       if (isset($attr['advanceborder']['topwidth'], $attr['advanceborder']['topstyle'], $attr['advanceborder']['topcolor'])) {
        $css .= "border-top: " . esc_attr($attr['advanceborder']['topwidth']) . " " . esc_attr($attr['advanceborder']['topstyle']) . " " . esc_attr($attr['advanceborder']['topcolor']) . ";";
        }

        // Bottom border
        if (isset($attr['advanceborder']['bottomwidth'], $attr['advanceborder']['bottomstyle'], $attr['advanceborder']['bottomcolor'])) {
            $css .= "border-bottom: " . esc_attr($attr['advanceborder']['bottomwidth']) . " " . esc_attr($attr['advanceborder']['bottomstyle']) . " " . esc_attr($attr['advanceborder']['bottomcolor']) . ";";
        }

        // Left border
        if (isset($attr['advanceborder']['leftwidth'], $attr['advanceborder']['leftstyle'], $attr['advanceborder']['leftcolor'])) {
            $css .= "border-left: " . esc_attr($attr['advanceborder']['leftwidth']) . " " . esc_attr($attr['advanceborder']['leftstyle']) . " " . esc_attr($attr['advanceborder']['leftcolor']) . ";";
        }

        // Right border
        if (isset($attr['advanceborder']['rightwidth'], $attr['advanceborder']['rightstyle'], $attr['advanceborder']['rightcolor'])) {
            $css .= "border-right: " . esc_attr($attr['advanceborder']['rightwidth']) . " " . esc_attr($attr['advanceborder']['rightstyle']) . " " . esc_attr($attr['advanceborder']['rightcolor']) . ";";
        }

        // Apply individual border-radius values if not a circle
        if (isset($attr['advanceRadius']['top'], $attr['advanceRadius']['right'], $attr['advanceRadius']['bottom'], $attr['advanceRadius']['left'])) {
            $css .= "border-radius: " . esc_attr($attr['advanceRadius']['top']) . " " . esc_attr($attr['advanceRadius']['right']) . " " . esc_attr($attr['advanceRadius']['bottom']) . " " . esc_attr($attr['advanceRadius']['left']) . ";";
        }
       
        // Box-shadow
        if (isset($attr['boxShadow']) && $attr['boxShadow']) {
            $boxShadowColor = 'rgba(' . implode(', ', [
                hexdec(substr($attr['boxShadowColor'], 1, 2)), // Red
                hexdec(substr($attr['boxShadowColor'], 3, 2)), // Green
                hexdec(substr($attr['boxShadowColor'], 5, 2))  // Blue
            ]) . ', ' . ((float) $attr['boxShadowColorOpacity'] / 100) . ')';
            $css .= "box-shadow: " . esc_attr($attr['boxShadowHorizontal']) . 'px ' .
                                esc_attr($attr['boxShadowVertical']) . 'px ' .
                                esc_attr($attr['boxShadowBlur']) . 'px ' .
                                esc_attr($attr['boxShadowSpread']) . 'px ' .
                                $boxShadowColor . ";";
        } else {
            $css .= "box-shadow: none;";
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
        $css .= isset($attr['backgroundPosition']) ? "background-position: " . esc_attr($attr['backgroundPosition']['x']) . ',' . esc_attr($attr['backgroundPosition']['y']) . ";" : 'background-position: 50%, 50%;';
        $css .= isset($attr['backgroundAttachment']) ? "background-attachment: " . esc_attr($attr['backgroundAttachment']) . ";" : '';
        $css .= isset($attr['backgroundRepeat']) ? "background-repeat: " . esc_attr($attr['backgroundRepeat']) . ";" : '';
        $css .= isset($attr['backgroundSize']) ? "background-size: " . esc_attr($attr['backgroundSize']) . ";" : '';

        // Transition
        $css .= "transition-duration: " . (isset($attr['transitionAll']) ? esc_attr($attr['transitionAll']) : '0') . "s;";
        
        // Grid properties
        $css .= "display: grid;";
        $gridTemplateColumns = isset($attr['pg_postLayoutColumns']) ? esc_attr($attr['pg_postLayoutColumns']) : 'auto-fit';
        $css .= "grid-template-columns: repeat({$gridTemplateColumns}, 1fr);";
        $gridGapUp = isset($attr['pg_gapup']) ? esc_attr($attr['pg_gapup']) . "px" : '16px'; // Default value '16px' or whatever default you prefer
        $gridGap = isset($attr['pg_gap']) ? esc_attr($attr['pg_gap']) . "px" : '16px'; // Default value '16px' or whatever default you prefer
        $css .= "grid-gap: {$gridGapUp} {$gridGap};";
        $css .= "grid-auto-rows: minmax(100px, auto);";
        
    $css .= "}";

    //Post
    $css .= "$wrapper $post {";
        // $css .= " display: flex;
        // flex-direction: column;
        // justify-content: space-between;";
        // Line height
        $css .= "box-sizing: border-box;";
        $widthUnit = isset($attr['layoutcustomWidthUnit']) ? esc_attr($attr['layoutcustomWidthUnit']) : '%';

        $css .= isset($attr['layoutcustomWidth']) ? "width: " . esc_attr($attr['layoutcustomWidth']) . $widthUnit . ";" : '';


        $css .= isset($attr['pg_spacing']) ? "line-height: " . esc_attr($attr['pg_spacing']) . ";" : '';

        // Desktop Padding
        $paddingUnit = isset($attr['pg_layoutpaddingUnit']) ? esc_attr($attr['pg_layoutpaddingUnit']) : 'px';
        $css .= isset($attr['pg_layoutpaddingTop']) ? "padding-top: " . esc_attr($attr['pg_layoutpaddingTop']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_layoutpaddingBottom']) ? "padding-bottom: " . esc_attr($attr['pg_layoutpaddingBottom']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_layoutpaddingLeft']) ? "padding-left: " . esc_attr($attr['pg_layoutpaddingLeft']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_layoutpaddingRight']) ? "padding-right: " . esc_attr($attr['pg_layoutpaddingRight']) . $paddingUnit . ";" : '';
 
        if (isset($attr['layout_backgroundType'])) {
            if ($attr['layout_backgroundType'] === 'color' && isset($attr['layout_backgroundColor'])) {
                $css .= "background: " . esc_attr($attr['layout_backgroundColor']) . ";";
            } elseif ($attr['layout_backgroundType'] === 'gradient') {
                $css .= "background: " . (isset($attr['layout_backgroundGradient']) ? esc_attr($attr['layout_backgroundGradient']) : 'linear-gradient(135deg,#12c2e9 0%,#c471ed 50%,#f64f59 100%)') . ";";
            } elseif ($attr['layout_backgroundType'] === 'image'){
                $css .= "background: url(" . esc_url($attr['layout_backgroundImage']['url']) . ");";

            }
        } elseif (isset($attr['layout_backgroundColor'])) {
            $css .= "background: " . esc_attr($attr['layout_backgroundColor']) . ";";
        } else {
            $css .= "background: none;";
        }
        
        // Font size
        $css .= isset($attr['pg_textSize']) ? "font-size: " . esc_attr($attr['pg_textSize']) . "px;" : '';     
        
        // Text color
        $css .= isset($attr['pg_textColor']) ? "color: " . esc_attr($attr['pg_textColor']) . ";" : '';
        
        // Position
        $css .= "position: relative;";
        
        // Background attachment, repeat, size
        $css .= isset($attr['layout_backgroundAttachment']) ? "background-attachment: " . esc_attr($attr['layout_backgroundAttachment']) . ";" : '';
        $css .= isset($attr['layout_backgroundRepeat']) ? "background-repeat: " . esc_attr($attr['layout_backgroundRepeat']) . ";" : '';
        $css .= isset($attr['layout_backgroundSize']) ? "background-size: " . esc_attr($attr['layout_backgroundSize']) . ";" : '';
        
        
        // Border radius for layout
        if (isset($attr['layoutradius'])) {
            $css .= "border-top-left-radius: " . esc_attr($attr['layoutradius']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['layoutradius']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['layoutradius']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['layoutradius']['left']) . ";";
        }

        if (isset($attr['layoutradiusTablet'])) {
            $css .= "@media (max-width: 768px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['layoutradiusTablet']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['layoutradiusTablet']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['layoutradiusTablet']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['layoutradiusTablet']['left']) . ";";
            $css .= "}";
        }

        if (isset($attr['layoutradiusMobile'])) {
            $css .= "@media (max-width: 480px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['layoutradiusMobile']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['layoutradiusMobile']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['layoutradiusMobile']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['layoutradiusMobile']['left']) . ";";
            $css .= "}";
        }

        // Border for Desktop
        $css .= isset($attr['layoutTopborderType']) && isset($attr['layoutTopBorder']) && isset($attr['layoutTopBorderColor']) ? 
            "border-top: " . esc_attr($attr['layoutTopborderType']) . ' ' . esc_attr($attr['layoutTopBorder']) . " " . esc_attr($attr['layoutTopBorderColor']) . ";" : '';
        $css .= isset($attr['layoutBottomborderType']) && isset($attr['layoutBottomBorder']) && isset($attr['layoutBottomBorderColor']) ? 
            "border-bottom: " . esc_attr($attr['layoutBottomborderType']) . ' ' . esc_attr($attr['layoutBottomBorder']) . " " . esc_attr($attr['layoutBottomBorderColor']) . ";" : '';
        $css .= isset($attr['layoutLeftborderType']) && isset($attr['layoutLeftBorder']) && isset($attr['layoutLeftBorderColor']) ? 
            "border-left: " . esc_attr($attr['layoutLeftborderType']) . ' ' . esc_attr($attr['layoutLeftBorder']) . " " . esc_attr($attr['layoutLeftBorderColor']) . ";" : '';
        $css .= isset($attr['layoutRightborderType']) && isset($attr['layoutRightBorder']) && isset($attr['layoutRightBorderColor']) ? 
            "border-right: " . esc_attr($attr['layoutRightborderType']) . ' ' . esc_attr($attr['layoutRightBorder']) . " " . esc_attr($attr['layoutRightBorderColor']) . ";" : '';

        // Media Query for Tablet
        $css .= "@media (max-width: 768px) {";
        $css .= isset($attr['layoutTopborderTypeTablet']) && isset($attr['layoutTopBorderTablet']) && isset($attr['layoutTopBorderColorTablet']) ? 
            "border-top: " . esc_attr($attr['layoutTopborderTypeTablet']) . ' ' . esc_attr($attr['layoutTopBorderTablet']) . " " . esc_attr($attr['layoutTopBorderColorTablet']) . ";" : '';
        $css .= isset($attr['layoutBottomborderTypeTablet']) && isset($attr['layoutBottomBorderTablet']) && isset($attr['layoutBottomBorderColorTablet']) ? 
            "border-bottom: " . esc_attr($attr['layoutBottomborderTypeTablet']) . ' ' . esc_attr($attr['layoutBottomBorderTablet']) . " " . esc_attr($attr['layoutBottomBorderColorTablet']) . ";" : '';
        $css .= isset($attr['layoutLeftborderTypeTablet']) && isset($attr['layoutLeftBorderTablet']) && isset($attr['layoutLeftBorderColorTablet']) ? 
            "border-left: " . esc_attr($attr['layoutLeftborderTypeTablet']) . ' ' . esc_attr($attr['layoutLeftBorderTablet']) . " " . esc_attr($attr['layoutLeftBorderColorTablet']) . ";" : '';
        $css .= isset($attr['layoutRightborderTypeTablet']) && isset($attr['layoutRightBorderTablet']) && isset($attr['layoutRightBorderColorTablet']) ? 
            "border-right: " . esc_attr($attr['layoutRightborderTypeTablet']) . ' ' . esc_attr($attr['layoutRightBorderTablet']) . " " . esc_attr($attr['layoutRightBorderColorTablet']) . ";" : '';
        $css .= "}";

        // Media Query for Mobile
        $css .= "@media (max-width: 480px) {";
        $css .= isset($attr['layoutTopborderTypeMobile']) && isset($attr['layoutTopBorderMobile']) && isset($attr['layoutTopBorderColorMobile']) ? 
            "border-top: " . esc_attr($attr['layoutTopborderTypeMobile']) . ' ' . esc_attr($attr['layoutTopBorderMobile']) . " " . esc_attr($attr['layoutTopBorderColorMobile']) . ";" : '';
        $css .= isset($attr['layoutBottomborderTypeMobile']) && isset($attr['layoutBottomBorderMobile']) && isset($attr['layoutBottomBorderColorMobile']) ? 
            "border-bottom: " . esc_attr($attr['layoutBottomborderTypeMobile']) . ' ' . esc_attr($attr['layoutBottomBorderMobile']) . " " . esc_attr($attr['layoutBottomBorderColorMobile']) . ";" : '';
        $css .= isset($attr['layoutLeftborderTypeMobile']) && isset($attr['layoutLeftBorderMobile']) && isset($attr['layoutLeftBorderColorMobile']) ? 
            "border-left: " . esc_attr($attr['layoutLeftborderTypeMobile']) . ' ' . esc_attr($attr['layoutLeftBorderMobile']) . " " . esc_attr($attr['layoutLeftBorderColorMobile']) . ";" : '';
        $css .= isset($attr['layoutRightborderTypeMobile']) && isset($attr['layoutRightBorderMobile']) && isset($attr['layoutRightBorderColorMobile']) ? 
            "border-right: " . esc_attr($attr['layoutRightborderTypeMobile']) . ' ' . esc_attr($attr['layoutRightBorderMobile']) . " " . esc_attr($attr['layoutRightBorderColorMobile']) . ";" : '';
        $css .= "}";


    $css .= "}";

    //Category
    $css .= "$wrapper $post .post-grid-category-style-new{";
        // Cursor
        $css .= "cursor: pointer;";

        // Padding
        $paddingUnit = isset($attr['categorypaddingUnit']) ? esc_attr($attr['categorypaddingUnit']) : 'px';
        $css .= isset($attr['pg_CategorypaddingTop']) ? "padding-top: " . esc_attr($attr['pg_CategorypaddingTop']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_CategorypaddingBottom']) ? "padding-bottom: " . esc_attr($attr['pg_CategorypaddingBottom']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_CategorypaddingLeft']) ? "padding-left: " . esc_attr($attr['pg_CategorypaddingLeft']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_CategorypaddingRight']) ? "padding-right: " . esc_attr($attr['pg_CategorypaddingRight']) . $paddingUnit . ";" : '';

        $css .= "text-decoration: none;";
        $css .= "margin-left: 5px;";
        $css .= "font-weight: 600;";
        $css .= isset($attr['pg_spacing']) ? "margin-block-start: " . esc_attr($attr['pg_spacing']) . "%;" : '';
        $css .= "line-height: initial;";

        // Text color
        $css .= isset($attr['pg_categoryTextColor']) ? "color: " . esc_attr($attr['pg_categoryTextColor']) . ";" : '';

        // Background
        $css .= isset($attr['category_backgroundColor']) ? "background: " . esc_attr($attr['category_backgroundColor']) . ";" : '';

        // Font size
        $css .= isset($attr['pg_categoryTextSize']) ? "font-size: " . esc_attr($attr['pg_categoryTextSize']) . "px;" : '';

          // Border radius for category
          if (isset($attr['categoryradius'])) {
            $css .= "border-top-left-radius: " . esc_attr($attr['categoryradius']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['categoryradius']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['categoryradius']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['categoryradius']['left']) . ";";
        }

        if (isset($attr['categoryradiusTablet'])) {
            $css .= "@media (max-width: 768px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['categoryradiusTablet']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['categoryradiusTablet']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['categoryradiusTablet']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['categoryradiusTablet']['left']) . ";";
            $css .= "}";
        }

        if (isset($attr['categoryradiusMobile'])) {
            $css .= "@media (max-width: 480px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['categoryradiusMobile']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['categoryradiusMobile']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['categoryradiusMobile']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['categoryradiusMobile']['left']) . ";";
            $css .= "}";
        }

        // Border for Desktop
        $css .= isset($attr['categoryTopborderType']) && isset($attr['categoryTopBorder']) && isset($attr['categoryTopBorderColor']) ? 
            "border-top: " . esc_attr($attr['categoryTopborderType']) . ' ' . esc_attr($attr['categoryTopBorder']) . " " . esc_attr($attr['categoryTopBorderColor']) . ";" : '';
        $css .= isset($attr['categoryBottomborderType']) && isset($attr['categoryBottomBorder']) && isset($attr['categoryBottomBorderColor']) ? 
            "border-bottom: " . esc_attr($attr['categoryBottomborderType']) . ' ' . esc_attr($attr['categoryBottomBorder']) . " " . esc_attr($attr['categoryBottomBorderColor']) . ";" : '';
        $css .= isset($attr['categoryLeftborderType']) && isset($attr['categoryLeftBorder']) && isset($attr['categoryLeftBorderColor']) ? 
            "border-left: " . esc_attr($attr['categoryLeftborderType']) . ' ' . esc_attr($attr['categoryLeftBorder']) . " " . esc_attr($attr['categoryLeftBorderColor']) . ";" : '';
        $css .= isset($attr['categoryRightborderType']) && isset($attr['categoryRightBorder']) && isset($attr['categoryRightBorderColor']) ? 
            "border-right: " . esc_attr($attr['categoryRightborderType']) . ' ' . esc_attr($attr['categoryRightBorder']) . " " . esc_attr($attr['categoryRightBorderColor']) . ";" : '';

        // Media Query for Tablet
        $css .= "@media (max-width: 768px) {";
            $css .= isset($attr['categoryTopborderTypeTablet']) && isset($attr['categoryTopBorderTablet']) && isset($attr['categoryTopBorderColorTablet']) ? 
                "border-top: " . esc_attr($attr['categoryTopborderTypeTablet']) . ' ' . esc_attr($attr['categoryTopBorderTablet']) . " " . esc_attr($attr['categoryTopBorderColorTablet']) . ";" : '';
            $css .= isset($attr['categoryBottomborderTypeTablet']) && isset($attr['categoryBottomBorderTablet']) && isset($attr['categoryBottomBorderColorTablet']) ? 
                "border-bottom: " . esc_attr($attr['categoryBottomborderTypeTablet']) . ' ' . esc_attr($attr['categoryBottomBorderTablet']) . " " . esc_attr($attr['categoryBottomBorderColorTablet']) . ";" : '';
            $css .= isset($attr['categoryLeftborderTypeTablet']) && isset($attr['categoryLeftBorderTablet']) && isset($attr['categoryLeftBorderColorTablet']) ? 
                "border-left: " . esc_attr($attr['categoryLeftborderTypeTablet']) . ' ' . esc_attr($attr['categoryLeftBorderTablet']) . " " . esc_attr($attr['categoryLeftBorderColorTablet']) . ";" : '';
            $css .= isset($attr['categoryRightborderTypeTablet']) && isset($attr['categoryRightBorderTablet']) && isset($attr['categoryRightBorderColorTablet']) ? 
                "border-right: " . esc_attr($attr['categoryRightborderTypeTablet']) . ' ' . esc_attr($attr['categoryRightBorderTablet']) . " " . esc_attr($attr['categoryRightBorderColorTablet']) . ";" : '';
        $css .= "}";

        // Media Query for Mobile
        $css .= "@media (max-width: 480px) {";
            $css .= isset($attr['categoryTopborderTypeMobile']) && isset($attr['categoryTopBorderMobile']) && isset($attr['categoryTopBorderColorMobile']) ? 
                "border-top: " . esc_attr($attr['categoryTopborderTypeMobile']) . ' ' . esc_attr($attr['categoryTopBorderMobile']) . " " . esc_attr($attr['categoryTopBorderColorMobile']) . ";" : '';
            $css .= isset($attr['categoryBottomborderTypeMobile']) && isset($attr['categoryBottomBorderMobile']) && isset($attr['categoryBottomBorderColorMobile']) ? 
                "border-bottom: " . esc_attr($attr['categoryBottomborderTypeMobile']) . ' ' . esc_attr($attr['categoryBottomBorderMobile']) . " " . esc_attr($attr['categoryBottomBorderColorMobile']) . ";" : '';
            $css .= isset($attr['categoryLeftborderTypeMobile']) && isset($attr['categoryLeftBorderMobile']) && isset($attr['categoryLeftBorderColorMobile']) ? 
                "border-left: " . esc_attr($attr['categoryLeftborderTypeMobile']) . ' ' . esc_attr($attr['categoryLeftBorderMobile']) . " " . esc_attr($attr['categoryLeftBorderColorMobile']) . ";" : '';
            $css .= isset($attr['categoryRightborderTypeMobile']) && isset($attr['categoryRightBorderMobile']) && isset($attr['categoryRightBorderColorMobile']) ? 
                "border-right: " . esc_attr($attr['categoryRightborderTypeMobile']) . ' ' . esc_attr($attr['categoryRightBorderMobile']) . " " . esc_attr($attr['categoryRightBorderColorMobile']) . ";" : '';
        $css .= "}";
    $css .= "}";

    $css .= "$wrapper $post .post-grid-category-style-container {";
        $css .= isset($attr['pg_layoutalignment']) ? "justify-content: " . esc_attr($attr['pg_layoutalignment']) . ";" : '';
    $css .= "}";
        
    $css .= "$wrapper $post .vayu_blocks_title_post_grid {";
        $css .= "display:flex;";
        $css .= isset($attr['pg_layoutalignment']) ? "justify-content: " . esc_attr($attr['pg_layoutalignment']) . ";" : '';
    $css .= "}";

    $css .= "$wrapper $post .post-grid-tag-style-conatiner {";
        // $css .= "display:flex;";
        $css .= isset($attr['pg_layoutalignment']) ? "text-align: " . esc_attr($attr['pg_layoutalignment']) . ";" : '';
    $css .= "}";
   
    //Tag
    $css .= "$wrapper $post .post-grid-tag-style-conatiner .post-grid-tag-style-new{";
        // Cursor
        $css .= "cursor: pointer;";
        // Display
        $css .= "text-decoration: none;";
        $css .= "margin-left: 5px;";
        // Desktop Padding
        $paddingUnit = isset($attr['tagpaddingUnit']) ? esc_attr($attr['tagpaddingUnit']) : 'px';
        $css .= isset($attr['pg_TagpaddingTop']) ? "padding-top: " . esc_attr($attr['pg_TagpaddingTop']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_TagpaddingBottom']) ? "padding-bottom: " . esc_attr($attr['pg_TagpaddingBottom']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_TagpaddingLeft']) ? "padding-left: " . esc_attr($attr['pg_TagpaddingLeft']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_TagpaddingRight']) ? "padding-right: " . esc_attr($attr['pg_TagpaddingRight']) . $paddingUnit . ";" : '';
        
        // Font Weight and Box Sizing
        $css .= "font-weight: 600;";
        $css .= "box-sizing: border-box;";
        $css .= "line-Height: initial;"; 
        
        // Text Color
        $css .= isset($attr['pg_tagTextColor']) ? "color: " . esc_attr($attr['pg_tagTextColor']) . ";" : '';
        
        $css .= "background: " . esc_attr($attr['tag_backgroundColor']) . ";";
        
        // Font Size
        $css .= isset($attr['pg_tagTextSize']) ? "font-size: " . esc_attr($attr['pg_tagTextSize']) . "px;" : '';
        
        // Border radius for tag
        if (isset($attr['tagradius'])) {
            $css .= "border-top-left-radius: " . esc_attr($attr['tagradius']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['tagradius']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['tagradius']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['tagradius']['left']) . ";";
        }

        if (isset($attr['tagradiusTablet'])) {
            $css .= "@media (max-width: 768px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['tagradiusTablet']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['tagradiusTablet']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['tagradiusTablet']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['tagradiusTablet']['left']) . ";";
            $css .= "}";
        }

        if (isset($attr['tagradiusMobile'])) {
            $css .= "@media (max-width: 480px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['tagradiusMobile']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['tagradiusMobile']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['tagradiusMobile']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['tagradiusMobile']['left']) . ";";
            $css .= "}";
        }

        // Border for Desktop
        $css .= isset($attr['tagTopborderType']) && isset($attr['tagTopBorder']) && isset($attr['tagTopBorderColor']) ? 
            "border-top: " . esc_attr($attr['tagTopborderType']) . ' ' . esc_attr($attr['tagTopBorder']) . " " . esc_attr($attr['tagTopBorderColor']) . ";" : '';
        $css .= isset($attr['tagBottomborderType']) && isset($attr['tagBottomBorder']) && isset($attr['tagBottomBorderColor']) ? 
            "border-bottom: " . esc_attr($attr['tagBottomborderType']) . ' ' . esc_attr($attr['tagBottomBorder']) . " " . esc_attr($attr['tagBottomBorderColor']) . ";" : '';
        $css .= isset($attr['tagLeftborderType']) && isset($attr['tagLeftBorder']) && isset($attr['tagLeftBorderColor']) ? 
            "border-left: " . esc_attr($attr['tagLeftborderType']) . ' ' . esc_attr($attr['tagLeftBorder']) . " " . esc_attr($attr['tagLeftBorderColor']) . ";" : '';
        $css .= isset($attr['tagRightborderType']) && isset($attr['tagRightBorder']) && isset($attr['tagRightBorderColor']) ? 
            "border-right: " . esc_attr($attr['tagRightborderType']) . ' ' . esc_attr($attr['tagRightBorder']) . " " . esc_attr($attr['tagRightBorderColor']) . ";" : '';

        // Media Query for Tablet
        $css .= "@media (max-width: 768px) {";
            $css .= isset($attr['tagTopborderTypeTablet']) && isset($attr['tagTopBorderTablet']) && isset($attr['tagTopBorderColorTablet']) ? 
                "border-top: " . esc_attr($attr['tagTopborderTypeTablet']) . ' ' . esc_attr($attr['tagTopBorderTablet']) . " " . esc_attr($attr['tagTopBorderColorTablet']) . ";" : '';
            $css .= isset($attr['tagBottomborderTypeTablet']) && isset($attr['tagBottomBorderTablet']) && isset($attr['tagBottomBorderColorTablet']) ? 
                "border-bottom: " . esc_attr($attr['tagBottomborderTypeTablet']) . ' ' . esc_attr($attr['tagBottomBorderTablet']) . " " . esc_attr($attr['tagBottomBorderColorTablet']) . ";" : '';
            $css .= isset($attr['tagLeftborderTypeTablet']) && isset($attr['tagLeftBorderTablet']) && isset($attr['tagLeftBorderColorTablet']) ? 
                "border-left: " . esc_attr($attr['tagLeftborderTypeTablet']) . ' ' . esc_attr($attr['tagLeftBorderTablet']) . " " . esc_attr($attr['tagLeftBorderColorTablet']) . ";" : '';
            $css .= isset($attr['tagRightborderTypeTablet']) && isset($attr['tagRightBorderTablet']) && isset($attr['tagRightBorderColorTablet']) ? 
                "border-right: " . esc_attr($attr['tagRightborderTypeTablet']) . ' ' . esc_attr($attr['tagRightBorderTablet']) . " " . esc_attr($attr['tagRightBorderColorTablet']) . ";" : '';
        $css .= "}";

        // Media Query for Mobile
        $css .= "@media (max-width: 480px) {";
            $css .= isset($attr['tagTopborderTypeMobile']) && isset($attr['tagTopBorderMobile']) && isset($attr['tagTopBorderColorMobile']) ? 
                "border-top: " . esc_attr($attr['tagTopborderTypeMobile']) . ' ' . esc_attr($attr['tagTopBorderMobile']) . " " . esc_attr($attr['tagTopBorderColorMobile']) . ";" : '';
            $css .= isset($attr['tagBottomborderTypeMobile']) && isset($attr['tagBottomBorderMobile']) && isset($attr['tagBottomBorderColorMobile']) ? 
                "border-bottom: " . esc_attr($attr['tagBottomborderTypeMobile']) . ' ' . esc_attr($attr['tagBottomBorderMobile']) . " " . esc_attr($attr['tagBottomBorderColorMobile']) . ";" : '';
            $css .= isset($attr['tagLeftborderTypeMobile']) && isset($attr['tagLeftBorderMobile']) && isset($attr['tagLeftBorderColorMobile']) ? 
                "border-left: " . esc_attr($attr['tagLeftborderTypeMobile']) . ' ' . esc_attr($attr['tagLeftBorderMobile']) . " " . esc_attr($attr['tagLeftBorderColorMobile']) . ";" : '';
            $css .= isset($attr['tagRightborderTypeMobile']) && isset($attr['tagRightBorderMobile']) && isset($attr['tagRightBorderColorMobile']) ? 
                "border-right: " . esc_attr($attr['tagRightborderTypeMobile']) . ' ' . esc_attr($attr['tagRightBorderMobile']) . " " . esc_attr($attr['tagRightBorderColorMobile']) . ";" : '';
        $css .= "}";
        
    $css .= "}";
        
    //Featured Image
    $css .= "$wrapper $post .post-grid-image{";
        $css .= "display: block;";
        $css .= "width: 100%;";
        $css .= "height: auto;";
        $css .= "box-sizing: border-box;";

        // Border radius for layout
        if (isset($attr['featuredradius'])) {
            $css .= "border-top-left-radius: " . esc_attr($attr['featuredradius']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['featuredradius']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['featuredradius']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['featuredradius']['left']) . ";";
        }

        if (isset($attr['featuredradiusTablet'])) {
            $css .= "@media (max-width: 768px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['featuredradiusTablet']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['featuredradiusTablet']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['featuredradiusTablet']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['featuredradiusTablet']['left']) . ";";
            $css .= "}";
        }

        if (isset($attr['featuredradiusMobile'])) {
            $css .= "@media (max-width: 480px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['featuredradiusMobile']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['featuredradiusMobile']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['featuredradiusMobile']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['featuredradiusMobile']['left']) . ";";
            $css .= "}";
        }

        // Border for Desktop
        $css .= isset($attr['featuredTopborderType']) && isset($attr['featuredTopBorder']) && isset($attr['featuredTopBorderColor']) ? 
            "border-top: " . esc_attr($attr['featuredTopborderType']) . ' ' . esc_attr($attr['featuredTopBorder']) . " " . esc_attr($attr['featuredTopBorderColor']) . ";" : '';
        $css .= isset($attr['featuredBottomborderType']) && isset($attr['featuredBottomBorder']) && isset($attr['featuredBottomBorderColor']) ? 
            "border-bottom: " . esc_attr($attr['featuredBottomborderType']) . ' ' . esc_attr($attr['featuredBottomBorder']) . " " . esc_attr($attr['featuredBottomBorderColor']) . ";" : '';
        $css .= isset($attr['featuredLeftborderType']) && isset($attr['featuredLeftBorder']) && isset($attr['featuredLeftBorderColor']) ? 
            "border-left: " . esc_attr($attr['featuredLeftborderType']) . ' ' . esc_attr($attr['featuredLeftBorder']) . " " . esc_attr($attr['featuredLeftBorderColor']) . ";" : '';
        $css .= isset($attr['featuredRightborderType']) && isset($attr['featuredRightBorder']) && isset($attr['featuredRightBorderColor']) ? 
            "border-right: " . esc_attr($attr['featuredRightborderType']) . ' ' . esc_attr($attr['featuredRightBorder']) . " " . esc_attr($attr['featuredRightBorderColor']) . ";" : '';

        // Media Query for Tablet
        $css .= "@media (max-width: 768px) {";
            $css .= isset($attr['featuredTopborderTypeTablet']) && isset($attr['featuredTopBorderTablet']) && isset($attr['featuredTopBorderColorTablet']) ? 
                "border-top: " . esc_attr($attr['featuredTopborderTypeTablet']) . ' ' . esc_attr($attr['featuredTopBorderTablet']) . " " . esc_attr($attr['featuredTopBorderColorTablet']) . ";" : '';
            $css .= isset($attr['featuredBottomborderTypeTablet']) && isset($attr['featuredBottomBorderTablet']) && isset($attr['featuredBottomBorderColorTablet']) ? 
                "border-bottom: " . esc_attr($attr['featuredBottomborderTypeTablet']) . ' ' . esc_attr($attr['featuredBottomBorderTablet']) . " " . esc_attr($attr['featuredBottomBorderColorTablet']) . ";" : '';
            $css .= isset($attr['featuredLeftborderTypeTablet']) && isset($attr['featuredLeftBorderTablet']) && isset($attr['featuredLeftBorderColorTablet']) ? 
                "border-left: " . esc_attr($attr['featuredLeftborderTypeTablet']) . ' ' . esc_attr($attr['featuredLeftBorderTablet']) . " " . esc_attr($attr['featuredLeftBorderColorTablet']) . ";" : '';
            $css .= isset($attr['featuredRightborderTypeTablet']) && isset($attr['featuredRightBorderTablet']) && isset($attr['featuredRightBorderColorTablet']) ? 
                "border-right: " . esc_attr($attr['featuredRightborderTypeTablet']) . ' ' . esc_attr($attr['featuredRightBorderTablet']) . " " . esc_attr($attr['featuredRightBorderColorTablet']) . ";" : '';
        $css .= "}";

        // Media Query for Mobile
        $css .= "@media (max-width: 480px) {";
            $css .= isset($attr['featuredTopborderTypeMobile']) && isset($attr['featuredTopBorderMobile']) && isset($attr['featuredTopBorderColorMobile']) ? 
                "border-top: " . esc_attr($attr['featuredTopborderTypeMobile']) . ' ' . esc_attr($attr['featuredTopBorderMobile']) . " " . esc_attr($attr['featuredTopBorderColorMobile']) . ";" : '';
            $css .= isset($attr['featuredBottomborderTypeMobile']) && isset($attr['featuredBottomBorderMobile']) && isset($attr['featuredBottomBorderColorMobile']) ? 
                "border-bottom: " . esc_attr($attr['featuredBottomborderTypeMobile']) . ' ' . esc_attr($attr['featuredBottomBorderMobile']) . " " . esc_attr($attr['featuredBottomBorderColorMobile']) . ";" : '';
            $css .= isset($attr['featuredLeftborderTypeMobile']) && isset($attr['featuredLeftBorderMobile']) && isset($attr['featuredLeftBorderColorMobile']) ? 
                "border-left: " . esc_attr($attr['featuredLeftborderTypeMobile']) . ' ' . esc_attr($attr['featuredLeftBorderMobile']) . " " . esc_attr($attr['featuredLeftBorderColorMobile']) . ";" : '';
            $css .= isset($attr['featuredRightborderTypeMobile']) && isset($attr['featuredRightBorderMobile']) && isset($attr['featuredRightBorderColorMobile']) ? 
                "border-right: " . esc_attr($attr['featuredRightborderTypeMobile']) . ' ' . esc_attr($attr['featuredRightBorderMobile']) . " " . esc_attr($attr['featuredRightBorderColorMobile']) . ";" : '';
        $css .= "}";

    $css .= "}";
     
    //Title Tag
    $css .= "$wrapper $post {$attr['pg_blockTitleTag']}{";
        if (isset($attr['titlechoice']) && $attr['titlechoice'] === 'color') {
            // Apply color style if titlechoice is 'color'
            if (isset($attr['pg_TitleColor'])) {
                $css .= "color: " . esc_attr($attr['pg_TitleColor']) . ";";
            }
        } elseif (isset($attr['titlechoice']) && $attr['titlechoice'] === 'gradient') {
            // Apply gradient style if titlechoice is 'gradient'
            if (isset($attr['pg_TitleColor'])) {
                $css .= "background: " . esc_attr($attr['pg_TitleColor']) . " !important;";
                $css .= "-webkit-background-clip: text !important;";
                $css .= "-webkit-text-fill-color: transparent !important;";
                $css .= "background-clip: text !important;";
            }
        }

        $css .= isset($attr['pg_TitleSize']) ? "font-size: " . esc_attr($attr['pg_TitleSize']) . "px;" : '';
       
        $css .= isset($attr['pg_spacing']) ? "margin-block-start: " . esc_attr($attr['pg_spacing']) . "%;" : '';

        $css .= "margin-left: 5px;";
        $css .= isset($attr['pg_TitlelineHeight']) ? "line-height: " . esc_attr($attr['pg_TitlelineHeight']) . ";" : '';
        $css .= "margin-block-end: 0.07em;";
        $css .= "font-weight: 600;";

        // Ensure text wraps properly
        $css .= "overflow-wrap: break-word;"; // Break words if needed
        $css .= "word-break: break-word;"; // Break long words if necessary

    $css .= "}";

    //Title Tag
    $css .= "$wrapper $post {$attr['pg_blockTitleTag']} a{";

        if (isset($attr['titlechoice']) && $attr['titlechoice'] === 'color') {
            // Apply color style if titlechoice is 'color'
            if (isset($attr['pg_TitleColor'])) {
                $css .= "color: " . esc_attr($attr['pg_TitleColor']) . ";";
            }
        } elseif (isset($attr['titlechoice']) && $attr['titlechoice'] === 'gradient') {
            // Apply gradient style if titlechoice is 'gradient'
            if (isset($attr['pg_TitleColor'])) {
                $css .= "background: " . esc_attr($attr['pg_TitleColor']) . " !important;";
                $css .= "-webkit-background-clip: text !important;";
                $css .= "-webkit-text-fill-color: transparent !important;";
                $css .= "background-clip: text !important;";
            }
        }
    $css .= "}";

    //author-date-container
    $css .= "$wrapper $post .post-grid-author-date-container{";
        $css .= "    display: flex;";
        $css .= "    align-items: flex-start;";
        $css .= "    flex-wrap: wrap;";
        $css .= "    margin-left:2px;";
        $css .= isset($attr['pg_layoutalignment']) ? "justify-content: " . esc_attr($attr['pg_layoutalignment']) . ";" : '';

    $css .= "}";

    //author-date-container
    $css .= "$wrapper $post .post-grid-author-date-container .datecontainer{";
        $css .= "    display: flex;";
        $css .= "    align-items: center;";
        $css .= "    flex-wrap: wrap;";
    $css .= "}";

    //author-image
    $css .= "$wrapper $post .post-grid-author-date-container .post-grid-author-image {";
        $css .= "    width: 20px;";
        $css .= "    border-radius: 50%;";
        $css .= "transform: scale(" . esc_attr($attr['pg_authorImageScale']) . ");";
    $css .= "}";
      
    //author-span
    $css .= "$wrapper $post .post-grid-author-date-container .post-grid-author-span{";
        $css .= "    text-decoration: none;";
        $css .= "font-size: " . esc_attr($attr['pg_authorTextSize']) . "px;";
        $css .= "color: " . esc_attr($attr['pg_authorTextColor']) . ";";
        // Cursor
        $css .= "cursor: pointer;";
        $css .= "    margin-right: 10px;";
    $css .= "}";

    //date-image
    $css .= "$wrapper $post .post-grid-author-date-container .post-grid-date-image{";
        $css .= "transform: scale(" . esc_attr($attr['pg_dateImageScale']) . ");";
        $css .= "width: 20px;";
      
    $css .= "}";
        
    //date-span
    $css .= "$wrapper $post .post-grid-author-date-container .post-grid-date-span{";
        $css .= "font-size: " . esc_attr($attr['pg_dateTextSize']) . "px;";
        $css .= "color: " . esc_attr($attr['pg_dateColor']) . ";";
    $css .= "}";
        
    //content
    $css .= "$wrapper $post .post-grid-excerpt-view{";

        // Font Weight
        $css .= isset($attr['pg_ContentWeight']) ? "font-weight: " . esc_attr($attr['pg_ContentWeight']) . ";" : '';

        // Text Color
        $css .= isset($attr['pg_textColor']) ? "color: " . esc_attr($attr['pg_textColor']) . ";" : '';
        
        // Font Size
        $css .= isset($attr['pg_textSize']) ? "font-size: " . esc_attr($attr['pg_textSize']) . "px;" : '';
        
        // Line Height
        $css .= isset($attr['pg_lineHeight']) ? "line-height: " . esc_attr($attr['pg_lineHeight']) . ";" : '';
        
        // Margin Left
        $css .= "margin-left: 5px;";


        $css .= isset($attr['pg_layoutalignment']) ? "text-align: " . esc_attr($attr['pg_layoutalignment']) . ";" : '';
        
    $css .= "}";

    //pagination
    $css .= ".page-numbers-{$uniqueId} {";
        // Padding
        $paddingUnit = isset($attr['paginationpaddingUnit']) ? esc_attr($attr['paginationpaddingUnit']) : 'px';
        $css .= isset($attr['pg_PaginationpaddingTop']) ? "padding-top: " . esc_attr($attr['pg_PaginationpaddingTop']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_PaginationpaddingBottom']) ? "padding-bottom: " . esc_attr($attr['pg_PaginationpaddingBottom']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_PaginationpaddingLeft']) ? "padding-left: " . esc_attr($attr['pg_PaginationpaddingLeft']) . $paddingUnit . ";" : '';
        $css .= isset($attr['pg_PaginationpaddingRight']) ? "padding-right: " . esc_attr($attr['pg_PaginationpaddingRight']) . $paddingUnit . ";" : '';
        
        // Cursor
        $css .= "cursor: pointer;";
        
        // Font size
        $css .= isset($attr['pg_PaginationSize']) ? "font-size: " . esc_attr($attr['pg_PaginationSize']) . "px;" : '';
        
        // Color
        $css .= isset($attr['pg_PaginationColor']) ? "color: " . esc_attr($attr['pg_PaginationColor']) . ";" : '';
        // Background
        $css .= isset($attr['pg_PaginationbackgroundColor']) ? "background: " . esc_attr($attr['pg_PaginationbackgroundColor']) . ";" : '';
        
        // Margin
        $css .= "margin: 20px 5px;";
        $css .="text-decoration: none;";
        
        $borderRadiusUnit = isset($attr['pg_PaginationpaddingUnit']) ? esc_attr($attr['pg_PaginationpaddingUnit']) : 'px';

        // Border radius for pagination
        if (isset($attr['paginationradius'])) {
            $css .= "border-top-left-radius: " . esc_attr($attr['paginationradius']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['paginationradius']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['paginationradius']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['paginationradius']['left']) . ";";
        }

        if (isset($attr['paginationradiusTablet'])) {
            $css .= "@media (max-width: 768px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['paginationradiusTablet']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['paginationradiusTablet']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['paginationradiusTablet']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['paginationradiusTablet']['left']) . ";";
            $css .= "}";
        }

        if (isset($attr['paginationradiusMobile'])) {
            $css .= "@media (max-width: 480px) {";
            $css .= "border-top-left-radius: " . esc_attr($attr['paginationradiusMobile']['top']) . ";";
            $css .= "border-top-right-radius: " . esc_attr($attr['paginationradiusMobile']['right']) . ";";
            $css .= "border-bottom-right-radius: " . esc_attr($attr['paginationradiusMobile']['bottom']) . ";";
            $css .= "border-bottom-left-radius: " . esc_attr($attr['paginationradiusMobile']['left']) . ";";
            $css .= "}";
        }
   
        // Pagination Borders for Desktop
        $css .= isset($attr['PaginationTopborderType']) && isset($attr['pg_paginationTopBorder']) && isset($attr['pg_paginationTopBorderColor']) ? 
            "border-top: " . esc_attr($attr['PaginationTopborderType']) . ' ' . esc_attr($attr['pg_paginationTopBorder']) . " " . esc_attr($attr['pg_paginationTopBorderColor']) . ";" : '';
        $css .= isset($attr['PaginationBottomborderType']) && isset($attr['pg_paginationBottomBorder']) && isset($attr['pg_paginationBottomBorderColor']) ? 
            "border-bottom: " . esc_attr($attr['PaginationBottomborderType']) . ' ' . esc_attr($attr['pg_paginationBottomBorder']) . " " . esc_attr($attr['pg_paginationBottomBorderColor']) . ";" : '';
        $css .= isset($attr['PaginationLeftborderType']) && isset($attr['pg_paginationLeftBorder']) && isset($attr['pg_paginationLeftBorderColor']) ? 
            "border-left: " . esc_attr($attr['PaginationLeftborderType']) . ' ' . esc_attr($attr['pg_paginationLeftBorder']) . " " . esc_attr($attr['pg_paginationLeftBorderColor']) . ";" : '';
        $css .= isset($attr['PaginationRightborderType']) && isset($attr['pg_paginationRightBorder']) && isset($attr['pg_paginationRightBorderColor']) ? 
            "border-right: " . esc_attr($attr['PaginationRightborderType']) . ' ' . esc_attr($attr['pg_paginationRightBorder']) . " " . esc_attr($attr['pg_paginationRightBorderColor']) . ";" : '';

        // Media Query for Tablet
        $css .= "@media (max-width: 768px) {";
        $css .= isset($attr['PaginationTopborderTypeTablet']) && isset($attr['pg_paginationTopBorderTablet']) && isset($attr['pg_paginationTopBorderColorTablet']) ? 
            "border-top: " . esc_attr($attr['PaginationTopborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationTopBorderTablet']) . " " . esc_attr($attr['pg_paginationTopBorderColorTablet']) . ";" : '';
        $css .= isset($attr['PaginationBottomborderTypeTablet']) && isset($attr['pg_paginationBottomBorderTablet']) && isset($attr['pg_paginationBottomBorderColorTablet']) ? 
            "border-bottom: " . esc_attr($attr['PaginationBottomborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationBottomBorderTablet']) . " " . esc_attr($attr['pg_paginationBottomBorderColorTablet']) . ";" : '';
        $css .= isset($attr['PaginationLeftborderTypeTablet']) && isset($attr['pg_paginationLeftBorderTablet']) && isset($attr['pg_paginationLeftBorderColorTablet']) ? 
            "border-left: " . esc_attr($attr['PaginationLeftborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationLeftBorderTablet']) . " " . esc_attr($attr['pg_paginationLeftBorderColorTablet']) . ";" : '';
        $css .= isset($attr['PaginationRightborderTypeTablet']) && isset($attr['pg_paginationRightBorderTablet']) && isset($attr['pg_paginationRightBorderColorTablet']) ? 
            "border-right: " . esc_attr($attr['PaginationRightborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationRightBorderTablet']) . " " . esc_attr($attr['pg_paginationRightBorderColorTablet']) . ";" : '';
        $css .= "}";

        // Media Query for Mobile
        $css .= "@media (max-width: 480px) {";
        $css .= isset($attr['PaginationTopborderTypeMobile']) && isset($attr['pg_paginationTopBorderMobile']) && isset($attr['pg_paginationTopBorderColorMobile']) ? 
            "border-top: " . esc_attr($attr['PaginationTopborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationTopBorderMobile']) . " " . esc_attr($attr['pg_paginationTopBorderColorMobile']) . ";" : '';
        $css .= isset($attr['PaginationBottomborderTypeMobile']) && isset($attr['pg_paginationBottomBorderMobile']) && isset($attr['pg_paginationBottomBorderColorMobile']) ? 
            "border-bottom: " . esc_attr($attr['PaginationBottomborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationBottomBorderMobile']) . " " . esc_attr($attr['pg_paginationBottomBorderColorMobile']) . ";" : '';
        $css .= isset($attr['PaginationLeftborderTypeMobile']) && isset($attr['pg_paginationLeftBorderMobile']) && isset($attr['pg_paginationLeftBorderColorMobile']) ? 
            "border-left: " . esc_attr($attr['PaginationLeftborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationLeftBorderMobile']) . " " . esc_attr($attr['pg_paginationLeftBorderColorMobile']) . ";" : '';
        $css .= isset($attr['PaginationRightborderTypeMobile']) && isset($attr['pg_paginationRightBorderMobile']) && isset($attr['pg_paginationRightBorderColorMobile']) ? 
            "border-right: " . esc_attr($attr['PaginationRightborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationRightBorderMobile']) . " " . esc_attr($attr['pg_paginationRightBorderColorMobile']) . ";" : '';
        $css .= "}";


    $css .= "}"; 

    // Media Query for Tablet (1024px and below)
    $css .= "@media (max-width: 1024px) {";
        $css .= ".page-numbers-{$uniqueId} {";

            // Border
            $css .= isset($attr['PaginationTopborderTypeTablet']) && isset($attr['pg_paginationTopBorderTablet']) && isset($attr['pg_paginationTopBorderColorTablet']) ? 
                "border-top: " . esc_attr($attr['PaginationTopborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationTopBorderTablet']) . " " . esc_attr($attr['pg_paginationTopBorderColorTablet']) . ";" : '';
            $css .= isset($attr['PaginationBottomborderTypeTablet']) && isset($attr['pg_paginationBottomBorderTablet']) && isset($attr['pg_paginationBottomBorderColorTablet']) ? 
                "border-bottom: " . esc_attr($attr['PaginationBottomborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationBottomBorderTablet']) . " " . esc_attr($attr['pg_paginationBottomBorderColorTablet']) . ";" : '';
            $css .= isset($attr['PaginationLeftborderTypeTablet']) && isset($attr['pg_paginationLeftBorderTablet']) && isset($attr['pg_paginationLeftBorderColorTablet']) ? 
                "border-left: " . esc_attr($attr['PaginationLeftborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationLeftBorderTablet']) . " " . esc_attr($attr['pg_paginationLeftBorderColorTablet']) . ";" : '';
            $css .= isset($attr['PaginationRightborderTypeTablet']) && isset($attr['pg_paginationRightBorderTablet']) && isset($attr['pg_paginationRightBorderColorTablet']) ? 
                "border-right: " . esc_attr($attr['PaginationRightborderTypeTablet']) . ' ' . esc_attr($attr['pg_paginationRightBorderTablet']) . " " . esc_attr($attr['pg_paginationRightBorderColorTablet']) . ";" : '';

        $css .= "}"; // Close the .page-numbers-{$uniqueId} block
    $css .= "}"; // Close the @media query block

    // Media Query for Tablet (1024px and below)
    $css .= "@media (max-width: 600px) {";
        $css .= ".page-numbers-{$uniqueId} {";

            // Border
            $css .= isset($attr['PaginationTopborderTypeMobile']) && isset($attr['pg_paginationTopBorderMobile']) && isset($attr['pg_paginationTopBorderColorMobile']) ? 
                "border-top: " . esc_attr($attr['PaginationTopborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationTopBorderMobile']) . " " . esc_attr($attr['pg_paginationTopBorderColorMobile']) . ";" : '';
            $css .= isset($attr['PaginationBottomborderTypeMobile']) && isset($attr['pg_paginationBottomBorderMobile']) && isset($attr['pg_paginationBottomBorderColorMobile']) ? 
                "border-bottom: " . esc_attr($attr['PaginationBottomborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationBottomBorderMobile']) . " " . esc_attr($attr['pg_paginationBottomBorderColorMobile']) . ";" : '';
            $css .= isset($attr['PaginationLeftborderTypeMobile']) && isset($attr['pg_paginationLeftBorderMobile']) && isset($attr['pg_paginationLeftBorderColorMobile']) ? 
                "border-left: " . esc_attr($attr['PaginationLeftborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationLeftBorderMobile']) . " " . esc_attr($attr['pg_paginationLeftBorderColorMobile']) . ";" : '';
            $css .= isset($attr['PaginationRightborderTypeMobile']) && isset($attr['pg_paginationRightBorderMobile']) && isset($attr['pg_paginationRightBorderColorMobile']) ? 
                "border-right: " . esc_attr($attr['PaginationRightborderTypeMobile']) . ' ' . esc_attr($attr['pg_paginationRightBorderMobile']) . " " . esc_attr($attr['pg_paginationRightBorderColorMobile']) . ";" : '';

        $css .= "}"; // Close the .page-numbers-{$uniqueId} block
    $css .= "}"; // Close the @media query block

    $css .= ".pagination{";  
        $css .= isset($attr['pg_Paginationalignment']) ? "text-align: " . esc_attr($attr['pg_Paginationalignment']) . ";" : '';
        $css .= "margin-top: 20px;";
        $css .= "margin-bottom: 30px;";
    $css .= "}"; 

    $css .= ".pagination a{";  
        $css .= "text-decoration: none;";
    $css .= "}"; 
     
    $css .= ".page-numbers.current span{";  
        $css .= isset($attr['pg_PaginationactiveColor']) ? "color: " . esc_attr($attr['pg_PaginationactiveColor']) . ";" : '';
        $css .= "trasform: scale(1.1);";
        $css .= "font-weight: bold;";
    $css .= "}"; 
     
    //Hover 
    $css .= "$wrapper:hover {";

        // Top border
        if (isset($attr['advanceborderhvr']['topwidth'], $attr['advanceborderhvr']['topstyle'], $attr['advanceborderhvr']['topcolor'])) {
            $css .= "border-top: " . esc_attr($attr['advanceborderhvr']['topwidth']) . " " . esc_attr($attr['advanceborderhvr']['topstyle']) . " " . esc_attr($attr['advanceborderhvr']['topcolor']) . ";";
        }

        // Bottom border
        if (isset($attr['advanceborderhvr']['bottomwidth'], $attr['advanceborderhvr']['bottomstyle'], $attr['advanceborderhvr']['bottomcolor'])) {
            $css .= "border-bottom: " . esc_attr($attr['advanceborderhvr']['bottomwidth']) . " " . esc_attr($attr['advanceborderhvr']['bottomstyle']) . " " . esc_attr($attr['advanceborderhvr']['bottomcolor']) . ";";
        }

        // Left border
        if (isset($attr['advanceborderhvr']['leftwidth'], $attr['advanceborderhvr']['leftstyle'], $attr['advanceborderhvr']['leftcolor'])) {
            $css .= "border-left: " . esc_attr($attr['advanceborderhvr']['leftwidth']) . " " . esc_attr($attr['advanceborderhvr']['leftstyle']) . " " . esc_attr($attr['advanceborderhvr']['leftcolor']) . ";";
        }

        // Right border
        if (isset($attr['advanceborderhvr']['rightwidth'], $attr['advanceborderhvr']['rightstyle'], $attr['advanceborderhvr']['rightcolor'])) {
            $css .= "border-right: " . esc_attr($attr['advanceborderhvr']['rightwidth']) . " " . esc_attr($attr['advanceborderhvr']['rightstyle']) . " " . esc_attr($attr['advanceborderhvr']['rightcolor']) . ";";
        }

        // Apply individual border-radius values if not a circle
        if (isset($attr['advanceRadiushvr']['top'], $attr['advanceRadiushvr']['right'], $attr['advanceRadiushvr']['bottom'], $attr['advanceRadiushvr']['left'])) {
            $css .= "border-radius: " . esc_attr($attr['advanceRadiushvr']['top']) . " " . esc_attr($attr['advanceRadiushvr']['right']) . " " . esc_attr($attr['advanceRadiushvr']['bottom']) . " " . esc_attr($attr['advanceRadiushvr']['left']) . ";";
        }
   
        // Box-shadow
        if (isset($attr['boxShadowHvr']) && $attr['boxShadowHvr']) {
            // Ensure the boxShadowColorHvr and boxShadowColorOpacityHvr keys are set
            if (isset($attr['boxShadowColorHvr'], $attr['boxShadowColorOpacityHvr'])) {
                $boxShadowColor = 'rgba(' . implode(', ', [
                    hexdec(substr($attr['boxShadowColorHvr'], 1, 2)), // Red
                    hexdec(substr($attr['boxShadowColorHvr'], 3, 2)), // Green
                    hexdec(substr($attr['boxShadowColorHvr'], 5, 2))  // Blue
                ]) . ', ' . ((float) $attr['boxShadowColorOpacityHvr'] / 100) . ')';
            } else {
                $boxShadowColor = 'rgba(0, 0, 0, 0)'; // Default value in case of missing color
            }

            // Ensure each box shadow dimension key is set, use a default value if not
            $boxShadowHorizontal = isset($attr['boxShadowHorizontalHvr']) ? esc_attr($attr['boxShadowHorizontalHvr']) : '0';
            $boxShadowVertical = isset($attr['boxShadowVerticalHvr']) ? esc_attr($attr['boxShadowVerticalHvr']) : '0';
            $boxShadowBlur = isset($attr['boxShadowBlurHvr']) ? esc_attr($attr['boxShadowBlurHvr']) : '0';
            $boxShadowSpread = isset($attr['boxShadowSpreadHvr']) ? esc_attr($attr['boxShadowSpreadHvr']) : '0';

            $css .= "box-shadow: " . $boxShadowHorizontal . 'px ' .
                                    $boxShadowVertical . 'px ' .
                                    $boxShadowBlur . 'px ' .
                                    $boxShadowSpread . 'px ' .
                                    $boxShadowColor . ";";
        } else {
            $css .= "box-shadow: none;";
        }

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

    // Start building the CSS string for hover styles
    $css .= "$wrapper $post {$attr['pg_blockTitleTag']} a:hover {";

        // Check if `titlechoicehvr` is set and apply styles accordingly
        if (isset($attr['titlechoicehvr']) && $attr['titlechoicehvr'] === 'color') {
            // Apply color style if titlechoicehvr is 'color'
            if (isset($attr['pg_TitleColorhvr'])) {
                $css .= "color: " . esc_attr($attr['pg_TitleColorhvr']) . " !important;";
            }
        } elseif (isset($attr['titlechoicehvr']) && $attr['titlechoicehvr'] === 'gradient') {
            // Apply gradient style if titlechoicehvr is 'gradient'
            if (isset($attr['pg_TitleColorhvr'])) {
                $css .= "background: " . esc_attr($attr['pg_TitleColorhvr']) . " !important;";
                $css .= "-webkit-background-clip: text !important;";
                $css .= "-webkit-text-fill-color: transparent !important;";
                $css .= "background-clip: text !important;";
            }
        }
        
    // Close the CSS rule
    $css .= "}";

    $css .= ".page-numbers:hover {";
        $css .= "color:" . $attr['pg_PaginationactiveColor'] . ";";
    $css .= "}";

    if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
        $css .= "@media only screen and (min-width: 1024px) {.wp-block-vayu-blocks-post-grid  {display:none;}}";
    }
    //hide on Tablet
    if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { .wp-block-vayu-blocks-post-grid  {display:none;}}";
    }
    //hide on Mobile
    if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
        $css .= "@media only screen and (max-width: 767px) {.wp-block-vayu-blocks-post-grid  {display:none;}}";
    }

 
    //for tablet
    $css .= "@media (max-width: 1024px) {

        $wrapper {
            width: " . (isset($attr['customWidthTablet']) ? esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) : '') . ";
            grid-template-columns: repeat(" . (isset($attr['pg_postLayoutColumnsTablet']) ? $attr['pg_postLayoutColumnsTablet'] : 2) . ", 1fr);
            padding-top: " . (isset($attr['buttonpaddingTopTablet']) ? esc_attr($attr['buttonpaddingTopTablet']) . esc_attr($attr['paddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['buttonpaddingBottomTablet']) ? esc_attr($attr['buttonpaddingBottomTablet']) . esc_attr($attr['paddingUnit']) : '') . ";
            padding-left: " . (isset($attr['buttonpaddingLeftTablet']) ? esc_attr($attr['buttonpaddingLeftTablet']) . esc_attr($attr['paddingUnit']) : '') . ";
            padding-right: " . (isset($attr['buttonpaddingRightTablet']) ? esc_attr($attr['buttonpaddingRightTablet']) . esc_attr($attr['paddingUnit']) : '') . ";
            margin-top: " . (isset($attr['marginTopTablet']) ? esc_attr($attr['marginTopTablet']) . esc_attr($attr['marginUnit']) : '') . ";
            margin-bottom: " . (isset($attr['marginBottomTablet']) ? esc_attr($attr['marginBottomTablet']) . esc_attr($attr['marginUnit']) : '') . ";
            margin-left: " . (isset($attr['marginLeftTablet']) ? esc_attr($attr['marginLeftTablet']) . esc_attr($attr['marginUnit']) : '') . ";
            margin-right: " . (isset($attr['marginRightTablet']) ? esc_attr($attr['marginRightTablet']) . esc_attr($attr['marginUnit']) : '') . ";   
            margin-left: auto !important;
            margin-right: auto !important;
            grid-gap: " . (isset($attr['pg_gapupTablet']) ? esc_attr($attr['pg_gapupTablet']) . 'px ' . esc_attr($attr['pg_gapTablet']) . 'px' : '') . ";
            border-top-left-radius: " . (isset($attr['pg_postTopBorderRadiusTablet']) ? esc_attr($attr['pg_postTopBorderRadiusTablet']) . "px" : '') . ";
            border-bottom-left-radius: " . (isset($attr['pg_postBottomBorderRadiusTablet']) ? esc_attr($attr['pg_postBottomBorderRadiusTablet']) . "px" : '') . ";
            border-bottom-right-radius: " . (isset($attr['pg_postLeftBorderRadiusTablet']) ? esc_attr($attr['pg_postLeftBorderRadiusTablet']) . "px" : '') . ";
            border-top-right-radius: " . (isset($attr['pg_postRightBorderRadiusTablet']) ? esc_attr($attr['pg_postRightBorderRadiusTablet']) . "px" : '') . ";
   
        }
    
        $wrapper $post {
            width: " . (isset($attr['layoutcustomWidthTablet']) ? esc_attr($attr['layoutcustomWidthTablet']) . esc_attr($attr['layoutcustomWidthUnit']) : '') . ";
            padding-top: " . (isset($attr['pg_layoutpaddingTopTablet']) ? esc_attr($attr['pg_layoutpaddingTopTablet']) . esc_attr($attr['pg_layoutpaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_layoutpaddingBottomTablet']) ? esc_attr($attr['pg_layoutpaddingBottomTablet']) . esc_attr($attr['pg_layoutpaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_layoutpaddingLeftTablet']) ? esc_attr($attr['pg_layoutpaddingLeftTablet']) . esc_attr($attr['pg_layoutpaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_layoutpaddingRightTablet']) ? esc_attr($attr['pg_layoutpaddingRightTablet']) . esc_attr($attr['pg_layoutpaddingUnit']) : '') . ";
            line-height: " . (isset($attr['pg_spacingTablet']) ? esc_attr($attr['pg_spacingTablet']) : '') . ";
            font-size: " . (isset($attr['pg_textSizeTablet']) ? esc_attr($attr['pg_textSizeTablet']) . "px" : '16px') . ";
        }   

        $wrapper $post .post-grid-category-style-new {
            padding-top: " . (isset($attr['pg_CategorypaddingTopTablet']) ? esc_attr($attr['pg_CategorypaddingTopTablet']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_CategorypaddingBottomTablet']) ? esc_attr($attr['pg_CategorypaddingBottomTablet']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_CategorypaddingLeftTablet']) ? esc_attr($attr['pg_CategorypaddingLeftTablet']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_CategorypaddingRightTablet']) ? esc_attr($attr['pg_CategorypaddingRightTablet']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            margin-block-start: " . (isset($attr['pg_spacingTablet']) ? esc_attr($attr['pg_spacingTablet']) : '') . ";
            font-size: " . (isset($attr['pg_categoryTextSizeTablet']) ? esc_attr($attr['pg_categoryTextSizeTablet']) . "px" : '16px') . ";
        }

        $wrapper $post .post-grid-tag-style-new {
            padding-top: " . (isset($attr['pg_TagpaddingTopTablet']) ? esc_attr($attr['pg_TagpaddingTopTablet']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_TagpaddingBottomTablet']) ? esc_attr($attr['pg_TagpaddingBottomTablet']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_TagpaddingLeftTablet']) ? esc_attr($attr['pg_TagpaddingLeftTablet']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_TagpaddingRightTablet']) ? esc_attr($attr['pg_TagpaddingRightTablet']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            font-size: " . (isset($attr['pg_tagTextSizeTablet']) ? esc_attr($attr['pg_tagTextSizeTablet']) . "px" : '16px') . ";
        }

        .page-numbers-{$uniqueId} {

            font-size: " . (isset($attr['pg_PaginationSizeTablet']) ? esc_attr($attr['pg_PaginationSizeTablet']) . "px" : '16px') . ";

            padding-top: " . (isset($attr['pg_PaginationpaddingTopTablet']) ? esc_attr($attr['pg_PaginationpaddingTopTablet']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_PaginationpaddingBottomTablet']) ? esc_attr($attr['pg_PaginationpaddingBottomTablet']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_PaginationpaddingLeftTablet']) ? esc_attr($attr['pg_PaginationpaddingLeftTablet']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_PaginationpaddingRightTablet']) ? esc_attr($attr['pg_PaginationpaddingRightTablet']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";

        }

        .pagination { 
            text-align: " . (isset($attr['pg_PaginationalignmentTablet']) ? esc_attr($attr['pg_PaginationalignmentTablet']) : 'left') . ";            
        }

        $wrapper .post-grid-excerpt-view {
            font-weight: " . (isset($attr['pg_ContentWeightTablet']) ? esc_attr($attr['pg_ContentWeightTablet']) : '') . ";
            font-size: " . (isset($attr['pg_textSizeTablet']) ? esc_attr($attr['pg_textSizeTablet']) . "px" : '16px') . ";
            line-height: " . (isset($attr['pg_lineHeightTablet']) ? esc_attr($attr['pg_lineHeightTablet']) : '') . ";
            text-align: " . (isset($attr['pg_layoutalignmentTablet']) ? esc_attr($attr['pg_layoutalignmentTablet']) : '') . ";
        }

        $wrapper .post-grid-author-date-container {
            justify-content: " . (isset($attr['pg_layoutalignmentTablet']) ? esc_attr($attr['pg_layoutalignmentTablet']) : '') . ";
        }

        $wrapper .post-grid-category-style-container {
            justify-content: " . (isset($attr['pg_layoutalignmentTablet']) ? esc_attr($attr['pg_layoutalignmentTablet']) : '') . ";
        }

        $wrapper .vayu_blocks_title_post_grid {
            justify-content: " . (isset($attr['pg_layoutalignmentTablet']) ? esc_attr($attr['pg_layoutalignmentTablet']) : '') . ";
        }

        $wrapper .post-grid-tag-style-conatiner {
            text-align: " . (isset($attr['pg_layoutalignmentTablet']) ? esc_attr($attr['pg_layoutalignmentTablet']) : '') . ";
        }

        {$wrapper} {$post} {$attr['pg_blockTitleTag']} {
            line-height: " . (isset($attr['pg_TitlelineHeightTablet']) ? esc_attr($attr['pg_TitlelineHeightTablet']) : '') . ";
        }

        $wrapper $post .post-grid-author-date-container .post-grid-author-span{
            font-size: " . (isset($attr['pg_authorTextSizeTablet']) ? esc_attr($attr['pg_authorTextSizeTablet']) . "px" : '16px') . ";
        }
            
        $wrapper $post .post-grid-author-date-container .post-grid-date-span{
            font-size: " . (isset($attr['pg_dateTextSizeTablet']) ? esc_attr($attr['pg_dateTextSizeTablet']) . "px" : '16px') . ";
        }

    }";

    //for mobile
    $css .= "@media (max-width: 400px) {

        $wrapper {
            width: " . (isset($attr['customWidthMobile']) ? esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) : '') . ";
            grid-template-columns: repeat(" . (isset($attr['pg_postLayoutColumnsMobile']) ? $attr['pg_postLayoutColumnsMobile'] : 1) . ", 1fr);
            padding-top: " . (isset($attr['buttonpaddingTopMobile']) ? esc_attr($attr['buttonpaddingTopMobile']) . esc_attr($attr['paddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['buttonpaddingBottomMobile']) ? esc_attr($attr['buttonpaddingBottomMobile']) . esc_attr($attr['paddingUnit']) : '') . ";
            padding-left: " . (isset($attr['buttonpaddingLeftMobile']) ? esc_attr($attr['buttonpaddingLeftMobile']) . esc_attr($attr['paddingUnit']) : '') . ";
            padding-right: " . (isset($attr['buttonpaddingRightMobile']) ? esc_attr($attr['buttonpaddingRightMobile']) . esc_attr($attr['paddingUnit']) : '') . ";
            margin-top: " . (isset($attr['marginTopMobile']) ? esc_attr($attr['marginTopMobile']) . esc_attr($attr['marginUnit']) : '') . ";
            margin-bottom: " . (isset($attr['marginBottomMobile']) ? esc_attr($attr['marginBottomMobile']) . esc_attr($attr['marginUnit']) : '') . ";
            margin-left: " . (isset($attr['marginLeftMobile']) ? esc_attr($attr['marginLeftMobile']) . esc_attr($attr['marginUnit']) : '') . ";
            margin-right: " . (isset($attr['marginRightMobile']) ? esc_attr($attr['marginRightMobile']) . esc_attr($attr['marginUnit']) : '') . ";
            grid-template-rows: repeat(" . (isset($attr['pg_numberOfRowMobile']) ? $attr['pg_numberOfRowMobile'] : 2) . ", minmax(100px, 1fr));
            grid-gap: " . (isset($attr['pg_gapupMobile']) ? esc_attr($attr['pg_gapupMobile']) . 'px ' . esc_attr($attr['pg_gapMobile']) . 'px' : '') . ";
            border-top-left-radius: " . (isset($attr['pg_postTopBorderRadiusMobile']) ? esc_attr($attr['pg_postTopBorderRadiusMobile']) . "px" : '') . ";
            border-bottom-left-radius: " . (isset($attr['pg_postBottomBorderRadiusMobile']) ? esc_attr($attr['pg_postBottomBorderRadiusMobile']) . "px" : '') . ";
            border-bottom-right-radius: " . (isset($attr['pg_postLeftBorderRadiusMobile']) ? esc_attr($attr['pg_postLeftBorderRadiusMobile']) . "px" : '') . ";
            border-top-right-radius: " . (isset($attr['pg_postRightBorderRadiusMobile']) ? esc_attr($attr['pg_postRightBorderRadiusMobile']) . "px" : '') . ";
       
            
        }
    
        $wrapper $post {
            width: " . (isset($attr['layoutcustomWidthMobile']) ? esc_attr($attr['layoutcustomWidthMobile']) . esc_attr($attr['layoutcustomWidthUnit']) : '') . ";
            padding-top: " . (isset($attr['pg_layoutpaddingTopMobile']) ? esc_attr($attr['pg_layoutpaddingTopMobile']) . (isset($attr['pg_layoutpaddingUnit']) ? esc_attr($attr['pg_layoutpaddingUnit']) : 'px') : '') . ";
            padding-bottom: " . (isset($attr['pg_layoutpaddingBottomMobile']) ? esc_attr($attr['pg_layoutpaddingBottomMobile']) . (isset($attr['pg_layoutpaddingUnit']) ? esc_attr($attr['pg_layoutpaddingUnit']) : 'px') : '') . ";
            padding-left: " . (isset($attr['pg_layoutpaddingLeftMobile']) ? esc_attr($attr['pg_layoutpaddingLeftMobile']) . (isset($attr['pg_layoutpaddingUnit']) ? esc_attr($attr['pg_layoutpaddingUnit']) : 'px') : '') . ";
            padding-right: " . (isset($attr['pg_layoutpaddingRightMobile']) ? esc_attr($attr['pg_layoutpaddingRightMobile']) . (isset($attr['pg_layoutpaddingUnit']) ? esc_attr($attr['pg_layoutpaddingUnit']) : 'px') : '') . ";
            line-height: " . (isset($attr['pg_spacingMobile']) ? esc_attr($attr['pg_spacingMobile']) : '') . ";
            font-size: " . (isset($attr['pg_textSizeMobile']) ? esc_attr($attr['pg_textSizeMobile']) . "px" : '16px') . ";
        }
    
        $wrapper $post .post-grid-category-style-new {
            padding-top: " . (isset($attr['pg_CategorypaddingTopMobile']) ? esc_attr($attr['pg_CategorypaddingTopMobile']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_CategorypaddingBottomMobile']) ? esc_attr($attr['pg_CategorypaddingBottomMobile']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_CategorypaddingLeftMobile']) ? esc_attr($attr['pg_CategorypaddingLeftMobile']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_CategorypaddingRightMobile']) ? esc_attr($attr['pg_CategorypaddingRightMobile']) . esc_attr($attr['categorypaddingUnit']) : '') . ";
            margin-block-start: " . (isset($attr['pg_spacingMobile']) ? esc_attr($attr['pg_spacingMobile']) : '') . ";
            font-size: " . (isset($attr['pg_categoryTextSizeMobile']) ? esc_attr($attr['pg_categoryTextSizeMobile']) . "px" : '16px') . ";
        }
    
        $wrapper $post .post-grid-tag-style-new {
            padding-top: " . (isset($attr['pg_TagpaddingTopMobile']) ? esc_attr($attr['pg_TagpaddingTopMobile']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_TagpaddingBottomMobile']) ? esc_attr($attr['pg_TagpaddingBottomMobile']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_TagpaddingLeftMobile']) ? esc_attr($attr['pg_TagpaddingLeftMobile']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_TagpaddingRightMobile']) ? esc_attr($attr['pg_TagpaddingRightMobile']) . esc_attr($attr['tagpaddingUnit']) : '') . ";
            font-size: " . (isset($attr['pg_tagTextSizeMobile']) ? esc_attr($attr['pg_tagTextSizeMobile']) . "px" : '16px') . ";

        }

        .page-numbers-{$uniqueId} {
        
            padding-top: " . (isset($attr['pg_PaginationpaddingTopMobile']) ? esc_attr($attr['pg_PaginationpaddingTopMobile']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
            padding-bottom: " . (isset($attr['pg_PaginationpaddingBottomMobile']) ? esc_attr($attr['pg_PaginationpaddingBottomMobile']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
            padding-left: " . (isset($attr['pg_PaginationpaddingLeftMobile']) ? esc_attr($attr['pg_PaginationpaddingLeftMobile']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
            padding-right: " . (isset($attr['pg_PaginationpaddingRightMobile']) ? esc_attr($attr['pg_PaginationpaddingRightMobile']) . esc_attr($attr['pg_PaginationpaddingUnit']) : '') . ";
        }

        .pagination { 
            text-align: " . (isset($attr['pg_PaginationalignmentMobile']) ? esc_attr($attr['pg_PaginationalignmentMobile']) : 'left') . ";            
        }

        .page-numbers-{$uniqueId} {
            font-size: " . (isset($attr['pg_PaginationSizeMobile']) ? esc_attr($attr['pg_PaginationSizeMobile']) . "px" : '16px') . ";
        }

        $wrapper .post-grid-excerpt-view {
            font-weight: " . (isset($attr['pg_ContentWeightMobile']) ? esc_attr($attr['pg_ContentWeightMobile']) : '') . ";
            font-size: " . (isset($attr['pg_textSizeMobile']) ? esc_attr($attr['pg_textSizeMobile']) . "px" : '16px') . ";
            line-height: " . (isset($attr['pg_lineHeightMobile']) ? esc_attr($attr['pg_lineHeightMobile']) : '') . ";
            text-align: " . (isset($attr['pg_layoutalignmentMobile']) ? esc_attr($attr['pg_layoutalignmentMobile']) : '') . ";
        }

        $wrapper .post-grid-author-date-container {
            justify-content: " . (isset($attr['pg_layoutalignmentMobile']) ? esc_attr($attr['pg_layoutalignmentMobile']) : '') . ";
        }

        $wrapper .post-grid-category-style-container {
            justify-content: " . (isset($attr['pg_layoutalignmentMobile']) ? esc_attr($attr['pg_layoutalignmentMobile']) : '') . ";
        }

        $wrapper .vayu_blocks_title_post_grid {
            justify-content: " . (isset($attr['pg_layoutalignmentMobile']) ? esc_attr($attr['pg_layoutalignmentMobile']) : '') . ";
        }

        $wrapper .post-grid-tag-style-conatiner {
            text-align: " . (isset($attr['pg_layoutalignmentMobile']) ? esc_attr($attr['pg_layoutalignmentMobile']) : '') . ";
        }

        {$wrapper} {$post} {$attr['pg_blockTitleTag']} {
            line-height: " . (isset($attr['pg_TitlelineHeightMobile']) ? esc_attr($attr['pg_TitlelineHeightMobile']) : '') . ";
        }

        $wrapper $post .post-grid-author-date-container .post-grid-author-span{
            font-size: " . (isset($attr['pg_authorTextSizeMobile']) ? esc_attr($attr['pg_authorTextSizeMobile']) . "px" : '16px') . ";
        }
            
        $wrapper $post .post-grid-author-date-container .post-grid-date-span{
            font-size: " . (isset($attr['pg_dateTextSizeMobile']) ? esc_attr($attr['pg_dateTextSizeMobile']) . "px" : '16px') . ";
        }

    }";
        
    return $css;
}
