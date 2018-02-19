<?php

define('EASL_INC_DIR', trailingslashit(get_stylesheet_directory()) . 'inc/');

require_once EASL_INC_DIR . 'post-types/event/event-config.php';
require_once EASL_INC_DIR . 'customizer.php';
require_once EASL_INC_DIR . 'total-extend.php';
require_once EASL_INC_DIR . 'shortcodes.php';

function easl_theme_setup(){
	
}
add_action( 'after_setup_theme', 'easl_theme_setup' );


function easl_custom_scripts(){
	wp_enqueue_script('jquery');
    wp_enqueue_script('easl-custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), null, true);
	$ssl_scheme = is_ssl() ? 'https' : 'http';
	$fornt_end_data = array(
		'ajaxUrl' => admin_url('admin-ajax.php', $ssl_scheme),
	);
	wp_localize_script( 'easl-custom', 'EASLSETTINGS', $fornt_end_data );
}
add_action('wp_enqueue_scripts', 'easl_custom_scripts', 20);

function easl_footer_scripts(){
	echo '<script type="text/javascript" src="'. get_stylesheet_directory_uri() . '/js/custom.js' .'"></script>';
}

//add_action('wp_footer', 'easl_footer_scripts', 99);


/**
 * Make the main menu displayable for the mobile menu
 * Stripping all column alias and classes.
 */
//add_filter('wp_nav_menu_objects', 'easl_nav_menu_objs', 11, 2);
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
	if(!wpex_page_header_subheading_content()){
		return $classes;
	}
	$classes[] = 'ilc-page-subheading';
	return $classes;
}
//add_filter('wpex_page_header_classes', 'easl_page_heder_class');