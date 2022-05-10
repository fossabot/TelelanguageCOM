<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

//shortocde
add_shortcode( 'themeum_tinny_slider', function($atts, $content = null){

  extract(shortcode_atts(array(
    'number_of_slides'    => '3',
    'title_size'          => '60px',
    'title_weight'        => '400',
    'title_color'         => '#ffffff',
    'sub_title_size'      => '16px',
    'sub_title_weight'    => '400',
    'sub_title_color'     => '#ffffff',
    'alignment'           => 'left',
    'title_margin'        => ''
    ), $atts));





global $themeum_options;
$sub_header_style = 'style="color:'.esc_attr($sub_title_color).'; font-size: '.esc_attr($sub_title_size).'; font-weight:'.esc_attr($sub_title_weight).'; "';
$header_style = 'style="color:'.esc_attr($title_color).'; font-size: '.esc_attr($title_size).'; font-weight:'.esc_attr($title_weight).'; line-height: '.esc_attr($title_size).'; margin:'.esc_attr($title_margin).'"';

$output = '<div id="owl-tiny-slider" class="owl-carousel owl-theme">';
if(isset($themeum_options['opt-slides'])){
  foreach ($themeum_options['opt-slides'] as $key) {
    if($number_of_slides >= count($themeum_options['opt-slides'])){
       $output .= '<div class="item" style="text-align:'.$alignment.';" >';
          $output .= '<div class="tiny-header" '.$header_style.'>'.$key['title'].'</div>';
          $output .= '<div class="tiny-content" '.$sub_header_style.'>'.$key['description'].'</div>';
       $output .= '</div>';
    }
  }
}
$output .= '</div>'; 



// pagination 
ob_start();
$output .= ob_get_contents();
ob_clean();

return $output;
     
}); 

//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Tiny Slider", "themeum-lms"),
    "base" => "themeum_tinny_slider",
    'icon' => 'icon-thm-custom-search',
    "class" => "",
    "description" => __("Themeum Custom Search", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(

      

      array(
      "type" => "textfield",
      "heading" => __("Number of Slider", "themeum-lms"),
      "param_name" => "number_of_slides",
      "value" => "3",
      ), 


      array(
      "type" => "dropdown",
      "heading" => __("Alingment", "themeum-lms"),
      "param_name" => "alignment",
      "value" =>  array(
          'Select'=>'',
          'left'   => 'left',
          'right'   => 'right',
          'center' => 'center',
        )
      ),

      array(
      "type" => "textfield",
      "heading" => __("Title Font Size (eg: 6ß0px)", "themeum-lms"),
      "param_name" => "title_size",
      "value" => "",
      ), 

      array(
      "type" => "dropdown",
      "heading" => __("Title Font Weight", "themeum-lms"),
      "param_name" => "title_weight",
      "value" => array('Select'=>'','300'=>'300','100'=>'100','200'=>'200','400'=>'400','500'=>'500','600'=>'600','700'=>'700'),
      ),           

      array(
      "type" => "colorpicker",
      "heading" => __("Title Color", "themeum-lms"),
      "param_name" => "title_color",
      "value" => "",
      ), 

       array(
      "type" => "textfield",
      "heading" => __("Title Margin: (eg: 5px 5px 5px 5px)", "themeum-lms"),
      "param_name" => "title_margin",
      "value" => "0px",
      ),     


      array(
      "type" => "textfield",
      "heading" => __("Sub Title Font Size (eg: 16px)", "themeum-lms"),
      "param_name" => "sub_title_size",
      "value" => "",
      ),  

      array(
      "type" => "dropdown",
      "heading" => __("Sub Title Font Weight", "themeum-lms"),
      "param_name" => "sub_title_weight",
      "value" => array('Select'=>'','300'=>'300','100'=>'100','200'=>'200','400'=>'400','500'=>'500','600'=>'600','700'=>'700'),
      ),           

      array(
      "type" => "colorpicker",
      "heading" => __("Sub Title Color", "themeum-lms"),
      "param_name" => "sub_title_color",
      "value" => "",
      ),       


      )

    ));
}
