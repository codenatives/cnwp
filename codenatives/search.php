<?php
/**
 * The template for displaying search results pages.
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main" role="main">

	<header class="codenatives-page-header page-header">
		<div class="codenatives-container">
			<h1 class="codenatives-page-title">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for: %s', 'codenatives' ),
					'<span>' . get_search_query() . '</span>'
				);
				?>
			</h1>
		</div>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="codenatives-container codenatives-posts-grid inner-content">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			?>
		</div>

		<div class="codenatives-container codenatives-pagination">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => esc_html__( '&larr; Previous', 'codenatives' ),
					'next_text' => esc_html__( 'Next &rarr;', 'codenatives' ),
				)
			);
			?>
		</div>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

</main>

<?php
get_footer();
