<?php

add_action('widgets_init','register_themeum_about_widget');

function register_themeum_about_widget()
{
	register_widget('Themeum_About_Widget');
}

class Themeum_About_Widget extends WP_Widget{

	function Themeum_About_Widget()
	{
		parent::__construct( 'Themeum_About_Widget',__("Themeum About Us Widgets","themeum"),array('description' => __("This About Us Widgets","themeum")));
	}


	/*-------------------------------------------------------
	 *				Front-end display of widget
	 *-------------------------------------------------------*/

 function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		if($instance['about_img1']) {
			echo '<img src="'. get_site_url() . $instance['about_img1'].'" class="img-responsive" alt="">';
		}

		if( isset($instance['about_text']) && $instance['about_text'] ) 
		{
			echo '<div class="about-desc">'.$instance['about_text'].'</div>';
		}
		?>	
			<ul class="themeum-about-share">
				<?php if( isset($instance['facebook_url']) && $instance['facebook_url'] ) { ?>
					<li><a class="facebook" href="<?php echo $instance['facebook_url']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['twitter_url']) && $instance['twitter_url'] ) { ?>
					<li><a class="twitter" href="<?php echo $instance['twitter_url']; ?>" target="_blank" ><i class="fa fa-twitter"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['gplus_url']) && $instance['gplus_url'] ) { ?>
					<li><a class="g-plus" href="<?php echo $instance['gplus_url']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['linkedin_url']) && $instance['linkedin_url'] ) { ?>
					<li><a class="linkedin" href="<?php echo $instance['linkedin_url']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>			

				<?php if( isset($instance['pinterest_url']) && $instance['pinterest_url'] ) { ?>
					<li><a class="pinterest" href="<?php echo $instance['pinterest_url']; ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['delicious_url']) && $instance['delicious_url'] ) { ?>
					<li><a class="delicious" href="<?php echo $instance['delicious_url']; ?>" target="_blank"><i class="fa fa-delicious"></i></a></li>
				<?php } ?>						

				<?php if( isset($instance['instagram_url']) && $instance['instagram_url'] ) { ?>
					<li><a class="delicious" href="<?php echo $instance['instagram_url']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['tumblr_url']) && $instance['tumblr_url'] ) { ?>
					<li><a class="tumblr" href="<?php echo $instance['tumblr_url']; ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['stumbleupon_url']) && $instance['stumbleupon_url'] ) { ?>
					<li><a class="stumbleupon" href="<?php echo $instance['stumbleupon_url']; ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li>
				<?php } ?>				

				<?php if( isset($instance['flickr_url']) && $instance['flickr_url'] ) { ?>
					<li><a class="flickr" href="<?php echo $instance['flickr_url']; ?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
				<?php } ?>

				<?php if( isset($instance['dribble_url']) && $instance['dribble_url'] ) { ?>
					<li><a class="dribble" href="<?php echo $instance['dribble_url']; ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
				<?php } ?>
			</ul>

		<?php

		echo $after_widget;
	}


	/*-------------------------------------------------------
	 *				Sanitize data, save and retrive
	 *-------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['about_img1'] 		= $new_instance['about_img1'];
		$instance['about_text'] 		= $new_instance['about_text'];
		$instance['facebook_url'] 		= $new_instance['facebook_url'];
		$instance['twitter_url'] 		= $new_instance['twitter_url'];
		$instance['gplus_url'] 			= $new_instance['gplus_url'];
		$instance['linkedin_url'] 		= $new_instance['linkedin_url'];
		$instance['pinterest_url'] 		= $new_instance['pinterest_url'];
		$instance['delicious_url'] 		= $new_instance['delicious_url'];
		$instance['instagram_url'] 		= $new_instance['instagram_url'];
		$instance['tumblr_url'] 		= $new_instance['tumblr_url'];
		$instance['stumbleupon_url'] 	= $new_instance['stumbleupon_url'];
		$instance['flickr_url'] 		= $new_instance['flickr_url'];
		$instance['dribble_url'] 		= $new_instance['dribble_url'];

		return $instance;
	}


	/*-------------------------------------------------------
	 *				Back-End display of widget
	 *-------------------------------------------------------*/
	
	function form( $instance )
	{

		$defaults = array(  'title' 			=> '',
							'about_img1' 		=> '',
							'about_text' 		=> '',
							'facebook_url' 		=> '',
							'twitter_url' 		=> '',
							'gplus_url' 		=> '',
							'linkedin_url' 		=> '',
							'pinterest_url' 	=> '',
							'delicious_url' 	=> '',
							'instagram_url' 	=> '',
							'tumblr_url' 		=> '',
							'stumbleupon_url' 	=> '',
							'flickr_url' 		=> '',
							'dribble_url' 		=> ''
			);

		$instance = wp_parse_args( (array) $instance, $defaults );
	   ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'about_img1' ); ?>"><?php _e( 'About Image URL', 'themeum' ); ?></label>

			<input type="hidden" id="<?php echo $this->get_field_id('about_img1');?>" name="<?php echo $this->get_field_name('about_img1');?>" class="<?php echo $this->get_field_id('about_img1');?>" value="<?php echo $instance['about_img1']; ?>"/>
 			<button id="<?php echo $this->get_field_id('about_img1');?>" class="custom-upload button" data-url="<?php echo get_site_url(); ?>"><?php echo __('Upload image','themeum'); ?></button>
 			<img class="<?php echo $this->get_field_id('about_img1');?>" src="<?php echo get_site_url() . $instance['about_img1']; ?> "/>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'about_text' ); ?>"><?php _e('About Text :', 'themeum'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('about_text');?>" name="<?php echo $this->get_field_name('about_text'); ?>" style="height:150px;"><?php echo $instance['about_text']; ?></textarea> 
		</p>


		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>"><?php _e('Facebook URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'facebook_url' ); ?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" value="<?php echo $instance['facebook_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_url' ); ?>"><?php _e('Twitter URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'twitter_url' ); ?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" value="<?php echo $instance['twitter_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'gplus_url' ); ?>"><?php _e('Google Plus URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'gplus_url' ); ?>" name="<?php echo $this->get_field_name( 'gplus_url' ); ?>" value="<?php echo $instance['gplus_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin_url' ); ?>"><?php _e('Linkedin URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'linkedin_url' ); ?>" name="<?php echo $this->get_field_name( 'linkedin_url' ); ?>" value="<?php echo $instance['linkedin_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'pinterest_url' ); ?>"><?php _e('Pinterest URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'pinterest_url' ); ?>" name="<?php echo $this->get_field_name( 'pinterest_url' ); ?>" value="<?php echo $instance['pinterest_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'delicious_url' ); ?>"><?php _e('Delicious URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'delicious_url' ); ?>" name="<?php echo $this->get_field_name( 'delicious_url' ); ?>" value="<?php echo $instance['delicious_url']; ?>" style="width:100%;" />
		</p>			

		<p>
			<label for="<?php echo $this->get_field_id( 'instagram_url' ); ?>"><?php _e('Instagram URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'instagram_url' ); ?>" name="<?php echo $this->get_field_name( 'instagram_url' ); ?>" value="<?php echo $instance['instagram_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'tumblr_url' ); ?>"><?php _e('Tumblr URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'tumblr_url' ); ?>" name="<?php echo $this->get_field_name( 'tumblr_url' ); ?>" value="<?php echo $instance['tumblr_url']; ?>" style="width:100%;" />
		</p>		

		<p>
			<label for="<?php echo $this->get_field_id( 'stumbleupon_url' ); ?>"><?php _e('Stumbleupon URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'stumbleupon_url' ); ?>" name="<?php echo $this->get_field_name( 'stumbleupon_url' ); ?>" value="<?php echo $instance['stumbleupon_url']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'flickr_url' ); ?>"><?php _e('Flickr URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'flickr_url' ); ?>" name="<?php echo $this->get_field_name( 'flickr_url' ); ?>" value="<?php echo $instance['flickr_url']; ?>" style="width:100%;" />
		</p>					

		<p>
			<label for="<?php echo $this->get_field_id( 'dribble_url' ); ?>"><?php _e('Dribble URL: ', 'themeum'); ?></label>
			<input id="<?php echo $this->get_field_id( 'dribble_url' ); ?>" name="<?php echo $this->get_field_name( 'dribble_url' ); ?>" value="<?php echo $instance['dribble_url']; ?>" style="width:100%;" />
		</p>
		
	<?php
	}
}