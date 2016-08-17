<?php
/*
Template Name: career
*/
get_header(); ?>

<?php if( have_posts() ) : the_post(); ?>
<section id="page-content">
<div class="headerimgholder">
<?php if( has_post_thumbnail() ){
	the_post_thumbnail('full', array('class'=>'img-responsive headerimg'));
} ?>
</div>
<div class="container-fluid">
<div class="row video_with_image">
		<div class="col-md-offset-4 col-md-4 col-sm-offset-4 col-sm-4 col-xs-offset-2 col-xs-8 topthumbs">
			<img src="<?php the_field('header_secondary_image'); ?>" class="img-responsive reportnerror">
		</div>
</div>
</div>
<div class="container">
<div class="row">
		<div class="col-md-12 contentsection">
			<h3 class="bigtxt black"><?php the_title(); ?></h3>
			<?php the_content(); ?>
		</div>
</div>
</div>
</section>
<?php
$fimg = get_field('footer_background_image');
if( $fimg ): ?>
	<div style="height:180px;background-image:url(<?php echo esc_url($fimg); ?>);background-repeat:no-repeat;background-size:cover;background-position:bottom left;"></div>
<?php
endif;
?>
<?php endif; ?>
<?php get_footer(); ?>