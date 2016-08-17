<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: ContactFormDB
Plugin URI:  http://
Description: Custom plugin to capture all contact form 7 messages.
Version:     1.0
Author:      Rituparna sonowal
Author URI:  http://icraftzone.com/
*/
global $ngcd_db_version;
$ngcd_db_version = "1.0";
function ngcd_install() {
  global $wpdb;
  global $ngcd_db_version;
  $table_name = $wpdb->prefix . "ngcd";
  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (";
  $sql .= "`cdid` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,";
  $sql .= "`name` VARCHAR(50) NOT null,";
  $sql .= "`email` VARCHAR(50) NOT null,";
  $sql .= "`phone` VARCHAR(15),";
  $sql .= "`messages` TEXT,";
  $sql .= "`whaturl` VARCHAR(100),";
  $sql .= "`subdatetime` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL";
  $sql .= ");";
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
  add_option("ngcd_db_version", $ngcd_db_version);
}
register_activation_hook(__FILE__,'ngcd_install');
/*
*Let's capture email now
*/
add_action( 'wpcf7_mail_sent', 'ng_wpcf7_mail_sent_function' );
function ng_wpcf7_mail_sent_function( $contact_form ) {
  $submission = WPCF7_Submission::get_instance();
  if ( $submission ) {
    $posted_data = $submission->get_posted_data();
  }
  $title = $contact_form->title();
  
  if ( 'contact form' == $title && !empty($posted_data) ) {
    $name = $posted_data['uname'];
    $email = $posted_data['uemail'];
    $phone = $posted_data['uphone'];
    $messages = $posted_data['umessage'];
    $whaturl = $posted_data['whatform'];
    global $wpdb;
    $tablename = $wpdb->prefix . "ngcd";
    $wpdb->insert( 
    $tablename, 
    array(
      'cdid' => 'NULL', 
      'name' => $name,
      'email' => $email, 
      'phone' => $phone,
      'messages' => $messages,
      'whaturl' => $whaturl,
      'subdatetime' => date("Y-m-d H:i:s")
      ),
    array(
      '%d',
      '%s',
      '%s',
      '%s',
      '%s',
      '%s',
      '%s'
      )
    );
  }
}
require_once( plugin_dir_path( __FILE__ ) .'email_table.php' );
/*
 * Add an admin submenu link under Settings
 */
function naegeli_add_email_page() {
  add_submenu_page (
    '',
    __( 'Single message', '_naegeli' ),
    __( 'Single message', '_naegeli' ),
    'manage_options',
    'ng_signle_message',
    'ng_view_single_message'
    );
}
add_action( 'admin_menu', 'naegeli_add_email_page' );
function ng_view_single_message(){
  global $wpdb;
  $result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}ngcd WHERE cdid = {$_GET['record']}", ARRAY_A );
  ?>
  <div class="wrap">
    <h2>Naegeli Deposition Schedule Inbox</h2>
    <div id="poststuff">
      <div id="post-body" class="metabox-holder">
        <div id="post-body-content">
          <table class="wp-list-table widefat fixed striped messages">
          <tr><th>NAME</th><td><?php echo $result['name']; ?></td></tr>
          <tr><th>EMAIL</th><td><?php echo $result['email']; ?></td></tr>
          <tr><th>PHONE</th><td><?php echo $result['phone']; ?></td></tr>
          <tr><th>LOCATION</th><td><?php echo basename($result['whaturl']).PHP_EOL; ?></td></tr>
          <tr><th>SUBMITTED ON</th><td><?php echo $result['subdatetime']; ?></td></tr>
          <tr><th>MESSAGE</th><td><?php echo $result['messages']; ?></td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>