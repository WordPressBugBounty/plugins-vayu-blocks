<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
     
class Vayu_blocks_video {

    private $attr; //attributes
    private $device_type;

    public function __construct($attr,$content) {
        $this->attr = $attr;
        $this->content = $content;
        $this->device_type = $this->get_device_type();
    }

    //Render
    public function render() {
        ob_start(); // Start output buffering
        echo $this->render_image();
        return ob_get_clean(); // Return the buffered output
    }

    //main container containing image and overlay
    private function render_image() {
        $attributes = $this->attr; // Access attributes
        $image_html = '';
        $uniqueId = isset($attributes['uniqueId']) ? esc_attr($attributes['uniqueId']) : '';
        $imageSrc = !empty($attributes['image']) ? esc_url($attributes['image']) :  plugins_url('../../assets/img/no-image.png', __FILE__);

        $imageAlt = isset($attributes['imagealttext']) ? esc_attr($attributes['imagealttext']) : 'Image ' . rand(1, 100);
        $imageHvrEffect = isset($attributes['imagehvreffect']) ? esc_attr($attributes['imagehvreffect']) : '';
        $imageHvrAnimation = isset($attributes['imagehvranimation']) ? esc_attr($attributes['imagehvranimation']) : '';
        $imageHvrFilter = isset($attributes['imagehvrfilter']) ? esc_attr($attributes['imagehvrfilter']) : '';
        $imagemaskshape = isset($attributes['maskshape']) && $attributes['maskshape'] !== 'none' ? 'maskshapeimage' : '';
        $wrapperanimation = isset($attributes['wrapperanimation']) ? esc_attr($attributes['wrapperanimation']) : '';
        $animation_classname = '';

        if ($attributes['animationsettings'] === 'without-hvr') {
            $animation_classname = $attributes['imagehvranimation'];
        } elseif ($attributes['animationsettings'] === 'with-hvr') {
            $animation_classname = $attributes['imagehvranimation'] . 'hvr';
        } elseif ($attributes['animationsettings'] === 'one-time') {
            $animation_classname = $attributes['imagehvranimation'] . 'onetime';
        }

        $image_html .= '<div class="vayu_blocks_video__wrapper ' . $wrapperanimation . ' " id='. $uniqueId .'>';
            $image_html .= '<div class="vayu_blocks_rotating_div">';
            $image_html .= '<div class="vayu_blocks_image_image_wrapping_container ' . $imageHvrFilter . ' ' . $imageHvrEffect . ' ' . $animation_classname . '" >';   
        
                if ($this->device_type === 'Mobile'){
                    $videoSize = !empty($attributes['videosizemobile']) ? esc_attr($attributes['videosizemobile']) : 'auto';

                }elseif($this->device_type === 'Tablet'){
                    $videoSize = !empty($attributes['videosizetablet']) ? esc_attr($attributes['videosizetablet']) : 'auto';

                }else {
                    $videoSize = !empty($attributes['videosize']) ? esc_attr($attributes['videosize']) : 'auto';
                }

                // Render a video element
                $videoUrl = esc_url($attributes['videoUrl']);
                $autoplay = !empty($attributes['autoplay']) ? 'autoplay' : '';
                $loop = !empty($attributes['loop']) ? 'loop' : '';
                $controls = !empty($attributes['controls']) ? 'controls' : '';
                $muted = !empty($attributes['muted']) ? 'muted' : '';
                $poster = !empty($attributes['fallbackImageUrl']) ? esc_url($attributes['fallbackImageUrl']) : '';
                // Check for specific attributes like fullscreen, download, etc.
                $nofullscreen = !empty($attributes['nofullscreen']) ? 'nofullscreen' : '';
                $nodownload = !empty($attributes['nodownload']) ? 'nodownload' : ''; // Check for nodownload
                $noremoteplayback = !empty($attributes['noremoteplayback']) ? 'noremoteplayback' : ''; // Check for remote playback
                $noplaybackrate = !empty($attributes['noplaybackrate']) ? 'noplaybackrate' : ''; // Check for playback rate

                if ( $attributes['blockValue'] === 'mp4' && !empty($attributes['videoUrl'])) {

                    $image_html .= '<video 
                        ' .(isset($attributes['pipfront']) && $attributes['pipfront'] ? 'id="videoElement"' : '') .' 
                        width="' . $videoSize . '" 
                        class="vayu_blocks__image_image ' . $imageHvrFilter . ' ' . $imagemaskshape . '" 
                        ' . $autoplay . ' 
                        ' . $loop . ' 
                        ' . $controls . ' 
                        ' . $muted . ' 
                        poster="' . $poster . '"
                        controlsList="' . 
                            ($nofullscreen ? 'nofullscreen ' : '') .
                            ($nodownload ? 'nodownload ' : '') . 
                            ($noremoteplayback ? 'noremoteplayback ' : '') . 
                            ($noplaybackrate ? 'noplaybackrate ' : '') .'">
                        <source src="' . $videoUrl . '" type="video/mp4" />
                        Your browser does not support the video tag.
                    </video>';
                }

                else if($attributes['blockValue'] === 'you-tube' && !empty($attributes['youvideoUrl'])) {
                    $image_html .= '<iframe
                        width="' . esc_attr($attributes['videosize']) . '"
                        height="' . esc_attr($attributes['heightvideosize']) . '"
                        class="vayu_blocks__image_image ' . esc_attr($attributes['imagehvrfilter']) . ' ' . (esc_attr($attributes['maskshape']) !== 'none' ? 'maskshapeimage' : '') . '"
                        src="https://www.youtube.com/embed/' . esc_attr($attributes['youvideoUrl']) . '?' . 
                            ($attributes['youautoplay'] ? 'autoplay=1&mute=1' : '') . 
                            ($attributes['youcontrols'] ? '&controls=0' : '') . 
                            ($attributes['youloop'] ? '&loop=1&playlist=' . esc_attr($attributes['youvideoUrl']) : '') . 
                            ($attributes['startTime'] ? '&start=' . esc_attr($attributes['startTime']) : '') . '"
                        title="YouTube video player"
                        frameborder="0"
                        allow="autoplay; encrypted-media; web-share; picture-in-picture"
                        referrerpolicy="strict-origin-when-cross-origin">
                    </iframe>';

                }

            $image_html .= '</div>';
            // Append the overlay HTML

            // Conditionally append overlay HTML
            if (!empty($attributes['overlayshow']) || !empty($attributes['frameshow'])) {
                $image_html .= $this->overlay(); // Ensure this method returns valid HTML
            }

        
        $image_html .= '</div>';
        $image_html .= '</div>';

        // Check if the 'caption' attribute is not empty
        if (!empty($attributes['caption'])) {
            // Append HTML for the caption
            $image_html .= '<div class="vayu_block_caption">';
                $image_html .= '<p class="vayu_block_caption_text_para">';
                    $image_html .= esc_html($attributes['captiontext']); // Use esc_html to properly escape HTML entities
                $image_html .= '</p>';
            $image_html .= '</div>';
        }
        
        $classhover='';
        if ($attributes['animationhover']) {
            $classhover = 'vayu_blocks_hover_can_apply';
        }
    
        return '<div class="vayu-blocks-video-main-container' . $uniqueId . ' ' . $classhover .' vayu_blocks_image_image-container">' . $image_html . '</div>';
    }
    
