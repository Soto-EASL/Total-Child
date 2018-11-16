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
 * Shortcode class
 * @var $this EASL_VC_Events
 */
$title = $element_width = $view_all_link = $view_all_url = $view_all_text = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'wpb_easl_events wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if(!$view_all_text){
	$view_all_text = 'View all Events';
}

if($title && $view_all_link){
	$title .= '<a class="easl-events-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}

$widget_subtitle = '';
if ( ! empty( $subtitle ) ) {
	$widget_subtitle .= '<p class="wpb_easl_events_subtitle">' . $subtitle . '</p>';
}

$number_posts = '-1';
if ( ! empty( $numberposts ) && (int) $numberposts > 0 ) {
	$number_posts = $numberposts;
}
$now_time = time();
$event_args = array(
	'post_type' => EASL_Event_Config::get_event_slug(),
	'post_status' => 'publish',
	'posts_per_page' => $number_posts,
	'order' => 'ASC',
	'orderby' => 'meta_value_num',
	'meta_key' => 'event_start_date',
	'meta_query' => array(
		'relation' => 'OR',
		array(
			'key' => 'event_start_date',
            'value' => $now_time - 86399,
            'compare' => '>=',
            'type' => 'NUMERIC',
		),
		array(
			'key' => 'event_end_date',
            'value' => $now_time - 86399,
            'compare' => '>=',
            'type' => 'NUMERIC',
		),
	)
);
$event_query = new WP_Query($event_args);
if($event_query->have_posts()){
	$row_count = 0;
	?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?> class="<?php echo esc_attr( trim( $css_class ) ); ?>">
	<?php 
	echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_events_heading' ) ); 
	echo $widget_subtitle;
	?>
	<div class="easl-events-list-wrap">
		<ul>
	<?php
	while ($event_query->have_posts()){
		$event_query->the_post();
		$row_count++;
		$event_data = get_post_meta( get_the_ID() );
		$event_start_date = array( '0', '0', '0' );
		if ( ! empty( $event_data['event_start_date'][0] ) ) {
			$event_start_date = explode( '/', date( 'd/M/Y', $event_data['event_start_date'][0] ) );
		}
		$event_color = easl_get_events_topic_color(get_the_ID());
		$event_meeting_type_name = easl_meeting_type_name(get_the_ID());
		$event_location_display = easl_get_event_location(get_the_ID(), 'city,contury');
		?>
			<li class="easl-events-li easl-event-li-<?php echo $event_color; ?>">
				<h3><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<a class="events-li-date" href="<?php the_permalink(); ?>">
					<span class="eld-day"><?php echo $event_start_date[0]; ?></span>
					<span class="eld-mon"><?php echo strtoupper( $event_start_date[1] ); ?></span>
					<span class="eld-year"><?php echo $event_start_date[2]; ?></span>
					<i class="fa fa-play" aria-hidden="true"></i>
				</a>
				<?php if($event_meeting_type_name || $event_location_display): ?>
				<p class="el-location">
					<?php if($event_meeting_type_name): ?>
					<span class="ell-name"><?php echo $event_meeting_type_name; ?></span> 
					<?php endif; ?>
					<?php if($event_meeting_type_name && $event_location_display): ?>
					<span class="ell-bar">|</span> 
					<?php endif; ?>
					<?php if($event_location_display): ?>
					<span class="ell-country"><?php echo $event_location_display; ?></span>
					<?php endif; ?>
				</p>
				<?php endif; ?>
			</li>
		<?php
	}
	wp_reset_query();
	?>	
		</ul>
	</div>
</div>
<?php
}