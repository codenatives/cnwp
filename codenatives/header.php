<?php
/**
 * The header for the theme.
 *
 * Displays the <head> section and everything up to the main content area.
 * Includes Elementor theme location support for the header.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
/**
 * Elementor Header Location.
 *
 * If Elementor Pro has a header template assigned, it renders here.
 * Otherwise, the default theme header from the HTML site is output.
 */
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) :
?>

	<!-- Default Theme Header -->
	<nav class="codenatives-navbar navbar" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'codenatives' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-brand" rel="home">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/content/cn_logo_white-1.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="nav-logo nav-logo-dark">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/content/cn_logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="nav-logo nav-logo-light">
			<?php endif; ?>
		</a>

		<?php
		if ( has_nav_menu( 'primary' ) ) :
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_class'     => 'nav-links',
					'container'      => false,
					'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'          => 2,
					'fallback_cb'    => false,
				)
			);
		else :
		?>
			<ul class="nav-links">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-link"><?php esc_html_e( 'Home', 'codenatives' ); ?></a></li>
			</ul>
		<?php endif; ?>

		<div class="codenatives-nav-actions">
			<button class="codenatives-mobile-toggle mobile-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'codenatives' ); ?>">&#9776;</button>
		</div>
	</nav>

	<!-- Mobile Menu -->
	<div class="codenatives-mobile-menu mobile-menu" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'codenatives' ); ?>">
		<button class="codenatives-mobile-menu-close mobile-menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'codenatives' ); ?>">&times;</button>
		<?php
		if ( has_nav_menu( 'mobile' ) ) :
			wp_nav_menu(
				array(
					'theme_location' => 'mobile',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
		elseif ( has_nav_menu( 'primary' ) ) :
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'items_wrap'     => '%3$s',
					'depth'          => 1,
					'fallback_cb'    => false,
				)
			);
		else :
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'codenatives' ); ?></a>
		<?php endif; ?>
	</div>

<?php endif; ?>

	<div id="content" class="codenatives-site-content">
