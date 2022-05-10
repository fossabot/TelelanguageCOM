<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $themeum_options;
global $woocommerce; 
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>-->

<?php
global $post;
$seo_title = get_post_meta($post->ID,'_yoast_wpseo_title',true); ?>

<?php if(is_front_page()) { ?>
	<title><?php echo $seo_title; ?> | <?php bloginfo('name'); ?></title>
<?php } else { ?>
	<title><?php is_front_page() ? bloginfo('description') : wp_title(''); ?> | <?php bloginfo('name'); ?></title>
<?php } ?>

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

<script>

jQuery(document).ready(function() {

jQuery('.on-site a').attr('style','background-color:#D16213 !important');
jQuery('.video-remote a').attr('style','background-color:#A82228 !important');
jQuery('.telephonic a').attr('style','background-color:#3A3C67 !important');
jQuery('.scheduling-software a').attr('style','background-color:#7B57A1 !important');
jQuery('.document-translation a').attr('style','background-color:#3A3C67 !important');
jQuery('.single-post .sub-title-inner h2').html("Telelanguage Blog");

jQuery("#Field9").val("<?php echo the_title();?>")


jQuery(".course-settings .col-sm-3:first-child a").attr("href","http://telelanguage.com/services/telephonic-interpretation/");
jQuery(".course-settings .col-sm-3:nth-child(2) a").attr("href","http://telelanguage.com/services/on-site-interpretation/");
jQuery(".course-settings .col-sm-3:nth-child(3) a").attr("href","http://telelanguage.com/services/video-remote-interpretation/");
jQuery(".course-settings .col-sm-3:nth-child(4) a").attr("href","http://telelanguage.com/services/scheduling-software/");



 var offset = 200;
 var duration = 600;
 
 jQuery(window).scroll(function() {
 
	if (jQuery(this).scrollTop() > offset) {
		jQuery(".back-to-top").fadeIn(duration);
 
	} else {
 
	jQuery(".back-to-top").fadeOut(duration);
 
	}
 
});
 
 
jQuery(".back-to-top").click(function(event) {
 
event.preventDefault();
 
jQuery("html, body").animate({scrollTop: 0}, duration);
 
return false;
 
})

});

</script>

<link rel="stylesheet" id="font-awesome-css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" type="text/css" media="screen">


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24680442-1', 'auto');
  ga('send', 'pageview');

</script>


<meta name="google-site-verification" content="Dxy8m2h4m7OP_0q9Lj-ftCa2l_ZCNEHvGQax7BhJemY" />

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '268014166979499'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=268014166979499&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->


<script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"5683181"};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script><noscript><img src="//bat.bing.com/action/0?ti=5683181&Ver=2" height="0" width="0" style="display:none; visibility: hidden;" /></noscript>

</head>

 <?php 

     if ( isset($themeum_options['boxfull-en']) ) {
      $layout = esc_attr($themeum_options['boxfull-en']);
     }else{
        $layout = 'fullwidth';
     }
 ?>

<body <?php body_class( $layout.'-bg' ); ?>>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    

	<div id="page" class="hfeed site <?php echo $layout; ?>" >
		<header id="masthead" class="site-header header" role="banner">
			<div id="header-container">
				<div id="navigation" class="container">
					<ul class="custom-list">
						<li>Call Toll Free: <a href="tel:1-888-983-5352">1-888-983-5352</a></li>

					<li>
						<a href="https://www.interpreterplatform.com">
							Login
						</a>
					</li>


					<li>
						<a href="<?php echo get_permalink("1597");?>">
							FAQ's
						</a>
					</li>

					<li>
						<a href="https://docs.google.com/forms/d/e/1FAIpQLSdyGlgRir1ZK0GCQbBKaeT-ME7gIrKnhFnhQJVrMkU-mpfBdw/viewform" target="_blank">
							ASL Feedback
						</a>
					</li>

					<li>
						<a href="<?php echo get_permalink("94");?>">
							Blog
						</a>
					</li>

					<li>
							<a href="https://twitter.com/telelanguage" target="_blank">
								<i class="twitter"></i>
							</a>
					</li>

					<li>
						<a href="https://www.facebook.com/telelanguageInc/" target="_blank">
							<i class="facebook"></i>
						</a>
					</li>

					<li>
						<a href="https://www.linkedin.com/company/telelanguage" target="_blank">
							<i class="linkedin"></i>
						</a>
					</li>
				</ul>

				<div class="row">
                        <div class="col-sm-4">
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

                        <div class="col-sm-8">

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