<?php
/**
 * Roster Plugin
 *
 * @package   Project Showcase
 * @author    Mikey Brandt 
 * @license   GPL-2.0+
 */
/**
 * Plugin class.
 */
class proj_showcase {
	
	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.0';

	/**
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'proj_showcase';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_proj_textdomain' ) );
		add_action( 'admin_menu', array( $this, 'add_proj_admin_menu' ) );



		// Add the options page and menu item.
		add_action( 'wp_enqueue_scripts', array( $this, 'activate_proj_jquery' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_project_admin_scripts') );
		add_action( 'admin_enqueue_scripts', array( $this, 'proj_custom_media') );

		add_action( 'wp_enqueue_scripts', array( $this, 'proj_public_scripts' ) );


		// Load style sheet.
		// add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_proj_styles') );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_stylesX') );
		// add_action( 'enqueue_scripts', array( $this, 'enqueue_public_styles') );


		// add_action( 'admin_init', array( $this, 'proj_settings' ) );
		add_action( 'wp_ajax_proj_save_proj', array( $this, 'proj_save_proj_handler') );
		add_action( 'wp_ajax_proj_delete', array( $this, 'proj_delete_handler') );
		add_action( 'wp_ajax_proj_edit', array( $this, 'proj_edit_handler') );
		add_action( 'wp_ajax_proj_get_proj', array( $this, 'proj_get_proj_handler') );

		
		
	}
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
	 */
	public static function activate() {
		include_once('views/public.php');
	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {
		// Remove suvbc_featured_players table from db
		global $wpdb;
		$table_name = $wpdb->prefix . 'myTheme_project_showcase';

		$wpdb->query("DROP TABLE IF EXISTS $table_name");



	}
	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
	 */

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_proj_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */

	public function proj_public_scripts() {
			wp_enqueue_script( $this->plugin_slug . '-public-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), $this->version );
			wp_localize_script( $this->plugin_slug . '-public-script', 'SUVBC_Rosters', array( 'ajaxurl' => admin_url('admin-ajax.php')  ) );
			
		}

	//include jQuery
	public function activate_proj_jquery() {
		wp_enqueue_script( 'jquery' );
	}
	//include admin scrips
	public function enqueue_project_admin_scripts() {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
	}

	/**
	 * Register and enqueue style sheet.
	 *
	 * @since    1.0.0
	 */

	// public function enqueue_proj_styles() {
	// 	// wp_enqueue_style( 'pg-style', get_template_directory_uri() . '/css/proj_styles.css');	

	// 	wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/proj_styles.css', __FILE__ ), array(), $this->version );
	// }
	public function enqueue_stylesX() {
		// wp_enqueue_style( 'bootstrap-style', '//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css', array(), '3.2.0' );
		// wp_enqueue_style( $this->plugin_slug . '-bootstrap-styles', plugins_url( 'css/bootstrap.min.css', __FILE__ ), array(), $this->version );

		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/proj_styles.css', __FILE__ ), array(), $this->version );
		
	}
	
	// public function enqueue_public_styles(){
	// 	wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/proj_styles.css', __FILE__ ), array(), $this->version );

	// }

	//include media libery from forms  
	public function proj_custom_media(){
		wp_enqueue_media();
		
	}


	//add menu button to dashboard panal  
	public function add_proj_admin_menu(){
		add_menu_page(
			__( 'Project Showcase'),
			__( 'Project Showcase' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_proj_admin_page'), 'dashicons-id'
			);
	}
	//view for dashboard panal
	public function display_proj_admin_page() {
		include_once( 'views/admin.php' );

	}

	
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	

	public function proj_settings() {
		register_setting( 'proj_show_group', 'proj_set');
	}

	//install suvbc_featured_players table 
	public function myTheme_proj_table_install(){
		global $wpdb;

		$table_name = $wpdb->prefix . 'myTheme_project_showcase';

		$sql = "CREATE TABLE " . $table_name . "(
			myTheme_project_id MEDIUMINT NOT NULL AUTO_INCREMENT,
			myTheme_project_title TINYTEXT NOT NULL,
			myTheme_project_url TINYTEXT NOT NULL,
			myTheme_project_work TINYTEXT NOT NULL,
			myTheme_project_decp TINYTEXT NOT NULL,
			myTheme_project_nav_img TINYTEXT NOT NULL,
			myTheme_project_img TINYTEXT NOT NULL,
			PRIMARY KEY  myTheme_project_id (myTheme_project_id)
			);";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	public function proj_save_proj_handler(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'myTheme_project_showcase';

		$f_title = stripslashes($_REQUEST['proj_title']);
		$f_url = stripslashes($_REQUEST['proj_url']);
		$f_work = stripslashes($_REQUEST['proj_work']);
		$f_decp = stripslashes($_REQUEST['proj_decp']);
		$f_nav_img = stripslashes($_REQUEST['proj_nav_img']);
		$f_reg_img = stripslashes($_REQUEST['proj_reg_img']);


		$wpdb->insert( 
			$table_name, 
			array(
			'myTheme_project_id' =>  '',
			'myTheme_project_title' => $f_title,
			'myTheme_project_url' => $f_url,
			'myTheme_project_work' => $f_work,
			'myTheme_project_decp' => $f_decp,
			'myTheme_project_nav_img' => $f_nav_img,
			'myTheme_project_img' => $f_reg_img
			),
			array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
				)
			);
		// echo $f_url . " " . $f_name;
		$getProject = $wpdb->get_results("SELECT * FROM " . $table_name . " ");

		foreach ($getProject as $project) {
			 $project_ID   = $project->myTheme_project_id;
			 $project_title = $project->myTheme_project_title;
		}		
		$str = '<li class="admin-active-proj" data-proj_id="'.$project_ID.'">' . $project_title . '</li>';
		echo $str;

		exit();
	}
	public function proj_get_proj_handler(){

		global $wpdb;
		$project_id = stripslashes($_REQUEST['project_ID']);
		$table_name = $wpdb->prefix . 'myTheme_project_showcase';

		$editQuery = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE myTheme_project_id = '".$project_id."'");

		echo json_encode($editQuery);

		exit();


	}
	// //delete players from suvbc_featured_players table
	public function proj_delete_handler(){
		global $wpdb;
		
		$table_name = $wpdb->prefix . 'myTheme_project_showcase';

		$clicked_id = stripslashes( $_REQUEST['proj_id'] );
		echo $clicked_id;
		
		// $deleteQuery = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE myTheme_project_id = '".$clicked_id."'");
		// var_dump($deleteQuery);
	// 	foreach ($deleteQuery as $nName) {
	// 		$selectedID = $nName->mcm_id;
	// 	}
		$wpdb->delete( $table_name, array( 'myTheme_project_id' => $clicked_id ) );
		
		exit();
	}
	public function proj_edit_handler(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'myTheme_project_showcase';
		$p_id = stripslashes($_REQUEST['proj_id']);
		$p_title = stripslashes($_REQUEST['proj_title']);
		$p_url = stripslashes($_REQUEST['proj_url']);
		$p_work = stripslashes($_REQUEST['proj_work']);
		$p_decp = stripslashes($_REQUEST['proj_decp']);
		$p_nav_img = stripslashes($_REQUEST['proj_nav_img']);
		$p_img = stripslashes($_REQUEST['proj_reg_img']);
		
		$results = array(
			'myTheme_project_id' =>  $p_id,
			'myTheme_project_title' => $p_title,
			'myTheme_project_url' => $p_url,
			'myTheme_project_work' => $p_work,
			'myTheme_project_decp' => $p_decp,
			'myTheme_project_nav_img' => $p_nav_img,
			'myTheme_project_img' => $p_reg_img
			);

		$wpdb->update( $table_name, $results, array( 'myTheme_project_id' => $p_id) );

		exit();
	}

}
?>