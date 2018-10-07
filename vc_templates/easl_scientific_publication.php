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


if (!$view_all_text) {
    $view_all_text = 'View all Events';
}

if ($title && $view_all_link) {
    $title .= '<a class="easl-events-all-link" href="' . esc_url($view_all_url) . '">' . $view_all_text . '</a>';
}
$filter_by_topic = '';
$taxonomy_string = '';

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
            $taxonomy_string .= '<li>'.
                    '<label class="easl-custom-checkbox csic-'.$bg_color.'">'.
                        '<input type="checkbox" name="ec_filter_topics[]" value="'.$taxonomy->term_id.'" data-countries=""> <span>'.$taxonomy->name.'</span>'.
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
                                                                '<input type="checkbox" name="ec_filter_topics[]" value="" checked="checked"> <span>All Topics</span>'.
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
$take_me_to = '<h4 style="font-size: 18px">Take me to:</h4>'.
    '<a href="/journal-of-hepatology" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Journal of Hepatology'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br.
    '<a href="/jhep-reports" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Jhep Report'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br.
    '<a href="/eu-publications" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">EU Publications'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br.
    '<a href="/patient-documents" class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Patient Documents'.
    '<span class="vcex-icon-wrap theme-button-icon-right"><span class="fa fa-angle-right"></span></span></span></a>'.$br;

$top_filter = '<div class="vc_row wpb_row '.$no_bottom_margins.' vc_inner vc_row-fluid" style="background-color:#ffffff !important; padding-top: 30px; margin-bottom: 30px;border: 3px solid #004b87;">'.
    $filter_by_topic.
	'<div class="wpb_column vc_column_container vc_col-sm-8">'.
		'<div class="vc_column-inner ">'.
			'<div class="wpb_wrapper">'.
				'<div class="wpb_raw_code wpb_content_element wpb_raw_html">'.
					'<div class="wpb_wrapper">'.
						'<div class="easl-col-inner" >'.
							'<div class="ec-filter-search">'.
								'<input type="text" name="ecf_search" value="" placeholder="Search for publication"/>'.
								'<span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>'.
							'</div>'.
							'<h4 style="font-size: 21px">Filter Publications:</h4>'.

							'<div class="easl-custom-select" style="margin-bottom: 15px;">'.
								'<span class="ec-cs-label">Select a year</span>'.
								'<select name="ec-meeting-type" placeholder="Select a year">'.
									'<option value="">Select a year</option>'.
									'<option value="2018">2018</option>'.
									'<option value="2017">2017</option>'.
									'<option value="2016">2016</option>'.
									'<option value="2015">2015</option>'.
									'<option value="2014">2014</option>'.
									'<option value="2013">2013</option>'.
									'<option value="2012">2012</option>'.
									'<option value="2011">2011</option>'.
									'<option value="2010">2010</option>'.
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
$atts['taxonomy']  = 'publication_category';
$atts['tax_query'] = array(
    'taxonomy'=> 'publication_category',
    'field' => 'id',
    'terms' => explode(',', $include_categories),
);

//$css_animation = $this->getCSSAnimation($css_animation);
$easl_query = vcex_build_wp_query( $atts );

$pagination = '
	<div class="easl-ec-pagination-container">
		' . wpex_pagination($easl_query, false) . '
	</div>
	';
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
        $image_src = $image ? $image[0] : EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-1.jpg';


        $excerpt = $hide_excerpt === "true" ? '' : get_the_excerpt();
        $read_more_link =  $deny_detail_page === "true" ? get_field('link_to_journal_hepatology') : get_permalink();
        $target = $deny_detail_page === "true" ? 'target="_blank"' : '';

        $rows .= '<article class="scientific-publication clr">'.
                    '<div class="sp-thumb">'.
                        '<a href="' . $read_more_link . '" title="" '.$target.'><img alt="" src="'.$image_src.'"/></a>'.
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
    $rows .= 'content is coming soon';
endif;



$class_to_filter = 'wpb_easl_scientific_publication wpb_content_element ';
//$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = '';//apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);


$html = '<div class="easl-scientific-publication-wrap">
			' . $top_filter . '
			' . $pagination . '
			<div class="easl-scientific-publication-inner">
				' . $rows . '
			</div>
			' . $pagination . '
		</div>';

$wrapper_attributes = array();
if (!empty($el_id)) {
    $wrapper_attributes[] = 'id="' . esc_attr($el_id) . '"';
}
$output = '
	<div ' . implode(' ', $wrapper_attributes) . ' class="' . esc_attr(trim($css_class)) . '">
		' . wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_easl_widget_heading')) . '
			' . $html . '
	</div>
';

echo $output;
