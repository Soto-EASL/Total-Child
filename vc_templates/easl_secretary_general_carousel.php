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
$orderby       = '';
$limit         = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'vcex-module wpex-carousel wpex-carousel-post-type wpex-clr owl-carousel arrwstyle-slim arrwpos-abs easl-secretary-generals-carousel';
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
	'post_type'      => EASL_Secretary_Generals_Config::get_slug(),
	'status'         => 'publish',
	'posts_per_page' => $limit,
	'order'          => $order,
);

if ( $orderby == 'year' ) {
	$query_args['orderby']  = 'meta_value';
	$query_args['meta_key'] = 'year';
} elseif ( $orderby == 'name' ) {
	$query_args['orderby']  = 'meta_value';
	$query_args['meta_key'] = 'name';
}

$sg_query = new WP_Query( $query_args );

if ( $sg_query->have_posts() ) {
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?> data-items="5" data-slideby="1" data-nav="true"
                                                            data-dots="false" data-autoplay="false" data-loop="true"
                                                            data-autoplay-timeout="5000" data-center="false"
                                                            data-margin="15" data-items-tablet="3"
                                                            data-items-mobile-landscape="2"
                                                            data-items-mobile-portrait="1" data-smart-speed="150">
		<?php
		while ( $sg_query->have_posts() ):
			$sg_query->the_post();
			$year = get_field( 'year' );
			$name = get_field( 'name' );
			if ( has_post_thumbnail() && $year && $name ):
				?>
                <div class="wpex-carousel-slide wpex-clr">
                    <div class="sec-genral-details wpex-clr">
                        <h5 class="sec-gen-year"><?php echo $year; ?></h5>
                        <h5 class="sec-gen-name"><?php echo $name; ?></h5>
                    </div>
                    <div class="sec-gen-image wpex-clr">
						<?php the_post_thumbnail( 'full' ); ?>
                    </div>
                </div>
			<?php
			endif;
		endwhile;
		wp_reset_query();
		?>
    </div>
	<?php
}
?>