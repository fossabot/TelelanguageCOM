<?php

add_action('widgets_init','register_themeum_popular_post_widget');

function register_themeum_popular_post_widget()
{
	register_widget('themeum_popular_post_widget');
}

class themeum_popular_post_widget extends WP_Widget{

	function themeum_popular_post_widget()
	{
		parent::__construct( 'themeum_popular_post_widget','Themeum Popular Course( Sell )',array('description' => 'Themeum post widget to display Popular Course'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance)
	{
		extract($args);

		$title 			= apply_filters('widget_title', $instance['title'] );
		$count 			= esc_url($instance['count']);
		
		echo $before_widget;

		$output = '';

		if ( $title )
			echo $before_title . $title . $after_title;

		
	  global $post;
	  global $wpdb;
	  $sql = '';
	  if ( is_user_logged_in() ) { 
	    $sql = "SELECT `meta_value` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_order_course_id' GROUP BY `meta_value` ORDER BY `meta_value` DESC";
	  }
	  $results = $wpdb->get_results($sql);
	  $post_id = array();
	  if(!empty($results)){ foreach ($results as $key=>$value) { $post_id[] = $value->meta_value; } }


	  $post_ids = get_posts(array( 'post_type' => 'course','numberposts'   => -1,'fields'        => 'ids'));

	  $counter = 1;
	  $i = 0;
	  while($counter == 1){
	      if((count($post_id)+1) <= $count){
	        if(!in_array( $post_ids[$i],$post_id )){
	          $post_id[] = $post_ids[$i];
	        }
	      }else{
	        $counter = 2;
	      }
	      $i++;
	  }

	  $courses = get_posts( array(
	    'post_type' => 'course',
	    'showposts' => $count,
	    'post__in' => $post_id,
	    'orderby' => 'post__in'
	    ) );

		$currency_array = array('AUD' => '$','BRL' => 'R$','CAD' => '$','CZK' => 'Kč','DKK' => 'kr.','EUR' => '€','HKD' => 'HK$','HUF' => 'Ft','ILS' => '₪','JPY' => '¥','MYR' => 'RM','MXN' => 'Mex$','NOK' => 'kr','NZD' => '$','PHP' => '₱','PLN' => 'zł','GBP' => '£','RUB' => '₽','SGD' => '$','SEK' => 'kr','CHF' => 'CHF','TWD' => '角','THB' => '฿','TRY' => 'TRY','USD' => '$');
		$symbol = '';
		$currency_type = get_option('paypal_curreny_code');
		if (array_key_exists( $currency_type , $currency_array)) {
		    $symbol = $currency_array[$currency_type];
		}else{
			 $symbol = '$';
		}
		



	    $output = '<div class="product_list_widget themeum-popular-course-widgets">';
		    foreach ($courses as $key=>$post){
		    	setup_postdata( $post );

	    		$course_price = rwmb_meta( 'themeum_course_price' );
		    		
	    		$output .= '<div class="media popular-course-widgets">';
		    	if ( has_post_thumbnail() && ! post_password_required() ){
		    	 	$output .=  '<div class="pull-left"><a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'xs-thumb', array('class' => 'media-object')).'</a></div>';
		    		$output .= '<div class="media-body">';
		    		$output .= '<h4 class="media-heading"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
		    		if($course_price) {
                      $output .= '<span>' .esc_html($symbol). '' .esc_html($course_price). '</span>';
                    } else {
                      $output .= '<span>' .__('Free', 'themeum-lms'). '</span>';
                    }
		    		$output .= '<p>'.the_excerpt_max_charlength(30).'</p></div>';
		    	}else{	    		
		    		$output .= '<div class="media-body">';
		    		$output .= '<h4 class="media-heading"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
	    	 		if($course_price) {
                      $output .= '<span>' .esc_html($symbol). '' .esc_html($course_price). '</span>';
                    } else {
                      $output .= '<span>' .__('Free', 'themeum-lms'). '</span>';
                    }			    		
		    		$output .= '<p>'.the_excerpt_max_charlength(30).'</p></div>';
		    	}
		    	$output .= '</div>';
		    }
	    $output .= '</div>';



		wp_reset_postdata();


		echo $output;

		echo $after_widget;
	}


	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['count'] 			= strip_tags( $new_instance['count'] );

		return $instance;
	}


	function form($instance)
	{
		$defaults = array( 
			'title' 	=> 'Popular Course',
			'count' 	=> 5
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Widget Title', 'themeum'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'count' )); ?>"><?php _e('Count', 'themeum'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'count' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'count' )); ?>" value="<?php echo esc_attr($instance['count']); ?>" style="width:100%;" />
		</p>

	<?php
	}
}