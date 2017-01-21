<?php 

/* 
  FLEXIBLE LAYOUT
  for ACF flexible layouts
*/

?>

<?php if (have_rows('custom_page_layout')) :
  while (have_rows('custom_page_layout')) : the_row(); 

    if (get_row_layout() == 'full_width_text') : ?>

      <section class="page-content custom-layout full-width-text">
        <?php the_sub_field('content'); ?>
      </section>

    <?php elseif (get_row_layout() == 'image_text_section') : 
      if (get_sub_field('order') == 'image') : ?>
        
        <div class="row image-text-section">
          <div class="image">
            <?php $image = get_sub_field('image');
              if (!empty($image)) : ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            <?php endif; ?>
          </div>

          <div class="text">
            <?php the_sub_field('text'); ?>
          </div>
        </div>

      <?php else : ?>
        
        <div class="row image-text-section">
          <div class="text">
            <?php the_sub_field('text'); ?>
          </div>

          <div class="image">
            <?php $image = get_sub_field('image');
              if (!empty($image)) : ?>
                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
            <?php endif; ?>
          </div>
        </div>

      <?php endif; ?>

    <?php elseif (get_row_layout() == 'image_section') : ?>

      <?php if (have_rows('images')) : ?>
        <div class="image-section">
          <?php $i=0;
          while (have_rows('images')) : the_row(); 
            $i++;
          endwhile; 

          if ($i == 3) : ?>
            <div class="row three-images">
          <?php elseif ($i == 2) : ?>
            <div class="row two-images">
          <?php else : ?>
            <div class="row">
          <?php endif; ?>

            <?php while (have_rows('images')) : the_row(); ?>
              <?php $image = get_sub_field('image');
                if (!empty($image)) : ?>
                  <div class="image-wrap">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
                  </div>
              <?php endif; ?>
            <?php endwhile; ?>

          </div>

        </div>
      <?php endif; ?>
      
    <?php elseif (get_row_layout() == 'two_column_text_section') : ?>

      <div class="row two-column-text">
        <div class="left">
          <?php the_sub_field('left_column_content'); ?>
        </div>
        <div class="right">
          <?php the_sub_field('right_column_content'); ?>
        </div>
      </div>
      
    <?php endif;

  $i++;
  endwhile;
endif; ?>