<?php
/**
 * Plugin Name: Contact Form Builder
 * Plugin URI: https://web-dorado.com/products/wordpress-contact-form-builder.html
 * Description: Contact Form Builder is an advanced plugin to add contact forms into your website. It comes along with multiple default templates which can be customized.
 * Version: 1.0.64
 * Author: WebDorado
 * Author URI: https://web-dorado.com/wordpress-plugins-bundle.html
 * License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
define('WD_CFM_DIR', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define('WD_CFM_URL', plugins_url(plugin_basename(dirname(__FILE__))));
define('WD_CFM_VERSION', '1.0.64');
define('WD_CFM_PREFIX', 'cfm');
define('WD_CFM_NICENAME', __( 'Contact Form Builder', WD_CFM_PREFIX ));

// Plugin menu.
function contact_form_maker_options_panel() {
  $parent_slug = null;
  if( get_option( "fmc_subscribe_done" ) == 1 ) {
    add_menu_page('CForm Builder', 'CForm Builder', 'manage_options', 'manage_cfm', 'contact_form_maker', WD_CFM_URL . '/images/contact_form_maker_logo16.png');
    $parent_slug = 'manage_cfm';
  }

  $manage_page = add_submenu_page($parent_slug, __('Manager', 'contact_form_maker'), __('Manager', 'contact_form_maker'), 'manage_options', 'manage_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $manage_page, 'contact_form_maker_manage_styles');
  add_action('admin_print_scripts-' . $manage_page, 'contact_form_maker_manage_scripts');

  $submissions_page = add_submenu_page($parent_slug, __('Submissions', 'contact_form_maker'), __('Submissions', 'contact_form_maker'), 'manage_options', 'submissions_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $submissions_page, 'contact_form_maker_styles');

  $blocked_ips_page = add_submenu_page($parent_slug, __('Blocked IPs', 'contact_form_maker'),  __('Blocked IPs', 'contact_form_maker'), 'manage_options', 'blocked_ips_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $blocked_ips_page, 'contact_form_maker_manage_styles');
  add_action('admin_print_scripts-' . $blocked_ips_page, 'contact_form_maker_manage_scripts');

  $themes_page = add_submenu_page($parent_slug, __('Themes', 'contact_form_maker'),  __('Themes', 'contact_form_maker'), 'manage_options', 'themes_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $themes_page, 'contact_form_maker_styles');
  
  $global_options_page = add_submenu_page($parent_slug, __('Global Options', 'contact_form_maker'), __('Global Options', 'contact_form_maker'), 'manage_options', 'goptions_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $global_options_page, 'contact_form_maker_styles');
  add_action('admin_print_scripts-' . $global_options_page, 'contact_form_maker_scripts');

  $licensing_plugins_page = add_submenu_page($parent_slug, __('Get Pro', 'contact_form_maker'), __('Get Pro', 'contact_form_maker'), 'manage_options', 'licensing_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $licensing_plugins_page, 'contact_form_maker_licensing_styles');

  $uninstall_page = add_submenu_page($parent_slug, __('Uninstall', 'contact_form_maker'),  __('Uninstall', 'contact_form_maker'), 'manage_options', 'uninstall_cfm', 'contact_form_maker');
  add_action('admin_print_styles-' . $uninstall_page, 'contact_form_maker_styles');
  add_action('admin_print_scripts-' . $uninstall_page, 'contact_form_maker_scripts');
}
add_action('admin_menu', 'contact_form_maker_options_panel');

function contact_form_maker() {
  if (function_exists('current_user_can')) {
    if (!current_user_can('manage_options')) {
      die('Access Denied');
    }
  }
  else {
    die('Access Denied');
  }
  require_once(WD_CFM_DIR . '/framework/WDW_CFM_Library.php');
  $page = WDW_CFM_Library::get('page');
  if (($page != '') && (($page == 'manage_cfm') || ($page == 'goptions_cfm') || ($page == 'submissions_cfm') || ($page == 'blocked_ips_cfm') || ($page == 'themes_cfm') || ($page == 'licensing_cfm') || ($page == 'uninstall_cfm') || ($page == 'CFMShortcode'))) {
    require_once (WD_CFM_DIR . '/admin/controllers/CFMController' . ucfirst(strtolower($page)) . '.php');
    $controller_class = 'CFMController' . ucfirst(strtolower($page));
    $controller = new $controller_class();
    $controller->execute();
  }
}

add_action('wp_ajax_ContactFormMakerPreview', 'contact_form_maker_ajax');
add_action('wp_ajax_ContactFormmakerwdcaptcha', 'contact_form_maker_ajax'); // Generete captcha image and save it code in session.
add_action('wp_ajax_nopriv_ContactFormmakerwdcaptcha', 'contact_form_maker_ajax'); // Generete captcha image and save it code in session for all users.

function contact_form_maker_ajax() {
  require_once(WD_CFM_DIR . '/framework/WDW_CFM_Library.php');
  $page = WDW_CFM_Library::get('action');
  if ($page != 'ContactFormmakerwdcaptcha') {
    if (function_exists('current_user_can')) {
      if (!current_user_can('manage_options')) {
        die('Access Denied');
      }
    }
    else {
      die('Access Denied');
    }
  }
  if ($page != '') {
    require_once (WD_CFM_DIR . '/admin/controllers/CFMController' . ucfirst($page) . '.php');
    $controller_class = 'CFMController' . ucfirst($page);
    $controller = new $controller_class();
    $controller->execute();
  }
}

// Add the Contact Form Builder button.
function contact_form_maker_add_button($buttons) {
  array_push($buttons, "contact_form_maker_mce");
  return $buttons;
}

// Register Contact Form Builder button.
function contact_form_maker_register($plugin_array) {
  $url = WD_CFM_URL . '/js/contact_form_maker_editor_button.js';
  $plugin_array["contact_form_maker_mce"] = $url;
  return $plugin_array;
}

function contact_form_maker_admin_ajax() {
  ?>
  <script>
    var contact_form_maker_admin_ajax = '<?php echo add_query_arg(array('action' => 'CFMShortcode'), admin_url('admin-ajax.php')); ?>';
    var contact_form_maker_plugin_url = '<?php echo WD_CFM_URL; ?>';
    var contact_form_maker_admin_url = '<?php echo admin_url('admin.php'); ?>';
  </script>
  <?php
}
add_action('admin_head', 'contact_form_maker_admin_ajax');

function cfm_do_output_buffer() {
  ob_start();
}
add_action('init', 'cfm_do_output_buffer');

function wd_contact_form_builder($id) {
  require_once (WD_CFM_DIR . '/frontend/controllers/CFMControllerForm_maker.php');
  $controller = new CFMControllerForm_maker();
  $form = $controller->execute($id);
  echo $form;
}

function wd_contact_form_builder_shortcode($attrs) {
  ob_start();
  wd_contact_form_builder($attrs['id']);
  return str_replace(array("\r\n", "\n", "\r"), '', ob_get_clean());
  // return ob_get_clean();
}
add_shortcode('Contact_Form_Builder', 'wd_contact_form_builder_shortcode');

// Add the Contact Form Builder button to editor.
add_action('wp_ajax_CFMShortcode', 'contact_form_maker_ajax');
add_filter('mce_external_plugins', 'contact_form_maker_register');
add_filter('mce_buttons', 'contact_form_maker_add_button', 0);

// Contact Form Builder Widget.
if (class_exists('WP_Widget')) {
  require_once(WD_CFM_DIR . '/admin/controllers/CFMControllerWidget.php');
  add_action('widgets_init', create_function('', 'return register_widget("CFMControllerWidget");'));
}

// Activate plugin.
function contact_form_maker_activate() {
  $version = get_option("wd_contact_form_maker_version");
  $new_version = WD_CFM_VERSION;
  if ($version && version_compare($version, $new_version, '<')) {
    require_once WD_CFM_DIR . "/contact-form-builder-update.php";
    contact_form_maker_update($version);
    update_option("wd_contact_form_maker_version", $new_version);
  }
  else {
    require_once WD_CFM_DIR . "/contact-form-builder-insert.php";
    contact_form_maker_insert();
    add_option("wd_contact_form_maker_version", $new_version, '', 'no');
  }
}
register_activation_hook(__FILE__, 'contact_form_maker_activate');

if (!isset($_GET['action']) || $_GET['action'] != 'deactivate') {
  add_action('admin_init', 'contact_form_maker_activate');
}

// Contact Form Builder manage page styles.
function contact_form_maker_manage_styles() {
  wp_admin_css('thickbox');
  wp_enqueue_style('contact_form_maker_tables', WD_CFM_URL . '/css/contact_form_maker_tables.css', array(), WD_CFM_VERSION);
  wp_enqueue_style('contact_form_maker_first', WD_CFM_URL . '/css/contact_form_maker_first.css', array(), WD_CFM_VERSION);
  wp_enqueue_style('jquery-ui', WD_CFM_URL . '/css/jquery-ui-1.10.3.custom.css');
  wp_enqueue_style('contact_form_maker_style', WD_CFM_URL . '/css/style.css', array(), WD_CFM_VERSION);
  wp_enqueue_style('contact_form_maker_codemirror', WD_CFM_URL . '/css/codemirror.css');
  wp_enqueue_style('contact_form_maker_layout', WD_CFM_URL . '/css/contact_form_maker_layout.css', array(), WD_CFM_VERSION);
}
// Contact Form Builder manage page scripts.
function contact_form_maker_manage_scripts() {
  $cfm_settings = get_option('cfm_settings');
  $map_key = isset($cfm_settings['map_key']) ? $cfm_settings['map_key'] : '';
  
  wp_enqueue_script('thickbox');
  wp_enqueue_script('jquery');
  wp_enqueue_script('jquery-ui-widget');
  wp_enqueue_script('jquery-ui-sortable');

  wp_enqueue_script('google-maps', 'https://maps.google.com/maps/api/js?v=3.exp&key=' . $map_key);
  wp_enqueue_script('gmap_form', WD_CFM_URL . '/js/if_gmap_back_end.js');

  wp_enqueue_script('contact_form_maker_admin', WD_CFM_URL . '/js/contact_form_maker_admin.js', array(), WD_CFM_VERSION);
  wp_enqueue_script('contact_form_maker_manage', WD_CFM_URL . '/js/contact_form_maker_manage.js', array(), WD_CFM_VERSION);

  wp_enqueue_script('contactformmaker', WD_CFM_URL . '/js/contactformmaker.js', array(), WD_CFM_VERSION);

  wp_enqueue_script('contact_form_maker_codemirror', WD_CFM_URL . '/js/layout/codemirror.js', array(), '2.3');
  wp_enqueue_script('contact_form_maker_clike', WD_CFM_URL . '/js/layout/clike.js', array(), '1.0.0');
  wp_enqueue_script('contact_form_maker_formatting', WD_CFM_URL . '/js/layout/formatting.js', array(), '1.0.0');
  wp_enqueue_script('contact_form_maker_css', WD_CFM_URL . '/js/layout/css.js', array(), '1.0.0');
  wp_enqueue_script('contact_form_maker_javascript', WD_CFM_URL . '/js/layout/javascript.js', array(), '1.0.0');
  wp_enqueue_script('contact_form_maker_xml', WD_CFM_URL . '/js/layout/xml.js', array(), '1.0.0');
  wp_enqueue_script('contact_form_maker_php', WD_CFM_URL . '/js/layout/php.js', array(), '1.0.0');
  wp_enqueue_script('contact_form_maker_htmlmixed', WD_CFM_URL . '/js/layout/htmlmixed.js', array(), '1.0.0');

  wp_localize_script('contactformmaker', 'fmc_objectL10n', array(
    'fmc_Only_letters'  => __('Only letters, numbers, hyphens and underscores are allowed.', 'contact_form_maker'),
    'fmc_name_attribute_required'  => __('The name of the attribute is required.', 'contact_form_maker'),
    'fmc_cannot_add_style_attribute'  => __('Sorry, you cannot add a style attribute here. Use "Class name" instead.', 'contact_form_maker'),
    'fmc_name_attribute_cannotbe_number'  => __('The name of the attribute cannot be a number.', 'contact_form_maker'),
    'fmc_name_attribute_cannot_containspace'  => __('The name of the attribute cannot contain a space.', 'contact_form_maker'),
    'fmc_labels_mustbe_unique'  => __('Sorry, the labels must be unique.', 'contact_form_maker'),
    'fmc_field_label_required'  => __('The field label is required.', 'contact_form_maker'),
    'fmc_select_element_add'  => __('Please select an element to add.', 'contact_form_maker'),
    'fmc_Afghanistan'  => __('Afghanistan', 'contact_form_maker'),
    'fmc_Albania'  => __('Albania', 'contact_form_maker'),
    'fmc_Algeria'  => __('Algeria', 'contact_form_maker'),
    'fmc_Andorra'  => __('Andorra', 'contact_form_maker'),
    'fmc_Angola'  => __('Angola', 'contact_form_maker'),
    'fmc_AntiguaandBarbuda'  => __('Antigua and Barbuda', 'contact_form_maker'),
    'fmc_Argentina'  => __('Argentina', 'contact_form_maker'),
    'fmc_Armenia'  => __('Armenia', 'contact_form_maker'),
    'fmc_Australia'  => __('Australia', 'contact_form_maker'),
    'fmc_Austria'  => __('Austria', 'contact_form_maker'),
    'fmc_Azerbaijan'  => __('Azerbaijan', 'contact_form_maker'),
    'fmc_Bahamas'  => __('Bahamas', 'contact_form_maker'),
    'fmc_Bahrain'  => __('Bahrain', 'contact_form_maker'),
    'fmc_Bangladesh'  => __('Bangladesh', 'contact_form_maker'),
    'fmc_Barbados'  => __('Barbados', 'contact_form_maker'),
    'fmc_Belarus'  => __('Belarus', 'contact_form_maker'),
    'fmc_Belgium'  => __('Belgium', 'contact_form_maker'),
    'fmc_Belize'  => __('Belize', 'contact_form_maker'),
    'fmc_Benin'  => __('Benin', 'contact_form_maker'),
    'fmc_Bhutan'  => __('Bhutan', 'contact_form_maker'),
    'fmc_Bolivia'  => __('Bolivia', 'contact_form_maker'),
    'fmc_BosniaandHerzegovina'  => __('Bosnia and Herzegovina', 'contact_form_maker'),
    'fmc_Botswana'  => __('Botswana', 'contact_form_maker'),
    'fmc_Brazil'  => __('Brazil', 'contact_form_maker'),
    'fmc_Brunei'  => __('Brunei', 'contact_form_maker'),
    'fmc_Bulgaria'  => __('Bulgaria', 'contact_form_maker'),
    'fmc_BurkinaFaso'  => __('Burkina Faso', 'contact_form_maker'),
    'fmc_Burundi'  => __('Burundi', 'contact_form_maker'),
    'fmc_Cambodia'  => __('Cambodia', 'contact_form_maker'),
    'fmc_Cameroon'  => __('Cameroon', 'contact_form_maker'),
    'fmc_Canada'  => __('Canada', 'contact_form_maker'),
    'fmc_CapeVerde'  => __('Cape Verde', 'contact_form_maker'),
    'fmc_CentralAfricanRepublic'  => __('Central African Republic', 'contact_form_maker'),
    'fmc_Chad'  => __('Chad', 'contact_form_maker'),
    'fmc_Chile'  => __('Chile', 'contact_form_maker'),
    'fmc_China'  => __('China', 'contact_form_maker'),
    'fmc_Colombi'  => __('Colombi', 'contact_form_maker'),
    'fmc_Comoros'  => __('Comoros', 'contact_form_maker'),
    'fmc_CongoBrazzaville'  => __('Congo (Brazzaville)', 'contact_form_maker'),
    'fmc_Congo'  => __('Congo', 'contact_form_maker'),
    'fmc_CostaRica'  => __('Costa Rica', 'contact_form_maker'),
    'fmc_CotedIvoire'  => __("Cote d'Ivoire", 'contact_form_maker'),
    'fmc_Croatia'  => __('Croatia', 'contact_form_maker'),
    'fmc_Cuba'  => __('Cuba', 'contact_form_maker'),
    'fmc_Cyprus'  => __('Cyprus', 'contact_form_maker'),
    'fmc_CzechRepublic'  => __('Czech Republic', 'contact_form_maker'),
    'fmc_Denmark'  => __('Denmark', 'contact_form_maker'),
    'fmc_Djibouti'  => __('Djibouti', 'contact_form_maker'),
    'fmc_Dominica'  => __('Dominica', 'contact_form_maker'),
    'fmc_DominicanRepublic'  => __('Dominican Republic', 'contact_form_maker'),
    'fmc_EastTimorTimorTimur'  => __('East Timor (Timor Timur)', 'contact_form_maker'),
    'fmc_Ecuador'  => __('Ecuador', 'contact_form_maker'),
    'fmc_Egypt'  => __('Egypt', 'contact_form_maker'),
    'fmc_ElSalvador'  => __('El Salvador', 'contact_form_maker'),
    'fmc_EquatorialGuinea'  => __('Equatorial Guinea', 'contact_form_maker'),
    'fmc_Eritrea'  => __('Eritrea', 'contact_form_maker'),
    'fmc_Estonia'  => __('Estonia', 'contact_form_maker'),
    'fmc_Ethiopia'  => __('Ethiopia', 'contact_form_maker'),
    'fmc_Fiji'  => __('Fiji', 'contact_form_maker'),
    'fmc_Finland'  => __('Finland', 'contact_form_maker'),
    'fmc_France'  => __('France', 'contact_form_maker'),
    'fmc_Gabon'  => __('Gabon', 'contact_form_maker'),
    'fmc_GambiaThe'  => __('Gambia, The', 'contact_form_maker'),
    'fmc_Georgia'  => __('Georgia', 'contact_form_maker'),
    'fmc_Germany'  => __('Germany', 'contact_form_maker'),
    'fmc_Ghana'  => __('Ghana', 'contact_form_maker'),
    'fmc_Greece'  => __('Greece', 'contact_form_maker'),
    'fmc_Grenada'  => __('Grenada', 'contact_form_maker'),
    'fmc_Guatemala'  => __('Guatemala', 'contact_form_maker'),
    'fmc_Guinea'  => __('Guinea', 'contact_form_maker'),
    'fmc_GuineaBissau'  => __('Guinea-Bissau', 'contact_form_maker'),
    'fmc_Guyana'  => __('Guyana', 'contact_form_maker'),
    'fmc_Haiti'  => __('Haiti', 'contact_form_maker'),
    'fmc_Honduras'  => __('Honduras', 'contact_form_maker'),
    'fmc_Hungary'  => __('Hungary', 'contact_form_maker'),
    'fmc_Iceland'  => __('Iceland', 'contact_form_maker'),
    'fmc_India'  => __('India', 'contact_form_maker'),
    'fmc_Indonesia'  => __('Indonesia', 'contact_form_maker'),
    'fmc_Iran'  => __('Iran', 'contact_form_maker'),
    'fmc_Iraq'  => __('Iraq', 'contact_form_maker'),
    'fmc_Ireland'  => __('Ireland', 'contact_form_maker'),
    'fmc_Israel'  => __('Israel', 'contact_form_maker'),
    'fmc_Italy'  => __('Italy', 'contact_form_maker'),
    'fmc_Jamaica'  => __('Jamaica', 'contact_form_maker'),
    'fmc_Japan'  => __('Japan', 'contact_form_maker'),
    'fmc_Jordan'  => __('Jordan', 'contact_form_maker'),
    'fmc_Kazakhstan'  => __('Kazakhstan', 'contact_form_maker'),
    'fmc_Kenya'  => __('Kenya', 'contact_form_maker'),
    'fmc_Kiribati'  => __('Kiribati', 'contact_form_maker'),
    'fmc_KoreaNorth'  => __('Korea, North', 'contact_form_maker'),
    'fmc_KoreaSouth'  => __('Korea, South', 'contact_form_maker'),
    'fmc_Kuwait'  => __('Kuwait', 'contact_form_maker'),
    'fmc_Kyrgyzstan'  => __('Kyrgyzstan', 'contact_form_maker'),
    'fmc_Laos'  => __('Laos', 'contact_form_maker'),
    'fmc_Latvia'  => __('Latvia', 'contact_form_maker'),
    'fmc_Lebanon'  => __('Lebanon', 'contact_form_maker'),
    'fmc_Lesotho'  => __('Lesotho', 'contact_form_maker'),
    'fmc_Liberia'  => __('Liberia', 'contact_form_maker'),
    'fmc_Libya'  => __('Libya', 'contact_form_maker'),
    'fmc_Liechtenstein'  => __('Liechtenstein', 'contact_form_maker'),
    'fmc_Lithuania'  => __('Lithuania', 'contact_form_maker'),
    'fmc_Luxembourg'  => __('Luxembourg', 'contact_form_maker'),
    'fmc_Macedonia'  => __('Macedonia', 'contact_form_maker'),
    'fmc_Madagascar'  => __('Madagascar', 'contact_form_maker'),
    'fmc_Malawi'  => __('Malawi', 'contact_form_maker'),
    'fmc_Malaysia'  => __('Malaysia', 'contact_form_maker'),
    'fmc_Maldives'  => __('Maldives', 'contact_form_maker'),
    'fmc_Mali'  => __('Mali', 'contact_form_maker'),
    'fmc_Malta'  => __('Malta', 'contact_form_maker'),
    'fmc_MarshallIslands'  => __('Marshall Islands', 'contact_form_maker'),
    'fmc_Mauritania'  => __('Mauritania', 'contact_form_maker'),
    'fmc_Mauritius'  => __('Mauritius', 'contact_form_maker'),
    'fmc_Mexico'  => __('Mexico', 'contact_form_maker'),
    'fmc_Micronesia'  => __('Micronesia', 'contact_form_maker'),
    'fmc_Moldova'  => __('Moldova', 'contact_form_maker'),
    'fmc_Monaco'  => __('Monaco', 'contact_form_maker'),
    'fmc_Mongolia'  => __('Mongolia', 'contact_form_maker'),
    'fmc_Morocco'  => __('Morocco', 'contact_form_maker'),
    'fmc_Mozambique'  => __('Mozambique', 'contact_form_maker'),
    'fmc_Myanmar'  => __('Myanmar', 'contact_form_maker'),
    'fmc_Namibia'  => __('Namibia', 'contact_form_maker'),
    'fmc_Nauru'  => __('Nauru', 'contact_form_maker'),
    'fmc_Nepa'  => __('Nepa', 'contact_form_maker'),
    'fmc_Netherlands'  => __('Netherlands', 'contact_form_maker'),
    'fmc_NewZealand'  => __('New Zealand', 'contact_form_maker'),
    'fmc_Nicaragua'  => __('Nicaragua', 'contact_form_maker'),
    'fmc_Niger'  => __('Niger', 'contact_form_maker'),
    'fmc_Nigeria'  => __('Nigeria', 'contact_form_maker'),
    'fmc_Norway'  => __('Norway', 'contact_form_maker'),
    'fmc_Oman'  => __('Oman', 'contact_form_maker'),
    'fmc_Pakistan'  => __('Pakistan', 'contact_form_maker'),
    'fmc_Palau'  => __('Palau', 'contact_form_maker'),
    'fmc_Panama'  => __('Panama', 'contact_form_maker'),
    'fmc_PapuaNewGuinea'  => __('Papua New Guinea', 'contact_form_maker'),
    'fmc_Paraguay'  => __('Paraguay', 'contact_form_maker'),
    'fmc_Peru'  => __('Peru', 'contact_form_maker'),
    'fmc_Philippines'  => __('Philippines', 'contact_form_maker'),
    'fmc_Poland'  => __('Poland', 'contact_form_maker'),
    'fmc_Portugal'  => __('Portugal', 'contact_form_maker'),
    'fmc_Qatar'  => __('Qatar', 'contact_form_maker'),
    'fmc_Romania'  => __('Romania', 'contact_form_maker'),
    'fmc_Russia'  => __('Russia', 'contact_form_maker'),
    'fmc_Rwanda'  => __('Rwanda', 'contact_form_maker'),
    'fmc_SaintKittsandNevis'  => __('Saint Kitts and Nevis', 'contact_form_maker'),
    'fmc_SaintLucia'  => __('Saint Lucia', 'contact_form_maker'),
    'fmc_SaintVincent'  => __('Saint Vincent', 'contact_form_maker'),
    'fmc_Samoa'  => __('Samoa', 'contact_form_maker'),
    'fmc_SanMarino'  => __('San Marino', 'contact_form_maker'),
    'fmc_SaoTomeandPrincipe'  => __('Sao Tome and Principe', 'contact_form_maker'),
    'fmc_SaudiArabia'  => __('Saudi Arabia', 'contact_form_maker'),
    'fmc_Senegal'  => __('Senegal', 'contact_form_maker'),
    'fmc_SerbiandMontenegro'  => __('Serbia and Montenegro', 'contact_form_maker'),
    'fmc_Seychelles'  => __('Seychelles', 'contact_form_maker'),
    'fmc_SierraLeone'  => __('Sierra Leone', 'contact_form_maker'),
    'fmc_Singapore'  => __('Singapore', 'contact_form_maker'),
    'fmc_Slovakia'  => __('Slovakia', 'contact_form_maker'),
    'fmc_Slovenia'  => __('Slovenia', 'contact_form_maker'),
    'fmc_SolomonIslands'  => __('Solomon Islands', 'contact_form_maker'),
    'fmc_Somalia'  => __('Somalia', 'contact_form_maker'),
    'fmc_SouthAfrica'  => __('South Africa', 'contact_form_maker'),
    'fmc_Spain'  => __('Spain', 'contact_form_maker'),
    'fmc_SriLanka'  => __('Sri Lanka', 'contact_form_maker'),
    'fmc_Sudan'  => __('Sudan', 'contact_form_maker'),
    'fmc_Suriname'  => __('Suriname', 'contact_form_maker'),
    'fmc_Swaziland'  => __('Swaziland', 'contact_form_maker'),
    'fmc_Sweden'  => __('Sweden', 'contact_form_maker'),
    'fmc_Switzerland'  => __('Switzerland', 'contact_form_maker'),
    'fmc_Syria'  => __('Syria', 'contact_form_maker'),
    'fmc_Taiwan'  => __('Taiwan', 'contact_form_maker'),
    'fmc_Tajikistan'  => __('Tajikistan', 'contact_form_maker'),
    'fmc_Tanzania'  => __('Tanzania', 'contact_form_maker'),
    'fmc_Thailand'  => __('Thailand', 'contact_form_maker'),
    'fmc_Togo'  => __('Togo', 'contact_form_maker'),
    'fmc_Tonga'  => __('Tonga', 'contact_form_maker'),
    'fmc_TrinidadandTobago'  => __('Trinidad and Tobago', 'contact_form_maker'),
    'fmc_Tunisia'  => __('Tunisia', 'contact_form_maker'),
    'fmc_Turkey'  => __('Turkey', 'contact_form_maker'),
    'fmc_Turkmenistan'  => __('Turkmenistan', 'contact_form_maker'),
    'fmc_Tuvalu'  => __('Tuvalu', 'contact_form_maker'),
    'fmc_Uganda'  => __('Uganda', 'contact_form_maker'),
    'fmc_Ukraine'  => __('Ukraine', 'contact_form_maker'),
    'fmc_UnitedArabEmirates'  => __('United Arab Emirates', 'contact_form_maker'),
    'fmc_UnitedKingdom'  => __('United Kingdom', 'contact_form_maker'),
    'fmc_UnitedStates'  => __('United States', 'contact_form_maker'),
    'fmc_Uruguay'  => __('Uruguay', 'contact_form_maker'),
    'fmc_Uzbekistan'  => __('Uzbekistan', 'contact_form_maker'),
    'fmc_Vanuatu'  => __('Vanuatu', 'contact_form_maker'),
    'fmc_VaticanCity'  => __('Vatican City', 'contact_form_maker'),
    'fmc_Venezuela'  => __('Venezuela', 'contact_form_maker'),
    'fmc_Vietnam'  => __('Vietnam', 'contact_form_maker'),
    'fmc_Yemen'  => __('Yemen', 'contact_form_maker'),
    'fmc_Zambia'  => __('Zambia', 'contact_form_maker'),
    'fmc_Zimbabwe'  => __('Zimbabwe', 'contact_form_maker'),
    'fmc_Alabama'  => __('Alabama', 'contact_form_maker'),
    'fmc_Alaska'  => __('Alaska', 'contact_form_maker'),
    'fmc_Arizona'  => __('Arizona', 'contact_form_maker'),
    'fmc_Arkansas'  => __('Arkansas', 'contact_form_maker'),
    'fmc_California'  => __('California', 'contact_form_maker'),
    'fmc_Colorado'  => __('Colorado', 'contact_form_maker'),
    'fmc_Connecticut'  => __('Connecticut', 'contact_form_maker'),
    'fmc_Delaware'  => __('Delaware', 'contact_form_maker'),
    'fmc_DistrictOfColumbia'  => __('District Of Columbia', 'contact_form_maker'),
    'fmc_Florida'  => __('Florida', 'contact_form_maker'),
    'fmc_Georgia'  => __('Georgia', 'contact_form_maker'),
    'fmc_Hawaii'  => __('Hawaii', 'contact_form_maker'),
    'fmc_Idaho'  => __('Idaho', 'contact_form_maker'),
    'fmc_Illinois'  => __('Illinois', 'contact_form_maker'),
    'fmc_Indiana'  => __('Indiana', 'contact_form_maker'),
    'fmc_Iowa'  => __('Iowa', 'contact_form_maker'),
    'fmc_Kansas'  => __('Kansas', 'contact_form_maker'),
    'fmc_Kentucky'  => __('Kentucky', 'contact_form_maker'),
    'fmc_Louisiana'  => __('Louisiana', 'contact_form_maker'),
    'fmc_Maine'  => __('Maine', 'contact_form_maker'),
    'fmc_Maryland'  => __('Maryland', 'contact_form_maker'),
    'fmc_Massachusetts'  => __('Massachusetts', 'contact_form_maker'),
    'fmc_Michigan'  => __('Michigan', 'contact_form_maker'),
    'fmc_Minnesota'  => __('Minnesota', 'contact_form_maker'),
    'fmc_Mississippi'  => __('Mississippi', 'contact_form_maker'),
    'fmc_Missouri'  => __('Missouri', 'contact_form_maker'),
    'fmc_Montana'  => __('Montana', 'contact_form_maker'),
    'fmc_Nebraska'  => __('Nebraska', 'contact_form_maker'),
    'fmc_Nevada'  => __('Nevada', 'contact_form_maker'),
    'fmc_NewHampshire'  => __('New Hampshire', 'contact_form_maker'),
    'fmc_NewJersey'  => __('New Jersey', 'contact_form_maker'),
    'fmc_NewMexico'  => __('New Mexico', 'contact_form_maker'),
    'fmc_NewYork'  => __('New York', 'contact_form_maker'),
    'fmc_NorthCarolina'  => __('North Carolina', 'contact_form_maker'),
    'fmc_NorthDakota'  => __('North Dakota', 'contact_form_maker'),
    'fmc_Ohio'  => __('Ohio', 'contact_form_maker'),
    'fmc_Oklahoma'  => __('Oklahoma', 'contact_form_maker'),
    'fmc_Oregon'  => __('Oregon', 'contact_form_maker'),
    'fmc_Pennsylvania'  => __('Pennsylvania', 'contact_form_maker'),
    'fmc_RhodeIsland'  => __('Rhode Island', 'contact_form_maker'),
    'fmc_SouthCarolina'  => __('South Carolina', 'contact_form_maker'),
    'fmc_SouthDakota'  => __('South Dakota', 'contact_form_maker'),
    'fmc_Tennessee'  => __('Tennessee', 'contact_form_maker'),
    'fmc_Texas'  => __('Texas', 'contact_form_maker'),
    'fmc_Utah'  => __('Utah', 'contact_form_maker'),
    'fmc_Vermont'  => __('Vermont', 'contact_form_maker'),
    'fmc_Virginia'  => __('Virginia', 'contact_form_maker'),
    'fmc_Washington'  => __('Washington', 'contact_form_maker'),
    'fmc_WestVirginia'  => __('West Virginia', 'contact_form_maker'),
    'fmc_Wisconsin'  => __('Wisconsin', 'contact_form_maker'),
    'fmc_Wyoming'  => __('Wyoming', 'contact_form_maker'),

    'fmc_Enable_field'  => __('Enable field', 'contact_form_maker'),
    'fmc_Submit_button_label'  => __('Submit button label', 'contact_form_maker'),
    'fmc_Submit_function'  => __('Submit function', 'contact_form_maker'),
    'fmc_Reset_button_label'  => __('Reset button label', 'contact_form_maker'),
    'fmc_Display_reset_button'  => __('Display Reset button', 'contact_form_maker'),
    'fmc_Reset_function'  => __('Reset function', 'contact_form_maker'),
    'fmc_Class_name'  => __('Class name', 'contact_form_maker'),
    'fmc_Additional_attributes'  => __('Additional Attributes', 'contact_form_maker'),
    'fmc_Name'  => __('Name', 'contact_form_maker'),
    'fmc_Value'  => __('Value', 'contact_form_maker'),
    'fmc_Field_label'  => __('Field label', 'contact_form_maker'),
    'fmc_Field_label_size'  => __('Field label size(px) ', 'contact_form_maker'),
    'fmc_Field_label_position'  => __('Field label position', 'contact_form_maker'),
    'fmc_Required'  => __('Required', 'contact_form_maker'),
    'fmc_Field_size'  => __('Field size(px)', 'contact_form_maker'),
    'fmc_Value_empty'  => __('Value if empty', 'contact_form_maker'),
    'fmc_Allow_only_unique_values'  => __('Allow only unique values', 'contact_form_maker'),
    'fmc_Deactive_class_name'  => __('Deactive Class name', 'contact_form_maker'),
    'fmc_Active_class_name'  => __('Active Class name', 'contact_form_maker'),
    'fmc_Name_format'  => __('Name Format', 'contact_form_maker'),
    'fmc_Overall_size'  => __('Overall size(px)', 'contact_form_maker'),
    'fmc_Disable_field'  => __('Disable field(s)', 'contact_form_maker'),
    'fmc_Use_list_US_states'  => __('Use list for US states', 'contact_form_maker'),
    'fmc_Public_key'  => __('Site key', 'contact_form_maker'),
    'fmc_Private_key'  => __('Secret key', 'contact_form_maker'),
    'fmc_Recaptcha_theme'  => __('Recaptcha Theme', 'contact_form_maker'),
    'fmc_Red'  => __('Red', 'contact_form_maker'),
    'fmc_White'  => __('White', 'contact_form_maker'),
    'fmc_Blackglass'  => __('Blackglass', 'contact_form_maker'),
    'fmc_Clean'  => __('Clean', 'contact_form_maker'),
    'fmc_Recaptcha_doesnt_display_backend'  => __("Recaptcha doesn't display in back end", 'contact_form_maker'),
    'fmc_Captcha_size'  => __('Captcha size', 'contact_form_maker'),
    'fmc_Relative_position'  => __('Relative Position', 'contact_form_maker'),
    'fmc_Rows_columns'  => __('Rows/Columns', 'contact_form_maker'),
    'fmc_Randomize_frontend'  => __('Randomize in frontend', 'contact_form_maker'),
    'fmc_Allow_other'  => __('Allow other', 'contact_form_maker'),
    'fmc_Options'  => __('Options', 'contact_form_maker'),
    'fmc_Check_emptyvalue_checkbox'  => __('IMPORTANT! Check the "Empty value" checkbox only if you want the option to be considered as empty.', 'contact_form_maker'),
    'fmc_Option_name'  => __('Option name', 'contact_form_maker'),
    'fmc_Price'  => __('Price', 'contact_form_maker'),
    'fmc_Empty_value'  => __('Empty value', 'contact_form_maker'),
    'fmc_Delete'  => __('Delete', 'contact_form_maker'),
    'fmc_Drag_change_position'  => __('Drag the marker to change marker position.', 'contact_form_maker'),
    'fmc_Location'  => __('Location', 'contact_form_maker'),
    'fmc_Map_size'  => __('Map size', 'contact_form_maker'),
    'fmc_Key'  => __('Key', 'contact_form_maker'),
    'fmc_Click_here'  => __('To set up map key click here', 'contact_form_maker'),
    'fmc_Keys'  => __('Keys', 'contact_form_maker'),
    'fmc_Click_here_recaptcha'  => __('To set up recaptcha keys click here', 'contact_form_maker'),
    'fmc_Marker_info'  => __('Marker Info', 'contact_form_maker'),
    'fmc_Address'  => __('Address', 'contact_form_maker'),
    'fmc_Longitude'  => __('Longitude', 'contact_form_maker'),
    'fmc_Latitude'  => __('Latitude', 'contact_form_maker'),
    'fmc_add'  => __('add', 'contact_form_maker'),
    'fmc_Disable_thefield'  => __('Disable the field', 'contact_form_maker'),
    'fmc_Enable_thefield'  => __('Enable the field', 'contact_form_maker'),
    'fmc_Edit_field'  => __('Edit the field', 'contact_form_maker'),
    'fmc_Dublicate_field'  => __('Dublicate the field', 'contact_form_maker'),
    'fmc_Move_fieldup'  => __('Move the field up', 'contact_form_maker'),
    'fmc_Move_fielddown'  => __('Move the field down', 'contact_form_maker'),
    'fmc_Move_fieldright'  => __('Move the field to the right', 'contact_form_maker'),
    'fmc_Move_fieldleft'  => __('Move the field to the left', 'contact_form_maker'),
    'fmc_Left'  => __('Left', 'contact_form_maker'),
    'fmc_Top'  => __('Top', 'contact_form_maker'),
    'fmc_Use_field_allow'  => __('Use the field to allow the user to choose whether to receive a copy of the submitted form or not. Do not forget to fill in User Email section in Email Options in advance.', 'contact_form_maker'),
    'fmc_labels_fields_editable'  => __('The labels of the fields are editable. Please, click the label to edit.', 'contact_form_maker'),
    'fmc_Normal'  => __('Normal', 'contact_form_maker'),
    'fmc_Extended'  => __('Extended', 'contact_form_maker'),
    'fmc_Use_US_states'  => __('Use US states', 'contact_form_maker'),
    'fmc_Vertical'  => __('Vertical', 'contact_form_maker'),
    'fmc_Horizontal'  => __('Horizontal', 'contact_form_maker'),
    'fmc_Width'  => __('Width', 'contact_form_maker'),
    'fmc_Height'  => __('Height', 'contact_form_maker'),
    'fmc_not_valid_email_address' => __('This is not a valid email address.', 'contact_form_maker'),
    'fmc_Edit' => __('Edit', 'contact_form_maker'),
    'fmc_Items_succesfully_saved' => __('Items Succesfully Saved.', 'contact_form_maker'),
    'fmc_Delete_email' => __('Delete Email', 'contact_form_maker'),
    'fmc_Items_succesfully_saved' => __('Items Succesfully Saved.', 'contact_form_maker'),
    'fmc_SaveIP' => __('Save IP', 'contact_form_maker'),
    'fmc_field_required' => __('* field is required.', 'contact_form_maker'),
    'fmc_Validation' => __('Validation (Regular Exp.)', 'contact_form_maker'),
    'fmc_reg_exp' => __('Regular Expression', 'contact_form_maker'),
    'fmc_common_reg_exp' => __('Common Regular Expressions', 'contact_form_maker'),
    'fmc_case_insensitive' => __('Case Insensitive', 'contact_form_maker'),
    'fmc_alert_message' => __('Alert Message', 'contact_form_maker'),
    'fmc_select' => __('Select', 'contact_form_maker'),
    'fmc_name_latin_letters' => __('Name(Latin letters and some symbols)', 'contact_form_maker'),
    'fmc_phone_number' => __('Phone Number(Digits and dashes)', 'contact_form_maker'),
    'fmc_integer_number' => __('Integer Number', 'contact_form_maker'),
    'fmc_decimal_number' => __('Decimal Number', 'contact_form_maker'),
    'fmc_latin_letters_and_numbers' => __('Latin letters and Numbers', 'contact_form_maker'),
    'fmc_credit_card' => __('Credit Card (16 Digits)', 'contact_form_maker'),
    'fmc_zip_code' => __('Zip Code', 'contact_form_maker'),
    'fmc_IP_address' => __('IP Address', 'contact_form_maker'),
    'fmc_date_mdy' => __('Date m/d/y (e.g. 12/21/2013)', 'contact_form_maker'),
    'fmc_date_dmy' => __('Date d.m.y (e.g. 21.12.2013)', 'contact_form_maker'),
    'fmc_date_format' => __('MySQL Date Format (2013-12-21)', 'contact_form_maker'),
  ));
}

function contact_form_maker_styles() {
  wp_enqueue_style('contact_form_maker_tables', WD_CFM_URL . '/css/contact_form_maker_tables.css', array(), WD_CFM_VERSION);
  wp_enqueue_style('contact_form_maker_style', WD_CFM_URL . '/css/style.css', array(), WD_CFM_VERSION);
  wp_enqueue_style('fmc_deactivate-css',  WD_CFM_URL . '/wd/assets/css/deactivate_popup.css', array(), WD_CFM_VERSION);
}
function contact_form_maker_scripts() {
  wp_enqueue_script('contact_form_maker_admin', WD_CFM_URL . '/js/contact_form_maker_admin.js', array(), WD_CFM_VERSION);
  wp_enqueue_script('fmc-deactivate-popup', WD_CFM_URL.'/wd/assets/js/deactivate_popup.js', array(), WD_CFM_VERSION, true );
  $admin_data = wp_get_current_user();

  wp_localize_script( 'fmc-deactivate-popup', 'fmcWDDeactivateVars', array(
    "prefix" => "wde" ,
    "deactivate_class" =>  'fmc_deactivate_link',
    "email" => $admin_data->data->user_email,
    "plugin_wd_url" => "https://web-dorado.com/products/wordpress-contact-form-builder.html",
  ));
}

function contact_form_maker_licensing_styles() {
  wp_enqueue_style('contact_form_maker_licensing', WD_CFM_URL . '/css/contact_form_maker_licensing.css');
}

// Languages localization.
function contact_form_maker_language_load() {
  load_plugin_textdomain('contact_form_maker', FALSE, basename(dirname(__FILE__)) . '/languages');
}
add_action('init', 'contact_form_maker_language_load');

function contact_form_maker_front_end_scripts() {
  $cfm_settings = get_option('cfm_settings');
  $map_key = isset($cfm_settings['map_key']) ? $cfm_settings['map_key'] : '';
  
  wp_register_style('jquery-ui', WD_CFM_URL . '/css/jquery-ui-1.10.3.custom.css');
  wp_register_style('contact_form_maker_frontend', WD_CFM_URL . '/css/contact_form_maker_frontend.css', FALSE, WD_CFM_VERSION);

  wp_register_script('google-maps', 'https://maps.google.com/maps/api/js?v=3.exp&key=' . $map_key);
  wp_register_script('gmap_form', WD_CFM_URL . '/js/if_gmap_front_end.js', array('jquery'));

  wp_register_script('cfm_main_front_end', WD_CFM_URL . '/js/cfm_main_front_end.js', array('jquery', 'jquery-ui-widget', 'jquery-effects-shake'), WD_CFM_VERSION);
}
add_action('wp_enqueue_scripts', 'contact_form_maker_front_end_scripts');

function fmc_overview() {
  if (is_admin() && !isset($_REQUEST['ajax'])) {
    if (!class_exists("DoradoWeb")) {
      require_once(WD_CFM_DIR . '/wd/start.php');
    }
    global $fmc_options;
    $fmc_options = array(
      "prefix" => "fmc",
      "wd_plugin_id" => 61,
      "plugin_title" => "Contact Form Builder",
      "plugin_wordpress_slug" => "contact-form-builder",
      "plugin_dir" => WD_CFM_DIR,
      "plugin_main_file" => __FILE__,
      "description" => __('Contact Form Builder is an advanced plugin to add contact forms into your website. It comes along with multiple default templates which can be customized.', 'form_maker'),
      // from web-dorado.com
      "plugin_features" => array(
        0 => array(
          "title" => __("Responsive design", "form_maker"),
          "description" => __("This responsive form maker plugin is one of the most easy-to-use form builder solutions available on the market. Simple, yet powerful plugin allows you to quickly and easily build any complex forms.", "form_maker"),
        ),
        1 => array(
          "title" => __("37 default themes", "form_maker"),
          "description" => __("There are 37 default themes coming with the Form Builder. The themes can be customized using Edit CSS button in the General Options. There is also possibility of adding more themes using the Themes section.", "form_maker"),
        ),
        2 => array(
          "title" => __("10 samples for the form, possibility to edit and save as copy", "form_maker"),
          "description" => __("The contact forms can be protected from spam using either simple Captcha or Recaptcha protection.", "form_maker"),
        ),
        3 => array(
          "title" => __("Customizable features (labels, options and dimensions)", "form_maker"),
          "description" => __("", "form_maker"),
        ),
        4 => array(
          "title" => __("Possibility of activating/deactivating specific types of fields", "form_maker"),
          "description" => __("", "form_maker"),
        )
      ),
      // user guide from web-dorado.com
      "user_guide" => array(
        0 => array(
          "main_title" => __("Installing the Contact Form Builder", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/installing.html",
          "titles" => array()
        ),
        1 => array(
          "main_title" => __("Editing Contact Form Builder", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/editing-form.html",
          "titles" => array()
        ),
        2 => array(
          "main_title" => __("Configuring Form Options", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/configuring-form-options.html",
          "titles" => array(
            array(
              "title" => __("General Options", "form_maker"),
              "url" => "https://web-dorado.com/wordpress-contact-form-builder/configuring-form-options/general-options.html",
            ),
            array(
              "title" => __("Email Options", "form_maker"),
              "url" => "https://web-dorado.com/wordpress-contact-form-builder/configuring-form-options/email-options.html",
            ),
          )
        ),
        3 => array(
          "main_title" => __("Description of the Contact Form fields", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/description-of-fields.html",
          "titles" => array()
        ),
        4 => array(
          "main_title" => __("Publishing", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/publishing-form.html",
          "titles" => array()
        ),
        5 => array(
          "main_title" => __("Blocking IPs", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/blocking-ips.html",
          "titles" => array()
        ),
        6 => array(
          "main_title" => __("Managing Submissions", "form_maker"),
          "url" => "https://web-dorado.com/wordpress-contact-form-builder/managing-submissions.html",
          "titles" => array()
        ),
      ),
      "video_youtube_id" => "EqhOv7xVI2w",  // e.g. https://www.youtube.com/watch?v=acaexefeP7o youtube id is the acaexefeP7o
      "plugin_wd_url" => "https://web-dorado.com/products/wordpress-contact-form-builder.html",
      "plugin_wd_demo_link" => "http://wpdemo.web-dorado.com/contact-form-builder/",
      "plugin_wd_addons_link" => "",
      "after_subscribe" => admin_url('admin.php?page=overview_fmc'), // this can be plagin overview page or set up page
      "plugin_wizard_link" => '',
      "plugin_menu_title" => "CForm Builder",
      "plugin_menu_icon" => WD_CFM_URL . '/images/contact_form_maker_logo16.png',
      "deactivate" => true,
      "subscribe" => true,
      "custom_post" => 'manage_cfm',
      "menu_position" => null,
    );

    dorado_web_init($fmc_options);
  }
}
add_action('init', 'fmc_overview');

/**
 * Show notice to install backup plugin
 */
