/*
$(document).ready(){function (argument) {
    //add popup nessassary files
    $("head").append('<script type="text/javascript" src="' + script + '"></script>');
}}*/



function open_popup(index_type,has_languages){
    var language_form=[];
    //get all language for add index for all language in system
    $.ajax({
        async: false,
        url: '../indexes/Language/get_language',
         success: function(result){
            var obj=JSON.parse(result);
            $.each(obj, function () {
               language_form.push({
                    name: "NameVal",
                    placeholder:"enter value in "+this["Name"],
                    required: true
                },
                {
                    name: "Language_Id",
                    value:this["ID"],
                    type:"hidden"
                }
                );
            });
         }
     });

    //show popup

    swal.withForm({
    title: 'Add index',
    text: 'This has different types of inputs',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Submit',
    closeOnConfirm: false,
    formFields: language_form
      },function(isConfirm){
        $.ajax({
             type: 'post',
             async: false,
             url: '../indexes/Indexes/set_value',
             data: {'index_name':index_type,
                    'index_value':this.swalForm.NameVal,
                    'Language_Ids':this.swalForm.Language_Id,
                    'has_languages':has_languages},
             success: function(result){
                if(result==0){
                    swal('Not inserted','This value is exist.',"error");
                    return false;
                }
                else{
                    swal("Hey !!", "You add new index.", "success");
                    //Mage::getSingleton("core/session")->addSuccess("Add success message"); 
                    refresh_datasource(index_type,has_languages,index_type);
                }

                }   
            });
            //form.submit();

            }
      );
}

function refresh_category() {
    changeProductType($('[name="ProductTypeID"]:checked').val());
}

function refresh_texture(name) {
   $.ajax({
        type: 'post',
        async: false,
        url: '../Fitting_color/get_fitting_texture/',
        data: {},
         success: function(result){
            $('[id='+name+']').empty();
            var obj=JSON.parse(result);
            $.each(obj, function () {
                var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
                 $('[id='+name+']').append(newOption);
                
            });
            $('[id='+name+']').trigger("chosen:updated");
            
         }
     }); 
}

function refresh_datasource(index_name,has_languages,elm_name){
    //get data
    $.ajax({
        type: 'post',
        async: false,
        url: '../indexes/Indexes/get_index/'+index_name,
        data: {'has_languages':has_languages},
         success: function(result){
            var selected_option = [];
            $.each($("[id="+elm_name+"] option:selected"), function(){            
                selected_option.push($(this).val());
            });
            $('[id='+elm_name+']').empty();
            //$('#'+index_name).empty(); //remove all child nodes
            var obj=JSON.parse(result);
            $.each(obj, function () {
                var selected="";
                if(selected_option.includes(this["ID"])){
                    selected='selected';
                }
                var newOption = $('<option value="'+this["ID"]+'" '+selected+'>'+this["Name"]+'</option>');
                 $('[id='+elm_name+']').append(newOption);
                /*$("[id]").each(function(){ 

                    if($(this).attr("id")==index_name){
                        $(this).append(newOption);
                    }
                });*/
            });
            $('[id='+elm_name+']').trigger("chosen:updated");
            /*$("[id]").each(function(){
                    if($(this).attr("id")==index_name){
                        if($(this).hasClass("chosen-select"))
                            $(this).trigger("chosen:updated");
                    }
                });*/
            //$('#'+index_name).trigger("chosen:updated");
         }
     });
    
}

function refresh_accessory_datasource(type,elm_name){ 
    //get data
    supplier=$('[name=Fitting_supplierID]').val();
    
    if (supplier==undefined || supplier=="") {
        supplier=0;
    }
        
    $.ajax({
        type: 'post',
        async: false,
        url: '../Accessory/get_accessory_by_type/'+type+'/'+supplier,
        data: {},
         success: function(result){
            $('[id='+elm_name+']').empty();
            //$('#'+index_name).empty(); //remove all child nodes
            var obj=JSON.parse(result);
            $.each(obj, function () {
                var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
                 $('[id='+elm_name+']').append(newOption);
            });
            $('[id='+elm_name+']').trigger("chosen:updated");
         }
     });
}

function refresh_fixture_datasource(type,elm_name){ 
    var option;
    if(type=="LED"){
        option=get_led_data();

    }
    else{
        option=get_driver_data();
    }
    
    $(elm_name).parent().find('select').empty();
    
    
    $(elm_name).parent().find('select').append(option);
    $(elm_name).parent().find('select').trigger("chosen:updated");
}

function open_category_addPopup(index_type,has_languages){ 
    var language_form=[];
    //get all language for add index for all language in system
    $.ajax({
        async: false,
        url: '../indexes/Language/get_language',
         success: function(result){
            var obj=JSON.parse(result);
            $.each(obj, function (index, value) {
               language_form.push({
                    name: "NameVal",
                    placeholder:"enter value in "+this["Name"],
                    required: true,
                    tabIndex: "1"

                },
                {
                    name: "Language_Id",
                    value:this["ID"],
                    type:"hidden"
                }
                );

            });
            language_form.push(
            {
                name:"Code_str",
                placeholder:"enter code character",
                required:true
            },
            {
                name:"Code_num",
                placeholder:"enter code number",
                required:true
            }
            );
         }
     });

    //show popup

    swal.withForm({
    title: 'Add index',
    text: 'This has different types of inputs',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Submit',
    closeOnConfirm: false,
    formFields: language_form
      },function(isConfirm){
        $.ajax({
             type: 'post',
             async: false,
             url: '../indexes/Indexes/set_value',
             data: {'index_name':index_type,
                    'index_value':this.swalForm.NameVal,
                    'Language_Ids':this.swalForm.Language_Id,
                    'has_languages':has_languages,
                    'product_type' : $('[name="ProductTypeID"]:checked').val(),
                    'Code_str' : this.swalForm.Code_str,
                    'Code_num' : this.swalForm.Code_num
                },
             success: function(result){
                if(result==0){
                    swal('Not inserted','This value is exist.',"error");
                    return false;
                }
                else{
                    swal("Hey !!", "You add new index.", "success");
                    //Mage::getSingleton("core/session")->addSuccess("Add success message"); 
                    //refresh_datasource(index_type,has_languages);
                }

                }   
            });
            //form.submit();

            }
      );
}

function open_popup_info(type,id){
    if(type == 'Driver'){
        action='Driver/get_driver_by_id';
        id=$(id).parent().find('select option:selected').val();
    }
    else
        if(type == 'LED'){
            action='LED/get_LED_by_id';
            id=$(id).parent().find('select option:selected').val();
        }

    if (id == "" || id== null) {
        swal.showInputError("You need to write something!");
        return false
    }
    $.ajax({
         type: 'post',
         async: false,
         url: '../'+action,
         data: {'id':id},
         success: function(result){
            var obj=JSON.parse(result);
            if(obj.length==0)
            {
                sweetAlert("Oops...", "this "+type+" doesn't exist !!", "error");
            }
            else{
                tbody='<tbody>';
                obj_id=0;
                $.each(obj, function (name, value) {
                    tbody+='<tr><th>'+name+'</th>';
                    tbody+='<td>'+value+'</td></tr>';
                    obj_id= obj["ID"];
                });
                
                tbody+='</tbody>';
                swal({
                    title: type+" Information",
                    text: '<div class="table-responsive" style="max-height: 350px;overflow: auto;"><table class="table " id="">'+tbody+'</table></div>',
                    html: true,
                    showCancelButton: false,
                    showConfirmButton:true
                });
            
                }
            }   
        });

}