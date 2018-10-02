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
 * Shortcode class
 * @var $this EASL_VC_Events
 */
$title = $element_width = $view_all_link = $view_all_url = $view_all_text = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!$view_all_text){
	$view_all_text = 'View all Events';
}

if($title && $view_all_link){
	$title .= '<a class="easl-events-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}

$widget_subtitle = '';
if ( ! empty( $subtitle ) ) {
	$widget_subtitle .= '<p class="wpb_easl_events_subtitle">' . $subtitle . '</p>';
}

$number_posts = '-1';
if ( ! empty( $numberposts ) && (int) $numberposts > 0 ) {
	$number_posts = $numberposts;
}
$args = array(
	'post_type' => 'event',
	'numberposts' => $number_posts,
);
$events = get_posts( $args );
wp_reset_postdata();

$items = '';
$countries = easl_event_get_countries();
if ( ! empty( $events ) ) {
	$extra_class = array(
		'easl-event-li-red',
		'easl-event-li-green',
		'easl-event-li-blue',
		'easl-event-li-orrange',
	);
	$i = 0;
	foreach ( $events as $event ) {
		$event_data = get_post_meta( $event->ID );
		$event_start_date = array( '0', '0', '0' );
		if ( ! empty( $event_data['event_start_date'][0] ) ) {
			$event_start_date = explode( '/', date( 'd/M/Y', $event_data['event_start_date'][0] ) );
		}
		$items .= '
		<li class="easl-events-li ' . $extra_class[ $i ] . '">
			<h3>
				<a title="" href="' . get_permalink( $event->ID ) . '">' . $event->post_title . '</a>
			</h3>
			<a class="events-li-date" href="">
				<span class="eld-day">' . $event_start_date[0] . '</span>
				<span class="eld-mon">' . strtoupper( $event_start_date[1] ) . '</span>
				<span class="eld-year">' . $event_start_date[2] . '</span>
				<i class="fa fa-play" aria-hidden="true"></i>
			</a>
			<p class="el-location">
				<span class="ell-name">Clinical School</span> 
				<span class="ell-bar">|</span> 
				<span class="ell-country">
				' . $countries[ $event_data['event_location_country'][0] ] . ', ' . $event_data['event_location_city'][0] . '
				</span>
			</p>
		</li>';
		$i++;
		if ( $i > 3 ) {
			$i = 0;
		}
	}
}

//$items = '
//	<li class="easl-events-li easl-event-li-red">
//		<h3><a title="" href="'. get_permalink(167) .'">Clinical School of Hepatology Course 28: controversies in end-stage liver disease</a></h3>
//		<a class="events-li-date" href=""><span class="eld-day">12</span><span class="eld-mon">OCT</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
//		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Madrid, Spain</span></p>
//	</li>
//	<li class="easl-events-li easl-event-li-green">
//		<h3><a title="" href="'. get_permalink(167) .'">Clinical School of Hepatology Course 28: Title of course goes here</a></h3>
//		<a class="events-li-date" href=""><span class="eld-day">14</span><span class="eld-mon">NOV</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
//		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Paris, France</span></p>
//	</li>
//	<li class="easl-events-li easl-event-li-blue">
//		<h3><a title="" href="'. get_permalink(167) .'">Cholangiocytes in health and disease: from basic science to novel treatments</a></h3>
//		<a class="events-li-date" href=""><span class="eld-day">13</span><span class="eld-mon">DEC</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
//		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Oslo, Norway</span></p>
//	</li>
//	<li class="easl-events-li easl-event-li-orrange">
//		<h3><a title="" href="'. get_permalink(167) .'">Cholangiocytes in health and disease: from basic science to novel treatments</a></h3>
//		<a class="events-li-date" href=""><span class="eld-day">12-13</span><span class="eld-mon">DEC</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
//		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Madrid, Spain</span></p>
//	</li>
//	';
//$items = implode( '', $item );

$class_to_filter = 'wpb_easl_events wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$items .= '';

$html = '<div class="easl-events-list-wrap">
			<ul>
				'. $items .'
			</ul>
		</div>';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . ' class="' . esc_attr( trim( $css_class ) ) . '">
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_events_heading' ) ) . $widget_subtitle . '
			' . $html . '
	</div>
';

echo $output;