function cfm_bp_install_notice() {
  // Remove old notice.
  if ( get_option('wds_bk_notice_status') !== FALSE ) {
    update_option('wds_bk_notice_status', '1', 'no');
  }

  // Show notice only on plugin pages.
  if ( !isset($_GET['page']) || strpos(esc_html($_GET['page']), '_cfm') === FALSE ) {
    return '';
  }

  $meta_value = get_option('wd_bk_notice_status');
  if ( $meta_value === '' || $meta_value === FALSE ) {
    ob_start();
    $prefix = WD_CFM_PREFIX;
    $nicename = WD_CFM_NICENAME;
    $url = WD_CFM_URL;
    $dismiss_url = add_query_arg(array( 'action' => 'wd_bp_dismiss' ), admin_url('admin-ajax.php'));
    $install_url = esc_url(wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=backup-wd'), 'install-plugin_backup-wd'));
    ?>
    <div class="notice notice-info" id="wd_bp_notice_cont">
      <p>
        <img id="wd_bp_logo_notice" src="<?php echo $url . '/images/logo.png'; ?>" />
        <?php echo sprintf(__("%s advises: Install brand new FREE %s plugin to keep your forms and website safe.", $prefix), $nicename, '<a href="https://wordpress.org/plugins/backup-wd/" title="' . __("More details", $prefix) . '" target="_blank">' .  __("Backup WD", $prefix) . '</a>'); ?>
        <a class="button button-primary" href="<?php echo $install_url; ?>">
          <span onclick="jQuery.post('<?php echo $dismiss_url; ?>');"><?php _e("Install", $prefix); ?></span>
        </a>
      </p>
      <button type="button" class="wd_bp_notice_dissmiss notice-dismiss" onclick="jQuery('#wd_bp_notice_cont').hide(); jQuery.post('<?php echo $dismiss_url; ?>');"><span class="screen-reader-text"></span></button>
    </div>
    <style>
      @media only screen and (max-width: 500px) {
        body #wd_backup_logo {
          max-width: 100%;
        }
        body #wd_bp_notice_cont p {
          padding-right: 25px !important;
        }
      }
      #wd_bp_logo_notice {
        width: 40px;
        float: left;
        margin-right: 10px;
      }
      #wd_bp_notice_cont {
        position: relative;
      }
      #wd_bp_notice_cont a {
        margin: 0 5px;
      }
      #wd_bp_notice_cont .dashicons-dismiss:before {
        content: "\f153";
        background: 0 0;
        color: #72777c;
        display: block;
        font: 400 16px/20px dashicons;
        speak: none;
        height: 20px;
        text-align: center;
        width: 20px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
      .wd_bp_notice_dissmiss {
        margin-top: 5px;
      }
    </style>
    <?php
    echo ob_get_clean();
  }
}

