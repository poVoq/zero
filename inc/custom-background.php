<?php
/**
 * Custom background feature
 *
 * @package zero
 */

/**
 * Adds support for the WordPress 'custom-background' theme feature.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function zero_custom_background_setup() {

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'zero_custom_background_args', array(
		'default-color' => 'f0f0f0',
		'default-image' => '',
	) ) );

}
add_action( 'after_setup_theme', 'zero_custom_background_setup', 15 );
