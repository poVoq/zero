<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package zero
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_singular() ) : ?>

		<header class="entry-header">
			<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				get_template_part( 'template-parts/entry', 'meta' );
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'zero' ),
					'after'  => '</div>',
          'link_before' => '<span>',
          'link_after' => '</span>',
          'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'zero' ) . ' </span>%',
          'separator'   => '<span class="screen-reader-text">, </span>',
				) );
			?>
		</div><!-- .entry-content -->

		<?php get_template_part( 'template-parts/entry', 'footer' ); ?>
	<?php else : ?>

		<div class="entry-inner">
			<header class="entry-header">
				<?php
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt() ?>
			</div><!-- .entry-summary -->

			<?php get_template_part( 'template-parts/entry', 'meta' ); ?>
		</div><!-- .entry-inner -->
	<?php endif; ?>
</article><!-- #post-## -->
