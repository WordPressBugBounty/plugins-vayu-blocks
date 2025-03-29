<?php

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

function vayu_advance_container_style($attr){

	$OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

    $css = '';

    if(isset( $attr['uniqueId'] )){
		
		$options = (new VAYU_BLOCKS_OPTION_PANEL())->get_option();
		// Access the container settings
		$container_width = $options['global']['containerWidth'];
		$container_gap   = $options['global']['containerGap'];
		$globalpadding   = $options['global']['containerPadding'];

		$css .=".wp-block-vayu-blocks-advance-container.{$attr['uniqueId']}{";
		//padding
		if (isset($attr['Padding']) && is_array($attr['Padding'])){
			$css .= $OBJ_STYLE ->dimensions('Padding', 'padding', 'Desktop');	
		} else {
			$css .= "padding: {$globalpadding}px;\n";
		}
        //margin
		if (isset($attr['Margin']) && is_array($attr['Margin'])){
			$css .= $OBJ_STYLE ->dimensions('Margin', 'margin', 'Desktop');
		}

		$css .="}";

        
		$css .= ".{$attr['uniqueId']}.boxed-content > .th-inside-content-wrap{";
        // boxed-width
		if (isset($attr['boxedcontentWidth'])) {
			$boxedcontentWidthUnit = isset($attr['boxedcontentWidthUnit']) ? $attr['boxedcontentWidthUnit'] : 'px';
			$css .= "max-width: {$attr['boxedcontentWidth']}{$boxedcontentWidthUnit}; margin: auto;";

		}else{
            $css .= "max-width:{$container_width}px;margin: auto;";
        }
        $css .= "}";

        $css .= ".{$attr['uniqueId']}.fullwidth-content{";
            // full-width
            if (isset($attr['fullcontentWidth'])) {
                $fullcontentWidthUnit = isset($attr['fullcontentWidthUnit']) ? $attr['fullcontentWidthUnit'] : '%';
                $css .= "max-width: 100%;
				width: {$attr['fullcontentWidth']}{$fullcontentWidthUnit};
				margin-left: auto;
				margin-right: auto; ";
            }else{
                $css .= "max-width:100%;
				width:100%;
				margin-left: auto;
				margin-right: auto;";
            }
       $css .= "}";


       $css .= ".{$attr['uniqueId']}{";
      
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
        
        
        //z-index
		$css .= isset( $attr['zindex'] ) ? "z-index:{$attr['zindex'] };" : '';

        
		//border// border-radius//box shadow
		$css .= $OBJ_STYLE->borderRadiusShadow('advBorder','advBorderRadius','advDropShadow','Desktop');
		

		//transition duration
		$css .= "transition: all ". (isset($attr['transitionAll']) ? $attr['transitionAll'] : '0.2' ). "s ease;";
        //position property

		$css .= "position: " . (isset($attr['position']) ? $attr['position'] : 'relative' ). ";";
		
		if(isset($attr['horizontalOrientation']) && 'left' === $attr['horizontalOrientation']  && 'relative' !== $attr['position']){
			$horizontalOrientationOffset = isset($attr['horizontalOrientationOffset']) ? $attr['horizontalOrientationOffset'] : '0';
			$horizontalOrientationOffsetUnit = isset($attr['horizontalOrientationOffsetUnit']) ? $attr['horizontalOrientationOffsetUnit'] : 'px';
            $css .= "left: {$horizontalOrientationOffset}{$horizontalOrientationOffsetUnit};";
		}
		if(isset($attr['horizontalOrientation']) && 'right' === $attr['horizontalOrientation'] && 'relative' !== $attr['position']){
			$horizontalOrientationOffsetRight = isset($attr['horizontalOrientationOffsetRight']) ? $attr['horizontalOrientationOffsetRight'] : '0';
			$horizontalOrientationOffsetRightUnit = isset($attr['horizontalOrientationOffsetRightUnit']) ? $attr['horizontalOrientationOffsetRightUnit'] : 'px';
            $css .= "right: {$horizontalOrientationOffsetRight}{$horizontalOrientationOffsetRightUnit};";
		}
		if(isset($attr['verticalOrientation']) && 'top' === $attr['verticalOrientation'] && 'relative' !== $attr['position']){
			$verticalOrientationOffsetTop = isset($attr['verticalOrientationOffsetTop']) ? $attr['verticalOrientationOffsetTop'] : '0';
			$verticalOrientationOffsetTopUnit = isset($attr['verticalOrientationOffsetTopUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
            $css .= "top: {$verticalOrientationOffsetTop}{$verticalOrientationOffsetTopUnit};";
		}
		if(isset($attr['verticalOrientation']) && 'bottom' === $attr['verticalOrientation'] && 'relative' !== $attr['position']){
			$verticalOrientationOffsetBottom = isset($attr['verticalOrientationOffsetBottom']) ? $attr['verticalOrientationOffsetBottom'] : '0';
			$verticalOrientationOffsetBottomUnit = isset($attr['verticalOrientationOffsetBottomUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
            $css .= "bottom: {$verticalOrientationOffsetBottom}{$verticalOrientationOffsetBottomUnit};";
		}

        // flex properties
		$css .= "align-self: " . (isset($attr['alignSelf']) ? $attr['alignSelf'] : 'inherit;' ). ";";
        if(isset($attr['order']) && $attr['order'] === 'start'){
			$css .= "order:-9999;";
		}elseif(isset($attr['order']) && $attr['order'] === 'end'){
			$css .= "order:9999;";
		}elseif(isset($attr['order']) && $attr['order'] === 'custom'){
		$css .= isset( $attr['customOrder'] ) ? "order:{$attr['customOrder']};" : '';
		}

		//flex size
        if(isset($attr['flexSize']) && $attr['flexSize'] === 'none'){
			
			$css .= "flex-grow:0;
				flex-shrink:0;";
		
		}elseif(isset($attr['flexSize']) && $attr['flexSize'] === 'grow'){
			$css .= "flex-grow:1;
			flex-shrink:0;";

		}elseif(isset($attr['flexSize']) && $attr['flexSize'] === 'shrink'){
			$css .= "flex-grow:0;
			flex-shrink:1;";
		}elseif(isset($attr['flexSize']) && $attr['flexSize'] === 'custom'){
			$css .= isset( $attr['FlexGrowSize'] ) ? "flex-grow:{$attr['FlexGrowSize']};" : '';
            $css .= isset( $attr['FlexShrinkSize'] ) ? "flex-shrink:{$attr['FlexShrinkSize']};" : '';
		}

        $css .= "}";
        
        // overlay
        $css .= ".{$attr['uniqueId']} > .wp-block-th-blocks-container-overlay{";
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
        $css .= "border-radius:inherit";
        $css .= "}";

        // overlay hover
        $css .= ".{$attr['uniqueId']}:hover > .wp-block-th-blocks-container-overlay{";
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
            $css .= "border-radius:inherit";
            $css .= "}";

        //inside wrap
        $css .= ".{$attr['uniqueId']} > .th-inside-content-wrap{";

			// min-height
			if (isset($attr['contentMinHgt'])) {
				$contentMinHgtUnit = isset($attr['contentMinHgtUnit']) ? $attr['contentMinHgtUnit'] : 'px';
				$css .= "min-height: {$attr['contentMinHgt']}{$contentMinHgtUnit}; ";
			}else{
				$css .= "min-height:auto;";
			}

             //flex-direction
             $css .= isset($attr['direction']) ? "flex-direction: {$attr['direction']}; " : '';
             //justifiy-content
             $css .= isset($attr['Justify']) ? "justify-content: {$attr['Justify']}; " : '';
             //align-Items
             $css .= isset($attr['AlignItem']) ? "align-items: {$attr['AlignItem']}; " : '';
             //flex-wrap
             $css .= isset($attr['Wrap']) ? "flex-wrap: {$attr['Wrap']}; " : '';
			 
             //  align content
             if (isset($attr['Wrap']) && $attr['Wrap']=='wrap') {
             $css .= isset($attr['AlignContent']) ? "align-content: {$attr['AlignContent']}; " : '';
             }

			 //gap
			 $elementGap = isset($attr['elementGap']) ? $attr['elementGap'] : $container_gap;	
			 $elementGapUnit = isset($attr['elementGapUnit']) ? $attr['elementGapUnit'] : 'px';
             $css .= "gap: {$elementGap}{$elementGapUnit};";
		

        $css .= "}";

        // Hover
        $css .= ".{$attr['uniqueId']}:hover{";
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
        //border// border-radius//box shadow
		$css .= $OBJ_STYLE->borderRadiusShadow('advBorderHvr','advBorderRadiusHvr','advDropShadowHvr','Desktop','Hover');
		$css .= "transition: all ". (isset($attr['transitionAll']) ? $attr['transitionAll'] : '0.2' ). "s ease;";

        $css .= "}";

	//shaper
	    $css .= ".{$attr['uniqueId']} > .th-shaper .th-shape-top svg{";	
		$css .= isset( $attr['shapeTopWidth'] ) ? "width:{$attr['shapeTopWidth'] }%;" : '';
		$css .= isset( $attr['shapeTopHeight'] ) ? "height:{$attr['shapeTopHeight'] }px;" : '';
	    $css .= "}";

		$css .= ".{$attr['uniqueId']} > .th-shaper .th-shape-bottom svg{";	
		$css .= isset( $attr['shapeBottomWidth'] ) ? "width:{$attr['shapeBottomWidth'] }%;" : '';
		$css .= isset( $attr['shapeBottomHeight'] ) ? "height:{$attr['shapeBottomHeight'] }px;" : '';
		$css .= "}";

		$css .= ".{$attr['uniqueId']} > .th-shaper .th-shape-top {";
		$css .= isset( $attr['shapeTopFront'] ) ? "z-index:1" : 'z-index:0';	
		$css .= "}";

		$css .= ".{$attr['uniqueId']} > .th-shaper .th-shape-bottom {";
		$css .= isset( $attr['shapeBottomFront'] ) ? "z-index:1" : 'z-index:0';	
		$css .= "}";

      //    tablet view
      $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) { ";
      
      $css .= ".{$attr['uniqueId']}.boxed-content > .th-inside-content-wrap{";
            // boxed-width
            if (isset($attr['boxedcontentWidthTablet'])) {
                $boxedcontentWidthUnit = isset($attr['boxedcontentWidthUnitTablet']) ? $attr['boxedcontentWidthUnitTablet'] : '%';
                $css .= "max-width: {$attr['boxedcontentWidthTablet']}{$boxedcontentWidthUnit}; ";
            }else{
                $css .= "max-width:100%;";
            }
			
            $css .= "}";
    
            $css .= ".{$attr['uniqueId']}.fullwidth-content{";
              
                if (isset($attr['fullcontentWidthTablet'])){
                    $fullcontentWidthUnitTablet = isset($attr['fullcontentWidthUnitTablet']) ? $attr['fullcontentWidthUnitTablet'] : '%';
                    $css .= "max-width: {$attr['fullcontentWidthTablet']}{$fullcontentWidthUnitTablet}; 
					width: {$attr['fullcontentWidthTablet']}{$fullcontentWidthUnitTablet};
					margin-left: auto;
					margin-right: auto;";
                }else{
                    $css .= "
					
					max-width: {100%};
					margin-left: auto;
					margin-right: auto;";
                }
           $css .= "}";

		   $css .=".wp-block-vayu-blocks-advance-container.{$attr['uniqueId']}{";
		   
		   
		  //padding
		
		if (isset($attr['Padding']) && is_array($attr['Padding'])){
			$css .= $OBJ_STYLE ->dimensions('Padding', 'padding', 'Tablet');	
		} else {
			$css .= "padding: {$globalpadding}px;\n";
		}
        //margin
		if (isset($attr['Margin']) && is_array($attr['Margin'])){
			$css .= $OBJ_STYLE ->dimensions('Margin', 'margin', 'Tablet');
		}
   
		   $css .="}";
    
    
           $css .= ".{$attr['uniqueId']}{";
          
            
            
			//border// border-radius//box shadow
		   $css .= $OBJ_STYLE->borderRadiusShadow('advBorder','advBorderRadius','advDropShadow','Tablet');


            $css .= (isset($attr['zindexTablet']) ? "z-index:{$attr['zindexTablet']};}" : '');
            //position

			if(isset($attr['horizontalOrientation']) && 'left' === $attr['horizontalOrientation']  && 'relative' !== $attr['position']){
				$horizontalOrientationOffsetTablet = isset($attr['horizontalOrientationOffsetTablet']) ? $attr['horizontalOrientationOffsetTablet'] : '0';
				$horizontalOrientationOffsetUnit = isset($attr['horizontalOrientationOffsetUnit']) ? $attr['horizontalOrientationOffsetUnit'] : 'px';
				$css .= "left: {$horizontalOrientationOffsetTablet}{$horizontalOrientationOffsetUnit};";
			}
			if(isset($attr['horizontalOrientation']) && 'right' === $attr['horizontalOrientation'] && 'relative' !== $attr['position']){
				$horizontalOrientationOffsetRightTablet = isset($attr['horizontalOrientationOffsetRightTablet']) ? $attr['horizontalOrientationOffsetRightTablet'] : '0';
				$horizontalOrientationOffsetRightUnit = isset($attr['horizontalOrientationOffsetRightUnit']) ? $attr['horizontalOrientationOffsetRightUnit'] : 'px';
				$css .= "right: {$horizontalOrientationOffsetRightTablet}{$horizontalOrientationOffsetRightUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'top' === $attr['verticalOrientation'] && 'relative' !== $attr['position']){
				$verticalOrientationOffsetTopTablet = isset($attr['verticalOrientationOffsetTopTablet']) ? $attr['verticalOrientationOffsetTopTablet'] : '0';
				$verticalOrientationOffsetTopUnit = isset($attr['verticalOrientationOffsetTopUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
				$css .= "top: {$verticalOrientationOffsetTopTablet}{$verticalOrientationOffsetTopUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'bottom' === $attr['verticalOrientation'] && 'relative' !== $attr['position']){
				$verticalOrientationOffsetBottomTablet = isset($attr['verticalOrientationOffsetBottomTablet']) ? $attr['verticalOrientationOffsetBottomTablet'] : '0';
				$verticalOrientationOffsetBottomUnit = isset($attr['verticalOrientationOffsetBottomUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
				$css .= "bottom: {$verticalOrientationOffsetBottomTablet}{$verticalOrientationOffsetBottomUnit};";
			}

            // flex properties
			$css .= "align-self: " . (isset($attr['alignSelfTablet']) ? $attr['alignSelfTablet'] : 'inherit;' ). ";";
			if(isset($attr['orderTablet']) && $attr['orderTablet'] === 'start'){
				$css .= "order:-9999;";
			}elseif(isset($attr['orderTablet']) && $attr['orderTablet'] === 'end'){
				$css .= "order:9999;";
			}elseif(isset($attr['orderTablet']) && $attr['orderTablet'] === 'custom'){
			$css .= isset( $attr['customOrderTablet'] ) ? "order:{$attr['customOrderTablet']};" : '';
			}
			//flex size
			if(isset($attr['flexSizeTablet']) && $attr['flexSizeTablet'] === 'none'){
			
				$css .= "flex-grow:0;
					flex-shrink:0;";
			
			}elseif(isset($attr['flexSizeTablet']) && $attr['flexSizeTablet'] === 'grow'){
				$css .= "flex-grow:1;
				flex-shrink:0;";
	
			}elseif(isset($attr['flexSizeTablet']) && $attr['flexSizeTablet'] === 'shrink'){
				$css .= "flex-grow:0;
				flex-shrink:1;";
			}elseif(isset($attr['flexSizeTablet']) && $attr['flexSizeTablet'] === 'custom'){
				$css .= isset( $attr['FlexGrowSizeTablet'] ) ? "flex-grow:{$attr['FlexGrowSizeTablet']};" : '';
				$css .= isset( $attr['FlexShrinkSizeTablet'] ) ? "flex-shrink:{$attr['FlexShrinkSizeTablet']};" : '';
			}
            
            $css .= "}";

            //inside wrap
            $css .= ".{$attr['uniqueId']} > .th-inside-content-wrap{";
			
				// min-height
			
				if (isset($attr['contentMinHgtTablet'])) {
					$contentMinHgtUnit = isset($attr['contentMinHgtUnit']) ? $attr['contentMinHgtUnit'] : 'px';
					$css .= "min-height: {$attr['contentMinHgtTablet']}{$contentMinHgtUnit}; ";
				}else{
					$css .= "min-height: auto;";
				}
    
                //flex-direction
                $css .= isset($attr['directionTablet']) ? "flex-direction: {$attr['directionTablet']}; " : '';
                //justifiy-content
                $css .= isset($attr['JustifyTablet']) ? "justify-content: {$attr['JustifyTablet']}; " : '';
                //align-Items
                $css .= isset($attr['AlignItemTablet']) ? "align-items: {$attr['AlignItemTablet']}; " : '';
                //flex-wrap
                $css .= isset($attr['WrapTablet']) ? "flex-wrap: {$attr['WrapTablet']}; " : '';
                //  align content
                if (isset($attr['WrapTablet']) && $attr['WrapTablet']=='wrap') {
                $css .= isset($attr['AlignContentTablet']) ? "align-content: {$attr['AlignContentTablet']}; " : '';
                }
				//gap
			
			 $elementGapTablet = isset($attr['elementGapTablet']) ? $attr['elementGapTablet'] : $container_gap;	
			 $elementGapUnit = isset($attr['elementGapUnit']) ? $attr['elementGapUnit'] : 'px';
             $css .= "gap: {$elementGapTablet}{$elementGapUnit};";

            $css .= "}";

            $css .= ".{$attr['uniqueId']}:hover {";
            //for border-width hover tablet
			//border// border-radius//box shadow
			$css .= $OBJ_STYLE->borderRadiusShadow('advBorderHvr','advBorderRadiusHvr','advDropShadowHvr','Tablet','Hover');
            $css .= " }";

			//shaper
			$css .= ".{$attr['uniqueId']} > .th-shaper .th-shape-top svg{";	
				$css .= isset( $attr['shapeTopWidthTablet'] ) ? "width:{$attr['shapeTopWidthTablet'] }%;" : '';
				$css .= isset( $attr['shapeTopHeightTablet'] ) ? "height:{$attr['shapeTopHeightTablet'] }px;" : '';
				$css .= "}";
		
				$css .= ".{$attr['uniqueId']} > .th-shaper .th-shape-bottom svg{";	
				$css .= isset( $attr['shapeBottomWidthTablet'] ) ? "width:{$attr['shapeBottomWidthTablet'] }%;" : '';
				$css .= isset( $attr['shapeBottomHeightTablet'] ) ? "height:{$attr['shapeBottomHeightTablet'] }px;" : '';
				$css .= "}";

      $css .= " }";

      //    mobile view
      $css .= "@media only screen and (max-width: 767px){";
      
        $css .= ".{$attr['uniqueId']}.boxed-content > .th-inside-content-wrap{";
              // boxed-width
              if (isset($attr['boxedcontentWidthMobile'])){
                  $boxedcontentWidthUnit = isset($attr['boxedcontentWidthUnitMobile']) ? $attr['boxedcontentWidthUnitMobile'] : '%';
                  $css .= "max-width: {$attr['boxedcontentWidthMobile']}{$boxedcontentWidthUnit}; ";
              }else{
                  $css .= "max-width:100%;";
              }
              $css .= "}";
      
              $css .= ".{$attr['uniqueId']}.fullwidth-content{";
                  // boxed-width
                  if (isset($attr['fullcontentWidthMobile'])){
                      $fullcontentWidthUnitMobile = isset($attr['fullcontentWidthUnitMobile']) ? $attr['fullcontentWidthUnitMobile'] : '%';
                      $css .= "max-width: {$attr['fullcontentWidthMobile']}{$fullcontentWidthUnitMobile};
					  width: {$attr['fullcontentWidthMobile']}{$fullcontentWidthUnitMobile}; 
					  margin-left: auto;
					  margin-right: auto;";
                  }else{
                      $css .= "
					  max-width:100%;
					  margin-left: auto;
					  margin-right: auto;";
                  }
             $css .= "}";

			 $css .=".wp-block-vayu-blocks-advance-container.{$attr['uniqueId']}{";
			 //padding
			if (isset($attr['Padding']) && is_array($attr['Padding'])){
				$css .= $OBJ_STYLE ->dimensions('Padding', 'padding', 'Mobile');	
			} else {
				$css .= "padding: {$globalpadding}px;\n";
			}
			//margin
			if (isset($attr['Margin']) && is_array($attr['Margin'])){
				$css .= $OBJ_STYLE ->dimensions('Margin', 'margin', 'Mobile');
			}

            $css .=(isset($attr['zindexMobile']) ? "z-index:{$attr['zindexMobile']};" : '');
            $css .= $OBJ_STYLE->borderRadiusShadow('advBorder','advBorderRadius','advDropShadow','Mobile');


            //position

			if(isset($attr['horizontalOrientation']) && 'left' === $attr['horizontalOrientation']  && 'relative' !== $attr['position']){
				$horizontalOrientationOffsetMobile = isset($attr['horizontalOrientationOffsetMobile']) ? $attr['horizontalOrientationOffsetMobile'] : '0';
				$horizontalOrientationOffsetUnit = isset($attr['horizontalOrientationOffsetUnit']) ? $attr['horizontalOrientationOffsetUnit'] : 'px';
				$css .= "left: {$horizontalOrientationOffsetMobile}{$horizontalOrientationOffsetUnit};";
			}
			if(isset($attr['horizontalOrientation']) && 'right' === $attr['horizontalOrientation'] && 'relative' !== $attr['position']){
				$horizontalOrientationOffsetRightMobile = isset($attr['horizontalOrientationOffsetRightMobile']) ? $attr['horizontalOrientationOffsetRightMobile'] : '0';
				$horizontalOrientationOffsetRightUnit = isset($attr['horizontalOrientationOffsetRightUnit']) ? $attr['horizontalOrientationOffsetRightUnit'] : 'px';
				$css .= "right: {$horizontalOrientationOffsetRightMobile}{$horizontalOrientationOffsetRightUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'top' === $attr['verticalOrientation'] && 'relative' !== $attr['position']){
				$verticalOrientationOffsetTopMobile = isset($attr['verticalOrientationOffsetTopMobile']) ? $attr['verticalOrientationOffsetTopMobile'] : '0';
				$verticalOrientationOffsetTopUnit = isset($attr['verticalOrientationOffsetTopUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
				$css .= "top: {$verticalOrientationOffsetTopMobile}{$verticalOrientationOffsetTopUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'bottom' === $attr['verticalOrientation'] && 'relative' !== $attr['position']){
				$verticalOrientationOffsetBottomMobile = isset($attr['verticalOrientationOffsetBottomMobile']) ? $attr['verticalOrientationOffsetBottomMobile'] : '0';
				$verticalOrientationOffsetBottomUnit = isset($attr['verticalOrientationOffsetBottomUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
				$css .= "bottom: {$verticalOrientationOffsetBottomMobile}{$verticalOrientationOffsetBottomUnit};";
			}
            // flex properties
			$css .= "align-self: " . (isset($attr['alignSelfMobile']) ? $attr['alignSelfMobile'] : 'inherit;' ). ";";
			if(isset($attr['orderMobile']) && $attr['orderMobile'] === 'start'){
				$css .= "order:-9999;";
			}elseif(isset($attr['orderMobile']) && $attr['orderMobile'] === 'end'){
				$css .= "order:9999;";
			}elseif(isset($attr['orderMobile']) && $attr['orderMobile'] === 'custom'){
			$css .= isset( $attr['customOrderMobile'] ) ? "order:{$attr['customOrderMobile']};" : '';
			}
			//flex size
			if(isset($attr['flexSizeMobile']) && $attr['flexSizeMobile'] === 'none'){
			
				$css .= "flex-grow:0;
					flex-shrink:0;";
			
			}elseif(isset($attr['flexSizeMobile']) && $attr['flexSizeMobile'] === 'grow'){
				$css .= "flex-grow:1;
				flex-shrink:0;";
	
			}elseif(isset($attr['flexSizeMobile']) && $attr['flexSizeMobile'] === 'shrink'){
				$css .= "flex-grow:0;
				flex-shrink:1;";
			}elseif(isset($attr['flexSizeMobile']) && $attr['flexSizeMobile'] === 'custom'){
				$css .= isset( $attr['FlexGrowSizeMobile'] ) ? "flex-grow:{$attr['FlexGrowSizeMobile']};" : '';
				$css .= isset( $attr['FlexShrinkSizeMobile'] ) ? "flex-shrink:{$attr['FlexShrinkSizeMobile']};" : '';
			}

            $css .= "}";

            $css .= ".{$attr['uniqueId']}:hover {";
            // Border (Hover)
			$css .= $OBJ_STYLE->borderRadiusShadow('advBorderHvr','advBorderRadiusHvr','advDropShadowHvr','Mobile','Hover');
            $css .= "}";

            //inside wrap
            $css .= ".{$attr['uniqueId']} > .th-inside-content-wrap{";
				// min-height
				if (isset($attr['contentMinHgtMobile'])) {
					$contentMinHgtUnit = isset($attr['contentMinHgtUnit']) ? $attr['contentMinHgtUnit'] : 'px';
					$css .= "min-height: {$attr['contentMinHgtMobile']}{$contentMinHgtUnit}; ";
				}else{
					$css .= "min-height: auto;";
				}
				
                //flex-direction
                $css .= isset($attr['directionMobile']) ? "flex-direction: {$attr['directionMobile']}; " : 'flex-direction:column;';
                //justifiy-content
                $css .= isset($attr['JustifyMobile']) ? "justify-content: {$attr['JustifyMobile']}; " : '';
                //align-Items
                $css .= isset($attr['AlignItemMobile']) ? "align-items: {$attr['AlignItemMobile']}; " : '';
                //flex-wrap
                $css .= isset($attr['WrapMobile']) ? "flex-wrap: {$attr['WrapMobile']}; " : '';
                //  align content
                if (isset($attr['WrapMobile']) && $attr['WrapMobile']=='wrap') {
                $css .= isset($attr['AlignContentMobile']) ? "align-content: {$attr['AlignContentMobile']}; " : '';
                }
				//gap
				$elementGapMobile = isset($attr['elementGapMobile']) ? $attr['elementGapMobile'] : $container_gap;	
			    $elementGapUnit = isset($attr['elementGapUnit']) ? $attr['elementGapUnit'] : 'px';
                $css .= "gap: {$elementGapMobile}{$elementGapUnit};";
                $css .= "}";

			//shaper
			$css .= ".{$attr['uniqueId']} .th-shaper .th-shape-top svg{";	
				$css .= isset( $attr['shapeTopWidthMobile'] ) ? "width:{$attr['shapeTopWidthMobile'] }%;" : '';
				$css .= isset( $attr['shapeTopHeightMobile'] ) ? "height:{$attr['shapeTopHeightMobile'] }px;" : '';
				$css .= "}";
		
				$css .= ".{$attr['uniqueId']} .th-shaper .th-shape-bottom svg{";	
				$css .= isset( $attr['shapeBottomWidthMobile'] ) ? "width:{$attr['shapeBottomWidthMobile'] }%;" : '';
				$css .= isset( $attr['shapeBottomHeightMobile'] ) ? "height:{$attr['shapeBottomHeightMobile'] }px;" : '';
				$css .= "}";
  
        $css .= " }";

        if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
            $css .= "@media only screen and (min-width: 1024px) {.{$attr['uniqueId']}{display:none;}}";
        }
        //hide on Tablet
        if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
            $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) {.{$attr['uniqueId']}{display:none;}}";
        }
        //hide on Mobile
        if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
            $css .= "@media only screen and (max-width: 767px) {.{$attr['uniqueId']}{display:none;}}";
        }

    }

    return $css;

}