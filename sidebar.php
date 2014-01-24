<?php
/**
 * The template for displaying the sidebar.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package leivankash
 * @since leivankash 1.0
 */
?>

<div id="sidebar" class="span one-fourth alpha">
	<button class="mobile-sidebar-btn"></button>
	<?php 
	if ( ! acf_Widget::dynamic_widgets( 'default' ) ) :
		dynamic_sidebar('default');
	endif;
	?>
</div>