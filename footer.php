<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package zero
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php get_sidebar( 'footer' ); // Loads the sidebar-footer.php template. ?>

		<div class="site-info">

			<?php get_template_part( 'menus/menu', 'social' ); // Loads the menus/menu-social.php template. ?>

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zero' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'zero' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'zero' ), 'zero', '<a href="http://muniftanjim.com/" rel="designer">MunifTanjim</a>' ); ?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
