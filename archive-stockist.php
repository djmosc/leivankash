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
$stockists_page = get_field('stockists_page', 'options');
get_header(); ?>

<div id="archive-stockist">
	<header class="header">
		<div class="container">
			<?php echo get_the_post_thumbnail($stockists_page->ID, 'full'); ?>
		</div>
	</header>

	<div class="inner container">
		<div id="sidebar" class="span one-fourth alpha">
			<button class="mobile-sidebar-btn"></button>
			<?php dynamic_sidebar('stockists'); ?>
		</div>
		<div id="content" class="span seven-and-half omega break-on-tablet">
			<header class="header">
				<?php if(is_tax('region')): ?>
				<h5 class="page-title"><?php echo single_term_title( "", false ); ?></h5>
				<?php else: ?>
				<h5 class="page-title"><?php _e("View All", THEME_NAME); ?></h5>
				<?php endif; ?>
			</header>
			<div class="stockists clearfix">
			<?php if(have_posts()): ?>
			<?php $i = 0; ?>
			<?php //print_r($wp_query); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="stockist span one-third">
					<h6 class="title"><?php the_title(); ?></h6>
					<div class="content small">
						<?php the_content(); ?>
					</div>
				</div>
			<?php $i++; ?>
			<?php endwhile; ?>
			<?php else: ?>
			<p class="text-center"><?php _e("No Stockists found", THEME_NAME); ?></p>
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
