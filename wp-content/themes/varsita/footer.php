
    <?php global $themeum_options; ?>
    <?php if(is_active_sidebar('bottom')){ ?>
    <section id="bottom">
        <div class="container">
            <div class="bottom">
                <div class="row">
                    <?php dynamic_sidebar('bottom'); ?>
                </div>
            </div>
        </div>
    </section><!--/#footer-->
    <?php } ?>

    <?php if (isset($themeum_options['copyright-en']) && $themeum_options['copyright-en']){?>
        <footer id="footer">
            <div class="container">
                <div class="footer">
                    <div class="copyright">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php if(isset($themeum_options['copyright-text'])) echo balanceTags($themeum_options['copyright-text']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!--/#footer-->
    <?php } ?>
</div>
<?php if(isset($themeum['before_body']))  echo esc_js($themeum['before_body']); ?>
<?php if(isset($themeum_options['google-analytics'])) echo esc_js($themeum_options['google-analytics']); ?>

<?php wp_footer(); ?>
</body>
</html>