<?php
/**
 * Template Name: No Sidebar
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 4.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

		<div id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

			<div id="content" class="site-content clr">

				<?php wpex_hook_content_top(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php wpex_get_template_part( 'page_single_blocks' ); ?>

				<?php endwhile; ?>

				<?php wpex_hook_content_bottom(); ?>

			</div><!-- #content -->

			<?php wpex_hook_content_after(); ?>

		</div><!-- #primary -->

	</div><!-- .container -->

<?php get_footer(); ?>