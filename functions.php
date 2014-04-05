<?php
/**
 * Mill Falls GiveCamp 2014 functions and definitions
 *
 * @package Mill Falls GiveCamp 2014
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'mfcs_2014_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mfcs_2014_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Mill Falls GiveCamp 2014, use a find and replace
	 * to change 'mfcs_2014' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'mfcs_2014', get_template_directory() . '/languages' );

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
		'header' => __( 'Header Menu', 'mfcs_2014' ),
		'primary' => __( 'Primary Menu', 'mfcs_2014' ),
		'footer' => __( 'Footer Menu', 'mfcs_2014' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats' );

	add_image_size( 'widget', 100, 100, true );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // mfcs_2014_setup
add_action( 'after_setup_theme', 'mfcs_2014_setup' );

/**
 * Add custom sizes to what is returned im attachment selection
 */
function mfcs_2014_add_size_js( $sizes ){
	$sizes['widget'] = 'Widget';
	return $sizes;
}
add_filter( 'image_size_names_choose', 'mfcs_2014_add_size_js' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function mfcs_2014_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'mfcs_2014' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Homepage', 'mfcs_2014' ),
		'id'            => 'homepage',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'mfcs_2014_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mfcs_2014_scripts() {
	wp_enqueue_style( 'mfcs_2014-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mfcs_2014-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'mfcs_2014-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mfcs_2014_scripts' );

/**
 * Add admin scripts to specific pages
 */
function mfcs_2014_admin_scripts( $screen ){
	if ( 'widgets.php' == $screen ) {
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
		wp_enqueue_script( 'mfcs_2014-navigation', get_template_directory_uri() . '/js/app.js', array('jquery') );
	}
}
add_action( 'admin_enqueue_scripts', 'mfcs_2014_admin_scripts', 5 );

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

/**
 * Add our custom widget(s)
 */
require get_template_directory() . '/inc/widgets.php';

