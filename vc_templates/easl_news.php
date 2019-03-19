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
$title         = '';
$element_width = '';
$view_all_link = '';
$view_all_url  = '';
$view_all_text = '';
$el_class      = '';
$el_id         = '';
$css_animation = '';
$limit         = '';
$atts          = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( ! $view_all_text ) {
	$view_all_text = 'View all News';
}

if ( $title && $view_all_link ) {
	$title .= '<a class="easl-news-all-link" href="' . esc_url( $view_all_url ) . '">' . $view_all_text . '</a>';
}

$class_to_filter = 'wpb_easl_news_list wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

if(!$limit){
	$limit = -1;
}
$query_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'meta_query'     => array(
		array(
			'key'     => '_thumbnail_id',
			'compare' => 'EXISTS'
		),
	)
);

$news_query = new WP_Query( $query_args );

if ( $news_query->have_posts() ):
	?>
    <div <?php echo implode( ' ', $wrapper_attributes ); ?> class="<?php echo esc_attr( trim( $css_class ) ); ?>">
		<?php echo wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_news_heading' ) ); ?>
        <div class="easl-news-container easl-container">
            <div class="easl-news-row easl-row">
				<?php
				while ( $news_query->have_posts() ) {
					$news_query->the_post();
					if ( ! has_post_thumbnail() ) {
						continue;
					}
					$image_args = array(
						'width'      => 350,
						'height'     => 170,
						'crop'       => true,
						'attachment' => get_post_thumbnail_id(),
					);
					?>
                    <div class="easl-news-col easl-col easl-col-3">
                        <div class="easl-col-inner">
                            <article class="easl-news-item">
                                <figure>
                                    <a href="<?php the_permalink(); ?>"><?php echo wpex_get_post_thumbnail( $image_args ); ?></a>
                                </figure>
                                <p class="easl-news-date"><?php echo wpex_date_format( array( 'id'     => get_the_ID(),
								                                                              'format' => 'd M, Y',
									) ); ?></p>
                                <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
                                <div class="eeasl-news-excerpt"><?php echo wpex_get_excerpt( array( 'length' => 28 ) ); ?></div>
                            </article>
                        </div>
                    </div>
					<?php
				}
				wp_reset_query();
				?>
            </div>
        </div>
    </div>
<?php endif; ?>