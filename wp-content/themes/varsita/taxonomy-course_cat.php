<?php
/**
 * Display Course Category
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Varsita
 *-------------------------------------------------------------*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header();
?>
<section id="main" class="clearfix">

   <?php get_template_part('lib/sub-header')?>

  <div id="page" class="container">
    <div class="row">
      <div id="content" class="courses col-md-8" role="main">
        <div class="row">
          <?php

          if ( have_posts() ) {
            while(have_posts()) { the_post();

              $course_price         = rwmb_meta('themeum_course_price');
              $course_lesson_number     = rwmb_meta('themeum_course_lesson_number');
              $themeum_course_attachment  = rwmb_meta('themeum_course_attachment');
                ?>

                <div id="post-<?php the_ID(); ?>" class="col-xs-12 col-sm-6">
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
                        <p><?php echo the_excerpt_max_charlength(60); ?></p>
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
                            <span><?php echo esc_html($themeum_course_attachment); ?></span> 
                          <?php } ?>

                        </div>
                        <?php } ?>
                    </div> <!--/.details-->
                  </div><!--/.themeumlms-course-wrap-->
                </div><!--/.col-sm-8-->

              <?php 
            }
            themeum_pagination(); 
          }
          ?>
        </div>
      </div><!--/#content-->
      <div id="sidebar" class="col-sm-4" role="complementary">
            <aside class="widget-area">
            <?php dynamic_sidebar('coursesidebar'); ?>
          </aside>
        </div> <!-- #sidebar -->
    </div>
  </div>
</section> 
<?php
get_footer();