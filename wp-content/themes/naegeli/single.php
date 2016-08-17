<?php
get_header(); ?>
<section id="page-content">
<div class="container">
  <div class="row">
    <div class="col-md-12 contentsection">
      <?php
        if( have_posts() ) : the_post();
      ?>
      <div class="blog-item fullpost">
        <div class="post-meta">Posted on <?php the_time('M j, Y'); ?> in Naegeli Blog | <?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></div>
        <div class="breadcrumb"><a href="<?php echo esc_url(get_permalink(12)); ?>"><i class="fa fa-chevron-circle-left"></i> Back to All posts</a></div>
        <?php if(has_post_thumbnail()){
            the_post_thumbnail('full', array('class'=>'img-responsive post-thumb' ));
          }
        ?>
        <h2 class="post-title"><?php the_title(); ?></h2>
        <div class="blog-entry"><?php the_content(); ?></div>
      </div>
      <?php
        endif;
      ?>
    </div>
  </div>
</div>
</section>
<?php get_footer(); ?>