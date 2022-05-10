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

function themeum_lms_post_type_course()
{
	$labels = array( 
		'name'                	=> _x( 'Courses', 'Courses', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Course', 'Course', 'themeum-lms' ),
		'menu_name'           	=> __( 'Courses', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Course:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Courses', 'themeum-lms' ),
		'view_item'           	=> __( 'View Course', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Course', 'themeum-lms' ),
		'add_new'             	=> __( 'New Course', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Course', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Course', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Course', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> 'edit.php?post_type=course',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail','comments'),
		'taxonomies' 			=> array('post_tag')
		);

	register_post_type('course',$args);

}

add_action('init','themeum_lms_post_type_course');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_course( $messages )
{
	global $post, $post_ID;

	$message['course'] = array(
		0 => '',
		1 => sprintf( __('Course updated. <a href="%s">View Course</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Course updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Course restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Course published. <a href="%s">View Course</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Course saved.', 'themeum-lms' ),
		8 => sprintf( __('Course submitted. <a target="_blank" href="%s">Preview Course</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Course scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Course</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Course draft updated. <a target="_blank" href="%s">Preview Course</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_course' );


/**
 * Register Course Category Taxonomies
 *
 * @return void
 */

function themeum_lms_register_course_cat_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Course Categories', 'taxonomy general name', 'themeum-lms' ),
		'singular_name'     	=> _x( 'Course Category', 'taxonomy singular name', 'themeum-lms' ),
		'search_items'      	=> __( 'Search Course Category', 'themeum-lms' ),
		'all_items'         	=> __( 'All Course Category', 'themeum-lms' ),
		'parent_item'       	=> __( 'Course Parent Category', 'themeum-lms' ),
		'parent_item_colon' 	=> __( 'Course Parent Category:', 'themeum-lms' ),
		'edit_item'         	=> __( 'Edit Course Category', 'themeum-lms' ),
		'update_item'       	=> __( 'Update Course Category', 'themeum-lms' ),
		'add_new_item'      	=> __( 'Add New Course Category', 'themeum-lms' ),
		'new_item_name'     	=> __( 'New Course Category Name', 'themeum-lms' ),
		'menu_name'         	=> __( 'Course Category', 'themeum-lms' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('course_cat',array( 'course' ),$args);
}

add_action('init','themeum_lms_register_course_cat_taxonomy');




