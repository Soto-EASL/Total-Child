<?php
/**
 * Single event layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 4.4.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$organisation = easl_event_get_organisations();
$country = easl_event_get_countries();
if( function_exists('get_field')){
	$event_online_programme_url = get_field('event_online_programme_url');
	$event_website_url = get_field('event_website_url');
	$event_notification_url = get_field('event_notification_url');
	$event_why_attend = trim(get_field('event_why_attend'));
	$event_who_should_attend = trim(get_field('event_who_should_attend'));
	$event_topic_covered = trim(get_field('event_topic_covered'));
	$event_sections = get_field('event_sections');
	$event_top_sections = get_field('event_top_sections');
	$event_bottom_sections = get_field('event_bottom_sections');
	$about_easl_schools = get_field('about_easl_schools');
	$event_accreditation = get_field('event_accreditation');
	$event_show_more = trim(get_field('event_show_more'));
	$event_short_description = trim(get_field('event_short_description'));
	$event_short_description_title = trim(get_field('event_short_description_title'));
	$event_why_attend_title = trim(get_field('event_why_attend_title'));
	$event_who_should_attend_title = trim(get_field('event_who_should_attend_title'));
	$event_topic_covered_title = trim(get_field('event_topic_covered_title'));
	$event_submit_abstract_url = trim(get_field('event_submit_abstract_url'));
	$event_register_url = trim(get_field('event_register_url'));
	$event_poster_image = get_field('event_poster_image');
	$event_poster_text_source = get_field('event_poster_text_source');
	$event_poster_custom_text = get_field('event_poster_custom_text');
	$poster_download_link = get_field('poster_download_link');
	$event_organisers = trim(get_field('event_organisers'));
	$event_google_map = get_field('event_google_map');
	$event_highlights = get_field('event_highlights');
}else{
	$event_online_programme_url = get_post_meta(get_the_ID(), 'event_online_programme_url', true);
	$event_website_url = get_post_meta(get_the_ID(), 'event_website_url', true);
	$event_why_attend = trim(get_post_meta(get_the_ID(), 'event_why_attend', true));
	$event_who_should_attend = trim(get_post_meta(get_the_ID(), 'event_who_should_attend', true));
	$event_topic_covered = trim(get_post_meta(get_the_ID(), 'event_topic_covered', true));
	$event_sections = get_post_meta(get_the_ID(), 'event_sections', true);
	$event_top_sections = get_post_meta(get_the_ID(), 'event_top_sections', true);
	$event_bottom_sections = get_post_meta(get_the_ID(), 'event_bottom_sections', true);
	$about_easl_schools = get_post_meta(get_the_ID(), 'about_easl_schools', true);
	$event_accreditation = get_post_meta(get_the_ID(), 'event_accreditation', true);
	$event_show_more = trim(get_post_meta(get_the_ID(), 'event_show_more', true));
	$event_short_description = trim(get_post_meta(get_the_ID(), 'event_short_description', true));
	$event_short_description_title = trim(get_post_meta(get_the_ID(), 'event_short_description_title', true));
	$event_why_attend_title = trim(get_post_meta(get_the_ID(), 'event_why_attend_title', true));
	$event_who_should_attend_title = trim(get_post_meta(get_the_ID(), 'event_who_should_attend_title', true));
	$event_topic_covered_title= trim(get_post_meta(get_the_ID(), 'event_topic_covered_title', true));
	$event_submit_abstract_url= trim(get_post_meta(get_the_ID(), 'event_submit_abstract_url', true));
	$event_register_url = trim(get_post_meta(get_the_ID(), 'event_register_url', true));
	$event_poster_image = wp_get_attachment_image_src(get_post_meta(get_the_ID(), 'event_poster_image', true), 'full');
	$event_poster_image = $event_poster_image ? $event_poster_image[0] : '';
	$event_poster_text_source = get_post_meta(get_the_ID(), 'event_poster_text_source', true);
	$event_poster_custom_text = get_post_meta(get_the_ID(), 'event_poster_custom_text', true);
	$poster_download_link = get_post_meta(get_the_ID(), 'poster_download_link', true);
	$event_organisers = trim(get_post_meta(get_the_ID(), 'event_organisers', true));
	$event_google_map = get_post_meta(get_the_ID(), 'event_google_map', true);
	$event_highlights = get_post_meta(get_the_ID(), 'event_highlights', true);
}
if(!in_array($event_poster_text_source, array('default', 'no', 'custom') )) {
	$event_poster_text_source = 'default';
}
$event_poster_text = '';
if($event_poster_text_source == 'no') {
	$event_poster_text = '';
}elseif($event_poster_text_source == 'custom'){
	$event_poster_text = trim($event_poster_custom_text);
}else{
	$event_poster_text = trim(wpex_get_mod('event_poster_text'));
}

$event_start_date = get_post_meta(get_the_ID(), 'event_start_date', true);
$event_end_date = get_post_meta(get_the_ID(), 'event_end_date', true);
$now_time = time() - 86399;
$event_time_type = 'upcoming';
if( ($event_start_date < $now_time) && ($event_end_date < $now_time) ){
	$event_time_type = 'past';
}
if( ($event_start_date < $now_time) && ($event_end_date >= $now_time) ){
	$event_time_type = 'current';
}
$event_location = array();
$event_location_venue = get_post_meta(get_the_ID(), 'event_location_venue', true);
$event_location_city = get_post_meta(get_the_ID(), 'event_location_city', true);
$event_location_country = get_post_meta(get_the_ID(), 'event_location_country', true);
$event_location_display_format = get_post_meta(get_the_ID(), 'event_location_display_format', true);

if(!in_array( $event_location_display_format, array('venue|city,contury', 'venue,Country', 'venue', 'city,contury' ))) {
	$event_location_display_format = 'venue|city,contury';
}

$event_location_display = array();


if('venue|city,contury' == $event_location_display_format){
	if($event_location_venue){
		$event_location_display[] = $event_location_venue;
	}
	if($event_location_city){
		$event_location[] = $event_location_city;
	}
	if($event_location_country){
		$event_location[] = easl_event_map_country_key($event_location_country );
	}
	if(count($event_location > 0)){
		$event_location_display[] = implode(', ', $event_location);
	}
	$event_location_display = implode( ' | ', $event_location_display );
}elseif('venue,Country' == $event_location_display_format){
	if($event_location_venue){
		$event_location_display[] = $event_location_venue;
	}
	if($event_location_country){
		$event_location_display[] = easl_event_map_country_key($event_location_country );
	}
	$event_location_display = implode( ', ', $event_location_display );
}elseif('venue' == $event_location_display_format){
	$event_location_display = $event_location_venue;
}elseif('city,contury' == $event_location_display_format){
	if($event_location_city){
		$event_location_display[] = $event_location_city;
	}
	if($event_location_country){
		$event_location_display[] = easl_event_map_country_key($event_location_country );
	}
	$event_location_display = implode( ', ', $event_location_display );
}else{
	$event_location_display = '';
}

$event_topics_name = easl_event_topics_name(get_the_ID());
$event_meeting_type_name = easl_meeting_type_name(get_the_ID());

$about_easl_school_title = wpex_get_mod('about_easl_schools_title');
$about_easl_school_content = wpex_get_mod('about_easl_schools_content');

$topic_color = easl_get_events_topic_color(get_the_ID());

$event_highlights = wp_parse_args($event_highlights, array(
    'cover_image' => '',
    'pdf_url' => '',
));
?>

<article id="single-blocks" class="single-event-article entry easl-color-<?php echo $topic_color; ?> clr">
	<div class="event-top-section">
		<div class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-flex">
			<div class="wpb_column vc_column_container vc_col-sm-7">
				<div class="vc_column-inner">
					<div class="event-dates-meta-wrap wpb_wrapper easl-flex-con easl-flex-align-center clr">
						<div class="event-dates-wrap">
							<div class="event-dates">
                                <?php $begining_date = new DateTime('@'.get_field('event_start_date'));?>
								<span class="event-day"><?php echo $begining_date->format('d'); ?></span>
								<span class="event-mon"><?php echo $begining_date->format('M'); ?></span>
								<span class="event-year"><?php echo $begining_date->format('Y'); ?></span>
							</div>
						</div>
						<div class="event-meta-wrap easl-flex-one">
							<?php if($event_topics_name): ?>
							<p class="event-meta">
								<span class="event-meta-type">Topic:</span>
                                    <span class="event-meta-value"><?php echo $event_topics_name;?></span>
							</p>
							<?php endif; ?>
							<?php if($event_organisers): ?>
							<p class="event-meta">
								<span class="event-meta-type"><?php _e('Organised by:', 'total-child'); ?></span>
								<span class="event-meta-value"><?php echo esc_html($event_organisers);?></span>
							</p>
							<?php endif; ?>
							<?php if($event_location_display): ?>
							<p class="event-meta">
								<span class="event-meta-type">Location:</span>
								<span class="event-meta-value"><?php echo $event_location_display;  ?></span>
							</p>
							<?php endif; ?>
							<?php if($event_meeting_type_name): ?>
							<p class="event-meta">
								<span class="event-meta-type"><?php _e('Meeting Type:', 'total-child'); ?></span>
                                    <span class="event-meta-value"><?php echo $event_meeting_type_name;?></span>
							</p>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php if($event_submit_abstract_url || $event_register_url): ?>
            <div class="wpb_column vc_column_container vc_col-sm-5">
                <div class="vc_column-inner" style="justify-content: center;">
                    <div class="wpb_wrapper">
                        <div class="vc_row wpb_row vc_row-fluid">
						<?php if($event_submit_abstract_url): ?>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <a class="event-button event-button-wide event-button-icon event-button-icon-application"
                                           style="padding-top: 8px;
                                                  padding-bottom: 8px;"
												  href="<?php echo esc_url($event_submit_abstract_url);?>" target="_blank">Submit Abstract</a>
                                    </div>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if($event_register_url): ?>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <a class="event-button event-button-wide event-button-icon event-button-icon-person"
                                           style="padding-top: 8px;
                                                  padding-bottom: 8px;" href="<?php echo esc_url($event_register_url);?>" target="_blank">Register</a>
                                    </div>
                                </div>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
            </div>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="event-main-section">
		<div class="vc_row wpb_row vc_row-fluid">
			<div class="wpb_column vc_column_container vc_col-sm-8">
				<div class="vc_column-inner">
					<div class="wpb_wrapper clr">
						<?php if($event_top_sections && is_array( $event_top_sections) && count($event_top_sections) > 0): ?>
                        <div class="event-sections">
							<?php 
							foreach ($event_top_sections as $event_top_section):
								$event_top_section_title = !empty($event_top_section['section_title'])? trim($event_top_section['section_title']) : '';
								$event_top_section_content = !empty($event_top_section['section_content'])? trim($event_top_section['section_content']) : '';
								if(!$event_top_section_content){
									continue;
								}
							?>
								<div class="event-text-block">
									<?php if($event_top_section_title): ?>
									<h3><?php echo $event_top_section_title; ?></h3>
									<?php endif; ?>
									<?php echo do_shortcode($event_top_section_content);?>
								</div>
							<?php endforeach; ?>
                        </div>
						<?php endif; ?>
						<?php if($event_short_description || $event_show_more): ?>
						<div class="event-text-block">
							<?php if($event_short_description_title): ?>
							<h3><?php echo esc_html($event_short_description_title); ?></h3>
							<?php endif; ?>
							<?php if($event_short_description): ?>
                            <div class="event_description">
                                <?php echo do_shortcode($event_short_description);?>    
                            </div>
							<?php endif; ?>
							<?php if($event_show_more): ?>
                            <div id="event-more-description" class="event-description-more easl-st-collapse">
                                <?php echo do_shortcode($event_show_more);?>
                            </div>
                            <p>
								<a href="#" class="toggle-box-button tbb-hidden" data-target="#event-more-description">
									<span class="tbb-shown-text">Show more <i class="fa fa-angle-down"></i></span>
									<span class="tbb-hidden-text">Show less <i class="fa fa-angle-up"></i></span>
								</a>
							</p>
							<?php endif; ?>
						</div>
						<?php endif; ?>
                        <div class="event-text-block event-sidebar-item event-links">
                            <ul class="event-links-list">
								<?php if($event_online_programme_url): ?>
                                <li class="event-link-program" style="float: left;border: none;margin-right: 40px;">
                                    <a class="event-link-item" href="<?php echo esc_url( $event_online_programme_url );?>" style="display: inline-block" target="_blank">
                                        <span class="event-link-icon"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                                        <span class="event-link-text">Scientific Programme</span>
                                    </a>
                                </li>
								<?php endif; ?>
								<?php if('past' != $event_time_type): ?>
                                <li class="event-link-calendar" style="float: left;border: none;margin-right: 40px">
									<div title="Add to Calendar" class="addeventatc">
										<span class="event-link-item" href="" style="display: inline-block">
											<span class="event-link-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
											<span class="event-link-text">Add to Calendar</span>
										</span>
										<span class="start"><?php echo date('Y-m-d', $event_start_date); ?></span>
										<span class="end"><?php echo date('Y-m-d', $event_end_date); ?></span>
										<span class="timezone">America/Los_Angeles</span>
										<span class="title"><?php the_title(); ?></span>
										<span class="location"><?php echo $event_location; ?></span>
									</div>
                                </li>
								<?php endif; ?>
								<?php if($event_notification_url && ('past' != $event_time_type)): ?>
                                <li class="event-link-notify" style="float: left;border: none;margin-right: 40px">
                                    <a class="event-link-item" href="<?php echo esc_url($event_notification_url);?>" style="display: inline-block" target="_blank">
                                        <span class="event-link-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                        <span class="event-link-text">Get Notified</span>
                                    </a>
                                </li>
								<?php endif; ?>
								<?php if($event_website_url): ?>
                                <li class="event-link-website" style="float: left;border: none;margin-right: 40px">
                                    <a class="event-link-item" href="<?php echo esc_url( $event_website_url); ?>" style="display: inline-block" target="_blank">
                                        <span class="event-link-icon"><i class="fa fa-tv" aria-hidden="true"></i></span>
                                        <span class="event-link-text">Visit Website</span>
                                    </a>
                                </li>
								<?php endif; ?>
                            </ul>
                            <div style="clear: both"></div>
                        </div>
                        <?php if($event_time_type != 'past'): ?>
                            <?php if($event_why_attend): ?>
                            <div class="event-text-block">
                                <?php if($event_why_attend_title): ?>
                                <h3><?php echo esc_html($event_why_attend_title); ?></h3>
                                <?php endif; ?>
                                <?php echo do_shortcode($event_why_attend);?>
                            </div>
                            <?php endif; ?>
                            <?php if($event_who_should_attend): ?>
                            <div class="event-text-block">
                                <?php if($event_who_should_attend_title): ?>
                                <h3><?php echo esc_html($event_who_should_attend_title); ?></h3>
                                <?php endif; ?>
                                <?php echo do_shortcode($event_who_should_attend);?>
                            </div>
                            <?php endif; ?>
						<?php endif; ?>
						<?php if($event_topic_covered): ?>
                        <div class="event-text-block">
                            <?php if($event_topic_covered_title): ?>
                            <h3><?php echo esc_html($event_topic_covered_title); ?></h3>
							<?php endif; ?>
                            <?php echo do_shortcode($event_topic_covered);?>
                        </div>
						<?php endif; ?>
						<?php if($event_time_type == 'past' && $event_highlights['cover_image'] && $event_highlights['pdf_url']): ?>
                            <div class="event-text-block">
                                    <h3><?php _e('Event Highlights' ,'total-child') ?></h3>
                                <div class="event-highlights-cover">
                                    <a href="<?php echo esc_url( $event_highlights['pdf_url']); ?>" target="_blank">
                                        <img src="<?php echo esc_url( $event_highlights['cover_image']); ?>" alt="">
                                    </a>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if($event_sections && is_array( $event_sections) && count($event_sections) > 0): ?>
                        <div class="event-sections">
							<?php 
							foreach ($event_sections as $event_section):
								$event_section_title = !empty($event_section['section_title'])? trim($event_section['section_title']) : '';
								$event_section_content = !empty($event_section['section_content'])? trim($event_section['section_content']) : '';
								if(!$event_section_content){
									continue;
								}
							?>
								<div class="event-text-block">
									<?php if($event_section_title): ?>
									<h3><?php echo $event_section_title; ?></h3>
									<?php endif; ?>
									<?php echo do_shortcode($event_section_content);?>
								</div>
							<?php endforeach; ?>
                        </div>
						<?php endif; ?>
						<?php if($about_easl_schools && $about_easl_school_content): ?>
						<div class="event-text-block">
							<?php if($about_easl_school_title): ?>
							<h3><?php echo $about_easl_school_title; ?></h3>
							<?php endif; ?>
							<?php echo do_shortcode($about_easl_school_content);?>
						</div>
						<?php endif; ?>
						<?php if($event_bottom_sections && is_array( $event_bottom_sections) && count($event_bottom_sections) > 0): ?>
                        <div class="event-sections">
							<?php 
							foreach ($event_bottom_sections as $event_bottom_section):
								$event_bottom_section_title = !empty($event_bottom_section['section_title'])? trim($event_bottom_section['section_title']) : '';
								$event_bottom_section_content = !empty($event_bottom_section['section_content'])? trim($event_bottom_section['section_content']) : '';
								if(!$event_bottom_section_content){
									continue;
								}
							?>
								<div class="event-text-block">
									<?php if($event_bottom_section_title): ?>
									<h3><?php echo $event_bottom_section_title; ?></h3>
									<?php endif; ?>
									<?php echo do_shortcode($event_bottom_section_content);?>
								</div>
							<?php endforeach; ?>
                        </div>
						<?php endif; ?>
						<?php if($event_accreditation): ?>
						<div class="event-seperator"></div>
						<div class="event-image-box event-image-box-border-tb">
							<div class="eib-image">
								<img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2018/09/cme.jpg"/>
							</div>
							<div class="eib-text">
								<h3>An application has been made to the EACCME® for CME accreditation of this event.</h3>
							</div>
						</div>
						<div class="event-seperator"></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="wpb_column vc_column_container vc_col-sm-4">
				<div class="vc_column-inner event-main-sidebar">
					<div class="wpb_wrapper">
                        <?php
                        $event_sponsorship_url = trim(get_field('event_sponsorship_url'));
                        ?>
                        <?php if($event_sponsorship_url):?>
                            <div class="event-sidebar-item">
                                <a class="easl-image-link" href="<?php echo esc_url($event_sponsorship_url);?>">
                                    <img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2017/10/event-image-1.jpg"/>
                                    <span>Sponsor this event</span>
                                </a>
                            </div>
                        <?php endif;?>
						<?php
						$event_bursary_url = trim(get_field('event_bursary__url'));
						?>
                        <?php if($event_bursary_url):?>
                            <div class="event-sidebar-item">
                                <a class="easl-image-link" href="<?php echo esc_url($event_bursary_url);?>">
                                    <img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2018/09/pig.jpg"/>
                                    <span>Bursaries available for this event</span>
                                </a>
                            </div>
                        <?php endif;?>
						<?php
						$event_press_url = trim(get_field('event_press_url'));
						?>
                        <?php if($event_press_url):?>
                        <div class="event-sidebar-item">
							<a class="easl-image-link" href="<?php echo esc_url($event_press_url);?>">
								<img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2017/10/pm-thumb.jpg"/>
								<span>Press Invited</span>
							</a>
						</div>
                        <?php endif;?>
						<?php
						$key_dates = get_field('event_key_deadline_row');
						if($key_dates):
						?>
						<div class="event-sidebar-item event-key-deadlines">
							<div class="event-sidebar-item-inner app-process">

								<h3 class="event-sidebar-item-title">Key Deadlines</h3>
								<ul>
                                    <?php 
									if(!$key_dates){
										$key_dates = array();
									}
									$counter = 0;
                                    foreach ($key_dates as $date):
                                        switch($counter):
                                            case 0:
                                                $addon_class = 'active';
                                                break;
                                            case 1:
                                                $addon_class = 'next-key';
                                                break;
                                            default:
                                                $addon_class = '';

                                        endswitch;


                                        ?>
                                        <li class="app-process-key <?php echo $addon_class;?>">
                                            <p class="event-kd-date"><?php echo $date['event_key_start_date'];?></p>
                                            <h4 class="event-kd-title"><?php echo strip_tags($date['event_key_deadline_description'], '<br>');?></h4>
                                        </li>
                                        <?php $counter++;?>
                                    <?php endforeach;?>
								</ul>
							</div>
						</div>
						<?php endif; ?>
						<?php if($event_poster_image || $poster_download_link): ?>
                        <div class="event-poster-image-box event-sidebar-item event-image-box-bg">
							<?php if($event_poster_image): ?>
                            <div class="eib-image">
                                <img alt="" src="<?php echo $event_poster_image;?>"/>
                            </div>
							<?php endif; ?>
							<?php if($event_poster_text): ?>
							<h3 class="easl-text-gray">
								<?php
								echo wp_kses( $event_poster_text, array(
									'br' => array(), 
									'span' => array(
										'style' => array(), 
										'class' => array(),
									)
								) );
								?>
							</h3>
							<?php endif; ?>
							<?php if($poster_download_link && !empty($poster_download_link['url'])): ?>
							<a class="event-button event-button-icon event-button-no-arrow event-button-icon-download event-image-box-full-button" href="<?php echo esc_url($poster_download_link['url']);?>" <?php if($poster_download_link['target']){ echo 'target="'. esc_attr($poster_download_link['target']) .'"';} ?> download>
								<?php if(!empty($poster_download_link['title'])){echo esc_html($poster_download_link['title']);}{_e('Download Poster', 'total-child'); } ?>
							</a>
							<?php endif; ?>
                        </div>
						<?php endif; ?>
						<?php if($event_google_map): ?>
                        <div class="event-google-map-box event-sidebar-item event-image-box-bg">
                            <div class="eib-image">
                                <iframe src="<?php echo $event_google_map;?>" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                            <div class="eib-text">
								<?php if(get_field('event_address')): ?>
                                <p style="color:#004b87;font-family: 'KnockoutHTF51Middleweight';font-size: 21px;"><?php echo get_field('event_address');?></p>
								<?php endif; ?>
								<?php if(get_field('event_google_map_view_on_map')): ?>
                                <p>
									<a class="event-button event-button-icon event-button-no-arrow event-button-icon-marker event-image-box-full-button"
                                      href="<?php echo get_field('event_google_map_view_on_map');?>" target="_blank"
                                    >View on Map</a>
								</p>
								<?php endif; ?>
                            </div>
                        </div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner " style="margin-bottom: 0">
                <div class="wpb_wrapper">
	                <?php easl_social_share_icons(); ?>
                </div>
            </div>
        </div>
    </div>
</article><!-- #single-blocks -->