if ( !is_dir(plugin_dir_path(__DIR__) . 'backup-wd') ) {
  add_action('admin_notices', 'cfm_bp_install_notice');
}

if ( !function_exists('wd_bps_install_notice_status') ) {
  // Add usermeta to db.
  function wd_bps_install_notice_status() {
    update_option('wd_bk_notice_status', '1', 'no');
  }
  add_action('wp_ajax_wd_bp_dismiss', 'wd_bps_install_notice_status');
}

function cfm_add_plugin_meta_links($meta_fields, $file) {
  if ( plugin_basename(__FILE__) == $file ) {
    $plugin_url = "https://wordpress.org/support/plugin/contact-form-builder";
    $prefix = WD_CFM_PREFIX;
    $meta_fields[] = "<a href='" . $plugin_url . "' target='_blank'>" . __('Support Forum', $prefix) . "</a>";
    $meta_fields[] = "<a href='" . $plugin_url . "/reviews#new-post' target='_blank' title='" . __('Rate', $prefix) . "'>
            <i class='wdi-rate-stars'>"
      . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
      . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
      . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
      . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
      . "<svg xmlns='http://www.w3.org/2000/svg' width='15' height='15' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-star'><polygon points='12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2'/></svg>"
      . "</i></a>";

    $stars_color = "#ffb900";

    echo "<style>"
      . ".wdi-rate-stars{display:inline-block;color:" . $stars_color . ";position:relative;top:3px;}"
      . ".wdi-rate-stars svg{fill:" . $stars_color . ";}"
      . ".wdi-rate-stars svg:hover{fill:" . $stars_color . "}"
      . ".wdi-rate-stars svg:hover ~ svg{fill:none;}"
      . "</style>";
  }

  return $meta_fields;
}
add_filter("plugin_row_meta", 'cfm_add_plugin_meta_links', 10, 2);

