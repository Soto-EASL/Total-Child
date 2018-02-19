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
 * Shortcode class EASL_VC_Mentors
 * @var $this EASL_VC_Mentors
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
$rows = '';
$rows .= '
	<div id="prof-jean-francois-dufour" class="vc_tta-panel vc_active" data-vc-content=".vc_tta-panel-body">
		<div class="vc_tta-panel-heading">
			<h4 class="vc_tta-panel-title vc_tta-controls-icon-position-right">
				<a href="#prof-jean-francois-dufour" data-vc-accordion="" data-vc-container=".vc_tta-container">
					<span class="vc_tta-title-text">Prof. Jean-Francois Dufour, MD</span><i class="vc_tta-controls-icon vc_tta-controls-icon-chevron"></i>
				</a>
			</h4>
		</div>
		<div class="vc_tta-panel-body">
			<div class="mentors-section-body clr">
				<p><img class="mentors-thumb alignleft" alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lorem euismod, maximus dui a, laoreet sapien. Nullam auctor turpis nec nibh tempor, ut viverra nulla convallis. Duis sit amet magna nec nibh sodales posuere rhoncus quis augue. Proin augue velit, lobortis suscipit mattis gravida, facilisis at nisl. Cras ut neque ex. Aliquam gravida, nibh non ornare aliquet, lorem orci aliquet diam, eu laoreet urna ligula iaculis urna. Ut a tempus orci. Cras et suscipit urna, id egestas neque. Phasellus iaculis ipsum tortor, vel fringilla turpis mattis sit amet. Sed sed nibh justo. 
	e maximus vestibulum. Curabitur varius feugiat finibus. Vivamus suscipit euismod sapien a fringilla.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lorem euismod, maximus dui a, laoreet sapien. Nullam auctor turpis nec nibh tempor, ut viverra nulla convallis. Duis sit amet magna nec nibh sodales posuere.</p>
				<p>Proin augue velit, lobortis suscipit mattis gravida, facilisis at nisl. Cras ut neque ex. Aliquam gravida, nibh non ornare aliquet, lorem orci aliquet diam, eu laoreet urna ligula iaculis urna. Ut a tempus orci. Cras et suscipit urna, id egestas neque. </p>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div id="mario-strazzabosco" class="vc_tta-panel" data-vc-content=".vc_tta-panel-body">
		<div class="vc_tta-panel-heading">
			<h4 class="vc_tta-panel-title vc_tta-controls-icon-position-right">
				<a href="#mario-strazzabosco" data-vc-accordion="" data-vc-container=".vc_tta-container">
					<span class="vc_tta-title-text">Mario Strazzabosco MD, PhD</span><i class="vc_tta-controls-icon vc_tta-controls-icon-chevron"></i>
				</a>
			</h4>
		</div>
		<div class="vc_tta-panel-body">
			<div class="mentors-section-body clr">
				<p><img class="mentors-thumb alignleft" alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lorem euismod, maximus dui a, laoreet sapien. Nullam auctor turpis nec nibh tempor, ut viverra nulla convallis. Duis sit amet magna nec nibh sodales posuere rhoncus quis augue. Proin augue velit, lobortis suscipit mattis gravida, facilisis at nisl. Cras ut neque ex. Aliquam gravida, nibh non ornare aliquet, lorem orci aliquet diam, eu laoreet urna ligula iaculis urna. Ut a tempus orci. Cras et suscipit urna, id egestas neque. Phasellus iaculis ipsum tortor, vel fringilla turpis mattis sit amet. Sed sed nibh justo. 
	e maximus vestibulum. Curabitur varius feugiat finibus. Vivamus suscipit euismod sapien a fringilla.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lorem euismod, maximus dui a, laoreet sapien. Nullam auctor turpis nec nibh tempor, ut viverra nulla convallis. Duis sit amet magna nec nibh sodales posuere.</p>
				<p>Proin augue velit, lobortis suscipit mattis gravida, facilisis at nisl. Cras ut neque ex. Aliquam gravida, nibh non ornare aliquet, lorem orci aliquet diam, eu laoreet urna ligula iaculis urna. Ut a tempus orci. Cras et suscipit urna, id egestas neque. </p>
			</div>
		</div>
	</div>
	';
$rows .= '
	<div id="prof-michael-trauner" class="vc_tta-panel" data-vc-content=".vc_tta-panel-body">
		<div class="vc_tta-panel-heading">
			<h4 class="vc_tta-panel-title vc_tta-controls-icon-position-right">
				<a href="#prof-michael-trauner" data-vc-accordion="" data-vc-container=".vc_tta-container">
					<span class="vc_tta-title-text">Prof. Michael Trauner, MD</span><i class="vc_tta-controls-icon vc_tta-controls-icon-chevron"></i>
				</a>
			</h4>
		</div>
		<div class="vc_tta-panel-body">
			<div class="mentors-section-body clr">
				<p><img class="mentors-thumb alignleft" alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-prof-jean.png"/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lorem euismod, maximus dui a, laoreet sapien. Nullam auctor turpis nec nibh tempor, ut viverra nulla convallis. Duis sit amet magna nec nibh sodales posuere rhoncus quis augue. Proin augue velit, lobortis suscipit mattis gravida, facilisis at nisl. Cras ut neque ex. Aliquam gravida, nibh non ornare aliquet, lorem orci aliquet diam, eu laoreet urna ligula iaculis urna. Ut a tempus orci. Cras et suscipit urna, id egestas neque. Phasellus iaculis ipsum tortor, vel fringilla turpis mattis sit amet. Sed sed nibh justo. 
	e maximus vestibulum. Curabitur varius feugiat finibus. Vivamus suscipit euismod sapien a fringilla.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque quis lorem euismod, maximus dui a, laoreet sapien. Nullam auctor turpis nec nibh tempor, ut viverra nulla convallis. Duis sit amet magna nec nibh sodales posuere.</p>
				<p>Proin augue velit, lobortis suscipit mattis gravida, facilisis at nisl. Cras ut neque ex. Aliquam gravida, nibh non ornare aliquet, lorem orci aliquet diam, eu laoreet urna ligula iaculis urna. Ut a tempus orci. Cras et suscipit urna, id egestas neque. </p>
			</div>
		</div>
	</div>
	';

$class_to_filter = 'wpb_easl_yi_meontors wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$html = '<div class="vc_tta-container" data-vc-action="collapseAll">
			<div class="vc_general vc_tta vc_tta-accordion vc_tta-color-grey vc_tta-style-classic vc_tta-shape-rounded vc_tta-o-shape-group vc_tta-controls-align-left vc_tta-o-all-clickable">
				<div class="vc_tta-panels-container">
					<div class="vc_tta-panels">
						'. $rows .'
					</div>
				</div>
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