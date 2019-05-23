function add_premium_product() {

    $("#createForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        /*$(".text-danger").remove();*/

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
function get_product_option() {
    var dimension_count = $("#_fixture .table-responsive").length;
    
    var base_data=get_basedata(dimension_count);
    
    //get all baserole
    var baserole_data=get_baserole(dimension_count);

    //get all beam angle
    //var res =$('#product_type').find('option:selected').text().toLowerCase();

    var BA,BAH,BAV;
    if($('#SymmetricBeam').is(":checked")){
        BA=$('input[name="BeamAngleValue"]').val();
        BAH=null;
        BAV=null;
    }
    else{
        BA=null;
        BAH=$('input[name="BeamAngleH"]').val();
        BAV=$('input[name="BeamAngleV"]').val();   
    }
    /*if(res=='indoor'){
        BA=$('input[name="BeamAngleValue"]').val();
        BAH=null;
        BAV=null;
    }
    else{
        BA=null;
        BAH=$('input[name="BeamAngleH"]').val();
        BAV=$('input[name="BeamAngleV"]').val();   
    }*/
    
    //get Installation way option
    var installation_way=new Array();
    $('[name="InstallationWayID[]"]').each(function(){
        installation_way.push($(this).find('option:selected').text());
    });

     //get Lighting distribution option
    var distribution=new Array();
    $('[name="LightingDistributionKindID[]"]').each(function(){
        distribution.push($(this).find('option:selected').text());
    });

    //get all color series
    var color_option=Array();
    $('[name="color_series"]').each(function(argument) {
       color_option.push($(this).find('h4').html()); 
    });
    var data2= $("#create_productForm").serialize();
    data2+='base_data='+base_data;
    //var data = new FormData(document.getElementById("create_productForm"));
     var data = $('#create_productForm').serializeArray();
    /*data.append('base_data',base_data);
    data.append('baserole_data',baserole_data);
    data.append('BA',BA);
    data.append('BAH',BAH);
    data.append('BAV',BAV);*/
    

    data.push({name: 'base_data', value: base_data});
    data.push({name: 'baserole_data', value: baserole_data});
    data.push({name: 'BA', value: BA});
    data.push({name: 'BAH', value: BAH});
    data.push({name: 'BAV', value: BAV});
    //call function for mix values
    /*var request = new XMLHttpRequest();
    request.open("POST", "../Product/get_product_mixer/");
     
    request.send(data);*/
    $.post("../Product/get_product_mixer/", data);
    $.ajax({
        type: 'post',
        async: false,
        processData: false,
        contentType: false,
        dataType: 'json',/*
        enctype: 'multipart/form-data',
        cache: false,*/
        url: '../Product/get_product_mixer/',
        //data: {'base_data':base_data,'baserole_data':baserole_data, 'BA':BA, 'BAH':BAH, 'BAV':BAV,data},
        data: data ,
        success: function (data, status)
        {
             
        },
        error: function (xhr, desc, err)
        {
             

        }
     });

}

/*$( '#create_productForm' )
  .submit( function( e ) { 
    var dimension_count = $("#_fixture .table-responsive").length;
    
    var base_data=get_basedata(dimension_count);
    
    //get all baserole
    var baserole_data=get_baserole(dimension_count);

    //get all beam angle
    //var res =$('#product_type').find('option:selected').text().toLowerCase();

    var BA,BAH,BAV;
    if($('#SymmetricBeam').is(":checked")){
        BA=$('input[name="BeamAngleValue"]').val();
        BAH=null;
        BAV=null;
    }
    else{
        BA=null;
        BAH=$('input[name="BeamAngleH"]').val();
        BAV=$('input[name="BeamAngleV"]').val();   
    }*/
    /*if(res=='indoor'){
        BA=$('input[name="BeamAngleValue"]').val();
        BAH=null;
        BAV=null;
    }
    else{
        BA=null;
        BAH=$('input[name="BeamAngleH"]').val();
        BAV=$('input[name="BeamAngleV"]').val();   
    }*/
    
    //get Installation way option
    /*var installation_way=new Array();
    $('[name="InstallationWayID[]"]').each(function(){
        installation_way.push($(this).find('option:selected').text());
    });

     //get Lighting distribution option
    var distribution=new Array();
    $('[name="LightingDistributionKindID[]"]').each(function(){
        distribution.push($(this).find('option:selected').text());
    });

    //get all color series
    var color_option=Array();
    $('[name="color_series"]').each(function(argument) {
       color_option.push($(this).find('h4').html()); 
    });


    var data = new FormData(this);*/
    /*data.append('base_data',JSON.stringify(base_data).replace(/]|[[]/g, ''));
    data.append('baserole_data',JSON.stringify(baserole_data).replace(/]|[[]/g, ''));
    data.append('BA',BA);
    data.append('BAH',BAH);
    data.append('BAV',BAV);
    data.append('color_series',color_option);*/
    //var data_form=Array();
    /*var data_form=[];
   // var data_form="";
    var x = $("#create_productForm").serializeArray();
    //var i=0;
    //$return_array = json_encode(x);
    $.each(x, function(i, field){ 
        //data_form.splice(field.index, i , field.name);
        var innerObj = {};
        innerObj[field.name] = field.value;
        data_form.push(innerObj);*/
       /* data_form+= "'"+field.name +"' : '"+field.value+"'";
        if(i!=51)
            data_form+=",";*/
        //data_form.push( {name: value.name,  index:  value.index});
    /*});*/
/**/
        //var data = $("#create_productForm").serializeArray();
        //var data = $("#create_productForm").serialize();
        //var data_object={'base_data':base_data,'baserole_data':baserole_data, 'BA':BA, 'BAH':BAH, 'BAV':BAV, 'data': data_form};
    ///test


 /*   var data_object={'base_data':base_data,'baserole_data':baserole_data, 'BA':BA, 'BAH':BAH, 'BAV':BAV};
    var x = $("#create_productForm").serializeArray();
    $.each(x, function(i, field){ 
        //Object.assign(data_object, { field.name: field.value});
        //data_object.push( field.name, field.value );
        //data_object.assign({field.name : field.value}, data_object);
        //data_object.add(field.name, field.value )
        data_object[field.name] = field.value;
    });*/

/*
var values = $(this).serialize(),
attributes = {};

values.replace(/([^&]+)=([^&]*)/g, function (match, name, value) {
    attributes[name] = value;
});*/
//call function for mix values
    /*var request = new XMLHttpRequest();
    request.open("POST", "../Product/get_product_mixer/");
     
    request.send(data);
    request.send(base_data);// not worked becouse i can't send array without serialsed
    request.send(baserole_data);
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { 
            document.getElementById("demo").innerHTML =
            this.responseText;
       }
    };*/
    //var form = $(this);
   /* $.ajax( {
      url: '../Product/get_basedata/1',
      data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
      //important for upload dile inside form
        /*async: false,
        processData: false,
        contentType: false,

      success: function (data, status)
        {
             
        },
        error: function (xhr, desc, err)
        {
             

        }
    } );
    e.preventDefault();
  });*/


function get_baserole(dimension_count) {
    var baserole_data=new Array(dimension_count);
    var baserole_index=0;
     $('#_mixer .table-responsive').each(function(){
        var dim=$(this).find('h4').html();
        var dim_table=$(this).find('tr ');
        var power_data=new Array($(this).find('tr ').length -1 );
        var power_index=0;
        dim_table.each(function(){
            if($(this).find('.cct_value').val()!=undefined)
            {
                power_data[power_index]={'power':$(this).find('td:first').html(),'CCT':$(this).find('.cct_value:checked').val(),'CRI':$(this).find('.cri_value:checked').val(),'Lumen':$(this).find('#lumen_value').val()};
                console.log('Power='+$(this).find('td:first').html());
                console.log('CCT='+$(this).find('.cct_value:checked').val());
                console.log('CRI='+$(this).find('.cri_value:checked').val());
                console.log('Lumen='+$(this).find('#lumen_value').val());
                power_index++;
            }
        }); 
        baserole_data[baserole_index]={ dim :dim, power_data :power_data};
        baserole_index++;
     });
    /*$('<input>').attr({
            type: 'hidden',
            name: 'baserole_data[]',
            value: baserole_data
        }).appendTo('#_mixer');*/

     return baserole_data;
}

function get_basedata(dimension_count) {
    var data=new Array(dimension_count);
    var counter=1;
    var index=0;
    $('#_fixture .table-responsive').each(function(){

       var dim=$(this).find('h4').html(); 
       console.log("get dimension #"+counter);
       var powers=$(this).find('input[name="LuminaryPower'+counter+'[]"]');
       if(powers){
        var power_data=new Array($('input[name="LuminaryPower'+counter+'[]"]').length);
        var power_index=0;
        powers.each(function(){
            var power=this.value;
            //var power_id=this.name;
            //power_id=power_id.substring(13, 14); dimention ID
            var power_id=$('input[name="LuminaryPower'+counter+'[]"]').index(this);
            
            power_id++;

            console.log("get power ="+power);
            console.log("    power id ="+power_id);

            //LED option
            var leds=$('select[name="led'+counter+power_id+'[]"]');
            var led_data=new Array($('select[name="led'+counter+power_id+'[]"]').length);
            var led_index=0;
            leds.each(function(){
                led_data[led_index]=$(this).find('option:selected').val();
                console.log("       led ="+ $(this).find('option:selected').val());
                led_index++;
            });

            //driver option
            var driver_count_id=1;
            var drivers_count=$('input[name="driver_count'+counter+power_id+'[]"]');
            var drivers_count_data=new Array($('input[name="driver_count'+counter+power_id+'[]"]').length);
            var driver_count_index=0;
            drivers_count.each(function(){

                console.log("       driver count ="+ $(this).val());

                //get all driver id in this row
                var drivers=$('select[name="driver'+counter+power_id+driver_count_id+'[]"]');
                var drivers_data=new Array($('select[name="driver'+counter+power_id+driver_count_id+'[]"]').length);
                var drivers_index = 0;
                drivers.each(function(){
                    drivers_data[drivers_index]=$(this).find('option:selected').val();
                    console.log("       driver ="+ $(this).find('option:selected').val());
                    drivers_index++;
                });
                drivers_count_data[led_index]={"value" : $(this).val(), "driver_data" : drivers_data};
                
                driver_count_index++;
            });


            power_data[power_index]={"value":power,"led_data":led_data,"driver_count_data": drivers_count_data};
            power_index++;
        });
        data[index]={ dim :dim, power_data :power_data};
       }

       counter++;
       index++;
    });
    /*$('<input>').attr({
            type: 'hidden',
            name: 'basedata[]',
            value: data
        }).appendTo('#_mixer');*/
    return data;
}