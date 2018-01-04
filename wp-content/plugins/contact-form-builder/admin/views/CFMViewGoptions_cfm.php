<?php
class CFMViewGoptions_cfm {
	////////////////////////////////////////////////////////////////////////////////////////
	// Events                                                                             //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Constants                                                                          //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Variables                                                                          //
	////////////////////////////////////////////////////////////////////////////////////////
	private $model;

	////////////////////////////////////////////////////////////////////////////////////////
	// Constructor & Destructor                                                           //
	////////////////////////////////////////////////////////////////////////////////////////
	public function __construct($model) {
    $this->model = $model;
	}

  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
	public function display() {
		$cfm_settings = get_option('cfm_settings');
		$public_key = isset($cfm_settings['public_key']) ? $cfm_settings['public_key'] : '';
		$private_key = isset($cfm_settings['private_key']) ? $cfm_settings['private_key'] : '';
		$map_key = isset($cfm_settings['map_key']) ? $cfm_settings['map_key'] : '';
		?>
		<div class="fm-clear"></div>
		<form class="wrap" method="post" action="admin.php?page=goptions_cfm" style="width:99%;">
			<?php wp_nonce_field('nonce_cfm', 'nonce_cfm'); ?>     
			<div class="fm-options-page-banner">
        <div class="fm-options-logo"></div>
				<div class="fm-options-logo-title">
					<?php echo __("Global Options", "contact_form_maker"); ?>
				</div>
				<div class="fm-page-actions">
					<button class="fm-button save-button small" onclick="spider_set_input_value('task', 'save');">
            <span></span>
						<?php echo __("Save", "contact_form_maker"); ?>
					</button>
				</div>
			</div>

			<table style="clear:both;">
				<tbody>
					<tr>
						<td>
							<label for="public_key"><?php echo __("Recaptcha Site Key:", "contact_form_maker"); ?></label>
						</td>
						<td>
							<input type="text" id="public_key" name="public_key" value="<?php echo $public_key; ?>" style="width:250px;" />
						</td>
						<td rowspan="2">
							<a href="https://www.google.com/recaptcha/intro/index.html" target="_blank"><?php echo __("Get Recaptcha", "contact_form_maker"); ?></a>
						</td>
					</tr>
					<tr>
						<td>
							<label for="private_key"><?php echo __("Recaptcha Secret Key:", "contact_form_maker"); ?></label>
						</td>
						<td>
							<input type="text" id="private_key" name="private_key" value="<?php echo $private_key; ?>" style="width:250px;" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="public_key"><?php echo __("Maps API Key:", "contact_form_maker"); ?></label>
						</td>
						<td>
							<input type="text" id="map_key" name="map_key" value="<?php echo $map_key; ?>" style="width:250px;" />
						</td>
						<td>
							<a href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend&keyType=CLIENT_SIDE&reusekey=true" target="_blank"><?php echo __("Get maps API key", "contact_form_maker"); ?></a>
						</td>
					</tr>
					<tr>
						<td>
							
						</td>
						<td>
							<span style="width:250px; display: inline-block; padding: 0 5px;">(It may take up to 5 minutes for API key change to take effect.)</span>
						</td>
						<td>
							
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" id="task" name="task" value=""/>
		</form>
		<?php
	}



	////////////////////////////////////////////////////////////////////////////////////////
	// Getters & Setters                                                                  //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Private Methods                                                                    //
	////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	// Listeners                                                                          //
	////////////////////////////////////////////////////////////////////////////////////////
}