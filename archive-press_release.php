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
global $wp_query;
get_header(); ?>

<div id="archive-press-release">
	<div class="inner container">
		<div id="sidebar" class="span one-fourth alpha">
			<button class="mobile-sidebar-btn"></button>
			<?php dynamic_sidebar('press'); ?>
		</div>
		<div id="content" class="span seven-and-half omega break-on-tablet">
			<header class="header">
				<?php if(is_tax('press_category')): ?>
				<h5 class="page-title"><?php  ?></h5>
				<?php else: ?>
				<h5 class="page-title"><?php _e("View All", THEME_NAME); ?></h5>
				<?php endif; ?>
			</header>
			<?php get_template_part('inc/options'); ?>
			<div class="press-releases clearfix">
			<?php $i = 0; ?>
			<?php //print_r($wp_query); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="press-release span one-third">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('press_release_thumbnail', array('class' => 'scale')); ?>
						<h6 class="title"><?php the_title(); ?></h6>
					</a>
				</div>
			<?php $i++; ?>
			<?php endwhile; ?>
			</div>
			<?php get_template_part('inc/options'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
