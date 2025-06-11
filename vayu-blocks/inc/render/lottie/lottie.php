<?php
if (!defined('ABSPATH')) {
    exit;
}
  
class Vayu_blocks_lottie {

    private $attr;
    private $content;

    public function __construct($attr,$content) {
        $this->attr = $attr;
        $this->content = $content;
    }

    //Render
    public function render() {
        ob_start();

        echo $this->render_lottie();

        return ob_get_clean();
    }

    private function render_lottie() {
        return null; 
    }

}

function vayu_block_lottie_render($attr,$content) {

    if ((new VAYUBLOCKS_DISPLAY_CONDITION($attr))->display()) {
        return ;
    }
    $default_attributes = include('defaultattributes.php');
    $attr = array_merge($default_attributes, $attr);
    $lottie = new Vayu_blocks_lottie($attr,$content);

    return $lottie->render();
    
} 