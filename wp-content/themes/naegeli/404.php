<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Brightspire Starter Theme
 */

get_header(); ?>
<section id="page-content">
<div class="container">
	<div class="row">
		<div class="col-md-12 contentsection">
			<h2 class="bigtxt black"><?php _e( 'Oops! That page can&rsquo;t be found.', '_brtspr' ); ?></h2>
			<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', '_naegeli' ); ?></p>

			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

			<?php
				/* translators: %1$s: smiley */
				$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', '_naegeli' ), convert_smilies( ':)' ) ) . '</p>';
				the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
			?>

			<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
		</div>
	</div>
</div>
</section>
<?php get_footer(); ?>
