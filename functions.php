<?php

if ( ! defined( 'EASL_INC_DIR' ) ) {
	define( 'EASL_INC_DIR', trailingslashit( get_stylesheet_directory() ) . 'inc/' );
}

if ( ! defined( 'EASL_HOME_URL' ) ) {
	define( 'EASL_HOME_URL', get_home_url() );
}

require_once EASL_INC_DIR . 'custom-tax-news-source.php';
require_once EASL_INC_DIR . 'post-types/post-types.php';
require_once EASL_INC_DIR . 'customizer.php';
require_once EASL_INC_DIR . 'total-extend.php';
require_once EASL_INC_DIR . 'shortcodes.php';
require_once EASL_INC_DIR . 'widgets.php';

function easl_theme_setup(){
	load_theme_textdomain('total-child');
	add_image_size('staff_grid', 254, 254, true);
	add_image_size('news_list', 256, 126, true);
	add_image_size('news_single', 1125, 9999, false);
}
add_action( 'after_setup_theme', 'easl_theme_setup' );


function easl_custom_scripts(){
	wp_enqueue_script('jquery');
	if( is_singular('event') && easl_is_future_event( get_queried_object_id())){
		wp_enqueue_script('atc', 'https://addevent.com/libs/atc/1.6.1/atc.min.js', array(), null, false);
	}
    wp_enqueue_script('easl-custom', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);
	$ssl_scheme = is_ssl() ? 'https' : 'http';
	$fornt_end_data = array(
		'ajaxUrl' => admin_url('admin-ajax.php', $ssl_scheme),
	);
	wp_localize_script( 'easl-custom', 'EASLSETTINGS', $fornt_end_data );
}
add_action('wp_enqueue_scripts', 'easl_custom_scripts', 20);

function easl_header_scripts() {
	if( is_singular('event') && easl_is_future_event( get_queried_object_id())){
		?>
<script type="text/javascript">
	window.addeventasync = function(){
		addeventatc.settings({
			css: false
		});
	};
</script>
		<?php
	}
}
add_action('wp_head', 'easl_header_scripts', 99);
function easl_footer_scripts(){
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() . '/assets/js/custom.js' .'"></script>';
}

//add_action('wp_footer', 'easl_footer_scripts', 99);


/**
 * Make the main menu displayable for the mobile menu
 * Stripping all column alias and classes.
 */
add_filter('wp_nav_menu_objects', 'easl_nav_menu_objs', 11, 2);
function easl_nav_menu_objs($sorted_menu_items, $args){
    if(empty($args->theme_location)){
        return $sorted_menu_items;
    }

    $current_col = $cols_parent = $hide_parent = false;
    foreach($sorted_menu_items as $k=>$item){
        if(!empty($hide_parent) && in_array($item->menu_item_parent, $hide_parent)){
            $hide_parent[] = $item->ID;
            unset($sorted_menu_items[$k]);
        }
        if(is_array($item->classes) && in_array('ilc-hide-menu-item', $item->classes)){
            $hide_parent[] = $item->ID;
            unset($sorted_menu_items[$k]);
        }
        if('mobile_menu_alt' == $args->theme_location){
            if(!empty($current_col) && ($item->menu_item_parent == $current_col)){
                $item->menu_item_parent = $cols_parent;
            }
            if(is_array($item->classes) && in_array('megamenu', $item->classes)){
                $sorted_menu_items[$k]->classes = array_diff($item->classes, array('megamenu', 'col-1', 'col-2', 'col-3', 'col-4'));
            }
            if(!is_array($item->classes) || !in_array('ilc-hide-link', $item->classes)){
                continue;
            }
            $cols_parent = $item->menu_item_parent;
            $current_col = $item->ID;
            unset($sorted_menu_items[$k]);
        }
        
    }
    if($current_col){
        $sorted_menu_items = array_values($sorted_menu_items);
    }
    return $sorted_menu_items;
}

// Hide link text
//add_filter('walker_nav_menu_start_el', 'easl_walker_nav_menu_start_el', 11, 4);
function easl_walker_nav_menu_start_el($item_output, $item, $depth, $args){
    if(is_array($item->classes) && in_array('ilc-hide-link', $item->classes)){
        return '';
    }
    return $item_output;
}
add_shortcode('easl_year', 'sc_easl_year');
function sc_easl_year() {
    $year = date('Y');
    return $year;
}

//remove_action( 'wpex_outer_wrap_before', 'wpex_skip_to_content_link' );


