<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Function to generate responsive CSS
function generateResponsiveCSS($OBJ_STYLE, $wrapper, $devices = ['Desktop', 'Tablet', 'Mobile']) {
    $css = "";

    foreach ($devices as $device) {
        $mediaQuery = match ($device) {
            'Tablet' => '@media (max-width: 1024px) {',
            'Mobile' => '@media (max-width: 768px) {',
            default => '',
        };

        $iconMainBlockStyles = $OBJ_STYLE->dimensions('iconmargin', 'margin', $device);
        $iconBlockStyles = $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadow', $device) .
                           $OBJ_STYLE->dimensions('iconpadding', 'padding', $device);

        if (!empty($iconMainBlockStyles) || !empty($iconBlockStyles)) {
            $css .= $mediaQuery ? $mediaQuery : '';

            if (!empty($iconMainBlockStyles)) {
                $css .= "$wrapper .vayu_blcoks_icon_main_blocks_icon { $iconMainBlockStyles }";
            }
            if (!empty($iconBlockStyles)) {
                $css .= "$wrapper .vayu_blocks_icon_block_main { $iconBlockStyles }";
            }

            $css .= $mediaQuery ? " }" : '';
        }
    }

    return $css;
}



function generate_inline_icon_styles($attr) {
    $css = '';
    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);


   
    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];
    

    // Generate the class selector by concatenating '.' with the unique ID
    $wrapper = '.vayu-blocks-icon-main-container-' . esc_attr($uniqueId);

    $inline = '.vayu_blocks_icon__wrapper';
    
        // desktop
        $css .= $wrapper." ".".vayu_blcoks_icon_main_blocks_icon{";
        $css .= "}";

        $css .= $wrapper." ".".vayu_blocks_icon_block_main{";
        $css .= $OBJ_STYLE->borderRadiusShadow('iconsBorder','iconsRadius','iconsDropShadow','Desktop');
        $css .= $OBJ_STYLE->dimensions('iconpadding','padding');
        $css .= "}";

        $css .= $wrapper." .vayu_blocks_icon_block_main:hover {".  
        $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadowHover','Desktop','Hover').
        "}";

        $css .=  "@media (max-width: 1024px) {".
                    $wrapper." ".".vayu_blcoks_icon_main_blocks_icon{".
                    "}".
                    $wrapper." ".".vayu_blocks_icon_block_main{".
                    $OBJ_STYLE->borderRadiusShadow('iconsBorder','iconsRadius','iconsDropShadow','Tablet').
                    $OBJ_STYLE->dimensions('iconpadding','padding','Tablet').
                    "}".
                        $wrapper." .vayu_blocks_icon_block_main:hover {".  
                        $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadowHover','Tablet','Hover').
                        "}
                }";
        

        $css .=  "@media (max-width: 768px) {".  
                $wrapper." ".".vayu_blcoks_icon_main_blocks_icon{".
                "}".
                    $wrapper." ".".vayu_blocks_icon_block_main{".
                     $OBJ_STYLE->borderRadiusShadow('iconsBorder','iconsRadius','iconsDropShadow','Mobile').
                     $OBJ_STYLE->dimensions('iconpadding','padding','Mobile').
                     "}".

                     $wrapper." .vayu_blocks_icon_block_main:hover {".  
                     $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadowHover','Mobile','Hover').
            "}
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

    // Ensure default box shadow attributes are set
    if ($attr['iconboxShadow']) {
        $newboxShadow = sprintf(
            '%dpx %dpx %dpx %dpx rgba(%d, %d, %d, %.2f)', 
            $attr['iconboxShadowHorizontal'], 
            $attr['iconboxShadowVertical'], 
            $attr['iconboxShadowBlur'], 
            $attr['iconboxShadowSpread'], 
            hexdec(substr($attr['iconboxShadowColor'], 1, 2)),  // Red
            hexdec(substr($attr['iconboxShadowColor'], 3, 2)),  // Green
            hexdec(substr($attr['iconboxShadowColor'], 5, 2)),  // Blue
            $attr['iconboxShadowColorOpacity'] / 100  // Opacity
        );
    } else {
        $newboxShadow = 'none';
    }

    if ($attr['iconboxShadowHvr']) {
        $hoverboxShadow = sprintf(
            '%dpx %dpx %dpx %dpx rgba(%d, %d, %d, %.2f)', 
            $attr['iconboxShadowHorizontalHvr'], 
            $attr['iconboxShadowVerticalHvr'], 
            $attr['iconboxShadowBlurHvr'], 
            $attr['iconboxShadowSpreadHvr'], 
            hexdec(substr($attr['iconboxShadowColorHvr'], 1, 2)),  // Red
            hexdec(substr($attr['iconboxShadowColorHvr'], 3, 2)),  // Green
            hexdec(substr($attr['iconboxShadowColorHvr'], 5, 2)),  // Blue
            $attr['iconboxShadowColorOpacityHvr'] / 100  // Opacity
        );
    } else {
        $hoverboxShadow = 'none';
    }


