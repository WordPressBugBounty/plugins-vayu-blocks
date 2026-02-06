<?php 

function vayu_blocks_register_assets(){

	wp_register_style(
		'animate.compact',
		VAYU_BLOCKS_URL .'inc/assets/css/animate.compact.css',
		array(),
		null
	);	

	wp_register_style(
		'vayu-blocks-global-main',
		VAYU_BLOCKS_URL .'inc/assets/css/global.css',
			array(),	
				null
		);

		wp_register_style(
		'vayu-blocks-frontend',
		plugin_dir_url( __FILE__ ) . 'build/style-multi-block-editor.css',
	);

	/** script enqueue */

		wp_register_script(
		'vayu-blocks-frontend',
		plugin_dir_url( __FILE__ ) . 'build/multi-block-frontend.js',
		array(),
		null,
		true
	);

		wp_register_style(
		'th-icon',
		VAYU_BLOCKS_URL .'inc/th-icon/style.css',
			array(),	
				null
		);
}
add_action('init','vayu_blocks_register_assets');


function vayu_blocks_enqueue_block_assets() {
	wp_enqueue_style('animate.compact');
		wp_enqueue_style('vayu-blocks-global-main');


}

add_action( 'enqueue_block_assets', 'vayu_blocks_enqueue_block_assets' );


function vayu_blocks_multiblock_enqueue_block_assets() {
	$dependencies =   require_once VAYU_BLOCKS_DIR_PATH .'public/build/multi-block-editor.asset.php';

	// wp_enqueue_style(
	// 	'vayu-blocks-frontend',
	// 	plugin_dir_url( __FILE__ ) . 'build/style-multi-block-editor.css',
	// );

	 wp_enqueue_style('vayu-blocks-frontend');

		wp_enqueue_style(
		'vayu-blocks-editor',
		plugin_dir_url( __FILE__ ) . 'build/multi-block-editor.css',
		array(),
		null
	);


		wp_enqueue_script(
		'vayu-blocks-editor',
		plugin_dir_url( __FILE__ ) . 'build/multi-block-editor.js',
		$dependencies['dependencies'],
		$dependencies['version'],
		false
	);


}
add_action( 'enqueue_block_editor_assets', 'vayu_blocks_multiblock_enqueue_block_assets' );



function vayu_blocks_multiblock_enqueue_frontend_assets() {

	wp_enqueue_style('th-icon');
	 wp_enqueue_style('vayu-blocks-frontend');
	 wp_enqueue_style('vayu-blocks-global-main');
     wp_add_inline_style( 'vayu-blocks-global-main', vayu_render_server_side_css());

	 wp_enqueue_script('vayu-blocks-frontend');
}
add_action( 'wp_enqueue_scripts', 'vayu_blocks_multiblock_enqueue_frontend_assets',9);