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
 * @var $this SC_LL_Video_Box
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

$items = '
	<li class="easl-events-li easl-event-li-red">
		<h3><a title="" href="'. get_permalink(167) .'">Clinical School of Hepatology Course 28: controversies in end-stage liver disease</a></h3>
		<a class="events-li-date" href=""><span class="eld-day">12</span><span class="eld-mon">OCT</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Madrid, Spain</span></p>
	</li>
	<li class="easl-events-li easl-event-li-green">
		<h3><a title="" href="'. get_permalink(167) .'">Clinical School of Hepatology Course 28: Title of course goes here</a></h3>
		<a class="events-li-date" href=""><span class="eld-day">14</span><span class="eld-mon">NOV</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Paris, France</span></p>
	</li>
	<li class="easl-events-li easl-event-li-blue">
		<h3><a title="" href="'. get_permalink(167) .'">Cholangiocytes in health and disease: from basic science to novel treatments</a></h3>
		<a class="events-li-date" href=""><span class="eld-day">13</span><span class="eld-mon">DEC</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Oslo, Norway</span></p>
	</li>
	<li class="easl-events-li easl-event-li-orrange">
		<h3><a title="" href="'. get_permalink(167) .'">Cholangiocytes in health and disease: from basic science to novel treatments</a></h3>
		<a class="events-li-date" href=""><span class="eld-day">12-13</span><span class="eld-mon">DEC</span><span class="eld-year">2017</span><i class="fa fa-play" aria-hidden="true"></i></a>
		<p class="el-location"><span class="ell-name">Clinical School</span> <span class="ell-bar">|</span> <span class="ell-country">Madrid, Spain</span></p>
	</li>
	';

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
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_events_heading' ) ) . '
			' . $html . '
	</div>
';

echo $output;