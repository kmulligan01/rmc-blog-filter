<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//get ajax query results and display
function my_default_posts($atts) {
  
    $a = shortcode_atts( array(
        'tax_type_1' => '',
		'tax_type_2' => '',
        'terms_1' => '',
		'terms_2' => '',
		'per_page' => '6',
        'offset' => '0'
	), $atts );

   
    $posts_per_page = $a['per_page'];
    $offset = $a['offset'];
   $tax_type_1 = $a['tax_type_1'];
   $tax_type_2 = $a['tax_type_2'];

    $terms_1 = $a['terms_1'];
	$terms_2 = $a['terms_2'];

	$default_response = '';

	$args = array(
        'post_type' => array('post'),
        'post_status' => array('publish'),
        'posts_per_page' => $posts_per_page,
        'order' => 'DESC',
        'orderby' => 'date',
        'ignore_sticky_posts' => '1',
        'offset' => $offset,
        'tax_query' => array(
            'relation' => 'OR',
            array(
            'taxonomy' => $tax_type_1,
            'field'    => 'slug',
            'terms'    => explode( ',', $terms_1 ),
            'hide_empty' => 'true'
            ),
			array(
				'taxonomy' => $tax_type_2,
				'field'    => 'slug',
				'terms'    => explode( ',', $terms_2 ),
				'hide_empty' => 'true'
			),
           
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
				  	<?php 
					if($tax_type_1 != '' || $tax_type_2 != ''){
						display_meta_btn($terms_1, $terms_2);
					}
				
					?>
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
function display_meta_btn($terms_1, $terms_2){


	$ind_terms_1 = explode( ',', $terms_1 );
	$ind_terms_2 = explode( ',', $terms_2 );

	
	$count = 0;

	if($count <= 3  ){?>
	<div class="d-active">	
		<?php 
		//buttons for active
    	foreach($ind_terms_1 as $term1 ){		
			if( $count < 3 && $term1 != ''){
				$term1 = str_replace( 'yes', 'Featured', $term1);
				echo '<p class="d-purple">'. ucfirst($term1).' </p>'; 			
							 
			}else if($count > 3){
				echo '';
			}
			$count ++;
	 	} 

		 foreach($ind_terms_2 as $term2){					
			if($count <= 2 && $term2 != ''){
				$term1 = str_replace( 'yes', 'Featured', $term2);
				echo '<p class="d-gray">' . ucfirst($term2) . '</p>';
				
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