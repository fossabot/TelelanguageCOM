<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_student_page_listing', function($atts, $content = null){
	global $count_post;
  	extract(shortcode_atts(array(
    	"title" 		=>'',
    	'count_post' 	=>6,
    	'column'		=>'4',
    	'class' 		=>'',
    	'student_cat'	=>'themeumall'
    ), $atts));

	function student_parse_query(&$q){
		global $count_post;
		$q->set( 'posts_per_page', $count_post );
		return $q;
	}

    add_filter('parse_query','student_parse_query');

  	global $post;
  	$temp_post = $post;
  	$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
  	
	$args = '';  	
  	if( $student_cat != 'themeumall' ){	
		$args = array(
					'post_type' => 'student',
					'tax_query' => array(
										array(
											'taxonomy' => 'student_cat',
											'field'    => 'slug',
											'terms'    => $student_cat,
										),
									),
					'order' => 'ASC',
					'paged' => $paged
			    );
  	}else{
  		$args = array(
			'post_type' => 'student',
			'order' => 'ASC',
			'paged' => $paged
    	);
  	}



  	

  	$student = new WP_Query($args);
  	$output = '<div class="themeum-teacher-listing ' . esc_attr($class) .'">';
 	if($title) $output .= '<h3 class="heading">' . esc_html($title) . '</h3>';


	if ( $student->have_posts() ) 
	{
		$output .= '<div class="row">';		
			while($student->have_posts()) 
			{

				$student->the_post();

				$email 			= get_post_meta(get_the_ID(),'themeum_student_email',true);
				$phone   	 	= get_post_meta(get_the_ID(),'themeum_student_phone',true);
				$address   	 	= get_post_meta(get_the_ID(),'themeum_student_address',true);
				$course   	 	= get_post_meta(get_the_ID(),'themeum_student_course',true);


				$facebook 		= get_post_meta(get_the_ID(),'themeum_student_facebook',true);
				$twitter   	 	= get_post_meta(get_the_ID(),'themeum_student_twitter',true);
				$gplus   	 	= get_post_meta(get_the_ID(),'themeum_student_gplus',true);
				$youtube   	 	= get_post_meta(get_the_ID(),'themeum_student_youtube',true);


				$output .= '<div class="teachers-listing col-xs-12 col-sm-6 col-md-'.$column.'">';
						$output .= '<figure class="team-member">';

		                 	if ( has_post_thumbnail() && ! post_password_required() ) 
		                 	{
							   $output .=  get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive'));
							   $output .=  '<div></div>';
							}else 
							{
								$output .= '<div class="no-image" style="height:230px;width:100%"></div>';
								$output .=  '<div></div>';
							}
							$output .= '<figcaption>';
								$output .= '<h3 class="person-title"><a href="' .get_permalink($post->ID).'">' .get_the_title(). '</a></h3>';

								if ($email) 
								{
									$output .= '<span class="person-deg">'.sanitize_email($email). '</span>';
								}

								if ($phone) 
								{
									$output .= '<p>' .esc_url($phone). '</p>';
								}

								if ($address) 
								{
								$output .= '<p>' .sanitize_email($address). '</p>';
								}

								if ($course) 
								{
								 $output .= '<p>' .$course. '</p>';
								}

								$output .= '<div class="person-social">';	
									$output .= '<ul class="social-person">';

										if( $facebook ) 
										{
										$output .= '<li><a href="' .esc_url($facebook). '"><i class="fa fa-facebook"></i></a></li>';
										}

										if( $gplus ) 
										{
										$output .= '<li><a href="' .esc_url($gplus). '"><i class="fa fa-google-plus"></i></a></li>';
										}

										if( $twitter ) 
										{
										$output .= '<li><a href="' .esc_url($twitter). '"><i class="fa fa-twitter"></i></a></li>';
										}

										if( $youtube ) 
										{
										$output .= '<li><a href="' .esc_url($youtube). '"><i class="fa fa-youtube"></i></a></li>';
										}
									$output .= '</ul>';
								$output .= '</div>'; //person social
							$output .= '</figcaption>';
		                $output .= '</figure>';
				$output .= '</div>'; //teachers-listing
			}
		$output .= '</div>'; //row
	}
	
	// pagination 
	ob_start();
	themeum_pagination($student->max_num_pages);
	$output .= ob_get_contents();
	ob_clean();

	$output .= '</div>';
	$post = $temp_post;
	wp_reset_query();
	remove_filter('parse_query','student_parse_query');
	return $output;
     
}); 


//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Student Listing", "themeum-lms"),
    "base" => "themeum_student_page_listing",
    'icon' => 'icon-thm-student-listing',
    "class" => "",
    "description" => __("Student Listing", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(        

	array(
		"type" => "textfield",
		"heading" => __("Student Page Title", "themeum-lms"),
		"param_name" => "title",
		"value" => "",
	),  

	array(
		"type" => "dropdown",
		"heading" => __("Select Student Category:","themeum"),
		"param_name" => "student_cat",
		"value" => themeum_cat_list( 'student_cat' )
	),


	array(
		"type" => "textfield",
		"heading" => __("Number of Post", "themeum-lms"),
		"param_name" => "count_post",
		"value" => "6",
	),          

	array(
		"type" => "dropdown",
		"heading" => __("Button Font Wight", "themeum-lms"),
		"param_name" => "column",
		"value" => array('Select'=>'','column 2'=>'6','column 3'=>'4','column 4'=>'3'),
	),	                 

	array(
		"type" => "textfield",
		"heading" => __("Custom Class", "themeum-lms"),
		"param_name" => "class",
		"value" => "",
	),

	)

    ));
}



