<?php
$taxonomies = get_categories(['taxonomy' => 'slide_decks_category']);
$menu = '';
$tabs = '';
$counter = 0;
$taxonomies = get_terms( array(
    'taxonomy' => 'slide_decks_category',
    'hide_empty' => false,
    'orderby' => 'term_id',
    'order' => 'DESC',
    'fields' => 'id=>name',
) );


foreach ($taxonomies as $taxonomy_id => $taxonomy_name):
    $post_content = '';
    $coming_soon = '';

    $the_slide_decks = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type' => 'slide_decks',
        'tax_query' => array(
            array(
                'taxonomy' => 'slide_decks_category',
                'field' => 'term_id',
                'terms' => $taxonomy_id,
            )
        )
    ) );
    if ( $the_slide_decks->have_posts() ) {

        while ($the_slide_decks->have_posts()) {

            $the_slide_decks->the_post();

            $image = has_post_thumbnail(get_the_ID()) ?
                wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail') : '';

            $file_path = get_field('slide-decks-file');

            if($file_path){
                $post_content .= '<div class="wpb_column vc_column_container vc_col-sm-6" style="flex: 1 0 auto;">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_single_image wpb_content_element vc_align_">
                                            <figure class="wpb_wrapper vc_figure">
                                                <div class="vc_single_image-wrapper   vc_box_border_grey">
                                                    <img width="550" height="412"
                                                         src="'.$image[0].'"
                                                         class="vc_single_image-img attachment-full" alt=""
                                                         sizes="(max-width: 550px) 100vw, 550px">
                                                </div>
                                            </figure>
                                        </div>
                                        <div class="textcenter theme-button-wrap clr">
                                            <a href="'.get_field('slide-decks-file').'"
                                                class="vcex-button theme-button large align-center inline animate-on-hover"
                                                style="background:#184c83;color:#ffffff;" download=""><span
                                                    class="theme-button-inner">Download</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            } else {
                $coming_soon .= '<div class="wpb_column vc_column_container vc_col-sm-6" style="flex: 1 0 auto;">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_single_image wpb_content_element vc_align_">
                                            <figure class="wpb_wrapper vc_figure">
                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img
                                                            width="550" height="412"
                                                            src="'.$image[0].'"
                                                            class="vc_single_image-img attachment-full" alt=""
                                                            sizes="(max-width: 550px) 100vw, 550px"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>';
            }

        }
    }


    $menu .= '<li class="vc_tta-tab '.($counter < 1 ? 'vc_active' : '').'" data-vc-tab="">
                <a href="#tab-' . $taxonomy_id . '" data-vc-tabs="" data-vc-container=".vc_tta" tabindex="0" data-term="' . $taxonomy_id . '">
                    <span class="vc_tta-title-text">' . $taxonomy_name . '</span></a></li>';

    $tab_description = '<h2 style="color: #000000;text-align: left" class="vc_custom_heading">' . $taxonomy_name . ' slide decks</h2>
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <p>For any suggestions or questions please contact us: <a
                                                            href="mailto:Slidedeck_feedback@easloffice.eu?subject=slide decks on the ILC website">Slidedeck_feedback@easloffice.eu</a>
                                                </p>

                                            </div>
                                        </div>';

    $tabs .= '<div class="vc_tta-panel '.($counter < 1 ? 'vc_active' : '').'" id="tab-' . $taxonomy_id . '"
                     data-vc-content=".vc_tta-panel-body">
                    <div class="vc_tta-panel-heading">
                        <h4 class="vc_tta-panel-title">
                            <a href="#tab-' . $taxonomy_id . '" data-vc-accordion="" 
                            data-vc-container=".vc_tta-container"><span class="vc_tta-title-text">' . $taxonomy_name . '</span></a>
                        </h4>
                    </div>
                    <div class="vc_tta-panel-body">
                        <div class="vc_row wpb_row vc_inner vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        '.$tab_description.'
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex vc_row wpb_row vc_inner vc_row-fluid" style="flex-flow: wrap;">'.$post_content.'</div>';
    if($coming_soon){
        $tabs .= '<div class="d-flex vc_row wpb_row vc_inner vc_row-fluid" style="flex-flow: wrap;">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner ">
                                    <div class="wpb_wrapper">
                                        <h2 style="color: #000000;text-align: left; border-bottom: 1px solid #d1d1d1;" class="vc_custom_heading">Coming soon</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="vc_row wpb_row vc_inner vc_row-fluid">'.$coming_soon.'</div>';
    }
    $tabs .= '</div></div>';


    $counter++;

endforeach;
?>

<div class="vc_tta-container" data-vc-action="collapse">
    <div class="vc_general vc_tta vc_tta-tabs vc_tta-color-grey vc_tta-style-classic vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
        <div class="vc_tta-tabs-container">
            <ul class="vc_tta-tabs-list"><?php echo $menu;?></ul>
        </div>
        <div class="vc_tta-panels-container">
            <div class="vc_tta-panels">
                <?php echo $tabs;?>
            </div>
        </div>
    </div>
</div>
