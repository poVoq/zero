<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

get_header(); ?>

<header class="page-header">
  <?php if ( have_posts() ) : ?>
    <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'zero' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
  <?php else : ?>
    <h1 class="page-title"><?php _e( 'Nothing Found', 'zero' ); ?></h1>
  <?php endif; ?>
</header><!-- .page-header -->


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

    <div class="grid-wrapper">

		<?php

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'components/post/content', 'excerpt' );

			endwhile;
    ?>

    </div><!-- .grid-wrapper -->

    <?php zero_posts_pagination(); ?>

	<?php else : ?>

    <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'zero' ); ?></p>

    <?php get_search_form(); ?>

	<?php endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
