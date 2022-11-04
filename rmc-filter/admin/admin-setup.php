<?php

//create settings page
function ec_filter_default_sub_pages(){
    add_options_page(
        __('Blog Filter Instructions', 'ec-filter'), //page title
        __('Blog Filter Settings', 'ec-filter'), //menu title
        'manage_options', //where to place
        'rmcfilter-settings', //url
        'rmcfilter_settings_page_markup' //function to display the settings
    );
}

add_action( 'admin_menu', 'ec_filter_default_sub_pages');

function rmcfilter_settings_page_markup(){
    if(!current_user_can('manage_options')){
        return;
    }

    ?>

    <div class="wrap">
			<h2><?php esc_html_e( get_admin_page_title());?></h2>
			<p>This page helps provide instructions and shortcodes for the EC Blog filter plugin</p>
           
            <!-- Tab links -->
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'Instruct')">Instructions</button>
                <button class="tablinks" onclick="openCity(event, 'SC')">Shortcodes</button>
            </div>

            <!-- Tab content -->
            <div id="Instruct" class="tabcontent instructions">
                <ol>
                <li class="i-first"> 
                 <h3>Add to Page (Block & Elementor Usage)</h3>
                    <ol class="usage">
                        <li class="inst-link">Search for 'Cat List Checkbox' in blocks on page</li>
                        <li class="inst-link">After inserted, fill in text boxes for list title, taxonomy to search, and the wording for the 'all types' text.</li>
                        <li class="inst-link">Save</li>
                    </ol>
                </li>

               <li class="i-first">
                <h3>Attach Filtered Posts With Cat Checklist</h3>
                <ol class="usage">
                    <li class="inst-link">
                        <p>After adding the cat list checkbox to the page (see above), add a custom html section where you want your filterd posts to display on the page. In this section, add:</p>
                        <div class="code">&lt;div id="demo"&gt;&lt;/div></div>
                        <p>This section is IMPORTANT because it is where your ajax posts result will be displayed.</p>
                    </li>
                    <li class="inst-link">
                        <p>Next, wrap your default posts shortcode in the div below. See the 'Shortcodes' tab for the shortcode:</p>
                        <div class="code">&lt;div id="is-container"&gt;[shortcode goes here]&lt;/div&gt;</div>
                        <p>This step enables the smooth animation transition, and hides all your posts on filter click.</p>
                    </li>
                    
                </ol>
                </li>   
               </ol>
            </div>

            <div id="SC" class="tabcontent shortcodes">
                <h3>Example Shortcode With All Parameters</h3>
                <p>Copy the below shortcode and insert on pages where you want the posts to display. Change up search terms and taxonomies. See below for more definitions</p>
                <code>[default_posts per_page="3" offset="0" tax_type_1="featured_post" terms_1="yes" tax_type_2="category" terms_2="sales" ] </code>
                <hr>
                <h3>Shortcode param definitions</h3>
                <h4>Post Offset <span>(Required)</span></h4>
                <p>How many posts you want to offset for the start - default is 0</p>    
                <code> offset: 0</code>
                <h4>Posts Per Page <span>(Required)</span></h4>  
                <p>How many posts you want to show per page</p>
                <code>   per_page: 1</code>
                <h4>Taxonomy 1 <span>(Required)</span></h4>  
                <p>The first category or custom post type slug to search within (i.e category for default categories or resource_type for custom post type)</p>
                <code>    tax_type_1: resource_type</code>
                <h4>Taxonomy 2</h4>  
                <p>The second category or custom post type slug to search within (i.e category for default categories or resource_type for custom post type)</p>
                <code>    tax_type_2: category</code>
                <h4>Terms 1 <span>(Required)</span></h4>  
                <p>The first set of terms name to search for. Can search for multiple instead of 1. The terms MUST MATCH the tax_type_1 (EX. have to search for blog within category not resource type)</p>
                <p>(i.e sales, marketing for default categories or webinar, worksheet for custom post type)</p>
               
                <code>    terms_1: webinar, category</code>
                <h4>Terms 2</h4>  
                <p>The second set of terms name to search for. Can search for multiple instead of 1. The terms MUST MATCH the tax_type_2 (EX. have to search for blog within category not resource type)</p>
                <p>(i.e sales, marketing for default categories or webinar, worksheet for custom post type)</p>
                <code>    terms_2: blog, sales</code>

           
            </div>
                    

		</div>
<?php 
}