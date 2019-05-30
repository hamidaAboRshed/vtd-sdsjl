
$(document).ready(function() {
	addEconomicProductCollection();
});

function addEconomicProductCollection(){

		$("#create_productCollectionForm").unbind('submit').bind('submit', function() {
		var form = $(this);

		// remove the text-danger
		$(".text-danger").remove();
		var data = new FormData(document.getElementById("create_productCollectionForm"));
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
					 window.location = response.url;	

				} else {
					if(response.messages instanceof Object) {
						$.each(response.messages, function(index, value) {
							/*var id = $("#"+index);

							id
							.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.after(value);*/
							if (value.length > 0) 
							{
								$('#validation_msg').append('<p class="has-error">'+value+'</p>')
							}

						});
					} else {
					}
				}
			}
		});	

		return false;
	});
}

function change_code(elm){
    //alert( "Handler for .change() called."+elm.value );
     $.ajax({
        async: false,
        type: 'post',
        url: '../Economic_product/code_exist',
        data: {'code':elm.value},
         success: function(result){
            if(result=='true')
            {
                sweetAlert("Oops...", "this product code exist !!", "error");
                elm.value='';
            }
         }
     });
   }