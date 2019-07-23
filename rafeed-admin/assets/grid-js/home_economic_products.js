// global variable
var manageMemberTable;
$(document).ready(function() {
	manageMemberTable = $("#PremiumProductMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		'ajax': './Premium_product/fetchMemberData/-2',
		'order': []
	});	
});

function addEconomicProduct(){
		$("#add_productForm")[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		$("#add_productForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("add_productForm"));
		$.ajax({
			url: form.attr('action') ,
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
					$("#addEconomicProductModal").modal('hide');

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
						$("#addEconomicProductModal").modal('hide');
						// update the manageMemberTable
						manageMemberTable.ajax.reload(null, false); 
					}
				}
			}
		});	

		return false;
	});
}

function deleteEconomicProduct(id = null) 
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

function changeProductType(val) 
  {
      //var res =sel.options[sel.selectedIndex].text.toLowerCase();
      
      //has subcategory
      $.ajax({
      async: false,
      type: 'post',
      url: '../indexes/Product_category/get_subcategory',
      data: {'id':val},
       success: function(result){

          $('#product_cat').empty(); //remove all child nodes
          var obj=JSON.parse(result);
          $.each(obj, function () {
              var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
             $('#product_cat').append(newOption);
          });
          $('#product_cat').trigger("chosen:updated");
          
       }
      });

      /*if(res=="outdoor"){
        $('#AsymmetricDiv').css("display","");
        $('#SymmetricDiv').css("display","none");
      }
      else{
        $('#SymmetricDiv').css("display","");
        $('#AsymmetricDiv').css("display","none");
      }*/

  }

  function change_family(elm){
    //alert( "Handler for .change() called."+elm.value );
     $.ajax({
        async: false,
        type: 'post',
        url: '../Economic_product/family_exist',
        data: {'Family_name':elm.value},
         success: function(result){
            if(result=='true')
            {
                sweetAlert("Oops...", "this family exist !!", "error");
                elm.value='';
            }
         }
     });
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

function updateApplicationPhoto(product_id = null) 
{
	if(product_id) {
		$('#power_table').find('tr').remove();
		$.ajax({
	      async: true,
	      type: 'post',
	      url: '../Premium_product/get_product_installation_way',
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
		$('.text-danger').remove();

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
						$("#uploadApplicationPhotosModal").modal('hide');
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

function checkEconomicProduct(id = null) 
{
	if(id) {
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('#error_msg').html("");
		$("#checkMemberBtn").unbind('click').bind('click', function() {
			$.ajax({
				url: './set_economic_product_collection_code' + '/' + id,
				type: 'post',				
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#checkEconomicProductModal").modal('hide');

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

function changeACProductFunction(sel){
  //var res =sel.options[sel.selectedIndex].text.toLowerCase();
  var res =sel.labels[0].textContent.toLowerCase();
      if($.trim(res)=="bulb"){
          $("#Socket").css("display","grid");
          $("#Pin").css("display","none");
          $("#TubeModel").css("display","none");
      }
      else
          if($.trim(res)=="normal tube" || $.trim(res)=="integrated tube"){
          $("#Socket").css("display","none");
          $("#Pin").css("display","none");
          $("#TubeModel").css("display","grid");
        }
        else
          if ($.trim(res)=="spotlight") {
            $("#Socket").css("display","none");
            $("#Pin").css("display","grid");
            $("#TubeModel").css("display","none");
          }
          else{
            $("#Socket").css("display","none");
            $("#Pin").css("display","none");
            $("#TubeModel").css("display","none");
          }
}

function changeLightSourceType(sel) 
{
  var res =sel.labels[0].textContent.toLowerCase();
  if(res== "led")
      	$("#led_type_div").removeClass("hide");
    else
  		$("#led_type_div").addClass("hide");
  
}

function changeProductPowerType(sel) {
	var res =sel.labels[0].textContent.toLowerCase();
  	if(res== "ac")
      	$("#AC_row").removeClass("hide");
    else
  		$("#AC_row").addClass("hide");
}