<?php 

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

function vayu_advance_product_tab_style($attr){ 

    $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

	$css = '';

    if(isset( $attr['uniqueId'] )){

        // Advanced setting start
        $wrapper = ".wp-block-th-advance-product-tag-{$attr['uniqueId']}";

        $css .= $OBJ_STYLE->advanceStyle($wrapper);
        // Advanced setting end


        if (isset($attr['productCol'])) {

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-item-wrap{";
            
        $css .= "grid-template-columns:repeat({$attr['productCol']['Desktop']},minmax(0, 1fr))";

        $css .= "}";

        }

        //tab style
        $showTab = isset($attr['showTab']) ? $attr['showTab'] : true;
        if($showTab):
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs{";
        $css .= isset( $attr['tabAlign'] ) ? "justify-content:{$attr['tabAlign']['Desktop'] };" : 'justify-content:center;';
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li{";
        $css .= isset( $attr['tabColor'] ) ? "color:{$attr['tabColor'] };" : 'color:#111;';
        $css .= isset( $attr['tabBgColor'] ) ? "background:{$attr['tabBgColor'] };" : 'background:transparent;';
    
        // tab border radius shadow
        $css .= $OBJ_STYLE->borderRadiusShadow('tabBorder', 'tabRadius', 'tabShadow', 'Desktop');
        
        //tabPadding
        if (!empty($attr['tabPadding'])){
            $css .= $OBJ_STYLE->dimensions('tabPadding', 'padding', 'Desktop');
        }
        //tabMargin
        if (!empty($attr['tabMargin'])){
            $css .= $OBJ_STYLE->dimensions('tabMargin', 'margin', 'Desktop');
        }
        //tabtypography
        $css .= $OBJ_STYLE->typography('tabTypography','Desktop');
        
        $css .= "}";

        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li:hover,.wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li.active{";
        $css .= isset( $attr['tabColorHvr'] ) ? "color:{$attr['tabColorHvr'] };" : '';
        $css .= isset( $attr['tabBgColorHvr'] ) ? "background:{$attr['tabBgColorHvr'] };" : '';
        $css .= isset( $attr['tabBorderColorHvr'] ) ? "border-color:{$attr['tabBorderColorHvr'] };" : '';
        $css .= "}";
        endif;

        //product box
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item{";
        $css .= isset( $attr['productAlign'] ) ? "text-align:{$attr['productAlign']['Desktop'] };" : 'text-align:center;';
        $css .= "}";
        
        // product-box-padding
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap{";
        if (!empty($attr['productPadding'])){
        $css .= $OBJ_STYLE->dimensions('productPadding', 'padding', 'Desktop');
        }
        $css .= $OBJ_STYLE->borderRadiusShadow('productboxBorder', 'productboxRadius', 'productboxShadow', 'Desktop');
        //bg color
        $css .= isset( $attr['productboxClr'] ) ? "background:{$attr['productboxClr'] };" : '';

        $css .= "}";

        //gap
        
        if (isset($attr['elementGap'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-block-product-item-wrap{";
            $css .= "grid-row-gap:{$attr['elementGap']['Desktop']};";
            $css .= "grid-column-gap:{$attr['elementGap']['Desktop']};";
            $css .= "}";
		}
        
       

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


        if(isset($attr['widthType']) && 'inlinewidth' === $attr['widthType'] ){
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}{";
            $css .= "display: inline-flex;";
            $css .= "}";
        }
   
        //overlay
        if(isset($attr['overlaybackground'])){
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .wp-block-th-blocks-overlay{";
        $css .= $OBJ_STYLE->background( 'overlaybackground' );
        $css .= "}";
        }

        //overlay hover
         if(isset($attr['overlaybackgroundHover'])){
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']}:hover .wp-block-th-blocks-container-overlay{";
        $css .= $OBJ_STYLE->background('overlaybackgroundHover');
        $css .= "}";
        }
        // cat typography
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-cat a{";
        $css .= $OBJ_STYLE->typography('catTypography','Desktop');
        $css .= "}";
        // title typography
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-title a{";
        $css .= $OBJ_STYLE->typography('titleTypography','Desktop');
        $css .= "}";
        // price typography
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-price span{";
        $css .= $OBJ_STYLE->typography('priceTypography','Desktop');
        $css .= "}";
        // rating typography
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-rating.woocommerce .star-rating{";
        $css .= $OBJ_STYLE->typography('ratingTypography','Desktop');
        $css .= "}";
        //button typograpgy
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-add-btn a{";
        $css .= $OBJ_STYLE->typography('buttonTypography','Desktop'); 
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
        
        // start tablet view
        $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) {";
        
            if (isset($attr['productCol'])) {

                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-item-wrap{";
                    
                $css .= "grid-template-columns:repeat({$attr['productCol']['Tablet']},minmax(0, 1fr))";
        
                $css .= "}";
        
                }   

            if($showTab):

                 $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs{";
        $css .= isset( $attr['tabAlign'] ) ? "justify-content:{$attr['tabAlign']['Tablet'] };" : 'justify-content:center;';
        $css .= "}";

                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li{";
            
                // tab border radius shadow
                $css .= $OBJ_STYLE->borderRadiusShadow('tabBorder', 'tabRadius', 'tabShadow', 'Tablet');
                
                //tabPadding
                if (!empty($attr['tabPadding'])){
                    $css .= $OBJ_STYLE->dimensions('tabPadding', 'padding', 'Tablet');
                }
                //tabMargin
                if (!empty($attr['tabMargin'])){
                    $css .= $OBJ_STYLE->dimensions('tabMargin', 'margin', 'Tablet');
                }
                //tabtypography
                $css .= $OBJ_STYLE->typography('tabTypography','Tablet');
                
                $css .= "}";

        endif;

             // product-box-padding
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap{";
                if (!empty($attr['productPadding'])){
                $css .= $OBJ_STYLE->dimensions('productPadding', 'padding', 'Tablet');
                }
                $css .= $OBJ_STYLE->borderRadiusShadow('productboxBorder', 'productboxRadius', 'productboxShadow', 'Tablet');

                $css .= "}";

                //product box align
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item{";
        $css .= isset( $attr['productAlign'] ) ? "text-align:{$attr['productAlign']['Tablet'] };" : 'text-align:center;';
        $css .= "}";

                //gap
        
        if (isset($attr['elementGap'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-block-product-item-wrap{";
            $css .= "grid-row-gap:{$attr['elementGap']['Tablet']};";
            $css .= "grid-column-gap:{$attr['elementGap']['Tablet']};";
            $css .= "}";
		}

        $css .= "}"; 
        
        // start tablet view
        $css .= "@media only screen and (max-width: 767px){";
        
            if (isset($attr['productCol'])) {

                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-item-wrap{";
                    
                $css .= "grid-template-columns:repeat({$attr['productCol']['Mobile']},minmax(0, 1fr))";
        
                $css .= "}";
        
            }   

            if($showTab):

                 $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs{";
                $css .= isset( $attr['tabAlign'] ) ? "justify-content:{$attr['tabAlign']['Mobile'] };" : 'justify-content:center;';
                $css .= "}";
                
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-cat-filter ul.category-tabs li{";
            
                // tab border radius shadow
                $css .= $OBJ_STYLE->borderRadiusShadow('tabBorder', 'tabRadius', 'tabShadow', 'Mobile');
                
                //tabPadding
                if (!empty($attr['tabPadding'])){
                    $css .= $OBJ_STYLE->dimensions('tabPadding', 'padding', 'Mobile');
                }
                //tabMargin
                if (!empty($attr['tabMargin'])){
                    $css .= $OBJ_STYLE->dimensions('tabMargin', 'margin', 'Mobile');
                }
                //tabtypography
                $css .= $OBJ_STYLE->typography('tabTypography','Mobile');
                
                $css .= "}";

        endif;

        // product-box-padding
                $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item .th-product-block-content-wrap{";
                if (!empty($attr['productPadding'])){
                $css .= $OBJ_STYLE->dimensions('productPadding', 'padding', 'Mobile');
                }
                $css .= $OBJ_STYLE->borderRadiusShadow('productboxBorder', 'productboxRadius', 'productboxShadow', 'Mobile');

                $css .= "}";

                //product box align
        $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-item{";
        $css .= isset( $attr['productAlign'] ) ? "text-align:{$attr['productAlign']['Mobile'] };" : 'text-align:center;';
        $css .= "}";

                //gap
        
        if (isset($attr['elementGap'])) {
            $css .= ".wp-block-th-advance-product-tag-{$attr['uniqueId']} .th-product-block-product-content .th-product-block-product-item-wrap{";
            $css .= "grid-row-gap:{$attr['elementGap']['Mobile']};";
            $css .= "grid-column-gap:{$attr['elementGap']['Mobile']};";
            $css .= "}";
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