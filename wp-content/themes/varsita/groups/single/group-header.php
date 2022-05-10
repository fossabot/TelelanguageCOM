<?php

do_action( 'bp_before_group_header' );

?>

<div class="media">
	<div id="item-header-avatar" class="pull-left">
		<a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>">
			<?php bp_group_avatar(); ?>
		</a>
	</div><!-- #item-header-avatar -->

	<div class="media-body">

		<div id="item-header-content">
			<h2><a href="<?php bp_group_permalink(); ?>" title="<?php bp_group_name(); ?>"><?php bp_group_name(); ?></a></h2>
			<span class="highlight"><?php bp_group_type(); ?></span> <span class="activity"><?php printf( __( 'active %s', 'themeum' ), bp_get_group_last_active() ); ?></span>

			<?php do_action( 'bp_before_group_header_meta' ); ?>

			<div id="item-meta">

				<?php bp_group_description(); ?>

				<div id="item-buttons">

					<?php do_action( 'bp_group_header_actions' ); ?>

				</div><!-- #item-buttons -->

				<?php do_action( 'bp_group_header_meta' ); ?>

			</div>
		</div><!-- #item-header-content -->
	</div><!-- .media-body -->

</div><!-- .media -->

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>