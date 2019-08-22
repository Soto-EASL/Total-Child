<?php
/**
 * Template Name: Member Zone Pages
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

    <div id="content-wrap" class="easl-member-zone-container container clr">

		<?php wpex_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

            <div id="content" class="site-content clr">

				<?php wpex_hook_content_top(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

                    <article id="single-blocks" class="single-page-article wpex-clr">
                        <div class="single-content single-page-content entry clr">
                            <div class="vc_row wpb_row vc_row-fluid">
                                <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-2">
                                    <div class="vc_column-inner">
                                        <div class="easl-mz-page-menu">
                                            <h1 class="easl-mz-page-menu-title">Member Zone</h1>
											<?php
											wp_nav_menu( array(
												'container'      => 'nav',
												'menu_class'     => '',
												'wp_nav_menu'    => '',
												'echo'           => true,
												'fallback_cb'    => false,
												'theme_location' => 'member-zone-pages-menu',
											) );
											?>
                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-9 vc_col-md-10">
                                    <div class="vc_column-inner">
                                        <div class="wpb_wrapper easl-mz-container-inner">
											<?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

				<?php endwhile; ?>

				<?php wpex_hook_content_bottom(); ?>

            </div><!-- #content -->

			<?php wpex_hook_content_after(); ?>

        </div><!-- #primary -->

		<?php wpex_hook_primary_after(); ?>

    </div><!-- .container -->

<?php get_footer(); ?>