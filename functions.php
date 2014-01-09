<?php

define('THEME_NAME', 'leivankash');

require( get_template_directory() . '/inc/default/functions.php' );

require( get_template_directory() . '/inc/default/hooks.php' );

require( get_template_directory() . '/inc/default/shortcodes.php' );

// Custom Actions

// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

// remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
 
// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

//gforms_datepicker

add_action( 'after_setup_theme', 'custom_setup_theme' );

add_action( 'init', 'custom_init');

add_action( 'wp', 'custom_wp');

add_action( 'admin_menu', 'custom_remove_menus');

add_action( 'widgets_init', 'custom_widgets_init' );

add_action( 'wp_enqueue_scripts', 'custom_scripts', 30);

add_action( 'wp_print_styles', 'custom_styles', 30);

add_action( 'woocommerce_show_page_title', 'custom_woocommerce_show_page_title');

add_action('pre_get_posts','custom_pre_get_posts');

// Custom Filters

add_filter( 'loop_shop_columns', 'custom_woocommerce_shop_columns');

//Custom shortcodes

//add_shortcode( 'phone_number', 'custom_phone_number');



function custom_setup_theme() {
	
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );

	add_theme_support('woocommerce');

	add_theme_support('editor_style');

	//add_theme_support( 'post-formats', array( 'gallery' ) );


	register_nav_menus( array(
		'primary_header' => __( 'Primary Header', THEME_NAME ),
		'secondary_header' => __( 'Secondary Header', THEME_NAME ),
		'primary_footer' => __( 'Primary Footer', THEME_NAME )
	) );

	//add_image_size( 'custom_medium', 706, 400, true);

	add_rewrite_rule('skip/([^/]+)/upgrade', 'index.php?product=$matches[1]&upgrade=1', 'top');
	
	add_editor_style('/css/editor-styles.css');

	

}

function custom_init(){
	require( get_template_directory() . '/inc/classes/custom-post-type.php' );
	if(function_exists('get_field')) {
		// $testimonials_page = get_field('testimonials_page', 'options');
		// $testimonial = new Custom_Post_Type( 'Testimonial', 
	 // 		array(
	 // 			'rewrite' => array( 'with_front' => false, 'slug' => get_page_uri($testimonials_page->ID) ),
	 // 			'capability_type' => 'post',
	 // 		 	'publicly_queryable' => true,
	 //   			'has_archive' => true, 
	 //    		'hierarchical' => false,
	 //    		'exclude_from_search' => true,
	 //    		'menu_position' => null,
	 //    		'supports' => array('title', 'editor', 'page-attributes'),
	 //    		'plural' => 'Testimonials'
	 //   		)
	 //   	);
	}
}

function custom_wp(){
	
}

function custom_widgets_init() {

	// 	/********************** Sidebars ***********************/

	register_sidebar( array(
		'name' => __( 'Default', THEME_NAME ),
		'id' => 'default',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer', THEME_NAME ),
		'id' => 'footer',
		'before_widget' => '<aside id="%1$s" class="widget span one-third %2$s"><div class="inner">',
		'after_widget' => '</div></aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );

	// 	/********************** Content ***********************/

	// 	register_sidebar( array(
	// 		'name' => __( 'Homepage Content', THEME_NAME ),
	// 		'id' => 'homepage_content',
	// 		'before_widget' => '<aside id="%1$s" class="widget span one-third %2$s">',
	// 		'after_widget' => '</div></aside>',
	// 		'before_title' => '<h5 class="widget-title text-center light-brown uppercase">',
	// 		'after_title' => '</h5><div class="inner equal-height">',
	// 	) );
}

function custom_remove_menus() {
	global $menu;
	$restricted = array(__('Links'), __('Comments'), __('Posts'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:'' , $restricted)) unset($menu[key($menu)]);
	}
}

function custom_scripts() {
	$template_directory_uri = get_template_directory_uri();
	// wp_dequeue_script('prettyPhoto');
	// wp_dequeue_script('prettyPhoto-init');
	// wp_dequeue_script('woocommerce-wishlists');
	// wp_dequeue_script('wc-single-product');
	wp_register_script('fancybox', $template_directory_uri.'/js/plugins/jquery.fancybox.min.js', array('jquery'), '', true);
	wp_register_script('zoom', $template_directory_uri.'/js/plugins/jquery.elevatezoom.js', array('jquery'), '', true);
	
	wp_enqueue_script('jquery');

	if(SCRIPT_DEBUG){
		wp_enqueue_script('modernizr', $template_directory_uri.'/js/libs/modernizr.js');
		wp_enqueue_script('plugins', $template_directory_uri.'/js/main.js', array('jquery', 'modernizr'), '', true);
		wp_enqueue_script('main', $template_directory_uri.'/js/main.js', array('jquery', 'modernizr', 'plugins'), '', true);
	} else {
		wp_enqueue_script('script', $template_directory_uri.'/js/script.min.js', array('jquery'), '', true);
	}	
}


function custom_styles() {
	global $wp_styles;
	$template_directory_uri = get_template_directory_uri();
	
	//wp_deregister_style( 'woocommerce_prettyPhoto_css' );
	wp_register_style('fancybox', $template_directory_uri.'/css/jquery.fancybox.css');
	//wp_enqueue_style( 'jquery-ui', $template_directory_uri . '/css/jquery-ui.css');
	if(SCRIPT_DEBUG){
		wp_enqueue_style( 'style', $template_directory_uri . '/css/style.css' );
	} else {
		wp_enqueue_style( 'style', $template_directory_uri . '/style.css' );
	}
	//wp_enqueue_style( 'ie7', $template_directory_uri . '/css/ie7.css' );
	//wp_enqueue_style( 'prettyphoto', $template_directory_uri . '/css/prettyphoto.css' );

	//$wp_styles->add_data('ie7', 'conditional', 'lt IE 8');
}

function custom_pre_get_posts($query) {
    if (!is_admin() && ($query->is_post_type_archive( 'product' ) || $query->is_tax( get_object_taxonomies( 'product' ))) && isset($_GET['sale']) && $_GET['sale'] == 1) {
         $meta_query = array(
               array(
                   'key' => '_sale_price',
                   'value' => 0,
                   'compare' => '>',
                   'type' => 'numeric'
               )
         );
         $query->set('meta_query', $meta_query);
    }
}

