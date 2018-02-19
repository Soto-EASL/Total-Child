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
 * @var $content - shortcode content
 * Shortcode class EASL_VC_Menu_Stacked_content
 * @var $this EASL_VC_Menu_Stacked_content
 */
$title = $nav_menu = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$menu_content = '';
if($nav_menu){
	$menu_content = wp_nav_menu(
		array(
			'menu' => $nav_menu,
			'container'		 => '',
			'menu_class'	 => 'msc-menu',
			'link_before'	 => '',
			'link_after'	 => '',
			'fallback_cb'	 => '',
			'echo'			 => false,
		)
	);
}
if($menu_content){
	$menu_content = '
		<div class="easl-msc-menu-wrap">
			'. $menu_content .'
		</div>
		';
}


$css_classes = 'easl-menu-stacked-content wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$css_classes .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );

$wrapper_attributes = array();

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_classes ) ) . '"';
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . '>
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_widget_heading' ) ) . '
		<div class="easl-msc-container">
			'. $menu_content .'
			<div class="easl-msc-content-wrap">
				<div class="easl-msc-content-wrap-inner">
					'. wpb_js_remove_wpautop( $content ) .'
				</div>
			</div>
		</div>
	</div>
	';

echo $output;