<?php
/**
* Project content page
*
* @subpackage portfolio site
* @since v0.1
*/

$this_page_id = get_cat_ID('myprojects');
// $this_page = myTheme_get_post($this_page_id);
$argsX = array(
		'cat' => $this_page_id,
		'post_type' => 'projects',
		'numberposts' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC'
	);
$proj_count = 0;

?>
<h1>My Work</h1>
	<div class="project-container regular-container" >
		<ul>
<?php
$this_query = new WP_Query( $argsX );
	if ( have_posts() ) : 
		while ( $this_query->have_posts() ) : 
			$this_query->the_post();
			$proj_count++;
			$prj_meta = get_post_meta(get_the_ID(), 'prj-meta-text', true);
			$proj_img = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
			
			if($proj_count % 2 === 0){
?>
				<li>
				<div class="col-md-5 proj-decp">
					<ul>
						<li><h1><?php the_title(); ?></h1></li>
						<li><a href="http://<?php echo $prj_meta; ?>" target="_blank">Vist Page</a></li>
						<li><span class="project-contrubute"><?php the_excerpt(); ?></span></li>
						<li><?php the_content(); ?></li>
						<li data-toggle="modal" data-target="#proj-<?php echo $proj_count; ?>" class="mobile_tog" id="p-<?php echo $proj_count; ?>">View Images</li>
						

					</ul>
				</div>
				<div class="col-md-7" >
					<div class="proj-img" data-toggle="modal" data-target="#proj-<?php echo $proj_count; ?>" style="background-image: url('<?php echo $proj_img; ?>')"></div>

					<div class="modal fade" id="proj-<?php echo $proj_count; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php the_title(); ?>" aria-hidden="false">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									 <h4 class="modal-title" id="myModalLabel"><?php the_title(); ?></h4>
								</div>
								<div class="modal-body">
									<div class="modal-image" style="background-image:url('<?php echo $proj_img; ?>')"></div>
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
					<div class="col-md-7" >
						<div class="proj-img" data-toggle="modal" data-target="#proj-<?php echo $proj_count; ?>" style="background-image: url('<?php echo $proj_img; ?>')"></div>

						<div class="modal fade" id="proj-<?php echo $proj_count; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php the_title(); ?>" aria-hidden="false">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
										 <h4 class="modal-title" id="myModalLabel"><?php the_title(); ?></h4>
									</div>
									<div class="modal-body">
										<div class="modal-image" style="background-image:url('<?php echo $proj_img; ?>')"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5 proj-decp">
						<ul>
							<li><h1><?php the_title(); ?></h1></li>
							<li><a href="http://<?php echo $prj_meta; ?>" target="_blank">Vist Page</a></li>
							<li><span class="project-contrubute"><?php the_excerpt(); ?></span></li>
							<li><?php the_content(); ?></li>
							<li data-toggle="modal" data-target="#proj-<?php echo $proj_count; ?>" class="mobile_tog" id="p-<?php echo $proj_count; ?>">View Images</li>
						</ul>
					</div>

				</li>

<?php
			}
				

		endwhile;
	endif;
?>