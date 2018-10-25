<?php
/**
 * Single event layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 4.4.1
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
$image = has_post_thumbnail( get_the_ID() ) ?
    wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
$image_src = $image ? $image[0] : '';

$topic_str = '';
$topics = wp_get_post_terms(get_the_ID(), 'publication_topic' );
if($topics){
    foreach ($topics as $topic){
        $topic_str .= $topic->name.' ';

    }
}
wp_enqueue_script('publication-detailed-item-script',
    get_stylesheet_directory_uri() . '/assets/js/publication_detailed.js',
    ['jquery'],
    false,
    true);

?>
<style>
    .text-decoration-none:hover {
        text-decoration: none;
    }
</style>
<article id="single-blocks" class="single-publication-article entry clr">
    <div class="publication-main-section">
        <div class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-flex">
            <div class="wpb_column vc_column_container vc_col-sm-9">
                <div class="vc_column-inner">
                    <div class="wpb_wrapper clr">
                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-4">
                                <div class="vc_column-inner">
                                    <div class="pub-thumb">
                                        <?php if($image_src):?>
                                        <img alt=""
                                             src="<?php echo $image_src ?>"/>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-8">
                                <div class="vc_column-inner">
                                    <div class="pub-content">
                                        <div class="color-delimeter filter-bg-<?php echo easl_get_events_topic_color();?>"
                                             style="padding-left: 0px; margin-bottom: 30px; border-left:none;">
                                            <div class="pub-meta" style="margin-bottom: 20px;">
                                                <p class="sp-meta">
                                                    <span class="sp-meta-date"><?php echo get_field('publication_date');?></span>
                                                    <span class=sp-meta-sep"> | </span>
                                                    <span class="sp-meta-type">Topic:</span>
                                                    <span class="sp-meta-value"><?php echo $topic_str;?></span>
                                                </p>
                                            </div>
                                            <h3 class="pub-section-title" style="font-size: 26px;
    line-height: 30px;
    margin: 0 0 0px;"><?php echo get_the_title();?></h3>
                                        </div>

                                        <div class="pub-description">
                                            <?php the_content();?>
                                        </div>
                                        <div class="vc_row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                                <div class="vc_column-inner " style="margin-bottom: 0">
                                                    <div class="wpb_wrapper">
                                                        <div style="float: left;margin-right: 20px;font-family: 'KnockoutHTF51Middleweight';
    font-size: 16px;
    font-weight: normal;color:#104f85;">Share this page</div>
                                                        <div class="wpex-social-share position-horizontal style-custom display-block" style="margin-bottom: 0"
                                                             data-source="<?php echo get_bloginfo('url')?>"
                                                             data-url="<?php the_permalink();?>"
                                                             data-title="<?php the_title();?>"
                                                             data-specs="menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600">
                                                            <ul class="clr">
                                                                <li class="wpex-twitter">
                                                                    <a role="button" tabindex="1" style="background-image: url('/wp-content/themes/Total-Child/images/title-icons/tw.png');
background-repeat: no-repeat;
background-position: top left;
background-size: cover;
height: 25px;
    width: 30px;
    display: block;">

                                                                    </a>
                                                                </li>
                                                                <li class="wpex-facebook">
                                                                    <a role="button" tabindex="1" style="background-image: url('/wp-content/themes/Total-Child/images/title-icons/f.png');
background-repeat: no-repeat;background-position: top left; background-size: cover;
height: 25px;
    width: 30px;
    display: block;">

                                                                    </a>
                                                                </li>
                                                                <li class="wpex-linkedin">
                                                                    <a role="button" tabindex="1" style="background-image: url('/wp-content/themes/Total-Child/images/title-icons/in.png');
background-repeat: no-repeat;background-position: top left; background-size: cover;
height: 25px;
    width: 30px;
    display: block;">
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php echo do_shortcode('[vcex_social_share style="custom" sites="%5B%7B%22site%22%3A%22twitter%22%7D%2C%7B%22site%22%3A%22facebook%22%7D%2C%7B%22site%22%3A%22linkedin%22%7D%5D"]');?>
                                    </div>
                                    <style>
                                        .wpex-social-share,
                                        .hidden{
                                            display: none;
                                        }
                                        .display-block{
                                            display: block;
                                        }
                                    </style>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-3">
                <div class="vc_column-inner publication-sidebar">
                    <div class="wpb_wrapper">
                        <?php if(have_rows('publication_other_languages')):?>
                            <div class="publication-sidebar-item pub-download-item"
                                 style="padding-bottom: 15px;">
                                <h3 class="publication-sidebar-item-title">Download as a PDF</h3>
                                <form action="" method="post">
                                    <div class="easl-custom-select">
                                        <span class="ec-cs-label">Select language</span>
                                        <select name="ec-meeting-type">
                                            <option value="<?php echo get_field('publication_link_to_pdf');?>" selected="selected">English</option>
                                            <?php while( have_rows('publication_other_languages') ): the_row(); ?>
                                                <option value="<?php the_sub_field('link_to_file'); ?>"><?php the_sub_field('language'); ?></option>
                                            <?php endwhile;?>
                                        </select>
                                    </div>
                                    <a href="<?php echo get_field('publication_link_to_pdf')?>" class="easl-button easl-button-wide publication-download-pdf-btn" download>Download</a>
                                </form>
                            </div>
                            <?php if(get_field('publication_slide_decks')):?>
                            <div class="" style="border-top: 1px solid #004b87;">
                                <a href="<?php echo get_field('publication_slide_decks')?>"
                                   class="vcex-button theme-button inline animate-on-hover wpex-dhover-0"
                                   style="background:#ffffff;
                                           #ffffff;
                                           color:#004b87;
                                           font-family: KnockoutHTF51Middleweight;
                                           font-size: 17px;
                                           background-image: url('/wp-content/themes/Total-Child/images/ppoint.png');
                                           background-repeat: no-repeat;
                                           background-size: auto;
                                           background-position: 0px 5px;
                                           padding-left: 38px;"><span
                                            class="theme-button-inner">Download Slide Deck<span
                                                class="vcex-icon-wrap theme-button-icon-right"><span
                                                    class="fa fa-angle-right"></span></span></span></a>
                            </div>
                            <?php endif;?>
                        <?php else:?>
                            <div class="publication-sidebar-item pub-download-item">
                                <a href="<?php echo get_field('publication_link_to_pdf')?>" class="text-decoration-none">
                                    <h3 class="publication-sidebar-item-title" style="border-bottom: none;">Download as a PDF</h3>
                                </a>
                            </div>
                            <?php if(get_field('publication_slide_decks')):?>
                            <div class="" style="padding-top: 10px;border-top: 1px solid #004b87;">
                                <a href="<?php echo get_field('publication_slide_decks')?>"
                                   class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 text-decoration-none"
                                   style="background:#ffffff;
                                           #ffffff;
                                           color:#004b87;
                                           font-family: KnockoutHTF51Middleweight;
                                           font-size: 17px;
                                           background-image: url('/wp-content/themes/Total-Child/images/ppoint.png');
                                           background-repeat: no-repeat;
                                           background-size: auto;
                                           background-position: 0px 5px;
                                           padding: 5px 5px 5px 38px;"
                                   download>
                                    <h3 class="publication-sidebar-item-title" style="border-bottom: none;">Download Slide Deck</h3>
                                </a>
                            </div>
                            <?php endif;?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</article><!-- #single-blocks -->