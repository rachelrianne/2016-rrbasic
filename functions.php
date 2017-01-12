<?php

// ******************* Google jQuery ****************** //

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.0//jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}


// ******************* Auto-create Meta Description ****************** //

function create_meta_desc() {
	global $post;
	if (!is_single()) { return; }
	$meta = strip_tags($post->post_content);
	$meta = strip_shortcodes($post->post_content);
	$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
	$meta = substr($meta, 0, 125);
	echo "<meta name='description' content='$meta' />";
}
add_action('wp_head', 'create_meta_desc');


// ******************* Sidebars ****************** //

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'			=> __( 'Sidebar name' ),
		'id'			=> 'unique-sidebar-id',
		'description'	=> '',
		'class'			=> '',
		'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</li>',
		'before_title'	=> '<h2 class="widget_title">',
		'after_title'	=> '</h2>'
	));
}

// ******************* Add Custom Menus ****************** //

add_theme_support( 'menus' );
register_nav_menu( 'single_nav', 'Single Navigation Menu' );
register_nav_menus( array(
	'sample_nav' => 'Sample Nav Menu',
	'footer_nav' => 'Sample Footer Menu'
) );

// ******************* Add Custom Excerpt Lengths ****************** //

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

// ******************* Add Post Thumbnails ****************** //

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50, true );
add_image_size( 'category-thumb', 300, 9999, true );

// ******************* Add Custom Post Types & Taxonomies ****************** //

function codex_custom_init() {
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
add_action( 'init', 'codex_custom_init' );

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_book_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function create_book_taxonomies() 
{
	// Add new taxonomy, make it hierarchical (like categories)
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

// ******************* Add Page Slug to Body Class ****************** //
function add_slug_body_class( $classes ) {
	global $post;
	
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

?>