<?php

/*************************************************
* Utilizer ui elements: radio input
**************************************************/
function uz_radio_input($label,$input_name,$input_value,$options=array()) {

	$label_string = "label_{$input_name}";

	?>

		<div class="uz_input">

			<label> <?php echo $label; ?> </label>
			<div class="uz_radio" data-actual="<?php echo $input_value; ?>">

				<?php $first=true; foreach($options as $option) :
					$ls = (isset($option['label'])) ? sanitize_title($option['label']) : "label-".rand(1111,9999); ?>

					<input id="<?php echo $ls; ?>" type="radio" name="<?php echo $input_name; ?>" value="<?php echo $option['value']; ?>" <?php if($first && !$input_value) echo 'checked="checked"'; ?> <?php if($input_value && $input_value==$option['value']) echo 'checked="checked"'; ?> />
					<label for="<?php echo $ls; ?>"> <?php if(isset($option['icon'])) echo '<i class="'.$option['icon'].'"></i> '; if($option['label']) echo $option['label']; ?> </label>

				<?php $first=false; endforeach; ?>

				<div class="uz_clear"></div>

			</div>

		</div>

	<?php

}
