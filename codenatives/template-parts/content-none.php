<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="codenatives-no-results">
	<div class="codenatives-container">

		<header class="codenatives-page-header page-header">
			<h1 class="codenatives-page-title"><?php esc_html_e( 'Nothing Found', 'codenatives' ); ?></h1>
		</header>

		<div class="codenatives-page-content inner-content">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p>
					<?php
					printf(
						wp_kses(
							/* translators: 1: link to new post */
							__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'codenatives' ),
							array( 'a' => array( 'href' => array() ) )
						),
						esc_url( admin_url( 'post-new.php' ) )
					);
					?>
				</p>

			<?php elseif ( is_search() ) : ?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'codenatives' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'codenatives' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div>

	</div>
</section>
