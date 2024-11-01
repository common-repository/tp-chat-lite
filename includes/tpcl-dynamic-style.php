<?php
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
 
/**
 * Inject dynamic css to head
 */
add_action('wp_head', 'tpcl_custom_css');
if(!function_exists('tpcl_custom_css')){
	function tpcl_custom_css() {

		echo '<style>

		span.aa_whatsapp_button,
		span.aa_whatsapp_rectangular_button{
	        left: unset;
	        right: 30px;
	        bottom: 30px;
	        background-color: #2ecc71;
	        color: #fff;
        }

		</style>';

	}
}