<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part( 'components/post/content', get_post_format() );

			// Next/Previous Post Navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'zero' ) . zero_get_svg( array( 'icon' => 'arrow-circle-right' ) ) . '</span> <span class="screen-reader-text">' . esc_html__( 'Next post:', 'zero' ) . '</span> <span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . zero_get_svg( array( 'icon' => 'arrow-circle-left' ) ) . esc_html__( 'Previous', 'zero' ) . '</span> <span class="screen-reader-text">' . esc_html__( 'Previous post:', 'zero' ) . '</span> <span class="post-title">%title</span>',
			) );

			// Jetpack Related Posts
			if ( class_exists( 'Jetpack_RelatedPosts' ) ) :
				echo do_shortcode( '[jetpack-related-posts]' );
			endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
	?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
