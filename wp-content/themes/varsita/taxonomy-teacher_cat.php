<?php
/**
 * Display Teacher Category
 *
 * @author 		Themeum
 * @category 	Template
 * @package 	Vasita
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

                $teacher_website      = rwmb_meta('themeum_teacher_website');
                $teacher_email        = rwmb_meta('themeum_teacher_email');
                $teacher_experience       = rwmb_meta('themeum_teacher_experience');
                $teacher_specialist       = rwmb_meta('themeum_teacher_specialist');
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
                              if ($teacher_specialist){
                                echo '<span class="person-deg">'.esc_html($teacher_specialist). '</span>';
                              }

                              if ($teacher_website){
                                echo '<p><a href="' .esc_url($teacher_website). '">' .esc_url($teacher_website). '</a></p>';
                              }

                              if ($teacher_email){
                                echo '<p>' .sanitize_email($teacher_email). '</p>';
                              }

                              if ($teacher_experience){
                                echo '<p>' .$teacher_experience. '</p>';
                              }
                            ?>

                            <div class="person-social">
                              <ul class="social-person">
                                <?php
                                  if( rwmb_meta( 'themeum_teacher_facebook' ) ){
                                    echo '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_facebook' )). '"><i class="fa fa-facebook"></i></a></li>';
                                  }

                                  if( rwmb_meta( 'themeum_teacher_gplus' ) ){
                                    echo '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_gplus' )). '"><i class="fa fa-google-plus"></i></a></li>';
                                  }

                                  if( rwmb_meta( 'themeum_teacher_twitter' ) ){
                                    echo '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_twitter' )). '"><i class="fa fa-twitter"></i></a></li>';
                                  }

                                  if( rwmb_meta( 'themeum_teacher_youtube' ) ){
                                    echo '<li><a href="' .esc_url(rwmb_meta( 'themeum_teacher_youtube' )). '"><i class="fa fa-youtube"></i></a></li>';
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