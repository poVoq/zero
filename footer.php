<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Zero
 * @since 0.1.0
 * @version 0.2.0
 */

?>
    </div><!-- .content-wrap -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_template_part( 'components/footer/footer', 'widgets' ); ?>

		<?php get_template_part( 'components/menus/menu', 'social' ); ?>

    <?php get_template_part( 'components/footer/site', 'info' ); ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
