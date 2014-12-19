<?php 
function display_project_show_case(){
	
	global $wpdb;
	$table_name = $wpdb->prefix . 'myTheme_project_showcase';
	
	$proj_content_query = $wpdb->get_results("SELECT * FROM ".$table_name." ");
	$proj_nav_query = $wpdb->get_results("SELECT myTheme_project_title, myTheme_project_nav_img FROM ".$table_name." ");
	
	$proj_nav_count = 0;
	$proj_count = 0;


?>

	<h1>My Work</h1>

		<div class="project-container regular-container" >
			<ul>
		<?php

			foreach ($proj_content_query as $project) {
				$project_ID = $project->myTheme_project_id;
				$project_title = $project->myTheme_project_title;
				$project_url = $project->myTheme_project_url;
				$project_work = $project->myTheme_project_work;
				$project_decp = $project->myTheme_project_decp;
				$project_nav_img = $project->myTheme_project_nav_img;
				$project_img = $project->myTheme_project_img;

				$proj_count++;

				if($proj_count % 2){
					?>
					<li>
						<div class="col-md- "></div>
						<div class="col-md- "></div>

					</li>


					<?php

				}else{
					?>
					<li>
						<div class="col-md- "></div>
						<div class="col-md- "></div>

					</li>

					<?php
				}


		?>
			</ul>
			<div class="row project-content-1" id="<?php echo $project_title; ?>-content">
				<div class="project-decp col-sm-7">
					<ul>
						<li>
							<h1><?php echo $project_title; ?></h1>
						</li>
						<li> 
							<a href="http://<?php echo $project_url; ?>" target="_blank">View page</a>
						</li>
						<li>
							<span class="project-contrubute"><?php echo $project_work; ?></span>
						</li>
						<li>
							<p><?php echo $project_decp; ?></p>
						</li>
					</ul>
					
				</div>
				<div class="project-img-container col-sm-5" >
					<div class="project-img" style="background-image: url('<?php echo $project_img; ?>')">
						img 1
					</div> 
				</div>
			</div>

			<?php
				$proj_count ++; 
				}
			?>
		</div>
		<ul id="mobile-showcase">
		<?php 

			foreach ($proj_content_query as $project) {
				$project_ID = $project->myTheme_project_id;
				$project_title = $project->myTheme_project_title;
				$project_url = $project->myTheme_project_url;
				$project_work = $project->myTheme_project_work;
				$project_decp = $project->myTheme_project_decp;
				$project_nav_img = $project->myTheme_project_nav_img;
				$project_img = $project->myTheme_project_img;


		?>
			<li data-position="<?php echo $proj_nav_count; ?>">
				<h1><?php echo $project_title; ?></h1>
				<h5><a href="http://<?php echo $project_url; ?>" target="_blank">View page</a></h5>
				<h5><?php echo $project_work; ?></h5>
				<p><?php echo $project_decp; ?></p>
			</li>
	<?php 
		$proj_nav_count++;
		};
	?>
		</ul>	
<?php

	}
//add this to post to display plugin 
add_shortcode( 'proj_show', 'display_project_show_case' ); 
?>