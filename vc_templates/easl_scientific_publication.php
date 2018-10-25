<?php
if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $el_id
 * @var $css
 * Shortcode class
 * @var $this SC_LL_Video_Box
 */

$title = $element_width = $view_all_link = $view_all_url = $view_all_text = $el_class = $el_id = $css_animation = '';
$atts = vc_map_get_attributes( 'easl_scientific_publication', $atts );

extract($atts);

wp_enqueue_style('easl-scientific-publication-style',
    get_stylesheet_directory_uri() . '/assets/css/easl_scientific_publication.css');

wp_enqueue_script('easl-scientific-publication-script',
    get_stylesheet_directory_uri() . '/assets/js/easl_scientific_publication.js',
    ['jquery'],
    false,
    true);

$has_filter = false;
$filter_ec_filter_topics = [];
$filter_ecf_search = '';
$filter_ecf_year = '';

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;


if(isset($_REQUEST['ec_filter_topics'])){
    $filter_ec_filter_topics = $_REQUEST['ec_filter_topics'];
    $has_filter = true;
}
if(isset($_REQUEST['ecf_search']) && ($_REQUEST['ecf_search'] != '') ){
    $filter_ecf_search = $_REQUEST['ecf_search'];
    $has_filter = true;
}
if(isset($_REQUEST['ecf_year']) && $_REQUEST['ecf_year'] != ''){
    $filter_ecf_year = $_REQUEST['ecf_year'];
    $has_filter = true;
}


if (!$view_all_text) {
    $view_all_text = 'View all Events';
}

if ($title && $view_all_link) {
    $title .= '<a class="easl-events-all-link" href="' . esc_url($view_all_url) . '">' . $view_all_text . '</a>';
}
$filter_by_topic = '';
$taxonomy_string = '';
$is_custom_topic = false;
if($hide_topic === "false"){
    $taxonomies = get_categories(['taxonomy' => 'publication_topic']);
    if($taxonomies){
        foreach ($taxonomies as $taxonomy){
            $bg_color ='';
            $topic_color = get_term_meta($taxonomy->term_id, 'easl_tax_color', true);
            if(!$topic_color) {
                $bg_color = 'blue';
            } else {
                $bg_color = $topic_color;
            }
            $filter_topic_checked = '';
            if(in_array($taxonomy->term_id, $filter_ec_filter_topics)){
                $filter_topic_checked = 'checked';
                $is_custom_topic = true;
            }
            $taxonomy_string .= '<li>'.
                    '<label class="easl-custom-checkbox csic-'.$bg_color.'">'.
                        '<input type="checkbox" name="ec_filter_topics[]" value="'.$taxonomy->term_id.'" data-countries="" '.$filter_topic_checked.'> <span>'.$taxonomy->name.'</span>'.
                    '</label>'.
                '</li>';
        }
    }

    $filter_by_topic = '<div class="wpb_column vc_column_container vc_col-sm-4">'.
                            '<div class="vc_column-inner ">'.
                                '<div class="wpb_wrapper">'.
                                    '<div class="wpb_raw_code wpb_content_element wpb_raw_html">'.
                                        '<div class="wpb_wrapper">'.
                                            '<div class="easl-col-inner">'.
                                                '<div class="easl-col-inner">'.

                                                    '<h4 style="font-size: 21px;border-bottom: 1px solid #d7d7d7;">Show me:</h4>'.
                                                    '<ul class="ec-filter-topics">'.
                                                        '<li>'.
                                                            '<label class="easl-custom-checkbox easl-cb-all csic-light-blue easl-active">'.
                                                                '<input type="checkbox" name="ec_filter_topics[]" value="" '.(!$is_custom_topic ? 'checked="checked"' : '').'> <span>All Topics</span>'.
                                                            '</label>'.
                                                        '</li>'.
                                                        $taxonomy_string.
                                                    '</ul>'.
                                                '</div>'.
                                            '</div>'.
                                        '</div>'.
                                    '</div>'.
                                '</div>'.
                            '</div>'.
                        '</div>';

    $br = '';
    $no_bottom_margins = '';
}  else {
    $br = '<br>';
    $no_bottom_margins = 'no-bottom-margins';
}

