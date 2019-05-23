
  $(document).ready(function(){ debugger;
  	//select2
    $(".js-example-tokenizer").select2({
      tags: true,
   
	 });

	 $('.js-example-tokenizer').on('change', function() {
		  select2value=$(".js-example-tokenizer").select2("val");//alert(select2value);
		  $("#select2-value").val(select2value);
    })
	 

    $("#AddParagraph").click(function(){ 
      var row_count=$("#rowcount").val(); 
      var x = row_count;x++;
      row_count++;


      $("#rowcount").val(row_count);
     // alert(row_count);
      cell='<div class="row" id="row_'+row_count+'"> <i class="fa fa-minus-circle" aria-hidden="true" onclick=\'delete_par("#row_'+row_count+'");\'></i>';

	      cell+='<div class="col-xs-12"><div class="head-para "><i class="fa fa-chevron-down" data-toggle="collapse" data-target="#collaps_para'+row_count+'" ></i>Paragraph #<input class="col-xs-9 flaot-non " type="number" name="OrderNumber_'+row_count+'" value="'+x+'" min="1"/></div></div>';

	      cell+='<div class="row par-content collapse" id="collaps_para'+row_count+'"><div class="col-xs-6"><div class="form-group "><input type="text" name="titlePar_'+row_count+'" class="form-control" placeholder="Title" required /></div></div>';

	      cell+='<div class="col-xs-6"><div class="form-group "><input type="file" name="ImagePar_'+row_count+'" class="form-control" onchange=\'readURLImage(this,"#blah_par'+row_count+'");\'/></div></div>';

	      cell+='<div class="col-xs-12"><div class="form-group "><textarea type="text" name="textPar_'+row_count+'" class="form-control " rows="5"></textarea></div></div>';

	      cell+='<div class="col-xs-6 text-center"><img class="img-shadow" id="blah_par'+row_count+'" src="'+window.base_url+'/assets/images/blog/image-them.png" alt="your image"  width="380" /></div>';

	      cell+='<div class="col-xs-6"><div class="col-xs-6 text-center  padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems1.png"/><br>Them 1 <input type="radio" name="themPar_'+row_count+'" value="1" /></div><div class="col-xs-6 text-center padding-6"><img src="'+window.base_url+'/assets/images/blog/them/thems2.png"/><br>Them 2 <input type="radio" name="themPar_'+row_count+'" value="2"/></div><div class="col-xs-6 text-center padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems3.png"/><br>Them 3 <input type="radio" name="themPar_'+row_count+'" value="3" checked/></div><div class="col-xs-6 text-center padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems4.png"/><br>Them 4 <input type="radio" name="themPar_'+row_count+'" value="4"/></div></div>';

	      cell+='<div class="col-xs-12"><a id="AddSubParagraph'+x+'" style=" text-decoration: underline!important;color: #090988;">Add Sub Paragraph</a><div class="col-xs-12 Subparagraph'+x+'"><input type="hidden" name="rowcount_sub'+x+'" id="rowcount_sub'+x+'"  value="0" /></div></div></div>';

     cell+='</div>';
     
	  $( ".paragraph" ).append(cell);
	   CKEDITOR.replace( "textPar_"+row_count ,{language: 'en'});


        //end append paragraph 


      //apend sub Paragraph cell

       $("#AddSubParagraph"+row_count).click(function(){ 
       	var rowcount_sub=$("#rowcount_sub"+row_count).val();
       	var y = rowcount_sub;y++;
              rowcount_sub++;

      $("#rowcount_sub"+row_count).val(rowcount_sub);


      cell2='<div class="body-sub-par row row_sub'+row_count+rowcount_sub+'" id="row_sub_'+row_count+rowcount_sub+'">';

      cell2+='<div class="head-sub row"><i class="fa fa-minus-circle" aria-hidden="true" onclick=\'delete_par("#row_sub_'+row_count+rowcount_sub+'");\'></i><div class="col-xs-12"><div class="head-para">Sub Paragraph #<input class="col-xs-6 flaot-non-sub" type="number" name="SubOrderNumber_'+row_count+rowcount_sub+'" value="'+y+'" min="1"/></div></div></div>';
      cell2+='<div class="info-sub" ><div class="row"><div class="col-xs-6"><div class="form-group "><input type="text" name="titleSubPar_'+row_count+rowcount_sub+'" class="form-control" placeholder="Title" required/></div></div>';

      cell2+='<div class="col-xs-6"><div class="form-group "><input type="file" name="ImageSubPar_'+row_count+rowcount_sub+'" class="form-control" onchange=\'readURLImage(this,"#blah_parSub'+row_count+rowcount_sub+'");\'/></div></div></div>';
      cell2+='<div class="row"><div class="col-xs-12"><div class="form-group "><textarea type="text" name="textSubPar_'+row_count+rowcount_sub+'" class="form-control"></textarea></div></div></div>';

      cell2+='<div class="row"><div class="col-xs-6"><div class="col-xs-6 text-center  padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems1.png"/></br>Them 1 <input type="radio" name="themSubPar_'+row_count+rowcount_sub+'" value="1"/></div><div class="col-xs-6 text-center  padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems2.png"/></br>Them 2 <input type="radio" name="themSubPar_'+row_count+rowcount_sub+'" value="2"/></div><div class="col-xs-6 text-center  padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems3.png"/></br>Them 3 <input type="radio" name="themSubPar_'+row_count+rowcount_sub+'" value="3" checked/></div><div class="col-xs-6 text-center  padding-6 "><img src="'+window.base_url+'/assets/images/blog/them/thems4.png" /></br>Them 4 <input type="radio" name="themSubPar_'+row_count+rowcount_sub+'" value="4"/></div></div>';

      cell2+='<div class="col-xs-6 text-center"><img class="img-shadow" id="blah_parSub'+row_count+rowcount_sub+'" src="'+window.base_url+'/assets/images/blog/image-them.png" alt="your image" width="380" /></div></div></div>';

      cell2+='</div>';

			$( ".Subparagraph"+row_count ).append(cell2);


			    CKEDITOR.replace( "textSubPar_"+row_count+rowcount_sub,{language: 'en'} );


       	});//end function Sub Paragrah 


    });//end function for Paragraph 



  });//end document ready
  


         
        $("textarea").each(function(){
		    CKEDITOR.replace( this ,{language: 'en'});

		  });

 
    function readURLImage(input,num) { 
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $(num).attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }



	function delete_par(ele) { //delete paragraph or sub 
    debugger;
	$(ele).remove();
	}


  function delete_exists_par(ele,id)
  {
    debugger;
    $.ajax({

      url: '../delete_paragraph/'+ id,

      dataType: 'json',
    
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