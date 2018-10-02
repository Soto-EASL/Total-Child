<?php
/**
 * The template for displaying the footer.
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 4.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

            <?php wpex_hook_main_bottom(); ?>

        </main><!-- #main-content -->
                
        <?php wpex_hook_main_after(); ?>

        <?php wpex_hook_wrap_bottom(); ?>

    </div><!-- #wrap -->

    <?php wpex_hook_wrap_after(); ?>

</div><!-- .outer-wrap -->

<?php wpex_outer_wrap_after(); ?>

<?php wp_footer(); ?>
<div class="social_buttons_widget">
<?php dynamic_sidebar('social_buttons');?>
</div>
<script>

(function (d, t) {

   var pp = d.createElement(t), s = d.getElementsByTagName(t)[0];

   pp.src = '//app.pageproofer.com/overlay/js/3085/1254';

   pp.type = 'text/javascript';

   pp.async = true;

   s.parentNode.insertBefore(pp, s);

})(document, 'script');

</script>

</body>
</html>