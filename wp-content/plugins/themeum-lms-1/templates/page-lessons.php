<?php
/**
 * Display Lessons List
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
	
	<div id="page" class="container lessons">
			<div class="row">
				<div class="col-sm-8">
						<?php  
						$paged 		= (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args 		= array( 'post_type' => 'lesson', 'paged' => $paged );
						$lessons 	= new WP_Query( $args );	

						if ( $lessons->have_posts() ) {
							while($lessons->have_posts()) {
								$lessons->the_post();
								?>
								<div id="post-<?php the_ID(); ?>">

									<div class="lesson">
						                 <div class="lesson-details">
						                 	<h2><a href="<?php echo get_permalink($id);?>"><?php the_title();?></a></h2>

						                    <p><?php the_content();?></p>

						                 </div>
									</div><!--/.course-->
								</div><!--/.col-sm-6-->
								<?php 
							}
						}
						?>
				</div><!--/.col-sm-8-->

				<div id="sidebar" class="col-sm-4" role="complementary">
			        <div class="sidebar-inner">
			          <aside class="event-widget-area">
			           <?php dynamic_sidebar('course');?>
			         </aside>
			       </div>
		      </div><!--/#sidebar-->

			</div><!--/.row-->
			<?php
				themeum_pagination($lessons->max_num_pages);
				wp_reset_query();
			?>

	</div>
</section>
<?php
get_footer();

