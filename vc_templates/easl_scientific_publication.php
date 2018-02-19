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

$css_animation = $this->getCSSAnimation($css_animation);

if(!$view_all_text){
	$view_all_text = 'View all Events';
}

if($title && $view_all_link){
	$title .= '<a class="easl-events-all-link" href="'. esc_url($view_all_url) .'">' . $view_all_text . '</a>';
}
$top_filter = '
	<div class="easl-ec-filter-container">
		<div class="easl-ec-filter">
			<div class="ec-filter-search">
				<input type="text" name="ecf_search" value="" placeholder="Search for publication"/>
				<span class="ecs-icon"><i class="fa fa-search" aria-hidden="true"></i></span>
			</div>
			<h4>Filter Publications:</h4>
			<div class="easl-row">
				<div class="easl-col easl-col-3">
					<div class="easl-col-inner">
						<div class="easl-custom-select">
							<span class="ec-cs-label">Select a topic</span>
							<select name="ec-meeting-type">
								<option value="1">Topic 1</option>
								<option value="2">Topic 2</option>
								<option value="3">Topic 3</option>
								<option value="4">Topic 4</option>
								<option value="5">Topic 5</option>
								<option value="6">Topic 6</option>
							</select>
						</div>
					</div>
				</div>
				<div class="easl-col easl-col-3">
					<div class="easl-col-inner">
						<div class="easl-custom-select">
							<span class="ec-cs-label">Select publication</span>
							<select name="ec-meeting-type">
								<option value="1">Publication 1</option>
								<option value="2">Publication 2</option>
								<option value="3">Publication 3</option>
								<option value="4">Publication 4</option>
								<option value="5">Publication 5</option>
								<option value="6">Publication 6</option>
							</select>
						</div>
					</div>
				</div>
				<div class="easl-col easl-col-3">
					<div class="easl-col-inner">
						<div class="easl-custom-select">
							<span class="ec-cs-label">Select year</span>
							<select name="ec-meeting-type">
								<option value="1">2017</option>
								<option value="2">2016</option>
								<option value="3">2015</option>
								<option value="4">2014</option>
								<option value="5">2013</option>
								<option value="6">2012</option>
							</select>
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
		'. wpex_pagination($easl_query, false) .'
	</div>
	';

$rows = '';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-1.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 July 2017</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Hepatitis B, Hepatitis D</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">EASL 2017 clinical practice guidelines on the management of Hepatitis B virus infection</a>
			</h3>
			<p class="sp-excerpt">Hepatitis B virus (HBV) infection remains a global public health problem with changing epidemiology due to several factors including vaccination policies and migration. This Clinical Practice…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-2.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 June 2017</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Cholestatis, PBC & PSC</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">Roles of endoscopy in primary sclerosing cholangitis</a>
			</h3>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-3.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 May 2017</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Acute Liver Failure</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">Management of acute (fulminant) liver failure</a>
			</h3>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-4.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 April 2017</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Cholestatis, PBC & PSC</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">The diagnosis and management of patients with primary biliary cholangitis</a>
			</h3>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-5.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 December 2016</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Hepatitis C</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">EASL recommendations on treatment of Hepatitis C 2016</a>
			</h3>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-6.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 November 2017</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Non-HCC Liver tumors</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">The management of benign liver tumors</a>
			</h3>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';
$rows .= '
	<article class="scientific-publication clr">
		<div class="sp-thumb">
			<a href="'. get_permalink(175) . '" title=""><img alt="" src="http://easl.websitestage.co.uk/wp-content/uploads/2017/10/journal-7.jpg"/></a>
		</div>
		<div class="sp-content">
			<p class="sp-meta">
				<span class="sp-meta-date">01 Otober 2016</span>
				<span class=sp-meta-sep"> | </span>
				<span class="sp-meta-type">Topic:</span> 
				<span class="sp-meta-value">Gallstones</span>
			</p>
			<h3>
				<a href="'. get_permalink(175) . '">Prevention, diagnosis and treatment of gallstones</a>
			</h3>
			<p class="sp-excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisi augue, congue sed mollis quis, mollis ac odio. In tristique pharetra dictum. Proin placerat vestibulum erat, quis rhoncus augue lacinia nec. Phasellus pulvinar tellus sed tincidunt pharetra. Vestibulum vitae dictum enim…</p>
			<a class="easl-button" href="'. get_permalink(175) . '">Read More</a>
		</div>
	</article>
	';

$class_to_filter = 'wpb_easl_scientific_publication wpb_content_element ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$html = '<div class="easl-scientific-publication-wrap">
			'. $top_filter .'
			'. $pagination .'
			<div class="easl-scientific-publication-inner">
				'. $rows .'
			</div>
			'. $pagination .'
		</div>';

$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
$output = '
	<div ' . implode( ' ', $wrapper_attributes ) . ' class="' . esc_attr( trim( $css_class ) ) . '">
		' . wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_easl_widget_heading' ) ) . '
			' . $html . '
	</div>
';

echo $output;
wp_get_archives();