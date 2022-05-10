<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Performer Scroller
add_shortcode( 'lms_free_course', function($atts, $content = null){

	extract(shortcode_atts(array(
		'count'		=> '',
		'column'	=>'',
		'class'		=> ''
		), $atts));


	global $post;


	$args = array(
		'post_type' => 'course',
		'meta_query' => array(
			array(
				'key' => 'themeum_free_feature',
				'value' => '1',
				'compare' => '='
			)
		),
		'order' => 'DSC',
		'orderby' => 'date',
		'showposts' => esc_attr($count)
	 );
	$courses = new WP_Query( $args );


	$output = '<div class="themeum-lms-free-course ' . esc_attr($class) .'">';
	$output .= '<div class="row">';
		if ( $courses->have_posts() ) {

			while ( $courses->have_posts() ) {
			$courses->the_post();

			$course_price 				= get_post_meta(get_the_ID(),'themeum_course_price',true);
			$course_price_month 		= get_post_meta(get_the_ID(),'themeum_course_price_month',true);
			$themeum_course_attachment 	= get_post_meta(get_the_ID(),'themeum_course_attachment',true);
			$course_lesson_number		= get_post_meta(get_the_ID(),'themeum_course_lesson_number',true);

	          $output .= '<div class="col-xs-12 col-sm-'.esc_attr($column).'">';
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
	                    $output .= '<p>'.the_excerpt_max_charlength(70).'</p>';
	                    
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
	          $output .= '</div>'; // col-sm-6
			}
		}
		wp_reset_postdata();
	$output .= '</div>'; //row
	$output .= '</div>'; //themeum-lms-free-ourse

	return $output;
});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Free Course", "themeum-lms"),
		"base" => "lms_free_course",
		'icon' => 'icon-wpb-free-course',
		"class" => "",
		"description" => "Free Course",
		"category" => __("Themeum", "themeum-lms"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Count", "themeum-lms"),
				"param_name" => "count",
				"description" => __("Enter the number of performers you want to display.", "themeum-lms"),
				"value" => 3, 
				),

		      array(
		        "type" => "dropdown",
		        "heading" => __("Number Of Column:", "themeum"),
		        "param_name" => "column",
		        "value" => array('Select'=>'','column 2'=>'6','column 3'=>'4','column 4'=>'3'),
		        ),			

			array(
				"type" => "textfield",
				"heading" => __("Extra CSS Class", "themeum-lms"),
				"param_name" => "class",
				"value" => "",
				"description" => "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file."
				),

	)

));
}

