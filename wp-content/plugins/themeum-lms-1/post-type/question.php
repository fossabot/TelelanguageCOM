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
 * Register post type Question
 *
 * @return void
 */

function themeum_lms_post_type_question()
{
	$labels = array( 
		'name'                	=> _x( 'Questions', 'Questions', 'themeum-lms' ),
		'singular_name'       	=> _x( 'Question', 'Question', 'themeum-lms' ),
		'menu_name'           	=> __( 'Questions', 'themeum-lms' ),
		'parent_item_colon'   	=> __( 'Parent Question:', 'themeum-lms' ),
		'all_items'           	=> __( 'All Question', 'themeum-lms' ),
		'view_item'           	=> __( 'View Question', 'themeum-lms' ),
		'add_new_item'        	=> __( 'Add New Question', 'themeum-lms' ),
		'add_new'             	=> __( 'New Question', 'themeum-lms' ),
		'edit_item'           	=> __( 'Edit Question', 'themeum-lms' ),
		'update_item'         	=> __( 'Update Question', 'themeum-lms' ),
		'search_items'        	=> __( 'Search Question', 'themeum-lms' ),
		'not_found'           	=> __( 'No article found', 'themeum-lms' ),
		'not_found_in_trash'  	=> __( 'No article found in Trash', 'themeum-lms' )
		);

	$args = array(  
		'labels'             	=> $labels,
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		/* 'show_in_menu'       	=> 'edit.php?post_type=question', */
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type('question',$args);

}

add_action('init','themeum_lms_post_type_question');


/**
 * View Message When Updated Question
 *
 * @param array $messages Existing post update messages.
 * @return array
 */

function themeum_lms_update_message_question( $messages )
{
	global $post, $post_ID;

	$message['question'] = array(
		0 => '',
		1 => sprintf( __('Question updated. <a href="%s">View Question</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'themeum-lms' ),
		3 => __('Custom field deleted.', 'themeum-lms' ),
		4 => __('Question updated.', 'themeum-lms' ),
		5 => isset($_GET['revision']) ? sprintf( __('Question restored to revision from %s', 'themeum-lms' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Question published. <a href="%s">View Question</a>', 'themeum-lms' ), esc_url( get_permalink($post_ID) ) ),
		7 => __('Question saved.', 'themeum-lms' ),
		8 => sprintf( __('Question submitted. <a target="_blank" href="%s">Preview Question</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Question scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Question</a>', 'themeum-lms' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Question draft updated. <a target="_blank" href="%s">Preview Question</a>', 'themeum-lms' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		);

return $message;
}

add_filter( 'post_updated_messages', 'themeum_lms_update_message_question' );



/**
 * Register Question Category Taxonomies
 *
 * @return void
 */

function themeum_lms_register_question_cat_taxonomy(){
	$labels = array(
		'name'              	=> _x( 'Question Categories', 'taxonomy general name', 'themeum-lms' ),
		'singular_name'     	=> _x( 'Question Category', 'taxonomy singular name', 'themeum-lms' ),
		'search_items'      	=> __( 'Search Question Category', 'themeum-lms' ),
		'all_items'         	=> __( 'All Questions Category', 'themeum-lms' ),
		'parent_item'       	=> __( 'Question Parent Category', 'themeum-lms' ),
		'parent_item_colon' 	=> __( 'Question Parent Category:', 'themeum-lms' ),
		'edit_item'         	=> __( 'Edit Question Category', 'themeum-lms' ),
		'update_item'       	=> __( 'Update Question Category', 'themeum-lms' ),
		'add_new_item'      	=> __( 'Add New Question Category', 'themeum-lms' ),
		'new_item_name'     	=> __( 'New Question Category Name', 'themeum-lms' ),
		'menu_name'         	=> __( 'Question Category', 'themeum-lms' )
		);

	$args = array(
		'hierarchical'      	=> true,
		'labels'            	=> $labels,
		'show_in_nav_menus' 	=> true,
		'show_ui'           	=> true,
		'show_admin_column' 	=> true,
		'query_var'         	=> true
		);

	register_taxonomy('question_cat',array( 'question' ),$args);
}

add_action('init','themeum_lms_register_question_cat_taxonomy');
