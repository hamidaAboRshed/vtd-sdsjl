
  
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
      $('#IES_files').append('<input type="file" class="custom-file-input" id="validatedCustomFile" name="ies_file[]">');
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
                    '<select data-placeholder="Select" class=" chosen-select required"  id="fitting_part1'+color_series+'" name="PlaceID'+color_series+'[]">'+
                    '</select><a class="btn btn-default btn sweet-prompt" onclick="open_popup(\'fitting_part\',1);"><i class="fa fa-plus"></i></a>'+
                    '<a class="btn btn-default btn" onclick="refresh_datasource(\'fitting_part\',1,\'fitting_part1'+color_series+'\');"><i class="fa fa-refresh"></i></a></div></td><td>'+
                    '<select data-placeholder="Select" class=" chosen-select required"  id="texture1'+color_series+'" name="TextureID'+color_series+'[]"></select>'+
                    '<a class="btn btn-default btn" onclick="refresh_texture(\'texture1'+color_series+'\');"><i class="fa fa-refresh"></i></a>'+
                    '</td><td></td></tr></table>'+
                    '<div align="right">'+
                    '<button type="button" name="add" id="add_ColorSeries'+color_series+'" class="btn btn-success btn-xs" onclick="add_color('+color_series+')">+</button></div>'+
                    '<div class="form-group custom-file">'+
                    '<input type="file" class="custom-file-input" id="validatedCustomFile" name="color_series_photo[]" required>'+
                    '<label class="custom-file-label" for="validatedCustomFile">upload product photo with selected color...</label></div></div>';
    $('#color_series').append(html_code);
    $('#form_fitting_part').find('option').clone().appendTo('#fitting_part1'+color_series);
    $('#form_texture').find('option').clone().appendTo('#texture1'+color_series);
    $('#fitting_part1'+color_series).trigger("chosen:updated");
    $('#texture1'+color_series).trigger("chosen:updated");
    $('#fitting_part1'+color_series).chosen({ width: '220' });
    $('#texture1'+color_series).chosen({ width: '220' });
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

    $('#fitting_part'+color_count).chosen({ width: '220' });
    $('#texture'+color_count).chosen({ width: '220' });
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
                options += '<option value="'+this["ID"]+'">'+this["Code"]+'</option>';
            });
         }
     });
  return options;
}

function get_cct_option(element_name) {
  var checkbox_list='';
  $("#basic_CCT_option option").each(function()
  {
    checkbox_list += '<div class="col ">'
                +'<span class="radio-wrapper"> '
                    +'<input type="checkbox" name="'+element_name+'" id="'+element_name+$(this).index()+'" value="'+$(this).val()+'">'
                    +'<div></div></span>'
                    +'<span class="table-cell"> '
                    +'<label for="'+element_name+$(this).index()+'">'+$(this).val()+'</label></span></div> ';

  });
  return checkbox_list;
}