// print_r($attr);

    //Main div
    $css .= "$wrapper {";
        $css .= '--icon-size-font-tablet: ' . (isset($attr['fontSizeTablet']) ? esc_attr($attr['fontSizeTablet']) . 'px' : '') . ';';
        $css .= '--icon-size-font-mobile: ' . (isset($attr['fontSizeMobile']) ? esc_attr($attr['fontSizeMobile']) . 'px' : '') . ';';
    
        $css  .= '--text-icon-settings-tablet-font: ' . esc_attr($attr['textfontTablet']) . ';';
        $css  .= '--text-icon-settings-tablet-size: ' . (isset($attr['textsizeTablet']) ? esc_attr($attr['textsizeTablet']) . 'px' : '') . ';';
        $css  .= '--text-icon-settings-tablet-appearance: ' . esc_attr($attr['textappearanceTablet']) . ';';
        $css  .= '--text-icon-settings-tablet-letterSpacing: ' . esc_attr($attr['letterSpacingTablet']) . ';';
        
        $css  .= '--text-icon-settings-mobile-font: ' . esc_attr($attr['textfontMobile']) . ';';
        $css  .= '--text-icon-settings-mobile-size: ' . (isset($attr['textsizeMobile']) ? esc_attr($attr['textsizeMobile']) . 'px' : '') . ';';
        $css  .= '--text-icon-settings-mobile-appearance: ' . esc_attr($attr['textappearanceMobile']) . ';';
        $css  .= '--text-icon-settings-mobile-letterSpacing: ' . esc_attr($attr['letterSpacingMobile']) . ';';
        
        $css  .= '--stroke-text-settings: ' . $attr['strokeWidthtext'] . 'px ' . $attr['stroketext'] . ';';
        $css  .= '--text-icon-settings-font: ' . $attr['textfont'] . ';';
        $css .= '--text-icon-settings-size: ' . $attr['textsize'] . 'px;';
        $css .= '--text-icon-settings-appearance: ' . $attr['textappearance'] . ';';
        $css .= '--text-icon-settings-letterSpacing: ' . $attr['letterSpacing'] . ';';
        $css .= '--text-icon-settings-textbackground: ' . $attr['textbackground'] . ';';
        $css .= '--text-icon-settings-textcolor: ' . $attr['textcolor'] . ';';
        $css .= '--text-icon-settings-textx: ' . $attr['textx'] . ';';
        $css .= '--text-icon-settings-texty: ' . $attr['texty'] . ';';
        // $css .= vayuBlocksDimesions('--icon-padding-box-icon', $attr['iconpadding'], 'Desktop');
        // $css .= vayuBlocksDimesions('--icon-margin-box-icon', $attr['iconmargin'], 'Desktop');
        // $css .= vayuBlocksDimesions('--icon-padding-box-icon-tablet', $attr['iconpadding'], 'Tablet');
        // $css .= vayuBlocksDimesions('--icon-margin-box-icon-tablet', $attr['iconmargin'], 'Tablet');
        // $css .= vayuBlocksDimesions('--icon-padding-box-icon-mobile', $attr['iconpadding'], 'Mobile');
        // $css .= vayuBlocksDimesions('--icon-margin-box-icon-mobile', $attr['iconmargin'], 'Mobile');

       // $css .= '--icon-padding-box-icon-tablet: ' . $attr['iconpaddingTablet']['top'] . ' ' . $attr['iconpaddingTablet']['right'] . ' ' . $attr['iconpaddingTablet']['bottom'] . ' ' . $attr['iconpaddingTablet']['left'] . ';';
       // $css .= '--icon-margin-box-icon-tablet: ' . $attr['iconmarginTablet']['top'] . ' ' . $attr['iconmarginTablet']['right'] . ' ' . $attr['iconmarginTablet']['bottom'] . ' ' . $attr['iconmarginTablet']['left'] . ';';

        //$css .= '--icon-padding-box-icon-mobile: ' . $attr['iconpaddingMobile']['top'] . ' ' . $attr['iconpaddingMobile']['right'] . ' ' . $attr['iconpaddingMobile']['bottom'] . ' ' . $attr['iconpaddingMobile']['left'] . ';';
       // $css .= '--icon-margin-box-icon-mobile: ' . $attr['iconmarginMobile']['top'] . ' ' . $attr['iconmarginMobile']['right'] . ' ' . $attr['iconmarginMobile']['bottom'] . ' ' . $attr['iconmarginMobile']['left'] . ';';

        $css .= '--icon-size-font: ' . $attr['fontSize'] . 'px;';
        $css .= '--icon-rotate-degree: ' . $attr['rotate'] . 'deg;';
        $css .= '--icon-color-svg: ' . $attr['color'] . ';';
        $css .= '--icon-hover-color-svg: ' . $attr['hoverColor'] . ';';
        $css .= '--backgorund-box-icon: ' . $attr['backgroundcolor'] . ';';
        if($attr['backgroundhoverColor']){
            $css .= '--backgorund-hover-box-icon: ' . $attr['backgroundhoverColor'] . ';';
        }else{
            $css .= '--backgorund-hover-box-icon: ' . $attr['backgroundcolor'] . ';';
        }

        $css .= '--color-hover-box-icon: ' . $attr['hoverColor'] . ';';

        // $css .= '--icon-box-icon-border-top: ' . $attr['iconTopBorder'] . ' ' . $attr['iconTopborderType'] . ' ' . $attr['iconTopBorderColor'] . ';';
        // $css .= '--icon-box-icon-border-bottom: ' . $attr['iconBottomBorder'] . ' ' . $attr['iconBottomborderType'] . ' ' . $attr['iconBottomBorderColor'] . ';';
        // $css .= '--icon-box-icon-border-left: ' . $attr['iconLeftBorder'] . ' ' . $attr['iconLeftborderType'] . ' ' . $attr['iconLeftBorderColor'] . ';';
        // $css .= '--icon-box-icon-border-right: ' . $attr['iconRightBorder'] . ' ' . $attr['iconRightborderType'] . ' ' . $attr['iconRightBorderColor'] . ';';
        
        // $css .= '--icon-box-icon-border-top-tablet: ' . $attr['iconTopBorderTablet'] . ' ' . $attr['iconTopborderTypeTablet'] . ' ' . $attr['iconTopBorderColorTablet'] . ';';
        // $css .= '--icon-box-icon-border-bottom-tablet: ' . $attr['iconBottomBorderTablet'] . ' ' . $attr['iconBottomborderTypeTablet'] . ' ' . $attr['iconBottomBorderColorTablet'] . ';';
        // $css .= '--icon-box-icon-border-left-tablet: ' . $attr['iconLeftBorderTablet'] . ' ' . $attr['iconLeftborderTypeTablet'] . ' ' . $attr['iconLeftBorderColorTablet'] . ';';
        // $css .= '--icon-box-icon-border-right-tablet: ' . $attr['iconRightBorderTablet'] . ' ' . $attr['iconRightborderTypeTablet'] . ' ' . $attr['iconRightBorderColorTablet'] . ';';
        
        // $css .= '--icon-box-icon-border-top-mobile: ' . $attr['iconTopBorderMobile'] . ' ' . $attr['iconTopborderTypeMobile'] . ' ' . $attr['iconTopBorderColorMobile'] . ';';
        // $css .= '--icon-box-icon-border-bottom-mobile: ' . $attr['iconBottomBorderMobile'] . ' ' . $attr['iconBottomborderTypeMobile'] . ' ' . $attr['iconBottomBorderColorMobile'] . ';';
        // $css .= '--icon-box-icon-border-left-mobile: ' . $attr['iconLeftBorderMobile'] . ' ' . $attr['iconLeftborderTypeMobile'] . ' ' . $attr['iconLeftBorderColorMobile'] . ';';
        // $css .= '--icon-box-icon-border-right-mobile: ' . $attr['iconRightBorderMobile'] . ' ' . $attr['iconRightborderTypeMobile'] . ' ' . $attr['iconRightBorderColorMobile'] . ';';
        
        // Only the border radius will be responsive
        $css .= '--icon-box-icon-borderRadius: ' . $attr['iconRadius']['top'] . ' ' . $attr['iconRadius']['right'] . ' ' . $attr['iconRadius']['left'] . ' ' . $attr['iconRadius']['bottom'] . ';';
        $css .= '--icon-box-icon-borderRadiusTablet: ' . $attr['iconRadiusTablet']['top'] . ' ' . $attr['iconRadiusTablet']['right'] . ' ' . $attr['iconRadiusTablet']['left'] . ' ' . $attr['iconRadiusTablet']['bottom'] . ';';
        $css .= '--icon-box-icon-borderRadiusMobile: ' . $attr['iconRadiusMobile']['top'] . ' ' . $attr['iconRadiusMobile']['right'] . ' ' . $attr['iconRadiusMobile']['left'] . ' ' . $attr['iconRadiusMobile']['bottom'] . ';';
        
        $css .= '--icon-box-icon-hover-border-top: ' . $attr['iconhvrTopBorder'] . ' ' . $attr['iconhvrTopborderType'] . ' ' . $attr['iconhvrTopBorderColor'] . ';';
        $css .= '--icon-box-icon-hover-border-bottom: ' . $attr['iconhvrBottomBorder'] . ' ' . $attr['iconhvrBottomborderType'] . ' ' . $attr['iconhvrBottomBorderColor'] . ';';
        $css .= '--icon-box-icon-hover-border-left: ' . $attr['iconhvrLeftBorder'] . ' ' . $attr['iconhvrLeftborderType'] . ' ' . $attr['iconhvrLeftBorderColor'] . ';';
        $css .= '--icon-box-icon-hover-border-right: ' . $attr['iconhvrRightBorder'] . ' ' . $attr['iconhvrRightborderType'] . ' ' . $attr['iconhvrRightBorderColor'] . ';';
        
        $css .= '--icon-box-icon-hover-border-top-tablet: ' . $attr['iconhvrTopBorderTablet'] . ' ' . $attr['iconhvrTopborderTypeTablet'] . ' ' . $attr['iconhvrTopBorderColorTablet'] . ';';
        $css .= '--icon-box-icon-hover-border-bottom-tablet: ' . $attr['iconhvrBottomBorderTablet'] . ' ' . $attr['iconhvrBottomborderTypeTablet'] . ' ' . $attr['iconhvrBottomBorderColorTablet'] . ';';
        $css .= '--icon-box-icon-hover-border-left-tablet: ' . $attr['iconhvrLeftBorderTablet'] . ' ' . $attr['iconhvrLeftborderTypeTablet'] . ' ' . $attr['iconhvrLeftBorderColorTablet'] . ';';
        $css .= '--icon-box-icon-hover-border-right-tablet: ' . $attr['iconhvrRightBorderTablet'] . ' ' . $attr['iconhvrRightborderTypeTablet'] . ' ' . $attr['iconhvrRightBorderColorTablet'] . ';';
        
        $css .= '--icon-box-icon-hover-border-top-mobile: ' . $attr['iconhvrTopBorderMobile'] . ' ' . $attr['iconhvrTopborderTypeMobile'] . ' ' . $attr['iconhvrTopBorderColorMobile'] . ';';
        $css .= '--icon-box-icon-hover-border-bottom-mobile: ' . $attr['iconhvrBottomBorderMobile'] . ' ' . $attr['iconhvrBottomborderTypeMobile'] . ' ' . $attr['iconhvrBottomBorderColorMobile'] . ';';
        $css .= '--icon-box-icon-hover-border-left-mobile: ' . $attr['iconhvrLeftBorderMobile'] . ' ' . $attr['iconhvrLeftborderTypeMobile'] . ' ' . $attr['iconhvrLeftBorderColorMobile'] . ';';
        $css .= '--icon-box-icon-hover-border-right-mobile: ' . $attr['iconhvrRightBorderMobile'] . ' ' . $attr['iconhvrRightborderTypeMobile'] . ' ' . $attr['iconhvrRightBorderColorMobile'] . ';';
        
        // Only the border radius will be responsive
        $css .= '--icon-box-icon-hover-borderRadius: ' . $attr['iconhvrRadius']['top'] . ' ' . $attr['iconhvrRadius']['right'] . ' ' . $attr['iconhvrRadius']['left'] . ' ' . $attr['iconhvrRadius']['bottom'] . ';';
        $css .= '--icon-box-icon-hover-borderRadiusTablet: ' . $attr['iconhvrRadiusTablet']['top'] . ' ' . $attr['iconhvrRadiusTablet']['right'] . ' ' . $attr['iconhvrRadiusTablet']['left'] . ' ' . $attr['iconhvrRadiusTablet']['bottom'] . ';';
        $css .= '--icon-box-icon-hover-borderRadiusMobile: ' . $attr['iconhvrRadiusMobile']['top'] . ' ' . $attr['iconhvrRadiusMobile']['right'] . ' ' . $attr['iconhvrRadiusMobile']['left'] . ' ' . $attr['iconhvrRadiusMobile']['bottom'] . ';';


        $css .= '--icon-box-icon-boxShadow: ' . $newboxShadow . ';'; // Assuming $newboxShadow is already set
        $css .= '--icon-box-icon-hover-boxShadow: ' . $hoverboxShadow . ';'; // Assuming $hoverboxShadow is already set

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
        
        // Flex properties
        $css .= "display: flex;";
        $css .= "align-items: center;";
        $css .= "justify-content: {$attr['alignment']['Desktop']};";
        
    $css .= "}";
     
    //Hover 
    $css .= "$wrapper:hover {";

       // Top border
        if (
            isset($attr['advanceborderhvr']['topwidth']) && !empty($attr['advanceborderhvr']['topwidth']) &&
            isset($attr['advanceborderhvr']['topstyle']) && !empty($attr['advanceborderhvr']['topstyle']) &&
            isset($attr['advanceborderhvr']['topcolor']) && !empty($attr['advanceborderhvr']['topcolor'])
        ) {
            $css .= "border-top: " . esc_attr($attr['advanceborderhvr']['topwidth']) . " " . esc_attr($attr['advanceborderhvr']['topstyle']) . " " . esc_attr($attr['advanceborderhvr']['topcolor']) . ";";
        }


        // Bottom border
        if (
            isset($attr['advanceborderhvr']['bottomwidth']) && !empty($attr['advanceborderhvr']['bottomwidth']) &&
            isset($attr['advanceborderhvr']['bottomstyle']) && !empty($attr['advanceborderhvr']['bottomstyle']) &&
            isset($attr['advanceborderhvr']['bottomcolor']) && !empty($attr['advanceborderhvr']['bottomcolor'])
        ) {
            $css .= "border-bottom: " . esc_attr($attr['advanceborderhvr']['bottomwidth']) . " " . esc_attr($attr['advanceborderhvr']['bottomstyle']) . " " . esc_attr($attr['advanceborderhvr']['bottomcolor']) . ";";
        }

        // Left border
        if (
            isset($attr['advanceborderhvr']['leftwidth']) && !empty($attr['advanceborderhvr']['leftwidth']) &&
            isset($attr['advanceborderhvr']['leftstyle']) && !empty($attr['advanceborderhvr']['leftstyle']) &&
            isset($attr['advanceborderhvr']['leftcolor']) && !empty($attr['advanceborderhvr']['leftcolor'])
        ) {
            $css .= "border-left: " . esc_attr($attr['advanceborderhvr']['leftwidth']) . " " . esc_attr($attr['advanceborderhvr']['leftstyle']) . " " . esc_attr($attr['advanceborderhvr']['leftcolor']) . ";";
        }

        // Right border
        if (
            isset($attr['advanceborderhvr']['rightwidth']) && !empty($attr['advanceborderhvr']['rightwidth']) &&
            isset($attr['advanceborderhvr']['rightstyle']) && !empty($attr['advanceborderhvr']['rightstyle']) &&
            isset($attr['advanceborderhvr']['rightcolor']) && !empty($attr['advanceborderhvr']['rightcolor'])
        ) {
            $css .= "border-right: " . esc_attr($attr['advanceborderhvr']['rightwidth']) . " " . esc_attr($attr['advanceborderhvr']['rightstyle']) . " " . esc_attr($attr['advanceborderhvr']['rightcolor']) . ";";
        }


        // Apply individual border-radius values if all values are set and not empty
        if (
            isset($attr['advanceRadiushvr']['top']) && ($attr['advanceRadiushvr']['top'])!='0px' ||
            isset($attr['advanceRadiushvr']['right']) && ($attr['advanceRadiushvr']['right']) !='0px' ||
            isset($attr['advanceRadiushvr']['bottom']) && ($attr['advanceRadiushvr']['bottom']) !='0px' ||
            isset($attr['advanceRadiushvr']['left']) && ($attr['advanceRadiushvr']['left'])!='0px'
        ) {
            $css .= "border-radius: " . esc_attr($attr['advanceRadiushvr']['top']) . " " . esc_attr($attr['advanceRadiushvr']['right']) . " " . esc_attr($attr['advanceRadiushvr']['bottom']) . " " . esc_attr($attr['advanceRadiushvr']['left']) . ";";
        }

        if(!empty($attr['boxShadowColorHvr'])){
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

            if(!empty($boxShadowColor)){
                $css .= "box-shadow: " . $boxShadowHorizontal . 'px ' .
                $boxShadowVertical . 'px ' .
                $boxShadowBlur . 'px ' .
                $boxShadowSpread . 'px ' .
                $boxShadowColor . ";";
            }

        }
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

    $css .= ".vayu_blocks_icon_block_main_icon_front_svg{";
        $css .= "transform: " . 
            ($attr['flipHorizontal'] ? "scaleX(-1) " : "") . 
            ($attr['flipVertical'] ? "scaleY(-1)" : "") . " !important;";

    $css .= "}";


    if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
        $css .= "@media only screen and (min-width: 1024px) {.wp-block-vayu-blocks-icon  {display:none;}}";
    }
    //hide on Tablet
    if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { .wp-block-vayu-blocks-icon  {display:none;}}";
    }
    //hide on Mobile
    if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
        $css .= "@media only screen and (max-width: 767px) {.wp-block-vayu-blocks-icon  {display:none;}}";
    }


    // for tablet
    $css .= "@media (max-width: 1024px) {

        $wrapper {
            width: " . (isset($attr['customWidthTablet']) ? esc_attr($attr['customWidthTablet']) . esc_attr($attr['customWidthUnit']) : 'auto') . ";

            grid-template-columns: repeat(" . (isset($attr['pg_postLayoutColumnsTablet']) ? $attr['pg_postLayoutColumnsTablet'] : 2) . ", 1fr);
            padding-top: " . (isset($attr['buttonpaddingTopTablet']) ? esc_attr($attr['buttonpaddingTopTablet']) . esc_attr($attr['paddingUnit']) : '0') . ";
            padding-bottom: " . (isset($attr['buttonpaddingBottomTablet']) ? esc_attr($attr['buttonpaddingBottomTablet']) . esc_attr($attr['paddingUnit']) : '0') . ";
            padding-left: " . (isset($attr['buttonpaddingLeftTablet']) ? esc_attr($attr['buttonpaddingLeftTablet']) . esc_attr($attr['paddingUnit']) : '0') . ";
            padding-right: " . (isset($attr['buttonpaddingRightTablet']) ? esc_attr($attr['buttonpaddingRightTablet']) . esc_attr($attr['paddingUnit']) : '0') . ";
        
            margin-top: " . (isset($attr['marginTopTablet']) ? esc_attr($attr['marginTopTablet']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-bottom: " . (isset($attr['marginBottomTablet']) ? esc_attr($attr['marginBottomTablet']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-left: " . (isset($attr['marginLeftTablet']) ? esc_attr($attr['marginLeftTablet']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-right: " . (isset($attr['marginRightTablet']) ? esc_attr($attr['marginRightTablet']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-left: auto !important;
            margin-right: auto !important;

            grid-gap: " . (isset($attr['pg_gapupTablet']) ? esc_attr($attr['pg_gapupTablet']) . 'px ' . esc_attr($attr['pg_gapTablet']) . 'px' : '0') . ";

            border-top-left-radius: " . (isset($attr['pg_postTopBorderRadiusTablet']) ? esc_attr($attr['pg_postTopBorderRadiusTablet']) . "px" : '0') . ";
            border-bottom-left-radius: " . (isset($attr['pg_postBottomBorderRadiusTablet']) ? esc_attr($attr['pg_postBottomBorderRadiusTablet']) . "px" : '0') . ";
            border-bottom-right-radius: " . (isset($attr['pg_postLeftBorderRadiusTablet']) ? esc_attr($attr['pg_postLeftBorderRadiusTablet']) . "px" : '0') . ";
            border-top-right-radius: " . (isset($attr['pg_postRightBorderRadiusTablet']) ? esc_attr($attr['pg_postRightBorderRadiusTablet']) . "px" : '0') . ";
            justify-content: " . (isset($attr['alignment']['Tablet']) ? esc_attr($attr['alignment']['Tablet']) : '') . ";
        }

        $wrapper $inline {
            width: " . (isset($attr['imagewidthtablet']) ? esc_attr($attr['imagewidthtablet']) : 'auto') . ";
            height: " . (isset($attr['imageheighttablet']) ? esc_attr($attr['imageheighttablet']) : 'auto') . ";
        }


    }";
    // for mobile


      
    $css .= "@media (max-width: 500px) {  
   
   $wrapper {
            width: " . (isset($attr['customWidthMobile']) ? esc_attr($attr['customWidthMobile']) . esc_attr($attr['customWidthUnit']) : 'auto') . ";

            grid-template-columns: repeat(" . (isset($attr['pg_postLayoutColumnsMobile']) ? $attr['pg_postLayoutColumnsMobile'] : 1) . ", 1fr);
            padding-top: " . (isset($attr['buttonpaddingTopMobile']) ? esc_attr($attr['buttonpaddingTopMobile']) . esc_attr($attr['paddingUnit']) : '0') . ";
            padding-bottom: " . (isset($attr['buttonpaddingBottomMobile']) ? esc_attr($attr['buttonpaddingBottomMobile']) . esc_attr($attr['paddingUnit']) : '0') . ";
            padding-left: " . (isset($attr['buttonpaddingLeftMobile']) ? esc_attr($attr['buttonpaddingLeftMobile']) . esc_attr($attr['paddingUnit']) : '0') . ";
            padding-right: " . (isset($attr['buttonpaddingRightMobile']) ? esc_attr($attr['buttonpaddingRightMobile']) . esc_attr($attr['paddingUnit']) : '0') . ";
            margin-top: " . (isset($attr['marginTopMobile']) ? esc_attr($attr['marginTopMobile']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-bottom: " . (isset($attr['marginBottomMobile']) ? esc_attr($attr['marginBottomMobile']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-left: " . (isset($attr['marginLeftMobile']) ? esc_attr($attr['marginLeftMobile']) . esc_attr($attr['marginUnit']) : '0') . ";
            margin-right: " . (isset($attr['marginRightMobile']) ? esc_attr($attr['marginRightMobile']) . esc_attr($attr['marginUnit']) : '0') . ";
            grid-template-rows: repeat(" . (isset($attr['pg_numberOfRowMobile']) ? $attr['pg_numberOfRowMobile'] : 2) . ", minmax(100px, 1fr));
            grid-gap: " . (isset($attr['pg_gapupMobile']) ? esc_attr($attr['pg_gapupMobile']) . 'px ' . esc_attr($attr['pg_gapMobile']) . 'px' : '0') . ";

            border-top-left-radius: " . (isset($attr['pg_postTopBorderRadiusMobile']) ? esc_attr($attr['pg_postTopBorderRadiusMobile']) . "px" : '0') . ";
            border-bottom-left-radius: " . (isset($attr['pg_postBottomBorderRadiusMobile']) ? esc_attr($attr['pg_postBottomBorderRadiusMobile']) . "px" : '0') . ";
            border-bottom-right-radius: " . (isset($attr['pg_postLeftBorderRadiusMobile']) ? esc_attr($attr['pg_postLeftBorderRadiusMobile']) . "px" : '0') . ";
            border-top-right-radius: " . (isset($attr['pg_postRightBorderRadiusMobile']) ? esc_attr($attr['pg_postRightBorderRadiusMobile']) . "px" : '0') . ";

            justify-content: " . (isset($attr['alignment']['Mobile']) ? esc_attr($attr['alignment']['Mobile']) : '') . ";

        }

        $wrapper $inline {
            width: " . (isset($attr['imagewidthmobile']) ? esc_attr($attr['imagewidthmobile']) : 'auto') . ";
            height: " . (isset($attr['imageheightmobile']) ? esc_attr($attr['imageheightmobile']) : 'auto') . ";
        }
    }";


    
    
    return $css;
}
