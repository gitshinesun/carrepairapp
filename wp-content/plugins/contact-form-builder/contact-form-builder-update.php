<?php

function contact_form_maker_update($version) {
  global $wpdb;
  if (version_compare($version, '1.0.18') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "contactformmaker` ADD `wpmail` tinyint(1) NOT NULL DEFAULT '1'");
  }
  if (version_compare($version, '1.0.22') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "contactformmaker` ADD `sortable` tinyint(1) NOT NULL DEFAULT '1'");
  }
  if (version_compare($version, '1.0.46') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "contactformmaker_submits` CHANGE `ip` `ip` varchar(128) NOT NULL");
  }
  if (version_compare($version, '1.0.47') == -1) {
    $recaptcha_keys = $wpdb->get_row('SELECT `public_key`, `private_key` FROM ' . $wpdb->prefix . 'contactformmaker WHERE public_key!="" and private_key!=""', ARRAY_A);
    $public_key = isset($recaptcha_keys['public_key']) ? $recaptcha_keys['public_key'] : '';
    $private_key = isset($recaptcha_keys['private_key']) ? $recaptcha_keys['private_key'] : '';
    
    if (FALSE === $fm_settings = get_option('cfm_settings')) {
      add_option('cfm_settings', array('public_key' => $public_key, 'private_key' => $private_key, 'map_key' => ''));	
    }
  }
  if (version_compare($version, '1.0.58') == -1) {
    $wpdb->query("ALTER TABLE `" . $wpdb->prefix . "contactformmaker` CHANGE `element_value` `element_value` text NOT NULL");
  }
  return;
}

?>