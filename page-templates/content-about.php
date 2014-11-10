<?php
/**
* About content page
*
* @subpackage portfolio site
* @since v0.1
*/

$this_page_id = get_cat_ID('myabout');
$this_page = myTheme_get_post($this_page_id);

?>
<div class="extra-padding">
	<h1><?php echo $this_page->post_title; ?></h1>
	<p><?php echo $this_page->post_content; ?></p>

</div>