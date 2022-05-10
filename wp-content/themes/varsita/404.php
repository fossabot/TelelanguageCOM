<?php get_header('alternative'); 
/*
*Template Name: 404 Page Template
*/
global $themeum_options;
?>

<div class="content-404">
	<img src="<?php echo esc_url($themeum_options['errorpage']['url']); ?>" alt="">
	<h1><?php  _e( '404','themeum');?> </h1>
	<h2><?php  _e( 'Page not found', 'themeum' ); ?></h2>
	<a class="btn btn-lg" href="<?php echo esc_url(site_url()); ?>"><?php _e( 'Back to Homepage', 'themeum' ); ?></a>
</div>

<?php get_footer('alternative'); ?>
