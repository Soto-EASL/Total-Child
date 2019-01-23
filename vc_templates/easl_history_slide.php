<?php
/**
 * EASL_VC_Staffs
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $el_class
 * @var $el_id
 * @var $this EASL_VC_Secretary_Generals_Carousel
 */
$el_class      = '';
$css           = '';
$css_animation = '';
$order         = '';
$limit         = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'easl-history-slide-wrap';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();

if ( ! empty( $atts['el_id'] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( $css_class ) . '"';
}
// Build Query
$limit = absint( $limit );
if ( ! $limit ) {
	$limit = - 1;
}
if ( in_array( $order, array( 'ASC', 'DESC' ) ) ) {
	$order = 'DESC';
}
$query_args = array(
	'post_type'      => EASL_History_Config::get_slug(),
	'status'         => 'publish',
	'posts_per_page' => $limit,
	'meta_key' => 'history_year',
	'orderby' => 'meta_value',
	'order' => $order,
);

$history_query = new WP_Query( $query_args );

$html = '';
$dates = '';
$issues = '';
$image = [];
$year_list = [];
$year_selected = 0;
if ( $history_query->have_posts() ) {

	while ( $history_query->have_posts() ){
		$history_query->the_post();

		$year = get_post_meta(get_the_ID(), 'history_year', true);

		if (has_post_thumbnail( get_the_ID() ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
		}

		if($year){
			$year_list[] = $year;
			$selected = $year_selected < 1 ? 'class="selected"' : '';
			$dates .= '<li class="slider-frame-points" data-year="'.$year.'"><a href="#'.$year.'" '.$selected.' >'.$year.'</a></li>';

			$issues .= '<li id="'.$year.'"><div style="float: left; width: 50%;"><img src="'.$image[0].'" width="256" height="256" /></div>'.
			           '<div style="float: left;width: 50%">'.
			           '<h1>'.$year.'</h1>'.
			           '<h2>'.get_the_title().'</h2>'.get_the_content().
			           '</div></li>';

			$year_selected++;
		}
	}
	wp_reset_query();
}
if(count($year_list) > 0):
    $this->front_end_assets();
?>

    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
        <div id="timeline">
            <div class="history-slider-logo">
            </div>
            <ul id="issues">
			    <?php echo $issues;?>
            </ul>
            <ul id="dates">
			    <?php echo $dates;?>
            </ul>
            <a href="#" id="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" id="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
            <div class="slider-block">
                <div class="timeline-value"><?php echo max($year_list);?></div>
                <div class="slider-wrapper-block">
                    <div id='slider'>
                        <div id="custom-handle" class="ui-slider-handle"></div>
                    </div>
                </div>
                <div class="timeline-value"><?php echo min($year_list);?></div>
            </div>
        </div>
    </div>
<?php endif; ?>