function get_cri_option(element_name) {
  var checkbox_list='';
  $("#basic_CRI_option option").each(function()
  {
    checkbox_list += '<div class="col ">'
                +'<span class="radio-wrapper"> '
                    +'<input type="checkbox" name="'+element_name+'" id="'+element_name+$(this).index()+'" value="'+$(this).val()+'">'
                    +'<div></div></span>'
                    +'<span class="table-cell"> '
                    +'<label for="'+element_name+$(this).index()+'">'+$(this).val()+'</label></span></div> ';

  });
  return checkbox_list;
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
        var cct_option = get_cct_option('LED_CCT_value'+row_id+'1[]');
        var cri_option = get_cri_option('LED_CRI_value'+row_id+'1[]');
        var dimension=' ';
        if (shape_name=="Round") {
            dimension= $(this).find("#diameter").html()+" x "+$(this).find("#height").html();
        }
        else
            dimension= $(this).find("#width").html()+" x "+$(this).find("#length").html()+" x "+$(this).find("#height").html();   
        table='<div class="table-responsive" id="fixture_table_row'+row_id+'"><h4>Dimension: '+shape_name+' '+dimension+'</h4>'
            +'<table class="table table-bordered" id="fixture_table'+row_id+'">'
            +'<tr><th>Power</th><th>Current</th><th>LED code</th><th>CCT</th><th>CRI</th><th>driver count</th><th>Driver code</th><th>Price</th><th></th></tr>'
            +'<tr>'
            +'<td><div><input type="number" class="dimentionValue required" min="0" name="LuminaryPower'+row_id+'[]" data-id="1" id="LuminaryPower" onchange="change_power(this,'+row_id+',1)"/><input type="text" class="unit" value="W " disabled/><button type="button" name="add" id="" onclick="add_power(this,'+row_id+')" class="btn btn-success btn-xs">+</button></div></td>'
            +'<td><div><input type="number" class="dimentionValue required" min="0" name="LuminaryCurrent'+row_id+'[]" data-id="1" id="LuminaryCurrent"/><input type="text" class="unit" value="mA " disabled/></div></td>'
            +'<td id="led_col"><button type="button" name="add" onclick="add_led(this,'+row_id+',1)" class="btn btn-success btn-xs">+</button><br/><div id="select-row"><select data-placeholder="Select" class="chosen-select"  id="led" name="led'+row_id+'1[]">'+led_option+'</select>'
            +'<a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'LED\',this);"><i class="fa fa-refresh"></i></a>'
            +'<a class="btn btn-default btn" onclick="open_popup_info(\'LED\',this);"><i class="fa fa-info"></i></a></div></td>'
            +'<td>'+cct_option+'</td>'
            +'<td>'+cri_option+'</td>'
            +'<td><input type="number" name="driver_count'+row_id+'1[]" min="1" value="1" onchange="change_driver_count(this,'+row_id+',1,1)"><button type="button" name="add" id="" onclick="add_driver(this,'+row_id+',1)" class="btn btn-success btn-xs">+</button></td>'
            +'<td id="driver_col"><div id="select-row"><select data-placeholder="Select" class="form-control-sm required chosen-select"  id="driver" name="driver'+row_id+'11[]">'+driver_option+'</select>'
            +'<a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'Driver\',this);"><i class="fa fa-refresh"></i></a>'
            +'<a class="btn btn-default btn" onclick="open_popup_info(\'Driver\',this);"><i class="fa fa-info"></i></a></div></td>'
            //+'<td><input type="file" class="custom-file-input" id="validatedCustomFile" name="form_photo"></td>'
            +'<td><input type="number" class="dimentionValue" name="Price'+row_id+'[]" style="width: 60%;" value="0"/><input type="text" class="unit" value="$ " disabled/></td>'
            +'<td></td></tr></table>'
            +'<div align="right"></div></div>';
        $('#_fixture').append(table);
        $("select[name='led"+row_id+"1[]']").chosen();
        $("select[name='driver"+row_id+"11[]']").chosen();

        mixer_table='<div class="table-responsive" id="mixer_table_row'+row_id+'"><h4>Dimension: '+shape_name+' '+dimension+'</h4>'
            +'<table class="table table-bordered" id="mixer_table'+row_id+'">'
            +'<tr><th>Power</th><th style="width: 10px;">LED Option</th><th>CCT</th><th>CRI</th><th>Lumen</th><th></th></tr>'
            +'<tr><td id="power'+row_id+'1"></td>'
            +'<td><button type="button" data-row="'+row_id+'1" class="btn btn-default btn-xs" onclick="get_led_option(this)">get LED option</button></td>'
            +'<td id="cct'+row_id+'1"></td>'
            +'<td id="cri'+row_id+'1"></td>'
            +'<td id="lumen'+row_id+'"><input type="number" class="required" min="0" id="lumen_value" name="lumen'+row_id+'1" /></td>'
            +'<td></td></tr></table></div>';
        $('#base_role').append(mixer_table);            
        
      }
  });
}
function add_product_validation(){
  alert("Hello");
}
function remove_dimnsionfromfixture(row) {
  $('#fixture_table_' + row).remove();
  $('#mixer_table_' + row).remove();
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
    var row='<tr id="fixture_row_'+dim_id+power_id+driver_id+'"><td></td><td></td><td></td><td></td><td></td><td><input type="number" name="driver_count'+dim_id+power_id+'[]" min="1" value="1" onchange="change_driver_count(this,'+dim_id+','+power_id+','+driver_id+')"></td>'
          +'<td id="driver_col"><div id="select-row"><select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="driver'+dim_id+power_id+driver_id+'" name="driver'+dim_id+power_id+driver_id+'[]"></select><a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'Driver\',this);"><i class="fa fa-refresh"></i></a><a class="btn btn-default btn" onclick="open_popup_info(\'Driver\',this);"><i class="fa fa-info"></i></a></div></td>'
          +'<td><button type="button" name="remove" data-row="fixture_row_'+dim_id+power_id+driver_id+'" class="btn btn-danger btn-xs remove">-</button></td></tr>';
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

  var cct_option = get_cct_option('LED_CCT_value'+dim_id+power_id+'[]');
  var cri_option = get_cri_option('LED_CRI_value'+dim_id+power_id+'[]');
  var row='<tr id="'+dim_id+power_id+'" >'
            +'<td><div><input type="number" class="dimentionValue required" min="0" name="LuminaryPower'+dim_id+'[]" id="LuminaryPower" data-id="'+power_id+'" onchange="change_power(this,'+dim_id+','+power_id+')" /><input type="text" class="unit" value="W " disabled/></div></td>'
            +'<td><div><input type="number" class="dimentionValue required" min="0" name="LuminaryCurrent'+dim_id+'[]" data-id="'+power_id+'" id="LuminaryCurrent"/><input type="text" class="unit" value="mA " disabled/></div></td>'
            +'<td id="led_col"><button type="button"  onclick="add_led(this,'+dim_id+','+power_id+')" class="btn btn-success btn-xs">+</button><br/><div id="select-row"><select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="led'+dim_id+power_id+'" name="led'+dim_id+power_id+'[]"></select><a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'LED\',this);"><i class="fa fa-refresh"></i></a><a class="btn btn-default btn" onclick="open_popup_info(\'LED\',this);"><i class="fa fa-info"></i></a></div></td>'
            +'<td>'+cct_option+'</td><td>'+cri_option+'</td>'
            +'<td><input type="number" name="driver_count'+dim_id+power_id+'[]" min="1" value="1" onchange="change_driver_count(this,'+dim_id+','+power_id+',1)"><button type="button" name="add" id="" onclick="add_driver(this,'+dim_id+','+power_id+')" class="btn btn-success btn-xs">+</button></td>'
            +'<td id="driver_col"><div id="select-row"><select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="driver'+dim_id+power_id+'1" name="driver'+dim_id+power_id+'1[]"></select><a class="btn btn-default btn" onclick="refresh_fixture_datasource(\'Driver\',this);"><i class="fa fa-refresh"></i></a><a class="btn btn-default btn" onclick="open_popup_info(\'Driver\',this);"><i class="fa fa-info"></i></a></div></td>'
            //+'<td><input type="file" class="custom-file-input" id="validatedCustomFile" name="form_photo"></td>'
            +'<td><input type="number" class="dimentionValue" name="Price'+row_id+'[]" style="width: 60%;" value="0"/><input type="text" class="unit" value="$ " disabled/></td>'
            +'<td><button type="button" name="remove" data-row="'+dim_id+power_id+'" class="btn btn-danger btn-xs remove">-</button></td></tr>';

  $("#fixture_table"+dim_id).append(row);
  $('#driver').find('option').clone().appendTo('#driver'+dim_id+power_id+'1');
  $('#driver'+dim_id+power_id+'1').chosen();
  $('#led').find('option').clone().appendTo('#led'+dim_id+power_id);
  $('#led'+dim_id+power_id).chosen();

  var mixer_table='<tr id="mixer_fixture_row_'+dim_id+power_id+'"><td id="power'+dim_id+power_id+'"></td>'
        +'<td><button type="button" data-row="'+dim_id+power_id+'" class="btn btn-default btn-xs" onclick="get_led_option(this)">get LED option</button></td>'
        +'<td id="cct'+dim_id+power_id+'"> </td>'
        +'<td id="cri'+dim_id+power_id+'"> </td>'
        +'<td id="lumen'+dim_id+'"><input type="number" class="required" min="0" id="lumen_value" name="lumen'+dim_id+power_id+'" /></td>'
        +'<td></td></tr>';
    $('#mixer_table'+dim_id).append(mixer_table);
}

