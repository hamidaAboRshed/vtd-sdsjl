// global variable
var manageAccessoryMemberTable;
$(document).ready(function() {
	manageAccessoryMemberTable = $("#AccessoryManageMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
        ],
		'ajax': '../Accessory/fetchMemberData',
		'order': []
	});	
});

$('#status').change(function(){
	var e = document.getElementById("status");
	var strUser = e.options[e.selectedIndex].text;
	var table = $('#AccessoryManageMemberTable').DataTable();

	table.search(strUser).draw();
    } );

$('#trigger').click(function () {
	$('#addAccessoryMadal').modal({show : true});
});
function addAccessoryMemberModel() 
{
	$("#createAccessoryForm")[0].reset();
	$("#accessory_product_photo").css("background-image","url('../../assets/images/4.jpg')");
	$("#series1").prop('checked',true);
	$('#accessory_supplier').trigger("chosen:updated");

	//remove textdanger
	$(".text-danger").remove();
	// remove form-group
	$(".form-group").removeClass('has-error').removeClass('has-success');

	$("#createAccessoryForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			//data: form.serialize(), // /converting the form data into array and sending it to server
			data:new FormData(this),
            processData:false,
            contentType:false,
            cache:false,
            async:false,
			dataType: 'json',
			success:function(response) { 
				if(response.success === true) {
					$(".accessory-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#addAccessoryMadal").modal('hide');

					// update the manageMemberTable
					manageAccessoryMemberTable.ajax.reload(null, false); 

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
						$(".accessory-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#addAccessoryMadal").modal('hide');
						// update the manageMemberTable
						manageAccessoryMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});

}

function copyAccessoryMember(id = null) 
{
	if(id) {

		$("#createAccessoryForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: '../Accessory/getSelectedMemberInfo/'+id,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				
				$("#AccessoryCode").val(response.SupplierCode);

				//$("#accessory_product_photo").css("background-image","url('../../assets/images/"+response.Photo+"')");

				$("#AccessoryType").val(response.Type);
				var id_=0;
				$('[name="accessory_description[]"]').each(function(){
					$(this).val(response[id_]);
					id_++;
				});
				
				$("#series"+response.Series_id).prop('checked',true);

				$("#accessory_supplier").val(response.SupplierID);
				$("#accessory_supplier").trigger("chosen:updated");	
				
				$('#price').val(response.price);

				$("#createAccessoryForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') ,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
								$(".accessory-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#addAccessoryMadal").modal('hide');

								// update the manageMemberTable
								manageAccessoryMemberTable.ajax.reload(null, false); 

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
									$(".accessory-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>');
									// hide the modal
									$("#addAccessoryMadal").modal('hide');
								}
							}
						} // /succes
					}); // /ajax

					return false;
				});
				
			}
		});
	}
	else {
		alert('error');
	}
}

function editAccessoryMember(id = null) 
{
	if(id) {

		$("#editAccessoryForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: '../Accessory/getSelectedMemberInfo/'+id,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				
				$("#editAccessoryCode").val(response.SupplierCode);

				//$("#accessory_product_photo").css("background-image","url('../../assets/images/"+response.Photo+"')");

				$("#editAccessoryType").val(response.Type);
				var id_=0;
				$('[name="editAccessory_description[]"]').each(function(){
					$(this).val(response[id_]);
					id_++;
				});
				
				$("#edit_series"+response.Series_id).prop('checked',true);

				$("#editAccessory_supplier").val(response.SupplierID);	
				$("#editAccessory_supplier").trigger("chosen:updated");	
				
				$('#editprice').val(response.price);			

				$("#editAccessoryForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' + id,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
								$(".accessory-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#editAccessoryMemberModal").modal('hide');

								// update the manageMemberTable
								manageAccessoryMemberTable.ajax.reload(null, false); 

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
									$(".accessory-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>');
									// hide the modal
									$("#editAccessoryMemberModal").modal('hide');
								}
							}
						} // /succes
					}); // /ajax

					return false;
				});
				
			}
		});
	}
	else {
		alert('error');
	}
}

function changeImageAccessoryMember(id = null) 
{
	if(id) {

		$("#changeAccessoryImageForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#changeAccessoryImageForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("changeAccessoryImageForm"));
		$.ajax({
			url: form.attr('action') + '/' + id,
			type: form.attr('method'),
			//data: form.serialize(), // /converting the form data into array and sending it to server
			data:data,
			async: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					$(".accessory-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#changeImageMemberModal").modal('hide');

					// update the manageMemberTable
					manageAccessoryMemberTable.ajax.reload(null, false); 

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
						$(".accessory-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#changeImageMemberModal").modal('hide');
						// update the manageMemberTable
						manageAccessoryMemberTable.ajax.reload(null, false); 
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


function removeMember(id = null) 
{

	if(id) {
		$("#removeMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: 'remove' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".accessory-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#removeMemberModal").modal('hide');

						// update the manageMemberTable
						manageAccessoryMemberTable.ajax.reload(null, false); 
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
							$(".accessory-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
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