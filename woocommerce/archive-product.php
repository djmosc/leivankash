<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>
	<div id="archive-product" class="container">
		<?php 
		if (is_tax( 'product_collection' )) :
			global $wp_query;
			$collection = $wp_query->get_queried_object();
			$image = get_field('image', 'product_collection_'.$collection->term_id);
		?>
		<header class="archive-product-header clearfix" style="background-image: url(<?php echo $image['url']; ?>);">
			<div class="content">
				<div class="inner">
					<h1 class="title italic"><?php echo $collection->name; ?></h1>
					<div class="description">
						<?php echo apply_filters('the_content', $collection->description); ?>
					</div>
					<p><a class="sackers scroll-to-btn small" id=""><?php _e("Shop the collection", THEME_NAME); ?> <i class="icon-arrow-down small" ></i></a><p>
				</div>
			</div>
		</header>
		<?php endif; ?>
		<div class="inner clearfix">
	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
	?>
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h5 class="page-title text-center"><?php woocommerce_page_title(); ?></h5>
		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<div class="options">
			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>
			</div>
			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>
			<div class="options">
			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>
			</div>
		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
		</div>
	</div>
<?php get_footer('shop'); ?>