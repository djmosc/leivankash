<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 ?>
<div id="sidebar" class="span one-fourth alpha">
	<button class="mobile-sidebar-btn"></button>
	<?php dynamic_sidebar('shop'); ?>
</div>