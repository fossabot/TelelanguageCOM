<?php global $themeum_options; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php  if ( rwmb_meta( 'thm_audio_code' ) ) { ?>
    <div class="featured-image clearfix">
        <div class="entry-audio embed-responsive embed-responsive-16by9">
            <?php echo rwmb_meta( 'thm_audio_code' ); ?>
        </div> <!--/.audio-content -->
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