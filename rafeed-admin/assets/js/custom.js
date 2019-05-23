function readURL(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .css('background-image','url('+ e.target.result+')');
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//LED Efficiency
function calcEfficiency(){
    var value=0;
    if($('#LedPower').val() !=0){
        value=$('#LedLumen').val()/$('#LedPower').val();
    }
    $('#LedEfficiency').val(value);
}

//fixture efficiency
function calcFixtureEfficiency(){
    var value=0;
    if($('#LuminaryPower').val() !=0){
        value=$('#TotalLumen').val()/$('#LuminaryPower').val();
    }
    $('#fixtureEfficiency').val(value)
}

function calcFixtureIP(){
    var ip=0;

    if($('input[name="IsExternal"]')[0].checked){
        ip=$('input[name="FittingIP"]').val();
    }
    else
    {
        ip=Math.min($('input[name="FittingIP"]').val(), $('input[name="DriverIP"]').val());
    }

    $('#FixtureIP').val(ip);
}

function calcFixtureIK(){
    var ik=0;
    
    ik=$('input[name="FittingIK"]').val();
    
    $('#FixtureIK').val(ik);
}

function calcFixtureLifeSpan(){
    var minValue=Math.min($('#DriverLifeSpan').find(":selected").text(),$('#LEDLifeSpan').find(":selected").text());
    $('input[name="fixtureLifeSpan"]').val(minValue);
}

function calcFixtureWarranty(){
     var minValue=Math.min($('#DriverWarranty').find(":selected").text(),$('#LEDWarranty').find(":selected").text());
    $('input[name="fixtureWarranty"]').val(minValue);
}

function reviewAllDataProduct(){
    $('#series_tab_table').append($('#table_series').html());
    $('#fitting_tab_table').append($('#table_fitting').html());
    $('#driver_tab_table').append($('#table_driver').html());
    $('#led_tab_table').append($('#table_led').html());
    $('#fixture_tab_table').append($('#table_fixture').html());
    $('#uploads_tab_table').append($('#table_upload').html());
}

//shared butween LED and fixture
function changeSymmetricBeam(val){
     if(val.checked) {
        $('.current_step #SymmetricDiv').css("display","grid");
        $('.current_step #AsymmetricDiv').css("display","none");
        }
    else{
       $('.current_step #SymmetricDiv').css("display","none");
        $('.current_step #AsymmetricDiv').css("display","grid");
    }
}
    //LED
    function changeLightSourceType(sel) 
    {
        var res =sel.options[sel.selectedIndex].text.toLowerCase();
        switch(res){
            case "module":
                $("#ModuleDiv").css("display","grid");
                $("#TubeDiv").css("display","none");
                $("#BulbDiv").css("display","none");
                $("#StripsDiv").css("display","none");
                break;
            case "tube":
                $("#TubeDiv").css("display","grid");
                $("#ModuleDiv").css("display","none");
                $("#BulbDiv").css("display","none");
                $("#StripsDiv").css("display","none");
                break;
            case "bulb":
                $("#BulbDiv").css("display","grid");
                $("#ModuleDiv").css("display","none");
                $("#TubeDiv").css("display","none");
                $("#StripsDiv").css("display","none");
                break;
            case "strips":
                $("#StripsDiv").css("display","grid");
                $("#ModuleDiv").css("display","none");
                $("#TubeDiv").css("display","none");
                $("#BulbDiv").css("display","none");
                break;  
        }
    }

    function changeColorTemperature(sel) 
    {
        var res =sel.options[sel.selectedIndex].text.toLowerCase();
        switch(res){
            case "tunable":
                $("#TunableDiv").css("display","grid");
                $("#NotTunableDiv").css("display","none");
                $("#RGBDiv").css("display","none");
                $("#RGBWDiv").css("display","none");
                break;
            case "not tunable":
                $("#TunableDiv").css("display","none");
                $("#NotTunableDiv").css("display","grid");
                $("#RGBDiv").css("display","none");
                $("#RGBWDiv").css("display","none");
                break;
            case "rgb":
                $("#TunableDiv").css("display","none");
                $("#NotTunableDiv").css("display","none");
                $("#RGBDiv").css("display","grid");
                $("#RGBWDiv").css("display","none");
                break;
            case "rgbw":
                $("#TunableDiv").css("display","none");
                $("#NotTunableDiv").css("display","none");
                $("#RGBDiv").css("display","grid");
                $("#RGBWDiv").css("display","grid");
                break;
        }
    }

    function changeCoolingRequired(val){
         if(val.checked) {
            $('#CoolingRequiredDiv').css("display","grid");
            }
        else{
           $('#CoolingRequiredDiv').css("display","none");
        }
    }

    //fitting 
    function changeProductType(sel) 
    {
        var res =sel.options[sel.selectedIndex].text.toLowerCase();
        if(res=="track light"){
            $("#ProductType_details").css("display","grid");
        }
        else
            $("#ProductType_details").css("display","none");

        //has subcategory
        $.ajax({
        async: false,
        type: 'post',
        url: '../indexes/Product_category/get_subcategory',
        data: {'id':sel.options[sel.selectedIndex].value},
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

    };


   function changeLightingSource(sel){
    var res =sel.options[sel.selectedIndex].text.toLowerCase();
        if(res=="socket"){
            $("#Socket").css("display","grid");
            $("#Pin").css("display","none");
        }
        else
            if(res=="pin"){
            $("#Socket").css("display","none");
            $("#Pin").css("display","grid");
        }
        else{
            $("#Socket").css("display","none");
            $("#Pin").css("display","none");
        }
   }

   //driver
   function changeDimmable(val){
         if(val.checked) {
            $('#DimmableType').css("display","grid");
        }
        else{
           $("#DimmableType").css("display","none"); 
        }
   }
   function changeflex(sel) 
    {
        var res =sel.options[sel.selectedIndex].text.toLowerCase();
        if(res=="flex"){
            $("#flex_details").css("display","grid");
        }
        else
            $("#flex_details").css("display","none");

   }

   function change_family(elm){ 
    //alert( "Handler for .change() called."+elm.value );
     $.ajax({
        async: false,
        type: 'post',
        url: '../Premium_product/family_exist',
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

   function change_driver_code(elm){
    $.ajax({
        async: false,
        type: 'post',
        url: '../Driver/get_driver_by_code',
        data: {'code':elm.value},
         success: function(result){ 
            var obj=JSON.parse(result);
            if(obj.length>0)
            {
                sweetAlert("Oops...", "this driver exist !!", "error");
                elm.value='';
            }
         }
     });
   }

   function change_led_code(elm){
    $.ajax({
        async: false,
        type: 'post',
        url: '../LED/get_LED_by_code',
        data: {'code':elm.value},
         success: function(result){ 
            var obj=JSON.parse(result);
            if(obj.length>0)
            {
                sweetAlert("Oops...", "this LED exist !!", "error");
                elm.value='';
            }
         }
     });
   }
   
function open_popup_search(type){
    if(type == 'Driver'){
        action='Driver/get_driver_by_code';
    }
    else
        if(type == 'LED')
            action='LED/get_LED_by_code'
    swal({
            title: "Enter driver code",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        },
        function(inputValue){
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }
             
            //swal("Hey !!", "You wrote: " + inputValue, "success");
             $.ajax({
                     type: 'post',
                     async: false,
                     url: '../'+action,
                     data: {'code':inputValue},
                     success: function(result){ 
                        var obj=JSON.parse(result);
                        if(obj.length==0)
                        {
                            sweetAlert("Oops...", "this "+type+" doesn't exist !!", "error");
                        }
                        else{
                            //info='<div class="table-responsive"><table class="table " id=""><tbody></table></div>';
                            theader='<thead><tr>';
                            tbody='<tbody><tr>';
                            obj_id=0;
                            $.each(obj, function (name, value) {
                                theader+='<th>'+name+'</th>';
                                tbody+='<td>'+value+'</td>';
                                obj_id= obj["ID"];
                            });
                            /*$.each(obj, function () {
                                $.each(this, function (name, value) {
                                    theader+='<th>'+name+'</th>';
                                    tbody+='<td>'+value+'</td>';
                                    //info+=name + '=' + value+ '<br>';
                               });
                                obj_id= this["ID"];
                            });*/
                            theader+='</tr></thead>';
                            tbody+='</tr></tbody>';

                            //swal("Hey !!", obj, "success");
                            swal({
                                title: "Driver information",
                                text: '<div class="table-responsive"><table class="table " id="">'+theader+tbody+'</table></div><br/><a href="#" id="select_and_go_next_step" onclick="select_object(\''+type+'\','+obj_id+')">select and go to next step</a>',
                                html: true,
                                showCancelButton: true,
                                showConfirmButton:false
                            });
                        
                        }
                        }   
                    });

        });
}

function select_object(type,id){ 
    if(type=='Driver')
    {
        $('#Driver_ID').val(id);
        swal("Hey !!", "success selected driver", "success");
    }
    else{
        $('#LED_ID').val(id);
        swal("Hey !!", "success selected LED", "success");
    }
}

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
                    refresh_datasource(index_type,has_languages);
                }

                }   
            });
            //form.submit();

            }
      );
}

