<?php
/**
 * Enqueue scripts and styles.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue theme styles.
 */
function codenatives_enqueue_styles() {
	/* Google Fonts — Inter */
	wp_enqueue_style(
		'codenatives-google-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	/* Main theme stylesheet (from HTML repo) */
	wp_enqueue_style(
		'codenatives-main',
		get_template_directory_uri() . '/assets/css/codenatives-theme.css',
		array( 'codenatives-google-fonts' ),
		wp_get_theme()->get( 'Version' )
	);

	/* WordPress default stylesheet */
	wp_enqueue_style(
		'codenatives-style',
		get_stylesheet_uri(),
		array( 'codenatives-main' ),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'codenatives_enqueue_styles' );

/**
 * Enqueue theme scripts.
 */
function codenatives_enqueue_scripts() {
	/* jQuery is bundled with WordPress — use the WP version */
	wp_enqueue_script( 'jquery' );

	/* Main theme script (from HTML repo), wrapped in noConflict */
	wp_enqueue_script(
		'codenatives-main',
		get_template_directory_uri() . '/assets/js/codenatives-main.js',
		array( 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);

	/* Comment reply script — only on singular pages with comments open */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'codenatives_enqueue_scripts' );

/**
 * Preconnect to Google Fonts for performance.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Modified URLs.
 */
function codenatives_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
			'crossorigin' => false,
		);
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'codenatives_resource_hints', 10, 2 );

/**
 * Add preload for critical fonts.
 */
function codenatives_preload_fonts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'codenatives_preload_fonts', 1 );
