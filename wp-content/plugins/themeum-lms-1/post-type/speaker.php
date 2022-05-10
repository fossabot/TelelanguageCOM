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
 * Register post type Speaker
 *
 * @return void
 */

function themeum_lms_post_type_speaker()
{
	$labels = array( 
		'name'                	=> _x( 'Speakers', 'Speakers', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Speaker', 'Speaker', 'themeum-lms' ),
		'menu_name'           	=> __( 'Speakers', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Speaker:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Speaker', 'themeum-lms' ),
		'view_item'           	=> __( 'View Speaker', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Speaker', 'themeum-lms' ),
		'add_new'             	=> __( 'New Speaker', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Speaker', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Speaker', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Speaker', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> 'edit.php?post_type=speaker',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type('speaker',$args);

}

add_action('init','themeum_lms_post_type_speaker');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_speaker( $messages )
{
	global $post, $post_ID;

	$message['speaker'] = array(
		0 => '',
		1 => sprintf( __('Speaker updated. <a href="%s">View Speaker</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Speaker updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Speaker restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Speaker published. <a href="%s">View Speaker</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Speaker saved.', 'themeum-lms' ),
		8 => sprintf( __('Speaker submitted. <a target="_blank" href="%s">Preview Speaker</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Speaker scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Speaker</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Speaker draft updated. <a target="_blank" href="%s">Preview Speaker</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_speaker' );


