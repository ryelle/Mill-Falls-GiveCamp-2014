<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Mill Falls GiveCamp 2014
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'mfcs_2014' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'mfcs_2014' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'mfcs_2014' ), 'Mill Falls GiveCamp 2014', '<a href="http://themes.redradar.net" rel="designer">GiveCamp (Kelly Dwan & Mel Choyce)</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
