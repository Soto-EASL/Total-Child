<?php
/**
 * EASL_VC_STAFF_LIST
 */

if( !class_exists('EASL_VC_HIGHLIGHTS') ){
    class EASL_VC_HIGHLIGHTS {

        public function __construct() {
            add_shortcode( 'easl_highlights', array( $this, 'output' ) );
            vc_lean_map( 'easl_highlights', array( $this, 'map' ) );

            // Admin filters
            if ( is_admin() ) {

                // Get autocomplete suggestion
                add_filter( 'vc_autocomplete_easl_highlights_include_categories_callback', 'vcex_suggest_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_exclude_categories_callback', 'vcex_suggest_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_filter_active_category_callback', 'vcex_suggest_staff_categories', 10, 1 );

                // Render autocomplete suggestions
                add_filter( 'vc_autocomplete_easl_highlights_include_categories_render', 'vcex_render_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_exclude_categories_render', 'vcex_render_staff_categories', 10, 1 );
                add_filter( 'vc_autocomplete_easl_highlights_filter_active_category_render', 'vcex_render_staff_categories', 10, 1 );


            }

        }

        /**
         * Shortcode output => Get template file and display shortcode
         *
         * @since 4.0
         */
        public function output( $atts, $content = null ) {
            ob_start();
            include( get_stylesheet_directory() . '/vc_templates/easl_highlights.php' );
            return ob_get_clean();
        }

        public function map() {
            return array(
                'name' => __( 'EASL Highlights', 'total' ),
                'base' => 'easl_highlights',
                'category' => __( 'EASL', 'total' ),
                'description' => __( 'EASL Highlights', 'total' ),
                'icon' => 'vcex-icon ticon ticon-users',
                'php_class_name' => 'EASL_VC_YI_Fellowship',
                'params' => array(
                    vc_map_add_css_animation(),
                    array(
                        'type' => 'el_id',
                        'heading' => __( 'Element ID', 'js_composer' ),
                        'param_name' => 'el_id',
                        'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ),
                            'http://www.w3schools.com/tags/att_global_id.asp' ),
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'js_composer' ),
                        'param_name' => 'el_class',
                        'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                    ),
                    array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            );
        }

        public function load_highlights(){

            $filter = $_REQUEST['filter'];
            $country = easl_event_get_countries();
            $color_list = array(
                'blue' => '#165291',
                'red' => '#dc214e',
                'teal' => '#189790',
                'orrange' => '#eb6018',
                'gray' => '#7e6a73',
                'yellow' => '#f9bc49',
            );
			$now_time = time();
            if($filter === 'all'){
                $latest_event = new WP_Query(
					array(
						'post_type' => EASL_Event_Config::get_event_slug(),
						'post_status' => 'publish',
						'posts_per_page' => 1,
						'order' => 'ASC',
						'orderby' => 'meta_value_num',
						'meta_key' => 'event_start_date',
						'meta_query' => array(
							'relation' => 'OR',
							array(
								'key' => 'event_start_date',
								'value' => $now_time - 86399,
								'compare' => '>=',
								'type' => 'NUMERIC',
							),
							array(
								'key' => 'event_end_date',
								'value' => $now_time - 86399,
								'compare' => '>=',
								'type' => 'NUMERIC',
							),
						)
					)
				);
                $latest_publication = new WP_Query('post_type=publication&posts_per_page=1');
                $latest_slide_desks = new WP_Query('post_type=slide_decks&posts_per_page=2');
            } else {
                $latest_event = new WP_Query( array(
                    'post_type' => EASL_Event_Config::get_event_slug(),
                    'post_status'=> 'publish',
                    'posts_per_page' => 1,
					'order' => 'ASC',
					'orderby' => 'meta_value_num',
					'meta_key' => 'event_start_date',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'event_organisation',
							'value' => 1,
							'compare' => '=',
							'type' => 'NUMERIC',
						),
						array(
							'relation' => 'OR',
							array(
								'key' => 'event_start_date',
								'value' => $now_time - 86399,
								'compare' => '>=',
								'type' => 'NUMERIC',
							),
							array(
								'key' => 'event_end_date',
								'value' => $now_time - 86399,
								'compare' => '>=',
								'type' => 'NUMERIC',
							),
						),
					),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'event_topic',
                            'field' => 'slug',
                            'terms' => $filter,
                        )
                    ),
                ) );
                if(!in_array('general-hepatology', $filter) && !$latest_event->have_posts()){
	                $latest_event = new WP_Query( array(
		                'post_type' => EASL_Event_Config::get_event_slug(),
		                'post_status'=> 'publish',
		                'posts_per_page' => 1,
		                'order' => 'ASC',
		                'orderby' => 'meta_value_num',
		                'meta_key' => 'event_start_date',
		                'meta_query' => array(
			                'relation' => 'AND',
			                array(
				                'key' => 'event_organisation',
				                'value' => 1,
				                'compare' => '=',
				                'type' => 'NUMERIC',
			                ),
			                array(
				                'relation' => 'OR',
				                array(
					                'key' => 'event_start_date',
					                'value' => $now_time - 86399,
					                'compare' => '>=',
					                'type' => 'NUMERIC',
				                ),
				                array(
					                'key' => 'event_end_date',
					                'value' => $now_time - 86399,
					                'compare' => '>=',
					                'type' => 'NUMERIC',
				                ),
			                ),
		                ),
		                'tax_query' => array(
			                array(
				                'taxonomy' => 'event_topic',
				                'field' => 'slug',
				                'terms' => array('general-hepatology'),
			                )
		                ),
	                ) );
                }
                $latest_publication = new WP_Query( array(
                    'posts_per_page' => 1,
                    'post_type' => 'publication',
                    'post_status'=> 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'publication_topic',
                            'field' => 'slug',
                            'terms' => $filter,
                        )
                    ),
                    'orderby'=> 'ID',
                    'order' => 'DESC',
                ) );
                $latest_slide_desks = new WP_Query( array(
                    'posts_per_page' => 2,
                    'post_type' => 'slide_decks',
                    'post_status'=> 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'slide_decks_topic',
                            'field' => 'slug',
                            'terms' => $filter,
                        )
                    ),
                    'orderby'=> 'ID',
                    'order' => 'DESC',
                ) );
            }

            ob_start();
            ?>
            <div class="wpb_column vc_column_container vc_col-sm-4">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <a href="/events/calendar"
                           class="vcex-button theme-button inline animate-on-hover"
                           style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                            <span class="theme-button-inner">Events</span>
                        </a>
                        <div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>
                        <div class="easl-events-list-wrap">
                            <ul>
                                <?php
                                if($latest_event->have_posts()):
                                    while ($latest_event->have_posts()):
                                        $latest_event->the_post();
                                        $begining_date = new DateTime('@'.get_field('event_start_date'));
                                        $event_location_city = get_field('event_location_city');
                                        $event_country =  $country[get_field('event_location_country')];
                                        $topics = wp_get_post_terms(get_the_ID(), 'event_topic' );
                                        foreach ($topics as $topic):
                                            $topic_color = get_term_meta($topic->term_id, 'easl_tax_color', true);
                                        endforeach;
                                        if(!$topic_color):
                                            $topic_color = 'blue';
                                        endif;
                                        ?>
                                        <li class="easl-events-li easl-event-li-<?php echo $topic_color;?>">
                                            <h3><a title="<?php the_title_attribute();?>" href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h3>
                                            <a class="events-li-date" href="<?php echo get_permalink();?>">
                                                <span class="eld-day"><?php echo $begining_date->format('d'); ?></span>
                                                <span class="eld-mon"><?php echo $begining_date->format('M'); ?></span>
                                                <span class="eld-year"><?php echo $begining_date->format('Y'); ?></span>
                                                <i class="ticon ticon-play" aria-hidden="true"></i>
                                            </a>
                                            <p class="el-location">
                                                <span class="ell-name">Clinical School</span>
                                                <span class="ell-bar">|</span>
                                                <span class="ell-country"><?php echo $event_location_city;?>, <?php echo $event_country;?></span>
                                            </p>
                                        </li>
                                    <?php endwhile;?>
                                <?php endif;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-4"
                 style="border-right: 1px solid #dedede;border-left: 1px solid #dedede;">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <a href="/publications/"
                           class="vcex-button theme-button inline animate-on-hover"
                           style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                            <span class="theme-button-inner">Publication</span>
                        </a>
                        <div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>
                        <div class="wpb_wrapper">
                            <?php
                            if($latest_publication->have_posts()):
                                while ($latest_publication->have_posts()):
                                    $latest_publication->the_post();
                                    $image = has_post_thumbnail( get_the_ID() ) ?
                                        wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
                                    $topics = wp_get_post_terms(get_the_ID(), 'publication_topic' );
                                    foreach ($topics as $topic):
                                        $topic_color = get_term_meta($topic->term_id, 'easl_tax_color', true);
                                    endforeach;

                                    if(!$topic_color):
                                        $topic_color = 'blue';
                                    endif;
                                    ?>
                                    <div class="wpb_single_image wpb_content_element" style="float: left;margin-right: 15px;">
                                        <figure class="wpb_wrapper vc_figure">
                                            <div class="vc_single_image-wrapper   vc_box_border_grey">
                                                <?php if($image):?>
                                                    <img class="vc_single_image-img" style="height:107px;width:80px;"
                                                         src="<?php echo $image[0];?>"
                                                         width="80" height="107"
                                                         alt="<?php the_title_attribute();?>"
                                                         title="<?php the_title_attribute();?>">
                                                <?php endif;?>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="wpb_content_element">
                                        <h4 style="color: #666666;
                                    text-align: left;
                                    margin-left: 95px;
                                    border-left: 4px solid <?php echo $color_list[$topic_color];?>;
                                    padding-left: 8px;
                                    line-height: 14px;" class="vc_custom_heading"><?php echo get_field('publication_date');?></h4>
                                        <h2 style="font-size: 19px;
                                    color: #004b87;
                                    line-height: 24px;
                                    text-align: left;
                                    margin-left: 95px;
                                    padding-left: 8px;
                                    height: 45px;
                                    overflow: hidden;
                                    border-left: 4px solid <?php echo $color_list[$topic_color];?>;
                                    margin-bottom: 13px;"
                                            class="vc_custom_heading"><?php echo get_the_title();?></h2>
                                        <a href="<?php echo get_permalink();?>" class="vcex-button theme-button inline animate-on-hover"
                                           style="background: #71c5e8;
                                    color: #ffffff;
                                    font-size: 16px;
                                    border-radius: 0px;
                                    font-family: KnockoutHTF51Middleweight;
                                    padding: 5px 12px;"><span class="theme-button-inner">Read More</span></a>
                                    </div>
                                <?php endwhile;?>
                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
            <div class="wpb_column vc_column_container vc_col-sm-4">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <a href="/slide-decks/"
                           class="vcex-button theme-button inline animate-on-hover"
                           style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                            <span class="theme-button-inner">Slide Decks</span>
                        </a>
                        <div class="vc_empty_space" style="height: 24px">
                            <span class="vc_empty_space_inner"></span>
                        </div>
                        <?php

                        if($latest_slide_desks->have_posts()):
                            while ($latest_slide_desks->have_posts()):
                                $latest_slide_desks->the_post();
                                $topics = wp_get_post_terms(get_the_ID(), 'slide_decks_topic' );
                                foreach ($topics as $topic):
                                    $topic_color = get_term_meta($topic->term_id, 'easl_tax_color', true);
                                endforeach;

                                if(!$topic_color):
                                    $topic_color = 'blue';
                                endif;
                                ?>
                                <div class="wpb_content_element">
                                    <!--                        <h4 style="color: #666666;-->
                                    <!--    text-align: left;-->
                                    <!--    border-left: 4px solid #0b9490;-->
                                    <!--    padding-left: 8px;-->
                                    <!--    line-height: 14px;" class="vc_custom_heading">01 February 2018</h4>-->
                                    <a href="<?php echo get_field('slide-decks-file');?>">
                                        <h2 style="font-size: 19px;
    color: #004b87;
    line-height: 24px;
    text-align: left;
    padding-left: 8px;
    height: 42px;
    border-left: 4px solid <?php echo $color_list[$topic_color];?>;
    margin-bottom: 13px;"
                                            class="vc_custom_heading"><?php echo get_the_title();?></h2></a>
                                </div>
                            <?php endwhile;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            $html = ob_get_contents();
            ob_end_clean();
            echo $html;
            die();
        }
    }
}
new EASL_VC_HIGHLIGHTS;

add_action('wp_ajax_easl_get_highlights', array('EASL_VC_HIGHLIGHTS', 'load_highlights'));
add_action('wp_ajax_nopriv_easl_get_highlights', array('EASL_VC_HIGHLIGHTS', 'load_highlights'));
