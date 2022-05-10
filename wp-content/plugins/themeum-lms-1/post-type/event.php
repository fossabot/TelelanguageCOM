<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Admin functions for the Event post type
 *
 * @author 		Themeum
 * @category 	Admin
 * @package 	Varsity
 * @version     1.0
 *-------------------------------------------------------------*/

/**
 * Register post type Course
 *
 * @return void
 */

function themeum_lms_post_type_event()
{
	$labels = array( 
		'name'                	=> _x( 'Event', 'Events', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Event', 'Event', 'themeum-lms' ),
		'menu_name'           	=> __( 'Events', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Event:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Event', 'themeum-lms' ),
		'view_item'           	=> __( 'View Event', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Event', 'themeum-lms' ),
		'add_new'             	=> __( 'New Event', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Event', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Event', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Event', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> 'edit.php?post_type=event',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'supports'           	=> array( 'title','editor','thumbnail'),
		'taxonomies' 			=> array('post_tag')
		);

	register_post_type('event',$args);

}

add_action('init','themeum_lms_post_type_event');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_event( $messages )
{
	global $post, $post_ID;

	$message['event'] = array(
		0 => '',
		1 => sprintf( __('Event updated. <a href="%s">View Event</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Event updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Event published. <a href="%s">View Event</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Event saved.', 'themeum-lms' ),
		8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview Event</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview Event</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_event' );


/**
 * Register Event Category Taxonomies
 *
 * @return void
 */

function themeum_lms_register_event_cat_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Event Categories', 'taxonomy general name', 'themeum-lms' ),
		'singular_name'     	=> _x( 'Event Category', 'taxonomy singular name', 'themeum-lms' ),
		'search_items'      	=> __( 'Search Category', 'themeum-lms' ),
		'all_items'         	=> __( 'All Category', 'themeum-lms' ),
		'parent_item'       	=> __( 'Parent Category', 'themeum-lms' ),
		'parent_item_colon' 	=> __( 'Parent Category:', 'themeum-lms' ),
		'edit_item'         	=> __( 'Edit Category', 'themeum-lms' ),
		'update_item'       	=> __( 'Update Category', 'themeum-lms' ),
		'add_new_item'      	=> __( 'Add New Category', 'themeum-lms' ),
		'new_item_name'     	=> __( 'New Category Name', 'themeum-lms' ),
		'menu_name'         	=> __( 'Event Category', 'themeum-lms' )
		);

	$args = array(	'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('event_cat',array( 'event' ),$args);
}

add_action('init','themeum_lms_register_event_cat_taxonomy');


