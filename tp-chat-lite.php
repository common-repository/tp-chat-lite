<?php
/**
 * Plugin Name: TP Chat Lite
 * Plugin URI:  https://trendyplugins.com/plugins/tp-chat-lite
 * Description: TP Chat Lite is the fastest way for your website visitors to get in touch with you via WhatsApp. Stay always easy-to-reach for users via their favourite messenger. 
 * Version:     1.0.0
 * Author:      Trendy Plugins
 * Author URI:  https://trendyplugins.com
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: tp-chat-lite
 * Domain Path: languages
 */

/**
 * Preventing to direct access
 */
defined( 'ABSPATH' ) OR die( 'Direct access not acceptable!' );

if (!function_exists('add_action')) {
  echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
  exit;
}

/**
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */
define('TPCL_VERSION', '1.0.0' );
define('TPCL_MINIMUM_WP_VERSION', '4.1.1');
if(!defined('TPCL_PLUGIN_URL')) define('TPCL_PLUGIN_URL', plugin_dir_url(__FILE__) );
if(!defined('TPCL_PLUGIN_DIR')) define('TPCL_PLUGIN_DIR', plugin_dir_path(__FILE__) );


/**
 * load translations
 */
function tpcl_load_textdomain() {
    load_plugin_textdomain('tp-chat-lite', false, dirname(plugin_basename( __FILE__)) . '/languages/');
}
add_action('plugins_loaded', 'tpcl_load_textdomain');


/**
 * plugin activation.
 */
register_activation_hook(__FILE__, 'tpcl_plugin_activate');
function tpcl_plugin_activate() {
  tpcl_installer();
  add_option('tpcl_plugin_do_activation_redirect', true);
} 


/**
 * Redirect to plugin settings page.
 */
add_action('admin_init', 'tpcl_plugin_redirect');
function tpcl_plugin_redirect() {
  if (get_option('tpcl_plugin_do_activation_redirect', false)) {
    delete_option('tpcl_plugin_do_activation_redirect');
    if(!isset($_GET['activate-multi']))
    {
      wp_redirect( admin_url( '/admin.php?page=tp-chat-lite' ) );
     // exit;
    }
  }
}

/**
 * track plugin version  
 */
function tpcl_installer(){

  $installed = get_option( 'tpcl_installed' );

  if( !$installed ){
    update_option( 'tpcl_installed', time() );
  }

  update_option( 'tpcl_installed', TPCL_VERSION );
}

/**
 * Add a settings url in plugin
 */
function tpcl_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=tp-chat-lite">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter('plugin_action_links_'.$plugin, 'tpcl_settings_link' );

/**
 * Include Files
 */
require_once TPCL_PLUGIN_DIR . 'includes/tpcl-setting.php';
require_once TPCL_PLUGIN_DIR . 'includes/tpcl-dynamic-style.php';

require_once TPCL_PLUGIN_DIR . 'frontend/public_view.php';
require_once TPCL_PLUGIN_DIR . 'backend/admin_view.php';
 