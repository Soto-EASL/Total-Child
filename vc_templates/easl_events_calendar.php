<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $el_id
 * @var $css
 * Shortcode class EASL_VC_Events_Calendar
 * @var $this EASL_VC_Events_Calendar
 */
$event_number = $event_type = $title = $element_width = $view_all_link = $view_all_url = $view_all_text = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation = $this->getCSSAnimation($css_animation);

if(!$view_all_text){
	$view_all_text = 'View all Events';
}

if($title && $view_all_link){
	$title .= '<a class="easl-events-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}
wp_dequeue_script('easl-custom');
wp_enqueue_script( 'jquery-ui' );

wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery-ui' ) );
wp_enqueue_script('easl-custom');

wp_enqueue_style(
		'jquery-ui-datepicker-style',
		'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css'
);
$topics_list = '
	<li>
		<label class="easl-custom-checkbox easl-cb-all csic-light-blue">
			<input type="checkbox" name="ec_filter_topics[]" value="" checked="checked"/> <span>All Topics</span>
		</label>
	</li>
	';
$topics = get_terms( array(
	'taxonomy' => EASL_Event_Config::get_topic_slug(),
	'hide_empty' => false,
	'orderby' => 'term_id',
	'order' => 'ASC',
	'fields' => 'id=>name',
) );

if( !is_array($topics)){
	$topics = array();
}
foreach($topics as $topic_id => $topic_name){
	$topic_color = get_term_meta($topic_id, 'easl_tax_color', true);
	if(!$topic_color){
		$topic_color = 'blue';
	}
	$topics_list .= '
		<li>
			<label class="easl-custom-checkbox csic-'. $topic_color .'">
				<input type="checkbox" name="ec_filter_topics[]" value="'. $topic_id .'"/> <span>'. esc_html($topic_name) .'</span>
			</label>
		</li>
		';
}
$meeting_type_list = '
	<option value="">Meeting Type</option>
	';
$meeting_types = get_terms( array(
	'taxonomy' => EASL_Event_Config::get_meeting_type_slug(),
	'hide_empty' => false,
	'orderby' => 'term_id',
	'order' => 'ASC',
	'fields' => 'id=>name',
) );

if( !is_array($meeting_types)){
	$meeting_types = array();
}
foreach($meeting_types as $meeting_typ_id => $meeting_type_name){
	$meeting_type_list .= '
		<option value="'. $meeting_typ_id .'">'. esc_html($meeting_type_name) .'</option>
		';
}

$location_list = '
	<option value="">Location</option>
	';
$countries = easl_event_db_countries();
foreach($countries as $country_code => $country_name){
	$location_list .= '
		<option value="'. $country_code .'">'. esc_html($country_name) .'</option>
		';
}

$top_filter = '
	<div class="easl-ec-filter-container">
		<div class="easl-ec-filter easl-row">
			<div class="easl-col easl-col-4 ec-filter-showme">
				<div class="easl-col-inner">
					<h4>Show me:</h4>
					<ul class="ec-filter-topics">
						'. $topics_list .'
					</ul>
				</div>
			</div>
			<div class="easl-col easl-col-3-4">
				<div class="easl-col-inner">
					<div class="ec-filter-search">
						<input type="text" name="ecf_search" value="" placeholder="Search for an event"/>
						<span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
					</div>
					<div class="easl-row">
						<div class="easl-col easl-col-2-3">
							<div class="easl-col-inner">
								<h4>Filter Events:</h4>
								<div class="ec-filter-fields">
									<div class="ec-filter-field-wrap">
										<div class="easl-custom-select">
											<span class="ec-cs-label">Meeting Type</span>
											<select name="ec_meeting_type">
												'. $meeting_type_list .'
											</select>
										</div>
									</div>
									<div class="ec-filter-field-wrap">
										<div class="easl-custom-select">
											<span class="ec-cs-label">Location</span>
											<select name="ec_location">
												'. $location_list .'
											</select>
										</div>
									</div>
									<div class="ec-filter-field-wrap">
										<div class="easl-custom-date">
											<span class="ecd-lable-left">From:</span>
											<input class="easl-date-picker" type="text" name="ec_filter_date_from" />
											<span class="ecd-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										</div>
									</div>
									<div class="ec-filter-field-wrap">
										<div class="easl-custom-date ecfd-to">
											<span class="ecd-lable-left">To:</span>
											<input class="easl-date-picker" type="text" name="ec_filter_date_to" />
											<span class="ecd-icon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										</div>
									</div>
									<div class="ec-filter-field-wrap">
										<div class="ecf-events-types">
											<label class="easl-custom-radio"><input type="radio" name="ec_filter_type" value="future" checked="checked"/> <span>Future Events</span></label>
											<label class="easl-custom-radio"><input type="radio" name="ec_filter_type" value="past"/> <span>Past Events</span></label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="easl-col easl-col-3 ecf-submit-event">
							<div class="easl-col-inner">
								<h4>Submit an Event</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vita.In fermentum tellus id ultricies efficitur. Vivamus molestie purus sagittis.</p>
								<a class="easl-button easl-button-small" href="">Tell us about an Event</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	';

$now_time = time();

// Quick debug purpose or filtering $event_number
if(isset($_GET['event_type'])){
	$event_type = trim($_GET['event_type']);
}
if( !in_array( $event_type, array('all', 'past', 'future', 'current') )){
	$event_type = 'future';
}
if(isset($_GET['event_number'])){
	$event_number = trim($_GET['event_number']);
}
if(!$event_number){
	$event_number = 5;
}


$event_args = array(
	'post_type' => EASL_Event_Config::get_event_slug(),
	'post_status' => 'publish',
	'posts_per_page' => $event_number,
	'order' => 'ASC',
	'orderby' => 'meta_value_num',
	'meta_key' => 'event_start_date',
);
if('future' == $event_type){
	$event_args['order'] = 'ASC';
	$event_args['meta_query'] = array(
		'relation' => 'OR',
		array(
			'key' => 'event_start_date',
            'value' => $now_time - 86399,
            'compare' => '>=',
            'type' => 'NUMERIC',
		),
		array(
			'key' => 'event_end_date',
            'value' => $now_time - 86399,
            'compare' => '>=',
            'type' => 'NUMERIC',
		),
	);
}elseif('past' == $event_type){
	$event_args['order'] = 'DESC';
	$event_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'event_start_date',
            'value' => $now_time - 86399,
            'compare' => '<',
            'type' => 'NUMERIC',
		),
		array(
			'key' => 'event_end_date',
            'value' => $now_time - 86399,
            'compare' => '<',
            'type' => 'NUMERIC',
		),
	);
}elseif('current' == $event_type){
	$event_args['order'] = 'ASC';
	$event_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key' => 'event_start_date',
            'value' => $now_time - 86399,
            'compare' => '<',
            'type' => 'NUMERIC',
		),
		array(
			'key' => 'event_end_date',
            'value' => $now_time - 86399,
            'compare' => '>=',
            'type' => 'NUMERIC',
		),
	);
}

