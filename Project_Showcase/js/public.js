jQuery(function($){
  var h = $(window).height()-100;
  $('.get_screen_height').css('height', h);
	var project_nav_boxs = $('.project-showcase > li'),
			project_containers = $('.project-content'),
			active_project_nav = $('.active-proj-nav'),
			active_project_container = $('.active-proj');

	project_nav_boxs.click(function(){
		var is_active = $('.project-showcase').attr('data-is_active');
		// console.log(is_active);
		var this_project = $(this),
			this_pos = this_project.data('position'),
			this_content = $(project_containers[this_pos]);

		var show_proj = function(){
			this_project.addClass('active-proj-nav');
			this_content.addClass('active-proj');

		}
		var hide_proj = function(){
			project_nav_boxs.removeClass('active-proj-nav');
			project_containers.removeClass('active-proj');

		}
		if(is_active == 'false'){
			$('.project-showcase').attr('data-is_active', 'true');
			show_proj();

			// console.log('true');
		}else{
			hide_proj();

			setTimeout(show_proj,400);

			// console.log('false');
		}
		

				// this_project.parent().next().next().one().addClass('active-content');

		// project_nav_boxs.removeClass('active-proj-nav');
		// this_project.addClass('active-proj-nav');
		
		// project_containers.removeClass('active-proj');
		// this_content.addClass('active-proj');


	}); //end of project nav box click
})