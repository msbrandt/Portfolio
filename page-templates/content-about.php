<?php
/**
* About content page
*
* @subpackage portfolio site
* @since v0.1
*/

$this_page_id = get_cat_ID('myabout');
// $this_page = myTheme_get_post($this_page_id);
$argsX = array(
		'cat' => $this_page_id,
		'post_type' => 'post',
		'post_count' => 1
	);

$this_query = new WP_Query( $argsX );
	if ( have_posts() ) : 
		while ( $this_query->have_posts() ) : 
			$this_query->the_post();
		?>
		<div class="row">
			<!-- <div class="my-image col-md-6" style="background-image: url('<?php echo get_template_directory_uri();?>/img/me_use.png')"></div> -->
			<div class="my-image col-md-6">
				<h1>M</h1>
				<h1>B</h1>
			</div>
			<div class="extra-padding col-md-6">
				<h1><?php the_title(); ?></h1>
				<p><?php the_content(); ?></p>
			</div>
		</div>
<?php
		endwhile;
	endif;

?>