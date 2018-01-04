<?php

if (!class_exists('bwlms_message_menu_class'))
{
  class bwlms_message_menu_class
  {
 	private static $instance;
	
	public static function init()
        {
            if(!self::$instance instanceof self) {
                self::$instance = new self;
            }
            return self::$instance;
        }
		
    function actions_filters()
    {
			add_action ('bwlms_message_menu_button', array(&$this, 'newmessage'));
			add_action ('bwlms_message_menu_button', array(&$this, 'messagebox'));
			add_action ('bwlms_message_menu_button', array(&$this, 'settings'));
    }

	function settings() {
	 $class = 'bwlms-message-button';

	 if ( is_page( bwlms_message_page_id() ) && isset($_GET['bwlmsmessageaction']) && sanitize_text_field($_GET['bwlmsmessageaction']) == 'settings')
		 $class = 'bwlms-message-button-active';
	}

	function newmessage() {
	 $class = 'bwlms-message-button';
	 if ( is_page( bwlms_message_page_id() ) && isset($_GET['bwlmsmessageaction']) && sanitize_text_field($_GET['bwlmsmessageaction']) == 'newmessage')
		$class = 'bwlms-message-button-active';

		$newmsgbtn = "
				<div id='wptobe_message_newbtn' class='row message_new_btn_row'>

						<a href='#' data-reveal-id='firstModal' class='$class bwlms-msg-new-btn'>";
		
		$newmsgbtn .= __('New Message', 'wptobemem');
		$newmsgbtn .= "</a></div>	";

		$newmsgbtn .="	
			<div id='firstModal' class='reveal-modal' data-reveal aria-labelledby='firstModalTitle' aria-hidden='true' role='dialog'>
			
						<div class='bwlms-newmsg-titlerow' id='firstModalTitle'>";
		$newmsgbtn .= __('New Message', 'wptobemem');
		$newmsgbtn .="	</div>";
		$newmsgbtn .= do_shortcode('[bwlms-message-new]');
		
		$newmsgbtn .=" 
			  <a class='close-reveal-modal' aria-label='Close'>&#215;</a>
			</div>
		
		</div><!--Centered-->
		</div><!--Row bwlms-message-ui.php function bwlms_message_message_box() [202 Line] -->
		 ";
 		 echo $newmsgbtn;
	  }
	  
	  function messagebox() {
		$numNew = bwlms_message_get_new_message_button();
		$class = 'bwlms-message-button';
		 if ( is_page( bwlms_message_page_id() ) && ( !isset($_GET['bwlmsmessageaction']) || sanitize_text_field($_GET['bwlmsmessageaction']) == 'messagebox') )
		 $class = 'bwlms-message-button-active';
	  }

  } 
} 

add_action('wp_loaded', array(bwlms_message_menu_class::init(), 'actions_filters'));
?>