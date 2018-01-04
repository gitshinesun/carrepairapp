<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class HG_Pricing_Table_Admin {

    public function __construct()
    {
        $this->init_meta_box_action();
    }

    private function init_meta_box_action()
    {
        add_action('add_meta_boxes', array($this, 'builder_meta_box'));
        add_filter('manage_pricing_table_posts_columns', array($this, 'table_columns'));
        add_action('manage_pricing_table_posts_custom_column', array( $this, 'manage_price_table_columns'));
        add_action('media_buttons_context', array($this, 'media_button_popup'));
        add_action('admin_footer', array($this, 'media_button_popup_content'));
    }

    public function media_button_popup($context)
    {
        return $context .= "<a href='#TB_inline?width=400&inlineId=hg_price_table_shortcode' title='".__('Select Huge IT Pricing Table to Insert Into Post', 'hg_pricing_table')."' class='thickbox button'> ".__('Add Pricing Table Shortcode', 'hg_pricing_table')."</a>";
    }

    public function media_button_popup_content()
    {
		$screen_for_inserting = get_current_screen();

		if ( $screen_for_inserting->post_type != 'page' && $screen_for_inserting->post_type != "post" )
			return;			
        ?>
        <div id="hg_price_table_shortcode">
            <h3><?php _e("Choose Pricing Table", "hg_pricing_table") ?></h3>
            <?php $args = array(
                'posts_per_page' => '-1',
                'post_type' => 'pricing_table',
                'post_status' => 'publish'
            );
            ?>
            <select id="price_table_choosing">
                <?php
                $posts_array = get_posts($args);
                foreach ($posts_array as $posts_arr) {
                    ?>
                    <option value="<?php echo $posts_arr->ID; ?>">
                        <?php if ($posts_arr->post_title != "") {
                            echo $posts_arr->post_title;
                        } else {
                            echo __("no title", "hg_pricing_table");
                        }
                        ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <button id="insert_price_table" class="button"><?php _e('Insert', 'hg_pricing_table'); ?></button>
        </div>
        <?php
    }

    public function builder_meta_box()
    {
        add_meta_box(
            'pricing_table_meta',
            __('Huge-IT Pricing Table', 'hg_pricing_table'),
            array($this, 'pricing_table_meta'),
            'pricing_table',
            'normal',
            'high'
        );

        add_meta_box(
            'pricing_table_options',
            __('Huge-IT Pricing Table Options', 'hg_pricing_table'),
            array($this, 'pricing_table_options'),
            'pricing_table',
            'normal',
            'high'
        );

        add_meta_box(
            'shortcode_usage',
            __('Usage', 'hg_pricing_table'),
            array($this, 'shortcode_usage'),
            'pricing_table',
            'side',
            'low'
        );
    }

    public function shortcode_usage()
    {
        global $post;

        ?>
        <div id="hg_price_table_usage">
            <ul>
                <li rel="tab-1" class="selected">
                    <h4><?php echo __( 'Shortcode', 'hg_pricing_table' );?></h4>
                    <p><?php echo __( 'Copy &amp; paste the shortcode directly into any WordPress post or page', 'hg_pricing_table' );?>.</p>
                    <textarea class="full" readonly="readonly"><?php
                        if (get_post_status($post->ID) != "" && get_post_status($post->ID) == 'publish') {
                            echo '[hg_price_table id="' . $post->ID . '"]';
                        } else {
                            echo __('After Save you get shortcode', 'hg_pricing_table');
                        }
                        ?></textarea>
                </li>
            </ul>
        </div>

        <?php
    }

    public function table_columns($columns)
    {

        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => __('Title', 'hg_pricing_table'),
            'shortcode' => __('Shortcode', 'hg_pricing_table'),
            'date' => __('Date', 'hg_pricing_table')
        );

        return $columns;
    }

    public function manage_price_table_columns()
    {
        global $post;

        echo '[hg_price_table id="' . $post->ID . '"]';

    }

    public function pricing_table_meta($post)
    {

        global $post;

        $hg_price_table_builder_data = get_post_meta($post->ID);

        if(isset($hg_price_table_builder_data['hg_price_column']) && $hg_price_table_builder_data['hg_price_column'] != "") {
            $hg_pt_columns_data = unserialize($hg_price_table_builder_data['hg_price_column'][0]);
        }

        if(isset($hg_price_table_builder_data['hg_price_col_info']) && $hg_price_table_builder_data['hg_price_col_info'] != "") {
            $hg_price_col_info_data = unserialize($hg_price_table_builder_data['hg_price_col_info'][0]);
            $hg_price_col_info_data = $hg_price_col_info_data[0];
        }

        if (isset($hg_price_table_builder_data['hg_price_table_columns_count'][0]) && $hg_price_table_builder_data['hg_price_table_columns_count'][0] != "") {
            $hg_price_table_columns_count = intval($hg_price_table_builder_data['hg_price_table_columns_count'][0]);
        } else {
            $hg_price_table_columns_count = 3;
        }

        if ( isset( $hg_price_table_builder_data['hg_price_table_columns_max_count'][0] ) && $hg_price_table_builder_data['hg_price_table_columns_max_count'][0] != "" ) {
            $hg_price_table_columns_max_count = intval( $hg_price_table_builder_data['hg_price_table_columns_max_count'][0] );
        } else {
            $hg_price_table_columns_max_count = 3;
        }

        require(HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH . 'admin/pricing-table-meta.php');

    }

    public function pricing_table_options($post)
    {
        require(HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH . 'admin/pricing-table-options.php');
    }

    public function font_awesome_block()
    {
        require(HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH . 'admin/font-awesome-block.php');
    }

    public function pricing_table_column_customize($i)
    {
        require(HG_PRICING_TABLE_BUILDER_TEMPLATES_PATH . 'admin/table-column-customize.php');
    }

}

new HG_Pricing_Table_Admin;