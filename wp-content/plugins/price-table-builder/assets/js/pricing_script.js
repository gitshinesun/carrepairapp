'use strict';
jQuery(document).ready(function () {

    /*
    * Adding Features Rows In Columns
    * */
    jQuery("#huge_it_new_plugin_versions").on("click", "#add_new_feature_button", function () {

        if(jQuery(".hg_first_column .hg_col_element").hasClass("hg_pt_feature_row")) {
            var last_ft_id = parseInt(jQuery('.hg_first_column .hg_pt_feature').last().attr('data-ft-id'))+ 1;
            var delete_ft_row = '';

                jQuery(".hg_pt_column").each(function(index){
                if(index == 0) {
                    delete_ft_row = `<div class="hg_pt_delete_ft_row">
                                         <i class="fa fa-times" aria-hidden="true"></i>
                                     </div>`;
                } else {
                    delete_ft_row = '';
                }
                jQuery(this).find('.hg_pt_feature_row').last().after(`
                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        `+ delete_ft_row +`
                        <div class="hg_pt_feature hg_feature_`+ last_ft_id +`" data-ft-id="`+ last_ft_id +`">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[`+ index +`][`+ last_ft_id +`][feature]" value="`+ hg_pricing_table.feature_name +`" placeholder="`+ hg_pricing_table.feature_name +`" />
                            `+ font_awesome_block() +`
                        </div>
                    </div>`);
            });
        } else {
            var last_ft_id = 0;

            jQuery(".hg_pt_column").each(function(index){
                if(index == 0) {
                    delete_ft_row = `
                         <div class="hg_pt_delete_ft_row">
                              <i class="fa fa-times" aria-hidden="true"></i>
                         </div>`;
                } else {
                    delete_ft_row = '';
                }
                jQuery(this).find('.hg_pt_price').after(`
                    <div class="hg_col_element hg_pt_feature_row">
                        <div class="hg_movable_item">
                            <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                        </div>
                        `+ delete_ft_row +`
                        <div class="hg_pt_feature hg_feature_`+ last_ft_id +`" data-ft-id="`+ last_ft_id +`">
                            <span class="hg_movable_feature"></span>
                            <input type="text" class="hg_pt_field" name="hg_price_column[`+ index +`][`+ last_ft_id +`][feature]" value="`+ hg_pricing_table.feature_name +`" placeholder="`+ hg_pricing_table.feature_name +`" />
                            `+ font_awesome_block() +`
                        </div>
                    </div>`);
            });
        }
    });

    /*
    * Remove Columns Row
    * */
    jQuery("#huge_it_new_plugin_versions").on("click", ".hg_pt_delete_ft_row", function () {
        var class_remove_row = jQuery(this).parent().find('.hg_pt_feature').attr('class').split(' ')[1];
        jQuery('.' + class_remove_row).parent().slideToggle("fast", function(){
            jQuery(this).remove();
        });
        row_sortable();
    });

    /* Change Columns Count */
    jQuery('#add_new_column').on('click', function () {

        var old_columns_count = parseInt(jQuery("#columns_count").val());
        var column_count = parseInt(jQuery("#columns_count").val()) + 1;
        var features_rows_count = parseInt(jQuery('.hg_first_column .hg_pt_feature').last().attr('data-ft-id')) + 1;
        var hg_feature_block = '';

        if(features_rows_count <=  1) {
                hg_feature_block = `
                <div class="hg_col_element hg_pt_feature_row">
					<div class="hg_pt_feature hg_feature_` + old_columns_count + `">
						<span class="hg_movable_item"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
						<input type="text" class="hg_pt_field" name="hg_price_column[` + old_columns_count + `][0][feature]" value="` + hg_pricing_table.feature_name + `" placeholder="`+ hg_pricing_table.feature_name +`" />
						` + font_awesome_block() + `
					</div>
				</div>`;
        } else {
            for(var i = 0; i <  features_rows_count; i ++){
                hg_feature_block += `
                <div class="hg_col_element hg_pt_feature_row">
					<div class="hg_pt_feature hg_feature_` + old_columns_count + `">
						<span class="hg_movable_item"><i class="fa fa-arrows-alt" aria-hidden="true"></i></span>
						<input type="text" class="hg_pt_field" name="hg_price_column[` + old_columns_count + `][` + i + `][feature]" value="` + hg_pricing_table.feature_name + `" placeholder="`+ hg_pricing_table.feature_name +`" />
						` + font_awesome_block() + `
					</div>
				</div>`;
            }
        }

        jQuery("#price_list_sortable").append(`
            <div class="hg_pt_column hg_col_`+ old_columns_count +`" data-i="`+ old_columns_count +`">
				<div class="hg_movable_col"><i class="fa fa-arrows-alt" aria-hidden="true"></i></div>
				<span class="hg_delete_col"><i class="fa fa-times" aria-hidden="true"></i></span>
				<div class="hg_col_element hg_pt_head">
					<input type="text" class="hg_pt_field" name="hg_price_column[`+ old_columns_count +`][head]" value="`+ hg_pricing_table.head +`" placeholder="`+ hg_pricing_table.head +`" />
					`+ add_column_style(old_columns_count) + font_awesome_block() +`
				</div>

				<div class="hg_col_element hg_pt_highlight">
					<div class="best_seller">
						<label for="best_sel_`+ old_columns_count +`">`+ hg_pricing_table.highlight +`</label>
						<input type="checkbox" id="best_sel_`+ old_columns_count +`" name="hg_price_column[`+ old_columns_count +`][highlight]" value="`+ old_columns_count +`" />
					</div>
				</div>
				<div class="hg_col_element hg_pt_price">
				    <div class="hg_movable_item">
                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                    </div>
					<input type="text" class="hg_pt_field" value="`+ hg_pricing_table.price + ' ' + old_columns_count +`0" name="hg_price_column[`+ old_columns_count +`][price]" placeholder="`+ hg_pricing_table.price +`" />
					`+ font_awesome_block() +`
				</div>
				
				`+ hg_feature_block +`

				<div class="hg_col_element hg_pt_button">
			    	<div class="hg_movable_item">
                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                    </div>
					<input type="text" class="hg_pt_field" value="`+ hg_pricing_table.button_text +`" name="hg_price_column[`+ old_columns_count +`][button_text]" placeholder="`+ hg_pricing_table.button_text +`" />
					`+ font_awesome_block() +`
					<input type="text" class="hg_pt_link_field" value=""  placeholder="http://" name="hg_price_column[`+ old_columns_count +`][button_link]" />
				</div>
			</div>`);

        jQuery("#columns_count").val(column_count);
        columns_sortable();
        row_sortable();
        row_dynamic_sortable();

    });

    /*
     * High Light Checkbox check or not check
     */
    jQuery("#price_list_sortable").on("click", ".best_seller input:checkbox", function () {
        jQuery("#price_list_sortable .hg_pt_column input:checkbox").not(this).attr('checked', false);
    });

    // Font Awesome Icons Block
    jQuery("#huge_it_features").on("click", ".huge_it_open_fa_icon", function () {
        jQuery(this).parent().find(".huge_it_font_awesome_block").css("display", "block");
        jQuery(this).css("display", "none");

    });

    /*
    * Show Hide First Column
    */
    jQuery(".hg_show_hide_first_column").on("click", function(){
       var show_hide_val = jQuery(this).find(".hg_first_col_hide_show").val();
       if(show_hide_val == "true"){
           jQuery(this).find(".hg_first_col_hide_show").val("false");
           jQuery(this).parent().removeClass("hg_first_col_hidden");
       }
       else  {
           jQuery(this).find(".hg_first_col_hide_show").val("true");
           jQuery(this).parent().addClass("hg_first_col_hidden");
       }
    });

    /*
     * Show Hide Price Row
     */
    jQuery(".hg_show_hide_price_row").on("click", function(){
        var show_hide_val = jQuery(this).find(".hg_show_hide_price_row").val();
        if(show_hide_val == "true"){
            jQuery(this).find(".hg_show_hide_price_row").val("false");
            jQuery(".hg_pt_price").removeClass("hg_price_row_hidden");
        }
        else  {
            jQuery(this).find(".hg_show_hide_price_row").val("true");
            jQuery(".hg_pt_price").addClass("hg_price_row_hidden");
        }
    });

    /*
     * Show Hide Button Row
     */
    jQuery(".hg_show_hide_button_row").on("click", function(){

        var show_hide_val = jQuery(this).find(".hg_show_hide_button_row").val();
        if(show_hide_val == "true"){
            jQuery(this).find(".hg_show_hide_button_row").val("false");
            jQuery(".hg_pt_button").removeClass("hg_price_row_hidden");
        }
        else  {
            jQuery(this).find(".hg_show_hide_button_row").val("true");
            jQuery(".hg_pt_button").addClass("hg_price_row_hidden");
        }
    });

    jQuery("#huge_it_features").on("click", ".huge_it_features_close", function () {
        jQuery(this).parent().css("display", "none");
        jQuery(this).parent().parent().find(".huge_it_open_fa_icon").css("display", "inline");
    });

    jQuery("#huge_it_features").on("click", "label i", function () {
        var font_icon_name = '[' + jQuery(this).parent().find("input").val() + ']';
        var plugin_feature_input = jQuery(this).parent().parent().parent().parent().find(".plugin_feature");
        var caretPos = plugin_feature_input[0].selectionStart;
        var textAreaTxt = plugin_feature_input.val();
        plugin_feature_input.val(textAreaTxt.substring(0, caretPos) + font_icon_name + textAreaTxt.substring(caretPos));
        jQuery(this).parent().parent().css("display", "none");
        jQuery(this).parent().parent().parent().find(".huge_it_open_fa_icon").css("display", "inline");
    });

    // Column Customize Block
    jQuery("#huge_it_features").on("click", ".huge_it_features_open_customize_block", function () {
        var hg_parent_class = jQuery(this).parent().parent().attr('class');
        jQuery("." + hg_parent_class).find(".huge_it_font_awesome_block").css("display", "none");
        jQuery("." + hg_parent_class).find(".huge_it_open_fa_icon").css("display", "inline");
        jQuery(this).parent().find(".huge_it_features_column_customize_block").slideToggle("fast", function(){
            if(jQuery(this).css('display') == 'block') {
                jQuery(this).parent().find(".hg-arrow-down").css({"border-bottom": "8px solid #fff", "border-top": "0"});
            }else {
                jQuery(this).parent().find(".hg-arrow-down").css({"border-top": "8px solid #fff", "border-bottom": "0"});
            }
        });
    });

    jQuery("#feature_show_rows_count").on('change keyup', function () {
        var show_row_count = jQuery(this).val();
        if (isNaN(parseInt(show_row_count)) || (!isFinite(show_row_count)) || show_row_count <= 1) {
            alert("You Can Write Only Numbers That Bigger Then 1");
            jQuery(this).val("");
        }
    });

    /*
    *  Sorting Columns Sortable
    * */
    jQuery("#price_list_sortable").sortable({
        items: ".hg_pt_column:not(.hg_first_column)",
        cursor: "move",
        update: function (event, ui) {
            columns_sortable();
            row_sortable();
        },
        revert: true
    });

    jQuery("#price_list_sortable").disableSelection();

    row_dynamic_sortable();

    function row_dynamic_sortable(){
        jQuery(".hg_pt_column").sortable({
            items: ".hg_col_element:not(.hg_pt_head)",
            axis: "y",
            cursor: "move",
            scroll: false,
            update: function (event, ui) {
                row_sortable();
            },
            revert: true
        });
        jQuery(".hg_pt_column").disableSelection();
    }

    /* Column Remove functions */

    jQuery("#huge_it_new_plugin_versions").on("click", ".hg_delete_col", function () {
        jQuery(this).parent().toggle("fast", function(){
            jQuery(this).remove();
            columns_sortable();
            row_sortable();
        });

        var new_columns_count = parseInt(jQuery("#columns_count").val()) - 1;
        jQuery("#columns_count").val(new_columns_count);
    });

    /*
    * Hg Price table Row Sorting
    * */
    function row_sortable() {

        if(jQuery(".hg_col_element").hasClass("hg_pt_feature_row")) {

            jQuery('.hg_pt_column').each(function (index) {
                jQuery(this).find('.hg_pt_feature_row').each(function (row_index) {
                    jQuery(".hg_pt_feature", this).attr("data-ft-id", row_index);
                    jQuery(this).find('.hg_pt_field', this).attr("name", "hg_price_column" + "[" + index + "]" + "[" + row_index + "][feature]");
                    jQuery(".hg_pt_feature", this).removeClass().addClass("hg_pt_feature hg_feature_" + row_index);
                });
            });

        }
    }

    /*
     *  Sorting Columns Sorting After Change Position Columns
     * */
    function columns_sortable() {

        jQuery(".hg_pt_column .huge_it_features_columns_customize:not(.hg_first_column)").each(function(index){
            jQuery(this).attr("data-column-id", index);
            jQuery(this).find(".hg_col_customize_bg_color input").attr("name", "hg_price_table_column_options[" + index + "][background_color]");
            jQuery(this).find(".hg_col_customize_bg_color input").attr("id", "column_" + index + "_background_color");
            jQuery(this).find(".hg_col_customize_bg_color label").attr("for", "column_" + index + "_background_color");

            jQuery(this).find(".hg_col_customize_header_text_color input").attr("name", "hg_price_table_column_options[" + index + "][header_text_color]");
            jQuery(this).find(".hg_col_customize_header_text_color input").attr("id", "column_" + index + "_header_text_color");
            jQuery(this).find(".hg_col_customize_header_text_color label").attr("for", "column_" + index + "_header_text_color");

            jQuery(this).find(".hg_col_customize_price_color input").attr("name", "hg_price_table_column_options[" + index + "][price_text_color]");
            jQuery(this).find(".hg_col_customize_price_color input").attr("id", "column_" + index + "_price_text_color");
            jQuery(this).find(".hg_col_customize_price_color label").attr("for", "column_" + index + "_price_text_color");

            jQuery(this).find(".hg_col_customize_awesome_icon_color input").attr("name", "hg_price_table_column_options[" + index + "][awesome_icon_color]");
            jQuery(this).find(".hg_col_customize_awesome_icon_color input").attr("id", "column_" + index + "_awesome_icon_color");
            jQuery(this).find(".hg_col_customize_awesome_icon_color label").attr("for", "column_" + index + "_awesome_icon_color");

            jQuery(this).find(".hg_col_customize_features_color input").attr("name", "hg_price_table_column_options[" + index + "][features_color]");
            jQuery(this).find(".hg_col_customize_features_color input").attr("id", "column_" + index + "_features_color");
            jQuery(this).find(".hg_col_customize_features_color label").attr("for", "column_" + index + "_features_color");

            jQuery(this).find(".hg_col_customize_column_border_color input").attr("name", "hg_price_table_column_options[" + index + "][column_border_color]");
            jQuery(this).find(".hg_col_customize_column_border_color input").attr("id", "column_" + index + "_border_color");
            jQuery(this).find(".hg_col_customize_column_border_color label").attr("for", "column_" + index + "_border_color");

            jQuery(this).find(".hg_col_customize_row_border_color input").attr("name", "hg_price_table_column_options[" + index + "][row_border_color]");
            jQuery(this).find(".hg_col_customize_row_border_color input").attr("id", "row_" + index + "_border_color");
            jQuery(this).find(".hg_col_customize_row_border_color label").attr("for", "row_" + index + "_border_color");
        });

        jQuery(".hg_pt_column:not(.hg_first_column)").each(function (index) {
            index = parseInt(index) + 1;
            jQuery(this).attr("data-i", ""+ index +"");
            jQuery(this).removeClass();
            jQuery(this).addClass("hg_pt_column hg_col_" + index);
        });

        jQuery(".hg_pt_column:not(.hg_first_column) .hg_pt_head").each(function (index) {
            index = parseInt(index) + 1;
            jQuery("input.hg_pt_field", this).attr("name", "hg_price_column["+ index +"][head]")
        });

        jQuery('.hg_pt_column:not(.hg_first_column) .hg_pt_highlight').each(function (index) {
            index = parseInt(index) + 1;
            jQuery("input", this).attr("name", "hg_price_column[" + index + "][highlight]");
            jQuery("input", this).val(index);
            jQuery("label", this).attr("for", "best_sel_" + index);
            jQuery("input", this).attr("id", "best_sel_" + index);
        });

        jQuery('.hg_pt_column:not(.hg_first_column) .hg_pt_price').each(function (index) {
            index = parseInt(index) + 1;
            jQuery("input.hg_pt_field", this).attr("name", "hg_price_column["+ index +"][price]");
        });

        jQuery('.hg_pt_column:not(.hg_first_column) .hg_pt_feature_row').each(function (index) {
            index = parseInt(index) + 1;
            var data_ft_id =jQuery(".hg_pt_feature", this).attr("data-ft-id");
            jQuery("input.hg_pt_field", this).attr("name", "hg_price_column["+ index +"]["+ data_ft_id +"][feature]");
        });

        jQuery('.hg_pt_column:not(.hg_first_column) .hg_pt_button').each(function (index) {
            index = parseInt(index) + 1;
            jQuery("input.hg_pt_field", this).attr("name", "hg_price_column["+ index +"][button_text]");
            jQuery("input.hg_pt_link_field", this).attr("name", "hg_price_column["+ index +"][button_link]");
        });
    }

    /*
    * Inserting Font Awesome In Field Function Current Position
    * */
    jQuery("#price_list_sortable").on("click", ".hg_col_element label i", function () {
        var font_icon_name = '[' + jQuery(this).parent().find("input").val() + ']';
        var plugin_feature_input = jQuery(this).parent().parent().parent().parent().find(".hg_pt_field");
        var caretPos = plugin_feature_input[0].selectionStart;
        var textAreaTxt = plugin_feature_input.val();
        plugin_feature_input.val(textAreaTxt.substring(0, caretPos) + font_icon_name + textAreaTxt.substring(caretPos));
        jQuery(this).parent().parent().css("display", "none");
        jQuery(this).parent().parent().parent().find(".huge_it_open_fa_icon").css("display", "inline");
    });

    /*
    *  Columns Customize Block
    * */
    function add_column_style(i) {
        return `<div class="huge_it_features_columns_customize" data-column-id="' + i + '">
                    <div class="huge_it_features_column_customize_block">
                        <div class="hg_col_customize_bg_color">
                            <label class="color_picker_label features-label" for="column_` + i + `_background_color">` + hg_pricing_table.background_color + `</label>
                            <input class="jscolor" type="text" id="column_` + i + `_background_color" name="hg_price_table_column_options[` + i + `][background_color]" value="fff"/>
                        </div>
                        <div class="hg_col_customize_header_text_color">
                            <label class="color_picker_label features-label" for="column_` + i + `_header_text_color">` + hg_pricing_table.header_text_color + `</label>
                            <input class="jscolor" type="text" id="column_` + i + `_header_text_color" name="hg_price_table_column_options[` + i + `][header_text_color]" value="565656"/>
                        </div>
                        <div class="hg_col_customize_price_color">
                            <label class="color_picker_label features-label" for="column_` + i + `_price_text_color">` + hg_pricing_table.price_text_color + `</label>
                            <input class="jscolor" type="text" id="column_` + i + `_price_text_color" name="hg_price_table_column_options[` + i + `][price_text_color]" value="9f9f9f"/>
                        </div>
                        <div class="hg_col_customize_awesome_icon_color">
                            <label class="color_picker_label features-label" for="column_` + i + `_awesome_icon_color">` + hg_pricing_table.font_awesome_icon_color + `</label>
                            <input class="jscolor" type="text" id="column_` + i + `_awesome_icon_color" name="hg_price_table_column_options[` + i + `][awesome_icon_color]" value="9f9f9f"/>
                        </div>
                        <div class="hg_col_customize_features_color">
                            <label class="color_picker_label features-label" for="column_` + i + `_features_color">` + hg_pricing_table.features_text_color + `</label>
                            <input class="jscolor" type="text" id="column_` + i + `_features_color" name="hg_price_table_column_options[` + i + `][features_color]" value="2d3d4f"/>
                        </div>
                        <div class="hg_col_customize_column_border_color">
                            <label class="color_picker_label features-label" for="column_` + i + `_border_color">` + hg_pricing_table.column_border_color + `</label>
                            <input class="jscolor" type="text" id="column_` + i + `_border_color" name="hg_price_table_column_options[` + i + `][column_border_color]" value="ccc"/>
                        </div>
                        <div class="hg_col_customize_row_border_color">
                            <label class="color_picker_label features-label" for="row_` + i + `_border_color">` + hg_pricing_table.row_border_color + `</label>
                            <input class="jscolor" type="text" id="row_` + i + `_border_color" name="hg_price_table_column_options[` + i + `][row_border_color]" value="ccc"/>
                        </div>
                    </div>
                   <span class="huge_it_features_open_customize_block">` + hg_pricing_table.column_customize + `<span class="hg-arrow-down"></span></span>
                </div>`;
    };

    /*
    * Font Awesome Icons Block
    * */
    function font_awesome_block() {

        var font_awesome_array = ['fa-pencil-square-o',
            'fa-bell',
            'fa-star',
            'fa-heart',
            'fa-globe',
            'fa-ban',
            'fa-dropbox',
            'fa-diamond',
            'fa-anchor',
            'fa-recycle',
            'fa-files-o',
            'fa-gift',
            'fa-asterisk',
            'fa-book',
            'fa-refresh',
            'fa-cc-visa',
            'fa-cc-mastercard',
            'fa-cc-paypal',
            'fa-cc-amex',
            'fa-paypal',
            'fa-credit-card-alt',
            'fa-credit-card',
            'fa-usd',
            'fa-eur',
            'fa-rub',
            'fa-ils',
            'fa-krw',
            'fa-jpy',
            'fa-try',
            'fa-gbp',
            'fa-inr',
            'fa-btc',
            'fa-windows',
            'fa-apple',
            'fa-android',
            'fa-linux',
            'fa-wordpress',
            'fa-drupal',
            'fa-joomla',
            'fa-opencart',
            'fa-opera',
            'fa-chrome',
            'fa-internet-explorer',
            'fa-edge',
            'fa-firefox',
            'fa-safari',
            'fa-html5',
            'fa-css3',
            'fa-google',
            'fa-google-plus',
            'fa-google-plus-square',
            'fa-google-plus-official',
            'fa-facebook',
            'fa-facebook-square',
            'fa-youtube-play',
            'fa-youtube',
            'fa-youtube-square',
            'fa-pinterest-p',
            'fa-pinterest',
            'fa-pinterest-square',
            'fa-linkedin',
            'fa-linkedin-square',
            'fa-twitter',
            'fa-twitter-square',
            'fa-vk',
            'fa-odnoklassniki',
            'fa-instagram',
            'fa-vimeo',
            'fa-vimeo-square',
            'fa-yahoo',
            'fa-reddit',
            'fa-skype',
            'fa-steam',
            'fa-twitch',
            'fa-whatsapp',
            'fa-github',
            'fa-gitlab',
            'fa-envelope-o',
            'fa-share-alt',
            'fa-slack',
            'fa-car',
            'fa-bicycle',
            'fa-motorcycle',
            'fa-ship',
            'fa-train',
            'fa-subway',
            'fa-plane',
            'fa-rocket',
            'fa-thumbs-o-up',
            'fa-thumbs-up',
            'fa-hand-peace-o',
            'fa-usb',
            'fa-wifi',
            'fa-headphones',
            'fa-camera-retro',
            'fa-camera',
            'fa-bluetooth',
            'fa-desktop',
            'fa-mobile',
            'fa-fax',
            'fa-check',
            'fa-times',
            'fa-check-square',
            'fa-check-circle-o',
            'fa-check-circle',
            'fa-lock',
            'fa-cogs',
            'fa-flag',
            'fa-bolt',
            'fa-map',
            'fa-pie-chart',
            'fa-paper-plane',
            'fa-paper-plane-o',
            'fa-file',
            'fa-file-text',
            'fa-file-image-o',
            'fa-file-video-o',
            'fa-area-chart',
            'fa-key',
            'fa-birthday-cake'
        ];

        var font_awesome = `<div class="huge_it_choose_fa_icon">
                    <div class="huge_it_font_awesome_block">
                        <span class="huge_it_features_close">+</span>
                        <h3>` + hg_pricing_table.choose_font_awesome_icon + `</h3>`;

        font_awesome_array.forEach(function(item) {
            font_awesome += `<label class="font_awesome_label">
                            <input type="radio" class="${item}" value="${item}"/>
                            <i class="fa ${item}" aria-hidden="true"></i>
                    </label>`;
        });

        font_awesome += `<div class="clear"></div>
                    </div>
                    <span class="huge_it_open_fa_icon">` + hg_pricing_table.icon + `</span>
                </div>`;

        return font_awesome;
    }
});