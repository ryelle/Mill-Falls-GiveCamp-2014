<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mill Falls GiveCamp 2014
 */
$page = get_option( 'page_on_front' );

get_header(); ?>

	<div class="page-header" style="background-color: <?php echo mfcs_background_color( $page ); ?>;">
		<?php if ( has_post_thumbnail( $page ) && ! ( function_exists( 'jetpack_is_mobile' ) && jetpack_is_mobile() ) ) : ?>
			<div class="featured-image container">
				<?php echo get_the_post_thumbnail( $page ); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="container">

		<header class="entry-header" style="background-color: <?php echo mfcs_header_color( $page ); ?>;">
			<h1 class="entry-title">News</h1>
		</header><!-- .entry-header -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php mfcs_2014_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div>
<?php get_footer(); ?>
