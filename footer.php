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

		<div class="container">
			<nav id="footer-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
			</nav><!-- #footer-navigation -->

			<div class="fb-like" data-href="https://www.facebook.com/MillFallsCharterSchool" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
		</div>

	</footer><!-- #colophon -->

	<div class="site-info">
		Copyright 2014 Mill Falls Charter School
	</div><!-- .site-info -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
