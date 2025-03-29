<?php

class VAYUBLOCKS_RESPONSIVE_STYLE{

    public static $attribute = array();


    public function __construct($attr){
        self::$attribute = $attr;
    }

    // function border($borderData,$radiusDataHover = []) {
    //     $value = $borderData;
    //     if (isset($value['width'])) {
    //         return sprintf("border: %s %s %s;",
    //             $value['width'],
    //             ($value['style'] === 'none' ? 'solid' : $value['style']),
    //             isset($value['color']) ? $value['color'] : ''
    //         );
    //     }
    //     $borderStyles = [];
    //     foreach ($value as $side => $val) {
    //         if (isset($val['width'], $val['style'], $val['color'])) {
    //             $borderStyles[] = sprintf("border-%s: %s %s %s;",
    //                 $side,
    //                 $val['width'],
    //                 $val['style'],
    //                 $val['color']
    //             );
    //         }
    //     }
    //     return implode(" ", $borderStyles);
    // }


    // function borderRadius($borderRadius) {

    //     if (isset($borderRadius['width'])) {
    //         return "border-radius: " . $borderRadius['width'] . ";";
    //     }
    
    //     return sprintf(
    //         "border-top-left-radius: %s; border-top-right-radius: %s; border-bottom-right-radius: %s; border-bottom-left-radius: %s;",
    //         isset($borderRadius['top']['width']) ? $borderRadius['top']['width'] : '0px',
    //         isset($borderRadius['right']['width']) ? $borderRadius['right']['width'] : '0px',
    //         isset($borderRadius['bottom']['width']) ? $borderRadius['bottom']['width'] : '0px',
    //         isset($borderRadius['left']['width']) ? $borderRadius['left']['width'] : '0px'
    //     );
    // }



    function border($borderData, $mainBorder = []) {
        $value = isset($borderData) ? $borderData : [];
        $valueHover = isset($mainBorder) ? $mainBorder : [];
    
        if (empty($value)) {
            return ""; // Return empty string if no border styles exist
        }
    
        // Generate full border property if 'width' exists
        $borderParts = array_filter([
            isset($value['width']) ? $value['width'] : (isset($valueHover['width']) ? $valueHover['width'] : null),
            isset($value['style']) ? $value['style'] : (isset($valueHover['style']) ? $valueHover['style'] : null),
            isset($value['color']) ? $value['color'] : (isset($valueHover['color']) ? $valueHover['color'] : null),
        ]);
    
        $css = "";
        
        if (isset($value['top'])) {
            foreach ($value as $side => $val) {
                $css .= sprintf(
                    "border-%s: %s;\n",
                    $side,
                    implode(" ", array_filter([
                        isset($val['width']) ? $val['width'] : (isset($valueHover[$side]['width']) ? $valueHover[$side]['width'] : null),
                        isset($val['style']) ? $val['style'] : (isset($valueHover[$side]['style']) ? $valueHover[$side]['style'] : null),
                        isset($val['color']) ? $val['color'] : (isset($valueHover[$side]['color']) ? $valueHover[$side]['color'] : null),
                    ]))
                );
            }
        } else {
            if (!empty($borderParts)) {
                $css .= "border: " . implode(" ", $borderParts) . ";\n";
            }
        }
    
        return trim($css); // Remove extra whitespace
    }
    

    function borderRadius($radiusData, $radiusDataHover = []) {
        $borderRadius = isset($radiusData) ? $radiusData : [];
        $borderRadiusHover = isset($radiusDataHover) ? $radiusDataHover : [];

        if (empty($borderRadius)) {
            // If object is empty, return default empty array
            return [];
        }
    
        if (!isset($borderRadius['top'])) {
            return "border-radius: " . $borderRadius['width'] . ";";
        }
    
        $styles = [
            "border-top-left-radius" => $borderRadius['top']['width'] ?? $borderRadiusHover['top']['width'] ?? "0px",
            "border-top-right-radius" => $borderRadius['right']['width'] ?? $borderRadiusHover['right']['width'] ?? "0px",
            "border-bottom-right-radius" => $borderRadius['bottom']['width'] ?? $borderRadiusHover['bottom']['width'] ?? "0px",
            "border-bottom-left-radius" => $borderRadius['left']['width'] ?? $borderRadiusHover['left']['width'] ?? "0px",
        ];

            // Convert array to CSS string
    $css = "";
    foreach ($styles as $property => $value) {
        $css .= $property . ": " . $value . "; ";
    }

    return trim($css);

    }
    


    function boxShadow($boxshadow) {

        return 'box-shadow:'.$boxshadow['css'].';';
    }

    function borderRadiusShadow($border,$radius,$shadow,$device='Desktop',$hover=''){   
        
        $style = ''; 
        if(isset(self::$attribute[$border][$device])){
            $style .= $hover==='Hover'? $this->border(self::$attribute[$border.'Hover'][$device],self::$attribute[$border][$device]):$this->border(self::$attribute[$border][$device]);
        }
        if(isset(self::$attribute[$radius][$device])){
            $style .= $hover==='Hover'? $this->borderRadius(self::$attribute[$radius.'Hover'][$device],self::$attribute[$radius][$device]):$this->borderRadius(self::$attribute[$radius][$device]);
       
            
        }
        if(isset(self::$attribute[$shadow][$device])){
            if(self::$attribute[$shadow][$device]['elements']['elevation']!='none'){
                $style .= $this->boxShadow(self::$attribute[$shadow][$device]);
            }
        }
        return $style;
    }


    function dimensions($dimensions,$type='paddding',$device='Desktop') {
        if(!empty(self::$attribute[$dimensions][$device])){
            $dim = self::$attribute[$dimensions][$device];
            $css =  "{$dim['top']} {$dim['right']} {$dim['bottom']} {$dim['left']}";
            return "$type: $css;";
        }
    }
    

}