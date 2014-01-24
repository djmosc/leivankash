<?php

define('THEME_NAME', 'leivankash');

$template_directory = get_template_directory();

$template_directory_uri = get_template_directory_uri();

require( $template_directory . '/inc/default/functions.php' );

require( $template_directory . '/inc/default/hooks.php' );

require( $template_directory . '/inc/default/shortcodes.php' );


// Custom Actions

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

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

add_action('pre_get_posts','custom_pre_get_posts');

add_action('admin_head', 'custom_admin_head');

add_action( 'woocommerce_register_taxonomy', 'custom_woocommerce_register_taxonomy');

add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 10 );

add_action( 'woocommerce_after_shop_loop_item', 'custom_woocommerce_after_shop_loop_item');

add_action( 'woocommerce_single_product_summary', 'custom_woocommerce_single_product_summary', 2);

add_action('single_product_additional_info', 'custom_single_product_accordion', 10);

add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );

// Custom Filters

add_filter( 'loop_shop_columns', 'custom_woocommerce_shop_columns');

add_filter( 'walker_nav_menu_start_el' , 'custom_walker_nav_menu_start_el', 10, 4);

add_filter( 'woocommerce_page_title' , 'custom_woocommerce_page_title');

add_filter('single_add_to_cart_text', 'custom_add_to_cart_text');

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
		'primary_footer' => __( 'Primary Footer', THEME_NAME ),
		'customer_service' => __( 'Customer Service', THEME_NAME )
	) );

	add_image_size( 'scroll_item', 960, 640, true);
	add_image_size( 'press_release_thumbnail', 220, 300, true);
	add_image_size( 'press_release_widget', 310, 410, true);

	add_editor_style('editor-style.css');

}

function custom_init(){
	global $template_directory;

	require( $template_directory . '/inc/classes/custom-post-type.php' );
	if(function_exists('get_field')) {
		$press_releases_page = get_field('press_releases_page', 'options');
		$press_releases_url = get_page_uri($press_releases_page->ID);
		$press_release = new Custom_Post_Type( 'Press release', 
	 		array(
	 			'rewrite' => array( 'with_front' => false, 'slug' => $press_releases_url ),
	 			'capability_type' => 'post',
	 		 	'publicly_queryable' => true,
	   			'has_archive' => true, 
	    		'hierarchical' => false,
	    		'exclude_from_search' => false,
	    		'menu_position' => null,
	    		'supports' => array('title', 'editor', 'page-attributes', 'thumbnail'),
	    		'plural' => 'Press Releases'
	   		)
	   	);

	   	$press_release->add_taxonomy('press_category', 
	   		array('hierarchical' => true, 'rewrite' => array( 'slug' => 'press-category')), 
	   		array('plural' => __("Categories", THEME_NAME), 'singular_name' => __("Category", THEME_NAME))
	   	);

	   	$stockists_page = get_field('stockists_page', 'options');
		$stockists_url = get_page_uri($stockists_page->ID);
		$stockist = new Custom_Post_Type( 'Stockist', 
	 		array(
	 			'rewrite' => array( 'with_front' => false, 'slug' => $stockists_url ),
	 			'capability_type' => 'post',
	 		 	'publicly_queryable' => true,
	   			'has_archive' => true, 
	    		'hierarchical' => false,
	    		'exclude_from_search' => false,
	    		'menu_position' => null,
	    		'supports' => array('title', 'editor', 'page-attributes'),
	    		'plural' => 'Stockists'
	   		)
	   	);

	   	$stockist->add_taxonomy('region', 
	   		array('hierarchical' => true, 'show_admin_column' => true, 'query_var' => true, 'rewrite' => array( 'slug' => 'region')), 
	   		array('plural' => __("Regions", THEME_NAME), 'singular_name' => __("Region", THEME_NAME))
	   	);
	}

}

function custom_wp(){
	
}

