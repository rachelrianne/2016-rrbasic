<?php get_header(); ?>

  <section class="page-content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
      get_template_part('post-single');
    endwhile; ?>

    <?php comments_template(); ?>
  </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>