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
 * Shortcode class EASL_VC_Slide_Decks
 * @var $this EASL_VC_Slide_Decks
 */

$el_class = $el_id = $css_animation = $css = '';
$limit= '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );


$class_to_filter = 'wpb_easl_slide_decks wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class		 = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings[ 'base' ], $atts );
$wrapper_attributes = array();
if (!empty($el_id)) {
	$wrapper_attributes[] = 'id="' . esc_attr($el_id) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( $css_class ) . '"';
}

wp_enqueue_style('easl-scientific-publication-style',
	get_stylesheet_directory_uri() . '/assets/css/easl_scientific_publication.css');

wp_enqueue_script('easl-scientific-publication-script',
	get_stylesheet_directory_uri() . '/assets/js/easl_scientific_publication.js',
	['jquery'],
	false,
	true);

$has_filter = false;
$filter_sd_topics = [];
$filter_sd_search = '';
$filter_sd_cat = '';



if(isset($_REQUEST['sd_topics'])){
	$filter_sd_topics = $_REQUEST['sd_topics'];
	$has_filter = true;
}
if(isset($_REQUEST['sd_search']) && ($_REQUEST['sd_search'] != '') ){
	$filter_sd_search = $_REQUEST['sd_search'];
	$has_filter = true;
}
if(isset($_REQUEST['sd_cat']) && $_REQUEST['sd_cat'] != ''){
	$filter_sd_cat = $_REQUEST['sd_cat'];
	$has_filter = true;
}

$filter_by_topic = '';
$taxonomy_string = '';
$is_custom_topic = false;

