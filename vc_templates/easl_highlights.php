<?php

wp_enqueue_script('highlights-script',
    get_stylesheet_directory_uri() . '/assets/js/easl-higlights.js',
    ['jquery'],
    false,
    true);

$color_list = [
    'blue' => '#165291',
    'red' => '#dc214e',
    'teal' => '#189790',
    'orrange ' => '#eb6018',
    'gray' => '#7e6a73',
    'yellow' => '#f9bc49',
];

?>
<style>
    .filter-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: calc(100% - 15px);
        height: 100%;
    }

    ul.current-filter {
        list-style: none;
        margin: 0 0 0px;
        position: relative;
        background-color: #f0f0f0;
        z-index: 3;
    }

    ul.current-filter li.current-active {
        position: relative;
    }

    ul.current-filter li.current-active:before {
        position: absolute;
        top: 8px;
        right: 12px;
        content: "\f107";
        display: block;
        font-size: 20px;
        line-height: 22px;
        font-family: 'FontAwesome';
        color: #78cdf2;
        z-index: 3;
    }

    ul.current-filter li.current-active a.theme-button {
        background-color: #f0f0f0;
        color: #004b87;
        display: block;
        padding-left: 22px;
        line-height: 22px;
    }

    a.theme-button {
        font-size: 16px;
        font-family: "KnockoutHTF51Middleweight", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    ul.current-filter li.current-active .filter-links-wrapper {
        display: none;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper {
        display: block;
    }

    ul.current-filter li.current-active .filter-links-wrapper ul.vcex-filter-links li {
        float: left;
        width: 100%;
        margin-right: 0px;
        margin-bottom: 0px;
        background-color: #ffffff;
        position: relative;
    }

    ul.current-filter li.current-active .filter-links-wrapper ul.vcex-filter-links li a.theme-button {
        background-color: transparent;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:hover {
        background-color: #f0f0f0;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links {
        box-shadow: 0px 0px 8px -2px rgba(0, 0, 0, 0.3);
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:after {
        display: block;
        position: absolute;
        top: 50%;
        left: 10px;
        transform: translateY(-50%);
        height: 60%;
        width: 4px;
        content: '';
    }

    ul.current-filter li.current-active:after {
        display: block;
        position: absolute;
        top: 6px;
        left: 10px;
        height: 26px;
        width: 4px;
        content: '';
        background-color: transparent;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-light-blue:after,
    ul.current-filter li.current-active.csic-light-blue:after {
        background-color: #71c4e8;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-blue:after,
    ul.current-filter li.current-active.csic-blue:after {
        background-color: #004b87;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-red:after,
    ul.current-filter li.current-active.csic-red:after {
        background-color: #dc224e;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-orrange:after,
    ul.current-filter li.current-active.csic-orrange:after {
        background-color: #f26a29;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-teal:after,
    ul.current-filter li.current-active.csic-teal:after {
        background-color: #0a9490;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-gray:after,
    ul.current-filter li.current-active.csic-gray:after {
        background-color: #866c74;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.csic-yellow:after,
    ul.current-filter li.current-active.csic-yellow:after {
        background-color: #f8bf3e;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li {
        padding: 0 10px;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li a.theme-button {
        border-bottom: 1px solid #dedede;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:last-child a.theme-button {
        border-bottom: none;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li.active {
        display: block;
        background: #f0f0f0;
    }

    .easl-border-bottom-custom {
        border-bottom: 1px solid #004b87;
        padding-bottom: 7px;
    }

    .px-0 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }


</style>
<div class="vc_row wpb_row vc_row-fluid vc_custom_1537605760398 wpex-vc_row-has-fill no-bottom-margins wpex-vc-reset-negative-margin easl-border-bottom-custom">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner px-0">
            <div class="wpb_wrapper">
                <div class="vc_row wpb_row vc_inner vc_row-fluid">
                    <div class="wpb_column vc_column_container vc_col-sm-6">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <h2 style="font-size: 30px;color: #004b87;line-height: 34px;text-align: left"
                                    class="vc_custom_heading">Highlights</h2></div>
                        </div>
                    </div>
                    <div class="wpb_column vc_column_container vc_col-sm-3">
                        <div class="vc_column-inner">
                            <div class="wpb_wrapper">
                                <h2 style="font-size: 18px;color: #004b87;line-height: 34px;text-align: right"
                                    class="vc_custom_heading">Select your field of expertise:</h2></div>
                        </div>
                    </div>
                    <div class="wpb_column vc_column_container vc_col-sm-3">
                        <div class="vc_column-inner ">
                            <div class="wpb_wrapper">
                                <div class="filter-wrapper">
                                    <ul class="current-filter">
                                        <li class="current-active csic-light-blue">
                                            <a href="#" data-filter="all" data-bgclass="csic-light-blue"
                                               class="highlight-filter-item theme-button csic-light-blue" style="padding-left: 22px;"><span>All Topics</span></a>
                                            <div class="filter-links-wrapper">
                                                <ul class="vcex-filter-links clr">
                                                    <li class="csic-light-blue active">
                                                        <a href="#" data-filter="all" data-bgclass="csic-light-blue"
                                                           class="highlight-filter-item theme-button csic-light-blue"><span>All Topics</span></a>
                                                    </li>
                                                    <?php
                                                    $topics = get_terms( array(
                                                        'taxonomy' => EASL_Event_Config::get_topic_slug(),
                                                        'hide_empty' => false,
                                                        'orderby' => 'term_id',
                                                        'order' => 'ASC',
                                                        'fields' => 'all',
                                                    ) );

                                                    foreach($topics as $topic):
                                                        $topic_color = get_term_meta($topic->term_id, 'easl_tax_color', true);
                                                        if(!$topic_color){
                                                            $topic_color = 'blue';
                                                        }
                                                        $topic_ccs = isset($topic_country_map[$topic->term_id]) ? $topic_country_map[$topic->term_id] : array();
                                                        ?>
                                                        <li class="filter-cat-<?php echo $topic->term_id;?> csic-<?php echo $topic_color;?>">
                                                            <a href="#" data-filter="<?php echo $topic->slug;?>"
                                                               data-bgclass="csic-<?php echo $topic_color;?>"
                                                               class="highlight-filter-item theme-button csic-<?php echo $topic_color;?>" ><?php echo esc_html($topic->name);?></a>
                                                        </li>

                                                    <?php endforeach;?>

                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>

<div class="vc_row wpb_row vc_row-fluid no-bottom-margins d-flex highlights-content">
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
                        $organisation = easl_event_get_organisations();
                        $country = easl_event_get_countries();

                        $latest_event = new WP_Query('post_type=event&posts_per_page=1');

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
                                        <i class="fa fa-play" aria-hidden="true"></i>
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
                <a href="/publications"
                   class="vcex-button theme-button inline animate-on-hover"
                   style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                    <span class="theme-button-inner">Publication</span>
                </a>
                <div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>
                <div class="wpb_wrapper">
                    <?php
                    $latest_publication = new WP_Query('post_type=publication&posts_per_page=1');
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
                                        <img class="vc_single_image-img " style="height:107px;width:80px;"
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
                                    border-left: 4px solid <?php echo $color_list[$topic_color]?>;
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
                                    border-left: 4px solid <?php echo $color_list[$topic_color]?>;
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
                <a href="/slide-decks"
                   class="vcex-button theme-button inline animate-on-hover"
                   style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                    <span class="theme-button-inner">Slide Decks</span>
                </a>
                <div class="vc_empty_space" style="height: 24px">
                    <span class="vc_empty_space_inner"></span>
                </div>
                <?php
                $latest_slide_desks = new WP_Query('post_type=slide_decks&posts_per_page=2');
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
                        <a href="<?php echo get_field('slide-decks-file');?>"><h2 style="font-size: 19px;
    color: #004b87;
    line-height: 24px;
    text-align: left;
    padding-left: 8px;
    height: 42px;
    border-left: 4px solid <?php echo $color_list[$topic_color]?>;
    margin-bottom: 13px;"
                            class="vc_custom_heading"><?php echo get_the_title();?></h2></a>
                    </div>
                <?php endwhile;?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
