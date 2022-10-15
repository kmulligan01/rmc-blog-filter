<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//get ajax query results and display
function my_default_posts($atts) {
  
    $a = shortcode_atts( array(
        'tax_type' => 'resource_type',
        'cat_type' => 'category',
        'terms' => false,
		'per_page' => '6',
        'offset' => '0'
	), $atts );

   // $tax_qry = [];
    $posts_per_page = $a['per_page'];
    $offset = $a['offset'];
   $tax_type = $a['tax_type'];
   $cat_type = $a['cat_type'];

    $default_terms = $a['terms'];

	$default_response = '';

	$args = array(
        'post_type' => array('post'),
        'post_status' => array('publish'),
        'posts_per_page' => $posts_per_page,
        'order' => 'ASC',
        'orderby' => 'date',
        'ignore_sticky_posts' => '1',
        'offset' => $offset,
        'tax_query' => array(
            'relation' => 'OR',
            array(
            'taxonomy' => $tax_type,
            'field'    => 'slug',
            'terms'    => explode( ',', $default_terms ),
            'hide_empty' => 'true'
            ),
            array(
                'taxonomy' => $cat_type,
                'field'    => 'slug',
                'terms'    => explode( ',', $default_terms ),
                'hide_empty' => 'true'
                )
        )
        
    );
	
   // The Query
   $qry_posts = new WP_Query( $args );
 
 ob_start();?>
   <div class="default-grid">
	<?php
   if ($qry_posts->have_posts() ) {
	   while ( $qry_posts->have_posts() ) {
        $qry_posts->the_post();?>	  	             	
		  <article class="card-item">
                <?php if ( has_post_thumbnail() ) : 
					$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<div class="post-img" style="background: url('<?php echo $url?>') no-repeat;" ></div>
				  <?php endif;?>
			  <div class="card-body">
			  <a href="<?php the_permalink(); ?>" class="black">
				  <header  class="bf-header">
					  <h2 class="entry-title"><?php the_title(); ?></h2>
				  </header>
				  <div class="entry-summary">
					  <?php the_excerpt(); ?>
				  </div>
				  </a>
				  <div class="meta ">		
				  	<?php default_meta_btn($qry_posts, $default_terms);?>
				  </div>					  
			  </div>						
		  </article>
    <?php 
		}
        
        wp_reset_postdata();

	}?>
    </div>
    <?php
            
	$default_response = ob_get_clean();
    
    return $default_response ;

   exit; 
}

add_shortcode( 'default_posts' , 'my_default_posts' );

//toggle which meta buttons display as active/inactive based terms in taxonomy
function default_meta_btn($qry_posts,$default_terms){
	$category = get_the_terms($qry_posts->ID, 'category');
	$type = get_the_terms($qry_posts->ID, 'resource_type');	

	$cat_name = join(', ' , wp_list_pluck($category, 'name'));
	$type_name = join(', ' , wp_list_pluck($type, 'name'));

	$ind_terms = explode( ',', $default_terms );
	$count = 0;

	if($count <= 3){?>
	<div class="d-active">	
		<?php 
		//buttons for active
        foreach($ind_terms as $term){		
			if(term_exists($term, 'category') && $type_name != '' && $count < 3){					
				echo '<p class="d-purple">'. $term . '</p>'; 						 
			}elseif(term_exists($term, 'resource_type') && $cat_name != '' && $count < 3){
				echo '<p class="d-purple">'. $term . '</p>'; 				
			}else{
				echo '<p class="d-purple">'. $term . '</p>';							
			}
			$count ++;
	 	} 

		//buttons for inactive
	  	foreach($ind_terms as $term){					
			if(term_exists($term, 'category') && $type_name != '' && $count <= 2 ){
				echo '<p class="d-gray">' . $type_name . '</p>';
				
			}elseif(term_exists($term, 'resource_type') && $cat_name != '' && $count <= 2){
				echo '<p class="d-gray">' . $cat_name . '</p>';
				
			}else{
				echo ''; 
			}
			$count ++;
		} 
	 ?>
	</div>
	<?php	
	 }
	    
}