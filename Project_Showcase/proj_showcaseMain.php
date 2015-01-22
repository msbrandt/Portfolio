<?php
/**
* @package   Project Showcase
* @author    Mike Brandt 
* @license   GPL-2.0+
*
*Plugin Name: Portfolio Project Showcase
*Description: Add, edit, or delete projects to a portoilio website.
*Version: v1.0
*Author: Mikey b
*
*/
if ( ! defined( 'WPINC' ) ) {
	die;
}

register_activation_hook( __FILE__, array( 'proj_showcase', 'activate' ) );
require_once( plugin_dir_path( __FILE__ ) . 'proj_showcase_class.php' );


register_deactivation_hook( __FILE__, array( 'proj_showcase', 'deactivate' ) );
include( 'views/public.php' );


proj_showcase::get_instance();
register_activation_hook( __FILE__, array( proj_showcase, 'myTheme_proj_table_install' ) );



?>