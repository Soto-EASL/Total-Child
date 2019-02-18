<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$preloaer_eanbled = wpex_get_mod( 'easl_enable_preloader' );
$preloaer_image_id   = wpex_get_mod( 'easl_preloader_image' );
$preloaer_image_src = '';
if($preloaer_image_id) {
	$preloaer_image_src = wp_get_attachment_image_src($preloaer_image_id, 'full');
	if($preloaer_image_src) {
		$preloaer_image_src = $preloaer_image_src[0];
    }
}

?>
<?php if ( $preloaer_eanbled && $preloaer_image_src ): ?>
    <div class="easl-preloader">
        <div class="easl-loading-image-con"><img src="<?php echo esc_url( $preloaer_image_src ); ?>" alt="<?php _e( 'Loading...', 'total-child' ); ?>"/></div>
    </div>
<?php endif; ?>