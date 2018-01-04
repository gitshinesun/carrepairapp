<?php

/*************************************************
* Utilizer ui elements: wp editor input
**************************************************/
function uz_wp_editor_input($label,$input_name,$input_value,$settings=array("textarea_rows"=>5)) {

	wp_enqueue_script('editor');
	do_action('admin_print_scripts');

	?>

		<div class="uz_input wp-editor">

			<div class="uz_clear"></div>

			<label for="<?php echo $input_name; ?>"> <?php echo $label; ?> </label>
      	<?php wp_editor( $input_value, $input_name, $settings ); ?>

		</div>

	<?php

}
