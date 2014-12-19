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
						<div class="col-md-5 proj-decp">
							<h1><?php echo $project_title; ?></h1>
							<a href="http://<?php echo $project_url; ?>" target="_blank">View Page</a>
							<span class="project-contrubute"><?php echo $project_work; ?></span>
							<p><?php echo $project_decp; ?></p>
						</div>
						<div class="col-md-7" >
							<div class="proj-img" data-toggle="modal" data-target="#proj-<?php echo $proj_count; ?>" style="background-image: url('<?php echo $project_img; ?>')"></div>

							<div class="modal fade" id="proj-<?php echo $proj_count; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $project_title; ?>" aria-hidden="false">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											 <h4 class="modal-title" id="myModalLabel"><?php echo $project_title; ?></h4>
										</div>
										<div class="modal-body">
											<div class="modal-image" style="background-image:url('<?php echo $project_img; ?>')"
											<img src="<?php echo $project_img; ?>">
										</div>
									</div>
								</div>
							</div>
						</div>

					</li>
					<?php

				}else{
					?>
					<li>
						<div class="col-md-7">
							<div class="proj-img" data-toggle="modal" data-target="#proj-<?php echo $proj_count; ?>" style="background-image: url('<?php echo $project_img; ?>')"></div>
							<div class="modal fade" id="proj-<?php echo $proj_count; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $project_title; ?>" aria-hidden="false">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
											 <h4 class="modal-title" id="myModalLabel"><?php echo $project_title; ?></h4>
										</div>
										<div class="modal-body">
											<div class="modal-image" style="background-image:url('<?php echo $project_img; ?>')"
											IMAGE GOES HERE!!!
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-5 proj-decp">
							<h1><?php echo $project_title; ?></h1>
							<a href="http://<?php echo $project_url; ?>" target="_blank">View Page</a>
							<span class="project-contrubute"><?php echo $project_work; ?></span>
							<p><?php echo $project_decp; ?></p>
						</div>

					</li>

					<?php
				}
			}


		?>
	</ul>
</div>

<?php

	}
//add this to post to display plugin 
add_shortcode( 'proj_show', 'display_project_show_case' ); 
?>