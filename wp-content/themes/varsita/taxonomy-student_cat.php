<?php
/**
 * Display Student Category 
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

              $email      = rwmb_meta('themeum_student_email');
              $phone      = rwmb_meta('themeum_student_phone');
              $address      = rwmb_meta('themeum_student_address');
              $course       = rwmb_meta('themeum_student_course');


              $facebook     = rwmb_meta('themeum_student_facebook');
              $twitter      = rwmb_meta('themeum_student_twitter');
              $gplus      = rwmb_meta('themeum_student_gplus');
              $youtube      = rwmb_meta('themeum_student_youtube');
                ?>

                <div class="teachers-listing col-xs-12 col-sm-6 col-md-'.$column.'">
                    <figure class="team-member">

                        <?php if ( has_post_thumbnail() && ! post_password_required() ): ?> 
                            <?php echo get_the_post_thumbnail($post->ID, 'blog-thumb', array('class' => 'img-responsive')); ?>
                            <div></div>
                        <?php else: ?>
                            <div class="no-image" style="height:230px;width:100%"></div>
                            <div></div>
                        <?php endif; ?>

                        <figcaption>
                            <h3 class="person-title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title(); ?></a></h3>
                            
                            <?php 

                              if ($email) 
                              {
                                echo '<span class="person-deg">'.sanitize_email($email). '</span>';
                              }

                              if ($phone) 
                              {
                                echo '<p>' .esc_attr($phone). '</p>';
                              }

                              if ($address){
                                echo '<p>' .sanitize_email($address). '</p>';
                              }

                              if ($course){
                                echo '<p>' .esc_attr($course). '</p>';
                              }
                            ?>

                            <div class="person-social">
                              <ul class="social-person">
                                <?php
                                  if( $facebook ){
                                    echo '<li><a href="' .esc_url($facebook). '"><i class="fa fa-facebook"></i></a></li>';
                                  }

                                  if( $gplus ){
                                    echo '<li><a href="' .esc_url($gplus). '"><i class="fa fa-google-plus"></i></a></li>';
                                  }

                                  if( $twitter ){
                                    echo '<li><a href="' .esc_url($twitter). '"><i class="fa fa-twitter"></i></a></li>';
                                  }

                                  if( $youtube ){
                                    echo '<li><a href="' .esc_url($youtube). '"><i class="fa fa-youtube"></i></a></li>';
                                  }
                                ?>
                              </ul>
                            </div><!-- .person-social -->
                        </figcaption>

                  </figure>
              </div>
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