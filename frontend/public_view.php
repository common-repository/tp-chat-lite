<?php

if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**
 *  whatsapp button 
 */
add_action('wp_footer', 'tpcl_whatsapp');
if(!function_exists('tpcl_whatsapp')){
	function tpcl_whatsapp() { 

		echo '<span data-phone="'.esc_attr(get_option('tpcl_phone_option')).'" data-msg="'.esc_attr(get_option('tpcl_support_option')).'" class="animated shake aa_whatsapp_button"> <i class="socicon-whatsapp"></i> </span>';

	}
}

