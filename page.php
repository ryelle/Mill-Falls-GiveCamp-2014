<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Mill Falls GiveCamp 2014
 */

get_header(); ?>

	<div class="page-header" style="background-color: <?php echo mfcs_header_color(); ?>;">
		<?php if ( has_post_thumbnail() && ! ( function_exists( 'jetpack_is_mobile' ) && jetpack_is_mobile() ) ) : ?>
			<div class="featured-image container">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="container">

		<?php while ( have_posts() ) : the_post(); ?>

		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php endwhile; // end of the loop. ?>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>
