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
$title = $nav_menu = $layout =  $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_classes = 'easl-menu-stacked-content wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$css_classes .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );


if($layout == "vertical") {
	$container_class = 'easl-msc-container-vertical';
	$menu_wrap_class = "easl-msc-menu-wrap-vertical";
	$content_wrapp_class = "easl-msc-content-wrap-vertical";
	$css_classes .= ' easl-menu-stacked-content-vertical';
	$menu_class = 'msch-menu';
}else{
	$container_class = 'easl-msc-container';
	$menu_wrap_class = "easl-msc-menu-wrap";
	$content_wrapp_class = "easl-msc-content-wrap";
	$menu_class = 'msc-menu';
}

$menu_content = '';
if($nav_menu){
	$menu_content = wp_nav_menu(
		array(
			'menu' => $nav_menu,
			'container'		 => '',
			'menu_class'	 => $menu_class,
			'link_before'	 => '',
			'link_after'	 => '',
			'fallback_cb'	 => '',
			'echo'			 => false,
		)
	);
}
if($menu_content){
	$menu_content = '
		<div class="'.$menu_wrap_class.'">
			'. $menu_content .'
		</div>
		';
}

$wrapper_attributes = array();

$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_classes ) ) . '"';

if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . '>
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_widget_heading' ) ) . '
		<div class="'.$container_class.'">
			'. $menu_content .'
			<div class="'. $content_wrapp_class .'">
				<div class="easl-msc-content-wrap-inner">
					'. wpb_js_remove_wpautop( $content ) .'
				</div>
			</div>
		</div>
	</div>
	';

echo $output;