<?php get_header(); ?>  

  <section class="page-content">
    <h1 id="page-title">
      <?php if ( is_day() ) : 
        echo 'Archives: ' . get_the_date();
      elseif ( is_month() ) : 
        echo 'Archives: ' . get_the_date('F Y');
      elseif ( is_year() ) : 
        echo 'Archives: ' . get_the_date('Y');
      elseif ( is_category() ) : 
        echo single_cat_title('Category: ');
      else : 
        echo 'Blog Archives';
      endif; ?>
    </h1>

    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
      get_template_part('post-index'); 
    endwhile; ?>
  </section>
  
<?php get_sidebar(); ?>
<?php get_footer(); ?>