<?php
/**
 * EASL_VC_Staffs
 */
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $el_class
 * @var $el_id
 * @var $this EASL_VC_Staffs
 */
$el_class				 = '';
$css					 = '';
$css_animation			 = '';
$widget_title			 = '';
$staffs_number			 = '';
$include_categories		 = '';
$cat_relation			 = '';
$order					 = '';
$orderby				 = '';
$staff_col_width		 = '';
$item_content_layout	 = '';
$enable_info_template	 = '';
$info_template			 = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'vcex-module easl-staffs-wrap clr';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class		 = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings[ 'base' ], $atts );

if ( $item_content_layout == 'two_col' ) {
	$css_class .= ' easl-staff-item-two-col';
} else {
	$css_class .= ' easl-staff-item-single-col';
}

$wrapper_attributes = array();
if ( !empty( $atts[ 'el_id' ] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts[ 'el_id' ] ) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( $css_class ) . '"';
}
// Build Query
$query_args		 = array(
	'post_type'		 => 'staff',
	'posts_per_page' => -1,
);
$staffs_number	 = absint( $staffs_number );
if ( $staffs_number ) {
	$query_args[ 'posts_per_page' ] = $staffs_number;
}
$order = strtoupper( $order );
if ( in_array( $order, array( 'ASC', 'DESC' ) ) ) {
	$query_args[ 'order' ] = $order;
}
if ( $orderby && in_array( $orderby, vcex_orderby_array() ) ) {
	$query_args[ 'orderby' ] = $orderby;
}

$cats_query = $this->build_category_query( $include_categories, $cat_relation );

if ( $cats_query ) {
	$query_args[ 'tax_query' ] = $cats_query;
}
$staff_query = new WP_Query( $query_args );

if ( $staff_query->have_posts() ) {
	$this->enqueue_css_js();
	$item_class	 = array( 'easl-staff-item', vcex_get_grid_column_class( array('columns' => $staff_col_width) ), 'col' );
	$count		 = 0;
	?>
	<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
		<?php if ( $widget_title ): ?>
			<div class="easl-staffs-widget-title">
				<h2><?php echo esc_html( $widget_title ); ?></h2>
			</div>
		<?php endif; ?>
		<?php if ( $content ): ?>
			<div class="easl-staffs-widget-intro">
				<?php echo wpb_js_remove_wpautop( $content, true ); ?>
			</div>
		<?php endif; ?>
		<div class="wpex-row easl-staffs-row wpex-clr">
			<?php
			while ( $staff_query->have_posts() ) {
				$staff_query->the_post();
				$count++;
				?>
				<div class="<?php echo implode( ' ', $item_class ) . ' col-' . $count; ?>">
					<div class="easl-staff-item-inner clr">
						<?php if ( has_post_thumbnail() ): ?>
							<div class="easl-staff-item-thumb">
								<?php if ( $this->staff_has_details( get_the_ID() ) ): ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
									<?php echo $this->get_staff_profile_thumb( get_the_ID() ); ?>
									<?php if ( $this->staff_has_details( get_the_ID() ) ): ?></a><?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="easl-staff-item-detail wpex-clr">
							<h2 class="easl-staff-item-name">
								<?php if ( $this->staff_has_details( get_the_ID() ) ): ?><a href="<?php the_permalink(); ?>"><?php endif; ?>
									<span><?php the_title(); ?></span>
									<?php if ( $this->staff_has_details( get_the_ID() ) ): ?></a><?php endif; ?>
							</h2>
							<?php if ( $enable_info_template == 'true' && $info_template ): ?>
								<?php
								echo $this->parse_info_template( $info_template, get_the_ID() );
								?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php
			}
			wp_reset_query();
			?>
		</div>
	</div>
	<?php
}
?>