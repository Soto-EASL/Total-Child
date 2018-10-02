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
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css_animation = $this->getCSSAnimation($css_animation);

if (!$view_all_text) {
    $view_all_text = 'View all Events';
}

if ($title && $view_all_link) {
    $title .= '<a class="easl-events-all-link" href="' . esc_url($view_all_url) . '">' . $view_all_text . '</a>';
}
$top_filter = '
	<div class="vc_row wpb_row vc_inner vc_row-fluid" style="background-color:#f3f3ee!important; padding-top: 30px; margin-bottom: 30px;border: 3px solid #004b87;">
	<div class="wpb_column vc_column_container vc_col-sm-4">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="wpb_raw_code wpb_content_element wpb_raw_html">
					<div class="wpb_wrapper">
						<div class="easl-col-inner">
							<div class="easl-col-inner">
		    <style>
		        body{
		            background-color: #ffffff !important;
		        }
                .easl-custom-checkbox:after {
                    background: transparent;
                    content: "\f00c";
                    color: #fff;
                    font-family: FontAwesome;
                    font-size: 11px;
                    position: absolute;
                    left: 0;
                    top: 1px;
                    opacity: 0;
                    width: 20px;
                    height: 20px;
                    line-height: 20px;
                    text-align: center;
                    z-index: 2;
                    -webkit-transition: opacity 0.15s linear;
                    -moz-transition: opacity 0.15s linear;
                    transition: opacity 0.15s linear;
                }
                .easl-custom-checkbox:before {
                    content: "";
                    width: 20px;
                    height: 20px;
                    position: absolute;
                    left: 0;
                    top: 0;
                    z-index: 1;
                    background-color: #f0f0f0;
                }
                .ec-filter-topics li{
                    list-style: none;
                }
                .ec-filter-search input {
                    background: #ffffff;
                    color: #666;
                    display: block;
                    width: 100%;
                    height: 40px;
                    line-height: 18px;
                    font-size: 16px;
                    z-index: 2;
                }
                .easl-custom-select {
                    position: relative;
                    height: 40px;
                    background: #ffffff;
                    line-height: 40px;
                    padding: 0 40px 0 10px;
                    color: #004b87;
                    font-size: 14px;
                    cursor: pointer;
                }
                .ec-filter-search .ecs-icon {
                    color: #004b87;
                    position: absolute;
                    right: 0;
                    top: 0;
                    height: 40px;
                    padding: 0 10px;
                    font-size: 24px;
                    line-height: 40px;
                }
                .publication-filter-button {
                    background-color: #f3f3ee;
                    font-size: 14px;
                    padding: 0;
                    color: #004b87;
                    font-family: "KnockoutHTF51Middleweight", "Helvetica Neue", Helvetica, Arial, sans-serif;
                }
                .publication-filter-button:hover{
                background-color: #f3f3ee;
                color: #004b87;
                }
                .entry ul, .entry ol {
                    margin: 0 0 0 0;
                }
                .ec-filter-topics li{
                margin-bottom: 5px;
                }
                .scientific-publication .sp-thumb a {
                    display: block;
                    line-height: 1rem;
                }
            </style>
                <h4 style="font-size: 21px;border-bottom: 1px solid #d7d7d7;">Show me:</h4>
                <ul class="ec-filter-topics">						
                    <li>
                        <label class="easl-custom-checkbox easl-cb-all csic-light-blue easl-active">
                            <input type="checkbox" name="ec_filter_topics[]" value="" checked="checked"> <span>All Topics</span>
                        </label>
                    </li>
                
                    <li>
                        <label class="easl-custom-checkbox csic-blue">
                            <input type="checkbox" name="ec_filter_topics[]" value="16" data-countries="[&quot;DE&quot;,&quot;FR&quot;,&quot;GB&quot;,&quot;RO&quot;]"> <span>General hepatology</span>
                        </label>
                    </li>
                    
                    <li>
                        <label class="easl-custom-checkbox csic-red">
                            <input type="checkbox" name="ec_filter_topics[]" value="17" data-countries="[&quot;CH&quot;,&quot;ES&quot;,&quot;HU&quot;,&quot;IT&quot;,&quot;PT&quot;,&quot;SI&quot;]"> <span>Liver tumours</span>
                        </label>
                    </li>
                    
                    <li>
                        <label class="easl-custom-checkbox csic-orrange">
                            <input type="checkbox" name="ec_filter_topics[]" value="18" data-countries="[&quot;NO&quot;]"> <span>Cholestasis and autoimmune</span>
                        </label>
                    </li>
                    
                    <li>
                        <label class="easl-custom-checkbox csic-teal">
                            <input type="checkbox" name="ec_filter_topics[]" value="19" data-countries="[&quot;BE&quot;]"> <span>Metabolism, alcohol and toxicity</span>
                        </label>
                    </li>
                    
                    <li>
                        <label class="easl-custom-checkbox csic-gray">
                            <input type="checkbox" name="ec_filter_topics[]" value="20" data-countries="[&quot;ES&quot;,&quot;GB&quot;]"> <span>Cirrhosis and complications</span>
                        </label>
                    </li>
                    
                    <li>
                        <label class="easl-custom-checkbox csic-yellow">
                            <input type="checkbox" name="ec_filter_topics[]" value="21" data-countries="[&quot;DE&quot;,&quot;NL&quot;]"> <span>Viral hepatitis</span>
                        </label>
                    </li>                    
                </ul>
            </div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="wpb_column vc_column_container vc_col-sm-8">
		<div class="vc_column-inner ">
			<div class="wpb_wrapper">
				<div class="wpb_raw_code wpb_content_element wpb_raw_html">
					<div class="wpb_wrapper">
						<div class="easl-col-inner" >
							<div class="ec-filter-search">
								<input type="text" name="ecf_search" value="" placeholder="Search for publication"/>
								<span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
							</div>
							<h4 style="font-size: 21px">Filter Publications:</h4>

							<div class="easl-custom-select" style="margin-bottom: 15px;">
								<span class="ec-cs-label">Select a year</span>
								<select name="ec-meeting-type" placeholder="Select a year">
									<option value="">Select a year</option>
									<option value="2018">2018</option>
									<option value="2017">2017</option>
									<option value="2016">2016</option>
									<option value="2015">2015</option>
									<option value="2014">2014</option>
									<option value="2013">2013</option>
									<option value="2012">2012</option>
									<option value="2011">2011</option>
									<option value="2010">2010</option>
								</select>
							</div>
							<h4 style="font-size: 18px">Take me to:</h4>
							<button class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Clinical Practice Guidelines<span
                                            class="vcex-icon-wrap theme-button-icon-right"><span
                                                class="fa fa-angle-right"></span></span></span></button>
                            <button class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Journal of Hepatology<span
                        class="vcex-icon-wrap theme-button-icon-right"><span
                            class="fa fa-angle-right"></span></span></span></button>
                            <button class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Jhep Report<span
                        class="vcex-icon-wrap theme-button-icon-right"><span
                            class="fa fa-angle-right"></span></span></span></button>
                            <button class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">EU Publication<span
                        class="vcex-icon-wrap theme-button-icon-right"><span
                            class="fa fa-angle-right"></span></span></span></button>
                            <button class="vcex-button theme-button inline animate-on-hover wpex-dhover-0 publication-filter-button">Patient Documents<span
                        class="vcex-icon-wrap theme-button-icon-right"><span
                            class="fa fa-angle-right"></span></span></span></button>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>	
	';
