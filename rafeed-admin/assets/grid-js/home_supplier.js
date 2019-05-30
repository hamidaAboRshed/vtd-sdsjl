function delete_supplier_contact(id = null) 
 {
    if(id)
    {

      $("#DeleteForm")[0].reset();
      $('.form-group').removeClass('has-error').removeClass('has-success');
      $('.text-danger').remove();

      $("#DeleteForm").unbind('submit').bind('submit', function()
      {
          var form = $(this);

          // remove the text-danger
          $(".text-danger").remove();
          
          $.ajax({
            url: form.attr('action') + '/' + id,
            type: form.attr('method'),
            dataType: 'json',
          
            success:function(response)
            {
                    if(response.success === true) {
                  $(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                  '</div>');

                  // hide the modal
                  $("#delete_supplier_con_Modal").modal('hide');

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
                    $(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                      '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                      '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                    '</div>');
                  }
                }
            }

          }); 

          return false;
      });
    }
    else 
    {
      alert('error');
    }
}


//empty contact 
  function delete_con(ele)
  { 
     
    $(ele).slideUp(300,function() {
      $(ele).remove();
    });

  }

//delete from database

  function delete_exists_con(ele,id)
  {
    
    $.ajax({
      url: '../../delete_supplier_contact_details/' + id,
      dataType: 'json',
      //data: form.serialize(), // /converting the form data into array and sending it to server
    
      success:function(response) 
      {
          if(response.success === true) 
          {
            $(ele).slideUp(300,function() {
              $(ele).remove();
           });
          } 

          else 
          {
            alert(response.messages);
          }
      
      } 

  
    });

  }