<?php
	
?>
<div class="project-admin-wrapper">
	<div class="project-admin-section">
		<h1>Add, Edit, or Remove projects from project section</h1>
		<form id="project-form" action="options.php" method="post">
			<span id="proj_response"></span>
			<?php settings_fields( 'proj_show_group' ); ?>
			<input type="hidden" class="proj_input" name="proj_id" data-this_id="">
			<input type='text' class="proj_input" name="proj_name" placeholder="Project Name">
			<input type='text' class="proj_input" name="proj_url" placeholder="Project URL">
			<input type='text' class="proj_input" name="proj_work" placeholder="Project Work">
			<textarea cols="45" rows="10" class="proj_input" name="project_decription" placeholder="Add decription of project"></textarea>

			<input type='text' id="proj_nav_img" class="proj_input" name="proj-img-nav" placeholder="Add picture for Nav view">
			<input type='text' id="proj_img_" class="proj_input" name="proj-img-reg" placeholder="Add picture for regular view">
			<input type="button" class="proj_img" id="proj_btn_save"value="Save" />
			<input type="button" class="proj_btn" id="proj_btn_delete"value="Delete" />
		</form>
	</div>
	<div class="project-admin-section">
		<h2>Active projects</h2>

		<ul>
			<?php 
				global $wpdb;

				$table_name = $wpdb->prefix . 'myTheme_project_showcase';

				$admin_proj_showcase= $wpdb->get_results("SELECT * FROM " . $table_name . " "); 
				
				//add new player to active table on admin page 
				foreach ($admin_proj_showcase as $proj) {
					?>
					<li class="admin-active-proj" data-proj_id="<?php echo $proj->myTheme_project_id; ?>">
						<?php echo $proj->myTheme_project_title; ?>
					 </li>
					<?
		
				}
			?>
		</ul>

	</div>
</div>
