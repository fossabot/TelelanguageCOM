<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( rwmb_meta('thm_gallery_images','type=image_advanced') ) { ?>
    <div class="featured-image">
        <div class="entry-content-gallery">
            <?php $slides = rwmb_meta('thm_gallery_images','type=image_advanced'); ?>
            <?php if(count($slides) > 0) { ?>
            <div id="blog-gallery-slider<?php echo get_the_ID(); ?>" class="carousel slide blog-gallery-slider">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $slide_no = 1; ?>
                    <?php foreach( $slides as $slide ) { ?>
                    <div class="item <?php if($slide_no == 1) echo 'active'; ?>">
                        <?php $images = wp_get_attachment_image_src( $slide['ID'], 'blog-full' ); ?>
                        <img class="img-responsive" src="<?php echo esc_url($images[0]); ?>" alt="">
                    </div>
                    <?php $slide_no++ ?>
                    <?php } ?>
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right carousel-control" href="#blog-gallery-slider<?php echo get_the_ID(); ?>" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <?php } ?>
        </div><!--/.entry-content-gallery-->
    </div> 
    <?php } ?>

   <div class="entry-headder">
        <div class="entry-title-wrap">
            <h2 class="entry-title blog-entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
                <sup class="featured-post"><?php _e( 'Sticky', 'themeum' ) ?></sup>
                <?php } ?>
            </h2> <!-- //.entry-title --> 
        </div>
    </div>               

    <div class="entry-content-wrap">
        <?php get_template_part( 'post-format/entry-content' ); ?> 
    </div>

</article> <!--/#post -->