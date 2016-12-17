<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package zero
 */

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function zero_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'zero_pingback_header' );

/**
 * Filters the 'stylesheet_uri' to allow theme developers to offer a minimized version of their main
 * 'style.css' file. It will detect if a 'style.min.css' file is available and use it if SCRIPT_DEBUG
 * is disabled.
 *
 * @since     1.1.0
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2015, Justin Tadlock
 * @link      http://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @param     string  $stylesheet_uri      The URI of the active theme's stylesheet.
 * @param     string  $stylesheet_dir_uri  The directory URI of the active theme's stylesheet.
 * @return    string  $stylesheet_uri
 */
function zero_min_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {

	// Get the minified suffix.
	$suffix = zero_get_min_suffix();

	// Use the .min stylesheet if available.
	if ( $suffix ) {

		// Remove the stylesheet directory URI from the file name.
		$stylesheet = str_replace( trailingslashit( $stylesheet_dir_uri ), '', $stylesheet_uri );

		// Change the stylesheet name to 'style.min.css'.
		$stylesheet = str_replace( '.css', "{$suffix}.css", $stylesheet );

		// If the stylesheet exists in the stylesheet directory, set the stylesheet URI to the dev stylesheet.
		if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $stylesheet ) ) {
			$stylesheet_uri = esc_url( trailingslashit( $stylesheet_dir_uri ) . $stylesheet );
		}

	}

	// Return the theme stylesheet.
	return $stylesheet_uri;

}
add_filter( 'stylesheet_uri', 'zero_min_stylesheet_uri', 5, 2 );

/**
 * Helper function for getting the script/style `.min` suffix for minified files.
 *
 * @since  1.1.0
 * @return string
 */
function zero_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Change the default excerpt_more [...]
 *
 * @since  0.1.0
 * @return string $more
 */
function zero_excerpt_more() {
	/* Translators: The %s is the post title shown to screen readers. */
	$text = sprintf(
		wp_kses(
			__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'zero' ),
			array( 'span' => array( 'class' => array() ) )
		), the_title( '<span class="screen-reader-text">', '</span>', false )
	);
	$more = sprintf(
		'&hellip; <a href="%s" class="more-link">%s</a>',
		esc_url( get_permalink() ), $text
	);
	return $more;
}
add_filter( 'excerpt_more', 'zero_excerpt_more' );

/**
 * Add SVG definitions to the footer.
 *
 * @since 1.1.0
 */
function zero_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}

}
add_action( 'wp_footer', 'zero_include_svg_icons', 9999 );

/**
 * Display SVG icons in social navigation.
 *
 * @since 1.0.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function zero_nav_social_icons( $item_output, $item, $depth, $args ) {

	// Supported social icons.
	$social_icons = apply_filters( 'zero_nav_social_icons', array(
		'codepen.io'      => 'codepen',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'googleplus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin-alt',
		'mailto:'         => 'mail',
		'pinterest.com'   => 'pinterest-alt',
		'getpocket.com'   => 'pocket',
		'polldaddy.com'   => 'polldaddy',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'soundcloud.com'  => 'cloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'youtube.com'     => 'youtube',
	) );

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' == $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . zero_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'zero_nav_social_icons', 10, 4 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function zero_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add the '.custom-header-image' class if the user is using a custom header image.
	if ( get_header_image() ) {
		$classes[] = 'custom-header-image';
	}

	// Add the '.no-header-text' class if there is no Site Title and Tagline.
	if ( ! display_header_text() ) {
		$classes[] = 'no-header-text';
	}

	// Footer widget area count.
	$footer_widget_count = 0;
	if( is_active_sidebar( 'footer-1' ) ) {
		$footer_widget_count++;
	}
	if( is_active_sidebar( 'footer-2' ) ) {
		$footer_widget_count++;
	}
	if( is_active_sidebar( 'footer-3' ) ) {
		$footer_widget_count++;
	}

	$classes[] = 'footer-widgets-' . $footer_widget_count;

	return $classes;
}
add_filter( 'body_class', 'zero_body_classes' );
