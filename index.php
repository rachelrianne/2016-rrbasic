<?php get_header(); ?>
  
  <section class="page-content">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
      get_template_part('post-index');  
    endwhile; ?>

    <nav class="pagination">
      <p class="next"><?php next_posts_link('Older') ?></p>
      <p class="prev"><?php previous_posts_link('Newer') ?></p>
    </nav>
  </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>