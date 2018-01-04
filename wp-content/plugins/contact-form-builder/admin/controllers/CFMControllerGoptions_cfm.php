<?php

class CFMControllerGoptions_cfm {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
  }
  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function execute() {
    $task = WDW_CFM_Library::get('task');
    $id = (int)WDW_CFM_Library::get('current_id', 0);
    $message = WDW_CFM_Library::get('message');
    echo WDW_CFM_Library::message_id($message);
    if (method_exists($this, $task)) {
		check_admin_referer('nonce_cfm', 'nonce_cfm');
		$this->$task($id);
    }
    else {
		$this->display();
    }
  }

  public function display() {
    require_once WD_CFM_DIR . "/admin/models/CFMModelGoptions_cfm.php";
    $model = new CFMModelGoptions_cfm();

    require_once WD_CFM_DIR . "/admin/views/CFMViewGoptions_cfm.php";
    $view = new CFMViewGoptions_cfm($model);
    $view->display();
  }

  public function save() {
    $message = $this->save_db();
    $page = WDW_CFM_Library::get('page');
    WDW_CFM_Library::spider_redirect(add_query_arg(array('page' => $page, 'task' => 'display', 'message' => $message), admin_url('admin.php')));
  }
  
  public function save_db() {
    $public_key = (isset($_POST['public_key']) ? esc_html(stripslashes($_POST['public_key'])) : '');
    $private_key = (isset($_POST['private_key']) ? esc_html(stripslashes($_POST['private_key'])) : '');
    $map_key = (isset($_POST['map_key']) ? esc_html(stripslashes($_POST['map_key'])) : '');
    update_option('cfm_settings', array('public_key' => $public_key, 'private_key' => $private_key, 'map_key' => $map_key));	
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