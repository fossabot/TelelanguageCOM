<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( rwmb_meta( 'thm_video' ) ) { ?>
    <div class="featured-image  clearfix">
        <div class="entry-video embed-responsive embed-responsive-16by9">
            <?php $video_source = esc_attr(rwmb_meta( 'thm_video_source' )); ?>
            <?php $video = rwmb_meta( 'thm_video' ); ?>
            <?php if($video_source == 1): ?>
                <?php echo rwmb_meta( 'thm_video' ); ?>
            <?php elseif ($video_source == 2): ?>
                <?php echo '<iframe width="100%" height="350" src="http://www.youtube.com/embed/'.esc_attr($video).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white"  allowfullscreen></iframe>'; ?>
            <?php elseif ($video_source == 3): ?>
                <?php echo '<iframe src="http://player.vimeo.com/video/'.esc_attr($video).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="350" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
            <?php endif; ?>
        </div>
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