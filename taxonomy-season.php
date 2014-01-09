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

<div id="taxonomy-season">
	<div class="collection scroller" data-scroll-all="true" data-resize="true">
		<div class="scroller-mask">
			<div class="scroll-items-container">
			<?php $i = 0; ?>
			<?php
				global $wp_query;
				$season = get_query_var('term');
				$args = array( 'post_type' => 'collection', 'term' => $season, 'taxonomy' => 'season', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order');
				query_posts( $args );
			?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="scroll-item <?php if($i == 0) echo 'current'; ?>" data-id="<?php the_ID(); ?>">
					<?php the_post_thumbnail('custom_medium', array('class' => 'scale')); ?>
				</div>
			<?php $i++; ?>
			<?php endwhile; ?>
			</div>
		</div>
		<nav class="scroller-navigation">
			<button class="prev-btn large"></button>
			<button class="next-btn large"></button>
		</nav>

	</div>
</div>

<?php get_footer(); ?>
