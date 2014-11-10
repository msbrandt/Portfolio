jQuery(function($){

	var project_nav_boxs = $('.project-showcase > li'),
			project_containers = $('.project-content'),
			active_project_nav = $('.active-proj-nav'),
			active_project_container = $('.active-proj');

	project_nav_boxs.click(function(){
		var this_project = $(this),
				this_pos = this_project.data('position'),
				this_content = $(project_containers[this_pos]);


		project_nav_boxs.removeClass('active-proj-nav');
		this_project.addClass('active-proj-nav');

		project_containers.removeClass('active-proj');
		this_content.addClass('active-proj');

	})

	// var prjShowcase = $('.get_screen_height');
	// var showcaseSide = $('#project-title-project > aside.active-side'),
	// 	showcaseList = $('.project-nav-wrapper > ul'),
	// 	tempSide = $('.temp-sidebar');

 //  	var wh = $(window).height(),
 //  		ph = $('#projects').height(),
 //  		slh = showcaseList.height();

 //  		// console.log(slh);

 //  	var projectTop = $('#projects').offset().top,
 //  		projectBottom = $('#projects').offset().top + ph,
 //  		greyArea = $('#projects').height() - wh;
 //  	// console.log(tempSide);
 //  		projectBottomX = projectBottom + greyArea;
  
 //  	prjShowcase.height(ph);


 //  	var myProjects = $('.project-info'),
 //  		projectCount = myProjects.length;

 //  	var positionArry = [];
 //    var x = new Object();
 //    var projBox = $('.project-nav-wrapper > ul').children();
 //  	// console.log(projBox);
 //  	for( var i = 0; i < projectCount; i++ ){
 //  		var thisProject = myProjects[i],
 //          thisNav = projBox[i],
 //  			theTitle = $(thisProject).data('project'),

 //  			thePosition = $(thisProject).offset().top;
 //        x = {'proj': theTitle, 'pos': thePosition};
 //  			// console.log(theTitle + ": " + thePosition);
 //        // console.log(thisProject);
 //        // console.log(x);
 //    console.log(thisNav);
        

 //  		positionArry.push(x);
 //  		// console.log(thisProject);
 //  		// console.log(theTitle);
 //  	}
 //  	// console.log(positionArry);

 //  	$(window).scroll(function(){
 //  		var st = $(window).scrollTop(),
 //  			stb = st + wh;
 //  		var showcaseBottom = st + slh;
 //      var active = $('.active-project'),
 //          activeB = active.height() + st;
 //      // console.log(activeB);

 //  		// console.log(showcaseBottom + ' ' + projectBottom);

 //  		// console.log(st + ' ' + $(window).height() + ' '+ stb);
	// 	if(st > projectTop){
	// 		tempSide.show();
	// 		showcaseList.addClass('fix-sidebar');
	// 	}else{
	// 		tempSide.hide();
	// 		showcaseList.removeClass('fix-sidebar bottom-sidebar');
	// 	}
	// 	if( showcaseBottom > projectBottom){
	// 		// console.log('it works again');
	// 		tempSide.hide();
	// 		showcaseList.addClass('bottom-sidebar').removeClass('fix-sidebar');
			
	// 	}else if(showcaseBottom < projectBottom && st > projectTop){
	// 		showcaseList.addClass('fix-sidebar').removeClass('bottom-sidebar');

	// 	}

 //    if(activeB > positionArry[1].pos){
 //      // console.log(positionArry[1].proj);
 //      // console.log('change-active to phlaw');
 //    }
 //    // if(activeB > positionArry[2].pos){
 //    //   console.log('change-active to phlaw');
 //    // }
 //    // if(activeB > positionArry[3].pos){
 //    //   console.log('change-active to phlaw');
 //    // }
 //    // if(activeB > positionArry[4].pos){
 //    //   console.log('change-active to phlaw');
 //    // }

	// 	// if(stb > projectBottom){
	// 	// 	console.log('it works');
	// 	// 	// tempSide.hide();
	// 	// 	showcaseSide.addClass('bottom-sidebar').removeClass('fix-sidebar');
	// 	// }
	// 	// if(st > projectTop && st > projectBottom){
	// 	// 	if(stb > projectBottom){
	// 	// 		// tempSide.hide();
	// 	// 		// showcaseSide.removeClass('fix-sidebar').addClass('bottom-sidebar');
	// 	// 	}			
	// 	// }


 //  	});
  
});