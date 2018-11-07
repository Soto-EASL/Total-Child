<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$atts = vc_map_get_attributes( 'easl_awardees', $atts );
//var_dump($atts);

$awardees = new WP_Query( array(
    'posts_per_page' => -1,
    'post_type' => 'staff',
    'post_status'=> 'publish',
    'tax_query' => array(
        array(
            'taxonomy' => 'staff_tag',
            'field' => 'term_id',
            'terms' => explode(',',$atts['include_tags']),
            'operator' => 'AND',
        )
    ),
    'orderby'=> 'ID',
    'order' => 'DESC',
) );

$staff_col_width = $atts['staff_col_width'];
switch ($staff_col_width){
    case '1':
        $vc_col_width = 'vc_col-sm-12';
        break;
    case '2':
        $vc_col_width = 'vc_col-sm-6';
        break;
    case '3':
        $vc_col_width = 'vc_col-sm-4';
        break;
    case '4':
        $vc_col_width = 'vc_col-sm-3';
        break;
    default:
        $vc_col_width = 'vc_col-sm-4';
}

if ( $awardees->have_posts() ):
    $counter = 0;
?>
<div class="vc_row wpb_row vc_inner vc_row-fluid">
    <?php
    while ($awardees->have_posts()):

        $awardees->the_post();
        $image = has_post_thumbnail( get_the_ID() ) ?
            wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';
        $avatar_src = $image ? $image[0] : '/wp-content/uploads/2018/10/default-avatar.png';
		
		$awardee_profile_link = get_field('recognition_awardee_profile_link');
		
        ?>

        <div class="wpb_column vc_column_container <?php echo $vc_col_width;?>">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <div class="wpb_single_image wpb_content_element vc_align_ ">
                        <figure class="wpb_wrapper vc_figure">
                            <div class="vc_single_image-wrapper   vc_box_border_grey">
								<?php if($awardee_profile_link): ?>
								<a href="<?php echo esc_url($awardee_profile_link['url']); ?>" <?php if($awardee_profile_link['target']){ echo 'target="'. esc_attr($awardee_profile_link['target']) .'"';} ?>>
								<?php endif; ?>
                                <img width="254" height="254" src="<?php echo $avatar_src;?>"
                                     class="vc_single_image-img attachment-full" alt=""
                                     sizes="(max-width: 254px) 100vw, 254px">
								<?php if($awardee_profile_link): ?></a><?php endif; ?>
                            </div>
                        </figure>
                    </div>

                    <div style="color:#104e85;font-family:KnockoutHTF51Middleweight;font-size:19px;"
                         class="wpb_text_column has-custom-color wpb_content_element  recognition-link">
                        <div class="wpb_wrapper">
                            <p><?php echo the_title();?></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php endif;?>