function refresh_datasource(index_name,has_languages){
    //get data
    $.ajax({
        type: 'post',
        async: false,
        url: '../indexes/Indexes/get_index/'+index_name,
        data: {'has_languages':has_languages},
         success: function(result){
            $('[id='+index_name+']').empty();
            //$('#'+index_name).empty(); //remove all child nodes
            var obj=JSON.parse(result);
            $.each(obj, function () {
                var newOption = $('<option value="'+this["ID"]+'">'+this["Name"]+'</option>');
                 $('[id='+index_name+']').append(newOption);
                /*$("[id]").each(function(){ 

                    if($(this).attr("id")==index_name){
                        $(this).append(newOption);
                    }
                });*/
            });
            $('[id='+index_name+']').trigger("chosen:updated");
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

$(document).ready(function () {
    //@naresh action dynamic childs
    var nextMaterial = 1;
    var nextLightingDisturbation = 1;
    $("#AddNewMaterialRecord").click(function(e){ 
        $('#static_material_control #Texture').attr('disabled',true);
        $("#more_material_feild").append('<div class="question-details details-group" id="dynamic_control_"'+nextMaterial+'"">'+$("#static_material_control").html()+'</div>');
        $('#static_material_control #Texture').attr('disabled',false);
        //add_data_row();
       nextMaterial++;
    });

    $("#AddLightingDisturbationRecord").click(function(e){
        $("#more_lighting_disturbation_feild").append('<div class="question-details details-group" id="dynamic_control_"'+nextLightingDisturbation+'"">'+$("#static_lighting_disturbation_control").html()+'</div>');
        nextLightingDisturbation++;
    });

    //LED 
    $('#LedLumen, #LedPower').on('change', function() {
        calcEfficiency();
    }); 

    //fixture
    $('#TotalLumen , #LuminaryPower').on('change', function() {
        calcFixtureEfficiency();
    });

    /*$("input[name='ProductFamily']").change(function() {
      alert( "Handler for .change() called." );
    });*/
});