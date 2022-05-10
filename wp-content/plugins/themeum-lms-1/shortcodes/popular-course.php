<?php

if ( ! defined( 'ABSPATH' ) )
exit; // Exit if accessed directly


//shortocde
add_shortcode( 'themeum_popular_course', function($atts, $content = null){

  	extract(shortcode_atts(array(
    	'btn_all'         =>'',
      'number_count'    =>'6',
      'column'          =>'4',
      'class'          =>'',
      'browse_all_url'  =>''
    ), $atts));

  global $post;
  global $wpdb;
  $sql = '';
  $sql = "SELECT `meta_value` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_order_course_id' group by `meta_value`";
  $results = $wpdb->get_results($sql);

  $post_id = array();
  if(!empty($results)){ foreach ($results as $key=>$value){ $post_id[] = $value->meta_value; } }


  $post_ids = get_posts(array( 'post_type' => 'course','numberposts'   => $number_count,'fields'        => 'ids'));

  $counter = 1;
  $i = 0;
  while($counter == 1){
      if((count($post_id)+1) <= $number_count){
        if(!in_array( $post_ids[$i],$post_id )){
          $post_id[] = $post_ids[$i];
        }
      }else{
        $counter = 2;
      }
      $i++;
  }

  $currency_array = array(
          'AUD' => '$',
          'CAD' => '$',
          'EUR' => '€',
          'GBP' => '£',
          'SGD' => '$',
          'CHF' => 'CHF',
          'THB' => '฿',
          'USD' => '$'
      );

  $courses = get_posts( array(
    'post_type' => 'course',
    'showposts' => $number_count,
    'post__in' => $post_id,
    'orderby' => 'post__in'
    ) );

    $output = '<div class="themeum-lms-popular-course ' . $class .'">';
    $output .= '<div class="row">';
    foreach ($courses as $key=>$post){
      setup_postdata( $post );

        $course_price         = get_post_meta(get_the_ID(),'themeum_course_price',true);
        $course_lesson_number     = get_post_meta(get_the_ID(),'themeum_course_lesson_number',true);
        $themeum_course_attachment  = get_post_meta(get_the_ID(),'themeum_course_attachment',true);
        
          $output .= '<div class="col-md-'.$column.' col-sm-6">';
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
    if($browse_all_url != ""){ $output .= '<div class="col-sm-12 text-center"><a href="'.esc_url($browse_all_url).'" class="btn btn-default btn-lg" role="button">'.esc_html($btn_all).'</a></div>'; }
    wp_reset_postdata();
    $output .= '</div>'; //row
    $output .= '</div>'; //themeum-lms-popular-ourse
	return $output;
}); 	



//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Popular Course", "themeum-lms"),
    "base" => "themeum_popular_course",
    'icon' => 'icon-thm-course-listing',
    "class" => "",
    "description" => __("Popular Course Listing", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(        

      array(
        "type" => "textfield",
        "heading" => __("Count"),
        "param_name" => "number_count",
        "description" => __("Enter the number of post you want to display.", "themeum-lms"),
        "value" => 6, 
        ),

      array(
        "type" => "dropdown",
        "heading" => __("Number Of Column:", "themeum-lms"),
        "param_name" => "column",
        "value" => array('Select'=>'','column 3'=>'4','column 2'=>'6','column 4'=>'3'),
        ),

        array(
        "type" => "textfield",
        "heading" => __("Browse All Button", "themeum-lms"),
        "param_name" => "btn_all",
        "value" => "Browse All Page",
        ),      

        array(
        "type" => "textfield",
        "heading" => __("Browse All Page Link:", "themeum-lms"),
        "param_name" => "browse_all_url",
        "value" => ''
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





