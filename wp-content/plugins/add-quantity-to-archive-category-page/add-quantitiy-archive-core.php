<?php
/*
Plugin Name: Woocommerce add quantity on category pages
Plugin URI:  http://uzzyraja.com
Description: Adds a quantity field to your woocommerce category/archive page
Version:     1.0
Author:      Raja Usman Latif
Author URI:  http://uzzyraja.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
/**
 * Add quantity field on the archive page. uzzyraja.com/sourcecodes/
 */
function custom_quantity_field_archive() {

	$product = wc_get_product( get_the_ID() );

	if ( ! $product->is_sold_individually() && 'variable' != $product->product_type && $product->is_purchasable() ) {
		woocommerce_quantity_input( array( 'min_value' => 0, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity() ) );
	}

}
add_action( 'woocommerce_after_shop_loop_item', 'custom_quantity_field_archive', 31);


/**
 * Add requires JavaScript. uzzyraja.com/sourcecodes/
 */
function custom_add_to_cart_quantity_handler() {

	wc_enqueue_js( '
		jQuery( ".post-type-archive-product" ).on( "change input", ".quantity .qty", function() {
			var add_to_cart_button = jQuery( this ).parents( ".product" ).find( ".add_to_cart_button" );

			// For AJAX add-to-cart actions
			add_to_cart_button.attr( "data-quantity", jQuery( this ).val() );


			// For non-AJAX add-to-cart actions
add_to_cart_button.attr( "href", "?add-to-cart=" + add_to_cart_button.attr( "data-product_id" ) + "&quantity=0" + jQuery( this ).val() );
		});
	' );

}
add_action( 'init', 'custom_add_to_cart_quantity_handler' );
?>