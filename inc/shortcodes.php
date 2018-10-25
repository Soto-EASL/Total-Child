<?php

require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-button.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-button-grid.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-gbutton.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-events.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-events-calendar.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-news.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-scientific-publication.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-carousel.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-carousel-item.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-yifellowship.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-mentors.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-mentors-table.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-cag-members.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-menu-stacked-content.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-post-type-grid.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-users-grid.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-card-button.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-staff-list.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-associations.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-highlights.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-staffs.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-annual-reports.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-slide-decks.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/class-vc-awardees.php';

function easl_vc_shortcodes_lean_maps(){
	vc_lean_map( 'easl_button', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-button.php' );
	vc_lean_map( 'easl_button_grid', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-button-grid.php' );
	vc_lean_map( 'easl_gbutton', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-gbutton.php' );
	vc_lean_map( 'easl_events', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-events.php' );
	vc_lean_map( 'easl_events_calendar', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-events-calendar.php' );
	vc_lean_map( 'easl_news', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-news.php' );
	vc_lean_map( 'easl_carousel', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-carousel.php' );
	vc_lean_map( 'easl_carousel_item', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-carousel-item.php' );
	vc_lean_map( 'easl_yi_fellowship', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-yifellowship.php' );
	vc_lean_map( 'easl_mentors', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-mentors.php' );
	vc_lean_map( 'easl_mentors_table', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-mentors-table.php' );
	vc_lean_map( 'easl_cag_members', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-cag-members.php' );
	vc_lean_map( 'easl_menu_stacked_content', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-menu-stacked-content.php' );
	vc_lean_map( 'easl_card_button', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-card-button.php' );
	vc_lean_map( 'easl_staffs', null, get_stylesheet_directory() . '/inc/shortcodes/map-easl-staffs.php' );

}
add_action( 'vc_after_init', 'easl_vc_shortcodes_lean_maps', 40 );
