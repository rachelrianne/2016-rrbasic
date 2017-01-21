<?php

/*** 
  Enqueue Google jQuery 
***/

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0//jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}


/*** 
  Register Sidebars 
***/

if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
    'name'      => __( 'Sidebar name' ),
    'id'      => 'unique-sidebar-id',
    'description' => '',
    'class'     => '',
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widget_title">',
    'after_title' => '</h2>'
  ));
}

/*** 
  Register Custom Menus 
***/

add_theme_support( 'menus' );
register_nav_menus( array(
  'sample_nav' => 'Sample Nav Menu',
  'footer_nav' => 'Sample Footer Menu'
) );

/*** 
  Add Custom Excerpt Lengths 
***/

function wpe_excerptlength_index($length) {
    return 160;
}
function wpe_excerptmore($more) {
    return '... <a href="'. get_permalink().'">Read More ></a>';
}

function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

/*** 
  Add Post Thumbnails 
***/

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50, true );
add_image_size( 'category-thumb', 300, 9999, true );


/*** 
  Register Custom Post Types & Taxonomies 
***/

// add actions below – commented out initially
// add_action( 'init', 'create_book_post_type' );
// add_action( 'init', 'create_book_taxonomies', 0 );

function create_book_post_type() {
  $labels = array(
    'name' => 'Books',
    'singular_name' => 'Book',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Book',
    'edit_item' => 'Edit Book',
    'new_item' => 'New Book',
    'all_items' => 'All Books',
    'view_item' => 'View Book',
    'search_items' => 'Search Books',
    'not_found' =>  'No books found',
    'not_found_in_trash' => 'No books found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Books'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'book' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'book', $args );
}

function create_book_taxonomies() {
  $labels = array(
    'name'                => _x( 'Genres', 'taxonomy general name' ),
    'singular_name'       => _x( 'Genre', 'taxonomy singular name' ),
    'search_items'        => __( 'Search Genres' ),
    'all_items'           => __( 'All Genres' ),
    'parent_item'         => __( 'Parent Genre' ),
    'parent_item_colon'   => __( 'Parent Genre:' ),
    'edit_item'           => __( 'Edit Genre' ), 
    'update_item'         => __( 'Update Genre' ),
    'add_new_item'        => __( 'Add New Genre' ),
    'new_item_name'       => __( 'New Genre Name' ),
    'menu_name'           => __( 'Genre' )
  );  

  $args = array(
    'hierarchical'        => true,
    'labels'              => $labels,
    'show_ui'             => true,
    'show_admin_column'   => true,
    'query_var'           => true,
    'rewrite'             => array( 'slug' => 'genre' )
  );

  register_taxonomy( 'genre', array( 'book' ), $args );

  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name'                         => _x( 'Writers', 'taxonomy general name' ),
    'singular_name'                => _x( 'Writer', 'taxonomy singular name' ),
    'search_items'                 => __( 'Search Writers' ),
    'popular_items'                => __( 'Popular Writers' ),
    'all_items'                    => __( 'All Writers' ),
    'parent_item'                  => null,
    'parent_item_colon'            => null,
    'edit_item'                    => __( 'Edit Writer' ), 
    'update_item'                  => __( 'Update Writer' ),
    'add_new_item'                 => __( 'Add New Writer' ),
    'new_item_name'                => __( 'New Writer Name' ),
    'separate_items_with_commas'   => __( 'Separate writers with commas' ),
    'add_or_remove_items'          => __( 'Add or remove writers' ),
    'choose_from_most_used'        => __( 'Choose from the most used writers' ),
    'not_found'                    => __( 'No writers found.' ),
    'menu_name'                    => __( 'Writers' )
  ); 

  $args = array(
    'hierarchical'                 => false,
    'labels'                       => $labels,
    'show_ui'                      => true,
    'show_admin_column'            => true,
    'update_count_callback'        => '_update_post_term_count',
    'query_var'                    => true,
    'rewrite'                      => array( 'slug' => 'writer' )
  );

  register_taxonomy( 'writer', 'book', $args );
}


/*** 
  Custom HTML Widget 
***/

add_action( 'widgets_init', 'rr_custom_html_widget'); 

function rr_custom_html_widget() {
  register_widget( 'rr_custom_html' );
}

class rr_custom_html extends WP_Widget {

  public function __construct() {
    $widget_ops = array(
      'classname' => 'rr_custom_html_widget',
      'description' => __( 'Displays a customized text widget for your theme.' ),
      'customize_selective_refresh' => true,
    );
    $control_ops = array( 'width' => 400, 'height' => 350 );
    parent::__construct( 'rr_custom_html_text', __( 'Custom Text Widget' ), $widget_ops, $control_ops );
  }

  public function widget( $args, $instance ) {

    /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
    $rr_subscribe_title = apply_filters( 'widget_title', empty( $instance['rr_subscribe_title'] ) ? '' : $instance['rr_subscribe_title'], $instance, $this->id_base );

    $widget_rr_subscribe_text = ! empty( $instance['rr_subscribe_text'] ) ? $instance['rr_subscribe_text'] : '';

    $rr_subscribe_text = apply_filters( 'widget_rr_subscribe_text', $widget_rr_subscribe_text, $instance, $this );

    echo $args['before_widget'];
    if ( ! empty( $rr_subscribe_title ) ) {
      echo $args['before_title'] . $rr_subscribe_title . $args['after_title'];
    } ?>
      <div class="rr_subscribe_textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $rr_subscribe_text ) : $rr_subscribe_text; ?></div>
    <?php
    echo $args['after_widget'];
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['rr_subscribe_title'] = sanitize_text_field( $new_instance['rr_subscribe_title'] );
    if ( current_user_can( 'unfiltered_html' ) ) {
      $instance['rr_subscribe_text'] = $new_instance['rr_subscribe_text'];
    } else {
      $instance['rr_subscribe_text'] = wp_kses_post( $new_instance['rr_subscribe_text'] );
    }
    $instance['filter'] = ! empty( $new_instance['filter'] );
    return $instance;
  }

  public function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'rr_subscribe_title' => '', 'rr_subscribe_text' => '' ) );
    $filter = isset( $instance['filter'] ) ? $instance['filter'] : 0;
    $rr_subscribe_title = sanitize_text_field( $instance['rr_subscribe_title'] );
    ?>
    <p><label for="<?php echo $this->get_field_id('rr_subscribe_title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('rr_subscribe_title'); ?>" name="<?php echo $this->get_field_name('rr_subscribe_title'); ?>" type="text" value="<?php echo esc_attr($rr_subscribe_title); ?>" /></p>

    <p><label for="<?php echo $this->get_field_id( 'rr_subscribe_text' ); ?>"><?php _e( 'Content:' ); ?></label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('rr_subscribe_text'); ?>" name="<?php echo $this->get_field_name('rr_subscribe_text'); ?>"><?php echo esc_textarea( $instance['rr_subscribe_text'] ); ?></textarea></p>

    <p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox"<?php checked( $filter ); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
    <?php
  }
}

?>