<?php

function wodanslider_menu() {
		
	$wodans_types = array( 'post', 'wodanslider' );
		
		foreach ( $wodans_types as $wodans_type ) {
			
			add_meta_box( 'wodanslider_field',  'Wodan Slider', 'wodanslider_meta_field', $wodans_type, 'normal', 'high');
	
	}
	
	add_submenu_page( 'edit.php?post_type=wodanslider', 'Configurações Gerais | Wodan Slider', 'Configurações', 'manage_options',  'wodanslider_settings', 'wodanslider_settings_page' );
		
}
	
function wodanslider_settings_page() {
		
	include( 'wodan-slider-settings.php' );
	
}
	
function wodanslider_register_settings() {

	register_setting( 'wodanslider_options', 'wodanslider_options' );
		
	add_settings_section( 'wodan_slider', '<h1>Configurações Gerais</h1>', 'wodanslider_section_text', 'wodanslider' );
		
	add_settings_field( 'wodan_posttype', 'Tipo de Post', 'wodanslider_posttype', 'wodanslider', 'wodan_slider' );
		
	add_settings_field( 'wodan_showposts', 'Mostrar Posts', 'wodanslider_showposts', 'wodanslider', 'wodan_slider' );
		
	add_settings_field( 'wodan_hover', 'Efeito Hover', 'wodanslider_hover', 'wodanslider', 'wodan_slider' );
		
}
	
add_action( 'admin_menu', 'wodanslider_menu' );
add_action( 'admin_init', 'wodanslider_register_settings' );