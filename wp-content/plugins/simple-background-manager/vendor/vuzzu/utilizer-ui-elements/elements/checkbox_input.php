<?php

/*************************************************
* Utilizer ui elements: checkbox input
**************************************************/

// Checkbox ui element
function uz_checkbox_input($label,$input_name,$input_value) {

	?>

		<div class="uz_input">

			<label> <?php echo $label; ?> </label>
			<div class="uz_clear"></div>
			<a href="#" class="checkbox" data-actual="<?php if(!empty($input_value)) echo $input_value; ?>">
				<div class="inner">
					<p class="off"> Off </p>
					<i class="fa fa-times-circle-o off"></i>
					<i class="fa fa-check-circle-o on"></i>
					<p class="on"> On </p>
				</div>
				<input type="checkbox" name="<?php echo $input_name; ?>" value="<?php if(!empty($input_value)) echo $input_value; ?>" checked="checked" />
			</a>

			<div class="uz_clear"></div>

		</div>

	<?php

}
