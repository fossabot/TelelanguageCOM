<?php get_header();
global $themeum_options; ?>
<?php 
    while( have_posts() ): the_post(); 
	$question = rwmb_meta('question_id');
?>
<section id="single-portfolio">

   <?php get_template_part('lib/sub-header')?>


    <div class="container">
        <div id="question-details" >
            <div class="row">
                
                <div class="col-sm-12">
                    <div class="question-info quiz-body">
                        <h3 class="style-title2"><span class="span-title2"><?php the_title(); ?></span></h3>
                        <div class="entry-content">
                        	<p><?php the_content(); ?></p>
                        </div>
                    </div>

                    <button id="quiz-body" class="quiz-body"><?php _e('Start Test','themeum'); ?></button>
                    
                    <div class="col-sm-offset-4 col-sm-8">
                        <span id="timer"></span>
                        <div id="question-data"></div>
                        <div id="total-time" class="hide"><?php $time = rwmb_meta('quiz-time')*60; echo $time; ?></div>
                        <a id="quiz-next" class="btn btn-primary" data-post-id="<?php echo get_the_ID(); ?>" data-url="<?php echo get_template_directory_uri().'/post-loadquiz.php'; ?>" data-question-no="1" data-user-id= "<?php echo get_current_user_id(); ?>" href="#"><?php _e('Next Question', 'themeum') ;?></a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
                        

</section>

<?php endwhile; ?>

<?php get_footer();