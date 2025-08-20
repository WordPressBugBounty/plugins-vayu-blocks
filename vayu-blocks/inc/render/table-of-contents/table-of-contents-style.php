<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

function generate_inline_toc_styles($attr) {

    if ((new VAYUBLOCKS_DISPLAY_CONDITION($attr))->display()) {
        return '';
    }

    $css = '';

    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];

    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    $wrapper = '.vb-toc-container' . esc_attr($uniqueId);

    $title   = "$wrapper .vb-toc-title";

    $content = "$wrapper .vb-toc-list";

    $button = "$wrapper .vb-toc-wrapper .vb-toc-title .vb-toc-toggle-button";

    $css .= $OBJ_STYLE->advanceStyle( $wrapper );

    $css .= "$wrapper .vb-toc-wrapper {";

        if (isset($attr['scroll']) && $attr['scroll']) {
            $scrollHeight = $attr['scrollheight']['Desktop'] ?? '300px'; 
            $css .= "max-height: $scrollHeight;";
            $css .= "overflow-y: auto;";
            $css .= "scroll-behavior: smooth;";
        }

    $css .= "}";

    // Title specific styles
    $css .= "$title {";

        if (isset($attr['titlebg']) && $attr['titlebg'] !== '') {
            $css .= 'background:' . esc_attr($attr['titlebg']) . ';';
        }

        if (isset($attr['titlecolor']) && $attr['titlecolor'] !== '') {
            $css .= 'color:' . esc_attr($attr['titlecolor']) . ';';
        }

        if (!empty($attributes['titlePadding'])) {
            $css .= $OBJ_STYLE->dimensions('titlePadding', 'padding');
        } else {
           $css .= "padding-left:10px;";
           $css .= "padding-right:10px;";
        }

        $css .= $OBJ_STYLE->borderRadiusShadow('titleBorder','titleBorderRadius','','Desktop');

        $css .= $OBJ_STYLE->typography('titletypography','Desktop');

        $css .="box-sizing:border-box;";

        $align = !empty($attr['iconalignment']['Desktop']) ? $attr['iconalignment']['Desktop'] : 'center';
        $css .= "justify-content: {$align};";

        $margin = !empty($attr['spacing']['Desktop']) ? $attr['spacing']['Desktop'] : '0px';
        $css .= "margin-bottom: {$margin};";

    $css .= "}";

    $css .="$content{";
        if (isset($attr['contentbg']) && $attr['contentbg'] !== '') {
            $css .= 'background:' . esc_attr($attr['contentbg']) . ';';
        }

        if (!empty($attributes['contentPadding'])) {
            $css .= $OBJ_STYLE->dimensions('contentPadding', 'padding');
            if (trim($padding) !== 'padding: 0;' && trim($padding) !== '') {
                $css .= $padding;
            }
        } else {
           $css .= "padding-left:20px;";
           $css .= "padding-right:20px;";
        }

        $css .= $OBJ_STYLE->borderRadiusShadow('contentBorder','contentBorderRadius','','Desktop');

        $css .= $OBJ_STYLE->typography('contenttypography','Desktop');

        $css .="box-sizing:border-box;";
        $css .= "list-style-position: inside;";

        if ( isset( $attr['contentalignment']['Desktop'] ) ) {
            $css .= "text-align: " . esc_attr( $attr['contentalignment']['Desktop'] ) . ";";
        }

        if (isset($attr['contentcolor']) && $attr['contentcolor'] !== '') {
            $css .= 'color:' . esc_attr($attr['contentcolor']) . ';';
        }

        
        $gap = !empty($attr['contentspacing']['Desktop']) ? $attr['contentspacing']['Desktop'] : '0px';
        $css .= "gap: {$gap};";

    $css .= "}";

    $css .="$content .vb-toc-item a{";
        if (isset($attr['contentcolor']) && $attr['contentcolor'] !== '') {
            $css .= 'color:' . esc_attr($attr['contentcolor']) . ';';
        }
    $css .= "}";

    $css .= "$button {";
        if ( isset( $attr['iconsize']['Desktop'] ) && $attr['iconsize']['Desktop'] !== '' ) {
            $css .= "--icon-size: " . esc_attr( $attr['iconsize']['Desktop'] ) . ";";
        }

        if (isset($attr['iconbg']) && $attr['iconbg'] !== '') {
            $css .= 'background:' . esc_attr($attr['iconbg']) . ';';
        }

        
        if (isset($attr['iconcolor']) && $attr['iconcolor'] !== '') {
            $css .= 'color:' . esc_attr($attr['iconcolor']) . ';';
            $css .= 'fill:' . esc_attr($attr['iconcolor']) . ';';
        }

        $css .= $OBJ_STYLE->dimensions('iconPadding','padding');

        $css .= $OBJ_STYLE->borderRadiusShadow('iconBorder','iconBorderRadius','iconDropShadow','Desktop');

    $css .= "}";

    $css .= "$button.vb-active {";
        if (isset($attr['iconactivecolor']) && $attr['iconactivecolor'] !== '') {
            $css .= 'color:' . esc_attr($attr['iconactivecolor']) . ';';
            $css .= 'fill:' . esc_attr($attr['iconactivecolor']) . ';';
        }
    $css .= "}";

    $css .= "$button:hover {";

        if (isset($attr['iconbghvr']) && $attr['iconbghvr'] !== '') {
            $css .= 'background:' . esc_attr($attr['iconbghvr']) . ';';
        }

        if (isset($attr['iconcolorhvr']) && $attr['iconcolorhvr'] !== '') {
            $css .= 'color:' . esc_attr($attr['iconcolorhvr']) . ';';
            $css .= 'fill:' . esc_attr($attr['iconcolorhvr']) . ';';
        }

    $css .= "}";

    // 🔹 Tablet Media Query
    $css .= "@media (min-width: 768px) and (max-width: 1024px) {";

        $css .= "$wrapper .vb-toc-wrapper {";

            if (isset($attr['scroll']) && $attr['scroll']) {
                $scrollHeight = $attr['scrollheight']['Tablet'] ?? '300px'; 
                $css .= "max-height: $scrollHeight;";
            }

        $css .= "}";
        // Title specific styles
        $css .= "$title {";

            $css .= $OBJ_STYLE->dimensions('titlePadding','padding', 'Tablet');

            $css .= $OBJ_STYLE->borderRadiusShadow('titleBorder','titleBorderRadius','','Tablet');

            $css .= $OBJ_STYLE->typography('titletypography','Tablet');

            $align = !empty($attr['iconalignment']['Tablet']) ? $attr['iconalignment']['Tablet'] : 'center';
            $css .= "justify-content: {$align};";

            
            $margin = !empty($attr['spacing']['Tablet']) ? $attr['spacing']['Tablet'] : '0px';
            $css .= "margin-bottom: {$margin};";

        $css .= "}";

        $css .="$content{";

            $padding = $OBJ_STYLE->dimensions('contentPadding', 'padding', 'Tablet');

            if (trim($padding) !== 'padding: 0;' && trim($padding) !== '') {
                $css .= $padding;
            }

            $css .= $OBJ_STYLE->borderRadiusShadow('contentBorder','contentBorderRadius','','Tablet');

            $css .= $OBJ_STYLE->typography('contenttypography','Tablet');

            if ( isset( $attr['contentalignment']['Tablet'] ) ) {
                $css .= "text-align: " . esc_attr( $attr['contentalignment']['Tablet'] ) . ";";
            }

            $gap = !empty($attr['contentspacing']['Tablet']) ? $attr['contentspacing']['Tablet'] : '0px';
            $css .= "gap: {$gap};";

        $css .= "}";

        $css .= "$button {";
            if ( isset( $attr['iconsize']['Tablet'] ) && $attr['iconsize']['Tablet'] !== '' ) {
                $css .= "--icon-size: " . esc_attr( $attr['iconsize']['Tablet'] ) . ";";
            }

            $css .= $OBJ_STYLE->dimensions('iconPadding','padding', 'Tablet');

            $css .= $OBJ_STYLE->borderRadiusShadow('iconBorder','iconBorderRadius','iconDropShadow','Tablet');

        $css .= "}";
       
    $css .= "}";

    // 🔹 Mobile Media Query
    $css .= "@media (max-width: 767px) {";

        $css .= "$wrapper .vb-toc-wrapper {";
            if (isset($attr['scroll']) && $attr['scroll']) {
                $scrollHeight = $attr['scrollheight']['Mobile'] ?? '300px'; 
                $css .= "max-height: $scrollHeight;";
            }
        $css .= "}";
            
        // Title specific styles
        $css .= "$title {";

            $css .= $OBJ_STYLE->dimensions('titlePadding','padding', 'Mobile');

            $css .= $OBJ_STYLE->borderRadiusShadow('titleBorder','titleBorderRadius','','Mobile');

            $css .= $OBJ_STYLE->typography('titletypography','Mobile');

            $align = !empty($attr['iconalignment']['Mobile']) ? $attr['iconalignment']['Mobile'] : 'center';
            $css .= "justify-content: {$align};";

            $margin = !empty($attr['spacing']['Mobile']) ? $attr['spacing']['Mobile'] : '0px';
            $css .= "margin-bottom: {$margin};";

        $css .= "}";

        $css .="$content{";

            $padding = $OBJ_STYLE->dimensions('contentPadding', 'padding', 'Mobile');

            if (trim($padding) !== 'padding: 0;' && trim($padding) !== '') {
                $css .= $padding;
            }

            $css .= $OBJ_STYLE->borderRadiusShadow('contentBorder','contentBorderRadius','','Mobile');

            $css .= $OBJ_STYLE->typography('contenttypography','Mobile');

            if ( isset( $attr['contentalignment']['Mobile'] ) ) {
                $css .= "text-align: " . esc_attr( $attr['contentalignment']['Mobile'] ) . ";";
            }

            $gap = !empty($attr['contentspacing']['Mobile']) ? $attr['contentspacing']['Mobile'] : '0px';
            $css .= "gap: {$gap};";

        $css .= "}";
        
        $css .= "$button {";
            if ( isset( $attr['iconsize']['Mobile'] ) && $attr['iconsize']['Mobile'] !== '' ) {
                $css .= "--icon-size: " . esc_attr( $attr['iconsize']['Mobile'] ) . ";";
            }

            $css .= $OBJ_STYLE->dimensions('iconPadding','padding', 'Mobile');

            $css .= $OBJ_STYLE->borderRadiusShadow('iconBorder','iconBorderRadius','iconDropShadow','Mobile');

        $css .= "}";
       
    $css .= "}";

    return $css;
}