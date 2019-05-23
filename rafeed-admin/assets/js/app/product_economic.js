function changeAdjustableType(sel){
   /* if(sel.selectedIndex)
    {
      var res =sel.options[sel.selectedIndex].text.toLowerCase();
      
      if(res=="tilted" || res=="rotated"){
        $("#adjustable_values").css("display","");
        $("input[name='form_Adjustable']").attr("value",1);
      }
      else {
        $("#adjustable_values").css("display","none");
        $("input[name='form_Adjustable']").attr("value",0);
      }
    }
    else {
      $("#adjustable_values").css("display","none");
      $("input[name='form_Adjustable']").attr("value",0);
    }*/
    var res =sel.labels[0].textContent.toLowerCase();
      
      if($.trim(res)=="tilted" || $.trim(res)=="rotated"){
        $("#adjustable_values").css("display","");
        $("input[name='form_Adjustable']").attr("value",1);
      }
      else {
        $("#adjustable_values").css("display","none");
        $("input[name='form_Adjustable']").attr("value",0);
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

      /*if(res=="outdoor"){
        $('#AsymmetricDiv').css("display","");
        $('#SymmetricDiv').css("display","none");
      }
      else{
        $('#SymmetricDiv').css("display","");
        $('#AsymmetricDiv').css("display","none");
      }*/

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
   
function changeCategory(sel) {
  var res =sel.options[sel.selectedIndex].text.toLowerCase();
  if(res=="track light"){
      $("#ProductType_details").css("display","");
  }
  else
      $("#ProductType_details").css("display","none");

}

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
function changeLightSourceType(sel,is_edit) 
{
  var res =sel.options[sel.selectedIndex].text.toLowerCase();
  var edit='';
  if(is_edit){
    edit='edit';
  }
  switch(res){
      case "module":
          $("#"+edit+"led_type").removeClass("hide");
          $("#"+edit+"LED_pin_type_div").addClass("hide");
          $("#"+edit+"LED_socket_type_div").addClass("hide");
          $("#"+edit+"LED_strips_m").addClass("hide");
          break;
      case "tube":
          $("#"+edit+"led_type").addClass("hide");
          $("#"+edit+"LED_pin_type_div").removeClass("hide");
          $("#"+edit+"LED_socket_type_div").addClass("hide");
          $("#"+edit+"LED_strips_m").addClass("hide");
          break;
      case "bulb":
          $("#"+edit+"led_type").addClass("hide");
          $("#"+edit+"LED_pin_type_div").addClass("hide");
          $("#"+edit+"LED_socket_type_div").removeClass("hide");
          $("#"+edit+"LED_strips_m").addClass("hide");
          break;
      case "strips":
          $("#"+edit+"led_type").addClass("hide");
          $("#"+edit+"LED_pin_type_div").addClass("hide");
          $("#"+edit+"LED_socket_type_div").addClass("hide");
          $("#"+edit+"LED_strips_m").removeClass("hide");
          break;  
  }
}

var color_series=1;
var dimension_count = 1;
var lightingdistribution_count=1;
var installationway_count=1;
var color_count=1;


function add_ColorSeries() {
   var html_code = '<div class="table-responsive" name="color_series" id="color_series_'+color_series+'">'+
                    '<div class="row col-xs-6"><h4>Color series #'+color_series+'</h4><a onclick="delete_colorseries('+color_series+')">  (delete) </a></div>'+
                    '<table class="table table-bordered" id="colorSeries_table'+color_series+'">'+
                    '<tr><th width="45%">part</th><th width="45%">Texture</th><th width="10%"></th></tr><tr><td>'+
                    '<div class="form-group">'+
                    '<select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="fitting_part1'+color_series+'" name="PlaceID'+color_series+'[]">'+
                    '</select><a class="btn btn-default btn sweet-prompt" onclick="open_popup(\'fitting_part\',1);"><i class="fa fa-plus"></i></a>'+
                    '<a class="btn btn-default btn" onclick="refresh_datasource(\'fitting_part\',1,\'fitting_part1'+color_series+'\');"><i class="fa fa-refresh"></i></a></div></td><td>'+
                    '<select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="texture1'+color_series+'" name="TextureID'+color_series+'[]"></select>'+
                    '<a class="btn btn-default btn" onclick="refresh_texture(\'texture1'+color_series+'\');"><i class="fa fa-refresh"></i></a>'+
                    '</td><td></td></tr></table>'+
                    '<div align="right">'+
                    '<button type="button" name="add" id="add_ColorSeries'+color_series+'" class="btn btn-success btn-xs" onclick="add_color('+color_series+')">+</button></div>'+
                    '<div class="form-group custom-file">'+
                    '<input type="file" class="custom-file-input" id="validatedCustomFile" required>'+
                    '<label class="custom-file-label" for="validatedCustomFile">upload product photo with selected color...</label></div></div>';
    $('#color_series').append(html_code);
    $('#form_fitting_part').find('option').clone().appendTo('#fitting_part1'+color_series);
    $('#form_texture').find('option').clone().appendTo('#texture1'+color_series);
    $('#fitting_part1'+color_series).trigger("chosen:updated");
    $('#texture1'+color_series).trigger("chosen:updated");
    $('input[name="color_series_count"]').val(parseInt($('input[name="color_series_count"]').val()) +1);
     color_series++;
}


function add_color(colorseries_id) {
  
    var html_code = "<tr id='row"+color_count+"'>";
    html_code += "<td><div class='form-group'><select data-placeholder='Select' class='form-control-sm chosen-select required' id='fitting_part"+color_count+"' name='PlaceID"+colorseries_id+"[]'></select>"
              +"<a class='btn btn-default btn sweet-prompt' onclick='open_popup(\"fitting_part\",1);''><i class='fa fa-plus'></i></a>"
              +'<a class="btn btn-default btn" onclick="refresh_datasource(\'fitting_part\',1,\'fitting_part'+color_count+'\');"><i class="fa fa-refresh"></i></a></div></td>';
    html_code += "<td><select data-placeholder='Select' class='form-control-sm chosen-select required' id='texture"+color_count+"' name='TextureID"+colorseries_id+"[]'></select>"
              +'<a class="btn btn-default btn" onclick="refresh_texture(\'texture'+color_count+'\');"><i class="fa fa-refresh"></i></a></td>';
    html_code += "<td><button type='button' name='remove' data-row='row"+color_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
    html_code += "</tr>";  
    $('#colorSeries_table'+colorseries_id).append(html_code);
    $('#form_fitting_part').find('option').clone().appendTo('#fitting_part'+color_count);
    $('#form_texture').find('option').clone().appendTo('#texture'+color_count);
    $('#fitting_part'+color_count).trigger("chosen:updated");
    $('#texture'+color_count).trigger("chosen:updated");

    color_count++;
}

var accessory_count=1;

$('#add_accessory').click(function (argument) {
    var html_code = "<tr id='row"+accessory_count+"'>";
    html_code += '<td class="form-group"><textarea class="form-control" rows="3" id="accessory_description" name="accessory_description[]"></textarea></td>';
    html_code += '<td class="form-group"><select data-placeholder="Select" class="form-control-sm   required"  id="AccessoryType'+accessory_count+'" name="accessory_type[]"></select></td>';
    html_code += '<td class="form-group"><select data-placeholder="Select" class="text_field chosen-select"  id="accessory_supplier'+accessory_count+'" name="accessory_supplierID[]"></select></td>';
    html_code += "<td><button type='button' name='remove' data-row='row"+installationway_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
    html_code += "</tr>";  
    $('#accessory_table').append(html_code);
    $('#Supplier').find('option').clone().appendTo('#accessory_supplier'+accessory_count);
    $('#AccessoryType').find('option').clone().appendTo('#AccessoryType'+accessory_count);

    accessory_count ++;
});

function delete_colorseries(series_id) {
  $("#color_series_"+series_id).remove();
  $('input[name="color_series_count"]').val(parseInt($('input[name="color_series_count"]').val()) -1);
  /*color_series--;*/
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

function add_dimension2fixture(row_id) {
  var table='';
  var mixer_table='';
  $('#dimension_table #row'+row_id).each(function() {
      var shape_name = $(this).find("#shape").html();
      if(shape_name!= '' )
      {
        var driver_option=get_driver_data();
        var led_option=get_led_data();

        var dimension=' ';
        if (shape_name=="Round") {
            dimension= $(this).find("#diameter").html()+" x "+$(this).find("#height").html();
        }
        else
            dimension= $(this).find("#width").html()+" x "+$(this).find("#length").html()+" x "+$(this).find("#height").html();   
        table='<div class="table-responsive" id="fixture_table_row'+row_id+'"><h4>Dimension: '+shape_name+' '+dimension+'</h4>'
            +'<table class="table table-bordered" id="fixture_table'+row_id+'">'
            +'<tr><th>Power</th><th>CCT</th><th>CRI</th><th>Lumen</th><th>Code</th><th></th></tr>'
            +'<tr><td><div><input type="number" class="dimentionValue required" min="0" name="LuminaryPower'+row_id+'[]" data-id="1" id="LuminaryPower" onchange="change_power(this,'+row_id+',1)"/><input type="text" class="unit" value="W " disabled/><button type="button" name="add" id="" onclick="add_power(this,'+row_id+')" class="btn btn-success btn-xs">+</button></div></td>'
            +'<td><input type="number" class="required" min="0" name="LuminaryCCT'+row_id+'[]" data-id="1" id="LuminaryCCT" /></td>'
            +'<td><input type="number" class="required" min="0" name="LuminaryCRI'+row_id+'[]" data-id="1" id="LuminaryCRI" /></td>'
            +'<td><input type="number" class="required" min="0" name="LuminaryLumen'+row_id+'[]" data-id="1" id="LuminaryLumen" /></td>'
            +'<td><input type="text" class="required" min="0" name="LuminaryCode'+row_id+'[]" data-id="1" id="LuminaryCode" /></td>'
            +'<td></td></tr></table>'
            +'<div align="right"></div></div>';
        $('#_fixture').append(table);         
        
      }
  });
}

function remove_dimnsionfromfixture(row) {
  $('#fixture_table_' + row).remove();
}
function remove_mixer_power(row) {
  $('#mixer_fixture_row_' + row).remove();
}

function change_driver_count(elm,dim_id,power_id,driver_id) {

  var current_count=$(elm).closest('tr').find('#driver_col select').length;
  var driver_count=elm.value-current_count;
  
  if(driver_count>0){
    //add driver
    while(current_count != elm.value)
    {
      current_count++;  
      $(elm).closest('tr').find('#driver_col').append('<div id="select-row"><select data-placeholder="Select" class="form-control-sm  chosen-select required" id="driver'+dim_id+power_id+driver_id+current_count+'" name="driver'+dim_id+power_id+driver_id+'[]"></select><a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'Driver\',this);"><i class="fa fa-refresh"></i></a><a class="btn btn-default btn" onclick="open_popup_info(\'Driver\',this);"><i class="fa fa-info"></i></a></div>');
      $('#driver').find('option').clone().appendTo('#driver'+dim_id+power_id+driver_id+current_count);
      $('#driver'+dim_id+power_id+driver_id+current_count).chosen();
    }
  }
  else{
    //remove driver
    while(current_count != elm.value)
    {
      current_count--;  
      $(elm).closest('tr').find('#driver_col #select-row:last').remove();
    }
  }
}

function add_driver(elm,dim_id,power_id) {
    //add tr in table 
    var driver_id=$("[name='driver_count"+dim_id+power_id+"[]']").length +1;
    var row='<tr id="fixture_row_'+dim_id+power_id+driver_id+'"><td></td><td></td><td><input type="number" name="driver_count'+dim_id+power_id+'[]" min="1" value="1" onchange="change_driver_count(this,'+dim_id+','+power_id+','+driver_id+')"></td>'
          +'<td id="driver_col"><div id="select-row"><select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="driver'+dim_id+power_id+driver_id+'" name="driver'+dim_id+power_id+driver_id+'[]"></select><a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'Driver\',this);"><i class="fa fa-refresh"></i></a><a class="btn btn-default btn" onclick="open_popup_info(\'Driver\',this);"><i class="fa fa-info"></i></a></div></td>'
          +'<td></td><td><button type="button" name="remove" data-row="fixture_row_'+dim_id+power_id+driver_id+'" class="btn btn-danger btn-xs remove">-</button></td></tr>';
    $("[name='driver_count"+dim_id+power_id+"[]']:last").closest("tr").after(row);
    $('#driver').find('option').clone().appendTo('#driver'+dim_id+power_id+driver_id);
    $('#driver'+dim_id+power_id+driver_id).chosen();
    //$("#fixture_table"+dim_id).append(row);

    
}

function add_power(elm,dim_id) {
  //var power_id=$("[name='LuminaryPower"+dim_id+"[]']").length +1;
  var power_id=$("[name='LuminaryPower"+dim_id+"[]']:last").data("id");
  power_id++;
  //var driver_option=$('#driver').find('option').clone().html();
  var row='<tr id="'+dim_id+power_id+'" ><td><div><input type="number" class="dimentionValue required" min="0" name="LuminaryPower'+dim_id+'[]" id="LuminaryPower" data-id="'+power_id+'" onchange="change_power(this,'+dim_id+','+power_id+')" /><input type="text" class="unit" value="W " disabled/></div></td>'
            +'<td><input type="number" class="required" min="0" name="LuminaryCCT'+dim_id+power_id+'[]" data-id="1" id="LuminaryCCT'+dim_id+power_id+'" /></td>'
            +'<td><input type="number" class="required" min="0" name="LuminaryCRI'+dim_id+power_id+'[]" data-id="1" id="LuminaryCRI'+dim_id+power_id+'" /></td>'
            +'<td><input type="number" class="required" min="0" name="LuminaryLumen'+dim_id+power_id+'[]" data-id="1" id="LuminaryLumen'+dim_id+power_id+'" /></td>'
            +'<td><input type="text" class="required" min="0" name="LuminaryCode'+dim_id+power_id+'[]" data-id="1" id="LuminaryCode'+dim_id+power_id+'" /></td>'
            +'<td><button type="button" name="remove" data-row="'+dim_id+power_id+'" class="btn btn-danger btn-xs remove">-</button></td></tr>';

  $("#fixture_table"+dim_id).append(row);
}

function get_led_option(elm) {
  var id=$(elm).data("row");  
  var cct_option=Array();
  var cri_option=Array();
  var cct_element="";
  var cri_element="";
  $(elm).parent().parent().find('#cct'+id).empty();
  $(elm).parent().parent().find('#cri'+id).empty();

  $('[name="led'+id+'[]"]').each(function() {
   $.ajax({
         type: 'post',
         async: false,
         url: '../LED/get_led_options/'+$(this).val(),
         data: {},
         success: function(result){
            var obj=JSON.parse(result);
            if(obj.length==0)
            {
                sweetAlert("Oops...", "doesn't exist !!", "error");
            }
            else{
                  cct_option.push(obj["CCT"]);
                  cri_option.push(obj["CRI"]);
              }
            }
          }); 
   });

  cct_option= $.unique(cct_option.sort()).sort();
  cri_option= $.unique(cri_option.sort()).sort();

  $.each(cct_option,function(key, value){
    cct_element='<div class="col "><span class="radio-wrapper"> '
            +'<input type="radio" class="cct_value" name="cct_value'+id+'" id="cct_value'+id+key+'" value="'+value+'">'
            +'<div></div></span> <span class="table-cell"><label for="cct_value'+id+key+'"">'+value+'</label></span></div></td>';
    $(elm).parent().parent().find('#cct'+id).append(cct_element);
  });

  $.each(cri_option,function(key, value){
    cri_element='<div class="col "><span class="radio-wrapper"> '
            +'<input type="radio" class="cri_value" name="cri_value'+id+'" id="cri_value'+id+key+'" value="'+value+'">'
            +'<div></div></span> <span class="table-cell"><label for="cri_value'+id+key+'">'+value+'</label></span></div></td>';  
    $(elm).parent().parent().find('#cri'+id).append(cri_element);
  });
 
}

function change_power(elm,dim_id,power_id) {
  var new_power=elm.value;
  $('#mixer_table'+dim_id+' #power'+dim_id+power_id).html(new_power);
}

function add_led(elm,dim_id,power_id){
  var current_count=$(elm).closest('tr').find('#led_col select').length;
  current_count++;
  $(elm).closest('tr').find('#led_col').append('<div id="select-row"><select data-placeholder="Select" class="chosen-select required"  id="led'+dim_id+power_id+current_count+'" name="led'+dim_id+power_id+'[]"></select><a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'Driver\',this);"><i class="fa fa-refresh"></i></a><a class="btn btn-default btn" onclick="open_popup_info(\'LED\',this);"><i class="fa fa-info"></i></a><a class="btn btn-default btn" id="remove_select_row"><i class="fa fa-remove"></i></a><div>');
  $('#led').find('option').clone().appendTo('#led'+dim_id+power_id+current_count);
  $('#led'+dim_id+power_id+current_count).chosen();
}

$(document).ready(function(){
    
    $('#add_dimension').click(function(){ 
        
        /*$('#dimension_controls').append("<input type='hidden' value='"+$("input[name='form_diameter']").val()+"' name='diameter[]'>");*/
        var html_code = "<tr id='row"+dimension_count+"'>";
        html_code += "<td id='shape'>"+$("select[name='form_Shape']").chosen().find("option:selected" ).text();+"</td>";
        html_code += "<td id='diameter'>"+$("input[name='form_diameter']").val()+"</td>";
        html_code += "<td id='width'>"+$("input[name='form_width']").val()+"</td>";
        html_code += "<td id='length'>"+$("input[name='form_length']").val()+"</td>";
        html_code += "<td id='height'>"+$("input[name='form_height']").val()+"</td>";
        html_code += "<td id='Weight'>"+$("input[name='form_Weight']").val()+"</td>";
        html_code += "<td>"+$("select[name='form_AdjustableType']").chosen().find("option:selected" ).text();+"</td>";
        html_code += "<td>"+$("input[name='form_HMin']").val()+"</td>";
        html_code += "<td>"+$("input[name='form_HMax']").val()+"</td>";
        html_code += "<td>"+$("input[name='form_VMin']").val()+"</td>";
        html_code += "<td>"+$("input[name='form_VMax']").val()+"</td>";
        html_code += "<td id='dim_controls_"+dimension_count+"'><button type='button' name='remove' data-row='row"+dimension_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
        html_code += "</tr>";  
        $('#dimension_table').append(html_code);
        add_dimension2fixture(dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'diameter[]',
            value: $("input[name='form_diameter']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'width[]',
            value: $("input[name='form_width']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'length[]',
            value: $("input[name='form_length']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'height[]',
            value: $("input[name='form_height']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'HMin[]',
            value: $("input[name='form_HMin']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'HMax[]',
            value: $("input[name='form_HMax']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'VMin[]',
            value: $("input[name='form_VMin']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'VMax[]',
            value: $("input[name='form_VMax']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'Shape[]',
            value: $("select[name='form_Shape']").chosen().find("option:selected" ).val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'AdjustableType[]',
            value: $("input[name='form_AdjustableType']").val()
        }).appendTo('#dim_controls_'+dimension_count);
        
        $('<input>').attr({
            type: 'hidden',
            name: 'weight[]',
            value: $("input[name='form_Weight']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'Phases[]',
            value: $("input[name='form_Phases']").val()
        }).appendTo('#dim_controls_'+dimension_count);
        
        $('<input>').attr({
            type: 'hidden',
            name: 'Wires[]',
            value: $("input[name='form_Wires']").val()
        }).appendTo('#dim_controls_'+dimension_count);


        //file type
        var inputs = $("input[name='form_dimension_photo']").clone();
        inputs.attr("class","hide");
        inputs.attr("name","dimension_photo[]");
        $('#dim_controls_'+dimension_count).append(inputs);

        inputs = $("input[name='form_product_photo']").clone();
        inputs.attr("class","hide");
        inputs.attr("name","product_photo[]");
        $('#dim_controls_'+dimension_count).append(inputs);

        inputs = $("input[name='form_dailog_study_file']").clone();
        inputs.attr("class","hide");
        inputs.attr("name","dailog_study_file[]");
        $('#dim_controls_'+dimension_count).append(inputs);


         $('<input>').attr({
            type: 'hidden',
            name: 'product_AccessoryID[]',
            value: ($("select[name='form_AccessoryID']").chosen().val()).concat($("select[name='form_PublicAccessoryID']").val())
        }).appendTo('#dim_controls_'+dimension_count);

        //clear values of controler
        $("input[name='form_diameter']").val("");
        $("input[name='form_width']").val("");
        $("input[name='form_length']").val("");
        $("input[name='form_height']").val("");
        $("input[name='form_HMin']").val("");
        $("input[name='form_HMax']").val("");
        $("input[name='form_VMin']").val("");
        $("input[name='form_VMax']").val("");
        $("input[name='form_AdjustableType']").val(0);

        $("input[name='form_dimension_photo']").val("");
        $("input[name='form_product_photo']").val("");
        $("input[name='form_dailog_study_file']").val("");

        $("input[name='form_Weight']").val("");
        $("select[name='form_Shape']").children('option').first().prop('selected', true);
        $("select[name='form_Shape']").trigger("chosen:updated");
        $("select[name='form_AccessoryID']").val("");
        $("select[name='form_AccessoryID']").trigger("chosen:updated");
        $("select[name='form_PublicAccessoryID']").val("");
        $("select[name='form_PublicAccessoryID']").trigger("chosen:updated");

        /*$("select[name='form_AdjustableType']").children('option').first().prop('selected', true);
        $("select[name='form_AdjustableType']").trigger("chosen:updated");
        $("select[name='form_AdjustableType']").trigger("change");*/

        dimension_count= dimension_count + 1;
    });

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

    $('#add_installation_way').click(function(){
        var html_code = "<tr id='row"+installationway_count+"'>";
        html_code += "<td><select data-placeholder='Select' class='form-control-sm  chosen-select required' id='installation_way"+installationway_count+"' name='InstallationWayID[]' ></select>"
                  +"<a class='btn btn-default btn sweet-prompt' onclick='open_popup(\"installation_way\",1);'><i class='fa fa-plus'></i></a>"
                  +'<a class="btn btn-default btn" onclick="refresh_datasource(\'installation_way\',1,\'installation_way'+installationway_count+'\');"><i class="fa fa-refresh"></i></a></td>';
        html_code += "<td><select data-placeholder='Select' class='form-control-sm  chosen-select' id='FittingAccessory"+installationway_count+"' name='installation_way_AccessoryID[]'><option value='NULL'>Without accessory</option></select></td>";
        html_code += "<td><button type='button' name='remove' data-row='row"+installationway_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
        html_code += "</tr>";  
        $('#installationway_table').append(html_code);
        $('#installation_way').find('option').clone().appendTo('#installation_way'+installationway_count);
        $('#FittingAccessory').find('option').clone().appendTo('#FittingAccessory'+installationway_count);

        installationway_count ++;
  });
   

   
     
    $(document).on('click', '.remove', function(){
      var delete_row = $(this).data("row");
      $('#' + delete_row).remove();
      remove_dimnsionfromfixture(delete_row);
      remove_mixer_power(delete_row);
      //dimension_count--; when delete row must add uniqe number
    });

    // remove driver
    $(document).on('click', '#remove_select_row', function(){
      $(this).parent().closest('div').remove();
    });

    //remove-power
});