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
 * Register post type Teacher
 *
 * @return void
 */

function themeum_lms_post_type_teacher()
{
	$labels = array( 
		'name'                	=> _x( 'Teachers', 'Teachers', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Teacher', 'Teacher', 'themeum-lms' ),
		'menu_name'           	=> __( 'Teachers', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Teacher:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Teacher', 'themeum-lms' ),
		'view_item'           	=> __( 'View Teacher', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Teacher', 'themeum-lms' ),
		'add_new'             	=> __( 'New Teacher', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Teacher', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Teacher', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Teacher', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> 'edit.php?post_type=teacher',
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type('teacher',$args);

}

add_action('init','themeum_lms_post_type_teacher');


/**
 * View Message When Updated Project
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_teacher( $messages )
{
	global $post, $post_ID;

	$message['teacher'] = array(
		0 => '',
		1 => sprintf( __('Teacher updated. <a href="%s">View Teacher</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Teacher updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Teacher restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Teacher published. <a href="%s">View Teacher</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Teacher saved.', 'themeum-lms' ),
		8 => sprintf( __('Teacher submitted. <a target="_blank" href="%s">Preview Teacher</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Teacher scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Teacher</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Teacher draft updated. <a target="_blank" href="%s">Preview Teacher</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_teacher' );



/**
 * Register Teacher Category Taxonomies
 *
 * @return void
 */

function themeum_lms_register_teacher_cat_taxonomy()
{
	$labels = array(
		'name'              	=> _x( 'Teacher Categories', 'taxonomy general name', 'themeum-lms' ),
		'singular_name'     	=> _x( 'Teacher Category', 'taxonomy singular name', 'themeum-lms' ),
		'search_items'      	=> __( 'Search Teacher Category', 'themeum-lms' ),
		'all_items'         	=> __( 'All Teacher Category', 'themeum-lms' ),
		'parent_item'       	=> __( 'Teacher Parent Category', 'themeum-lms' ),
		'parent_item_colon' 	=> __( 'Teacher Parent Category:', 'themeum-lms' ),
		'edit_item'         	=> __( 'Edit Teacher Category', 'themeum-lms' ),
		'update_item'       	=> __( 'Update Teacher Category', 'themeum-lms' ),
		'add_new_item'      	=> __( 'Add New Teacher Category', 'themeum-lms' ),
		'new_item_name'     	=> __( 'New Teacher Category Name', 'themeum-lms' ),
		'menu_name'         	=> __( 'Teacher Category', 'themeum-lms' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('teacher_cat',array( 'teacher' ),$args);
}

add_action('init','themeum_lms_register_teacher_cat_taxonomy');


