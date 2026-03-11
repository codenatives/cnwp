<?php
/**
 * Elementor page builder support.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Elementor theme locations.
 */
function codenatives_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_location( 'header' );
	$elementor_theme_manager->register_location( 'footer' );
	$elementor_theme_manager->register_location( 'single' );
	$elementor_theme_manager->register_location( 'archive' );
}
add_action( 'elementor/theme/register_locations', 'codenatives_register_elementor_locations' );

/**
 * Add Elementor support to theme.
 */
function codenatives_elementor_theme_support() {
	add_theme_support( 'elementor' );
	add_theme_support( 'header-footer-elementor' );
}
add_action( 'after_setup_theme', 'codenatives_elementor_theme_support' );

/**
 * Disable Gutenberg editor on pages edited with Elementor.
 *
 * @param bool   $use_block_editor Whether the post can be edited with the block editor.
 * @param string $post_type        The post type being checked.
 * @return bool Modified value.
 */
function codenatives_disable_gutenberg_for_elementor( $use_block_editor, $post_type ) {
	if ( ! function_exists( 'elementor_load_plugin_textdomain' ) ) {
		return $use_block_editor;
	}

	$post_id = 0;

	if ( isset( $_GET['post'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$post_id = absint( $_GET['post'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	} elseif ( isset( $_POST['post_ID'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
		$post_id = absint( $_POST['post_ID'] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	}

	if ( $post_id && get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
		return false;
	}

	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'codenatives_disable_gutenberg_for_elementor', 10, 2 );

/**
 * Add Elementor canvas and full-width body classes.
 *
 * @param array $classes Existing body classes.
 * @return array Modified body classes.
 */
function codenatives_elementor_body_classes( $classes ) {
	if ( function_exists( 'elementor_load_plugin_textdomain' ) ) {
		$classes[] = 'codenatives-elementor-active';
	}
	return $classes;
}
add_filter( 'body_class', 'codenatives_elementor_body_classes' );
