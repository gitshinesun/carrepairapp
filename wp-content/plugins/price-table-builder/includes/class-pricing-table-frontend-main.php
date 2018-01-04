<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class HG_Pricing_Table_Builder_Frontend_Main {

	public function __construct() {
		$this->add_shortcode();
	}

	private function add_shortcode() {
		add_shortcode( 'hg_price_table', array( $this, 'frontend_view' ) );
	}

	public static function frontend_view( $atts, $content = null ) {

		$atts = shortcode_atts(
			array(
				'id' => '',
			), $atts
		);

		if ( isset( $atts['id'] ) && $atts['id'] != "" && get_post_status($atts['id']) && get_post_type($atts['id']) == "pricing_table") {
			$price_table_id = $atts['id'];
			
			do_action( 'price_table_shortcode_scripts', $atts['id'] );

			$hg_price_table_builder_data = get_post_meta( $price_table_id );

			if ( isset( $hg_price_table_builder_data ) ) {

                if(isset($hg_price_table_builder_data['hg_price_column']) && $hg_price_table_builder_data['hg_price_column'] != "") {
                    $hg_pt_columns_data = unserialize($hg_price_table_builder_data['hg_price_column'][0]);
                }

                if(isset($hg_price_table_builder_data['hg_price_col_info']) && $hg_price_table_builder_data['hg_price_col_info'] != "") {
                    $hg_price_col_info_data = unserialize($hg_price_table_builder_data['hg_price_col_info'][0]);
                    $hg_price_col_info_data = $hg_price_col_info_data[0];
                }

                if (isset($hg_price_table_builder_data['hg_price_table_columns_count'][0]) && $hg_price_table_builder_data['hg_price_table_columns_count'][0] != "") {
                    $hg_price_table_columns_count = intval($hg_price_table_builder_data['hg_price_table_columns_count'][0]);
                } else {
                    $hg_price_table_columns_count = 3;
                }

                if ( isset( $hg_price_table_builder_data['hg_price_table_column_options'] ) && $hg_price_table_builder_data['hg_price_table_column_options'] != "" ) {
                    $hg_price_table_column_options = unserialize( $hg_price_table_builder_data['hg_price_table_column_options'][0] );
                }

                ob_start();

				require( HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH . 'front/pricing_table_frontend.php' );

				require( HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH . 'styles/fronted_table_styles.php' );

			} else {
				echo "Write existing id";
			}
		} else {
			echo "Write existing and id of pricing_table";
		}

        return ob_get_clean();
	}
}

new HG_Pricing_Table_Builder_Frontend_Main;