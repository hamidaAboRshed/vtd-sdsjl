$(document).ready(function(){
  $('#product_dimension_table .clickable-row')[0].click();
});

var url='';
String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1).toLowerCase();
}
function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}
$('#product_dimension_table').on('click', '.clickable-row', function(event) {
	/*$(this).addClass('active').siblings().removeClass('active');*/
	var dim="dim_"+this.id;
    var id=this.id;
	//get collection of this dimension
    if($('#product_option'+id+' tbody').html()===""){
	$.ajax({
      async: false,
      type: 'post',
      url: '../get_dimension_collection/'+this.id,
      data: {'id':this.id},
       success: function(result){
          $('#product_option'+id+' tbody').empty(); //remove all child nodes
          var html='';
          var obj=JSON.parse(result);
          url=obj['base_url'];
          $.each(obj['premium_product_collection'], function () {
			var beamanle='';
              
			if(this['SymmetricBeam'] ==1)
			  	  beamanle=this['BeamAngleValue'];
			else{
                if(this['BeamAngleH']!=0 && this['BeamAngleV']!=0)
                    beamanle=this['BeamAngleH']+' x '+ this['BeamAngleV'];
                else if(this['BeamAngleH']!=0)
                    beamanle=this['BeamAngleH'];
                else if(this['BeamAngleV']!=0)
                    beamanle=this['BeamAngleV'];
                
            }
			  	
			 var power= Number(this['Power'])+Number(this['Power_up']);
              
              if(this['CCT'] == null)
                  var CCT = '-';
              else 
                  var CCT = this['CCT'] ;
              
             if(this['CRI'] == null)
                  var CRI = '-';
              else 
                  var CRI = this['CRI'] ;
              
             if(this['Lumen'] == null)
                  var Lumen = '-';
              else 
                  var Lumen = this['Lumen'] ;
              
              if(beamanle == null)
                  beamanle = '-';
//              data-toggle="modal"
			  html += '<tr class="click2" data-toggle="modal" onclick="product_info_popup('+this['ID']+')"  data-target=".animate"  style ="cursor: pointer;">'+
			  		'<td>'+this['product_code']+'</td> '+
				    '<td>'+power+'</td>'+
				    '<td>'+CCT+'</td>'+
				    '<td>'+CRI+'</td>'+
				    '<td>'+this['IP']+'</td>'+
				    '<td>'+beamanle+'</td>'+
				    '<td>'+Lumen+'</td><td>';
				$.each(this['color'], function () {
					html += '<a data-toggle="tooltip" data-placement="right" title="'+this['part'].capitalizeFirstLetter()+' - '+this['color'].capitalizeFirstLetter()+' - '+this['material'].capitalizeFirstLetter()+'"><img hight=30 width=30 style="border-radius: 50%;    border: 1px solid #b7b6b6;" src="'+url+'/upload_files/Texture/'+this['Texture_photo']+'"/> </a>';
				});
			    html += '</td>'+
		    		'</tr>';

          });
           
          $('#product_option'+id+' tbody').html(html);
           $('[data-toggle="tooltip"]').tooltip();  
           }
    });
	if ( $.fn.dataTable.isDataTable('#product_option'+id) ) {

  	}
        
        
        
	$("#product_option"+id).DataTable( {
        "showNEntries" : false,
        "lengthChange": false,
        "ordering": false,
        "responsive": true,
        "pagingType": "numbers",
        "columnDefs": [
        {"className": "dt-center", "targets": [0,1,2,3,4,5,6]}        
      ],
        "language": {
         "info": "This dimension contains _TOTAL_ luminaires",/*_START_ _END_  */
        },

        initComplete: function () {
            this.api().columns([1,2,3,4,5]).every( function () {
                var column = this.column( this, {search: 'applied'});
                $(column.header()).append("<br>")
                var select = $('<select ><option value="">All</option></select>')
                    .appendTo($(column.header()))
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
        
        
}
});
         


function power_filter(elm,dim) {
	var power= $('label[for="'+elm.id+'"]').html();
	power=power.replace(/\D/g,'');
	$('#product_option tbody tr').each(function(){
		t_power=$(this).find('#power').html();
		t_power=t_power.replace(/\D/g,'');
		if(t_power == power && this.id == dim)
			$(this).removeClass('hide');
		else
			$(this).addClass('hide');
	});
}



function product_info_popup(id){
    $.ajax({
      async: false,
      type: 'post',
      url: '../get_collection_info/'+id,
      data: {'id':this.id},
       success: function(result){
            var obj=JSON.parse(result);
            var data ='<ul class="list-group list-group-flush" style="text-align: left;">';
            var data2 ='<ul class="list-group list-group-flush" style="text-align: left;">';
                       if(obj['product_serial'] != null)
                data += '<li class="list-group-item"> <span style="font-weight: 700; font-size: 0.9rem;">Luminaire Number : </span>'+obj['product_serial']+'</li>';/*serial_num*/
            if(obj['product_code'] != null)
                data += '<li class="list-group-item"> <span style="font-weight: 600;font-size: 0.9rem;">Luminaire Model : </span>'+obj['product_code']+'</li>';
           
           
                data += '<li></li></ul>';
           ///////////////////////////////////////////////////////////
           
           if(obj['Shape'] != null)
                data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Shape : </span>'+obj['Shape']+'</li>';
           if(obj['Length'] != null && obj['Length2'] != null)
                data2 +='<li class="list-group-item">  <span style="font-weight: 700;font-size: 0.9rem;">Length : </span>'+obj['Length']+' / '+obj['Length2']+'<span><i> mm</i></span></li>';
           else if(obj['Length'] != null && obj['Length2'] == null)
                data2 += '<li class="list-group-item">  <span style="font-weight: 700;font-size: 0.9rem;">Length : </span>'+obj['Length']+'<span><i> mm</i></span></li>';
           if(obj['Width'] != null)
                data2 +='<li class="list-group-item">  <span style="font-weight: 700;font-size: 0.9rem;">Width : </span>'+obj['Width']+'<span><i> mm</i></span></li>';
           if(obj['Height'] != null && obj['Height'] != 0)
                data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Height : </span>'+obj['Height']+'<span><i> mm</i></span></li>';
           if(obj['Radius'] != null && obj['Radius'] != 0)
                data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Radius : </span>'+obj['Radius']+'<span><i> mm</i></span></li>';
           if(obj['Cut_out'] != null && obj['Cut_out'] != 0)
                data2 +='<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Cut Out : </span>'+obj['Cut_out']+'<span><i> mm</i></span></li>';
           
           if(obj['AdjustableType'] == 'Tilted'){
               if(obj['TiltedVMax'] != null && obj['TiltedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt >Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd></dl></li>';
               else if (obj['TiltedVMax'] != null && obj['TiltedHMax']==null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd></dl></li>';
               else if (obj['TiltedVMax'] == null && obj['TiltedHMax'] != null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd></dl></li>';    
           }

           else if(obj['AdjustableType'] == 'Rotated'){
                if(obj['RotatedVMax'] != null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Rotated Adjustable</dt><dd> Vertical :             '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd><dd>Horizontal : '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
               else if (obj['RotatedVMax'] != null && obj['RotatedHMax']==null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd></dl></li>';  
               else if (obj['RotatedVMax'] == null && obj['RotatedHMax'] != null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd>Horizontal : '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';  
           }

           else if(obj['AdjustableType'] == 'Tilted & Rotated'){
                if (obj['TiltedVMax']!=null && obj['TiltedHMax']!=null && obj['RotatedVMax']!=null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd><dt>Rotated Adjustable</dt><dd> Vertical : '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd><dd>Horizontal :  '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']==null && obj['TiltedHMax']!=null && obj['RotatedVMax']!=null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd><dt>Rotated Adjustable</dt><dd> Vertical : '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd><dd>Horizontal :  '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']!=null && obj['TiltedHMax']==null && obj['RotatedVMax']!=null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dt>Rotated Adjustable</dt><dd> Vertical : '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd><dd>Horizontal :  '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']!=null && obj['TiltedHMax']!=null && obj['RotatedVMax']==null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd><dt>Rotated Adjustable</dt><dd>Horizontal :  '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']!=null && obj['TiltedHMax']!=null && obj['RotatedVMax']!=null && obj['RotatedHMax']==null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd><dt>Rotated Adjustable</dt><dd> Vertical : '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd></dl></li>';
               
               
                else if (obj['TiltedVMax']==null && obj['TiltedHMax']!=null && obj['RotatedVMax']==null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd><dt>Rotated Adjustable</dt><dd>Horizontal :  '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']==null && obj['TiltedHMax']!=null && obj['RotatedVMax']!=null && obj['RotatedHMax']==null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd>Horizontal : '+obj['TiltedHMin']+'/'+obj['TiltedHMax']+'</dd><dt>Rotated Adjustable</dt><dd> Vertical : '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']!=null && obj['TiltedHMax']==null && obj['RotatedVMax']==null && obj['RotatedHMax']!=null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dt>Rotated Adjustable</dt><dd>Horizontal :  '+obj['RotatedHMin']+'/'+obj['RotatedHMax']+'</dd></dl></li>';
                else if (obj['TiltedVMax']!=null && obj['TiltedHMax']==null && obj['RotatedVMax']!=null && obj['RotatedHMax']==null)
                    data2 +='<li class="list-group-item" style="padding-bottom: 0px;font-size: 0.9rem;"><dl><dt>Tilted Adjustable</dt><dd> Vertical :  '+obj['TiltedVMin']+'/'+obj['TiltedVMax']+'</dd><dt>Rotated Adjustable</dt><dd> Vertical : '+obj['RotatedVMin']+'/'+obj['RotatedVMax']+'</dd></dl></li>';  
           }
           
           else if(obj['AdjustableType'] == 'Not Adjustable'){
                    data2 += '<li class="list-group-item"><span style="font-weight: 700;font-size: 0.9rem;">Adjustable : </span>Not Adjustable</li>';
           }


           if(obj['Weight'] != null && obj['Weight'] != 0)
                data2 += '<li class="list-group-item"><span style="font-weight: 700;font-size: 0.9rem;">Weight : </span>'+obj['Weight']+'</li>';

           
           
           
           
           
           
                if(obj['Power_up'] != null && obj['Power_up'] != 0)//W
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Power Up : </span>'+obj['Power_up']+'<span><i> W</i></span></li>';
                if(obj['Power_up'] != null && obj['Power_up'] != 0 && obj['Power'] != null && obj['Power'] != 0)
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Power Down: </span>'+obj['Power']+'<span><i> W</i></span></li>';
                if((obj['Power_up'] == null || obj['Power_up'] == 0) && (obj['Power'] != null && obj['Power'] != 0))
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Power : </span>'+obj['Power']+'<span><i> W</i></span></li>';
                if(obj['CCT'] != null  && obj['CCT'] != 0){
                    if(isNaN(obj['CCT']))
                        data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">CCT : </span>'+obj['CCT']+' <span></span></li>';
                    else 
                        data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">CCT : </span>'+obj['CCT']+' <span><i>K</i></span></li>';        
                }
                    
                if(obj['CRI'] != null && obj['CRI'] != 0)
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">CRI : </span>'+obj['CRI']+'</li>';
                if(obj['Lumen'] != null && obj['Lumen'] != 0)
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Lumen : </span>'+obj['Lumen']+'<span><i> lm</i></span></li>';
                if(obj['Current'] != null && obj['Current'] != 0)
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Current : </span>'+obj['Current']+'<span><i> mA</i></span></li>';
           
              if(obj['Multiple_ip'] == '0')
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">IP : </span>'+obj['IP']+'</li>';
              else if(obj['Multiple_ip'] == '1')
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Front IP : </span>'+obj['Front_ip']+'<br><span style="font-weight: 700;">Back IP : </span>'+obj['Back_ip']+'</li>';
           if(obj['IK'] != null && obj['IK'] != 0){
                if(obj['IK'].toString().length > 1)
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">IK : </span>'+obj['IK']+'</li>';
               else
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">IK : </span>0'+obj['IK']+'</li>';
           }

                if(obj['SymmetricBeam'] == '1')
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Beam Angle :  </span>'+obj['BeamAngleValue']+'°</li>'
               else if(obj['SymmetricBeam'] == '0'){
                   
                   if(obj['BeamAngleH']!= 0 && obj['BeamAngleV']!= 0)
                        data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Beam Angle Horizontal : </span>'+obj['BeamAngleH']+'°<br><span style="font-weight: 700;font-size: 0.9rem;">Beam Angle Vertical : </span>'+obj['BeamAngleV']+'°</li>';
                   else if(obj['BeamAngleH']!= 0)
                        data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Beam Angle Horizontal : </span>'+obj['BeamAngleH']+'°';
                    else if(obj['BeamAngleV']!= 0)
                        data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Beam Angle Vertical : </span>'+obj['BeamAngleV']+'°';
               }

           
                if(obj['LifeSpan'] != null && obj['LifeSpan'] != 0)//Hours
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">LifeSpan : </span>'+obj['LifeSpan']+'<span><i> Hours</i></span></li>';
                if(obj['Warranty'] != null && obj['Warranty'] != 0)//Years
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">Warranty : </span>'+obj['Warranty']+'<span><i> Years</i></span></li>';         
                
                if(obj['UGRRate'] != null && obj['UGRRate'] != 0)
                    data2 += '<li class="list-group-item"> <span style="font-weight: 700;font-size: 0.9rem;">UGRRate : </span>'+obj['UGRRate']+'</li>';
           
                      
           if(obj['color'] != null){
              data2 += '<li class="list-group-item" style="padding-bottom: 0px;"><dl><dt style="padding-bottom: 6px; font-size: 0.9rem;">Color</dt>';
              $.each(obj['color'], function () {
					data2 +='<dd><img hight=20 width=20 style="border-radius: 50%;  border: 1px solid #b7b6b6; padding-bottom:0px !important;" src="'+url+'/upload_files/Texture/'+this['Texture_photo']+'"/><span> '+this['part'].capitalizeFirstLetter()+' - '+this['color'].capitalizeFirstLetter()+' - '+this['material'].capitalizeFirstLetter()+'</span></dd>';
				});
              data2 += '</dl></li>';   
          }
           
            if(obj['lighting_distributor'] != null && obj['lighting_distributor'] != 0){
              data2 += '<li class="list-group-item" style="padding-bottom: 0px;"><dl><dt style="padding-bottom: 6px; font-size: 0.9rem;">Lighting Distributor</dt>';
              $.each(obj['lighting_distributor'], function () {
					data2 +='<dd><img hight=20 width=20 style="border-radius: 50%;    border: 1px solid #b7b6b6;" src="'+url+'/upload_files/Texture/'+this['Texture_photo']+'"/><span>                             '+this['kind'].capitalizeFirstLetter()+' - '+this['color'].capitalizeFirstLetter()+' - '+this['material'].capitalizeFirstLetter()+'</span></dd>';
				});
              data2 += '</dl></li>';   
          }
           
           data2 += '</ul>';
     
           var data3='<div class="row">';
           $.each(obj['accessories'], function () {
               data3+= '<div class="col-md-6">'+
                        '<div class="product-container-2">'+
                        '<div class="product-image-2">'+
                        '<img class="img-responsive" src="'+url+'/upload_files/Accessory/'+(this['Photo']==null ? (this['photos'].length == 0 ? 'accessory_default.png' : this['photos'][0]['photo']) :this['Photo'])+'"></div>'+
                
                        '<div class="product-description-2">'+
                            '<h6 style="margin-bottom: 0rem;">'+this['Code']+'</h6>'+
                            '<p style="font-size:medium;">'+this['Name']+'</p></div></div></div>';
           });
           if (data3 == '<div class="row">')
               data3+='<p style="padding-top: 20px; margin: auto;  padding-left: 23px;">No available accessories for this product</p>';
            data3+='</div>';
           
           var Driver_datasheet_unique = null;

           if(obj['Driver_datasheet']!=null)
                var Driver_datasheet_unique = obj['Driver_datasheet'].filter( onlyUnique );
           var data4 = '<div class="list-group"><ul class="list-group list-group-flush" style="text-align: left;">';
           
           data4 += '<li class="list-group-item"><a style="font-weight: 700;font-size: 0.9rem;" href="../premium_datasheet_view/'+obj['collection_id']+'" target="_blank"> <i class="fa fa-download" aria-hidden="true" style="padding-right:10px; color:#DBAE27;"></i>Product Datasheet<span style="color: rgba(0,0,0,0.6); padding-left: 7px;">/ PDF</span> </a></li>';
           /*data4 += '<li class="list-group-item"><a style="font-weight: 700;font-size: 1vw;" href="'+url+'index.php/Product/premium_datasheet_view2/'+obj['collection_id']+'" target="_blank"> <i class="fa fa-download" aria-hidden="true" style="padding-right:10px; color:#DBAE27;"></i>Product Datasheet 2<span style="color: rgba(0,0,0,0.6); padding-left: 7px;">/ PDF</span> </a></li>';*/
          if(obj['LED_datasheet'] != null)
           data4+='<li class="list-group-item"><a style="font-weight: 700;font-size: 0.9rem;" href="'+url+'/upload_files/Datasheet/Led/'+obj['LED_datasheet']+'" target="_blank"> <i class="fa fa-download" aria-hidden="true" style="padding-right:10px; color:#DBAE27;"></i>LED Datasheet<span style="color: rgba(0,0,0,0.6); padding-left: 7px;">/ PDF</span> </a></li>';
            
           if(Driver_datasheet_unique != null){
                          var c = 1;
           if(Driver_datasheet_unique.length <= 1){
                if(Driver_datasheet_unique[0]!= null && (Driver_datasheet_unique[0].includes('.PDF') || Driver_datasheet_unique[0].includes('.pdf')))
                data4+='<li class="list-group-item"><a style="font-weight: 700;font-size: 0.9rem;" href="'+url+'/upload_files/Datasheet/Driver/'+Driver_datasheet_unique[0]+'" target="_blank"><i class="fa fa-download" aria-hidden="true" style="padding-right:10px; color:#DBAE27;"></i>Driver Datasheet<span style="color: rgba(0,0,0,0.6); padding-left: 7px;">/ PDF</span> </a></li>';
           }

           else{
                $.each(Driver_datasheet_unique, function () {
               if(this != null && (this.includes('.PDF') || this.includes('.pdf')))
                   {
                    data4+='<li class="list-group-item"><a style="font-weight: 700;font-size: 0.9rem;" href="'+url+'/upload_files/Datasheet/Driver/'+this+'" target="_blank"><i class="fa fa-download" aria-hidden="true" style="padding-right:10px; color:#DBAE27;"></i> Driver Datasheet '+c+'<span style="color: rgba(0,0,0,0.6); padding-left: 7px;">/ PDF</span> </a></li>';
                    c+=1;  
                   }
                      });
           }

           }
           var product_id = $('#product_id').val();

                if(obj['attach_files'] != null){
                $.each(obj['attach_files'], function () {
                    data4+='<li class="list-group-item"><a style="font-weight: 700;font-size: 0.9rem;" href="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'"><i class="fa fa-download" aria-hidden="true" style="padding-right:10px; color:#DBAE27;"></i>'+this['file_type']+'</a></li>';
                      });
           }

           
           
           
           
           

           
           data4+='</ul></div>';
    
           $('#product_info').html(data);
//           document.getElementById("demo").innerHTML = "Paragraph changed!";
           $('#product_info_2').html(data2);
           $('#product_info_3').html(data3);
           $('#product_info_4').html(data4);
           
           
           /////////////
           
         var html_content = '<div class="content">';
         var html_thumbail = '<div class="thumbnail" >';
         var index = 0;
			 //color photo
         if (obj['color_series_photo']!= null) {
            html_content +=  '<a class="example-image-link image_'+index+'" href="'+url+'/upload_files/Product/Premium/'+product_id+'/'+obj['color_series_photo']+'" data-lightbox="example-set'+index+'" data-title="product photo"  style="display: none;">'+
              '<img style="width:100% !important" class="example-image " src="'+url+'/upload_files/Product/Premium/'+product_id+'/'+obj['color_series_photo']+'" alt="" />'+
              '</a>';
            html_thumbail += '<div class="thumb">'+
                    '<a href="#" rel="1">'+
                      '<img width="300" src="'+url+'/upload_files/Product/Premium/'+product_id+'/'+obj['color_series_photo']+'" id="thumb_'+index+'" alt="" />'+
                    '</a></div>';
            index++;
         }
         else{
          $.each(obj['product_photo'], function (key, value) {
              html_content +=  '<a class="example-image-link image_'+index+'" href="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'" data-lightbox="example-set'+index+'" data-title="product photo"  style="display: none;">'+
                '<img class="example-image " style="width:100% !important" src="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'" alt="" />'+
              '</a>';
        html_thumbail += '<div class="thumb" >'+
                          '<a href="#" rel="1" >'+
                            '<img src="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'" id="thumb_'+index+'" alt="" />'+
                          '</a></div>';
                index++;

          });
      
         }

			$.each(obj['Dim_photo'], function (key, value) {
             	html_content +=  '<a class="example-image-link image_'+index+'" href="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'" data-lightbox="example-set'+index+'" data-title="dimension photo"  style="display: none;">'+
							'<img style="width:100% !important" class="example-image " src="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'" alt="" />'+
							'</a>';
				html_thumbail += '<div class="thumb">'+
				                    '<a href="#" rel="1">'+
			                        '<img width="300" src="'+url+'/upload_files/Product/Premium/'+product_id+'/'+this['FileName']+'" id="thumb_'+index+'" alt="" />'+
				                    '</a></div>';
                index++;
          });
			html_content += '</div><div class="clear"></div>'
			html_thumbail +='</div>';
			
	         $('#gallery').html(html_content+html_thumbail);  
          
          $('#gallery').simplegallery({
		        galltime : 400,
		        gallcontent: '.content',
		        gallthumbnail: '.thumbnail',
		        gallthumb: '.thumb'
		    });     
            $('.thumbnail a')[0].click();   			
				
         
       
    } 
         
    });
    $('#product_info_2').removeClass("show");
    $('#product_info_2').removeClass("active");
    $('#product_info_2_tab').removeClass("active");
    
    $('#product_info_3').removeClass("show");
    $('#product_info_3').removeClass("active");
    $('#product_info_3_tab').removeClass("active");
    
    $('#product_info_4').removeClass("show");
    $('#product_info_4').removeClass("active");
    $('#product_info_4_tab').removeClass("active");
    
    $('#product_info_0').addClass("show");
    $('#product_info_0').addClass("active");
    $('#product_info_0_tab').addClass("active");
}




