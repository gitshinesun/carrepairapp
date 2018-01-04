jQuery(document).ready(function () {
    jQuery('.ihewc-vendor-color').each(function () {
        jQuery(this).minicolors({
            control: jQuery(this).attr('data-control') || 'hue',
            defaultValue: jQuery(this).attr('data-defaultValue') || '',
            format: jQuery(this).attr('data-format') || 'hex',
            keywords: jQuery(this).attr('data-keywords') || '',
            inline: jQuery(this).attr('data-inline') === 'true',
            letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
            opacity: jQuery(this).attr('data-opacity'),
            position: jQuery(this).attr('data-position') || 'bottom left',
            swatches: jQuery(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
            change: function (value, opacity) {
                if (!value)
                    return;
                if (opacity)
                    value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    jQuery('#ihewc-add-new-item').on('click', function () {
        jQuery("#ihewc-add-new-item-data").modal("show");
        jQuery("#ihewc-image-upload-url").val(null);
        jQuery("#ihewc-title").val(null);
        jQuery("#ihewc-desc").val(null);
        jQuery("#ihewc-bottom").val(null);
        jQuery("#ihewc-link").val(null);
        jQuery("#item-id").val(null);
    });
    jQuery('[data-toggle="tooltip"]').tooltip();
    jQuery(".ihewc-draggable").draggable({
        handle: ".modal-header"
    });
    jQuery('.ihewc-admin-font').fontselect()
});

