// global variable
var manageDriverMemberTable;
$(document).ready(function() {
	manageDriverMemberTable = $("#driverManageMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
        ],
		'ajax': './fetchMemberData',
		'order': []
	});	
});

$('#status').change(function(){
	var e = document.getElementById("status");
	var strUser = e.options[e.selectedIndex].text;
	var table = $('#driverManageMemberTable').DataTable();

	table.search(strUser).draw();
    } );

$('#trigger').click(function () {
	$('#addDriverMadal').modal({show : true});
});
function addDriverMemberModel() 
{
	$("#createDriverForm")[0].reset();
	$('input:radio[name="OutputType"]')[0].checked = true;

	//remove textdanger
	$(".text-danger").remove();
	// remove form-group
	$(".form-group").removeClass('has-error').removeClass('has-success');

	$("#createDriverForm").unbind('submit').bind('submit', function() {
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
					$(".driver-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#addDriverMadal").modal('hide');

					// update the manageMemberTable
					manageDriverMemberTable.ajax.reload(null, false); 

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
						$(".driver-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#addDriverMadal").modal('hide');
						// update the manageMemberTable
						manageDriverMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});

}


function editDriverMember(id = null) 
{
	if(id) {

		$("#editDriverForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$.ajax({
			url: '../driver/getSelectedMemberInfo/'+id,
			type: 'post',
			dataType: 'json',
			success:function(response) {

				$("#editPowerMethod"+response.power_method).prop('checked',true);

				$("#editVoltageTypeID"+response.voltage_type_id).prop('checked',true);

				$("#editDimmable").val(response.Dimmable).trigger("chosen:updated");

				$("#editCodeOldVal").val(response.Code);

				$("#editCode").val(response.Code);

				$("#editPower").val(response.Power);

				$("#editFrequency").val(response.frequency);				

				$("#editOutputCurrentMin").val(response.OutputCurrentMin);	

				$("#editOutputCurrentMax").val(response.OutputCurrentMax);	

				$("#editInputVoltageMin").val(response.InputVoltageMin);

				$("#editInputVoltageMax").val(response.InputVoltageMax);

				$("#editOutputVoltageMin").val(response.OutputVoltageMin);

				$("#editOutputVoltageMax").val(response.OutputVoltageMax);					

				$("#editOutputType"+response.OutputType).prop('checked',true);

				$("#editPowerFactor").val(response.PowerFactor);

				$("#editIPRate").val(response.IPRate);

				$("#editOriginCountryID").val(response.OriginCountryID);				

				$("#editSupplierID").val(response.SupplierID);	

				$("#editLength").val(response.length);	

				$("#editWidth").val(response.width);	

				$("#editHeight").val(response.height);	

				$("#editDriverForm").unbind('submit').bind('submit', function() {
					
					var form = $(this);

					$.ajax({
						url: form.attr('action') + '/' + id,
						type: 'post',
						data: form.serialize(),
						dataType: 'json',
						success:function(response) {
							if(response.success === true) {
								$(".driver-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
								'</div>');

								// hide the modal
								$("#editDriverMemberModal").modal('hide');

								// update the manageMemberTable
								manageDriverMemberTable.ajax.reload(null, false); 

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
									$(".driver-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
									'</div>');
									// hide the modal
									$("#editDriverMemberModal").modal('hide');
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


function uploadDriverDatasheet(id = null) 
{
	if(id) {

		$("#uploadDriverDatasheetForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#uploadDriverDatasheetForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("uploadDriverDatasheetForm"));
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
					$(".driver-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
					  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
					  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
					  '</div>');

					// hide the modal
					$("#uploadDriverDatasheetModal").modal('hide');

					// update the manageMemberTable
					manageDriverMemberTable.ajax.reload(null, false); 

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
						$(".driver-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
						'</div>');
						// hide the modal
						$("#uploadDriverDatasheetModal").modal('hide');
						// update the manageMemberTable
						manageDriverMemberTable.ajax.reload(null, false); 
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
						$(".driver-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#removeMemberModal").modal('hide');

						// update the manageMemberTable
						manageDriverMemberTable.ajax.reload(null, false); 
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
							$(".driver-messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
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