<?php
/**
 * Plugins Settings List
 *
 * @author 		Themeum
 * @category 	Admin Settings
 * @package 	Varsity
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


/**
 * Lessons list Page Template
 *
 * @return string
 */

add_filter( 'page_template', 'themeum_lms_lesson_page_template' );

function themeum_lms_lesson_page_template( $page_template )
{
	if ( is_page( 'lessons' ) ) {
		$page_template = dirname( __FILE__ ) . '/templates/page-lessons.php';
	}

	return $page_template;
}



/**
 * Course Single Template
 *
 * @return string
 */

function themeum_lms_course_template($single_template) {
	global $post;

	if ($post->post_type == 'course') {
		$single_template = dirname( __FILE__ ) . '/templates/course-template.php';
	}
	
	return $single_template;
}

add_filter( "single_template", "themeum_lms_course_template" ) ;


/**
 * Lesson Single Template
 *
 * @return string
 */

function themeum_lms_lesson_template($single_template) {
	global $post;

	if ($post->post_type == 'lesson') {
		$single_template = dirname( __FILE__ ) . '/templates/lesson-template.php';
	}
	
	return $single_template;
}

add_filter( "single_template", "themeum_lms_lesson_template" ) ;


/**
 * Teacher Single Template
 *
 * @return string
 */

function themeum_lms_teacher_template($single_template) {
	global $post;

	if ($post->post_type == 'teacher') {
		$single_template = dirname( __FILE__ ) . '/templates/teacher-template.php';
	}
	
	return $single_template;
}

add_filter( "single_template", "themeum_lms_teacher_template" ) ;


/**
 * Student Single Template
 *
 * @return string
 */

function themeum_lms_student_template($single_template) {
	global $post;

	if ($post->post_type == 'student') {
		$single_template = dirname( __FILE__ ) . '/templates/student-template.php';
	}
	
	return $single_template;
}

add_filter( "single_template", "themeum_lms_student_template" ) ;


/**
 * Speaker Single Template
 *
 * @return string
 */

function themeum_lms_speaker_template($single_template) {
	global $post;

	if ($post->post_type == 'speaker') {
		$single_template = dirname( __FILE__ ) . '/templates/speaker-template.php';
	}
	
	return $single_template;
}

add_filter( "single_template", "themeum_lms_speaker_template" ) ;


/**
 * Event Single Template
 *
 * @return string
 */

function themeum_events_template($single_template) {
	global $post;

	if ($post->post_type == 'event') {
		$single_template = dirname( __FILE__ ) . '/templates/event-template.php';
	}
	
	return $single_template;
}

add_filter( "single_template", "themeum_events_template" ) ;



add_action('admin_enqueue_scripts', function(){
	wp_enqueue_style('themeum-lms', plugins_url( ) .'/themeum-lms/assets/css/admin.css');
});
