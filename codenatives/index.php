<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="codenatives-page-header page-header">
				<div class="codenatives-container">
					<h1 class="codenatives-page-title"><?php single_post_title(); ?></h1>
				</div>
			</header>
		<?php endif; ?>

		<div class="codenatives-container codenatives-posts-grid">
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
get_sidebar();
get_footer();