$event_query = new WP_Query($event_args);

$paged = 1;
$event_wrapper_data = array();
if($event_query->max_num_pages <= $paged){
	$event_wrapper_data[] = 'data-lastpage="true"';
}else{
	$event_wrapper_data[] = 'data-lastpage="false"';
}

if($css_animation){
	$event_wrapper_data[] = 'data-cssanimation="'. esc_attr($css_animation) .'"';
}

$rows = '';
if($event_query->have_posts()){
	$previous_events_month = '';
	$row_count = 0;
	
	while ($event_query->have_posts()){
		$event_query->the_post();
		$row_count++;
		ob_start();
		include get_stylesheet_directory() . '/partials/event/event-calendar-row.php';
		$rows .= ob_get_clean();
	}
	wp_reset_postdata();
}

$class_to_filter = 'wpb_easl_events_calendar wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );



$html = '<div class="easl-events-calendar-wrap" '. implode( ' ', $event_wrapper_data ) .'>
			'. $top_filter .'
			<div class="easl-events-calendar-inner">
				'. $rows .'
			</div>
			<div class="easl-events-calendar-bottom">
				<div class="easl-ec-row easl-ec-row-ball"><span></span></div>
				<div class="easl-ec-load-more">
					<div class="easl-ec-load-icon">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
					</div>
					<p class="easl-ec-load-text">Loading More</p>
				</div>
			</div>
		</div>';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . ' class="' . esc_attr( trim( $css_class ) ) . '">
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_events_calendar_heading' ) ) . '
			' . $html . '
	</div>
';

echo $output;