<?php
add_shortcode( 'themeum_admission', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'image'				=> '',
		'title'				=> '',
		'align'				=> '',
		'size'				=> '',
		'degree'			=> '',
		'course'			=> '',
		'duration'			=> '',
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

	$output .= '<div class="themeum-admission '.$class.'">';

	if ($title)
    {
	$output .= '<h3 class="themeum-admission-title" style="'.$style.'">'.$title.'</h3>';
	}

	$output .= '<div class="media">';
	$output .= '<div class="pull-left">';
	$output .= '<img class="img-responsive" src="'.$src_image[0].'" alt="image">';
	$output .= '</div>';
	$output .= '<div class="media-body">';
	if ($degree)
    {
	$output .= '<span class="themeum-admission-degree">'.$degree.'</span>';
	}	
	if ($course)
    {
	$output .= '<span class="themeum-admission-course">'.$course.'</span>';
	}	
	if ($duration)
    {
	$output .= '<span class="themeum-admission-duration">'.$duration.'</span>';
	}
	$output .= '</div>';
	$output .= '</div>';

	if ($text)
    {
    $output .= '<p class="themeum-admission-text">'.$text.'</p>';
	}
	if ($btn_link)
    {
	$output .=  '<a class="btn-style" href="'.$btn_link.'">'.$btn_name.'</a>';
    }

	$output .= '</div>';

	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Admission", "themeum"),
	"base" => "themeum_admission",
	'icon' => 'icon-thm-image-caption',
	"class" => "",
	"description" => __("Welcome Admission", "themeum"),
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
			"heading" => __("Admission Title", "themeum"),
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
			"type" => "textfield",
			"heading" => __("Degree", "themeum"),
			"param_name" => "degree",
			"value" => ""
			),				

		array(
			"type" => "textfield",
			"heading" => __("Course", "themeum"),
			"param_name" => "course",
			"value" => ""
			),			

		array(
			"type" => "textfield",
			"heading" => __("Duration", "themeum"),
			"param_name" => "duration",
			"value" => ""
			),			

		array(
			"type" => "textarea",
			"heading" => __("Admission Text", "themeum"),
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