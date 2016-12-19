<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) :
	return;
endif;
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( esc_html_x( 'One Thought on &ldquo;%2$s&rdquo;', 'comments title', 'zero' ), get_the_title() );
			} else {
				printf( esc_html(
					_nx(
						'%1$s Thought on &ldquo;%2$s&rdquo;',
						'%1$s Thoughts on &ldquo;%2$s&rdquo;',
						get_comments_number(),
						'comments title',
						'zero'
						)
					),
					esc_attr( number_format_i18n( $comments_number ) ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2>

		<?php
			the_comments_navigation( array(
				'prev_text' => sprintf( esc_html__( '%s Older comments', 'zero' ), zero_get_svg( $args = array( 'icon' => 'chevron-circle-left' ) ) ),
				'next_text' => sprintf( esc_html__( 'Newer comments %s', 'zero' ), zero_get_svg( $args = array( 'icon' => 'chevron-circle-right' ) ) ),
		  ) );
		?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
					'reply_text'  => esc_html__( 'Reply', 'zero' ) . zero_get_svg( $args = array( 'icon' => 'reply' ) ),
				) );
			?>
		</ol><!-- .comment-list -->

		<?php
			the_comments_navigation( array(
				'prev_text' => sprintf( esc_html__( '%s Older comments', 'zero' ), zero_get_svg( $args = array( 'icon' => 'chevron-circle-left' ) ) ),
				'next_text' => sprintf( esc_html__( 'Newer comments %s', 'zero' ), zero_get_svg( $args = array( 'icon' => 'chevron-circle-right' ) ) ),
		) );
		?>

	<?php endif; // Check for have_comments(). ?>


	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'zero' ); ?></p>
		<?php endif;

		comment_form();
	?>

</div><!-- #comments -->