function custom_widgets_init() {
	global $template_directory;

	require( $template_directory . '/inc/widgets/featured-products-widget.php' );

	require( $template_directory . '/inc/widgets/instagram-widget.php' );

	require( $template_directory . '/inc/widgets/press-widget.php' );
	
	// 	/********************** Sidebars ***********************/

	register_sidebar( array(
		'name' => __( 'Default', THEME_NAME ),
		'id' => 'default',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Shop', THEME_NAME ),
		'id' => 'shop',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );


	register_sidebar( array(
		'name' => __( 'Press', THEME_NAME ),
		'id' => 'press',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Stockists', THEME_NAME ),
		'id' => 'stockists',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	// 	/********************** Content ***********************/

	register_sidebar( array(
		'name' => __( 'Homepage Content', THEME_NAME ),
		'id' => 'homepage_content',
		'before_widget' => '<aside id="%1$s" class="widget span one-third %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title text-center light-brown uppercase">',
		'after_title' => '</h5>',
	) );
}

function custom_remove_menus() {
	global $menu;
	$restricted = array(__('Links'), __('Posts'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:'' , $restricted)) unset($menu[key($menu)]);
	}
}

function custom_scripts() {
	global $template_directory_uri;
	// wp_dequeue_script('prettyPhoto');
	// wp_dequeue_script('prettyPhoto-init');
	// wp_dequeue_script('woocommerce-wishlists');
	// wp_dequeue_script('wc-single-product');
	wp_register_script('fancybox', $template_directory_uri.'/js/plugins/jquery.fancybox.min.js', array('jquery'), '', true);
	wp_register_script('zoom', $template_directory_uri.'/js/plugins/jquery.elevatezoom.js', array('jquery'), '', true);
	
	wp_enqueue_script('jquery');

	wp_enqueue_script('modernizr', $template_directory_uri.'/js/libs/modernizr.min.js');
	wp_enqueue_script('plugins', $template_directory_uri.'/js/plugins.min.js', array('jquery', 'modernizr'), '', true);
	wp_enqueue_script('main', $template_directory_uri.'/js/main.js', array('jquery', 'modernizr', 'plugins'), '', true);
}


function custom_styles() {
	global $wp_styles, $template_directory_uri;
	
	//wp_deregister_style( 'woocommerce_prettyPhoto_css' );
	wp_register_style('fancybox', $template_directory_uri.'/css/jquery.fancybox.css');
	//wp_enqueue_style( 'jquery-ui', $template_directory_uri . '/css/jquery-ui.css');
	if(SCRIPT_DEBUG){
		wp_enqueue_style( 'style', $template_directory_uri . '/css/style.css' );
	} else {
		wp_enqueue_style( 'style', $template_directory_uri . '/css/style.min.css' );
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


function custom_walker_nav_menu_start_el($item_output, $item, $depth, $args){
	if($item->ID == 124 && $args->theme_location == 'secondary_header') {
		ob_start();
		woocommerce_get_template('cart/mini-cart.php');
    	$item_output .= ob_get_clean();
	}
	return $item_output;
}



function custom_admin_head() {
  echo '<style>
    table.acf_input tbody tr td.label {
    	width: 10%;
    }
  </style>';
}

function custom_woocommerce_shop_columns($columns){
	return 3;
}


function custom_woocommerce_register_taxonomy(){
	register_taxonomy( 'product_collection',
        array('product'),
        array(
            'hierarchical' 			=> true,
            'update_count_callback' => '_woocommerce_term_recount',
            'label' 				=> __( 'Product Collections', 'woocommerce'),
            'labels' => array(
			    'name' 				=> __( 'Product Collections', 'woocommerce'),
			    'singular_name' 	=> __( 'Product Collection', 'woocommerce'),
				'menu_name'			=> _x( 'Collections', 'Admin menu name', 'woocommerce' ),
			    'search_items' 		=> __( 'Search Product Collections', 'woocommerce'),
			    'all_items' 		=> __( 'All Product Collections', 'woocommerce'),
			    'parent_item' 		=> __( 'Parent Product Collection', 'woocommerce'),
			    'parent_item_colon' => __( 'Parent Product Collection:', 'woocommerce'),
			    'edit_item' 		=> __( 'Edit Product Collection', 'woocommerce'),
			    'update_item' 		=> __( 'Update Product Collection', 'woocommerce'),
			    'add_new_item' 		=> __( 'Add New Product Collection', 'woocommerce'),
			    'new_item_name' 	=> __( 'New Product Collection Name', 'woocommerce')
			),
            'show_ui' 				=> true,
            'query_var' 			=> true,
            'capabilities'			=> array(
            	'manage_terms' 		=> 'manage_product_terms',
				'edit_terms' 		=> 'edit_product_terms',
				'delete_terms' 		=> 'delete_product_terms',
				'assign_terms' 		=> 'assign_product_terms',
            ),
            'rewrite' 				=> array(
            	'slug' => 'collection',
            	'with_front' => false,
            	'hierarchical' => true
            )
        )
    );
}

function custom_woocommerce_after_shop_loop_item(){
	woocommerce_get_template('single-product/collections.php');
}

function custom_woocommerce_single_product_summary(){
	woocommerce_get_template('single-product/collections.php');
}

function custom_woocommerce_page_title($title){
	if($title == "Shop") $title = __("Viewing All", THEME_NAME);
	return $title;
}

function custom_single_product_accordion(){
	woocommerce_get_template( 'single-product/accordion.php' );
}

function custom_add_to_cart_text( $text ) {
	return __("Add to bag", THEME_NAME);
}
