<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if($hg_price_col_info_data['first_col_hide'] == "false") {
    $hg_price_table_columns_count = absint($hg_price_table_columns_count);
} else {
    $hg_price_table_columns_count = absint($hg_price_table_columns_count) - 1;
}

?>

<style>
    .hugeit_ft_col {
    <?php
        if(isset($hg_price_table_columns_count) && $hg_price_table_columns_count != ""){
           echo 'width: calc('. (100/$hg_price_table_columns_count.'%' . ' - ' . (1 - (1/$hg_price_table_columns_count))).'% - '.(2 * 2 ).'px);';
           echo 'margin-left: 1%;';
       }
       else {
           echo 'width: calc('. (100/3 . '%' . ' - ' . (1 - (1/3))).'% - '.(2 * 2 ).'px);';
           echo 'margin-left: 1%;';
       }
        ?>;
    }

    <?php
    if((isset($hg_price_table_column_options) && $hg_price_table_column_options != "") && (isset($hg_price_table_columns_count) && $hg_price_table_columns_count != 0)) {

        if($hg_price_col_info_data['first_col_hide'] == "false") {
            $i = 0;
        }else {
            $i = 1;
            $hg_price_table_columns_count = $hg_price_table_columns_count + 1;
        }

         for ( $i ; $i < $hg_price_table_columns_count; $i ++ ) {
             ?>
            .plugin_version_features .hugeit_ft_col.hg_ft_col_<?php echo $i; ?> {
            <?php
                if(isset($hg_price_table_column_options[$i]['background_color']) && $hg_price_table_column_options[$i]['background_color'] != ""){
                    echo 'background-color: #'.$hg_price_table_column_options[$i]['background_color'].';';
                }
                else {
                    echo 'background-color: transparent;';
                }
                if(isset($hg_price_table_column_options[$i]['column_border_color']) && $hg_price_table_column_options[$i]['column_border_color'] != "") {
                    echo 'border-color: #'.$hg_price_table_column_options[$i]['column_border_color'].';';
                }
                else {
                    echo 'border-color: #ccc;';
                }
            ?>
            }

            .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_head {
            <?php
                if(isset($hg_price_table_column_options[$i]['header_text_color']) && $hg_price_table_column_options[$i]['header_text_color'] != "") {
                    echo 'color: #'.$hg_price_table_column_options[$i]['header_text_color'].';';
                }
                else {
                    echo 'color: #ccc;';
                }
            ?>
            }

            .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_price, .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_price_text {
            <?php
                if(isset($hg_price_table_column_options[$i]['price_text_color']) && $hg_price_table_column_options[$i]['price_text_color'] != "") {
                    echo 'color: #'.$hg_price_table_column_options[$i]['price_text_color'].';';
                }
                else {
                    echo 'color: #9f9f9f;';
                }
            ?>
            }

            .plugin_version_features .hg_ft_col_<?php echo $i; ?> i.fa {
            <?php
                if(isset($hg_price_table_column_options[$i]['awesome_icon_color']) && $hg_price_table_column_options[$i]['awesome_icon_color'] != "") {
                    echo 'color: #'.$hg_price_table_column_options[$i]['awesome_icon_color'].';';
                }
                else {
                    echo 'color: #9f9f9f;';
                }
            ?>
            }

            .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_head, .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_purchase_text, .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_price, .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_price_text, .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_features, .plugin_version_features h3:not(:last-child)  {
            <?php
                if(isset($hg_price_table_column_options[$i]['row_border_color']) && $hg_price_table_column_options[$i]['row_border_color'] != "") {
                    echo 'border-color: #'.$hg_price_table_column_options[$i]['row_border_color'].';';
                }
                else {
                    echo 'border-color: #ccc;';
                }
            ?>
            }

            <?php if($hg_price_col_info_data['hide_button_row'] == 'true') { ?>
                .plugin_version_features .hg_ft_col_<?php echo $i; ?> h3:last-child {
                    border-bottom: 0;
                }
            <?php
            }
            ?>

            .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_features, .plugin_version_features .hg_ft_col_<?php echo $i; ?> .huge_it_features_purchase_text {
            <?php
                if(isset($hg_price_table_column_options[$i]['features_color']) && $hg_price_table_column_options[$i]['features_color'] != "") {
                    echo 'color: #'.$hg_price_table_column_options[$i]['features_color'].';';
                }
                else {
                    echo 'color: #9f9f9f;';
                }
            ?>
            }

            <?php
        }
    }

?>
@media screen and (max-width: 1003px) {
    .hugeit_ft_col {
        width: calc(33.333333333333% - 1%);
    }
    .hugeit_ft_col:nth-child(3n + 1) {
        margin-left: 0;
    }
}

@media screen and (max-width: 768px) {
    .hugeit_ft_col {
        width: calc(50% - 1%);
    }
    .hugeit_ft_col:nth-child(3n + 1) {
        margin-left:1%;
    }
    .hugeit_ft_col:nth-child(2n + 1) {
        margin-left: 0;
    }
}

@media screen and (max-width: 600px) {
    .hugeit_ft_col:nth-child(3n + 1) {
        margin-left: 0;
    }
    .hugeit_ft_col {
        width: 100%;
        float: none;
        margin-left: 0;
    }
}

</style>