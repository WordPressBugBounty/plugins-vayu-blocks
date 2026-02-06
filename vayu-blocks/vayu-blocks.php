<?php
/**
 * Plugin Name:       Vayu Blocks
*  Plugin URI:         https://themehunk.com/vayu-blocks
 * Description:       The Vayu Blocks is an add-on plugin For Gutenberg Block Editor. Quickstart the Gutenberg editor with Powerful and elegant blocks to design stunning websites. Free Vayu Blocks plugin that amplifies the default WordPress Gutenberg Editor with powerful blocks.
 * Requires at least: 6.2
 * Requires PHP:      7.4
 * Version:           1.4.4
 * Author:            ThemeHunk
 * Author URI:        https://themehunk.com
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:       vayu-blocks
 *
 * @package           vayu-blocks
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit;
} 
define( 'VAYU_BLOCKS_VERSION', '1.4.4' );
define( 'VAYU_BLOCKS_BASEFILE', __FILE__ );
define( 'VAYU_BLOCKS_URL', plugins_url( '/', __FILE__ ) );
define( 'VAYU_BLOCKS_PATH', dirname( __FILE__ ) );
define( 'VAYU_BLOCKS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'VAYU_BLOCKS_PRO_SUPPORT', true );
define( 'VAYU_BLOCKS_SHOW_NOTICES', false );


class Vayu_Block_Plugin {

	/**
	 * Plugin version.
	 *
	 * @var string
	*/
	const VERSION = VAYU_BLOCKS_VERSION;

	/**
	 * Initialize the plugin.
	*/

    public function __construct() {
        
        require_once VAYU_BLOCKS_DIR_PATH .'inc/init.php';
        require_once VAYU_BLOCKS_DIR_PATH .'public/init.php';
        add_action('admin_menu',  array( $this, 'vayu_plugin_menu'));

    }
    

    // plugin menu option add
    public function vayu_plugin_menu() {
        add_menu_page(
            'Vayu Blocks',
            'Vayu Blocks',
            'manage_options', 
            'vayu-blocks',
            array( $this, 'vayu_plugin_page_callback' ),
            plugins_url( 'vayu-blocks/inc/assets/img/menu-logo.png' ),
            59
        );

         add_submenu_page(
            'vayu-blocks',
            'Blocks',
            'Blocks',
            'manage_options', 
            'vayu-blocks',
            array( $this, 'vayu_plugin_page_callback' ),
        );

            add_submenu_page(
            'vayu-blocks',
            'Settings',
            'Settings',
            'manage_options',
            'vayu-blocks-settings',
            array( $this, 'vayu_plugin_page_callback' )
        );

        add_submenu_page(
            'vayu-blocks',
            'Starter Templates',
            'Starter Templates',
            'manage_options',
            'vayu-sites',
            array( $this, 'vayu_plugin_page_callback' )
        );

    }

    public function vayu_blocks_sites_callback() {
        ?>
        <div class="themehunk-sites-menu-page-wrapper">
            <div id="vayuroot"></div>
        </div>
        <?php
    }
    
    public function vayu_plugin_page_callback() {
        
		if ( ! current_user_can( 'manage_options' ) ) {
				return;
		}?>

        <div class="vayu-blocks-wrap">
        <div id="vayu-blocks-container"></div>
        </div>

    <?php }

}


function vayu_block_plugin_init() {
    new Vayu_Block_Plugin();
}
add_action( 'init', 'vayu_block_plugin_init', 1 );




/**
 * Adds a custom template part area for mega menus to the list of template part areas.
 *
 * @param array $areas Existing array of template part areas.
 * @return array Modified array of template part areas including the new "Menu" area.
 */
function vayu_blocks_mega_menu_template_part_areas( array $areas ) {
	$areas[] = array(
		'area'        => 'menu',
		'area_tag'    => 'div',
		'description' => __( 'Menu templates are used to create sections of a mega menu.', 'mega-menu-block' ),
		'icon'        => '',
		'label'       => __( 'Menu', 'mega-menu-block' ),
	);

	return $areas;
}
// add_filter( 'default_wp_template_part_areas', 'vayu_blocks_mega_menu_template_part_areas' );
// require_once VAYU_BLOCKS_DIR_PATH .'inc/patterns/single.php';