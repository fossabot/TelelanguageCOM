<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $themeum_options;
global $woocommerce; 
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<?php 

	if(isset($themeum_options['favicon'])){ ?>
		<link rel="shortcut icon" href="<?php echo esc_url($themeum_options['favicon']['url']); ?>" type="image/x-icon"/>
	<?php }else{ ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/images/plus.png'; ?>" type="image/x-icon"/>
	<?php } ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

 <?php 

     if ( isset($themeum_options['boxfull-en']) ) {
      $layout = esc_attr($themeum_options['boxfull-en']);
     }else{
        $layout = 'fullwidth';
     }
 ?>

<body <?php body_class( $layout.'-bg' ); ?>>


    
	<div id="page" class="hfeed site <?php echo $layout; ?>" >
		<header id="masthead" class="site-header header" role="banner">
			<div id="header-container">
				<div id="navigation" class="container">
                    <div class="row">
                        <div class="col-sm-3">
        					<div class="navbar-header">
        						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        						</button>
                                <h1 class="logo-wrapper">
        	                       <a class="navbar-brand" href="<?php echo site_url(); ?>">
        		                    	<?php
        									if (isset($themeum_options['logo']))
        								   {
        								   		
        										if($themeum_options['logo-text-en']) {
        											echo esc_html($themeum_options['logo-text']);
        										}
        										else
        										{
        											if(!empty($themeum_options['logo'])) {
        											?>
        												<img class="enter-logo img-responsive" src="<?php echo esc_url($themeum_options['logo']['url']); ?>" alt="" title="">
        											<?php
        											}else{
        												echo esc_html(get_bloginfo('name'));
        											}
        										}
        								   }
        									else
        								   {
        								    	echo esc_html(get_bloginfo('name'));
        								   }
        								?>
        		                     </a>
                                </h1>     
        					</div>
                        </div>

                        <div class="col-sm-9">

                            <div id="main-menu" class="hidden-xs">

                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu(  array(
                                        'theme_location' => 'primary',
                                        'container'      => '', 
                                        'menu_class'     => 'nav',
                                        'fallback_cb'    => 'wp_page_menu',
                                        'depth'          => 4,
                                        'walker'         => new Megamenu_Walker()
                                        )
                                    ); 
                                }
                                ?>
                            </div><!--/#main-menu-->

                        </div>
                        
                        

                        <div id="mobile-menu" class="visible-xs">
                            <div class="collapse navbar-collapse">
                                <?php 
                                if ( has_nav_menu( 'primary' ) ) {
                                    wp_nav_menu( array(
                                        'theme_location'      => 'primary',
                                        'container'           => false,
                                        'menu_class'          => 'nav navbar-nav',
                                        'fallback_cb'         => 'wp_page_menu',
                                        'depth'               => 4,
                                        'walker'              => new wp_bootstrap_mobile_navwalker()
                                        )
                                    ); 
                                }
                                ?>
                            </div>
                        </div><!--/.#mobile-menu-->
                    </div><!--/.row--> 
				</div><!--/.container--> 
			</div>
		</header><!--/#header-->