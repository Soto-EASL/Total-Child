<?php

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
