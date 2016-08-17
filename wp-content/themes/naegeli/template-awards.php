<?php
/*
Template Name: Naegeli awards
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
		<div class="col-md-offset-3 col-md-2 col-sm-offset-3 col-sm-2 col-xs-offset-0 col-xs-12 topthumbs">
			<a href="<?php echo esc_url(get_permalink(10)); ?>"><img src="<?php the_field('header_secondary_image_one'); ?>" class="img-responsive"><span>Affiliates</span></a>
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 topthumbs">
			<img src="<?php the_field('header_secondary_image_two'); ?>" class="img-responsive">
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 topthumbs">
			<a href="<?php echo esc_url(get_permalink(155)); ?>"><img src="<?php the_field('header_secondary_image_three'); ?>" class="img-responsive"><span>Press</span></a>
		</div>
</div>
</div>
<div class="container">
<div class="row">
		<div class="col-md-12 contentsection">
			<h3 class="bigtxt black"><?php the_title(); ?></h3>
			<p class="schedulebutholder"><a href="<?php echo esc_url( get_permalink(6) ); ?>" class="innerbutt">SCHEDULE NOW</a></p>
			<?php the_content(); ?>
			<div class="row awardsholder">
			<?php
			if( have_rows('naegeli_awards') ):
			    while ( have_rows('naegeli_awards') ) : the_row(); ?>    
			        <div class="col-md-4 col-xs-12 award">
			        <div class="awardimg_holder"><img src="<?php echo esc_url(get_sub_field('award_img')); ?>" class="img-responsive"></div>
			        <?php the_sub_field('award_text'); ?>
			        </div>
			        <?php
			    endwhile;
			else :
			    // no rows found
			endif;
			?>
			</div>
		</div>
</div>
<div class="row">
	<div class="col-md-12 contentsection">
		<?php the_field('text_after_naegeli_awards') ?>
	</div>
</div>
</div>
</section>
<?php endif; ?>
<?php get_footer(); ?>