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
 * Shortcode class EASL_VC_YI_Fellowship
 * @var $this EASL_VC_YI_Fellowship
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

$rows = '';
$rows .= '
	<div class="yi-fellowship clr">
		<div class="yif-thumb">
			<a href="'. get_permalink() . '" title="">
				<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/fellowhip-thumb.jpg"/>
				<span class="yi-thumb-tag">STARTING 2017<br/>INCREASED FUNDING</span>
			</a>
		</div>
		<div class="yi-content">
			<div class="yif-title-wrap clr">
				<h3>
					<a href="'. get_permalink() . '">Postgraduate Fellowship Sheila Sherlock</a>
				</h3>
				<div class="yif-application-preiod">
					<span>Application Period:  15 July - 15 Sept</span>
				</div>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id consequat risus. Aliquam vitae dolor nulla. Morbi maximus orci non libero fermentum ornare. Morbi finibus dapibus lobortis. Integer mattis, tortor non laoreet commodo, magna ex rhoncus purus, et tristique elit elit a leo. Integer non sapien urna. Nulla vel arcu commodo arcu dapibus maximus. Sed laoreet fermentum enim sit amet convallis. Nunc eu massa sollicitudin, sodales mauris eu, eleifend velit. Curabitur volutpat at mi et gravida. Etiam gravid</p>
			<a class="easl-button easl-button-blue" href="'. get_permalink() . '">Find out more</a>
		</div>
	</div>
	';
$rows .= '
	<div class="yi-fellowship clr">
		<div class="yif-thumb">
			<a href="'. get_permalink() . '" title="">
				<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/fellowhip-thumb.jpg"/>
				<span class="yi-thumb-tag">STARTING 2017<br/>INCREASED FUNDING</span>
			</a>
		</div>
		<div class="yi-content">
			<div class="yif-title-wrap clr">
				<h3>
					<a href="'. get_permalink() . '">Postgraduate Fellowship Sheila Sherlock</a>
				</h3>
				<div class="yif-application-preiod">
					<span>Application Period:  15 July - 15 Sept</span>
				</div>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id consequat risus. Aliquam vitae dolor nulla. Morbi maximus orci non libero fermentum ornare. Morbi finibus dapibus lobortis. Integer mattis, tortor non laoreet commodo, magna ex rhoncus purus, et tristique elit elit a leo. Integer non sapien urna. Nulla vel arcu commodo arcu dapibus maximus. Sed laoreet fermentum enim sit amet convallis. Nunc eu massa sollicitudin, sodales mauris eu, eleifend velit. Curabitur volutpat at mi et gravida. Etiam gravid</p>
			<a class="easl-button easl-button-blue" href="'. get_permalink() . '">Find out more</a>
		</div>
	</div>
	';
$rows .= '
	<div class="yi-fellowship clr">
		<div class="yif-thumb">
			<a href="'. get_permalink() . '" title="">
				<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/fellowhip-thumb.jpg"/>
				<span class="yi-thumb-tag">STARTING 2017<br/>INCREASED FUNDING</span>
			</a>
		</div>
		<div class="yi-content">
			<div class="yif-title-wrap clr">
				<h3>
					<a href="'. get_permalink() . '">Postgraduate Fellowship Sheila Sherlock</a>
				</h3>
				<div class="yif-application-preiod">
					<span>Application Period:  15 July - 15 Sept</span>
				</div>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id consequat risus. Aliquam vitae dolor nulla. Morbi maximus orci non libero fermentum ornare. Morbi finibus dapibus lobortis. Integer mattis, tortor non laoreet commodo, magna ex rhoncus purus, et tristique elit elit a leo. Integer non sapien urna. Nulla vel arcu commodo arcu dapibus maximus. Sed laoreet fermentum enim sit amet convallis. Nunc eu massa sollicitudin, sodales mauris eu, eleifend velit. Curabitur volutpat at mi et gravida. Etiam gravid</p>
			<a class="easl-button easl-button-blue" href="'. get_permalink() . '">Find out more</a>
		</div>
	</div>
	';
$rows .= '
	<div class="yi-fellowship clr">
		<div class="yif-thumb">
			<a href="'. get_permalink() . '" title="">
				<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/fellowhip-thumb.jpg"/>
				<span class="yi-thumb-tag">STARTING 2017<br/>INCREASED FUNDING</span>
			</a>
		</div>
		<div class="yi-content">
			<div class="yif-title-wrap clr">
				<h3>
					<a href="'. get_permalink() . '">Postgraduate Fellowship Sheila Sherlock</a>
				</h3>
				<div class="yif-application-preiod">
					<span>Application Period:  15 July - 15 Sept</span>
				</div>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id consequat risus. Aliquam vitae dolor nulla. Morbi maximus orci non libero fermentum ornare. Morbi finibus dapibus lobortis. Integer mattis, tortor non laoreet commodo, magna ex rhoncus purus, et tristique elit elit a leo. Integer non sapien urna. Nulla vel arcu commodo arcu dapibus maximus. Sed laoreet fermentum enim sit amet convallis. Nunc eu massa sollicitudin, sodales mauris eu, eleifend velit. Curabitur volutpat at mi et gravida. Etiam gravid</p>
			<a class="easl-button easl-button-blue" href="'. get_permalink() . '">Find out more</a>
		</div>
	</div>
	';
$rows .= '
	<div class="yi-fellowship yi-applicaiton-closed clr">
		<div class="yif-thumb">
			<a href="'. get_permalink() . '" title="">
				<img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/fellowhip-thumb.jpg"/>
			</a>
		</div>
		<div class="yi-content">
			<div class="yif-title-wrap clr">
				<h3>
					<a href="'. get_permalink() . '">Postgraduate Fellowship Sheila Sherlock</a>
				</h3>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id consequat risus. Aliquam vitae dolor nulla. Morbi maximus orci non libero fermentum ornare. Morbi finibus dapibus lobortis. Integer mattis, tortor non laoreet commodo, magna ex rhoncus purus, et tristique elit elit a leo. Integer non sapien urna. Nulla vel arcu commodo arcu dapibus maximus. Sed laoreet fermentum enim sit amet convallis. Nunc eu massa sollicitudin, sodales mauris eu, eleifend velit. Curabitur volutpat at mi et gravida. Etiam gravid</p>
			<a class="easl-button easl-button-blue" href="'. get_permalink() . '">Find out more</a>
		</div>
		<div class="yif-application-closed-block">
			<p class="yif-application-closed-text">Applications are now closed</p>
			<p class="yif-awarded clr">
				<img src="http://easl.websitestage.co.uk/wp-content/uploads/2017/11/thumb-emma.png" alt="">
				The Daniel Alagille Award was awarded to: <br/><span class="yf-awardee-name">DR Emma R Anderson</span>
			</p>
		</div>
	</div>
	';

$class_to_filter = 'wpb_easl_yi_fellowship wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$html = '<div class="easl-yi-fellowship-wrap">
			<div class="easl-yi-fellowship-inner">
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