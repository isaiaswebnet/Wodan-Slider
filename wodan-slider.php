<?php

/*
	
	Plugin Name: Wodan Slider
	Description: The responsive slideshow for WordPress theme.
	Plugin URI: http://skynetsites.com.br
	Author: Isaias oliveira
	Author URI: http://skynetsites.com.br
	Version: 1.0
	Text Domain: Wodan Slider
	License: GPLv2 or later

*/

define( PLUGIN_DIR_URL, plugin_dir_url( __FILE__ ) );
define( PLUGIN_DIR_ASSETS, PLUGIN_DIR_URL . 'assets/' );
define( EDIT_POST, admin_url( 'edit.php' ) );
define( EDIT_POST_SLIDER, admin_url( 'edit.php?post_type=wodanslider' ) );
	
function wodanslider_settings_options() {
		
	$wodan_options = get_option( 'wodanslider_options' );
		
	if ( $wodan_options['wodan_showposts'] == '' ) {

		$wodan_settings_args = array(
			
			'wodan_posttype'   => 'wodanslider',
			'wodan_showposts'  => '3',
			'wodan_hover'      => 'wodan-slider-grow',
				
		);	
			
			update_option( 'wodanslider_options', $wodan_settings_args );
	
	}

}
	
if ( is_admin() ) {
	
	include( 'includes/wodan-slider-cpt.php' );

	include( 'includes/wodan-slider-option.php' );
	
}

function wodanslider_assets() {
		
	if( !is_admin() ) {
			
		wp_enqueue_style( 'wodanslider-style', PLUGIN_DIR_ASSETS . 'css/wodanslider.style.css', array(), '1.0' );
		wp_enqueue_style( 'wodanslider-hover', PLUGIN_DIR_ASSETS . 'css/wodanslider.hover.css', array(), '1.0' );
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'wodanslider-script', PLUGIN_DIR_ASSETS . 'js/wodanslider.script.js', array( 'jquery' ) );
	
	}
		
}
	
function wodanslider_image_size() {
		
	add_image_size( 'wodan-large-img', 600, 600, true );
	add_image_size( 'wodan-medium-img', 600, 300, true);
		
	the_post_thumbnail( 'wodan-large-img' );
	the_post_thumbnail( 'wodan-medium-img' );
		
}
	
function wodanslider_shortcode() {
	
	$fonts = "<style>
				@font-face {
					font-family: 'opensans-bold';
					src: url('fonts/opensans-bold-webfont.eot');
					src: url('" . PLUGIN_DIR_ASSETS . "fonts/opensans-bold-webfont.eot?#iefix') format('embedded-opentype'), 
					url('" . PLUGIN_DIR_ASSETS . "fonts/opensans-bold-webfont.woff') format('woff'), 
					url('" . PLUGIN_DIR_ASSETS . "fonts/opensans-bold-webfont.ttf') format('truetype'), 
					url('" . PLUGIN_DIR_ASSETS . "fonts/opensans-bold-webfont.svg#opensans-bold') format('svg');
					font-style: normal;
					font-weight: normal
				}
			</style>";

	if( !is_admin() ) {
	
		echo $fonts;
	
		include( 'includes/wodan-slider-view.php' );

	}
		
}
	
register_activation_hook( __FILE__, 'wodanslider_settings_options' );
add_action( 'wp_enqueue_scripts', 'wodanslider_assets' );
add_action( 'plugins_loaded', 'wodanslider_image_size' );
add_shortcode( 'wodan_slider', 'wodanslider_shortcode' );