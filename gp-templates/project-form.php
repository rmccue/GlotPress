<dl>
	<dt><label for="project[name]"><?php _e('Name');  ?></label></dt>
	<dd><input type="text" name="project[name]" value="<?php echo esc_html( $project->name ); ?>" id="project[name]"></dd>
	
	<!-- TODO: make slug edit WordPress style -->
	<dt><label for="project[slug]"><?php _e('Slug');  ?></label></dt>
	<dd>
		<input type="text" name="project[slug]" value="<?php echo esc_html( $project->slug ); ?>" id="project[slug]">
		<small>If you leave the slug empty, it will be derived from the name.</small>
	</dd>	

	<dt><label for="project[description]"><?php _e('Description');  ?></label></dt>
	<dd><textarea name="project[description]" rows="4" cols="40" id="project[description]"><?php echo esc_html( $project->description ); ?></textarea></dd>

	<dt><label for="project[source_url_template]"><?php _e('Source file URL');  ?></label></dt>
	<dd>
		<input type="text" value="<?php echo esc_html( $project->source_url_template ); ?>" name="project[source_url_template]" id="project[source_url_template]" style="width: 30em;" />
		<small>Public URL to a source file in the project. You can use <code>%file%</code> and <code>%line%</code>. Ex. <code>http://trac.example.org/browser/%file%#L%line%</code></small>
	</dd>

	<dt><label for="project[parent_project_id]"><?php _e('Parent Project');  ?></label></dt>
	<dd><?php echo gp_select( 'project[parent_project_id]', $all_project_options, $project->parent_project_id); ?></dd>
</dl>
<?php echo gp_js_focus_on( 'project[name]' ); ?>