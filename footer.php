<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package leivankash
 * @since leivankash 1.0
 */
?>
	</div><!-- #main .site-main -->
	<div id="social">
		<div class="inner container">
			<div class="span three hide-on-mobile customer-service-navigation-container">
				<h6 class="title uppercase"><?php _e("Customer Service", THEME_NAME); ?></h6>
				<?php wp_nav_menu( array( 'theme_location' => 'customer_service', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'customer-service-navigation navigation' )); ?>
				<?php //wp_nav_menu( array( 'theme_location' => 'primary_footer', 'menu_class' => 'clearfix menu', 'container' => false ) ); ?>				
			</div>
			<div class="span seven right alpha omega break-on-mobile">
				<div class="newsletter-container">
					<?php gravity_form(1); ?>
				</div>

				<div class="clearfix">
					<div class="span five social-links-container break-on-tablet">
						<ul class="social-links">
							<li>
								<h6 class="title"><?php _e("Find us here", THEME_NAME); ?></h6>
							</li>
							<li>
								<a class="facebook-btn" href="<?php echo get_field('facebook_url', 'options');?>" target="_blank"></a>
							</li>
							<li>
								<a class="twitter-btn" href="<?php echo get_field('twitter_url', 'options');?>" target="_blank"></a>
							</li>
							<li>
								<a class="instagram-btn" href="<?php echo get_field('instagram_url', 'options');?>" target="_blank"></a>
							</li>
							<li>
								<a class="tumblr-btn" href="<?php echo get_field('tumblr_url', 'options');?>" target="_blank"></a>
							</li>
							<li>
								<a class="pinterest-btn" href="<?php echo get_field('pinterest_url', 'options');?>" target="_blank"></a>
							</li>
						</ul>
					</div>
					<div class="span five cards-container hide-on-tablet">
						<img src="<?php echo get_template_directory_uri(); ?>/images/misc/cards.jpg" />
					</div>
				</div>
			</div>

		</div>
	</div>
	<footer id="footer" class="site-footer" role="contentinfo">
		<div class="container inner">
			<div class="clearfix top">
				<div class="span three alpha">
					<h1 class="logo-container">
						<a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</h1>
				</div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary_footer', 'menu_class' => 'clearfix menu', 'container' => 'nav', 'container_class' => 'span seven omega primary-footer-navigation navigation' ) ); ?>
			</div>		
			<div class="bottom">
				<div class="copyright">
					<p class="small text-right">
						&copy; Copyright <?php bloginfo( 'name' ); ?> 2011-<?php echo date('Y'); ?>.  <?php _e("Registered In England and Wales. Registration number OC361044.", THEME_NAME);?><br />
						<?php _e("Site by", THEME_NAME); ?> <a href="http://parkandcube.com" target="_blank">Park &amp; Cube</a> and <a href="http://www.mindblownmedia.com" target="_blank">Mind Blown Media</a>
					</p>
				</div>
			</div>
		</div>
	</footer><!-- #footer .site-footer -->
</div><!-- #wrap -->

<?php wp_footer(); ?>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-338027-29', 'leivankash.com');
  ga('send', 'pageview');
</script>
<!--script src="//s7.addthis.com/js/300/addthis_widget.js"></script-->

</body>
</html>