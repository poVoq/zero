<?php
/**
 * Template part for displaying posts excerpts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-inner">

		<header class="entry-header">
			<?php
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">',
				esc_url( get_permalink() ) ), '</a></h2>' );
			?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<?php get_template_part( 'components/others/entry', 'meta' ); ?>

	</div><!-- .entry-inner -->
</article><!-- #post-## -->
