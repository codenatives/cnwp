<?php
/**
 * Template part for displaying results in search pages.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'codenatives-blog-card blog-card' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="blog-card-img">
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail( 'medium_large', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="blog-card-body">

		<span class="blog-card-tag">
			<?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?>
		</span>

		<?php the_title( '<h2 class="blog-card-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

		<div class="blog-card-excerpt">
			<?php the_excerpt(); ?>
		</div>

		<div class="codenatives-card-footer">
			<a href="<?php the_permalink(); ?>" class="blog-card-readmore">
				<?php esc_html_e( 'Read more', 'codenatives' ); ?>
				<span>&rarr;</span>
			</a>
			<span class="blog-card-date"><?php echo esc_html( get_the_date() ); ?></span>
		</div>

	</div>

</article>
