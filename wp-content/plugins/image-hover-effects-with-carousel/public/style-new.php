<?php
if (!defined('ABSPATH'))
    exit;
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'ihewcstylenew')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $css = 'iheu-image-type |0| iheu-item |ihewc-responsive-3| iheu-showing-type || image-height |75| image-padding |20| iheu-new-tab |_blank| box-shadow |0| box-shadow-color |rgba(255, 255, 255, 1)| heading-font-size |20| heading-font-familly |Open+Sans| heading-font-weight |600| iheu-heading-underline || heading-padding-bottom |5| desc-font-size |14| desc-font-familly |Open+Sans| desc-font-weight |300| desc-padding-bottom |20| button-font-size |12| button-font-familly |Open+Sans| button-font-weight |300| button-padding-bottom |7| button-padding-left |10| button-border-radius |5| iheu-css || image-margin |20| carousel-autoplay |true| carousel-auto-timing |2000| iheu-animations |fadeIn| animation-timing |3| |';
        $style_name = $_POST['style'];
        global $wpdb;
        $table_name = $wpdb->prefix . 'image_hover_with_carousel_style';
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, css) VALUES ( %s, %s )", array($name, $css)));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            $url = admin_url("admin.php?page=image-hover-carousel-new");
        }
        if ($redirect_id != 0) {
            $url = admin_url("admin.php?page=image-hover-carousel-new&styleid=$redirect_id");
        }
        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
        exit;
    }
}
?>

