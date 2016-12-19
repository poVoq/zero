<?php
/**
 * Entry meta content for displaying post date and author.
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.1.0
 */

if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<?php zero_posted_on(); ?>
	</div><!-- .entry-meta -->
<?php endif;
