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
 * @package leivankash
 * @since leivankash 1.0
 */

get_header(); ?>
<section id="front-page" class="clearfix">
	<?php if ( get_field('content')) :?>
	<div id="content">
		<?php if ( get_field('content')):?>
		<?php get_template_part('inc/content'); ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<div id="widgets">
		<div class="container">
			<div class="inner clearfix">
				<?php dynamic_sidebar('homepage_content'); ?>
			</div>
		</div>
	</div>
</section><!-- #front-page -->

<?php get_footer(); ?>