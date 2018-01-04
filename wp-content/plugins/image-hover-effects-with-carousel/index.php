<?php
/*
  Plugin Name: Image Hover Effects with Carousel
  Author: Biplob Adhikari
  Plugin URI: https://wordpress.org/plugins/image-hover-effects-with-carousel/
  Description: Image Hover Effects with carousel Plugin For WordPress is all in one image hover effect solution for any kind of WordPress websites.
  Author URI: https://oxilab.org
  Version: 2.0
  License: GPLv2 or later
 */
if (!defined('ABSPATH'))
    exit;

$image_hover_with_carousel_version = '2.0';
define('image_hover_with_carousel_url', plugin_dir_path(__FILE__));
// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define('IMAGE_HOVER_WITH_CAROUSEL_HOME', 'https://www.oxilab.org'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of your product. This should match the download name in EDD exactly
define('IMAGE_HOVER_WITH_CAROUSEL', 'Image Hover with Carousel'); // you should use your own CONSTANT name, and be sure to replace it throughout this file
// the name of the settings page for the license input to be displayed
define('IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE', 'image-hover-with-carousel-license');

add_shortcode('ihewc_oxi', 'ihewc_oxi_shortcode');

include image_hover_with_carousel_url . 'public-data.php';

function ihewc_oxi_shortcode($atts) {
    extract(shortcode_atts(array('id' => ' ',), $atts));
    $styleid = $atts['id'];
    ob_start();
    ihewc_oxi_shortcode_function($styleid);
    return ob_get_clean();
}

add_action('admin_menu', 'image_hover_with_carousel_menu');

function image_hover_with_carousel_menu() {
    add_menu_page('Image Hover', 'Image Hover', 'manage_options', 'image-hover-carousel', 'image_hover_with_carousel_home');
    add_submenu_page('image-hover-carousel', 'Image Hover', 'Image Hover', 'manage_options', 'image-hover-carousel', 'image_hover_with_carousel_home');
    add_submenu_page('image-hover-carousel', 'New Effects', 'New Effects', 'manage_options', 'image-hover-carousel-new', 'image_hover_with_carousel_new');
    add_submenu_page('image-hover-carousel', 'Product License', 'Product License', 'manage_options', IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE, 'image_hover_with_carousel_license_page');
}

function image_hover_with_carousel_home() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include image_hover_with_carousel_url . 'home.php';
}

function image_hover_with_carousel_new() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    include image_hover_with_carousel_url . 'admin.php';
}

add_action('admin_head', 'add_image_hover_carousel_icons_styles');

function add_image_hover_carousel_icons_styles() {
    ?>
    <style>
        #adminmenu #toplevel_page_image-hover-carousel div.wp-menu-image:before {
            content: "\f115";
        }
    </style>

    <?php
}

register_activation_hook(__FILE__, 'image_hover_effects_with_carousel_install');

function image_hover_effects_with_carousel_install() {
    global $wpdb;
    global $image_hover_with_carousel_version;

    $table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
    $table_list = $wpdb->prefix . 'image_hover_with_carousel_list';

    $charset_collate = $wpdb->get_charset_collate();

    $sql1 = "CREATE TABLE $table_name (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                name varchar(50) NOT NULL,
                css text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_list (
		id mediumint(5) NOT NULL AUTO_INCREMENT,
                styleid mediumint(6) NOT NULL,
		title varchar(100),
                files varchar(400),
                buttom_text varchar(100),
                link varchar(500),
                image varchar(300),
                css varchar(500),
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql1);
    dbDelta($sql2);

    add_option('image_hover_with_carousel_version', $image_hover_with_carousel_version);
    set_transient('_Ihewc_image_hover_welcome_activation_redirect', true, 30);
}

add_filter('widget_text', 'do_shortcode');
include image_hover_with_carousel_url . 'widget.php';

function ihewc_html_special_charecter($data) {
    $data = str_replace("\'", "'", $data);
    $data = str_replace('\"', '"', $data);
    return $data;
}

function ihewc_font_familly_special_charecter($data) {
    $data = str_replace('+', ' ', $data);
    $data = explode(':', $data);
    $data = $data[0];
    $data = '"' . $data . '"';
    return $data;
}

