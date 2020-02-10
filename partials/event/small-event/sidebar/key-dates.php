<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$key_dates = array();
$now       = time();
while ( have_rows( 'event_key_deadline_row' ) ) {
	the_row( 'event_key_deadline_row' );
	$title      = get_sub_field( 'key_date_name' );
	$start_date = trim( get_sub_field( 'event_key_start_date' ) );
	$end_date   = trim( get_sub_field( 'event_key_end_date' ) );
	if(is_array($title)) {
		$title = 'Other';
    }
	if ( $title == 'Other' ) {
		$title = get_sub_field( 'event_key_deadline_description' );
	}
	$title = trim( $title );
	if ( ! $title ) {
		continue;
	}
	$start_date = DateTime::createFromFormat( 'd/m/Y', $start_date );
	$end_date   = DateTime::createFromFormat( 'd/m/Y', $end_date );
	if ( false === $start_date ) {
		continue;
	}

	$class = 'key-date-not-expired';
	if ( $start_date->getTimestamp() < $now ) {
		$class = 'key-date-expired';
	}
	$key_dates[] = array(
		'title' => $title,
		'start' => $start_date->format( 'd M, Y' ),
		'class' => $class
	);

}
if ( count( $key_dates ) > 0 ):
	?>
    <div class="easl-small-event-sbitem easl-small-event-sbitem-keydates">
        <div class="easl-small-event-sbitem-inner">
            <h3 class="event-sidebar-item-title">Key Dates</h3>
            <div class="easl-key-dates">
                <ul class="easl-key-dates-list">
					<?php
					foreach ( $key_dates as $key_date ):
						?>
                        <li class="<?php echo $key_date['class']; ?>">
                            <span><?php echo $key_date['start']; ?></span>
                            <span><?php echo $key_date['title']; ?></span>
                        </li>
					<?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
