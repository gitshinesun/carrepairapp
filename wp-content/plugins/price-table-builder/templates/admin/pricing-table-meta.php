<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<div id="huge_it_new_plugin_versions">
    <div id="huge_it_features">
        <div class="add_new_feature">
            <div class="button" id="add_new_feature_button"><?php _e('Add New Feature Row', 'hg_pricing_table'); ?></div>
            <div class="button" id="add_new_column"><?php _e('Add New Column', 'hg_pricing_table'); ?></div>
        </div>

        <div class="hg_price_table_main" id="price_list_sortable">
            <?php

            if ((isset($hg_pt_columns_data) && $hg_pt_columns_data != "") && (isset($hg_price_col_info_data) && $hg_price_col_info_data != "")) {

                $j = 0;
                for ($i = 0; $i < $hg_price_table_columns_count; $i++) {
                    if ($i == 0) {
                        ?>
                        <div class="hg_pt_column hg_first_column <?php if ($hg_price_col_info_data['first_col_hide'] == 'true') {
                            echo "hg_first_col_hidden";
                        } ?>" data-i="0">
                            <div class="hg_show_hide_first_column">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <input type="hidden" class="hg_first_col_hide_show" name="hg_price_col_info[<?php echo $i; ?>][first_col_hide]" value="<?php echo $hg_price_col_info_data['first_col_hide']; ?>"/>
                            </div>
                            <div class="hg_col_element hg_pt_head">
                                <input type="text" class="hg_pt_field" name="hg_price_column[<?php echo $i; ?>][head]" value="<?php echo htmlentities($hg_pt_columns_data[$i]['head']); ?>" placeholder="<?php _e('Head', 'hg_pricing_table'); ?>" />
                                <?php echo $this->pricing_table_column_customize($i); ?>
                                <?php echo $this->font_awesome_block(); ?>
                            </div>

                            <div class="hg_col_element hg_pt_highlight">
                                <div class="hg_movable_price_row"></div>
                                <div class="hg_price_text">
                                    <input type="text" class="hg_pt_field" value="<?php echo $hg_pt_columns_data[$i]['highlight_text']; ?>" name="hg_price_column[0][highlight_text]" placeholder="<?php _e('Highlight Text', 'hg_pricing_table'); ?>" />
                                    <?php echo $this->font_awesome_block(); ?>
                                </div>
                            </div>
                            <?php
                            foreach ($hg_pt_columns_data[$i] as $hg_pt_columns => $values) {

                                if ($hg_pt_columns === "price") {
                                    ?>

                                    <div class="hg_col_element hg_pt_price <?php if ($hg_price_col_info_data['hide_price_row'] == 'true') {
                                        echo "hg_price_row_hidden";
                                    } ?>">
                                        <div class="hg_movable_item">
                                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        </div>
                                        <div class="hg_show_hide_price_row">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <input type="hidden" class="hg_show_hide_price_row" name="hg_price_col_info[<?php echo $i; ?>][hide_price_row]" value="<?php if(isset($hg_price_col_info_data['hide_price_row']) && $hg_price_col_info_data['hide_price_row'] != "") {echo $hg_price_col_info_data['hide_price_row'];} else {echo "false";} ?>"/>
                                        </div>
                                        <input type="text" class="hg_pt_field" value="<?php echo htmlentities($hg_pt_columns_data[$i]['price']); ?>" name="hg_price_column[<?php echo $i; ?>][price]" placeholder="<?php _e('Price Text', 'hg_pricing_table'); ?>" />
                                        <?php echo $this->font_awesome_block(); ?>
                                    </div>

                                    <?php
                                }
                                if (is_array($values)) {
                                    ?>
                                    <div class="hg_col_element hg_pt_feature_row">
                                        <div class="hg_movable_item">
                                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        </div>
                                        <div class="hg_pt_delete_ft_row">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </div>
                                        <div class="hg_pt_feature hg_feature_<?php echo $j; ?>" data-ft-id="<?php echo $j; ?>">
                                            <span class="hg_movable_feature"></span>
                                            <input type="text" class="hg_pt_field" name="hg_price_column[<?php echo $i; ?>][<?php echo $j; ?>][feature]" value="<?php echo htmlentities($values['feature']); ?>" placeholder="<?php _e('Highlight Text', 'hg_pricing_table'); ?>" />
                                            <?php echo $this->font_awesome_block(); ?>
                                        </div>
                                    </div>
                                    <?php
                                    $j++;
                                }
                                if ($hg_pt_columns === "button_text") {
                                    ?>

                                    <div class="hg_col_element hg_pt_button <?php if ($hg_price_col_info_data['hide_button_row'] == 'true') {
                                        echo "hg_price_row_hidden";
                                    } ?>">
                                        <div class="hg_movable_item">
                                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        </div>
                                        <div class="hg_show_hide_button_row">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <input type="hidden" class="hg_show_hide_button_row" name="hg_price_col_info[<?php echo $i; ?>][hide_button_row]" value="<?php if(isset($hg_price_col_info_data['hide_button_row']) && $hg_price_col_info_data['hide_button_row'] != "") {echo $hg_price_col_info_data['hide_button_row'];} else {echo "false";} ?>"/>
                                        </div>
                                        <input type="text" class="hg_pt_field" name="hg_price_column[<?php echo $i; ?>][button_text]" value="<?php echo htmlentities($hg_pt_columns_data[$i]['button_text']); ?>" placeholder="<?php _e('Button Text', 'hg_pricing_table'); ?>" />
                                        <?php echo $this->font_awesome_block(); ?>
                                        <input type="text" class="hg_pt_link_field" name="hg_price_column[<?php echo $i; ?>][button_link]" value="<?php echo htmlentities($hg_pt_columns_data[$i]['button_link']); ?>" placeholder="http://">
                                    </div>

                                    <?php
                                }

                            }
                            ?>
                        </div>

                        <?php
                    } else {
                        ?>
                    <div class="hg_pt_column hg_col_<?php echo $i; ?>" data-i="<?php echo $i; ?>">
                        <div class="hg_movable_col"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
                        <span class="hg_delete_col"><i class="fa fa-times" aria-hidden="true"></i></span>
                        <div class="hg_col_element hg_pt_head">
                            <input type="text" class="hg_pt_field" name="hg_price_column[<?php echo $i; ?>][head]" value="<?php echo htmlentities($hg_pt_columns_data[$i]['head']); ?>" placeholder="<?php _e('Head', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->pricing_table_column_customize($i); ?>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>

                        <div class="hg_col_element hg_pt_highlight">
                            <div class="best_seller">
                                <label for="best_sel_<?php echo $i; ?>"><?php _e('Highlight', 'hg_pricing_table'); ?></label>
                                <input type="checkbox" id="best_sel_<?php echo $i; ?>" name="hg_price_column[<?php echo $i; ?>][highlight]" value="<?php echo $i; ?>" <?php if(isset($hg_pt_columns_data[$i]['highlight'])) {echo 'checked';} ?>>
                            </div>
                        </div>
                        <?php
                        $k = 0;
                        foreach ($hg_pt_columns_data[$i] as $hg_pt_columns => $values) {
                            if ($hg_pt_columns === "price") {
                                ?>
                                <div class="hg_col_element hg_pt_price <?php if ($hg_price_col_info_data['hide_price_row'] == 'true') {
                                    echo "hg_price_row_hidden";
                                } ?>">
                                    <div class="hg_movable_item">
                                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="hg_pt_field" value="<?php echo htmlentities($hg_pt_columns_data[ $i ]['price']); ?>" name="hg_price_column[<?php echo $i; ?>][price]" placeholder="<?php _e('Price', 'hg_pricing_table'); ?>"/>
                                    <?php echo $this->font_awesome_block(); ?>
                                </div>

                                <?php
                            }
                            if (is_array($values)) {
                                ?>
                                <div class="hg_col_element hg_pt_feature_row">
                                    <div class="hg_movable_item">
                                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                    </div>
                                    <div class="hg_pt_feature hg_feature_<?php echo $k; ?>" data-ft-id="<?php echo $k; ?>">
                                        <span class="hg_movable_feature"></span>
                                        <input type="text" class="hg_pt_field" name="hg_price_column[<?php echo $i; ?>][<?php echo $k; ?>][feature]" value="<?php echo htmlentities($values['feature']); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                                        <?php echo $this->font_awesome_block(); ?>
                                    </div>
                                </div>
                                <?php
                                $k++;
                            }
                            if ($hg_pt_columns === "button_text") {
                                ?>

                                <div class="hg_col_element hg_pt_button <?php if ($hg_price_col_info_data['hide_button_row'] == 'true') {
                                    echo "hg_price_row_hidden";
                                } ?>">
                                    <div class="hg_movable_item">
                                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="hg_pt_field" name="hg_price_column[<?php echo $i; ?>][button_text]" value="<?php echo htmlentities($hg_pt_columns_data[$i]['button_text']); ?>" placeholder="<?php _e('Button Text', 'hg_pricing_table'); ?>"/>
                                    <?php echo $this->font_awesome_block(); ?>
                                    <input type="text" class="hg_pt_link_field" name="hg_price_column[<?php echo $i; ?>][button_link]" value="<?php echo htmlentities($hg_pt_columns_data[$i]['button_link']); ?>" placeholder="http://">
                                </div>

                                <?php
                            }

                        }
                        ?>
                    </div>
                    <?php
                    }
                }

            } else {
                ?>
                <div class="hg_pt_column hg_first_column" data-i="0">
                    <div class="hg_show_hide_first_column">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <input type="hidden" class="hg_first_col_hide_show" name="hg_price_col_info[0][first_col_hide]" value="false"/>
                    </div>
                    <div class="hg_col_element hg_pt_head">
                        <input type="text" class="hg_pt_field" name="hg_price_column[0][head]" value="<?php _e('Limited', 'hg_pricing_table'); ?>" placeholder="<?php _e('Head', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->pricing_table_column_customize(0); ?>
                        <?php echo $this->font_awesome_block(); ?>
                    </div>

                    <div class="hg_col_element hg_pt_hightlight">
                        <div class="hg_movable_price_row"></div>
                        <div class="hg_price_text">
                            <input type="text" class="hg_pt_field" value="<?php _e('Exclusive', 'hg_pricing_table'); ?>" name="hg_price_column[0][highlight_text]" placeholder="<?php _e('Highlight Text', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_price">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_show_hide_price_row">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <input type="hidden" class="hg_show_hide_price_row" name="hg_price_col_info[0][hide_price_row]" value="false"/>
                        </div>
                        <input type="text" class="hg_pt_field" value="<?php _e('$ 10', 'hg_pricing_table'); ?>" name="hg_price_column[0][price]" placeholder="<?php _e('Price Text', 'hg_pricing_table'); ?>">
                        <?php echo $this->font_awesome_block(); ?>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_delete_ft_row">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_0" data-ft-id="0">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[0][0][feature]" value="<?php _e('5 Email Accounts', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_delete_ft_row">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_1" data-ft-id="1">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[0][1][feature]" value="<?php _e('1 Template Style', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_delete_ft_row">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_2" data-ft-id="2">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[0][2][feature]" value="<?php _e('25 Products Loaded', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_delete_ft_row">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_3" data-ft-id="3">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[0][3][feature]" value="<?php _e('1 Image per Product', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_delete_ft_row">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_4" data-ft-id="4">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[0][4][feature]" value="<?php _e('Unlimited Bandwidth', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_button">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_show_hide_button_row">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            <input type="hidden" class="hg_show_hide_button_row" name="hg_price_col_info[0][hide_button_row]" value="false"/>
                        </div>
                        <input type="text" class="hg_pt_field" value="<?php _e('Sign Up', 'hg_pricing_table'); ?>" name="hg_price_column[0][button_text]" placeholder="<?php _e('Button Text', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->font_awesome_block(); ?>
                        <input type="text" class="hg_pt_link_field" value="" placeholder="http://" name="hg_price_column[0][button_link]">
                    </div>
                </div>

                <div class="hg_pt_column hg_col_1" data-i="1">
                    <div class="hg_movable_col"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
                    <span class="hg_delete_col"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <div class="hg_col_element hg_pt_head">
                        <input type="text" class="hg_pt_field" name="hg_price_column[1][head]" value="<?php _e('Pro', 'hg_pricing_table'); ?>" placeholder="<?php _e('Head', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->pricing_table_column_customize(1); ?>
                        <?php echo $this->font_awesome_block(); ?>
                    </div>

                    <div class="hg_col_element hg_pt_highlight">
                        <div class="best_seller">
                            <label for="best_sel_1"><?php _e('Highlight', 'hg_pricing_table'); ?></label>
                            <input type="checkbox" id="best_sel_1" name="hg_price_column[1][highlight]" value="1">
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_price">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="hg_pt_field" value="<?php _e('$ 30', 'hg_pricing_table'); ?>" name="hg_price_column[1][price]" placeholder="<?php _e('Price', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->font_awesome_block(); ?>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_0" data-ft-id="0">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[1][0][feature]" value="<?php _e('10 Email Accounts', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_1" data-ft-id="1">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[1][1][feature]" value="<?php _e('2 Template Styles', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_2" data-ft-id="2">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[1][2][feature]" value="<?php _e('30 Products Loaded', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_3" data-ft-id="3">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[1][3][feature]" value="<?php _e('5 Images per Product', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_4" data-ft-id="4">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[1][4][feature]" value="<?php _e('Unlimited Bandwidth', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_button">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="hg_pt_field" value="<?php _e('Sign Up', 'hg_pricing_table'); ?>" name="hg_price_column[1][button_text]" placeholder="<?php _e('Button Text', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->font_awesome_block(); ?>
                        <input type="text" class="hg_pt_link_field" value="" placeholder="http://" name="hg_price_column[1][button_link]">
                    </div>
                </div>

                <div class="hg_pt_column hg_col_2" data-i="2">
                    <div class="hg_movable_col"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
                    <span class="hg_delete_col"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <div class="hg_col_element hg_pt_head">
                        <input type="text" class="hg_pt_field" name="hg_price_column[2][head]" value="<?php _e('Exclusive', 'hg_pricing_table'); ?>" placeholder="<?php _e('Head', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->pricing_table_column_customize(2); ?>
                        <?php echo $this->font_awesome_block(); ?>
                    </div>

                    <div class="hg_col_element hg_pt_highlight">
                        <div class="best_seller">
                            <label for="best_sel_2"><?php _e('Highlight', 'hg_pricing_table'); ?></label>
                            <input type="checkbox" id="best_sel_2" name="hg_price_column[2][highlight]" value="2" checked="checked">
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_price">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="hg_pt_field" value="<?php _e('$ 60', 'hg_pricing_table'); ?>" name="hg_price_column[2][price]" placeholder="<?php _e('Price', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->font_awesome_block(); ?>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_0" data-ft-id="0">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[2][0][feature]" value="<?php _e('15 Email Accounts', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_1" data-ft-id="1">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[2][1][feature]" value="<?php _e('3 Template Styles', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_2" data-ft-id="2">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[2][2][feature]" value="<?php _e('40 Products Loaded', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_3" data-ft-id="3">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[2][3][feature]" value="<?php _e('7 Images per Product', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <div class="hg_pt_feature hg_feature_4" data-ft-id="4">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[2][4][feature]" value="<?php _e('Unlimited Bandwidth', 'hg_pricing_table'); ?>" placeholder="<?php _e('Feature Name', 'hg_pricing_table'); ?>"/>
                            <?php echo $this->font_awesome_block(); ?>
                        </div>
                    </div>

                    <div class="hg_col_element hg_pt_button">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        <input type="text" class="hg_pt_field" value="<?php _e('Sign Up', 'hg_pricing_table'); ?>" name="hg_price_column[2][button_text]" placeholder="<?php _e('Button Text', 'hg_pricing_table'); ?>"/>
                        <?php echo $this->font_awesome_block(); ?>
                        <input type="text" class="hg_pt_link_field" value="" placeholder="http://" name="hg_price_column[2][button_link]">
                    </div>
                </div>
            <?php } ?>
        </div>
        <div>
            <input type="hidden" id="columns_count" name="hg_price_table_columns_count" value="<?php if ( isset( $hg_price_table_columns_count ) && $hg_price_table_columns_count != "" ) {
                echo $hg_price_table_columns_count;
            } else {
                echo 3;
            } ?>"/>
        </div>
        <?php wp_nonce_field( 'action_pricing_table_nonce', 'pricing_table_nonce_field' ); ?>
        <div class="clear"></div>
    </div>
</div>