<?php
	
function wodanslider_section_text() {
		
	if( isset( $_GET['settings-updated'] ) ) {
			
		$wodan_message = __( 'Settings saved.' );
				
			echo "<br /><div class='updated'><p>$wodan_message</p></div>";
		
	}
			echo "<p>Para adicionar o Wodan Slider, use <b>&lt;?php echo do_shortcode( '[wodan_slider]' ); ?&gt;.</p</p>";
}
	
function wodanslider_posttype() {
		
	$wodan_options = get_option( 'wodanslider_options' );
		
	$wodan_args=array(
  			
		'public'   => true,
  			
		'_builtin' => false
		
	); 
		
	$wodan_output   = 'names';
	
	$wodan_operator = 'and';

	$wodan_post_types = get_post_types( $wodan_args, $wodan_output, $wodan_operator );
		
		echo "<select id='wodan_posttype' name='wodanslider_options[wodan_posttype]' onchange='this.form.submit()'>";

		echo "<option value='post'" . selected( $wodan_options['wodan_posttype'], 'post' ) . ">Post</option>";

	foreach ( $wodan_post_types as $wodan_post_type ) {
			
	$wodan_label_obj = get_post_type_object( $wodan_post_type ); 
        	
	$wodan_labels    = $wodan_label_obj->labels->name;
				
		echo "<option value='$wodan_post_type'" . selected( $wodan_options['wodan_posttype'], $wodan_post_type ) . ">$wodan_labels</option>";
  		
		}
				
		echo "</select>";

}
	
function wodanslider_showposts() {
		
	$wodan_options = get_option( 'wodanslider_options' );
			
		echo "<input type='number' id='wodan_showposts' name='wodanslider_options[wodan_showposts]' value='{$wodan_options['wodan_showposts']}' style='width:120px;' />";

}
	
function wodanslider_hover() {
				
	$wodan_options = get_option( 'wodanslider_options' );
		
	$wodan_grow                   = 'grow';
	$wodan_shrink                 = 'shrink';
	$wodan_pulse                  = 'pulse';
	$wodan_pulse_grow             = 'pulse grow';
	$wodan_pulse_shrink           = 'pulse shrink';
	$wodan_push                   = 'push';
	$wodan_pop                    = 'pop';
	$wodan_bounce_in              = 'bounce in';
	$wodan_bounce_out             = 'bounce out';
	$wodan_rotate                 = 'rotate';
	$wodan_grow_rotate            = 'grow rotate';
	$wodan_float                  = 'float';
	$wodan_sink                   = 'sink';
	$wodan_bob                    = 'bob';
	$wodan_hang                   = 'hang';
	$wodan_skew                   = 'skew';
	$wodan_skew_forward           = 'skew forward';
	$wodan_skew_backward          = 'skew backward';
	$wodan_wobble_vertical        = 'wobble vertical';
	$wodan_wobble_horizontal      = 'wobble horizontal';
	$wodan_wobble_to_bottom_right = 'wobble to bottom right';
	$wodan_wobble_to_top_right    = 'wobble to top right';
	$wodan_wobble_top 			  = 'wobble top';
	$wodan_wobble_bottom          = 'wobble bottom';
	$wodan_wobble_skew            = 'wobble skew';
	$wodan_buzz                   = 'buzz';
		
		
	$wodan_item = array(
			
		'wodan-slider-grow'                   => $wodan_grow,
		'wodan-slider-shrink'                 => $wodan_shrink,
		'wodan-slider-pulse'                  => $wodan_pulse,
		'wodan-slider-pulse-grow'             => $wodan_pulse_grow,
		'wodan-slider-pulse-shrink'           => $wodan_pulse_shrink,
		'wodan-slider-push'                   => $wodan_push,
		'wodan-slider-pop'                    => $wodan_pop,
		'wodan-slider-bounce-in'              => $wodan_bounce_in,
		'wodan-slider-bounce-out'             => $wodan_bounce_out,
		'wodan-slider-rotate'                 => $wodan_rotate,
		'wodan-slider-grow-rotate'            => $wodan_grow_rotate,
		'wodan-slider-float'                  => $wodan_float,
		'wodan-slider-sink'                   => $wodan_sink,
		'wodan-slider-bob'                    => $wodan_bob,
		'wodan-slider-hang'                   => $wodan_hang,
		'wodan-slider-skew'                   => $wodan_skew,
		'wodan-slider-skew-forward'           => $wodan_skew_forward,
		'wodan-slider-skew-backward'          => $wodan_skew_backward,
		'wodan-slider-wobble-vertical'        => $wodan_wobble_vertical,
		'wodan-slider-wobble-horizontal'      => $wodan_wobble_horizontal,
		'wodan-slider-wobble-to-bottom-right' => $wodan_wobble_to_bottom_right,
		'wodan-slider-wobble-to-top-right'    => $wodan_wobble_to_top_right, 
		'wodan-slider-wobble-top'             => $wodan_wobble_top,
		'wodan-slider-wobble-bottom'          => $wodan_wobble_bottom,
		'wodan-slider-wobble-skew'            => $wodan_wobble_skew,
		'wodan-slider-buzz'                   => $wodan_buzz
			
	);
		
		echo "<select id='wodan_hover' name='wodanslider_options[wodan_hover]' style='text-transform:uppercase'>";
		
	while ( list( $wodan_key, $wodan_val ) = each( $wodan_item ) ) {
			
		echo "<option value='$wodan_key'" . selected( $wodan_options['wodan_hover'], $wodan_key ) . ">$wodan_val</option>";
  		
	}

		echo "</select>";

}

if( is_admin() ) {
	echo '<div class="wrap">';
	echo '<form action="options.php" method="post">';
		settings_fields( 'wodanslider_options' );
		do_settings_sections( 'wodanslider' );
		submit_button( '', 'primary', 'save', false );
	echo '</form>';
	echo '</div>';
}