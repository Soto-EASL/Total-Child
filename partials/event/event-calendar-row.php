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
			<p class="ec-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in sollicitudin augue. Nunc eget laoreet ex. Donec finibus commodo nunc, in bibendum ligula tincidunt et. Nulla convallis ac erat eu </p>
			<div class="ec-icons clr">
				<ul class="ec-icons-nav clr">
					<li class="ec-links-more">
						<a href="<?php the_permalink(); ?>">
							<span class="ec-links-icon"><i class="fa fa-info" aria-hidden="true"></i></span>
							<span class="ec-link-text">More<br/>Information</span>
						</a>
					</li>
					<li class="ec-links-website">
						<a href="" target="_blank">
							<span class="ec-links-icon"><i class="fa fa-laptop" aria-hidden="true"></i></span>
							<span class="ec-link-text">Visit<br/>Website</span>
						</a>
					</li>
					<li class="ec-links-deadline">
						<a href="">
							<span class="ec-links-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
							<span class="ec-link-text">Key<br/>Deadlines</span>
						</a>
					</li>
					<li class="ec-links-program">
						<a href="">
							<span class="ec-links-icon"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
							<span class="ec-link-text">Online<br/>Programme</span>
						</a>
					</li>
					<li class="ec-links-notify">
						<a href="">
							<span class="ec-links-icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
							<span class="ec-link-text">Get<br/>Notified</span>
						</a>
					</li>
					<li class="ec-links-calendar">
						<a href="">
							<span class="ec-links-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></span>
							<span class="ec-link-text">Add to<br/>Calendar</span>
						</a>
					</li>
				</ul>
				<div class="ec-links-details ec-links-details-key-deadlines">
					<ul>
						<li>
							<span>06.07.2017</span>
							<span>Lorem ipsum dolor amet consecteteur</span>
						</li>
						<li>
							<span>04.08.2017</span>
							<span>Ipsum dolor amet consecteteur</span>
						</li>
						<li>
							<span>11.09.2017</span>
							<span>Dolor Lorem ipsum dolor amet consecteteur</span>
						</li>
					</ul>
				</div>
			</div>
		</article>
	</div>

