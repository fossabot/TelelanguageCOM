<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//Performer Scroller
add_shortcode( 'lms_course_category', function($atts, $content = null){

	extract(shortcode_atts(array(
		'counts'		=> '',
		'class'		=> ''
		), $atts));


	global $post;

	$i=1;
	$j=1;
	$columns = 4;

	$output = '<div class="themeum-lms-category-course text-center ' . esc_attr($class) .'">';

		$filters = get_terms('course_cat');

		$coun_item = 1;

		$filters = array_values($filters);

		foreach ($filters as $key=>$filter)
		{
			if ($coun_item<=esc_attr($counts)) {

				$lastContainer = '';

				if( (($key+1)%($columns)==0) || $j== count($filters)) {
					$lastContainer= true;
				} else {
					$lastContainer= false;
				}

				if($i==1) {
					$output .= '<div class="row">';
				}

				$term_link = get_term_link( $filter );
				$icon = get_option('course_cat_custom_order_'.$filter->term_taxonomy_id);
				$output .= '<div class="col-sm-3 col-xs-6">';
					if($icon != '') {
						$output .= '<span class="cat-icon"><a href="'.$term_link.'"><i class="fa fa-'.$icon.'"></i></a><br></span>';
					}else {
						$output .= '<span class="cat-icon"><a href="'.$term_link.'"><i class="fa fa-graduation-cap"></i></a><br></span>';
					}
					$output .= '<a class="cat-title" href="'.$term_link.'">'.$filter->name.'<br><span class="cat-count">('.$filter->count.')</span></a>';
				$output .= '</div>';

				if(($i == $columns) || $lastContainer) {
					$output .= '</div>';
					$i=0;
				}

				$i++;
				$j++;
			$coun_item++;
			}

		}

	$output .= '</div>'; //themeum-lms-latest-ourse

	return $output;
});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Course Category", "themeum-lms"),
		"base" => "lms_course_category",
		'icon' => 'icon-wpb-course-category',
		"class" => "",
		"description" => "Course Category",
		"category" => __("Themeum", "themeum-lms"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Count", "themeum-lms"),
				"param_name" => "counts",
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

