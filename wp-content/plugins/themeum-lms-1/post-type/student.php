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
 * Register post type Student
 *
 * @return void
 */

function themeum_lms_post_type_student()
{
	$labels = array( 
		'name'                	=> _x( 'Students', 'Students', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Student', 'Student', 'themeum-lms' ),
		'menu_name'           	=> __( 'Students', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Student:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Student', 'themeum-lms' ),
		'view_item'           	=> __( 'View Student', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Student', 'themeum-lms' ),
		'add_new'             	=> __( 'New Student', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Student', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Student', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Student', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> 'edit.php?post_type=student',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type('student',$args);

}

add_action('init','themeum_lms_post_type_student');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_student( $messages )
{
	global $post, $post_ID;

	$message['student'] = array(
		0 => '',
		1 => sprintf( __('Student updated. <a href="%s">View Student</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Student updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Student restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Student published. <a href="%s">View Student</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Student saved.', 'themeum-lms' ),
		8 => sprintf( __('Student submitted. <a target="_blank" href="%s">Preview Student</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Student scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Student</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Student draft updated. <a target="_blank" href="%s">Preview Student</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_student' );



/**
 * Register Student Category Taxonomies
 *
 * @return void
 */

function themeum_lms_register_student_cat_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Student Categories', 'taxonomy general name', 'themeum-lms' ),
		'singular_name'     	=> _x( 'Student Category', 'taxonomy singular name', 'themeum-lms' ),
		'search_items'      	=> __( 'Search Student Category', 'themeum-lms' ),
		'all_items'         	=> __( 'All Student Category', 'themeum-lms' ),
		'parent_item'       	=> __( 'Student Parent Category', 'themeum-lms' ),
		'parent_item_colon' 	=> __( 'Student Parent Category:', 'themeum-lms' ),
		'edit_item'         	=> __( 'Edit Student Category', 'themeum-lms' ),
		'update_item'       	=> __( 'Update Student Category', 'themeum-lms' ),
		'add_new_item'      	=> __( 'Add New Student Category', 'themeum-lms' ),
		'new_item_name'     	=> __( 'New Student Category Name', 'themeum-lms' ),
		'menu_name'         	=> __( 'Student Category', 'themeum-lms' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('student_cat',array( 'student' ),$args);
}

add_action('init','themeum_lms_register_student_cat_taxonomy');


