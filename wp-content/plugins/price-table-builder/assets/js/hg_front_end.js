jQuery(document).ready(function () {

	/* Matchheight Function for align row heights */
	jQuery('.huge_it_features_head').matchHeight(false);
	jQuery('.huge_it_features_price').matchHeight(false);

	var ht_pt_rows_count = jQuery('.hg_ft_col_0 h3').length+1;

	if(ht_pt_rows_count == 1) {
		ht_pt_rows_count = jQuery('.hg_ft_col_1 h3').length+1;
	}

	for(var i = 0; i < ht_pt_rows_count; i ++) {
		jQuery(".hugeit_ft_col h3:nth-of-type("+ i +")").matchHeight(false);
	}

});