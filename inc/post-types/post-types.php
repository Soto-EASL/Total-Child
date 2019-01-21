<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

require_once EASL_INC_DIR . 'post-types/event/event-config.php';
require_once EASL_INC_DIR . 'post-types/fellowship/fellowship-config.php';
require_once EASL_INC_DIR . 'post-types/associations/associations-config.php';
require_once EASL_INC_DIR . 'post-types/publication/publication-config.php';
require_once EASL_INC_DIR . 'post-types/annual-reports/annual-reports-config.php';
require_once EASL_INC_DIR . 'post-types/slide-decks/slide-decks-config.php';
require_once EASL_INC_DIR . 'post-types/newsletter/newsletter-config.php';
require_once EASL_INC_DIR . 'post-types/ilc/ilc-config.php';
require_once EASL_INC_DIR . 'post-types/award/award-config.php';

function easl_change_pt_labels_post($labels) {
	$labels = array(
		'name' => _x('News', 'post type general name'),
		'singular_name' => _x('News', 'post type singular name'),
		'add_new' => _x('Add New', 'post'),
		'add_new_item' => __('Add New News'),
		'edit_item' => __('Edit News'),
		'new_item' => __('New News'),
		'view_item' => __('View News'),
		'view_items' => __('View News'),
		'search_items' => __('Search News'),
		'not_found' => __('No news found.'),
		'not_found_in_trash' => __('No news found in Trash.'),
		'all_items' => __( 'All News' ),
		'archives' => __( 'News Archives' ),
		'attributes' => __( 'News Attributes' ),
		'insert_into_item' => __( 'Insert into news' ),
		'uploaded_to_this_item' => __( 'Uploaded to this news' ),
		'filter_items_list' => __( 'Filter news list' ),
		'items_list_navigation' => __( 'News list navigation' ),
		'items_list' => __( 'News list' ),
		'menu_name' => _x('News', 'post type general name'),
		'name_admin_bar' => _x( 'News', 'add new from admin bar' ),
	);
	return $labels;
}
add_filter('post_type_labels_post', 'easl_change_pt_labels_post', 10);