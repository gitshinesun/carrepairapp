jQuery(document).ready(function () {

    jQuery('#insert_price_table').on('click', function(){
        var id = jQuery('#price_table_choosing option:selected').val();
        window.send_to_editor('[hg_price_table id="' + id + '"]');
        tb_remove();
    });

});