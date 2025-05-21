<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

function generate_inline_video_styles($attr) {

    $css = '';

    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);  
    $uniqueId = $attr['uniqueId'];

    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    $wrapper = '.vb-video-' . esc_attr($uniqueId);
    $inline = '.vb-video-container';

    $css .= $OBJ_STYLE->advanceStyle($wrapper);

    $css .= ".vayu_blocks_image_flip-duotone-filters {";
        $css .= "display: none;";
        $css .= "height: 0;";
    $css .= "}";

    // Effect 3 CSS rule
    $css .= "$wrapper .vayu_block_styling-effect3::after {";
        $css .= "background:" . esc_attr(isset($attr['animationData']['effect']['effectColor']) ? $attr['animationData']['effect']['effectColor'] : 'transparent') . ";";
        $css .= "box-shadow: 1rem 1rem 2rem " . esc_attr(isset($attr['animationData']['effect']['effectColor']) ? $attr['animationData']['effect']['effectColor'] : 'transparent') . ";";
    $css .= "}";

    // Effect 10 CSS rule
    $css .= "$wrapper .vayu_block_styling-effect10 {";
        $css .= "background:" . esc_attr(isset($attr['animationData']['effect']['effectColor']) ? $attr['animationData']['effect']['effectColor'] : 'transparent') . ";";
    $css .= "}";

    $css .= "$wrapper .vayu_block_styling-effect10 {";
        $effectColor = isset($attr['animationData']['effect']['effectColor']) ? esc_attr($attr['animationData']['effect']['effectColor']) : 'undefined';

        $css .= " box-shadow:
        1px 1px 0 1px {$effectColor},
        -1px 0 28px 0 rgba(34, 33, 81, 0.01),
        28px 28px 28px 0 rgba(34, 33, 81, 0.25) !important;";

    $css .= "}";

    $css .= "$wrapper .vayu_block_styling-effect10:hover {";
        $effectColor = isset($attr['animationData']['effect']['effectColor']) ? esc_attr($attr['animationData']['effect']['effectColor']) : 'transparent';

        $css .= " box-shadow:
        1px 1px 0 1px {$effectColor},
        -1px 0 28px 0 rgba(34, 33, 81, 0.01),
        54px 54px 28px -10px rgba(34, 33, 81, 0.15) !important;";

    $css .= "}";

    // Append CSS rules to $css
    $css .= "$wrapper $inline {";
        if ( isset($attr['imagealignment']) && is_array($attr['imagealignment']) && isset($attr['imagealignment']['Desktop']) ) {
            $css .= "justify-content: {$attr['imagealignment']['Desktop']} !important;";
        }
        $css .= "display: flex;";
        $css .= "height: 100%;";
        $css .= "width: 100%;";
        $css .= " position: relative;";
        $css .= " transition: transform 0.5s linear;";
        $css .= "perspective: 1000px;";
        $css .= "transform-style: preserve-3d;";
    $css .= "}";

    $css .= "$wrapper .vb-video-rotation{";
        $rotation = esc_attr($attr['rotation']) % 360; // This will ensure the value is within 0-359
        $css .= "transform: rotate( " . $rotation . "deg) !important;";
    $css .= "}";
    
    // Assuming $attr['imagetransitiontime'] contains the transition time value
    $transitionTime = isset($attr['imagetransitiontime']) ? esc_attr($attr['imagetransitiontime']) : '0.5'; // Default to 0.5s if not set

    // Append CSS rules to $css
    $css .= "$wrapper .vb-video-cont_image {";
        $css .= "    transition: transform {$transitionTime}s ease, filter {$transitionTime}s ease, opacity {$transitionTime}s ease;";
        $css .= "justify-content: center;";
        $css .= "display: flex;";
        $css .= "align-items: center;";
    
    $css .= "}";

    // Append CSS rules to $css
    $css .= "$wrapper .vb-video-iframe {";

        if (!empty($attr['animationData']['hovereffect']) && !empty($attr['animationData']['hovereffect']['value'])) {
            if ($attr['animationData']['hovereffect']['value'] === 'flip-front' || $attr['animationData']['hovereffect']['value']) {
                $css .= "backface-visibility: hidden;";
            }
        }

        if($attr['screenfit']==='screenfit'){
            $css .= "width: var(--screen-width);";
            $css .= "height: var(--screen-height);";
        }
        
        if (isset($attr['duotone']) && !empty($attr['duotone'])) {
            $css .= "    filter: url(#duotone-filter-{$attr['uniqueId']}) !important;";
        }   
        if (isset($attr['screenfit']) && $attr['screenfit'] === 'auto') {
            $aspectRatio = $attr['imageaspectratio']['Desktop'] ?? 'auto';
            $css .= "aspect-ratio: $aspectRatio;";
        }
        
        if (!empty($attr['frameData']['radius'])) {
            $radiusData = $attr['frameData']['radius']['Desktop'];
            
            if (!empty($radiusData['width'])) {
                // If a general width is set, apply it to all corners
                $css .= "border-radius: " . $radiusData['width'] . ";";
            } else {
                // Otherwise, check individual values and apply them
                $topLeft     = !empty($radiusData['top-left']) ? $radiusData['top-left'] : "0";
                $topRight    = !empty($radiusData['top-right']) ? $radiusData['top-right'] : "0";
                $bottomRight = !empty($radiusData['bottom-right']) ? $radiusData['bottom-right'] : "0";
                $bottomLeft  = !empty($radiusData['bottom-left']) ? $radiusData['bottom-left'] : "0";
        
                $css .= "border-radius: $topLeft $topRight $bottomRight $bottomLeft;";
            }
        }
        
        if (!empty($attr['imageboxShadow'])) {
            $css .= $OBJ_STYLE->borderRadiusShadow('', '', 'imageboxShadow', 'Desktop');
        }
        $css .= "display:inline-block;";

        if( $attr['screenfit'] != 'custom'){
            if (
                ($attr['blockValue'] != 'you-tube') && 
                !($attr['blockValue'] === 'you-tube' &&
                    !empty($attr['youtubeshorts']) &&
                    $attr['screenfit'] === 'custom'
                )
            ) {
                $css .= "width:100%;";
            }
        }

        if($attr['blockValue'] === 'you-tube' && $attr['screenfit'] === 'auto' && $attr['youtubeshorts']){
            $css .= "width:100%;";
        }
      

    $css .= "}";

    // Append hover effect CSS rules
    $css .= " $wrapper $inline:hover .vb-video-iframe {";
        $css .= "    transform: var(--image-hover-effect-transform, none);";
        $css .= "    filter: var(--image-filter-effect, none);";
        $css .= "    opacity: var(--image-hover-effect-opacity, 1);";
    $css .= "}";

    if ( isset($attr['imagealignment']) && is_array($attr['imagealignment']) && isset($attr['imagealignment']['Desktop']) ) {
        $css .= " $wrapper {";
            $css .= "justify-content: {$attr['imagealignment']['Desktop']} !important;";
        $css .= "}";
    }
    
    $css .= ".flip-front {";
        $css .= "  --image-hover-effect-transform: rotateY(180deg);";
    $css .= "}";

    $css .= ".flip-back {";
        $css .= "  --image-hover-effect-transform: rotateX(180deg);";
    $css .= "}";
        
    $css .= ".flip-front-left {";
        $css .= "  --image-hover-effect-transform: rotateY(-180deg);";
    $css .= "}";

    $css .= ".flip-back-bottom {";
        $css .= "  --image-hover-effect-transform: rotateX(-180deg);";
    $css .= "}";

    /* Grayscale */
    $css .= ".grayScale {";
        $css .= "    --image-filter-effect: grayscale(100%);";
    $css .= "}";

    /* Grayscale reverse hover */
    $css .= ".grayScalereverse {";
        $css .= "    filter: grayscale(100%) !important;";
        $css .= "    transition: filter " . esc_attr($attr['imagetransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".grayScalereverse:hover {";
        $css .= "filter: none;";
    $css .= "}";

    /* Sepia */
    $css .= ".sepia {";
        $css .= "    --image-filter-effect: sepia(100%);";
    $css .= "}";

    /* Zoom-in and Zoom-out effects */
    $css .= ".zoom-in {";
        $css .= "    --image-hover-effect-transform: scale(1.5);";
    $css .= "}";

    $css .= ".zoom-out {";
        $css .= "    --image-hover-effect-transform: scale(0.8);";
    $css .= "}";

    /* Fade-in and Fade-out effects */
    $css .= ".fade-in {";
        $css .= "    --image-hover-effect-opacity: 1;";
    $css .= "}";

    $css .= ".fade-out {";
        $css .= "    --image-hover-effect-opacity: 0.5;";
    $css .= "}";

    /* Slide effects */
    $css .= ".slide-up {";
        $css .= "    --image-hover-effect-transform: translateY(-10px);";
    $css .= "}";

    $css .= ".slide-down {";
        $css .= "    --image-hover-effect-transform: translateY(10px);";
    $css .= "}";

    $css .= ".slide-left {";
        $css .= "    --image-hover-effect-transform: translateX(-10px);";
    $css .= "}";

    $css .= ".slide-right {";
        $css .= "    --image-hover-effect-transform: translateX(10px);";
    $css .= "}";

    /* Flip effects */
    $css .= ".flip-horizontal {";
        $css .= "    --image-hover-effect-transform: rotateY(180deg);";
    $css .= "}";

    $css .= ".flip-vertical {";
        $css .= "    --image-hover-effect-transform: rotateX(180deg);";
    $css .= "}";

    /* Rotate */
    $css .= ".rotate {";
        $css .= "    --image-hover-effect-transform: rotate(-30deg);";
    $css .= "}";

    /* Blur */
    $css .= ".blur {";
        $css .= "    --image-filter-effect: blur(3px);";
    $css .= "}";

    /* Shine */
    $css .= ".shine {";
        $css .= "    --image-filter-effect: grayscale(100%);";
    $css .= "}";

    if($attr['overlayshow']){
        /* Hover the image and show the overlay */
        $css .= "$wrapper .vb-video-rotation:hover .vb-video-overlay-wrapper::before {";
                if($attr['overlayhvrcolor']){
                    $css .= "background: " . esc_attr($attr['overlayhvrcolor']) . " !important;";
                }
                $css .= "opacity: " . esc_attr($attr['overlayhvrcolor']) . " !important;";
        $css .= "}";
    }
    
    /* Overlay styles */
    $css .= "$wrapper .vb-video-overlay-wrapper {";
       
        $css .= "width: " . esc_attr($attr['overlaywidth']) . " !important;";
        $css .= "height: " . esc_attr($attr['overlayheight']) . "!important;";
        $css .= "position: absolute;";
        $css .= "top: " . esc_attr($attr['overlaytop']) . "!important;";
        $css .= "left: " . esc_attr($attr['overlayleft']) . "!important;";
        $css .= "transition: " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
        $css .= "opacity: 1; ";
        $css .= "overflow: hidden;";
        $css .= "z-index: 10;";
        $css .= "display: flex;";
        $css .= "pointer-events: none;";
        
        $css .= "box-sizing: border-box;";


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

       $css .= "$wrapper .vb-video-overlay-wrapper:after {";
        
        $css .= 'content: " ";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 10;';

        $css .= "-webkit-mask-image: radial-gradient(circle, white 100%, transparent 100%);";
        $css .= $OBJ_STYLE->borderFrame('frameData','Desktop');
        $css .= "-webkit-mask-image: radial-gradient(circle, white 100%, transparent 100%);";

    $css .= "}";

    $css .= "$wrapper .vb-video-overlay-wrapper:before {";
        if($attr['overlayshow']){
            $css .= "background-color: " . esc_attr($attr['overlaycolor']) . ";";
            $css .= "opacity: " . esc_attr($attr['overlayopacity']) . " !important;";
        }

        $css .= 'content: " ";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;  ';
    $css .= "}";

    if (!empty($attr['animationData']['mask']) && isset($attr['animationData']['mask']['maskshape'])) {
        // Determine the SVG based on the maskshape attribute
        switch (esc_attr($attr['animationData']['mask']['maskshape'])) {
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
        }else{
            $svg = '';
        }

    // Encode the SVG to Base64
    $svgBase64 = base64_encode($svg);

    // Create a Data URL
    $imagePath = "data:image/svg+xml;base64,{$svgBase64}";

    $css .= "$wrapper .maskshapeimage{";

        if($svgBase64){
            $css .= "mask-image: url($imagePath);";
            $css .= "-webkit-mask-image: url($imagePath);";
            $masksize = isset($attr['animationData']['mask']['masksize']) ? esc_attr($attr['animationData']['mask']['masksize']) : 'auto';
            $maskrepeat = isset($attr['animationData']['mask']['maskrepeat']) ? esc_attr($attr['animationData']['mask']['maskrepeat']) : 'no-repeat';
            $maskposition = isset($attr['animationData']['mask']['maskposition']) ? esc_attr($attr['animationData']['mask']['maskposition']) : 'center';
            
            $css .= "mask-size: {$masksize};";
            $css .= "-webkit-mask-size: {$masksize};";
            $css .= "mask-repeat: {$maskrepeat};";
            $css .= "-webkit-mask-repeat: {$maskrepeat};";
            $css .= "mask-position: {$maskposition};";
            $css .= "-webkit-mask-position: {$maskposition};";
        }

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
        if (!empty($attr['frameData']['radius'])) {
            $radiusData = $attr['frameData']['radius']['Desktop'];
            
            if (!empty($radiusData['width'])) {
                // If a general width is set, apply it to all corners
                $css .= "border-radius: " . $radiusData['width'] . ";";
            } else {
                // Otherwise, check individual values and apply them
                $topLeft     = !empty($radiusData['top-left']) ? $radiusData['top-left'] : "0";
                $topRight    = !empty($radiusData['top-right']) ? $radiusData['top-right'] : "0";
                $bottomRight = !empty($radiusData['bottom-right']) ? $radiusData['bottom-right'] : "0";
                $bottomLeft  = !empty($radiusData['bottom-left']) ? $radiusData['bottom-left'] : "0";
        
                $css .= "border-radius: $topLeft $topRight $bottomRight $bottomLeft;";
            }
        }
    $css .= "}";

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
    
    $css .= ".overlayzoom-in-up {";
        $css .= "transform: scale(0.5) translateY(-50%);";
        $css .= "opacity: 0;";
        $css .= "transition: transform " . esc_attr($attr['overlaytransitiontime']) . "s ease, opacity " . esc_attr($attr['overlaytransitiontime']) . "s ease;";
    $css .= "}";

    $css .= ".$inline:hover .overlayzoom-in-up {";
        $css .= "transform: scale(1) translateY(0);";
        $css .= "opacity: 1;";
    $css .= "}";

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

    $css .= "@media (max-width: 1024px) {";

        $css .= "$wrapper .vb-video-overlay-wrapper:after {";
            $css .= $OBJ_STYLE->borderFrame('frameData','Tablet');
        $css .= "}";

        $css .= "$wrapper $inline {";
            if ( isset($attr['imagealignment']) && is_array($attr['imagealignment']) && isset($attr['imagealignment']['Mobile']) ) {
                $css .= "justify-content: {$attr['imagealignment']['Mobile']} !important;";
            }
        $css .= "}";

        $css .= "$wrapper .vb-video-iframe {";

            if (!empty($attr['frameData']['radius'])) {
                $radiusData = $attr['frameData']['radius']['Mobile'];
                
                if (!empty($radiusData['width'])) {
                    // If a general width is set, apply it to all corners
                    $css .= "border-radius: " . $radiusData['width'] . ";";
                } else {
                    // Otherwise, check individual values and apply them
                    $topLeft     = !empty($radiusData['top-left']) ? $radiusData['top-left'] : "0";
                    $topRight    = !empty($radiusData['top-right']) ? $radiusData['top-right'] : "0";
                    $bottomRight = !empty($radiusData['bottom-right']) ? $radiusData['bottom-right'] : "0";
                    $bottomLeft  = !empty($radiusData['bottom-left']) ? $radiusData['bottom-left'] : "0";
            
                    $css .= "border-radius: $topLeft $topRight $bottomRight $bottomLeft;";
                }   
            }

            if (isset($attr['screenfit']) && $attr['screenfit'] === 'auto') {
                $aspectRatio = $attr['imageaspectratio']['Tablet'] ?? 'auto';
                $css .= "aspect-ratio: $aspectRatio;";
            }
        $css .= "}";

        

    $css .= "}";

    $css .= "@media (max-width: 400px) {";

        $css .= "$wrapper .vb-video-overlay-wrapper:after {";
            $css .= $OBJ_STYLE->borderFrame('frameData','Mobile');
        $css .= "}";

        $css .= "$wrapper $inline {";
            if ( isset($attr['imagealignment']) && is_array($attr['imagealignment']) && isset($attr['imagealignment']['Mobile']) ) {
                $css .= "justify-content: {$attr['imagealignment']['Mobile']} !important;";
            }
        $css .= "}";

        $css .= "$wrapper .vb-video-iframe {";

            if (isset($attr['screenfit']) && $attr['screenfit'] === 'auto') {
                $aspectRatio = $attr['imageaspectratio']['Mobile'] ?? 'auto';
                $css .= "aspect-ratio: $aspectRatio;";
            }

            if (!empty($attr['frameData']['radius'])) {
                $radiusData = $attr['frameData']['radius']['Mobile'];
                
                if (!empty($radiusData['width'])) {
                    // If a general width is set, apply it to all corners
                    $css .= "border-radius: " . $radiusData['width'] . ";";
                } else {
                    // Otherwise, check individual values and apply them
                    $topLeft     = !empty($radiusData['top-left']) ? $radiusData['top-left'] : "0";
                    $topRight    = !empty($radiusData['top-right']) ? $radiusData['top-right'] : "0";
                    $bottomRight = !empty($radiusData['bottom-right']) ? $radiusData['bottom-right'] : "0";
                    $bottomLeft  = !empty($radiusData['bottom-left']) ? $radiusData['bottom-left'] : "0";
            
                    $css .= "border-radius: $topLeft $topRight $bottomRight $bottomLeft;";
                }   
            }
        $css .= "}";

    $css .= "}";

    $css .= "@media (max-width: 1024px) {

        $wrapper .vb-video-overlay-wrapper  {

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

        $wrapper{
            justify-content:" . (isset($attr['imagealignment']['Tablet']) ? esc_attr($attr['imagealignment']['Tablet']) : 'auto') . ";
        }
            
        $wrapper .vb-video-overlay-wrapper{
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

    $css .= "@media (max-width: 400px) {

        $wrapper .vb-video-overlay-wrapper  {

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

        $wrapper{
            justify-content:" . (isset($attr['imagealignment']['Mobile']) ? esc_attr($attr['imagealignment']['Mobile']) : 'auto') . ";
        }

        $wrapper .vb-video-overlay-wrapper{
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