function cfm_topic() {
  $page = isset($_GET['page']) ? $_GET['page'] : '';
  $task = isset($_REQUEST['task']) ? $_REQUEST['task'] : '';
  $user_guide_link = 'https://wordpress.org/plugins/contact-form-builder/';
  $support_forum_link = 'https://wordpress.org/support/plugin/contact-form-builder';
  $pro_icon = WD_CFM_URL . '/images/wd_logo.png';
  $pro_link = 'http://web-dorado.com/files/fromContactFormBuilder.php';
  $support_icon = WD_CFM_URL . '/images/support.png';
  $prefix = WD_CFM_PREFIX;
  $is_free = TRUE;
  switch ($page) {
    case 'blocked_ips_cfm': {
      $help_text = 'block IPs';
      $user_guide_link .= 'blocking-ips.html';
      break;
    }
    case 'goptions_cfm': {
      $help_text = 'edit form settings';
      $user_guide_link .= '';
      break;
    }
    case 'licensing_cfm': {
      $help_text = '';
      $user_guide_link .= '';
      break;
    }
    case 'manage_cfm': {
      switch ($task) {
        case 'edit':
        case 'edit_old': {
          $help_text = 'add fields to your form';
          $user_guide_link .= 'description-of-form-fields.html';
          break;
        }
        case 'form_options':
        case 'form_options_old': {
          $help_text = 'edit form options';
          $user_guide_link .= 'configuring-form-options.html';
          break;
        }
        default: {
          $help_text = 'create, edit forms';
          $user_guide_link .= 'creating-form.html';
        }
      }
      break;
    }
    case 'submissions_cfm': {
      $help_text = 'view and manage form submissions';
      $user_guide_link .= 'managing-submissions.html';
      break;
    }
    case 'themes_cfm': {
      $help_text = 'create, edit form themes';
      $user_guide_link .= '';
      break;
    }
    default: {
      return '';
    }
  }
  ob_start();
  ?>
  <style>
    .wd_topic {
      background-color: #ffffff;
      border: none;
      box-sizing: border-box;
      clear: both;
      color: #6e7990;
      font-size: 14px;
      font-weight: bold;
      line-height: 44px;
      margin: 0;
      padding: 0 0 0 15px;
      vertical-align: middle;
      width: 98%;
    }
    .wd_topic .wd_help_topic {
      float: left;
    }
    .wd_topic .wd_help_topic a {
      color: #0073aa;
    }
    .wd_topic .wd_help_topic a:hover {
      color: #00A0D2;
    }
    .wd_topic .wd_support {
      float: right;
      margin: 0 10px;
    }
    .wd_topic .wd_support img {
      vertical-align: middle;
    }
    .wd_topic .wd_support a {
      text-decoration: none;
      color: #6E7990;
    }
    .wd_topic .wd_pro {
      float: right;
      padding: 0;
    }
    .wd_topic .wd_pro a {
      border: none;
      box-shadow: none !important;
      text-decoration: none;
    }
    .wd_topic .wd_pro img {
      border: none;
      display: inline-block;
      vertical-align: middle;
    }
    .wd_topic .wd_pro a,
    .wd_topic .wd_pro a:active,
    .wd_topic .wd_pro a:visited,
    .wd_topic .wd_pro a:hover {
      background-color: #D8D8D8;
      color: #175c8b;
      display: inline-block;
      font-size: 11px;
      font-weight: bold;
      padding: 0 10px;
      vertical-align: middle;
    }
  </style>
  <div class="update-nag wd_topic">
    <?php
    if ($help_text) {
      ?>
      <span class="wd_help_topic">
        <?php echo sprintf(__('This section allows you to %s.', $prefix), $help_text); ?>
        <a target="_blank" href="<?php echo $user_guide_link; ?>">
          <?php _e('Read More in User Manual', $prefix); ?>
        </a>
      </span>
      <?php
    }
    if ($is_free) {
      $text = strtoupper(__('Upgrade to paid version', $prefix));
      ?>
      <div class="wd_pro">
        <a target="_blank" href="<?php echo $pro_link; ?>">
          <img alt="web-dorado.com" title="<?php echo $text; ?>" src="<?php echo $pro_icon; ?>" />
          <span><?php echo $text; ?></span>
        </a>
      </div>
      <?php
    }
    if (TRUE) {
      ?>
      <span class="wd_support">
      <a target="_blank" href="<?php echo $support_forum_link; ?>">
        <img src="<?php echo $support_icon; ?>" />
        <?php _e('Support Forum', $prefix); ?>
      </a>
    </span>
      <?php
    }
    ?>
  </div>
  <?php
  echo ob_get_clean();
}

add_action('admin_notices', 'cfm_topic', 11);

