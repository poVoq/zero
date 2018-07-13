<?php
/**
 * SVG icons related functions and filters
 *
 * @package Zero
 * @since 0.2.0
 */

/**
 * Add SVG definitions to the footer.
 *
 * @since 0.2.0
 */
function zero_include_svg_icons() {
	// Define SVG sprite file.
	$svg_icons = get_parent_theme_file_path( '/assets/images/svg-icons.svg' );
	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
add_action( 'wp_footer', 'zero_include_svg_icons', 9999 );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function zero_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'zero' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'zero' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'aria_hidden' => true, // Hide from screen readers.
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = '';

	if ( true === $args['aria_hidden'] ) {
		$aria_hidden = ' aria-hidden="true"';
	}

	// Set ARIA.
	$aria_labelledby = '';

	if ( $args['title'] && $args['desc'] ) {
		$aria_labelledby = ' aria-labelledby="title desc"';
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// If there is a title, display it.
	if ( $args['title'] ) {
		$svg .= '<title>' . esc_html( $args['title'] ) . '</title>';
	}

	// If there is a description, display it.
	if ( $args['desc'] ) {
		$svg .= '<desc>' . esc_html( $args['desc'] ) . '</desc>';
	}

	// Use absolute path in the Customizer so that icons show up in there.
	if ( is_customize_preview() ) {
		$svg .= '<use xlink:href="' . get_parent_theme_file_uri( '/assets/images/svg-icons.svg#icon-' . esc_html( $args['icon'] ) ) . '"></use>';
	} else {
		$svg .= '<use xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use>';
	}

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Display an SVG.
 *
 * @param array $args Parameters needed to display an SVG.
 */
function zero_do_svg( $args = array() ) {
	echo zero_get_svg( $args );
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item with possible description.
 */
function zero_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = zero_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . zero_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
		  }
	  }
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'zero_nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function zero_social_links_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'blogspot.com'    => 'blogger',
		'joindiaspora.com' => 'diaspora',
		'discord.me'      => 'discord',
		'hub.docker.com'  => 'docker',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'plus.google.com' => 'google',
		'github.com'      => 'github',
		'gitlab.com'      => 'gitlab',
		'instagram.com'   => 'instagram',
		'kickstarter.com' => 'kickstarter',
		'mailto:'         => 'mailru',
		'mastodon.social' => 'mastodon',
		'patreon.com'     => 'patreon',
		'paypal.com'      => 'paypal',
		'pinterest.com'   => 'pinterest-alt',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slack.com'       => 'slack',
		'soundcloud.com'  => 'cloud',
		'spotify.com'     => 'spotify',
		'steamcommunity.com'     => 'steam',
		'steemit.com'     => 'steem',
		'stumbleupon.com' => 'stumbleupon',
		'trello.com'      => 'trello',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'youtube.com'     => 'youtube',
		'social.freegamedev.net'  => 'gnusocial',
		'blog.freegamedev.net'    => 'rss',
		'git.freegamedev.net'    => 'git',
		'irc.freegamedev.net'    => 'slack',
	);

	return apply_filters( 'zero_social_links_icons', $social_links_icons );
}
