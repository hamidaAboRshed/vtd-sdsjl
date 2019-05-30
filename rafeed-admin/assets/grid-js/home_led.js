// global variable
var manageMemberTable;
$(document).ready(function() {
	manageMemberTable = $("#manageMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
        ],
		'ajax': '../led/fetchMemberData',
		'order': []
	});	
});

$('#status').change(function(){
	var e = document.getElementById("status");
	var strUser = e.options[e.selectedIndex].text;
	var table = $('#manageMemberTable').DataTable();

	table.search(strUser).draw();
    } );
$('#trigger').click(function () { 
	$('#addLED').modal({show : true});
});
function addMemberModel() 
{
	$("#createForm")[0].reset();

	//remove textdanger
	$(".text-danger").remove();
	// remove form-group
	$(".form-group").removeClass('has-error').removeClass('has-success');

	$("#createForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();

		$.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: form.serialize(), // /converting the form data into array and sending it to server
			dataType: 'json',
			success:function(response) { 
				if(response.success === true) {
					$(".led-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					'</div>');

					// hide the modal
					$("#addLED").modal('hide');

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
						$(".led-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#addLED").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});

}


function editMember(id = null) 
{
	if(id) {

		$("#editForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: '../led/getSelectedMemberInfo/'+id,
			type: 'post',
			dataType: 'json',
			success:function(response) {
				$("#editLightSourceTypeID").val(response.LightSourceTypeID);
				 
				switch(response.LightSourceTypeID){
					case "1":
						$("#editled_type").val(response.Type);
						break;
					case "2":
						$("#editLED_pin_type").val(response.Type);
						break;
					case "3":
						$("#editLED_socket_type").val(response.Type);
						break;
					default:
						$("#editLED_strips_m").val(response.Type);
						break;

					}
				changeLightSourceType($("#editLightSourceTypeID")[0],true);

				$("#editLEDCode").val(response.Code);

				$("#editLEDCodeOldVal").val(response.Code);
				
				$("#editLEDOriginCountryID").val(response.OriginCountryID);				

				$("#editLEDSupplierID").val(response.SupplierID);	

				$("#editForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' + id,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
								$(".led-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#editMemberModal").modal('hide');

								// update the manageMemberTable
								manageMemberTable.ajax.reload(null, false); 

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
									$(".led-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>');
									// hide the modal
									$("#addMember").modal('hide');
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

function uploadLEDDatasheet(id = null) 
{
	if(id) {

		$("#uploadLEDDatasheetForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#uploadLEDDatasheetForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("uploadLEDDatasheetForm"));
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
					$(".led-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#uploadLEDDatasheetModal").modal('hide');

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
						$(".led-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#uploadLEDDatasheetModal").modal('hide');
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
						$(".led-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#removeMemberModal").modal('hide');

						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
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
							$(".led-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
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