$current_year = (new DateTime())->format('Y');
$the_year = 2010;
$option = '';
for ($current_year = (new DateTime())->format('Y'); $current_year >= $the_year ; $current_year--){
    $selected_attr = '';
    if($current_year == (int)$filter_ecf_year){
        $selected_attr = 'selected';
    }
    $option .= '<option value="'.$current_year.'" '.$selected_attr.'>'.$current_year.'</option>';

}
$take_me_to = '<h4 style="font-size: 18px">Take me to:</h4>'.
    '<a href="/journal-of-hepatology" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Journal of Hepatology'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br.
    '<a href="/jhep-reports" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Jhep Report'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br.
    '<a href="/eu-publications" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">EU Publications'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br.
    '<a href="/patient-documents" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Patient Documents'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br;

$top_filter = '<div class="vc_row wpb_row '.$no_bottom_margins.' vc_inner vc_row-fluid easl-scientific-publication-container" 
style="background-color:#ffffff !important; padding-top: 30px; margin-bottom: 30px;border: 3px solid #004b87;">'.
    $filter_by_topic.
	'<div class="wpb_column vc_column_container vc_col-sm-8">'.
		'<div class="vc_column-inner ">'.
			'<div class="wpb_wrapper">'.
				'<div class="wpb_raw_code wpb_content_element wpb_raw_html">'.
					'<div class="wpb_wrapper">'.
						'<div class="easl-col-inner" >'.
							'<div class="ec-filter-search">'.
								'<input type="text" name="ecf_search" value="'.($filter_ecf_search ? $filter_ecf_search : '').'" placeholder="Search for publication"/>'.
								'<span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>'.
							'</div>'.
							'<h4 style="font-size: 21px">Filter Publications:</h4>'.

							'<div class="easl-custom-select" style="margin-bottom: 15px;">'.
								'<span class="ec-cs-label">Select a year</span>'.
								'<select name="ecf_year" placeholder="Select a year">'.
									'<option value="">Select a year</option>'.
                                    $option.
								'</select>'.
							'</div>';

$top_filter .= $hide_topic === "false" ? $take_me_to : '';
$top_filter .=			'</div>'.
					'</div>'.
				'</div>'.
			'</div>'.
		'</div>'.
	'</div>';
$top_filter .=  $hide_topic === "true" ? '<div class="wpb_column vc_column_container vc_col-sm-4" style="border-left: 1px solid #104f85;">'.
'<div class="vc_column-inner ">'.
			'<div class="wpb_wrapper">'.
				'<div class="wpb_raw_code wpb_content_element wpb_raw_html">'.
					'<div class="wpb_wrapper">'.
						'<div class="easl-col-inner" >'. $take_me_to.'</div></div></div></div></div></div>': '';
$top_filter .= '</div>';

$atts['post_type'] = 'publication';
$atts['paged'] = $paged;
$atts['tax_query'] = array(
    array(
        'taxonomy'=> 'publication_category',
        'field' => 'id',
        'terms' => explode(',', $include_categories),
    ),
);

if($filter_ecf_search){
    $atts['s'] = $filter_ecf_search;
}

if($filter_ecf_year && ($filter_ecf_year != '') ){
    $atts['meta_query'] = array(
        'relation' => 'AND',
        'publication_date'=> array(
            'key' => 'publication_date',
            'value' => $filter_ecf_year,
            'compare' => 'LIKE',
            'type' => 'CHAR',
        )


    );
}
if( is_array($filter_ec_filter_topics) && count($filter_ec_filter_topics) > 0 && $filter_ec_filter_topics[0] != '') {
    $atts['tax_query']['relation'] = 'AND';
    $atts['tax_query'][] =  array(
        'taxonomy' => 'publication_topic',
        'field' => 'id',
        'terms' => $filter_ec_filter_topics,
        'operator' => 'IN',
    );
}


//$css_animation = $this->getCSSAnimation($css_animation);

$easl_query = new WP_Query( $atts );


