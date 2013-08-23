<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('WP FPO'); ?></h2>

	<?php if(!isset($_REQUEST['wpfpo_status'])){ ?>
		<!-- form -->
		<h3><?php _e('Blah blah blah and stuff'); ?></h3>
		<p><?php _e('Some explanatory copy goes here.'); ?></p>
		<h3 style="width:50%">IMPORTANT: Depending on the speed of your server (and some external sources, per options above), this may take awhile. Don't click submit again or you'll have more FPO posts than perhaps you want.</h3>
		<form method="post" action="<?php echo admin_url( 'admin.php' ); ?>">
	    <input type="hidden" name="action" value="wpfpo" />
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="wpfpo_content_type"><?php _e('Content type?'); ?></label></th>
					<td>
						<select name="wpfpo_content_type" id="wpfpo_content_type">
							<option name="loremipsum"><?php _e('Lorem ipsum dolor sit amet, consectetur adipiscing elit.'); ?></option>
							<option name="shakespeare">Blah blah</option>
						</select>
						<p class="description"><?php _e('A description of this option can go here'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="wpfpo_num_posts"><?php _e('Number of posts to create?'); ?></label></th>
					<td>
						<input name="wpfpo_num_posts" type="text" id="wpfpo_num_posts" class="small-text" />
						<p class="description"><?php _e('A description of this option can go here'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Create FPO categories?'); ?></label></th>
					<td>
						<fieldset>
							<label title="yes">
								<input type="radio" name="wpfpo_category_bool" value="yes"/>
								<span><?php _e('Yes'); ?></span>
							</label>
							&nbsp;
							<label title="no">
								<input type="radio" name="wpfpo_category_bool" value="no"/>
								<span><?php _e('No'); ?></span>
							</label>
						</fieldset>
						<p class="description"><?php _e('A description of this option can go here'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Create FPO tags?'); ?></label></th>
					<td>
						<fieldset>
							<label>
								<input type="radio" name="wpfpo_tag_bool" value="yes"/>
								<span><?php _e('Yes'); ?></span>
							</label>
							&nbsp;
							<label>
								<input type="radio" name="wpfpo_tag_bool" value="no"/>
								<span><?php _e('No'); ?></span>
							</label>
						</fieldset>
						<p class="description"><?php _e('A description of this option can go here'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('Should the posts contain images?'); ?></label></th>
					<td>
						<fieldset>
							<label>
								<input type="radio" name="wpfpo_images" value="yes_fpo"/>
								<span><?php _e('Yes, and use blank image placeholders via'); ?> <a href="http://placehold.it" target="_blank">Placehold.it</a></span>
							</label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_images" value="yes_flickr"/>
								<span><?php _e('Yes, and use Creative Commons images from'); ?> <a href="http://flickr.com" target="_blank">Flickr</a></span>
							</label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_images" value="no"/>
								<span><?php _e('No'); ?></span>
							</label>
							<br/>
						</fieldset>
						<p class="description"><?php _e('A description of this option can go here'); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label><?php _e('How should the content be structured?'); ?></label></th>
					<td>
						<fieldset>
							<label>
								<input type="radio" name="wpfpo_images" value="yes_fpo"/>
								<span><?php _e('Flat paragraphs of text'); ?></span>
							</label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_images" value="yes_flickr"/>
								<span><?php _e('Rich text via HTML (h1...h6, blockquote, etc)'); ?></span>
							</label>
							<br/>
							<label>
								<input type="radio" name="wpfpo_images" value="no"/>
								<span><?php _e('Both'); ?></span>
							</label>
							<br/>
						</fieldset>
						<p class="description"><?php _e('A description of this option can go here'); ?></p>
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
				<p><?php _e('Sweet, I just made ')?> <a href="edit.php?category_name=wp-fpo"><?php echo $_REQUEST['wpfpo_num_posts']?></a> <?php _e('posts.'); ?> <a href="tools.php?page=wp-fpo">Make more</a>.</p>
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