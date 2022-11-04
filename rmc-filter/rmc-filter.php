<?php
/**
 * Plugin Name: RMC Blog Filter Widget
 * Description: Custom Blog Filter widget to use on resource center pages
 * Plugin URI:  https://rockymountaincode.com
 * Version:     1.0.5
 * Author:      Kendra Mulligan
 * Author URI:  https://rockymountaincode.com
 * Text Domain: rmcfilter
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('RMCFILTER_URL', plugin_dir_url(__FILE__) );

//get styles and scripts for frontend and admin page
include(plugin_dir_path(__FILE__) . 'includes/rmcfilter-styles-scripts.php');

//create options page with instructions
include( plugin_dir_path(__FILE__) . 'admin/admin-setup.php' );

//register all files
include( plugin_dir_path(__FILE__) . 'includes/widgets/carbon-widget.php' );
include( plugin_dir_path(__FILE__) . 'includes/shortcode_posts.php' );
include( plugin_dir_path(__FILE__) . 'includes/ajax_query.php' );


//register elementor widget if using elementor
function register_elementor_widget( $widgets_manager){
	include( plugin_dir_path(__FILE__) .  'includes/widgets/elementor-widget.php');

	$widgets_manager->register( new \EC_Cat_List_Widget() );
}
add_action( 'elementor/widgets/register', 'register_elementor_widget' );

//load carbon fields for block editor widget
function carbon_fields_boot_plugin() {
	include( plugin_dir_path(__FILE__) .  'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'after_setup_theme', 'carbon_fields_boot_plugin' );

//Settings link after activation
function rmcfilter_add_settings_link($links){
	$settings_link = '<a href="options-general.php?page=rmcfilter-settings">'. __('Settings') . '</a>';

	array_push( $links, $settings_link );
	return $links;
}

$filter_name = "plugin_action_links_" . plugin_basename(__FILE__);

add_filter($filter_name, 'rmcfilter_add_settings_link');


//Filter the excerpt length & edit the trailing end.
function custom_short_excerpt($excerpt){

	$limit = 199;

	if (strlen($excerpt) > $limit) {
		$new_length = substr($excerpt, 0, strpos($excerpt, ' ', $limit));
		$read_more = '....';

		return $new_length . $read_more;
	}
	return $excerpt;

}
add_filter('the_excerpt', 'custom_short_excerpt');	