    //overlay
    private function overlay() {
        $attributes = $this->attr; // Access attributes
        $overlay = '';
        $imageHvrEffect = isset($attributes['imagehvreffect']) ? esc_attr($attributes['imagehvreffect']) : '';
        $imageHvrAnimation = isset($attributes['imagehvranimation']) ? esc_attr($attributes['imagehvranimation']) : '';
        $overlaywrapper = isset($attributes['overlaywrapper']) ? esc_attr($attributes['overlaywrapper']) : '';

        $animation_classname = '';

        if ($attributes['animationsettings'] === 'without-hvr') {
            $animation_classname = $attributes['imagehvranimation'];
        } elseif ($attributes['animationsettings'] === 'with-hvr') {
            $animation_classname = $attributes['imagehvranimation'] . 'hvr';
        } elseif ($attributes['animationsettings'] === 'one-time') {
            $animation_classname = $attributes['imagehvranimation'] . 'onetime';
        }

        $wrapperanimation = '';
        if($attributes['wrapperanimation'] === 'vayu_block_styling-effect7'){
            $wrapperanimation = 'vayu_block_styling-overlay-effect'; 
        }

        $imagemaskshape = isset($attributes['maskshape']) && $attributes['maskshape'] !== 'none' ? 'maskshapeimage' : '';

        $overlay .= '<div class="vayu_blocks_overlay_main_wrapper_image '. $wrapperanimation .' ' . $overlaywrapper .' ' . $imageHvrEffect . ' ' . $animation_classname . ' ' . $imagemaskshape . '">';
            if(!empty($attributes['overlayshow'])){
                $overlay .= '<div class="vayu_blocks_inner_content">';
                    $overlay .= $this->content;
                $overlay .= '</div>';  
            }

        $overlay .= '</div>';
    
        return $overlay;
    }

    //device type
    private function get_device_type() {
        $tablet_browser = 0;
        $mobile_browser = 0;
        
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $tablet_browser++;
        }
        
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
            $mobile_browser++;
        }
        
        if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
            $mobile_browser++;
        }
        
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
        $mobile_agents = array(
            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
            'newt','noki','palm','pana','pant','phil','play','port','prox',
            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
            'wapr','webc','winw','winw','xda ','xda-');
        
        if (in_array($mobile_ua,$mobile_agents)) {
            $mobile_browser++;
        }
        
        if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
            $mobile_browser++;
            // Check for tablets on opera mini alternative headers
            $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
            if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
                $tablet_browser++;
            }
        }
        
        if ($tablet_browser > 0) {
            return 'Tablet';
        } else if ($mobile_browser > 0) {
            return 'Mobile';
        } else {
            return 'Desktop';
        }
    }

}

// Render callback for the block
function vayu_block_video_render($attr,$content) {
    // Include default attributes
    $default_attributes = include('defaultattributes.php');

    // Merge default attributes with provided attributes
    $attr = array_merge($default_attributes, $attr);

    // Initialize the image with the merged attributes
    $image = new Vayu_blocks_video($attr,$content);
    
    // Ensure className is sanitized and applied correctly
    $className = isset($attr['classNamemain']) ? esc_attr($attr['classNamemain']) : '';

    $animated = isset($attr['className']) ? esc_attr($attr['className']) : ''; // animation

    // Render and return the image output inside a div with the dynamic class name
    return '<div class="' . trim($className) . ' wp_block_vayu-blocks-video-main  ' . trim($animated) . '">' . $image->render() . '</div>';
} 