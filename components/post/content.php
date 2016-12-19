<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;

		get_template_part( 'components/others/entry', 'meta' );
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
			the_content();

			zero_link_pages();
		?>

	</div><!-- .entry-content -->

	<?php get_template_part( 'components/others/entry', 'footer' ); ?>

</article><!-- #post-## -->
