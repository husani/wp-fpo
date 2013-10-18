<?php
/*
Plugin Name: WP FPO
Plugin URI: http://github.com/husani/wp-fpo
Description: Create FPO blog posts to help your WordPress design and development process. This plugin creates randomly-generated content (via Markov chains from various sources) and creates for placement only posts. All posts are tagged #wp-fpo so you can easily find and delete them when necessary.
Version: 1.0
Author: Husani S. Oakley
Author URI: http://husani.com/
License: GPL2
*/

/*
Copyright 2013  Husani Oakley

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class wpfpo{

	var $user_options;
	var $content_sources;

	/**
	 * Constructor. Set up WP actions and content source locations
	 */
	function __construct(){
		add_action('admin_menu', array(&$this, 'adminMenu'));	
		add_action('admin_action_wpfpo', array($this, 'createPosts'));
		$this->content_sources['content']['loremipsum'] = plugin_dir_path(__FILE__) . "/content/loremipsum.txt";
		$this->content_sources['content']['usconstitution'] = plugin_dir_path(__FILE__) . "/content/usconstitution.txt";
		$this->content_sources['content']['birmingham'] = plugin_dir_path(__FILE__) . "/content/birmingham.txt";
		$this->content_sources['meta']['category'] = plugin_dir_path(__FILE__) . "/content/categories.txt";
		$this->content_sources['meta']['tag'] = plugin_dir_path(__FILE__) . "/content/tags.txt";
	}
	
	/**
	 * Add page for this plugin to WP admin.
	 */
	function adminMenu(){
		add_submenu_page('tools.php', 'WP FPO', 'WP FPO', 'manage_options', 'wp-fpo', array($this, 'adminUi'));
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
		if($this->_doPosts()){
			$status = "success";
		} else {
			$status = "failure";
		}
		wp_redirect( $_SERVER['HTTP_REFERER'] . "&wpfpo_status=" . $status . "&wpfpo_num_posts=" . $_REQUEST['wpfpo_num_posts']);
		exit();
	}

	/**
	 * Create post with content passed to function
	 */
	private function _doPosts(){
		//include markov logic
		include plugin_dir_path(__FILE__) . "markov/markov.php";
		
		//get all content from text files to avoid a bunch of needless i/o
		$this->source_content = file_get_contents($this->content_sources['content'][$this->user_options['wpfpo_content_source']]);
		
		//loop through user-requested number of posts, make posts/tags/categories
		$created_count = 0;
		for($i = 0; $i < $this->user_options['wpfpo_num_posts']; $i++){
			$tags = $this->_postTag();
			$args = array(
						'post_author' => $this->user_options['wpfpo_author_id'],
						'post_content' => implode("", $this->_postContent()),
						'post_excerpt' => $this->_postExcerpt(),
						'post_title' => $this->_postTitle(),
						'post_status' => 'publish'
				);	

			if($post_id = wp_insert_post($args)){
				//add categories if necessary
				if($this->user_options['wpfpo_category_bool']){
					//create categories
					unset($category_ids);
					$categories = $this->_postCategory();
					foreach($categories as $category){
						$category_ids[] = wp_create_category($category);
					}
					wp_set_post_categories($post_id, $category_ids);
				}
				//add tags if necessary
				if($this->user_options['wpfpo_tag_bool']){
					//get and assign tags
					wp_set_post_tags($post_id, $this->_postTag());
				}
				//add wpfpo-specific tag
				wp_set_post_tags($post_id, "wp-fpo", true);
				//and we're done.
				$created_count++;
			}

		}
		//if what we've made matches what we wanted to make, we're good -- otherwise, something went wrong.
		if($created_count == $this->user_options['wpfpo_num_posts']){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Generate FPO category
	 */
	private function _postCategory(){
		if($this->user_options['wpfpo_category_bool']){
			return $this->_getFromTextfile($this->user_options['wpfpo_category_num'], $this->content_sources['meta']['category']);
		} else {
			return false;
		}
	}

	/**
	 * Generate FPO tags
	 */
	private function _postTag(){
		if($this->user_options['wpfpo_tag_bool']){
			$tags_array = $this->_getFromTextfile($this->user_options['wpfpo_tag_num']-1, $this->content_sources['meta']['tag']); //minus 1 so we can have the plugin's tag
			array_unshift($tags_array, "wp-fpo");
			return $tags_array;
		} else {
			return false;
		}
	}
	
	/**
	 * Generate FPO content
	 */
	private function _postContent(){
		//set up table
		$markov_table = generate_markov_table($this->source_content, 50);

		//let's start generating content. two ways to do this -- blocks of paragraphs or include fun html stuff, depending on user choice.
		$content_array = array();
		
		switch($this->user_options['wpfpo_content_structure']){
			case "flat":
				$num_paragraphs = rand(3,12);
				for($i = 0; $i < $num_paragraphs; $i++){
			        $content_array[] = "<p>" . $this->_fixText(generate_markov_text(rand(250,1000), $markov_table, 50)) . "</p>";
			    }
				break;
			case "rich":
				//get the flat paragraphs
				$num_paragraphs = rand(3,7);
				for($i = 0; $i < $num_paragraphs; $i++){
			        $content_array[] = "<p>" . $this->_fixText(generate_markov_text(rand(250,1000), $markov_table, 50)) . "</p>";
			    }				
				//get markov'd sentence and make blockquote
				$content_array[] = "<blockquote>" . $this->_fixText(generate_markov_text(200, $markov_table, 50)) . "</blockquote>";
				
				//get markov'd sentences and randomly apply h1 ... h6 
				$num_paragraphs = rand(2,6);
				for($i = 0; $i < $num_paragraphs; $i++){
					$rand_html = rand(1,6);
			        $content_array[] = "<h" . $rand_html . ">" . $this->_fixText(generate_markov_text(150, $markov_table, 50)) . "</h" . $rand_html . ">";
			    }
				//randomly reorder content
				shuffle($content_array);
				break;
		}
		return $content_array;
	}
	
	/** 
	 * Generate FPO excerpt
	 */
	private function _postExcerpt(){
		$markov_table = generate_markov_table($this->source_content, 50);
		return $this->_fixText(generate_markov_text(250, $markov_table, 50));
	}
	
	/**
	 * Generate FPO title
	 */
	private function _postTitle(){
		$markov_table = generate_markov_table($this->source_content, 15);
		return $this->_fixText(generate_markov_text(5, $markov_table, 5));
	}

	/**
	 * Open and retrieve lines from a text file
	 */
	private function _getFromTextFile($num_lines, $textfile){
		$content = file($textfile);
		$lines_array = array();
		for($i = 0; $i < $num_lines; $i++){
		    $lines_array[] = $content[rand(0, count($content) - 1)];
		}
		return $lines_array;
	}
	
	/**
	 * Make the FPO markov'd text a little more realistic - ensure sentences look like they begin and end properly.
	 */
	private function _fixText($string){
		//kill linebreaks
		$string = str_replace("\n", "", $string);
		//make sure we start with a letter and do not end with a space
		$string = trim($string, ",. ");
		return ucfirst($string . ".");
	}

}

//go gadget go
new wpfpo;

?>