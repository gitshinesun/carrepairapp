<?php
/**
 * Install Functionality
 *
 * @package   Login Designer
 * @author    Rich Tabor from ThatPluginCompany
 * @license   GPL-3.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Install
 *
 * Runs on plugin install by setting up the Login Designer template.
 * After successful install, the user is redirected to the Customizer.
 *
 * @global $wpdb
 * @global $login_designer_options
 * @param  bool|bool $network_wide If the plugin is being network-activated.
 * @return void
 */
function login_designer_install( $network_wide = false ) {
	global $wpdb;

	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	if ( is_multisite() && $network_wide ) {

		foreach ( $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs LIMIT 100" ) as $blog_id ) {
			switch_to_blog( $blog_id );
			login_designer_run_install();
			restore_current_blog();
		}

	} else {

		login_designer_run_install();

	}

}
register_activation_hook( LOGIN_DESIGNER_PLUGIN_FILE, 'login_designer_install' );

/**
 * Run the Login Designer install process
 *
 * @return void
 */
function login_designer_run_install() {

	// Set up options.
	$options = array();

	// Pull options from WP.
	$admin_options = get_option( 'login_designer_settings', array() );

	// Checks if the Login Designer page option exists.
	$login_designer_page = array_key_exists( 'login_designer_page', $admin_options ) ? get_post( $admin_options['login_designer_page'] ) : false;

	if ( empty( $login_designer_page ) ) {

		// Array of allowed HTML in the page content.
		$allowed_html_array = array(
			'a' => array(
				'href'   => array(),
				'target' => array(),
			),
		);

		$post_content = sprintf( wp_kses( __( '<p>This page is used by <a href="%1$s">%2$s</a> to preview the login forms in the Customizer. Please don\'t delete this page. Thanks!</p>', 'login-designer' ), $allowed_html_array ), 'https://logindesigner.com', 'Login Designer' );

		// Create the page.
		$page = wp_insert_post(
			array(
				'post_title'     => 'Login Designer',
				'post_content'   => $post_content,
				'post_status'    => 'draft',
				'post_author'    => 1,
				'post_type'      => 'page',
				'comment_status' => 'closed',
			)
		);

		$options['login_designer_page'] = $page;
	}

	$page = isset( $page ) ? $page : $admin_options['login_designer_page'];

	$merged_options = array_merge( $admin_options, $options );
	$admin_options  = $merged_options;

	update_option( 'login_designer_settings', $admin_options );

	// Assign the Login Designer template.
	login_designer_attach_template_to_page( $page, 'template-login-designer.php' );
}

/**
 * When a new Blog is created in multisite, see if Login Designer is network activated, and run the installer
 *
 * @param int|int     $blog_id The Blog ID created.
 * @param int|int     $user_id The User ID set as the admin.
 * @param string      $domain The URL.
 * @param string      $path Site Path.
 * @param int|int     $site_id The Site ID.
 * @param array|array $meta Blog Meta.
 * @return void
 */
function login_designer_new_blog_created( $blog_id, $user_id, $domain, $path, $site_id, $meta ) {

	if ( is_plugin_active_for_network( plugin_basename( LOGIN_DESIGNER_PLUGIN_FILE ) ) ) {

		switch_to_blog( $blog_id );
		login_designer_install();
		restore_current_blog();

	}

}
add_action( 'wpmu_new_blog', 'login_designer_new_blog_created', 10, 6 );

/**
 * Attaches the specified template to the page identified by the specified name.
 *
 * @param int|int $page The id of the page to attach the template.
 * @param int|int $template The template's filename (assumes .php' is specified).
 *
 * @returns -1 if the page does not exist; otherwise, the ID of the page.
 */
function login_designer_attach_template_to_page( $page, $template ) {

	// Only attach the template if the page exists.
	if ( -1 !== $page ) {
		update_post_meta( $page, '_wp_page_template', $template );
	}

	return $page;
}
