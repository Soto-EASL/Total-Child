<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$publication_date = get_field('publication_date');
$image = has_post_thumbnail( get_the_ID() ) ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ) : '';

$topic_color = easl_get_publication_topic_color(get_the_ID());
?>
<div class="easl-highlights-publications-item-inner easl-color-<?php echo $topic_color; ?><?php if(!has_post_thumbnail()){echo ' ehpi-nothumb';} ?>">
	<?php if(has_post_thumbnail()): ?>
		<figure><a href="<?php the_permalink(); ?>"><?php echo wpex_get_post_thumbnail(array('width' => 80, 'height' => 107, 'crop' => true, 'attachment' => get_post_thumbnail_id())); ?></a></figure>
	<?php endif; ?>
	<div class="easl-highlights-publications-date-title">
		<?php if($publication_date):     ?>
			<h4><?php echo $publication_date;?></h4>
		<?php endif; ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<a class="easl-generic-button easl-color-lightblue" href="<?php the_permalink() ?>"><?php _e('Read More', 'total-child'); ?><span class="easl-generic-button-icon"><span class="ticon ticon-chevron-right"></span></span></a>
	</div>
</div>