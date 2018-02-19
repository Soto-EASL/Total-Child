<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $css
 * Shortcode class EASL_VC_Carousel
 * @var $this EASL_VC_Carousel
 */
$el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$items = do_shortcode($content);


$class_to_filter = 'wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$wrapper_attributes[] = 'class="wpex-carousel easl-carousel owl-carousel clr ' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'data-items="1"';
$wrapper_attributes[] = 'data-slideby="1"';
$wrapper_attributes[] = 'data-nav="false"';
$wrapper_attributes[] = 'data-dots="true"';
$wrapper_attributes[] = 'data-autoplay="true"';
$wrapper_attributes[] = 'data-loop="true"';
$wrapper_attributes[] = 'data-autoplay-timeout="5000"';
$wrapper_attributes[] = 'data-center="false"';
$wrapper_attributes[] = 'data-items-tablet="1"';
$wrapper_attributes[] = 'data-items-mobile-landscape="1"';
$wrapper_attributes[] = 'data-items-mobile-portrait="1"';
$wrapper_attributes[] = 'data-smart-speed="150"';

$output = '';
if($items){
	$output = '
		<div ' . implode( ' ', $wrapper_attributes ) . '">
			' . $items . '
		</div>
	';
}

echo $output;