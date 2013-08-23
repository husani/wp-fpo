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

	var $user_options;
	var $fpo_category_source = "categories.txt";
	var $fpo_tag_source = "tags.txt";

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
		$this->user_options = $_REQUEST;
		if($this->_doPost()){
			$status = "success";	
		} else {
			$status = "failure";
		}
		wp_redirect( $_SERVER['HTTP_REFERER'] . "&wpfpo_status=" . $status);
		exit();
	}

	/**
	 * Create post with content passed to function
	 */
	private function _doPost(){
		$categories = $this->_postCategory();
		$tags = $this->_postTag();


		$args = array(
					'post_author' => $this->_postAuthor(),
					'post_content' => $this->_postContent(),
					'post_excerpt' => $this->_postExcerpt(),
					'post_title' => $this->_postTitle(),
			);
			
		print_r($args);
		die;
		if($post_id = wp_insert_post($args)){
			//add categories if necessary
			if($this->user_options['wpfpo_category_bool']){
				//wp_set_post_terms($post_id);
			}
			return true;
		} else {
			return false;		
		}
	}
	
	/**
	 * Generate FPO author
	 */
	private function _postAuthor(){
	
	}
	
	/**
	 * Generate FPO category
	 */
	private function _postCategory(){
		if($this->user_options['wpfpo_category_bool']){
			return $this->_getFromTextfile($this->user_options['wpfpo_category_num'], $this->fpo_category_source);
		} else {
			return false;
		}
	}

	/**
	 * Generate FPO tags
	 */
	private function _postTag(){
		if($this->user_options['wpfpo_tag_bool']){
			return $this->_getFromTextfile($this->user_options['wpfpo_tag_num'], $this->fpo_tag_source);
		} else {
			return false;
		}
	}
	
	/**
	 * Generate FPO content
	 */
	private function _postContent(){
		//include markov logic
		include plugin_dir_path(__FILE__) . "markov/markov.php";		

		//set up table
		$markov_table = generate_markov_table(file_get_contents(plugin_dir_path(__FILE__) . "/content/" . "loremipsum.txt"), 50);

		//let's start generating content. two ways to do this -- blocks of paragraphs or include fun html stuff, depending on user choice.
		$content_array = array();
		
		switch($this->user_options['wpfpo_content_structure']){
			case "flat":
				$num_paragraphs = rand(3,10);
				for($i = 0; $i < $num_paragraphs; $i++){
			        $content_array[] = "<p>" . generate_markov_text(rand(250,1000), $markov_table, 50) . "</p>";
			    }
				break;
			case "rich":
				//get the flat paragraphs
				
				//randomly choose words to bold/ital
				
				//get markov'd sentences...
				
				//...then make those sentences randomly h1...h6
				break;
			case "both":
				break;
		}
		print_r($content_array);
		die;
	}
	
	/**
	 * Generate FPO title
	 */
	private function _postTitle(){
		return "a fake title";
	}

	/**
	 * Open and retrieve lines from a text file
	 */
	private function _getFromTextFile($num_lines, $textfile){
		$content = file(plugin_dir_path(__FILE__) . "/content/" . $textfile);
		$lines_array = array();
		for($i = 0; $i < $num_lines; $i++){
		    $lines_array[] = $content[rand(0, count($content) - 1)];
		}
		return $lines_array;
	}

}

//go gadget go
new wpfpo;

?>