<div class="wrap">
    <div class="ihewc-admin-wrapper">
        <h1>Hover Effects Preview  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ihewc-effects-data">Create New</button></h1>
        <p>Select Style from our Template list</p>
        <div class="modal fade" id="ihewc-effects-data" >
            <form method="post">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Style Settings</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row form-group-sm">
                                <label for="style-name" class="col-sm-6 col-form-label"  data-toggle="tooltip" class="tooltipLink" data-original-title="Give Your Template Name">Name</label>
                                <div class="col-sm-6 nopadding">
                                    <input class="form-control" type="text" value=""  name="style-name">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                            <?php wp_nonce_field("ihewcstylenew") ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="ihewc-admin-new-row">
            <div class="ihewc-admin-row">
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-62{
                                padding: 0;
                            }
                            .ihewc-hover-62 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-62{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-62,
                            .ihewc-hover-62 .ihewc-hover-figure,
                            .ihewc-hover-62 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-62 .ihewc-hover-figure,
                            .ihewc-hover-62 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-62 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-62 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-62  .img-btn, .ihewc-hover-62 .img-btn:hover, .ihewc-hover-62 .img-btn:focus, .ihewc-hover-62 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-62  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-62 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-62">
                                    <div class="ihewc-hover ihewc-hover-62 ihewc-hover-62-67 ihewc-blinds-horizontal ihewc-animation-62">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/4.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-flip-x iheu-delay-sm">Custom Printed T-Shirts</h3>
                                                        <p class="iheu-flip-x iheu-delay-sm">Create awesome custom screen printed T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-62-67,
                                            .ihewc-hover-62-67:before,
                                            .ihewc-hover-62-67:after,
                                            .ihewc-hover-62-67 .ihewc-hover-figure,
                                            .ihewc-hover-62-67 .ihewc-hover-figure:before,
                                            .ihewc-hover-62-67 .ihewc-hover-figure:after,
                                            .ihewc-hover-62-67 .ihewc-hover-figure-caption,
                                            .ihewc-hover-62-67 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-62-67 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(151, 8, 194, 0.76);
                                            }.ihewc-hover-62-67 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-62-67 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-62-67 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-62-67 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-62-67 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-62");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-62");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-62");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            blinds Effects  <em>( 6 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-57{
                                padding: 0;
                            }
                            .ihewc-hover-57 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-57{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-57,
                            .ihewc-hover-57 .ihewc-hover-figure,
                            .ihewc-hover-57 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-57 .ihewc-hover-figure,
                            .ihewc-hover-57 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-57 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-57 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-57  .img-btn, .ihewc-hover-57 .img-btn:hover, .ihewc-hover-57 .img-btn:focus, .ihewc-hover-57 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-57  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-57 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-57">
                                    <div class="ihewc-hover ihewc-hover-57 ihewc-hover-57-62 ihewc-blocks-rotate-left ihewc-animation-57">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/1.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Fully Customizable</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Customize With Image Hover Awesome Tools</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-57-62,
                                            .ihewc-hover-57-62:before,
                                            .ihewc-hover-57-62:after,
                                            .ihewc-hover-57-62 .ihewc-hover-figure,
                                            .ihewc-hover-57-62 .ihewc-hover-figure:before,
                                            .ihewc-hover-57-62 .ihewc-hover-figure:after,
                                            .ihewc-hover-57-62 .ihewc-hover-figure-caption,
                                            .ihewc-hover-57-62 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-57-62 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(139, 0, 204, 1);
                                            }.ihewc-hover-57-62 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-57-62 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-57-62 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-57-62 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-57-62 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-57");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-57");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-57");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>                    </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Block Effects  <em>( 14 Layouts )</em>
                        </div>
                    </div>
                </div>

                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-81{
                                padding: 0px;
                            }
                            .ihewc-hover-81 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-81{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-81,
                            .ihewc-hover-81 .ihewc-hover-figure,
                            .ihewc-hover-81 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-81 .ihewc-hover-figure,
                            .ihewc-hover-81 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(0, 153, 130, 1);
                            }
                            .ihewc-hover-81 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-81 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-81  .img-btn, .ihewc-hover-81 .img-btn:hover, .ihewc-hover-81 .img-btn:focus, .ihewc-hover-81 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-81  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-81 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-81">
                                    <div class="ihewc-hover ihewc-hover-81 ihewc-hover-81-86 ihewc-blur ihewc-animation-81">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/2.jpg'; ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-up iheu-delay-sm">Beautiful T-Shirt</h3>
                                                        <p class="iheu-fade-right iheu-delay-sm">Unique and Handmade Beautiful T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> 
                                        <style>.ihewc-hover-81-86 .ihewc-hover-figure-caption{
                                                background-color: rgba(0, 113, 179, 1);
                                            }.ihewc-hover-81-86 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-81-86 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-81-86 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-81-86 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-81-86 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  
                                        </div>
                                    </div></div></div>
                            <script>
                                (function ($) {
                                    $.fn.visible = function (partial) {

                                        var $t = $(this),
                                                $w = $(window),
                                                viewTop = $w.scrollTop(),
                                                viewBottom = viewTop + $w.height(),
                                                _top = $t.offset().top,
                                                _bottom = _top + $t.height(),
                                                compareTop = partial === true ? _bottom : _top,
                                                compareBottom = partial === true ? _top : _bottom;

                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                    };

                                })(jQuery);

                                var win = jQuery(window);

                                var allMods = jQuery(".ihewc-animation-81");

                                allMods.each(function (i, el) {
                                    var el = jQuery(el);
                                    if (el.visible(true)) {
                                        el.addClass("animated-hover-81");
                                        el.addClass("fadeIn");
                                    }
                                });

                                win.scroll(function (event) {

                                    allMods.each(function (i, el) {
                                        var el = jQuery(el);
                                        if (el.visible(true)) {
                                            el.addClass("animated-hover-81");
                                            el.addClass("fadeIn");
                                        }
                                    });

                                });
                            </script>

                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Blur Effects <em>( Single Layout )</em>
                        </div>
                    </div>

                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-65{
                                padding: 0;
                            }
                            .ihewc-hover-65 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-65{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-65,
                            .ihewc-hover-65 .ihewc-hover-figure,
                            .ihewc-hover-65 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-65 .ihewc-hover-figure,
                            .ihewc-hover-65 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-65 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-65 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-65  .img-btn, .ihewc-hover-65 .img-btn:hover, .ihewc-hover-65 .img-btn:focus, .ihewc-hover-65 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-65  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-65 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-65">
                                    <div class="ihewc-hover ihewc-hover-65 ihewc-hover-65-70 ihewc-book-open-horizontal ihewc-animation-65">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/1.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Fully Customizable</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Customize With Image Hover Awesome Tools</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-65-70,
                                            .ihewc-hover-65-70:before,
                                            .ihewc-hover-65-70:after,
                                            .ihewc-hover-65-70 .ihewc-hover-figure,
                                            .ihewc-hover-65-70 .ihewc-hover-figure:before,
                                            .ihewc-hover-65-70 .ihewc-hover-figure:after,
                                            .ihewc-hover-65-70 .ihewc-hover-figure-caption,
                                            .ihewc-hover-65-70 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-65-70 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(149, 19, 209, 1);
                                            }.ihewc-hover-65-70 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-65-70 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-65-70 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-65-70 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-65-70 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-65");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-65");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-65");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>                    </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Book Effects <em>( 6 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-63{
                                padding: 0;
                            }
                            .ihewc-hover-63 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-63{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-63,
                            .ihewc-hover-63 .ihewc-hover-figure,
                            .ihewc-hover-63 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-63 .ihewc-hover-figure,
                            .ihewc-hover-63 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-63 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-63 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-63  .img-btn, .ihewc-hover-63 .img-btn:hover, .ihewc-hover-63 .img-btn:focus, .ihewc-hover-63 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-63  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-63 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-63">
                                    <div class="ihewc-hover ihewc-hover-63 ihewc-hover-63-68 ihewc-border-reveal ihewc-animation-63">
                                        <div class="ihewc-hover-figure">
                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/3.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-down iheu-delay-sm">Pasta and Mac &amp; Cheese</h3>
                                                        <p class="iheu-fade-down iheu-delay-sm">Make lunch and dinner more delicious with Pasta</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-63-68,
                                            .ihewc-hover-63-68:before,
                                            .ihewc-hover-63-68:after,
                                            .ihewc-hover-63-68 .ihewc-hover-figure,
                                            .ihewc-hover-63-68 .ihewc-hover-figure:before,
                                            .ihewc-hover-63-68 .ihewc-hover-figure:after,
                                            .ihewc-hover-63-68 .ihewc-hover-figure-caption,
                                            .ihewc-hover-63-68 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-63-68 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(180, 8, 207, 1);
                                            }.ihewc-hover-63-68 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-63-68 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-63-68 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-63-68 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-63-68 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-63");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-63");
                                                        el.addClass("jello");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-63");
                                                            el.addClass("jello");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Border Reveal Effects  <em>( 15 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-69{
                                padding: 0;
                            }
                            .ihewc-hover-69 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-69{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-69,
                            .ihewc-hover-69 .ihewc-hover-figure,
                            .ihewc-hover-69 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-69 .ihewc-hover-figure,
                            .ihewc-hover-69 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-69 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-69 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-69  .img-btn, .ihewc-hover-69 .img-btn:hover, .ihewc-hover-69 .img-btn:focus, .ihewc-hover-69 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-69  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-69 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-69">
                                    <div class="ihewc-hover ihewc-hover-69 ihewc-hover-69-74 ihewc-bounce-in ihewc-animation-69 ">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/6.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Creative Logo Design</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">A well designed logo allows an impact on Customers</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-69-74,
                                            .ihewc-hover-69-74:before,
                                            .ihewc-hover-69-74:after,
                                            .ihewc-hover-69-74 .ihewc-hover-figure,
                                            .ihewc-hover-69-74 .ihewc-hover-figure:before,
                                            .ihewc-hover-69-74 .ihewc-hover-figure:after,
                                            .ihewc-hover-69-74 .ihewc-hover-figure-caption,
                                            .ihewc-hover-69-74 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-69-74 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(197, 98, 222, 1);
                                            }.ihewc-hover-69-74 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-69-74 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-69-74 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-69-74 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-69-74 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script>    (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-69");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-69");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-69");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Bounce Effects <em>( 10 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-67{
                                padding: 0;
                            }
                            .ihewc-hover-67 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-67{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-67,
                            .ihewc-hover-67 .ihewc-hover-figure,
                            .ihewc-hover-67 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-67 .ihewc-hover-figure,
                            .ihewc-hover-67 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-67 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-67 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-67  .img-btn, .ihewc-hover-67 .img-btn:hover, .ihewc-hover-67 .img-btn:focus, .ihewc-hover-67 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-67  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-67 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-67">
                                    <div class="ihewc-hover ihewc-hover-67 ihewc-hover-67-72 ihewc-circle-up ihewc-animation-67">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/8.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Best Luxury Watches for Men</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Looking for a timepiece that's both sophisticated and stylish</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-67-72,
                                            .ihewc-hover-67-72:before,
                                            .ihewc-hover-67-72:after,
                                            .ihewc-hover-67-72 .ihewc-hover-figure,
                                            .ihewc-hover-67-72 .ihewc-hover-figure:before,
                                            .ihewc-hover-67-72 .ihewc-hover-figure:after,
                                            .ihewc-hover-67-72 .ihewc-hover-figure-caption,
                                            .ihewc-hover-67-72 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-67-72 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(180, 0, 204, 1);
                                            }.ihewc-hover-67-72 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-67-72 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-67-72 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-67-72 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-67-72 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  </div></div></div></div><script>(function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-67");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-67");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-67");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Circle Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-76{
                                padding: 0px;
                            }
                            .ihewc-hover-76 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-76{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-76,
                            .ihewc-hover-76 .ihewc-hover-figure,
                            .ihewc-hover-76 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-76 .ihewc-hover-figure,
                            .ihewc-hover-76 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-76 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-76 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-76  .img-btn, .ihewc-hover-76 .img-btn:hover, .ihewc-hover-76 .img-btn:focus, .ihewc-hover-76 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-76  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-76 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-76">
                                    <div class="ihewc-hover ihewc-hover-76 ihewc-hover-76-81 ihewc-cube-up ihewc-animation-76">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/7.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-right iheu-delay-sm">Amazing iPhone Photos</h3>
                                                        <p class="iheu-fade-right iheu-delay-sm">10 iPhone Photography Tips To Quickly Improve Your Photos</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style>.ihewc-hover-76-81 .ihewc-hover-figure-caption{
                                                background-color: rgba(204, 22, 195, 1);
                                            }.ihewc-hover-76-81 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-76-81 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-76-81 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-76-81 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-76-81 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   
                                        </div></div></div></div><script>(function ($) {
                                                $.fn.visible = function (partial) {

                                                    var $t = $(this),
                                                            $w = $(window),
                                                            viewTop = $w.scrollTop(),
                                                            viewBottom = viewTop + $w.height(),
                                                            _top = $t.offset().top,
                                                            _bottom = _top + $t.height(),
                                                            compareTop = partial === true ? _bottom : _top,
                                                            compareBottom = partial === true ? _top : _bottom;

                                                    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                };

                                            })(jQuery);

                                            var win = jQuery(window);

                                            var allMods = jQuery(".ihewc-animation-76");

                                            allMods.each(function (i, el) {
                                                var el = jQuery(el);
                                                if (el.visible(true)) {
                                                    el.addClass("animated-hover-76");
                                                    el.addClass("bounceInLeft");
                                                }
                                            });

                                            win.scroll(function (event) {

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-76");
                                                        el.addClass("bounceInLeft");
                                                    }
                                                });

                                            });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Cube Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-77{
                                padding: 0px;
                            }
                            .ihewc-hover-77 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-77{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-77,
                            .ihewc-hover-77 .ihewc-hover-figure,
                            .ihewc-hover-77 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-77 .ihewc-hover-figure,
                            .ihewc-hover-77 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-77 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-77 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-77  .img-btn, .ihewc-hover-77 .img-btn:hover, .ihewc-hover-77 .img-btn:focus, .ihewc-hover-77 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-77  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-77 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-77">
                                    <div class="ihewc-hover ihewc-hover-77 ihewc-hover-77-82 ihewc-dive ihewc-animation-77">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/6.jpg' ?> ">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-flip-y iheu-delay-sm">Creative Logo Design</h3>
                                                        <p class="iheu-flip-y iheu-delay-sm">A well designed logo allows an impact on Customers</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-77-82,
                                            .ihewc-hover-77-82:before,
                                            .ihewc-hover-77-82:after,
                                            .ihewc-hover-77-82 .ihewc-hover-figure,
                                            .ihewc-hover-77-82 .ihewc-hover-figure:before,
                                            .ihewc-hover-77-82 .ihewc-hover-figure:after,
                                            .ihewc-hover-77-82 .ihewc-hover-figure-caption,
                                            .ihewc-hover-77-82 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-77-82 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 145, 41, 1);
                                            }.ihewc-hover-77-82 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-77-82 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-77-82 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-77-82 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-77-82 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script>(function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-77");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-77");
                                                        el.addClass("zoomIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-77");
                                                            el.addClass("zoomIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Dive Effects <em>( 3 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-1{
                                padding: 0px;
                            }
                            .ihewc-hover-1 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-1{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-1,
                            .ihewc-hover-1 .ihewc-hover-figure,
                            .ihewc-hover-1 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-1 .ihewc-hover-figure,
                            .ihewc-hover-1 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 5px rgba(163, 163, 163, 1);
                            }
                            .ihewc-hover-1 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:20px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;
                            }
                            .ihewc-hover-1 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-1  .img-btn, .ihewc-hover-1 .img-btn:hover, .ihewc-hover-1 .img-btn:focus, .ihewc-hover-1 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-1  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-1 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row ">
                                <div class="ihewc-responsive-1 ihewc-hover-padding-1">
                                    <div class="ihewc-hover ihewc-hover-1 ihewc-hover-1-37 ihewc-fade-in-up ihewc-animation-1">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/1.jpg'; ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-up-big iheu-delay-sm">Fully Customizable</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Customize With Image Hover Awesome Tools</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-1-37,                                           
                                            .ihewc-hover-1-37 .ihewc-hover-figure-caption{
                                                background-color: rgba(0, 158, 147, 1);
                                            }.ihewc-hover-1-37 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-1-37 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-1-37 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-1-37 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-1-37 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-1");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-1");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-1");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script> 
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Fade Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-70{
                                padding: 0;
                            }
                            .ihewc-hover-70 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-70{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-70,
                            .ihewc-hover-70 .ihewc-hover-figure,
                            .ihewc-hover-70 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-70 .ihewc-hover-figure,
                            .ihewc-hover-70 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-70 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-70 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-70  .img-btn, .ihewc-hover-70 .img-btn:hover, .ihewc-hover-70 .img-btn:focus, .ihewc-hover-70 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-70  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-70 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-70">
                                    <div class="ihewc-hover ihewc-hover-70 ihewc-hover-70-75 ihewc-fall-away-horizontal ihewc-animation-70">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/5.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Handbags With Unique Design</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Shop at Etsy to find unique and handmade designer Handbags</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-70-75,
                                            .ihewc-hover-70-75:before,
                                            .ihewc-hover-70-75:after,
                                            .ihewc-hover-70-75 .ihewc-hover-figure,
                                            .ihewc-hover-70-75 .ihewc-hover-figure:before,
                                            .ihewc-hover-70-75 .ihewc-hover-figure:after,
                                            .ihewc-hover-70-75 .ihewc-hover-figure-caption,
                                            .ihewc-hover-70-75 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-70-75 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(196, 110, 167, 1);
                                            }.ihewc-hover-70-75 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-70-75 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-70-75 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-70-75 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-70-75 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>       </div></div></div></div><script>      (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-70");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-70");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-70");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Fall Away Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-80{
                                padding: 0px;
                            }
                            .ihewc-hover-80 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-80{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-80,
                            .ihewc-hover-80 .ihewc-hover-figure,
                            .ihewc-hover-80 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-80 .ihewc-hover-figure,
                            .ihewc-hover-80 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-80 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-80 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-80  .img-btn, .ihewc-hover-80 .img-btn:hover, .ihewc-hover-80 .img-btn:focus, .ihewc-hover-80 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-80  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-80 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-80">
                                    <div class="ihewc-hover ihewc-hover-80 ihewc-hover-80-85 ihewc-flash-bottom-left ihewc-animation-80">
                                        <div class="ihewc-hover-figure">
                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/3.jpg'; ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-up iheu-delay-sm">Pasta and Mac &amp; Cheese</h3>
                                                        <p class="iheu-fade-up iheu-delay-sm">Make lunch and dinner more delicious with Pasta</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-80-85,
                                            .ihewc-hover-80-85:before,
                                            .ihewc-hover-80-85:after,
                                            .ihewc-hover-80-85 .ihewc-hover-figure,
                                            .ihewc-hover-80-85 .ihewc-hover-figure:before,
                                            .ihewc-hover-80-85 .ihewc-hover-figure:after,
                                            .ihewc-hover-80-85 .ihewc-hover-figure-caption,
                                            .ihewc-hover-80-85 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-80-85 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(192, 0, 217, 1);
                                            }.ihewc-hover-80-85 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-80-85 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-80-85 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-80-85 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-80-85 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  

                                        </div>
                                    </div></div></div>
                            <script>(function ($) {
                                    $.fn.visible = function (partial) {

                                        var $t = $(this),
                                                $w = $(window),
                                                viewTop = $w.scrollTop(),
                                                viewBottom = viewTop + $w.height(),
                                                _top = $t.offset().top,
                                                _bottom = _top + $t.height(),
                                                compareTop = partial === true ? _bottom : _top,
                                                compareBottom = partial === true ? _top : _bottom;

                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                    };

                                })(jQuery);

                                var win = jQuery(window);

                                var allMods = jQuery(".ihewc-animation-80");

                                allMods.each(function (i, el) {
                                    var el = jQuery(el);
                                    if (el.visible(true)) {
                                        el.addClass("animated-hover-80");
                                        el.addClass("fadeIn");
                                    }
                                });

                                win.scroll(function (event) {

                                    allMods.each(function (i, el) {
                                        var el = jQuery(el);
                                        if (el.visible(true)) {
                                            el.addClass("animated-hover-80");
                                            el.addClass("fadeIn");
                                        }
                                    });

                                });
                            </script>   
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Flash Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-53{
                                padding: 0;
                            }
                            .ihewc-hover-53 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-53{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-53,
                            .ihewc-hover-53 .ihewc-hover-figure,
                            .ihewc-hover-53 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-53 .ihewc-hover-figure,
                            .ihewc-hover-53 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-53 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-53 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-53  .img-btn, .ihewc-hover-53 .img-btn:hover, .ihewc-hover-53 .img-btn:focus, .ihewc-hover-53 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-53  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-53 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-53">
                                    <div class="ihewc-hover ihewc-hover-53 ihewc-hover-53-58 ihewc-flip-horizontal ihewc-animation-53">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/5.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Handbags With Unique Design</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Shop at Etsy to find unique and handmade designer Handbags</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-53-58,
                                            .ihewc-hover-53-58:before,
                                            .ihewc-hover-53-58:after,
                                            .ihewc-hover-53-58 .ihewc-hover-figure,
                                            .ihewc-hover-53-58 .ihewc-hover-figure:before,
                                            .ihewc-hover-53-58 .ihewc-hover-figure:after,
                                            .ihewc-hover-53-58 .ihewc-hover-figure-caption,
                                            .ihewc-hover-53-58 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-53-58 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(189, 0, 196, 1);
                                            }.ihewc-hover-53-58 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-53-58 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-53-58 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-53-58 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-53-58 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-53");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-53");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-53");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Flip Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-55{
                                padding: 0;
                            }
                            .ihewc-hover-55 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-55{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-55,
                            .ihewc-hover-55 .ihewc-hover-figure,
                            .ihewc-hover-55 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-55 .ihewc-hover-figure,
                            .ihewc-hover-55 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-55 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-55 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-55  .img-btn, .ihewc-hover-55 .img-btn:hover, .ihewc-hover-55 .img-btn:focus, .ihewc-hover-55 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-55  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-55 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-55">
                                    <div class="ihewc-hover ihewc-hover-55 ihewc-hover-55-60 ihewc-fold-up ihewc-animation-55">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/3.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Pasta and Mac &amp; Cheese</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Make lunch and dinner more delicious with Pasta</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-55-60,
                                            .ihewc-hover-55-60:before,
                                            .ihewc-hover-55-60:after,
                                            .ihewc-hover-55-60 .ihewc-hover-figure,
                                            .ihewc-hover-55-60 .ihewc-hover-figure:before,
                                            .ihewc-hover-55-60 .ihewc-hover-figure:after,
                                            .ihewc-hover-55-60 .ihewc-hover-figure-caption,
                                            .ihewc-hover-55-60 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-55-60 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(170, 2, 212, 1);
                                            }.ihewc-hover-55-60 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-55-60 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-55-60 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-55-60 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-55-60 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-55");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-55");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-55");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Fold Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-73{
                                padding: 0;
                            }
                            .ihewc-hover-73 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-73{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-73,
                            .ihewc-hover-73 .ihewc-hover-figure,
                            .ihewc-hover-73 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-73 .ihewc-hover-figure,
                            .ihewc-hover-73 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-73 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-73 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-73  .img-btn, .ihewc-hover-73 .img-btn:hover, .ihewc-hover-73 .img-btn:focus, .ihewc-hover-73 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-73  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-73 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-73">
                                    <div class="ihewc-hover ihewc-hover-73 ihewc-hover-73-78 ihewc-gradient-radial-in ihewc-animation-73">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/2.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Beautiful T-Shirt</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Unique and Handmade Beautiful T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style>.ihewc-hover-73-78.ihewc-gradient-radial-in:before {background-image: -webkit-radial-gradient(transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-radial-gradient(transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -o-radial-gradient(transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: radial-gradient(transparent 0%, rgba(163, 10, 102, 1) 100%);}.ihewc-hover-73-78.ihewc-gradient-radial-out:before {background-image: -webkit-radial-gradient(rgba(163, 10, 102, 1) 0%, transparent 100%);background-image: -moz-radial-gradient(rgba(163, 10, 102, 1) 0%, transparent 100%);background-image: -o-radial-gradient(rgba(163, 10, 102, 1) 0%, transparent 100%);background-image: radial-gradient(rgba(163, 10, 102, 1) 0%, transparent 100%);}.ihewc-hover-73-78.ihewc-gradient-up:before {background-image: -webkit-linear-gradient( top , transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -webkit-gradient(linear, left top, left bottom, from(transparent), to(rgba(163, 10, 102, 1)));background-image: -webkit-linear-gradient(top, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-linear-gradient(top, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -o-linear-gradient(top, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: linear-gradient(to bottom, transparent 0%, rgba(163, 10, 102, 1) 100%);}.ihewc-hover-73-78.ihewc-gradient-down:before {background-image: -webkit-linear-gradient( bottom , transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -webkit-gradient(linear, left bottom, left top, from(transparent), to(rgba(163, 10, 102, 1)));background-image: -webkit-linear-gradient(bottom, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-linear-gradient(bottom, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -o-linear-gradient(bottom, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: linear-gradient(to top, transparent 0%, rgba(163, 10, 102, 1) 100%);}.ihewc-hover-73-78.ihewc-gradient-left:before {background-image: -webkit-linear-gradient( left , transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -webkit-gradient(linear, left top, right top, from(transparent), to(rgba(163, 10, 102, 1)));background-image: -webkit-linear-gradient(left, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-linear-gradient(left, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -o-linear-gradient(left, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: linear-gradient(to right, transparent 0%, rgba(163, 10, 102, 1) 100%);}.ihewc-hover-73-78.ihewc-gradient-right:before {background-image: -webkit-linear-gradient( right , transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -webkit-gradient(linear, right top, left top, from(transparent), to(rgba(163, 10, 102, 1)));background-image: -webkit-linear-gradient(right, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-linear-gradient(right, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -o-linear-gradient(right, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: linear-gradient(to left, transparent 0%, rgba(163, 10, 102, 1) 100%);}.ihewc-hover-73-78.ihewc-gradient-top-left:before {background-image: -webkit-linear-gradient(-45deg, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -webkit-linear-gradient(135deg, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-linear-gradient(135deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -o-linear-gradient(135deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: linear-gradient(-45deg, transparent 0%, rgba(163, 10, 102, 1) 100%);} .ihewc-hover-73-78.ihewc-gradient-top-right:before { background-image: -webkit-linear-gradient(-315deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -webkit-linear-gradient(45deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -moz-linear-gradient(45deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -o-linear-gradient(45deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: linear-gradient(45deg, transparent 0%, rgba(163, 10, 102, 1) 100%);} .ihewc-hover-73-78.ihewc-gradient-bottom-left:before { background-image: -webkit-linear-gradient(-135deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -webkit-linear-gradient(225deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -moz-linear-gradient(225deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -o-linear-gradient(225deg, transparent 0%, rgba(163, 10, 102, 1) 100%);  background-image: linear-gradient(-135deg, transparent 0%, rgba(163, 10, 102, 1) 100%);  }.ihewc-hover-73-78.ihewc-gradient-bottom-right:before {background-image: -webkit-linear-gradient(-405deg, transparent 0%, rgba(163, 10, 102, 1) 100%);  background-image: -webkit-linear-gradient(315deg, transparent 0%, rgba(163, 10, 102, 1) 100%);background-image: -moz-linear-gradient(315deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: -o-linear-gradient(315deg, transparent 0%, rgba(163, 10, 102, 1) 100%); background-image: linear-gradient(135deg, transparent 0%, rgba(163, 10, 102, 1) 100%);}.ihewc-hover-73-78 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-73-78 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-73-78 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-73-78 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-73-78 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  </div></div></div></div><script>(function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-73");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-73");
                                                        el.addClass("bounceInDown");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-73");
                                                            el.addClass("bounceInDown");
                                                        }
                                                    });

                                                });
                            </script>                    </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Gradient Effects <em>( 10 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-51{
                                padding: 0;
                            }
                            .ihewc-hover-51 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-51{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-51,
                            .ihewc-hover-51 .ihewc-hover-figure,
                            .ihewc-hover-51 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-51 .ihewc-hover-figure,
                            .ihewc-hover-51 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-51 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-51 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-51  .img-btn, .ihewc-hover-51 .img-btn:hover, .ihewc-hover-51 .img-btn:focus, .ihewc-hover-51 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-51  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-51 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-51">
                                    <div class="ihewc-hover ihewc-hover-51 ihewc-hover-51-56 ihewc-hinge-up ihewc-animation-51">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/6.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Creative Logo Design</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">A well designed logo allows an impact on Customers</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-51-56,
                                            .ihewc-hover-51-56:before,
                                            .ihewc-hover-51-56:after,
                                            .ihewc-hover-51-56 .ihewc-hover-figure,
                                            .ihewc-hover-51-56 .ihewc-hover-figure:before,
                                            .ihewc-hover-51-56 .ihewc-hover-figure:after,
                                            .ihewc-hover-51-56 .ihewc-hover-figure-caption,
                                            .ihewc-hover-51-56 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-51-56 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 168, 168, 1);
                                            }.ihewc-hover-51-56 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-51-56 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-51-56 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-51-56 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-51-56 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>    </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-51");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-51");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-51");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Hinge Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-72{
                                padding: 0;
                            }
                            .ihewc-hover-72 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-72{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-72,
                            .ihewc-hover-72 .ihewc-hover-figure,
                            .ihewc-hover-72 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-72 .ihewc-hover-figure,
                            .ihewc-hover-72 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-72 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-72 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-72  .img-btn, .ihewc-hover-72 .img-btn:hover, .ihewc-hover-72 .img-btn:focus, .ihewc-hover-72 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-72  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-72 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-72">
                                    <div class="ihewc-hover ihewc-hover-72 ihewc-hover-72-77 ihewc-lightspeed-in-left ihewc-animation-72">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/3.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Pasta and Mac &amp; Cheese</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Make lunch and dinner more delicious with Pasta</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-72-77,
                                            .ihewc-hover-72-77:before,
                                            .ihewc-hover-72-77:after,
                                            .ihewc-hover-72-77 .ihewc-hover-figure,
                                            .ihewc-hover-72-77 .ihewc-hover-figure:before,
                                            .ihewc-hover-72-77 .ihewc-hover-figure:after,
                                            .ihewc-hover-72-77 .ihewc-hover-figure-caption,
                                            .ihewc-hover-72-77 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-72-77 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 158, 147, 1);
                                            }.ihewc-hover-72-77 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-72-77 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-72-77 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-72-77 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-72-77 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>    </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-72");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-72");
                                                        el.addClass("swing");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-72");
                                                            el.addClass("swing");
                                                        }
                                                    });

                                                });
                            </script>                    </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Lightspeed Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>

                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-71{
                                padding: 0;
                            }
                            .ihewc-hover-71 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-71{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-71,
                            .ihewc-hover-71 .ihewc-hover-figure,
                            .ihewc-hover-71 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-71 .ihewc-hover-figure,
                            .ihewc-hover-71 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-71 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-71 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-71  .img-btn, .ihewc-hover-71 .img-btn:hover, .ihewc-hover-71 .img-btn:focus, .ihewc-hover-71 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-71  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-71 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-71">
                                    <div class="ihewc-hover ihewc-hover-71 ihewc-hover-71-76 ihewc-modal-slide-up ihewc-animation-71">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/4.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-up iheu-delay-sm">Custom Printed T-Shirts</h3>
                                                        <p class="iheu-fade-up iheu-delay-sm">Create awesome custom screen printed T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-71-76,
                                            .ihewc-hover-71-76:before,
                                            .ihewc-hover-71-76:after,
                                            .ihewc-hover-71-76 .ihewc-hover-figure,
                                            .ihewc-hover-71-76 .ihewc-hover-figure:before,
                                            .ihewc-hover-71-76 .ihewc-hover-figure:after,
                                            .ihewc-hover-71-76 .ihewc-hover-figure-caption,
                                            .ihewc-hover-71-76 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-71-76 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 158, 147, 1);
                                            }.ihewc-hover-71-76 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-71-76 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-71-76 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-71-76 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-71-76 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>     </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-71");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-71");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-71");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>

                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Modal Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-74{
                                padding: 0;
                            }
                            .ihewc-hover-74 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-74{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-74,
                            .ihewc-hover-74 .ihewc-hover-figure,
                            .ihewc-hover-74 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-74 .ihewc-hover-figure,
                            .ihewc-hover-74 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-74 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-74 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-74  .img-btn, .ihewc-hover-74 .img-btn:hover, .ihewc-hover-74 .img-btn:focus, .ihewc-hover-74 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-74  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-74 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-74">
                                    <div class="ihewc-hover ihewc-hover-74 ihewc-hover-74-79 ihewc-parallax-up ihewc-animation-74">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/1.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-out iheu-delay-sm">Fully Customizable</h3>
                                                        <p class="iheu-zoom-out iheu-delay-sm">Customize With Image Hover Awesome Tools</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-74-79,
                                            .ihewc-hover-74-79:before,
                                            .ihewc-hover-74-79:after,
                                            .ihewc-hover-74-79 .ihewc-hover-figure,
                                            .ihewc-hover-74-79 .ihewc-hover-figure:before,
                                            .ihewc-hover-74-79 .ihewc-hover-figure:after,
                                            .ihewc-hover-74-79 .ihewc-hover-figure-caption,
                                            .ihewc-hover-74-79 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-74-79 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(185, 0, 209, 0.7);
                                            }.ihewc-hover-74-79 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-74-79 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-74-79 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-74-79 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-74-79 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style></div></div></div></div><script>   (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-74");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-74");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-74");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Parallax Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-60{
                                padding: 0;
                            }
                            .ihewc-hover-60 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-60{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-60,
                            .ihewc-hover-60 .ihewc-hover-figure,
                            .ihewc-hover-60 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-60 .ihewc-hover-figure,
                            .ihewc-hover-60 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-60 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-60 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-60  .img-btn, .ihewc-hover-60 .img-btn:hover, .ihewc-hover-60 .img-btn:focus, .ihewc-hover-60 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-60  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-60 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-60">
                                    <div class="ihewc-hover ihewc-hover-60 ihewc-hover-60-65 ihewc-pivot-in-top-left ihewc-animation-60">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/6.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-down iheu-delay-sm">Creative Logo Design</h3>
                                                        <p class="iheu-fade-down iheu-delay-sm">A well designed logo allows an impact on Customers</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-60-65,
                                            .ihewc-hover-60-65:before,
                                            .ihewc-hover-60-65:after,
                                            .ihewc-hover-60-65 .ihewc-hover-figure,
                                            .ihewc-hover-60-65 .ihewc-hover-figure:before,
                                            .ihewc-hover-60-65 .ihewc-hover-figure:after,
                                            .ihewc-hover-60-65 .ihewc-hover-figure-caption,
                                            .ihewc-hover-60-65 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-60-65 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(150, 0, 196, 1);
                                            }.ihewc-hover-60-65 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-60-65 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-60-65 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-60-65 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-60-65 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>    </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-60");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-60");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-60");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Pivot Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-82{
                                padding: 0;
                            }
                            .ihewc-hover-82 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-82{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-82,
                            .ihewc-hover-82 .ihewc-hover-figure,
                            .ihewc-hover-82 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-82 .ihewc-hover-figure,
                            .ihewc-hover-82 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-82 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-82 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-82  .img-btn, .ihewc-hover-82 .img-btn:hover, .ihewc-hover-82 .img-btn:focus, .ihewc-hover-82 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-82  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-82 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-82">
                                    <div class="ihewc-hover ihewc-hover-82 ihewc-hover-82-87 ihewc-pixel-up ihewc-animation-82">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/7.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Amazing iPhone Photos</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">10 iPhone Photography Tips To Quickly Improve Your Photos</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-82-87,
                                            .ihewc-hover-82-87:before,
                                            .ihewc-hover-82-87:after,
                                            .ihewc-hover-82-87 .ihewc-hover-figure,
                                            .ihewc-hover-82-87 .ihewc-hover-figure:before,
                                            .ihewc-hover-82-87 .ihewc-hover-figure:after,
                                            .ihewc-hover-82-87 .ihewc-hover-figure-caption,
                                            .ihewc-hover-82-87 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-82-87 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(134, 50, 199, 1);
                                            }.ihewc-hover-82-87 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-82-87 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-82-87 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-82-87 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-82-87 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script>   (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-82");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-82");
                                                        el.addClass("bounceIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-82");
                                                            el.addClass("bounceIn");
                                                        }
                                                    });

                                                });
                            </script>                    </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Pixel Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">



                        <style>
                            .ihewc-hover-padding-4{
                                padding: 0;
                            }
                            .ihewc-hover-4 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-4{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-4,
                            .ihewc-hover-4 .ihewc-hover-figure,
                            .ihewc-hover-4 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-4 .ihewc-hover-figure,
                            .ihewc-hover-4 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-4 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-4 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-4  .img-btn, .ihewc-hover-4 .img-btn:hover, .ihewc-hover-4 .img-btn:focus, .ihewc-hover-4 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-4  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-4 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-4">
                                    <div class="ihewc-hover ihewc-hover-4 ihewc-hover-4-38 ihewc-push-up ihewc-animation-4">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/7.jpg'; ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Amazing iPhone Photos</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">10 iPhone Photography Tips To Quickly Improve Your Photos</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-4-38,
                                            .ihewc-hover-4-38:before,
                                            .ihewc-hover-4-38:after,
                                            .ihewc-hover-4-38 .ihewc-hover-figure,
                                            .ihewc-hover-4-38 .ihewc-hover-figure:before,
                                            .ihewc-hover-4-38 .ihewc-hover-figure:after,
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption,
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(224, 0, 187, 1);
                                            }.ihewc-hover-4-38 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-4-38 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-4-38 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-4");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-4");
                                                        el.addClass("bounceIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-4");
                                                            el.addClass("bounceIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Push Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">



                        <style>
                            .ihewc-hover-padding-4{
                                padding: 0;
                            }
                            .ihewc-hover-4 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-4{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-4,
                            .ihewc-hover-4 .ihewc-hover-figure,
                            .ihewc-hover-4 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-4 .ihewc-hover-figure,
                            .ihewc-hover-4 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-4 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-4 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-4  .img-btn, .ihewc-hover-4 .img-btn:hover, .ihewc-hover-4 .img-btn:focus, .ihewc-hover-4 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-4  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-4 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row ">
                                <div class="ihewc-responsive-1 ihewc-hover-padding-4">
                                    <div class="ihewc-hover ihewc-hover-4 ihewc-hover-4-38 ihewc-push-up ihewc-animation-4">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/7.jpg'; ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Amazing iPhone Photos</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">10 iPhone Photography Tips To Quickly Improve Your Photos</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-4-38,
                                            .ihewc-hover-4-38:before,
                                            .ihewc-hover-4-38:after,
                                            .ihewc-hover-4-38 .ihewc-hover-figure,
                                            .ihewc-hover-4-38 .ihewc-hover-figure:before,
                                            .ihewc-hover-4-38 .ihewc-hover-figure:after,
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption,
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(224, 0, 187, 1);
                                            }.ihewc-hover-4-38 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-4-38 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-4-38 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-4-38 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-4");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-4");
                                                        el.addClass("bounceIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-4");
                                                            el.addClass("bounceIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Reveal Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-64{
                                padding: 0;
                            }
                            .ihewc-hover-64 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-64{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-64,
                            .ihewc-hover-64 .ihewc-hover-figure,
                            .ihewc-hover-64 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-64 .ihewc-hover-figure,
                            .ihewc-hover-64 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-64 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-64 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-64  .img-btn, .ihewc-hover-64 .img-btn:hover, .ihewc-hover-64 .img-btn:focus, .ihewc-hover-64 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-64  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-64 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-64">
                                    <div class="ihewc-hover ihewc-hover-64 ihewc-hover-64-69 ihewc-rotate-left ihewc-animation-64">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/2.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-down iheu-delay-sm">Beautiful T-Shirt</h3>
                                                        <p class="iheu-fade-down iheu-delay-sm">Unique and Handmade Beautiful T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-64-69,
                                            .ihewc-hover-64-69:before,
                                            .ihewc-hover-64-69:after,
                                            .ihewc-hover-64-69 .ihewc-hover-figure,
                                            .ihewc-hover-64-69 .ihewc-hover-figure:before,
                                            .ihewc-hover-64-69 .ihewc-hover-figure:after,
                                            .ihewc-hover-64-69 .ihewc-hover-figure-caption,
                                            .ihewc-hover-64-69 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-64-69 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(120, 6, 196, 0.66);
                                            }.ihewc-hover-64-69 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-64-69 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-64-69 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-64-69 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-64-69 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script>   (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-64");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-64");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-64");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Rotate Effects <em>( 2 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-68{
                                padding: 0;
                            }
                            .ihewc-hover-68 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-68{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-68,
                            .ihewc-hover-68 .ihewc-hover-figure,
                            .ihewc-hover-68 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-68 .ihewc-hover-figure,
                            .ihewc-hover-68 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-68 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-68 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-68  .img-btn, .ihewc-hover-68 .img-btn:hover, .ihewc-hover-68 .img-btn:focus, .ihewc-hover-68 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-68  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-68 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-68">
                                    <div class="ihewc-hover ihewc-hover-68 ihewc-hover-68-73 ihewc-shift-top-left ihewc-animation-68">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/7.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Amazing iPhone Photos</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">10 iPhone Photography Tips To Quickly Improve Your Photos</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-68-73,
                                            .ihewc-hover-68-73:before,
                                            .ihewc-hover-68-73:after,
                                            .ihewc-hover-68-73 .ihewc-hover-figure,
                                            .ihewc-hover-68-73 .ihewc-hover-figure:before,
                                            .ihewc-hover-68-73 .ihewc-hover-figure:after,
                                            .ihewc-hover-68-73 .ihewc-hover-figure-caption,
                                            .ihewc-hover-68-73 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-68-73 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(148, 120, 6, 1);
                                            }.ihewc-hover-68-73 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-68-73 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-68-73 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-68-73 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-68-73 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script>    (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-68");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-68");
                                                        el.addClass("bounceInRight");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-68");
                                                            el.addClass("bounceInRight");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Shift Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-54{
                                padding: 0;
                            }
                            .ihewc-hover-54 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-54{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-54,
                            .ihewc-hover-54 .ihewc-hover-figure,
                            .ihewc-hover-54 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-54 .ihewc-hover-figure,
                            .ihewc-hover-54 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-54 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-54 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-54  .img-btn, .ihewc-hover-54 .img-btn:hover, .ihewc-hover-54 .img-btn:focus, .ihewc-hover-54 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-54  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-54 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-54">
                                    <div class="ihewc-hover ihewc-hover-54 ihewc-hover-54-59 ihewc-shutter-out-horizontal ihewc-animation-54">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/4.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Custom Printed T-Shirts</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Create awesome custom screen printed T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-54-59,
                                            .ihewc-hover-54-59:before,
                                            .ihewc-hover-54-59:after,
                                            .ihewc-hover-54-59 .ihewc-hover-figure,
                                            .ihewc-hover-54-59 .ihewc-hover-figure:before,
                                            .ihewc-hover-54-59 .ihewc-hover-figure:after,
                                            .ihewc-hover-54-59 .ihewc-hover-figure-caption,
                                            .ihewc-hover-54-59 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-54-59 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(219, 0, 190, 1);
                                            }.ihewc-hover-54-59 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-54-59 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-54-59 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-54-59 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-54-59 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script>    (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-54");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-54");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-54");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Shutter Effects <em>( 10 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-48{
                                padding: 0;
                            }
                            .ihewc-hover-48 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-48{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-48,
                            .ihewc-hover-48 .ihewc-hover-figure,
                            .ihewc-hover-48 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-48 .ihewc-hover-figure,
                            .ihewc-hover-48 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-48 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-48 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-48  .img-btn, .ihewc-hover-48 .img-btn:hover, .ihewc-hover-48 .img-btn:focus, .ihewc-hover-48 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-48  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-48 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-48">
                                    <div class="ihewc-hover ihewc-hover-48 ihewc-hover-48-53 ihewc-slide-up ihewc-animation-48">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/8.jpg'; ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Best Luxury Watches for Men</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Looking for a timepiece that's both sophisticated and stylish</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-48-53,
                                            .ihewc-hover-48-53:before,
                                            .ihewc-hover-48-53:after,
                                            .ihewc-hover-48-53 .ihewc-hover-figure,
                                            .ihewc-hover-48-53 .ihewc-hover-figure:before,
                                            .ihewc-hover-48-53 .ihewc-hover-figure:after,
                                            .ihewc-hover-48-53 .ihewc-hover-figure-caption,
                                            .ihewc-hover-48-53 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-48-53 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(194, 0, 184, 1);
                                            }.ihewc-hover-48-53 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-48-53 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-48-53 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-48-53 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-48-53 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-48");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-48");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-48");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>                    </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Slide Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-79{
                                padding: 0px;
                            }
                            .ihewc-hover-79 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-79{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-79,
                            .ihewc-hover-79 .ihewc-hover-figure,
                            .ihewc-hover-79 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-79 .ihewc-hover-figure,
                            .ihewc-hover-79 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-79 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-79 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-79  .img-btn, .ihewc-hover-79 .img-btn:hover, .ihewc-hover-79 .img-btn:focus, .ihewc-hover-79 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-79  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-79 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-79">
                                    <div class="ihewc-hover ihewc-hover-79 ihewc-hover-79-84 ihewc-splash-down ihewc-animation-79">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/4.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-fade-up iheu-delay-sm">Custom Printed T-Shirts</h3>
                                                        <p class="iheu-fade-up iheu-delay-sm">Create awesome custom screen printed T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-79-84,
                                            .ihewc-hover-79-84:before,
                                            .ihewc-hover-79-84:after,
                                            .ihewc-hover-79-84 .ihewc-hover-figure,
                                            .ihewc-hover-79-84 .ihewc-hover-figure:before,
                                            .ihewc-hover-79-84 .ihewc-hover-figure:after,
                                            .ihewc-hover-79-84 .ihewc-hover-figure-caption,
                                            .ihewc-hover-79-84 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-79-84 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 158, 147, 1);
                                            }.ihewc-hover-79-84 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-79-84 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-79-84 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-79-84 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-79-84 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> 
                                        </div></div></div></div><script>
                                            (function ($) {
                                                $.fn.visible = function (partial) {

                                                    var $t = $(this),
                                                            $w = $(window),
                                                            viewTop = $w.scrollTop(),
                                                            viewBottom = viewTop + $w.height(),
                                                            _top = $t.offset().top,
                                                            _bottom = _top + $t.height(),
                                                            compareTop = partial === true ? _bottom : _top,
                                                            compareBottom = partial === true ? _top : _bottom;

                                                    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                };

                                            })(jQuery);

                                            var win = jQuery(window);

                                            var allMods = jQuery(".ihewc-animation-79");

                                            allMods.each(function (i, el) {
                                                var el = jQuery(el);
                                                if (el.visible(true)) {
                                                    el.addClass("animated-hover-79");
                                                    el.addClass("fadeIn");
                                                }
                                            });

                                            win.scroll(function (event) {

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-79");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                            });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Splash Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">

                        <style>
                            .ihewc-hover-padding-75{
                                padding: 0px;
                            }
                            .ihewc-hover-75 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-75{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-75,
                            .ihewc-hover-75 .ihewc-hover-figure,
                            .ihewc-hover-75 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-75 .ihewc-hover-figure,
                            .ihewc-hover-75 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-75 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-75 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-75  .img-btn, .ihewc-hover-75 .img-btn:hover, .ihewc-hover-75 .img-btn:focus, .ihewc-hover-75 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-75  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-75 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-75">
                                    <div class="ihewc-hover ihewc-hover-75 ihewc-hover-75-80 ihewc-stack-left ihewc-animation-75">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/8.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Best Luxury Watches for Men</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Looking for a timepiece that's both sophisticated and stylish</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-75-80,
                                            .ihewc-hover-75-80:before,
                                            .ihewc-hover-75-80:after,
                                            .ihewc-hover-75-80 .ihewc-hover-figure,
                                            .ihewc-hover-75-80 .ihewc-hover-figure:before,
                                            .ihewc-hover-75-80 .ihewc-hover-figure:after,
                                            .ihewc-hover-75-80 .ihewc-hover-figure-caption,
                                            .ihewc-hover-75-80 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-75-80 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(113, 158, 0, 1);
                                            }.ihewc-hover-75-80 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-75-80 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-75-80 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-75-80 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-75-80 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> 
                                        </div></div></div></div><script> (function ($) {
                                                $.fn.visible = function (partial) {

                                                    var $t = $(this),
                                                            $w = $(window),
                                                            viewTop = $w.scrollTop(),
                                                            viewBottom = viewTop + $w.height(),
                                                            _top = $t.offset().top,
                                                            _bottom = _top + $t.height(),
                                                            compareTop = partial === true ? _bottom : _top,
                                                            compareBottom = partial === true ? _top : _bottom;

                                                    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                };

                                            })(jQuery);

                                            var win = jQuery(window);

                                            var allMods = jQuery(".ihewc-animation-75");

                                            allMods.each(function (i, el) {
                                                var el = jQuery(el);
                                                if (el.visible(true)) {
                                                    el.addClass("animated-hover-75");
                                                    el.addClass("bounceIn");
                                                }
                                            });

                                            win.scroll(function (event) {

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-75");
                                                        el.addClass("bounceIn");
                                                    }
                                                });

                                            });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Stack Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div> 

                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-58{
                                padding: 0;
                            }
                            .ihewc-hover-58 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-58{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-58,
                            .ihewc-hover-58 .ihewc-hover-figure,
                            .ihewc-hover-58 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-58 .ihewc-hover-figure,
                            .ihewc-hover-58 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-58 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-58 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-58  .img-btn, .ihewc-hover-58 .img-btn:hover, .ihewc-hover-58 .img-btn:focus, .ihewc-hover-58 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-58  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-58 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-58">
                                    <div class="ihewc-hover ihewc-hover-58 ihewc-hover-58-63 ihewc-strip-shutter-up ihewc-animation-58">
                                        <div class="ihewc-hover-figure">
                                            <a href="#" target="_blank"><style>.ihewc-hover-58-63 .ihewc-hover-figure a {float: left;width: 100%;}</style>
                                                <div class="ihewc-hover-image">
                                                    <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/8.jpg' ?>">
                                                </div>
                                                <div class="ihewc-hover-figure-caption">
                                                    <div class="ihewc-hover-figure-caption-table">
                                                        <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                            <h3 class="iheu-zoom-in iheu-delay-sm">Best Luxury Watches for Men</h3>
                                                            <p class="iheu-zoom-in iheu-delay-sm">Looking for a timepiece that's both sophisticated and stylish</p>

                                                        </div>  
                                                    </div>
                                                </div>
                                            </a>  
                                        </div> <style> .ihewc-hover-58-63,
                                            .ihewc-hover-58-63:before,
                                            .ihewc-hover-58-63:after,
                                            .ihewc-hover-58-63 .ihewc-hover-figure,
                                            .ihewc-hover-58-63 .ihewc-hover-figure:before,
                                            .ihewc-hover-58-63 .ihewc-hover-figure:after,
                                            .ihewc-hover-58-63 .ihewc-hover-figure-caption,
                                            .ihewc-hover-58-63 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-58-63 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 158, 147, 1);
                                            }.ihewc-hover-58-63 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-58-63 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-58-63 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-58-63 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-58-63 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>   </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-58");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-58");
                                                        el.addClass("fadeIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-58");
                                                            el.addClass("fadeIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Strip Effects <em>( 16 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">
                        <style>
                            .ihewc-hover-padding-78{
                                padding: 0px;
                            }
                            .ihewc-hover-78 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-78{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-78,
                            .ihewc-hover-78 .ihewc-hover-figure,
                            .ihewc-hover-78 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-78 .ihewc-hover-figure,
                            .ihewc-hover-78 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-78 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-78 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-78  .img-btn, .ihewc-hover-78 .img-btn:hover, .ihewc-hover-78 .img-btn:focus, .ihewc-hover-78 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-78  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-78 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-78">
                                    <div class="ihewc-hover ihewc-hover-78 ihewc-hover-78-83 ihewc-switch-left ihewc-animation-78">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/5.jpg' ?> ">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Handbags With Unique Design</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Shop at Etsy to find unique and handmade designer Handbags</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style>
                                            .ihewc-hover-78-83 .ihewc-hover-figure-caption{
                                                background-color: rgba(152, 0, 179, 1);
                                            }
                                            .ihewc-hover-78-83 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-78-83 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-78-83 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-78-83 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-78-83 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style> 
                                        </div></div></div></div><script>  (function ($) {
                                                $.fn.visible = function (partial) {

                                                    var $t = $(this),
                                                            $w = $(window),
                                                            viewTop = $w.scrollTop(),
                                                            viewBottom = viewTop + $w.height(),
                                                            _top = $t.offset().top,
                                                            _bottom = _top + $t.height(),
                                                            compareTop = partial === true ? _bottom : _top,
                                                            compareBottom = partial === true ? _top : _bottom;

                                                    return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                };

                                            })(jQuery);

                                            var win = jQuery(window);

                                            var allMods = jQuery(".ihewc-animation-78");

                                            allMods.each(function (i, el) {
                                                var el = jQuery(el);
                                                if (el.visible(true)) {
                                                    el.addClass("animated-hover-78");
                                                    el.addClass("bounceIn");
                                                }
                                            });

                                            win.scroll(function (event) {

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-78");
                                                        el.addClass("bounceIn");
                                                    }
                                                });

                                            });
                            </script>

                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Switch Effects <em>( 4 Layouts )</em>
                        </div>
                    </div>
                </div> 
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-61{
                                padding: 0;
                            }
                            .ihewc-hover-61 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-61{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-61,
                            .ihewc-hover-61 .ihewc-hover-figure,
                            .ihewc-hover-61 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-61 .ihewc-hover-figure,
                            .ihewc-hover-61 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-61 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-61 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-61  .img-btn, .ihewc-hover-61 .img-btn:hover, .ihewc-hover-61 .img-btn:focus, .ihewc-hover-61 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-61  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-61 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-61">
                                    <div class="ihewc-hover ihewc-hover-61 ihewc-hover-61-66 ihewc-throw-in-up ihewc-animation-61">
                                        <div class="ihewc-hover-figure">
                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/5.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Handbags With Unique Design</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Shop at Etsy to find unique and handmade designer Handbags</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-61-66,
                                            .ihewc-hover-61-66:before,
                                            .ihewc-hover-61-66:after,
                                            .ihewc-hover-61-66 .ihewc-hover-figure,
                                            .ihewc-hover-61-66 .ihewc-hover-figure:before,
                                            .ihewc-hover-61-66 .ihewc-hover-figure:after,
                                            .ihewc-hover-61-66 .ihewc-hover-figure-caption,
                                            .ihewc-hover-61-66 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-61-66 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(0, 158, 147, 1);
                                            }.ihewc-hover-61-66 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-61-66 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-61-66 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-61-66 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-61-66 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>    </div></div></div></div><script> (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-61");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-61");
                                                        el.addClass("bounceInUp");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-61");
                                                            el.addClass("bounceInUp");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Throw Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div>
                <div class="ihewc-admin-style-select-panel">
                    <div class="ihewc-admin-style-select-panel-upper">


                        <style>
                            .ihewc-hover-padding-56{
                                padding: 0;
                            }
                            .ihewc-hover-56 .ihewc-hover-image:after{
                                padding-bottom: 75%;
                                display: block;
                                content: "";
                            }
                            .animated-hover-56{
                                -webkit-animation-duration:1s;
                                animation-duration:1s;
                                -webkit-animation-fill-mode:both;
                                animation-fill-mode:both
                            }
                            .ihewc-hover-56,
                            .ihewc-hover-56 .ihewc-hover-figure,
                            .ihewc-hover-56 .ihewc-hover-figure .ihewc-hover-figure-caption {
                                border-radius:0%;
                            }
                            .ihewc-hover-56 .ihewc-hover-figure,
                            .ihewc-hover-56 .ihewc-hover-figure-caption{
                                box-shadow: 0 0 0px rgba(255, 255, 255, 1);
                            }
                            .ihewc-hover-56 h3{
                                font-size:22px;
                                font-weight:600;
                                margin-bottom:5px;
                                line-height: 120%;
                                padding-bottom: 5px;
                                display: inline-block;

                            }
                            .ihewc-hover-56 p{
                                font-size:16px;
                                font-weight: 300;
                                margin-bottom: 20px !important;
                                line-height: 120%;
                            }
                            .ihewc-hover-56  .img-btn, .ihewc-hover-56 .img-btn:hover, .ihewc-hover-56 .img-btn:focus, .ihewc-hover-56 .img-btn:active {
                                padding: 7px 10px;
                                -webkit-border-radius: 5px;
                                -moz-border-radius: 5px;
                                border-radius: 5px;
                                font-weight: 300;
                                font-size: 12px;

                            }
                            .ihewc-hover-56  .img-link {
                                font-weight: 300;
                                font-size: 12px;
                            }
                            .ihewc-hover-56 .ihewc-hover-figure-caption{
                                padding: 20px;
                            }

                        </style><div class="ihewc-container"><div class="ihewc-row "> <div class="ihewc-responsive-1 ihewc-hover-padding-56">
                                    <div class="ihewc-hover ihewc-hover-56 ihewc-hover-56-61 ihewc-zoom-out-right ihewc-animation-56">
                                        <div class="ihewc-hover-figure">

                                            <div class="ihewc-hover-image">
                                                <img src="<?php echo plugin_dir_url(dirname(__FILE__)) . 'public/image/2.jpg' ?>">
                                            </div>
                                            <div class="ihewc-hover-figure-caption">
                                                <div class="ihewc-hover-figure-caption-table">
                                                    <div class="ihewc-hover-figure-caption-content ihewc-layout-horizontal-center ihewc-layout-vertical-middle">
                                                        <h3 class="iheu-zoom-in iheu-delay-sm">Beautiful T-Shirt</h3>
                                                        <p class="iheu-zoom-in iheu-delay-sm">Unique and Handmade Beautiful T-Shirts</p>

                                                    </div>  
                                                </div>
                                            </div>

                                        </div> <style> .ihewc-hover-56-61,
                                            .ihewc-hover-56-61:before,
                                            .ihewc-hover-56-61:after,
                                            .ihewc-hover-56-61 .ihewc-hover-figure,
                                            .ihewc-hover-56-61 .ihewc-hover-figure:before,
                                            .ihewc-hover-56-61 .ihewc-hover-figure:after,
                                            .ihewc-hover-56-61 .ihewc-hover-figure-caption,
                                            .ihewc-hover-56-61 .ihewc-hover-figure-caption:before,
                                            .ihewc-hover-56-61 .ihewc-hover-figure-caption:after {
                                                background-color: rgba(61, 19, 189, 1);
                                            }.ihewc-hover-56-61 h3{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-56-61 p{
                                                color: #ffffff!important;
                                            }
                                            .ihewc-hover-56-61 .ihewc-hover-figure-caption-content a.img-btn{
                                                background: #fafafa!important;
                                            }
                                            .ihewc-hover-56-61 .ihewc-hover-figure-caption-content a.img-btn, .ihewc-hover-56-61 .ihewc-hover-figure-caption-content a.img-link{
                                                color: #00a88f; }
                                            </style>  </div></div></div></div><script>  (function ($) {
                                                    $.fn.visible = function (partial) {

                                                        var $t = $(this),
                                                                $w = $(window),
                                                                viewTop = $w.scrollTop(),
                                                                viewBottom = viewTop + $w.height(),
                                                                _top = $t.offset().top,
                                                                _bottom = _top + $t.height(),
                                                                compareTop = partial === true ? _bottom : _top,
                                                                compareBottom = partial === true ? _top : _bottom;

                                                        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));

                                                    };

                                                })(jQuery);

                                                var win = jQuery(window);

                                                var allMods = jQuery(".ihewc-animation-56");

                                                allMods.each(function (i, el) {
                                                    var el = jQuery(el);
                                                    if (el.visible(true)) {
                                                        el.addClass("animated-hover-56");
                                                        el.addClass("bounceIn");
                                                    }
                                                });

                                                win.scroll(function (event) {

                                                    allMods.each(function (i, el) {
                                                        var el = jQuery(el);
                                                        if (el.visible(true)) {
                                                            el.addClass("animated-hover-56");
                                                            el.addClass("bounceIn");
                                                        }
                                                    });

                                                });
                            </script>
                        </div>
                        <div class="ihewc-admin-style-select-panel-bottom">
                        <div class="ihewc-admin-style-select-panel-bottom-left">
                            Zoom Effects <em>( 8 Layouts )</em>
                        </div>
                    </div>
                </div> 
            </div>
        </div> 
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</div>