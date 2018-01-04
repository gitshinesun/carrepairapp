<?php

/*--------------------------------------------------*/
/* Simple Background Manager > frontend load style
/*--------------------------------------------------*/

function vuzzu_sbm_load_background_manager_style() {

	// In case post type is not supported break the hook
	$supported_post_types = get_theme_support( 'simple_background_manager_support_types' );
	if( !is_front_page() && !is_home() && !is_singular( $supported_post_types[0] ) ) return;

	global $wp_query;
	$postId = $wp_query->get_queried_object_id();

	// SBM Settings
	$sbm_fi_as_bi = get_option('simple_background_manager_fi_as_bi',false);
	$sbm_inherit_parent_settings = get_option('simple_background_manager_inherit_parent_settings',false);

	$bg_img_default = ($sbm_fi_as_bi) ? wp_get_attachment_url(get_post_thumbnail_id($postId)) : null;
	$background_manager_options = get_post_meta($postId, 'sbm_background_manager', true);

	if($sbm_inherit_parent_settings) {
		$ppID = wp_get_post_parent_id($postId);
		if(!$background_manager_options) $background_manager_options = get_post_meta($ppID, 'sbm_background_manager', true);
		if(!$bg_img_default) $bg_img_default = ($sbm_fi_as_bi) ? wp_get_attachment_url(get_post_thumbnail_id($ppID)) : null;
	}

	$bg_color = (isset($background_manager_options['color'])) ? $background_manager_options['color'] : null;
	$bg_color_opacity = (isset($background_manager_options['color_opacity'])) ? $background_manager_options['color_opacity'] : 1;
	$bg_img = (isset($background_manager_options['img'])) ? $background_manager_options['img'] : $bg_img_default;
	$bg_img_repeat  = (isset($background_manager_options['img_repeat'])) ? $background_manager_options['img_repeat'] : null;
	$bg_img_fixed	= (isset($background_manager_options['img_fixed'])) ? $background_manager_options['img_fixed'] : null;

	//Convert bg color to rgb values
	(strlen($bg_color) === 4) ? list($r, $g, $b) = sscanf($bg_color, "#%1x%1x%1x") : list($r, $g, $b) = sscanf($bg_color, "#%2x%2x%2x");

	?>

		<style type="text/css">

		body {
			<?php if($bg_img) echo "background-image: url({$bg_img}) !important;"; ?>
			<?php if(!$bg_img && $bg_color) echo "background-color: rgba({$r},{$g},{$b},{$bg_color_opacity}) !important;"; ?>
			<?php echo ($bg_img_repeat) ? "background-repeat: {$bg_img_repeat} !important;" : "background-repeat:no-repeat;"; ?>
			<?php if($bg_img_fixed) echo "background-attachment: fixed !important;"; ?>
		}

		<?php if($bg_color && $bg_img && $bg_color_opacity) : ?>
			body > div.overlay-color-mask {
				width: 100%;
				height: 100%;
				position: fixed;
				top: 0; left:0;
				z-index:-1;
				<?php echo "background-color: rgba({$r},{$g},{$b},{$bg_color_opacity}) !important;"; ?>
			}
		<?php endif;?>

		</style>

	<?php

}

/*--------------------------------------------------*/
/* Simple Background Manager > frontend load script
/*--------------------------------------------------*/

function vuzzu_sbm_load_background_manager_script() {

	$supported_post_types = get_theme_support( 'simple_background_manager_support_types' );
	if( !is_front_page() && !is_home() && !is_singular( $supported_post_types[0] ) ) return;

	global $wp_query;
	$postId = $wp_query->get_queried_object_id();

	// SBM Settings
	$sbm_fi_as_bi = get_option('simple_background_manager_fi_as_bi',false);
	$sbm_inherit_parent_settings = get_option('simple_background_manager_inherit_parent_settings',false);

	$bg_img_default = ($sbm_fi_as_bi) ? wp_get_attachment_url(get_post_thumbnail_id($postId)) : null;
	$background_manager_options = get_post_meta($postId, 'sbm_background_manager', true);

	if($sbm_inherit_parent_settings) {
		$ppID = wp_get_post_parent_id($postId);
		if(!$background_manager_options) $background_manager_options = get_post_meta($ppID, 'sbm_background_manager', true);
		if(!$bg_img_default) $bg_img_default = ($sbm_fi_as_bi) ? wp_get_attachment_url(get_post_thumbnail_id($ppID)) : null;
	}

	$bg_color = (isset($background_manager_options['color'])) ? $background_manager_options['color'] : null;
	$bg_color_opacity = (isset($background_manager_options['color_opacity'])) ? $background_manager_options['color_opacity'] : null;
	$bg_img = (isset($background_manager_options['img'])) ? $background_manager_options['img'] : $bg_img_default;

	if($bg_img && $bg_color && $bg_color_opacity) :

		?>
			<script>
			document.addEventListener("DOMContentLoaded", function(event) {
				document.body.insertAdjacentHTML( 'afterbegin', '<div class="overlay-color-mask"></div>' );
			});
			</script>
		<?php

	endif;

}
