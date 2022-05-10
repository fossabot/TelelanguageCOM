<?php
/**
 * Display Single Event 
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

 	<div class="container">
 		<div id="post-<?php the_ID(); ?>" <?php post_class(array('class' => 'event-details' )); ?>>
 		    <div class="row">
 		    	<div class="col-sm-8" role="main">
					<?php while(have_posts()): the_post(); ?>

				    <div class="featured-image">
				    	<?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail('full', array('class' => 'img-responsive img-album')); ?>
						<?php } ?>
				    </div>
				    <div class="entry-headder">
				        <div class="entry-title-wrap">
				            <h3 class="entry-title blog-entry-title">
				                <?php the_title(); ?>
				            </h3> <!-- //.entry-title --> 
				        </div>
				    </div>
				    <?php 
				    	$event_start_datetime 	= esc_attr(rwmb_meta( 'themeum_event_start_datetime' )); 
				    	$event_end_datetime 	= esc_attr(rwmb_meta( 'themeum_event_end_datetime' )); 
				    	$event_place 			= esc_attr(rwmb_meta( 'themeum_event_place' )); 
				    	$event_price 			= esc_attr(rwmb_meta( 'themeum_event_price' )); 
				    	$event_speakers         = rwmb_meta('themeum_event_speaker','type=checkbox_list');
				    	$location 				= esc_attr(rwmb_meta('themeum_event_location'));
				    	$map 					= rwmb_meta('themeum_event_location_map');
				    ?>
				    <ul class="event-details-inner">
				    	<?php if($event_start_datetime) { ?>
							<li><span class="heading-side"><?php  _e('Date : ','themeum-lms'); ?></span><span class="info-side"><?php echo  date("F d, Y", strtotime($event_start_datetime)); ?> - <?php echo  date("F d, Y", strtotime($event_end_datetime)) ;?></span></li>
							<li><span class="heading-side"><?php  _e('Time : ','themeum-lms'); ?></span><span class="info-side"><?php echo date("H:i A", strtotime($event_start_datetime)); ?> - <?php echo date("H:i A", strtotime($event_end_datetime)); ?></span></li>
						<?php } ?>

						<?php if($event_place) { ?>
							<li><span class="heading-side"><?php  _e('Location : ','themeum-lms'); ?></span><span class="info-side"><?php echo $event_place; ?></span></li>
						<?php } ?>						

						<?php if($event_price) { ?>
							<li><span class="heading-side"><?php  _e('Price : ','themeum-lms'); ?></span><span class="info-side"><?php echo $event_price; ?></span></li>
						<?php } ?>

							<?php if(!empty($event_speakers)) {  ?>

							    <li><span class="heading-side"><?php  _e('Speaker : ','themeum-lms'); ?></span><span class="info-side">

	                                <?php $posts_id = array();
	                                  foreach ($event_speakers as $value) {
	                                    $posts = get_posts(array('post_type' => 'speaker', 'name' => $value));
	                                    $posts_id[] = $posts[0]->ID;
	                                  }
	                                  $event_speakers = get_posts( array( 'post_type' => 'speaker', 'post__in' => $posts_id, 'posts_per_page'   => 20) );
	                                ?>

	                                <ul class="event-speaker-listing" style="display:inline;">

	                                  <?php foreach ($event_speakers as $key=>$post) {

	                                  setup_postdata( $post ); ?>

	                                  <li>
	                                        <a href="<?php echo get_permalink($post->ID);?>"><?php the_title(); ?></a>
	                                  </li>
	                                  <?php } ?>
	                                  <?php wp_reset_postdata(); ?>
	                                </ul>  

                            </span></li>
                            <?php } ?>
					</ul>
					<?php the_content(); ?>
					<?php endwhile; ?>

					<?php if(!empty($map)) { ?>
					<h3 class="location-title"><?php echo __('Event Location', 'themeum-lms'); ?></h3>						
					<?php echo $map; ?>
					<?php } ?>


					<?php  $terms = get_the_terms( $post->ID, 'post_tag' );
						if ( $terms && ! is_wp_error( $terms ) ) { ?>

			        <div class="related-event">
			            <h3 class="related-title"><?php _e('Related Events', 'themeum-lms'); ?></h3>

			            	<?php	

			                    $term_name = array();

			                    foreach ( $terms as $term ) {
			                        $term_name[] = $term->slug;
			                    }

			                    $args = array(
			                        'post_type' => 'event',
			                        'tax_query' => array(
			                            array(
			                                'taxonomy' => 'post_tag',
			                                'field' => 'slug',
			                                'terms' => $term_name
			                                )
			                            ),
			                        'posts_per_page'   => 20
			                        );

			                    	$related_events = get_posts($args); ?>

			                    		<div id="related-event-list" class="carousel slide related-events" data-ride="carousel">

											<div class="carousel-inner">
			                    
												<?php	
												$i = 0;
												foreach ( $related_events as $post ) {  

												  $event_start_datetime   = esc_attr(rwmb_meta('themeum_event_start_datetime'));
									              $event_end_datetime     = esc_attr(rwmb_meta('themeum_event_end_datetime'));
									              $event_place            = esc_attr(rwmb_meta('themeum_event_place'));
									              $event_price            = esc_attr(rwmb_meta('themeum_event_price'));
									              $event_speakers         = rwmb_meta('themeum_event_speaker','type=checkbox_list');
							                      setup_postdata($post); 

							                      $classes = ($i==0)?'item active':'item';
							                      ?>
							                      	<div class="related-event-inner <?php echo $classes; ?>">
								                    	<div class="event-page">
									                    	<div class="row">
										                        <div class="col-sm-5">
											                        <div class="event-img">
											                          <?php if ( has_post_thumbnail() && ! post_password_required() ) { 
											                              the_post_thumbnail('event-thumb', array('class' => 'img-responsive'));
											                            }?>

											                        </div><!--/.event-ing-->  
										                        </div>   

									                            <div class="col-sm-7">
									                                <div class="event-info">
									                                    <div class="event-info-title">
											                              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											                            </div>
											                            <div class="event-info-text">
											                            	<div class="event-info-middle">
											                            		    <?php if(!empty($event_speakers)) { 

											                                          $posts_id = array();
											                                          foreach ($event_speakers as $value) {
											                                            $posts = get_posts(array('post_type' => 'speaker', 'name' => $value));
											                                            $posts_id[] = $posts[0]->ID;
											                                          }
											                                          $event_speakers = get_posts( array( 'post_type' => 'speaker', 'post__in' => $posts_id,'posts_per_page'   => 20) );
											                                        ?>

											                                        <p style="display:inline;"><span class="event-bold"><?php  _e('Speakers : ','themeum-lms'); ?></span></P> 
											                                          <ul class="event-speaker-listing" style="display:inline">

											                                          <?php foreach ($event_speakers as $key=>$post) {

											                                          setup_postdata( $post ); ?>

											                                          <li>
											                                                <a href="<?php echo get_permalink($post->ID);?>"><?php the_title(); ?></a>
											                                          </li>
											                                          <?php } ?>
											                                          <?php wp_reset_postdata(); ?>
											                                        </ul> 

											                                    <?php } ?>

											                                    <?php if($event_start_datetime) { ?>
											                                      <p><span class="event-bold"><?php  _e('Date : ','themeum-lms'); ?></span><?php echo  date("F d, Y", strtotime($event_start_datetime)); ?> - <?php echo  date("F d, Y", strtotime($event_end_datetime)) ;?></p>
											                                      <p><span class="event-bold"><?php  _e('Time : ','themeum-lms'); ?></span><?php echo date("H:i A", strtotime($event_start_datetime)); ?> - <?php echo date("H:i A", strtotime($event_end_datetime)); ?></p>
											                                    <?php } ?>

											                                     <?php if( $event_place ) { ?>
											                                        <p><span class="event-bold"><?php  _e('Location : ','themeum-lms'); ?></span><?php echo $event_place; ?></p>
											                                     <?php } ?>	

											                                     <?php if( $event_price ) { ?>										                       
											                                        <p><span class="event-bold"><?php  _e('Price : ','themeum-lms'); ?></span><?php echo $event_price; ?></p>
											                                     <?php } ?>

											                            	</div><!--/.event-info-middle-->
											                            </div><!--/.event-info-text-->
									                                </div><!--/.event-info-->
									                            </div><!--/.col-sm-7--> 
								                            </div> <!--/.row--> 
							                            </div> <!--/.event-page--> 
						                            </div> <!--/.related-event-inner--> 
							                <?php 
							                $i++;
							                 } ?>
							            		
							        	</div> <!--/.carousel-inner--> 

							        	<div class="related-control">	
								        	  <!-- Controls -->
											  <a class="left carousel-control" href="#related-event-list" role="button" data-slide="prev">
											    <i class="fa fa-angle-left"></i>
											  </a>
											  <a class="right carousel-control" href="#related-event-list" role="button" data-slide="next">
											    <i class="fa fa-angle-right"></i>
											  </a>
										</div>

						        </div> <!--/.carousel-->    

			                </div> <!--/.related-event-->    
			                <?php } ?>   
				</div> <!--/#col-sm-8-->
				
	            <div id="sidebar" class="col-sm-4" role="complementary">
	                <div class="sidebar-inner">
	                    <aside class="widget-area">
	                        <?php dynamic_sidebar( 'eventsidebar' ); ?>
	                    </aside>
	                </div>
	            </div> <!-- #sidebar -->
			</div> <!--/.row-->
		</div> <!--/#post-->
	</div> <!--/.container-->
</section> <!--/#main-->
<?php get_footer();

