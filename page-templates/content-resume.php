<?php
/**
* Resume content page
*
* @subpackage portfolio site
* @since v0.1
*/
// $this_page_id = get_cat_ID('myresume');
// // $this_page = myTheme_get_post($this_page_id);
// $argsX = array(
// 		'cat' => $this_page_id,
// 		'post_type' => 'post',
// 		'post_count' => 1
// 	);

// $this_query = new WP_Query( $argsX );
// 	if ( have_posts() ) : 
// 		while ( $this_query->have_posts() ) : 
// 			$this_query->the_post();
// 				the_content();
// 		endwhile;
// 	endif;
?>
<div class="download-version pull-right"><a href="<?php echo get_template_directory_uri(); ?>/img/Michael_Brandt_resume.pdf" target="_blank"><span class="glyphicon glyphicon-save"></span>Resume</a></div>

<div class="row" id="regular_version">
	<div class='col-md-3'>
		<div class="top-section">
			<h1>Michael <br />Brandt</h1>
			<h3>Production Developer</h3> 
			<h3>Syracuse Spiders</h3>
		</div>
		<div class="bottom-section">
			<div class="bottom-content">
				<h4>9578 Tagus Lane</h4>
				<h4>Brewerton, NY  13029</h4>
				<br />
				<h4>315-373-9569</h4>
				<h4>msbrandt@syr.edu</h4>
				<h4>michaelbrandt.info</h4>
			</div>
		</div>
	</div>
	<div class='col-md-9'>
		<h3 class="heading">Education</h3>
		<ul id="ed-list">
			<li>
				<h4 class="sub-heading">Syracuse University School of Information Studies</h4>
				<p>Bachelor of Science: Information Management and Technology</p>
				<p>Anticipated Date of Graduation: May 2015</p>
			</li>
			<li>
				<h4 class="sub-heading">Paul V. Moore High School</h4>
				<p>Honor Roll and Career and Technical Education – Diploma June 2011</p>
			</li>
		</ul>
		<h3 class="heading">Experence</h3>
		<ul id="experence-list">
			<li>
				<h4 class="sub-heading">SYRACUSE Spiders, (May 2013 – Present)</h4>
				<ul>
					<li>Production Developer for Content Management Systems</li>
					<li>Develop plugins and themes for Syracuse University</li>
					<li>Site worked on:  beyondthehill.syr.edu, studentorgs.syr.edu/suvbc, and orangeTv.syr.edu </li>
				</ul>
			</li>
			<li>
				<h4 class="sub-heading">The Pike Company General Employee, (June 2012 – August 2012)</h4>
				<ul>
					<li>Fire proofing all new vents and plumbing during bathroom reinvention</li>
					<li>Making sure Shaw Hall was kept clean and safe during project </li>
				</ul>
			</li>
			<li>
				<h4 class="sub-heading">The Pike Company General Employee, (June 2012 – August 2012)</h4>
				<ul>
					<li>Inspect student dorms and apartments for damages</li>
					<li>General maintenance on the Syracuse University campus</li>
				</ul>
			</li>
			<li>
				<h4 class="sub-heading">Carrier Dome Merchandise Supervisor, (Fall 2008-Spring 2014)</h4>
				<ul>
					<li>Sell Syracuse apparel and merchandise during events</li>
					<li>Make sure all stands are stocked and ready for events</li>
					<li>Run transfers to stands during events</li>
				</ul>
			</li>
		</ul>
		<h3 class="heading">TECHNICAL SKILLS</h3>
		<ul id="tech-skills">
			<li>PHP, JavaScript, jQuery, HTML5, CSS3</li>
			<li>Responsive design</li>
			<li>Wordpress / CMS</li>
			<li>git hub / Version Control</li>
			<li>z/OS, JCL, RDz, for COBOL</li>
			<li>Knowledgeable in Microsoft Office and Adobe Creative Suite</li>
		</ul>

	</div>
</div>
<div class="row" id="mobile_version">
	<div class="col-md-12">
		<h1>Michael Brandt</h1>
		<h3>Production Developer</h3> 
		<h3>Syracuse Spiders</h3>
		<p>For more informaiton about my resume, feel free to download it or check out my <a class="my-nav-button" href="#myTheme-about"> about </a> section!</p>
		<!-- <img src="<?php echo get_template_directory_uri(); ?>/img/curved_arrow.png"> -->
	</div>
</div>