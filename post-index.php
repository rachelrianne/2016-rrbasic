<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <h2 class="post-date"><?php the_time('M n ‘y'); ?></h2>
  </header>
  
  <div class="post-content">
    <?php wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore'); ?>
  </div>
  
  <footer>
    <?php if ( get_the_category() ) { ?>
      <p class="cats"><?php echo get_the_category_list( ', ' ); ?></p>
    <?php } ?>
    <?php if ( get_tags() ) { ?>
      <p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>
    <?php } ?>
    
    <p class="comments"><?php comments_popup_link( 'Leave a comment', '1 Comment', '% Comments' ); ?></p>
  </footer>
</article>