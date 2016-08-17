<?php
/*
Template Name: two ups
*/
function modify_youtube_embed_url($html) {
    return str_replace("?feature=oembed", "?feature=oembed&rel=0", $html);
}
get_header(); ?>

<?php if( have_posts() ) : the_post(); ?>
<section id="page-content">
<div class="headerimgholder">
<?php if( has_post_thumbnail() ){
	the_post_thumbnail('full', array('class'=>'img-responsive headerimg'));
} ?>
<?php /* ?><img src="<?php echo get_template_directory_uri().'/images/schedule-button.png'; ?>" class="sbutton"> <?php */ ?>
</div>
<div class="container">
<?php
$vidlink = get_field('youtube_video_link');
if($vidlink){ ?>
<div class="row video_with_image">
		<div class="col-md-offset-2 col-md-4 col-sm-offset-1 col-sm-5 col-xs-offset-0 col-xs-12" id="header_sec_img_holder">
			<img src="<?php the_field('header_secondary_image'); ?>" class="img-responsive header_sec_img">
			<div class="clear"></div>
		</div>
		<div class="col-md-4 col-sm-5 col-xs-12">
			<div class="embedvid">
			  <?php
				add_filter('oembed_result', 'modify_youtube_embed_url');
				$embed_code = wp_oembed_get($vidlink); 
				echo $embed_code;


			?>
			</div>
		</div>
</div>
<?php }
?>
	<div class="row">
		<div class="col-md-12 contentsection">
			<h3 class="bigtxt black"><?php the_title(); ?></h3>
			<p class="schedulebutholder"><a href="<?php echo esc_url( get_permalink(6) ); ?>" class="innerbutt">SCHEDULE NOW</a></p>
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