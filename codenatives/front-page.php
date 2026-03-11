<?php
/**
 * The front page template.
 *
 * When Elementor is active and has content for this page, Elementor
 * controls the output. Otherwise, the static HTML homepage from the
 * original site is rendered as a fallback.
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main codenatives-front-page" role="main">

	<?php
	if ( codenatives_is_elementor_page() ) :
		// Elementor controls this page — render its content.
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;

	elseif ( have_posts() ) :
		// Check if the static page has WordPress editor content.
		while ( have_posts() ) :
			the_post();
			$page_content = get_the_content();

			if ( ! empty( trim( wp_strip_all_tags( $page_content ) ) ) ) :
				// Page has real content from Gutenberg/classic editor.
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="codenatives-page-links">' . esc_html__( 'Pages:', 'codenatives' ),
						'after'  => '</div>',
					)
				);
			else :
				// No content — show static HTML fallback.
				get_template_part( 'template-parts/front-page', 'fallback' );
			endif;
		endwhile;

	else :
		// No page assigned / latest posts mode with no posts — show fallback.
		get_template_part( 'template-parts/front-page', 'fallback' );
	endif;
	?>

</main>

<?php
get_footer();
