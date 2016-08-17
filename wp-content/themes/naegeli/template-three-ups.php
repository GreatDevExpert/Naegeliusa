<?php
/*
Template Name: three ups
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
		<div class="col-md-offset-3 col-md-2 col-sm-offset-3 col-sm-2 col-xs-offset-0 col-xs-12">
			<img src="<?php the_field('header_secondary_image_one'); ?>" class="img-responsive">
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<img src="<?php the_field('header_secondary_image_two'); ?>" class="img-responsive">
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12">
			<img src="<?php the_field('header_secondary_image_three'); ?>" class="img-responsive">
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
<?php endif; ?>
<?php get_footer(); ?>