<?php
/*
Template Name: blog index
*/
get_header(); ?>
<?php if( have_posts() ) : the_post(); ?>
<section id="page-content">
<div class="headerimgholder">
<?php if( has_post_thumbnail() ){
	the_post_thumbnail('full', array('class'=>'img-responsive headerimg'));
} ?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12 contentsection">
			<h3 class="bigtxt black"><?php the_title(); ?></h3>
			<?php endif; ?>
			<?php
				$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
				$bargs = array(
							'post_type'=>'post',
							'posts_per_page'=>10,
							'paged' => $paged,
							'orderby'=>'date',
							'order'=>'DSC',
							);
				$bquery = new WP_Query($bargs);
				if( $bquery->have_posts() ) : while( $bquery->have_posts() ) : $bquery->the_post();
			?>
			<div class="blog-item">
				<div class="post-meta">Posted on <?php the_time('M j, Y'); ?> in Naegeli Blog | <?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></div>
				<?php if(has_post_thumbnail()){
						the_post_thumbnail('blog_thumb', array('class'=>'img-responsive post-thumb' ));
					}
				?>
				<h2 class="post-title"><a href="<?php esc_url(the_permalink()); ?>" class="postlink"><?php the_title(); ?></a></h2>
				<div class="blog-entry"><?php the_excerpt(); ?></div>
			</div>
			<?php
				endwhile; wp_reset_postdata(); endif;
			?>
			<?php echo easy_wp_pagenavigation( $bquery ); ?>
		</div>
	</div>
</div>
</section>
<?php get_footer(); ?>