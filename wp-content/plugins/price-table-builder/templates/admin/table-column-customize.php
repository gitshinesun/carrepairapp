<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
$hg_price_table_builder_data = get_post_meta( $post->ID );

if ( isset( $hg_price_table_builder_data['hg_price_table_column_options'] ) && $hg_price_table_builder_data['hg_price_table_column_options'] != "" ) {
	$hg_price_table_column_options = unserialize( $hg_price_table_builder_data['hg_price_table_column_options'][0] );
}

?>
<div class="huge_it_features_columns_customize" data-column-id="<?php echo $i; ?>">
	<div class="huge_it_features_column_customize_block">
		<div class="hg_col_customize_bg_color">
			<label class="color_picker_label features-label" for="column_<?php echo $i; ?>_background_color"><?php _e('Background Color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="column_<?php echo $i; ?>_background_color" name="hg_price_table_column_options[<?php echo $i; ?>][background_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['background_color'] ) && $hg_price_table_column_options[ $i ]['background_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['background_color'];
			} else {
				echo '#fff';
			} ?> "/>
		</div>
		<div class="hg_col_customize_header_text_color">
			<label class="color_picker_label features-label" for="column_<?php echo $i; ?>_header_text_color"><?php _e('Header Text Color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="column_<?php echo $i; ?>_header_text_color" name="hg_price_table_column_options[<?php echo $i; ?>][header_text_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['header_text_color'] ) && $hg_price_table_column_options[ $i ]['header_text_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['header_text_color'];
			} else {
				echo '#565656';
			} ?> "/>
		</div>
		<div class="hg_col_customize_price_color">
			<label class="color_picker_label features-label" for="column_<?php echo $i; ?>_price_text_color"><?php _e('Price Text Color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="column_<?php echo $i; ?>_price_text_color" name="hg_price_table_column_options[<?php echo $i; ?>][price_text_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['price_text_color'] ) && $hg_price_table_column_options[ $i ]['price_text_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['price_text_color'];
			} else {
				echo '#9f9f9f';
			} ?> "/>
		</div>
		<div class="hg_col_customize_awesome_icon_color">
			<label class="color_picker_label features-label" for="column_<?php echo $i; ?>_awesome_icon_color"><?php _e('Font Awesome icons color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="column_<?php echo $i; ?>_awesome_icon_color" name="hg_price_table_column_options[<?php echo $i; ?>][awesome_icon_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['awesome_icon_color'] ) && $hg_price_table_column_options[ $i ]['awesome_icon_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['awesome_icon_color'];
			} else {
				echo '#9f9f9f';
			} ?> "/>
		</div>
		<div class="hg_col_customize_features_color">
			<label class="color_picker_label features-label" for="column_<?php echo $i; ?>_features_color"><?php _e('Features Text Color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="column_<?php echo $i; ?>_features_color" name="hg_price_table_column_options[<?php echo $i; ?>][features_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['features_color'] ) && $hg_price_table_column_options[ $i ]['features_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['features_color'];
			} else {
				echo '#2d3d4f';
			} ?> "/>
		</div>
		<div class="hg_col_customize_column_border_color">
			<label class="color_picker_label features-label" for="column_<?php echo $i; ?>_border_color"><?php _e('Column Border Color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="column_<?php echo $i; ?>_border_color" name="hg_price_table_column_options[<?php echo $i; ?>][column_border_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['column_border_color'] ) && $hg_price_table_column_options[ $i ]['column_border_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['column_border_color'];
			} else {
				echo '#ccc';
			} ?> "/>
		</div>
		<div class="hg_col_customize_row_border_color">
			<label class="color_picker_label features-label" for="row_<?php echo $i; ?>_border_color"><?php _e('Row Border Color', 'hg_pricing_table'); ?></label>
			<input class="jscolor" type="text" id="row_<?php echo $i; ?>_border_color" name="hg_price_table_column_options[<?php echo $i; ?>][row_border_color]" value="<?php if ( isset( $hg_price_table_column_options[ $i ]['row_border_color'] ) && $hg_price_table_column_options[ $i ]['row_border_color'] != "" ) {
				echo $hg_price_table_column_options[ $i ]['row_border_color'];
			} else {
				echo '#ccc';
			} ?> "/>
		</div>
		<div class="features-main-options customize-pro-options-block">
			<img class="hg_price_table_options_image" src="<?php echo esc_attr(HG_PRICING_TABLE_BUILDER_IMAGES_URL.'/customize-options.jpg');?>" alt="user manual" />
			<div class="hg_free_overlay">
				<div>
					<a href="#"><?php _e( 'Go To Pro', 'hg_pricing_table' ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<span class="huge_it_features_open_customize_block"><?php _e('Customize', 'hg_pricing_table'); ?><span class="hg-arrow-down"></span></span>
</div>