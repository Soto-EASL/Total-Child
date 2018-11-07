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


$topics_req = !empty($_REQUEST['topics']) ? $this->string_to_array($_REQUEST['topics']): false;
$meeting_type_req = !empty($_REQUEST['type']) ? absint($_REQUEST['type']): false;
if(!$topics_req) {
	$topics_req = array();
}

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

$topic_country_map = easl_get_events_topic_count();

foreach($topics as $topic_id => $topic_name){
	$topic_color = get_term_meta($topic_id, 'easl_tax_color', true);
	if(!$topic_color){
		$topic_color = 'blue';
	}
	$topic_ccs = isset($topic_country_map[$topic_id]) ? $topic_country_map[$topic_id] : array();
	$topics_list .= '
		<li>
			<label class="easl-custom-checkbox csic-'. $topic_color .'">
				<input type="checkbox" name="ec_filter_topics[]" value="'. $topic_id .'" data-countries="'. esc_attr( json_encode($topic_ccs)) .'" '. checked(in_array($topic_id, $topics_req), true, false) .' /> <span style="">'. esc_html($topic_name) .'</span>
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
	'parent' => '0',
) );

if( !is_array($meeting_types)){
	$meeting_types = array();
}
foreach($meeting_types as $meeting_typ_id => $meeting_type_name){
	$meeting_type_list .= '
		<option value="'. $meeting_typ_id .'" '. selected($meeting_typ_id, $meeting_type_req, false) .'>'. esc_html($meeting_type_name) .'</option>
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
<style>
    .entry ul.submit-proposal{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .submit-proposal li{
        padding: 12px 0;
        list-style: none;
        border-bottom: 1px solid #dedede;
    }
    .submit-proposal li:last-child{
    border-bottom: none;
    }
    .submit-proposal li a{
        color: #004b87;
        font-family: "KnockoutHTF51Middleweight", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 16px;
    }
    .easl-custom-select .ecs-list {
        display: none;
        background: #fff;
        border: 1px solid #e3e0e0;
        position: absolute;
        left: 0;
        padding: 0;
        margin: 0;
        width: 100%;
        list-style: none;
        z-index: 10;
    }
</style>
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
						<input type="text" name="ecf_search" value="" placeholder="Search"/>
						<span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
					</div>
					<div class="easl-row">
						<div class="easl-col easl-col-2-3">
							<div class="easl-col-inner">
							    <div class="vc_row wpb_row vc_row-fluid no-bottom-margins">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div class="wpb_text_column wpb_content_element ">
                                        <div class="wpb_wrapper">
                                            <h2 style="margin-bottom: 10px;">Filter by:</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
								<div class="ec-filter-fields">
								    <div class="ec-filter-field-wrap">
										<div class="ecf-events-types" style="margin-bottom: 15px">
											<label class="easl-custom-radio"><input type="radio" name="organizer" value="1" checked="checked"/> <span>EASL Organised</span></label>
											<label class="easl-custom-radio"><input type="radio" name="organizer" value="2"/> <span>Other Events</span></label>
										</div>
									
										<div class="easl-custom-select easl-custom-select-filter-type">
											<span class="ec-cs-label">Meeting Type</span>
											<select name="ec_meeting_type">
												'. $meeting_type_list .'
											</select>
										</div>
									</div>
									<div class="ec-filter-field-wrap ec-filter-field-location">
										<div class="ecf-events-types" style="margin-bottom: 15px">
											<label class="easl-custom-radio"><input type="radio" name="ec_filter_type" value="future" checked="checked"/> <span>Future Events</span></label>
											<label class="easl-custom-radio"><input type="radio" name="ec_filter_type" value="past"/> <span>Past Events</span></label>
										</div>
									
										<div class="easl-custom-select easl-custom-select-filter-location">
											<span class="ec-cs-label">Location</span>
											<select name="ec_location">
												'. $location_list .'
											</select>
										</div>
									</div>
									<div class="ec-filter-field-wrap">
										
									</div>
									<div class="ec-filter-field-wrap" style="margin-bottom:0;margin-top: 34px;">
										<div class="easl-filter-reset-wrap">
											<button class="easl-button easl-button-small easl-ecf-reset"
											style="color: #004b87;
                                            background: #ffffff;
                                            padding: 0;
                                            font-size: 14px;
                                            "><i class="fa fa-times-circle"></i> Clear Filters</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="easl-col easl-col-3 ecf-submit-event">
							<div class="easl-col-inner" style="border-left: 2px solid #004b87;">
								<h4>Submit your proposal</h4>
								
								<ul class="submit-proposal">
								    <li><a href="mailto:easloffice@easloffice.eu">EASL Endorsement or Sponsorship requests <i class="fa fa-angle-right"></i></a></li>
								    <li><a href="mailto:easloffice@easloffice.eu">Announce my Event <i class="fa fa-angle-right"></i></a></li>
								    <li><a href="mailto:easloffice@easloffice.eu">Call for Proposal <i class="fa fa-angle-right"></i></a></li>
                                </ul>
								
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
$meta_query_date = array();
if('future' == $event_type){
	$event_args['order'] = 'ASC';
	$meta_query_date[] = array(
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
	$meta_query_date[] = array(
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
	$meta_query_date[] = array(
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


$organizer = !empty($_REQUEST['organizer']) ? absint($_REQUEST['organizer']) : 1;
$meta_query[] = array(
	'relation' => 'AND',
	array(
		'key' => 'event_organisation',
		'value' => $organizer,
		'compare' => '=',
		'type' => 'NUMERIC',
	)
);
if(count($meta_query_date) > 0){
	$meta_query[] = $meta_query_date;
}

// Check if there is any meta queyr
if(count($meta_query) > 0){
	$meta_query['relation'] = 'AND';
	$event_args['meta_query'] = $meta_query;
}
			
// Taxonomy query args
$tax_query = array();
// Topic
if( is_array($topics_req) && count($topics_req) > 0){
	$tax_query[] = array(
		'taxonomy' => EASL_Event_Config::get_topic_slug(),
		'field' => 'term_id',
		'terms' => $topics_req,
	);
}
// Meeting Type
if( $meeting_type_req){
	$tax_query[] = array(
		'taxonomy' => EASL_Event_Config::get_meeting_type_slug(),
		'field' => 'term_id',
		'terms' => array($meeting_type_req),
	);
}
// Check if there is any topic/meeting type
if(count($tax_query) > 0){
	$tax_query['relation'] = 'AND';
	$event_args['tax_query'] = $tax_query;
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
$output .= $this->output_inline_script();
echo $output;