<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zero
 */

if ( ! is_active_sidebar( 'front-page' ) ) {
	return;
}
?>

<div class="front-page-widgets-wrapper">

	<aside class="front-page-widget-area widget-area" id="front-page-widget-area" role="complementary">
		<?php dynamic_sidebar( 'front-page' ); ?>
	</aside><!-- .widget-area -->

</div><!-- .front-page-widgets-wrapper -->
