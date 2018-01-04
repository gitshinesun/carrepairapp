<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="plugin_version_features full-width">
	<div class="price-table-block">
	<?php
	if($hg_price_col_info_data['first_col_hide'] == "false"){
		$i = 0;
	} else {
		$i = 1;
	}
	$j = 0;
	for ( $i; $i < $hg_price_table_columns_count; $i ++ ) {
			?>
			<div class="hugeit_ft_col hugeit_features_name hg_ft_col_<?php echo $i; ?>">
				<?php
				if ( isset( $hg_pt_columns_data[$i]['highlight']) && $hg_pt_columns_data[$i]['highlight'] == $i ) {
					if ( preg_match_all( "/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[0]['highlight_text'] )) {
						preg_match_all( "/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[0]['highlight_text'], $matches );
						foreach ( $matches[1] as $key => $match ) {
							$hg_pt_columns_data[0]['highlight_text'] = str_replace( $matches[0][ $key ], '<i class="fa ' . $match . '" aria-hidden="true"></i>', $hg_pt_columns_data[0]['highlight_text'] );
						}
						echo '<div class="huge_it_best_seller"><span>' . $hg_pt_columns_data[0]['highlight_text'] . '</span></div>';
					} else {
						echo '<div class="huge_it_best_seller"><span>' . $hg_pt_columns_data[0]['highlight_text'] . '</span></div>';
					}
				}
				?>
				<h2 class="huge_it_features_head">
					<span>
					<?php
					if ( preg_match_all( "/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[ $i ]['head'] )) {
						preg_match_all( "/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[ $i ]['head'], $matches );
						foreach ( $matches[1] as $key => $match ) {
							$hg_pt_columns_data[ $i ]['head'] = str_replace( $matches[0][ $key ], '<i class="fa ' . $match . '" aria-hidden="true"></i>', $hg_pt_columns_data[ $i ]['head'] );
						}
						echo $hg_pt_columns_data[ $i ]['head'];
					} else {
						echo $hg_pt_columns_data[ $i ]['head'];
					} ?>
					</span>
				</h2>
				<?php
				foreach ($hg_pt_columns_data[$i] as $hg_pt_columns => $values) {

					if ($hg_pt_columns === "price") {
						if ($hg_price_col_info_data['hide_price_row'] == 'false') {
						?>
						<h3 class="huge_it_features_price">
							<span>
							<?php
							if ( preg_match_all( "/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[ $i ]['price'] )) {
								preg_match_all( "/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[ $i ]['price'], $matches );
								foreach ( $matches[1] as $key => $match ) {
									$hg_pt_columns_data[ $i ]['price'] = str_replace( $matches[0][ $key ], '<i class="fa ' . $match . '" aria-hidden="true"></i>', $hg_pt_columns_data[ $i ]['price'] );
								}
								echo $hg_pt_columns_data[ $i ]['price'];
							} else {
								echo $hg_pt_columns_data[ $i ]['price'];
							}
							?>
							</span>
						</h3>
						<?php
						}
					}
					if (is_array($values)) {
						?>
						<h3 class="huge_it_features_features">
							<span>
							<?php
							if ( preg_match_all( "/\[(fa-[^\]]*)\]/", $values['feature'] )) {
								preg_match_all( "/\[(fa-[^\]]*)\]/", $values['feature'], $matches );
	
								foreach ( $matches[1] as $key => $match ) {
									$values['feature'] = str_replace( $matches[0][ $key ], '<i class="fa ' . $match . '" aria-hidden="true"></i>', $values['feature'] );
								}
								echo $values['feature'];
	
							} else {
								echo $values['feature'];
							}
							?>
							</span>
						</h3>
						<?php
						$j++;
					}
					if ($hg_pt_columns === "button_text") {
						if ($hg_price_col_info_data['hide_button_row'] == 'false') {
							?>
							<h3 class="huge_it_features_buy_link">
								<span>
								<?php if($hg_pt_columns_data[$i]['button_text'] != "") { ?>
									<a class="huge_it_features_buy_link_a <?php if (isset($hg_pt_columns_data[$i]['highlight']) && intval($hg_pt_columns_data[$i]['highlight']) == $i && intval($hg_pt_columns_data[$i]['highlight']) != 0) {
										echo 'huge_it_best_seller_button';
									} ?>" href="<?php echo $hg_pt_columns_data[$i]['button_link']; ?>">
										<?php
										if (preg_match_all("/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[$i]['button_text'])) {
											preg_match_all("/\[(fa-[^\]]*)\]/", $hg_pt_columns_data[$i]['button_text'], $matches);
											foreach ($matches[1] as $key => $match) {
												$hg_pt_columns_data[$i]['button_text'] = str_replace($matches[0][$key], '<i class="fa ' . $match . '" aria-hidden="true"></i>', $hg_pt_columns_data[$i]['button_text']);
											}
											echo $hg_pt_columns_data[$i]['button_text'];
										} else {
											echo $hg_pt_columns_data[$i]['button_text'];
										}
										?>
									</a>
								<?php
								}
								?>
								</span>
							</h3>
							<?php
						}
					}
				}
				?>

			</div>
			<?php
	}

	?>
	<div class="clear"></div>
	</div>
</div>