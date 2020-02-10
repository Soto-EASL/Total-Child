<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$event_poster_image   = get_field( 'event_poster_image' );
$poster_download_link = get_field( 'poster_download_link' );

if ( $event_poster_image || $poster_download_link ):
	?>
    <div class="easl-small-event-sbitem easl-small-event-sbitem-countdown">
        <div class="easl-small-event-sbitem-inner">
            <div class="event-poster-image-box event-image-box-bg">
				<?php if ( $event_poster_image ): ?>
                    <div class="eib-image">
                        <img alt="" src="<?php echo $event_poster_image; ?>"/>
                    </div>
				<?php endif; ?>
				<?php if ( $event_poster_text ): ?>
                    <p><?php echo wp_kses( $event_poster_text, array(
							'br'   => array(),
							'span' => array(
								'style' => array(),
								'class' => array(),
							)
						) ); ?></p>
				<?php endif; ?>
				<?php if ( $poster_download_link && ! empty( $poster_download_link['url'] ) ): ?>
                    <a class="event-button event-button-icon event-button-light-blue event-button-icon-download event-image-box-full-button" href="<?php echo esc_url( $poster_download_link['url'] ); ?>" <?php if ( $poster_download_link['target'] ) {
						echo 'target="' . esc_attr( $poster_download_link['target'] ) . '"';
					} ?> download>
						<?php if ( ! empty( $poster_download_link['title'] ) ) {
							echo esc_html( $poster_download_link['title'] );
						}
						{
							_e( 'Download Poster', 'total-child' );
						} ?>
                    </a>
				<?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