$easl_query = new WP_Query();
$easl_query->max_num_pages = 5;
$pagination = '
	<div class="easl-ec-pagination-container">
		' . wpex_pagination($easl_query, false) . '
	</div>
	';

$rows = '';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-1.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #0b9490;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 July 2017</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Hepatitis B, Hepatitis D</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">EASL 2017 clinical practice guidelines on the management of Hepatitis B virus infection</a>
                </h3>
			</div>
			<p class="sp-excerpt">Hepatitis B virus (HBV) infection remains a global public health problem with changing epidemiology due to several factors including vaccination policies and migration. This Clinical Practice…</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-2.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #dc214e;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 June 2017</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Cholestasis, PBC & PSC</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">Roles of endoscopy in primary sclerosing cholangitis</a>
                </h3>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-3.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #0b9490;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 May 2017</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Acute Liver Failure</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">Management of acute (fulminant) liver failure</a>
                </h3>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-4.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #f8bf3e;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 April 2017</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Cholestasis, PBC & PSC</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">The diagnosis and management of patients with primary biliary cholangitis</a>
                </h3>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-5.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #866d75;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 December 2016</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Hepatitis C</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">EASL recommendations on treatment of Hepatitis C 2016</a>
                </h3>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-6.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #004b87;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 November 2016</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Non-HCC Liver tumours</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">The management of benign liver tumours</a>
                </h3>
			</div>
			<p class="sp-excerpt">Benign liver tumours are a heterogeneous group of lesions with different
                                                cellular origins, as summarized by an international panel of experts
                                                sponsored by the World Congress of Gastroenterology in 1994.</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="' . get_permalink(175) . '" title=""><img alt="" src="' . EASL_HOME_URL . '/wp-content/uploads/2017/10/journal-7.jpg"/></a>
		</div>
		<div class="sp-content">
		    <div class="color-delimeter" style="border-left: 5px solid #dc214e;padding-left: 10px;">
                <p class="sp-meta">
                    <span class="sp-meta-date">01 Otober 2016</span>
                    <span class=sp-meta-sep"> | </span>
                    <span class="sp-meta-type">Topic:</span> 
                    <span class="sp-meta-value">Gallstones</span>
                </p>
                <h3>
                    <a href="' . get_permalink(175) . '">Prevention, diagnosis and treatment of gallstones</a>
                </h3>
			</div>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="' . get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';

$class_to_filter = 'wpb_easl_scientific_publication wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);


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
