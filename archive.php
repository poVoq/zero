<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
<header class="page-header">
	<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
	?>
</header><!-- .page-header -->
<?php endif; ?>

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

		</div>

		<?php zero_posts_pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'components/post/content', 'none' ); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
