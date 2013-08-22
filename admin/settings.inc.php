<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php _e('WP FPO'); ?></h2>


	<h3><?php _e('Blah blah blah and stuff'); ?></h3>

	<p><?php _e('Some explanatory copy goes here.'); ?></p>

	<!-- content -->
	
	<form method="post">
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="wpfpo_content_type"><?php _e('Content type?'); ?></label></th>
				<td>
					<select name="wpfpo_content_type" id="wpfpo_content_type">
						<option name="loremipsum">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</option>
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
				<th scope="row"><label><?php _e('Create FPO categories for these posts?'); ?></label></th>
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
				<th scope="row"><label><?php _e('Create FPO tags for these posts?'); ?></label></th>
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
							<span>Yes, and use blank image placeholders via <a href="http://placehold.it" target="_blank">Placehold.it</a></span>
						</label>
						<br/>
						<label>
							<input type="radio" name="wpfpo_images" value="yes_flickr"/>
							<span>Yes, and use Creative Commons images from <a href="http://flickr.com" target="_blank">Flickr</a></span>
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
							<span>Flat paragraphs of text</span>
						</label>
						<br/>
						<label>
							<input type="radio" name="wpfpo_images" value="yes_flickr"/>
							<span>Yes, and use Creative Commons images from <a href="http://flickr.com" target="_blank">Flickr</a></span>
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
		</table>
	</form>
	
	
	<!-- /content -->

	<!-- hsolink -->
<!-- 	<p style="margin-top:150px;"><small style="padding:6px; color:#fff; background-color: blue">WP FPO, by <a href="http://husani.com" target="_blank" style="color:#fff">Husani S. Oakley</a>. <a href="" target="_blank">Wordpress plugin page</a>. <a href="" target="_blank">GitHub</a>.</small></p> -->
	<!-- /hsolink -->

</div>