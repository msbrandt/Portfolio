<?php
/**
* Contact content page
*
* @subpackage portfolio site
* @since v0.1
*/
$this_page_id = get_cat_ID('mycontact');
// $this_page = myTheme_get_post($this_page_id);
$argsX = array(
		'cat' => $this_page_id,
		'post_type' => 'post',
		'post_count' => 1
	);
?>
<div class="row">
<?php
$this_query = new WP_Query( $argsX );
	if ( have_posts() ) : 
		while ( $this_query->have_posts() ) : 
			$this_query->the_post();
		?>
		<h1>Contact me for more infromation or freelance work!</h1>

		<div class="col-md-12">
		<!-- <h1><?php the_title(); ?></h1> -->
			<?php the_content(); ?>
		</div>
		<?php
		endwhile;
	endif;
?>

</div>
