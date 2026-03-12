<?php
/**
 * The template for displaying all single posts.
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

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'codenatives-single-article' ); ?>>

			<header class="codenatives-page-header page-header">
				<div class="codenatives-container">
					<?php the_title( '<h1 class="codenatives-page-title">', '</h1>' ); ?>
					<div class="codenatives-post-meta">
						<span class="codenatives-post-date">
							<?php echo esc_html( get_the_date() ); ?>
						</span>
						<span class="codenatives-post-author">
							<?php
							printf(
								/* translators: %s: author name */
								esc_html__( 'by %s', 'codenatives' ),
								esc_html( get_the_author() )
							);
							?>
						</span>
						<?php if ( has_category() ) : ?>
							<span class="codenatives-post-categories">
								<?php the_category( ', ' ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>
			</header>

			<div class="codenatives-single-content inner-content">
				<div class="codenatives-container codenatives-narrow-container">

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="codenatives-featured-image">
							<?php the_post_thumbnail( 'large', array( 'class' => 'blog-hero-img' ) ); ?>
						</div>
					<?php endif; ?>

					<div class="blog-post-body prose">
						<?php the_content(); ?>
					</div>

					<?php if ( has_tag() ) : ?>
						<div class="blog-post-tags">
							<?php the_tags( '', '', '' ); ?>
						</div>
					<?php endif; ?>

					<?php
					wp_link_pages(
						array(
							'before' => '<div class="codenatives-page-links">' . esc_html__( 'Pages:', 'codenatives' ),
							'after'  => '</div>',
						)
					);
					?>

				</div>
			</div>

			<nav class="codenatives-post-navigation codenatives-container">
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="blog-nav-label">' . esc_html__( 'Previous', 'codenatives' ) . '</span><span class="blog-nav-title">%title</span>',
						'next_text' => '<span class="blog-nav-label">' . esc_html__( 'Next', 'codenatives' ) . '</span><span class="blog-nav-title">%title</span>',
					)
				);
				?>
			</nav>

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
