jQuery(function($){

	$('#proj_btn_save').click(function(){
		//cont how many inputs their is 
		var formCount = $('form#project-form .proj_input').length,
			formData = [];
		var hasData = $('form#project-form .proj_input:eq(0)').val();
		

		//pull all of user input from form 
		for(var i=0; i<formCount; i++){
			var getFormData = $('form#project-form .proj_input:eq('+ i +')').val();
		 		if(i>1){
		 			if(getFormData){
			 			formData.push(getFormData);
					}else{
						console.log('no val');
					};	
		 		}else{
		 			formData.push(getFormData);
		 		}

		}
		//user input 
		if(formData.length > 1){
			console.log('add data');
		
		var proj_id = formData[0],
			proj_title   = formData[1],  
			proj_url  = formData[2], 
			proj_work   = formData[3], 
			proj_decp = formData[4],  
			proj_nav_img    = formData[5]; 
			proj_reg_img    = formData[6]; 

			if(hasData){
				console.log('update row');
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'proj_edit_proj',
						proj_id : proj_id,
						proj_title: proj_title,
						proj_url: proj_url,
						proj_work: proj_work,
						proj_decp: proj_decp,
						proj_nav_img: proj_nav_img,
						proj_reg_img: proj_reg_img
					},
					//on sucess, add player to table and give the user a response 
					success: function(response){
						console.log(response);
						$('.project-admin-section ul').append(response);
						$('#proj_response').html('Project updated!').delay(5000).fadeOut();

						$('form#project-form .proj_input').val('');
					}
				})
			}else{

		// ajax request
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'proj_save_proj',
				proj_id : proj_id,
				proj_title: proj_title,
				proj_url: proj_url,
				proj_work: proj_work,
				proj_decp: proj_decp,
				proj_nav_img: proj_nav_img,
				proj_reg_img: proj_reg_img
			},
			//on sucess, add player to table and give the user a response 
			success: function(response){
				$('.project-admin-section ul').append(response);
				$('#proj_response').html('Project Added!').delay(5000).fadeOut();

				$('form#project-form .proj_input').val('');

			}
		})
		return false;
			console.log('new post');
		}
		}else{
			console.log('do not add!');
		}
	});//end of save click

	var project_input = $('form#project-form .proj_input'),
		project_count = project_input.length;

	$('.project-admin-section > ul > li').click(function(){
		var project = $(this),
			project_id = project.data('proj_id');

		$.ajax({
			url: ajaxurl,
			type: 'GET',
			data: {
				action: 'proj_get_proj',
				project_ID: project_id
			},
			//on sucess, add player to table and give the user a response 
			success: function(response){
				var this_project = JSON.parse(response);
				var this_ID = this_project[0].myTheme_project_id,
					this_name = this_project[0].myTheme_project_title,
					this_url = this_project[0].myTheme_project_url,
					this_work = this_project[0].myTheme_project_work,
					this_decp = this_project[0].myTheme_project_decp,
					this_nav_img = this_project[0].myTheme_project_nav_img;
					this_img = this_project[0].myTheme_project_img;

				$(project_input[0]).val(this_ID);
				$(project_input[1]).val(this_name);
				$(project_input[2]).val(this_url);
				$(project_input[3]).val(this_work);
				$(project_input[4]).val(this_decp);
				$(project_input[5]).val(this_nav_img);
				$(project_input[6]).val(this_img);


			}
		})
	});

	
	$('#proj_btn_delete').click(function(){
		var formCount = $('form#project-form .proj_input').length,
			formData = [];
			// console.log(formCount);
		//pull all of user input from form 
		for(var i=0; i<formCount; i++){
			var getFormData = $('form#project-form .proj_input:eq('+ i +')').val();
		 		formData.push(getFormData);
		}
		var proj_id = formData[0];

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'proj_delete',
				proj_id : proj_id,
				
			},
			//on sucess, add player to table and give the user a response 
			success: function(response){

				$('#proj_response').html('Project Deleted!').delay(5000).fadeOut();

				$('form#project-form .proj_input').val('');
				$('[data-proj_id='+proj_id+']').remove();

			}
		})
		return false;


	});

	//Open wordpress media uploader when search image is clicked 
    $('#proj_nav_img').click(function(e) {
    	var nav_media_button = $(this);
    	e.preventDefault();

    	custom_uploader = wp.media.frames.file_frame = wp.media({
    		title: 'Choose Image',
    		button: {text: 'Save Image'},
    		multiple: false
    	});
    	custom_uploader.on('select', function(){
    		attachment = custom_uploader.state().get('selection').first().toJSON();
    		var id = nav_media_button.attr('id');
 			$('input[name="'+id+'"]').val(attachment.url);
            $('#'+id+'-preview').attr( 'src', attachment.url );

            $('#proj_nav_img').val(attachment.url);
    	})
    	custom_uploader.open();
    });

    $('#proj_img_').click(function(e) {
	var reg_media_button = $(this);
	e.preventDefault();

	custom_uploader = wp.media.frames.file_frame = wp.media({
		title: 'Choose Image',
		button: {text: 'Save Image'},
		multiple: false
	});
	custom_uploader.on('select', function(){
		attachment = custom_uploader.state().get('selection').first().toJSON();
		var id = reg_media_button.attr('id');
			$('input[name="'+id+'"]').val(attachment.url);
        $('#'+id+'-preview').attr( 'src', attachment.url );

        $('#proj_img_').val(attachment.url);
	})
	custom_uploader.open();
});

})