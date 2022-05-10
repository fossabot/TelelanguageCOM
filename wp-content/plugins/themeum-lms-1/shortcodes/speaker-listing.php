<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_speaker_page_listing', function($atts, $content = null){
	global $count_post;
  	extract(shortcode_atts(array(
    	"title" => '',
    	'count_post' => 6,
    	'column'=>'4',
    	'class' => ''
    ), $atts));

    function speaker_parse_query(&$q){
      global $count_post;
      $q->set( 'posts_per_page', $count_post );
      return $q;
    }

    add_filter('parse_query','speaker_parse_query');

  	global $post;
  	$temp_post = $post;
  	$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
  	$args = array(
      'post_type' => 'speaker',
      'order' => 'ASC',
      'paged' => $paged
    );

  	$speakers = new WP_Query($args);
  	$output = '<div class="themeum-speaker-listing ' . $class .'">';
 	if($title) $output .= '<h3 class="heading">' . $title . '</h3>';

	if ( $speakers->have_posts() ) 
	{
		$output .= '<div class="row">';	
			while($speakers->have_posts()) {
				$speakers->the_post();

				$speaker_website 			= get_post_meta(get_the_ID(),'themeum_speaker_website',true);
				$speaker_email   	 		= get_post_meta(get_the_ID(),'themeum_speaker_email',true);
				$speaker_designation   	 	= get_post_meta(get_the_ID(),'themeum_speaker_designation',true);

				$output .= '<div class="speaker-listing col-xs-12 col-sm-6 col-md-'.$column.'">';
						$output .= '<figure class="team-member">';

		                 	if ( has_post_thumbnail() && ! post_password_required() ) 
		                 	{
							     $output .=  get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive'));
							     $output .=  '<div></div>';
							} else 
							{
								$output .= '<div class="no-image" style="height:230px;width:100%"></div>';
							}

							$output .= '<figcaption>';

								$output .= '<h3 class="person-title"><a href="' .get_permalink($post->ID). '">' .get_the_title(). '</a></h3>';
								if ($speaker_designation) 
								{
									$output .= '<span class="person-deg">' .esc_html($speaker_designation). '</span>';
								}

								$output .= '<div class="person-social">';	

									if ($speaker_website) 
									{
										$output .= '<p><a href="' .esc_url($speaker_website). '">' .esc_html($speaker_website). '</a></p>';
									}

									if ($speaker_email) 
									{
										$output .= '<p>' .sanitize_email($speaker_email). '</p>';
									}
								$output .= '</div>';

							$output .= '</figcaption>';

		                $output .= '</figure>';
				$output .= '</div>';
			}
		$output .= '</div>'; //row
	}

	// pagination 
	ob_start();
	themeum_pagination($speakers->max_num_pages);
	$output .= ob_get_contents();
	ob_clean();

	$output .= '</div>';
	$post = $temp_post;
	wp_reset_query();
	remove_filter('parse_query','speaker_parse_query');

	return $output;
     
}); 

//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Speaker Listing", "themeum-lms"),
    "base" => "themeum_speaker_page_listing",
    'icon' => 'icon-thm-speaker-listing',
    "class" => "",
    "description" => __("Speaker Listing", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(        

      array(
        "type" => "textfield",
        "heading" => __("Speaker Page Title", "themeum-lms"),
        "param_name" => "title",
        "value" => "",
        ),   

      array(
        "type" => "textfield",
        "heading" => __("Course Count Number", "themeum-lms"),
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





