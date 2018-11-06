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
}else{
	$event_online_programme_url = get_post_meta(get_the_ID(), 'event_online_programme_url', true);
	$event_website_url = get_post_meta(get_the_ID(), 'event_website_url', true);
	$event_why_attend = trim(get_post_meta(get_the_ID(), 'event_why_attend', true));
	$event_who_should_attend = trim(get_post_meta(get_the_ID(), 'event_who_should_attend', true));
	$event_topic_covered = trim(get_post_meta(get_the_ID(), 'event_topic_covered', true));
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
$event_location_city = get_post_meta(get_the_ID(), 'event_location_city', true);
$event_location_country = get_post_meta(get_the_ID(), 'event_location_country', true);
if($event_location_city){
	$event_location[] = $event_location_city;
}
if($event_location_country){
	$event_location[] = easl_event_map_country_key($event_location_country );
}
$event_location = implode(', ', $event_location);


?>

<article id="single-blocks" class="single-event-article entry clr">
	<div class="event-top-section">
		<div class="vc_row wpb_row vc_row-fluid vc_row-o-equal-height vc_row-flex">
			<div class="wpb_column vc_column_container vc_col-sm-7">
				<div class="vc_column-inner">
					<div class="wpb_wrapper clr">
						<div class="event-dates-wrap">
							<div class="event-dates">

                                <?php $begining_date = new DateTime('@'.get_field('event_start_date'));?>
								<span class="event-day"><?php echo $begining_date->format('d'); ?></span>
								<span class="event-mon"><?php echo $begining_date->format('M'); ?></span>
								<span class="event-year"><?php echo $begining_date->format('Y'); ?></span>
							</div>
						</div>
						<div class="event-meta-wrap">
							<p class="event-meta">
								<span class="event-meta-type">Topic:</span>
                                <?php $terms =  get_the_terms(get_the_ID(), 'event_topic');?>
                                <?php foreach ($terms as $term):?>
                                    <span class="event-meta-value"><?php echo $term->name;?></span>&nbsp;
                                <?php endforeach;?>

							</p>
							<p class="event-meta">
								<span class="event-meta-type">Course Directors:</span>
								<span class="event-meta-value"><?php echo $organisation[get_field('event_organisation')];?></span>
							</p>
							<p class="event-meta">
								<span class="event-meta-type">Location:</span>
								<span class="event-meta-value">Clinical School  |  <?php echo get_field('event_location_city');?>, <?php echo $country[get_field('event_location_country')];?></span>
							</p>
						</div>
					</div>
				</div>
			</div>
            <div class="wpb_column vc_column_container vc_col-sm-5">
                <div class="vc_column-inner">
                    <div class="wpb_wrapper">
                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <a class="event-button event-button-wide event-button-icon event-button-icon-application"
                                           style="padding-top: 8px;
                                                  padding-bottom: 8px;"
                                           href="<?php echo get_field('event_submit_abstract_url');?>" target="_blank">Submit Abstract</a>
                                    </div>
                                </div>
                            </div>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <a class="event-button event-button-wide event-button-icon event-button-icon-person"
                                           style="padding-top: 8px;
                                                  padding-bottom: 8px;" href="<?php echo get_field('event_register_url');?>" target="_blank">Register</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
	
	<div class="event-main-section">
		<div class="vc_row wpb_row vc_row-fluid">
			<div class="wpb_column vc_column_container vc_col-sm-8">
				<div class="vc_column-inner">
					<div class="wpb_wrapper clr">
						<div class="event-text-block">
							<h3>Description</h3>
                            <div class="event_description">
                                <?php echo get_field('event_short_description');?>    
                            </div>
                            <div class="event_description hidden">
                                <?php echo get_field('event_show_more');?>
                            </div>
                            <p><a href="#" class="show_more_btn">Show more <i class="fa fa-angle-down"></i></a></p>
						</div>
                        <div class="event-text-block event-sidebar-item event-links">
                            <ul class="event-links-list">
								<?php if($event_online_programme_url): ?>
                                <li class="event-link-program" style="float: left;border: none;margin-right: 40px;">
                                    <a class="event-link-item" href="<?php echo esc_url( $event_online_programme_url );?>" style="display: inline-block" target="_blank">
                                        <span class="event-link-icon"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
                                        <span class="event-link-text">Online Programme</span>
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
						<?php if($event_why_attend): ?>
                        <div class="event-text-block">
                            <h3>Why attend?</h3>
                            <?php echo do_shortcode($event_why_attend);?>
                        </div>
						<?php endif; ?>
						<?php if($event_who_should_attend): ?>
                        <div class="event-text-block">
                            <h3>Who should attend?</h3>
                             <?php echo do_shortcode($event_who_should_attend);?>
                        </div>
						<?php endif; ?>
						<?php if($event_topic_covered): ?>
                        <div class="event-text-block">
                            <h3>Topic to be covered</h3>
                             <?php echo do_shortcode($event_topic_covered);?>
                        </div>
						<?php endif; ?>
						<div class="event-text-block">
							<h3>About EASL Schoools</h3>
							<p>The schools contribute to the training of new generations of hepatologists and are a major element of our association. Aimed at young fellows enrolled in hepatology-oriented departments or more experienced clinicians who want to be exposed to the newest trends in hepatology.</p>
							<p>For selected applicants, EASL will cover transportation costs to attend the school and accommodation during the event (details will be provided individually once the selection process has been done).</p>
							<p>Application is open to young fellows under the age of 35 and/or still in training.</p>
							<p>Approximately 30 places are available for each school and priority is given to registered EASL members during the selection process. lorem ipusm dolor amet.</p>
						</div>
						<div class="event-seperator"></div>
						<div class="event-image-box event-image-box-border-tb">
							<div class="eib-image">
								<img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2018/09/cme.jpg"/>
							</div>
							<div class="eib-text">
								<h3>An application has been made to the EACCME® for CME accreditation of this event, lorem ipsum dolor amet.</h3>
							</div>
						</div>
						<div class="event-seperator"></div>
					</div>
				</div>
			</div>
			<div class="wpb_column vc_column_container vc_col-sm-4">
				<div class="vc_column-inner event-main-sidebar">
					<div class="wpb_wrapper">
                        <?php if(get_field('event_display_sponsorship_sidebar')):?>
                            <div class="event-sidebar-item">
                                <a class="easl-image-link" href="<?php echo get_field('event_sponsorship_url');?>">
                                    <img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2017/10/event-image-1.jpg"/>
                                    <span>Sponsor this event</span>
                                </a>
                            </div>
                        <?php endif;?>
                        <?php if(get_field('event_bursary_available')):?>
                            <div class="event-sidebar-item">
                                <a class="easl-image-link" href="<?php echo get_field('event_bursary__url');?>">
                                    <img alt="" src="<?php echo EASL_HOME_URL; ?>/wp-content/uploads/2018/09/pig.jpg"/>
                                    <span>Bursaries available for this event</span>
                                </a>
                            </div>
                        <?php endif;?>
                        <?php if(get_field('event_press_ivited')):?>
                        <div class="event-sidebar-item">
							<a class="easl-image-link" href="<?php echo get_field('event_press_url');?>">
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
                        <div class="event-image-box-column event-image-box-bg">
							<?php if(get_field('event_poster_image')): ?>
                            <div class="eib-image">
                                <img alt="" src="<?php echo get_field('event_poster_image');?>"/>
                            </div>
							<?php endif; ?>
                            <div class="eib-text">
                                <h3 class="easl-text-gray">Help us to inform the liver community by downloading the poster, printing it and placing it on your institute's notice board or forwarding it to your local network:</h3>
                                <p>
                                    <a class="event-button event-button-icon event-button-no-arrow event-button-icon-download" style="width: 100%" href="<?php echo get_field('event_poster_image');?>" download>Download Poster</a>
                                </p>
                            </div>
                        </div>
                        <div class="event-image-box-column event-image-box-bg">
							<?php if(get_field('event_google_map')): ?>
                            <div class="eib-image">
                                <iframe src="<?php echo get_field('event_google_map');?>" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
							<?php endif; ?>
                            <div class="eib-text">
								<?php if(get_field('event_address')): ?>
                                <p style="color:#004b87;font-family: 'KnockoutHTF51Middleweight';font-size: 21px;"><?php echo get_field('event_address');?></p>
								<?php endif; ?>
								<?php if(get_field('event_google_map_view_on_map')): ?>
                                <p>
									<a class="event-button event-button-icon event-button-no-arrow event-button-icon-marker"
                                      style="width: 100%"
                                      href="<?php echo get_field('event_google_map_view_on_map');?>" target="_blank"
                                    >View on Map</a>
								</p>
								<?php endif; ?>
                            </div>
                        </div>

					</div>
				</div>
			</div>
		</div>
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
                        <ul class="clr social-share">
                            <li class="wpex-twitter">
                                <a role="button" tabindex="1" href=""><span class="hexagon"></span><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            </li>
                            <li class="wpex-facebook">
                                <a role="button" tabindex="1" href=""><span class="hexagon"></span><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li class="wpex-linkedin">
                                <a href=""><span class="hexagon"></span><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo do_shortcode('[vcex_social_share style="custom" sites="%5B%7B%22site%22%3A%22twitter%22%7D%2C%7B%22site%22%3A%22facebook%22%7D%2C%7B%22site%22%3A%22linkedin%22%7D%5D"]');?>
</article><!-- #single-blocks -->