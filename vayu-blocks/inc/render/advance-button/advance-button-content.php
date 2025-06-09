<?php

function vayu_blocks_get_border_value($border, $side = 'top', $property = 'width') {
    if (!is_array($border) || !isset($border['Desktop'])) {
        return null;
    }

    // Mixed case
    if (isset($border['Desktop'][$side]) && is_array($border['Desktop'][$side]) && isset($border['Desktop'][$side][$property])) {
        return $border['Desktop'][$side][$property];
    }

    // Non-mixed case
    if (isset($border['Desktop'][$property])) {
        return $border['Desktop'][$property];
    }

    return null;
}

function vayu_blocks_advance_button_render( $attributes ) {
    
    $uniqueID = $attributes['uniqueID'] ?? '';
    $content = $attributes['content'] ?? 'Button';

    $url = $attributes['post']['url'] ?? '';
    $opensInNewTab = $attributes['post']['opensInNewTab'] ?? false;
    $markAsNofollow = $attributes['post']['markAsNofollow'] ?? false;

    $iconHTML = $attributes['iconCopy']; // Optional: render from $attributes['icon'] or $attributes['iconName']

    $btnBorder = $attributes['btnBorder'] ?? null;
    $btnBorderHover = $attributes['btnBorderHover'] ?? null;

    $buttonColor = $attributes['color'] ?? '';
    $hoverColor = $attributes['hoverColor'] ?? '';
    $bgColor = $attributes['btnBackground']['color'] ?? '';
    $bgGradient = $attributes['btnBackground']['gradient'] ?? '';
    $hoverBgColor = $attributes['btnBackgroundHover']['color'] ?? '';
    $hoverBgGradient = $attributes['btnBackgroundHover']['gradient'] ?? '';
    $animationClass = $attributes['advAnimation']['className'] ?? '';
    $effectClass = $attributes['animationData']['background']['value'] ?? 'none';
    $effectTrigger = $attributes['animationData']['background']['type'] ?? 'onhvr';

    $btnBorder_top_width = vayu_blocks_get_border_value($btnBorder, 'top', 'width');
    $btnBorder_top_color = vayu_blocks_get_border_value($btnBorder, 'top', 'color');
    $btnBorder_top_style = vayu_blocks_get_border_value($btnBorder, 'top', 'style');

    $btnBorder_right_width = vayu_blocks_get_border_value($btnBorder, 'right', 'width');
    $btnBorder_right_color = vayu_blocks_get_border_value($btnBorder, 'right', 'color');
    $btnBorder_right_style = vayu_blocks_get_border_value($btnBorder, 'right', 'style');

    $btnBorder_bottom_width = vayu_blocks_get_border_value($btnBorder, 'bottom', 'width');
    $btnBorder_bottom_color = vayu_blocks_get_border_value($btnBorder, 'bottom', 'color');
    $btnBorder_bottom_style = vayu_blocks_get_border_value($btnBorder, 'bottom', 'style');

    $btnBorder_left_width = vayu_blocks_get_border_value($btnBorder, 'left', 'width');
    $btnBorder_left_color = vayu_blocks_get_border_value($btnBorder, 'left', 'color');
    $btnBorder_left_style = vayu_blocks_get_border_value($btnBorder, 'left', 'style');

    //Border Hover
    $btnBorderHover_top_width = vayu_blocks_get_border_value($btnBorderHover, 'top', 'width');
    $btnBorderHover_top_color = vayu_blocks_get_border_value($btnBorderHover, 'top', 'color');
    $btnBorderHover_top_style = vayu_blocks_get_border_value($btnBorderHover, 'top', 'style');

    $btnBorderHover_right_width = vayu_blocks_get_border_value($btnBorderHover, 'right', 'width');
    $btnBorderHover_right_color = vayu_blocks_get_border_value($btnBorderHover, 'right', 'color');
    $btnBorderHover_right_style = vayu_blocks_get_border_value($btnBorderHover, 'right', 'style');

    $btnBorderHover_bottom_width = vayu_blocks_get_border_value($btnBorderHover, 'bottom', 'width');
    $btnBorderHover_bottom_color = vayu_blocks_get_border_value($btnBorderHover, 'bottom', 'color');
    $btnBorderHover_bottom_style = vayu_blocks_get_border_value($btnBorderHover, 'bottom', 'style');

    $btnBorderHover_left_width = vayu_blocks_get_border_value($btnBorderHover, 'left', 'width');
    $btnBorderHover_left_color = vayu_blocks_get_border_value($btnBorderHover, 'left', 'color');
    $btnBorderHover_left_style = vayu_blocks_get_border_value($btnBorderHover, 'left', 'style');
    

    // Button styles as inline CSS variables
    $styleVars = [
        '--animation-box-button' => $attributes['animationData']['background']['bg'] ?? '',
        '--button-color' => $buttonColor,
        '--button-hvr-color' => $hoverColor,
        '--button-background' => $bgColor,
        '--button-gradient' => $bgGradient,
        '--button-hvr-background' => $hoverBgColor,
        '--button-hvr-gradient' => $hoverBgGradient,

        '--btnBorder-top-width' => $btnBorder_top_width,
        '--btnBorder-top-color' => $btnBorder_top_color,
        '--btnBorder-top-style' => $btnBorder_top_style,

        '--btnBorder-right-width' => $btnBorder_right_width,
        '--btnBorder-right-color' => $btnBorder_right_color,
        '--btnBorder-right-style' => $btnBorder_right_style,

        '--btnBorder-bottom-width' => $btnBorder_bottom_width,
        '--btnBorder-bottom-color' => $btnBorder_bottom_color,
        '--btnBorder-bottom-style' => $btnBorder_bottom_style,

        '--btnBorder-left-width' => $btnBorder_left_width,
        '--btnBorder-left-color' => $btnBorder_left_color,
        '--btnBorder-left-style' => $btnBorder_left_style,

        '--btnBorderHover-top-width' => $btnBorderHover_top_width,
        '--btnBorderHover-top-color' => $btnBorderHover_top_color,
        '--btnBorderHover-top-style' => $btnBorderHover_top_style,

        '--btnBorderHover-right-width' => $btnBorderHover_right_width,
        '--btnBorderHover-right-color' => $btnBorderHover_right_color,
        '--btnBorderHover-right-style' => $btnBorderHover_right_style,

        '--btnBorderHover-bottom-width' => $btnBorderHover_bottom_width,
        '--btnBorderHover-bottom-color' => $btnBorderHover_bottom_color,
        '--btnBorderHover-bottom-style' => $btnBorderHover_bottom_style,

        '--btnBorderHover-left-width' => $btnBorderHover_left_width,
        '--btnBorderHover-left-color' => $btnBorderHover_left_color,
        '--btnBorderHover-left-style' => $btnBorderHover_left_style,
        
        
    ];

    $styleInline = '';
    foreach ( $styleVars as $key => $val ) {
        if ( ! empty( $val ) ) {
            $styleInline .= $key . ':' . esc_attr( $val ) . ';';
        }
    }

    $buttonClasses = implode( ' ', array_filter([
        'th-button',
        'th-button-inside',
        $animationClass,
        $effectClass !== 'none' ? $effectClass : '',
        "effect-trigger-$effectTrigger"
    ]));

    $iconToggle = $attributes['iconToggle'] ?? false;


    $textContent = esc_html( $content );
    $textSpan = "<span class='vayu-btn-text'>{$textContent}</span>";

    $iconSpan = $iconToggle ? "<span class='vayu-icon'>{$iconHTML}</span>" : '';

    $innerButton = $iconSpan . $textSpan;

    // Use <a> or <div>
    $buttonElement = '';
    if ( ! empty( $url ) ) {
        $target = $opensInNewTab ? ' target="_blank"' : '';
        $rel = $markAsNofollow ? ' rel="nofollow noreferrer noopener"' : '';
        $buttonElement = "<a href=\"" . esc_url( $url ) . "\" class=\"$buttonClasses\" style=\"$styleInline\"$target$rel>$innerButton</a>";
    } else {
        $buttonElement = "<div class=\"$buttonClasses\" style=\"$styleInline\">$innerButton</div>";
    }

    return "<div class=\"th-button-wrapper{$uniqueID}\">{$buttonElement}</div>";
}
