<?php
/**
 * Primary Menu
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'zero' ); ?></button>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container_class' => 'primary-menu-wrapper',
				'menu_id' => 'primary-menu',
				'menu_class' => 'primary-menu',
				'depth' => 1,
			) );
		?>
	</nav><!-- #site-navigation -->
<?php endif;
