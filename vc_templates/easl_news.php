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
	$view_all_text = 'View all News';
}

if($title && $view_all_link){
	$title .= '<a class="easl-news-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}

$items = '
	<div class="easl-news-col easl-col easl-col-3">
		<div class="easl-col-inner">
			<article class="easl-news-item">
				<figure><a href=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/thumb1.jpg"/></a></figure>
				<p class="easl-news-date">10/09/17</p>
				<h3><a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h3>
				<p class="easl-news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet tempus lectus, sit amet vehicula felis. Vivamus euismod tempus turpis at semper. Ut urna magna, malesuada quis orci…</p>
			</article>
		</div>
	</div>
	<div class="easl-news-col easl-col easl-col-3">
		<div class="easl-col-inner">
			<article class="easl-news-item">
				<p class="easl-news-date">09/09/17</p>
				<h3><a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h3>
				<p class="easl-news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet tempus lectus, sit amet vehicula felis. Vivamus euismod tempus turpis at semper. Ut urna magna, malesuada quis orci…</p>
			</article>
			<article class="easl-news-item">
				<p class="easl-news-date">07/09/17</p>
				<h3><a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h3>
				<p class="easl-news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet tempus lectus, sit amet vehicula felis. Vivamus euismod tempus turpis at semper. Ut urna magna, malesuada quis orci…</p>
			</article>
		</div>
	</div>
	<div class="easl-news-col easl-col easl-col-3">
		<div class="easl-col-inner">
			<article class="easl-news-item">
				<figure><a href=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/thumb2.jpg"/></a></figure>
				<p class="easl-news-date">06/09/17</p>
				<h3><a href="">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h3>
				<p class="easl-news-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet tempus lectus, sit amet vehicula felis. Vivamus euismod tempus turpis at semper. Ut urna magna, malesuada quis orci…</p>
			</article>
		</div>
	</div>
	';

$class_to_filter = 'wpb_easl_news_list wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$items .= '';

$html = '<div class="easl-news-container easl-container">
			<div class="easl-news-row easl-row">
				'. $items .'
			</div>
		</div>';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . ' class="' . esc_attr( trim( $css_class ) ) . '">
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_news_heading' ) ) . '
			' . $html . '
	</div>
';

echo $output;