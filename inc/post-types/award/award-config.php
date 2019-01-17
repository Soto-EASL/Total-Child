<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
class EASL_Award_Config {
	protected static $slugs = array(
		'type' => 'award',
		'award_group' => 'award_group',
		'award_year' => 'award_year'
	);
	public function __construct() {
		add_action( 'init', array( 'EASL_Award_Config', 'register_post_type' ), 0 );
		add_action( 'init', array( 'EASL_Award_Config', 'register_tax' ), 0 );
		add_filter('acf/get_field_group_style', array('EASL_Award_Config', 'hide_on_edit_screen'));
	}
	/**
	 * Get post type slug
	 * @return string
	 */
	public static function get_slug(){
		return self::$slugs['type'];
	}
	/**
	 * Get award group slug
	 * @return string
	 */
	public static function get_award_group_slug (){
		return self::$slugs['award_group'];
	}
	/**
	 * Get award year slug
	 * @return string
	 */
	public static function get_award_year_slug (){
		return self::$slugs['award_year'];
	}
	/**
	 * Register post type.
	 */
	public static function register_post_type() {
		register_post_type( self::get_slug(), array(
			'labels' => array(
				'name' => __( 'Award', 'total-child' ),
				'singular_name' => __( 'Award', 'total-child' ),
				'add_new' => __( 'Add New', 'total-child' ),
				'add_new_item' => __( 'Add New Award', 'total-child' ),
				'edit_item' => __( 'Edit Award', 'total-child' ),
				'new_item' => __( 'Add New Award', 'total-child' ),
				'view_item' => __( 'View Award', 'total-child' ),
				'search_items' => __( 'Search Awards', 'total-child' ),
				'not_found' => __( 'No Awards Found', 'total-child' ),
				'not_found_in_trash' => __( 'No Awards Found In Trash', 'total-child' )
			),
			'public' => false,
			'show_ui' => true,
			'capability_type' => 'post',
			'has_archive' => false,
			'menu_position' => 25,
			'rewrite' => false,
			'supports' => array(
				'title',
				'thumbnail',
			),
		) );
	}

	/**
	 * Register Award Group
	 *
	 * @since 2.0.0
	 */
	public static function register_award_group() {
		// Define args and apply filters for child theming
		$args = array(
			'labels' => array(
				'name' => __( 'Award Group', 'total-child' ),
				'singular_name' => __( 'Award Group', 'total-child' ),
				'menu_name' => __( 'Award Group', 'total' ),
				'search_items' => __( 'Search Award Groups', 'total-child' ),
				'popular_items' => __( 'Popular Award Groups', 'total-child' ),
				'all_items' => __( 'All Award Groups', 'total-child' ),
				'parent_item' => __( 'Parent Award Group', 'total-child' ),
				'parent_item_colon' => __( 'Parent Award Group:', 'total-child' ),
				'edit_item' => __( 'Edit Award Group', 'total-child' ),
				'update_item' => __( 'Update Award Group', 'total-child' ),
				'add_new_item' => __( 'Add New Award Group', 'total-child' ),
				'new_item_name' => __( 'New Award Group Name', 'total-child' ),
				'separate_items_with_commas' => __( 'Separate award group with commas', 'total-child' ),
				'add_or_remove_items' => __( 'Add or remove award groups', 'total-child' ),
				'choose_from_most_used' => __( 'Choose from the most used award groups', 'total-child' ),
			),
			'public' => false,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_quick_edit' => true,
			'rewrite' => false,
			'query_var' => false
		);

		// Register the staff tag taxonomy
		register_taxonomy( self::get_award_group_slug(), array( self::get_slug() ), $args );
	}
	/**
	 * Register Award Year.
	 *
	 * @since 2.0.0
	 */
	public static function register_award_year() {
		// Define args and apply filters for child theming
		$args = array(
			'labels' => array(
				'name' => __( 'Award Year', 'total-child' ),
				'singular_name' => __( 'Award Year', 'total-child' ),
				'menu_name' => __( 'Award Year', 'total' ),
				'search_items' => __( 'Search Award Years', 'total-child' ),
				'popular_items' => __( 'Popular Award Years', 'total-child' ),
				'all_items' => __( 'All Award Years', 'total-child' ),
				'parent_item' => __( 'Parent Award Year', 'total-child' ),
				'parent_item_colon' => __( 'Parent Award Year:', 'total-child' ),
				'edit_item' => __( 'Edit Award Year', 'total-child' ),
				'update_item' => __( 'Update Award Year', 'total-child' ),
				'add_new_item' => __( 'Add New Award Year', 'total-child' ),
				'new_item_name' => __( 'New Award Year Name', 'total-child' ),
				'separate_items_with_commas' => __( 'Separate award year with commas', 'total-child' ),
				'add_or_remove_items' => __( 'Add or remove award years', 'total-child' ),
				'choose_from_most_used' => __( 'Choose from the most used award years', 'total-child' ),
			),
			'public' => false,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => false,
			'show_admin_column' => true,
			'show_in_quick_edit' => true,
			'rewrite' => false,
			'query_var' => false
		);

		// Register the staff tag taxonomy
		register_taxonomy( self::get_award_year_slug(), array( self::get_slug() ), $args );
	}
	public static function register_tax(){
		self::register_award_group();
		self::register_award_year();
	}

	public static function hide_on_edit_screen($style) {
		$hide = array(
			'#award_groupdiv',
			'#screen-meta label[for=award_groupdiv-hide]',
			'#tagsdiv-award_year',
			'#screen-meta label[for=tagsdiv-award_year-hide]',
			'.post-type-award #mymetabox_revslider_0',
		);
		if(1) {
			$hide[] = '#mymetabox_revslider_0';
		}
		$style .= implode(', ', $hide) . ' {display: none;}';

		return $style;
	}
}
new EASL_Award_Config();