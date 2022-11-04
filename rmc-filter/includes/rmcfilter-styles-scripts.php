<?php

//admin styles
function rmcfilter_admin_styles(){
    wp_enqueue_style('rmcfilter-admin', RMCFILTER_URL . '/admin/css/admin.css', [], TIME());
}

add_action('admin_enqueue_scripts', 'rmcfilter_admin_styles');

//frontend styles
function rmcfilter_frontend_styles(){
    wp_enqueue_style('rmcfilter-frontend-styles', RMCFILTER_URL . '/assets/css/blog-filter.css', [], TIME());
}

add_action('wp_enqueue_scripts', 'rmcfilter_frontend_styles', 100);


//admin scripts
function rmcfilter_admin_scripts(){
    wp_enqueue_script('rmcfilter-admin', RMCFILTER_URL . '/admin/js/admin.js', ['jquery'], TIME());
}

add_action('admin_enqueue_scripts', 'rmcfilter_admin_scripts', 100);

//frontend script
function rmcfilter_frontend_scripts(){
    wp_enqueue_script('rmcfilter-isotope', RMCFILTER_URL . '/assets/js/isotope.js', ['jquery'], TIME(), true);
    wp_enqueue_script('rmcfilter-frontend-scripts', RMCFILTER_URL . '/assets/js/main.js', ['jquery'], TIME(), true);
    wp_localize_script( 'rmcfilter-frontend-scripts', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action('wp_enqueue_scripts', 'rmcfilter_frontend_scripts', 100);


?>