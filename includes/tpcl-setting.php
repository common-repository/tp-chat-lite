<?php
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**
 * Enqueue a css and js for frontend
 */
if( !function_exists('tpcl_add_scripts') ) :
    function tpcl_add_scripts() {
        wp_enqueue_script('jquery');
        wp_register_script('tpcl-script-integration',TPCL_PLUGIN_URL.'frontend/js/script.js',array(),true);
        wp_localize_script( 'tpcl-script-integration', 'tpcl', array('time' => current_time( 'timestamp' )) );
        wp_enqueue_script( 'tpcl-script-integration' );

        wp_enqueue_style( 'animation', TPCL_PLUGIN_URL.'frontend/css/animate.css', false );
        wp_enqueue_style( 'socicon', TPCL_PLUGIN_URL.'frontend/css/socicon.css', false );
        wp_enqueue_style( 'tpcl-main-css', TPCL_PLUGIN_URL.'frontend/css/style.css', false );
    }    
    add_action( 'wp_enqueue_scripts', 'tpcl_add_scripts' );
endif;

/**
 * Enqueue a custom stylesheet in the WordPress admin.
 */
if( !function_exists('tpcl_add_admin_scripts') ) :
    function tpcl_add_admin_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'iris', admin_url( 'js/iris.min.js' ), array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
        wp_enqueue_script( 'cp-active', plugins_url('/backend/js/cp-active.js', __FILE__), array('jquery'), '', true );

        wp_enqueue_style( 'tpcl-admin-style', TPCL_PLUGIN_URL.'/backend/css/admin-style.css', false );
       
    }    
    add_action( 'admin_enqueue_scripts', 'tpcl_add_admin_scripts' );
endif;
 