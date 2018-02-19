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
 * Shortcode class EASL_VC_Mentors_Table
 * @var $this EASL_VC_Mentors_Table
 */
$title = $element_width = $view_all_link = $view_all_url = $view_all_text = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_animation = $this->getCSSAnimation($css_animation);

if(!$view_all_text){
	$view_all_text = 'View all Events';
}

if($title && $view_all_link){
	$title .= '<a class="easl-events-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}
easlenqueueTtaScript();
$head_row = '
	<div class="easl-mentors-table-row easl-mentors-table-head">
		<div class="easl-mentors-table-col">Year</div>
		<div class="easl-mentors-table-col">Mentor</div>
		<div class="easl-mentors-table-col">Mentee</div>
	</div>
	';
$rows = '';
$rows .= '
	<div class="easl-mentors-table-row">
		<div class="easl-mentors-table-col">
			<span class="emt-year">2017</span>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Prof. Jean-Francois Dufour</h5>
					<p>University Clinic Visceral Surgery and Medicine, Switzerland</p>
				</div>
			</div>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Dr Maria Chiara Sorbo</h5>
					<p>Italy</p>
				</div>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div class="easl-mentors-table-row">
		<div class="easl-mentors-table-col">
			<span class="emt-year">2017</span>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Prof. Jean-Francois Dufour</h5>
					<p>University Clinic Visceral Surgery and Medicine, Switzerland</p>
				</div>
			</div>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Dr Maria Chiara Sorbo</h5>
					<p>Italy</p>
				</div>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div class="easl-mentors-table-row">
		<div class="easl-mentors-table-col">
			<span class="emt-year">2017</span>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Prof. Jean-Francois Dufour</h5>
					<p>University Clinic Visceral Surgery and Medicine, Switzerland</p>
				</div>
			</div>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Dr Maria Chiara Sorbo</h5>
					<p>Italy</p>
				</div>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div class="easl-mentors-table-row">
		<div class="easl-mentors-table-col">
			<span class="emt-year">2017</span>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Prof. Jean-Francois Dufour</h5>
					<p>University Clinic Visceral Surgery and Medicine, Switzerland</p>
				</div>
			</div>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Dr Maria Chiara Sorbo</h5>
					<p>Italy</p>
				</div>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div class="easl-mentors-table-row">
		<div class="easl-mentors-table-col">
			<span class="emt-year">2017</span>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Prof. Jean-Francois Dufour</h5>
					<p>University Clinic Visceral Surgery and Medicine, Switzerland</p>
				</div>
			</div>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Dr Maria Chiara Sorbo</h5>
					<p>Italy</p>
				</div>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div class="easl-mentors-table-row">
		<div class="easl-mentors-table-col">
			<span class="emt-year">2017</span>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Prof. Jean-Francois Dufour</h5>
					<p>University Clinic Visceral Surgery and Medicine, Switzerland</p>
				</div>
			</div>
		</div>
		<div class="easl-mentors-table-col">
			<div class="emt-intro clr">
				<div class="emt-thumb">
					<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>
				</div>
				<div class="emt-mbio">
					<h5>Dr Maria Chiara Sorbo</h5>
					<p>Italy</p>
				</div>
			</div>
		</div>
	</div>
	';

$class_to_filter = 'wpb_easl_yi_meontors wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$html = '<div class="easl-mentors-table-wrap">
			<div class="easl-mentors-table">
			'. $head_row .'
			'. $rows .'
			</div>
		</div>';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . ' class="' . esc_attr( trim( $css_class ) ) . '">
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_widget_heading' ) ) . '
			' . $html . '
	</div>
';

echo $output;
wp_get_archives();