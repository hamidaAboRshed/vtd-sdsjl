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


    //call function for mix values
    $.ajax({
        type: 'post',
        async: false,
        url: '../Product/get_product_mixer/',
        data: {'base_data':base_data,'baserole_data':baserole_data, 'BA':BA, 'BAH':BAH, 'BAV':BAV,
             'installation_way':installation_way, 'color_series': color_option,
             'lighting_distribution':distribution, 'family_name':$('[name="ProductFamily[]"]')[0].value,
             'product_type' :$('[name="ProductCatID"]').val()},
         success: function(result){
            var obj=JSON.parse(result);
            $.each(obj, function () {
                var html_code='<tr><td>'+this["Dimension"]+'</td><td>'+this["power"]+'</td><td>'+this['CCT']+
                            '</td><td>'+this['CRI']+'</td><td>'+this['beamAngle']+'</td><td>'+this['lumen']+
                            '</td><td>'+this['InstallationWay']+'</td><td>'+this['Color']+'</td>'+
                            '<td>'+this['Lighting_Distribution']+'</td>'+
                            '<td>'+this['code']+'</td></tr>';
                $('#all_product_option').append(html_code);
            });
         }
     });

}

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
                power_data[power_index]={'power':$(this).find('td:first').html(),'CCT':$(this).find('.cct_value').val(),'CRI':$(this).find('.cri_value').val(),'Lumen':$(this).find('#lumen_value').val()};
                console.log('Power='+$(this).find('td:first').html());
                console.log('CCT='+$(this).find('.cct_value').val());
                console.log('CRI='+$(this).find('.cri_value').val());
                console.log('Lumen='+$(this).find('#lumen_value').val());
                power_index++;
            }
        }); 
        baserole_data[baserole_index]={ dim :dim, power_data :power_data};
        baserole_index++;
     });
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
            var leds=$('select[name="led'+counter+power_id+'[]"]');
            var led_data=new Array($('select[name="led'+counter+power_id+'[]"]').length);
            var led_index=0;
            leds.each(function(){
                led_data[led_index]=$(this).find('option:selected').val();
                console.log("       led ="+ $(this).find('option:selected').val());
                led_index++;
            });
            power_data[power_index]={"value":power,"led_data":led_data};
            power_index++;
        });
        data[index]={ dim :dim, power_data :power_data};
       }

       counter++;
       index++;
    });
    return data;
}