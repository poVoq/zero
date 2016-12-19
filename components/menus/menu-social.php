<?php
/**
 * Social Menu.
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<?php if ( has_nav_menu( 'social' ) ) : ?>

	<nav class="menu-social social-navigation menu" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'zero' ); ?>">

		<?php
			wp_nav_menu( array(
				'theme_location'  => 'social',
				'container_class' => 'social-menu-wrapper',
				'menu_class'      => 'social-menu',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>' . zero_get_svg( array( 'icon' => 'rating-full' ) ),
			) );
		?>

	</nav><!-- .menu-social -->

<?php endif;
