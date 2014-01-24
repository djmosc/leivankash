<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package leivankash
 * @since leivankash 1.0
 */

global $woocommerce;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 7]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html xmlns:fb="http://ogp.me/ns/fb#" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="<?php echo get_template_directory_uri(); ?>/images/misc/favicon.png" rel="shortcut icon" type="image/x-icon">

    <script type="text/javascript">
		var themeUrl = '<?php bloginfo( 'template_url' ); ?>';
		var baseUrl = '<?php bloginfo( 'url' ); ?>';
	</script>
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<header id="header" role="banner">
		<div class="top">
			<div class="inner container">
				<h1 class="logo-container">
					<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<div class="navigation-container">
					<!--button class="mobile-navigation-btn"></button-->
					<?php wp_nav_menu( array( 'theme_location' => 'secondary_header', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'secondary-navigation navigation' )); ?>
					<!--div class="cart">
						<a href="<?php echo get_permalink(get_field('cart_page', 'options')); ?>" class="cart-btn" ><?php echo get_the_title(get_field('cart_page', 'options')); ?></a>
						&nbsp;&nbsp;<a class="items" href="<?php echo get_permalink(get_field('cart_page', 'options')); ?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></a>
						
					</div-->
				</div>
				<!--ul class="ecommerce-options clearfix">
					<li class="account">
						<a href="<?php echo get_permalink(get_field('account_page', 'options')); ?>" class="account-btn" ><?php echo get_the_title(get_field('account_page', 'options')); ?>
						</a>
					</li>
					<?php if ( is_user_logged_in() ): ?>
					<li class="logout">
						<a href="<?php echo wp_logout_url('/'); ?>" class="logout-btn" >
							<?php _e("Logout") ?>
						</a>
					</li>
					<?php endif; ?>
					<?php global $woocommerce; ?>
					
				</ul-->
			</div>	
		</div>
		<div class="bottom">
			<div class="inner container">
				
				<div class="navigation-container">
					<!--a href="<?php echo get_permalink(get_field('cart_page', 'options')); ?>" class="cart-btn" >
						<?php echo get_the_title(get_field('cart_page', 'options')); ?>:
						<strong class="items"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?></strong>
					</a-->
					<?php wp_nav_menu( array( 'theme_location' => 'primary_header', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'primary-navigation' ) ); ?>
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</header><!-- #header -->
	<?php if(!is_front_page()): ?>
		<?php
		$args = array(
				'delimiter'		=> ' &rsaquo; ',
				'wrap_before'	=> '<nav id="breadcrumbs"><div class="inner container"><div class="crumbs">',
				'wrap_after'	=> '</div></div></nav>',
				'home'			=> _x( "Home", 'breadcrumb', 'woocommerce' )
		);
		?>
		<?php woocommerce_breadcrumb( $args ); ?>
	<?php //if ( function_exists('yoast_breadcrumb') ) yoast_breadcrumb('<div id="breadcrumbs"><div class="inner container">','</div></div>'); ?>
	<?php endif; ?>
	<div id="main" class="site-main" role="main">
		<div id="ajax-page"></div>