$taxonomies = get_terms( array(
    'taxonomy'   => Slide_Decks_Config::get_topic_slug(),
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
    'fields'     => 'id=>name',
) );
if($taxonomies){
    foreach ($taxonomies as $term_id => $term_name){
        $bg_color ='';
        $topic_color = get_term_meta($term_id, 'easl_tax_color', true);
        if(!$topic_color) {
            $bg_color = 'blue';
        } else {
            $bg_color = $topic_color;
        }
        $filter_topic_checked = '';
        if(in_array($term_id, $filter_sd_topics)){
            $filter_topic_checked = 'checked';
            $is_custom_topic = true;
        }
        $taxonomy_string .= '<li>'.
                            '<label class="easl-custom-checkbox csic-'.$bg_color.'">'.
                            '<input type="checkbox" name="sd_topics[]" value="'.$term_id.'" data-countries="" '.$filter_topic_checked.'> <span>'.$term_name.'</span>'.
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
                   '<input type="checkbox" name="sd_topics[]" value="" '.(!$is_custom_topic ? 'checked="checked"' : '').'> <span>All topics</span>'.
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


$sd_cats_options = '';
$slide_decks_categories = get_terms( array(
	'taxonomy'   => Slide_Decks_Config::get_category_slug(),
	'hide_empty' => false,
	'orderby'    => 'term_id',
	'order'      => 'ASC',
	'fields'     => 'id=>name',
) );
if($slide_decks_categories){
    foreach ($slide_decks_categories as $term_id => $term_name){
	    $sd_cats_options .= '<option value="'. $term_id .'" '. selected($term_id, $filter_sd_cat, false) .'>'. $term_name .'</option>';
    }
}

$top_filter = '<div class="vc_row wpb_row no-bottom-margins vc_inner vc_row-fluid easl-slide-decks-container">'.
              $filter_by_topic.
              '<div class="wpb_column vc_column_container vc_col-sm-8">'.
              '<div class="vc_column-inner ">'.
              '<div class="wpb_wrapper">'.
              '<div class="wpb_raw_code wpb_content_element wpb_raw_html">'.
              '<div class="wpb_wrapper">'.
              '<div class="easl-col-inner" >'.
              '<div class="ec-filter-search">'.
              '<input type="text" name="sd_search" value="'.($filter_sd_search ? $filter_sd_search : '').'" placeholder="Search for slide decks"/>'.
              '<span class="ecs-icon"><i class="ticon ticon-search" aria-hidden="true"></i></span>'.
              '</div>'.
              '<h4 style="font-size: 21px">Filter Slide Decks:</h4>'.

              '<div class="easl-custom-select" style="margin-bottom: 15px;">'.
              '<span class="ec-cs-label">Select an option</span>'.
              '<select name="sd_cat" placeholder="Select an option">'.
              '<option value="">All</option>'.
              $sd_cats_options.
              '</select>'.
              '</div>';

$top_filter .=			'</div>'.
                          '</div>'.
                          '</div>'.
                          '</div>'.
                          '</div>'.
                          '</div>';

$top_filter .= '</div>';

$limit = absint($limit);
if(!$limit){
	$limit = -1;
}
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$query_args = array(
	'post_type'      => Slide_Decks_Config::get_slug(),
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'paged'          => $paged,
);

if($filter_sd_search){
	$query_args['s'] = $filter_sd_search;
}

$tax_query = array();
if( is_array($filter_sd_topics) && count($filter_sd_topics) > 0 && $filter_sd_topics[0] != '') {
	$tax_query[] =  array(
		'taxonomy' => Slide_Decks_Config::get_topic_slug(),
		'field' => 'id',
		'terms' => $filter_sd_topics,
		'operator' => 'IN',
	);
}
if(!empty($filter_sd_cat)) {
	$tax_query[] =  array(
		'taxonomy' => Slide_Decks_Config::get_category_slug(),
		'field' => 'id',
		'terms' => array($filter_sd_cat),
		'operator' => 'IN',
	);
}
if(count($tax_query) > 0){
	$query_args['tax_query'] = array('relation' => 'AND');
	$query_args['tax_query'][] = $tax_query;
}

$easl_query = new WP_Query( $query_args );

$paginatio_html =  paginate_links( array(
	'total'     => $easl_query->max_num_pages,
	'current'   => $paged,
	'end_size'  => 3,
	'mid_size'  => 5,
	'prev_next' => true,
	'prev_text' => '<span class="ticon ticon-angle-left" aria-hidden="true"></span>',
	'next_text' => '<span class="ticon ticon-angle-right" aria-hidden="true"></span>',
	'type'      => 'list',
) );

$pagination = '<div class="easl-list-pagination" >' . $paginatio_html . '</div>';

$not_found_text = $has_filter ? __('Nothing has been found', 'total-child') : __('content is coming soon', 'total-child');
?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
    <div class="easl-slide-decks-wrap">
		<?php if($top_filter): ?>
            <form class="publication-filter" action="" method="get" style="background: #fff; border: 3px solid #004b87; padding: 30px 15px; margin-bottom: 30px;">
				<?php echo $top_filter; ?>
            </form>
		<?php endif; ?>
        <div class="easl-slide-decks-top-pagination easl-list-pagination" ><?php echo $paginatio_html; ?></div>
        <div class="easl-slide-decks-inner">
			<?php
			if ( $easl_query->have_posts() ){
				while ( $easl_query->have_posts() ):
					$easl_query->the_post();
					$topic_str = '';
					$topics = wp_get_post_terms(get_the_ID(), Slide_Decks_Config::get_topic_slug() );
					if($topics){
						foreach ($topics as $topic){
							$topic_str .= $topic->name.' ';

						}
					}
					$image = has_post_thumbnail( get_the_ID() ) ?
						wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
					$image_src = $image ? $image[0] : '';

					$download_link =  get_field('slide-decks-file');
					?>
                    <article class="easl-slide-deck-item <?php if($image_src){echo 'easl-slide-deck-item-has-thumb';} ?> easl-sdrow-color-<?php echo easl_get_slide_decks_topic_color(); ?> clr">
						<?php if($image_src): ?>
                            <div class="easl-slide-deck-item-thumb">
                                <?php if($download_link): ?><a href="<?php echo $download_link;?>" title="" target="_blank" download=""><?php endif; ?>
                                    <img alt="" src="<?php echo $image_src; ?>"/>
					            <?php if($download_link): ?></a><?php endif; ?>
                            </div>
						<?php endif; ?>
                        <div class="easl-slide-deck-item-content">
                            <div class="easl-slide-deck-item-meta-title">
	                            <?php if($topic_str): ?>
                                <p class="sp-meta">
                                    <span class="sp-meta-type"><?php _e('Topic:', 'total-child'); ?></span>
                                    <span class="sp-meta-value"><?php echo $topic_str; ?></span>
                                </p>
	                            <?php endif; ?>
                                <h3>
                                    <?php if($download_link): ?><a href="<?php echo $download_link; ?>" target="_blank" download=""><?php endif; ?>
                                        <?php the_title(); ?>
                                    <?php if($download_link): ?></a><?php endif; ?>
                                </h3>
                            </div>
                            <?php if($download_link): ?>
                            <a class="easl-button" href="<?php echo $download_link; ?>" target="_blank" download=""><?php _e('Download', 'total-child') ?></a>
	                        <?php endif; ?>
                        </div>
                    </article>
				<?php
				endwhile;
				wp_reset_query();
			}else{
				echo '<div class="easl-not-found"><p>'. $not_found_text .'</p></div>';
            }
			?>
        </div>
        <div class="easl-slide-decks-bottom-pagination easl-list-pagination" ><?php echo $paginatio_html; ?></div>
    </div>
</div>
