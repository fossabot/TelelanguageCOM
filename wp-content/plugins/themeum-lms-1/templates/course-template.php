<?php
/**
 * Display Single Course 
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Varsity
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
					$course_sub_name 		= esc_html(rwmb_meta('themeum_course_sub_name'));
					$course_price 			= esc_attr(rwmb_meta('themeum_course_price'));
					$course_teachers 		= rwmb_meta('themeum_course_teacher','type=checkbox_list');
					$course_list 			= rwmb_meta('course_list');
					$visitor_count = get_post_meta( $post->ID, '_post_views_count', true);
					if( $visitor_count == '' ){ $visitor_count = 0; }
					$total_time 			= rwmb_meta('themeum_total_time');
					$review 				= get_post_meta( get_the_ID() ,'themeum-review', false );
					$watch_trailer			= get_post_meta( get_the_ID() ,'themeum_watch_trailer', true );
				?>
				<?php
					// Check This is purchase or not
					global $wpdb;
					$sql = '';
					$results = array();
					if ( is_user_logged_in() ) { 
						$sql = "SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_order_course_id' AND `meta_value`='".$post->ID."' AND `post_id` IN (SELECT `post_id` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_order_user_id' AND `meta_value`='".get_current_user_id()."')";
						$results = $wpdb->get_results($sql);
						if(!count($results)>0){
							$sql2 = "SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_student_course' AND `meta_value`='".$post->ID."' AND `post_id` IN (SELECT `post_id` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_user_name' AND `meta_value`='".get_current_user_id()."')";
							$results = $wpdb->get_results($sql2);
						}
					}	
				?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(array('class' => 'col-sm-8' )); ?>>
					<div class="course-details">
				        <header>
				           <h2 class="course-title"> <?php the_title() ;?> </h2>
				           <span class="course-entry-rate">
					           	<?php
					           	$rate = array();
								$total_rate = 0;
								foreach ($review as  $value){
									$arr = explode( '####', $value);
									$rate[] = (int)$arr[1];
									$total_rate = (int)$arr[1] + $total_rate;
								}

								if( $total_rate != 0 ){
									$rate = round(5*($total_rate/(5*count($review))));
								}else{
									$rate = 0;
								}

								echo '<ul class="list-unstyled list-inline entry-rate-list">';
									for ($i=0; $i <=4 ; $i++) {  
										if( $rate <= $i  ){
											echo '<li><i class="fa fa-star-o"></i></li>';
										}else{
											echo "<li><i class='fa fa-star'></i></li>";
										}
									}
								echo '</ul>';

					           	 _e('Ratings','themeum-lms'); ?>
					           	(<?php echo count( $review );?>)
				           	</span>
				           	<ul class="course-entry-meta">
				           		<li><?php echo get_the_date('F d, Y'); ?></li>
				           		<li> <?php _e('Viewers','themeum-lms'); ?>: <?php echo $visitor_count; ?></li>
				           		<?php if( has_tag() ){ ?><li><?php _e('Tag','themeum-lms'); ?> : <?php echo get_the_tag_list('',', ',''); ?></li><?php } ?>
				           	</ul>
				        </header> <!--/header--> 
          				<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
          				<div class="cousre-details-img">
							<?php the_post_thumbnail('course-thumb', array('class' => 'img-responsive')); ?>
						
							<div class="course-title">
				                <p><?php the_title() ;?></p>
				                <?php if ($course_sub_name) { ?>
				                	<p class="coursr-title-bold"><?php echo esc_html($course_sub_name); ?></p>
				                <?php } ?>
			                </div>
		                </div><!--/.cousre-details-img--> 
						<?php } ?>
						<div class="course-details-text">
							<?php echo get_the_content(); ?>
						</div><!--/.course-details-text-->
			            <div class="course-details-title">
				              <div class="title-left">
				                <ul>
				                <?php if( ($watch_trailer) != '' ){ ?>
				                <li><a class="btn btn-primary btn-watch" href="<?php echo $watch_trailer;?>" target="_blank"><?php _e('Watch Trailer','themeum-lms'); ?></a></li>
				                <?php } ?>
				                <li>
				                  	<?php
										$currency_array = array('AUD' => '$','BRL' => 'R$','CAD' => '$','CZK' => 'Kč','DKK' => 'kr.','EUR' => '€','HKD' => 'HK$','HUF' => 'Ft','ILS' => '₪','JPY' => '¥','MYR' => 'RM','MXN' => 'Mex$','NOK' => 'kr','NZD' => '$','PHP' => '₱','PLN' => 'zł','GBP' => '£','RUB' => '₽','SGD' => '$','SEK' => 'kr','CHF' => 'CHF','TWD' => '角','THB' => '฿','TRY' => 'TRY','USD' => '$');
										$symbol = '';
										$currency_type = get_option('paypal_curreny_code');
										if (array_key_exists( $currency_type , $currency_array)) {
										    $symbol = $currency_array[$currency_type];
										}else{
											 $symbol = '$';
										}
									?>

									<?php
								  	$buy_now = '';
									if( get_post_type() == "course" ){						  
										$current_user = wp_get_current_user(); 
										$price = "";
										$price = rwmb_meta('themeum_course_price');

										$buy_now = '<form id="buy_now_form" action="'.esc_url(admin_url('admin-ajax.php')).'" method="post" >
														  <input type="hidden" name="user_id" value="'.$current_user->ID.'">
														  <input type="hidden" name="email" value="'.$current_user->user_email.'">
														  <input type="hidden" name="product_id" value="'.get_the_ID().'">
														  <input type="hidden" name="product_name" value="'.get_the_title(get_the_ID()).'">
														  <input type="hidden" name="price" value="'.esc_html($price).'">
														  <span id="spinner"><i class="fa fa-spinner fa-spin"></i></span>
														  <input type="button" class="btn btn-primary" id="submitbtn" value="'.esc_html($symbol). '' .esc_attr($course_price).' - '.__("Buy Now","themeum-lms").' "/>
													</form>
													<div id="simple-msg"></div>
													<div id="simple-msg-err"></div>
													<div id="checkout-url" style="display:none;">'.esc_attr(site_url()).'/?p='.esc_attr(get_option("paypal_payment_checkout_page_id")).'</div>
													';
										}
									if($price == "" || $price == 0 || (count($results)>0) ){}
									else{ echo $buy_now; }
								   ?>
							  	</li>

				                </ul>
				              </div>
				               <?php
				              	if( $total_time != '' ){ ?>
					              <div class="title-right pull-right btn-duration">
					              <?php
						              _e('Course Durations: ','themeum-lms');
						              echo '<strong>'.$total_time.'</strong>';
					              ?>							  
					              </div>
				              <?php } ?>	
			            </div><!--/.course-details-title-->

			            <div class="course-single-lessons clearfix">
							<!-- Course Lesson List Start Here  -->
							<?php 
							if(is_array( $course_list )) {
								if(isset($course_list[0]['themeum_course_lessons'])){ 
								foreach ($course_list as $course_lessons) { //Loop #course Category
							?>

									<div class="course-single-lessons-inner">
										<h4 class="course-category-title"><?php echo $course_lessons['themeum_course_category']; ?></h4>
										<p><?php echo $course_lessons['themeum_course_description']; ?></p>
										
										<?php if(!empty($course_lessons)) { ?>
											 <div class="course-lessons">
												<?php 
													$posts_id = array();
													foreach ($course_lessons['themeum_course_lessons'] as $value) {
														$posts = get_posts(array('post_type' => 'lesson', 'name' => $value ));
														$posts_id[] = $posts[0]->ID;
													}
													$lessons_all = get_posts( array( 'post_type' => 'lesson', 'post__in' => $posts_id, 'posts_per_page'   => 40) );
												?>
												<ul>
													<?php foreach ($lessons_all as $post) {
													$lesson_duration =	rwmb_meta('themeum_lesson_duration');
													setup_postdata( $post ); ?>
													<li>
										                <?php if ( (count($results) > 0) || (rwmb_meta('themeum_lesson_lesson_type')=='free' ) ):  ?>
										                	<span><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></span>
										                <?php else: ?>
															<span><i class="fa fa-lock"></i> <a href="#"><?php the_title(); ?></a></span>
										                <?php endif; ?>
										                <?php if ($lesson_duration) { ?>
										                	<span class="pull-right"><?php  _e('Duration : ','themeum-lms'); echo esc_html($lesson_duration);  ?></span>
										                <?php } ?>
													</li><!--li-->	
													<?php } ?>
													<?php wp_reset_postdata(); ?>
												</ul><!--ul-->	
											</div><!--/.course-teacher-->
										<?php } ?>
									</div>

							<?php
									}
								}
							}
							?>
							<!-- Course Lesson List End Here  -->
			            </div>
					</div><!--/.course-details-->

					<?php if(!empty($course_teachers)) { ?>
						 <div class="course-teacher">
							<?php 
								$posts_id = array();
								foreach ($course_teachers as $value) {
									$posts = get_posts(array('post_type' => 'teacher', 'name' => $value ));
									$posts_id[] = $posts[0]->ID;
								}
								$course_teachers = get_posts( array( 'post_type' => 'teacher', 'post__in' => $posts_id, 'posts_per_page'   => 20) );
							?>
							<h3><?php echo __('Meet Our Course Teacher', 'themeum-lms'); ?></h3>
							<div class="row">
								<?php foreach ($course_teachers as $key=>$post) {

								setup_postdata( $post ); ?>

								<div class="col-sm-3">
					                <div class="course-teacher-img">
					                	<?php if ( has_post_thumbnail() && ! post_password_required() ) { 
					                		//$thumb_src = wp_get_attachment_url( get_post_thumbnail_id ( $post->ID ),'course-teacher-thumb' );
					                		$thumb_src =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'course-teacher-thumb' ); ?>
					                  		<a href="<?php echo get_permalink($post->ID);?>"><img src="<?php echo $thumb_src[0]; ?>" alt="<?php echo get_the_title(); ?>" class="img-responsive" /></a>
					                    <?php } //.entry-thumbnail ?>
					                </div><!--/.course-teacher-img-->	

					                <div class="course-teacher-info">
					                  <a href="<?php echo get_permalink($post->ID);?>" class="teacher-name"><?php the_title(); ?></a><br>
					                  <p class="teacher-department"><?php echo esc_html(rwmb_meta('themeum_teacher_specialist')); ?></p>
					                </div> <!--/.course-teacher-img-->	

								</div><!--/.col-sm-3-->	
								<?php } ?>
								<?php wp_reset_postdata(); ?>
							</div><!--/.row-->	
						</div><!--/.course-teacher-->
					<?php } ?>


					<!-- Review Start -->
					<div class="course-review">
						<h3><?php _e('Course Reviews','themeum-lms');?></h3><br>
						<div class="review-list"> <!-- .review-list -->
						<?php 
						if(is_array($review)){ 
							if(!empty($review)){
								echo '<ul>';
								foreach ($review as $value){
									echo '<li class="media">';
									$arr = explode( '####', $value);
									$message = $arr[0];
									$rating = $arr[1];
									$userid = $arr[2];	

									$user_info = new WP_Query( 
														array( 
															'post_type' => 'student',
															'meta_query' => array(
																				array(
																					'key'     => 'themeum_user_name',
																					'value'   => $userid,
																					'compare' => '=',
																				),
																			),
															'posts_per_page'   => 1,
															) 
														);

									if ( $user_info->have_posts() ) {
										while ( $user_info->have_posts() ) {
											$user_info->the_post();
											if( has_post_thumbnail() ){
												echo '<div class="reviewer-image pull-left">';
													echo '<img src="'.wp_get_attachment_thumb_url( get_post_thumbnail_id(get_the_ID()) ).'">';
												echo '</div>';
											}
											echo '<div class="reviewer-data media-body">';
											echo '<h3>'.get_the_title().'</h3>';
										}
									}		
									if( $userid == get_current_user_id() ){
										echo "<span><a class='edit-review' href='#review-form'><i class='fa fa-edit'></i></a></span>";
									}
									wp_reset_postdata();
									echo "<div class='rating-number hidden'>".$rating.'</div>'; 
									?>

						           	<div class="course-entry-rate">
							           	<?php
										echo '<ul class="list-unstyled list-inline entry-rate-list">';
											for ($i=0; $i <=4 ; $i++) {  
												if( $rating <= $i  ){
													echo '<li><i class="fa fa-star-o"></i></li>';
												}else{
													echo "<li><i class='fa fa-star'></i></li>";
												}
											}
										echo '</ul>';
										echo '('.$rating.'/5)';
										?>
						           	</div>
									<?php echo '<p class="rating-body">'.$message.'</p>';
									echo '</div>';
									echo '</li>';
									}
								echo '</ul>';
								}
							}
							?>	

						</div> <!-- /.review-list -->


						<?php if( count($results) > 0 ){ ?>
							<div id="review-form" class="review-form"> <!-- .review-form -->
								<h3><?php _e('Post Your Reviews','themeum-lms');?></h3><br>
								<form name="review-submit-form" action="<?php echo esc_url(admin_url("admin-ajax.php")); ?>" method="post" id="review-submit-form">
									
									<input type="hidden" name="action" value="review_form">
									<input type="hidden" name="review-post-id" value="<?php echo esc_attr(get_the_ID()); ?>">
									<input type="hidden" name="user-id" value="<?php echo get_current_user_id(); ?>">
									<input type="hidden" id="redirect-url" name="redirect-url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
									
									<textarea name="review-message" class="review-message"></textarea><br>
									<div class="review-rating">	
										<div class="pull-left">
										<h4 class="rating-text">Your Rating</h4>
										    <span><input type="radio" name="rating" value="1"></span>
										    <span><input type="radio" name="rating" value="2"></span>
										    <span><input type="radio" name="rating" value="3"></span>
										    <span><input type="radio" name="rating" value="4"></span>
										    <span><input type="radio" name="rating" checked value="5"></span>
										</div>
										<div class="pull-right">	
											<input type="submit" value="Submit">
										</div>
										<div class="clearfix"></div>
									</div>
								</form>
							</div> <!-- /.review-form -->
						<?php } ?>

					</div><!-- Review Close -->


				</div><!--/#post-->
				<?php
				    // This is Count The Number of post visitor. 
				    $count_post = get_post_meta( $post->ID, '_post_views_count', true);
				    if( $count_post == ''){
				        $count_post = 0;
				        update_post_meta( $post->ID, '_post_views_count', $count_post);
				    }else{
				        $count_post = (int)$count_post + 1;
				        update_post_meta( $post->ID, '_post_views_count', $count_post);
				    }
				?>				
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

