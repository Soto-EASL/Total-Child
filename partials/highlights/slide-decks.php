<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$sd_color = easl_get_slide_deck_topic_color(get_the_ID());
?>
<li class="easl-color-<?php echo $sd_color; ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>