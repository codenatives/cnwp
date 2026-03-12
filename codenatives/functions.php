<?php
/**
 * Codenatives theme functions and definitions.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Define theme constants.
 */
define( 'CODENATIVES_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function codenatives_setup() {
	/* Make theme available for translation. */
	load_theme_textdomain( 'codenatives', get_template_directory() . '/languages' );

	/* Add default posts and comments RSS feed links to head. */
	add_theme_support( 'automatic-feed-links' );

	/* Let WordPress manage the document title. */
	add_theme_support( 'title-tag' );

	/* Enable support for post thumbnails on posts and pages. */
	add_theme_support( 'post-thumbnails' );

	/* Custom logo support. */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 72,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/* Switch default core markup to output valid HTML5. */
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

	/* Add support for responsive embeds. */
	add_theme_support( 'responsive-embeds' );

	/* Add support for wide and full alignment (Gutenberg). */
	add_theme_support( 'align-wide' );

	/* Add support for editor styles. */
	add_theme_support( 'editor-styles' );

	/* Add custom background support. */
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'ffffff',
		)
	);

	/* Register navigation menus matching the HTML site structure. */
	register_nav_menus(
		array(
			'primary'    => esc_html__( 'Primary Menu', 'codenatives' ),
			'mobile'     => esc_html__( 'Mobile Menu', 'codenatives' ),
			'footer'     => esc_html__( 'Footer Menu', 'codenatives' ),
		)
	);

	/* Set content width. */
	if ( ! isset( $content_width ) ) {
		$content_width = 1280;
	}
}
add_action( 'after_setup_theme', 'codenatives_setup' );

/**
 * Register widget areas matching footer/sidebar columns from the HTML layout.
 */
function codenatives_widgets_init() {
	/* Sidebar widget area */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'codenatives' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in the sidebar.', 'codenatives' ),
			'before_widget' => '<div id="%1$s" class="codenatives-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="codenatives-widget-title">',
			'after_title'   => '</h3>',
		)
	);

	/* Footer Column 1 — About / Brand */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1 — Brand', 'codenatives' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Footer brand area with logo and description.', 'codenatives' ),
			'before_widget' => '<div id="%1$s" class="codenatives-footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="codenatives-footer-heading">',
			'after_title'   => '</h4>',
		)
	);

	/* Footer Column 2 — Solutions */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2 — Solutions', 'codenatives' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Footer solutions links area.', 'codenatives' ),
			'before_widget' => '<div id="%1$s" class="codenatives-footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="codenatives-footer-heading">',
			'after_title'   => '</h4>',
		)
	);

	/* Footer Column 3 — Company */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3 — Company', 'codenatives' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Footer company links area.', 'codenatives' ),
			'before_widget' => '<div id="%1$s" class="codenatives-footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="codenatives-footer-heading">',
			'after_title'   => '</h4>',
		)
	);

	/* Footer Column 4 — Contact */
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 4 — Contact', 'codenatives' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Footer contact information area.', 'codenatives' ),
			'before_widget' => '<div id="%1$s" class="codenatives-footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="codenatives-footer-heading">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'codenatives_widgets_init' );

/**
 * Include enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Include Elementor support.
 */
require get_template_directory() . '/inc/elementor-support.php';

/**
 * Include homepage setup tool (admin only).
 */
require get_template_directory() . '/inc/setup-homepage.php';

/**
 * Localize script strings for translation.
 */
function codenatives_localize_scripts() {
	wp_localize_script(
		'codenatives-main',
		'codenativesL10n',
		array(
			'page' => esc_html__( 'Page', 'codenatives' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'codenatives_localize_scripts', 20 );

/**
 * Add data-theme attribute to html tag for theme toggle support.
 *
 * @param string $output The opening html tag output.
 * @return string Modified output.
 */
function codenatives_html_tag_attributes( $output ) {
	return $output . ' data-theme="light"';
}
add_filter( 'language_attributes', 'codenatives_html_tag_attributes' );

/**
 * Custom excerpt length.
 *
 * @param int $length Default excerpt length.
 * @return int Modified excerpt length.
 */
function codenatives_excerpt_length( $length ) {
	return 25;
}
add_filter( 'excerpt_length', 'codenatives_excerpt_length' );

/**
 * Custom excerpt more string.
 *
 * @param string $more Default more string.
 * @return string Modified more string.
 */
function codenatives_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'codenatives_excerpt_more' );

/**
 * Add custom body classes.
 *
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function codenatives_body_classes( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'codenatives-hero-page';
		$classes[] = 'hero-page';
	}

	if ( ! is_singular() ) {
		$classes[] = 'codenatives-hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'codenatives_body_classes' );

/**
 * Ping-back header for singular pages with pings open.
 */
function codenatives_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'codenatives_pingback_header' );

/**
 * Check if the current page is being edited with Elementor.
 *
 * @return bool True if the page uses Elementor.
 */
function codenatives_is_elementor_page() {
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return false;
	}

	$document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );

	if ( ! $document ) {
		return false;
	}

	return $document->is_built_with_elementor();
}
