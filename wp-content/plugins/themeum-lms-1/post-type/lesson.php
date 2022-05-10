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
 * Register post type Lesson
 *
 * @return void
 */

function themeum_lms_post_type_lesson()
{
	$labels = array( 
		'name'                	=> _x( 'Lessons', 'Lessons', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Lesson', 'Lesson', 'themeum-lms' ),
		'menu_name'           	=> __( 'Lessons', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Lesson:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Lesson', 'themeum-lms' ),
		'view_item'           	=> __( 'View Lesson', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Lesson', 'themeum-lms' ),
		'add_new'             	=> __( 'New Lesson', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Lesson', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Lesson', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Lesson', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> 'edit.php?post_type=lesson',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail', 'page-attributes','comments')
		);

	register_post_type('lesson', $args);

}

add_action('init','themeum_lms_post_type_lesson');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_lesson( $messages )
{
	global $post, $post_ID;

	$message['lesson'] = array(
		0 => '',
		1 => sprintf( __('Lesson updated. <a href="%s">View Lesson</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Lesson updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Lesson restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Lesson published. <a href="%s">View Lesson</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Lesson saved.', 'themeum-lms' ),
		8 => sprintf( __('Lesson submitted. <a target="_blank" href="%s">Preview Lesson</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Lesson scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Lesson</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Lesson draft updated. <a target="_blank" href="%s">Preview Lesson</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_lesson' );
