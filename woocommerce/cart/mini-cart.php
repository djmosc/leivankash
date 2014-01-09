<?php global $woocommerce; ?>
<?php //if ( sizeof( $woocommerce->cart->get_cart() ) > 0 && isset($_GET['added-to-cart'])) :?>
<div class="mini-cart">
	<button class="close-btn">&times;</button>
	<header class="header">
		<h5 class="uppercase text-center novecento no-margin"><?php _e("Recently Added", THEME_NAME); ?></h5>
	</header>
	<div class="products">
	<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) :
		$_product = $values['data'];
			if ( $_product->exists() && $values['quantity'] > 0  && $values['product_id'] == $_GET['added-to-cart']) : ?>
		<div class="product clearfix">
			<div class="span three thumbnail alpha">
			<?php
			$thumbnail = $_product->get_image('shop_thumbnail', array('class' => 'scale'));

			if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
				echo $thumbnail;
			else
				printf('<a href="%s" class="overlay-btn">%s</a>', esc_url( get_permalink( $values['product_id'] ) ), $thumbnail );
		?>
			</div>
			<div class="span seven">
				<h5 class="product-title"><?php
					if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
						echo $_product->get_title();
					else
						printf('<a href="%s">%s</a>', esc_url( get_permalink(  $values['product_id'] ) ), $_product->get_title() );
				?></h5>
				<?php echo $woocommerce->cart->get_item_data( $values ); ?>

				<p class="price"><?php 
				$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
				echo woocommerce_price( $product_price );
				?></p>

			</div>
		</div>		
		<?php endif; ?>
	<?php endforeach; ?>
	</div>
	<footer class="footer">
		<a href="<?php echo get_permalink(get_field('cart_page', 'options')); ?>" class="white-btn"><?php _e("View Bag", THEME_NAME); ?></a>
		<a href="<?php echo get_permalink(get_field('cart_page', 'options')); ?>" class="black-btn"><?php _e("Checkout", THEME_NAME); ?></a>
	</footer>
</div>
<?php //endif; ?>