<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


//get ajax query results and display
function get_ajax_posts() {

	$terms = $_POST['params'];
	$page = $_POST['page'];
	$response = '';

	if($terms != '*'){
	$args = array(
        'post_type' => array('post'),
        'post_status' => array('publish'),
        'posts_per_page' => 6,
        'order' => 'DESC',
        'orderby' => 'date',
		'paged' => $page,
		'tax_query' => array(
			'relation' => 'OR',
			array(
				'taxonomy' => 'resource_type',
				'field'    => 'slug',
				'terms'    => explode( ',', $terms ),
				'hide_empty' => 'true'
			),
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => explode( ',', $terms ),
				'hide_empty' => 'true'
			)
		)
    );
	}
   // The Query
   $ajaxposts = new WP_Query( $args );
 
   ob_start();?>
	<?php
   if ( $ajaxposts->have_posts() ) {
	   while ( $ajaxposts->have_posts() ) {
		   $ajaxposts->the_post();
	?>
		  <article class="card-item">			
				  <?php if ( has_post_thumbnail() ) : 
					$url = wp_get_attachment_url( get_post_thumbnail_id($ajaxpost->ID) ); ?>
					<div class="post-img" style="background: url('<?php echo $url?>') no-repeat;" ></div>
				  <?php endif;?>		
			  <div class="card-body">
			  <a href="<?php the_permalink(); ?>" class="black">
				  <header class="bf-header" >
					  <h2 class="entry-title"><?php the_title(); ?></h2>
				  </header>
				  <div class="entry-summary">
					  <?php the_excerpt(); ?>
				  </div>
				  </a>
				  <div class="meta ">				 
					<?php meta_btn($ajaxposts, $terms);?>	
				  </div>
			  </div>						
		  </article>       	 		
	<?php 
	   }
		//Pagination
		ajax_pager($ajaxposts,$page);
		wp_reset_postdata();
	}

	$response = ob_get_clean();
   	echo $response;

   exit; 
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_ajax_posts', 'get_ajax_posts');
add_action('wp_ajax_nopriv_get_ajax_posts', 'get_ajax_posts');

//toggle which meta buttons display as active/inactive based terms in taxonomy
function meta_btn($ajaxposts, $terms){
	$category = get_the_terms($ajaxposts->ID, 'category');
	$type = get_the_terms($ajaxposts->ID, 'resource_type');	

	$cat_name = join(', ' , wp_list_pluck($category, 'name'));
	$type_name = join(', ' , wp_list_pluck($type, 'name'));

	$ind_terms = explode( ',', $terms );
	$count = 0;
	?>
	<div class="m-active">	
		<?php 
		//buttons for active
		foreach($ind_terms as $term){		
			if(term_exists($term, 'category') && $type_name != '' && $count < 3){
				$new_term = strtr($term, "-", " ");
				echo '<p class="purple">'. $new_term . '</p>'; 		
							 
			}elseif(term_exists($term, 'resource_type') && $cat_name != '' && $count < 3){
					$new_term = strtr($term, "-", " ");
					echo '<p class="purple">'. $new_term . '</p>'; 				
				
			}elseif($count <3){
				$new_term = strtr($term, "-", " ");
				echo '<p class="purple">'. $new_term . '</p>';							
			}
			$count ++;
	 	} 

		//buttons for inactive
	  	foreach($ind_terms as $term){					
			if(term_exists($term, 'category') && $type_name != '' && $count <= 2 ){
				echo '<p class="gray">' . $type_name . '</p>';
				
			}elseif(term_exists($term, 'resource_type') && $cat_name != '' && $count <= 2){
				echo '<p class="gray">' . $cat_name . '</p>';
				
			}else{
				echo ''; 
			}
			$count ++;
		} 	
	 ?>
	</div>
	<?php	
}

//run pagination function to display numbers
function ajax_pager( $ajaxposts, $page ) {

	if (!$ajaxposts)
		return;	

	$paginate = paginate_links([
		'base'      => '%_%',
		'type'      => 'array',
		'total'     => $ajaxposts->max_num_pages,
		'format'    => '#page=%#%',
		'current'   => max( 1,  $page),
		'prev_text' => '&lsaquo;',
		'next_text' => '&rsaquo;'
	]);

	if ($ajaxposts->max_num_pages > 1) : ?>
		<div class="pagination">
			<?php foreach ( $paginate as $pages ) :?>
				<?php echo $pages; ?>
			<?php endforeach; ?>
		</div>
	<?php endif;


}





?>