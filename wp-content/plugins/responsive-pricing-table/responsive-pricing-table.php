<?php
/**!
 * Plugin Name:         Responsive Pricing Table
 * Plugin URI:          http://wordpress.org/plugins/responsive-pricing-table/
 * Description:         Dynamic responsive pricing table for WordPress.
 * Version:             1.2.1
 * Author:              Sayful Islam
 * Author URI:          https://sayfulislam.com
 * Requires at least:   4.0
 * Tested up to:        4.8
 * Text Domain:         responsive-pricing-table
 * License:             GPLv3
 * License URI:         https://www.gnu.org/licenses/gpl-3.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Responsive_Pricing_Table' ) ):

	class Responsive_Pricing_Table {

		private $plugin_name = 'responsive-pricing-table';
		private $plugin_version = '1.2.1';
		protected static $instance = null;

		/**
		 * Main Responsive_Pricing_Table Instance
		 * Ensures only one instance of Responsive_Pricing_Table is loaded or can be loaded.
		 */
		public static function instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		public function __construct() {
			// define constants
			$this->define_constants();

			register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivate' ) );

			add_action( 'init', array( $this, 'load_textdomain' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ), 20 );

			$this->includes();
		}

		/**
		 * Define constants
		 */
		private function define_constants() {
			$this->define( 'RESPONSIVE_PRICING_TABLE_VERSION', $this->plugin_version );
			$this->define( 'RESPONSIVE_PRICING_TABLE_FILE', __FILE__ );
			$this->define( 'RESPONSIVE_PRICING_TABLE_PATH', dirname( RESPONSIVE_PRICING_TABLE_FILE ) );
			$this->define( 'RESPONSIVE_PRICING_TABLE_INCLUDES', RESPONSIVE_PRICING_TABLE_PATH . '/includes' );
			$this->define( 'RESPONSIVE_PRICING_TABLE_TEMPLATES', RESPONSIVE_PRICING_TABLE_PATH . '/templates' );
			$this->define( 'RESPONSIVE_PRICING_TABLE_URL', plugins_url( '', RESPONSIVE_PRICING_TABLE_FILE ) );
			$this->define( 'RESPONSIVE_PRICING_TABLE_ASSETS', RESPONSIVE_PRICING_TABLE_URL . '/assets' );
			$this->define( 'RESPONSIVE_PRICING_TABLE_UPLOAD_DIR', 'dcf-attachments' );
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
		 * Load plugin textdomain
		 */
		public function load_textdomain() {
			$locale_file = sprintf( '%1$s-%2$s.mo', 'responsive-pricing-table', get_locale() );
			$global_file = join( DIRECTORY_SEPARATOR, array( WP_LANG_DIR, 'responsive-pricing-table', $locale_file ) );

			// Look in global /wp-content/languages/carousel-slider folder
			if ( file_exists( $global_file ) ) {
				load_textdomain( $this->plugin_name, $global_file );
			}
		}

		public function includes() {
			if ( is_admin() ) {
				$this->admin_includes();
			}
			if ( ! is_admin() ) {
				$this->frontend_includes();
			}

			include_once RESPONSIVE_PRICING_TABLE_INCLUDES . '/Responsive_Pricing_Table_Activation.php';
		}

		public function admin_includes() {
			include_once RESPONSIVE_PRICING_TABLE_INCLUDES . '/Responsive_Pricing_Table_Form.php';
			include_once RESPONSIVE_PRICING_TABLE_INCLUDES . '/Responsive_Pricing_Table_Admin.php';

			new Responsive_Pricing_Table_Admin();
		}

		public function frontend_includes() {
			include_once RESPONSIVE_PRICING_TABLE_INCLUDES . '/Responsive_Pricing_Table_Shortcode.php';

			Responsive_Pricing_Table_ShortCode::init();
		}

		public function admin_scripts() {
			global $post_type;
			if ( 'pricing_tables' !== $post_type ) {
				return;
			}

			wp_enqueue_style(
				$this->plugin_name . '-admin',
				RESPONSIVE_PRICING_TABLE_ASSETS . '/css/admin.css',
				array(),
				RESPONSIVE_PRICING_TABLE_VERSION,
				'all'
			);

			wp_enqueue_script(
				$this->plugin_name . '-admin',
				RESPONSIVE_PRICING_TABLE_ASSETS . '/js/admin.js',
				array(
					'jquery',
					'jquery-ui-accordion',
					'jquery-ui-sortable'
				),
				RESPONSIVE_PRICING_TABLE_VERSION,
				true
			);
		}

		public function front_scripts() {
			wp_enqueue_style(
				$this->plugin_name,
				RESPONSIVE_PRICING_TABLE_ASSETS . '/css/style.css',
				array(),
				RESPONSIVE_PRICING_TABLE_VERSION,
				'all'
			);
		}

		/**
		 * Register plugin activation action for later use, and
		 * Flush rewrite rules on plugin activation
		 * @return void
		 */
		public function plugin_activation() {
			do_action( 'responsive_pricing_table_activation' );
			flush_rewrite_rules();
		}

		/**
		 * Flush rewrite rules on plugin deactivation
		 * @return void
		 */
		public function plugin_deactivate() {
			do_action( 'responsive_pricing_table_deactivate' );
			flush_rewrite_rules();
		}
	}

endif;

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
Responsive_Pricing_Table::instance();
