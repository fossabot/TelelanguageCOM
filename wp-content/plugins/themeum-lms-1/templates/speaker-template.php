<?php
/**
 * Display Single Speaker 
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
					$speaker_website 			= esc_url(rwmb_meta('themeum_speaker_website'));
					$speaker_email   	 		= sanitize_email(rwmb_meta('themeum_speaker_email'));
					$speaker_designation   	 	= esc_html(rwmb_meta('themeum_speaker_designation'));
				?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="page-details">
						<div class="col-sm-5">
              				<?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
							<?php the_post_thumbnail('blog-thumb', array('class' => 'img-responsive')); ?>
							<?php } //.entry-thumbnail ?>
						</div>
							
			            <div class="col-sm-7">
							<h3><?php the_title();?></h3>
							<?php if ($speaker_designation) { ?>
								<?php echo $speaker_designation; ?><br>
							<?php } ?>

							<?php if ($speaker_website) { ?>
								<a href="<?php echo $speaker_website; ?>"><?php echo $speaker_website; ?></a>
							<?php } ?>

							<?php if ($speaker_email) { ?>
								<p><?php echo $speaker_email; ?></p>
							<?php } ?>

							<div class="page-details-text">
								<?php the_content();?>
							</div><!--/.page-details-text-->
			            </div>
			            
					</div><!--/.page-details-->

				</div><!--/#post-->

			<?php endwhile; ?>
		</div><!--/.row-->
	</div><!--/.container-->
</section>
<?php get_footer();

