<?php
/*
Plugin Name: WP FPO
Plugin URI: http://github.com/husani/wp-fpo
Description: Automatically create "for placement only" posts - includes inline FPO images and various text content sources.
Version: 1.0
Author: Name Of The Plugin Author
Author URI: http://husani.com
License: A "Slug" license name e.g. GPL2
*/

class wpfpo{

	/**
	 * Constructor. Perhaps obviously.
	 */
	function __construct(){
		add_action('admin_menu', array(&$this, 'adminMenu'));	
		add_action('admin_action_wpfpo', array($this, 'createPosts'));
	}
	
	/**
	 * Add page for this plugin to WP admin.
	 */
	function adminMenu(){
		add_submenu_page('tools.php', 'WP FPO', 'WP FPO', 'manage_options', 'wpfpo', array($this, 'adminUi'));
	}
	
	/**
	 * Load external file for plugin interface.
	 */
	function adminUi(){
		include plugin_dir_path(__FILE__) . "admin/ui.inc.php";		
	}
	
	/**
	 * Based on user options set in $_REQUEST, create FPO posts.
	 */
	function createPosts(){
		$status = "success";
		wp_redirect( $_SERVER['HTTP_REFERER'] . "&wpfpo_status=" . $status);
		exit();
	}

}

//go gadget go
new wpfpo;

?>