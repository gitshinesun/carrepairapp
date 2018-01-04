<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="features-main-options">
	<img class="hg_price_table_options_image" src="<?php echo esc_attr(HG_PRICING_TABLE_BUILDER_IMAGES_URL.'/pricing_table_img.jpg');?>" alt="user manual" />
	<div class="hg_free_overlay">
		<div>
			<?php _e( 'This section is available only for pro users. Please, upgrade your profile.', 'hg_pricing_table' ); ?>
			<a href="#"><?php _e( 'Go To Pro', 'hg_pricing_table' ); ?></a>
		</div>
	</div>
</div>