	<div id="content">
		<div class="container">
			<div class="padder">
				<div class="row">
					<div class="col-sm-8">
						<div class="activity-inner">
							<?php do_action( 'bp_before_member_home_content' ); ?>

							<div id="item-header" role="complementary">

								<?php bp_get_template_part( 'members/single/member-header' ) ?>

							</div><!-- #item-header -->


							<div id="item-body" role="main">

								<div id="item-nav">
									<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
										<ul>

											<?php bp_get_displayed_user_nav(); ?>

											<?php do_action( 'bp_member_options_nav' ); ?>

										</ul>
									</div>
								</div><!-- #item-nav -->

								<?php do_action( 'bp_before_member_body' );

								if ( bp_is_user_activity() || !bp_current_component() ) :
									bp_get_template_part( 'members/single/activity' );

								elseif ( bp_is_user_blogs() ) :
									bp_get_template_part( 'members/single/blogs'    );

								elseif ( bp_is_user_friends() ) :
									bp_get_template_part( 'members/single/friends'  );

								elseif ( bp_is_user_groups() ) :
									bp_get_template_part( 'members/single/groups'   );

								elseif ( bp_is_user_messages() ) :
									bp_get_template_part( 'members/single/messages' );

								elseif ( bp_is_user_profile() ) :
									bp_get_template_part( 'members/single/profile'  );

								elseif ( bp_is_user_forums() ) :
									bp_get_template_part( 'members/single/forums'   );

								elseif ( bp_is_user_notifications() ) :
									bp_get_template_part( 'members/single/notifications' );

								elseif ( bp_is_user_settings() ) :
									bp_get_template_part( 'members/single/settings' );

								// If nothing sticks, load a generic template
								else :
									bp_get_template_part( 'members/single/plugins'  );

								endif;

								do_action( 'bp_after_member_body' ); ?>

							</div><!-- #item-body -->

							<?php do_action( 'bp_after_member_home_content' ); ?>
						</div><!-- activity-inner -->	
					</div><!-- col-sm-8 -->			

					<div id="sidebar" class="col-md-4" role="complementary">
    					<aside class="widget-area">
						  <?php dynamic_sidebar('coursesidebar'); ?>
						</aside>
					</div> <!-- #sidebar -->

				</div><!-- #buddypress -->
		</div><!-- #buddypress -->
	</div><!-- #buddypress -->
</div><!-- #buddypress -->
