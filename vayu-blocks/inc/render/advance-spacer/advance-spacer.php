<?php 

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 

function vayu_advance_spacer_style($attr){
    
  $css = '';


   // THESE  4 LINES to be add to implement NEW Advance tab styles
   $uniqueId = $attr['uniqueId'];
   $OBJ_STYLE = new VAYUBLOCKS_RESPONSIVE_STYLE($attr);
   $wrapper = '.vayu-spacer-' . esc_attr($uniqueId);
   $css .= $OBJ_STYLE->advanceStyle($wrapper);
   // THESE  4 LINES to be add to implement NEW Advance tab styles


    if(isset( $attr['uniqueId'] )){
      $css .= ".vayu-spacer-{$attr['uniqueId']}{";
        //Width
        if( isset($attr['widthType']) && $attr['widthType'] == 'fullwidth' ){
          $css .= "width: 100%;max-width: 100%!important;";
        }
        elseif( isset($attr['widthType']) && $attr['widthType'] == 'inlinewidth' ){
          $css .= "width: auto;display: inline-flex;";
        }
        elseif( isset($attr['widthType']) && $attr['widthType'] == 'customwidth' ){
          $css .= isset($attr['customWidth']['Desktop']) ? "width: {$attr['customWidth']['Desktop']};" : "width: 650px;";
          $css .= isset($attr['customWidth']['Desktop']) ? "max-width: {$attr['customWidth']['Desktop']};" : "max-width: 650px;";
        }
        else {
          $css .= "width: 100%;display: flex;";
        }

        //Height
		    $css .= isset($attr['height']['Desktop']) ? "height: {$attr['height']['Desktop']};" : "height: 50px;";

     $css .= "}"; 


     //HOVER CSS
     $css .= ".vayu-spacer-{$attr['uniqueId']}:hover{";

     $css .= "}";

     //    tablet view
     $css .= "@media only screen and (min-width: 768px) and (max-width: 1023px) {";

     $css .= ".vayu-spacer-{$attr['uniqueId']}{";

	    $css .= isset($attr['height']['Tablet']) ? "height: {$attr['height']['Tablet']};" : "";

      $css .= ( isset($attr['widthType']) && $attr['widthType'] === 'customwidth' && isset($attr['customWidth']['Tablet']) && !empty($attr['customWidth']['Tablet']) )
    ? "width: " . esc_attr($attr['customWidth']['Tablet']) . ";"
    : '';

    $css .= ( isset($attr['widthType']) && $attr['widthType'] === 'customwidth' && isset($attr['customWidth']['Tablet']) && !empty($attr['customWidth']['Tablet']) )
    ? "max-width: " . esc_attr($attr['customWidth']['Tablet']) . ";"
    : '';
      

      $css .= "}";

     $css .= "}";

     
     //    Mobile view
    $css .= "@media screen and (max-width: 767px){";
    $css .= ".vayu-spacer-{$attr['uniqueId']}{";
    
	    $css .= isset($attr['height']['Mobile']) ? "height: {$attr['height']['Mobile']};" : "";

      $css .= ( isset($attr['widthType']) && $attr['widthType'] === 'customwidth' && isset($attr['customWidth']['Mobile']) && !empty($attr['customWidth']['Mobile']) )
      ? "width: " . esc_attr($attr['customWidth']['Mobile']) . ";"
      : '';
  
      $css .= ( isset($attr['widthType']) && $attr['widthType'] === 'customwidth' && isset($attr['customWidth']['Mobile']) && !empty($attr['customWidth']['Mobile']) )
      ? "max-width: " . esc_attr($attr['customWidth']['Mobile']) . ";"
      : '';

    $css .= "}";

    $css .= "}";

    }

    return $css;

}