//Visual Composer Data
if (!function_exists('is_plugin_active')) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}
if (is_plugin_active('js_composer/js_composer.php')) {
    add_action('vc_before_init', 'ihewc_oxi_VC_extension');
    add_shortcode('ihewc_oxi_VC', 'ihewc_oxi_VC_shortcode');

    function ihewc_oxi_VC_shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => ''
                        ), $atts));
        $styleid = $atts['id'];
        ob_start();
        ihewc_oxi_shortcode_function($styleid);
        return ob_get_clean();
    }

    function ihewc_oxi_VC_extension() {
        global $wpdb;
        $data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'image_hover_with_carousel_style ORDER BY id DESC', ARRAY_A);
        $vcdata = array();
        foreach ($data as $value) {
            $vcdata[] = $value['id'];
        }
        vc_map(array(
            "name" => __("Image Hover with Carousel"),
            "base" => "ihewc_oxi_VC",
            "category" => __("Content"),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => "Image Hover Select",
                    "param_name" => "id",
                    "value" => $vcdata,
                    'save_always' => true,
                    "description" => "Select your Image Hover ID",
                    "group" => 'Settings',
                ),
            )
        ));
    }

}

add_action('admin_init', 'Ihewc_image_hover_welcome_activation_redirect');

function Ihewc_image_hover_welcome_activation_redirect() {
    if (!get_transient('_Ihewc_image_hover_welcome_activation_redirect')) {
        return;
    }
    delete_transient('_Ihewc_image_hover_welcome_activation_redirect');
    if (is_network_admin() || isset($_GET['activate-multi'])) {
        return;
    }
    wp_safe_redirect(add_query_arg(array('page' => 'Ihewc-image-hover-effects-welcome'), admin_url('index.php')));
}

add_action('admin_menu', 'ihewc_image_hover_welcome_pages');

function ihewc_image_hover_welcome_pages() {
    add_dashboard_page(
            'Welcome To Image Hover Effects with Carousel', 'Welcome To Image Hover Effects with Carousel', 'read', 'Ihewc-image-hover-effects-welcome', 'ihewc_image_hover_effects_welcome'
    );
}

function ihewc_image_hover_effects_welcome() {
    wp_enqueue_style('ihewc-image-welcome-style', plugins_url('css-js/admin-welcome.css', __FILE__));
    ?>
    <div class="wrap about-wrap">

        <h1>Welcome to Image Hover Effects with Carousel</h1>
        <div class="about-text">
            Thank you for choosing image Hover Effects with Carousel - the most friendly WordPress Image Hover plugin. Here's how to get started.
        </div>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab nav-tab-active">
                Getting Started		
            </a>
        </h2>
        <p class="about-description">
            Use the tips below to get started using Image Hover Effects with Carousel. You will be up and running in no time.	
        </p>
        <div class="feature-section">
            <h3>Creating Your First Hover Effects</h3>
            <p>Image Hover Effects makes it easy to create Hover Effects in WordPress. You can follow the video tutorial on the right or read our how to 
                <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time/" target="_blank" rel="noopener">create your first Hover effects guide</a>.					</p>
            <p>But in reality, the process is so intuitive that you can just start by going to <a href="<?php echo admin_url(); ?>admin.php?page=image-hover-carousel-new">Image Hover - &gt; New Effects</a>.				</p>
            </br>
            </br>
            <iframe width="500" height="300" src="https://www.youtube.com/embed/44L2Q6ahOtI" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        </div>
        <div class="feature-section">
            <h3>See all Image Hover Effects with Carousel Features</h3>
            <p>Image Hover Effects with Carousel is both easy to use and extremely powerful. We have tons of helpful features that allows us to give you everything you need on Image Hover Effects.</p>
            <p>1. Awesome Live Preview Panel</p>
            <p>1. Can Customize with Our Settings</p>
            <p>1. Easy to USE & Builtin Integration for popular Page Builder</p>
            <p><a href="https://www.oxilab.org/downloads/image-hover-with-carousel/" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">See all Features</a></p>

        </div>
        <div class="feature-section">
            <h3>Have any Bugs or Suggestion</h3>
            <p>Your suggestions will make this plugin even better, Even if you get any bugs on Image Hover Effects with Carousel so let us to know, We will try to solved within few hours</p>
            <p><a href="https://www.oxilab.org/contact-us" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Contact Us</a>
                <a href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel" target="_blank" rel="noopener" class="ihewc-image-features-button button button-primary">Support Forum</a></p>

        </div>

    </div>
    <?php
}

