<?php

if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**
 * Register a custom menu page.
*/

// add admin menu
add_action( 'admin_menu', 'tpcl_lite_admin_menu' );
function tpcl_lite_admin_menu(){
  add_menu_page( 
    __( 'WhatsApp Chat', 'tp-chat-lite' ),
    'WhatsApp Chat',
    'manage_options',
    'tp-chat-lite',
    'tpcl_callback',
    'dashicons-whatsapp',
    6
  ); 
}
 
// admin menu callback
function tpcl_callback() {
  tpcl_defaults();
    ?>
    <div class="wrap">
      <h1 class="wp-heading-inline"> <?php esc_html_e( 'WhatsApp Chat', 'tp-chat-lite' ); ?> </h1>
      <div class="postbox">
        <div class="inside">
          <form method="POST" action="options.php">
            <?php
              settings_fields( 'tpcl_lite' ); //option group
              do_settings_sections( 'tpcl_lite' ); 
              submit_button();
            ?>
          </form>
        </div>
      </div>
    </div>
    <?php
}

// reister settings
add_action( 'admin_init', 'tpcl_settings_init' );
function tpcl_settings_init() {   

  $settings_section = 'tpcl_lite_main';
  $option_group_and_page = 'tpcl_lite';
  $option_phone = 'tpcl_phone_option';
  $option_support = 'tpcl_support_option';

  register_setting( $option_group_and_page, $option_phone );
  register_setting( $option_group_and_page, $option_support ); 
 
  add_settings_section(
    $settings_section,
    __( 'Account Info', 'tp-chat-lite' ),
    'tpcl_main_section_text_output',
    $option_group_and_page 
  );
 
  add_settings_field(
    $option_phone,
    __( 'Mobile Number', 'tp-chat-lite' ),
    'tpcl_phone_input_renderer',
    $option_group_and_page,
    $settings_section
  );


  add_settings_field(
    $option_support,
    __( 'Support Message', 'tp-chat-lite' ),
    'tpcl_support_input_renderer',
    $option_group_and_page,
    $settings_section
  );
 
  function tpcl_main_section_text_output() {
    echo '<p>'.esc_html('Enter all info correctly. Otherwise it will not work.','tp-chat-lite').'</p>';
  }
 
  // Phone
  function tpcl_phone_input_renderer() {
    echo '<input type="text" id="tpcl_phone_option" value="'.esc_attr(get_option('tpcl_phone_option')).'" name="tpcl_phone_option">';
    echo '<p class="description">'.esc_html('Select a phone number including country code. e. g. +8801717407376','tp-chat-lite').'</p>';
  }
 
  // Support Message
  function tpcl_support_input_renderer() {
    echo '<input type="text" id="tpcl_support_option" value="'.esc_attr(get_option('tpcl_support_option')).'" name="tpcl_support_option">';
    echo '<p class="description">'.esc_html('Write a Support Message for you','tp-chat-lite').'</p>';
  }

}

/**
 * set default value globally to access both frontend & backend
 */
function tpcl_set_default($opt,$val){
  $default = get_option( $opt );

  if( !$default ){
    update_option( $opt, $val );
  }
}

/**
 * all default value
 */
function tpcl_defaults(){
  tpcl_set_default('tpcl_phone_option',__('+8801717407376','tp-chat-lite'));
  tpcl_set_default('tpcl_support_option',__('Hi, I need support','tp-chat-lite'));
}


?>

<?php if (isset($_GET['settings-updated'])) : ?>
  <div class="notice notice-success is-dismissible"><p><?php esc_html_e('Some Changes are done!','tp-chat-lite'); ?>.</p></div>
<?php endif; ?>


