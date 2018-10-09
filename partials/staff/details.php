<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$post = get_post( get_the_ID() );

$img_path = '';
if ( has_post_thumbnail( $post->ID ) ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'staff_grid' );
	if ( $image ) {
		$img_path = $image[ 0 ];
	}
}
$terms = get_the_terms( $post->ID, 'staff_category' );
?>
<div class="profile-block-wrapper">
	<div class="vc_row wpb_row vc_row-fluid">
		<div class="wpb_column vc_column_container vc_col-sm-8">
			<div class="vc_column-inner custom-margin-0">
				<div class="wpb_wrapper">
					<div class="easl-member-profile">
						<div class="easl-member-profile-header vc_clearfix">
							<div class="sp-thumb">
								<img style="max-width: 250px;" alt='' src='<?php echo $img_path ? $img_path : get_theme_file_uri( 'images/default-avatar.png' ); ?>' class='avatar avatar-121 photo'/>
							</div>
							<div class="sp-content">
								<h2 class="easl-member-profile-name"><?php the_title(); ?></h2>
								<?php if ( $terms ): ?>
									<?php foreach ( $terms as $term ): ?>
										<h4 class="easl-member-profile-position"><?php echo $term->name; ?></h4>
									<?php endforeach; ?>
								<?php endif; ?>
								<p class="sp-excerpt"><?php echo $post->post_excerpt ? $post->post_excerpt : ''; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="wpb_column vc_column_container vc_col-sm-4">
			<div class="vc_column-inner custom-margin-0">
				<div class="wpb_wrapper">
					<div class="easl-member-profile-details">
						<div class="easl-profile-details-item">
							<div class="easl-row">
								<div class="easl-col easl-col-2">
									<h4 class="easl-profile-details-item-title">tel:</h4>
									<p class="easl-profile-details-item-content"><?php echo get_field( 'telephone', $post->ID ); ?></p>
								</div>
							</div>
						</div>
						<div class="easl-profile-details-item">
							<div class="easl-row">
								<div class="easl-col easl-col-1">
									<h4 class="easl-profile-details-item-title">email:</h4>
									<p class="easl-profile-details-item-content"><?php echo get_field( 'email', $post->ID ); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="vc_row wpb_row vc_row-fluid">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner custom-margin">
				<div class="wpb_wrapper">
					<div class="easl-member-profile-description vc_clearfix"><?php echo $post->post_content; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>