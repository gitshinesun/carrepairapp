<?php
if (!defined('ABSPATH'))
    exit;
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}
$styleid = (int) $_GET['styleid'];

global $wpdb;
$table_list = $wpdb->prefix . 'image_hover_with_carousel_list';
$table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
$title = '';
$files = '';
$link = '';
$bottom = '';
$image = '';
$itemid = '';

if (!empty($_POST['submit']) && $_POST['submit'] == 'submit') {
    $ihtitle = sanitize_text_field($_POST['ihewc-title']);
    $ihfiles = sanitize_text_field($_POST['ihewc-desc']);
    $ihbotton = sanitize_text_field($_POST['ihewc-bottom']);
    $ihlink = sanitize_text_field($_POST['ihewc-link']);
    $ihimage = sanitize_text_field($_POST['ihewc-image-upload-url']);
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewcsavedata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        if ($_POST['item-id'] == '') {
            $css = 'image-effects |ihewc-blur| image-background-color |#0081cc| image-alignments |ihewc-layout-horizontal-center ihewc-layout-vertical-middle| title-color |#ffffff| title-animation |ihewc-zoom-in| desc-color |#ffffff| desc-animation |ihewc-zoom-in| buttom-color |#00a88f| buttom-animation |ihewc-zoom-in| buttom-background |#fafafa| image-style |blur-effects|';
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (title, files, buttom_text, link, image, css, styleid) VALUES ( %s, %s, %s, %s, %s, %s, %d)", array($ihtitle, $ihfiles, $ihbotton, $ihlink, $ihimage, $css, $styleid)));
        }
        if ($_POST['item-id'] != '' && is_numeric($_POST['item-id'])) {
            $item_id = (int) $_POST['item-id'];
            $wpdb->update("$table_list", array("title" => $ihtitle, "files" => $ihfiles, "buttom_text" => $ihbotton, "link" => $ihlink, "image" => $ihimage), array('id' => $item_id), array('%s', '%s', '%s', '%s', '%s'), array('%d'));
        }
    }
}

if (!empty($_POST['edit']) && is_numeric($_POST['item-id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewceditdata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $item_id), ARRAY_A);
        $title = $data['title'];
        $files = $data['files'];
        $link = $data['link'];
        $bottom = $data['buttom_text'];
        $image = $data['image'];
        $itemid = $item_id;
        echo '<script type="text/javascript"> jQuery(document).ready(function () {setTimeout(function() { jQuery("#ihewc-add-new-item-data").modal("show")  }, 500); });</script>';
    }
}
if (!empty($_POST['edit-css']) && is_numeric($_POST['item-id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewceditstyle')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $listcss = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $item_id), ARRAY_A);
        $listcss = $listcss['css'];
        $data = explode('|', $listcss);
        $imageeffects = $data[1];
        $imagebackgroundcolor = $data[3];
        $imagealignments = $data[5];
        $titlecolor = $data[7];
        $titleanimation = $data[9];
        $desccolor = $data[11];
        $descanimation = $data[13];
        $buttomcolor = $data[15];
        $buttomanimation = $data[17];
        $buttombackground = $data[19];
        $imagestyle = $data[21];
        $itemcssid = $item_id;

        echo '<script type="text/javascript"> jQuery(document).ready(function () {setTimeout(function() { jQuery("#ihewc-edit-css").modal("show")  }, 500); });</script>';
    }
}
if (!empty($_POST['delete']) && is_numeric($_POST['item-id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewcdeletedata')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $wpdb->query($wpdb->prepare("DELETE FROM {$table_list} WHERE id = %d ", $item_id));
    }
}

if (!empty($_POST['submit-css']) && $_POST['submit-css'] == 'Save' && is_numeric($_POST['itemcssid'])) {
    $itemcssid = (int) $_POST['itemcssid'];
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewcsavestyle')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $css = ' image-effects |' . sanitize_text_field($_POST['image-effects']) . '|'
                . ' image-background-color |#0081cc|'
                . ' image-alignments |' . sanitize_text_field($_POST['image-alignments']) . '|'
                . ' title-color |#FFF|'
                . ' title-animation ||'
                . ' desc-color |#FFF|'
                . ' desc-animation ||'
                . ' buttom-color |#00a88f|'
                . ' buttom-animation ||'
                . ' buttom-background |#fafafa|'
                . ' image-style |' . sanitize_text_field($_POST['image-style']) . '|';
        $css = sanitize_text_field($css);
        $wpdb->query($wpdb->prepare("UPDATE {$table_list} SET css = %s WHERE id = %d", $css, $itemcssid));
    }
}
if (!empty($_POST['data-submit']) && $_POST['data-submit'] == 'Save') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewcstylecss')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $data = 'ihewc-image-type |' . sanitize_text_field($_POST['ihewc-image-type']) . '|'
                . ' ihewc-item |' . sanitize_text_field($_POST['ihewc-item']) . '|'
                . ' ihewc-showing-type |' . sanitize_text_field($_POST['ihewc-showing-type']) . '|'
                . ' image-height |' . sanitize_text_field($_POST['image-height']) . '|'
                . ' image-padding |' . sanitize_text_field($_POST['image-padding']) . '|'
                . ' ihewc-new-tab |' . sanitize_text_field($_POST['ihewc-new-tab']) . '|'
                . ' box-shadow |0|'
                . ' box-shadow-color |' . sanitize_hex_color($_POST['box-shadow-color']) . '|'
                . ' heading-font-size |' . sanitize_text_field($_POST['heading-font-size']) . '|'
                . ' heading-font-familly |Open+Sans|'
                . ' heading-font-weight |' . sanitize_text_field($_POST['heading-font-weight']) . '|'
                . ' ihewc-heading-underline |' . sanitize_text_field($_POST['ihewc-heading-underline']) . '|'
                . ' heading-padding-bottom |' . sanitize_text_field($_POST['heading-padding-bottom']) . '|'
                . ' desc-font-size |' . sanitize_text_field($_POST['desc-font-size']) . '|'
                . ' desc-font-familly |Open+Sans|'
                . ' desc-font-weight |' . sanitize_text_field($_POST['desc-font-weight']) . '|'
                . ' desc-padding-bottom |' . sanitize_text_field($_POST['desc-padding-bottom']) . '|'
                . ' button-font-size |' . sanitize_text_field($_POST['button-font-size']) . '|'
                . ' button-font-familly |Open+Sans|'
                . ' button-font-weight |' . sanitize_text_field($_POST['button-font-weight']) . '|'
                . ' button-padding-bottom |' . sanitize_text_field($_POST['button-padding-bottom']) . '|'
                . ' button-padding-left |' . sanitize_text_field($_POST['button-padding-left']) . '|'
                . ' button-border-radius |' . sanitize_text_field($_POST['button-border-radius']) . '|'
                . ' ihewc-css ||'
                . ' image-margin |' . sanitize_text_field($_POST['image-margin']) . '|'
                . ' carousel-autoplay |' . sanitize_text_field($_POST['carousel-autoplay']) . '|'
                . ' carousel-auto-timing |2000|'
                . ' ihewc-animations ||'
                . ' animation-timing |' . sanitize_text_field($_POST['animation-timing']) . '| |';
        $data = sanitize_text_field($data);
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET css = %s WHERE id = %d", $data, $styleid));
    }
}
$listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
$styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
$styledata = $styledata['css'];
$styledata = explode('|', $styledata);
?>

