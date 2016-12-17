<?php
/**
 * Primary menu
 *
 * @package Zero
 */
?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
  <nav id="site-navigation" class="main-navigation" role="navigation">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'zero' ); ?></button>
    <?php
      wp_nav_menu( array(
        'menu' => 'primary-menu',
        'container_class' => 'primary-menu-wrapper',
        'menu_id' => 'primary-menu',
        'menu_class' => 'primary-menu',
        'depth' => 1,
        'theme_location' => 'primary'
      ) );
    ?>
  </nav><!-- #site-navigation -->
<?php endif;
