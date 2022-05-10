<?php
/**
 * Admin feature for Custom Meta Box
 *
 * @author 		Themeum
 * @category 	Admin Core
 * @package 	Varsity
 *-------------------------------------------------------------*/


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Registering meta boxes
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

add_filter( 'rwmb_meta_boxes', 'themeum_lms_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */

function themeum_lms_register_meta_boxes( $meta_boxes )
{

	global $woocommerce;

	$event_category = get_all_terms_by_taxonomy('event_cat');
	$course_category = get_all_terms_by_taxonomy('course_cat');

	$lessons_course = get_all_posts('course');

	//$student_quiz = get_all_posts('question');

	$courses = get_posts( array(
		'posts_per_page'   => -1,
		'offset'           => 0,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'post_type'        => 'course',
		'post_status'      => 'publish',
		'suppress_filters' => true 
	) );

	$list_courses = array();

	$courses_title = array();

	foreach ($courses as $post) {
		$list_courses[$post->ID] = $post->post_title;
		$courses_title[$post->post_title] = $post->post_title;
	}
	

	$lessons_teacher = get_all_posts('teacher');
	$course_teachers = get_all_posts('teacher');
	$event_speaker = get_all_posts('speaker');
	$course_lessons = get_all_posts('lesson');
	//$all_order = get_all_posts('lmsorder');

	if($woocommerce) {
		$products 	= get_all_posts('product');
	} else {
		$products  	= array();
	}

	function themeum_get_all_author(){
	        $authors = get_users('orderby=display_name&order=DESC');
	        $user_name = array();
	        foreach ($authors as $author) {
	            $user_name[$author->ID] = $author->user_login;
	        }
	        return $user_name;
	    }
	
	/**
	 * Prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'themeum_';

	/**
	 * Register Post Meta for Course Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'course-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Course Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'course'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(

			array(
				'name'          => __( 'Course Sub Name', 'themeum-lms' ),
				'id'            => "{$prefix}course_sub_name",
				'desc'			=> __( 'Add Course Sub Name Ex. Management', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),

//---------- Course Clone Start ---------						
// Group
array(
    'name' => '', // Optional
    'id' => 'course_list',
    'type'   => 'group',
    'clone'  => true,
    'fields' => array(

		array(
			'name'          => __( 'Course Lessons Category', 'themeum-lms' ),
			'id'            => "{$prefix}course_category",
			'type'          => 'text',
			'std'           => ''
		),

    	array(
			'name'	=> __( 'Course Lessons Category Description', 'themeum-lms' ),
			'id'	=> "{$prefix}course_description",
			'type'	=> 'textarea',
			'std'	=> ''
		),

        array(
			'name'  		=> __( 'Course Lessons', 'themeum-lms' ),
			'id'    		=> "{$prefix}course_lessons",
			'desc'  		=> '',
			'type'     		=> 'select_advanced',
			'options'  		=> $course_lessons,
			'multiple'    	=> true,
			'placeholder' 	=> __( 'Select Lessons', 'themeum-lms' ),
		),

        ),
 	),
//---------- Course Clone End -------
			/*
			array(
				'name'  		=> __( 'Course Lessons', 'themeum-lms' ),
				'id'    		=> "{$prefix}course_lessons",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $course_lessons,
				'multiple'    	=> true,
				'placeholder' 	=> __( 'Select Lessons', 'themeum-lms' ),
			),
			*/	

			array(
				'name'          => __( 'Number of Lessons', 'themeum-lms' ),
				'id'            => "{$prefix}course_lesson_number",
				'desc'			=> __( 'Number of Lesson Ex. 6 Lessons', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => '0 Lessons'
			),	

			array(
				'name'          => __( 'Attachment File', 'themeum-lms' ),
				'id'            => "{$prefix}course_attachment",
				'desc'			=> __( 'Number of Attachment File Ex. 3 Example Files', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => '0 Example Files'
			),									

			array(
				'name'  		=> __( 'Course Teacher', 'themeum-lms' ),
				'id'    		=> "{$prefix}course_teacher",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $course_teachers,
				'multiple'    	=> true,
				'placeholder' 	=> __( 'Select Teacher', 'themeum-lms' ),
			),			

			array(
				'name'  		=> __( 'Featured Course', 'themeum-lms' ),
				'id'    		=> "{$prefix}course_feature",
				'desc'  		=> __( 'Featured Course', 'themeum-lms' ),
				'type'  		=> 'checkbox',
				'std'   		=> 1
			),			

			array(
				'name'             => __( 'Featured Post BG Color', 'themeum-lms' ),
				'id'               => "{$prefix}feature_color",
				'desc'  		=> __( 'Featured Course Background Color', 'themeum-lms' ),
				'type'             => 'color',
				'std' 			   => "#444"
			),		

			array(
				'name'          => __( 'Course Price', 'themeum-lms' ),
				'id'            => "{$prefix}course_price",
				'desc'			=> __( 'Number of Price Ex. 30', 'themeum-lms' ),
				'type'          => 'number',
				'std'           => ''
			),				


			array(
				'name'  		=> __( 'Free Course', 'themeum-lms' ),
				'id'    		=> "{$prefix}free_feature",
				'desc'  		=> __( 'Free Course', 'themeum-lms' ),
				'type'  		=> 'checkbox',
				'std'   		=> 1
			),


			array(
				'name'        => __( 'Select Question Set', 'themeum-lms' ),
				'id'          => "{$prefix}quiz_set",
				'type'        => 'post',
				'post_type'   => 'question',
				'field_type'  => 'select_advanced',
				'placeholder' => __( 'Select Question Set', 'themeum-lms' ),
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				),
				'multiple'    	=> true,
			),


			array(
				'name'          => __( 'Total Course Time', 'themeum-lms' ),
				'id'            => "{$prefix}total_time",
				'desc'			=> __( 'Ex: 104hr 30min', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),

			array(
				'name'          => __( 'Watch Trailer URL', 'themeum-lms' ),
				'id'            => "{$prefix}watch_trailer",
				'type'          => 'text',
				'std'           => ''
			),			


		)
	);



	/**
	 * Register Post Meta for Course Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'event-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Event Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'event'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(	

			array(
				'name'  		=> __( 'Start Date and Time', 'themeum-lms' ),
				'id'    		=> "{$prefix}event_start_datetime",
				'desc'  		=> __( 'Event Start Date and Time', 'themeum-lms' ),
				'type'  		=> 'datetime',
				'std'   		=> ''
			),

			array(
				'name'  		=> __( 'Event End Date and Time', 'themeum-lms' ),
				'id'    		=> "{$prefix}event_end_datetime",
				'desc'  		=> __( 'Event Date and Time', 'themeum-lms' ),
				'type'  		=> 'datetime',
				'std'   		=> ''
			),

			array(
				'name'  		=> __( 'Event Speaker', 'themeum-lms' ),
				'id'    		=> "{$prefix}event_speaker",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $event_speaker,
				'multiple'    	=> true,
				'placeholder' 	=> __( 'Select Speaker', 'themeum-lms' ),
			),	

			array(
				'name'          => __( 'Event Price', 'themeum-lms' ),
				'id'            => "{$prefix}event_price",
				'desc'			=> __( 'Number of Price Ex. 30', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),						

			array(
				'name'  		=> __( 'Event Place', 'themeum-lms' ),
				'id'    		=> "{$prefix}event_place",
				'desc'  		=> __( 'Event Place', 'themeum-lms' ),
				'type'  		=> 'textarea',
				'std'   		=> ''
			),

			array(
				'name'          => __( 'Find Address', 'themeum-lms' ),
				'id'            => "{$prefix}event_location",
				'desc'			=> __( 'Just Write The Address and get map below', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => __( 'Dhaka, Bangladesh', 'themeum-lms' ),
			),

			array(
				'name'  		=> __( 'Location', 'themeum-lms' ),
				'id'    		=> "{$prefix}event_location_map",
				'desc'  		=> '',
				'type'  		=> 'map',
				'std'           => '23.709921,90.40714300000002,16',
				'style'         => 'width: 500px; height: 260px;',
				'address_field' => "{$prefix}event_location", 
			),		
					
		)
	);

	
	/**
	 * Register Post Meta for Lesson Post Type
	 *
	 * @return array
	 */


	$meta_boxes[] = array(
		'id' 		=> 'lesson-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Lesson Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'lesson'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(

			array(
				'name'          => __( 'Lesson Type *', 'themeum-lms' ),
				'id'            => "{$prefix}lesson_lesson_type",
				'desc'			=> __( 'Select Type Ex:Free/Paid', 'themeum-lms' ),
				'type'          => 'select',
				'std'           => 'free',
				'options' 		=> array(
						            'free'   => 'Free',
						            'paid'     => 'Paid',
						       		 )
			),

			array(
				'name'          => __( 'Video File', 'themeum-lms' ),
				'id'            => "{$prefix}lesson_video_file",
				'desc'			=> __( 'Add Video File(MP4 Format)', 'themeum-lms' ),
				'type'          => 'file_advanced',
				'max_file_uploads'=> 1
			),

			array(
				'name'  		=> __( 'Lesson Video URL', 'themeum-lms' ),
				'id'    		=> "{$prefix}lesson_video_url",
				'desc'  		=> __( 'Youtube/vimeo Url. e.g. https://www.youtube.com/watch?v=dqRzj05CySA', 'themeum-lms' ),
				'type'  		=> 'url',
				'std'   		=> ''
			),	

			array(
				'name'          => __( 'Lesson Attachment', 'themeum-lms' ),
				'id'            => "{$prefix}lesson_attachment",
				'desc'			=> __( 'Lesson Attachment)', 'themeum-lms' ),
				'type'          => 'file_advanced'
			),	



			array(
				'name'          => __( 'Video Duration', 'themeum-lms' ),
				'id'            => "{$prefix}lesson_duration",
				'desc'			=> __( 'Video Duration Ex. 30', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),			

		)
	);



	/**
	 * Register Post Meta for Teacher Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'teacher-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Teacher Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'teacher'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(

			array(
				'name'  		=> __( 'Teacher Website', 'themeum-lms' ),
				'id'    		=> "{$prefix}teacher_website",
				'desc'  		=> __( 'Soundcloud Playlist Url. e.g. https://www.example.com/', 'themeum-lms' ),
				'type'  		=> 'url',
				'std'   		=> ''
			),	

			array(
				'name'          => __( 'Teacher Email', 'themeum-lms' ),
				'id'            => "{$prefix}teacher_email",
				'desc'			=> __( 'Add Teacher Email', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),			

			array(
				'name'          => __( 'Teacher Experience', 'themeum-lms' ),
				'id'            => "{$prefix}teacher_experience",
				'desc'			=> __( 'Add Teacher Experience', 'themeum-lms' ),
				'type'          => 'textarea',
				'std'           => ''
			),	

			array(
				'name'          => __( 'Teacher Specialized In', 'themeum-lms' ),
				'id'            => "{$prefix}teacher_specialist",
				'desc'			=> __( 'Add Teacher Specialist In', 'themeum-lms' ),
				'type'          => 'textarea',
				'std'           => ''
			),	

			array(
				'name'  		=> __( 'Lesson Course', 'themeum-lms' ),
				'id'    		=> "{$prefix}teacher_lesson_course",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $lessons_course,
				'multiple'    	=> true,
				'placeholder' 	=> __( 'Select Course', 'themeum-lms' ),
			),

			array(
				'name'  		=> __( 'Facebook', 'themeum-lms' ),
				'id'    		=> "{$prefix}teacher_facebook",
				'desc'  		=> __( 'Facebook Profile Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			array(
				'name'  		=> __( 'Twitter', 'themeum-lms' ),
				'id'    		=> "{$prefix}teacher_twitter",
				'desc'  		=> __( 'Twitter Profile Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			array(
				'name'  		=> __( 'Gplus', 'themeum-lms' ),
				'id'    		=> "{$prefix}teacher_gplus",
				'desc'  		=> __( 'Google Plus Profile Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			array(
				'name'  		=> __( 'YouTube', 'themeum-lms' ),
				'id'    		=> "{$prefix}teacher_youtube",
				'desc'  		=> __( 'Youtube Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			)						
		)
	);
	


	/**
	 * Register Post Meta for Student Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'student-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Student Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'student'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(


			array(
				'name'          => __( 'Student Email', 'themeum-lms' ),
				'id'            => "{$prefix}student_email",
				'desc'			=> __( 'Add Student Email', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),			

			array(
				'name'          => __( 'Student Phone', 'themeum-lms' ),
				'id'            => "{$prefix}student_phone",
				'desc'			=> __( 'Add Student Phone', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),	

			array(
				'name'          => __( 'Student Address', 'themeum-lms' ),
				'id'            => "{$prefix}student_address",
				'desc'			=> __( 'Add Student Address', 'themeum-lms' ),
				'type'          => 'textarea',
				'std'           => ''
			),


			array(
				'name'  		=> __( 'Student Course', 'themeum-lms' ),
				'id'    		=> "{$prefix}student_course",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $list_courses, 
				'multiple'    	=> true,
				'placeholder' 	=> __( 'Select Course', 'themeum-lms' ),
			),

			array(
				'name'  		=> __( 'Facebook', 'themeum-lms' ),
				'id'    		=> "{$prefix}student_facebook",
				'desc'  		=> __( 'Facebook Profile Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			array(
				'name'  		=> __( 'Twitter', 'themeum-lms' ),
				'id'    		=> "{$prefix}student_twitter",
				'desc'  		=> __( 'Twitter Profile Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			array(
				'name'  		=> __( 'Gplus', 'themeum-lms' ),
				'id'    		=> "{$prefix}student_gplus",
				'desc'  		=> __( 'Google Plus Profile Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			array(
				'name'  		=> __( 'YouTube', 'themeum-lms' ),
				'id'    		=> "{$prefix}student_youtube",
				'desc'  		=> __( 'Youtube Url', 'themeum-lms' ),
				'type'  		=> 'text',
				'std'   		=> ''
			),
			
			array(
				'name'  		=> __( 'User Name', 'themeum-lms' ),
				'id'    		=> "{$prefix}user_name",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> themeum_get_all_author(),
				'multiple'    	=> false,
				'placeholder' 	=> __( 'Select User Name', 'themeum-lms' ),
			),


							
		)
	);
	



	/**
	 * Register Post Meta for Speaker Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'speaker-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Speaker Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'speaker'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(

			array(
				'name'          => __( 'Designation', 'themeum-lms' ),
				'id'            => "{$prefix}speaker_designation",
				'desc'			=> __( 'Add Speaker Designation', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),	

			array(
				'name'  		=> __( 'Speaker Website', 'themeum-lms' ),
				'id'    		=> "{$prefix}speaker_website",
				'desc'  		=> __( 'Soundcloud Playlist Url. e.g. https://www.example.com/', 'themeum-lms' ),
				'type'  		=> 'url',
				'std'   		=> ''
			),	

			array(
				'name'          => __( 'Speaker Email', 'themeum-lms' ),
				'id'            => "{$prefix}speaker_email",
				'desc'			=> __( 'Add Speaker Email', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),								
					
		)
	);





	/**
	 * Register Post Meta for Question Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'question-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Question Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'question'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(	
	
						// Group
				        array(
				            'name' => 'Answer of the Question', // Optional
				            'id' => 'question_id',
				            'type'   => 'group',
				            'clone'  => true,
				            'fields' => array(

				            	array(
									'name'	=> __( '', 'themeum-lms' ),
									'id'	=> "question_no",
									'desc'	=> __( 'Add The Question', 'themeum-lms' ),
									'type'	=> 'textarea',
									'std'	=> ''
								),

				                array(
				                    'name'	=> '',
				                    'id'	=> 'ans_number1',
									'desc'	=> __( 'Add Answer 1', 'themeum-lms' ),
				                    'type'	=> 'text',
				                ),
				                array(
				                    'name'	=> '',
				                    'id'	=> 'ans_number2',
				                    'desc'	=> __( 'Add Answer 2', 'themeum-lms' ),
				                    'type'	=> 'text',
				                ),
				                array(
				                    'name'	=> '',
				                    'id'	=> 'ans_number3',
				                    'desc'	=> __( 'Add Answer 1', 'themeum-lms' ),
				                    'type'	=> 'text',
				                ),
				                array(
				                    'name'	=> '',
				                    'id'	=> 'ans_number4',
				                    'desc'	=> __( 'Add Answer 1', 'themeum-lms' ),
				                    'type'	=> 'text',
				                ),
				                array(
									'name'     => '',
									'id'       => "correct_answer",
									'type'     => 'select',
									'options'  => array(
										'1' => __( '1st Answer is Correct', 'themeum-lms' ),
										'2' => __( '2nd Answer is Correct', 'themeum-lms' ),
										'3' => __( '3rd Answer is Correct', 'themeum-lms' ),
										'4' => __( '4th Answer is Correct', 'themeum-lms' ),
									),
									'multiple'    => false,
									'desc'	=> __( 'Select Correct Answer', 'themeum-lms' ),
									'std'         => '1'
								),
								

				            ),
				        ),

						
						array(
		                    'name'	=> __( 'Total Time of Quiz(in minute ex: 35)', 'themeum-lms' ),
		                    'id'	=> 'quiz-time',
		                    'desc'	=> __( 'ex: 35', 'themeum-lms' ),
		                    'type'	=> 'text',
		                ),



		)
	);






	/**
	 * Register Post Meta for Order Post Type
	 *
	 * @return array
	 */

	$meta_boxes[] = array(
		'id' 		=> 'order-post-meta',

		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title' 	=> __( 'Order Item Settings', 'themeum-lms' ),

		// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
		'pages' 	=> array( 'lmsorder'),

		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' 	=> 'normal',

		// Order of meta box: high (default), low. Optional.
		'priority' 	=> 'high',

		// Auto save: true, false (default). Optional.
		'autosave' 	=> true,

		// List of meta fields
		'fields' 	=> array(
			
			array(
				'name'  		=> __( 'Product Name', 'themeum-lms' ),
				'id'    		=> "{$prefix}product_name",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $courses_title,
				'multiple'    	=> false,
				'placeholder' 	=> __( 'Select Course Title', 'themeum-lms' ),
			),


			array(
				'name'          => __( 'Order ID', 'themeum-lms' ),
				'id'            => "{$prefix}order_id",
				'desc'			=> __( 'Order Course ID Ex. 3', 'themeum-lms' ),
				'type'          => 'number',
				'std'           => ''
			),	


			array(
				'name'          => __( 'User ID', 'themeum-lms' ),
				'id'            => "{$prefix}order_user_id",
				'desc'			=> __( 'Order User ID Ex. 3', 'themeum-lms' ),
				'type'          => 'number',
				'std'           => ''
			),	
	
			array(
				'name'  		=> __( 'Course ID', 'themeum-lms' ),
				'id'    		=> "{$prefix}order_course_id",
				'desc'  		=> '',
				'type'     		=> 'select_advanced',
				'options'  		=> $list_courses,
				'multiple'    	=> false,
				'placeholder' 	=> __( 'Select Course', 'themeum-lms' ),
			),


			array(
				'name'          => __( 'Order Price', 'themeum-lms' ),
				'id'            => "{$prefix}order_price",
				'desc'			=> __( 'Order Price', 'themeum-lms' ),
				'type'          => 'number',
				'std'           => ''
			),	

			array(
				'name'          => __( 'Payment ID', 'themeum-lms' ),
				'id'            => "{$prefix}payment_id",
				'desc'			=> __( 'Payment ID Ex. 3', 'themeum-lms' ),
				'type'          => 'number',
				'std'           => ''
			),	

			array(
				'name'          => __( 'Payment Method', 'themeum-lms' ),
				'id'            => "{$prefix}payment_method",
				'desc'			=> __( 'Add Payment Method', 'themeum-lms' ),
				'type'          => 'text',
				'std'           => ''
			),		

			array(
				'name'          => __( 'Order Created', 'themeum-lms' ),
				'id'            => "{$prefix}order_created",
				'desc'			=> __( 'Order created', 'themeum-lms' ),
				'type'          => 'datetime',
				'std'           => ''
			),

			array(
				'name'  		=> __( 'Comments', 'themeum-lms' ),
				'id'    		=> "{$prefix}order_comments",
				'desc'  		=> __( 'Add Your Order Comments Here', 'themeum-lms' ),
				'type'  		=> 'textarea',
				'std'   		=> ''
			),

			array(
				'name'          => __( 'Order Status', 'themeum-lms' ),
				'id'            => "{$prefix}status_all",
				'desc'			=> __( 'Select Order Status', 'themeum-lms' ),
				'type'          => 'select',
				'std'           => 'pending',
				'options' 		=> array(
						            'pending '   => 'Pending',
						            'complete'   => 'Complete',
						            'refund'     => 'Refund',
						       		 )
			),	
					
		)
	);





	return $meta_boxes;
}


/**
 * Get list of post from any post type
 *
 * @return array
 */

function get_all_posts($post_type)
{
	$args = array(
			'post_type' => $post_type,  // post type name
			'posts_per_page' => -1,   //-1 for all post
		);

	$posts = get_posts($args);

	$post_list = array();

	if (!empty( $posts ))
	{
		foreach ($posts as $post)
		{
			setup_postdata($post);
			$post_list[$post->post_name] = $post->post_title;
		}
		wp_reset_postdata();
		return $post_list;
	}
	else
	{
		return $post_list;
	}	
}


/**
 * Get term list from Taxonomy
 *
 * @return array
 */
 
function get_all_terms_by_taxonomy( $taxonomy_name )
{
	$terms = get_terms($taxonomy_name ,array('hide_empty' => false));

	$term = array();

	if ( !empty( $terms ) && !is_wp_error( $terms ) )
	{
		foreach ($terms as $value) {
			$term[$value->slug] = $value->name;
		}
		return $term;
	}
	else
	{
		return $term;
	}
}


