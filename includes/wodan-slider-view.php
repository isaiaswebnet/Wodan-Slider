<?php
	
global $post;
	
	$wodan_options   = get_option( 'wodanslider_options' );
	$wodan_posttype  = $wodan_options['wodan_posttype'];
	$wodan_showposts = $wodan_options['wodan_showposts'];
	$wodan_hover     = $wodan_options['wodan_hover'];
	
	$wodan_loop = new WP_Query( array(
	
		'post_type'  => $wodan_posttype,
		'showposts'  => $wodan_showposts,
		'orderby'    => 'wodan_featured',
		'order'      => 'ASC',
		'meta_query' => array(
                            array(
                            'key' => 'wodan_featured',
                            'value' => 'yes'
                            )
                        )
		
	) ); 
	
if ( $wodan_loop->have_posts() ) :
	 
?>

<div id="wodan_slider">
  <div class="wodan-slider" 
    		data-wodan-fx="scrollHorz" 
    		data-wodan-slides="> div"
    		data-wodan-timeout="1000"
            data-wodan-speed="2000"
    		data-wodan-pause-on-hover="true"
            data-wodan-pager=".wodan-pager"
        	data-wodan-prev="#wodan-prev"
        	data-wodan-next="#wodan-next">
<div class="wodan-slider-div">
	<div class="wodan-slider-div-rel">
<?php
		
	$counter = 0;
		
	while ( $wodan_loop->have_posts() ) : $wodan_loop->the_post();
		
		$wodan_category      = get_the_category();
	
		$wodan_category_name = $wodan_category[0]->name;
	
		$wodan_post_direct   = array(' wodan-post-left',' wodan-post-right',' wodan-post-bottom');
		
		$wodan_link          = get_post_meta( $post->ID, 'wodan_link', true );
		
if( $counter%3 == 0 && $counter > 0 ):
		
?>
	</div>
</div>
<div class="wodan-slider-div">
	<div class="wodan-slider-div-rel">
<?php 
	
endif;
		
?>
	
    <a href="<?php echo $wodan_link?$wodan_link:get_the_permalink(); ?>"<?php echo $wodan_link?' target="_blank"':''; ?>>
	<div class="wodan-slider-div-grup <?php echo $wodan_hover . $wodan_post_direct[$counter%3];  ?>" style="background:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id(), 'wodan-medium-img', true ); ?>'); padding-bottom:<?php echo $counter%3==0?'50%':'24.5%'; ?>">
    
<?php 

if( $wodan_category_name ) { ?>
	
    <span class="wodan-category-name"><?php echo $wodan_category_name; ?></span>

<?php 

} 

?>
	
    <h3 class="<?php echo $counter%3==0?'wodan-title wodan-font-size-t1':'wodan-title wodan-font-size-t2'; ?>"><?php echo get_the_title(); ?></h3>
	</div>
	</a>

<?php 
	
	$counter++; 
	  
endwhile; 
	  
wp_reset_postdata();
	  
?>
		</div>
	</div>
</div>
<div class="wodan-pager"></div>
	<span id="wodan-prev"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30.748 52.669"><path d="M0.878,28.455L24.212,51.79c1.172,1.172,3.071,1.172,4.243,0l1.415-1.414c1.171-1.172,1.171-3.071,0-4.242L10.071,26.334L29.87,6.535c1.171-1.172,1.171-3.07,0-4.242l-1.415-1.414c-1.171-1.172-3.071-1.172-4.243,0L0.878,24.213C-0.293,25.385-0.293,27.284,0.878,28.455z"></path></svg></span><span id="wodan-next"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30.748 52.669"><path d="M29.87,24.214L6.536,0.879c-1.172-1.172-3.071-1.172-4.243,0L0.878,2.293c-1.171,1.172-1.171,3.071,0,4.242l19.799,19.799L0.878,46.134c-1.171,1.171-1.171,3.07,0,4.242l1.415,1.414c1.171,1.172,3.071,1.172,4.243,0L29.87,28.456C31.041,27.284,31.041,25.385,29.87,24.214z"></path></svg></span>
<?php 

else:

	$add_post = !$wodan_posttype == 'post'?EDIT_POST:EDIT_POST_SLIDER;
	
	echo 'Não foi encontrado post cadastrado ou não existe post destacado. <a href="' . $add_post . '">Adicionar Post</a>.';

endif; 

?>
</div>