<?php

if ( ! defined( 'ABSPATH' ) )
exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_course_page_listing', function($atts, $content = null){

	global $count_post;

  	extract(shortcode_atts(array(
    	"title" 			=>'',
    	'column'			=>'4',
    	'count_post' 		=>6,
    	'class' 			=>'',
    	'course_cat'		=>'themeumall'
    ), $atts));



  	global $post;
  	$temp_post = $post;


	$args = '';
	$paged = get_query_var( 'paged', 1 ); 	

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
					'order' => 'ASC',
					'paged' => $paged
			    );
  	}else{
  		$args = array(
			'post_type' => 'course',
			'order' => 'ASC',
			'paged' => $paged
	    );
  	}




  	$courses = new WP_Query($args);
  	$output = '<div class="themeum-course-listing ' . esc_attr($class) .'">';
 	if($title) $output .= '<h3 class="heading">' . esc_attr($title) . '</h3>';
  	if ( $courses->have_posts() ) 
  	{
  		$output .= '<div class="row">';	
			while($courses->have_posts()) 
			{
				
				$courses->the_post();
				$course_price 				= get_post_meta(get_the_ID(),'themeum_course_price',true);
				$course_lesson_number 		= get_post_meta(get_the_ID(),'themeum_course_lesson_number',true);
				$themeum_course_attachment 	= get_post_meta(get_the_ID(),'themeum_course_attachment',true);

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
				$output .= '</div>'; // col-sm-3
			}
		$output .= '</div>'; //row
	}

	// pagination 
	ob_start();
	themeum_pagination($courses->max_num_pages);
	$output .= ob_get_contents();
	ob_clean();

	$output .= '</div>';
	$post = $temp_post;
	wp_reset_query();

	remove_filter('parse_query','course_parse_query');

	return $output;
     
}); 	



//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Course Listing", "themeum-lms"),
    "base" => "themeum_course_page_listing",
    'icon' => 'icon-thm-course-listing',
    "class" => "",
    "description" => __("Course Listing", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(        

    array(
        "type" => "textfield",
        "heading" => __("Course Page Title", "themeum-lms"),
        "param_name" => "title",
        "value" => "",
    ), 

    array(
		"type" => "dropdown",
		"heading" => __("Select Course Category:","themeum"),
		"param_name" => "course_cat",
		"value" => themeum_cat_list( 'course_cat' )
	),        

    array(
	    "type" => "textfield",
	    "heading" => __("Course Count Number", "themeum-lms"),
	    "param_name" => "count_post",
	    "value" => "6",
    ),        

	array(
		"type" => "dropdown",
		"heading" => __("Column ", "themeum-lms"),
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