function easl_page_heder_class($classes){
	$post_id = wpex_get_current_post_id();
	//if(!wpex_page_header_subheading_content()){
	//	return $classes;
	//}
	//$classes[] = 'ilc-page-subheading';
	$style = wpex_page_header_style();
	$bg_img = wpex_page_header_background_image();
	$bg_color = get_post_meta( $post_id, 'wpex_post_title_background_color', true );
	if('background-image' == $style && $bg_img ) {
		$classes['easl-page-header-has-bg'] = 'easl-page-header-has-bg';
	}else{
		$classes['easl-page-header-has-bg'] = 'easl-page-header-no-bg';
	}
	return $classes;
}
add_filter('wpex_page_header_classes', 'easl_page_heder_class');

// Add custom font to font settings
function wpex_add_custom_fonts() {
	return array(
		'KnockoutHTF31JuniorMiddlewt',
		'KnockoutHTF51Middleweight',
		'KnockoutHTF91UltmtMiddlewt',
	);
}
function register_custom_sidebar(){
    register_sidebar( array(
        'name' => ( 'Social Buttons' ),
        'id' => 'social_buttons',
        'description' => ( 'Widgets in this area will be shown on all posts and pages.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name' => ( 'Archive Reports' ),
        'id' => 'archive-reports',
        'description' => ( 'Widgets in this area will be shown on all posts and pages.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    register_sidebar( array(
        'name' => ( 'Fellowship Detail Sidebar' ),
        'id' => 'fellowship-detail-sidebar',
        'description' => ( 'Widgets in this area will be shown on fellowship post type detail page.' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}
add_action('widgets_init','register_custom_sidebar');



function func_styles() {
    if (is_page(sanitize_title('history'))) {
        wp_enqueue_style('jquery-ui-lib-style',
            get_stylesheet_directory_uri() . '/assets/lib/jquery-ui-1.12.1.custom/jquery-ui.css');
        wp_enqueue_style('history-timeline-slider-style',
            get_stylesheet_directory_uri() . '/assets/css/history_timeline_slider.css');
    }
    if(is_singular('fellowship')){
        wp_enqueue_style('fellowship-detail-slider-style',
            get_stylesheet_directory_uri() . '/assets/css/fellowship-detail.css');
    }
    if (is_page(sanitize_title('registry-grants'))) {
        wp_enqueue_style('registry-grants-style',
            get_stylesheet_directory_uri() . '/assets/css/registry-grants.css');
    }
    if (is_page(sanitize_title('liver-network'))) {
        wp_enqueue_style('liver-network-style',
            get_stylesheet_directory_uri() . '/assets/css/liver-network.css');
    }
    if (is_page(sanitize_title('awardees'))) {
        wp_enqueue_style('awardees-style',
            get_stylesheet_directory_uri() . '/assets/css/awardees.css');
    }
    if (is_page(sanitize_title('mentorships'))) {
        wp_enqueue_style('mentorships-style',
            get_stylesheet_directory_uri() . '/assets/css/mentorships.css');
    }
//    if (is_page(sanitize_title('community'))) {
//        wp_enqueue_style('community-style',
//            get_stylesheet_directory_uri() . '/assets/css/community.css');
//    }
//    if (is_page(sanitize_title('governingboard'))) {
//        wp_enqueue_style('governingboard-style',
//            get_stylesheet_directory_uri() . '/assets/css/community.css');
//    }
    if (is_page(sanitize_title('join-the-community'))) {
        wp_enqueue_style('join-the-community-style',
            get_stylesheet_directory_uri() . '/assets/css/join-community.css');
    }
    if (is_page(sanitize_title('fellowships'))) {
        wp_enqueue_style('fellowships-style',
            get_stylesheet_directory_uri() . '/assets/css/young-investigators-fellowships.css');
    }
    if (is_page(sanitize_title('national-associations')) ||
        is_page(sanitize_title('professor-andrew-k-burroughs')) ||
        is_page(sanitize_title('professor-jean-pierre-benhamou')) ||
        is_page(sanitize_title('professor-dame-sheila-sherlock')) ||
        is_page(sanitize_title('officeteam')) ||
        is_page(sanitize_title('cag')) ||
        is_page(sanitize_title('ethicscommittee')) ||
        is_page(sanitize_title('fellows')) ||
        is_page(sanitize_title('editorialboard')) ||
        is_page(sanitize_title('reviewers')) ||
        is_page(sanitize_title('tribute')) ) {
        wp_enqueue_style('sub-community-style',
            get_stylesheet_directory_uri() . '/assets/css/sub-community.css');
    }


    if (is_page(sanitize_title('sister-societies'))) {
        wp_enqueue_style('sister-societies-sub-community-style',
            get_stylesheet_directory_uri() . '/assets/css/sub-community.css');
        wp_enqueue_style('sister-societies-style',
            get_stylesheet_directory_uri() . '/assets/css/sister-societies.css');
    }
}
add_action('wp_head', 'func_styles', 25);


function func_scripts() {
    wp_enqueue_script('common-script',
        get_stylesheet_directory_uri() . '/assets/js/common.js',
        ['jquery'],
        false,
        true);
    wp_localize_script('common-script', 'ajaxurl', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    if (is_page(sanitize_title('history'))) {
        wp_enqueue_script('simple-jquery-timeline-Plugin',
            get_stylesheet_directory_uri() . '/assets/lib/Simple-jQuery-Timeline-Plugin-Timelinr/js/jquery.timelinr-0.9.7.js',
            ['jquery'],
            false,
            true);
        wp_enqueue_script('jquery-ui-lib-script',
            get_stylesheet_directory_uri() . '/assets/lib/jquery-ui-1.12.1.custom/jquery-ui.js',
            ['jquery'],
            false,
            true);

        wp_enqueue_script('history-timeline-slider-script',
            get_stylesheet_directory_uri() . '/assets/js/history_timeline_slider.js',
            ['jquery', 'simple-jquery-timeline-Plugin', 'jquery-ui-lib-script'],
            false,
            true);
    }
//    if (is_page(sanitize_title('community'))) {
//        wp_enqueue_script('community-script',
//            get_stylesheet_directory_uri() . '/assets/js/community.js',
//            ['jquery'],
//            false,
//            true);
//    }
//    if (is_page(sanitize_title('governingboard'))) {
//        wp_enqueue_script('governingboard-script',
//            get_stylesheet_directory_uri() . '/assets/js/community.js',
//            ['jquery'],
//            false,
//            true);
//    }
    if (is_page(sanitize_title('join-the-community'))) {
        wp_enqueue_script('join-the-community-script',
            get_stylesheet_directory_uri() . '/assets/js/join-community.js',
            ['jquery'],
            false,
            true);
    }


}
add_action('wp_enqueue_scripts', 'func_scripts', 10);


add_shortcode('timeline_slide', 'timefunc');
// [timeline_slide category_name="history"]
function timefunc($atts) {
    $a = $atts['category_name'];

    $the_query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category_name' => $a,
        'meta_key' => 'history_year',
        'orderby' => 'meta_value',
        'order' => 'DESC',

    ) );
    $dates = '';
    $issues = '';
    $image = [];
    $year_list = [];
    $year_selected = 0;

    if ( $the_query->have_posts() ){
        while ( $the_query->have_posts() ){
            $the_query->the_post();

            $year = get_post_meta(get_the_ID(), 'history_year', true);

            if (has_post_thumbnail( get_the_ID() ) ){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
            }

            if($year){
                $year_list[] = $year;
                $selected = $year_selected < 1 ? 'class="selected"' : '';
                $dates .= '<li class="slider-frame-points" data-year="'.$year.'"><a href="#'.$year.'" '.$selected.' >'.$year.'</a></li>';

                $issues .= '<li id="'.$year.'"><div style="float: left; width: 50%;"><img src="'.$image[0].'" width="256" height="256" /></div>'.
                                '<div style="float: left;width: 50%">'.
                                '<h1>'.$year.'</h1>'.
                                '<h2>'.get_the_title().'</h2>'.get_the_content().
                            '</div></li>';

                $year_selected++;
            }
        }
    }
    ob_start();
?>
    <div id="timeline">
        <div class="history-slider-logo">
            <style>
                .history-slider-logo{
                    width: 100%;
                    height: 100px;
                    border-bottom: 2px solid #80c4e5;
                    background-image: url("<?php echo get_stylesheet_directory_uri();?>/images/title-icons/history-slider-logo.png");
                    background-position: top left;
                    background-repeat: no-repeat;
                    background-size: auto;
                }
            </style>
        </div>
        <ul id="issues">
            <?php echo $issues;?>
        </ul>
        <ul id="dates">
            <?php echo $dates;?>
        </ul>
        <a href="#" id="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
        <a href="#" id="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        <div class="slider-block">
            <div class="timeline-value"><?php echo max($year_list);?></div>
            <div class="slider-wrapper-block">
                <div id='slider'>
                    <div id="custom-handle" class="ui-slider-handle"></div>
                </div>
            </div>
            <div class="timeline-value"><?php echo min($year_list);?></div>
        </div>
    </div>
<?php
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

add_filter ('get_archives_link',
    function ($link_html, $url, $text, $format, $before, $after) {
        if ('archived_mentors' == $format) {
            $link_html = $before."<a href='$url'>Archived Mentors - Mentees</a>".$after;
        }
        return $link_html;
    }, 10, 6);

add_action( 'wp_ajax_get_staff_profile', 'get_staff_profile' );
add_action( 'wp_ajax_nopriv_get_staff_profile', 'get_staff_profile' );
function get_staff_profile(){
    $staff_id = !empty($_POST['staff_id']) ? absint($_POST['staff_id']): false;
	if(!$staff_id){
		echo '';
		die();
	}
	global $post;
    $post = get_post($staff_id);
	if(!$post){
		echo '';
		die();
	}
	setup_postdata($post);
    ob_start();
	get_template_part('partials/staff/details');
	wp_reset_postdata();
    $html = ob_get_clean();
    echo $html;
    die();
}

add_filter( 'nav_menu_link_attributes', 'wpse_100726_extra_atts', 10, 3 );
function wpse_100726_extra_atts( $atts, $item, $args )
{
    $atts['data-item'] = $item->title;
    return $atts;
}

add_action( 'wp_ajax_get_membership_categories_func', 'get_membership_categories' );
add_action( 'wp_ajax_nopriv_get_membership_categories_func', 'get_membership_categories' );
function get_membership_categories(){
    $category = $_POST['category'];
    $the_query = new WP_Query( array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category_name' => $category,
    ) );
    $row = '';

    if ( $the_query->have_posts() ){
        while ( $the_query->have_posts() ){
            $the_query->the_post();

            $row .= get_the_content();
        }
    } else {
        $row .= 'there is not any post yet';
    }
    ob_start();
    ?>
    <div class="membership-categories-block-wrapper">
        <?php echo $row;?>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
    die();

}

add_action( 'wp_ajax_get_national_associations_func', 'get_national_associations' );
add_action( 'wp_ajax_nopriv_get_national_associations_func', 'get_national_associations' );
function get_national_associations(){
    $category = $_POST['category'];
    $the_associations = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type' => 'associations',
        'tax_query' => array(
            array(
                'taxonomy' => 'associations_category',
                'field' => 'term_id',
                'terms' => $category,
            )
        )
    ) );
    $rows = '';
    if ( $the_associations->have_posts() ):
        ob_start();
        while ($the_associations->have_posts()):
            $the_associations->the_post();
            $image = has_post_thumbnail( get_the_ID() ) ?
                wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
            ?>
            <div class="associations clr">
                        <div class="associations-content-wrapper">
                            <div class="d-flex">
                        <?php echo ($image ? '<div class="associations-thumb"><img alt="" src="'.$image[0].'"/></div>' : '')?>
                                <div class="associations-title-wrap clr">
                                    <?php echo the_title('<h3>','</h3>');?>
                                </div>
                            </div>
                            <div class="associations-content"><?php the_content();?></div>
                        </div>
                    </div>
        <?php endwhile;
    else:?>
        <p>'there is not any post yet'</p>
    <?php endif;

    $html = ob_get_contents();
    ob_end_clean();
    echo $html;
    die();

}

function easl_vc_tab_list_newline($html) {
	return str_replace('--NL--', '<br/>', $html);
}
add_filter('vc-tta-get-params-tabs-list', 'easl_vc_tab_list_newline', 10);

function easl_posts_pagination_display($display, $post_type) {
	$response = false;
	switch ($post_type){
        case 'publication':
        case 'annual_reports':
        case 'slide_decks':
        case 'associations':
            $response = false;
            break;
        default:
            $response = $display;
    }
	return $response;
}
add_filter( 'wpex_has_next_prev', 'easl_posts_pagination_display', 10, 2 );

function easl_staffs_types_args($args){
	$args['public'] = false;
	$args['show_ui'] = true;
	return $args;
}

add_filter('wpex_staff_args', 'easl_staffs_types_args');

function easl_body_classes($classes){
	$post_id = get_queried_object_id();
	if( is_singular('event')) {
		$classes[] = 'event-color-' . easl_get_events_topic_color($post_id);
	}
	if( is_singular(Publication_Config::get_publication_slug())) {
		$classes[] = 'publication-color-' . easl_get_publication_topic_color($post_id);
	}
	return $classes;
}
add_filter( 'body_class', 'easl_body_classes' );