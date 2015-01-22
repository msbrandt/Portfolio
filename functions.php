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
?>