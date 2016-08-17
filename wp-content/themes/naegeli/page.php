<?php get_header(); ?>

<?php if( have_posts() ) : the_post(); ?>
<section id="page-content">
<div class="headerimgholder">
<?php if( has_post_thumbnail() ){
	the_post_thumbnail('full', array('class'=>'img-responsive headerimg'));
}
?>
</div>
<?php
$vidlink = get_field('youtube_video_link');
if($vidlink){ ?>
	<div class="video">
		<?php echo $embed_code = wp_oembed_get($vidlink, array('height'=>360,'width'=>640)); ?>
		<p>Marsha J. Naegeli, Founder and CEO</p>
		<?php
		if(is_page(4)):
		?>
		<p class="schedulebutholder"><a href="<?php echo esc_url( get_permalink(6) ); ?>" class="innerbutt">SCHEDULE NOW</a></p>
		<?php
		endif;
		?>
	</div>
<?php }
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 contentsection">
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
<?php if(get_field('inner_page_quote')): ?>
<section id="quot" class="redishgrey">
<div class="container">
<div class="row">
	<div class="col-md-12">
		<?php the_field('inner_page_quote'); ?>
	</div>
</div>
</div>
</section>
<?php endif; ?>
<?php endif; ?>
<?php get_footer(); ?>