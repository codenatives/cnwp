<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * Matches the design of the HTML 404.html page.
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main" role="main">

	<section class="codenatives-404-section">
		<div class="codenatives-container codenatives-404-content">

			<div class="codenatives-404-number">
				404
			</div>

			<h1 class="codenatives-404-title">
				<?php esc_html_e( 'This Page Is No Longer Available', 'codenatives' ); ?>
			</h1>

			<p class="codenatives-404-description">
				<?php esc_html_e( 'The page you are trying to reach has been moved, removed, or may never have existed. Use the links below to find what you need.', 'codenatives' ); ?>
			</p>

			<div class="codenatives-404-cards">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="codenatives-404-card">
					<div class="codenatives-404-card-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
					</div>
					<h3><?php esc_html_e( 'Home', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Return to our homepage and explore everything we offer.', 'codenatives' ); ?></p>
				</a>

				<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="codenatives-404-card">
					<div class="codenatives-404-card-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Blog', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Read our latest insights, articles, and case studies.', 'codenatives' ); ?></p>
				</a>

				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="codenatives-404-card">
					<div class="codenatives-404-card-icon">
						<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
					</div>
					<h3><?php esc_html_e( 'Contact', 'codenatives' ); ?></h3>
					<p><?php esc_html_e( 'Get in touch with our team for any questions.', 'codenatives' ); ?></p>
				</a>

			</div>

			<div class="codenatives-404-search">
				<?php get_search_form(); ?>
			</div>

		</div>
	</section>

</main>

<?php
get_footer();
