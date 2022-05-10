<?php
add_shortcode( 'themeum_counter', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'number'			=> '',
		'duration'			=> '',
		'font_size'			=> '',
		'border_color' 		=> '',
		'border_width' 		=> '',
		'border_radius' 	=> '',
		'padding' 			=> '',
		'margin' 			=> '',
		'color' 			=> '',
		'background' 		=> '',
		'counter_title' 	=> '',
		'title_font_size'	=> '',
		'counter_color' 	=> '',
		'alignment'			=> 'left',
		'class'				=>'',
		), $atts));

	$style 			= '';
	$number_style 	= '';
	$text_style 	= '';
	$align 			= '';

	if($alignment) $align .= 'text-align:'. $alignment .';';

	if($background) $style .= 'background-color:' . $background  . ';';
	if($border_color) $style .= 'border-style:solid;border-color:' . $border_color  . ';';
	if($border_width) $style .= 'border-width:' . (int) $border_width  . 'px;';
	if($border_radius) $style .= 'border-radius:' . (int) $border_radius  . 'px;';
	if($padding) $style .= 'padding:' . $padding  . ';';

	if($color) $number_style .= 'color:' . $color  . ';';
	if($font_size) $number_style .= 'font-size:' . (int) $font_size . 'px;line-height:' . (int) $font_size . 'px;';

	if($counter_color) $text_style .= 'color:' . $counter_color  . ';';
	if($margin) $text_style .= 'margin:' . $margin  . ';';
	if($title_font_size) $text_style .= 'font-size:' . (int) $title_font_size . 'px;line-height:' . (int) $title_font_size . 'px;';

	$output  = '<div class="themeum-shortocde-counter ' . $class . '" style="'. $align . '">';

	$output .= '<div class="counter-content" style="' . $style . '">';
	$output .= '<div class="themeum-counter-number" data-digit="'. $number .'" data-duration="' . $duration . '" style="'. $number_style .'"></div>';
	if($counter_title) {
		$output .= '<div class="counter-number-title" style="' . $text_style . '">' . $counter_title . '</div>';
	}
	$output .= '</div>';

	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Counter", "themeum"),
	"base" => "themeum_counter",
	'icon' => 'icon-thm-counter',
	"class" => "",
	"description" => __("Widget Counter", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			'type'=>'textfield', 
			"heading" => __("Digit", "themeum"),
			"param_name" => "number",
			"value" => "1000",
			),		

		array(
			'type'=>'textfield', 
			"heading" => __("Duration", "themeum"),
			"param_name" => "duration",
			"value" => "1000",
			),		

		array(
			'type'=>'textfield', 
			"heading" => __("Counter Title", "themeum"),
			"param_name" => "counter_title",
			"value" => "Counter Number",
			),

		array(
			"type" => "dropdown",
			"heading" => __("Content Alignment", "themeum"),
			"param_name" => "alignment",
			"value" => array('Select'=>'','Left'=>'left','Center'=>'center','Right'=>'right'),
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Animated Number Color", "themeum"),
			"param_name" => "color",
			"value" => "rgba(255, 255, 255, 0)",
			),	

		array(
			'type'=>'textfield', 
			"heading" => __("Animated Number Font Size", "themeum"),
			"param_name" => "font_size",
			"value" => "36",
			),		

		array(
			'type'=>'textfield', 
			"heading" => __("Title Font Size", "themeum"),
			"param_name" => "title_font_size",
			"value" => "18",
			),

		array(
			"type" => "textfield",
			"heading" => __("Title Margin ex. 10px 0", "themeum"),
			"param_name" => "margin",
			"value" => "10px 0",
			),			

		array(
			"type" => "colorpicker",
			"heading" => __("Title Font Color", "themeum"),
			"param_name" => "counter_color",
			"value" => "rgba(255, 255, 255, 0)",
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Background Color", "themeum"),
			"param_name" => "background",
			"value" => "rgba(255, 255, 255, 0)",
			),						

		array(
			"type" => "colorpicker",
			"heading" => __("Border Color", "themeum"),
			"param_name" => "border_color",
			"value" => "rgba(255, 255, 255, 0)",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Border Width", "themeum"),
			"param_name" => "border_width",
			"value" => "3",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Border Radius", "themeum"),
			"param_name" => "border_radius",
			"value" => "5",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Padding ex. 20px 20px 20px 20px", "themeum"),
			"param_name" => "padding",
			"value" => "10px",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Extend Class", "themeum"),
			"param_name" => "class",
			"value" => "",
			),			

		)
	));
}