<?php
/**
 * The template for displaying sidebar pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package leivankash
 * @since leivankash 1.0
 */
get_header(); ?>

<div id="page">
	<?php while ( have_posts() ) : the_post(); ?>
	<div id="content" <?php post_class(); ?>>
		<?php get_template_part('inc/content'); ?>
	</div>
	<?php endwhile; // end of the loop. ?>
</div><!-- #page -->
<?php get_footer(); ?>