<?php

function bwlmslevel_shortcode_show_level($atts, $content=null, $code="")
{
	global $wpdb, $bwlmslevel_levels, $current_user, $levels;
	
	ob_start();
	
	if(bwlmslevel_hasMembershipLevel())
	{
		$level = $current_user->membership_level;
		?>

		<div class='row fullwidthrow_bwlmslevels'>

			<div class='small-11 medium-11 large-11 large-centered medium-centered small-centered columns bwlmsmembership-level-col'>

					<div class="row bwlmsmembership-level-shell-1">
						<div class="large-3 medium-3 small-3 columns bwlmsmembership-level-title">
							<?php _e( 'Memberships', 'wptobemem' ); ?>
						</div>
						<div class="large-9 medium-9  small-9 columns"></div>
					</div>


					<div class="row bwlmsmembership-level-shell-2"> 
						<div class="large-3 medium-3 small-3 columns bwlmsmembership-level-leftcol">
							<?php _e('Current Level', 'wptobemem'); ?>
						</div>

						<div class="large-9 medium-9 small-9 columns bwlmsmembership-level-rightcol">
							<?php 
							if (!isset($current_user->membership_level->name))
								_e('No Level','wptobemem');
							else
								echo $current_user->membership_level->name; 
							?>
						</div>
					</div>

			</div><!--endof 10-->
		</div>
		<?php
	}
	else {
	?>

		<div class='row fullwidthrow_bwlmslevels'>
			<div class='small-11 medium-11 large-11 large-centered medium-centered small-centered columns bwlmsmembership-level-col'>

					<div class="row bwlmsmembership-level-shell-1">
						<div class="large-3 medium-3 small-3 columns bwlmsmembership-level-title">
							<?php _e( 'Memberships', 'wptobemem' ); ?>
						</div>
						<div class="large-9 medium-9  small-9 columns"></div>
					</div>


					<div class="row bwlmsmembership-level-shell-2"> 
						<div class="large-3 medium-3 small-3 columns bwlmsmembership-level-leftcol">
							<?php _e('You have no membership.', 'wptobemem'); ?>
						</div>

						<div class="large-9 medium-9 small-9 columns bwlmsmembership-level-rightcol">
						</div>
					</div>

			</div><!--endof 10-->
		</div>
		<?php
	}
	
	$content = ob_get_contents();
	ob_end_clean();
	
	return $content;
}
add_shortcode('bwlmslevel_level', 'bwlmslevel_shortcode_show_level');