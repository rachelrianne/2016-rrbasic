<?php 

/* 
  CATEGORY PAGE NAVIGATION (WITH SUBCATEGORIES)
  - make sure to use `include( locate_template( 'snippets/category-navigation.php', false, false ) );` to retrieve variables
  - this only works for 3 category levels
*/

?>

<?php 
  $catTitle = single_cat_title("", false);
  $catID = get_cat_ID($catTitle);
  $children = get_term_children($catID, 'category');
  $thisCat = get_category($catID);
  $parentCatID = $thisCat->parent;
  $parentCat = get_category($parentCatID);

  if ($parentCatID) : // subcat page

    $topCatID = $parentCat->parent;

    if ($topCatID > 0) : // go higher to get topcat
      $topCat = get_category($topCatID);

      $featuredCatID = $topCatID;
      $featCatTitle = $topCat->name;
    else : // don't go any higher
      $featuredCatID = $parentCatID;
      $featCatTitle = $parentCat->name;
    endif; 

    $featTerm = get_term($featuredCatID, 'category');
    $featCatSlug = $featTerm->slug;

  else : // top level cat page
    $featuredCatID = $catID;

    $featCatTitle = single_cat_title("", false);

    $featTerm = get_term($catID, 'category');
    $featCatSlug = $featTerm->slug;

  endif;
?>

<?php // if category has children
  if ($parentCatID) : // subcat page ?>
    <section class="sidebar sidebar-subcat-nav">
      <div class="row-inner">
        <div class="row">
          <ul>
            <li>
              <a href="<?php echo get_category_link($parentCatID); ?>">All</a>
            </li>
            <?php wp_list_categories(array(
              'orderby'     => 'id',
              'depth'       => -1,
              'show_count'  => 0,
              'title_li'    => '',
              'use_desc_for_title'  => 1,
              'child_of'    => $parentCatID,
              'echo'        => 1,
              'hide_empty'  => false
             )); ?>
          </ul>
        </div>
      </div>
    </section>
  <?php else :
    if ($children) : ?>
    <section class="sidebar sidebar-subcat-nav">
      <div class="row-inner">
        <div class="row">
          <ul>
            <li class="current-cat">
              <a href="<?php echo get_category_link($catID); ?>">All</a>
            </li>
            <?php wp_list_categories(array(
              'orderby'     => 'id',
              'depth'       => -1,
              'show_count'  => 0,
              'title_li'    => '',
              'use_desc_for_title'  => 1,
              'child_of'    => $catID,
              'echo'        => 1,
              'hide_empty'  => false
             )); ?>
          </ul>
        </div>
      </div>
    </section>
  <?php endif;
endif; ?>