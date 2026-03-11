<?php
/**
 * The front page template.
 *
 * When Elementor is active, this acts as a blank canvas where
 * Elementor controls all page content and layout.
 *
 * @package Codenatives
 */

get_header();
?>

<main id="primary" class="codenatives-site-main codenatives-front-page" role="main">

	<?php
	while ( have_posts() ) :
		the_post();

		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="codenatives-page-links">' . esc_html__( 'Pages:', 'codenatives' ),
				'after'  => '</div>',
			)
		);

	endwhile;
	?>

</main>

<?php
get_footer();
