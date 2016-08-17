<?php get_header(); ?>
	
<section id="overview" class="dark">
<div class="container">
<div class="row">
	<div class="col-md-12">
		<p class="bigtxt white">
			<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  echo ot_get_option( 'introduction' );
			}
			?>
		</p>
		<h2 class="sectiontitle white services"><span>SERVICES</span></h2>
		<p class="smalltxt lightred">
			<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  echo ot_get_option( 'about_services_section_one' );
			}
			?>
		</p>
	</div>
</div>
<div class="row serviceswrap">
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('4')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-About-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('54')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Court-Reporting-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('59')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Videography-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('61')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Videoconference-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('75')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Trial-Support-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('65')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Transcription-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('63')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Copy-Scan-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
	<div class="col-md-3 col-sm-6 col-xs-12 servicethumb">
		<a href="<?php echo esc_url(get_permalink('73')); ?>"><img src="<?php echo get_template_directory_uri().'/images/Naegeli-Interpreter-nw.jpg'; ?>" class="img-responsive"></a>
	</div>
</div>
</div>
</section>
<section id="about" class="light">
<div class="container">
<div class="row">
	<div class="col-md-12">
	<p class="smalltxt grey">
		<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  echo ot_get_option( 'about_services_section_two' );
			}
		?>
	</p>
	</div>
</div>
</div>
</section>

<section id="quot" class="redishgrey">
<div class="container">
<div class="row">
	<div class="col-md-12">
	<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  echo ot_get_option( 'testimonial' );
			}
	?>
	</div>
</div>
</div>
</section>
<section id="unknownman">
<div class="container">
<div class="row">
	<div class="col-md-12">
	<p class="bigtxt white">
	<?php
		if ( function_exists( 'ot_get_option' ) ) {
		  echo ot_get_option( 'the_naegeli_advantage_text' );
		}
	?>
	</p>
	</div>
</div>
</div>
</section>

<section id="team" class="light">
<div class="container">
<div class="row">
	<div class="col-md-12">
		<h2 class="sectiontitle black team"><span>OUR TEAM</span></h2>
		<p class="smalltxt grey">
			<?php
				if ( function_exists( 'ot_get_option' ) ) {
				  echo ot_get_option( 'our_team_part_one' );
				}
			?>
		</p>

		<div class="row teamwrap">
			<div class="col-md-8 col-md-offset-2">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12 teamthumb">
						<img src="<?php echo get_template_directory_uri().'/images/marsha.jpg'; ?>" class="img-responsive">
						<p><span class="nam">Marsha J. Naegeli</span><br><span class="rol">CEO &amp; Founder</span></p>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-12 teamthumb">
						<img src="<?php echo get_template_directory_uri().'/images/richard.jpg'; ?>" class="img-responsive">
						<p><span class="nam">RICHARD D. TERACI</span><br><span class="rol">Vice President</span></p>
					</div>

					<div class="col-md-4 col-sm-4 col-xs-12 teamthumb">
						<img src="<?php echo get_template_directory_uri().'/images/yvette.jpg'; ?>" class="img-responsive">
						<p><span class="nam">YVETTE A. WINDEN</span><br><span class="rol">Executive Director</span></p>
					</div>
				</div>
			</div>
		</div>

		<p class="smalltxt grey">
		<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  echo ot_get_option( 'our_team_part_two' );
			}
		?>
		</p>
	</div>
</div>
</div>
</section>

<?php get_footer(); ?>