$rows = '';
$topic_label = 'Topic:';
$topic_delimiter = ' | ';
if ( $easl_query->have_posts() ) :
    while ( $easl_query->have_posts() ) {

        // Get post from query
        $easl_query->the_post();
        $topic_str = '';
        $topics = wp_get_post_terms(get_the_ID(), 'publication_topic' );
        if($topics){
            foreach ($topics as $topic){
                $topic_str .= $topic->name.' ';

            }
        }
        if($hide_topic === "true"){
            $topic_str = '';
            $topic_label = '';
            $topic_delimiter = '';
        }
        $image = has_post_thumbnail( get_the_ID() ) ?
            wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
        $image_src = $image ? $image[0] : '';


        $excerpt = $hide_excerpt === "true" ? '' : get_the_excerpt();
        $read_more_link =  $deny_detail_page === "true" ? get_field('link_to_journal_hepatology') : get_permalink();
        $target = $deny_detail_page === "true" ? 'target="_blank"' : '';

        $rows .= '<article class="scientific-publication clr">'.
                    '<div class="sp-thumb">'.
                        '<a href="' . $read_more_link . '" title="" '.$target.'>'.($image_src ? '<img alt="" src="'.$image_src.'"/>' : '').'</a>'.
                    '</div>'.
                    '<div class="sp-content">'.
                        '<div class="color-delimeter filter-bg-'.easl_get_events_topic_color().'" style="padding-left: 10px;">'.
                            '<p class="sp-meta">'.
                                '<span class="sp-meta-date">'.get_field('publication_date').'</span>'.
                                '<span class=sp-meta-sep">'.$topic_delimiter.'</span>'.
                                '<span class="sp-meta-type">'.$topic_label.'</span>'.
                                '<span class="sp-meta-value">'.$topic_str.'</span>'.
                            '</p>'.
                            '<h3>'.
                                '<a href="' . $read_more_link . '" '.$target.'>'.get_the_title().'</a>'.
                            '</h3>'.
                        '</div>'.
                        '<p class="sp-excerpt">'.$excerpt.'</p>'.
                        '<a class="easl-button" href="' . $read_more_link . '" '.$target.'>Read More</a>'.
                    '</div>'.
                '</article>';



    }
else:
    $rows .= $has_filter ? 'Nothing has been found' : 'content is coming soon';

endif;


$arrow_style = wpex_get_mod( 'pagination_arrow' );
$arrow_style = $arrow_style ? esc_attr( $arrow_style ) : 'angle';

// Arrows with RTL support
$prev_arrow = is_rtl() ? 'fa fa-' . $arrow_style . '-right' : 'fa fa-' . $arrow_style . '-left';
$next_arrow = is_rtl() ? 'fa fa-' . $arrow_style . '-left' : 'fa fa-' . $arrow_style . '-right';
// Previous text
$prev_text = '<span class="' . $prev_arrow . '" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'Previous', 'total' ) . '</span>';
// Next text
$next_text = '<span class="' . $next_arrow . '" aria-hidden="true"></span><span class="screen-reader-text">' . esc_html__( 'Next', 'total' ) . '</span>';

$args = array(
    'base' => preg_replace('/\?.*/', '/', get_pagenum_link()) . '%_%',
    'format'             => '?paged=%#%',
    'total'              => $easl_query->max_num_pages,
    'current'            => $paged,
    'show_all'           => false,
    'end_size'           => 1,
    'mid_size'           => 2,
    'prev_next'          => true,
    'prev_text'          => $prev_text,
    'next_text'          => $next_text,
    'type'               => 'list',
    'add_args'           => false,
);

$pagination = '<div class="easl-ec-pagination-container" style="display: flex">'.
    paginate_links($args) .
    '</div>';

$class_to_filter = 'wpb_easl_scientific_publication wpb_content_element ';
//$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = '';//apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);


$html = '<div class="easl-scientific-publication-wrap">'.
            '<form class="publication-filter" action="" method="get">' . $top_filter . '</form>'.
			 $pagination .
			'<div class="easl-scientific-publication-inner">'.
			 $rows .
			'</div>'.
			$pagination .
		'</div>';

$wrapper_attributes = array();
if (!empty($el_id)) {
    $wrapper_attributes[] = 'id="' . esc_attr($el_id) . '"';
}
$output = '
	<div ' . implode(' ', $wrapper_attributes) . ' class="' . esc_attr(trim($css_class)) . '" style="padding-left:15px; padding-right:15px;">
		' . wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_easl_widget_heading')) . '
			' . $html . '
	</div>
';

echo $output;
