<?php
/**
 * nathalieMota functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nathalieMota
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nathaliemota_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on nathalieMota, use a find and replace
		* to change 'nathaliemota' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'nathaliemota', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nathaliemota' ),
			'mobile-menu' => esc_html('Mobile', 'nathaliemota'),
			'footer-menu' => esc_html__('Footer', 'nathaliemota'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nathaliemota_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'nathaliemota_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nathaliemota_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nathaliemota_content_width', 640 );
}
add_action( 'after_setup_theme', 'nathaliemota_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nathaliemota_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nathaliemota' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'nathaliemota' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'nathaliemota_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nathaliemota_scripts() {
	wp_enqueue_style( 'nathaliemota-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'nathaliemota-styleScss', get_template_directory_uri() . '/CSS/style.css', array(), _S_VERSION );
	wp_style_add_data( 'nathaliemota-style', 'rtl', 'replace' );

	wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), _S_VERSION, true);
	wp_enqueue_script( 'nathaliemota-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'nathaliemota-burgerMenu', get_template_directory_uri() . '/js/burgerMenu.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'nathaliemota-contactModal', get_template_directory_uri() . '/js/modal.js', array(), _S_VERSION, true );
	if( is_single()) {wp_enqueue_script( 'nathaliemota-thumbnailsNavigatip,', get_template_directory_uri() . '/js/thumbnailsNav.js', array(), _S_VERSION, true );};
	wp_enqueue_script( 'nathaliemota-dropdownMenus,', get_template_directory_uri() . '/js/dropdownMenus.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'nathaliemota-lightbox,', get_template_directory_uri() . '/js/lightbox.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'nathaliemota-ajaxFordropdownMenus,', get_template_directory_uri() . '/js/ajaxOnlyScript.js', array('jquery'), _S_VERSION, true );
	    // Localize the script to prepare for AJAX
		// wp_localize_script('nathaliemota-ajaxFordropdownMenus', 'ajax_object', array(
		// 	// Pass the AJAX URL to the script
		// 	'ajax_url' => admin_url('admin-ajax.php')  
		// ));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nathaliemota_scripts' );

// Enqueue the ajax based scripts
// function ajaxBased_scripts() {
// 	wp_enqueue_script( 'nathaliemota-ajaxFordropdownMenus,', get_template_directory_uri() . '/js/ajaxOnlyScript.js', array(), null, true );
// 	// Localize the script to prepare for AJAX
// 	wp_localize_script('nathaliemota-ajaxFordropdownMenus', 'ajax_object', array(
// 		// Pass the AJAX URL to the script
// 		'ajax_url' => admin_url('admin-ajax.php')  
// 	));
// }
// add_action( 'wp_enqueue_scripts', 'ajaxBased_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Remove the p tag from cf7
add_filter('wpcf7_autop_or_not', '__return_false');

// Links for CPT 
// function replace_slug ($post_link, $post) {
// 	if(false !== strpos($post_link, '%photo%')){
// 		$photo = get_the_terms($post->ID, 'photo');
// 		if(!empty($photo)) {
// 			$post_link = str_replace('%photo%', array_pop($photo)->slug, $post_link);
// 		}
// 	}
// 	return $post_link;
// }
// add_filter('post_type_link', 'replace_slug', 10, 2);



// THE USABLE FUNCTIONS

// Setting up a function for random images
// Function to get a random image ID from the media library
function get_random_image_id() {
    // Get all attachments from the media library
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'post_status' => 'inherit',
        'posts_per_page' => -1, // Get all images
    );

    $query = new WP_Query($args);

    // Check if any images found
    if ($query->have_posts()) {
        // Get all image IDs
        $imageIds = array();
        while ($query->have_posts()) {
            $query->the_post();
            $imageIds[] = get_the_ID();
        }

        // Reset post data
        wp_reset_postdata();

        // Return a random image ID
        return $imageIds[array_rand($imageIds)];
    }

    // No images found
    return false;
}

// Function to get the URL and alt text of a random image
function get_random_image_url_and_alt() {
    // Get the random image ID
    $imageId = get_random_image_id(); 
    
    if (!$imageId) {
        // If no image ID is found, return false
        return false; 
    }

    // Get the image URL and alt text
    $imageUrl = wp_get_attachment_url($imageId);
    $imageAlt = get_post_meta($imageId, '_wp_attachment_image_alt', true);

    return array(
        'url' => $imageUrl,
        'alt' => $imageAlt,
    );
}

// Get the thumbnail of the next post
function get_next_post_thumbnail_id() {
    // Get the next post object
    $nextPost = get_adjacent_post(false, '', false);
    
    // Check if there is a next post
    if ($nextPost) {
        // Get the thumbnail ID of the next post
        $thumbnail_id = get_post_thumbnail_id($nextPost->ID);
        
        // Return the thumbnail ID
        return $thumbnail_id;
    }
    
    // Return false if there is no next post
    return false;
}
// Get the thumbnail of the previous post
function get_previous_post_thumbnail_id() {
    // Get the previous post object
    $previousPost = get_adjacent_post(false, '', true);
    
    // Check if there is a next post
    if ($previousPost) {
        // Get the thumbnail ID of the previous post
        $thumbnail_id = get_post_thumbnail_id($previousPost->ID);
        
        // Return the thumbnail ID
        return $thumbnail_id;
    }
    
    // Return false if there is no previous post
    return false;
}

// Get the images of the photo posts + their informations. This function allows to display all posts regarding to the following criterias. 
// It is needed at the initial page load.
function get_custom_posts_with_images() {
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
		'paged' => 1,
		'order' => 'DESC',
		'tax_query' => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'categorie',
				'field' => 'term_id',
				'terms' => '',
				'operator' => 'EXISTS'
			),
			array(
				'taxonomy' => 'format',
				'field' => 'term_id',
				'terms' => '',
				'operator' => 'EXISTS'
			)
		)
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $posts = array();
        while ($query->have_posts()) {
            $query->the_post();
            $posts[] = array(
				'ID' => get_the_ID(),
                'title' => get_the_title(),
                'image' => get_the_post_thumbnail_url(),
                'alt_text' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true),
				// To the difference of single-photo, we use the parameter 'get_the_ID' inside the more global function instead of in 
				// another variable, that we would have to call later.
				'categorie' => wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')), // Get the taxonomy term names
                'format' => wp_get_post_terms(get_the_ID(), 'format', array('fields' => 'names')), // Get the taxonomy term names
                'year' => get_the_date('Y')
            );
        }
        wp_reset_postdata();
        return $posts;
    } else {
        return array();
    }
}

// This function however is made to be dynamic, to fetch only the photos that are coming from desired filters without reloading the page. 
// So both will be needed.
function filter_custom_posts_ajax() {
    // Gather the filters from the AJAX request
    $categorie = isset($_POST['categorie']) ? sanitize_text_field($_POST['categorie']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $year = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';

	$args = array(
        'post_type' => 'post',
        'posts_per_page' => -1, // Adjust as needed
        'meta_query' => array(
            'relation' => 'AND',
        ),
    );

    if ($category) {
        $args['tax_query'][] = array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $categorie,
        );
    }

    if ($format) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    if ($year) {
        $args['date_query'] = array(
            array(
                'year' => $year,
            ),
        );
    }

    $query = new WP_Query($args);

	$posts = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
			get_template_part('template-part'/'BlockPhoto');
        }
    }

    // Reset the post data
    wp_reset_postdata();

    // Return the response
    wp_send_json_success($posts);
}
// action for logged in users
add_action('wp_ajax_filter_custom_posts_ajax', 'filter_custom_posts_ajax');
// action for non logged users
add_action('wp_ajax_nopriv_filter_custom_posts_ajax', 'filter_custom_posts_ajax');

// Here is for the loadMore button
function load_more_photos() {
	$ajaxposts = new WP_Query([
		'post_type' => 'publications',
		'posts_per_page' => 8,
		'orderby' => 'date',
		'order' => 'DESC',
		'paged' => $_POST['paged'],
	  ]);
	
	  $response = '';
	  $max_pages = $ajaxposts->max_num_pages;
	
	  if($ajaxposts->have_posts()) {
		ob_start();
		while($ajaxposts->have_posts()) : $ajaxposts->the_post();
		  $response .= get_template_part('template-part/BlockPhoto', 'postItem');
		endwhile;
		$output = ob_get_contents();
		ob_end_clean();
	  } else {
		$response = '';
	  }

	  $result = [
		'max' => $max_pages,
		'html' => $output,
	  ];
	
	  echo json_encode($result);
	  exit;
}
// And without forgetting the add_action
add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');


// Create reusable function for photo blocks !NOT USED YET
function render_photo_post($post) {
    // Fetch the reference field from ACF
    $reference = get_field('reference', $post->ID);
    
    // Get categories
    $categories = get_the_terms($post->ID, 'categorie');
    $category_names = [];
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            $category_names[] = $category->name;
        }
    }
    
    // Get formats
    $formats = get_the_terms($post->ID, 'format');
    $format_names = [];
    if ($formats && !is_wp_error($formats)) {
        foreach ($formats as $format) {
            $format_names[] = $format->name;
        }
    }
}

// Get the category taxonomies 
// function get_category_taxonomies() {
// 	// Get all taxonomies associated with the 'category' custom post type
//     $taxonomies = array(
// 				// Replace with your custom post type
// 				'post_type' => 'photo', 
// 				// Display all the posts
// 				'posts_per_page' => -1,
// 				'tax_query' => array(
// 					array(
// 						'taxonomy' => 'categorie',
// 						'field' => 'slug',
// 						)
// 					)
// 				);
		
// 	$query = new WP_Query($args);
// 	// Initialize an empty array to store taxonomy details
//     $output = array();

// 	if ($query->have_posts()) {
//         while ($query->have_posts()) {
//             $query->the_post();

//             // Get taxonomies associated with the current post
//             $post_taxonomies = get_post_taxonomies(get_the_ID());

//             foreach ($post_taxonomies as $taxonomy) {
//                 $taxonomy_object = get_taxonomy($taxonomy);
//                 $output[] = array(
//                     'name' => $taxonomy_object->labels->name,
//                     'slug' => $taxonomy_object->name,
//                 );
//             }
//         }
//         wp_reset_postdata();
//     }

//     // Remove duplicate taxonomies
//     $output = array_unique($output, SORT_REGULAR);

//     // Debugging: Print the output to verify it's correct
//     error_log(print_r($output, true));

//     return $output;
// }