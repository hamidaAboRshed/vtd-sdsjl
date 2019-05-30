// global variable
var manageAccessoryMemberTable;
$(document).ready(function() {
	managePremiumProductMemberTable = $("#PremiumProductMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		'ajax': './Premium_product/fetchMemberData/-2',
		'order': []
	});	
});

function deletePremiumProduct(id = null) 
{

	if(id) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: './Premium_product/delete_premium_product' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#deletePremiumProductModal").modal('hide');

						// update the manageMemberTable
						managePremiumProductMemberTable.ajax.reload(null, false); 
					} else {
						$('.text-danger').remove()
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
						}
					}
				} // /succes
			}); // /ajax
		});
	}
}

function checkPremiumProduct(id = null) 
{
	if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('#error_msg').html("");
		$("#checkMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: './Premium_product/set_premium_product_collection_code' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#checkPremiumProductModal").modal('hide');

						// update the manageMemberTable
						managePremiumProductMemberTable.ajax.reload(null, false); 
					} else {
						$('.text-danger').remove()
						if(response.messages instanceof Object) {
							$.each(response.messages, function(index, value) {
								var id = $("#"+index);

								id
								.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')										
								.html(value);										

							});
						} else {
							$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
							'</div>');
						}
					}
				} // /succes
			}); // /ajax
		});
	}
}

function upload_photos(product_id = null) 
{
	if(product_id) {

		$("#change_product_photoForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#change_product_photoForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("change_product_photoForm"));
		$.ajax({
			url: form.attr('action') + '/' + product_id ,
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
					managePremiumProductMemberTable.ajax.reload(null, false); 

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
						managePremiumProductMemberTable.ajax.reload(null, false); 
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

function updateApplicationPhoto(product_id = null) 
{
	if(product_id) {
		$('#power_table').find('tr').remove();
		$.ajax({
	      async: true,
	      type: 'post',
	      url: './Premium_product/get_product_installation_way',
	      data: {'id':product_id},
	       success: function(result){
	       	var html='';
          	var obj=JSON.parse(result);
	          $.each(obj, function (key, value) {
	      		html+= '<option value='+this['ID']+'>'+this['Name']+'</option>';
	          });

	       	$('#Installation_way_id')
			    .empty()
			    .append(html);
	       }
	      });

		$("#change_application_photoForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		

		$("#change_application_photoForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("change_application_photoForm"));
		$.ajax({
			url: form.attr('action') + '/' + product_id ,
			type: form.attr('method'),
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
					$("#uploadApplicationPhotosModal").modal('hide');

					// update the manageMemberTable
					managePremiumProductMemberTable.ajax.reload(null, false); 

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
						$("#uploadApplicationPhotosModal").modal('hide');
						// update the manageMemberTable
						managePremiumProductMemberTable.ajax.reload(null, false); 
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

function family_filter(element,id = 0) {
	if ( $.fn.dataTable.isDataTable('#PremiumProductMemberTable') ) {
	    managePremiumProductMemberTable.destroy();
	    //$('#PremiumProductMemberTable').empty(); 
  	}
	managePremiumProductMemberTable = $("#PremiumProductMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		'ajax': './Premium_product/fetchMemberData/'+id,
		'order': []
	});	
}