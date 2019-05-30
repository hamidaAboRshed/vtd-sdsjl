function addTextureMemberModel() 
{
	$("#createTextureForm")[0].reset();
	//$("#texture_img").attr("src","../../assets/images/nature.jpg");
	$('.jcrop-holder img').attr("src","../../assets/images/nature.jpg");
	$('#color').trigger("chosen:updated");
	$('#material').trigger("chosen:updated");
	
	//I can't set value to file input element,  the browser will not allow this because of security concerns.
	//$('#Texture_file').val("../../assets/images/nature.jpg");
	
	/*//remove textdanger
	$(".text-danger").remove();*/
	// remove form-group
	$(".form-group").removeClass('has-error').removeClass('has-success');
	
	$("#createTextureForm").unbind('submit').bind('submit', function() {
		var form = $(this);
		var data = new FormData(document.getElementById("createTextureForm"));
		// remove the text-danger
		$(".text-danger").remove();

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			//data: form.serialize(), // /converting the form data into array and sending it to server
			data:data,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success:function(response) { 
				if(response.success === true) {
					/*$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					'</div>');*/

					// hide the modal
					$("#add_texture_modal").modal('hide');


				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("[name='"+index+"']");;

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);

						});
					} else {
						/*$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');*/
						// hide the modal
						$("#add_texture_modal").modal('hide');
					}
				}
			}
		});	

		return false;
	});

}
