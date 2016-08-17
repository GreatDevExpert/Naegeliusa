<?php
/*
Template Name: two ups locations
*/
get_header(); ?>

<?php if( have_posts() ) : the_post(); ?>
<section id="page-content">
<div class="headerimgholder">
<?php
if( has_post_thumbnail() ){
	the_post_thumbnail('full', array('class'=>'img-responsive headerimg'));
}
?>
<?php /* ?><p class="schedulebutholder"><a href="<?php echo esc_url( get_permalink(6) ); ?>" class="innerbutt">SCHEDULE</a></p><?php */ ?>
</div>
<div class="container">
<div class="row video_with_image">
		<div class="col-md-offset-2 col-md-4 col-sm-offset-1 col-sm-5 col-xs-offset-0 col-xs-12" id="header_sec_img_holder">
			<?php 
			$regroyal = get_field('slider_shortcode');
			echo get_new_royalslider($regroyal);
			?>
			<div class="clear"></div>
		</div>
		<div class="col-md-4 col-sm-5 col-xs-12">
			<div id="mapsml" style="width:340px;height:240px;">
			</div>
			<div class="clear"></div>
		</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12 contentsection">
		<h3 class="bigtxt black"><?php the_title(); ?></h3>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<p class="schedulebutholder"><a href="<?php echo esc_url( get_permalink(6) ); ?>" class="innerbutt">SCHEDULE NOW</a></p>
	</div>
</div>
<div class="row contactform" align = 'center'>
		<div class="col-md-3 contactdetails">
			<?php echo htmlspecialchars_decode(get_field('contact_info')); ?>
		</div>
		<div class="col-md-9">
			<?php echo do_shortcode('[contact-form-7 id="80" title="contact form"]'); ?>
		</div>
</div>
<div class="row">
		<div class="col-md-12">
			<h3 class="bigtxt black"><?php the_field('additional_locations_header_title'); ?></h3>
		</div>
	</div>
	<div class="row otherlocone">
		<div class="col-xs-12 nomargin hidden-lg hidden-md hidden-sm">
			<a class="mobbut" href="<?php echo esc_url( get_permalink(6) ); ?>">Schedule Now</a>
		</div>
		<?php
		if( have_rows('additional_locations') ):

		 	// loop through the rows of data
		 	$i = 1;
		    while ( have_rows('additional_locations') ) : the_row();
		        
		        ?>
		        <div class="<?php if($i==1 || $i==6 ){ echo 'col-md-offset-1';} ?> col-md-2 nomargin">
					<a href="<?php the_sub_field('location_page_url'); ?>"><img src="<?php the_sub_field('location_img'); ?>" class="img-responsive"></a>
				</div>
				<?php
				$i++;
		    endwhile;

		else :

		?>
		
			<div class="col-md-offset-2 col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/bend.jpg'; ?>" class="img-responsive"></a>
			</div>
			<div class="col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/medford.jpg'; ?>" class="img-responsive"></a>
			</div>
			<div class="col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/seattle.jpg'; ?>" class="img-responsive"></a>
			</div>
			<div class="col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/spokane.jpg'; ?>" class="img-responsive"></a>
			</div>
		</div>
		<div class="row otherloctwo">
			<div class="col-md-offset-2 col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/tacoma.jpg'; ?>" class="img-responsive">
			</div>
			<div class="col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/kennewick.jpg'; ?>" class="img-responsive">
			</div>
			<div class="col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/boise.jpg'; ?>" class="img-responsive">
			</div>
			<div class="col-md-2 nomargin">
				<a href=""><img src="<?php echo get_template_directory_uri().'/images/coeur.jpg'; ?>" class="img-responsive">
			</div>
		
		<?php
		endif;
		?>
		<a class="verbutton" href="<?php echo esc_url( get_permalink(6) ); ?>">Schedule Now</a>
		<div class="col-xs-12 nomargin hidden-lg hidden-md hidden-sm">
			<a class="mobbut" href="<?php echo esc_url( get_permalink(6) ); ?>">Schedule Now</a>
		</div>
	</div>
<div class="row">
	<div class="col-md-12 contentsection">
		<?php the_content(); ?>
	</div>
</div>

	
</div>
</section>
<?php
$fimg = get_field('footer_bg');
if( $fimg ): ?>
	<div style="height:180px;background-image:url(<?php echo esc_url($fimg); ?>);background-repeat:no-repeat;background-size:cover;background-position:bottom left;"></div>
<?php
endif;

$location = get_field('map_address');

?>
<script type="text/javascript">
var customMapType = new google.maps.StyledMapType([
      {
        stylers: [
          {hue: '#676767'},
          {visibility: 'simplified'},
          {saturation: -100},
          {gamma: 0.5},
          {weight: 0.5}
        ]
      },
      {
        elementType: 'labels',
        stylers: [{visibility: 'on'}]
      },
      {
        featureType: 'water',
        stylers: [{color: '#b9bcc1'}]
      }
    ], {
      name: 'Custom Style'
  });
var customMapTypeId = 'custom_style';
var loc = {lat: <?php echo $location['lat']; ?>, lng: <?php echo $location['lng']; ?>};
var map = new google.maps.Map(document.getElementById('mapsml'), {
    zoom: 15,
    center: loc,
    scrollwheel: false,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
    }
  });
map.mapTypes.set(customMapTypeId, customMapType);
map.setMapTypeId(customMapTypeId);
var contentString = '<div id="caddress"><?php echo htmlspecialchars_decode(get_field('contact_info')); ?><div id="caddress">';
var infowindow = new google.maps.InfoWindow({
content: contentString,
maxWidth: 300
});

var marker = new google.maps.Marker({
position: loc,
map: map,
title: 'Naegeli Office <?php the_title(); ?>'
});
marker.addListener('click', function() {
	infowindow.open(map, marker);
});
</script>
<?php endif; ?>
<?php get_footer(); ?>