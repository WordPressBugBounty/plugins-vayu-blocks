<?php 
 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
// Renderloop function
add_action('rest_api_init', function () {
    register_rest_field('post', 'comment_count', [
        'get_callback'    => function ($post) {
            return get_comments_number($post['id']);
        },
        'update_callback' => null,
        'schema'          => [
            'description' => __('The number of comments for the post.'),
            'type'        => 'integer',
            'context'     => ['view', 'edit'],
        ],
    ]);
});

function vayu_blocks_advance_heading_render( $attributes, $content, $block ) {

	$Pcontent = '';

	global $post;

	if ( ! is_object( $post ) && ( !is_404() ) ) {
		return;
	}

	$Pcontent .= get_post_field( 'post_content', get_the_ID() );

	$blocks = parse_blocks( $Pcontent );

	// Iterate over the blocks to find the parent block
	$found_parent_block = false;

	foreach ( $blocks as $block ) {
		// Check if the block is the one you're looking for (vayu-blocks/advance-query-loop)
		if ( isset( $block['blockName'] ) && $block['blockName'] === 'vayu-blocks/advance-query-loop' ) {
			$found_parent_block = true;
			break; // If found, no need to continue searching
		}
	}
    // Determine the selected source field (default to 'title')
     $source_field = isset( $attributes['selectedSourceField'] ) ? $attributes['selectedSourceField'] : 'none';
    
   
    if ($found_parent_block){

    return $content;

    }
  
    // Fetch the postId
    $post_id = $post->ID;
	
    // Fetch content based on the selected source field
    switch ( $source_field ) {
        case 'title':
            $display_content = get_the_title( $post_id );
            break;
        case 'slug':
            $display_content = get_post_field( 'post_name', $post_id );
            break;
        case 'excerpt':
            $display_content = get_the_excerpt( $post_id );
            break;
		case 'content':
			$display_content = apply_filters('the_content', get_post_field('post_content', $post_id));
				break;
        case 'post_date':
            $display_content = get_the_date( '', $post_id );
            break;
        case 'post_time':
            $display_content = get_the_time( '', $post_id );
            break;
        case 'post_id':
            $display_content = $post_id;
            break;
        case 'post_image':
            $display_content = '<figure class="wp-block-post-featured-image">' . get_the_post_thumbnail( $post_id ) . '</figure>';
            break;
        case 'author_name':
            $display_content = get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) );
            break;
		case 'author_nic_name':
			$display_content = get_the_author_meta( 'nickname', get_post_field( 'post_author', $post_id ) );
            break;
		case 'author_first_name':
				$display_content = get_the_author_meta('first_name', get_post_field('post_author', $post_id));
				break;
		case 'author_last_name':
				$display_content = get_the_author_meta('last_name', get_post_field('post_author', $post_id));
				break;
        case 'author_bio':
            $display_content = get_the_author_meta( 'description', get_post_field( 'post_author', $post_id ) );
            break;
        case 'author_email':
            $display_content = get_the_author_meta( 'user_email', get_post_field( 'post_author', $post_id ) );
            break;
		case 'author_image':
			$author_id = get_post_field( 'post_author', $post_id ); // Get the author ID from the post
            $avatar_url = get_avatar_url( $author_id, ['size' => 24] ); // Get the URL of the author's avatar
            $display_content = '<img src="' . esc_url( $avatar_url ) . '" alt="Author Avatar" class="author-avatar" />';
			
				break;
		case 'comment_count':
				$display_content = get_comments_number($post_id);
				break;
        default:
            $display_content = $content;
            break;
    }
    

    if ( ! $display_content ) {

        return;
    }

    // Set the default tag (e.g., 'h2')
    $tag_name = isset( $attributes['tag'] ) ? $attributes['tag'] : 'h2';

    // Prepare wrapper attributes
    $wrapper_attributes = '';
    if ( isset( $attributes['uniqueID'] ) ) {
        $uid = esc_attr( $attributes['uniqueID'] );
        $wrapper_attributes .= ' id="' . $uid . '"';
    }

    // Build CSS classes
    $classes = array( 'wp-block-vayu-blocks-advance-heading' );

    if ( isset( $attributes['uniqueID'] ) ) {
        $classes[] = 'th-h' . esc_attr( $attributes['uniqueID'] );
    }

    $wrapper_attributes .= get_block_wrapper_attributes( array( 'class' => implode( ' ', $classes ) ) );

    // Check if linking is enabled
    if ( isset( $attributes['contentLinkEnable'] ) && $attributes['contentLinkEnable'] ) {
        $link_url = '';
	if ( isset( $attributes['contentLinkUrl'] ) && $attributes['contentLinkUrl'] ) {
        switch ( $attributes['contentLinkUrl'] ) {
            case 'post_url':
                $link_url = get_the_permalink( $post_id );
                break;
            case 'archive_url':
                $link_url = get_post_type_archive_link( get_post_type( $post_id ) );
                break;
            case 'author_url':
                $link_url = get_author_posts_url( get_post_field( 'post_author', $post_id ) );
                break;
            case 'site_url':
                $link_url = get_home_url();
                break;
            case 'comments_url':
                $link_url = get_comments_link( $post_id );
                break;
            case 'featured_img_url':
                $link_url = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
                break;
            default:
                $link_url = '';
        }
	}
        if ( $link_url ) {
			$link_target = isset( $attributes['linkTarget'] ) ? esc_attr( $attributes['linkTarget'] ) : '_self';
            $rel   = ! empty( $attributes['rel'] ) ? 'rel="' . esc_attr( $attributes['rel'] ) . '"' : '';
            $display_content = sprintf(
                '<a href="%1$s" target="%2$s" %3$s>%4$s</a>',
                esc_url( $link_url ),
                $link_target,
                $rel,
                esc_html( $display_content )
            );
        }
    }

    // Return the complete block HTML
    return sprintf(
        '<%1$s %2$s>%3$s</%1$s>',
        esc_attr( $tag_name ),
        $wrapper_attributes,
        $display_content
    );
}


