<?php
ob_start();

   if (isset($_POST['submit']) && isset($_POST['log_username']) ) {

       	global $errors_login;
        $errors_login ='';
        $username   =   sanitize_user($_POST['log_username']);
        $password   =   sanitize_text_field($_POST['log_password']);
        $remember   =   '';
        if(isset($_POST['remember'])){ $remember = sanitize_text_field($_POST['remember']); }

        $user = '';

 if (username_exists($username)){
        $creds = array();
		$creds['user_login'] = $username;
		$creds['user_password'] = $password;
		$creds['remember'] = '';
		
		if($remember == 'true'){
			$creds['remember'] = $remember;
		}
		else{
			$creds['remember'] = 'false';
		}
		
		$user = wp_signon( $creds, false );
	}


		if ( is_wp_error($user) ){
			$errors_login = '<div class="col-sm-4 col-sm-offset-4 text-center"><div class="alert alert-danger" role="alert"><strong>'.__("ERROR","themeum").'</strong>: '.__("Username or Password is not valid.","themeum").'</div></div>';
		 }elseif( $user == "" ){
		 	$errors_login = '<div class="col-sm-4 col-sm-offset-4 text-center"><div class="alert alert-danger" role="alert"><strong>'.__("ERROR","themeum").'</strong>: '.__("Username or Password is not valid.","themeum").'</div></div>';
		 }else{
		 	wp_safe_redirect(esc_url($_SERVER['REQUEST_URI'])); 
		 	exit;
		 }

    }



	function login_form(){
	    global $errors_login;
	    global $themeum_options;
	    echo $errors_login;
	    echo '
	    	<div class="col-sm-4 col-sm-offset-4 text-center">
		    <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
		    	<a href="'.esc_url(get_site_url()).'">
						<img class="img-responsive center-image" src="'.esc_url($themeum_options['loginlogo']['url']).'" alt="" >
				</a>
		    	<p class="lead">'.__("Welcome Back!","themeum").'</p>
			    <div class="form-group">
				    <input autocomplete="off" type="text" name="log_username" class="required form-control"  placeholder="'.__("Username","themeum").'" />
			    </div>
			    <div class="form-group">
				    <input autocomplete="off" type="password" class="password required form-control" placeholder="'.__("Password","themeum").'" name="log_password" >
			    </div>
			    <div class="form-group">
			    	<input type="checkbox" name="remember" value="true"> '.__("Remember Me","themeum").'
			    	<input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="'.__("Log In","themeum").'"/>
			    </div>
		    ';
		if( $errors_login != '' ){
	    	echo '<p><a href="'.wp_lostpassword_url().'" title="'.__("Lost Password","themeum").'">'.__("Lost Password?","themeum").'</a></p>';	
	    }
	    

	    if(get_option('register_page_id')){ 
	    	echo "<p>".__('Don not have an account?','themeum')." <a href='".esc_url(get_permalink( get_option('register_page_id') ))."' title='".__('Sign Up','themeum')."'>".__('Sign Up','themeum')."</a></p>";	
	    }

	   echo '</form></div>';

	}


	// Register login shortcode.
	add_shortcode('custom_login', 'custom_login_shortcode');
	function custom_login_shortcode(){
			if ( is_user_logged_in() ) {
				$current_user = wp_get_current_user();
				
		    	
		    	echo '<div class="col-md-4">
		    				<h4 class="list-group-item active">'.__('Personal Info','themeum').'</h4>
			    			<table class="table table-hover table-responsive personal-info">
							  	<tr>
							  		<td>'.__("Name: ","themeum").'</td>
							  		<td>'.esc_html($current_user->user_nicename).'</td>
							  	</tr>
							  	<tr>
							  		<td>'.__("Username: ","themeum").'</td>
							  		<td>'.esc_html($current_user->user_login).'</td>
							  	</tr>
							  	<tr>
							  		<td>'.__("Email: ","themeum").'</td>
							  		<td>'.sanitize_email($current_user->user_email).'</td>
							  	</tr>
							  	<tr>
							  		<td>'.__("Website: ","themeum").'</td>
							  		<td>'.esc_url($current_user->user_url).'</td>
							  	</tr>
							</table>
							<div class="margin15">
			    				<a class="pull-left btn btn-primary" href="'.esc_url(wp_logout_url( home_url() )).'" >'.__("Logout","themeum").'</a>
			    			</div>
						</div>
		    		';

// -------------------------------------------------------- Course list Start -------------------------------------------------------------------

			            	$profile_id = get_current_user_id();
			            	$post_id_public = '';
			            	$all_course_id = array();
			            	if( $profile_id != ''){
			            			// Get Paypal Paid Course List
							    	$args = array(
												'post_type'     => 'lmsorder', 
												'meta_query'    => array(
																array(
																	'key'     => 'themeum_order_user_id',
																	'value'   => $profile_id,
																	'compare' => '='
																	 )
															)
													);
								    $e_query = new WP_Query($args);
								    $course_id = 0;
								    $total_post = 0;

								    $paid_product = '';
								    while ( $e_query->have_posts() ) :  $e_query->the_post();
								    	$total_post++;
								    	$all_course_id[] = get_the_ID();
									    $paid_product .= '<a href="'.get_the_permalink(get_post_meta( get_the_ID() , "themeum_order_course_id" , true )).'" class="list-group-item"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> '.esc_html(get_the_title( get_post_meta( get_the_ID() , "themeum_order_course_id" , true ))).'</a>';
									endwhile;
									wp_reset_query();


									//Get course List From admin Assign
									$args = array(
											'post_type'  => 'student',
											'meta_query' => array(
												array(
													'key'     => 'themeum_user_name',
													'value'   => $profile_id,
													'compare' => '=',
												)
											)
										);
									$the_query = new WP_Query( $args );
									$public_profile_id = $the_course_id = '';
									if ( $the_query->have_posts() ) {
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
											$the_course_id = rwmb_meta('themeum_student_course','type=checkbox_list');					
										}
										wp_reset_query();
									}
									$all_course_id = array_merge($the_course_id,$all_course_id);





									// Get admin assigned course List
									if(is_array($the_course_id)){
										if( count($the_course_id)>0 ){
												$args=array(
															'post__in'       => $the_course_id,
															'post_type'      => 'course'
															);
												$posts_course = new WP_Query( $args );
												if ( $posts_course->have_posts() ) {
														while ( $posts_course->have_posts() ) {
															$total_post++;
															$posts_course->the_post();
															$paid_product .= '<a href="'.get_the_permalink().'" class="list-group-item"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> '.get_the_title().'</a>';
														}
													wp_reset_query();
												}
											}
										}

									if( $total_post > 0 ){
										$paid_product = '<div class="col-md-8 list-group"><h4 class="list-group-item active">'.__("Course Taken","themeum").'</h4>'.$paid_product;
										$paid_product .= '</div>';
									}


									echo $paid_product;

							}
// ----------------------------------------------------------------------- Course list Stop -------------------------------------------------------------------






// -------------------------------------------------------------------- Certifigate list  Start-------------------------------------------------------------------
						    if($profile_id != ''){
							    	// Get Paid Project From Paypal
									$args = array(
												'post_type'     => 'lmsorder', 
												'meta_query'    => array(
																array(
																	'key'     => 'themeum_order_user_id',
																	'value'   => $profile_id,
																	'compare' => '='  
																	 )
															)
												);
								    $e_query = new WP_Query($args);
								    $course_id = array();
								    $total_post = 0;
								    $course_title = '';
								    $certifigate = '';

								    while ( $e_query->have_posts() ) :  $e_query->the_post();
										$course_id[] = get_post_meta( get_the_ID() , "themeum_order_course_id" ,true );
										$course_title = get_the_title( get_post_meta( get_the_ID() , "themeum_order_course_id" ));
									endwhile;
									wp_reset_query();

									if (is_array($course_id)) {
										foreach ($course_id as  $value) {
											$certifigate .= '<a class="list-group-item" href="'.esc_url(get_option('certificate_page')).'?postid='.get_the_ID().'&courseid='.esc_attr($value).'"><i class="fa fa-check"></i> Certificate of <strong>'.esc_attr(get_the_title($value)).'</strong></a>';
										}
									}
								



									//Get Project From admin Assign
									$args = array(
											'post_type'  => 'student',
											'meta_query' => array(
												array(
													'key'     => 'themeum_user_name',
													'value'   => $profile_id,
													'compare' => '=',
												)
											)
										);
									$the_query = new WP_Query( $args );
									$public_profile_id = $post_id_public = $the_course_id = '';
									if ( $the_query->have_posts() ) {
										while ( $the_query->have_posts() ){
											$the_query->the_post();
											if( $course_title != '' ){
												$total_post++;
											}
											$public_profile_id = get_the_permalink(get_the_ID());
											$the_course_id = rwmb_meta('themeum_student_course','type=checkbox_list');
											$post_id_public = get_the_ID();
										}
										wp_reset_query();
									}



									// Get admin assigned course List
									if(is_array($the_course_id)){
										if( count($the_course_id)>0 ){
											$args=array(
														'post__in'       => $the_course_id,
														'post_type'      => 'course'
														);
											$posts_id = new WP_Query( $args );
											if ( $posts_id->have_posts() ) {
													while ( $posts_id->have_posts() ) {
														$total_post++;
														$posts_id->the_post();
														$certifigate .= '<a class="list-group-item" href="'.esc_url(get_option('certificate_page')).'?postid='.esc_attr($post_id_public).'&courseid='.get_the_ID().'"><i class="fa fa-check"></i> Certificate of <strong>'.get_the_title().'</strong></a>';
													}
												wp_reset_query();
											}
										}
									}
									if( $total_post > 0 ){
											$certifigate = '<div class="col-md-8 list-group pull-right"><h4 class="list-group-item active">'.__("Certificate List","themeum").'</h4>'.$certifigate;
											$certifigate .= '</div>';
										}

									echo $certifigate;
							}
// -------------------------------------------------------------------- Certifigate list  Stop-------------------------------------------------------------------


// ------------------------------------------ Quiz List Start --------------------------------------------
$quiz_html = '';

if(is_array($all_course_id)){
	if( count($all_course_id)>0 ){
		
		$quiz_details_html = '';
		$quiz_post_list = array(); 

		$args=array(
					'post__in'       => $all_course_id,
					'post_type'      => 'course'
					);
		$posts_id = new WP_Query( $args );
		if ( $posts_id->have_posts() ){
			while ( $posts_id->have_posts() ){
				$posts_id->the_post();
				$quiz_set = rwmb_meta('themeum_quiz_set','type=checkbox_list');
				if(!empty($quiz_set)){
					foreach ($quiz_set as $value) {
						$quiz_post_list[] = $value;		
					}
				}
			}
			wp_reset_query();
		}

		// question status
		$quiz_post_list = array_unique( $quiz_post_list );
		$args4=array(
					'post__in'       => $quiz_post_list,
					'post_type'      => 'question'
					);
		$post_data = new WP_Query( $args4 );
		if ( $post_data->have_posts() ){
			while ( $post_data->have_posts() ){
				$post_data->the_post();

				$trigger = get_user_meta( get_current_user_id(),'question-reasult',false );

				$percent = '';
				if( !empty($trigger) ){
					foreach ($trigger as $value){
						$value  = explode( '####', $value );
						if( $value[0] == get_the_ID() ){
							$percent = $value[1]; 
						}
					}
				}
				if( $percent != '' ){ $percent = $percent.'%'; }



				if( $percent == '' ){
					$quiz_details_html .= '<tr><td>'.get_the_title().'</td><td><a href="'.get_the_permalink().'">'.__("Take it","themeum").'</a></td></tr>';
				}else{
					$quiz_details_html .= '<tr><td>'.get_the_title().'</td><td>'.$percent.'</td></tr>';
				}
			

			}
			wp_reset_query();
		}


		$quiz_html 	.= '<div class="col-md-8 quiz-table pull-right">
							<table>
								<tr>
									<th>'.__('Quiz Title','themeum').'</th>
									<th>'.__('Action','themeum').'</th>
								</tr>
								'.$quiz_details_html.'
							</table>
						</div>';
	}
}
// ------------------------------------------ Quiz List Stop --------------------------------------------



echo $quiz_html;
?>


<?php
// Quiz List Stop ---------------------------------------------

					if($post_id_public != '' ){
						echo '<div class="col-md-8 pull-right">';
					echo '<a class="public-profile btn btn-primary" href="'.get_the_permalink( $post_id_public ).'">'.__('View Public Profile','themeum').'</a>';	
					echo '</div>';
				}
				
		    	ob_start();

	     }
	    else{
	    	login_form();
	    }
	    return ob_get_clean();
	}