add_action('admin_head', 'ihewc_image_hover_welcome_screen_remove_menus');

function ihewc_image_hover_welcome_screen_remove_menus() {
    remove_submenu_page('index.php', 'Ihewc-image-hover-effects-welcome');
}

// load our custom updater
include( dirname(__FILE__) . '/Plugin_Updater.php' );

function image_hover_with_carousel_plugin_updater() {
    $license_key = trim(get_option('image_hover_with_carousel_license_key'));
    // retrieve our license key from the DB
    // setup the updater
    $image_hover_with_carousel_updater = new IMAGE_HOVER_WITH_CAROUSEL_Plugin_Updater(IMAGE_HOVER_WITH_CAROUSEL_HOME, __FILE__, array(
        'version' => '2.0', // current version number
        'license' => $license_key, // license key (used get_option above to retrieve from DB)
        'item_name' => IMAGE_HOVER_WITH_CAROUSEL, // name of this plugin
        'author' => 'Biplob Adhikari', // author of this plugin
        'beta' => false
            )
    );
}

$status = get_option('image_hover_with_carousel_license_status');
if ($status == 'valid') {
    add_action('admin_init', 'image_hover_with_carousel_plugin_updater', 0);
}

/* * **********************************
 * the code below is just a standard
 * options page. Substitute with
 * your own.
 * *********************************** */

function image_hover_with_carousel_license_page() {
    $license = get_option('image_hover_with_carousel_license_key');
    $status = get_option('image_hover_with_carousel_license_status');
    ?>
    <div class="wrap">
        <h2><?php _e('Product License Activation'); ?></h2>
        <p>Activate your copy to get direct plugin updates and official support.</p>
        <form method="post" action="options.php">

    <?php settings_fields('image_hover_with_carousel_license'); ?>

            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
    <?php _e('License Key'); ?>
                        </th>
                        <td>
                            <input id="image_hover_with_carousel_license_key" name="image_hover_with_carousel_license_key" type="text" class="regular-text" value="<?php esc_attr_e($license); ?>" />
                            <label class="description" for="image_hover_with_carousel_license_key"><?php _e('Enter your license key'); ?></label>
                        </td>
                    </tr>
    <?php if (false !== $license) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
        <?php _e('Activate License'); ?>
                            </th>
                            <td>
        <?php if ($status !== false && $status == 'valid') { ?>
                                    <span style="color:green;"><?php _e('active'); ?></span>
                                    <?php wp_nonce_field('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce'); ?>
                                    <input type="submit" class="button-secondary" name="image_hover_with_carousel_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
                                    <?php
                                } else {
                                    wp_nonce_field('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce');
                                    ?>
                                    <input type="submit" class="button-secondary" name="image_hover_with_carousel_license_activate" value="<?php _e('Activate License'); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
    <?php } ?>
                </tbody>
            </table>
    <?php submit_button(); ?>

        </form>
    <?php
}

function image_hover_with_carousel_register_option() {
    // creates our settings in the options table
    register_setting('image_hover_with_carousel_license', 'image_hover_with_carousel_license_key', 'image_hover_with_carousel_sanitize_license');
}

add_action('admin_init', 'image_hover_with_carousel_register_option');

function image_hover_with_carousel_sanitize_license($new) {
    $old = get_option('image_hover_with_carousel_license_key');
    if ($old && $old != $new) {
        delete_option('image_hover_with_carousel_license_status'); // new license has been entered, so must reactivate
    }
    return $new;
}

/* * **********************************
 * this illustrates how to activate
 * a license key
 * *********************************** */

