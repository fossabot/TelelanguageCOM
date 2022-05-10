<?php
/**
 * Display Single Lesson
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
					global $wpdb;
					$sql = '';
					if ( is_user_logged_in() ) { 
						$sql = "SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_order_course_id' AND `meta_value` IN (SELECT `post_id` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_course_lessons' AND `meta_value`='".$post->post_name."') AND `post_id` IN (SELECT `post_id` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_order_user_id' AND `meta_value`='".get_current_user_id()."')";
					}
					$results = $wpdb->get_results($sql);

					if(count($results) == 0 ){
						 	$sql2 = "SELECT * FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_student_course' AND `meta_value` IN (SELECT `post_id` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_course_lessons' AND `meta_value`='".$post->post_name."') AND `post_id` IN (SELECT `post_id` FROM `".$wpdb->prefix."postmeta` WHERE `meta_key`='themeum_user_name' AND `meta_value`='".get_current_user_id()."')";
							$results = $wpdb->get_results($sql2);
						}

				?>
				
				<?php if ( ( count($results) > 0 ) || ( rwmb_meta('themeum_lesson_lesson_type') == "free" ) || is_super_admin() ): ?>

				<?php
					$lessons_course 		= rwmb_meta('themeum_lesson_course','type=checkbox_list');
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(array('class' => 'col-sm-8' )); ?>>

					<div class="lesson-details">
						<div class="lesson-details-img">
						
							<?php 
							if(get_post_meta( get_the_ID() ,'themeum_lesson_video_file', true) != ""){ 
									echo do_shortcode('<div class="video-container">[video mp4="'.wp_get_attachment_url(get_post_meta( get_the_ID() ,'themeum_lesson_video_file', true)).'" width="650" height="360"]</div>'); 
								}
							else{
									if(rwmb_meta("themeum_lesson_video_url") != '' ){
										echo '<div class="video-container">'.wp_oembed_get(rwmb_meta("themeum_lesson_video_url"), '').'</div>';
									}
									else{
										if ( has_post_thumbnail() && ! post_password_required() ){ 
											the_post_thumbnail('blog-thumb', array('class' => 'img-responsive')); 
										}
									}
								}

							?>
              		
			            </div><!--/.cousre-details-img-->

						<div class="course-details-inner">
							 <h3><?php the_title() ;?></h3>
							<?php the_content();?>
							
							<?php 
							$id_list = get_post_meta( get_the_ID() ,'themeum_lesson_attachment');
							if(!empty($id_list)){
								$i=1;
								foreach ($id_list as $key) {
									$sm = wp_get_attachment_url($key);
									if("" != $sm){
										echo '<a href="'.esc_url($sm).'" class="btn btn-default" role="button">'.__('Download Attachment ','themeum-lms').$i.'</a>';
										$i++;
									}
								} 
							}

							?>
						</div><!--/.course-details-text-->

					</div><!--/.course-details-->



					<?php if(!empty($lessons_course)) { ?>

						 <div class="lesson-list">
							<?php 
								$posts_id = array();
								foreach ($lessons_course as $value) {
									$posts = get_posts(array('post_type' => 'course', 'name' => $value));
									$posts_id[] = $posts[0]->ID;
								}
								$lessons_course = get_posts( array( 'post_type' => 'course', 'post__in' => $posts_id, 'posts_per_page'   => 40) );
							?>

							<h2><?php echo __('All Lessons', 'themeum-lms'); ?></h2>

								<?php foreach ($lessons_course as $key=>$post) {
								setup_postdata( $post ); ?>

								<?php  $all = get_post_meta( get_the_ID(), 'themeum_course_lessons'); ?>
								
									<ul class="lesson-lists">
										<?php foreach ($all  as $slug) {
										$args=array(
											'name'           => $slug,
											'post_type'      => 'lesson',
											'posts_per_page' => 1
										);
										$lesson = get_posts($args);
										?>
										<li>
					                  		<a href="<?php echo get_permalink($lesson[0]->ID);?>" class="teacher-name"><?php echo $lesson[0]->post_title; ?></a>
										</li>

										<?php } ?>
									</ul>
									
								<?php } ?>

								<?php wp_reset_postdata(); ?>

						</div><!--/.lesson-list-->

					<?php } ?>

				</div><!--/#post-->
				<?php 
					else: 
						echo __("You don't have access to see this video.");
					endif;
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

