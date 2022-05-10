<?php

add_action('widgets_init','register_themeum_past_events_widget');

function register_themeum_past_events_widget()
{
	register_widget('themeum_past_events_widget');
}

class themeum_past_events_widget extends WP_Widget{

	function themeum_past_events_widget()
	{
		parent::__construct( 'themeum_past_events_widget','Themeum Past Events',array('description' => 'Themeum post widget to display Past events'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance)
	{
		extract($args);

		$title 			= apply_filters('widget_title', $instance['title'] );
		$count 			= esc_attr($instance['count']);
		
		echo $before_widget;

		$output = '';

		if ( $title )
			echo $before_title . $title . $after_title;

		global $post;

		
		$args = array(  'post_type' => 'event',
			'posts_per_page' => $count,
			'meta_key' => 'themeum_event_start_datetime',
			'meta_value' => date('Y-m-d h:i'),
			'meta_compare' => '<',
			'orderby' => 'meta_value',
			'order' => 'DESC'
		);


		$posts = get_posts( $args );

		$output = '';
		if(count($posts)>0){
			$output .='<div class="widget-upcoming-event">';

			foreach ($posts as $post): setup_postdata($post);
			$event_start_datetime = rwmb_meta( 'themeum_event_start_datetime' );
				setup_postdata( $post );
		    		$output .= '<div class="media upcoming-event">';
			    	if ( has_post_thumbnail() && ! post_password_required() ){
			    	 	$output .=  '<div class="pull-left"><a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'xs-thumb', array('class' => 'media-object')).'</a></div>';
			    		$output .= '<span class="upcoming-event-date">' .date("j M Y h:i", strtotime($event_start_datetime)). '</span>';
			    		$output .= '<div class="media-body"><h4 class="media-heading"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
			    		$output .= '<p>'.the_excerpt_max_charlength(30).'</p>';
				    	$output .= '</div>';
			    	}else{
			    		$output .= '<span class="upcoming-event-date">' .date("j M Y h:i", strtotime($event_start_datetime)). '</span>';
			    		$output .= '<div class="media-body"><h4 class="media-heading"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>';
			    		$output .= '<p>'.the_excerpt_max_charlength(30).'</p>';
				    	$output .= '</div>';
			    	}
			    $output .= '</div>';	
			    	 

			endforeach;

			wp_reset_postdata();

			$output .='</div>';
		}


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
			'title' 	=> 'Past Events',
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