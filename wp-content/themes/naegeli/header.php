<!DOCTYPE html>

<html <?php language_attributes(); ?> >

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->


<script type="text/javascript">

/* <![CDATA[ */

var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"https://naegelidepositionsusa.com/wp-admin/admin-ajax.php","loadingTrans":"Loading..."};

/* ]]> */

</script>

<!--END Scripts-->

</head>

<body <?php body_class(); ?>>

<section id="header" >

	<div class="container-fluid">

		<div class="row">

			<div class="col-md-12">

				<div class="logo">

					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php the_title_attribute(); ?>">

						<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/naegeli-logo-top.png">

					</a>

					

					<p class="headerphone">

					<a href="tel:8005283335" class="telno"><i class="fa fa-phone-square"></i> (800) 528-3335</a>

					</p>

				

				</div>

				<?php

					$mfamenu = array(

					'theme_location'  => 'primary',

					'menu'            => 'topmenu',

					'container'       => 'div',

					'container_class' => 'menu-primary-menu-container',

					'container_id'    => '',

					'menu_class'      => 'nav nav-pills',

					'menu_id'         => 'primary-menu'

				);

				?>

				<nav class="navbar" id="navigation">

					<?php wp_nav_menu( $mfamenu ); ?>

				</nav>

				<div class="mobilemenu" id="mmm">

				<div class="clearfix"></div>

			</div>

		</div>

	</div>

</section>

<?php if(is_home()):?>
<section id = 'blank_header' ></section>
<section id="homebanner">

	<?php

	if(wp_is_mobile() && 0){

	?>

	<img src="<?php echo get_template_directory_uri().'/images/mobile-banner.jpg'; ?>" class="homebanner-small img-responsive">

	<?php } else { 	?>
												
	<img src="<?php echo get_template_directory_uri().'/images/naegeli-home-banner.jpg'; ?>" class="homebanner-big img-responsive">
<?php } ?>



	<p class = 'bigtxt white redbutton'>	<a href="<?php echo esc_url( get_permalink(6) ); ?>" class="innerbut" >SCHEDULE NOW</a></p>







	<p class="bigtxt white">NATIONWIDE<br>COURT REPORTERS<br>

	</p>

</section>

<?php endif; ?>