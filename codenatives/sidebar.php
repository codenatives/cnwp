<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Codenatives
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="codenatives-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Sidebar', 'codenatives' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
