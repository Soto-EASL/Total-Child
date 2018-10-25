<?php

$taxonomies = get_categories(['taxonomy' => 'associations_category']);
$menu = '';
$counter = 0;
$first_point = '';

foreach ($taxonomies as $taxonomy):
    if($counter < 1){
        $first_point = $taxonomy->term_id;
    }
    $current_country = $counter < 1 ? 'current-country' : '';
    $menu .= '<div class="menu-item-block"><a style="color: #004b87;" class="national-associations-menu-item '.$current_country.'" href="#" data-term="'. $taxonomy->term_id.'">'. $taxonomy->name.' <i class="fa fa-angle-right"></i></a></div>';
    $counter++;
endforeach;

$the_associations = new WP_Query( array(
    'posts_per_page' => -1,
    'post_type' => 'associations',
    'tax_query' => array(
        array(
            'taxonomy' => 'associations_category',
            'field' => 'term_id',
            'terms' => $first_point,
        )
    )
) );


?>
<style>
    .menu-item-block {
        display: block;
        width: 50%;
        float: left;
    }
    .associations-thumb {
        width: 20%;
        margin-right: 25px;
    }
    .associations-content-block{
        background-color: #efefef;
    }
    .current-country{
        font-weight: 700;
    }
</style>
<div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-6">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <?php echo $menu;?>
            </div>
        </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-6 ">
        <div class="vc_column-inner associations-content-block">
            <div class="wpb_wrapper associations-content-block-response" style="padding: 15px">
                <?php if ( $the_associations->have_posts() ):
                    while ($the_associations->have_posts()) :
                        $the_associations->the_post();
                        $image = has_post_thumbnail( get_the_ID() ) ?
                        wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';?>
                        <div class="associations clr">
                            <div class="associations-content-wrapper">
                                <div class="d-flex">
                                    <?php echo ($image ? '<div class="associations-thumb"><img alt="" src="'.$image[0].'"></div>' : '')?>
                                    <div class="associations-title-wrap clr">
                                        <?php echo the_title('<h3>','</h3>');?>
                                        </div>
                                </div>
                                <div class="associations-content">
                                    <?php echo the_content();?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;?>
                <?php endif;?>

            </div>
        </div>
    </div>
</div>
