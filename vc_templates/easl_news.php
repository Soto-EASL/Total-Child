<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
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
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!$view_all_text){
	$view_all_text = 'View all News';
}

if($title && $view_all_link){
	$title .= '<a class="easl-news-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}

$class_to_filter = 'wpb_easl_news_list wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$query_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 4,
	'tax_query'      => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => array( 23, 24, 34, 35, 36, 37, 38, 39, 88 ),
			'operator' => 'NOT IN',
		),
	),
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		),
	)
);

$img_news_query = new WP_Query($query_args);

$img_news_items = array();
while ($img_news_query->have_posts()){
	$img_news_query->the_post();
	if(!has_post_thumbnail()){
		continue;
	}
	$image_args = array(
		'width'          => 350,
		'height'         => 170,
		'crop'           => true,
		'attachment'     => get_post_thumbnail_id(),
	);
	$img_item_html = '<article class="easl-news-item">';
		$img_item_html .= '<figure><a href="'. get_the_permalink() .'">' . wpex_get_post_thumbnail($image_args) .'</a></figure>';
		$news_date = wpex_date_format( array(
			'id'     => get_the_ID(),
			'format' => 'd/m/y',
		) );
		$img_item_html .= '<p class="easl-news-date">'. $news_date .'</p>';
		$img_item_html .= '<h3><a href="' . get_the_permalink() . '">'. get_the_title() .'</a></h3></p>';
		$img_item_html .= '<div class="eeasl-news-excerpt">' . wpex_get_excerpt( array( 'length' => 28 ) ) . '</div>';
	$img_item_html .= '</article>';
	$img_news_items[] = $img_item_html;
}
wp_reset_query();
unset($img_news_query);

$query_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 8,
	'tax_query'      => array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'category',
			'field'    => 'term_id',
			'terms'    => array( 23, 24, 34, 35, 36, 37, 38, 39, 88 ),
			'operator' => 'NOT IN',
		),
	),
	'meta_query' => array(
		array(
			'key' => '_thumbnail_id',
			'compare' => 'NOT EXISTS'
		),
	)
);
$noimg_news_query = new WP_Query($query_args);

$noimg_news_items = array();
while ($noimg_news_query->have_posts()){
	$noimg_news_query->the_post();
	if(has_post_thumbnail()){
		continue;
	}
	$image_args = array(
		'width'          => 350,
		'height'         => 170,
		'crop'           => true,
		'attachment'     => get_post_thumbnail_id(),
	);
	$img_item_html = '<article class="easl-news-item">';
		$news_date = wpex_date_format( array(
			'id'     => get_the_ID(),
			'format' => 'd/m/y',
		) );
		$img_item_html .= '<p class="easl-news-date">'. $news_date .'</p>';
		$img_item_html .= '<h3><a href="' . get_the_permalink() . '">'. get_the_title() .'</a></h3></p>';
		$img_item_html .= '<div class="eeasl-news-excerpt">' . wpex_get_excerpt( array( 'length' => 28 ) ) . '</div>';
	$img_item_html .= '</article>';
	$noimg_news_items[] = $img_item_html;
}
wp_reset_query();
unset($noimg_news_query);
?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?> class="<?php echo esc_attr( trim( $css_class ) ) ; ?>">
	<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_news_heading' ) ); ?>
	<div class="easl-news-container easl-container">
		<div class="easl-news-row easl-row">
			<div class="easl-news-col easl-col easl-col-3">
				<div class="easl-col-inner">
					<?php
					if(!empty($img_news_items[0])){
						echo $img_news_items[0];
					}
					?>
				</div>
			</div>
			<div class="easl-news-col easl-col easl-col-3">
				<div class="easl-col-inner">
					<?php
					if(!empty($noimg_news_items[0])){
						echo $noimg_news_items[0];
					}
					if(!empty($noimg_news_items[1])){
						echo $noimg_news_items[1];
					}
					?>
				</div>
			</div>
			<div class="easl-news-col easl-col easl-col-3">
				<div class="easl-col-inner">
					<?php
					if(!empty($img_news_items[1])){
						echo $img_news_items[1];
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
