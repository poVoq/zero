<?php
/**
 * Implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Zero
 * @since 0.1.0
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses zero_header_style()
 */
function zero_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'zero_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1920,
		'height'                 => 400,
		'flex-height'            => true,
		'wp-head-callback'       => 'zero_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'zero_custom_header_setup', 15 );

/**
 * Styles the header image and text displayed on the blog.
 *
 * @see zero_custom_header_setup().
 */
function zero_header_style() {

	// Start header styles.
	$style = '';

	// Header text color
	$header_text_color = esc_attr( get_header_textcolor() );

	// Header Image
	$header_image = esc_url( get_header_image() );

	// Header image height.
	$header_image_height = get_custom_header()->height;

	// Header image width.
	$header_image_width = get_custom_header()->width;

	// When to show header image.
	$min_width = absint( apply_filters( 'zero_header_bg_show', 1260 ) );

	if ( display_header_text() ) :
		$style .= ".site-title a, .site-description { color: #{$header_text_color}; }";
	else :
		$style .= '.site-title, .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }';
	endif;

	if ( ! empty( $header_image ) ) :
		$style .= "@media screen and (min-width: {$min_width}px) { body.custom-header-image .hero { background-image: url({$header_image}); } }";
	endif;

	/* Echo styles if it's not empty. */
	if ( ! empty( $style ) ) :
		echo "\n" . '<style type="text/css" id="custom-header-css">' . esc_html( trim( $style ) ) . '</style>' . "\n";
	endif;
}
