<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('WP FPO'); ?></h2>
	<?php if(!isset($_REQUEST['wpfpo_status'])){ ?>
		<!-- form -->
		<h3><?php _e('Create FPO blog posts to help your WordPress design and development process.'); ?></h3>
		<p><?php _e('This plugin creates randomly-generated content (via Markov chains from various sources) and creates for placement only posts. All posts are tagged #wp-fpo so you can easily find and delete them when necessary.'); ?></p>
		<form id="wp-fpo" method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
			<div id="wp-fpo-error" style="display:none"><p style="color:red">Sorry, all fields are required. If you're trying to enable categories and tags, be sure to enter how many categories/tags you want made.</p></div>

		    <input type="hidden" name="action" value="wpfpo" />
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="wpfpo_content_source"><?php _e('Content source?'); ?></label></th>
					<td>
						<select name="wpfpo_content_source" id="wpfpo_content_source">
							<option value="loremipsum"><?php _e('Standard "Lorem ipsum..."'); ?></option>
							<option value="birmingham"><?php _e('Letter from Birmingham Jail'); ?></option>
							<option value="usconstitution"><?php _e('The Constitution of the United States'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('How should the content be structured?'); ?></label></th>
					<td>
						<fieldset>
							<label>
								<input type="radio" name="wpfpo_content_structure" value="flat"/>
								<span><?php _e('Flat paragraphs of text'); ?></span>
							</label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_content_structure" value="rich"/>
								<span><?php _e('Rich text via HTML (h1...h6, blockquote, etc)'); ?></span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Which author should be assigned?'); ?></label></th>
					<td>
						<?php
							$current_user = wp_get_current_user();
						?>
						<fieldset>
							<label>
								<input type="radio" name="wpfpo_author" value="current"/>
								<span><?php _e('Me'); ?> <strong>(<?php echo $current_user->display_name; ?>)</strong></span>
							</label>
							<br/>
							<label>						
								<input type="radio" name="wpfpo_author" id="wpfpo_author_another" value="another"/>
								<span>
									<?php _e('Another user:'); ?> <?php wp_dropdown_users(array('name'=>'wpfpo_author_id')); ?> 								
								</span>
							</label>
						</fieldset>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="wpfpo_num_posts"><?php _e('Number of posts to create?'); ?></label></th>
					<td>
						<input name="wpfpo_num_posts" type="text" id="wpfpo_num_posts" class="small-text" />
						<p class="description"><?php _e('The more posts you create, the longer this process could take.'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Create categories?'); ?></label></th>
					<td>
						<fieldset>
							<input type="radio" name="wpfpo_category_bool" id="wpfpo_category_bool_yes" value="yes"/>
							<label><span><?php _e('Yes,'); ?> <input name="wpfpo_category_num" type="text" id="wpfpo_category_num" class="small-text" onfocus="jQuery('input#wpfpo_category_bool_yes').attr('checked','checked')"/> <?php _e('per post'); ?></span></label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_category_bool" value="no"/>
								<span><?php _e('No'); ?></span>
							</label>
						</fieldset>
						<p class="description"><?php _e('Random words will be used as categories and assigned at random.'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Create tags?'); ?></label></th>
					<td>
						<fieldset>
							<input type="radio" name="wpfpo_tag_bool" id="wpfpo_tag_bool_yes" value="yes"/>
							<label><span><?php _e('Yes,'); ?> <input name="wpfpo_tag_num" type="text" id="wpfpo_tag_num" class="small-text" placeholder="" onfocus="jQuery('input#wpfpo_tag_bool_yes').attr('checked','checked')"/> <?php _e('per post'); ?></span></label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_tag_bool" value="no"/>
								<span><?php _e('No'); ?></span>
							</label>
						</fieldset>
						<p class="description"><?php _e('Random words will be used as tags and assigned at random.'); ?></p>
					</td>
				</tr>

			</table>
			<p class="submit">
				<input type="submit" name="submit" class="button button-primary" value="Create FPO Posts" />
			</p>
		</form>
		<!-- /form -->

	<?php } else { ?>
	
		<!-- results -->
		<?php if($_REQUEST['wpfpo_status'] == "success"){ ?>
			<!-- success -->
				<h2>Success!</h2>
				<p><?php _e('Sweet, I just made ')?> <a href="edit.php?tag=wp-fpo"><?php echo $_REQUEST['wpfpo_num_posts']?></a> <?php _e('posts.'); ?> <a href="tools.php?page=wp-fpo">Make more</a>.</p>
			<!-- /success -->
		<?php } else { ?>
			<!-- fail -->
				<h2>Ruh Roh...</h2>
				<p><?php _e('Err, something went wrong. Sorry. Check your error logs, and click'); ?> <a href="tools.php?page=wp-fpo">here</a> <?php _e("to try again. You'll have to re-enter your options, unfortunately."); ?></p>
			<!-- /fail -->
		<?php } ?>
		<!-- /results -->
	
	<?php } ?>

	<!-- hsolink -->
	<p style="margin-top:150px;"><span style="padding:7px; color:#fff; background-color: #1da0c6; font-family:arial; font-size:1em">WP FPO, by <a href="http://husani.com" target="_blank" style="color:#fff">Husani S. Oakley</a>. <a href="" target="_blank" style="color:#fff">Wordpress plugin page</a>. <a href="http://github.com/husani/wp-fpo" target="_blank" style="color:#fff">GitHub</a>.</span></p>
	<!-- /hsolink -->

</div>

<script language="javascript" type="text/javascript">
	<!-- quick and admittedly dirty form validation -->
	jQuery('form#wp-fpo').submit(function(){
		if(
			(jQuery('form#wp-fpo input[name=wpfpo_content_structure]').is(':checked')) &&
			(jQuery('form#wp-fpo input[name=wpfpo_author]').is(':checked')) &&
			(jQuery('form#wp-fpo input[name=wpfpo_num_posts]').val() != "") &&
			(jQuery('form#wp-fpo input[name=wpfpo_category_bool]').is(':checked')) &&
			(jQuery('form#wp-fpo input[name=wpfpo_tag_bool]').is(':checked'))
		){
			//check author, cats, tags
			if(jQuery('form#wp-fpo input[name=wpfpo_category_bool]:checked', '#wp-fpo').val() == "yes"){
				if(jQuery('form#wp-fpo input[name=wpfpo_category_num]').val() == ""){
					wpfpoShowError();
					return false;
				} 
			}
			if(jQuery('form#wp-fpo input[name=wpfpo_tag_bool]:checked', '#wp-fpo').val() == "yes"){
				if(jQuery('form#wp-fpo input[name=wpfpo_tag_num]').val() == ""){
					wpfpoShowError();
					return false;					
				} 
			}
			//hide submit button and replace with "please wait" message
			jQuery('form#wp-fpo input[name=submit]').attr('disabled','disabled').removeClass('button-primary').addClass('button-secondary').val("Please wait...");
			return true;
		} else {
			wpfpoShowError();
			return false;
		}
	});
	function wpfpoShowError(){
		jQuery('div#wp-fpo-error').show();
	}
	<!-- even dirtier form focus/blur crap -->
	jQuery('select#wpfpo_author_id').change(function(){
		jQuery('input#wpfpo_author_another').attr('checked','checked');
	});
</script>