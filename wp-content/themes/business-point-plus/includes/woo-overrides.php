<?php
/**
 * Load files.
 *
 * @package Business_Point
 */

// Remove rating info from featured products.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//=============================================================
// Change number of product per row
//=============================================================

if (!function_exists('business_point_product_columns')) {

	function business_point_product_columns() {

		return 3; // 3 products per row

	}
	
}

add_filter('loop_shop_columns', 'business_point_product_columns');

//=============================================================
// Change number of related product
//=============================================================

if (!function_exists('business_point_related_products_args')) {

	function business_point_related_products_args( $args ) {
		
		$args['posts_per_page'] = 3; // 3 related products
		
		return $args;
	}

}

add_filter( 'woocommerce_output_related_products_args', 'business_point_related_products_args' );


//=============================================================
// Change number of upsell products
//=============================================================

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product_summary', 'business_point_output_upsells', 15 );

if ( ! function_exists( 'business_point_output_upsells' ) ) {

	function business_point_output_upsells() {

	    woocommerce_upsell_display( 3, 3 ); // Display 3 products in rows of 3
	    
	}

}