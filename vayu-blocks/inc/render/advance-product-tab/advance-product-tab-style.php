<?php 

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

function vayu_advance_product_tab_style($attr){ 

	$css = '';

    if(isset( $attr['uniqueId'] )){

        if (isset($attr['productCol'])) {

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-item-wrap{";
            
        $css .= "grid-template-columns:repeat({$attr['productCol']},minmax(0, 1fr))";

        $css .= "}";

        }

        //tab

        $showTab = isset($attr['showTab']) ? $attr['showTab'] : true;
        if($showTab):
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs{";
        $css .= isset( $attr['tabAlign'] ) ? "justify-content:{$attr['tabAlign'] };" : 'justify-content:center;';
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li{";
        $css .= isset( $attr['tabColor'] ) ? "color:{$attr['tabColor'] };" : 'color:#111;';
        $css .= isset( $attr['tabBgColor'] ) ? "background:{$attr['tabBgColor'] };" : 'background:transparent;';
       
        //tabborder-width
		if (isset($attr['tabBorderTopBorder'])) {
			$borderType = $attr['tabBorderTopborderType'] ?? 'solid';
			$css .= "border-top: {$attr['tabBorderTopBorder']} {$borderType} {$attr['tabBorderTopBorderColor']}; ";
		}
		if (isset($attr['tabBorderBottomBorder'])) {
			$borderType = $attr['tabBorderBottomborderType'] ?? 'solid';
			$css .= "border-bottom: {$attr['tabBorderBottomBorder']} {$borderType} {$attr['tabBorderBottomBorderColor']}; ";
		}
		if (isset($attr['tabBorderRightBorder'])) {
			$borderType = $attr['tabBorderRightborderType'] ?? 'solid';
			$css .= "border-right: {$attr['tabBorderRightBorder']} {$borderType} {$attr['tabBorderRightBorderColor']}; ";
		}
		if (isset($attr['tabBorderLeftBorder'])) {
			$borderType = $attr['tabBorderLeftborderType'] ?? 'solid';
			$css .= "border-left: {$attr['tabBorderLeftBorder']} {$borderType} {$attr['tabBorderLeftBorderColor']}; ";
		}
        //tabBorder-radius
		//border-radius
		if (isset($attr['tabBorderRadius']) && is_array($attr['tabBorderRadius'])) {
            // Check for null explicitly and only default empty or missing values
            $tabRadiusTop = (isset($attr['tabBorderRadius']['top']) && $attr['tabBorderRadius']['top'] !== null) ? $attr['tabBorderRadius']['top'] : '0px';
            $tabRadiusRight = (isset($attr['tabBorderRadius']['right']) && $attr['tabBorderRadius']['right'] !== null) ? $attr['tabBorderRadius']['right'] : '0px';
            $tabRadiusBottom = (isset($attr['tabBorderRadius']['bottom']) && $attr['tabBorderRadius']['bottom'] !== null) ? $attr['tabBorderRadius']['bottom'] : '0px';
            $tabRadiusLeft = (isset($attr['tabBorderRadius']['left']) && $attr['tabBorderRadius']['left'] !== null) ? $attr['tabBorderRadius']['left'] : '0px';
            $css .= "border-radius: {$tabRadiusTop} {$tabRadiusRight} {$tabRadiusLeft} {$tabRadiusBottom}; ";
        }
        
        //tabPadding
		//padding
		if (isset($attr['tabPadding']) && is_array($attr['tabPadding'])) {
            // Check for null explicitly and only default empty or missing values
            $paddingTop = (isset($attr['tabPadding']['top']) && $attr['tabPadding']['top'] !== null) ? $attr['tabPadding']['top'] : '0px';
            $paddingRight = (isset($attr['tabPadding']['right']) && $attr['tabPadding']['right'] !== null) ? $attr['tabPadding']['right'] : '0px';
            $paddingBottom = (isset($attr['tabPadding']['bottom']) && $attr['tabPadding']['bottom'] !== null) ? $attr['tabPadding']['bottom'] : '0px';
            $paddingLeft = (isset($attr['tabPadding']['left']) && $attr['tabPadding']['left'] !== null) ? $attr['tabPadding']['left'] : '0px';
            // Append the padding to the CSS string
            $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";	
        } 

        //tabMargin
		if (isset($attr['tabMargin']) && is_array($attr['tabMargin'])) {
            // Check for null explicitly and only default empty or missing values
            $tabMarginTop = (isset($attr['tabMargin']['top']) && $attr['tabMargin']['top'] !== null) ? $attr['tabMargin']['top'] : '0px';
            $tabMarginRight = (isset($attr['tabMargin']['right']) && $attr['tabMargin']['right'] !== null) ? $attr['tabMargin']['right'] : '0px';
            $tabMarginBottom = (isset($attr['tabMargin']['bottom']) && $attr['tabMargin']['bottom'] !== null) ? $attr['tabMargin']['bottom'] : '0px';
            $tabMarginLeft = (isset($attr['tabMargin']['left']) && $attr['tabMargin']['left'] !== null) ? $attr['tabMargin']['left'] : '0px';
            // Append the margin to the CSS string
            $css .= "margin: {$tabMarginTop} {$tabMarginRight} {$tabMarginBottom} {$tabMarginLeft};\n";	
        }
        

        // tab typography
        
        $css .= "font-family: " . (isset($attr['tabfontFamily']) ? $attr['tabfontFamily'] : 'inherit') . ';';
        $css .= "font-weight: " . (isset($attr['tabfontVariant']) ? $attr['tabfontVariant'] : 'inherit') . ';';
        $css .= "font-style: " . (isset($attr['tabfontStyle']) ? $attr['tabfontStyle'] : 'normal') . ';';
        $css .= "text-transform: " . (isset($attr['tabtextTransform']) ? $attr['tabtextTransform'] : 'none') . ';';

        // Font Size
		if (isset($attr['tabfontSize'])) {
			$tabfontSizeUnit = isset($attr['tabfontSizeUnit']) ? $attr['tabfontSizeUnit'] : 'px';
			$css .= "font-size: {$attr['tabfontSize']}{$tabfontSizeUnit}; ";
		}
		// Line Height
		if (isset($attr['tablineHeight'])) {
			$tablineHeightUnit = isset($attr['tablineHeightUnit']) ? $attr['tablineHeightUnit'] : 'px';
			$css .= "line-height: {$attr['tablineHeight']}{$tablineHeightUnit}; ";
		}
		// Letter Spacing
		if (isset($attr['tabletterSpacing'])) {
			$tabletterSpacingUnit = isset($attr['tabletterSpacingUnit']) ? $attr['tabletterSpacingUnit'] : 'px';
			$css .= "letter-spacing: {$attr['tabletterSpacing']}{$tabletterSpacingUnit}; ";
		}

        
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li:hover,.wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li.active{";
        $css .= isset( $attr['tabColorHvr'] ) ? "color:{$attr['tabColorHvr'] };" : '';
        $css .= isset( $attr['tabBgColorHvr'] ) ? "background:{$attr['tabBgColorHvr'] };" : '';
        $css .= isset( $attr['tabBorderColorHvr'] ) ? "border-color:{$attr['tabBorderColorHvr'] };" : '';
        $css .= "}";
        endif;

        //product box
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item{";
        $css .= isset( $attr['productAlign'] ) ? "text-align:{$attr['productAlign'] };" : 'text-align:center;';
        $css .= "}";
        
        // product-box-padding
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap{";
        if (isset($attr['productPadding']) && is_array($attr['productPadding'])){
			// Check for null explicitly and only default empty or missing values
			$paddingTop = (isset($attr['productPadding']['top']) && $attr['productPadding']['top'] !== null) ? $attr['productPadding']['top'] : '0px';
			$paddingRight = (isset($attr['productPadding']['right']) && $attr['productPadding']['right'] !== null) ? $attr['productPadding']['right'] : '0px';
			$paddingBottom = (isset($attr['productPadding']['bottom']) && $attr['productPadding']['bottom'] !== null) ? $attr['productPadding']['bottom'] : '0px';
			$paddingLeft = (isset($attr['productPadding']['left']) && $attr['productPadding']['left'] !== null) ? $attr['productPadding']['left'] : '0px';
			// Append the padding to the CSS string
			$css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";	
		} 
         // product-box-border-radius
         if (isset($attr['productboxRadius']) && is_array($attr['productboxRadius'])) {
            // Check for null explicitly and only default empty or missing values
            $productboxRadiusTop = (isset($attr['productboxRadius']['top']) && $attr['productboxRadius']['top'] !== null) ? $attr['productboxRadius']['top'] : '0px';
            $productboxRadiusRight = (isset($attr['productboxRadius']['right']) && $attr['productboxRadius']['right'] !== null) ? $attr['productboxRadius']['right'] : '0px';
            $productboxRadiusBottom = (isset($attr['productboxRadius']['bottom']) && $attr['productboxRadius']['bottom'] !== null) ? $attr['productboxRadius']['bottom'] : '0px';
            $productboxRadiusLeft = (isset($attr['productboxRadius']['left']) && $attr['productboxRadius']['left'] !== null) ? $attr['productboxRadius']['left'] : '0px';
            $css .= "border-radius: {$productboxRadiusTop} {$productboxRadiusRight} {$productboxRadiusLeft} {$productboxRadiusBottom}; ";
        }

        //border
		if (isset($attr['productboxTopBorder'])) {
			$borderType = $attr['productboxTopborderType'] ?? 'solid';
			$css .= "border-top: {$attr['productboxTopBorder']} {$borderType} {$attr['productboxTopBorderColor']}; ";
		}
		if (isset($attr['productboxBottomBorder'])) {
			$borderType = $attr['productboxBottomborderType'] ?? 'solid';
			$css .= "border-bottom: {$attr['productboxBottomBorder']} {$borderType} {$attr['productboxBottomBorderColor']}; ";
		}
		if (isset($attr['productboxRightBorder'])) {
			$borderType = $attr['productboxRightborderType'] ?? 'solid';
			$css .= "border-right: {$attr['productboxRightBorder']} {$borderType} {$attr['productboxRightBorderColor']}; ";
		}
		if (isset($attr['productboxLeftBorder'])) {
			$borderType = $attr['productboxLeftborderType'] ?? 'solid';
			$css .= "border-left: {$attr['productboxLeftBorder']} {$borderType} {$attr['productboxLeftBorderColor']}; ";
		}
        
        //bg color
        $css .= isset( $attr['productboxClr'] ) ? "background:{$attr['productboxClr'] };" : '';
        
        //box shadow

        if (isset($attr['boxShadow'])){
			$css .= "box-shadow: ". (isset($attr['boxShadowHorizontal']) ? $attr['boxShadowHorizontal'] : '0') ."px  ". (isset($attr['boxShadowVertical']) ? $attr['boxShadowVertical'] : '0') ."px ". (isset($attr['boxShadowBlur']) ? $attr['boxShadowBlur'] : '5') ."px ". (isset($attr['boxShadowSpread']) ? $attr['boxShadowSpread'] : '1') ."px  ". vayu_hex2rgba((isset($attr['boxShadowColor']) ? $attr['boxShadowColor'] : '#fff'), (isset($attr['boxShadowColorOpacity']) ? $attr['boxShadowColorOpacity'] : '50') ) .";";
		}

        $css .= "}";

        //gap
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-block-product-item-wrap{";
        $elementGap = isset($attr['elementGap']) ? $attr['elementGap'] : 20;
        $elementGapUnit = isset($attr['elementGapUnit']) ? $attr['elementGapUnit'] : 'px';
        $css .= "grid-row-gap: {$elementGap}{$elementGapUnit};";
        $css .= "grid-column-gap: {$elementGap}{$elementGapUnit};";
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap:hover{";
        $css .= isset( $attr['productboxHvrClr'] ) ? "background:{$attr['productboxHvrClr'] };" : '';
        $css .= "}"; 
        
        if(isset( $attr['catTxtColor'] )):
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-cat a{";
        $css .= "color:{$attr['catTxtColor']}";
        $css .= "}";
        endif;

        if(isset( $attr['catTxtColorHvr'] )):
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-cat a:hover{";
        $css .= "color:{$attr['catTxtColorHvr']}";
        $css .= "}";
        endif;

        if(isset( $attr['productTitleColor'] )):
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-title a{";
            $css .= "color:{$attr['productTitleColor']}";
            $css .= "}";
            endif;
    
            if(isset( $attr['productTitleColorHvr'] )):
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-title a:hover{";
            $css .= "color:{$attr['productTitleColorHvr']}";
            $css .= "}";
            endif;

            if(isset( $attr['priceColor'] )):
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-item .th-product-price span{";
                $css .= "color:{$attr['priceColor']}";
                $css .= "}";
                endif;
        
            if(isset( $attr['priceDelColor'] )):
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-price del,.wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-price del span{";
                $css .= "color:{$attr['priceDelColor']}";
                $css .= "}";
                endif;

        //rating

        if(isset( $attr['ratingColor'] )):
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-rating.woocommerce .star-rating{";
            $css .= "color:{$attr['ratingColor']}";
            $css .= "}";
            endif;

        //button

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-add-btn a{";
        $css .= isset( $attr['buttonTxtClr'] ) ? "color:{$attr['buttonTxtClr'] };" : 'color:#fff;';
        $css .= isset( $attr['buttonBgClr'] ) ? "background:{$attr['buttonBgClr'] };" : '';

        if (isset($attr['buttonTopBorder'])) {
        $borderType = $attr['buttonTopborderType'] ?? 'solid';
        $css .= "border-top: {$attr['buttonTopBorder']} {$borderType} {$attr['buttonTopBorderColor']}; ";
        }
        if (isset($attr['buttonBottomBorder'])) {
            $borderType = $attr['buttonBottomborderType'] ?? 'solid';
            $css .= "border-bottom: {$attr['buttonBottomBorder']} {$borderType} {$attr['buttonBottomBorderColor']}; ";
        }
        if (isset($attr['buttonRightBorder'])) {
            $borderType = $attr['buttonRightborderType'] ?? 'solid';
            $css .= "border-right: {$attr['buttonRightBorder']} {$borderType} {$attr['buttonRightBorderColor']}; ";
        }
        if (isset($attr['buttonLeftBorder'])) {
            $borderType = $attr['buttonLeftborderType'] ?? 'solid';
            $css .= "border-left: {$attr['buttonLeftBorder']} {$borderType} {$attr['buttonLeftBorderColor']}; ";
        }

        //Border-radius
		if (isset($attr['buttonRadius']) && is_array($attr['buttonRadius'])) {
            // Check for null explicitly and only default empty or missing values
            $buttonRadiusTop = (isset($attr['buttonRadius']['top']) && $attr['buttonRadius']['top'] !== null) ? $attr['buttonRadius']['top'] : '0px';
            $buttonRadiusRight = (isset($attr['buttonRadius']['right']) && $attr['buttonRadius']['right'] !== null) ? $attr['buttonRadius']['right'] : '0px';
            $buttonRadiusBottom = (isset($attr['buttonRadius']['bottom']) && $attr['buttonRadius']['bottom'] !== null) ? $attr['buttonRadius']['bottom'] : '0px';
            $buttonRadiusLeft = (isset($attr['buttonRadius']['left']) && $attr['buttonRadius']['left'] !== null) ? $attr['buttonRadius']['left'] : '0px';
            $css .= "border-radius: {$buttonRadiusTop} {$buttonRadiusRight} {$buttonRadiusLeft} {$buttonRadiusBottom}; ";
        }
        //buttonSpacing
        if (isset($attr['buttonSpacePadding']) && is_array($attr['buttonSpacePadding'])) {
            // Check for null explicitly and only default empty or missing values
            $paddingTop = (isset($attr['buttonSpacePadding']['top']) && $attr['buttonSpacePadding']['top'] !== null) ? $attr['buttonSpacePadding']['top'] : '0px';
            $paddingRight = (isset($attr['buttonSpacePadding']['right']) && $attr['buttonSpacePadding']['right'] !== null) ? $attr['buttonSpacePadding']['right'] : '0px';
            $paddingBottom = (isset($attr['buttonSpacePadding']['bottom']) && $attr['buttonSpacePadding']['bottom'] !== null) ? $attr['buttonSpacePadding']['bottom'] : '0px';
            $paddingLeft = (isset($attr['buttonSpacePadding']['left']) && $attr['buttonSpacePadding']['left'] !== null) ? $attr['buttonSpacePadding']['left'] : '0px';
            // Append the padding to the CSS string
            $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";
        }
        
        
        $css .= "}";

        

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-add-btn a:hover{";
        $css .= isset( $attr['buttonTxtClrHvr'] ) ? "color:{$attr['buttonTxtClrHvr'] };" : '';
        $css .= isset( $attr['buttonBgClrHvr'] ) ? "background:{$attr['buttonBgClrHvr'] };" : '';
        $css .= isset( $attr['buttonBrdrClrHvr'] ) ? "border-color:{$attr['buttonBrdrClrHvr'] };" : '';
        $css .= "}";

        //padding
         $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-wrapper{";
         if (isset($attr['padding']) && is_array($attr['padding'])) {
            // Check for null explicitly and only default empty or missing values
            $paddingTop = (isset($attr['padding']['top']) && $attr['padding']['top'] !== null) ? $attr['padding']['top'] : '0px';
            $paddingRight = (isset($attr['padding']['right']) && $attr['padding']['right'] !== null) ? $attr['padding']['right'] : '0px';
            $paddingBottom = (isset($attr['padding']['bottom']) && $attr['padding']['bottom'] !== null) ? $attr['padding']['bottom'] : '0px';
            $paddingLeft = (isset($attr['padding']['left']) && $attr['padding']['left'] !== null) ? $attr['padding']['left'] : '0px';
            // Append the padding to the CSS string
            $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";
        }
         $css .= "}";

         //margin
         $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-wrapper{";
                if (isset($attr['margin']) && is_array($attr['margin'])) {
                    // Check for null explicitly and only default empty or missing values
                    $marginTop = (isset($attr['margin']['top']) && $attr['margin']['top'] !== null) ? $attr['margin']['top'] : '0px';
                    $marginRight = (isset($attr['margin']['right']) && $attr['margin']['right'] !== null) ? $attr['margin']['right'] : '0px';
                    $marginBottom = (isset($attr['margin']['bottom']) && $attr['margin']['bottom'] !== null) ? $attr['margin']['bottom'] : '0px';
                    $marginLeft = (isset($attr['margin']['left']) && $attr['margin']['left'] !== null) ? $attr['margin']['left'] : '0px';
                    // Append the margin to the CSS string
                    $css .= "margin: {$marginTop} {$marginRight} {$marginBottom} {$marginLeft};\n";
                }
        
         $css .= "}";


        if(isset($attr['widthType']) && 'inlinewidth' === $attr['widthType'] ){
            
            
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}{";
            $css .= "display: inline-flex;";
            $css .= "}";
    

        }
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}{";
        //background
        if ( isset( $attr['backgroundType'] ) && $attr['backgroundType'] == 'image' ) {
        
			$css .= isset( $attr['backgroundImage']['url'] ) ? "background-image: url({$attr['backgroundImage']['url']});" : '';
			$css .= isset( $attr['backgroundAttachment']) ? "background-attachment: {$attr['backgroundAttachment']};" : 'background-attachment:scroll;';
			$css .= isset( $attr['backgroundRepeat']) ? "background-repeat: {$attr['backgroundRepeat']};" : 'background-repeat:repeat;';
			$css .= isset( $attr['backgroundSize']) ? "background-size: {$attr['backgroundSize']};" : 'background-size:auto;';
			$css .= isset($attr['backgroundPosition']) ? "background-position-x: " . ($attr['backgroundPosition']['x'] * 100) . "%; background-position-y: " . ($attr['backgroundPosition']['y'] * 100) . "%;" : '';
		}elseif( isset( $attr['backgroundType'] ) && $attr['backgroundType'] == 'gradient' ){
			$css .= isset( $attr['backgroundGradient'] ) ? "background-image:{$attr['backgroundGradient']};" : 'background-image:linear-gradient(90deg,rgba(54,209,220,1) 0%,rgba(91,134,229,1) 100%)';  
		}else{
			$css .= isset( $attr['backgroundColor'] ) ? "background-color:{$attr['backgroundColor']};" : '';
		}
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}:hover{";
            //hvr background
            if ( isset( $attr['backgroundTypeHvr'] ) && $attr['backgroundTypeHvr'] == 'image' ) {
                    $css .= isset( $attr['backgroundImageHvr']['url'] ) ? "background-image: url({$attr['backgroundImageHvr']['url']});" : '';
                    $css .= isset( $attr['backgroundAttachmentHvr']) ? "background-attachment: {$attr['backgroundAttachmentHvr']};" : '';
                    $css .= isset( $attr['backgroundRepeatHvr']) ? "background-repeat: {$attr['backgroundRepeatHvr']};" : '';
                    $css .= isset( $attr['backgroundSizeHvr']) ? "background-size: {$attr['backgroundSizeHvr']};" : '';
                    $css .= isset( $attr['backgroundPositionHvr']) ? "background-position-x: {$attr['backgroundPositionHvr']['x']}%; background-position-y: {$attr['backgroundPositionHvr']['y']}%;" : '';
            }
            elseif( isset( $attr['backgroundTypeHvr'] ) && $attr['backgroundTypeHvr'] == 'gradient' ){
                    $css .= isset( $attr['backgroundGradientHvr'] ) ? "background-image:{$attr['backgroundGradientHvr']};" : '';  
            }else{
                    $css .= isset( $attr['backgroundColorHvr'] ) ? "background-color:{$attr['backgroundColorHvr']};" : '';
            }
        $css .= "}";    
        // overlay
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .wp-block-th-blocks-overlay{";
            if ( isset( $attr['overlaybackgroundType'] ) && $attr['overlaybackgroundType'] == 'image' ) {
                $css .= isset( $attr['overlaybackgroundImage']['url'] ) ? "background-image: url({$attr['overlaybackgroundImage']['url']});" : '';
                $css .= isset( $attr['overlaybackgroundAttachment']) ? "background-attachment: {$attr['overlaybackgroundAttachment']};" : 'background-attachment:scroll;';
                $css .= isset( $attr['overlaybackgroundRepeat']) ? "background-repeat: {$attr['overlaybackgroundRepeat']};" : 'background-repeat:repeat;';
                $css .= isset( $attr['overlaybackgroundSize']) ? "background-size: {$attr['overlaybackgroundSize']};" : 'background-size:auto;';
                $css .= isset($attr['overlaybackgroundPosition']) ? "background-position-x: " . ($attr['overlaybackgroundPosition']['x'] * 100) . "%; background-position-y: " . ($attr['overlaybackgroundPosition']['y'] * 100) . "%;" : '';
            }elseif( isset( $attr['overlaybackgroundType'] ) && $attr['overlaybackgroundType'] == 'gradient' ){
                $css .= isset( $attr['overlaybackgroundGradient'] ) ? "background-image:{$attr['overlaybackgroundGradient']};" : '';  
            }else{
                $css .= isset( $attr['overlaybackgroundColor'] ) ? "background-color:{$attr['overlaybackgroundColor']};" : '';
            }
         $css .= "}";

         // overlay hover
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}:hover .wp-block-th-blocks-container-overlay{";
            if ( isset( $attr['overlaybackgroundTypeHvr'] ) && $attr['overlaybackgroundTypeHvr'] == 'image' ) {
                $css .= isset( $attr['overlaybackgroundImageHvr']['url'] ) ? "background-image: url({$attr['overlaybackgroundImageHvr']['url']});" : '';
                $css .= isset( $attr['overlaybackgroundAttachmentHvr']) ? "background-attachment: {$attr['overlaybackgroundAttachmentHvr']};" : 'background-attachment:scroll;';
                $css .= isset( $attr['overlaybackgroundRepeatHvr']) ? "background-repeat: {$attr['overlaybackgroundRepeatHvr']};" : 'background-repeat:repeat;';
                $css .= isset( $attr['overlaybackgroundSizeHvr']) ? "background-size: {$attr['overlaybackgroundSizeHvr']};" : 'background-size:auto;';
                $css .= isset($attr['overlaybackgroundPositionHvr']) ? "background-position-x: " . ($attr['overlaybackgroundPositionHvr']['x'] * 100) . "%; background-position-y: " . ($attr['overlaybackgroundPositionHvr']['y'] * 100) . "%;" : '';
			}elseif( isset( $attr['overlaybackgroundTypeHvr'] ) && $attr['overlaybackgroundTypeHvr'] == 'gradient' ){
                $css .= isset( $attr['overlaybackgroundGradientHvr'] ) ? "background-image:{$attr['overlaybackgroundGradientHvr']};" : '';  
            }else{
                $css .= isset( $attr['overlaybackgroundColorHvr'] ) ? "background-color:{$attr['overlaybackgroundColorHvr']};" : '';
            }
        $css .= "}";

        //transition duration
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}{";
		$css .= "transition: all ". (isset($attr['transitionAll']) ? $attr['transitionAll'] : '0.2' ). "s ease;";
        $css .= "}";

        // typography
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-cat{";
        
        $css .= "font-family: " . (isset($attr['catfontFamily']) ? $attr['catfontFamily'] : 'inherit') . ';';
        $css .= "font-weight: " . (isset($attr['catfontVariant']) ? $attr['catfontVariant'] : 'inherit') . ';';
        $css .= "font-style: " . (isset($attr['catfontStyle']) ? $attr['catfontStyle'] : 'normal') . ';';
        $css .= "text-transform: " . (isset($attr['cattextTransform']) ? $attr['cattextTransform'] : 'none') . ';';

        // Font Size
        if (isset($attr['catfontSize'])) {
            $catfontSizeUnit = isset($attr['catfontSizeUnit']) ? $attr['catfontSizeUnit'] : 'px';
            $css .= "font-size: {$attr['catfontSize']}{$catfontSizeUnit}; ";
        }
        // Line Height
        if (isset($attr['catlineHeight'])) {
            $catlineHeightUnit = isset($attr['catlineHeightUnit']) ? $attr['catlineHeightUnit'] : 'px';
            $css .= "line-height: {$attr['catlineHeight']}{$catlineHeightUnit}; ";
        }

        // Letter Spacing
        if (isset($attr['catletterSpacing'])) {
            $catletterSpacingUnit = isset($attr['catletterSpacingUnit']) ? $attr['catletterSpacingUnit'] : 'px';
            $css .= "letter-spacing: {$attr['catletterSpacing']}{$catletterSpacingUnit}; ";
        }
        $css .= "}";

        // typography
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-title a{";
            $css .= "font-family: " . (isset($attr['titlefontFamily']) ? $attr['titlefontFamily'] : 'inherit') . ';';
            $css .= "font-weight: " . (isset($attr['titlefontVariant']) ? $attr['titlefontVariant'] : 'inherit') . ';';
            $css .= "font-style: " . (isset($attr['titlefontStyle']) ? $attr['titlefontStyle'] : 'normal') . ';';
            $css .= "text-transform: " . (isset($attr['titletextTransform']) ? $attr['titletextTransform'] : 'none') . ';';
            // Font Size
            if (isset($attr['titlefontSize'])) {
                $titlefontSizeUnit = isset($attr['titlefontSizeUnit']) ? $attr['titlefontSizeUnit'] : 'px';
                $css .= "font-size: {$attr['titlefontSize']}{$titlefontSizeUnit}; ";
            }
            // Line Height
            if (isset($attr['titlelineHeight'])) {
                $titlelineHeightUnit = isset($attr['titlelineHeightUnit']) ? $attr['titlelineHeightUnit'] : 'px';
                $css .= "line-height: {$attr['titlelineHeight']}{$titlelineHeightUnit}; ";
            }
    
            // Letter Spacing
            if (isset($attr['titleletterSpacing'])) {
                $titleletterSpacingUnit = isset($attr['titleletterSpacingUnit']) ? $attr['titleletterSpacingUnit'] : 'px';
                $css .= "letter-spacing: {$attr['titleletterSpacing']}{$titleletterSpacingUnit}; ";
            }
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-price span{";
            $css .= "font-family: " . (isset($attr['pricefontFamily']) ? $attr['pricefontFamily'] : 'inherit') . ';';
            $css .= "font-weight: " . (isset($attr['pricefontVariant']) ? $attr['pricefontVariant'] : 'inherit') . ';';
            $css .= "font-style: " . (isset($attr['pricefontStyle']) ? $attr['pricefontStyle'] : 'normal') . ';';
            $css .= "text-transform: " . (isset($attr['pricetextTransform']) ? $attr['pricetextTransform'] : 'none') . ';';
            // Font Size
            if (isset($attr['pricefontSize'])) {
                $pricefontSizeUnit = isset($attr['pricefontSizeUnit']) ? $attr['pricefontSizeUnit'] : 'px';
                $css .= "font-size: {$attr['pricefontSize']}{$pricefontSizeUnit}; ";
            }
            // Line Height
            if (isset($attr['pricelineHeight'])) {
                $pricelineHeightUnit = isset($attr['pricelineHeightUnit']) ? $attr['pricelineHeightUnit'] : 'px';
                $css .= "line-height: {$attr['pricelineHeight']}{$pricelineHeightUnit}; ";
            }
    
            // Letter Spacing
            if (isset($attr['priceletterSpacing'])) {
                $priceletterSpacingUnit = isset($attr['priceletterSpacingUnit']) ? $attr['priceletterSpacingUnit'] : 'px';
                $css .= "letter-spacing: {$attr['priceletterSpacing']}{$priceletterSpacingUnit}; ";
            }
        $css .= "}";

        // rating font size

        if (isset($attr['ratingfontSize'])) {
            $ratingfontSizeUnit = isset($attr['ratingfontSizeUnit']) ? $attr['ratingfontSizeUnit'] : 'px';
            $css .= "font-size: {$attr['ratingfontSize']}{$ratingfontSizeUnit}; ";
        }
        
        // Line Height
        if (isset($attr['ratinglineHeight'])) {
            $ratinglineHeightUnit = isset($attr['ratinglineHeightUnit']) ? $attr['ratinglineHeightUnit'] : 'px';
            $css .= "line-height: {$attr['ratinglineHeight']}{$ratinglineHeightUnit}; ";
        }

        // Letter Spacing
        if (isset($attr['ratingletterSpacing'])) {
            $ratingletterSpacingUnit = isset($attr['ratingletterSpacingUnit']) ? $attr['ratingletterSpacingUnit'] : 'px';
            $css .= "letter-spacing: {$attr['ratingletterSpacing']}{$ratingletterSpacingUnit}; ";
        }

            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-add-btn a{";
            $css .= "font-family: " . (isset($attr['buttonfontFamily']) ? $attr['buttonfontFamily'] : 'inherit') . ';';
            $css .= "font-weight: " . (isset($attr['buttonfontVariant']) ? $attr['buttonfontVariant'] : 'inherit') . ';';
            $css .= "font-style: " . (isset($attr['buttonfontStyle']) ? $attr['buttonfontStyle'] : 'normal') . ';';
            $css .= "text-transform: " . (isset($attr['buttontextTransform']) ? $attr['buttontextTransform'] : 'none') . ';';
           
            // Font Size
            if (isset($attr['buttonfontSize'])) {
                $buttonfontSizeUnit = isset($attr['buttonfontSizeUnit']) ? $attr['buttonfontSizeUnit'] : 'px';
                $css .= "font-size: {$attr['buttonfontSize']}{$buttonfontSizeUnit}; ";
            }
            // Line Height
            if (isset($attr['buttonlineHeight'])) {
                $buttonlineHeightUnit = isset($attr['buttonlineHeightUnit']) ? $attr['buttonlineHeightUnit'] : 'px';
                $css .= "line-height: {$attr['buttonlineHeight']}{$buttonlineHeightUnit}; ";
            }
            // Letter Spacing
            if (isset($attr['buttonletterSpacing'])) {
                $buttonletterSpacingUnit = isset($attr['buttonletterSpacingUnit']) ? $attr['buttonletterSpacingUnit'] : 'px';
                $css .= "letter-spacing: {$attr['buttonletterSpacing']}{$buttonletterSpacingUnit}; ";
            }
        $css .= "}";

        if (isset($attr['saleClr'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-sale{";
            $css .= "color: {$attr['saleClr']};";
            $css .= "}";
        }

        if (isset($attr['saleBgClr'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-sale{";
            $css .= "background: {$attr['saleBgClr']};";
            $css .= "}";
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-sale.style2:before{";
            $css .= "border-right-color: {$attr['saleBgClr']};border-left-color: {$attr['saleBgClr']};";
            $css .= "}";
        }

        if (isset($attr['postMetaClr'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-meta .th-icons,.wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-meta .th-icons a{";
            $css .= "color: {$attr['postMetaClr']};";
            $css .= "}";
        }

        if (isset($attr['postMetaBgClr'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-meta .th-icons{";
            $css .= "background: {$attr['postMetaBgClr']};";
            $css .= "}";
        }

        if (isset($attr['postMetaHvrClr'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-meta .th-icons:hover,.wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-meta .th-icons:hover a{";
            $css .= "color: {$attr['postMetaHvrClr']};";
            $css .= "}";
        }

        if (isset($attr['postMetaBgHvrClr'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-meta .th-icons:hover{";
            $css .= "background: {$attr['postMetaBgHvrClr']};";
            $css .= "}";
        }

        //end desktop view
        
        // tablet view
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) {";
        
            if (isset($attr['productCol'])) {

                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-item-wrap{";
                    
                $css .= "grid-template-columns:repeat({$attr['productColTablet']},minmax(0, 1fr))";
        
                $css .= "}";
        
                }   

                if($showTab):
                    $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs{";
                    $css .= isset( $attr['tabAlignTablet'] ) ? "justify-content:{$attr['tabAlignTablet'] };" : 'justify-content:center;';
                    $css .= "}";
                    $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li{";
                     //tabborder-width
                     if (isset($attr['tabBorderTopBorderTablet'])) {
                        $borderType = $attr['tabBorderTopborderTypeTablet'] ?? 'solid';
                        $css .= "border-top: {$attr['tabBorderTopBorderTablet']} {$borderType} {$attr['tabBorderTopBorderColorTablet']}; ";
                    }
                    if (isset($attr['tabBorderBottomBorderTablet'])) {
                        $borderType = $attr['tabBorderBottomborderTypeTablet'] ?? 'solid';
                        $css .= "border-bottom: {$attr['tabBorderBottomBorderTablet']} {$borderType} {$attr['tabBorderBottomBorderColorTablet']}; ";
                    }
                    if (isset($attr['tabBorderRightBorderTablet'])) {
                        $borderType = $attr['tabBorderRightborderTypeTablet'] ?? 'solid';
                        $css .= "border-right: {$attr['tabBorderRightBorderTablet']} {$borderType} {$attr['tabBorderRightBorderColorTablet']}; ";
                    }
                    if (isset($attr['tabBorderLeftBorderTablet'])) {
                        $borderType = $attr['tabBorderLeftborderType'] ?? 'solid';
                        $css .= "border-left: {$attr['tabBorderLeftBorderTablet']} {$borderType} {$attr['tabBorderLeftBorderColorTablet']}; ";
                    }
                        
                    //tabBorder-radius
                    //border-radius
                    if (isset($attr['tabBorderRadiusTablet']) && is_array($attr['tabBorderRadiusTablet'])) {
                        // Check for null explicitly and only default empty or missing values
                        $tabRadiusTop = (isset($attr['tabBorderRadiusTablet']['top']) && $attr['tabBorderRadiusTablet']['top'] !== null) ? $attr['tabBorderRadiusTablet']['top'] : '0px';
                        $tabRadiusRight = (isset($attr['tabBorderRadiusTablet']['right']) && $attr['tabBorderRadiusTablet']['right'] !== null) ? $attr['tabBorderRadiusTablet']['right'] : '0px';
                        $tabRadiusBottom = (isset($attr['tabBorderRadiusTablet']['bottom']) && $attr['tabBorderRadiusTablet']['bottom'] !== null) ? $attr['tabBorderRadiusTablet']['bottom'] : '0px';
                        $tabRadiusLeft = (isset($attr['tabBorderRadiusTablet']['left']) && $attr['tabBorderRadiusTablet']['left'] !== null) ? $attr['tabBorderRadiusTablet']['left'] : '0px';
                        $css .= "border-radius: {$tabRadiusTop} {$tabRadiusRight} {$tabRadiusLeft} {$tabRadiusBottom}; ";
                    }

                    //tabPadding
                    //padding
                    if (isset($attr['tabPaddingTablet']) && is_array($attr['tabPaddingTablet'])) {
                        // Check for null explicitly and only default empty or missing values
                        $paddingTop = (isset($attr['tabPaddingTablet']['top']) && $attr['tabPaddingTablet']['top'] !== null) ? $attr['tabPaddingTablet']['top'] : '0px';
                        $paddingRight = (isset($attr['tabPaddingTablet']['right']) && $attr['tabPaddingTablet']['right'] !== null) ? $attr['tabPaddingTablet']['right'] : '0px';
                        $paddingBottom = (isset($attr['tabPaddingTablet']['bottom']) && $attr['tabPaddingTablet']['bottom'] !== null) ? $attr['tabPaddingTablet']['bottom'] : '0px';
                        $paddingLeft = (isset($attr['tabPaddingTablet']['left']) && $attr['tabPaddingTablet']['left'] !== null) ? $attr['tabPaddingTablet']['left'] : '0px';
                        // Append the padding to the CSS string
                        $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";	
                    } 

                    //tabMargin
                    if (isset($attr['tabMarginTablet']) && is_array($attr['tabMarginTablet'])) {
                        // Check for null explicitly and only default empty or missing values
                        $tabMarginTop = (isset($attr['tabMarginTablet']['top']) && $attr['tabMarginTablet']['top'] !== null) ? $attr['tabMarginTablet']['top'] : '0px';
                        $tabMarginRight = (isset($attr['tabMarginTablet']['right']) && $attr['tabMarginTablet']['right'] !== null) ? $attr['tabMarginTablet']['right'] : '0px';
                        $tabMarginBottom = (isset($attr['tabMarginTablet']['bottom']) && $attr['tabMarginTablet']['bottom'] !== null) ? $attr['tabMarginTablet']['bottom'] : '0px';
                        $tabMarginLeft = (isset($attr['tabMarginTablet']['left']) && $attr['tabMarginTablet']['left'] !== null) ? $attr['tabMarginTablet']['left'] : '0px';
                        // Append the margin to the CSS string
                        $css .= "margin: {$tabMarginTop} {$tabMarginRight} {$tabMarginBottom} {$tabMarginLeft};\n";	
                    }
                    $css .= "}";
                endif;

            // product-box-padding
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap{";
            if (isset($attr['productPaddingTablet']) && is_array($attr['productPadding'])){
                // Check for null explicitly and only default empty or missing values
                $paddingTop = (isset($attr['productPaddingTablet']['top']) && $attr['productPaddingTablet']['top'] !== null) ? $attr['productPaddingTablet']['top'] : '0px';
                $paddingRight = (isset($attr['productPaddingTablet']['right']) && $attr['productPaddingTablet']['right'] !== null) ? $attr['productPaddingTablet']['right'] : '0px';
                $paddingBottom = (isset($attr['productPaddingTablet']['bottom']) && $attr['productPaddingTablet']['bottom'] !== null) ? $attr['productPaddingTablet']['bottom'] : '0px';
                $paddingLeft = (isset($attr['productPaddingTablet']['left']) && $attr['productPaddingTablet']['left'] !== null) ? $attr['productPaddingTablet']['left'] : '0px';
                // Append the padding to the CSS string
                $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";	
            } 
             // product-box-border-radius
             if (isset($attr['productboxRadiusTablet']) && is_array($attr['productboxRadiusTablet'])) {
                // Check for null explicitly and only default empty or missing values
                $productboxRadiusTop = (isset($attr['productboxRadiusTablet']['top']) && $attr['productboxRadiusTablet']['top'] !== null) ? $attr['productboxRadiusTablet']['top'] : '0px';
                $productboxRadiusRight = (isset($attr['productboxRadiusTablet']['right']) && $attr['productboxRadiusTablet']['right'] !== null) ? $attr['productboxRadiusTablet']['right'] : '0px';
                $productboxRadiusBottom = (isset($attr['productboxRadiusTablet']['bottom']) && $attr['productboxRadiusTablet']['bottom'] !== null) ? $attr['productboxRadiusTablet']['bottom'] : '0px';
                $productboxRadiusLeft = (isset($attr['productboxRadiusTablet']['left']) && $attr['productboxRadiusTablet']['left'] !== null) ? $attr['productboxRadiusTablet']['left'] : '0px';
                $css .= "border-radius: {$productboxRadiusTop} {$productboxRadiusRight} {$productboxRadiusLeft} {$productboxRadiusBottom}; ";
            }
    
            //border
            if (isset($attr['productboxTopBorderTablet'])) {
                $borderType = $attr['productboxTopborderTypeTablet'] ?? 'solid';
                $css .= "border-top: {$attr['productboxTopBorderTablet']} {$borderType} {$attr['productboxTopBorderColorTablet']}; ";
            }
            if (isset($attr['productboxBottomBorderTablet'])) {
                $borderType = $attr['productboxBottomborderTypeTablet'] ?? 'solid';
                $css .= "border-bottom: {$attr['productboxBottomBorderTablet']} {$borderType} {$attr['productboxBottomBorderColorTablet']}; ";
            }
            if (isset($attr['productboxRightBorderTablet'])) {
                $borderType = $attr['productboxRightborderTypeTablet'] ?? 'solid';
                $css .= "border-right: {$attr['productboxRightBorderTablet']} {$borderType} {$attr['productboxRightBorderColorTablet']}; ";
            }
            if (isset($attr['productboxLeftBorderTablet'])) {
                $borderType = $attr['productboxLeftborderTypeTablet'] ?? 'solid';
                $css .= "border-left: {$attr['productboxLeftBorderTablet']} {$borderType} {$attr['productboxLeftBorderColorTablet']}; ";
            }
            
    
        $css .= "}";

        //gap
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-block-product-item-wrap{";
            $elementGapTablet = isset($attr['elementGapTablet']) ? $attr['elementGapTablet'] : 20;
            $elementGapUnit = isset($attr['elementGapUnit']) ? $attr['elementGapUnit'] : 'px';
            $css .= "grid-row-gap: {$elementGapTablet}{$elementGapUnit};";
            $css .= "grid-column-gap: {$elementGapTablet}{$elementGapUnit};";
            $css .= "}";

        //padding
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-wrapper{";
        if (isset($attr['paddingTablet']) && is_array($attr['paddingTablet'])) {
           // Check for null explicitly and only default empty or missing values
           $paddingTop = (isset($attr['paddingTablet']['top']) && $attr['paddingTablet']['top'] !== null) ? $attr['paddingTablet']['top'] : '0px';
           $paddingRight = (isset($attr['paddingTablet']['right']) && $attr['paddingTablet']['right'] !== null) ? $attr['paddingTablet']['right'] : '0px';
           $paddingBottom = (isset($attr['paddingTablet']['bottom']) && $attr['paddingTablet']['bottom'] !== null) ? $attr['paddingTablet']['bottom'] : '0px';
           $paddingLeft = (isset($attr['paddingTablet']['left']) && $attr['paddingTablet']['left'] !== null) ? $attr['paddingTablet']['left'] : '0px';
           // Append the padding to the CSS string
           $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";
       }
        $css .= "}";

        //margin
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-wrapper{";
               if (isset($attr['marginTablet']) && is_array($attr['marginTablet'])) {
                   // Check for null explicitly and only default empty or missing values
                   $marginTop = (isset($attr['marginTablet']['top']) && $attr['marginTablet']['top'] !== null) ? $attr['marginTablet']['top'] : '0px';
                   $marginRight = (isset($attr['marginTablet']['right']) && $attr['marginTablet']['right'] !== null) ? $attr['marginTablet']['right'] : '0px';
                   $marginBottom = (isset($attr['marginTablet']['bottom']) && $attr['marginTablet']['bottom'] !== null) ? $attr['marginTablet']['bottom'] : '0px';
                   $marginLeft = (isset($attr['marginTablet']['left']) && $attr['marginTablet']['left'] !== null) ? $attr['marginTablet']['left'] : '0px';
                   // Append the margin to the CSS string
                   $css .= "margin: {$marginTop} {$marginRight} {$marginBottom} {$marginLeft};\n";
               }
       
        $css .= "}";   

         

        // typography

        // Font Size
		if (isset($attr['tabfontSizeTablet'])) {
			$tabfontSizeUnit = isset($attr['tabfontSizeUnit']) ? $attr['tabfontSizeUnit'] : 'px';
			$css .= "font-size: {$attr['tabfontSizeTablet']}{$tabfontSizeUnit}; ";
		}
		// Line Height
		if (isset($attr['tablineHeightTablet'])) {
			$tablineHeightUnit = isset($attr['tablineHeightUnit']) ? $attr['tablineHeightUnit'] : 'px';
			$css .= "line-height: {$attr['tablineHeightTablet']}{$tablineHeightUnit}; ";
		}

		// Letter Spacing
		if (isset($attr['tabletterSpacingTablet'])) {
			$tabletterSpacingUnit = isset($attr['tabletterSpacingUnit']) ? $attr['tabletterSpacingUnit'] : 'px';
			$css .= "letter-spacing: {$attr['tabletterSpacingTablet']}{$tabletterSpacingUnit}; ";
		}

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-add-btn a{";
       

        if (isset($attr['buttonTopBorderTablet'])) {
        $borderType = $attr['buttonTopborderTypeTablet'] ?? 'solid';
        $css .= "border-top: {$attr['buttonTopBorderTablet']} {$borderType} {$attr['buttonTopBorderColorTablet']}; ";
        }
        if (isset($attr['buttonBottomBorderTablet'])) {
            $borderType = $attr['buttonBottomborderTypeTablet'] ?? 'solid';
            $css .= "border-bottom: {$attr['buttonBottomBorderTablet']} {$borderType} {$attr['buttonBottomBorderColorTablet']}; ";
        }
        if (isset($attr['buttonRightBorderTablet'])) {
            $borderType = $attr['buttonRightborderTypeTablet'] ?? 'solid';
            $css .= "border-right: {$attr['buttonRightBorderTablet']} {$borderType} {$attr['buttonRightBorderColorTablet']}; ";
        }
        if (isset($attr['buttonLeftBorderTablet'])) {
            $borderType = $attr['buttonLeftborderTypeTablet'] ?? 'solid';
            $css .= "border-left: {$attr['buttonLeftBorderTablet']} {$borderType} {$attr['buttonLeftBorderColorTablet']}; ";
        }

        //Border-radius
		if (isset($attr['buttonRadiusTablet']) && is_array($attr['buttonRadiusTablet'])) {
            // Check for null explicitly and only default empty or missing values
            $buttonRadiusTop = (isset($attr['buttonRadiusTablet']['top']) && $attr['buttonRadiusTablet']['top'] !== null) ? $attr['buttonRadiusTablet']['top'] : '0px';
            $buttonRadiusRight = (isset($attr['buttonRadiusTablet']['right']) && $attr['buttonRadiusTablet']['right'] !== null) ? $attr['buttonRadiusTablet']['right'] : '0px';
            $buttonRadiusBottom = (isset($attr['buttonRadiusTablet']['bottom']) && $attr['buttonRadiusTablet']['bottom'] !== null) ? $attr['buttonRadiusTablet']['bottom'] : '0px';
            $buttonRadiusLeft = (isset($attr['buttonRadiusTablet']['left']) && $attr['buttonRadiusTablet']['left'] !== null) ? $attr['buttonRadiusTablet']['left'] : '0px';
            $css .= "border-radius: {$buttonRadiusTop} {$buttonRadiusRight} {$buttonRadiusLeft} {$buttonRadiusBottom}; ";
        }
        //buttonSpacing
        if (isset($attr['buttonSpacePaddingTablet']) && is_array($attr['buttonSpacePaddingTablet'])) {
            // Check for null explicitly and only default empty or missing values
            $paddingTop = (isset($attr['buttonSpacePaddingTablet']['top']) && $attr['buttonSpacePaddingTablet']['top'] !== null) ? $attr['buttonSpacePaddingTablet']['top'] : '0px';
            $paddingRight = (isset($attr['buttonSpacePaddingTablet']['right']) && $attr['buttonSpacePaddingTablet']['right'] !== null) ? $attr['buttonSpacePaddingTablet']['right'] : '0px';
            $paddingBottom = (isset($attr['buttonSpacePaddingTablet']['bottom']) && $attr['buttonSpacePaddingTablet']['bottom'] !== null) ? $attr['buttonSpacePaddingTablet']['bottom'] : '0px';
            $paddingLeft = (isset($attr['buttonSpacePaddingTablet']['left']) && $attr['buttonSpacePaddingTablet']['left'] !== null) ? $attr['buttonSpacePaddingTablet']['left'] : '0px';
            // Append the padding to the CSS string
            $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";
        }
        
        
        $css .= "}";

         $css .= "}";
        
            // mobile view
            $css .= "@media only screen and (max-width: 767px){";
             
            if (isset($attr['productCol'])) {

            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-item-wrap{";
                
            $css .= "grid-template-columns:repeat({$attr['productColMobile']},minmax(0, 1fr))";
    
            $css .= "}";
    
            }

            if($showTab):
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs{";
                    $css .= isset( $attr['tabAlignMobile'] ) ? "justify-content:{$attr['tabAlignMobile'] };" : 'justify-content:center;';
                    $css .= "}";
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li{";
                    //tabborder-width
                    if (isset($attr['tabBorderTopBorderMobile'])) {
                        $borderType = $attr['tabBorderTopborderTypeMobile'] ?? 'solid';
                        $css .= "border-top: {$attr['tabBorderTopBorderMobile']} {$borderType} {$attr['tabBorderTopBorderColorMobile']}; ";
                    }
                    if (isset($attr['tabBorderBottomBorderMobile'])) {
                        $borderType = $attr['tabBorderBottomborderTypeMobile'] ?? 'solid';
                        $css .= "border-bottom: {$attr['tabBorderBottomBorderMobile']} {$borderType} {$attr['tabBorderBottomBorderColorMobile']}; ";
                    }
                    if (isset($attr['tabBorderRightBorderMobile'])) {
                        $borderType = $attr['tabBorderRightborderTypeMobile'] ?? 'solid';
                        $css .= "border-right: {$attr['tabBorderRightBorderMobile']} {$borderType} {$attr['tabBorderRightBorderColorMobile']}; ";
                    }
                    if (isset($attr['tabBorderLeftBorderMobile'])) {
                        $borderType = $attr['tabBorderLeftborderTypeMobile'] ?? 'solid';
                        $css .= "border-left: {$attr['tabBorderLeftBorderMobile']} {$borderType} {$attr['tabBorderLeftBorderColorMobile']}; ";
                    }
                    
                    //tabBorder-radius
                    if (isset($attr['tabBorderRadiusMobile']) && is_array($attr['tabBorderRadiusMobile'])) {
                        // Check for null explicitly and only default empty or missing values
                        $tabRadiusTop = (isset($attr['tabBorderRadiusMobile']['top']) && $attr['tabBorderRadiusMobile']['top'] !== null) ? $attr['tabBorderRadiusMobile']['top'] : '0px';
                        $tabRadiusRight = (isset($attr['tabBorderRadiusMobile']['right']) && $attr['tabBorderRadiusMobile']['right'] !== null) ? $attr['tabBorderRadiusMobile']['right'] : '0px';
                        $tabRadiusBottom = (isset($attr['tabBorderRadiusMobile']['bottom']) && $attr['tabBorderRadiusMobile']['bottom'] !== null) ? $attr['tabBorderRadiusMobile']['bottom'] : '0px';
                        $tabRadiusLeft = (isset($attr['tabBorderRadiusMobile']['left']) && $attr['tabBorderRadiusMobile']['left'] !== null) ? $attr['tabBorderRadiusMobile']['left'] : '0px';
                        $css .= "border-radius: {$tabRadiusTop} {$tabRadiusRight} {$tabRadiusLeft} {$tabRadiusBottom}; ";
                    }
                    

                    //tabPadding
//padding
if (isset($attr['tabPaddingMobile']) && is_array($attr['tabPaddingMobile'])) {
    // Check for null explicitly and only default empty or missing values
    $paddingTop = (isset($attr['tabPaddingMobile']['top']) && $attr['tabPaddingMobile']['top'] !== null) ? $attr['tabPaddingMobile']['top'] : '0px';
    $paddingRight = (isset($attr['tabPaddingMobile']['right']) && $attr['tabPaddingMobile']['right'] !== null) ? $attr['tabPaddingMobile']['right'] : '0px';
    $paddingBottom = (isset($attr['tabPaddingMobile']['bottom']) && $attr['tabPaddingMobile']['bottom'] !== null) ? $attr['tabPaddingMobile']['bottom'] : '0px';
    $paddingLeft = (isset($attr['tabPaddingMobile']['left']) && $attr['tabPaddingMobile']['left'] !== null) ? $attr['tabPaddingMobile']['left'] : '0px';
    // Append the padding to the CSS string
    $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";  
} 

                //tabMargin
                if (isset($attr['tabMarginMobile']) && is_array($attr['tabMarginMobile'])) {
                    // Check for null explicitly and only default empty or missing values
                    $tabMarginTop = (isset($attr['tabMarginMobile']['top']) && $attr['tabMarginMobile']['top'] !== null) ? $attr['tabMarginMobile']['top'] : '0px';
                    $tabMarginRight = (isset($attr['tabMarginMobile']['right']) && $attr['tabMarginMobile']['right'] !== null) ? $attr['tabMarginMobile']['right'] : '0px';
                    $tabMarginBottom = (isset($attr['tabMarginMobile']['bottom']) && $attr['tabMarginMobile']['bottom'] !== null) ? $attr['tabMarginMobile']['bottom'] : '0px';
                    $tabMarginLeft = (isset($attr['tabMarginMobile']['left']) && $attr['tabMarginMobile']['left'] !== null) ? $attr['tabMarginMobile']['left'] : '0px';
                    // Append the margin to the CSS string
                    $css .= "margin: {$tabMarginTop} {$tabMarginRight} {$tabMarginBottom} {$tabMarginLeft};\n";  
                }

                $css .= "}";
            endif;

            // product-box-padding
           $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap{";
            // productPadding
if (isset($attr['productPaddingMobile']) && is_array($attr['productPaddingMobile'])){
    // Check for null explicitly and only default empty or missing values
    $paddingTop = (isset($attr['productPaddingMobile']['top']) && $attr['productPaddingMobile']['top'] !== null) ? $attr['productPaddingMobile']['top'] : '0px';
    $paddingRight = (isset($attr['productPaddingMobile']['right']) && $attr['productPaddingMobile']['right'] !== null) ? $attr['productPaddingMobile']['right'] : '0px';
    $paddingBottom = (isset($attr['productPaddingMobile']['bottom']) && $attr['productPaddingMobile']['bottom'] !== null) ? $attr['productPaddingMobile']['bottom'] : '0px';
    $paddingLeft = (isset($attr['productPaddingMobile']['left']) && $attr['productPaddingMobile']['left'] !== null) ? $attr['productPaddingMobile']['left'] : '0px';
    // Append the padding to the CSS string
    $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";  
} 

// product-box-border-radius
if (isset($attr['productboxRadiusMobile']) && is_array($attr['productboxRadiusMobile'])) {
    // Check for null explicitly and only default empty or missing values
    $productboxRadiusTop = (isset($attr['productboxRadiusMobile']['top']) && $attr['productboxRadiusMobile']['top'] !== null) ? $attr['productboxRadiusMobile']['top'] : '0px';
    $productboxRadiusRight = (isset($attr['productboxRadiusMobile']['right']) && $attr['productboxRadiusMobile']['right'] !== null) ? $attr['productboxRadiusMobile']['right'] : '0px';
    $productboxRadiusBottom = (isset($attr['productboxRadiusMobile']['bottom']) && $attr['productboxRadiusMobile']['bottom'] !== null) ? $attr['productboxRadiusMobile']['bottom'] : '0px';
    $productboxRadiusLeft = (isset($attr['productboxRadiusMobile']['left']) && $attr['productboxRadiusMobile']['left'] !== null) ? $attr['productboxRadiusMobile']['left'] : '0px';
    $css .= "border-radius: {$productboxRadiusTop} {$productboxRadiusRight} {$productboxRadiusLeft} {$productboxRadiusBottom}; ";
}

// border
if (isset($attr['productboxTopBorderMobile'])) {
    $borderType = $attr['productboxTopborderTypeMobile'] ?? 'solid';
    $css .= "border-top: {$attr['productboxTopBorderMobile']} {$borderType} {$attr['productboxTopBorderColorMobile']}; ";
}
if (isset($attr['productboxBottomBorderMobile'])) {
    $borderType = $attr['productboxBottomborderTypeMobile'] ?? 'solid';
    $css .= "border-bottom: {$attr['productboxBottomBorderMobile']} {$borderType} {$attr['productboxBottomBorderColorMobile']}; ";
}
if (isset($attr['productboxRightBorderMobile'])) {
    $borderType = $attr['productboxRightborderTypeMobile'] ?? 'solid';
    $css .= "border-right: {$attr['productboxRightBorderMobile']} {$borderType} {$attr['productboxRightBorderColorMobile']}; ";
}
if (isset($attr['productboxLeftBorderMobile'])) {
    $borderType = $attr['productboxLeftborderTypeMobile'] ?? 'solid';
    $css .= "border-left: {$attr['productboxLeftBorderMobile']} {$borderType} {$attr['productboxLeftBorderColorMobile']}; ";
}

            $css .= "}";

            //gap
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-block-product-item-wrap{";
            $elementGapMobile = isset($attr['elementGapMobile']) ? $attr['elementGapMobile'] : 20;
            $elementGapUnit = isset($attr['elementGapUnit']) ? $attr['elementGapUnit'] : 'px';
            $css .= "grid-row-gap: {$elementGapMobile}{$elementGapUnit};";
            $css .= "grid-column-gap: {$elementGapMobile}{$elementGapUnit};";
            $css .= "}";

            // padding
$css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-wrapper{";
if (isset($attr['paddingMobile']) && is_array($attr['paddingMobile'])) {
    // Check for null explicitly and only default empty or missing values
    $paddingTop = (isset($attr['paddingMobile']['top']) && $attr['paddingMobile']['top'] !== null) ? $attr['paddingMobile']['top'] : '0px';
    $paddingRight = (isset($attr['paddingMobile']['right']) && $attr['paddingMobile']['right'] !== null) ? $attr['paddingMobile']['right'] : '0px';
    $paddingBottom = (isset($attr['paddingMobile']['bottom']) && $attr['paddingMobile']['bottom'] !== null) ? $attr['paddingMobile']['bottom'] : '0px';
    $paddingLeft = (isset($attr['paddingMobile']['left']) && $attr['paddingMobile']['left'] !== null) ? $attr['paddingMobile']['left'] : '0px';
    // Append the padding to the CSS string
    $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";
}
$css .= "}";

// margin
$css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-wrapper{";
if (isset($attr['marginMobile']) && is_array($attr['marginMobile'])) {
    // Check for null explicitly and only default empty or missing values
    $marginTop = (isset($attr['marginMobile']['top']) && $attr['marginMobile']['top'] !== null) ? $attr['marginMobile']['top'] : '0px';
    $marginRight = (isset($attr['marginMobile']['right']) && $attr['marginMobile']['right'] !== null) ? $attr['marginMobile']['right'] : '0px';
    $marginBottom = (isset($attr['marginMobile']['bottom']) && $attr['marginMobile']['bottom'] !== null) ? $attr['marginMobile']['bottom'] : '0px';
    $marginLeft = (isset($attr['marginMobile']['left']) && $attr['marginMobile']['left'] !== null) ? $attr['marginMobile']['left'] : '0px';
    // Append the margin to the CSS string
    $css .= "margin: {$marginTop} {$marginRight} {$marginBottom} {$marginLeft};\n";
}

$css .= "}";
$css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-add-btn a{";

if (isset($attr['buttonTopBorderMobile'])) {
    $borderType = $attr['buttonTopborderTypeMobile'] ?? 'solid';
    $css .= "border-top: {$attr['buttonTopBorderMobile']} {$borderType} {$attr['buttonTopBorderColorMobile']}; ";
}
if (isset($attr['buttonBottomBorderMobile'])) {
    $borderType = $attr['buttonBottomborderTypeMobile'] ?? 'solid';
    $css .= "border-bottom: {$attr['buttonBottomBorderMobile']} {$borderType} {$attr['buttonBottomBorderColorMobile']}; ";
}
if (isset($attr['buttonRightBorderMobile'])) {
    $borderType = $attr['buttonRightborderTypeMobile'] ?? 'solid';
    $css .= "border-right: {$attr['buttonRightBorderMobile']} {$borderType} {$attr['buttonRightBorderColorMobile']}; ";
}
if (isset($attr['buttonLeftBorderMobile'])) {
    $borderType = $attr['buttonLeftborderTypeMobile'] ?? 'solid';
    $css .= "border-left: {$attr['buttonLeftBorderMobile']} {$borderType} {$attr['buttonLeftBorderColorMobile']}; ";
}

// Border-radius
if (isset($attr['buttonRadiusMobile']) && is_array($attr['buttonRadiusMobile'])) {
    // Check for null explicitly and only default empty or missing values
    $buttonRadiusTop = (isset($attr['buttonRadiusMobile']['top']) && $attr['buttonRadiusMobile']['top'] !== null) ? $attr['buttonRadiusMobile']['top'] : '0px';
    $buttonRadiusRight = (isset($attr['buttonRadiusMobile']['right']) && $attr['buttonRadiusMobile']['right'] !== null) ? $attr['buttonRadiusMobile']['right'] : '0px';
    $buttonRadiusBottom = (isset($attr['buttonRadiusMobile']['bottom']) && $attr['buttonRadiusMobile']['bottom'] !== null) ? $attr['buttonRadiusMobile']['bottom'] : '0px';
    $buttonRadiusLeft = (isset($attr['buttonRadiusMobile']['left']) && $attr['buttonRadiusMobile']['left'] !== null) ? $attr['buttonRadiusMobile']['left'] : '0px';
    $css .= "border-radius: {$buttonRadiusTop} {$buttonRadiusRight} {$buttonRadiusLeft} {$buttonRadiusBottom}; ";
}

// buttonSpacing
if (isset($attr['buttonSpacePaddingMobile']) && is_array($attr['buttonSpacePaddingMobile'])) {
    // Check for null explicitly and only default empty or missing values
    $paddingTop = (isset($attr['buttonSpacePaddingMobile']['top']) && $attr['buttonSpacePaddingMobile']['top'] !== null) ? $attr['buttonSpacePaddingMobile']['top'] : '0px';
    $paddingRight = (isset($attr['buttonSpacePaddingMobile']['right']) && $attr['buttonSpacePaddingMobile']['right'] !== null) ? $attr['buttonSpacePaddingMobile']['right'] : '0px';
    $paddingBottom = (isset($attr['buttonSpacePaddingMobile']['bottom']) && $attr['buttonSpacePaddingMobile']['bottom'] !== null) ? $attr['buttonSpacePaddingMobile']['bottom'] : '0px';
    $paddingLeft = (isset($attr['buttonSpacePaddingMobile']['left']) && $attr['buttonSpacePaddingMobile']['left'] !== null) ? $attr['buttonSpacePaddingMobile']['left'] : '0px';
    // Append the padding to the CSS string
    $css .= "padding: {$paddingTop} {$paddingRight} {$paddingBottom} {$paddingLeft};\n";
}

$css .= "}";


       
        // typography

        // Font Size
		if (isset($attr['tabfontSizeMobile'])) {
			$tabfontSizeUnit = isset($attr['tabfontSizeUnit']) ? $attr['tabfontSizeUnit'] : 'px';
			$css .= "font-size: {$attr['tabfontSizeMobile']}{$tabfontSizeUnit}; ";
		}
		// Line Height
		if (isset($attr['tablineHeightMobile'])) {
			$tablineHeightUnit = isset($attr['tablineHeightUnit']) ? $attr['tablineHeightUnit'] : 'px';
			$css .= "line-height: {$attr['tablineHeightMobile']}{$tablineHeightUnit}; ";
		}
		// Letter Spacing
		if (isset($attr['tabletterSpacingMobile'])) {
			$tabletterSpacingUnit = isset($attr['tabletterSpacingUnit']) ? $attr['tabletterSpacingUnit'] : 'px';
			$css .= "letter-spacing: {$attr['tabletterSpacingMobile']}{$tabletterSpacingUnit}; ";
		}



        $css .= "}";

        if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
            $css .= "@media only screen and (min-width: 1024px) {.wp-block-th-advance-product-tag-{$attr['uniqueId']}{display:none;}}";
        }
        //hide on Tablet
        if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
            $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { .wp-block-th-advance-product-tag-{$attr['uniqueId']}{display:none;}}";
        }
        //hide on Mobile
        if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
            $css .= "@media only screen and (max-width: 767px) {.wp-block-th-advance-product-tag-{$attr['uniqueId']}{display:none;}}";
        }

    }

    return $css;

}