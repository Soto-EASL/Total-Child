<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * @var $el_class
 * @var $el_id
 * @var $this EASL_VC_Yearly_Awardee
 */
$el_id         = '';
$el_class      = '';
$css           = '';
$css_animation = '';

$people_per_row = '';
$display_thumb  = '';
$award_type     = '';
$year_num       = '';
$people_order   = '';
$people_orderby = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'easl-yearly-awardees-wrap clr';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

if ( ! empty( $atts['el_id'] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( $css_class ) . '"';
}

if ( ! in_array( $people_order, array( 'ASC', 'DESC' ) ) ) {
	$people_order = 'ASC';
}

$peoples_args = array(
	'post_type'      => 'staff',
	'posts_per_page' => - 1,
	'order'          => $people_order,
);
switch ( $people_orderby ) {
	case 'first_name':
		$peoples_args['orderby']  = 'meta_value';
		$peoples_args['meta_key'] = 'first_name';
		break;
	case 'last_name':
		$peoples_args['orderby']  = 'meta_value';
		$peoples_args['meta_key'] = 'last_name';
		break;
	case 'ID':
		$peoples_args['orderby'] = 'ID';
		break;
	case 'title':
		$peoples_args['orderby'] = 'title';
		break;
	case 'menu_order':
		$peoples_args['orderby'] = 'menu_order';
		break;

	default:
		$peoples_args['orderby'] = 'post__in';
}
switch ( $people_per_row ) {
	case '1':
		$vc_col_width = 'vc_col-sm-12';
		break;
	case '2':
		$vc_col_width = 'vc_col-sm-6';
		break;
	case '3':
		$vc_col_width = 'vc_col-sm-4';
		break;
	case '4':
		$vc_col_width = 'vc_col-sm-3';
		break;
	default:
		$vc_col_width = 'vc_col-sm-4';
}

$award_type = absint( $award_type );

$year_num = absint( $year_num );

$avaiable_years = array();
if ( $year_num > 0 ) {
	$avaiable_years = EASL_Award_Config::get_years( $award_type, $year_num, true );
}
$do_auery   = true;
$query_args = array(
	'post_type'      => EASL_Award_Config::get_slug(),
	'posts_per_page' => - 1,
	'order'          => 'DESC',
	'oderby'         => 'meta_value_num',
	'meta_key'       => 'award_year'
);

if ( count( $avaiable_years ) > 0 ) {
	$query_args['meta_query'] = array(
		'relation' => 'AND',
		array(
			'key'     => 'award_year',
			'value'   => $avaiable_years,
			'compare' => 'IN',
		)
	);
}
if ( $award_type ) {
	$query_args['tax_query'] = array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'award_group',
			'field'    => 'id',
			'terms'    => array( $award_type ),
			'operator' => 'IN',
		)
	);
}

if ( $year_num > 0 && count( $avaiable_years ) < 1 ) {
	$do_auery = false;
}
$award_query = false;
if ( $do_auery ) {
	$award_query = new WP_Query( $query_args );
}
if ( $award_query && $award_query->have_posts() ):
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?>>
		<?php
		while ( $award_query->have_posts() ):
			$award_query->the_post();
			$award_thumb = '';
			if ( 'true' == $display_thumb && has_post_thumbnail() ) {
				$award_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
				$award_thumb = $award_thumb ? $award_thumb[0] : '';
			}
			?>
            <div class="easl-yearly-awardees-row">
                <div class="easl-yearly-awardees-year"><span><?php echo get_field( 'award_year' ); ?></span></div>
				<?php
				$awardees         = get_field( 'awardees' );

				if ( $awardees && count( $awardees ) > 0 ):
					$peoples_args['post__in'] = $awardees;
					$people_query = new WP_Query( $peoples_args );
					if ( $people_query->have_posts() ):
						?>
                        <div class="easl-yearly-awardees-peoples vc_row wpb_row vc_inner vc_row-fluid">
							<?php
							while ( $people_query->have_posts() ):
								$people_query->the_post();
								$image      = has_post_thumbnail( get_the_ID() ) ?
									wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
								$avatar_src = $image ? $image[0] : get_stylesheet_directory_uri() . '/images/default-avatar.png';

								$awardee_profile_link = get_field( 'recognition_awardee_profile_link' );
								?>
                                <div class="wpb_column vc_column_container <?php echo $vc_col_width; ?>">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="easl-yearly-awardee-image">
												<?php if ( $awardee_profile_link && trim( $awardee_profile_link['url'] ) ): ?>
                                                <a href="<?php echo esc_url( trim( $awardee_profile_link['url'] ) ); ?>" <?php if ( $awardee_profile_link['target'] ) {
													echo 'target="' . esc_attr( $awardee_profile_link['target'] ) . '"';
												} ?>>
													<?php endif; ?>
                                                    <img src="<?php echo $avatar_src; ?>" alt=""/>
													<?php if ( $awardee_profile_link ): ?></a><?php endif; ?>
                                            </div>

                                            <h5 class="easl-yearly-awardee-title">
												<?php if ( $awardee_profile_link && trim( $awardee_profile_link['url'] ) ): ?>
                                                <a href="<?php echo esc_url( trim( $awardee_profile_link['url'] ) ); ?>" <?php if ( $awardee_profile_link['target'] ) {
													echo 'target="' . esc_attr( $awardee_profile_link['target'] ) . '"';
												} ?>>
													<?php endif; ?>
													<?php echo the_title(); ?>
													<?php if ( $awardee_profile_link ): ?></a><?php endif; ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
							<?php endwhile; ?>
                            <?php if($award_thumb): ?>
                            <div class="wpb_column vc_column_container vc_col-sm-6">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="easl-yearly-award-thumb">
                                            <img src="<?php echo $award_thumb; ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
						<?php
						wp_reset_query();
					endif;
					?>
				<?php endif; ?>
            </div>
		<?php endwhile; ?>
    </div>
	<?php
	wp_reset_query();
endif;
?>