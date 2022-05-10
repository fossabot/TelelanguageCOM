<?php
/**
 * Plugin Name: Themeum LMS
 * Plugin URI: http://www.themeum.com
 * Description: Themeum LMS is ultimate event plugins
 * Author: Themeum
 * Version: 2.1
 * Author URI: http://www.themeum.com
 *
 * Tested up to: 4.0
 * Text Domain: themeum-lms
 *
 * @package Themeum LMS
 * @category Core
 * @author Varsity
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Language File Loaded.
add_action( 'plugins_loaded', 'myplugin_load_textdomain' );
function myplugin_load_textdomain(){
  load_plugin_textdomain( 'themeum-lms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

if(!function_exists('rwmb_meta')){ 
// Metabox Include
include_once( 'post-type/meta_box.php' );
include_once( 'post-type/meta-box/meta-box.php' );
}

/*
 * Include required core files used in admin and on the frontend.
 */

//Register Post Type
include_once( 'post-type/lesson.php' );
include_once( 'post-type/course.php' );
include_once( 'post-type/meta_box.php' );
include_once( 'post-type/speaker.php' );
include_once( 'post-type/teacher.php' );
include_once( 'post-type/student.php' );
include_once( 'post-type/question.php' );
include_once( 'post-type/order.php' );
include_once( 'post-type/event.php' );


//Shortcodes
include_once( 'shortcodes/event.php' );
include_once( 'shortcodes/event-listing.php' );
include_once( 'shortcodes/latest-course.php' );
include_once( 'shortcodes/free-courses.php' );
include_once( 'shortcodes/feature-course.php' );
include_once( 'shortcodes/popular-course.php' );
include_once( 'shortcodes/course-category.php' );
include_once( 'shortcodes/course-listing.php' );
include_once( 'shortcodes/teacher-listing.php' );
include_once( 'shortcodes/student-listing.php' );
include_once( 'shortcodes/speaker-listing.php' );
include_once( 'shortcodes/home-search.php' );
include_once( 'shortcodes/tiny-slider.php' );

//Admin Menu
include_once( 'admin/menus.php' );
include_once( 'admin/dashboard.php' );
/* add shortcode files */

/* Include settings */
include_once( 'themeum_lms_settings.php' );
/* define metaboxes */

/* Add Themeum Payment */
include_once( 'payment/themeum_payment_lms.php' );

// List of Group
function themeum_cat_list( $category ){
    global $wpdb;
    $sql = "SELECT * FROM `".$wpdb->prefix."term_taxonomy` INNER JOIN `".$wpdb->prefix."terms` ON `".$wpdb->prefix."term_taxonomy`.`term_taxonomy_id`=`".$wpdb->prefix."terms`.`term_id` AND `".$wpdb->prefix."term_taxonomy`.`taxonomy`='".$category."'";
    $results = $wpdb->get_results( $sql );

    $cat_list = array();
    $cat_list['All'] = 'themeumall';  
    if(is_array($results)){
        foreach ($results as $value) {
            $cat_list[$value->name] = $value->slug;
        }
    }
    return $cat_list;
}