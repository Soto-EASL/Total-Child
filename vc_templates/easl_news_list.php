<?php
/**
 * EASL_VC_News_List
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $this EASL_VC_News_List
 */
$el_class      = '';
$css           = '';
$css_animation = '';
$limit = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$search_req      = ! empty( $_REQUEST['nsearch'] ) ? $_REQUEST['nsearch'] : false;
$news_source_req = ! empty( $_REQUEST['nsource'] ) ? absint( $_REQUEST['nsource'] ) : false;
$year_req        = ! empty( $_REQUEST['nyear'] ) ? absint( $_REQUEST['nyear'] ) : false;

$class_to_filter = 'vcex-module easl-news-list-wrap clr';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$wrapper_attributes = array();

if ( ! empty( $atts['el_id'] ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $atts['el_id'] ) . '"';
}
if ( $css_class ) {
	$wrapper_attributes[] = 'class="' . esc_attr( $css_class ) . '"';
}
$limit = absint($limit);
if(!$limit){
	$limit = -1;
}
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
// Build Query
$query_args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
	'paged'          => $paged,
);
$tax_query  = array(
	'relation' => 'AND',
	array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => array( 23, 24, 34, 35, 36, 37, 38, 39, 88 ),
		'operator' => 'NOT IN',
	),
);

if ( $search_req ) {
	$query_args['s'] = $search_req;
}
if ( $year_req ) {
	$query_args['year'] = $year_req;
}
if ( $news_source_req ) {
	$tax_query[] = array(
		'taxonomy' => EASL_News_Source_Tax::get_slug(),
		'field'    => 'term_id',
		'terms'    => array( $news_source_req ),
	);
}

if ( count( $tax_query ) > 0 ) {
	$query_args['tax_query'] = $tax_query;
}

$news_query = new WP_Query( $query_args );
?>
<div <?php echo implode( ' ', $wrapper_attributes ); ?>>
    <div class="easl-news-list-filter">
        <form class="easl-news-list-filter-form" action="" method="get">
            <div class="easl-row">
                <div class="easl-col easl-col-2">
                    <div class="easl-col-inner">
                        <div class="ec-filter-search">
                            <input type="text" name="nsearch" value="<?php if ( $search_req ) {
								echo esc_attr( $search_req );
							} ?>" placeholder="Search for title or keyword"/>
                            <span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="easl-col easl-col-4">
                    <div class="easl-col-inner">
                        <div class="easl-custom-select easl-custom-select-filter-source">
                            <span class="ec-cs-label">All Sources</span>
                            <select name="nsource">
                                <option value="">All Sources</option>
								<?php
								$news_sources = get_terms( array(
									'taxonomy'   => EASL_News_Source_Tax::get_slug(),
									'hide_empty' => false,
									'orderby'    => 'term_id',
									'order'      => 'ASC',
									'fields'     => 'id=>name',
								) );
								if ( ! is_array( $news_sources ) ) {
									$news_sources = array();
								}
								foreach ( $news_sources as $news_source_id => $news_source_title ):
									?>
                                    <option value="<?php echo $news_source_id; ?>" <?php selected( $news_source_id, $news_source_req, true ) ?>><?php echo esc_html( $news_source_title ); ?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="easl-col easl-col-4">
                    <div class="easl-col-inner">
                        <div class="easl-custom-select easl-custom-select-filter-year">
                            <span class="ec-cs-label">All Years</span>
                            <select name="nyear">
                                <option value="">All Years</option>
								<?php
								$years_dd = $this->get_years();
								foreach ( $years_dd as $year ):
									?>
                                    <option value="<?php echo $year; ?>" <?php selected( $year, $year_req, true ) ?>><?php echo $year; ?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="easl-news-list-result <?php if ( $news_query->max_num_pages ) {
		echo 'easl-news-list-result-has-pagination';
	} ?>">
        <div class="easl-row">
            <div class="easl-col easl-col-3-4">
                <div class="easl-col-inner">
                    <div class="easl-news-list-con">
						<?php
						if ( $news_query->have_posts() ):
							while ( $news_query->have_posts() ):
								$news_query->the_post();
								?>
                                <article class="easl-news-list-entry <?php if ( has_post_thumbnail() ) {
									echo 'easl-news-list-entry-has-thumb';
								} ?>">
									<?php if ( has_post_thumbnail() ): ?>
                                        <div class="easl-news-list-thumb">
                                            <a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'news_list' ); ?>
                                            </a>
                                        </div>
									<?php endif; ?>
                                    <div class="easl-news-list-content">
                                        <p class="easl-news-list-meta">
                                            <span class="easl-news-list-date"></span><?php echo wpex_date_format( array(
												'id'     => get_the_ID(),
												'format' => 'd/m/y',
											) ); ?></span>
											<?php
											$sources = get_the_term_list( get_the_ID(), EASL_News_Source_Tax::get_slug(), '', ',', '' );
											if ( $sources ):
												?>
                                                - <span class="easl-news-list-source"><?php echo $sources; ?></span>
											<?php endif; ?>
                                        </p>
                                        <h2 class="easl-news-list-title"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="easl-news-list-excerpt"><?php wpex_excerpt( array( 'length' => 32 ) ); ?></div>
                                    </div>
                                </article>
							<?php
							endwhile;
							wp_reset_query();
                        else:
                            echo '<div class="easl-not-found"><p>'. __('Nothing has been found', 'total-child') .'</p></div>';
						endif;
						?>
                    </div>
					<?php if ( $news_query->max_num_pages ): ?>
                        <div class="easl-news-list-pagination easl-list-pagination">
							<?php echo paginate_links( array(
								'total'     => $news_query->max_num_pages,
								'current'   => $paged,
								'end_size'  => 3,
								'mid_size'  => 5,
								'prev_next' => true,
								'prev_text' => '<span class="fa fa-angle-left" aria-hidden="true"></span>',
								'next_text' => '<span class="fa fa-angle-right" aria-hidden="true"></span>',
								'type'      => 'list',
							) ); ?>
                        </div>
					<?php endif; ?>
                </div>
            </div>
            <div class="easl-col easl-col-4 easl-news-list-newsletters">
                <div class="easl-col-inner">
                    <div class="sidebar-box widget">
                        <h2 class="widget-title"><?php _e( 'Past EASL Newsletters', 'total-child' ); ?></h2>
                        <?php get_template_part('partials/newsletter/list'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>