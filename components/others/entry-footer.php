<?php
/**
 * Entry footer.
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.1.0
 */

?>

<?php if ( 'post' === get_post_type() ) : ?>

	<footer class="entry-footer clear">
		<?php
			zero_post_terms( array( 'taxonomy' => 'category', 'before' => '<div class="entry-terms-wrapper entry-categories-wrapper"><span class="screen-reader-text">' . esc_html__( 'Categories:', 'zero' ) . ' </span><span class="icon-wrapper">' . zero_get_svg( array( 'icon' => 'folder-open' ) ) . '</span>', 'after' => '</div>' ) );
			zero_post_terms( array( 'taxonomy' => 'post_tag', 'before' => '<div class="entry-terms-wrapper entry-tags-wrapper"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'zero' ) . ' </span><span class="icon-wrapper">' . zero_get_svg( array( 'icon' => 'tag' ) ) . '</span>', 'after' => '</div>' ) );
		?>
	</footer><!-- .entry-footer -->

<?php endif;
