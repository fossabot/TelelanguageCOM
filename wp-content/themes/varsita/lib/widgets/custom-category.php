<?php

add_action('widgets_init','register_themeum_custom_category_widget');

function register_themeum_custom_category_widget(){
	register_widget('themeum_custom_category_widget');
}

class themeum_custom_category_widget extends WP_Widget{

	function themeum_custom_category_widget(){
		parent::__construct( 'themeum_custom_category_widget','themeum Course Category',array('description' => 'Themeum Course Category widget'));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

	function widget($args, $instance){
		extract($args);

		$title 			= apply_filters('widget_title', $instance['title'] );
		$category 		= $instance['category'];
		
		echo $before_widget;

		$output = '';

		if ( $title ){
			echo $before_title . $title . $after_title;
		}


		$terms = get_terms( $category );
		if( !is_wp_error( $terms ) ){
			echo '<ul>';
			foreach ($terms as $value) {
				
				$url = get_term_link( $value->slug, $category );

				echo '<li><a style="display:block;" href="'.$url.'">'.$value->name.'<span class="pull-right">'.$value->count.'</span></a></li>';
			}
			echo '</ul>';
		}


		echo $output;
		echo $after_widget;
	}


	function update( $new_instance, $old_instance ){

		$instance = $old_instance;
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['category'] 		= strip_tags( $new_instance['category'] );
		return $instance;
	}


	function form($instance){

		$defaults = array( 
			'title' 	=> 'Course Category',
			'category' 	=> ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Widget Title', 'themeum'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'category' )); ?>"><?php _e('Select Taxonomie:', 'themeum'); ?></label>
			<?php
			$options = array();
			$taxonomies = get_taxonomies(); 
			foreach ( $taxonomies as $taxonomy ){
			    $options[ $taxonomy ] = $taxonomy ;
			}

			if(isset($instance['category'])) $category = esc_attr($instance['category']);
			?>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'category' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'category' )); ?>">
				<?php
				$op = '<option value="%s"%s>%s</option>';
				foreach ($options as $value ) {
					if ($category === $value) {
			            printf($op, $value, ' selected="selected"', $value);
			        } else {
			            printf($op, $value, '', $value);
			        }
			    }
				?>
			</select>
		</p>


	<?php
	}
}