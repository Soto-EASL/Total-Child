<?php
/**
 * Single fellowship layout
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 4.4.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image = has_post_thumbnail( get_the_ID() ) ?
	wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';

$first_aplication_period_start  = get_field( 'aplication_period_start' );
$first_aplication_period_start  = $first_aplication_period_start ? date( "d-M", strtotime($first_aplication_period_start) ) : '';
$first_aplication_period_finish = get_field( 'aplication_period_finish' );
$first_aplication_period_finish = $first_aplication_period_finish ? date( "d-M", strtotime( $first_aplication_period_finish ) ) : '';

$second_aplication_period_start  = get_field( 'second_aplication_period_start' );
$second_aplication_period_start  = $second_aplication_period_start ? date( "d-M", strtotime($second_aplication_period_start) ) : '';
$second_aplication_period_finish = get_field( 'second_aplication_period_finish' );
$second_aplication_period_finish = $second_aplication_period_finish ? date( "d-M", strtotime( $second_aplication_period_finish ) ) : '';



$apply_url      = get_field( 'apply_url' );

$application_guidelines      = get_field( 'application_guidelines' );
$read_application_guidelines = get_field( 'read_application_guidelines' );
if ( ! $read_application_guidelines ) {
	$read_application_guidelines = $application_guidelines;
}

$appliciation_periods_parts = array();
if($first_aplication_period_start) {
	$appliciation_periods_parts[] = $first_aplication_period_start;
}
if($first_aplication_period_finish) {
	$appliciation_periods_parts[] = $first_aplication_period_finish;
}
$first_application_period = implode(' - ', $appliciation_periods_parts);

$appliciation_periods_parts = array();
if($second_aplication_period_start) {
	$appliciation_periods_parts[] = $second_aplication_period_start;
}
if($second_aplication_period_finish) {
	$appliciation_periods_parts[] = $second_aplication_period_finish;
}
$second_application_period = implode(' - ', $appliciation_periods_parts);

$application_period_formatted = implode('<br/>', array($first_application_period, $second_application_period));
unset($appliciation_periods_parts, $first_application_period, $second_application_period);
if($application_period_formatted) {
	$application_period_formatted = '<span>'. $application_period_formatted .'</span>';
}
?>
<div class="fellowship-topbar">
    <h2 class="app-period-title"><span><?php _e('Application Period: ', 'total-child'); ?></span><?php echo $application_period_formatted; ?></h2>
    <?php if($application_guidelines): ?>
        <div class="fellowship-application-guidelines">
            <a class="application-guidelines-link" href="<?php echo esc_url( $application_guidelines ); ?>"><?php _e('Application Guidelines', 'total-child'); ?></a>
        </div>
	<?php endif; ?>
	<?php if($apply_url): ?>
        <div class="fellowship-apply-button">
            <a class="easl-generic-button easl-color-lightblue easl-size-small" href="<?php echo esc_url( $apply_url ); ?>" target="_blank"><?php _e('Apply Here', 'total-child'); ?><span class="easl-generic-button-icon"><span class="fa fa-chevron-right"></span></span></a>
        </div>
	<?php endif; ?>
</div>

<div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <div class="vc_row wpb_row vc_inner vc_row-fluid" style="padding: 0 15px;">
                    <div class="d-flex felloship-title-wrapper">
                        <div class="wpb_content_element vc_align_left">
                            <div class="vc_single_image-wrapper   vc_box_border_grey"
                                 style="background-image: url('<?php echo $image[0]; ?>');">
                                <img width="140" height="150" style="visibility: hidden;"
                                     src="<?php echo $image[0]; ?>"
                                     class="vc_single_image-img attachment-thumbnail"
                                     alt="">
                            </div>
                        </div>
                        <div class="wpb_content_element vc_align_left felloship-title-block">
                            <div class="d-flex flex-direction-column align-items-stretch align-content-space-between h-100 felloship-title-wrapper">
                                <h1 class="vc_custom_heading"><?php the_title(); ?></h1>
                                <a href="#" class="vcex-button theme-button inline animate-on-hover"
                                   style="background-color: #f5f5f5;color: #004b87;border-radius: 0;">
                                    <span class="theme-button-inner"><?php echo get_field( 'fellowship-term' ); ?></span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="vc_empty_space" style="height: 32px"><span class="vc_empty_space_inner"></span></div>
                <div class="vc_row wpb_row vc_inner vc_row-fluid" style="padding: 0 15px;">
                    <div class="wpb_content_element vc_align_left">
						<?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="fellowhip-buttons-wrap easl-generic-buttons-wrap easl-align-left">
	<?php if ( $read_application_guidelines ): ?>
        <a class="easl-generic-button easl-color-blue easl-size-medium" href="<?php echo esc_url( $read_application_guidelines ); ?>"><?php _e( 'Read the application guidelines before applying', 'total-child' ) ?><span class="easl-generic-button-icon"><span class="fa fa-chevron-right"></span></span></a>
	<?php endif; ?>
    <a class="easl-generic-button easl-color-lightblue easl-size-medium" href="/join-the-community/"><?php _e( 'Join the Community', 'total-child' ) ?><span class="easl-generic-button-icon"><span class="fa fa-chevron-right"></span></span></a>
</div>
<?php
// List Past fellowship awardees
$award_type = get_field('past_awardees');
$award_type = absint( $award_type );
// get years name for last 2 available years
$avaiable_years = EASL_Award_Config::get_years( $award_type, 2, true );
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
}else{
	$do_auery = false;
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
}else{
	$do_auery = false;
}

$award_query = false;
if ( $do_auery ) {
	$award_query = new WP_Query( $query_args );
}
$people_col_width = 'vc_col-sm-4';
if ( $award_query && $award_query->have_posts() ):
	?>
    <div class="fellowship-past-awardees">
        <h2 class="past-fellows"><?php _e('Past Fellows', 'total-child'); ?></h2>
		<?php
		while ( $award_query->have_posts() ){
			$award_query->the_post();
			include locate_template('partials/award/year-row.php');
		}
		?>
    </div>
	<?php
	wp_reset_query();
	$show_more_link = get_field( 'show_more_link' );
	$show_more_link = wp_parse_args($show_more_link, array(
        'title' => '',
        'url' => '',
        'target' => '',
    ));
	if ( $show_more_link['title'] &&  $show_more_link['url']):
    ?>
    <div class="fellowship-show-more">
        <a class="easl-generic-button easl-color-blue easl-size-medium" href="<?php echo esc_url( $show_more_link['url'] ); ?>"<?php if($show_more_link['target'] == '_blank'){echo ' target="_blank"';} ?>><?php echo esc_html($show_more_link['title']); ?><span class="easl-generic-button-icon"><span class="fa fa-chevron-right"></span></span></a>
    </div>
<?php
    endif;
endif;
?>

<div class="easl-social-share-wrap ">
	<?php easl_social_share_icons(); ?>
</div>