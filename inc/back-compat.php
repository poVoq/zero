<?php
/**
 * Zero back compat functionality
 *
 * Prevents Zero from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package Zero
 * @since Zero 0.2.0
 */

/**
 * Prevent switching to Zero on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Zero 0.2.0
 */
function zero_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'zero_upgrade_notice' );
}
add_action( 'after_switch_theme', 'zero_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Zero on WordPress versions prior to 4.7.
 *
 * @since Zero 0.2.0
 *
 * @global string $wp_version WordPress version.
 */
function zero_upgrade_notice() {
	$message = sprintf( __( 'Zero requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'zero' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', esc_html( $message ) );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Zero 0.2.0
 *
 * @global string $wp_version WordPress version.
 */
function zero_customize() {
	wp_die( sprintf( esc_html__( 'Zero requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'zero' ), esc_html( $GLOBALS['wp_version'] ) ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'zero_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Zero 0.2.0
 *
 * @global string $wp_version WordPress version.
 */
function zero_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( esc_html__( 'Zero requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'zero' ), esc_html( $GLOBALS['wp_version'] ) ) );
	}
}
add_action( 'template_redirect', 'zero_preview' );
