<?php
add_shortcode( 'themeum_welcome', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'image'				=> '',
		'title'				=> '',
		'align'				=> '',
		'size'				=> '',
		'text'				=> '',
		'btn_link'			=> '',
		'btn_name'			=> '',
		'color'				=> '',
		'class'				=> '',
		), $atts));

	$src_image   = wp_get_attachment_image_src($image, 'blog-full');


	$style ='';

	if($size) $style .= 'font-size:' . (int) $size . 'px;line-height:' . (int) $size . 'px;';

	if($color) $style .= 'color:' . $color;

	$output = '';

	$output .= '<div class="themeum-welcome row '.$class.'">';
	$output .= '<div class="col-sm-5">';
	$output .= '<img class="img-responsive" src="'.$src_image[0].'" alt="image">';
	$output .= '</div>';
	$output .= '<div class="welcome-intro col-sm-7">';
	if ($title)
    {
	$output .= '<h3 class="themeum-welcome-title" style="'.$style.'">'.$title.'</h3>';
	}
	if ($text)
    {
    $output .= '<p class="themeum-welcome-text">'.$text.'</p>';
	}
	if ($btn_link)
    {
	$output .=  '<a class="btn-style" href="'.$btn_link.'">'.$btn_name.'</a>';
    }
	$output .= '</div>';

	$output .= '</div>';


	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Welcome", "themeum"),
	"base" => "themeum_welcome",
	'icon' => 'icon-thm-image-caption',
	"class" => "",
	"description" => __("Welcome Message", "themeum"),
	"category" => __('Themeum', "themeum"),
	"params" => array(

		array(
			"type" => "attach_image",
			"heading" => __("Insert Image", "themeum"),
			"param_name" => "image",
			"value" => "",
			),			

		array(
			"type" => "textfield",
			"heading" => __("Welcome Title", "themeum"),
			"param_name" => "title",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Title Font Size", "themeum"),
			"param_name" => "size",
			"value" => "12"
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Title Color", "themeum"),
			"param_name" => "color",
			"value" => "#767676",
			),	

		array(
			"type" => "textarea",
			"heading" => __("Welcome Text", "themeum"),
			"param_name" => "text",
			"value" => "",
			),													

		array(
			"type" => "textfield",
			"heading" => __("Link URL", "themeum"),
			"param_name" => "btn_link",
			"value" => "",
			),				

		array(
			"type" => "textfield",
			"heading" => __("Button Name", "themeum"),
			"param_name" => "btn_name",
			"value" => "",
			),	

		array(
			"type" => "textfield",
			"heading" => __("Custom Class", "themeum"),
			"param_name" => "class",
			"value" => ""
			),		

		)
	));
}