<div class="wrap">
    <div class="ctu-admin-wrapper-promote">
        <div class="col-lg-5 col-md-5 hidden-sm hidden-xs">
            <h1>Image Hover Effects with <span>Carousel</span></h1>
            <p>If you have any difficulties in using the options, please follow the link to <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time/">Documentation</a> </p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xm-12">
            <p><a target="_blank" href="https://www.oxilab.org/downloads/image-hover-with-carousel/" class="ctu-admin-wrapper-promote-botton"><i class="fa fa-cart-plus" aria-hidden="true"></i> Upgrade NOW </a> <br> Just click on "Upgrade NOW" to get Pro Version only $11.99.</p>
        </div>
        <div class="col-lg-3 col-md-3  hidden-sm hidden-xs ctu-admin-wrapper-promote-rate">
            <p> <i class="fa fa-heart" aria-hidden="true"></i>  <a target="_blank" href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel/reviews/">Rate Us</a></p>
            <p> <i class="fa fa-life-ring" aria-hidden="true"></i>  <a target="_blank" href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel/">Support Ticket</a></p>
            <p> <i class="fa fa-envelope" aria-hidden="true"></i>  <a target="_blank" href="https://www.oxilab.org/contact-us/">Contact Oxilab</a></p>
            <p> <i class="fa fa-youtube" aria-hidden="true"></i> <a target="_blank" href="https://youtu.be/44L2Q6ahOtI">Video Tutorials</a></p>
        </div>
    </div>
    <div class="ihewc-admin-wrapper">
        <div class="ihewc-admin-row">
            <div class="ihewc-style-panel-left">
                <div class="ihewc-style-setting-panel">
                    <form method="post">
                        <div class="ctu-ultimate-wrapper-3"> 
                            <ul class="ctu-ulimate-style-3">  
                                <li ref="#ctu-ulitate-style-3-id-6" class="">
                                    General
                                </li>  
                                <li ref="#ctu-ulitate-style-3-id-5" class="">
                                    Typography
                                </li> 
                                <li ref="#ctu-ulitate-style-3-id-2">
                                    Custom CSS
                                </li>
                                <li ref="#ctu-ulitate-style-3-id-1">
                                   Quick Support
                                </li>
                            </ul>

                            <div class="ctu-ultimate-style-3-content">
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-6">
                                    <div class="ihewc-admin-style-settings-div-left">
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Which Type Hover you Want? Circle or Square">Image Type</label>
                                            <div class="col-sm-6 nopadding">

                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[1] == '50') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-image-type" id="ihewc-image-type-circle" autocomplete="off" <?php
                                                        if ($styledata[1] == '50') {
                                                            echo 'checked';
                                                        }
                                                        ?> value="50"> Circle
                                                    </label>
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[1] == '0') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-image-type" id="ihewc-image-type-square" autocomplete="off"  <?php
                                                        if ($styledata[1] == '0') {
                                                            echo 'checked';
                                                        }
                                                        ?>  value="0"> Square
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="ihewc-item" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize How mane Item You want to Show in a single Row ">Item Per Row </label>
                                            <div class="col-sm-6 nopadding">
                                                <select class="form-control" id="ihewc-item" name="ihewc-item">
                                                    <option value="ihewc-responsive-1" <?php
                                                    if ($styledata[3] == 'ihewc-responsive-1') {
                                                        echo 'selected';
                                                    }
                                                    ?> >Single Item per Row</option>
                                                    <option value="ihewc-responsive-2" <?php
                                                    if ($styledata[3] == 'ihewc-responsive-2') {
                                                        echo 'selected';
                                                    }
                                                    ?>>2 Items per Row</option>
                                                    <option value="ihewc-responsive-3"  <?php
                                                    if ($styledata[3] == 'ihewc-responsive-3') {
                                                        echo 'selected';
                                                    }
                                                    ?>>3 Items per Row</option>
                                                    <option value="ihewc-responsive-4" <?php
                                                    if ($styledata[3] == 'ihewc-responsive-4') {
                                                        echo 'selected';
                                                    }
                                                    ?>>4 Items per Row</option>
                                                    <option value="ihewc-responsive-5" <?php
                                                    if ($styledata[3] == 'ihewc-responsive-5') {
                                                        echo 'selected';
                                                    }
                                                    ?>>5 Items per Row</option>
                                                    <option value="ihewc-responsive-6" <?php
                                                    if ($styledata[3] == 'ihewc-responsive-6') {
                                                        echo 'selected';
                                                    }
                                                    ?>>6 Items per Row</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title=" Slide or Grid">Showing Type</label>
                                            <div class="col-sm-6 nopadding">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[5] == '') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-showing-type" id="ihewc-showing-type-normal" autocomplete="off" <?php
                                                        if ($styledata[5] == '') {
                                                            echo 'checked';
                                                        }
                                                        ?> value=""> Normal
                                                    </label>
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[5] == 'carousel') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-showing-type" id="ihewc-showing-type-carousel" autocomplete="off" value="carousel"  <?php
                                                        if ($styledata[5] == 'carousel') {
                                                            echo 'checked';
                                                        }
                                                        ?>> Carousel
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row " id="carousel-autoplay-hidden-show">
                                            <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Slide AutoPlay Yes or No">Autoplay</label>
                                            <div class="col-sm-6 nopadding">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[51] == 'true') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="carousel-autoplay" id="carousel-autoplay-on" autocomplete="off" <?php
                                                        if ($styledata[51] == 'true') {
                                                            echo 'checked';
                                                        }
                                                        ?> value="true"> Yes
                                                    </label>
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[51] == 'false') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="carousel-autoplay" id="carousel-autoplay-off" autocomplete="off" value="false"  <?php
                                                        if ($styledata[51] == 'false') {
                                                            echo 'checked';
                                                        }
                                                        ?>> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm" id="carousel-autoplay-time-show">
                                            <label for="carousel-auto-timing" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Slide Autoplay moveable Time 1 Seconds = 1000ms" >Autoplay Time <span class="ctu-pro-only">Pro Only</span></label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" min="100" step="10" max="10000" id="carousel-auto-timing" name="carousel-auto-timing" value="<?php echo $styledata[53]; ?>">
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            jQuery(document).ready(function () {
                                                if (jQuery('#ihewc-showing-type-carousel').attr('checked')) {
                                                    jQuery("#carousel-autoplay-hidden-show").slideDown();
                                                }
                                                if (jQuery('#ihewc-showing-type-carousel').attr('checked')) {
                                                    if (jQuery('#carousel-autoplay-on').attr('checked')) {
                                                        jQuery("#carousel-autoplay-time-show").slideDown();
                                                    }
                                                }
                                            });
                                        </script>
                                        <div class="form-group row form-group-sm">
                                            <label for="image-height" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Height, Our Auto Set make it on percentize with width for responsive , Such as for Square Image make it 100" >Image Height</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" min="30" step="1" max="300" id="image-height" name="image-height" value="<?php echo $styledata[7]; ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="ihewc-admin-style-settings-div-right">
                                        <div class="form-group row form-group-sm">
                                            <label for="ihewc-animations" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Animation when Our Image Will View">View Animation  <span class="ctu-pro-only">Pro Only</span></label>
                                            <div class="col-sm-6 nopadding">
                                                <select class="form-control" id="ihewc-animations" name="ihewc-animations">
                                                    <optgroup label="Attention Seekers">
                                                        <option value="bounce" <?php
                                                        if ($styledata[55] == 'bounce') {
                                                            echo 'selected';
                                                        }
                                                        ?>>bounce</option>
                                                        <option value="flash"  <?php
                                                        if ($styledata[55] == 'flash') {
                                                            echo 'selected';
                                                        }
                                                        ?>>flash</option>
                                                        <option value="pulse"  <?php
                                                        if ($styledata[55] == 'pulse') {
                                                            echo 'selected';
                                                        }
                                                        ?>>pulse</option>
                                                        <option value="rubberBand" <?php
                                                        if ($styledata[55] == 'rubberBand') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rubberBand</option>
                                                        <option value="shake" <?php
                                                        if ($styledata[55] == 'shake') {
                                                            echo 'selected';
                                                        }
                                                        ?>>shake</option>
                                                        <option value="swing" <?php
                                                        if ($styledata[55] == 'swing') {
                                                            echo 'selected';
                                                        }
                                                        ?>>swing</option>
                                                        <option value="tada" <?php
                                                        if ($styledata[55] == 'tada') {
                                                            echo 'selected';
                                                        }
                                                        ?>>tada</option>
                                                        <option value="wobble" <?php
                                                        if ($styledata[55] == 'wobble') {
                                                            echo 'selected';
                                                        }
                                                        ?>>wobble</option>
                                                        <option value="jello" <?php
                                                        if ($styledata[55] == 'jello') {
                                                            echo 'selected';
                                                        }
                                                        ?>>jello</option>
                                                    </optgroup>
                                                    <optgroup label="Bouncing Entrances">
                                                        <option value="bounceIn" <?php
                                                        if ($styledata[55] == 'bounceIn') {
                                                            echo 'selected';
                                                        }
                                                        ?>>bounceIn</option>
                                                        <option value="bounceInDown" <?php
                                                        if ($styledata[55] == 'bounceInDown') {
                                                            echo 'selected';
                                                        }
                                                        ?>>bounceInDown</option>
                                                        <option value="bounceInLeft" <?php
                                                        if ($styledata[55] == 'bounceInLeft') {
                                                            echo 'selected';
                                                        }
                                                        ?>>bounceInLeft</option>
                                                        <option value="bounceInRight" <?php
                                                        if ($styledata[55] == 'bounceInRight') {
                                                            echo 'selected';
                                                        }
                                                        ?>>bounceInRight</option>
                                                        <option value="bounceInUp" <?php
                                                        if ($styledata[55] == 'bounceInUp') {
                                                            echo 'selected';
                                                        }
                                                        ?>>bounceInUp</option>
                                                    </optgroup>
                                                    <optgroup label="Fading Entrances">
                                                        <option value="fadeIn" <?php
                                                        if ($styledata[55] == 'fadeIn') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeIn</option>
                                                        <option value="fadeInDown" <?php
                                                        if ($styledata[55] == 'fadeInDown') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInDown</option>
                                                        <option value="fadeInDownBig" <?php
                                                        if ($styledata[55] == 'fadeInDownBig') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInDownBig</option>
                                                        <option value="fadeInLeft" <?php
                                                        if ($styledata[55] == 'fadeInLeft') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInLeft</option>
                                                        <option value="fadeInLeftBig" <?php
                                                        if ($styledata[55] == 'fadeInLeftBig') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInLeftBig</option>
                                                        <option value="fadeInRight" <?php
                                                        if ($styledata[55] == 'fadeInRight') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInRight</option>
                                                        <option value="fadeInRightBig" <?php
                                                        if ($styledata[55] == 'fadeInRightBig') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInRightBig</option>
                                                        <option value="fadeInUp" <?php
                                                        if ($styledata[55] == 'fadeInUp') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInUp</option>
                                                        <option value="fadeInUpBig" <?php
                                                        if ($styledata[55] == 'fadeInUpBig') {
                                                            echo 'selected';
                                                        }
                                                        ?>>fadeInUpBig</option>
                                                    </optgroup>
                                                    <optgroup label="Flippers">
                                                        <option value="flip" <?php
                                                        if ($styledata[55] == 'flip') {
                                                            echo 'selected';
                                                        }
                                                        ?>>flip</option>
                                                        <option value="flipInX" <?php
                                                        if ($styledata[55] == 'flipInX') {
                                                            echo 'selected';
                                                        }
                                                        ?>>flipInX</option>
                                                        <option value="flipInY" <?php
                                                        if ($styledata[55] == 'flipInY') {
                                                            echo 'selected';
                                                        }
                                                        ?>>flipInY</option>
                                                    </optgroup>
                                                    <optgroup label="Lightspeed">
                                                        <option value="lightSpeedIn" <?php
                                                        if ($styledata[55] == 'lightSpeedIn') {
                                                            echo 'selected';
                                                        }
                                                        ?>>lightSpeedIn</option>
                                                    </optgroup>

                                                    <optgroup label="Rotating Entrances">
                                                        <option value="rotateIn"  <?php
                                                        if ($styledata[55] == 'rotateIn') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rotateIn</option>
                                                        <option value="rotateInDownLeft" <?php
                                                        if ($styledata[55] == 'rotateInDownLeft') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rotateInDownLeft</option>
                                                        <option value="rotateInDownRight" <?php
                                                        if ($styledata[55] == 'rotateInDownRight') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rotateInDownRight</option>
                                                        <option value="rotateInUpLeft" <?php
                                                        if ($styledata[55] == 'rotateInUpLeft') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rotateInUpLeft</option>
                                                        <option value="rotateInUpRight" <?php
                                                        if ($styledata[55] == 'rotateInUpRight') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rotateInUpRight</option>
                                                    </optgroup>
                                                    <optgroup label="Sliding Entrances">
                                                        <option value="slideInUp" <?php
                                                        if ($styledata[55] == 'slideInUp') {
                                                            echo 'selected';
                                                        }
                                                        ?>>slideInUp</option>
                                                        <option value="slideInDown" <?php
                                                        if ($styledata[55] == 'slideInDown') {
                                                            echo 'selected';
                                                        }
                                                        ?>>slideInDown</option>
                                                        <option value="slideInLeft" <?php
                                                        if ($styledata[55] == 'slideInLeft') {
                                                            echo 'selected';
                                                        }
                                                        ?>>slideInLeft</option>
                                                        <option value="slideInRight" <?php
                                                        if ($styledata[55] == 'slideInRight') {
                                                            echo 'selected';
                                                        }
                                                        ?>>slideInRight</option>
                                                    </optgroup>
                                                    <optgroup label="Zoom Entrances">
                                                        <option value="zoomIn" <?php
                                                        if ($styledata[55] == 'zoomIn') {
                                                            echo 'selected';
                                                        }
                                                        ?>>zoomIn</option>
                                                        <option value="zoomInDown" <?php
                                                        if ($styledata[55] == 'zoomInDown') {
                                                            echo 'selected';
                                                        }
                                                        ?>>zoomInDown</option>
                                                        <option value="zoomInLeft" <?php
                                                        if ($styledata[55] == 'zoomInLeft') {
                                                            echo 'selected';
                                                        }
                                                        ?>>zoomInLeft</option>
                                                        <option value="zoomInRight" <?php
                                                        if ($styledata[55] == 'zoomInRight') {
                                                            echo 'selected';
                                                        }
                                                        ?>>zoomInRight</option>
                                                        <option value="zoomInUp" <?php
                                                        if ($styledata[55] == 'zoomInUp') {
                                                            echo 'selected';
                                                        }
                                                        ?>>zoomInUp</option>
                                                    </optgroup>
                                                    <optgroup label="Specials">
                                                        <option value="hinge" <?php
                                                        if ($styledata[55] == 'hinge') {
                                                            echo 'selected';
                                                        }
                                                        ?>>hinge</option>
                                                        <option value="rollIn" <?php
                                                        if ($styledata[55] == 'rollIn') {
                                                            echo 'selected';
                                                        }
                                                        ?>>rollIn</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="animation-timing" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title=" Animation Duration " >Animation Duration</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" min="0.1" step="0.1" max="10" id="animation-timing" name="animation-timing" value="<?php echo $styledata[57]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="image-margin" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Distance Between Image to Image, Based on Pixel" >Image Margin</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number"  min="0" step="5" max="300" class="form-control" id="image-margin" name="image-margin" value="<?php echo $styledata[49]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="image-padding" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Image Padding to make more closser with image elements" >Image Padding</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number"  min="0" step="5" max="300" class="form-control" id="image-padding" name="image-padding" value="<?php echo $styledata[9]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="Image or Button Text Url Open System. Same Browser or New Tabs">Open New Tab?</label>
                                            <div class="col-sm-6 nopadding">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[11] == '_blank') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-new-tab" autocomplete="off"  value="_blank" <?php
                                                        if ($styledata[11] == '_blank') {
                                                            echo 'checked';
                                                        }
                                                        ?>> Yes
                                                    </label>
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[11] == '') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-new-tab"  autocomplete="off" value=""  <?php
                                                        if ($styledata[11] == '') {
                                                            echo '';
                                                        }
                                                        ?>> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="box-shadow" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Add box Shadow on Your Image or Hover Items, No need means make 0" >Box Shadow <span class="ctu-pro-only">Pro Only</span></label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="box-shadow" name="box-shadow" value="<?php echo $styledata[13]; ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="box-shadow-color" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Customize Your Box Shadow Color">Box Shadow Color</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="numer" class="form-control ihewc-vendor-color" id="box-shadow-color" name="box-shadow-color" value="<?php echo $styledata[15]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-5">
                                    <div class="ihewc-admin-style-settings-div-left">
                                        <div class="form-group row form-group-sm">
                                            <label for="heading-font-size" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Your Heanding or Title font size" >Heading font Size</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="heading-font-size" name="heading-font-size" value="<?php echo $styledata[17]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="heading-font-familly" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Choose Your Title Preferred font, Based on Google Font"> Font Family  <span class="ctu-pro-only">Pro Only</span></label>
                                            <div class="col-sm-6 nopadding">
                                                <input class="ihewc-admin-font" type="text" name="heading-font-familly" id="heading-font-familly" value="<?php echo $styledata[19]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="heading-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Title Font Style">Font Weight</label>
                                            <div class="col-sm-6 nopadding">
                                                <select class="form-control" id="heading-font-weight" name="heading-font-weight">
                                                    <option value="100"     <?php
                                                    if ($styledata[21] == '100') {
                                                        echo 'selected';
                                                    };
                                                    ?>>100</option>
                                                    <option value="200"     <?php
                                                    if ($styledata[21] == '200') {
                                                        echo 'selected';
                                                    };
                                                    ?>>200</option>
                                                    <option value="300"     <?php
                                                    if ($styledata[21] == '300') {
                                                        echo 'selected';
                                                    };
                                                    ?>>300</option>
                                                    <option value="400"     <?php
                                                    if ($styledata[21] == '400') {
                                                        echo 'selected';
                                                    };
                                                    ?>>400</option>
                                                    <option value="500"     <?php
                                                    if ($styledata[21] == '500') {
                                                        echo 'selected';
                                                    };
                                                    ?>>500</option>
                                                    <option value="600"     <?php
                                                    if ($styledata[21] == '600') {
                                                        echo 'selected';
                                                    };
                                                    ?>>600</option>
                                                    <option value="700"     <?php
                                                    if ($styledata[21] == '700') {
                                                        echo 'selected';
                                                    };
                                                    ?>>700</option>
                                                    <option value="800"     <?php
                                                    if ($styledata[21] == '800') {
                                                        echo 'selected';
                                                    };
                                                    ?>>800</option>
                                                    <option value="900"     <?php
                                                    if ($styledata[21] == '900') {
                                                        echo 'selected';
                                                    };
                                                    ?>>900</option>
                                                    <option value="normal" <?php
                                                    if ($styledata[21] == 'normal') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Normal</option>
                                                    <option value="bold"    <?php
                                                    if ($styledata[21] == 'bold') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Bold</option>
                                                    <option value="lighter" <?php
                                                    if ($styledata[21] == 'lighter') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Lighter</option>
                                                    <option value="initial"   <?php
                                                    if ($styledata[21] == 'initial') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Initial</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="heading Underline want or Not">Heading Underline</label>
                                            <div class="col-sm-6 nopadding">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[23] == 'yes') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-heading-underline" id="ihewc-heading-underline-yes" autocomplete="off"  value="yes" <?php
                                                        if ($styledata[23] == 'yes') {
                                                            echo 'checked';
                                                        }
                                                        ?>> Yes
                                                    </label>
                                                    <label class="btn btn-info <?php
                                                    if ($styledata[23] == '') {
                                                        echo 'active';
                                                    }
                                                    ?>">
                                                        <input type="radio" name="ihewc-heading-underline" id="ihewc-heading-underline-no" autocomplete="off" value="" <?php
                                                        if ($styledata[23] == '') {
                                                            echo 'checked';
                                                        }
                                                        ?>> No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="heading-padding-bottom" class="col-sm-6 control-label" data-toggle="tmooltip" data-placement="top" title="Make Distance From Descriptions" >Heading Padding Bottom</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="heading-padding-bottom" name="heading-padding-bottom" value="<?php echo $styledata[25]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="desc-font-size" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Your Descriptions or Content font size" >Description font Size</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="desc-font-size" name="desc-font-size" value="<?php echo $styledata[27]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="desc-font-familly" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Choose Your Descriptions Preferred font, Based on Google Font"> Description Font Family  <span class="ctu-pro-only">Pro Only</span></label>
                                            <div class="col-sm-6 nopadding">
                                                <input class="ihewc-admin-font" type="text" name="desc-font-familly" id="desc-font-familly" value="<?php echo $styledata[29]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="desc-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Descriptions Font Style">Description Font Weight</label>
                                            <div class="col-sm-6 nopadding">
                                                <select class="form-control" id="desc-font-weight" name="desc-font-weight">
                                                    <option value="100"     <?php
                                                    if ($styledata[31] == '100') {
                                                        echo 'selected';
                                                    };
                                                    ?>>100</option>
                                                    <option value="200"     <?php
                                                    if ($styledata[31] == '200') {
                                                        echo 'selected';
                                                    };
                                                    ?>>200</option>
                                                    <option value="300"     <?php
                                                    if ($styledata[31] == '300') {
                                                        echo 'selected';
                                                    };
                                                    ?>>300</option>
                                                    <option value="400"     <?php
                                                    if ($styledata[31] == '400') {
                                                        echo 'selected';
                                                    };
                                                    ?>>400</option>
                                                    <option value="500"     <?php
                                                    if ($styledata[31] == '500') {
                                                        echo 'selected';
                                                    };
                                                    ?>>500</option>
                                                    <option value="600"     <?php
                                                    if ($styledata[31] == '600') {
                                                        echo 'selected';
                                                    };
                                                    ?>>600</option>
                                                    <option value="700"     <?php
                                                    if ($styledata[31] == '700') {
                                                        echo 'selected';
                                                    };
                                                    ?>>700</option>
                                                    <option value="800"     <?php
                                                    if ($styledata[31] == '800') {
                                                        echo 'selected';
                                                    };
                                                    ?>>800</option>
                                                    <option value="900"     <?php
                                                    if ($styledata[31] == '900') {
                                                        echo 'selected';
                                                    };
                                                    ?>>900</option>
                                                    <option value="normal" <?php
                                                    if ($styledata[31] == 'normal') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Normal</option>
                                                    <option value="bold"    <?php
                                                    if ($styledata[31] == 'bold') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Bold</option>
                                                    <option value="lighter" <?php
                                                    if ($styledata[31] == 'lighter') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Lighter</option>
                                                    <option value="initial"   <?php
                                                    if ($styledata[31] == 'initial') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Initial</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ihewc-admin-style-settings-div-right">
                                        <div class="form-group row form-group-sm">
                                            <label for="desc-padding-bottom" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Make Distance From Button" >Description Padding Bottom</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="desc-padding-bottom" name="desc-padding-bottom" value="<?php echo $styledata[33]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="button-font-size" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Set Your Button font size" >Button font Size </label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="button-font-size" name="button-font-size" value="<?php echo $styledata[35]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="button-font-familly" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Choose Your Button Preferred font, Based on Google Font"> Button Font Family <span class="ctu-pro-only">Pro Only</span></label>
                                            <div class="col-sm-6 nopadding">
                                                <input class="ihewc-admin-font" type="text" name="button-font-familly" id="button-font-familly" value="<?php echo $styledata[37]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="button-font-weight" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Button Font Style">Button Font Weight</label>
                                            <div class="col-sm-6 nopadding">
                                                <select class="form-control" id="button-font-weight" name="button-font-weight">
                                                    <option value="100"     <?php
                                                    if ($styledata[39] == '100') {
                                                        echo 'selected';
                                                    };
                                                    ?>>100</option>
                                                    <option value="200"     <?php
                                                    if ($styledata[39] == '200') {
                                                        echo 'selected';
                                                    };
                                                    ?>>200</option>
                                                    <option value="300"     <?php
                                                    if ($styledata[39] == '300') {
                                                        echo 'selected';
                                                    };
                                                    ?>>300</option>
                                                    <option value="400"     <?php
                                                    if ($styledata[39] == '400') {
                                                        echo 'selected';
                                                    };
                                                    ?>>400</option>
                                                    <option value="500"     <?php
                                                    if ($styledata[39] == '500') {
                                                        echo 'selected';
                                                    };
                                                    ?>>500</option>
                                                    <option value="600"     <?php
                                                    if ($styledata[39] == '600') {
                                                        echo 'selected';
                                                    };
                                                    ?>>600</option>
                                                    <option value="700"     <?php
                                                    if ($styledata[39] == '700') {
                                                        echo 'selected';
                                                    };
                                                    ?>>700</option>
                                                    <option value="800"     <?php
                                                    if ($styledata[39] == '800') {
                                                        echo 'selected';
                                                    };
                                                    ?>>800</option>
                                                    <option value="900"     <?php
                                                    if ($styledata[39] == '900') {
                                                        echo 'selected';
                                                    };
                                                    ?>>900</option>
                                                    <option value="normal" <?php
                                                    if ($styledata[39] == 'normal') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Normal</option>
                                                    <option value="bold"    <?php
                                                    if ($styledata[39] == 'bold') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Bold</option>
                                                    <option value="lighter" <?php
                                                    if ($styledata[39] == 'lighter') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Lighter</option>
                                                    <option value="initial"   <?php
                                                    if ($styledata[39] == 'initial') {
                                                        echo 'selected';
                                                    };
                                                    ?>>Initial</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="button-padding-bottom" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Make Bigger or smaller of your Prepared Button, 1st one for top and buttom, 2nd is left and right" >Button Padding</label>
                                            <div class="col-sm-3 nopadding">
                                                <input type="number" class="form-control" id="button-padding-bottom" name="button-padding-bottom" value="<?php echo $styledata[41]; ?>">
                                            </div>
                                            <div class="col-sm-3 nopadding">
                                                <input type="number" class="form-control" id="button-padding-left" name="button-padding-left" value="<?php echo $styledata[43]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="button-border-radius" class="col-sm-6 control-label" data-toggle="tooltip" data-placement="top" title="Bourder Radius of your Button" >Button Border Radius</label>
                                            <div class="col-sm-6 nopadding">
                                                <input type="number" class="form-control" id="button-border-radius" name="button-border-radius" value="<?php echo $styledata[45]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-2">
                                    <div class="ihewc-admin-style-settings-div-css">
                                        <div class="form-group">
                                            <label for="ihewc-css">Add Your Custom CSS Code Here  <span class="ctu-pro-only">Pro Only</span></label>
                                            <textarea class="form-control" rows="4" id="ihewc-css" name="ihewc-css"><?php echo $styledata[47]; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="ctu-ulitate-style-3-tabs" id="ctu-ulitate-style-3-id-1">
                                    <div class="ihewc-admin-style-settings-div-css">
                                        <div class="col-xs-12">                                           
                                            <a href="https://www.oxilab.org/docs/image-hover-with-carousel/getting-started/installing-for-the-first-time" target="_blank">
                                                <div class="col-xs-support-ihewc">
                                                    <div class="ihewc-admin-support-icon">
                                                        <i class="fa fa-file" aria-hidden="true"></i>
                                                    </div>  
                                                    <div class="ihewc-admin-support-heading">
                                                        Read Our Docs
                                                    </div> 
                                                    <div class="ihewc-admin-support-info">
                                                        Learn how to set up and use Our Plugin
                                                    </div> 
                                                </div>
                                            </a>
                                            
                                            <a href="https://wordpress.org/support/plugin/image-hover-effects-with-carousel" target="_blank">
                                                <div class="col-xs-support-ihewc">
                                                    <div class="ihewc-admin-support-icon">
                                                        <i class="fa fa-users" aria-hidden="true"></i>
                                                    </div>  
                                                    <div class="ihewc-admin-support-heading">
                                                        Support
                                                    </div> 
                                                    <div class="ihewc-admin-support-info">
                                                        Powered by WordPress.org, Issues resolved by Plugins Author.
                                                    </div> 
                                                </div>
                                            </a>
                                            <a href="https://www.youtube.com/watch?v=44L2Q6ahOtI" target="_blank">
                                                <div class="col-xs-support-ihewc">
                                                    <div class="ihewc-admin-support-icon">
                                                        <i class="fa fa-ticket" aria-hidden="true"></i>
                                                    </div>  
                                                    <div class="ihewc-admin-support-heading">
                                                        Video Tutorial 
                                                    </div> 
                                                    <div class="ihewc-admin-support-info">
                                                        Watch our Using Video Toturial in Youtube.
                                                    </div> 
                                                </div>
                                            </a> 
                                        </div>
                                    </div>
                                </div>

                                <script type="text/javascript">
                                    jQuery(document).ready(function () {
                                        jQuery("#ihewc-preview-data-background").on("change", function () {
                                            var idvalue = jQuery('#ihewc-preview-data-background').val();
                                            jQuery("<style type='text/css'> #ihewc-preview-data{ background-color:" + idvalue + ";} </style>").appendTo("#ihewc-preview-data");
                                        });
                                    });
                                </script>
                            </div>

                        </div>    

                        <div class="ihewc-style-setting-save">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="data-submit" value="Save">
                            <?php wp_nonce_field("ihewcstylecss") ?>
                        </div>
                    </form>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            jQuery(".ctu-ulimate-style-3 li:first").addClass("active");
                            jQuery(".ctu-ulitate-style-3-tabs:first").addClass("active");
                            jQuery(".ctu-ulimate-style-3 li").click(function () {
                                jQuery(".ctu-ulimate-style-3 li").removeClass("active");
                                jQuery(this).toggleClass("active");
                                jQuery(".ctu-ulitate-style-3-tabs").removeClass("active");
                                var activeTab = jQuery(this).attr("ref");
                                jQuery(activeTab).addClass("active");
                            });
                        });
                    </script>   
                </div>
                <div class="ihewc-style-settings-preview">
                    <div class="ihewc-style-settings-preview-heading">
                        <div class="ihewc-style-settings-preview-heading-left">
                            Preview
                        </div>
                        <div class="ihewc-style-settings-preview-heading-right">
                            <input type="text" class="form-control ihewc-vendor-color"     id="ihewc-preview-data-background" name="ihewc-preview-data-background" value="rgba(255, 255, 255, 1)">
                        </div>
                    </div>
                    <div class="ihewc-preview-data" id="ihewc-preview-data">
                        <?php
                        ihewc_oxi_shortcode_effects($styleid, 'yes', $styledata, $listdata)
                        ?>

                    </div>
                    <div class="modal fade ihewc-draggable" id="ihewc-edit-css" data-backdrop="false" >
                        <div class="modal-dialog modal-sm">
                            <form method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Customize Image</h4>
                                    </div>
                                    <div class="modal-body">

                                       <div class="form-group row form-group-sm">
                                            <label for="image-style" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Your Hover Effects">Effects Style</label>
                                            <div class="col-sm-6 nopadding">
                                                <select class="form-control" name="image-style" id="image-style" size="1">
                                                    <option value="">All Style</option>
                                                    <option <?php
                                                    if ($imagestyle == 'blinds-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="blinds-effects">Blinds Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'block-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="block-effects">Block Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'blur-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="blur-effects">Blur Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'book-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="book-effects">Book Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'border-reveal-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="border-reveal-effects">Border Reveal Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'bounce-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="bounce-effects">Bounce Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'circle-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="circle-effects">Circle Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'cube-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="cube-effects">Cube Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'dive-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="dive-effects">Dive Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'fade-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="fade-effects">Fade Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'fall-away-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="fall-away-effects">Fall Away Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'flash-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="flash-effects">Flash Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'flip-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="flip-effects">Flip Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'fold-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="fold-effects">Fold Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'gradient-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="gradient-effects">Gradient Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'hinge-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="hinge-effects">Hinge Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'lightspeed-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="lightspeed-effects">Lightspeed Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'modal-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="modal-effects">Modal Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'parallax-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="parallax-effects">Parallax Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'pivot-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="pivot-effects">Pivot Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'pixel-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="pixel-effects">Pixel Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'push-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="push-effects">Push Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'reveal-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="reveal-effects">Reveal Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'rotate-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="rotate-effects">Rotate Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'shift-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="shift-effects">Shift Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'shutter-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="shutter-effects">Shutter Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'slide-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="slide-effects">Slide Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'splash-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="splash-effects">Splash Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'stack-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="stack-effects">Stack Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'strip-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="strip-effects">Strip Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'switch-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="switch-effects">Switch Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'throw-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="throw-effects">Throw Effects</option>
                                                    <option <?php
                                                    if ($imagestyle == 'zoom-effects') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="zoom-effects">Zoom Effects</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row form-group-sm">
                                            <label for="image-effects" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Your Hover Effects">Effects Style</label>
                                            <div class="col-sm-6 nopadding">
                                                <select  class="form-control" name="image-effects" id="image-effects" size="1">
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blinds-horizontal') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blinds-horizontal" class="sub-blinds-effects">Blinds Horizontal</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blinds-vertical') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blinds-vertical" class="sub-blinds-effects">Blinds Vertical</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blinds-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blinds-up" class="sub-blinds-effects">Blinds Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blinds-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blinds-down" class="sub-blinds-effects">Blinds Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blinds-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blinds-left" class="sub-blinds-effects">Blinds Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blinds-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blinds-right" class="sub-blinds-effects">Blinds Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-rotate-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-rotate-left" class="sub-block-effects">Block Rotate Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-rotate-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-rotate-right" class="sub-block-effects">Block Rotate Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-rotate-in-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-rotate-in-left" class="sub-block-effects">Block Rotate in Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-rotate-in-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-rotate-in-right" class="sub-block-effects">Block Rotate in Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-in') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-in" class="sub-block-effects">Block In</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-out') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-out" class="sub-block-effects">Block Out</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-float-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-float-up" class="sub-block-effects">Block Float Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-float-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-float-down" class="sub-block-effects">Block Float Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-float-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-float-left" class="sub-block-effects">Block Float Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-float-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-float-right" class="sub-block-effects">Block Float Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-zoom-top-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-zoom-top-left" class="sub-block-effects">Block Zoom Top Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-zoom-top-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-zoom-top-right" class="sub-block-effects">Block Zoom Top Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-zoom-bottom-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-zoom-bottom-left" class="sub-block-effects">Block Zoom Bottom Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blocks-zoom-bottom-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blocks-zoom-bottom-right" class="sub-block-effects">Block Zoom Bottom Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-blur') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-blur" class="sub-blur-effects">Blur Effects</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-book-open-horizontal') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-book-open-horizontal" class="sub-book-effects">Book Horizontal</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-book-open-vertical') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-book-open-vertical" class="sub-book-effects">Book Vertical</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-book-open-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-book-open-up" class="sub-book-effects">Book Open Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-book-open-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-book-open-down" class="sub-book-effects">Book Open Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-book-open-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-book-open-left" class="sub-book-effects">Book Open Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-book-open-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-book-open-right" class="sub-book-effects">Book Open Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal" class="sub-border-reveal-effects">Border Reveal </option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-vertical') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-vertical" class="sub-border-reveal-effects">Border Reveal Vertical</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-horizontal') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-horizontal" class="sub-border-reveal-effects">Border Reveal Horizontal</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-corners-1') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-corners-1" class="sub-border-reveal-effects">Border Reveal Corners 1</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-corners-2') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-corners-2" class="sub-border-reveal-effects">Border Reveal Corners 2</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-top-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-top-left" class="sub-border-reveal-effects">Border Reveal Top Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-top-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-top-right" class="sub-border-reveal-effects">Border Reveal Top Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-bottom-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-bottom-left" class="sub-border-reveal-effects">Border Reveal Bottom Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-bottom-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-bottom-right" class="sub-border-reveal-effects">Border Reveal Bottom Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-cc-1') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-cc-1" class="sub-border-reveal-effects">Border Reveal CC 1</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-ccc-1') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-ccc-1" class="sub-border-reveal-effects">Border Reveal CCC 1</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-cc-2') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-cc-2" class="sub-border-reveal-effects">Border Reveal CC 2</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-ccc-2') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-ccc-2" class="sub-border-reveal-effects">Border Reveal CCC 2</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-cc-3') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-cc-3" class="sub-border-reveal-effects">Border Reveal CC 3</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-border-reveal-ccc-3') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-border-reveal-ccc-3" class="sub-border-reveal-effects">Border Reveal CCC 3</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-in') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-in" class="sub-bounce-effects">Bounce In</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-in-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-in-up" class="sub-bounce-effects">Bounce In Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-in-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-in-down" class="sub-bounce-effects">Bounce In Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-in-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-in-left" class="sub-bounce-effects">Bounce In Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-in-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-in-right" class="sub-bounce-effects">Bounce In Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-out') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-out" class="sub-bounce-effects">Bounce Out</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-out-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-out-up" class="sub-bounce-effects">Bounce Out Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-out-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-out-down" class="sub-bounce-effects">Bounce Out Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-out-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-out-left" class="sub-bounce-effects">Bounce Out Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-bounce-out-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-bounce-out-right" class="sub-bounce-effects">Bounce Out Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-up" class="sub-circle-effects">Circle Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-down" class="sub-circle-effects">Circle Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-left" class="sub-circle-effects">Circle Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-right" class="sub-circle-effects">Circle Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-top-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-top-left" class="sub-circle-effects">Circle Top Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-top-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-top-right" class="sub-circle-effects">Circle Top Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-bottom-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-bottom-left" class="sub-circle-effects">Circle Bottom Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-circle-bottom-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-circle-bottom-right" class="sub-circle-effects">Circle Bottom Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-cube-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-cube-up" class="sub-cube-effects">Cube Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-cube-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-cube-down" class="sub-cube-effects">Cube Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-cube-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-cube-left" class="sub-cube-effects">Cube Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-cube-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-cube-right" class="sub-cube-effects">Cube Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-dive') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-dive" class="sub-dive-effects">Dive </option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-dive-cc') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-dive-cc" class="sub-dive-effects">Dive CC</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-dive-ccc') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-dive-ccc" class="sub-dive-effects">Dive CCC</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fade-in-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fade-in-up" class="sub-fade-effects">Fade in Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fade-in-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fade-in-down" class="sub-fade-effects">Fade in Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fade-in-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fade-in-left" class="sub-fade-effects">Fade in Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fade-in-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fade-in-right" class="sub-fade-effects">Fade in Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fall-away-horizontal') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fall-away-horizontal" class="sub-fall-away-effects">Fall Away Horizontal</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fall-away-vertical') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fall-away-vertical" class="sub-fall-away-effects">Fall Away Vertical</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fall-away-cc') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fall-away-cc" class="sub-fall-away-effects">Fall Away CC</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fall-away-ccc') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fall-away-ccc" class="sub-fall-away-effects">Fall Away CCC</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flash-top-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flash-top-left" class="sub-flash-effects">Flash Top Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flash-top-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flash-top-right" class="sub-flash-effects">Flash Top Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flash-bottom-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flash-bottom-left" class="sub-flash-effects">Flash Bottom Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flash-bottom-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flash-bottom-right" class="sub-flash-effects">Flash Bottom Right</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flip-horizontal') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flip-horizontal" class="sub-flip-effects">Flip Horizontal</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flip-vertical') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flip-vertical" class="sub-flip-effects">Flip Vertical</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flip-diagonal-1') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flip-diagonal-1" class="sub-flip-effects">Flip Diagonal 1</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-flip-diagonal-2') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-flip-diagonal-2" class="sub-flip-effects">Flip Diagonal 2</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fold-up') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fold-up" class="sub-fold-effects">Fold Up</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fold-down') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fold-down" class="sub-fold-effects">Fold Down</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fold-left') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fold-left" class="sub-fold-effects">Fold Left</option>
                                                    <option <?php
                                                    if ($imageeffects == 'ihewc-fold-right') {
                                                        echo 'selected';
                                                    }
                                                    ?> value="ihewc-fold-right" class="sub-fold-effects">Fold Right</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Redial In (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Redial Out (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-gradient-effects">Gradient Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-hinge-effects">Hinge Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-hinge-effects">Hinge Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-hinge-effects">Hinge Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-hinge-effects">Hinge Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-lightspeed-effects">Lightspeed in Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-lightspeed-effects">Lightspeed in Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-lightspeed-effects">Lightspeed Out Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-lightspeed-effects">Lightspeed Out Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Slide Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Slide Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Slide Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Slide Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Hinge Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Hinge Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Hinge Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-modal-effects">Modal Hinge Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-parallax-effects">Parallax Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-parallax-effects">Parallax Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-parallax-effects">Parallax Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-parallax-effects">Parallax Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot in Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot in Top Right  (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot in Bottom left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot in Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot out Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot out Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot out Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pivot-effects">Pivot out Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-pixel-effects">Pixel Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-push-effects">Push Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-push-effects">Push Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-push-effects">Push Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-push-effects">Push Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-reveal-effects">Reveal Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-rotate-effects">Rotate Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-rotate-effects">Rotate Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shift-effects">Shift Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shift-effects">Shift Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shift-effects">Shift Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shift-effects">Shift Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter Out Horizontal (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter Out Vertical (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter Out Diagonal 1 (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter Out Diagonal 2 (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter in Horizontal (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter in Vertical (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter in out Horizontal (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter in Out vertical (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter in Out Diagonal 1 (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-shutter-effects">Shutter  in Out Diagonal 2 (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-slide-effects">Slide Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-splash-effects">Splash Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-splash-effects">Splash Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-splash-effects">Splash Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-splash-effects">Splash Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-stack-effects">Stack Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Shutter Up  (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Shutter Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Shutter Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Shutter Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Horizontal Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Horizontal Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Horizontal Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Horizontal Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Horizontal Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Horizontal Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Vertical Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Vertical Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Vertical Top Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Vertical Top Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Vertical Bottom Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-strip-effects">Strip Vertical Bottom Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-switch-effects">Switch Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-switch-effects">Switch Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-switch-effects">Switch Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-switch-effects">Switch Right  (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw In Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw In Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw In Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw In Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw Out Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw Out Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw Out Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-throw-effects">Throw Out Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom In (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out Up (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out Down (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out Left (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out Right (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out Flip Horizontal (Pro)</option>
                                                    <option value="ihewc-blur" class="sub-zoom-effects">Zoom Out Flip Vertical (Pro)</option>
                                                </select>
                                                <span id="optionstore" style="display:none;"></span>

                                            </div>


                                            <script type="text/javascript">
                                                jQuery(document).ready(function () {
                                                    jQuery('#image-style').on("change", function () {
                                                        var cattype = jQuery(this).val();
                                                        optionswitch(cattype);
                                                    });
                                                });

                                                function optionswitch(myfilter) {
                                                    if (jQuery('#optionstore').text() == "") {
                                                        jQuery('option[class^="sub-"]').each(function () {
                                                            var optvalue = jQuery(this).val();
                                                            var optclass = jQuery(this).prop('class');
                                                            var opttext = jQuery(this).text();
                                                            optionlist = jQuery('#optionstore').text() + "@%" + optvalue + "@%" + optclass + "@%" + opttext;
                                                            jQuery('#optionstore').text(optionlist);
                                                        });
                                                    }

                                                    //Delete everything
                                                    jQuery('option[class^="sub-"]').remove();

                                                    // Put the filtered stuff back
                                                    populateoption = rewriteoption(myfilter);
                                                    jQuery('#image-effects').html(populateoption);
                                                }

                                                function rewriteoption(myfilter) {
                                                    //Rewrite only the filtered stuff back into the option
                                                    var options = jQuery('#optionstore').text().split('@%');
                                                    var resultgood = false;
                                                    var myfilterclass = "sub-" + myfilter;
                                                    var optionlisting = "";

                                                    myfilterclass = (myfilter != "") ? myfilterclass : "all";

                                                    //First variable is always the value, second is always the class, third is always the text
                                                    for (var i = 3; i < options.length; i = i + 3) {
                                                        if (options[i - 1] == myfilterclass || myfilterclass == "all") {
                                                            optionlisting = optionlisting + '<option value="' + options[i - 2] + '" class="' + options[i - 1] + '">' + options[i] + '</option>';
                                                            resultgood = true;
                                                        }
                                                    }
                                                    if (resultgood) {
                                                        return optionlisting;
                                                    }
                                                }
                                            </script>
                                        </div>
                                        <?php ihewc_addtional_items_data($imagebackgroundcolor, $imagealignments, $titlecolor, $titleanimation, $desccolor, $descanimation, $buttomcolor, $buttomanimation, $buttombackground); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="itemcssid" value="<?php echo $itemcssid; ?>">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" name="submit-css" value="Save">
                                        <?php wp_nonce_field("ihewcsavestyle") ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php ihewc_admin_right_side_data($styleid); ?>
        </div>
    </div>

    <?php ihewc_admin_add_new_data($title, $files, $link, $bottom, $image, $itemid); ?>
</div>