function get_led_option(elm) {
  var id=$(elm).data("row");  
  var cct_option=Array();
  var cri_option=Array();
  var cct_element="";
  var cri_element="";
  $(elm).parent().parent().find('#cct'+id).empty();
  $(elm).parent().parent().find('#cri'+id).empty();

  /*$('[name="led'+id+'[]"]').each(function() {
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
   });*/

  $.each($("input[name='LED_CCT_value"+id+"[]']:checked"), function(){            
      cct_option.push($(this).val());
  });

  $.each($("input[name='LED_CRI_value"+id+"[]']:checked"), function(){            
      cri_option.push($(this).val());
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
    var ip_count=1;
    $('#add_IP_value').click(function(){ 
        
        /*$('#dimension_controls').append("<input type='hidden' value='"+$("input[name='form_diameter']").val()+"' name='diameter[]'>");*/
        var html_code = "<tr id='row"+ip_count+"'>";
        html_code += '<td><div style="display: inline-flex;border: none;"><span class="radio-wrapper" style="margin-top: 7px"><input type="checkbox" name="IP_check_checkbox" id="IP_type'+ip_count+'" onchange="changeIPType(this);"><input type="hidden" name="IP_check[]" value="0" /><div></div></span><span class="table-cell"><label for="IP_type'+ip_count+'">Multiple IP</label></span></div></td>';
        html_code += '<td><div id="s_ip"><p class="form_title">Single IP<span class="text-danger">*</span></p><input type="number" class="text_field required" min=0 name="FittingSingleIP[]"  value="0"/></div>';
        html_code += '<div id="m_ip" class="hide"><p class="form_title">Front IP<span class="text-danger">*</span></p><input type="number" class="text_field required" min=0 name="FittingFrontIP[]" value="0"/>';
        html_code += '<p class="form_title">Back IP<span class="text-danger">*</span></p><input type="number" class="text_field required" min=0 name="FittingBackIP[]" value="0"/></div></td>';
        html_code += "<td><button type='button' name='remove' data-row='row"+ip_count+"' class='btn btn-danger btn-xs remove'>-</button></td></tr>";

        $('#ip_table').append(html_code);
        ip_count++;
    });

    //remove enter action enter
    $("#create_productForm").bind("keydown", function(e) {
       if (e.keyCode === 13) return false;
     });

    //select Indoor by default
    

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
         html_code += "<td>"+($("input[name='form_THMin']").val()=='' ? '' : $("input[name='form_THMin']").val()+" x "+ $("input[name='form_THMax']").val()) +"</td>";
        html_code += "<td>"+($("input[name='form_TVMin']").val()=='' ? '' : $("input[name='form_TVMin']").val()+" x "+ $("input[name='form_TVMax']").val()) +"</td>";
        html_code += "<td>"+($("input[name='form_RHMin']").val()=='' ? '' : $("input[name='form_RHMin']").val()+" x "+ $("input[name='form_RHMax']").val()) +"</td>";
        html_code += "<td>"+($("input[name='form_RVMin']").val()=='' ? '' : $("input[name='form_RVMin']").val()+" x "+ $("input[name='form_RVMax']").val()) +"</td>";
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
            name: 'THMin[]',
            value: $("input[name='form_THMin']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'THMax[]',
            value: $("input[name='form_THMax']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'TVMin[]',
            value: $("input[name='form_TVMin']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'TVMax[]',
            value: $("input[name='form_TVMax']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'RHMin[]',
            value: $("input[name='form_RHMin']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'RHMax[]',
            value: $("input[name='form_RHMax']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'RVMin[]',
            value: $("input[name='form_RVMin']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'RVMax[]',
            value: $("input[name='form_RVMax']").val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'Shape[]',
            value: $("select[name='form_Shape']").chosen().find("option:selected" ).val()
        }).appendTo('#dim_controls_'+dimension_count);

        $('<input>').attr({
            type: 'hidden',
            name: 'AdjustableType[]',
            value: $("input[name='form_Adjustable']").val()
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
        var inputs = $("input[name='form_dimension_photo[]']").clone();
        inputs.attr("class","hide");
        inputs.attr("name","dimension_photo"+dimension_count+"[]");
        $('#dim_controls_'+dimension_count).append(inputs);

        inputs = $("input[name='form_product_photo[]']").clone();
        inputs.attr("class","hide");
        inputs.attr("name","product_photo"+dimension_count+"[]");
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
        $("input[name='form_THMin']").val("");
        $("input[name='form_THMax']").val("");
        $("input[name='form_TVMin']").val("");
        $("input[name='form_TVMax']").val("");;
        $("input[name='form_RHMin']").val("");
        $("input[name='form_RHMax']").val("");
        $("input[name='form_RVMin']").val("");
        $("input[name='form_RVMax']").val("");
        //$("input[name='form_AdjustableType']").val(0);

        $("input[name='form_dimension_photo[]']").val("");
        $("input[name='form_product_photo[]']").val("");
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
        html_code += "<td><select data-placeholder='Select' class='form-control-sm  chosen-select required' id='lighting_distribution_texture"+lightingdistribution_count+"' name='LightingDisturbationTextureID[]'></select>"
                  +'<a class="btn btn-default btn" onclick="refresh_texture(\'lighting_distribution_texture'+lightingdistribution_count+'\');"><i class="fa fa-refresh"></i></a>';
        html_code += "<td><button type='button' name='remove' data-row='row"+lightingdistribution_count+"' class='btn btn-danger btn-xs remove'>-</button></td>";   
        html_code += "</tr>";  
        $('#lightingdistribution_table').append(html_code);
        $('#lighting_distribution_kind').find('option').clone().appendTo('#lighting_distribution_kind'+lightingdistribution_count);
        $('#lighting_distribution_texture').find('option').clone().appendTo('#lighting_distribution_texture'+lightingdistribution_count);

        $('#lighting_distribution_texture'+lightingdistribution_count).chosen({ width: '220' });
        $('#lighting_distribution_kind'+lightingdistribution_count).chosen({ width: '220' });

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