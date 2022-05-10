<?php

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_teacher_page_listing', function($atts, $content = null){
	global $count_post;
  	extract(shortcode_atts(array(
    	"title" 		=>'',
    	'count_post' 	=>6,
    	'column'		=>'4',
    	'teacher_cat'	=>'themeumall',
    	'class' 		=>''
    ), $atts));

	function teacher_parse_query(&$q){
		global $count_post;
		$q->set( 'posts_per_page', $count_post );
		return $q;
	}

    add_filter('parse_query','teacher_parse_query');

  	global $post;
  	$temp_post = $post;
  	$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$args = '';  	
  	if( $teacher_cat != 'themeumall' ){
		$args = array(
					'post_type' => 'teacher',
					'tax_query' => array(
										array(
											'taxonomy' => 'teacher_cat',
											'field'    => 'slug',
											'terms'    => $teacher_cat,
										),
									),
					'order' => 'ASC',
					'paged' => $paged
			    );
  	}else{
  		$args = array(
			'post_type' => 'teacher',
			'order' => 'ASC',
			'paged' => $paged
	    );
  	}

  	

  	$teachers = new WP_Query($args);
  	$output = '<div class="themeum-teacher-listing ' . esc_attr($class) .'">';
 	if($title) $output .= '<h3 class="heading">' . esc_html($title) . '</h3>';

	if ( $teachers->have_posts() ) 
	{
		$output .= '<div class="row">';		
			while($teachers->have_posts()) 
			{
				$teachers->the_post();
				$teacher_website 			= get_post_meta(get_the_ID(),'themeum_teacher_website',true);
				$teacher_email   	 		= get_post_meta(get_the_ID(),'themeum_teacher_email',true);
				$teacher_experience   	 	= get_post_meta(get_the_ID(),'themeum_teacher_experience',true);
				$teacher_specialist   	 	= get_post_meta(get_the_ID(),'themeum_teacher_specialist',true);

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

								if ($teacher_specialist) 
								{
									$output .= '<span class="person-deg">'.esc_html($teacher_specialist). '</span>';
								}

								if ($teacher_website) 
								{
									$output .= '<p><a href="' .esc_url($teacher_website). '">' .esc_url($teacher_website). '</a></p>';
								}

								if ($teacher_email) 
								{
								$output .= '<p>' .sanitize_email($teacher_email). '</p>';
								}

								if ($teacher_experience) 
								{
								 $output .= '<p>' .$teacher_experience. '</p>';
								}

								$output .= '<div class="person-social">';	
									$output .= '<ul class="social-person">';

										if( rwmb_meta( 'themeum_teacher_facebook' ) ) 
										{
										$output .= '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_facebook' )). '"><i class="fa fa-facebook"></i></a></li>';
										}

										if( rwmb_meta( 'themeum_teacher_gplus' ) ) 
										{
										$output .= '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_gplus' )). '"><i class="fa fa-google-plus"></i></a></li>';
										}

										if( rwmb_meta( 'themeum_teacher_twitter' ) ) 
										{
										$output .= '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_twitter' )). '"><i class="fa fa-twitter"></i></a></li>';
										}

										if( rwmb_meta( 'themeum_teacher_youtube' ) ) 
										{
										$output .= '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_youtube' )). '"><i class="fa fa-youtube"></i></a></li>';
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
	themeum_pagination($teachers->max_num_pages);
	$output .= ob_get_contents();
	ob_clean();

	$output .= '</div>';
	$post = $temp_post;
	wp_reset_query();
	remove_filter('parse_query','teacher_parse_query');
	return $output;
     
}); 


//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Teacher Listing", "themeum-lms"),
    "base" => "themeum_teacher_page_listing",
    'icon' => 'icon-thm-teacher-listing',
    "class" => "",
    "description" => __("Teacher Listing", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(        

	array(
		"type" => "textfield",
		"heading" => __("Teacher Page Title", "themeum-lms"),
		"param_name" => "title",
		"value" => "",
	),  


	array(
		"type" => "dropdown",
		"heading" => __("Select Teacher Category:","themeum"),
		"param_name" => "teacher_cat",
		"value" => themeum_cat_list( 'teacher_cat' )
		),

	array(
		"type" => "textfield",
		"heading" => __("Course Count Number", "themeum-lms"),
		"param_name" => "count_post",
		"value" => "6",
	),          

	array(
		"type" => "dropdown",
		"heading" => __("Column", "themeum-lms"),
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



