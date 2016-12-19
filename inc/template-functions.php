<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package Zero
 * @since 0.2.0
 */

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
	if ( is_active_sidebar( 'footer-1' ) ) {
		$footer_widget_count++;
	}
	if ( is_active_sidebar( 'footer-2' ) ) {
		$footer_widget_count++;
	}
	if ( is_active_sidebar( 'footer-3' ) ) {
		$footer_widget_count++;
	}

	$classes[] = 'footer-widgets-' . $footer_widget_count;

	return $classes;
}
add_filter( 'body_class', 'zero_body_classes' );

/**
 * Change the default excerpt_more [...]
 *
 * @since  0.1.0
 * @return string $more
 */
function zero_excerpt_more() {
	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s <span class="meta-nav">&rarr;</span></a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading %s', 'zero' ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) )
	);

	$more = '&hellip;' . $link;

	return $more;
}
add_filter( 'excerpt_more', 'zero_excerpt_more' );

/**
 * Filters the 'stylesheet_uri' to allow theme developers to offer a minimized version of their main
 * 'style.css' file. It will detect if a 'style.min.css' file is available and use it if SCRIPT_DEBUG
 * is disabled.
 *
 * @since     0.1.0
 * @author    Justin Tadlock <justin@justintadlock.com>
 * @copyright Copyright (c) 2008 - 2015, Justin Tadlock
 * @link      http://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @param     string $stylesheet_uri      The URI of the active theme's stylesheet.
 * @param     string $stylesheet_dir_uri  The directory URI of the active theme's stylesheet.
 * @return    string $stylesheet_uri
 */
function zero_min_stylesheet_uri( $stylesheet_uri, $stylesheet_dir_uri ) {
	// Get the minified suffix.
	$suffix = zero_get_min_suffix();

	// Use the .min stylesheet if available.
	if ( $suffix ) :
		// Remove the stylesheet directory URI from the file name.
		$stylesheet = str_replace( trailingslashit( $stylesheet_dir_uri ), '', $stylesheet_uri );

		// Change the stylesheet name to 'style.min.css'.
		$stylesheet = str_replace( '.css', "{$suffix}.css", $stylesheet );

		// If the stylesheet exists in the stylesheet directory, set the stylesheet URI to the dev stylesheet.
		if ( file_exists( trailingslashit( get_stylesheet_directory() ) . $stylesheet ) ) {
			$stylesheet_uri = esc_url( trailingslashit( $stylesheet_dir_uri ) . $stylesheet );
		}
	endif;

	// Return the theme stylesheet.
	return $stylesheet_uri;
}
add_filter( 'stylesheet_uri', 'zero_min_stylesheet_uri', 5, 2 );

/**
 * Helper function for getting the script/style `.min` suffix for minified files.
 *
 * @since  0.1.0
 * @return string
 */
function zero_get_min_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG ? '' : '.min';
}
