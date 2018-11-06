<?php
function easlenqueueTtaScript() {
	if(!defined('WPB_VC_VERSION')){
		return;
	}
	wp_register_style( 'vc_tta_style', vc_asset_url( 'css/js_composer_tta.min.css' ), false, WPB_VC_VERSION );
	wp_enqueue_style( 'vc_tta_style' );
	wp_register_script( 'vc_accordion_script', vc_asset_url( 'lib/vc_accordion/vc-accordion.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
	wp_register_script( 'vc_tta_autoplay_script', vc_asset_url( 'lib/vc-tta-autoplay/vc-tta-autoplay.min.js' ), array( 'vc_accordion_script' ), WPB_VC_VERSION, true );

	wp_enqueue_script( 'vc_accordion_script' );
	if ( ! vc_is_page_editable() ) {
		wp_enqueue_script( 'vc_tta_autoplay_script' );
	}
}

function wpex_cac_has_header_right_social(){
	return get_theme_mod( 'header_right_social', true );
}
function easl_vc_button_icons(){
	return array(
		__( 'No Icon', 'total' ) => '',
		__( 'Download Blue', 'total' ) => 'download-blue',
		__( 'Speech Buble Blue', 'total' ) => 'speech-bubble-blue',
	);
}
function easl_vc_button_grid_icons(){
	return array(
		__( 'No Icon', 'total' ) => '',
		__( 'Awards', 'total' ) => 'awards',
		__( 'Bursaries', 'total' ) => 'bursaries',
		__( 'Calendar', 'total' ) => 'calendar',
		__( 'Education', 'total' ) => 'education',
		__( 'Fellowship', 'total' ) => 'fellowship',
		__( 'Flask', 'total' ) => 'flask',
		__( 'Groups', 'total' ) => 'groups',
		__( 'Membership', 'total' ) => 'membership',
		__( 'Mentorship', 'total' ) => 'mentorship',
		__( 'Liver', 'total' ) => 'liver',
		__( 'Arrows', 'total' ) => 'arrows',
		__( 'Arrows', 'total' ) => 'arrows',
		__( 'Globe', 'total' ) => 'globe',
		__( 'UEG', 'total' ) => 'ueg',
		__( 'ALEH', 'total' ) => 'aleh',
		__( 'AASLD', 'total' ) => 'aasld',
		__( 'APASL', 'total' ) => 'apasl',
		__( 'Aliver', 'total' ) => 'aliver',
		__( 'Apps', 'total' ) => 'apps',
		__( 'Report', 'total' ) => 'report',
		__( 'Twitter', 'total' ) => 'twitter',
		__( 'Video', 'total' ) => 'video',
        __( 'Litmus', 'total' ) => 'litmus',
        __( 'EU stars ', 'total' ) => 'eu-star',
        __( 'Hand shake', 'total' ) => 'handshake',
        __( 'group of people', 'total' ) => 'group',
        __( 'ID card', 'total' ) => 'id-card',
        __( 'Hepatocytes', 'total' ) => 'hepatocytes',
        __( 'Two faces', 'total' ) => 'two-faces',
	);
}
function easl_title_icons(){
	return array(
		'' => __( 'No Icon', 'total' ),
		'aasld' => __( 'AASLD', 'total' ),
		'advocacy' => __( 'Advocacy', 'total' ),
		'aleh' => __( 'ALEH', 'total' ),
		'apasl' => __( 'APASL', 'total' ),
		'arrows' => __( 'Arrows', 'total' ),
		'awards' => __( 'Awards', 'total' ),
		'bursaries' => __( 'Bursaries', 'total' ),
		'calendar' => __( 'Calendar', 'total' ),
		'education' => __( 'Education', 'total' ),
		'fellowship' => __( 'Fellowship', 'total' ),
		'flask' => __( 'Flask', 'total' ),
		'globe' => __( 'Globe', 'total' ),
		'groups' => __( 'Groups', 'total' ),
		'liver' => __( 'Liver', 'total' ),
		'membership' => __( 'Membership', 'total' ),
		'mentorship' => __( 'Mentorship', 'total' ),
		'science' => __( 'Science ', 'total' ),
		'ueg' => __( 'UEG', 'total' ),
		'litmus' => __( 'Litmus', 'total' ),

	);
}
function easl_social_profile_options_list(){
	return array(
		'facebook' => array(
			'label' => 'Facebook',
			'icon_class' => 'fa fa-facebook',
		),
		'twitter' => array(
			'label' => 'Twitter',
			'icon_class' => 'fa fa-twitter',
		),
		'linkedin' => array(
			'label' => 'LinkedIn',
			'icon_class' => 'fa fa-linkedin',
		),
		'youtube' => array(
			'label' => 'Youtube',
			'icon_class' => 'fa fa-youtube',
		),
		'googleplus' => array(
			'label' => 'Google Plus',
			'icon_class' => 'fa fa-google-plus',
		),
		'pinterest'  => array(
			'label' => 'Pinterest',
			'icon_class' => 'fa fa-pinterest',
		),
		'dribbble' => array(
			'label' => 'Dribbble',
			'icon_class' => 'fa fa-dribbble',
		),
		'etsy'  => array(
			'label' => 'Etsy',
			'icon_class' => 'fa fa-etsy',
		),
		'vk' => array(
			'label' => 'VK',
			'icon_class' => 'fa fa-vk',
		),
		'instagram'  => array(
			'label' => 'Instagram',
			'icon_class' => 'fa fa-instagram',
		),
		'flickr' => array(
			'label' => 'Flickr',
			'icon_class' => 'fa fa-flickr',
		),
		'skype' => array(
			'label' => 'Skype',
			'icon_class' => 'fa fa-skype',
		),
		'whatsapp' => array(
			'label' => 'Whatsapp',
			'icon_class' => 'fa fa-whatsapp',
		),
		'vimeo' => array(
			'label' => 'Vimeo',
			'icon_class' => 'fa fa-vimeo-square',
		),
		'vine' => array(
			'label' => 'Vine',
			'icon_class' => 'fa fa-vine',
		),
		'spotify' => array(
			'label' => 'Spotify',
			'icon_class' => 'fa fa-spotify',
		),
		'xing' => array(
			'label' => 'Xing',
			'icon_class' => 'fa fa-xing',
		),
		'yelp' => array(
			'label' => 'Yelp',
			'icon_class' => 'fa fa-yelp',
		),
		'tripadvisor' => array(
			'label' => 'Tripadvisor',
			'icon_class' => 'fa fa-tripadvisor',
		),
		'houzz' => array(
			'label' => 'Houzz',
			'icon_class' => 'fa fa-houzz',
		),
		'twitch' => array(
			'label' => 'Twitch',
			'icon_class' => 'fa fa-twitch',
		),
		'rss'  => array(
			'label' => __( 'RSS', 'total' ),
			'icon_class' => 'fa fa-rss',
		),
		'email' => array(
			'label' => __( 'Email', 'total' ),
			'icon_class' => 'fa fa-envelope',
		),
		'phone' => array(
			'label' => __( 'Phone', 'total' ),
			'icon_class' => 'fa fa-phone',
		),
	);
}

add_filter('wpex_social_profile_options_list', 'easl_social_profile_options_list');

function easl_extended_meta($array, $post){
	$array['title']['settings'][] = array(
		'title' => esc_html__( 'Title icon', 'total' ),
		'type' => 'select',
		'id' => 'ese_post_title_icon',
		'description' => esc_html__( 'Select a icon to display on left of the title for this page or post.', 'total' ),
		'options' => easl_title_icons(),
	);
	return $array;
}
add_filter('wpex_metabox_array', 'easl_extended_meta', 10, 2);

function easl_remove_parents_action(){
	// Page Header
	remove_action( 'wpex_hook_page_header_inner', 'wpex_display_breadcrumbs' );
	add_action( 'wpex_hook_page_header_inner', 'wpex_display_breadcrumbs', 9 );
	
	remove_action( 'wpex_hook_footer_after', 'wpex_footer_bottom' );
	//add_action( 'wpex_hook_footer_after', 'wpex_footer_bottom' );
	remove_action( 'wpex_hook_footer_bottom_inner', 'wpex_footer_bottom_copyright' );
	remove_action( 'wpex_hook_footer_bottom_inner', 'wpex_footer_bottom_menu' );
	
	add_action( 'wpex_hook_footer_bottom', 'wpex_footer_bottom_copyright' );
	add_action( 'wpex_hook_footer_bottom', 'wpex_footer_bottom_menu' );
}

add_action('template_redirect', 'easl_remove_parents_action');


function easl_template_parts($parts){
    $parts['topbar_countdown'] = 'partials/topbar/topbar-countdown';
    
    return $parts;
}

add_filter('wpex_template_parts', 'easl_template_parts');

function easl_vc_add_params(){
	vc_add_params('vc_single_image',array(

			array(
				'type' => 'textfield',
				'heading' => __( 'Over Image Link Text', 'total' ),
				'param_name' => 'img_over_link_text',
				'description' => __( 'Use this field to add a overlay caption with link', 'total' ),
				'group' => __( 'Over Image Link', 'total' ),
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Over Image Link', 'total' ),
				'param_name' => 'img_over_link',
				'description' => __( 'Use this field to add a overlay caption with link', 'total' ),
				'group' => __( 'Over Image Link', 'total' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Over ImageLink Target', 'js_composer' ),
				'param_name' => 'img_over_linktarget',
				'value' => vc_target_param_list(),
				'group' => __( 'Over Image Link', 'total' ),
			),
	));
}
add_action( 'vc_after_init', 'easl_vc_add_params', 40 );



add_filter('wpex_main_metaboxes_post_types', 'easl_total_post_types');
function easl_total_post_types($post_types){
	$post_types['event'] = 'event';
	return $post_types;
}

function easl_page_header_title_table_wrap_open() {
	if ( is_singular('event') && 'background-image' != wpex_page_header_style() ) {
		echo '<div class="page-header-table clr"><div class="page-header-table-cell">';
	}
}
function easl_page_header_title_table_wrap_close() {
	if ( is_singular('event') && 'background-image' != wpex_page_header_style() ) {
		echo '</div></div>';
	}
}
add_action( 'wpex_hook_page_header_inner', 'easl_page_header_title_table_wrap_open', 0 );
add_action( 'wpex_hook_page_header_inner', 'easl_page_header_title_table_wrap_close', 9999 );