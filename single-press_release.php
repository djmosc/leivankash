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

<div id="single-press-release">
	<div class="inner container">
		<div id="sidebar" class="span one-fourth hide-on-tablet alpha">
			<button class="mobile-sidebar-btn"></button>
			<?php dynamic_sidebar('press'); ?>
		</div>
		<div id="content" class="span seven-and-half omega break-on-tablet">
			<header class="header">
				<div class="options">
					<div class="pagination">
						<a href="<?php echo get_permalink(get_field('press_releases_page', 'options')); ?>"><?php _e("Back", THEME_NAME); ?></a>
					</div>
				</div>
			</header>
			<?php $i = 0; ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="press-release clearfix">
				<div class="span one-third">
					<h5 class="title"><?php the_title(); ?></h5>
					<div class="meta small">
						<p class="publish-date">
							<span class="label"><?php _e("Published on", THEME_NAME); ?></span><br />
							<?php the_field('published_date'); ?>
						</p>
					</div>
					<div class="content small">
						<?php the_content(); ?>
					</div>
				</div>
				<div class="span two-thirds right">
					<?php if($images = get_field('images')): ?>
					<div class="images clearfix">
					<?php foreach($images as $image): ?>
						<div class="image span five" data-id="<?php echo $image['id']; ?>">
							<a class="overlay-btn" href="<?php echo $image['sizes']['large']; ?>" >
								<img src="<?php echo $image['sizes']['press_release_thumbnail']; ?>" />
							</a>
						</div>
					<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<?php $i++; ?>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