function vayu_advance_heading_style($attr){ 

	$OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);

	$css = '';

	if(isset( $attr['uniqueId'] )){

		$css .= ".{$attr['uniqueId']} a{";

			
			//heading color
		    $css .= isset( $attr['headingColor'] ) ? "color:{$attr['headingColor']};" : '';
			// Font family
			if (isset($attr['fontFamily'])) {
				$css .= "font-family: '{$attr['fontFamily']}', sans-serif; ";
			}

			if (isset($attr['headingimage']) && !empty($attr['headingimage'])) {
				
				$css .= "background-image: url(" . esc_url($attr['headingimage']) . "); ";
			}			

			if (isset($attr['fontVariant'])) {
				$fontVariant = isset($attr['fontVariant']) ? $attr['fontVariant'] : 'normal';
				$css .= "font-weight:{$fontVariant}; ";
			}
		$css .= "}";

		$css .= ".{$attr['uniqueId']} a:hover{";
			//heading color
			$css .= isset( $attr['headingHvrColor'] ) ? "color:{$attr['headingHvrColor']};" : '';
			
		$css .= "}";


		$css .= ".{$attr['uniqueId']} {";
	
		//heading color
		$css .= isset( $attr['headingColor'] ) ? "color:{$attr['headingColor']};" : '';
		if (isset($attr['headingimage']) && !empty($attr['headingimage'])) {
				
			$css .= "background-image: url(" . esc_url($attr['headingimage']) . "); ";
		}
	
		//heading background
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

		// Text alignment
		$css .= isset($attr['align']) ? "text-align: {$attr['align']}; " : '';

		// Font size
		if (isset($attr['fontSize'])) {
			$fontSizeUnit = isset($attr['fontSizeUnit']) ? $attr['fontSizeUnit'] : 'px';
			$css .= "font-size: {$attr['fontSize']}{$fontSizeUnit}; ";
		}

		// Line height
		if (isset($attr['lineHeight'])) {
			$lineHeightUnit = isset($attr['lineHeightUnit']) ? $attr['lineHeightUnit'] : 'px';
			$css .= "line-height: {$attr['lineHeight']}{$lineHeightUnit}; ";
		}

		// Letter spacing
		if (isset($attr['letterSpacing'])) {
			$letterSpacingUnit = isset($attr['letterSpacingUnit']) ? $attr['letterSpacingUnit'] : 'px';
			$css .= "letter-spacing: {$attr['letterSpacing']}{$letterSpacingUnit}; ";
		}

		// Font family
		if (isset($attr['fontFamily'])) {
			$css .= "font-family: '{$attr['fontFamily']}', sans-serif; ";
		}

		if (isset($attr['fontVariant'])) {
			$fontVariant = isset($attr['fontVariant']) ? $attr['fontVariant'] : 'normal';
			$css .= "font-weight:{$fontVariant}; ";
		}

		// Width
		if (isset($attr['widthType'])) {
			if ($attr['widthType'] == 'inlinewidth') {
				$css .= "display: inline-flex; ";
			} elseif ($attr['widthType'] == 'customwidth' && isset($attr['customWidth'])) {
				$customWidthUnit = isset($attr['customWidthUnit']) ? $attr['customWidthUnit'] : 'px';
				$css .= "max-width: {$attr['customWidth']}{$customWidthUnit}; ";
			}
		}

		//padding
		if (isset($attr['Padding']) && is_array($attr['Padding'])){
			$css .= $OBJ_STYLE ->dimensions('Padding', 'padding', 'Desktop');	
		} 
        //margin
		if (isset($attr['Margin']) && is_array($attr['Margin'])){
			$css .= $OBJ_STYLE ->dimensions('Margin', 'margin', 'Desktop');;	
		}
		//border
		$css .= $OBJ_STYLE->borderRadiusShadow('advBorder','advBorderRadius','advDropShadow','Desktop');
		
		
		//z-index
		$css .= isset( $attr['zindex'] ) ? "z-index:{$attr['zindex'] };" : '';

		
		
	
		//transition duration
		$css .= "transition: all ". (isset($attr['transitionAll']) ? $attr['transitionAll'] : '0.2' ). "s ease;";

		//position property

		$css .= "position: " . (isset($attr['position']) ? $attr['position'] : 'inherit;' ). ";";
		
		if(isset($attr['horizontalOrientation']) && 'left' === $attr['horizontalOrientation']  && 'inherit' !== $attr['position']){
			$horizontalOrientationOffset = isset($attr['horizontalOrientationOffset']) ? $attr['horizontalOrientationOffset'] : '0';
			$horizontalOrientationOffsetUnit = isset($attr['horizontalOrientationOffsetUnit']) ? $attr['horizontalOrientationOffsetUnit'] : 'px';
            $css .= "left: {$horizontalOrientationOffset}{$horizontalOrientationOffsetUnit};";
		}
		if(isset($attr['horizontalOrientation']) && 'right' === $attr['horizontalOrientation'] && 'inherit' !== $attr['position']){
			$horizontalOrientationOffsetRight = isset($attr['horizontalOrientationOffsetRight']) ? $attr['horizontalOrientationOffsetRight'] : '0';
			$horizontalOrientationOffsetRightUnit = isset($attr['horizontalOrientationOffsetRightUnit']) ? $attr['horizontalOrientationOffsetRightUnit'] : 'px';
            $css .= "right: {$horizontalOrientationOffsetRight}{$horizontalOrientationOffsetRightUnit};";
		}
		if(isset($attr['verticalOrientation']) && 'top' === $attr['verticalOrientation'] && 'inherit' !== $attr['position']){
			$verticalOrientationOffsetTop = isset($attr['verticalOrientationOffsetTop']) ? $attr['verticalOrientationOffsetTop'] : '0';
			$verticalOrientationOffsetTopUnit = isset($attr['verticalOrientationOffsetTopUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
            $css .= "top: {$verticalOrientationOffsetTop}{$verticalOrientationOffsetTopUnit};";
		}
		if(isset($attr['verticalOrientation']) && 'bottom' === $attr['verticalOrientation'] && 'inherit' !== $attr['position']){
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


		$css .= ".{$attr['uniqueId']}:hover { ";
	
			//heading hvr color
		    $css .= isset( $attr['headingHvrColor'] ) ? "color:{$attr['headingHvrColor']};" : '';
			//heading hvr background
			if ( isset( $attr['backgroundTypeHvr'] ) && $attr['backgroundType'] == 'image' ) {
					$css .= isset( $attr['backgroundImageHvr']['url'] ) ? "background-image: url({$attr['backgroundImageHvr']['url']});" : '';
					$css .= isset( $attr['backgroundAttachmentHvr']) ? "background-attachment: {$attr['backgroundAttachmentHvr']};" : '';
					$css .= isset( $attr['backgroundRepeatHvr']) ? "background-repeat: {$attr['backgroundRepeatHvr']};" : '';
					$css .= isset( $attr['backgroundSizeHvr']) ? "background-size: {$attr['backgroundSizeHvr']};" : '';
					$css .= isset( $attr['backgroundPositionHvr']) ? "background-position-x: {$attr['backgroundPositionHvr']['x']}; background-position-y: {$attr['backgroundPositionHvr']['y']};" : '';
			}
			elseif( isset( $attr['backgroundTypeHvr'] ) && $attr['backgroundTypeHvr'] == 'gradient' ){
					$css .= isset( $attr['backgroundGradientHvr'] ) ? "background-image:{$attr['backgroundGradientHvr']};" : '';  
			}else{
					$css .= isset( $attr['backgroundColorHvr'] ) ? "background-color:{$attr['backgroundColorHvr']};" : '';
			}

			//border hover
			$css .= $OBJ_STYLE->borderRadiusShadow('advBorderHvr','advBorderRadiusHvr','advDropShadowHvr','Desktop','Hover');

			$css .= "transition: all ". (isset($attr['transitionAll']) ? $attr['transitionAll'] : '0.2' ). "s ease;";

			$css .= "}";

			$css .= "@media only screen and (max-width: 768px) { .{$attr['uniqueId']} {";
			$css .= (isset($attr['fontSizeTablet']) ? "font-size:{$attr['fontSizeTablet']}" . (isset($attr['fontSizeUnit']) ? $attr['fontSizeUnit'] : 'px') . ";" : '');
			$css .= (isset($attr['lineHeightTablet']) ? "line-height:{$attr['lineHeightTablet']}" . (isset($attr['lineHeightUnit']) ? $attr['lineHeightUnit'] : 'px') . ";" : '');
		    $css .= (isset($attr['letterSpacingTablet']) ? "letter-spacing:{$attr['letterSpacingTablet']}" . (isset($attr['letterSpacingUnit']) ? $attr['letterSpacingUnit'] : 'px') . ";" : '');
			$css .= (isset($attr['alignTablet']) ? "text-align:{$attr['alignTablet']};" : '');
			$css .= (isset($attr['widthType']) && $attr['widthType']=='customwidth' ? "max-width:".(isset($attr['customWidthTablet']) ? ($attr['customWidthTablet']):'')."" . (isset($attr['customWidthUnit']) ? $attr['customWidthUnit'] : 'px') . ";" : '' );
           
			$css .= (isset($attr['zindexTablet']) ? "z-index:{$attr['zindexTablet']};}" : '');
			
			//padding
		if (isset($attr['Padding']) && is_array($attr['Padding'])){
			$css .= $OBJ_STYLE ->dimensions('Padding', 'padding', 'Tablet');
		} 
        //margin
		if(isset($attr['Margin']) && is_array($attr['Margin'])){
			$css .= $OBJ_STYLE ->dimensions('Margin', 'margin', 'Tablet');	
		}
            
		$css .= $OBJ_STYLE->borderRadiusShadow('advBorder','advBorderRadius','advDropShadow','Tablet');


			//position

			if(isset($attr['horizontalOrientation']) && 'left' === $attr['horizontalOrientation']  && 'inherit' !== $attr['position']){
				$horizontalOrientationOffsetTablet = isset($attr['horizontalOrientationOffsetTablet']) ? $attr['horizontalOrientationOffsetTablet'] : '0';
				$horizontalOrientationOffsetUnit = isset($attr['horizontalOrientationOffsetUnit']) ? $attr['horizontalOrientationOffsetUnit'] : 'px';
				$css .= "left: {$horizontalOrientationOffsetTablet}{$horizontalOrientationOffsetUnit};";
			}
			if(isset($attr['horizontalOrientation']) && 'right' === $attr['horizontalOrientation'] && 'inherit' !== $attr['position']){
				$horizontalOrientationOffsetRightTablet = isset($attr['horizontalOrientationOffsetRightTablet']) ? $attr['horizontalOrientationOffsetRightTablet'] : '0';
				$horizontalOrientationOffsetRightUnit = isset($attr['horizontalOrientationOffsetRightUnit']) ? $attr['horizontalOrientationOffsetRightUnit'] : 'px';
				$css .= "right: {$horizontalOrientationOffsetRightTablet}{$horizontalOrientationOffsetRightUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'top' === $attr['verticalOrientation'] && 'inherit' !== $attr['position']){
				$verticalOrientationOffsetTopTablet = isset($attr['verticalOrientationOffsetTopTablet']) ? $attr['verticalOrientationOffsetTopTablet'] : '0';
				$verticalOrientationOffsetTopUnit = isset($attr['verticalOrientationOffsetTopUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
				$css .= "top: {$verticalOrientationOffsetTopTablet}{$verticalOrientationOffsetTopUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'bottom' === $attr['verticalOrientation'] && 'inherit' !== $attr['position']){
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

			$css .= "}}";

			$css .= "@media only screen and (max-width: 768px) { .{$attr['uniqueId']}:hover {";
			$css .= $OBJ_STYLE->borderRadiusShadow('advBorderHvr','advBorderRadiusHvr','advDropShadowHvr','Tablet','Hover');
			$css .= "}}";

			// for mobile view

			$css .= "@media only screen and (max-width: 767px) { .{$attr['uniqueId']}{";
				$css .=(isset($attr['fontSizeMobile']) ? "font-size:{$attr['fontSizeMobile']}" . (isset($attr['fontSizeUnit']) ? $attr['fontSizeUnit'] : 'px') . ";" : '');
				$css .=(isset($attr['lineHeightMobile']) ? "line-height:{$attr['lineHeightMobile']}" . (isset($attr['lineHeightUnit']) ? $attr['lineHeightUnit'] : 'px') . ";" : '');
				$css .=(isset($attr['letterSpacingMobile']) ? "letter-spacing:{$attr['letterSpacingMobile']}" . (isset($attr['letterSpacingUnit']) ? $attr['letterSpacingUnit'] : 'px') . ";" : '');
				$css .=(isset($attr['alignMobile']) ? "text-align:{$attr['alignMobile']};" : '');
				$css .= (isset($attr['widthType']) && $attr['widthType']=='customwidth' ? "max-width:".(isset($attr['customWidthMobile']) ? ($attr['customWidthMobile']):'')."" . (isset($attr['customWidthUnit']) ? $attr['customWidthUnit'] : 'px') . ";" : '' );
				$css .=(isset($attr['zindexMobile']) ? "z-index:{$attr['zindexMobile']};" : '');
				//padding
				if (isset($attr['Padding']) && is_array($attr['Padding'])){
					$css .= $OBJ_STYLE ->dimensions('Padding', 'padding', 'Mobile');	
				} 
				//margin
				if(isset($attr['Margin']) && is_array($attr['Margin'])){
					$css .= $OBJ_STYLE ->dimensions('Margin', 'margin', 'Mobile');	
				}

            $css .=(isset($attr['zindexMobile']) ? "z-index:{$attr['zindexMobile']};" : '');
            // Border
			$css .= $OBJ_STYLE->borderRadiusShadow('advBorder','advBorderRadius','advDropShadow','Mobile');

				//position

			if(isset($attr['horizontalOrientation']) && 'left' === $attr['horizontalOrientation']  && 'inherit' !== $attr['position']){
				$horizontalOrientationOffsetMobile = isset($attr['horizontalOrientationOffsetMobile']) ? $attr['horizontalOrientationOffsetMobile'] : '0';
				$horizontalOrientationOffsetUnit = isset($attr['horizontalOrientationOffsetUnit']) ? $attr['horizontalOrientationOffsetUnit'] : 'px';
				$css .= "left: {$horizontalOrientationOffsetMobile}{$horizontalOrientationOffsetUnit};";
			}
			if(isset($attr['horizontalOrientation']) && 'right' === $attr['horizontalOrientation'] && 'inherit' !== $attr['position']){
				$horizontalOrientationOffsetRightMobile = isset($attr['horizontalOrientationOffsetRightMobile']) ? $attr['horizontalOrientationOffsetRightMobile'] : '0';
				$horizontalOrientationOffsetRightUnit = isset($attr['horizontalOrientationOffsetRightUnit']) ? $attr['horizontalOrientationOffsetRightUnit'] : 'px';
				$css .= "right: {$horizontalOrientationOffsetRightMobile}{$horizontalOrientationOffsetRightUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'top' === $attr['verticalOrientation'] && 'inherit' !== $attr['position']){
				$verticalOrientationOffsetTopMobile = isset($attr['verticalOrientationOffsetTopMobile']) ? $attr['verticalOrientationOffsetTopMobile'] : '0';
				$verticalOrientationOffsetTopUnit = isset($attr['verticalOrientationOffsetTopUnit']) ? $attr['verticalOrientationOffsetBottomUnit'] : 'px';
				$css .= "top: {$verticalOrientationOffsetTopMobile}{$verticalOrientationOffsetTopUnit};";
			}
			if(isset($attr['verticalOrientation']) && 'bottom' === $attr['verticalOrientation'] && 'inherit' !== $attr['position']){
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

			$css .= "}}";
            // for mobile view hover

			$css .= "@media only screen and (max-width: 767px) { .{$attr['uniqueId']}:hover{";
				// Border (Hover)
				$css .= $OBJ_STYLE->borderRadiusShadow('advBorderHvr','advBorderRadiusHvr','advDropShadowHvr','Mobile','Hover');
			$css .= "}}";

			if (isset($attr['responsiveTogHideDesktop']) && $attr['responsiveTogHideDesktop'] == true){
				$css .= "@media only screen and (min-width: 1024px){.{$attr['uniqueId']}{display:none;} }";
			}
			
			if (isset($attr['responsiveTogHideTablet']) && $attr['responsiveTogHideTablet'] == true){
				$css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) {.{$attr['uniqueId']}{display:none;}}";
			}
			
			if (isset($attr['responsiveTogHideMobile']) && $attr['responsiveTogHideMobile'] == true){
				$css .= "@media only screen and (max-width: 767px) {.{$attr['uniqueId']}{display:none;}}";
			}


    }


	return $css;
}