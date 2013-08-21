<?php
/*
Plugin Name: WP FPO
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: The Plugin's Version Number, e.g.: 1.0
Author: Name Of The Plugin Author
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/



class wpfpo_setup{

	function __construct(){
		add_action('admin_menu', array(&$this, 'adminMenu'));	
	}
	
	function adminMenu(){
		add_submenu_page('tools.php', 'WP FPO', 'WP FPO', 'manage_options', 'wpfpo', array($this, 'adminUi'));
	}
	
	function adminUi(){
		include plugin_dir_path(__FILE__) . "admin/settings.inc.php";		
	}

}

new wpfpo_setup;

?>