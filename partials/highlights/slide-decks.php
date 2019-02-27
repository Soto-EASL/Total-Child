<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$sd_color = easl_get_slide_deck_topic_color(get_the_ID());
$download_link =  get_field('slide-decks-file');
?>
<li class="easl-color-<?php echo $sd_color; ?>"><a href="<?php echo esc_url($download_link); ?>" target="_blank"><?php the_title(); ?></a></li>