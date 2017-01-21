<?php 

/* 
  LIST OF SOCIAL LINKS
  make sure to create social_links ACF before using 
*/

?>
<?php if (have_rows('social_links', 'options')) : ?>
  <ul class="social-links row">
    <?php while (have_rows('social_links', 'options')) : the_row(); ?>
      <li>
        <a href="<?php the_sub_field('link'); ?>" target="_blank"><span class="assistive-text"><?php the_sub_field('social_media_platform'); ?></span><i class="icon <?php the_sub_field('social_media_platform'); ?>"></i></a>
      </li>
    <?php endwhile; ?>
  </ul>
<?php endif; ?>