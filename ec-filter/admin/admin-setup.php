<?php
/**
*
 */

function admin_scripts() {
wp_enqueue_style('admin_styles', plugin_dir_url( __DIR__ ) . '/css/admin.css');

}
add_action( 'wp_enqueue_scripts', 'admin_scripts' );

class ECBlogFilter {
	private $ec_blog_filter_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'ec_blog_filter_add_plugin_page' ) );
		//add_action( 'admin_init', array( $this, 'ec_blog_filter_page_init' ) );
	}

	public function ec_blog_filter_add_plugin_page() {
		add_options_page(
			'EC Blog Filter', // page_title
			'EC Blog Filter', // menu_title
			'manage_options', // capability
			'ec-blog-filter', // menu_slug
			array( $this, 'ec_blog_filter_create_admin_page' ) // function
		);
	}

	public function ec_blog_filter_create_admin_page() {
		$this->ec_blog_filter_options = get_option( 'ec_blog_filter_option_name' ); ?>

		<div class="wrap">
			<h2>EC Blog Filter</h2>
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
	<?php }

}
if ( is_admin() )
	$ec_blog_filter = new ECBlogFilter();



?>