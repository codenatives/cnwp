<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'codenatives-page-article' ); ?>>

	<header class="codenatives-entry-header">
		<?php the_title( '<h1 class="codenatives-entry-title">', '</h1>' ); ?>
	</header>

	<div class="codenatives-entry-content prose">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="codenatives-page-links">' . esc_html__( 'Pages:', 'codenatives' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="codenatives-entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'codenatives' ),
						array( 'span' => array( 'class' => array() ) )
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="codenatives-edit-link">',
				'</span>'
			);
			?>
		</footer>
	<?php endif; ?>

</article>
