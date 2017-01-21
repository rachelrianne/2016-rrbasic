<?php 

/* 
  LIST OF RELATED CATEGORY/CATEGORIES POSTS 
  - uses an ACF relationship called 'related_posts' for custom control, but if no relationship exists, random posts from related categories are pulled
*/

?>

<div class="related-posts">
  <div class="row-inner">
    <h1>Related Posts</h1>
    
    <?php $posts = get_field('related_posts');
      if ($posts) : $relatedPostNum = 1; ?>

        <ul id="related-posts" class="row">
          <?php foreach ($posts as $post) :
            setup_postdata($post); ?>

            <li class="post post-<?php echo $relatedPostNum; ?>">
              <a href="<?php the_permalink(); ?>"> 
                <h2 class="post-title">
                  <?php the_title(); ?>
                </h2>
              </a>
            </li>

          <?php $relatedPostNum++; endforeach; ?>
        </ul>

        <?php wp_reset_postdata(); ?>

      <?php else : 
        $postCats = get_the_terms($post->ID, 'category');
        $postCatArray = array();

        foreach ($postCats as $postCat) {
          array_push($postCatArray, $postCat->term_id);
        }

        $args = array(
          'post_type' => 'post',
          'showposts' => '4',
          'category__in' => $postCatArray,
          'orderby' => 'rand'
        );

        $rel_post_query = '';
        $temp = $rel_post_query; 
        $rel_post_query = null; 
        $rel_post_query = new WP_Query();
        $rel_post_query->query($args); 

        if ($rel_post_query->have_posts()) : 
          $relatedPostNum = 1; ?>

          <ul id="related-posts" class="row">
            <?php while ($rel_post_query->have_posts()) : $rel_post_query->the_post(); ?>

              <li class="post post-<?php echo $relatedPostNum; ?>">
                <a href="<?php the_permalink(); ?>">
                  <h2 class="post-title">
                    <?php the_title(); ?>
                  </h2>
                </a>
              </li>

            <?php $relatedPostNum++; 
              endwhile;
              $rel_post_query = null; 
              $rel_post_query = $temp;  // Reset

              wp_reset_query(); 
            ?>
          </ul>

        <?php endif; ?>
      <?php endif; ?>
  </div>
</div>