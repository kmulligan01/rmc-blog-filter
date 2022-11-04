<?php

use Carbon_Fields\Block;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields','cat_list_checkboxes' );

function cat_list_checkboxes() {    
    Block::make( __( 'Cat List-Checkboxes' ) )
        ->add_fields( array(
            Field::make( 'text', 'list_title',  'List Title'  ),
            Field::make( 'text', 'list_tax',  'Taxonomy'  ),
            Field::make( 'text', 'all_text',  'Show All Text'  )
        ) )
        ->set_description(( 'Use this block for adding a list of checkbox categories' ) )
        ->set_icon( 'editor-spellcheck' )
        ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
            $taxonomy =  $fields['list_tax'];

            $cat_args = array(
                'orderby'      => 'name',
                'taxonomy' => $taxonomy,
                'style' => 'none'
            );

            $all_cats = get_categories($cat_args);
            
    
            ?>
            <h3 class="block mt-4 nav-filter-title"><?php echo esc_html( $fields['list_title'] ); ?></h3>
                <div class="blog-filter" >
                
                            <label for="">
                                <input  class="all" value="all" type="checkbox"/>
                                <?php echo esc_html( $fields['all_text'] ); ?>
                            </label>
                            <?php 
                               foreach($all_cats as $cats){?>
                                <label class="bf-label">
                                    <input value="<?php echo ($cats->name)?>" type="checkbox" />
                                    <?php echo ($cats->name)?>  
                            </label>
                                <?php }
                            ?>                          
                       
                </div>
                
            <?php
        } );
}

?>