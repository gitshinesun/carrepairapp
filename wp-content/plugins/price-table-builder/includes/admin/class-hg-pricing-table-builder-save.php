<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class HG_Pricing_Table_Builder_Save
{

    public function __construct()
    {
        add_action('save_post', array($this, 'pricing_table_builder_save'));
    }

    public function pricing_table_builder_save($post)
    {
        global $post;
        if (isset($post)) {
            $post_id = $post->ID;

            if (!isset($_POST['pricing_table_nonce_field']) || !wp_verify_nonce($_POST['pricing_table_nonce_field'], 'action_pricing_table_nonce')) {
                return;
            }

            /*
             *  Save Columns Count
             * */

            if (isset($_POST['hg_price_table_columns_count']) && $_POST['hg_price_table_columns_count'] != '' && intval($_POST['hg_price_table_columns_count']) > 0) {
                $hg_price_table_columns_count = intval($_POST['hg_price_table_columns_count']);
                update_post_meta($post_id, 'hg_price_table_columns_count', $hg_price_table_columns_count);
            } else {
                $hg_price_table_columns_count = 3;
                update_post_meta($post_id, 'hg_price_table_columns_count', $hg_price_table_columns_count);
            }

            /*
             *  Save Columns Data 
             * */
            if (isset($_POST['hg_price_column']) && $_POST['hg_price_column'] != '') {
                $hg_price_column_array = array();
                foreach ($_POST['hg_price_column'] as $price_column_params_keys => $price_column_params) {
                    foreach ($price_column_params as $price_column_keys => $price_column_values) {
                        if(isset($price_column_values[$price_column_params_keys]) && is_array($price_column_values[$price_column_params_keys])) {
                            foreach($price_column_values as $price_column_value_key => $price_column_value_value){
                                if($price_column_value_value != "") {
                                    $hg_price_column_array[$price_column_params_keys][0][$price_column_value_key] = wp_kses($price_column_value_value, 'default');
                                }
                            }
                        }
                        else {
                            $hg_price_column_array[$price_column_params_keys][$price_column_keys] = wp_kses($price_column_values, 'default');
                        }
                    }
                }
                update_post_meta($post_id, 'hg_price_column', $hg_price_column_array);
            }

            /*
             * Hide or Show First Column and Price Row and Button Row Save Data
             * */
            if (isset($_POST['hg_price_col_info']) && $_POST['hg_price_col_info'] != '') {
                $hg_price_col_info_array = array();
                foreach ($_POST['hg_price_col_info'] as $price_col_info_key => $price_col_info_value) {
                    if ($price_col_info_value != '') {
                        $hg_price_col_info_array[$price_col_info_key] = wp_kses($price_col_info_value, 'default');
                    }
                }
                update_post_meta($post_id, 'hg_price_col_info', $hg_price_col_info_array);
            }

            /*
             *  Price Table Column Options Data Save
             * */
            if (isset($_POST['hg_price_table_column_options']) && $_POST['hg_price_table_column_options'] != '') {
                $hg_price_table_column_options_array = array();
                foreach ($_POST['hg_price_table_column_options'] as $price_table_column_options_keys => $price_table_column_options_values) {
                    foreach($price_table_column_options_values as $price_table_column_options_values_key => $price_table_column_options_values_value) {
                        if(preg_match('/^[a-f0-9]{6}$/i', $price_table_column_options_values_value)) {
                            $hg_price_table_column_options_array[$price_table_column_options_keys][$price_table_column_options_values_key] = preg_replace('/\s+/', '', $price_table_column_options_values_value);
                        }
                    }
                }
                update_post_meta($post_id, 'hg_price_table_column_options', $hg_price_table_column_options_array);
            }

        }
    }
}

return new HG_Pricing_Table_Builder_Save;