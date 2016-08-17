<?php ob_start(); ?>
<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*
Plugin Name: Naegeli Scheduler
Plugin URI:  http://
Description: Custom web form for Naegeli assignment scheduling.
Version:     1.0
Author:      Rituparna sonowal
Author URI:  http://icraftzone.com/
*/
global $ngsch_db_version;
$ngsch_db_version = "1.0";
function ngch_install() {
   global $wpdb;
   global $ngsch_db_version;
   $table_name = $wpdb->prefix . "ngch";
  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (";
  $sql .= "`ssid` INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,";
  $sql .= "`yname` VARCHAR(255) NOT null,";
  $sql .= "`yemail` VARCHAR(255) NOT null,";
  $sql .= "`yphone` VARCHAR(15) NOT NULL,";
  $sql .= "`attorneyname` VARCHAR(255),";
  $sql .= "`lawfrmname` VARCHAR(255),";
  $sql .= "`lawfphone` VARCHAR(15),";
  $sql .= "`lawfmstadds` VARCHAR(255),";
  $sql .= "`attaddress` VARCHAR(255),";
  $sql .= "`attzip` VARCHAR(20),";
  $sql .= "`loccontact` VARCHAR(200),";
  $sql .= "`locname` VARCHAR(255),";
  $sql .= "`locphone` VARCHAR(15),";
  $sql .= "`locstrtadrss` VARCHAR(255),";
  $sql .= "`assaddress` VARCHAR(255),";
  $sql .= "`asszip` VARCHAR(20),";
  $sql .= "`startdate` VARCHAR(12) DEFAULT '0000-00-00' NOT NULL,";
  $sql .= "`starttime` VARCHAR(10) DEFAULT '00:00:00' NOT NULL,";
  $sql .= "`estlen` VARCHAR(100),";
  $sql .= "`casename` VARCHAR(255),";
  $sql .= "`caseno` VARCHAR(100),";
  $sql .= "`depname` TEXT,";
  $sql .= "`courtreporter` ENUM('yes', 'no'),";
  $sql .= "`videographer` ENUM('yes', 'no'),";
  $sql .= "`interpreter` ENUM('yes', 'no'),";
  $sql .= "`language` VARCHAR(255),";
  $sql .= "`conferenceroom` ENUM('yes', 'no'),";
  $sql .= "`speakerphone` ENUM('yes', 'no'),";
  $sql .= "`realtime` ENUM('yes', 'no'),";
  $sql .= "`vidconf` ENUM('yes', 'no'),";
  $sql .= "`pcontactmtd` VARCHAR(50),";
  $sql .= "`additionalcomments` TEXT,";
  $sql .= "`subdatetime` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,";
  $sql .= "`upfile` VARCHAR(255)";
  $sql .= ");";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
  add_option("ngsch_db_version", $ngsch_db_version);
}
register_activation_hook(__FILE__,'ngch_install');
/*
 * Add an admin submenu link under Settings
 */
function naegeli_add_options_submenu_page() {
	add_menu_page ( 
		__( 'Naegeli Scheduler', 'naegeli' ),
		__( 'Naegeli Scheduler', 'naegeli' ),
		'manage_options', 
		'ng_scheduler', 
		'naegeli_options_page', 
		'dashicons-clock', 
		75 
		);
	add_submenu_page (
		'ng_submission_inbox',
		__( 'Detail page', 'naegeli' ),
		__( 'Detail page', 'naegeli' ),
		'manage_options', 
		'ng_signle_submission', 
		'ng_view_submission'
		);
}
add_action( 'admin_menu', 'naegeli_add_options_submenu_page' );
/**
 * Register the settings
 */
function naegeli_register_settings() {
     register_setting(
          'naegeli_options',  // settings section
          'naegeli_alert' // setting name
     );
}
add_action( 'admin_init', 'naegeli_register_settings' );
/**
 * Build admin options page
 */
function naegeli_options_page() {
     if ( ! isset( $_REQUEST['settings-updated'] ) )
          $_REQUEST['settings-updated'] = false; ?>
     <div class="wrap">
          <h2><?php echo esc_html( get_admin_page_title() ); ?></h2> 
          <div id="poststuff">
               <div id="post-body">
                    <div id="post-body-content">
                         <form method="post" action="options.php">
                              <?php settings_fields( 'naegeli_options' ); ?>
                              <?php $options = get_option( 'naegeli_alert' ); ?>
                              <table class="form-table">
                                   <tr valign="top"><th scope="row"><?php _e( 'Email ID(s) to send submitted data', 'naegeli' ); ?></th>

                                        <td>

                                                  <?php $alert_email = $options['alert_email'] != '' ? $options['alert_email'] : get_option('admin_email'); ?>

                                                              <input name="naegeli_alert[alert_email]" type="email" id="alert_email" aria-describedby="admin-email-description" value="<?php echo $alert_email; ?>" class="regular-text ltr">

                                                        <p class="description" id="admin-email-description"><?php _e( 'If not set then submitted data will send to admin email.', 'naegeli' ); ?></p>

                                        </td>

                                   </tr>

                                   <tr valign="top"><th scope="row"><?php _e( 'Google reCAPTCHA Site key', 'naegeli' ); ?></th>

                                        <td>

                                                  <?php $site_key = $options['site_key'] != '' ? $options['site_key'] : ''; ?>

                                                              <input name="naegeli_alert[site_key]" type="text" id="site_key" aria-describedby="site-key-description" value="<?php echo $site_key; ?>" class="regular-text ltr">

                                                        <p class="description" id="site-key-description"><?php _e( 'Get your Google reCAPTCHA site key from https://www.google.com/recaptcha/admin.', 'naegeli' ); ?></p>

                                        </td>

                                   </tr>

                                   <tr valign="top"><th scope="row"><?php _e( 'Google reCAPTCHA Secret key', 'naegeli' ); ?></th>

                                        <td>

                                                  <?php $secret_key = $options['secret_key'] != '' ? $options['secret_key'] : ''; ?>

                                                              <input name="naegeli_alert[secret_key]" type="text" id="secret_key" aria-describedby="secret-key-description" value="<?php echo $secret_key; ?>" class="regular-text ltr">

                                                        <p class="description" id="secret-key-description"><?php _e( 'Get your Google reCAPTCHA secret key from https://www.google.com/recaptcha/admin.', 'naegeli' ); ?></p>

                                        </td>

                                   </tr>

                              </table>

                                     <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>

                         </form>

                         <p class="description">Plugin shortcode: [naegeli_schedule_form]</p>

                    </div> <!-- end post-body-content -->

               </div> <!-- end post-body -->

          </div> <!-- end poststuff -->

     </div>

<?php

}

/**

 * Build the form

*/

add_action( 'wp_enqueue_scripts', 'register_my_script' );

function register_my_script() {
     /*wp_register_style( 'bootstarpcss', plugins_url( '/bootstrap/css/bootstrap.min.css' , __FILE__ ), '1.0.0', 'screen' );*/
     wp_register_style( 'datepickercss', plugins_url( '/bootstrap-datepicker/bootstrap-datepicker.min.css' , __FILE__ ), '1.0.0' );
     wp_register_style( 'timepickercss', plugins_url( '/bootstrap-timepicker/bootstrap-timepicker.min.css' , __FILE__ ), '1.0.0' );
     wp_register_style( 'filebootcss', plugins_url( '/jasny-bootstrap/jasny-bootstrap.min.css' , __FILE__ ), '1.0.0' );
     wp_register_style( 'extracss', plugins_url( '/css/extra.css' , __FILE__ ), '1.0.0', 'screen' );
     /*wp_register_script( 'bootstarpjs', plugins_url( '/bootstrap/js/bootstrap.min.js' , __FILE__ ), array('jquery'), '1.0.0', true );*/
     wp_register_script( 'datepicker', plugins_url( '/bootstrap-datepicker/bootstrap-datepicker.min.js' , __FILE__ ), array('jquery','bootstrap-js'), '1.0.0', true );
     wp_register_script( 'timepicker', plugins_url( '/bootstrap-timepicker/bootstrap-timepicker.min.js' , __FILE__ ), array('jquery','bootstrap-js'), '1.0.0', true );
     wp_register_script( 'filebootjs', plugins_url( '/jasny-bootstrap/jasny-bootstrap.min.js' , __FILE__ ), array('jquery','bootstrap-js'), '1.0.0', true );
     wp_register_script( 'extrajs', plugins_url( '/js/extra.js' , __FILE__ ), array('jquery','bootstrap-js'), '1.0.0', true );
}


add_shortcode("naegeli_schedule_form", "createForm");
function createForm(){

     $optionval = get_option( 'naegeli_alert' );
     $siteKey = $optionval['site_key'];
     $lang = 'en';

     wp_enqueue_style( 'bootstarpcss' );
     wp_enqueue_style( 'datepickercss' );
     wp_enqueue_style( 'timepickercss' );
     wp_enqueue_style( 'filebootcss' );
     wp_enqueue_style( 'extracss' );
     wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
     wp_enqueue_script( 'bootstarpjs' );
     wp_enqueue_script( 'datepicker' );
     wp_enqueue_script( 'timepicker' );
     wp_enqueue_script( 'filebootjs' );
     wp_enqueue_script( 'extrajs' );

     //ob_start();
     ?>
     <div id="m2forms">
     <div class="greybg">
     <div class="row">
     <div class="col-md-12">
          <p class="formtxt"><span class="form-sub-heading">SCHEDULE NOW!</span> Your assignment scheduling will be confirmed via email within one business day. If confirmation is not received, please contact us at <a href="tel:8005283335" class="telno">(800)528-3335</a> or <span style="text-decoration: underline;"><a href="mailto:schedule@naegeliusa.com" class="telno">Schedule@NaegeliUSA.com</a></span> to speak directly with our NAEGELI scheduling manager 24/7.</p>
          <p class="formtxt"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/top-curl.jpg'  ?>"></p>
          <p class="formtxt"><span class="form-sub-heading">SHORT ON TIME?</span> <span class="text-white"><a style="text-decoration: underline;" href="mailto:schedule@naegeliusa.com" class="telno">Email us</a> AND attach your Deposition Notice if available.</span></p>
          <p class="formtxt">You will receive a confirmation via email within one business day. Last minute assignments are our specialty. Let us exceed your expectations!</p>
     </div>
     </div>
     

     <div class="row">
     <div class="col-md-12">
     <h2 class="form-sub-heading">CLIENT INFORMATION</h2>
     <div class="panel-body">
        <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" class="form-horizontal" id="m2fcapform" role="form" method="post" enctype="multipart/form-data">

          

          <div class="form-group">

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_name">YOUR NAME <span class="req">*REQUIRED</span></label>
                    <input name="yname" class="form-control" id="id_name" type="text" required>
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_email">EMAIL <span class="req">*REQUIRED</span></label>
                    <input name="yemail" class="form-control" id="id_email" type="text" required>
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_phone">PHONE <span class="req">*REQUIRED</span></label>
                    <input name="yphone" class="form-control" id="id_phone" type="text" data-mask="999-999-9999" required>
               </div>

          </div>

          <h2 class="form-sub-heading">ATTORNEY / LAW FIRM INFORMATION</h2>

          <div class="form-group">

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_attorneyname">ATTORNEY NAME</label>
                    <input name="attorneyname" class="form-control" id="id_attorneyname" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_lawfn">LAW FIRM NAME</label>
                    <input name="lawfrmname" class="form-control" id="id_lawfn" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_lawfphone">LAW FIRM PHONE</label>
                    <input name="lawfphone" class="form-control" id="id_lawfphone" type="text" data-mask="999-999-9999">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_lawfmstadds">LAW FIRM STREET ADDRESS</label>
                    <input name="lawfmstadds" class="form-control" id="id_lawfmstadds" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_attaddress">CITY / STATE / PROVINCE</label>
                    <input name="attaddress" class="form-control" id="id_attaddress" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_attzip">ZIP</label>
                    <input name="attzip" class="form-control" id="id_attzip" type="text">
               </div>

          </div>

          <h2 class="form-sub-heading">ASSIGNMENT INFORMATION</h2>

          <div class="form-group" id="maybeadd">

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_locname">LOCATION CONTACT NAME</label>
                    <input name="locname" class="form-control" id="id_locname" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_loccontact">LOCATION FIRM</label>
                    <input name="loccontact" class="form-control" id="id_loccontact" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_locphone">LOCATION PHONE</label>
                    <input name="locphone" class="form-control" id="id_locphone" data-mask="999-999-9999" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_locstrtadrss">LOCATION STREET ADDRESS</label>
                    <input name="locstrtadrss" class="form-control" id="id_locstrtadrss" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_assaddress">CITY / STATE / PROVINCE</label>
                    <input name="assaddress" class="form-control" id="id_assaddress" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_asszip">ZIP</label>
                    <input name="asszip" class="form-control" id="id_asszip" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_startdate">START DATE(S)</label>
                    <input name="startdate" id="id_startdate" type="text" class="form-control">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_starttime">START TIME</label>
                    <div class="input-group bootstrap-timepicker timepicker">
                      <input name="starttime" id="id_starttime" type="text" class="form-control">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                    </div>
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_estlen">ESTIMATED LENGTH</label>
                    <input name="estlen" class="form-control" id="id_estlen" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_casename">CASE CAPTION</label>
                    <input name="casename" class="form-control" id="id_casename" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_caseno">CASE NUMBER</label>
                    <input name="caseno" class="form-control" id="id_caseno" type="text">
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="id_depname">DEPONENT NAME(S)</label>
                    <div class="input-group">
                         <input name="depname[]" class="form-control" id="id_depname" type="text">
                         <span class="input-group-addon" id="addfield"><i class="glyphicon glyphicon-plus"></i></span>
                    </div>
               </div>

          </div>

          <h2 class="form-sub-heading">SERVICE REQUIREMENTS</h2>

          <div class="form-group">

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="courtreporter">COURT REPORTER</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="courtreporter" class="radio courtreporter" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="courtreporter" class="radio courtreporter" value="no">
                         NO
                    </label>
                    </div>
               </div>

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="videographer">VIDEOGRAPHER</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="videographer" class="radio videographer" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="videographer" class="radio videographer" value="no">
                         NO
                    </label>
                    </div>
               </div>

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="interpreter">INTERPRETER</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="interpreter" class="radio interpreter" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="interpreter" class="radio interpreter" value="no">
                         NO
                    </label>
                    </div>
               </div>

               <div class="col-md-3 col-xs-12 extraheight">
                    <label class="control-label" for="id_language">LANGUAGE</label>
                    <input name="language" class="form-control" id="id_language" type="text" placeholder="LANGUAGE REQUESTED">
               </div>

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="conferenceroom">CONFERENCE ROOM</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="conferenceroom" class="radio conferenceroom" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="conferenceroom" class="radio conferenceroom" value="no">
                         NO
                    </label>
                    </div>
               </div>

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="speakerphone">SPEAKERPHONE</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="speakerphone" class="radio speakerphone" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="speakerphone" class="radio speakerphone" value="no">
                         NO
                    </label>
                    </div>
               </div>

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="realtime">REALTIME</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="realtime" class="radio realtime" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="realtime" class="radio realtime" value="no">
                         NO
                    </label>
                    </div>
               </div>

               <div class="col-md-3 col-xs-12">
                    <label class="control-label" for="vidconf">VIDEOCONFERENCING</label>
                    <div class="radio">
                    <label>
                         <input type="radio" name="vidconf" class="radio vidconf" value="yes">
                         YES
                    </label>
                    </div>
                    <div class="radio">
                    <label>
                         <input type="radio" name="vidconf" class="radio vidconf" value="no">
                         NO
                    </label>
                    </div>
               </div>
          </div>

          <div class="form-group">

               <div class="col-md-8 col-xs-12 fileclass">
                    <label class="control-label" for="attachdoc">UPLOAD YOUR DEPOSITION NOTICE HERE</label>
                    <span class="helpBlock help-block">Please upload only the following file types: Adobe PDF or Microsoft Word</span>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <span class="btn btn-danger btn-file"><span class="fileinput-new">CHOOSE FILE</span><span class="fileinput-exists">Change</span><input type="file" id="attachdoc" name="attachdoc"></span>
                      <span class="fileinput-filename"></span>
                      <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                    </div>
               </div>

               <div class="col-md-4 col-xs-12">
                    <label class="control-label" for="pcontactmtd">PREFERRED CONTACT METHOD</label>
                    <select name="pcontactmtd" class="form-control">
                      <option value="email">EMAIL</option>
                      <option value="phone">PHONE</option>
                    </select>
               </div>
          </div>
          <div class="form-group">
               <div class="col-md-12 col-xs-12">
               <label class="control-label" for="additionalcomments">ADDITIONAL COMMENTS</label>
               <textarea name="additionalcomments" rows="5" class="form-control" id="additionalcomments"></textarea>
               </div>
          </div>
          <div class="form-group">
              <div class="col-md-6 col-xs-12">
                <label class="control-label" for="additionalcomments">Google reCaptcha</label>
                <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
                <span class="helpBlock help-block">Your privacy is important to us. Your information is completely secure.</span>
              </div>
              <div class="col-md-6 col-xs-12">
                <img src="<?php echo plugin_dir_url( __FILE__ ) . 'img/form-logo.png'  ?>" >
              </div>
          </div>
          <div class="form-group">
              <div class="col-md-4 col-sm-8 col-xs-12">
                <?php wp_nonce_field( 'ritunonce_action', 'ritunonce' ); ?>
                <button type="submit" class="btn btn-danger" id="btn-large">SUBMIT</button>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-12" id="alerts">
              </div>
          </div>
        </form>
     </div>
     </div>
     </div>
     </div>
     <?php
     //return ob_get_clean();
     //ob_end_flush();
}
add_action( 'init', 'process_form' );
function process_form() {
     global $errors;
     if(isset($_POST['ritunonce'])) {
          if ( 
              ! isset( $_POST['ritunonce'] ) 
              || ! wp_verify_nonce( $_POST['ritunonce'], 'ritunonce_action' )
          ) {
             $errors = "Security check failed.";
          } else {
               if( isset($_POST['g-recaptcha-response']) ){
                    // reCAPTCHA
                    require_once __DIR__ . '/src/autoload.php';
                    $optionval = get_option( 'naegeli_alert' );
                    $secret = $optionval['secret_key'];
                    $recaptcha = new \ReCaptcha\ReCaptcha($secret);
                    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

                    if ($resp->isSuccess()){
                         $yname = !empty($_POST['yname'])?strip_tags($_POST['yname']):'unknown';
                         $yemail = !empty($_POST['yemail'])?strip_tags($_POST['yemail']):'unknown';
                         $yphone = !empty($_POST['yphone'])?strip_tags($_POST['yphone']):'123';
                         $attorneyname = !empty($_POST['attorneyname'])?strip_tags($_POST['attorneyname']):'unknown';
                         $lawfrmname = !empty($_POST['lawfrmname'])?strip_tags($_POST['lawfrmname']):'unknown';
                         $lawfphone = !empty($_POST['lawfphone'])?strip_tags($_POST['lawfphone']):'123';
                         $lawfmstadds = !empty($_POST['lawfmstadds'])?strip_tags($_POST['lawfmstadds']):'unknown';
                         $attaddress = !empty($_POST['attaddress'])?strip_tags($_POST['attaddress']):'unknown';
                         $attzip = !empty($_POST['attzip'])?strip_tags($_POST['attzip']):'unknown';
                         $loccontact = !empty($_POST['loccontact'])?strip_tags($_POST['loccontact']):'unknown';
                         $locname = !empty($_POST['locname'])?strip_tags($_POST['locname']):'unknown';
                         $locphone = !empty($_POST['locphone'])?strip_tags($_POST['locphone']):'123';
                         $locstrtadrss = !empty($_POST['locstrtadrss'])?strip_tags($_POST['locstrtadrss']):'unknown';
                         $assaddress = !empty($_POST['assaddress'])?strip_tags($_POST['assaddress']):'unknown';
                         $asszip = !empty($_POST['asszip'])?strip_tags($_POST['asszip']):'unknown';
                         $startdate = !empty($_POST['startdate'])?strip_tags($_POST['startdate']):'unknown';
                         $starttime = !empty($_POST['starttime'])?strip_tags($_POST['starttime']):'unknown';
                         $estlen = !empty($_POST['estlen'])?strip_tags($_POST['estlen']):'unknown';
                         $casename = !empty($_POST['casename'])?strip_tags($_POST['casename']):'unknown';
                         $caseno = !empty($_POST['caseno'])?strip_tags($_POST['caseno']):'unknown';
                         $depname = !empty($_POST['depname'])?$_POST['depname']:'unknown';
                         $courtreporter = !empty($_POST['courtreporter']) ? $_POST['courtreporter'] : 'unknown';
                         $videographer = !empty($_POST['videographer']) ? $_POST['videographer'] : 'unknown';
                         $interpreter = !empty($_POST['interpreter']) ? $_POST['interpreter'] : 'unknown';
                         $language = !empty($_POST['language']) ? $_POST['language'] : 'unknown';
                         $conferenceroom = !empty($_POST['conferenceroom']) ? $_POST['conferenceroom'] : 'unknown';
                         $speakerphone = !empty($_POST['speakerphone']) ? $_POST['speakerphone'] : 'unknown';
                         $realtime = !empty($_POST['realtime']) ? $_POST['realtime'] : 'unknown';
                         $vidconf = !empty($_POST['vidconf']) ? $_POST['vidconf'] : 'unknown';
                         $pcontactmtd = $_POST['pcontactmtd'];
                         $additionalcomments = !empty($_POST['additionalcomments'])?strip_tags($_POST['additionalcomments']):'unknown';
                         //checking file type
                         function CheckFile ($file){
                               $mimeTypes = array(
                                             "application/pdf",
                                             "application/msword",
                                             "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                             );
                               $fileExtensions = array("pdf", "doc", "docx");
                                         $xval = explode(".", $file["name"]);
                               if (in_array($file['type'], $mimeTypes) &&
                                       in_array( end($xval), $fileExtensions)) {
                                   return true;
                               }
                         }
                         //check before processing form submit
                         if ( empty($yname) || empty($yemail) || empty($yphone) ) {
                              $errors = "You have missed required field!";
                         }
                         elseif (!is_email($yemail)) {
                              $errors = "Invalid email address!";
                         }
                         elseif ( !empty($_FILES['attachdoc']['name']) && !CheckFile($_FILES['attachdoc'])){
                              $errors = "We support only pdf, doc and docx!";
                         }
                         else {
                              if ( ! function_exists( 'wp_handle_upload' ) ) {
                                  require_once( ABSPATH . 'wp-admin/includes/file.php' );
                              }
                              $uploadedfile = $_FILES['attachdoc'];
                              $upload_overrides = array( 'test_form' => false );
                              $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                              if ( $movefile && !isset( $movefile['error'] ) ) {
                                  $attachment_url = $movefile['url'];
                                  $attachments = $movefile['file'];
                              }
                              $ready = 1;
                         }
                    }
                    else{
                         $errors = "Something went wrong!";
                    }
               }

          }
          if(isset($errors) && !empty($errors)){
               function alertF(){
                    global $errors;
                    ?>
                    <script type="text/javascript">
                    jQuery(function($){
                         $("#alerts").empty().append('<p class="bg-dark error"><?php echo $errors; ?></p>');
                         $('html, body').animate({
	                                      scrollTop: $('#alerts').offset().top
	                                  }, 'slow');
                    });
                    </script>
                    <?php
               }
               add_action('wp_footer','alertF');
          }
          if(isset($ready) && (1 == $ready)) {
               $optionemail = get_option( 'naegeli_alert' );
               $alert_email = $optionemail['alert_email'];
               $to = $alert_email;
               //$to = 'anna@naegeliusa.com,maryjo@naegeliusa.com,anna@larsentidswell.com,rsgp.88@gmail.com';
               $subject = 'NAEGELI Automated Scheduling Confirmation for '.$yname;
               $headers = "From: webdev@naegeliusa.com\r\n";
               $headers .= "Reply-To: ". $yemail."\r\n";
               $headers .= "Cc: ".$yemail."\r\n";
               $headers .= "MIME-Version: 1.0\r\n";
               $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
               $message = '<html><body>';
               $message .= '<table rules="all" style="border:1px solid #ddd;" cellpadding="10">';
               $message .= '<tr style="background: #000;"><td style="text-align:center;" colspan="2"><img width="150" src="'.get_template_directory_uri().'/images/naegeli-email-header-logo.jpg"></td></tr>';

               $message .= "<tr style='background: #eee;'><td><strong>NAME:</strong> </td><td>" . $yname . "</td></tr>";

               $message .= "<tr style='background: #eee;'><td><strong>EMAIL:</strong> </td><td>" . $yemail . "</td></tr>";

               $message .= "<tr style='background: #eee;'><td><strong>PHONE:</strong> </td><td>" . $yphone . "</td></tr>";

               $message .= "<tr><td><strong>ATTORNEY NAME:</strong> </td><td>" . $attorneyname . "</td></tr>";

               $message .= "<tr><td><strong>LAW FIRM NAME:</strong> </td><td>" . $lawfrmname . "</td></tr>";

               $message .= "<tr><td><strong>LAW FIRM PHONE:</strong> </td><td>" . $lawfphone . "</td></tr>";

               $message .= "<tr><td><strong>LAW FIRM STREET ADDRESS:</strong> </td><td>" . $lawfmstadds . "</td></tr>";

               $message .= "<tr><td><strong>CITY / STATE / PROVINCE:</strong> </td><td>" . $attaddress . "</td></tr>";

               $message .= "<tr><td><strong>ZIP:</strong> </td><td>" . $attzip . "</td></tr>";

               $message .= "<tr><th colspan='2' style='background: #eee;'>ASSIGNMENT INFORMATION</th></tr>";

               $message .= "<tr><td><strong>LOCATION CONTACT NAME:</strong> </td><td>" . $loccontact . "</td></tr>";

               $message .= "<tr><td><strong>LOCATION NAME:</strong> </td><td>" . $locname . "</td></tr>";

               $message .= "<tr><td><strong>LOCATION PHONE:</strong> </td><td>" . $locphone . "</td></tr>";

               $message .= "<tr><td><strong>LOCATION STREET ADDRESS:</strong> </td><td>" . $locstrtadrss . "</td></tr>";

               $message .= "<tr><td><strong>CITY / STATE / PROVINCE:</strong> </td><td>" . $assaddress . "</td></tr>";

               $message .= "<tr><td><strong>ZIP:</strong> </td><td>" . $asszip . "</td></tr>";

               $message .= "<tr><td><strong>START DATE(S):</strong> </td><td>" . $startdate . "</td></tr>";

               $message .= "<tr><td><strong>START TIME:</strong> </td><td>" . $starttime . "</td></tr>";

               $message .= "<tr><td><strong>ESTIMATED LENGTH:</strong> </td><td>" . $estlen . "</td></tr>";

               $message .= "<tr><td><strong>CASE NAME:</strong> </td><td>" . $casename . "</td></tr>";

               $message .= "<tr><td><strong>CASE NUMBER:</strong> </td><td>" . $caseno . "</td></tr>";
                if($depname != 'unknown'){
                 foreach ( $_POST['depname'] as $key => $val) {
                    $message .= "<tr><td><strong>DEPONENT NAME(". $key ."):</strong> </td><td>" . $val . "</td></tr>";
               	 }
	            }else{
	            	$message .= "<tr><td><strong>DEPONENT NAME:</strong> </td><td>unknown</td></tr>";
	            }
               $message .= "<tr><th colspan='2' style='background: #eee;'>SERVICE REQUIREMENTS</th></tr>";

               $message .= "<tr><td><strong>COURT REPORTER:</strong> </td><td>" . $courtreporter . "</td></tr>";

               $message .= "<tr><td><strong>VIDEOGRAPHER:</strong> </td><td>" . $videographer . "</td></tr>";

               $message .= "<tr><td><strong>INTERPRETER:</strong> </td><td>" . $interpreter . "</td></tr>";

               $message .= "<tr><td><strong>LANGUAGE:</strong> </td><td>" . $language . "</td></tr>";

               $message .= "<tr><td><strong>CONFERENCE ROOM:</strong> </td><td>" . $conferenceroom . "</td></tr>";

               $message .= "<tr><td><strong>SPEAKERPHONE:</strong> </td><td>" . $speakerphone . "</td></tr>";

               $message .= "<tr><td><strong>REALTIME:</strong> </td><td>" . $realtime . "</td></tr>";

               $message .= "<tr><td><strong>VIDEOCONFERENCING:</strong> </td><td>" . $vidconf . "</td></tr>";

               $message .= "<tr><td><strong>PREFERRED CONTACT METHOD:</strong> </td><td>" . $pcontactmtd . "</td></tr>";

               $message .= "<tr><td><strong>ADDITIONAL COMMENTS:</strong> </td><td>" . $additionalcomments . "</td></tr>";

               $message .= "</table>";

               $message .= "<p>Thank you for contacting us. This is a copy for your records.</p>";

               $message .= "<p>Submitted on: ".date("m/d/Y")."</p>";

               $message .= "</body></html>";

               $attachments = isset($attachments) ? $attachments : '';
               $attachment_url = isset($attachment_url) ? $attachment_url : '';

               $result = wp_mail( $to, $subject, $message, $headers, $attachments );

               if($result){
               		if($depname != 'unknown'){
                    $depnam = implode(",",$_POST['depname']);
                  }
                  else{
                    $depnam = 'unknown';
                  }
               		global $wpdb;
               		$tablename = $wpdb->prefix . "ngch";
               		$wpdb->insert( 
						$tablename, 
						array( 
							'ssid' => 'NULL', 
							'yname' => $yname,
							'yemail' => $yemail, 
							'yphone' => $yphone,
							'attorneyname' => $attorneyname, 
							'lawfrmname' => $lawfrmname,
							'lawfphone' => $lawfphone, 
							'lawfmstadds' => $lawfmstadds,
							'attaddress' => $attaddress, 
							'attzip' => $attzip,
							'loccontact' => $loccontact,
							'locname' => $locname, 
							'locphone' => $locphone,
							'locstrtadrss' => $locstrtadrss, 
							'assaddress' => $assaddress,
							'asszip' => $asszip, 
							'startdate' => $startdate,
							'starttime' => $starttime, 
							'estlen' => $estlen,
							'casename' => $casename,
							'caseno' => $caseno, 
							'depname' => $depnam,
							'courtreporter' => $courtreporter, 
							'videographer' => $videographer,
							'interpreter' => $interpreter, 
							'language' => $language,
							'conferenceroom' => $conferenceroom, 
							'speakerphone' => $speakerphone,
							'realtime' => $realtime, 
							'vidconf' => $vidconf,
							'pcontactmtd' => $pcontactmtd, 
							'additionalcomments' => $additionalcomments,
							'subdatetime' => date("Y-m-d H:i:s"), 
							'upfile' => $attachment_url
						), 
						array( 
							'%d',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s'
						) 
					);
               		if($wpdb->insert_id){
	                    function alertS(){
	                         global $errors;
	                         ?>
	                         <script type="text/javascript">
	                         jQuery(function($){
	                              $("#alerts").empty().append('<p class="bg-dark">THANK YOU! YOUR REQUEST HAS BEEN SUBMITTED.</p>');
	                              $('html, body').animate({
	                                      scrollTop: $('#alerts').offset().top
	                                  }, 'slow');
	                         });
	                         </script>
	                         <?php
	                    }
	                    add_action('wp_footer','alertS');
                  	}
               }

          }
     }
}
require_once( plugin_dir_path( __FILE__ ) .'list_table.php' );
function ng_view_submission(){
	global $wpdb;
	if( isset($_POST['actioncsv']) && 'makecsv' == $_POST['actioncsv'] ){
		$result = $wpdb->get_results( "SELECT yname,yemail,yphone,attorneyname,lawfrmname,lawfphone,lawfmstadds,attaddress,attzip,locname,loccontact,locphone,locstrtadrss,assaddress,asszip,startdate,starttime,estlen,casename,caseno,depname,courtreporter,videographer,interpreter,language,conferenceroom,speakerphone,realtime,vidconf,pcontactmtd,additionalcomments,subdatetime FROM {$wpdb->prefix}ngch", 'ARRAY_A' );
		ob_end_clean();
		ob_start();
		if (count($result) == 0) {
		     return null;
		}
	    $now = gmdate("D, d M Y H:i:s");
		$df = fopen("php://output", 'w');
		fputcsv($df, array('NAME','EMAIL','PHONE','ATTORNEY NAME','LAW FIRM NAME','LAW FIRM PHONE','LAW FIRM STREET ADDRESS','CITY_STATE_PROVINCE','ZIP','LOCATION CONTACT NAME','LOCATION FIRM','LOCATION PHONE','LOCATION STREET ADDRESS','ASS_CITY_STATE_PROVINCE','ASS_ZIP','START DATE','START TIME','ESTIMATED LENGTH','CASE CAPTION','CASE NUMBER','DEPONENT NAMES','COURT REPORTER','VIDEOGRAPHER','INTERPRETER','LANGUAGE','CONFERENCE ROOM','SPEAKERPHONE','REALTIME','VIDEOCONFERENCING','PREFERRED CONTACT METHOD','ADDITIONAL COMMENTS','SUBMITTED ON'));
		foreach ($result as $row){
			fputcsv($df, $row);
		}
		fclose($df);
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	    header("Last-Modified: {$now} GMT"); 
	    header("Content-Type: application/force-download");
	    header("Content-Type: application/octet-stream");
	    header("Content-Type: application/download");
	    header("Content-Disposition: attachment;filename=data_export_" . date("Y-m-d") . ".csv");
	    header("Content-Transfer-Encoding: binary");
		die;
	}
	$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}ngch WHERE ssid = {$_GET['record']}", ARRAY_A );
	?>
	<div class="wrap">
		<h2>Naegeli Deposition Schedule Inbox</h2>
		<form method="post">
            <input type="hidden" name="actioncsv" value="makecsv" />
            <input class="button button-primary" type="submit" name="exportcsv" value="Export to CSV" />
        </form>
		<div id="poststuff">
			<div id="post-body" class="metabox-holder">
				<div id="post-body-content">
					<table class="wp-list-table widefat fixed striped submissions">
					<?php if(!empty($result)):?>
					<tr><th colspan="2"><span class="headings" style="display: block;font-size: 22px;padding: 15px 0;font-weight: bold;color: #d43f3a;">CLIENT INFORMATION</span></th></tr>
					<tr><th>NAME</th><td><?php echo $result['yname']; ?></td></tr>
					<tr><th>EMAIL</th><td><?php echo $result['yemail']; ?></td></tr>
					<tr><th>PHONE</th><td><?php echo $result['yphone']; ?></td></tr>
					<tr><th>ATTORNEY NAME:</th><td><?php echo $result['attorneyname']; ?></td></tr>
					<tr><th>LAW FIRM NAME</th><td><?php echo $result['lawfrmname']; ?></td></tr>
					<tr><th>LAW FIRM PHONE</th><td><?php echo $result['lawfphone']; ?></td></tr>
					<tr><th>LAW FIRM STREET ADDRESS</th><td><?php echo $result['lawfmstadds']; ?></td></tr>
					<tr><th>CITY / STATE / PROVINCE</th><td><?php echo $result['attaddress']; ?></td></tr>
					<tr><th>ZIP</th><td><?php echo $result['attzip']; ?></td></tr>
					<tr><th colspan="2"><span class="headings" style="display: block;font-size: 22px;padding: 15px 0;font-weight: bold;color: #d43f3a;">ASSIGNMENT INFORMATION</span></th></tr>
					<tr><th>LOCATION CONTACT NAME</th><td><?php echo $result['locname']; ?></td></tr>
          <tr><th>LOCATION FIRM</th><td><?php echo $result['loccontact']; ?></td></tr>
					<tr><th>LOCATION PHONE</th><td><?php echo $result['locphone']; ?></td></tr>
					<tr><th>LOCATION STREET ADDRESS</th><td><?php echo $result['locstrtadrss']; ?></td></tr>
					<tr><th>CITY / STATE / PROVINCE</th><td><?php echo $result['assaddress']; ?></td></tr>
					<tr><th>ZIP</th><td><?php echo $result['asszip']; ?></td></tr>
					<tr><th>START DATE</th><td><?php echo $result['startdate']; ?></td></tr>
					<tr><th>START TIME</th><td><?php echo $result['starttime']; ?></td></tr>
					<tr><th>ESTIMATED LENGTH</th><td><?php echo $result['estlen']; ?></td></tr>
					<tr><th>CASE CAPTION</th><td><?php echo $result['casename']; ?></td></tr>
					<tr><th>CASE NUMBER</th><td><?php echo $result['caseno']; ?></td></tr>
					<?php
						$arr = explode(',', $result['depname']);
						if(count($arr)>1){
							foreach ($arr as $key => $value) {
								echo '<tr><th>DEPONENT NAME('.($key + 1).')</th><td>'.$value.'</td></tr>';
							}
						}else{
							echo '<tr><th>DEPONENT NAME</th><td>'.$result['depname'].'</td></tr>';
						}
					?>
					<tr><th colspan="2"><span class="headings" style="display: block;font-size: 22px;padding: 15px 0;font-weight: bold;color: #d43f3a;">SERVICE REQUIREMENTS</span></th></tr>
					<tr><th>COURT REPORTER</th><td><?php echo $result['courtreporter']; ?></td></tr>
					<tr><th>VIDEOGRAPHER</th><td><?php echo $result['videographer']; ?></td></tr>
					<tr><th>INTERPRETER</th><td><?php echo $result['interpreter']; ?></td></tr>
					<tr><th>LANGUAGE</th><td><?php echo $result['language']; ?></td></tr>
					<tr><th>CONFERENCE ROOM</th><td><?php echo $result['conferenceroom']; ?></td></tr>
					<tr><th>SPEAKERPHONE</th><td><?php echo $result['speakerphone']; ?></td></tr>
					<tr><th>REALTIME</th><td><?php echo $result['realtime']; ?></td></tr>
					<tr><th>VIDEOCONFERENCING</th><td><?php echo $result['vidconf']; ?></td></tr>
					<tr><th>PREFERRED CONTACT METHOD</th><td><?php echo $result['pcontactmtd']; ?></td></tr>
					<tr><th>ADDITIONAL COMMENTS</th><td><?php echo $result['additionalcomments']; ?></td></tr>
					<tr><th>SUBMITTED ON</th><td><?php echo $result['subdatetime']; ?></td></tr>
                         <?php
                              if(!empty($result['upfile'])){
                                   $up_file = '<a target="_blank" href="'.$result['upfile'].'"><span class="dashicons dashicons-media-document"></span></a>';
                              }else{
                                   $up_file = 'No attachment';
                              }
                         ?>
					<tr><th>DEPOSITION NOTICE</th><td><strong><?php echo $up_file; ?></strong></td></tr>
					<?php else: ?>
					<tr><th colspan="2"><span class="headings" style="display: block;font-size: 22px;padding: 15px 0;font-weight: bold;color: #d43f3a;">No records found.</span></th></tr>
					<?php endif; ?>
					</table>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<?php
}