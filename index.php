<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

get_header(); ?>

<header class="page-header">
	<?php if ( is_home() && ! is_front_page() ) : ?>
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	<?php else : ?>
		<h4 class="page-title"><?php esc_html_e( 'Posts', 'zero' ); ?></h4>
	<?php endif; ?>
</header>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

		<div class="grid-wrapper">

		<?php

			/* Start the Loop */
			while ( have_posts() ) : the_post();

			/*
       * Include the Post-Format-specific template for the content.
       * If you want to override this in a child theme, then include a file
       * called content-___.php (where ___ is the Post Format name) and that will be used instead.
       */
				get_template_part( 'components/post/content', 'excerpt' );

			endwhile;
		?>

		</div><!-- .grid-wrapper -->

		<?php zero_posts_pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'components/post/content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
