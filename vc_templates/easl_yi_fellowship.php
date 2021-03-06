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
$title         = '';
$element_width = '';
$view_all_link = '';
$view_all_url  = '';
$view_all_text = '';
$el_class      = '';
$el_id         = '';
$css_animation = '';
// Shortcode = easl_yi_fellowship
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

//$a = $atts['category_name'];

$the_fellowships = new WP_Query( array(
	'post_type'      => 'fellowship',
	'posts_per_page' => - 1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',

) );
$css_animation   = $this->getCSSAnimation( $css_animation );

if ( ! $view_all_text ) {
	$view_all_text = 'View all Events';
}

if ( $title && $view_all_link ) {
	$title .= '<a class="easl-events-all-link" href="' . esc_url( $view_all_url ) . '">' . $view_all_text . '</a>';
}
$rows = '';
if ( $the_fellowships->have_posts() ) {
	while ( $the_fellowships->have_posts() ) {

		$the_fellowships->the_post();


		$image = has_post_thumbnail( get_the_ID() ) ?
			wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';

		$app_start_1 = get_field( 'aplication_period_start' );
		$app_end_1   = get_field( 'aplication_period_finish' );
		$app_start_2 = get_field( 'second_aplication_period_start' );
		$app_end_2   = get_field( 'second_aplication_period_finish' );
		$apply_url   = get_field( 'apply_url' );

		if ( $app_start_1 ) {
			$app_start_1 = new DateTime( $app_start_1 );
		}
		if ( $app_end_1 ) {
			$app_end_1 = new DateTime( $app_end_1 );
		}
		if ( $app_start_2 ) {
			$app_start_2 = new DateTime( $app_start_2 );
		}
		if ( $app_end_2 ) {
			$app_end_2 = new DateTime( $app_end_2 );
		}

		$finished = new DateTime( get_field( 'aplication_period_finish' ) );

		$today              = new DateTime( 'now' );
		$application_period = '';
		$thumb_tag          = '';
		$closed_block       = '';
		$is_finished        = false;
		$is_open            = false;

		$first_aplication_period_start  = date( "d M", strtotime( get_field( 'aplication_period_start' ) ) );
		$first_aplication_period_finish = date( "d M", strtotime( get_field( 'aplication_period_finish' ) ) );

		$second_aplication_period_start  = get_field( 'second_aplication_period_start' ) ? date( "d M", strtotime( get_field( 'second_aplication_period_start' ) ) ) : '';
		$second_aplication_period_finish = get_field( 'second_aplication_period_finish' ) ? date( "d M", strtotime( get_field( 'second_aplication_period_finish' ) ) ) : '';

		$app_period = array();

		if ( ( $app_start_1 && $app_end_1 ) && ( $today > $app_start_1 ) && ( $today < $app_end_1 ) ) {
			$is_open = true;
		}
		if ( ( $app_start_2 && $app_end_2 ) && ( $today > $app_start_2 ) && ( $today < $app_end_2 ) ) {
			$is_open = true;
		}
		$apply_button_html = '';
		if ( $is_open ) {
			if ( $app_start_1 && $app_end_1 ) {
				$app_period[] = $first_aplication_period_start . ' - ' . $first_aplication_period_finish;
			}
			if ( $app_start_2 && $app_end_2 ) {
				$app_period[] = $second_aplication_period_start . ' - ' . $second_aplication_period_finish;
			}
			$app_period        = '<span>Application Period: <strong style="display: inline-block;font-weight: inherit;vertical-align: top">' . implode( '<br/>', $app_period ) . '</strong></span>';
			$thumb_tag         = '<span class="yi-thumb-tag">' . get_field( 'featured_image_caption' ) . '</span>';
			$apply_button_html = '<a class="easl-generic-button easl-size-medium easl-color-blue" style="margin-left: 10px;" href="' . get_permalink() . '">' . __( 'Apply Here', 'total-child' ) . ' <span class="easl-generic-button-icon"><span class="ticon ticon-chevron-right"></span></span></a>';
		} else {
			$app_period  = '<span style="padding: 10px 54px;color:#333333;">Applications are now closed</span>';
			$is_finished = true;
		}
		$application_period = '<div class="yif-application-preiod">' . $app_period . '</div>';
		//$rows .= '<div class="yi-fellowship clr '.($is_finished ? 'yi-applicaiton-closed' : '').'">'.
		$rows .= '<div class="yi-fellowship clr">' .
		         '<div class="yif-thumb">' .
		         '<a href="' . get_permalink() . '" title="">' .
		         '<img alt="" src="' . $image[0] . '"/>' .
		         $thumb_tag .
		         '</a>' .
		         '</div>' .
		         '<div class="yi-content">' .

		         '<div class="yif-title-wrap clr">' .
		         '<h3>' .
		         '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' .
		         '</h3>' .
		         $application_period .
		         '</div>' .
		         '<p class="sp-excerpt">' . get_the_excerpt() . '</p>' .
		         '<a class="easl-generic-button easl-size-medium easl-color-blue" href="' . get_permalink() . '">Find out more <span class="easl-generic-button-icon"><span class="ticon ticon-chevron-right"></span></span></a>' .
		         $apply_button_html .
		         '</div>' .
		         $closed_block .
		         '</div>';
	}
}


$class_to_filter = 'wpb_easl_yi_fellowship wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$html = '<div class="easl-yi-fellowship-wrap">
			<div class="easl-yi-fellowship-inner">
				' . $rows . '
			</div>
		</div>';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '<div ' . implode( ' ', $wrapper_attributes ) . ' class="' . esc_attr( trim( $css_class ) ) . '">' . wpb_widget_title( array(
		'title'      => $title,
		'extraclass' => 'wpb_easl_widget_heading'
	) ) . '
			' . $html . '
	</div>
';

echo $output;
