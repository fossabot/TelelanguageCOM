<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

//shortocde
add_shortcode( 'themeum_custom_search', function($atts, $content = null){

  extract(shortcode_atts(array(
    'search_type'     => '',
    'search_title'    => '',
    'search_content'  => ''
    ), $atts));



		    $output = '<div class="row">';
          $output .= '<div class="course-search col-md-offset-2 col-sm-12 col-md-8">';
            if ($search_title) {
              $output .= '<h1>'.esc_html($search_title).'</h1>';
            }
            if ($search_content) {
  		        $output .= '<p>'.esc_html($search_content).'</p>';
            }
            $output .= '<form role="search" action="'.esc_url(site_url('/')).'" method="get" class="custom-search">';
              $output .= '<input class="custom-input" type="search" name="s" placeholder="'.__('Find Course, Tutorials', 'themeum-lms').'" autocomplete="off"/>';
              if( $search_type == 'course' ){
                $output .= '<input type="hidden" name="post_type" value="course" />';
              }
              $output .= '<input type="submit" value="" class="transparent-button" />';
            $output .= '</form>';
	       $output .= "</div>";
      $output .= "</div>";

  // pagination 
ob_start();
$output .= ob_get_contents();
ob_clean();
wp_reset_query();

return $output;
     
}); 

//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Custom Search", "themeum-lms"),
    "base" => "themeum_custom_search",
    'icon' => 'icon-thm-custom-search',
    "class" => "",
    "description" => __("Custom Search", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(

       array(
          "type" => "dropdown",
          "heading" => __("Search From", "themeum-lms"),
          "param_name" => "search_type",
          "value" =>  array(
              'Select'=>'',
              'Only Course'         => 'course',
              'All Over The Post'   => 'all'
            )
          ),

      array(
        "type" => "textfield",
        "heading" => __("Search Page Title", "themeum-lms"),
        "param_name" => __("search_title", "themeum-lms"),
        "value" => "",
        ),            

      array(
        "type" => "textfield",
        "heading" => __("Search Page details", "themeum-lms"),
        "param_name" => __("search_content", "themeum-lms"),
        "value" => "",
        ),

      )

    ));
}
