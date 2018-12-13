<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$title = __('Share this page', 'total-child');
$sites = array();

$data_attrs = array();

$social_share_data = wpex_get_social_share_data( wpex_get_current_post_id(), $sites );

foreach ( $social_share_data as $datak => $datav ) {
	$data_attrs['data-' . $datak ] = $datav;
}


wp_enqueue_script( 'wpex-social-share' );
?>
<div class="easl-social-share-icons">
	<?php if($title): ?>
	<h5><?php echo $title; ?></h5>
	<?php endif; ?>
	<div class="wpex-social-share easl-social-share" <?php echo wpex_parse_attrs( $data_attrs ); ?>>
		<ul class="social-share clr">
			<li class="wpex-twitter">
				<a role="button" tabindex="1" href=""><span class="hexagon"></span><i class="fa fa-twitter" aria-hidden="true"></i></a>
			</li>
			<li class="wpex-facebook">
				<a role="button" tabindex="1" href=""><span class="hexagon"></span><i class="fa fa-facebook" aria-hidden="true"></i></a>
			</li>
			<li class="wpex-linkedin">
				<a href=""><span class="hexagon"></span><i class="fa fa-linkedin" aria-hidden="true"></i></a>
			</li>
		</ul>
	</div>
</div>