function image_hover_with_carousel_activate_license() {

    // listen for our activate button to be clicked
    if (isset($_POST['image_hover_with_carousel_license_activate'])) {

        // run a quick security check
        if (!check_admin_referer('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce'))
            return; // get out if we didn't click the Activate button








            
// retrieve the license from the database
        $license = trim(get_option('image_hover_with_carousel_license_key'));


        // data to send in our API request
        $api_params = array(
            'edd_action' => 'activate_license',
            'license' => $license,
            'item_name' => urlencode(IMAGE_HOVER_WITH_CAROUSEL), // the name of our product in EDD
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(IMAGE_HOVER_WITH_CAROUSEL_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

        // make sure the response came back okay
        if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

            if (is_wp_error($response)) {
                $message = $response->get_error_message();
            } else {
                $message = __('An error occurred, please try again.');
            }
        } else {

            $license_data = json_decode(wp_remote_retrieve_body($response));

            if (false === $license_data->success) {

                switch ($license_data->error) {

                    case 'expired' :

                        $message = sprintf(
                                __('Your license key expired on %s.'), date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                        );
                        break;

                    case 'revoked' :

                        $message = __('Your license key has been disabled.');
                        break;

                    case 'missing' :

                        $message = __('Invalid license.');
                        break;

                    case 'invalid' :
                    case 'site_inactive' :

                        $message = __('Your license is not active for this URL.');
                        break;

                    case 'item_name_mismatch' :

                        $message = sprintf(__('This appears to be an invalid license key for %s.'), IMAGE_HOVER_WITH_CAROUSEL);
                        break;

                    case 'no_activations_left':

                        $message = __('Your license key has reached its activation limit.');
                        break;

                    default :

                        $message = __('An error occurred, please try again.');
                        break;
                }
            }
        }

        // Check if anything passed on a message constituting a failure
        if (!empty($message)) {
            $base_url = admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE);
            $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

            wp_redirect($redirect);
            exit();
        }

        // $license_data->license will be either "valid" or "invalid"

        update_option('image_hover_with_carousel_license_status', $license_data->license);
        wp_redirect(admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE));
        exit();
    }
}

add_action('admin_init', 'image_hover_with_carousel_activate_license');


/* * *********************************************
 * Illustrates how to deactivate a license key.
 * This will decrease the site count
 * ********************************************* */

function image_hover_with_carousel_deactivate_license() {

    // listen for our activate button to be clicked
    if (isset($_POST['image_hover_with_carousel_license_deactivate'])) {

        // run a quick security check
        if (!check_admin_referer('image_hover_with_carousel_nonce', 'image_hover_with_carousel_nonce'))
            return; // get out if we didn't click the Activate button








            
// retrieve the license from the database
        $license = trim(get_option('image_hover_with_carousel_license_key'));


        // data to send in our API request
        $api_params = array(
            'edd_action' => 'deactivate_license',
            'license' => $license,
            'item_name' => urlencode(IMAGE_HOVER_WITH_CAROUSEL), // the name of our product in EDD
            'url' => home_url()
        );

        // Call the custom API.
        $response = wp_remote_post(IMAGE_HOVER_WITH_CAROUSEL_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

        // make sure the response came back okay
        if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

            if (is_wp_error($response)) {
                $message = $response->get_error_message();
            } else {
                $message = __('An error occurred, please try again.');
            }

            $base_url = admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE);
            $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

            wp_redirect($redirect);
            exit();
        }

        // decode the license data
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // $license_data->license will be either "deactivated" or "failed"
        if ($license_data->license == 'deactivated') {
            delete_option('image_hover_with_carousel_license_status');
        }

        wp_redirect(admin_url('admin.php?page=' . IMAGE_HOVER_WITH_CAROUSEL_LICENSE_PAGE));
        exit();
    }
}

add_action('admin_init', 'image_hover_with_carousel_deactivate_license');


/* * **********************************
 * this illustrates how to check if
 * a license key is still valid
 * the updater does this for you,
 * so this is only needed if you
 * want to do something custom
 * *********************************** */

function image_hover_with_carousel_check_license() {

    global $wp_version;

    $license = trim(get_option('image_hover_with_carousel_license_key'));

    $api_params = array(
        'edd_action' => 'check_license',
        'license' => $license,
        'item_name' => urlencode(IMAGE_HOVER_WITH_CAROUSEL),
        'url' => home_url()
    );

    // Call the custom API.
    $response = wp_remote_post(IMAGE_HOVER_WITH_CAROUSEL_HOME, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

    if (is_wp_error($response))
        return false;

    $license_data = json_decode(wp_remote_retrieve_body($response));

    if ($license_data->license == 'valid') {
        echo 'valid';
        exit;
        // this license is still valid
    } else {
        echo 'invalid';
        exit;
        // this license is no longer valid
    }
}

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function image_hover_with_carousel_admin_notices() {
    if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {

        switch ($_GET['sl_activation']) {

            case 'false':
                $message = urldecode($_GET['message']);
                ?>
                    <div class="error">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php
                    break;

                case 'true':
                default:
                    // Developers can put a custom success message here for when activation is successful if they way.
                    break;
            }
        }
    }

    add_action('admin_notices', 'image_hover_with_carousel_admin_notices');
    