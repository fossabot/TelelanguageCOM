<?php

//Visual Composer
if (class_exists('WPBakeryVisualComposerAbstract')) {
	vc_map(array(
		"name" => __("Tweet", "themeum"),
		"base" => "themeum_tweet",
		"description" => __("Themeum Tweet", "themeum"),
		"category" => __('Themeum', "themeum"),
		"params" => array(

			array(
				"type" => "textfield",
				"heading" => __("Username", "themeum"),
				"param_name" => "username",
				"value" => "themeum",
				),

            array(
              'type' => 'checkbox',
              'heading' => __( 'Show Avatar', 'themeum' ),
              'param_name' => 'avatar',
              'value' => array( __( 'avatar', 'themeum' ) => true )
            ),		

            array(
              'type' => 'checkbox',
              'heading' => __( 'Tweet Time', 'themeum' ),
              'param_name' => 'tweet_time',
              'value' => array( __( 'Tweet Time', 'themeum' ) => true )
            ),	

            array(
              'type' => 'checkbox',
              'heading' => __( 'Tweet Source', 'themeum' ),
              'param_name' => 'tweet_src',
              'value' => array( __( 'Tweet Source', 'themeum' ) => true )
            ),	

            array(
              'type' => 'checkbox',
              'heading' => __( 'Follow Link', 'themeum' ),
              'param_name' => 'follow_us',
              'value' => array( __( 'Follow Link', 'themeum' ) => true )
            ),	                          						
		
		)
	));
}
