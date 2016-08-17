<?php get_header(); ?>
<?php if( have_posts() ) : the_post(); ?>
<section id="page-content">
<?php
$location = get_field('map_address');
if($location){
	$lat = $location['lat'];
	$lng = $location['lng'];
}
else{
	$lat = '45.522187';
	$lng = '-122.676291';
}
?>
<div id="map" style="height:400px;"></div>
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
//var loc = {lat: 45.522187, lng: -122.676291};
var loc = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 15,
    center: loc,
    scrollwheel: false,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, customMapTypeId]
    }
  });
map.mapTypes.set(customMapTypeId, customMapType);
map.setMapTypeId(customMapTypeId);
var contentString = '<div id="locaddress">'+
  '<p><i class="fa fa-building-o office"></i> 111 SW 5th Ave #2020,</p>'+
  '<p>Portland, OR 97204, USA</p>'+
  '</div>';

var infowindow = new google.maps.InfoWindow({
content: contentString,
maxWidth: 300
});

var marker = new google.maps.Marker({
position: loc,
map: map,
title: 'Naegeli Main Office'
});
marker.addListener('click', function() {
	infowindow.open(map, marker);
});
infowindow.open(map,marker);
</script>
<div class="container">
	<div class="row contactform">
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
		<?php
		if( have_rows('additional_locations') ):

		 	// loop through the rows of data
		 	$i = 1;
		    while ( have_rows('additional_locations') ) : the_row();
		        
		        ?>
		        <div class="<?php if($i==1 || $i==5 || $i==9){ echo 'col-md-offset-2';} ?> col-md-2 nomargin">
					<a href="<?php the_sub_field('location_page_url'); ?>"><img src="<?php the_sub_field('location_img'); ?>" class="img-responsive"></a>
				</div>
				<?php
				$i++;
		    endwhile;

		else :

		?>
		
			<div class="col-md-offset-2 col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(290) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/bend.jpg'; ?>" class="img-responsive"></a>
			</div>
			<div class="col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(388) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/medford.jpg'; ?>" class="img-responsive"></a>
			</div>
			<div class="col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(401) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/seattle.jpg'; ?>" class="img-responsive"></a>
			</div>
			<div class="col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(429) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/spokane.jpg'; ?>" class="img-responsive"></a>
			</div>
		</div>
		<div class="row otherloctwo">
			<div class="col-md-offset-2 col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(432) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/tacoma.jpg'; ?>" class="img-responsive">
			</div>
			<div class="col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(437) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/kennewick.jpg'; ?>" class="img-responsive">
			</div>
			<div class="col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(443) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/boise.jpg'; ?>" class="img-responsive">
			</div>
			<div class="col-md-2 nomargin">
				<a href="<?php echo esc_url( get_permalink(448) ); ?>"><img src="<?php echo get_template_directory_uri().'/images/coeur.jpg'; ?>" class="img-responsive">
			</div>
		<?php
		endif;
		?>
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
?>
<?php endif; ?>
<?php get_footer(); ?>