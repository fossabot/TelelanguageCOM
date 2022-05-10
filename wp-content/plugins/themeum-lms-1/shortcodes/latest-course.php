<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Performer Scroller
add_shortcode( 'lms_latest_course', function($atts, $content = null){

	extract(shortcode_atts(array(
		"title" 		=> '',
		'count'			=> '8',
		'class'			=> '',
		'course_cat'	=> 'themeumall',
		), $atts));


	global $post;

	$args = '';  	
  	if( $course_cat != 'themeumall' ){
		
		$args = array(
					'post_type' => 'course',
					'tax_query' => array(
										array(
											'taxonomy' => 'course_cat',
											'field'    => 'slug',
											'terms'    => $course_cat,
										),
									),
					'showposts' => $count,
					'order' 	=> 'ASC',
					'orderby' 	=> 'menu_order'
			    );

  	}else{
  		$args = array( 
					'post_type' => 'course',
					'showposts' => $count,
					'order' => 'ASC',
					'orderby' => 'menu_order'
					); 
  	}




	$courses = get_posts( $args );

	$output = '<div class="themeum-lms-latest-ourse ' . $class .'">';

	if($title) {
		$output .= '<div class="latest-course-title">';
		$output .= '<h3 class="heading">' . esc_attr($title) . '</h3>';
		$output .= '<div class="owl-controls latest-course-control">';
		$output .= '<a class="owl-control latestCoursePrev"><span><i class="fa fa-angle-left"></i></span></a>';
		$output .= '<a class="owl-control latestCourseNext"><span><i class="fa fa-angle-right"></i></span></a>';
		$output .= '</div>';
		$output .= '</div>';
	}

	$output .= '<div id="carousel-latest-course" class="owl-carousel owl-theme">';

	foreach ($courses as $key=>$post) {

		setup_postdata( $post );

		$course_price 				= get_post_meta(get_the_ID(),'themeum_course_price',true);
		$course_lesson_number 		= get_post_meta(get_the_ID(),'themeum_course_lesson_number',true);
		$themeum_course_attachment 	= get_post_meta(get_the_ID(),'themeum_course_attachment',true);

	          $output .= '<div class="themeumlms-course-wrap">';

	              if ( has_post_thumbnail() && ! post_password_required() ){
	              $output .= '<figure class="themeumlms-course-img">';
	              $output .=  get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('class' => 'img-responsive'));
	              $output .= '<figcaption class="text-center">';
	                  $output .= '<a href="'.get_the_permalink().'">';
	                                $output .= __('Details','themeum-lms');
	                            $output .= '</a>';
	              $output .= '</figcaption>';
	              $output .= '</figure>';
	              }else {
	              $output .= '<figure class="themeumlms-course-none">';
	                $output .= '<figcaption class="text-center">';
	                    $output .= '<a href="'.get_the_permalink().'">';
	                                  $output .= __('Details','themeum-lms');
	                              $output .= '</a>';
	                $output .= '</figcaption>';
	              $output .= '</figure>';
	              }

	              $output .= '<div class="details">';
	                $output .= '<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
	                $output .= '<h4> '.__('by','themeum-lms').' <strong>'.get_the_author().' </strong></h4>';
	                $output .= '<p>'.the_excerpt_max_charlength(50).'</p>';
	                
	                $currency_array = array('AUD' => '$','BRL' => 'R$','CAD' => '$','CZK' => 'Kč','DKK' => 'kr.','EUR' => '€','HKD' => 'HK$','HUF' => 'Ft','ILS' => '₪','JPY' => '¥','MYR' => 'RM','MXN' => 'Mex$','NOK' => 'kr','NZD' => '$','PHP' => '₱','PLN' => 'zł','GBP' => '£','RUB' => '₽','SGD' => '$','SEK' => 'kr','CHF' => 'CHF','TWD' => '角','THB' => '฿','TRY' => 'TRY','USD' => '$');
					$symbol = '';
					$currency_type = get_option('paypal_curreny_code');
					if (array_key_exists( $currency_type , $currency_array)) {
					    $symbol = $currency_array[$currency_type];
					}else{
						 $symbol = '$';
					}
	                
	                if ( $course_price || $course_lesson_number || $themeum_course_attachment ) { 
	                  $output .= '<div class="course-details-span">';
	                    if($course_price) {
	                      $output .= '<span>' .esc_html($symbol). '' .esc_html($course_price). '</span>';
	                    } else {
	                      $output .= '<span>' .__('Free', 'themeum-lms'). '</span>';
	                    }
	                    if( $course_lesson_number != "" ){
	                      $output .= '<span>'.esc_html($course_lesson_number). '</span>'; 
	                    }
	                    if( $themeum_course_attachment != "" ){ 
	                      $output .= '<span>'.esc_html($themeum_course_attachment). '</span>';  
	                    }
	                  $output .= '</div>';
	                }
	              $output .= '</div>'; //details

	          $output .= '</div>'; // themeumlms-course-wrap
						
	}

	wp_reset_postdata();


	$output .= '</div>';//#carousel-performer
	$output .= '</div>';

	return $output;
});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Latest Course", "themeum-lms"),
		"base" => "lms_latest_course",
		'icon' => 'icon-wpb-latest-course',
		"class" => "",
		"description" => "Latest Course",
		"category" => __("Themeum", "themeum-lms"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Title", "vocal-event"),
				"param_name" => "title",
				"description" => __("Latest Course", "themeum-lms"),
				"value" => "",
				"admin_label"=>true,
				),


			array(
				"type" => "dropdown",
				"heading" => __("Select Course Category:","themeum"),
				"param_name" => "course_cat",
				"value" => themeum_cat_list( 'course_cat' )
				),


			array(
				"type" => "textfield",
				"heading" => __("Count", "themeum-lms"),
				"param_name" => "count",
				"description" => __("Enter the number of performers you want to display.", "themeum-lms"),
				"value" => 8, 
				),


			array(
				"type" => "textfield",
				"heading" => __("Extra CSS Class", "themeum-lms"),
				"param_name" => "class",
				"value" => "",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.","themeum-lms")
				),

			)

));
}

