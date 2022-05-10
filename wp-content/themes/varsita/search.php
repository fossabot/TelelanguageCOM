<?php get_header(); ?>

<section id="main">

   <?php get_template_part('lib/sub-header')?>

    <div class="container">
        <div class="row">
                <?php if(isset($_GET['post_type'])):  ?>
                    
                    <?php if(have_posts()):  ?>
                        <?php while ( have_posts() ) : the_post(); ?>

                          
                        <?php 
                                $course_price         = rwmb_meta('themeum_course_price');
                                $course_lesson_number     = rwmb_meta('themeum_course_lesson_number');
                                $themeum_course_attachment  = rwmb_meta('themeum_course_attachment');
                        ?>

                        <div class="col-xs-12 col-sm-6">
                            <div class="themeumlms-course-wrap">

                              <?php if ( has_post_thumbnail() && ! post_password_required() ){ ?>
                              <figure class="themeumlms-course-img">
                              <?php echo  get_the_post_thumbnail($post->ID, 'portfolio-thumb', array('class' => 'img-responsive')); ?>
                              <figcaption class="text-center">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <?php _e('Details','themeum-lms'); ?>
                                    </a>
                              </figcaption>
                              </figure>
                              <?php }else{ ?>
                              <figure class="themeumlms-course-none">
                                <figcaption class="text-center">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                                  <?php _e('Details','themeum-lms'); ?>
                                              </a>
                                </figcaption>
                              </figure>
                              <?php } ?>

                              <div class="details">
                              <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                              <h4> <?php echo _e('by','themeum-lms'); ?> <strong><?php echo get_the_author(); ?> </strong></h4>
                              <p><?php echo the_excerpt_max_charlength(70); ?></p>
                              
                              <?php  
                                //get_option('paypal_curreny_code')
                                $currency_array = array('AUD' => '$','BRL' => 'R$','CAD' => '$','CZK' => 'Kč','DKK' => 'kr.','EUR' => '€','HKD' => 'HK$','HUF' => 'Ft','ILS' => '₪','JPY' => '¥','MYR' => 'RM','MXN' => 'Mex$','NOK' => 'kr','NZD' => '$','PHP' => '₱','PLN' => 'zł','GBP' => '£','RUB' => '₽','SGD' => '$','SEK' => 'kr','CHF' => 'CHF','TWD' => '角','THB' => '฿','TRY' => 'TRY','USD' => '$');
                                $symbol = '';
                                $currency_type = get_option('paypal_curreny_code');
                                if (array_key_exists( $currency_type , $currency_array)) {
                                    $symbol = $currency_array[$currency_type];
                                }else{
                                   $symbol = '$';
                                }
          

                                if ( $course_price || $course_lesson_number || $themeum_course_attachment ) { 
                                    echo '<div class="course-details-span">';
                                    if($course_price) {
                                      echo '<span>' .esc_html($symbol). '' .esc_html($course_price). '</span>';
                                    } else {
                                      echo '<span>' .__('Free', 'themeum-lms'). '</span>';
                                    }
                                    if( $course_lesson_number != "" ){
                                      echo '<span>'.esc_html($course_lesson_number). '</span>'; 
                                    }
                                    if( $themeum_course_attachment != "" ){ 
                                      echo '<span>'.esc_html($themeum_course_attachment). '</span>';  
                                    }
                                    echo '</div>';
                                }
                                    ?>
                                  </div>
                              </div>
                        </div>

                        <?php endwhile; ?>
                    <?php else: ?>
                        <?php echo '<div class="col-sm-12">No Item Found!</div>'; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                            <?php endwhile; ?>
                            <?php echo themeum_pagination(); ?>
                    <?php else: ?>
                            <?php get_template_part( 'post-format/content', 'none' ); ?>
                    <?php endif; ?>
                <?php endif; ?>
        </div>
    </div>
    
</section>

<?php get_footer();