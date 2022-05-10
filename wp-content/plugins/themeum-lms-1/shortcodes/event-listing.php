<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}


//shortocde
add_shortcode( 'themeum_event_page', function($atts, $content = null){
  global $count_post;
  extract(shortcode_atts(array(
      "title"       => '',
      'count_post'  => 6,
      'class'       => '',
      'event_cat'   => 'themeumall',
    ), $atts));

    function event_parse_query(&$q){
      global $count_post;
      $q->set( 'posts_per_page', esc_attr($count_post) );
      return $q;
    }

    add_filter('parse_query','event_parse_query');


  global $post;
  $temp_post = $post;

  $paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = '';   
    if($event_cat != 'themeumall'){
    
    $args = array(

            'post_type' => 'event',
            'tax_query' => array(
                    array(
                      'taxonomy' => 'event_cat',
                      'field'    => 'slug',
                      'terms'    => $event_cat,
                    ),
                  ),
            'meta_key' => 'themeum_event_start_datetime',
            'meta_value' => date('Y-m-d h:i'),
            'meta_compare' => '>',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'paged' => $paged
          );

    }else{
      $args = array(
                  'post_type' => 'event',
                  'meta_key' => 'themeum_event_start_datetime',
                  'meta_value' => date('Y-m-d h:i'),
                  'meta_compare' => '>',
                  'orderby' => 'meta_value',
                  'order' => 'ASC',
                  'paged' => $paged
                  );
    }



  $events = new WP_Query($args);
  $output = '<div class="themeum-event-page ' . esc_attr($class) .'">';
  if($title) $output .= '<h3 class="heading">' . esc_attr($title) . '</h3>';
  if ( $events->have_posts() ) 
  {
    while($events->have_posts()) 
    { 
      $events->the_post();
      $event_start_datetime   = esc_attr(get_post_meta(get_the_ID(),'themeum_event_start_datetime'));
      $event_end_datetime     = esc_attr(get_post_meta(get_the_ID(),'themeum_event_end_datetime',true));
      $event_place            = get_post_meta(get_the_ID(),'themeum_event_place',true);
      $event_speakers         = get_post_meta('themeum_event_speaker','type=checkbox_list');

      $output .= '<div class="event-page">';
        $output .= '<div class="row">';
          $output .= '<div class="col-xs-4 col-sm-4">';
            $output .= '<div class="event-img">';
              if ( has_post_thumbnail() && ! post_password_required() ) {
                $output .=  get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive'));
              }else {
                if( $event_start_datetime ) {
                  $output .= '<div class="event-date">'; 
                  $output .= '<span class="date">' .date("d", strtotime($event_start_datetime)). ' </br></span>';
                    $output .= '<span class="month">' .date("M", strtotime($event_start_datetime)). '</span>';
                  $output .= '</div>';  
                }
              }

            $output .= '</div>';
          $output .= '</div>'; //col-sm-5

          $output .= '<div class="col-xs-8 col-sm-8">';
            $output .= '<div class="event-info">';
              $output .= '<div class="event-info-title">';
                $output .= '<h2><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h2>';
              $output .= '</div>';

              $output .= '<div class="event-info-text">';          
                $output .= '<div class="event-info-middle">';
                  if(!empty($event_speakers)) 
                  { 
                    $posts_id = array();
                    foreach ($event_speakers as $value)
                    {
                      $posts = get_posts(array('post_type' => 'speaker', 'name' => $value));
                      $posts_id[] = $posts[0]->ID;
                    }
                    $event_speakers = get_posts( array( 'post_type' => 'speaker', 'post__in' => $posts_id, 'posts_per_page'   => 20) );
                    $output .= '<p style="display:inline;"><span class="event-bold">'.__('Speakers : ','themeum-lms').'</span></P>'; 
                    $output .= '<ul class="event-speaker-listing" style="display:inline">';
                      foreach ($event_speakers as $key=>$post) 
                      { setup_postdata( $post );
                        $output .= '<li>';
                          $output .= '<a href="'.get_permalink($post->ID).'">'.get_the_title().'</a>';
                        $output .= '</li>';
                      }
                      wp_reset_postdata();
                    $output .= '</ul>';

                  }
                  if($event_start_datetime) 
                  {
                    $output .= '<p><span class="event-bold">'. __('Date :','themeum-lms'). '</span>' .date("F d, Y", strtotime($event_start_datetime)). ' - ' .date("F d, Y", strtotime($event_end_datetime)).'</p>';
                    $output .= '<p><span class="event-bold">'.__('Time :','themeum-lms'). '</span>' .date("H:i A", strtotime($event_start_datetime)). ' - ' .date("H:i A", strtotime($event_end_datetime)).'</p>';
                  }
                  if( $event_place ) 
                  {
                    $output .= '<p><span class="event-bold">' .__('Location :','themeum-lms').'</span>'.$event_place.'</p>';
                  }

                $output .= '</div>'; //event-info-middle
              $output .= '</div>'; //event-info-text
            $output .= '</div>'; //event-info
          $output .= '</div>'; //col-sm-7
        $output .= '</div>'; //row        
      $output .= '</div>'; //event-page
    }
  }

  // pagination 
  ob_start();
  themeum_pagination($events->max_num_pages);
  $output .= ob_get_contents();
  ob_clean();

  $output .= '</div>';

 $post = $temp_post;
 wp_reset_query();
 remove_filter('parse_query','event_parse_query');

return $output;
     
}); 



//Visual Composer addons register
if (class_exists('WPBakeryVisualComposerAbstract')) {
  vc_map(array(
    "name" => __("Event Listing", "themeum-lms"),
    "base" => "themeum_event_page",
    'icon' => 'icon-thm-event-page',
    "class" => "",
    "description" => __("Event Listing", "themeum-lms"),
    "category" => __('Themeum', "themeum-lms"),
    "params" => array(     

      array(
        "type" => "textfield",
        "heading" => __("Event Page Title", "themeum-lms"),
        "param_name" => "title",
        "value" => "",
        ), 

      array(
        "type" => "dropdown",
        "heading" => __("Select Event Category:","themeum-lms"),
        "param_name" => "event_cat",
        "value" => themeum_cat_list( 'event_cat' )
        ),

      array(
        "type" => "textfield",
        "heading" => __("Course Count Number", "themeum-lms"),
        "param_name" => "count_post",
        "value" => "6",
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
