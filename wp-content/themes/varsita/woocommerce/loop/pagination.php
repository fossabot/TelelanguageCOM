<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}

$paged 		= (get_query_var('paged')) ? get_query_var('paged') : 1;
$args 		= array( 'post_type' => 'product', 'paged' => $paged );
$products 	= new WP_Query( $args );

themeum_pagination($products->max_num_pages);

