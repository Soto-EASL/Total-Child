<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$prefix = 'event_';
return array(
	'event-data' => array(
		'title' => esc_html__( 'Event Data', 'total' ),
		'settings' => array(
			'location_city' => array(
				'title' => esc_html__( 'Location - City', 'total' ),
				'id' => $prefix . 'location_city',
				'type' => 'text',
				'description' => esc_html__( 'Enter the city of the event location.', 'total' ),
			),
			'location_country' => array(
				'title' => esc_html__( 'Location - Country', 'total' ),
				'id' => $prefix . 'location_country',
				'type' => 'select',
				'description' => esc_html__( 'Select the country of the event location.', 'total' ),
				'options' => easl_event_get_countries(),
			),
			'organisation' => array(
				'title' => esc_html__( 'Organisation', 'total' ),
				'id' => $prefix . 'organisation',
				'type' => 'select',
				'description' => esc_html__( 'Select the organisation of the event.', 'total' ),
				'options' => easl_event_get_organisations(),
			),
			'start_date' => array(
				'title' => esc_html__( 'Sart Date', 'total' ),
				'id' => $prefix . 'start_date',
				'type' => 'date',
				'description' => esc_html__( 'Enter the start date of the event.', 'total' ),
			),
			'end_date' => array(
				'title' => esc_html__( 'End Date', 'total' ),
				'id' => $prefix . 'end_date',
				'type' => 'date',
				'description' => esc_html__( 'Enter the end date of the event.', 'total' ),
			),
		)
	),
);