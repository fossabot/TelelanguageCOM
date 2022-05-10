<?php
/*
 * Add Sub-Menu Admin Style for Custom Post Sorting
 **/

function themeum_posts_sort_styles()
{
	$screen = get_current_screen();
	
	if($screen->post_type == 'portfolio' || $screen->post_type == 'client' || $screen->post_type == 'testimonial')
	{
		wp_enqueue_style( 'sorting-stylesheet', get_template_directory_uri().'/css/admin/sorting-stylesheet.css', array(), false, false );
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script( 'sort-script', get_template_directory_uri().'/js/admin/sorting-script.js', array(), false, false );
	}
}
add_action( 'admin_print_styles', 'themeum_posts_sort_styles' );



/*
 * Add Themeum Sorting Menu
 **/

function themeum_posts_sort()
{
	$themeum_post_types = array('portfolio','client','testimonial');

	foreach ($themeum_post_types as $value) {
		add_submenu_page('edit.php?post_type='.$value, 'Sort '.ucfirst($value), 'Sort', 'edit_posts', basename(__FILE__), 'themeum_posts_sort_callback');
	}
}

add_action('admin_menu' , 'themeum_posts_sort');


function themeum_posts_sort_callback()
{
	$screen = get_current_screen();
	$custom_post_type = $screen->post_type;

	$allposts = new WP_Query('post_type='.$custom_post_type.'&posts_per_page=-1&orderby=menu_order&order=ASC');
	?>
	<div class="wrap">
		<h3 class="themeum-sorting-title">Sort <?php echo esc_html($custom_post_type); ?> <img src="<?php echo esc_url(home_url()); ?>/wp-admin/images/loading.gif" id="themeum-sort-animation" /></h3>
		<ul id="themeum-sorting">
			<?php if( $allposts->have_posts() ): ?>
				<?php while ( $allposts->have_posts() ){ $allposts->the_post(); ?>
				<li id="<?php the_id(); ?>"><?php the_title(); ?></li>			
				<?php } ?>
			<?php else: ?>
				<li>There is no <?php echo esc_html($custom_post_type); ?> created</li>		
			<?php endif; ?>
		</ul>
	</div>
	<?php
}


/*
 * Themeum Sorting Ajax Call-back
 */

function themeum_posts_sort_order()
{
	global $wpdb;

	$order = explode(',', $_POST['order']);
	$counter = 0;
	
	foreach ($order as $custom_post_id) {
		$wpdb->update($wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $custom_post_id) );
		$counter++;
	}
	die(1);
}

add_action('wp_ajax_themeum_sort', 'themeum_posts_sort_order');
