<?php
/**
 * The footer for the theme.
 *
 * Contains the closing of the content div and all content after.
 * Includes Elementor theme location support for the footer.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	</div><!-- #content .codenatives-site-content -->

<?php
/**
 * Elementor Footer Location.
 *
 * If Elementor Pro has a footer template assigned, it renders here.
 * Otherwise, the default theme footer from the HTML site is output.
 */
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
?>

	<!-- Default Theme Footer -->
	<footer class="codenatives-footer footer-main" role="contentinfo">
		<div class="codenatives-footer-inner">

			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>

				<div class="codenatives-footer-columns">
					<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<div class="codenatives-footer-col">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<div class="codenatives-footer-col">
							<?php dynamic_sidebar( 'footer-2' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<div class="codenatives-footer-col">
							<?php dynamic_sidebar( 'footer-3' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<div class="codenatives-footer-col">
							<?php dynamic_sidebar( 'footer-4' ); ?>
						</div>
					<?php endif; ?>
				</div>

			<?php else : ?>

				<!-- Fallback footer matching the HTML site -->
				<div class="codenatives-footer-columns">
					<div class="codenatives-footer-col">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/content/cn_logo_white-1.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="codenatives-footer-logo">
						<p class="codenatives-footer-desc">
							<?php esc_html_e( 'Enterprise Digital Transformation & Intelligent Systems. Cupertino, CA.', 'codenatives' ); ?>
						</p>
						<div class="footer-social">
							<a href="#" aria-label="<?php esc_attr_e( 'LinkedIn', 'codenatives' ); ?>">in</a>
							<a href="#" aria-label="<?php esc_attr_e( 'Twitter / X', 'codenatives' ); ?>">X</a>
							<a href="#" aria-label="<?php esc_attr_e( 'GitHub', 'codenatives' ); ?>">GH</a>
							<a href="#" aria-label="<?php esc_attr_e( 'YouTube', 'codenatives' ); ?>">&#9654;</a>
						</div>
					</div>

					<div class="codenatives-footer-col">
						<h4 class="footer-heading"><?php esc_html_e( 'Solutions', 'codenatives' ); ?></h4>
						<?php
						if ( has_nav_menu( 'footer' ) ) :
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'container'      => false,
									'items_wrap'     => '%3$s',
									'depth'          => 1,
									'fallback_cb'    => false,
								)
							);
						endif;
						?>
					</div>

					<div class="codenatives-footer-col">
						<h4 class="footer-heading"><?php esc_html_e( 'Company', 'codenatives' ); ?></h4>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-link"><?php esc_html_e( 'Home', 'codenatives' ); ?></a>
					</div>

					<div class="codenatives-footer-col">
						<h4 class="footer-heading"><?php esc_html_e( 'Contact', 'codenatives' ); ?></h4>
						<p class="footer-link"><?php esc_html_e( 'info@codenatives.com', 'codenatives' ); ?></p>
						<p class="footer-link"><?php esc_html_e( 'Cupertino, California', 'codenatives' ); ?></p>
					</div>
				</div>

			<?php endif; ?>

			<div class="codenatives-footer-bottom footer-bottom">
				<span>
					<?php
					printf(
						/* translators: %s: current year */
						esc_html__( '&copy; %s Codenatives. All rights reserved.', 'codenatives' ),
						esc_html( gmdate( 'Y' ) )
					);
					?>
				</span>
				<div class="codenatives-footer-bottom-links">
					<button class="codenatives-theme-toggle theme-toggle" aria-label="<?php esc_attr_e( 'Toggle theme', 'codenatives' ); ?>">&#9790;</button>
					<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacy Policy', 'codenatives' ); ?></a>
				</div>
			</div>

		</div>
	</footer>

<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
