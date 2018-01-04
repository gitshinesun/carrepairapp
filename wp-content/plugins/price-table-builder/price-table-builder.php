<?php

/*
Plugin Name: Huge IT Price Table Builder
Plugin URI: https://huge-it.com/wordpress-price-table-builder/
Description: Price table builder is a beautiful price builder plugin for WordPress. Use multiple options to showcase your pricing table.
Version: 1.0.1
Author: Huge-IT
Author URI: http://huge-it.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: hg_price_table
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'HG_Price_Table_Builder' ) ) :
	final class HG_Price_Table_Builder {

		/**
		 * Version of plugin
		 * @var String
		 */
		public $version = "1.0.1";

		/**
		 * Instance of hg_price_table_builder_Admin class to manage admin
		 * @var HG_Price_Table_Builder instance
		 */
		public $admin = null;

		/**
		 * The single instance of the class.
		 *
		 * @var HG_Price_Table_Builder
		 */
		protected static $_instance = null;

		/**
		 * Main HG_PRICING_TABLE Instance.
		 *
		 * Ensures only one instance of HG_PRICING_TABLE is loaded or can be loaded.
		 *
		 * @static
		 * @see HG_PRICING_TABLE()
		 * @return HG_Price_Table_Builder - Main instance.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		private function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'hg_price_table' ), '2.1' );
		}

		/**
		 * Unserializing instances of this class is forbidden.
		 */
		private function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'hg_price_table' ), '2.1' );
		}

		public function __construct() {
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
			$this->admin_hooks();
			do_action( 'hg_pricing_table_builder_loaded' );
		}

		private function init_hooks() {
			add_action( 'init', array( $this, 'price_table_builder_type' ) );
		}

		/**
		 * Define HG_PRICING_TABLE_BUILDER Constants.
		 */
		private function define_constants() {
			$this->define( 'HG_PRICING_TABLE_BUILDER_PLUGIN_FILE', __FILE__ );
			$this->define( 'HG_PRICING_TABLE_BUILDER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'HG_PRICING_TABLE_BUILDER_VERSION', $this->version );
			$this->define( 'HG_PRICING_TABLE_BUILDER_IMAGES_PATH', $this->plugin_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR );
			$this->define( 'HG_PRICING_TABLE_BUILDER_IMAGES_URL', untrailingslashit( $this->plugin_url() . '/assets/images/' ) );
			$this->define( 'HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH', $this->plugin_path() . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR );
			$this->define( 'HG_PRICING_TABLE_BUILDER_TEMPLATES_URL', untrailingslashit( $this->plugin_url() ) . '/templates/' );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param  string $name
		 * @param  string|bool $value
		 */
		private function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * What type of request is this?
		 * string $type ajax, frontend or admin.
		 *
		 * @return bool
		 */
		private function is_request( $type ) {
			switch ( $type ) {
				case 'admin' :
					return is_admin();
				case 'ajax' :
					return defined( 'DOING_AJAX' );
				case 'cron' :
					return defined( 'DOING_CRON' );
				case 'frontend' :
					return  ! is_admin() && ! defined( 'DOING_CRON' );
			}
		}

		public function includes() {

			if ( $this->is_request( 'admin' ) ) {
				include_once( 'includes/admin/class-hg-pricing-table-admin.php' );
				include_once( 'includes/admin/class-hg-pricing-table-admin-assets.php' );
				include_once( 'includes/admin/class-hg-pricing-table-builder-save.php' );
			}

			if ( $this->is_request( 'frontend' ) ) {
				$this->frontend_includes();
			}
		}

		/**
		 * Include required core files used in front end
		 */
		public function frontend_includes() {
			include_once( 'includes/class-hg-pricing-table-frontend-assets.php' );
			include_once( 'includes/class-pricing-table-frontend-main.php' );
		}

		public function price_table_builder_type() {
			register_post_type( 'pricing_table',
				array(
					'labels'      => array(
						'name'               => __( 'Price Table Builder', 'hg_pricing_table' ),
						'singular_name'      => __( 'Price Table Builder', 'hg_pricing_table' ),
						'add_new'            => __( 'Add New Price Table', 'hg_pricing_table' ),
						'not_found'          => __( 'No Price Table Found.', 'hg_pricing_table' ),
						'not_found_in_trash' => __( 'No Price Table found in Trash.', 'hg_pricing_table' ),
                        'edit_item'          => __('Edit Price Table', 'hg_pricing_table'),
                        'add_new_item'       => __('Add Price Table', 'hg_pricing_table')
					),
					'public'             => true,
                    'publicly_queryable' => false,
                    'show_in_admin_bar'  => false,
					'has_archive'        => true,
					'supports'           => array( 'title' ),
				)
			);
		}

        public function admin_hooks() {
            add_action( 'admin_menu', array( $this, 'sub_menu_pages' ) );
        }

        public function sub_menu_pages() {
            add_submenu_page('edit.php?post_type=pricing_table', __('Featured Plugins', 'hg_pricing_table'), __('Featured Plugins', 'hg_pricing_table'), 'manage_options', 'price_table_featured_plugins', array($this, 'featured_plugins_page_html'));
            add_submenu_page('edit.php?post_type=pricing_table', __('Licensing', 'hg_pricing_table'), __('Licensing', 'hg_pricing_table'), 'manage_options', 'price_table_licencing', array($this, 'licensing_page_html'));
        }

        public function featured_plugins_page_html(){
            require 'templates/admin/featured-plugins.php';
        }

        public function licensing_page_html(){
            require 'templates/admin/licensing.php';
        }

		/**
		 * Easy Login Plugin Path.
		 *
		 * @var string
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Easy Login Plugin Url.
		 * @return string
		 */
		public function plugin_url() {
			return plugins_url( '', __FILE__ );
		}
	}

endif;

function HG_Price_Table_Builder() {
    return HG_Price_Table_Builder::instance();
}

$GLOBALS['hg_price_table_builder'] = HG_Price_Table_Builder();