<?php 
  $arg = array(
    'showposts' => 6
    'post_type' => 'news'
    'paged'     => $paged
  );

  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $wp_query->query($args); 

  while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

  <!-- LOOP: Usual Post Template Stuff Here-->

<?php endwhile; ?>

<nav class="pagination">
  <span class="next"><?php next_posts_link('&laquo; Older') ?></span>
  <span class="prev"><?php previous_posts_link('Newer &raquo;') ?></span>
</nav>

<?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
?>
<?php wp_reset_query(); ?>