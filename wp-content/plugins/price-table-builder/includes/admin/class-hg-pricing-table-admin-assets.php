<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class HG_Pricing_Table_Admin_Assets
{

    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
        add_action('wp_enqueue_media', array($this, 'media_button'));
    }

    public function admin_styles($hook)
    {
        global $post_type;
        if ('pricing_table' == $post_type) {
            wp_register_style('hg_pricing_table_admin_style', HG_Price_Table_Builder()->plugin_url() . ('/assets/css/style.css'));
            wp_enqueue_style('hg_pricing_table_admin_style', array(), false, true);
            wp_register_style('font-awesome', HG_Price_Table_Builder()->plugin_url() . ('/assets/css/font-awesome.css'));
            wp_enqueue_style('font-awesome', array(), false, true);
            wp_register_style('dragtable', HG_Price_Table_Builder()->plugin_url() . ('/assets/css/dragtable.css'));
            wp_enqueue_style('dragtable', array(), false, true);
        }
		if($hook == 'pricing_table_page_price_table_featured_plugins') {
			wp_enqueue_style('featured_plugins_style', HG_Price_Table_Builder()->plugin_url() . ('/assets/css/featured-plugins.css' ));
			wp_enqueue_style('featured_plugins_style', array(), false, true);			
		}
		if($hook == 'pricing_table_page_price_table_licencing') {
            wp_enqueue_style('licensing-style', HG_Price_Table_Builder()->plugin_url() . ('/assets/css/licensing-style.css' ));
            wp_enqueue_style('licensing-style', array(), false, true);
        }
    }

    public function media_button()
    {
        wp_enqueue_script('price_table_media', HG_Price_Table_Builder()->plugin_url() . ('/assets/js/price_table_media.js'), array(), false, true);
    }

    public function admin_scripts($hook)
    {
        global $post_type;
        if ('pricing_table' == $post_type) {
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('hg_pricing_table_handle', HG_Price_Table_Builder()->plugin_url() . ('/assets/js/pricing_script.js'), array(), false, true);
            wp_enqueue_script('jscolor', HG_Price_Table_Builder()->plugin_url() . ('/assets/js/jscolor.js'), array(), false, true);
            $price_table_translate = array(
                'background_color' => __('Background Color', 'hg_pricing_table'),
                'header_text_color' => __('Header Text Color', 'hg_pricing_table'),
                'price_text_color' => __('Price Text Color', 'hg_pricing_table'),
                'font_awesome_icon_color' => __('Font Awesome icons color', 'hg_pricing_table'),
                'features_text_color' => __('Features Text Color', 'hg_pricing_table'),
                'column_border_color' => __('Column Border Color', 'hg_pricing_table'),
                'row_border_color' => __('Row Border Color', 'hg_pricing_table'),
                'column_customize' => __('Customize', 'hg_pricing_table'),
                'icon' => __('Icon', 'hg_pricing_table'),
                'highlight' => __('Highlight', 'hg_pricing_table'),
                'head' => __('Head', 'hg_pricing_table'),
                'price' => __('Price', 'hg_pricing_table'),
                'button_text' => __('Button Text', 'hg_pricing_table'),
                'feature_name' => __('Feature Name', 'hg_pricing_table'),
                'feature' => __('Feature', 'hg_pricing_table'),
                'get_started' => __('Get Started', 'hg_pricing_table'),
                'choose_font_awesome_icon' => __('Choose Font Awesome Icon', 'hg_pricing_table')
            );
            wp_localize_script('hg_pricing_table_handle', 'hg_pricing_table', $price_table_translate);
        }
    }

}

return new HG_Pricing_Table_Admin_Assets();