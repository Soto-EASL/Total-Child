<?php
function easl_customizer_panels($panels) {
	$panels['events'] = array(
		'title' => __('Events', 'total-child'),
		'condition' => true,
	);
	return $panels;
}
add_filter('wpex_customizer_panels', 'easl_customizer_panels');
// Add settings for 
function easl_customizer_sections($sections) {
    $sections['wpex_header_general']['settings'][] = array(
			'id' => 'header_right_social',
			'default' => true,
			'transport' => 'refresh', // Other items relly on this conditionally to show/hide
			'control' => array(
				'label' => __( 'Social', 'total' ),
				'type' => 'checkbox',
			),
		);
	// Social settings
	$social_options = wpex_topbar_social_options();
	foreach ( $social_options as $key => $val ) {
		$sections['wpex_header_general']['settings'][] = array(
			'id' => 'header_right_social_profiles[' . $key .']',
			'transport' => 'partialRefresh',
			'control' => array(
				'label' => esc_html( $val['label'], 'total' ),
				'type' => 'text',
				'active_callback' => 'wpex_cac_has_header_right_social',
			),
		);
	}
	// Events Section
	$about_easl_schools_content = '<p>The schools contribute to the training of new generations of hepatologists and are a major element of our association. Aimed at young fellows enrolled in hepatology-oriented departments or more experienced clinicians who want to be exposed to the newest trends in hepatology.</p><p>For selected applicants, EASL will cover transportation costs to attend the school and accommodation during the event (details will be provided individually once the selection process has been done).</p><p>Application is open to young fellows under the age of 35 and/or still in training.</p><p>Approximately 30 places are available for each school and priority is given to registered EASL members during the selection process.</p>';
	$sections['easl_events_single'] = array(
		'title' => __( 'Single', 'total' ),
		'panel' => 'wpex_events',
		'settings' => array(
			array(
				'id' => 'about_easl_schools_title',
				'transport' => 'partialRefresh',
				'default' => __('About EASL Schools', 'total-child'),
				'control' => array(
					'label' => __('About EASL Schools Title', 'total-child'),
					'type' => 'text',
				),
			),
			array(
				'id' => 'about_easl_schools_content',
				'transport' => 'partialRefresh',
				'default' => __($about_easl_schools_content, 'total-child'),
				'control' => array(
					'label' => __('About EASL Schools Content', 'total-child'),
					'type' => 'textarea',
				),
			),
			array(
				'id' => 'event_poster_text',
				'transport' => 'partialRefresh',
				'default' => __("Help us to inform the liver community by downloading the poster, printing it and placing it on your institute's notice board or forwarding it to your local network:", 'total-child'),
				'control' => array(
					'label' => __('Event Poster Text', 'total-child'),
					'type' => 'textarea',
				),
			)
		)
	);
	// Footer Newsletter Section
	$sections['wpex_footer_bottom']['settings'][] = array(
				'id' => 'footer_bottom_newsletter',
				'transport' => 'partialRefresh',
				'default' => true,
				'control' => array(
					'label' => __( 'Enable Newsletter', 'total' ),
					'type' => 'checkbox',
					'desc' => __( 'Enable to display footer bottom newsletter.', 'total' ),
				),
			);
	$sections['wpex_footer_bottom']['settings'][] = 
			array(
				'id' => 'footer_bottom_newsletter_sc',
				'transport' => 'partialRefresh',
				'default' => '',
				'control' => array(
					'label' => __( 'Newsletter Shortcode/content', 'total' ),
					'type' => 'textarea',
				),
			);
    return $sections;
}

add_filter('wpex_customizer_sections', 'easl_customizer_sections');

add_action( 'customize_controls_print_styles', 'easl_customize_controls_print_styles' );

function easl_customize_controls_print_styles() {
	?>
	
<style type="text/css" id="easl-customizer-controls-css">
	#accordion-panel-wpex_events > h3:before {
		display: inline-block;
		width: 20px;
		height: 20px;
		font-size: 20px;
		line-height: 1;
		font-family: dashicons;
		text-decoration: inherit;
		font-weight: 400;
		font-style: normal;
		vertical-align: top;
		text-align: center;
		-webkit-transition: color .1s ease-in 0;
		transition: color .1s ease-in 0;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		color: #298cba;
		margin-right: 10px;
		font-family: "dashicons";
	}
	#accordion-panel-wpex_events > h3:before { content: "\f145" }
</style>
	<?php
}
