<?php

/*

Plugin Name: Simple Background Manager
Description: An easy solution to background management
Version: 1.2
Author: vuzzu
Author URI: http://vuzzu.net/
Plugin URI: https://github.com/vuzzu/simple-background-manager
License: GPL v.2.0

*/

class Vuzzu_Simple_Background_Manager {


	function __construct() {

		add_action( 'plugins_loaded',	 	array( &$this, 'translation' ) );

    if( is_admin() ) {

			add_action( 'admin_init', array( $this, 'admin_register_settings' ) );

      require_once trailingslashit( plugin_dir_path( __FILE__ ) . "vendor" ) . '/vuzzu/utilizer-ui-elements/init.php';
      require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . "admin_view.php";

			add_action( 'admin_menu', array( $this, 'admin_panel' ) );
			add_action( 'add_meta_boxes', array( $this, 'admin_metabox' ) );
			add_action( 'save_post', array( $this, 'admin_save_filter' ) );

    } else {
			require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . "front_init.php";
			add_action('wp_head', 'vuzzu_sbm_load_background_manager_style');
			add_action('wp_print_scripts', 'vuzzu_sbm_load_background_manager_script');
		}

	}


	public function translation() {
		load_plugin_textdomain( 'sbm_terms', false, trailingslashit( plugin_dir_path( __FILE__ ) . 'languages' ) );
		$locale = get_locale();
		$locale_file = trailingslashit( plugin_dir_path( __FILE__ ) . 'languages' ) . $locale . ".php";
		if ( is_readable( $locale_file ) ) {
				require_once( $locale_file );
		}
	}


	public function admin_register_settings() {
    register_setting( 'sbm-settings-group', 'simple_background_manager_support_types' );
    register_setting( 'sbm-settings-group', 'simple_background_manager_fi_as_bi' );
    register_setting( 'sbm-settings-group', 'simple_background_manager_inherit_parent_settings' );
  }


	public function admin_panel() {

    add_options_page(
      __('Simple Background Manager Settings','sbm_terms'),
      __('Simple Background Manager','sbm_terms'),
      'manage_options',
      'sbm-settings',
      'vuzzu_sbm_admin_settings_view'
    );

  }


	public function admin_metabox() {

		$supported_post_types = get_option('simple_background_manager_support_types',array('post','page'));

		if( is_array($supported_post_types) ) :
			foreach ( $supported_post_types as $post_type ) :
				add_meta_box('sbm-background', __('Simple Background Manager','sbm_terms'), 'vuzzu_sbm_metabox_view', $post_type, 'side');
			endforeach;
		endif;

	}


	public function admin_save_filter($post_id) {

		$supported_post_types = get_option('simple_background_manager_support_types',array('post','page'));
		$background_manager_options = array();

		# In case not supported skip
		if( isset($_POST['post_type']) && !in_array($_POST['post_type'], $supported_post_types) ) {
			return $post_id;
		}

		# Set background color
		if( isset($_POST['sbm_bg_color']) && strlen($_POST['sbm_bg_color'])>0 )
		{
			$background_manager_options['color'] = $_POST['sbm_bg_color'];
		}

		# Set background color opacity
		if( isset($_POST['sbm_bg_color_opacity']) && $_POST['sbm_bg_color_opacity']>0 )
		{
			$background_manager_options['color_opacity'] = $_POST['sbm_bg_color_opacity'];
		}

		# Set background image
		if( isset($_POST['sbm_bg_img']) && strlen($_POST['sbm_bg_img'])>0 )
		{
			$background_manager_options['img'] = $_POST['sbm_bg_img'];
		}

		# Set background image repeatness
		if( isset($_POST['sbm_bg_img_repeat']) && $_POST['sbm_bg_img_repeat'] !== 'none' && strlen($_POST['sbm_bg_img_repeat'])>0 )
		{
			$background_manager_options['img_repeat'] = $_POST['sbm_bg_img_repeat'];
		}

		# Set background image fixed
		if( isset($_POST['sbm_bg_img_fixed']) && strlen($_POST['sbm_bg_img_fixed'])>0 )
		{
			$background_manager_options['img_fixed'] = $_POST['sbm_bg_img_fixed'];
		}

		# Finally update changes
		if( count($background_manager_options) > 0 )
		{
			update_post_meta( $post_id, 'sbm_background_manager', $background_manager_options );
		} else {
			delete_post_meta( $post_id, 'sbm_background_manager');
		}

	}


}

new Vuzzu_Simple_Background_Manager();
