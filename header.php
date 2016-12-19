<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'zero' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="masthead-wrap">

			<?php get_template_part( 'components/menus/menu', 'primary' ); ?>

			<?php get_template_part( 'components/header/site', 'branding' ); ?>

		</div><!-- .masthead-wrap -->
	</header><!-- #masthead -->

	<div class="hero">
	</div><!-- .hero -->

	<div id="content" class="site-content">
		<div class="content-wrap">
