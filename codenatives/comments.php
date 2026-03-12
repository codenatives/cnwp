<?php
/**
 * The template for displaying comments.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password,
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="codenatives-comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="codenatives-comments-title">
			<?php
			$codenatives_comment_count = get_comments_number();
			if ( '1' === $codenatives_comment_count ) {
				printf(
					/* translators: 1: title */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'codenatives' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count, 2: title */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $codenatives_comment_count, 'comments title', 'codenatives' ) ),
					number_format_i18n( $codenatives_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<?php the_comments_navigation(); ?>

		<ol class="codenatives-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation();

		if ( ! comments_open() ) :
		?>
			<p class="codenatives-no-comments"><?php esc_html_e( 'Comments are closed.', 'codenatives' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_container' => 'codenatives-comment-respond',
		)
	);
	?>

</div>
