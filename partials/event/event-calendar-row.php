<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$event_id = get_the_ID();
$event_data = get_post_meta($event_id);



$event_start_date = isset($event_data['event_start_date'])?$event_data['event_start_date'][0]:'';
$event_end_date = isset($event_data['event_end_date'])?$event_data['event_end_date'][0]:'';
$event_location_city = isset($event_data['event_location_city'])?$event_data['event_location_city'][0]:'';
$event_location_country = isset($event_data['event_location_country'])?$event_data['event_location_country'][0]:'';
$event_organisation = isset($event_data['event_organisation'])?$event_data['event_organisation'][0]:'';

$event_date_days = date('d', $event_start_date);
if($event_end_date > $event_start_date){
	$event_date_days .= '-' . date('d', $event_end_date);
}


$event_location = array();
if($event_location_city){
	$event_location[] = $event_location_city;
}
if($event_location_country){
	$event_location[] = easl_event_map_country_key($event_location_country );
}
$event_location = implode(', ', $event_location);



$event_color = easl_get_events_topic_color($event_id);

$current_events_month = date('F Y', $event_start_date);

$new_month_row = false;
if($previous_events_month !== $current_events_month){
	$new_month_row = true;
	$previous_events_month = $current_events_month;
}

$row_position = 'left';
if($row_count % 2 == 0){
	$row_position = 'right';
}

?>


	<?php if($new_month_row): ?> 
	<div class="easl-ec-row easl-ec-row-month clr">
		<div class="easl-ec-month-label <?php if($row_count > 1){echo $css_animation;} ?>">
			<span><?php echo $current_events_month; ?></span>
		</div>
	</div>
	<?php endif;?> 
	<div class="easl-ec-row easl-ec-row-<?php echo $row_position; ?> easl-ec-row-<?php echo $event_color; ?> clr">
		<article class="easl-ec-event <?php echo $css_animation; ?>">
			<header class="ec-head">
				<p class="ec-meta">
					<span class="ec-meta-type">Topic:</span> <span class="ec-meta-value"><?php echo easl_event_topics_name($event_id); ?></span>
					<span class="ec-meta-sep"> | </span>
					<span class="ec-meta-type">Organisers:</span> <span class="ec-meta-value"><?php echo esc_html('EASL'); ?></span>
				</p>
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<p class="ec-dates" href=""><span class="ecd-day"><?php echo $event_date_days; ?></span><span class="ecd-mon"><?php echo date('M', $event_start_date); ?></span><span class="ecd-year"><?php echo date('Y', $event_start_date); ?></span><i class="fa fa-play" aria-hidden="true"></i></p>
			</header>
			<p class="ec-location">
				<span class="ec-loc-name"><?php echo easl_meeting_type_name($event_id); ?></span>
				<span class="ec-meta-sep"> | </span>
				<span class="ec-country"><?php echo $event_location; ?></span>
			</p>
			<p class="ec-excerpt"></p>
			<div class="ec-icons clr">
				<ul class="ec-icons-nav clr">
					<li class="ec-links-more">
						<a href="<?php the_permalink(); ?>">
                            <span class="icon-wrapper">
                                <span class="ec-links-icon info"></span>
                            </span>
							<span class="ec-link-text">More<br/>Information</span>
						</a>
					</li>
					<li class="ec-links-website">
						<a href="<?php echo(get_field('event_website_url')) ?>" target="_blank">
                            <span class="icon-wrapper">
                                <span class="ec-links-icon laptop"></span>
                            </span>
							<span class="ec-link-text">Visit<br/>Website</span>
						</a>
					</li>
					<li class="ec-links-deadline">
						<a href="">
                            <span class="icon-wrapper">
                                <span class="ec-links-icon clock"></span>
                            </span>
							<span class="ec-link-text">Key<br/>Deadlines</span>
						</a>
					</li>
					<li class="ec-links-program">
						<a href="<?php echo get_field('event_online_programme_url');?>">
                            <span class="icon-wrapper">
                                <span class="ec-links-icon list"></span>
                            </span>
							<span class="ec-link-text">Online<br/>Programme</span>
						</a>
					</li>
					<li class="ec-links-notify">
						<a href="<?php echo get_field('event_notification_url');?>">
                            <span class="icon-wrapper">
                                <span class="ec-links-icon envelope"></span>
                            </span>
							<span class="ec-link-text">Get<br/>Notified</span>
						</a>
					</li>
					<li class="ec-links-calendar">
						<a href="">
                            <span class="icon-wrapper">
                                <span class="ec-links-icon calendar"></span>
                            </span>
							<span class="ec-link-text">Add to<br/>Calendar</span>
						</a>
					</li>
				</ul>
				<div class="ec-links-details ec-links-details-key-deadlines">
					<ul>
                        <?php $key_dates = get_field('event_key_deadline_row');?>

                        <?php $counter = 0;?>
                        <?php foreach ($key_dates as $date):?>
                            <?php switch($counter):
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
                                <span class="event-kd-date"><?php echo $date['event_key_start_date'];?></span>
                                <span class="event-kd-title"><?php echo strip_tags($date['event_key_deadline_description'], '<br>');?></span>
                            </li>
                            <?php $counter++;?>
                        <?php endforeach;?>
					</ul>
				</div>
			</div>
		</article>
	</div>

