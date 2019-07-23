function changeIPType(elm){
    if(elm.checked) {
        $(elm).parent().parent().parent().parent().find('#s_ip').addClass('hide');
        $(elm).parent().parent().parent().parent().find('#m_ip').removeClass('hide');
        $(elm).parent().find("[name='IP_check[]']").val(1)
    }
    else{
        $(elm).parent().parent().parent().parent().find('#s_ip').removeClass('hide');
        $(elm).parent().parent().parent().parent().find('#m_ip').addClass('hide');
        $(elm).parent().find("[name='IP_check[]']").val(0)
    }
}

function changeAdjustableType(sel){
    var res =sel.labels[0].textContent.toLowerCase();
    switch($.trim(res))
    {
      case "tilted" : 
                $("#tilted_adjustable_values").css("display","");
                $("#rotated_adjustable_values").css("display","none");
                $("input[name='form_Adjustable']").attr("value",1);
                break;
              
      case "rotated" :
                $("#rotated_adjustable_values").css("display","");
                $("#tilted_adjustable_values").css("display","none");
                $("input[name='form_Adjustable']").attr("value",2);
                break;
      case "tilted & rotated" : 
                $("#rotated_adjustable_values").css("display","");
                $("#tilted_adjustable_values").css("display","");
                $("input[name='form_Adjustable']").attr("value",3);
                break;
      default :
                $("#rotated_adjustable_values").css("display","none");
                $("#tilted_adjustable_values").css("display","none");
                $("input[name='form_Adjustable']").attr("value",0);
                break;
    }
}

function changeShape(sel){
  var res =sel.options[sel.selectedIndex].text.toLowerCase();
  if(res=="round")
  {
    $("#dim_width").css("display","none");
    $("#dim_length").css("display","none");
    $("#dim_diameter").css("display","");
  }
  else{
    $("#dim_width").css("display","");
    $("#dim_length").css("display","");
    $("#dim_diameter").css("display","none");
  }
}

