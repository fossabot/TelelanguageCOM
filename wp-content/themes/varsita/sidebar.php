<div id="sidebar" class="col-md-4" role="complementary">
    <aside class="widget-area">
       <?php $sidebar = esc_attr(rwmb_meta( 'thm_slidebar' )); ?>
        <?php if($sidebar == 1): ?>
            <?php dynamic_sidebar('sidebar'); ?>
        <?php elseif ($sidebar == 2): ?>
           <?php dynamic_sidebar('eventsidebar'); ?>
        <?php elseif ($sidebar == 3): ?>
           <?php dynamic_sidebar('coursesidebar'); ?>
        <?php endif; ?>
    </aside>
</div> <!-- #sidebar -->
