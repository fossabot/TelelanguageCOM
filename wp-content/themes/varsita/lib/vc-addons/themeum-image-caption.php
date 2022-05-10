<?php
add_shortcode( 'themeum_image_caption', function($atts, $content = null) {

	extract(shortcode_atts(array(
		'image'				=> '',
		'title'				=> '',
		'align'				=> 'center',
		'size'				=> '',
		'margin'			=> '',
		'color'			=> '',
		'class'				=> '',
		), $atts));

	$src_image   = wp_get_attachment_image_src($image, 'blog-full');

	$alignment ='';
	$style ='';

	if($size) $style .= 'font-size:' . (int) $size . 'px;line-height:' . (int) $size . 'px;';

	if($margin) $style .= 'margin:' . $margin .';';

	if($color) $style .= 'color:' . $color;

	if($align) $alignment .='text-align:'. $align .'; display: inline-block;';

	
	$output = '';

	$output .= '<figure class="themeum-image-caption '.$class.'" style="'.$alignment.'">';
	$output .= '<a data-rel="prettyPhoto" href="'.$src_image[0].'">';
	$output .= '<img class="img-responsive" src="'.$src_image[0].'" alt="image">';
	$output .= '</a>';
	$output .= '<figcaption class="themeum-caption-title" style="'.$style.'">'.$title.'</figcaption>';
	$output .= '</figure>';


	return $output;

});


//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
vc_map(array(
	"name" => __("Image Caption", "themeum"),
	"base" => "themeum_image_caption",
	'icon' => 'icon-thm-image-caption',
	"class" => "",
	"description" => __("Widget Image Caption", "themeum"),
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
			"heading" => __("Caption Title", "themeum"),
			"param_name" => "title",
			"value" => ""
			),	

		array(
			"type" => "textfield",
			"heading" => __("Caption Title Font Size", "themeum"),
			"param_name" => "size",
			"value" => "12"
			),	

		array(
			"type" => "colorpicker",
			"heading" => __("Caption Title Color", "themeum"),
			"param_name" => "color",
			"value" => "#666666",
			),						

		array(
			"type" => "dropdown",
			"heading" => __("Caption Title Alignment", "themeum"),
			"param_name" => "align",
			"value" => array('Select'=>'','Left'=>'left','Center'=>'center','Right'=>'right'),
			),	

		array(
			"type" => "textfield",
			"heading" => __("Caption Title Margin  Ex. 2px 2px 2px 2px", "themeum"),
			"param_name" => "margin",
			"value" => "2px 0"
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