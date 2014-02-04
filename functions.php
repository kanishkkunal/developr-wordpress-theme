<?php
/**
 * Developr functions and definitions
 *
 * @package Developr
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'developr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function developr_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Developr, use a find and replace
	 * to change 'developr' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'developr', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'developr' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'developr_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // developr_setup
add_action( 'after_setup_theme', 'developr_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function developr_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer-1', 'developr' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

    register_sidebar( array(
		'name'          => __( 'Footer-2', 'developr' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

    register_sidebar( array(
		'name'          => __( 'Footer-3', 'developr' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'developr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function developr_scripts() {
    wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700');
    wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootswatch/3.1.0/yeti/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
	wp_enqueue_style( 'developr-style', get_stylesheet_uri() );

	//wp_enqueue_script( 'bootstrap-affix', get_template_directory_uri() . '/js/jquery.affix.js', array('jquery'), '20140120', true );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ),'', true ); 
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'developr_scripts' );

if ( ! function_exists( 'developr_excerpt_more' ) ) :
/**
 * Changes the default excerpt trailing content
 *
 * Replaces the default [...] trailing text from excerpts
 * to a more pleasant ...
 *
 * @since fastr 1.0
 */
function developr_excerpt_more($more) {
	return ' &#8230;';
}
endif;

add_filter( 'excerpt_more', 'developr_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

