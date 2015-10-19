<?php

function wodanslider_register_cpt() {
		
	$wodan_labels = array(
		
		'name'                => 'Wodan Slider',
		'singular_name'       => 'Wodan Slider',
		'menu_name'           => 'Wodan Slider',
		'name_admin_bar'      => 'Wodan Slider',
		'all_items'           => 'Todos os Posts',
		'add_new_item'        => 'Adicionar novo Post',
		'add_new'             => 'Adicionar Novo',
		'new_item'            => 'Novo Post',
		'edit_item'           => 'Editar Post',
		'update_item'         => 'Atualizar Post',
		'view_item'           => 'Ver Post',
		'search_items'        => 'Pesquisar Posts',
		'parent_item_colon'   => 'Parente Post',
		'not_found'           => 'Nenhum post encontrado',
		'not_found_in_trash'  => 'Nenhum post encontrado na lixeira',
	
	);
		
	$wodan_args = array(
	
		'labels'              => $wodan_labels,
		'description'         => '',
		'supports'            => array( 'title', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'			  => 'dashicons-screenoptions',
		'show_in_admin_bar'   => true,
		'can_export'          => true,
		'has_archive'         => false,
		'rewrite'             => false,
		'query_var'           => true,
		'can_export'          => true,
		'show_in_nav_menus'   => false,	
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	
	);
	
		register_post_type( 'wodanslider', $wodan_args );
		
}

function wodanslider_meta_get( $value ) {
	
	global $post;

	$wodan_field = get_post_meta( $post->ID, $value, true );
	
	if ( ! empty( $wodan_field ) ) {
		
		return is_array( $wodan_field ) ? stripslashes_deep( $wodan_field ) : stripslashes( wp_kses_decode_entities( $wodan_field 		
		
	) );
	
	} else {
		
		return false;
	}
}

function wodanslider_meta_field( $post ) {
	
	wp_nonce_field( '_wodan_nonce', 'wodan_nonce' );
	
	$wodan_link = wodanslider_meta_get( 'wodan_link' );
	
	$wodan_featured = wodanslider_meta_get( 'wodan_featured' )=='yes'?'checked':'';

	$wodan_field  = "<table class='form-table'>";
	$wodan_field .= "<tbody>";
	$wodan_field .= "<tr>";
	$wodan_field .= "<th scope='row'><label for='linkexterno'>Link Externo</label></th>";
	$wodan_field .= "<td><input type='text' name='wodan_link' id='wodan_link' value='$wodan_link' class='regular-text' />";
	$wodan_field .= "<p><span class='description' id='link-externo-description'>Use um url para o link externo ou mesmo uma link de uma p&aacute;gina/post existente em seu site.</span></p></td></td>";
	$wodan_field .= "</tr>";
	$wodan_field .= "<tr>";
	$wodan_field .= "<th scope='row'><label for='postemdestaque'>Post em Destaque</label></th>";
	$wodan_field .= "<td><fieldset><legend class='screen-reader-text'><span>Post em Destaque</span></legend>";
	$wodan_field .= "<label for='marqueopcao'>";
	$wodan_field .= "<input type='checkbox' name='wodan_featured' id='wodan_featured' value='yes' $wodan_featured />
<span class='description' id='post-em-destaque-description'>Marque essa op&ccedil;&atilde;o se voc&ecirc; quer que esse post apare&ccedil;a em destaque no slider.</span></label>";
	$wodan_field .= "</fieldset></td>";
	$wodan_field .= "</tr>";
	$wodan_field .= "</tbody>";
	$wodan_field .= "</table>";

	echo $wodan_field;
	
}

function wodanslider_meta_save( $post_id ) {
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	
	if ( ! isset( $_POST['wodan_nonce'] ) || ! wp_verify_nonce( $_POST['wodan_nonce'], '_wodan_nonce' ) ) return;
	
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['wodan_link'] ) || isset( $_POST['wodan_featured'] ) )
		
		update_post_meta( $post_id, 'wodan_link', esc_attr( $_POST['wodan_link'] ) );
		
	
	if( isset( $_POST[ 'wodan_featured' ] ) ) {
    	
		update_post_meta( $post_id, 'wodan_featured', 'yes' );
	
	} else {
    	
		update_post_meta( $post_id, 'wodan_featured', 'no' );
	}

}

add_action( 'init', 'wodanslider_register_cpt' );
add_action( 'save_post', 'wodanslider_meta_save' );