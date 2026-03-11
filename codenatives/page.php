<?php
/**
 * The template for displaying all pages.
 *
 * Supports Elementor canvas and full-width layouts.
 * When Elementor is active, it controls the page content.
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main" role="main">

	<?php
	while ( have_posts() ) :
		the_post();
	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'codenatives-page-article' ); ?>>

			<?php if ( ! codenatives_is_elementor_page() ) : ?>
				<header class="codenatives-page-header page-header">
					<div class="codenatives-container">
						<?php the_title( '<h1 class="codenatives-page-title">', '</h1>' ); ?>
					</div>
				</header>
			<?php endif; ?>

			<div class="codenatives-page-content<?php echo codenatives_is_elementor_page() ? ' codenatives-elementor-content' : ''; ?>">
				<?php if ( ! codenatives_is_elementor_page() ) : ?>
					<div class="codenatives-container">
				<?php endif; ?>

					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="codenatives-page-links">' . esc_html__( 'Pages:', 'codenatives' ),
							'after'  => '</div>',
						)
					);
					?>

				<?php if ( ! codenatives_is_elementor_page() ) : ?>
					</div>
				<?php endif; ?>
			</div>

		</article>

		<?php
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>

</main>

<?php
get_footer();
