<?php
/**
* Template Name: Page Certificate
*/
global $themeum_options;
get_header(); ?>

<section id="main">
    
   <?php get_template_part('lib/sub-header')?>

    <div class="container">
        <div id="content" class="site-content row" role="main">

            <?php $page_class = array('col-md-12'); ?>
            <?php while ( have_posts() ): the_post(); ?>

            <div id="post-<?php the_ID(); ?>" <?php post_class($page_class); ?>>
                <div class="entry-content row">
                    <?php
                        //echo get_query_var('userid');
                        if(get_query_var('postid') && get_query_var('courseid')){

                        $course_name = $category_name = $student_image = $full_name = $certificate_logo = '';
                        $posts_array = new WP_Query( array( 'post_type' => 'course', 'post__in' => array(get_query_var('courseid')) )  );

                        // The Loop
                        while ( $posts_array->have_posts() ) {
                        		$posts_array->the_post();
                        		
                                // Get Course name
                                $course_name =  get_the_title();
                        	
                        		//Get Category
                        		$categories = get_the_terms(get_query_var('courseid'),'course_cat');
                        		$category_name = '';
                        		if($categories){
                        			foreach($categories as $category) {
                        				$category_name .=  $category->name.' ';
                        			}
                        		}
                        }
                        wp_reset_query();


                        query_posts( 'p='.get_query_var('postid').'&post_type=student' );
                        // The Loop
                        while ( have_posts() ) : the_post();
                            $full_name = get_the_title(); //full-name
                            if (isset(wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'xs-certificate')[0])) {
                                $student_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'xs-certificate')[0]; //xs-thumb
                            }
                        endwhile;
                        // Reset Query
                        wp_reset_query();

                        } ?>

                        <div class="certificate">
                            <div class="wrapper">
                                <div class="col-md-8 left-part">
                                    <div class="header">
                                        <h3 class=""><?php _e('Certificate of Completion','themeum'); ?></h3>
                                        <?php if(( $themeum_options['user-image'] == true ) && ( $student_image != '' )){ ?>
                                        <p class="image">
                                            <img src="<?php echo esc_url($student_image); ?>" alt="image" class="img-responsive">
                                        </p>
                                        <?php } ?>
                                    </div>
                                    
                                    <p class="info">
                                        <?php _e('This is to certify that','themeum'); ?> <b><i><?php if ( $themeum_options['full-name'] == true ){ echo esc_attr($full_name); } ?></i></b> <?php _e('succesfully completed the','themeum'); ?> <b><i><?php if ( $themeum_options['course-name'] == true ){ echo esc_attr($course_name); } ?></i></b> <?php _e('course.','themeum'); ?> 
                                    </p>
                                    
                                    <p class="name"><?php esc_attr(bloginfo( 'name' )); ?></p>
                                    <p class="course-title"><i><?php _e('Course Organizer','themeum'); ?></i></p>
                                    
                                   
                                </div>
                                <div class="col-md-4 right-part">
                                    <div class="content">
                                        <?php if ( $themeum_options['certifigate-logo']['url'] != '' ){ ?>
                                            <p class="logo">
                                                <img src="<?php echo esc_url($themeum_options['certifigate-logo']['url']); ?>" alt="logo">
                                            </p>
                                        <?php } ?>
                                        
                                        <?php if ( $themeum_options['course-type'] == true ){ ?>
                                            <p class="course-type"><?php _e('Course Type','themeum'); ?></p>
                                            <p class="course-type-name"><?php  echo esc_attr($category_name);   ?></p>
                                        <?php } ?>
                                        
                                        <?php if ( $themeum_options['course-name'] == true ){ ?>
                                            <p class="course-name"><?php _e('Course Name','themeum'); ?></p>
                                            <p><?php echo esc_attr($course_name); ?></p>
                                        <?php } ?>
                                        
                                        <p class="link"><a href="<?php echo esc_url(site_url()); ?>"><?php echo esc_url(site_url()); ?></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </div>

            <?php endwhile; ?>
        </div> <!--/#content-->
    </div>
</section> <!--/#main-->
<?php get_footer();
