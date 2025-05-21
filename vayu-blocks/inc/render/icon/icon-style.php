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
            'Mobile' => '@media (max-width: 400px) {',
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
                $css .= "$wrapper .vb-icon-block-main-container { $iconBlockStyles }";
            }

            $css .= $mediaQuery ? " }" : '';
        }
    }

    return $css;
}

function generate_inline_icon_styles($attr) {
    $css = '';

    //attributes-merge
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];

    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);
    
    $wrapper = '.vayu-blocks-icon-main-container-' . esc_attr($uniqueId);
    $inline = '.vayu_blocks_icon__wrapper';

    $css .= $OBJ_STYLE->advanceStyle($wrapper);

    $style1 = $OBJ_STYLE->borderRadiusShadow('iconsBorder','iconsRadius','iconsDropShadow','Desktop');
    $style1 .= $OBJ_STYLE->dimensions('iconpadding','padding');
    if (!empty($style1)) {
        $css .= $wrapper . " .vb-icon-block-main-container { $style1 }";
    }

    $style2 = $OBJ_STYLE->borderRadiusShadow('','iconsRadius','','Desktop');
    if (!empty($style2)) {
        $css .= $wrapper . " .vb-icon-animation { $style2 }";
    }

    $style3 = $OBJ_STYLE->borderRadiusShadow('','iconsRadius','','Desktop', 'Hover');
    if (!empty($style3)) {
        $css .= $wrapper . " .vayu_blcoks_icon_main_blocks_icon:hover .vb-icon-animation { $style3 }";
    }

    $style4 = $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadow', 'Desktop','Hover','Hover');
    if (!empty($style4)) {
        $css .= $wrapper . " .vb-icon-block-main-container:hover { $style4 }";
    }

    //Main div
    $css .= "$wrapper {";
        $css .= '--icon-box-shadow-glow-half: 0 0 15px 15px ' . esc_attr( $attr['backgroundcolor'] ) . ';';    
        $css .= '--icon-size-font: ' . $attr['iconSize']['Desktop'] . ';';    
        $css .= '--icon-size-font-tablet: ' . (isset($attr['iconSize']['Tablet']) ? esc_attr($attr['iconSize']['Tablet']) . '' : '') . ';';
        $css .= '--icon-size-font-mobile: ' . (isset($attr['iconSize']['Mobile']) ? esc_attr($attr['iconSize']['Mobile']) . '' : '') . ';';
        $css .= '--icon-rotate-degree: ' . $attr['rotate'] . 'deg;';
        $css .= '--icon-color-svg: ' . $attr['color'] . ';';
        $css .= '--icon-hover-color-svg: ' . (isset($attr['hoverColor']) && !empty($attr['hoverColor']) ? $attr['hoverColor'] : (isset($attr['color']) ? $attr['color'] : 'defaultColor')) . ' ;';

        if($attr['backgroundcolor']){
            $css .= '--backgorund-box-icon: ' . $attr['backgroundcolor'] . ';';
        }
        if($attr['backgroundhoverColor']){
            $css .= '--backgorund-hover-box-icon: ' . $attr['backgroundhoverColor'] . ';';
        }else{
            $css .= '--backgorund-hover-box-icon: ' . $attr['backgroundcolor'] . ';';
        }

        $css .= '--color-hover-box-icon: ' . (isset($attr['hoverColor']) ? $attr['hoverColor'] : $attr['color']) . ' ;';

        $css .= "display: flex;";
        $css .= "align-items: center;";

        if ( !empty($attr['alignment']['Desktop']) ) {
            $css .= "justify-content: {$attr['alignment']['Desktop']};";
        }
        
    $css .= "}";

    $css .="$wrapper .vb-icon-text text{";
        $css .= $OBJ_STYLE->typography('typography','Desktop');
        $css  .= '-webkit-text-stroke: ' . $attr['strokeWidthtext'] . 'px ' . $attr['stroketext'] . ';';
        $css  .= 'text-stroke: ' . $attr['strokeWidthtext'] . 'px ' . $attr['stroketext'] . ';';
    $css .= "}";

    $css .= "$wrapper .vb-icon-text {";
        if ( ! empty( $attr['textbgcolor'] ) ) {
            $css .= "background: {$attr['textbgcolor']};";
        }
        $css .= $OBJ_STYLE->dimensions('textpadding','padding');
        $css .= 'color: ' . $attr['textcolor'] . ';';
        $css .= 'top: ' . $attr['textx'] . ';';
        $css .= 'left: ' . $attr['texty'] . ';';
        $css .= "position: absolute;";

    $css .= "}";

    $css .= ! empty( $attr['textcolorhover'] ) ? "$wrapper .vb-icon-text:hover { color: {$attr['textcolorhover']}; }" : '';
    
    $style = '';
    if ( ! empty( $attr['textbgcolorhvr'] ) ) {
        $style .= "background: {$attr['textbgcolorhvr']};";
    }

    if ( ! empty( $style ) ) {
        $css .= "$wrapper .vb-icon-text:hover { $style }";
    }
    

    $css .= ".vb-icon-front-svg{";
        $css .= "transform: " . 
            ($attr['flipHorizontal'] ? "scaleX(-1) " : "") . 
            ($attr['flipVertical'] ? "scaleY(-1)" : "") . " !important;";

    $css .= "}";

    $css .= "@media (min-width: 400px) and (max-width: 1024px)  {";

        $css .="$wrapper .vb-icon-text text{";
            $css .= $OBJ_STYLE->typography('typography','Tablet');
        $css .= "}";

        $style = $OBJ_STYLE->dimensions('textpadding','padding', 'Tablet');

        if ( ! empty( $style ) ) {
            $css .= "$wrapper .vb-icon-text { $style }";
        }

    $css .= "}";
    
    $css .=  "@media (max-width: 1024px) {".

        $borderStyle = $OBJ_STYLE->borderRadiusShadow('iconsBorder','iconsRadius','iconsDropShadow','Tablet');
        $paddingStyle = $OBJ_STYLE->dimensions('iconpadding','padding','Tablet');

        $style = $borderStyle . $paddingStyle;

        if ( ! empty( $style ) ) {
            $css .= $wrapper . " .vb-icon-block-main-container { $style }";
        }

        $wrapper." .vb-icon-block-main-container:hover {".  
            $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadow','Tablet','Hover', 'Hover').
        "}".

        $wrapper." .vb-icon-animation {".
            $OBJ_STYLE->borderRadiusShadow('','iconsRadius','','Tablet').
        "}".

        $wrapper.".vayu_blcoks_icon_main_blocks_icon:hover .vb-icon-animation{".
            $OBJ_STYLE->borderRadiusShadow('','iconsRadius','','Tablet', 'Hover').
        "}

        $wrapper {
            justify-content: " . (isset($attr['alignment']['Tablet']) ? esc_attr($attr['alignment']['Tablet']) : '') . ";
        }

        $wrapper $inline {
            width: " . (isset($attr['imagewidthtablet']) ? esc_attr($attr['imagewidthtablet']) : 'auto') . ";
            height: " . (isset($attr['imageheighttablet']) ? esc_attr($attr['imageheighttablet']) : 'auto') . ";
        }
        }";
    $css .= "}";

    $css .= "@media (max-width: 400px) {";

        // Apply typography styles for .vb-icon-text
        $css .= "$wrapper .vb-icon-text {";
            $css .= $OBJ_STYLE->typography('typography','Mobile');
        $css .= "}";

        // Apply padding styles for .vb-icon-text
        $style = $OBJ_STYLE->dimensions('textpadding','padding','Mobile');

        if ( ! empty( $style ) ) {
            $css .= "$wrapper .vb-icon-text { $style }";
        }

    $css .= "}";  // Closing brace for @media query

    $css .= "@media (max-width: 400px) {  
   
        $wrapper {
            justify-content: " . (isset($attr['alignment']['Mobile']) ? esc_attr($attr['alignment']['Mobile']) : '') . ";
        }

        $wrapper $inline {
            width: " . (isset($attr['imagewidthmobile']) ? esc_attr($attr['imagewidthmobile']) : 'auto') . ";
            height: " . (isset($attr['imageheightmobile']) ? esc_attr($attr['imageheightmobile']) : 'auto') . ";
        }
    }";
 
    $css .= "@media (max-width: 400px) {"; 

        $borderStyle = $OBJ_STYLE->borderRadiusShadow('iconsBorder','iconsRadius','iconsDropShadow','Mobile');
        $paddingStyle = $OBJ_STYLE->dimensions('iconpadding','padding','Mobile');

        $style = $borderStyle . $paddingStyle;

        if ( ! empty( $style ) ) {
            $css .= "$wrapper .vb-icon-block-main-container { $style }";
        }

        $hoverStyle = $OBJ_STYLE->borderRadiusShadow('iconsBorder', 'iconsRadius', 'iconsDropShadow','Mobile','Hover','Hover');
        if ( ! empty( $hoverStyle ) ) {
            $css .= "$wrapper .vb-icon-block-main-container:hover { $hoverStyle }";
        }

        $iconAnimationStyle = $OBJ_STYLE->borderRadiusShadow('','iconsRadius','','Tablet');
        if ( ! empty( $iconAnimationStyle ) ) {
            $css .= "$wrapper .vb-icon-animation { $iconAnimationStyle }";
        }

        $hoverIconAnimationStyle = $OBJ_STYLE->borderRadiusShadow('','iconsRadius','','Tablet', 'Hover');
        if ( ! empty( $hoverIconAnimationStyle ) ) {
            $css .= "$wrapper .vayu_blcoks_icon_main_blocks_icon:hover .vb-icon-animation { $hoverIconAnimationStyle }";
        }

    $css .= "}"; 
    
    return $css;
}
