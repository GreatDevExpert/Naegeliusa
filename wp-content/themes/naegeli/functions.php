<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
// Core Setup

if ( ! function_exists( '_naegeli_setup' ) ) :

function _naegeli_setup() {

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );



	register_nav_menus( array(

		'primary' => __( 'Primary Menu', '_naegeli' ),

		'secondry' => __( 'footer Menu', '_naegeli' )

	) );



	add_theme_support( 'html5', array(

		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',

	) );

	

	add_theme_support( 'post-thumbnails', array('post','page','property'));

}

endif; // _naegeli_setup

add_action( 'after_setup_theme', '_naegeli_setup' );



add_image_size( 'hm_services_thumb', 237, 163 );

add_image_size( 'team_thumb', 240, 292, true );

add_image_size( 'blog_thumb', 500, 300, true );



/*add_filter( 'image_size_names_choose', 'my_custom_sizes' );

 

function my_custom_sizes( $sizes ) {

    return array_merge( $sizes, array(

        'property_img' => __( 'Property thumbnail' ),

    ) );

}*/



// Remove Dashboard widgets

function disable_default_dashboard_widgets() {

	remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget

	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget

	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget

	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget

	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget

	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //

	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

}

add_action('admin_menu', 'disable_default_dashboard_widgets');





/************* CUSTOM LOGIN PAGE *****************/



// calling your own login css so you can style it

function login_css() {

	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/style-login.css', false );

}



// changing the logo link from wordpress.org to your site

function login_url() {  return home_url(); }



// changing the alt text on the logo to show your site name

function login_title() { return get_option('blogname'); }



// calling it only on the login page

add_action('login_enqueue_scripts', 'login_css', 10 );

add_filter('login_headerurl', 'login_url');

add_filter('login_headertitle', 'login_title');



/**

 * Enqueue scripts and styles.

 */

function _naegeli_scripts() {



	$theme_version = wp_get_theme()->Version;



	wp_enqueue_style( '_naegeli-style', get_stylesheet_uri() );



	wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,600' );

	

	wp_enqueue_style( 'bootstrap-style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' );

	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

	wp_enqueue_style( 'meancss', get_template_directory_uri().'/css/meanmenu.min.css' );



	wp_enqueue_style( 'site-css', get_template_directory_uri().'/css/site.css', array('bootstrap-style','font-awesome') );



	wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), '3.3.4', false );



	wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), $theme_version, true );

	

	wp_enqueue_script( 'uitotop', get_template_directory_uri() . '/js/jquery.ui.totop.js', array( 'jquery' ), $theme_version, true );

	

	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array( 'jquery' ), $theme_version, true );



	/* for custom mailpoet*/

	wp_enqueue_script( 'jsvalidationengine-en', plugins_url() . '/wysija-newsletters/js/validate/languages/jquery.validationEngine-en.js', array( 'jquery' ), $theme_version );

	wp_enqueue_script( 'jsvalidationengine', plugins_url() . '/wysija-newsletters/js/validate/jquery.validationEngine.js', array( 'jquery' ), $theme_version );

	wp_enqueue_script( 'frontsubscriber', plugins_url() . '/wysija-newsletters/js/front-subscribers.js', array( 'jquery' ), $theme_version );

	



	wp_enqueue_script( 'scripts-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery','wp-embed' ), $theme_version, true );



	if ( is_page('16') || is_page_template('locations.php') ){

		wp_enqueue_script( 'goglemap', '//maps.google.com/maps/api/js' );

	}



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', '_naegeli_scripts' );



/*add_filter( 'script_loader_tag', function ( $tag, $handle ) {



    if ( 'goglemap' !== $handle )

        return $tag;



    return str_replace( ' src', ' async defer src', $tag );

}, 10, 2 );*/







//adding short cut icons

add_action('wp_head', 'add_favicon');

function add_favicon() {

    ?>

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/favicon.ico" type="image/x-icon" />

    <link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/apple-touch-icon.png" />

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_stylesheet_directory_uri();?>/apple-touch-icon-57x57.png" />

    <?php

}

add_action('wp_footer', 'add_js_extra');

function add_js_extra()

{

?>

	<script type="text/javascript">

		jQuery(function($){

			

				var emvh = parseInt($("#header_sec_img_holder img").height());

				$(".embedvid iframe").attr("height", emvh);

			

		});

	</script>

<?php

}



// read more

function new_excerpt_more( $more ) {

	return ' <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'read more:', '_naegeli' ) . '</a>';

}

add_filter( 'excerpt_more', 'new_excerpt_more' );



//adding a body class so that i can add unique css

add_filter( 'body_class', 'schedule_class_name' );

function schedule_class_name( $classes ) {

     if ( is_page(6) ) {

          $classes[] = 'naegeli-schedule-page';

     }

     return $classes;

}



add_action('acf/register_fields', 'my_register_fields');



function my_register_fields()

{

	include_once('acf-repeater/repeater.php');

}