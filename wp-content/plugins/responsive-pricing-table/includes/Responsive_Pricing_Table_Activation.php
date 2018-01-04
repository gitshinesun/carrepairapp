<?php

if ( ! class_exists( 'Responsive_Pricing_Table_Activation' ) ) {

	class Responsive_Pricing_Table_Activation {

		private static $instance;

		/**
		 * @return Responsive_Pricing_Table_Activation
		 */
		public static function init() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Responsive_Pricing_Table_Activation constructor.
		 */
		public function __construct() {
			add_action( 'responsive_pricing_table_activation', array( $this, 'add_version_number' ) );
			add_action( 'responsive_pricing_table_activation', array( $this, 'upgrade_to_120' ) );
		}

		public function add_version_number() {
			update_option(
				'responsive_pricing_table_version',
				RESPONSIVE_PRICING_TABLE_VERSION,
				'no'
			);
		}

		/**
		 * Update meta box when upgrading to version 1.2.0
		 */
		public function upgrade_to_120() {

			$pricing_tables = get_posts( array(
				'post_type' => 'pricing_tables',
				'meta_key'  => 'responsive_pricing_table'
			) );

			if ( count( $pricing_tables ) > 0 ) {
				return;
			}

			$pricing_tables = get_posts( array(
				'post_type' => 'pricing_tables',
				'meta_key'  => '_table_packages'
			) );
			foreach ( $pricing_tables as $post ) {
				update_post_meta( $post->ID, "responsive_pricing_table", $this->package_data( $post->ID ) );
			}

		}

		/**
		 * @param $table_id
		 *
		 * @return array|mixed|object
		 */
		private function package_data( $table_id ) {
			$packages = get_post_meta( $table_id, "_table_packages", true );
			$packages = json_decode( $packages );

			$packages = array_map( function ( $id ) {
				$features = json_decode( get_post_meta( $id, "_package_features", true ) );

				return array(
					'package_title' => get_the_title( $id ),
					'recurrence'    => get_post_meta( $id, "_package_tenure", true ),
					'price'         => get_post_meta( $id, "_package_price", true ),
					'recommended'   => 'off',
					'button_text'   => get_post_meta( $id, "_package_buy_text", true ),
					'button_url'    => get_post_meta( $id, "_package_buy_link", true ),
					'features_list' => implode( "\n", $features ),
				);
			}, $packages );

			return $packages;
		}
	}
}

