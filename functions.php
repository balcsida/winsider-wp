<?php
/**
 * WINSIDER functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WINSIDER
 */

if ( ! function_exists( 'winsider_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function winsider_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on WINSIDER, use a find and replace
	 * to change 'winsider' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'winsider', get_template_directory() . '/languages' );

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
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'winsider' ),
		'secondary' => esc_html__( 'Secondary', 'winsider' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'winsider_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'winsider_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function winsider_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'winsider_content_width', 640 );
}
add_action( 'after_setup_theme', 'winsider_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function winsider_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'winsider' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'winsider' ),
		'before_widget' => '<section id="%1$s" class="mxn2 px2 %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="uppercase grayer">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'winsider_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function winsider_scripts() {
	wp_enqueue_style( 'winsider-style', get_stylesheet_uri() );

	wp_enqueue_script( 'winsider-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'winsider-fontawesome', 'https://use.fontawesome.com/8137cdccfc.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'winsider_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
