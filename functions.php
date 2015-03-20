<?php
 require get_template_directory() . '/inc/my-navbar.php';

/**
 * myTheme setup.
 *
 * @since myTheme 1.0
 */
function myTheme_setup(){
	/**
	* Register wp nav menu to create custom navbars
	*
	* @since myTheme 1.0 
	*
	*/
	add_theme_support( 'html5' );

	register_nav_menu( 'primary', __( 'Primary Menu', 'myTheme') );

	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'myTheme_setup' );


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since myTheme 1.0
 *
 * @return void
 */
function myTheme_scripts() {
	// Load main stylesheet.
	wp_enqueue_style( 'myTheme-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	// wp_enqueue_style( 'myTheme-proj-style', get_template_directory_uri() . '/css/proj_styles.css');
	wp_enqueue_style( 'myTheme-style', get_stylesheet_uri());

	wp_enqueue_style( 'myTheme-fonts', '//fonts.googleapis.com/css?family=Federo|Open+Sans|Righteous|Ubuntu|Ubuntu+Condensed' );



	wp_enqueue_script( 'myTheme-bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), true );
	wp_enqueue_script( 'myTheme-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), true );
}

add_action( 'wp_enqueue_scripts', 'myTheme_scripts' );

function myTheme_get_pages(){
	$pages = array('myAbout','myProjects','myResume','myContact');
	$pageArray = array();
	foreach ($pages as $page) {

		$thePageID = get_cat_ID($page);
		$args = array(
				'cat' => $thePageID,
				'post_type' => 'post',
				// 'post_count' => 1
			);
		$thisQuery = new WP_Query( $args );

		if ( have_posts() ) : 
			while ( $thisQuery->have_posts() ) : 
				$thisQuery->the_post();
			$thePost = get_post();
			array_push($pageArray, $thePost);

			endwhile;
		endif;

		// echo $page;
	}
				return $pageArray ;

	// $thisargs = array('sort_column'=>'menu_order');
	// $ph_pages = get_pages($thisargs); 

	// return $ph_pages;

}

function myTheme_get_post($theCatID){
	// return $theCatID;
	$args = array(
			'cat' => $theCatID,
			'post_type' => 'post',
			// 'post_count' => 1
		);
	$thisQuery = new WP_Query( $args );
	// return $thisQuery;
	if ( have_posts() ) : 
		while ( $thisQuery->have_posts() ) : 
			$thisQuery->the_post();
			return get_post();

		endwhile;
	endif;
	
}

function myTheme_header(){
	?>
       <a class="my-nav-button" id="scroll-down" href="#myTheme-about"><span class="myTheme-more glyphicon glyphicon-chevron-down"></span></a>

       <header>
              <nav class="navbar-inverse my-nav" role="navigation">
                     <div class="my-nav-container">

                            <?php myTheme_nav(); ?>
                     </div>
              </nav>

       </header>
              <div class="my-nav-temp"></div>

	<?php
}
function project_link_metabox(){

	add_meta_box('project-metabox', 'Link to Page', 'project_link_metabox_form');

}
add_action('add_meta_boxes', 'project_link_metabox');

function project_link_metabox_form( $project ){
	// var_dump( $project );
	wp_nonce_field( basename(__FILE__), 'proj_nonce');
	$proj_stored_meta = get_post_meta( $project->ID );
	// var_dump( $proj_stored_meta );
	?>
	<p>
        <label for="prj-meta-text" class="project-row-title">Add Website link</label>
        <input type="text" name="prj-meta-text" id="proj-prj-meta-text" value="<?php if ( isset ( $proj_stored_meta['prj-meta-text'] ) ) echo $proj_stored_meta['prj-meta-text'][0]; ?>" />
    </p>
	<?php
}

function project_save_meta($project_id){
    $is_autosave = wp_is_post_autosave( $project_id );
    $is_revision = wp_is_post_revision( $project_id );
    $is_valid_nonce = ( isset( $_POST[ 'proj_nonce' ] ) && wp_verify_nonce( $_POST[ 'proj_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 	// echo $is_valid_nonce;
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'prj-meta-text' ] ) ) {
    // 	echo $_POST[ 'prj-meta-text' ];
        update_post_meta( $project_id, 'prj-meta-text', sanitize_text_field( $_POST[ 'prj-meta-text' ] ) );
    // }else{
    // 	echo '<h1>No post meta!</h1>';
    }
}
add_action( 'save_post', 'project_save_meta' );

function projects_post_type() {
	register_post_type( 'projects',
		array(
			'menu_icon' => 'dashicons-portfolio',
			'menu_position' => 5,
			'capability_type' => 'post',
			'taxonomies' => array('category'),
			'supports' => array(
				'thumbnail',
				'title',
				'editor',
				'page-attributes',
				'excerpt'
			),

			'labels' => array(
					'name' => __( 'Project Showcase' ),
					'singular_name' => __( 'project' ),
					'add_new' => __( 'Add New' ),
					'add_new_item' => __( 'Add New Project' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Project' ),
					'new_item' => __( 'New Project' ),
					'view' => __( 'View Project' ),
					'view_item' => __( 'View Project' ),
					'search_items' => __( 'Search Project' ),
					'not_found' => __( 'No Project found' ),
					'not_found_in_trash' => __( 'No Project found in Trash' ),
					'parent' => __( 'Parent Project' ),
				),
			'public' => true,
			'has_archive' => true,
		)
	);
}
add_action( 'init', 'projects_post_type' );









?>