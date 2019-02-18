<?php

$page_link = remove_query_arg('nas_id');

$current_country_id = !empty($_GET['nas_id']) ? absint($_GET['nas_id']) : '';

$the_associations = false;
if($current_country_id){
    $the_associations = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type' => 'associations',
        'tax_query' => array(
            array(
                'taxonomy' => 'associations_category',
                'field' => 'term_id',
                'terms' => array($current_country_id),
            )
        )
    ) );
}

?>
<div class="nas-container easl-row easl-row-same-height-col<?php if ( $the_associations && $the_associations->have_posts() ){echo ' nas-loaded';} ?>">
    <div class="easl-col easl-col-2">
        <div class="easl-col-inner nas-country-lists clr">
            <?php
            $countries = get_categories(['taxonomy' => 'associations_category']);
            foreach ($countries as $country):
             ?>
                <div class="menu-item-block"><a class="national-associations-menu-item<?php if($current_country_id === $country->term_id){echo ' nas-current';} ?>" href="<?php echo add_query_arg(array('nas_id' => $country->term_id), $page_link); ?>" data-term="<?php echo $country->term_id; ?>"><?php echo  $country->name; ?> <i class="ticon ticon-angle-right"></i></a></div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="easl-col easl-col-2">
        <div class="easl-col-inner associations-content-block">
            <div class="associations-content-block-response">
                <?php
                if ( $the_associations && $the_associations->have_posts() ):
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
                                    <?php the_content();?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;?>
                <?php endif;?>
            </div>
            <div class="easl-sd-load-icon"><img class="easl-loading-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/images/easl-loader.gif"/></div>
        </div>
    </div>
</div>
