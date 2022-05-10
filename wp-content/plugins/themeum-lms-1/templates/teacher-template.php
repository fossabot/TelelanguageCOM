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
					$teacher_website 		= esc_url(rwmb_meta('themeum_teacher_website'));
					$teacher_email 			= sanitize_email(rwmb_meta('themeum_teacher_email'));
					$teacher_experience 	= esc_html(rwmb_meta('themeum_teacher_experience'));
					$teacher_specialist 	= esc_html(rwmb_meta('themeum_teacher_specialist'));
					$teacher_lesson_course 	= rwmb_meta('themeum_teacher_lesson_course','type=checkbox_list');
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

							<?php if ($teacher_specialist) { ?>
								<p><?php echo $teacher_specialist; ?></p>
							<?php } ?>

							<?php if ($teacher_experience) { ?>
								<p><?php echo $teacher_experience; ?></p>
							<?php } ?>

							<?php if ($teacher_email) { ?>	
								<p><?php echo $teacher_email; ?></p>
							<?php } ?>							

							<?php if ($teacher_website) { ?>
								<p><a href="<?php echo $teacher_website; ?>"><?php echo $teacher_website; ?></a></p>
							<?php } ?>

							<ul class="teacher-share-btn">

								<?php if( rwmb_meta( 'themeum_teacher_facebook' ) ) { ?>
								<li><a href="<?php echo esc_url(rwmb_meta( 'themeum_teacher_facebook' )); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<?php } ?>

								<?php if( rwmb_meta( 'themeum_teacher_gplus' ) ) { ?>
								<li><a href="<?php echo esc_url(rwmb_meta( 'themeum_teacher_gplus' )); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<?php } ?>

								<?php if( rwmb_meta( 'themeum_teacher_twitter' ) ) { ?>
								<li><a href="<?php echo esc_url(rwmb_meta( 'themeum_teacher_twitter' )); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php } ?>

								<?php if( rwmb_meta( 'themeum_teacher_youtube' ) ) { ?>
								<li><a href="<?php echo esc_url(rwmb_meta( 'themeum_teacher_youtube' )); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
								<?php } ?>
							</ul>

							<div class="course-details-text">
								<?php the_content();?>
							</div><!--/.page-details-text-->

		                </div>
		            

						<?php if(!empty($teacher_lesson_course)) { ?>
						 <div class="course-teacher col-sm-12">
							<?php 
								$posts_id = array();
								foreach ($teacher_lesson_course as $value) {
									$posts = get_posts(array('post_type' => 'course', 'name' => $value));
									if(!empty($posts)){ $posts_id[] = $posts[0]->ID; }
								}
								$teacher_lesson_course = get_posts( array( 'post_type' => 'course', 'post__in' => $posts_id, 'posts_per_page'   => 20) );
							?>

							<h2><?php echo __('Related Course', 'themeum-lms'); ?></h2>
							<div class="row">

								<?php foreach ($teacher_lesson_course as $key=>$post) {

					              $course_price         = rwmb_meta('themeum_course_price');
					              $course_lesson_number     = rwmb_meta('themeum_course_lesson_number');
					              $themeum_course_attachment  = rwmb_meta('themeum_course_attachment');

								setup_postdata( $post ); ?>

								<div class="col-sm-6">
				                  <div class="themeumlms-course-wrap">
				                    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
				                      <figure class="themeumlms-course-img">
				                         <?php echo get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('class' => 'img-responsive')); ?>
				                         <figcaption class="text-center">
				                              <a href="<?php echo get_the_permalink(); ?>">
				                                  <?php _e('Details','themeum-lms'); ?>
				                              </a>
				                          </figcaption>
				                      </figure>
				                    <?php } else { ?>

				                      <figure class="themeumlms-course-none">
				                       <figcaption class="text-center">
				                            <a href="<?php echo get_the_permalink(); ?>">
				                                <?php _e('Details','themeum-lms'); ?>
				                            </a>
				                        </figcaption>
				                      </figure>

				                    <?php } //.entry-thumbnail ?>

				                    <div class="details">

				                        <h3><a href="<?php echo get_permalink($id);?>"><?php the_title();?></a></h3>
				                        <h4> <?php _e('by','themeum-lms'); ?> <strong> <?php echo get_the_author(); ?></strong></h4>
				                        <p><?php echo the_excerpt_max_charlength(40); ?></p>
				                        <?php 
				                        
				                        $currency_array = array('AUD' => '$','BRL' => 'R$','CAD' => '$','CZK' => 'Kč','DKK' => 'kr.','EUR' => '€','HKD' => 'HK$','HUF' => 'Ft','ILS' => '₪','JPY' => '¥','MYR' => 'RM','MXN' => 'Mex$','NOK' => 'kr','NZD' => '$','PHP' => '₱','PLN' => 'zł','GBP' => '£','RUB' => '₽','SGD' => '$','SEK' => 'kr','CHF' => 'CHF','TWD' => '角','THB' => '฿','TRY' => 'TRY','USD' => '$');
										$symbol = '';
										$currency_type = get_option('paypal_curreny_code');
										if (array_key_exists( $currency_type , $currency_array)) {
										    $symbol = $currency_array[$currency_type];
										}else{
											 $symbol = '$';
										}

				                        if ( $course_price || $course_lesson_number || $themeum_course_attachment ) { ?>
				                        <div class="course-details-span">

				                          <?php if($course_price) { ?>
				                            <span><?php echo esc_html($symbol); echo esc_html($course_price); ?></span>
				                          <?php } else { ?>
				                            <span><?php _e('Free', 'themeum-lms'); ?></span>
				                          <?php }
				                          
				                          if( $course_lesson_number != "" ){ ?>
				                            <span> <?php echo esc_html($course_lesson_number); ?> </span>
				                          <?php }

				                          if( $themeum_course_attachment != "" ){  ?>
				                            <span><?php echo esc_url($themeum_course_attachment); ?></span> 
				                          <?php } ?>

				                        </div>
				                        <?php } ?>
				                    </div> <!--/.details-->
				                  </div><!--/.themeumlms-course-wrap-->
								</div><!--/.col-sm-3-->	
								<?php } ?>
								<?php wp_reset_postdata(); ?>
							</div><!--/.row-->	
						</div><!--/.course-teacher-->

					<?php } ?>

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

