<?php
/**
 * Developr functions and definitions
 *
 * Use a child theme instead of placing custom functions here
 * http://codex.wordpress.org/Child_Themes
 * @package Developr
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 720; /* pixels */
}


/* ------------------------------------------------------------------------- *
 *  OptionTree framework integration: Use in theme mode
/* ------------------------------------------------------------------------- */
	
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
load_template( get_template_directory() . '/option-tree/ot-loader.php' );

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

    // Load theme options
    load_template( get_template_directory() . '/inc/theme-options.php' );

    // Load custom widgets
    load_template( get_template_directory() . '/widgets/developr-social.php' );

    // Load custom shortcodes
	load_template( get_template_directory() . '/inc/shortcodes.php' );

    // Load dynamic styles
	load_template( get_template_directory() . '/inc/dynamic-styles.php' );

    // Load TGM plugin activation
    load_template( get_template_directory() . '/inc/class-tgm-plugin-activation.php' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );


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
		'name'          => __( 'Full-width Footer for ads etc.', 'developr' ),
		'id'            => 'above-footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

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
    //wp_enqueue_style( 'open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,700');
    wp_enqueue_style( 'bootstrap', '//netdna.bootstrapcdn.com/bootswatch/3.1.0/yeti/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' );
	wp_enqueue_style( 'developr-style', get_stylesheet_uri(), NULL, "0.8" );

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

/*  Excerpt length
/* ------------------------------------ */
if ( ! function_exists( 'developr_excerpt_length' ) ) {

	function developr_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}
	
}
add_filter( 'excerpt_length', 'developr_excerpt_length', 999 );

/* Gravatar Image */

/*  Social links
/* ------------------------------------ */
if ( ! function_exists( 'developr_admin_gravatar' ) ) {
    function developr_admin_gravatar() {
        // Get default from Discussion Settings.
	    $default = get_option( 'avatar_default', 'mystery' ); // Mystery man default
	    if ( 'mystery' == $default )
		    $default = 'mm';
	    elseif ( 'gravatar_default' == $default )
		    $default = '';

	    $protocol = ( is_ssl() ) ? 'https://secure.' : 'http://';
	    $url = sprintf( '%1$sgravatar.com/avatar/%2$s/', $protocol, md5( get_option( 'admin_email' ) ) );
	    $url = add_query_arg( array(
		    's' => 120,
		    'd' => urlencode( $default ),
	    ), $url );

	   return esc_url_raw( $url );
    }
}

/*  Social links
/* ------------------------------------ */
if ( ! function_exists( 'developr_social_links' ) ) {

	function developr_social_links($is_color_supported = FALSE) {
		if ( !ot_get_option('social-links') =='' ) {
			$links = ot_get_option('social-links', array());
			if ( !empty( $links ) ) {	
				foreach( $links as $item ) {
					
					// Build each separate html-section only if set
					if ( isset($item['title']) && !empty($item['title']) ) 
						{ $title = 'title="' .$item['title']. '"'; } else $title = '';
					if ( isset($item['social-link']) && !empty($item['social-link']) ) 
						{ $link = 'href="' .$item['social-link']. '"'; } else $link = '';
					if ( isset($item['social-target']) && !empty($item['social-target']) ) 
						{ $target = 'target="_blank"'; } else $target = '';
					if ( isset($item['social-icon']) && !empty($item['social-icon']) ) 
						{ $icon = 'class="fa ' .$item['social-icon']. '"'; } else $icon = '';
					if ( isset($item['social-color']) && !empty($item['social-color']) && $is_color_supported ) 
						{ $color = 'style="background: ' .$item['social-color']. ';"'; } else $color = '';
					
					// Put them together
					if ( isset($item['title']) && !empty($item['title']) && isset($item['social-icon']) && !empty($item['social-icon']) && ($item['social-icon'] !='fa-') ) {
						echo '<a rel="nofollow" class="social-links" '.$title.' '.$link.' '.$target.' '.$color.'><i '.$icon.' ></i></a>'."\n";
					}
				}
			}
		}
	}
}


/*  TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'developr_plugins' ) ) {

	function developr_plugins() {
		
		// Add the following plugins
		$plugins = array(
			array(
				'name' 				=> 'WP-PageNavi',
				'slug' 				=> 'wp-pagenavi',
				'required'			=> false,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'Responsive Lightbox',
				'slug' 				=> 'light',
				'source'			=> get_template_directory() . '/plugins/light.zip',
				'required'			=> false,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			)
		);	
		tgmpa( $plugins );
	}
}
add_action( 'tgmpa_register', 'developr_plugins' );



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

