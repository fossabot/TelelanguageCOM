<?php
/**
 * Display Event Category 
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

                  $event_start_datetime   = esc_attr(rwmb_meta('themeum_event_start_datetime'));
                  $event_end_datetime     = esc_attr(rwmb_meta('themeum_event_end_datetime'));
                  $event_place            = rwmb_meta('themeum_event_place');
                  $event_speakers         = rwmb_meta('themeum_event_speaker','type=checkbox_list');
                
                  echo '<div class="event-page">';
                    echo '<div class="row">';
                      echo '<div class="col-xs-4 col-sm-4">';
                        echo '<div class="event-img">';
                          if ( has_post_thumbnail() && ! post_password_required() ) {
                            echo  get_the_post_thumbnail(get_the_ID(), 'blog-thumb', array('class' => 'img-responsive'));
                          }else {
                            if( $event_start_datetime ) {
                              echo '<div class="event-date">'; 
                              echo '<span class="date">' .date("d", strtotime($event_start_datetime)). ' </br></span>';
                                echo '<span class="month">' .date("M", strtotime($event_start_datetime)). '</span>';
                              echo '</div>';  
                            }
                          }

                        echo '</div>';
                      echo '</div>'; //col-sm-5

                      echo '<div class="col-xs-8 col-sm-8">';
                        echo '<div class="event-info">';
                          echo '<div class="event-info-title">';
                            echo '<h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
                          echo '</div>';

                          echo '<div class="event-info-text">';          
                            echo '<div class="event-info-middle">';
                              if($event_speakers) 
                              { 
                                $posts_id = array();
                                $spost = '';
                                foreach ($event_speakers as $value)
                                {
                                  $spost = get_posts(array('post_type' => 'speaker', 'name' => $value));
                                  $posts_id[] = $spost[0]->ID;
                                }
                      
                                $event_speakers = get_posts( array( 'post_type' => 'speaker', 'post__in' => $posts_id, 'posts_per_page'   => 20) );
                                echo '<p style="display:inline;"><span class="event-bold">'.__('Speakers : ','themeum-lms').'</span></P>'; 
                                echo '<ul class="event-speaker-listing" style="display:inline">';
                                  foreach ($event_speakers as $key=>$post) 
                                  { setup_postdata( $post );
                                    echo '<li>';
                                      echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
                                    echo '</li>';
                                  }
                                  wp_reset_postdata();
                                echo '</ul>';

                              }
                              if($event_start_datetime) 
                              {
                                echo '<p><span class="event-bold">'. __('Date :','themeum-lms'). '</span>' .date("F d, Y", strtotime($event_start_datetime)). ' - ' .date("F d, Y", strtotime($event_end_datetime)).'</p>';
                                echo '<p><span class="event-bold">'.__('Time :','themeum-lms'). '</span>' .date("H:i A", strtotime($event_start_datetime)). ' - ' .date("H:i A", strtotime($event_end_datetime)).'</p>';
                              }
                              if( $event_place ) 
                              {
                                echo '<p><span class="event-bold">' .__('Location :','themeum-lms').'</span>'.$event_place.'</p>';
                              }
                            ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>    
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