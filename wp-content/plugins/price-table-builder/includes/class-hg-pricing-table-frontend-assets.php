<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class HG_Pricing_Table_Frontend_Assets {

	public function __construct() {
		add_action( 'price_table_shortcode_scripts', array( $this, 'frontend_styles') );
        add_action('price_table_shortcode_scripts', array($this, 'frontend_scripts'));
	}

	public function frontend_styles() {
		wp_register_style( 'font-awesome', HG_Price_Table_Builder()->plugin_url().( '/assets/css/font-awesome.css') );
		wp_enqueue_style( 'font-awesome' );
		wp_register_style( 'hg_pricing_table_front_style', HG_Price_Table_Builder()->plugin_url().( '/assets/css/front-style.css' ) );
		wp_enqueue_style( 'hg_pricing_table_front_style' );
	}

    public function frontend_scripts() {
        wp_enqueue_script('match_height', HG_Price_Table_Builder()->plugin_url() . ('/assets/js/jquery.matchHeight-min.js'), array(), false, true);
        wp_enqueue_script('hg_price_front_end_js', HG_Price_Table_Builder()->plugin_url() . ('/assets/js/hg_front_end.js'), array('match_height'), false, true);
    }
}

return new HG_Pricing_Table_Frontend_Assets();