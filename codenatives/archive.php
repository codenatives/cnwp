<?php
/**
 * The template for displaying archive pages.
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="codenatives-page-header page-header">
			<div class="codenatives-container">
				<?php the_archive_title( '<h1 class="codenatives-page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="codenatives-archive-description">', '</div>' ); ?>
			</div>
		</header>

		<div class="codenatives-container codenatives-posts-grid inner-content">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
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