function changePublicAccessory(val) {
  if(val.checked) {
    $('#PublicFittingAccessory').prop("disabled",false).trigger("chosen:updated");
  }
  else{
    $('#PublicFittingAccessory').prop("disabled",true).trigger("chosen:updated");
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
}

function changeIsnull(val,field_id){
  if(val.checked) {
    $('#'+field_id).prop('disabled', true).trigger("chosen:updated");
  }else{
    $('#'+field_id).prop('disabled', false).trigger("chosen:updated");
  }
}

function changeSymmetricBeam(val){
     if(val.checked) {
       $('#SymmetricDiv').css("display","");
        $('#AsymmetricDiv').css("display","none");
        }
    else{
        $('#AsymmetricDiv').css("display","");
        $('#SymmetricDiv').css("display","none");
    }
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

  /* function changeCategory(sel) {
  var res =sel.options[sel.selectedIndex].text.toLowerCase();
  if(res=="track light"){
      $("#ProductType_details").css("display","");
  }
  else
      $("#ProductType_details").css("display","none");

}*/

function changeLightingSource(sel){
  //var res =sel.options[sel.selectedIndex].text.toLowerCase();
  var res =sel.labels[0].textContent.toLowerCase();
      if($.trim(res)=="socket"){
          $("#Socket").css("display","grid");
          $("#Pin").css("display","none");
      }
      else
          if($.trim(res)=="pin"){
          $("#Socket").css("display","none");
          $("#Pin").css("display","grid");
      }
      else{
          $("#Socket").css("display","none");
          $("#Pin").css("display","none");
      }
}



function addIESfiles(elm) {
  var current_count=$('#IES_files').find('input').length;
  var files_count=elm.value-current_count;
  
  if(files_count>0){
    //add driver
    while(current_count != elm.value)
    {
      current_count++;  
      $('#IES_files').append('<input type="file" class="custom-file-input" id="validatedCustomFile" name="form_photo">');
    }
  }
  else{
    //remove driver
    while(current_count != elm.value)
    {
      current_count--;  
      $('#IES_files').find('input:last').remove();
    }
  }
}

var lightingdistribution_count=1;
var installationway_count=1;
var color_count=2;

function add_color(colorseries_id) {
  
    var html_code = "<tr id='row"+color_count+"'>";
    html_code += "<td><div class='form-group'><select data-placeholder='Select' class='form-control-sm chosen-select required' id='fitting_part"+color_count+"' name='PlaceID[]'></select>"
              +"<a class='btn btn-default btn sweet-prompt' onclick='open_popup(\"fitting_part\",1);''><i class='fa fa-plus'></i></a>"
              +'<a class="btn btn-default btn" onclick="refresh_datasource(\'fitting_part\',1,\'fitting_part'+color_count+'\');"><i class="fa fa-refresh"></i></a></div></td>';
    html_code += "<td><select data-placeholder='Select' class='form-control-sm chosen-select required' id='texture"+color_count+"' name='TextureID[]'></select>"
              +'<a class="btn btn-default btn" onclick="refresh_texture(\'texture'+color_count+'\');"><i class="fa fa-refresh"></i></a></td>';
    html_code += "<td><button type='button' name='remove' data-row='row"+color_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
    html_code += "</tr>";  
    $('#colorSeries_table').append(html_code);
    $('#form_fitting_part').find('option').clone().appendTo('#fitting_part'+color_count);
    $('#form_texture').find('option').clone().appendTo('#texture'+color_count);
    $('#fitting_part'+color_count).trigger("chosen:updated");
    $('#texture'+color_count).trigger("chosen:updated");

    $('#fitting_part'+color_count).chosen({ width: '220' });
    $('#texture'+color_count).chosen({ width: '220' });
    color_count++;
}

function add_lightingdistributor(lightingdistributorseries_id) {

    var html_code = "<tr id='row"+lightingdistribution_count+"'>";
    html_code += "<td><div class='form-group'><select data-placeholder='Select' class='form-control-sm  chosen-select required' id='lighting_distribution_kind"+lightingdistribution_count+"' name='LightingDistributionKindID[]'></select>"
              +"<a class='btn btn-default btn sweet-prompt' onclick='open_popup(\"lighting_distribution_kind\",1);'><i class='fa fa-plus'></i></a>"
              +'<a class="btn btn-default btn" onclick="refresh_datasource(\'lighting_distribution_kind\',1,\'lighting_distribution_kind'+lightingdistribution_count+'\');"><i class="fa fa-refresh"></i></a></div></td>';
    html_code += "<td><select data-placeholder='Select' class='form-control-sm  chosen-select required' id='lighting_distribution_texture"+lightingdistribution_count+"' name='LightingDisturbationTextureID[]'></select>"
              +'<a class="btn btn-default btn" onclick="refresh_texture(\'lighting_distribution_texture'+lightingdistribution_count+'\');"><i class="fa fa-refresh"></i></a>';
    html_code += "<td><button type='button' name='remove' data-row='row"+lightingdistribution_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
    html_code += "</tr>";  
    //$('#lightingdistribution_table').append(html_code);
    $('#lightingDistributorSeries_table').append(html_code);
    $('#form_lighting_distribution_kind').find('option').clone().appendTo('#lighting_distribution_kind'+lightingdistribution_count);
    $('#form_lighting_distribution_texture').find('option').clone().appendTo('#lighting_distribution_texture'+lightingdistribution_count);

    $('#lighting_distribution_texture'+lightingdistribution_count).chosen({ width: '220' });
    $('#lighting_distribution_kind'+lightingdistribution_count).chosen({ width: '220' });

    lightingdistribution_count++;
    
}

function get_driver_data() {
  var options='';
  $.ajax({
        type: 'post',
        async: false,
        url: '../Driver/get_drivers/',
        data: {},
         success: function(result){
            var obj=JSON.parse(result);
            $.each(obj, function () {
                options += '<option value="'+this["ID"]+'">'+this["code"]+'</option>';
            });
         }
     });
  return options;
}

function get_led_data() {
  var options='';
  $.ajax({
        type: 'post',
        async: false,
        url: '../LED/get_leds/',
        data: {},
         success: function(result){
            var obj=JSON.parse(result);
            $.each(obj, function () {
                options += '<option value="'+this["ID"]+'" data-id="'+this["LED_ID"]+'">'+this["Code"]+'</option>';
            });
         }
     });
  return options;
}

function add_new_series(type){
  if (type=='color') 
  {
    $('#edit_economic_color').empty();
    $('#add_economic_color').removeClass('hide');
  }
  else
  {
    $('#edit_economic_lighting_distribution').empty();
    $('#add_economic_lighting_distribution').removeClass('hide');
  }
}

$(document).ready(function(){
  if($('#economic_product_collection_id').val()!=0){
    //ajax call with collection data
    $.ajax({
        type: 'post',
        async: false,
        url: './getSelectedCollectionInfo/'+$('#economic_product_collection_id').val(),
        data: {},
         success: function(result){
            var obj=JSON.parse(result);
            $('[name=shape]').val(obj[0]["FittingShapeID"]);
            //$('[name=AdjustableType]').val(obj[0]["AdjustableType"]);
            $("#form_AdjustableType"+obj[0]["AdjustableType"]).prop("checked", true);
            $('[name=diameter]').val(obj[0]["Radius"]);
            $('[name=width]').val(obj[0]["Width"]);
            $('[name=length]').val(obj[0]["Length"]);
            $('[name=height]').val(obj[0]["Height"]);
            $('[name=cut_out]').val(obj[0]["Cut_out"]);

            $('[name=THMin]').val(obj[0]["TiltedHMin"]);
            $('[name=THMax]').val(obj[0]["TiltedHMax"]);
            $('[name=TVMin]').val(obj[0]["TiltedVMin"]);
            $('[name=TVMax]').val(obj[0]["TiltedVMax"]);
            $('[name=RHMin]').val(obj[0]["RotatedHMin"]);
            $('[name=RHMax]').val(obj[0]["RotatedHMax"]);
            $('[name=RVMin]').val(obj[0]["RotatedVMin"]);
            $('[name=RVMax]').val(obj[0]["RotatedVMax"]);

            $('[name=Weight]').val(obj[0]["Weight"]);
            $('[name=IP_check_checkbox]').val(obj[0]["Multiple_ip"]);
            $('[name=FittingSingleIP]').val(obj[0]["IP"]);
            $('[name=FittingBackIP]').val(obj[0]["Back_ip"]);
            $('[name=FittingFrontIP]').val(obj[0]["Front_ip"]);
            $('[name=FittingIK]').val(obj[0]["IK"]);
            $('[name=SymmetricBeam]').val(obj[0]["SymmetricBeam"]);
            $('[name=BeamAngleValue]').val(obj[0]["BeamAngleValue"]);
            $('[name=BeamAngleH]').val(obj[0]["BeamAngleH"]);
            $('[name=BeamAngleV]').val(obj[0]["BeamAngleV"]);
            $('[name=UGRRate]').val(obj[0]["UGRRate"]);

            $('[name=LuminaryPowerUp]').val(obj[0]["Power_up"]);
            $('[name=LuminaryPowerDown]').val(obj[0]["Power"]);
            $('#VoltageTypeID'+obj[0]["voltage_type_id"]).prop("checked", true);
            $('[name=InputVoltageMin]').val(obj[0]["InputVoltageMin"]);
            $('[name=InputVoltageMax]').val(obj[0]["InputVoltageMax"]);
            $('[name=LuminaryCurrent]').val(obj[0]["Current"]);
            $('[name=frequency]').val(obj[0]["frequency"]);
            $('[name=LuminaryLumen]').val(obj[0]["Lumen"]);
            $('[name=CCT]').val(obj[0]["CCT"]);
            $('[name=CRI]').val(obj[0]["CRI"]);
            $('[name=PCB_description]').val(obj[0]["PCB_description"]);
            $('[name=Fitting_supplierID]').val(obj[0]["supplier_id"]);
            $('[name=Warranty]').val(obj[0]["warranty"]);
            $('[name=LifeSpan]').val(obj[0]["lifespan"]);
            
            $('[name=driver]').val(obj[0]["driver_id"]);
            $('[name=led]').val(obj[0]["Led_id"]);
            $('[name=power_factor]').val(obj[0]["PowerFactor"]);
            $('[name=price]').val(obj[0]["price"]);

            $('.chosen-select').trigger("chosen:updated");
            var url= obj[0]['base_url'];
            var lighting_distribution_data='<a type="button" data-toggle="modal" onclick="add_new_series(\'lighting_distribution\')">add another lighting distributor</a><br/>'+
                  '<input type="hide" class="hide" name="lighting_distributor_series_id" value="'+obj[0]["lighting_distributor_series_id"]+'">';
            
            $.each(obj[0]["lighting_distribution"], function () {
                lighting_distribution_data += 'kind : '+this["kind"]+', color : '+this["color"]+' - '+this["material"]+
                '<img hight=30 width=30 src="'+url+'/upload_files/Texture/'+this['Texture_photo']+'" />';
            });
            var color_data='<a type="button" data-toggle="modal" onclick="add_new_series(\'color\')">add another color series</a><br/>'+
                '<input type="hide" class="hide" name="Fitting_color_series_id" value="'+obj[0]["Fitting_color_series_id"]+'">';
            $.each(obj[0]["color"], function () {
                color_data += 'Part : '+this["part"]+', color : '+this["color"]+' - '+this["material"]+
                '<img hight=30 width=30 src="'+url+'/upload_files/Texture/'+this['Texture_photo']+'" /><br/>';
            });

            $('#edit_economic_color').html(color_data);
            $('#edit_economic_lighting_distribution').html(lighting_distribution_data);

            $('#add_economic_color').addClass('hide');
            $('#add_economic_lighting_distribution').addClass('hide');

            //add images
            if ($('#is_edit').val()=='1') {

              $('[name=Code]').val(obj[0]["reference_code"]);
              $('[name=Code]').prop("disabled","true");
            }
/*
color: [{…}]

: [{…}]*/
            /*$.each(obj, function () {
                options += '<option value="'+this["ID"]+'" data-id="'+this["LED_ID"]+'">'+this["Code"]+'</option>';
            });*/
         }
     });
  }

  $("#add_lightingdistribution").click(function(){
      var html_code = "<tr id='row"+lightingdistribution_count+"'>";
      html_code += "<td><div class='form-group'><select data-placeholder='Select' class='form-control-sm  chosen-select required' id='lighting_distribution_kind"+lightingdistribution_count+"' name='LightingDistributionKindID[]'></select>"
                +"<a class='btn btn-default btn sweet-prompt' onclick='open_popup(\"lighting_distribution_kind\",1);'><i class='fa fa-plus'></i></a>"
                +'<a class="btn btn-default btn" onclick="refresh_datasource(\'lighting_distribution_kind\',1,\'lighting_distribution_kind'+lightingdistribution_count+'\');"><i class="fa fa-refresh"></i></a></div></td>';
      html_code += "<td><select data-placeholder='Select' class='form-control-sm  chosen-select required' id='lighting_distribution_material"+lightingdistribution_count+"' name='LightingDisturbationTextureID[]'></select>"
                +"<a class='btn btn-default btn sweet-prompt' onclick='open_popup(\"material\",1);'><i class='fa fa-plus'></i></a>"
                +'<a class="btn btn-default btn" onclick="refresh_datasource(\'material\',1,\'lighting_distribution_material'+lightingdistribution_count+'\');"><i class="fa fa-refresh"></i></a></td>';
      html_code += "<td><button type='button' name='remove' data-row='row"+lightingdistribution_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
      html_code += "</tr>";  
      $('#lightingdistribution_table').append(html_code);
      $('#lighting_distribution_kind').find('option').clone().appendTo('#lighting_distribution_kind'+lightingdistribution_count);
      $('#lighting_distribution_material').find('option').clone().appendTo('#lighting_distribution_material'+lightingdistribution_count);

      lightingdistribution_count++;
  });

   $(document).on('click', '.remove', function(){
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
      //dimension_count--; when delete row must add uniqe number
    });

    // remove driver
    $(document).on('click', '#remove_select_row', function(){
      $(this).parent().closest('div').remove();
    });
  });

