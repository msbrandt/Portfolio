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
 * Register Lato Google font 
 *
 * @since myTheme
 *
 * @return string
 */
// function myTheme_font_url() {
// 	$font_url = '';
// 	/*
// 	 * Translators: If there are characters in your language that are not supported
// 	 * by Lato, translate this to 'off'. Do not translate into your own language.
// 	 */
// 	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'myTheme' ) ) {
// 		$font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
// 	}

// 	return $font_url;
// }

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since myTheme 1.0
 *
 * @return void
 */
function myTheme_scripts() {
	// Add Lato font, used in the main stylesheet.
	// wp_enqueue_style( 'myTheme-lato', myTheme_font_url(), array(), null );

	// Load main stylesheet.
	wp_enqueue_style( 'myTheme-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'myTheme-proj-style', get_template_directory_uri() . '/css/proj_styles.css');
	wp_enqueue_style( 'myTheme-style', get_stylesheet_uri());

	wp_enqueue_style( 'myTheme-fonts', '//fonts.googleapis.com/css?family=Raleway|Open+Sans|Ubuntu|Ubuntu+Condensed|Oswald' );

	wp_enqueue_style( 'myTheme-exp-fonts', '//fonts.googleapis.com/css?family=Exo|Poiret+One|Denk+One|Voltaire|Allerta+Stencil|Federo|Snippet' );


	wp_enqueue_script( 'myTheme-bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20131209', true );
	wp_enqueue_script( 'myTheme-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20131209', true );
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