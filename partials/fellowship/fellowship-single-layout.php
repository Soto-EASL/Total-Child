<?php
/**
 * Single fellowship layout
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

$first_aplication_period_start = date("d-M", strtotime(get_field('aplication_period_start')));
$first_aplication_period_finish = date("d-M", strtotime(get_field('aplication_period_finish')));

$second_aplication_period_start = get_field('second_aplication_period_start') ? date("d-M", strtotime(get_field('second_aplication_period_start'))) : '';
$second_aplication_period_finish = get_field('second_aplication_period_finish') ? date("d-M", strtotime(get_field('second_aplication_period_finish'))) : '';


$application_guidelines= get_field('application_guidelines');
$read_application_guidelines = get_field('read_application_guidelines');
if(!$read_application_guidelines){
	$read_application_guidelines = $application_guidelines;
}

?>


<div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="vc_row wpb_row vc_inner vc_row-fluid application-guideline">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper d-flex app-period">
                                <div class="wpb_content_element item">
                                    <div class="wpb_wrapper">
                                        <h2 class="app-period-title"><?php
                                            if($second_aplication_period_start & $second_aplication_period_finish):?>
                                                <table>
                                                    <tr>
                                                        <td>Application Period:&nbsp;</td>
                                                        <td><?php echo $first_aplication_period_start.' - '. $first_aplication_period_finish;?></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><?php echo $second_aplication_period_start.' - '. $second_aplication_period_finish;?></td>
                                                    </tr>
                                                </table>
                                            <?php else:?>Application Period: <?php echo $first_aplication_period_start.' - '. $first_aplication_period_finish;?><?php endif;?></h2>
                                    </div>
                                </div>
                                <?php if($application_guidelines): ?>
                                <div class="wpb_content_element item">
                                    <div class="wpb_wrapper pdf-guideline">
                                        <a href="<?php echo esc_url($application_guidelines);?>" download class="application-guidelines-link">
                                        <img class="application-guidelines-link-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/title-icons/pdf-icon.png" alt="">
                                        <span class="application-guidelines-link-text">Application Guidelines</span></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="wpb_content_element item apply-here">
                                    <div class="wpb_wrapper">
                                        <a href="#" class="vcex-button theme-button inline animate-on-hover apply-fellowship-btn">
                                            <span class="theme-button-inner">APPLY HERE</span><i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="vc_row wpb_row vc_inner vc_row-fluid" style="padding: 0 15px;">
                    <div class="d-flex felloship-title-wrapper">
                        <div class="wpb_content_element vc_align_left">
                            <div class="vc_single_image-wrapper   vc_box_border_grey" style="background-image: url('<?php echo $image[0];?>');">
                                <img width="140" height="150" style="visibility: hidden;"
                                     src="<?php echo $image[0];?>"
                                     class="vc_single_image-img attachment-thumbnail"
                                     alt="">
                            </div>
                        </div>
                        <div class="wpb_content_element vc_align_left felloship-title-block">
                            <div class="d-flex flex-direction-column align-items-stretch align-content-space-between h-100 felloship-title-wrapper">
                                <h1 class="vc_custom_heading"><?php the_title(); ?></h1>
                                <a href="#" class="vcex-button theme-button inline animate-on-hover" style="background-color: #f5f5f5;color: #004b87;border-radius: 0;">
                                    <span class="theme-button-inner"><?php echo get_field('fellowship-term');?></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
                <div class="vc_row wpb_row vc_inner vc_row-fluid" style="padding: 0 15px;">
                    <div class="wpb_content_element vc_align_left">
                        <?php the_content();?>
                    </div>
                </div>

                <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
                <?php if($read_application_guidelines): ?>
                <div class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-flex no-bottom-margins">
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <a href="<?php echo esc_url($read_application_guidelines);?>" target="_blank"
                                   class="vcex-button theme-button inline animate-on-hover read-application-guidelines">
                                    <span class="theme-button-inner"><?php _e('Read the application guidelines before applying', 'total-child') ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="wpb_column vc_column_container vc_col-sm-3">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <a href="/join-the-community/" class="vcex-button theme-button inline animate-on-hover join-community-btn">
                                    <span class="theme-button-inner">Join the Community</span><i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="wpb_column vc_column_container vc_col-sm-3">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <a href="#" class="vcex-button theme-button inline animate-on-hover get-notified-btn">
                                    <span class="theme-button-inner">Get notified</span><i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
				<?php if( have_rows('past_fellows') ): ?>
                <div class="vc_row wpb_row vc_inner vc_row-fluid" style="padding: 0 15px;">
                    <div class="wpb_content_element vc_align_left">
                        <h2 class="past-fellows">Past Fellows</h2>
                    </div>
                </div>
                <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>

                <?php if(get_field('show_past_fellows_as_row') === true):?>
                <div class="vc_row wpb_row vc_row-fluid no-bottom-margins">
                    <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <div class="wpb_text_column wpb_content_element ">
                                    <div class="wpb_wrapper">
                                        <div class="d-flex justify-content-between">

                <?php endif;?>
                    <?php while( have_rows('past_fellows') ): the_row(); ?>
                        <div class="past_fellows-item" style="flex: 1 0 auto;">
                    <span style="font-size: 18px;color: #ffffff;line-height: 38px;text-align: left; padding: 8px 12px!important;background-color: #454545!important;"
                          class="vc_custom_heading easl-recognition-award-year"><?php the_sub_field('year'); ?></span>

                    <div class="vc_empty_space" style="height: 18px"><span class="vc_empty_space_inner"></span></div>
                    <div class="vc_row wpb_row vc_inner vc_row-fluid">
                        <?php if( have_rows('fellow') ): ?>
                        <?php while( have_rows('fellow') ): the_row(); ?>
                        <div class="wpb_column vc_column_container <?php echo get_field('show_past_fellows_as_row') === false ? 'vc_col-sm-4' : '';?>">
                            <div class="vc_column-inner">
                                <div class="wpb_wrapper">
                                    <?php
                                    $avatar = get_sub_field('avatar');
                                    $avatar_url = wp_get_attachment_image_url($avatar, 'staff_grid');
                                    if($avatar_url):
                                    ?>
                                    <div class="wpb_single_image wpb_content_element">
                                        <figure class="wpb_wrapper vc_figure">
                                            <img src="<?php echo $avatar_url; ?>" alt="" width="254" height="254"/>
                                        </figure>
                                    </div>
                                    <?php endif; ?>
                                    <div style="color:#104e85;font-family:KnockoutHTF51Middleweight;font-size:19px;" class="wpb_text_column has-custom-color wpb_content_element  recognition-link">
                                        <div class="wpb_wrapper">
                                            <p><?php the_sub_field('name'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                    <div class="vc_empty_space" style="height: 18px"><span class="vc_empty_space_inner"></span></div>
                        </div>
                    <?php endwhile; ?>
                                            <?php if(get_field('show_past_fellows_as_row') === true):?>
                                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                                        <?php endif;?>

				<?php endif; ?>
				<?php 
				$show_more_link = get_field('show_more_link');
				if($show_more_link):
				?>
                <a href="<?php echo esc_url($show_more_link['url']); ?>" class="vcex-button theme-button inline animate-on-hover" style="background-color: #104f85">
					<span class="theme-button-inner">
						<?php 
						if(empty($show_more_link['title'])){
							_e('Show more', 'totla');
						}else{
							echo $show_more_link['title'];	
						} 
						?>
					</span>
                </a>
				<?php endif; ?>
                <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>


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
    width: 25px;
    display: block;">

                                            </a>
                                        </li>
                                        <li class="wpex-facebook">
                                            <a role="button" tabindex="1" style="background-image: url('/wp-content/themes/Total-Child/images/title-icons/f.png');
background-repeat: no-repeat;background-position: top left; background-size: cover;
height: 25px;
    width: 25px;
    display: block;">

                                            </a>
                                        </li>
                                        <li class="wpex-linkedin">
                                            <a role="button" tabindex="1" style="background-image: url('/wp-content/themes/Total-Child/images/title-icons/in.png');
background-repeat: no-repeat;background-position: top left; background-size: cover;
height: 25px;
    width: 25px;
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
        </div>
    </div>
</div>
<!-- #single-blocks -->