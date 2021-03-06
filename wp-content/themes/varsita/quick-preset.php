<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';


	$link_color = esc_attr($themeum_options['link-color']);

if(isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']) {
	if(isset($link_color)){
		$output .= 'input[type="submit"], button, .home-search, .widget .nav,
		.btn-common, .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover,
		.pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .pagination>li>a:hover,
		.pagination>li>span:hover, .pagination>li>a:focus, .pagination>li>span:focus, .single-post .post-navigation .post-controller .previous-post a,
		.single-post .post-navigation .post-controller .next-post a, .post-content.media .post-format i, #searchform .btn-search,
		#blog-gallery-slider .carousel-control.left, #blog-gallery-slider .carousel-control.right, .featured-image .entry-date ,
		.entry-header .no-image, .format-no-image .entry-date, .features-list, .feature-img-wrapper, .map-content, 
		.pricing-plan .plan-price, .page-template-homepage-php .header #main-menu .nav>li>a:before,
		.page-template-homepage-php .header #main-menu .nav>li.active>a:before, #main-menu .nav>li>ul li a:before, #main-menu .nav>li>ul li.active a:before,
		.review-image-wrapper .comments a, .testimonial-carousel-control:hover, .themeum_button_shortcode:hover, .span-title2:before,
		.portfolio-filter li a:before, .thumb-overlay a, .box-content .box-btn:hover, .list.list-number-background li:before,
		.drop-cap:first-letter, .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover, 
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav .ui-tabs-active a, .subtitle h2::after,
		.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active,
		
		#main-menu .nav>li.nav-myacount a,
		.themeumlms-course-none,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		.product-thumbnail-outer .addtocart-btn,
		.woocommerce .quantity .minus, 
		.woocommerce-page .quantity .minus, 
		.woocommerce #content .quantity .minus, 
		.woocommerce-page #content .quantity .minus,
		.woocommerce .quantity .plus, 
		.woocommerce-page .quantity .plus, 
		.woocommerce #content .quantity .plus, 
		.woocommerce-page #content .quantity .plus,
		.woocommerce-tabs .nav-tabs>li.active>a, 
		.woocommerce-tabs .nav-tabs>li.active>a:hover, 
		.woocommerce-tabs .nav-tabs>li.active>a:focus,
		.woocommerce-tabs .nav>li>a:hover, 
		.woocommerce-tabs .nav>li>a:focus,
		.woocommerce .woocommerce-message,
		.woocommerce-page .woocommerce-message,
		.woocommerce .woocommerce-info,
		.woocommerce-page .woocommerce-info,
		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content,
		#single-portfolio .previous-post a:hover, #single-portfolio .next-post a:hover,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
		.product-thumbnail-outer:after, .product-thumbnail-outer:before, .product-thumbnail-outer-inner:after, .product-thumbnail-outer-inner:before,
		
		#main-menu .nav>li>ul li,
		.btn.btn-primary,
		input[type=button]:hover,
		.btn-primary,
		.list-group-item.active, .list-group-item.active:hover, .list-group-item.active:focus,
		figure.themeumlms-course-img figcaption a:hover,
		.load-more, .blog-date, .product-thumbnail-outer:after, .product-thumbnail-outer:before, .product-thumbnail-outer-inner:after, .product-thumbnail-outer-inner:before,
		.btn-pricing, .calender-date,.quiz-table th{ background-color: '. $link_color .'!important; }';

		$output .= '.style-title1:after,.review-item-text .entry-title a,.testimonial-carousel-control,.box-content .box-btn:hover,
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover, 
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav .ui-tabs-active a,
		.widget h3.widget_title, .widget .tagcloud a:hover,.themeum_button_shortcode:hover,

		.themeum-tweet .carousel-indicators li,

		#single-portfolio .previous-post a, #single-portfolio .next-post a,
		
		input:focus, textarea:focus, keygen:focus, select:focus,
		input[type="submit"],
		.form-control:focus,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{ border-color: '. $link_color .' !important; }';		

		$output .= '.title-variation1 .style-title1,.course-details .cousre-details-img .course-title,figure.themeumlms-course-img figcaption{ background-color: rgba('.hex2rgb($link_color).',.8); }';

		$output .= 'a,a:focus, #mobile-menu ul li:hover > a, .mc4wp-form:after, #mobile-menu ul li.active > a, span.badge,
		.comingsoon .social-share ul li a:hover, #comingsoon-countdown .countdown-period, .widget .nav > li.active > a, .widget .nav > li:hover > a,
		.widget.widget_mc4wp_widget .button i, .navbar-main .dropdown-menu>li>a:hover, .navbar-main .dropdown-menu>li>a:focus, .widget.widget_mc4wp_widget h3:before,
		.widget .tagcloud a:hover, .widget caption, .widget thead th, .footer-menu >li >a:hover, .entry-link h4, .post-content.media h2.entry-title a:hover,
		.widget.widget_rss ul li a, .widget.widget_recent_comments ul li a, .subtitle h2, .entry-qoute blockquote small, .format-link .entry-link h4,
		.comments-title, #respond .comment-reply-title, .comment-list .comment-body .comment-author, .widget-blog-posts .entry-title a:hover,
		.widget ul li a:hover, .organic-testimonial .testimonial-desc i, .woocommerce .star-rating, .testimonial-carousel-control,
		.list-circle ul li:before, .list-star ul li:before, .author-company, .themeum-feature-box.feature-box-shop,
		.entry-link h4, a, .comingsoon .social-share ul li a:hover, .format-link .entry-header, 
		#comingsoon-countdown .countdown-period, .widget .nav > li.active > a, .widget .nav > li:hover > a, 
		.widget.widget_mc4wp_widget .button i, .navbar-main .dropdown-menu>li>a:hover, .navbar-main .dropdown-menu>li>a:focus, 
		.widget.widget_mc4wp_widget h3:before, .widget .tagcloud a:hover, .widget caption, .widget thead th, .footer-menu >li >a:hover,
		
		sup.featured-post,
		.single-post .post-navigation  a,
		.themeumlms-course-wrap .details a:hover,
		.widget.widget_themeum_about_widget .themeum-about-share li a:hover,
		.carousel-event-item h3 a:hover,
		.box-event .event-item h4 a:hover,
		.themeum-lms-category-course .row .col-sm-3:hover .cat-icon a,
		.entry-content-wrap .entry-meta ul li i,
		.btn-transparent:hover,#main-menu .nav>li>a:hover,
		.btn-apply:hover, .event-place, .themeum-event .controller a:hover, .box-event-place,
		.related-event .related-events .related-control .carousel-control, .course-info span, .course-details a:hover,
		.course-details-title .title-left h2, .course-details-title .title-left span, .course-lessons ul li a:hover:before,
		.course-lessons ul li a:hover, .content-404 h1,.back-to-home,.list-group-item span,.list-group-item i,
		.course-teacher .course-teacher-info a:hover,.course-details h2.course-title{ color: '. $link_color .'; }';
		
		

		$output .= '.progress-bar, input[type="submit"], .widget .nav, .book_wrapper a.btn-download,
		.btn-commom, .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, 
		.pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .pagination>li>a:hover, 
		.pagination>li>span:hover, .pagination>li>a:focus, .pagination>li>span:focus, .single-post .post-navigation .post-controller .previous-post a, 
		.single-post .post-navigation .post-controller .next-post a, .post-content.media .post-format i, #searchform .btn-search, 
		#blog-gallery-slider .carousel-control.left, #blog-gallery-slider .carousel-control.right,

		.acton-btn, .themeum-tweet .carousel-indicators .active, .carousel-event-title, .latest-news-title p.more,
		.event-page .event-img .event-date, .content-404 .btn-lg,
		#comingsoon-countdown .countdown-amount:before, #comingsoon-countdown .countdown-amount:after{ background: '. $link_color .'; }';
	}
}	

if(isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']) {
	if(isset($themeum_options['hover-color'])){
		$output .= 'a:hover,.post-content.media h2.entry-title a:hover,
		.review-item-text .entry-title a:hover{ color: '.esc_attr($themeum_options['hover-color']) .'; }';
		$output .= '.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,.btn-commom:hover,
		.product-thumbnail-outer .addtocart-btn:before, a.load-more:hover,.featured .pricing-plan .plan-title,
		#main-menu .nav>li.nav-myacount a:hover,#main-menu .sub-menu li.active, 
		.btn.btn-default:hover,
		#main-menu .nav>li>ul li:hover,
		#submitbtn:hover,
		#simple-msg .btn-primary:hover,
		.acton-btn:hover{ background-color: '.esc_attr($themeum_options['hover-color']) .' !important; }';
	}
}

echo $output;