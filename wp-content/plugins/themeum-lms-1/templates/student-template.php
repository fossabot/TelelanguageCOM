<?php
/**
 * Display Single Teacher 
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Varsity
 * @version     1.0
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header();
?>

<section id="main" class="clearfix">

	<?php require_once 'sub-header.php'; ?>
	
	<div id="page" class="container">
		<div class="row">

			<?php while(have_posts()): the_post(); ?>

				<?php
				$email 			= rwmb_meta('themeum_student_email');
				$phone   	 	= rwmb_meta('themeum_student_phone');
				$address   	 	= rwmb_meta('themeum_student_address');
				$course   	 	= rwmb_meta('themeum_student_course','type=checkbox_list');
				
				$facebook 		= rwmb_meta('themeum_student_facebook');
				$twitter   	 	= rwmb_meta('themeum_student_twitter');
				$gplus   	 	= rwmb_meta('themeum_student_gplus');
				$youtube   	 	= rwmb_meta('themeum_student_youtube');
				$profile_id   	= rwmb_meta('themeum_user_name');
				$post_id_public = get_the_ID();
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(array('class' => 'col-sm-8' )); ?>>

					<div class="page-details">
						<div class="col-sm-5">
              				<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
							<?php the_post_thumbnail('teaher-thumb', array('class' => 'img-responsive')); ?>
							<?php } //.entry-thumbnail ?>
						</div>

		                <div class="col-sm-7">
							<h3><a href="<?php echo get_permalink($id);?>"><?php the_title();?></a></h3>

							<?php if ($email) { ?>	
								<p><?php echo sanitize_email($email); ?></p>
							<?php } ?>	

							<?php if ($phone) { ?>	
								<p><?php echo esc_attr($phone); ?></p>
							<?php } ?>

							<?php if ($address) { ?>	
								<p><?php echo esc_html($address); ?></p>
							<?php } ?>	


							<ul class="teacher-share-btn">

								<?php if( $facebook ) { ?>
								<li><a href="<?php echo esc_url($facebook); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<?php } ?>

								<?php if( $gplus ) { ?>
								<li><a href="<?php echo esc_url($gplus); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<?php } ?>

								<?php if( $twitter ) { ?>
								<li><a href="<?php echo esc_url($twitter); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php } ?>

								<?php if( $youtube ) { ?>
								<li><a href="<?php echo esc_url($youtube); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
								<?php } ?>
							</ul>

							<div class="course-details-text">
								<?php the_content();?>
							</div><!--/.page-details-text-->

		                </div>
		            

		            	<div class="course-teacher col-sm-12">
		            		<?php


// -------------------------------------------------------- Course list Start -------------------------------------------------------------------
			            	if( $profile_id != ''){
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
									    $paid_product .= '<a href="'.get_the_permalink(get_post_meta( get_the_ID() , "themeum_order_course_id" , true )).'" class="list-group-item"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> '.esc_html(get_the_title( get_post_meta( get_the_ID() , "themeum_order_course_id" , true ))).'</a>';
									endwhile;
									wp_reset_query();


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
										while ( $the_query->have_posts() ) {
											$the_query->the_post();
											$the_course_id = rwmb_meta('themeum_student_course','type=checkbox_list');					
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
										$paid_product = '<div class="col-md-12 list-group"><h4 class="list-group-item active">'.__("Course Taken","themeum").'</h4>'.$paid_product;
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
											$certifigate = '<div class="col-md-12 list-group pull-right"><h4 class="list-group-item active">'.__("Certificate List","themeum").'</h4>'.$certifigate;
											$certifigate .= '</div>';
										}

									echo $certifigate;
							}
// -------------------------------------------------------------------- Certifigate list  Stop-------------------------------------------------------------------




// -------------------------------------------------------------------- Certifigate list  Stop-------------------------------------------------------------------
// -------------------------------------------------------------------- Certifigate list  Stop-------------------------------------------------------------------
		            		 ?>
							

							<div class="row">
								
							</div>
		            	</div>

					</div><!--/.page-details-->

				</div><!--/#post-->

			<?php endwhile; ?>

			<div id="sidebar" class="col-sm-4" role="complementary">
		        <div class="sidebar-inner">
		          <aside class="event-widget-area">
		           <?php dynamic_sidebar('coursesidebar');?>
		         </aside>
		       </div>
	        </div><!--/#sidebar-->

		</div><!--/.row-->
	</div><!--/.container-->
</section>
<?php get_footer();

