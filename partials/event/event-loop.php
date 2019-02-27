<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_data       = get_post_meta( get_the_ID() );
$event_start_date = array( '0', '0', '0' );
if ( ! empty( $event_data['event_start_date'][0] ) ) {
	$event_start_date = explode( '/', date( 'd/M/Y', $event_data['event_start_date'][0] ) );
}
$event_color             = easl_get_events_topic_color( get_the_ID() );
$event_meeting_type_name = easl_meeting_type_name( get_the_ID() );
$event_location_display  = easl_get_event_location( get_the_ID(), 'city,contury' );
?>
<li class="easl-events-li easl-event-li-<?php echo $event_color; ?>">
    <h3><a title="" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <a class="events-li-date" href="<?php the_permalink(); ?>">
        <span class="eld-day"><?php echo $event_start_date[0]; ?></span>
        <span class="eld-mon"><?php echo strtoupper( $event_start_date[1] ); ?></span>
        <span class="eld-year"><?php echo $event_start_date[2]; ?></span>
        <i class="ticon ticon-play" aria-hidden="true"></i>
    </a>
	<?php if ( $event_meeting_type_name || $event_location_display ): ?>
        <p class="el-location">
			<?php if ( $event_meeting_type_name ): ?>
                <span class="ell-name"><?php echo $event_meeting_type_name; ?></span>
			<?php endif; ?>
			<?php if ( $event_meeting_type_name && $event_location_display ): ?>
                <span class="ell-bar">|</span>
			<?php endif; ?>
			<?php if ( $event_location_display ): ?>
                <span class="ell-country"><?php echo $event_location_display; ?></span>
			<?php endif; ?>
        </p>
	<?php endif; ?>
</li>
