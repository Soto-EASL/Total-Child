<?php

wp_enqueue_script('highlights-script',
    get_stylesheet_directory_uri() . '/assets/js/easl-higlights.js',
    ['jquery'],
    false,
    true);
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

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(1):after,
    ul.current-filter li.current-active.all-topic:after {
        background-color: #71c4e8;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(2):after,
    ul.current-filter li.current-active.general-hepatology:after {
        background-color: #004b87;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(3):after,
    ul.current-filter li.current-active.liver-tumors:after {
        background-color: #dc224e;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(4):after,
    ul.current-filter li.current-active.cholestatic:after {
        background-color: #f26a29;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(5):after,
    ul.current-filter li.current-active.metabolic:after {
        background-color: #0a9490;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(6):after,
    ul.current-filter li.current-active.cirrhosis:after {
        background-color: #866c74;
    }

    ul.current-filter:hover li.current-active .filter-links-wrapper ul.vcex-filter-links li:nth-child(7):after,
    ul.current-filter li.current-active.viral-hepatitis:after {
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
                                        <li class="current-active all-topic">
                                            <a href="#" data-filter="*"
                                               class="theme-button" style="padding-left: 22px;"><span>All Topics</span></a>
                                            <div class="filter-links-wrapper">
                                                <ul class="vcex-filter-links clr">
                                                    <li class="active">
                                                        <a href="#" data-filter="*" data-bgclass="all-topic"
                                                           class="theme-button"><span>All Topics</span></a>
                                                    </li>
                                                    <li class="filter-cat-41">
                                                        <a href="#" data-filter=".cat-41"
                                                           data-bgclass="general-hepatology"
                                                           class="theme-button">General Hepatology</a>
                                                    </li>
                                                    <li class="filter-cat-42">
                                                        <a href="#" data-filter=".cat-42" data-bgclass="liver-tumors"
                                                           class="theme-button">Liver Tumors</a>
                                                    </li>
                                                    <li class="filter-cat-43">
                                                        <a href="#" data-filter=".cat-43" data-bgclass="cholestatic"
                                                           class="theme-button">Cholestatic & Autoimmune</a>
                                                    </li>
                                                    <li class="filter-cat-44">
                                                        <a href="#" data-filter=".cat-44" data-bgclass="metabolic"
                                                           class="theme-button">Metabolic, Alcohol & Toxicity</a>
                                                    </li>
                                                    <li class="filter-cat-45">
                                                        <a href="#" data-filter=".cat-45" data-bgclass="cirrhosis"
                                                           class="theme-button">Cirrhosis & Complications</a>
                                                    </li>
                                                    <li class="filter-cat-46">
                                                        <a href="#" data-filter=".cat-46" data-bgclass="viral-hepatitis"
                                                           class="theme-button">Viral Hepatitis</a>
                                                    </li>
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

<div class="vc_row wpb_row vc_row-fluid no-bottom-margins d-flex">
    <div class="wpb_column vc_column_container vc_col-sm-4">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <a href="#"
                   class="vcex-button theme-button inline animate-on-hover"
                   style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                    <span class="theme-button-inner">Events</span>
                </a>
                <div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>
                <div class="easl-events-list-wrap">
                    <ul>

                        <li class="easl-events-li easl-event-li-red">
                            <h3>
                                <a title="" href="https://easl.websitestage.co.uk/event/test-event/">Test Event</a>
                            </h3>
                            <a class="events-li-date" href="">
                                <span class="eld-day">26</span>
                                <span class="eld-mon">NOV</span>
                                <span class="eld-year">2018</span>
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </a>
                            <p class="el-location">
                                <span class="ell-name">Clinical School</span>
                                <span class="ell-bar">|</span>
                                <span class="ell-country">
				United Kingdom (UK), London
				</span>
                            </p>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-4"
         style="border-right: 1px solid #dedede;border-left: 1px solid #dedede;">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <a href="#"
                   class="vcex-button theme-button inline animate-on-hover"
                   style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                    <span class="theme-button-inner">Publication</span>
                </a>
                <div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>
                <div class="wpb_wrapper">
                    <div class="wpb_single_image wpb_content_element" style="float: left;margin-right: 15px;">
                        <figure class="wpb_wrapper vc_figure">
                            <div class="vc_single_image-wrapper   vc_box_border_grey">
                                <img class="vc_single_image-img "
                                     src="https://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-2.jpg"
                                     width="80" height="100"
                                     alt="journal-2"
                                     title="journal-2">
                            </div>
                        </figure>
                    </div>
                    <div class="wpb_content_element">
                        <h4 style="color: #666666;
    text-align: left;
    margin-left: 95px;
    border-left: 4px solid #dc214e;
    padding-left: 8px;
    line-height: 14px;" class="vc_custom_heading">01 February 2018</h4>
                        <h2 style="font-size: 19px;
    color: #004b87;
    line-height: 24px;
    text-align: left;
    margin-left: 95px;
    padding-left: 8px;
    height: 42px;
    border-left: 4px solid #dc214e;
    margin-bottom: 13px;"
                            class="vc_custom_heading">Roles of endoscopy in primary sclerosis cholangitis</h2>
                        <a href="#" class="vcex-button theme-button inline animate-on-hover"
                           style="background: #71c5e8;
    color: #ffffff;
    font-size: 16px;
    border-radius: 0px;
    font-family: KnockoutHTF51Middleweight;
    padding: 5px 12px;"><span
                                    class="theme-button-inner">Read More</span></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-4">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <a href="#"
                   class="vcex-button theme-button inline animate-on-hover"
                   style="background:#f0f0f0;color:#004b87;padding: 0px 40px;">
                    <span class="theme-button-inner">Slide Desks</span>
                </a>
                <div class="vc_empty_space" style="height: 24px"><span class="vc_empty_space_inner"></span></div>

                    <div class="wpb_content_element">
                        <h4 style="color: #666666;
    text-align: left;
    border-left: 4px solid #0b9490;
    padding-left: 8px;
    line-height: 14px;" class="vc_custom_heading">01 February 2018</h4>
                        <h2 style="font-size: 19px;
    color: #004b87;
    line-height: 24px;
    text-align: left;
    padding-left: 8px;
    height: 42px;
    border-left: 4px solid #0b9490;
    margin-bottom: 13px;"
                            class="vc_custom_heading">Roles of endoscopy in primary sclerosis cholangitis</h2>
                    </div>
                <div class="wpb_content_element">
                    <h4 style="color: #666666;
    text-align: left;
    border-left: 4px solid #eb6018;
    padding-left: 8px;
    line-height: 14px;" class="vc_custom_heading">01 February 2018</h4>
                    <h2 style="font-size: 19px;
    color: #004b87;
    line-height: 24px;
    text-align: left;
    padding-left: 8px;
    height: 42px;
    border-left: 4px solid #eb6018;
    margin-bottom: 13px;"
                        class="vc_custom_heading">Roles of endoscopy in primary sclerosis cholangitis</h2>
                </div>

            </div>
        </div>
    </div>
</div>
