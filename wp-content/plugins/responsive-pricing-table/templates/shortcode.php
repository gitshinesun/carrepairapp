<div id="table-<?php echo $table_id; ?>" class="responsive_pricing_table">
	<?php foreach ( $packages as $package ): ?>
        <div class="responsive_pricing_table-item responsive_pricing_table-col-<?php echo $columns; ?> <?php echo $package['recommended'] == 'on' ? 'recommended' : ''; ?>">
            <h3 class="responsive_pricing_table-title">
				<?php echo esc_attr( $package['package_title'] ); ?>
            </h3><!-- Title -->
            <div class="responsive_pricing_table-price">
                <div class="responsive_pricing_table-price-figure">
                    <span class="responsive_pricing_table-price-number">
                        <?php echo esc_attr( $package['price'] ); ?>
                    </span>
                    <span class="responsive_pricing_table-price-tenure">
                        <?php echo esc_attr( $package['recurrence'] ); ?>
                    </span>
                </div>
            </div><!-- Price -->
            <ul class="responsive_pricing_table-features">
				<?php foreach ( explode( "\n", $package['features_list'] ) as $feature ): ?>
                    <li><?php echo $feature; ?></li>
				<?php endforeach; ?>
            </ul>
            <div class="responsive_pricing_table-footer">
                <a href="<?php echo esc_url( $package['button_url'] ); ?>" class="responsive_pricing_table-link"
                   rel="nofollow"><?php echo esc_attr( $package['button_text'] ); ?></a>
            </div>
        </div>
	<?php endforeach; ?>
</div>
