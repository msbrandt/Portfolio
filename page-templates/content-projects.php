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
		'post_type' => 'post',
		'post_count' => 1
	);

$this_query = new WP_Query( $argsX );
	if ( have_posts() ) : 
		while ( $this_query->have_posts() ) : 
			$this_query->the_post();
				the_content();
		endwhile;
	endif;
?>
