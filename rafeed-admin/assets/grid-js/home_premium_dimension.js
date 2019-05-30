function upload_photos(premium_id = null,dimension_id = null, type=null) 
{
	if(premium_id) {

		$("#change_product_photoForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$('.modal-title').html('Upload '+ type+' photos');

		$("#change_product_photoForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("change_product_photoForm"));
		$.ajax({
			url: form.attr('action') + '/' + premium_id + '/' + dimension_id + '/' + type,
			type: form.attr('method'),
			//data: form.serialize(), // /converting the form data into array and sending it to server
			data:data,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#uploadPhotosModal").modal('hide');

					// update the manageMemberTable
					manageMemberTable.ajax.reload(null, false); 

				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("#"+index);

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);

						});
					} else {
						$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#uploadPhotosModal").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});
	}
	else {
		alert('error');
	}
}

function updatePricesModal(dimension_id = null) 
{
	if(dimension_id) {
		$('#power_table').find('tr').remove();
		$.ajax({
	      async: true,
	      type: 'post',
	      url: '../get_dimension_power',
	      data: {'id':dimension_id},
	       success: function(result){
	       		var count =0;
	          var obj=JSON.parse(result);
	          $('#power_table').append('<tr><th>Power</th><th>Price</th></tr>');
	          $.each(obj["power"], function (key, value) {
          		var new_row= '<tr><td><div class="form-group "><input type="number" class="required" value="'+value+'" name="power_'+count+'" readonly/></div></td>'
          					+'<td><div class="form-group "><input type="number" class="required" step=".01" value="'+obj["price"][key]+'" min="0" name="price_'+count+'" /></div></td></tr>';
				$('#power_table').append(new_row);
	             count++;
	          });
	          $('#power_table').append('<input type="hidden" name="power_count" value="'+count+'" >');
	       }
	      });

		$("#change_product_pricesForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		//var data = new FormData(document.getElementById("change_product_pricesForm"));
		$.ajax({
			url: form.attr('action') + '/' +  dimension_id ,
			type: form.attr('method'),
			data: form.serialize(), // /converting the form data into array and sending it to server
			//data:data,
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#updatePricesModal").modal('hide');

					// update the manageMemberTable
					manageMemberTable.ajax.reload(null, false); 

				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							var id = $("#"+index);

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);

						});
					} else {
						$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#updatePricesModal").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});
	}
	else {
		alert('error');
	}
}