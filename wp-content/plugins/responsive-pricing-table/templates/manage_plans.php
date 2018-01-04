<?php wp_nonce_field( 'pricing_table_box', 'pricing_table_box_nonce' ); ?>
<p><span id='addNewPackage' class="button button-default"><?php _e( 'Add New Package' ); ?></span></p>
<div id="rpt_manage_plans">
	<?php if ( count( $rpt_info ) > 0 ): foreach ( $rpt_info as $rpt ): ?>

        <div data-id="closed" class="responsive-pricing-table-package shapla-toggle shapla-toggle--stroke">
			<span class="shapla-toggle-title">
				<?php esc_html_e( 'Package:', 'responsive-pricing-table' ); ?>
				<?php echo $rpt['package_title']; ?>
			</span>
            <div class="shapla-toggle-inner">
                <div class="shapla-toggle-content">
					<?php
					$this->text( array(
						'id'       => 'package_title',
						'name'     => __( 'Package Title', 'responsive-pricing-table' ),
						'multiple' => 'on',
						'std'      => $rpt['package_title'],
					) );
					$this->text( array(
						'id'       => 'recurrence',
						'name'     => __( 'Recurrence', 'responsive-pricing-table' ),
						'desc'     => __( 'eg. per month/year', 'responsive-pricing-table' ),
						'multiple' => 'on',
						'std'      => $rpt['recurrence'],
					) );
					$this->text( array(
						'id'       => 'price',
						'name'     => __( 'Price', 'responsive-pricing-table' ),
						'desc'     => __( 'With currency sign.', 'responsive-pricing-table' ),
						'multiple' => 'on',
						'std'      => $rpt['price'],
					) );
					$this->checkbox( array(
						'id'       => 'recommended',
						'class'    => 'is_recommended_package',
						'name'     => __( 'Recommended plan', 'responsive-pricing-table' ),
						'label'    => __( 'Mark as recommended ', 'responsive-pricing-table' ),
						'desc'     => __( 'Check this to highlight this plan.', 'responsive-pricing-table' ),
						'multiple' => 'on',
						'std'      => $rpt['recommended'],
					) );
					$this->text( array(
						'id'       => 'button_text',
						'name'     => __( 'Button text', 'responsive-pricing-table' ),
						'desc'     => __( 'eg. Buy Now', 'responsive-pricing-table' ),
						'multiple' => 'on',
						'std'      => $rpt['button_text'],
					) );
					$this->text( array(
						'id'       => 'button_url',
						'name'     => __( 'Button Link', 'responsive-pricing-table' ),
						'desc'     => __( 'eg. http://www.example.com', 'responsive-pricing-table' ),
						'multiple' => 'on',
						'std'      => $rpt['button_url'],
					) );
					$this->textarea( array(
						'id'       => 'features_list',
						'name'     => __( 'Features list', 'responsive-pricing-table' ),
						'desc'     => array(
							sprintf( '<strong>%s</strong>', __( 'One feature per line.', 'responsive-pricing-table' ) ),
							sprintf( '<strong>%s</strong><br>%s', __( 'Add links', 'responsive-pricing-table' ),
								esc_attr( '<a href="http://example.com">Example</a>' ) ),
							sprintf( '<strong>%s</strong><br>%s', __( 'Add bold text', 'responsive-pricing-table' ),
								esc_attr( '<strong>Something important</strong>' ) ),
						),
						'multiple' => 'on',
						'std'      => $rpt['features_list'],
					) );
					?>
                    <span class="deletePlan">Delete</span>
                </div>
            </div>
        </div>
	<?php endforeach; endif; ?>
</div>