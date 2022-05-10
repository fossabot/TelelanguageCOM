<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


//shortocde
add_shortcode( 'themeum_event', function($atts, $content = null){

	extract(shortcode_atts(array(
		"title" => '',
		"layout" => 'carouselevent',
		'count'	=> 4,
		'more_link'	=> '',
		'class'	=> ''
		), $atts));


	global $post;

	$events = get_posts( array( 
		'post_type' => 'event',
		'showposts' => esc_attr($count),
	    'meta_key' => 'themeum_event_start_datetime',
	    'meta_value' => date('Y-m-d h:i'),
	    'meta_compare' => '>',
	    'orderby' => 'meta_value',
	    'order' => 'ASC'	
		) );

	if ($layout == 'carouselevent') {

		$output = '';

		$output .= '<div class="themeum-event ' . esc_attr($class) .'">';

		$output .= '<div class="carousel-events">';

		$output .= '<div class="clearfix">';

		$output .= '<div class="col-sm-2 carousel-event-title">';
	    $output .= '<span class="carousel-event-subtitle">'.__('Featured','themeum-lms').'</span>';
	    if($title) {
	    $output .= '<h3 class="title-large">' . esc_attr($title) . '</h3>';
		}
        $output .= '</div>';

        $output .= '<div class="col-sm-9 carousel-event-inner">';
		$output .= '<div id="carousel-event" class="owl-carousel owl-theme">';

		foreach ($events as $key=>$post) {

			setup_postdata( $post );

			$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'xs-thumb' );
			$event_start_datetime = get_post_meta(get_the_ID(), 'themeum_event_start_datetime',true );
			
			$output .= '<div class="carousel-event-item">';
			    if( $thumb_src ) $output .= '<a href="' . get_permalink() . '"><img class="pull-left" src="' . esc_url($thumb_src['0']) . '" alt="' . get_the_title() . '"/></a>';
			$output .= '<div class="carousel-event-content">';
			$output .= '<span class="event-date">' . date_i18n(get_option( 'date_format' ), strtotime($event_start_datetime)) . '</span>';
			$output .= '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
			$output .= '<span class="event-place">' . get_post_meta(get_the_ID(), 'thm_event_place',true ) . '</span>';
			$output .= '</div>';
			$output .= '</div>';

		}

		wp_reset_postdata();


		$output .= '</div>';//#carousel-event
		$output .= '</div>';//.feature-box col-sm-9 

		$output .= '<div class="col-sm-1">';
		$output .= '<div class="owl-controls controller">';
		$output .= '<a class="owl-control eventPrev"><span><i class="left fa fa-angle-left"></i></span></a>';
		$output .= '<a class="owl-control eventNext"><span><i class="right fa fa-angle-right"></i></span></a>';
		$output .= '</div>'; //.controls
		$output .= '</div>'; //.col-sm-1

		$output .= '</div>';//.clearfix
		$output .= '</div>';//.carousel-events
		$output .= '</div>';//.themeum-event

	} else {

			$output = '';

			$output .= '<div class="themeum-event ' . esc_attr($class) .'">';


			$output .= '<div class="latest-news-title">';
	        if($title) {
				$output .= '<h2>' . esc_attr($title) . '</h2>';
			}
	        if ($more_link) {
	        	$output .= '<p class="more"><a href="'.esc_url($more_link).'">' . __('Load More','themeum-lms') . '</a></p>';
	        }
	        $output .= '</div>';
			$output .= '<ul class="box-event clearfix">';

			$index = 0;

			foreach ($events as $key => $post) { setup_postdata( $post );

				$event_start_datetime = get_post_meta(get_the_ID(), 'themeum_event_start_datetime',true );

				$div_left = '<li class="widthleft">';

				$div_left .= '<div class="event-img">';
					$div_left .= get_the_post_thumbnail($post->ID, 'event-thumb', array('class' => 'img-responsive'));
				$div_left .= '</div>';			

				$div_left .= '<div class="event-item">';
				$div_left .= '<span class="event-date">' . date_i18n(get_option( 'date_format' ), strtotime($event_start_datetime)) . '</span>';
				$div_left .= '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
				$div_left .= '<span class="box-event-place">' . get_post_meta(get_the_ID(), 'thm_event_place',true ) . '</span>';
				$div_left .= '<p>' .  substr( get_the_content(),0, 50) . '</p>';
				$div_left .= '</div>';
				$div_left .= '</li>';

				$div_right = '<li class="widthright">';
				$div_right .= '<div class="event-item">';
				$div_right .= '<span class="event-date">' . date_i18n(get_option( 'date_format' ), strtotime($event_start_datetime)) . '</span>';
				$div_right .= '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
				$div_right .= '<span class="box-event-place">' . get_post_meta(get_the_ID(), 'thm_event_place',true ) . '</span>';
				$div_right .= '<p>' .  substr( get_the_content(),0, 50) . '</p>';
				$div_right .= '</div>';

				$div_right .= '<div class="event-img">';
					$div_right .= get_the_post_thumbnail($post->ID, 'event-thumb', array('class' => 'img-responsive'));
				$div_right .= '</div>';	

				$div_right .= '</li>';

				if ($index % 2 == 0) {
					$output .= $div_left;
				}else{
					$output .= $div_right;
				}
					
				if ($key % 2 != 0) {
					$index++;
				}				
			}

			wp_reset_postdata();

		
			$output .= '</ul>';

			$output .= '</div>';//.themeum-event

		}

	return $output;
});


//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Event Layout", "themeum-lms"),
		"base" => "themeum_event",
		'icon' => 'icon-thm-event',
		"class" => "",
		"description" => __("Event Layout", "themeum-lms"),
		"category" => __('Themeum', "themeum-lms"),
		"params" => array(				

			array(
				"type" => "textfield",
				"heading" => __("Themeum Event", "themeum-lms"),
				"param_name" => "title",
				"value" => "",
				),						

			array(
				"type" => "dropdown",
				"heading" => __("Event Layout", "themeum-lms"),
				"param_name" => "layout",
				"value" => array('Select'=>'','Carousel Layout'=>'carouselevent','Box Layout'=>'boxevent'),
				),

			array(
				"type" => "textfield",
				"heading" => __("Add More Link for (Box Layout) ", "themeum-lms"),
				"param_name" => "more_link",
				"value" => "",
				),	

			array(
				"type" => "textfield",
				"heading" => __("Add Event Item Number ex: 4", "themeum-lms"),
				"param_name" => "count",
				"value" => "4",
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
