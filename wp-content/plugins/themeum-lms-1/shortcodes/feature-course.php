<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Performer Scroller
add_shortcode( 'lms_feature_course', function($atts, $content = null){

	extract(shortcode_atts(array(
		'count'		=> '4',
		'class'		=> ''
		), $atts));


	global $post;


	$args = array(
		'post_type' => 'course',
		'meta_query' => array(
			array(
				'key' => 'themeum_course_feature',
				'value' => '1',
				'compare' => '='
			)
		),
		'order' => 'DSC',
		'orderby' => 'date',
		'showposts' => esc_attr($count)
	 );
	$courses = new WP_Query( $args );


	$output = '<div class="themeum-lms-feature-course ' . esc_attr($class) .'">';

		if ( $courses->have_posts() ) {

			while ( $courses->have_posts() ) {
			$courses->the_post();
			$feature_bg_color 	= themeum_Hex2RGB(get_post_meta(get_the_ID(),'themeum_feature_color',true), '.8');
			$style = 'style="background-color: '.esc_attr($feature_bg_color).';"';
			$output .= '<div class="col-sm-3 paddingnone">';
				$output .= '<div class="feature-course" '.$style.'>';
					$output .= '<h3><a href="' . get_permalink(). '">' . get_the_title(). '</a></h3>';		
					$output .= '<p>' . the_excerpt_max_charlength(70). '</p>';		
					$output .= '<a class="btn-featue" href="' . get_permalink(). '">' . __('View Course', 'themeum-lms'). ' <i class="fa fa-long-arrow-right"></i></a>';		
				$output .= '</div>';
			$output .= '</div>'; //col-sm-3
			}

		}
		wp_reset_postdata();

	$output .= '</div>'; //themeum-lms-latest-ourse

	return $output;
});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Feature Course", "themeum-lms"),
		"base" => "lms_feature_course",
		'icon' => 'icon-wpb-feature-course',
		"class" => "",
		"description" => "Feature Course",
		"category" => __("Themeum", "themeum-lms"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Count","themeum-lms"),
				"param_name" => "count",
				"description" => __("Enter the number of performers you want to display.", "themeum-lms"),
				"value" => 4, 
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

