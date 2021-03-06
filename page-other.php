<?php
/*
Template Name: Other Page Template
*/
?>

<?php get_header(); ?>

  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <section class="page-content">
      <h1><?php the_title();?></h1>
      <?php the_content();?>  
    </section>
  <?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>