<?php

/**
 * Template Name: BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bp_before_directory_activity_page' ); ?>

	<div id="bbp-content">
		<div class="container">
			<div class="padder">
				<div class="row">
					<div class="col-sm-8">
						<div class="activity-inner">
							<?php do_action( 'bp_before_directory_activity' ); ?>

							<?php do_action( 'bp_before_directory_activity_content' ); ?>

							<?php if ( is_user_logged_in() ) : ?>

								<?php locate_template( array( 'activity/post-form.php'), true ); ?>

							<?php endif; ?>

							<?php do_action( 'template_notices' ); ?>


							<div class="row">

								<div class="col-sm-7">

									<div class="item-list-tabs activity-type-tabs" role="navigation">
										<ul>
											<?php do_action( 'bp_before_activity_type_tab_all' ); ?>

											 <li class="selected" id="activity-all"><a href="<?php bp_activity_directory_permalink(); ?>" title="<?php esc_attr_e( 'The public activity for everyone on this site.', 'themeum' ); ?>"><i class="fa fa-group"></i> <?php printf( __( 'All Members <span>%s</span>', 'themeum' ), bp_get_total_member_count() ); ?></a></li>

											<?php if ( is_user_logged_in() ) : ?>

												<?php do_action( 'bp_before_activity_type_tab_friends' ); ?>

												<?php if ( bp_is_active( 'friends' ) ) : ?>

													<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

														<li id="activity-friends"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of my friends only.', 'themeum' ); ?>"><?php printf( __( 'My Friends <span>%s</span>', 'themeum' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ); ?></a></li>

													<?php endif; ?>

												<?php endif; ?>

												<?php do_action( 'bp_before_activity_type_tab_groups' ); ?>

												<?php if ( bp_is_active( 'groups' ) ) : ?>

													<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

														<li id="activity-groups"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of groups I am a member of.', 'themeum' ); ?>"><?php printf( __( 'My Groups <span>%s</span>', 'themeum' ), bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

													<?php endif; ?>

												<?php endif; ?>

												<?php do_action( 'bp_before_activity_type_tab_favorites' ); ?>

												<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

													<li id="activity-favorites"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" title="<?php esc_attr_e( "The activity I've marked as a favorite.", 'themeum' ); ?>"><?php printf( __( 'My Favorites <span>%s</span>', 'themeum' ), bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

												<?php endif; ?>


											<?php endif; ?>

											<?php do_action( 'bp_activity_type_tabs' ); ?>
										</ul>
									</div><!-- .item-list-tabs -->
								</div>	

								<div class="col-sm-5">

									<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
										<ul>
											 <li class="feed"><a href="<?php bp_sitewide_activity_feed_link(); ?>" title="<?php esc_attr_e( 'RSS Feed', 'themeum' ); ?>"><i class="fa fa-rss"></i> <?php _e( 'RSS', 'themeum' ); ?></a></li>

											<?php do_action( 'bp_activity_syndication_options' ); ?>

											<li id="activity-filter-select" class="last">
												
												<div class="activity-filters">
													<label for="activity-filter-by"><?php _e( 'Show:', 'themeum' ); ?></label>
													<select id="activity-filter-by">
														<option value="-1"><?php _e( '&mdash; Everything &mdash;', 'themeum' ); ?></option>
														<option value="activity_update"><?php _e( 'Updates', 'themeum' ); ?></option>

														<?php if ( bp_is_active( 'blogs' ) ) : ?>

															<option value="new_blog_post"><?php _e( 'Posts', 'themeum' ); ?></option>
															<option value="new_blog_comment"><?php _e( 'Comments', 'themeum' ); ?></option>

														<?php endif; ?>

														<?php if ( bp_is_active( 'forums' ) ) : ?>

															<option value="new_forum_topic"><?php _e( 'Forum Topics', 'themeum' ); ?></option>
															<option value="new_forum_post"><?php _e( 'Forum Replies', 'themeum' ); ?></option>

														<?php endif; ?>

														<?php if ( bp_is_active( 'groups' ) ) : ?>

															<option value="created_group"><?php _e( 'New Groups', 'themeum' ); ?></option>
															<option value="joined_group"><?php _e( 'Group Memberships', 'themeum' ); ?></option>

														<?php endif; ?>

														<?php if ( bp_is_active( 'friends' ) ) : ?>

															<option value="friendship_accepted,friendship_created"><?php _e( 'Friendships', 'themeum' ); ?></option>

														<?php endif; ?>

														<option value="new_member"><?php _e( 'New Members', 'themeum' ); ?></option>

														<?php do_action( 'bp_activity_filter_options' ); ?>

													</select>
												</div>
											</li>
										</ul>
									</div><!-- .item-list-tabs -->
								</div><!-- .item-list-tabs -->
							</div><!-- .item-list-tabs -->

							<?php do_action( 'bp_before_directory_activity_list' ); ?>

							<div class="activity" role="main">

								<?php locate_template( array( 'activity/activity-loop.php' ), true ); ?>

							</div><!-- .activity -->

							<?php do_action( 'bp_after_directory_activity_list' ); ?>

							<?php do_action( 'bp_directory_activity_content' ); ?>

							<?php do_action( 'bp_after_directory_activity_content' ); ?>

							<?php do_action( 'bp_after_directory_activity' ); ?>

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

	<?php do_action( 'bp_after_directory_activity_page' ); 

