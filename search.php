<?php get_header(); ?>

	<section class="page-content">
   <h1 id="page-title">Search Results</h1>
   
   <?php if (have_posts()) : while (have_posts()) : the_post(); 
    get_template_part('post-index');
   endwhile; ?>

   <?php else : ?>

    <p>No posts found. Try a different search?</p>
    <?php get_search_form(); ?>

   <?php endif; ?> 
  </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>