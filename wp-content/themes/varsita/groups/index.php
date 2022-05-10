<?php

/**
 * BuddyPress - Groups Directory
 *
 * @package BuddyPress
 * @subpackage bp-default
 */

?>

	<?php do_action( 'bp_before_directory_groups_page' ); ?>

	<div id="bbp-content">
		<div class="container">
			<div class="padder">
				<div class="row">
					<div class="col-sm-8">
						<div class="activity-inner group-inner">
							<?php do_action( 'bp_before_directory_groups' ); ?>

							<form action="" method="post" id="groups-directory-form" class="dir-form">

								<div class="row">
									<div class="col-sm-4">
										<?php do_action( 'bp_before_directory_groups_content' ); ?>

										<div id="group-dir-search" class="dir-search" role="search">

											<?php bp_directory_groups_search_form(); ?>

										</div><!-- #group-dir-search -->

										<?php do_action( 'template_notices' ); ?>
									</div>

									<div class="col-sm-4">
										<div class="item-list-tabs group-all" role="navigation">
											<ul>
												  <li class="selected" id="groups-all"><a href="<?php echo trailingslashit( bp_get_root_domain() . '/' . bp_get_groups_root_slug() ); ?>"><i class="fa fa-group"></i> <?php printf( __( 'All Groups <span>%s</span>', 'themeum' ), bp_get_total_group_count() ); ?></a></li>

												<?php if ( is_user_logged_in() && bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

													<li id="groups-personal"><a href="<?php echo trailingslashit( bp_loggedin_user_domain() . bp_get_groups_slug() . '/my-groups' ); ?>"><?php printf( __( 'My Groups <span>%s</span>', 'themeum' ), bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

												<?php endif; ?>

												<?php do_action( 'bp_groups_directory_group_filter' ); ?>

											</ul>
										</div><!-- .item-list-tabs -->
									</div>

									<div class="col-sm-4">
										<div class="item-list-tabs" id="subnav" role="navigation">
											<ul>
												<?php do_action( 'bp_groups_directory_group_types' ); ?>

												<li id="groups-order-select" class="last filter">

													<label for="groups-order-by"><?php _e( 'Order By:', 'themeum' ); ?></label>
													<select id="groups-order-by">
														<option value="active"><?php _e( 'Last Active', 'themeum' ); ?></option>
														<option value="popular"><?php _e( 'Most Members', 'themeum' ); ?></option>
														<option value="newest"><?php _e( 'Newly Created', 'themeum' ); ?></option>
														<option value="alphabetical"><?php _e( 'Alphabetical', 'themeum' ); ?></option>

														<?php do_action( 'bp_groups_directory_order_options' ); ?>

													</select>
												</li>
											</ul>
										</div>
									</div>
								</div>

								<div id="groups-dir-list" class="groups dir-list">

									<?php locate_template( array( 'groups/groups-loop.php' ), true ); ?>

								</div><!-- #groups-dir-list -->

								<?php do_action( 'bp_directory_groups_content' ); ?>

								<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

								<?php do_action( 'bp_after_directory_groups_content' ); ?>

							</form><!-- #groups-directory-form -->

							<?php do_action( 'bp_after_directory_groups' ); ?>

						</div><!-- .activity-inner -->
					</div><!-- .col-sm-8 -->
					<div id="sidebar" class="col-md-4" role="complementary">
    					<aside class="widget-area">
						  <?php dynamic_sidebar('coursesidebar'); ?>
						</aside>
					</div> <!-- #sidebar -->
				</div><!-- .row -->
			</div><!-- .padder -->
		</div><!-- .container -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_groups_page' ); 

