<?php 
/**
* Template Name: Blog Right Sidebar 
*/
get_header();?>

<section id="main">

    <?php get_template_part('lib/sub-header'); ?>

    <div class="container">
        <div class="row">

            <div id="content" class="site-content col-md-8" role="main">
                <?php

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('post_type' => 'post','paged' => $paged);
                query_posts($args); 

                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                       // get_template_part( 'post-format/content', get_post_format() ); ?>

<?php global $themeum_options; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="featured-image">
            <?php if (is_page_template('blog-masonry-col3.php')) {
                the_post_thumbnail('sm-blog-thumb', array('class' => 'img-responsive'));
            }
            else if (is_page_template('blog-full-width.php')) {
                the_post_thumbnail('blog-full', array('class' => 'img-responsive'));
            }
            else if (is_page_template('blog-left-sidebar.php')) {
                the_post_thumbnail('blog-thumb', array('class' => 'img-responsive'));
            }            
            else if (is_page_template('blog-right-sidebar.php')) {
                the_post_thumbnail('blog-thumb', array('class' => 'img-responsive'));
            }
             else {
                the_post_thumbnail('blog-full', array('class' => 'img-responsive'));
            }?>
        </div>
    <?php } ?>

    <div class="entry-headder">
        <div class="entry-title-wrap">

            <h1 class="entry-title blog-entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
                <sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
                <?php } ?>
            </h1> <!-- //.entry-title --> 


        </div>
    </div>

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

</article> <!--/#post-->

<?php
                    endwhile;
                else:
                    get_template_part( 'post-format/content', 'none' );
                endif;

                ?>
                <?php themeum_pagination(); ?>
            </div>

            <div id="sidebar" class="col-md-4" role="complementary">
                <div class="sidebar-inner">
                    <aside class="widget-area">
                        <?php dynamic_sidebar( 'sidebar' ); ?>
                    </aside>
                </div>
            </div> <!-- #sidebar -->

        </div> <!-- .row -->
    </div><!-- .container -->
</section> 

<?php get_footer();