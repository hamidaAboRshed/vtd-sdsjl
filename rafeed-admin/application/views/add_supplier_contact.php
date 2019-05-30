<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style_article.css">

<link href="<?php echo base_url();?>assets/select2/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/select2/select2.min.js"></script>

<style type="text/css">

	.line-title{
		margin: 0;
	    padding: 1.8%;
	    border-bottom: 1px solid #455a64;
	    left: -26px;
	}
	.padding-right-14px
	{
		padding-right: 14px;
	}
	.contact-box
	{
	    border: 1px solid #777777a8;
	    padding-top: 11px;
	    padding-bottom: 12px;
	    background: #dddddd63;
	    margin: 0% 1.2% 5% 0%;
	}
	.contact-details{
	    margin-top: 30px;
	    margin-bottom: 5px;

	}
	.action-box
	{
	    width: 2%;
	    border: 1px solid #777777a8;
	    padding: 13px 2px;
		left: 9px;
	    background: #ccc;
	    top: 10px;
	    border-radius: 34%;
	}
	.width-48
	{
		width: 48%;
	}
	.select2-container--default .select2-selection--single {
	    height: 33px;
	    background-color: #fff;
	    border: 1px solid #cccccc82;
	    border-radius: 0;
	}
	.form-check
	{
	    margin: 0;
	    text-align: left;
	    top: 25px;
	    padding: 0;
	    left: 14px;
	}
	.width-19
	{
		    width: 19%;
	}
	.width-81
	{
		width: 81%;
	}
	.contact-box .form-control {
		 height: 33px;
	}

</style>

<?php if(isset($id_sup_con)) { ?>
 <?php echo form_open_multipart('Supplier/update_supplier_contact',$attributes=array('id'=>'createForm'));?> 
<?php  } else { ?>
 <?php echo form_open_multipart('Supplier/create_supplier_contact',$attributes=array('id'=>'createForm'));?> 
<?php } ?>


 
<div  id="row">
    <div class="card">
        <div class="card-body">

		<div class="row">
		    <div class="col-xs-3  form-group">
		    	<h3>Personal Information</h3>
				      
			</div>

			    <div class="col-xs-9  line-title"></div>

		</div>

		<div class="row padding-right-14px">
		  	<div class="col-xs-6">
		  		<label> Full Name</label>	
		  		<div class="form-group ">					  
				   <input type="text" name="FullName" class="form-control" id="FullName" required value="<?php if(isset($id_sup_con)) { echo $contact_details[0]['FullName'] ; } ?>" />
				</div>
		  	</div>

			<div class="col-xs-6">
				<label> Company Name</label>	
				<div class="form-group ">				  
				<input type="text"   class="form-control" value="<?php echo $supplier['Name'] ?>" readonly style="border-color: #878787;" />
				<input type="hidden" name="SupplierID" value="<?php echo $supplier['ID'] ?>"  />
				</div>
			</div>
		</div>

		<div class="row padding-right-14px">
		  	<div class="col-xs-12 ">
		  		<label> Note</label>
		  		<textarea name="Note"   class="form-control" id="Note" rows="5"><?php if(isset($id_sup_con)) { echo $contact_details[0]['Note'] ; } ?></textarea>
			</div>
		</div>

		<div class="row contact-details">
		    <div class="col-xs-3 form-group width-19">
		    	<h3>Contact Details</h3>
			</div>
			<div class="col-xs-9 line-title width-81"></div>
		</div>


		<?php if(isset($id_sup_con)) { ?>

		<input type="hidden" name="id_sup_con"   value="<?php echo $id_sup_con;?>"	 />
		<?php foreach ($contact_details as $con => $value) { ?>
			<input type="hidden" name="id_sup_con_det<?php echo $con;?>"   value="<?php echo $value['id_sup_con_det']?>" />

				<div class="row contact-box" id="edit_con<?php echo $con;?>" >
				    <div class="col-xs-4 form-group" >
				    	<label>Type</label></br>
				  		<select class="form-control js-example-tags" name="edit_type_<?php echo $con;?>">
				  			<?php for ($i=0; $i <count($supp_cont_type); $i++) { ?>
				  				<option <?php if ($supp_cont_type[$i]->ContactType==$value['ContactType'])  { echo 'selected="selected"';} ?> > <?php echo $supp_cont_type[$i]->ContactType; ?> </option>

				  			<?php } ?>
				  	
						</select>			      
					</div>

				    <div class="col-xs-5 form-group width-48">
				    	<label>Value</label>
				  		<input type="text" class="form-control" name="edit_value_<?php echo $con;?>"  value="<?php echo $value['ContactText'] ?>" />			      
					</div>

					  <div class="col-xs-2 form-check">
					    <input type="checkbox" class="form-check-input" name="edit_active_check_<?php echo $con;?>" <?php if($value['Active']==1) echo 'checked';  ?> value="1" >
					    <label class="form-check-label" for="exampleCheck1">Active</label>
					  </div>

					<div  class="col-xs-1 action-box" > <?php if ($con==0) { ?> 
						<i class="fa fa-plus-circle"  id="add_cont"></i> 
						<?php } else { ?> <i class="fa fa-trash"  onclick="delete_exists_con('#edit_con<?php echo $con;?>',<?php echo $value['id_sup_con_det'];?> ) "></i>
						<?php } ?><br>
					 </div>

			   </div>
			<input type="hidden" name="edit_rowcount"   value="<?php echo $con ;?>"	 />

		<?php } ?>

			<input type="hidden" name="rowcount" id="rowcount"  value="1"	 />
			<div class="new-conn"></div>

	<?php }

	else { ?>
		<div class="row contact-box" >
		    <div class="col-xs-4 form-group" >
		    	<label>Type</label></br>
		  		<select class="form-control js-example-tags" name="type_1">
		  			<?php for ($i=0; $i <count($supp_cont_type); $i++) { ?>
		  				<option <?php if ($supp_cont_type[$i]->ContactType=="Phone")  { echo 'selected="selected"';} ?> > <?php echo $supp_cont_type[$i]->ContactType; ?> </option>

		  			<?php } ?>
		  	
				</select>			      
			</div>

		    <div class="col-xs-5 form-group width-48">
		    	<label>Value</label>
		  		<input type="text" class="form-control" name="value_1"   />			      
			</div>

			  <div class="col-xs-2 form-check">
			    <input type="checkbox" class="form-check-input" name="active_check_1" value="1" checked>
			    <label class="form-check-label" for="exampleCheck1">Active</label>
			  </div>

			<div  class="col-xs-1 action-box" ><i class="fa fa-plus-circle"  id="add_cont"></i><br> </div>

		</div>


		<div class="row contact-box" id="con1">
		    <div class="col-xs-4 form-group">
				<label>Type</label></br>    	
		  		<select class="form-control js-example-tags" name="type_2">
		  			<?php for ($i=0; $i <count($supp_cont_type); $i++) { ?>
		  				<option <?php if ($supp_cont_type[$i]->ContactType=="Email") { echo 'selected="selected"';} ?> > <?php echo $supp_cont_type[$i]->ContactType; ?> </option>

		  			<?php } ?>
		  	
				</select>		      
			</div>

		    <div class="col-xs-5 form-group width-48">
		    	<label>Value</label>
		  		<input type="text" class="form-control" name="value_2" />			      
			</div>

			<div class="col-xs-2 form-check">
			   <input type="checkbox" class="form-check-input" name="active_check_2" value="1" checked>
			   <label class="form-check-label" for="exampleCheck1">Active</label>
			</div>

			<div  class="col-xs-1 action-box" ><i class="fa fa-trash" onclick="delete_con('#con1')"></i><br></i> </div>

	    </div>



		<div class="row contact-box" id="con2">

		    <div class="col-xs-4 form-group">
		    	<label>Type</label></br>
		  		<select class="form-control js-example-tags" name="type_3">
		  			<?php for ($i=0; $i <count($supp_cont_type); $i++) { ?>
		  				<option <?php if ($supp_cont_type[$i]->ContactType=="QQ") { echo 'selected="selected"';} ?> > <?php echo $supp_cont_type[$i]->ContactType; ?> </option>

		  			<?php } ?>
		  	
				</select>			      
			</div>

		    <div class="col-xs-5 form-group width-48">
		    	<label>Value</label>
		  		<input type="text" class="form-control" name="value_3" />			      
			</div>

			  <div class="col-xs-2 form-check">
			    <input type="checkbox" class="form-check-input" name="active_check_3" value="1" checked>
			    <label class="form-check-label" for="exampleCheck1" >Active</label>
			  </div>

			<div  class="col-xs-1 action-box" ><i class="fa fa-trash" onclick="delete_con('#con2')"></i><br> </div>

		</div>
		<input type="hidden" name="rowcount" id="rowcount"  value="3"	 />

		<div class="new-conn"></div>

	<?php } ?>

	   <div class="modal-footer">
			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-success","id"=>"submit","form"=>"createForm"));?>
	   </div>
		</div>
	</div>
</div> 
 

 <?php echo form_close()?>
 <script type="text/javascript">
 	

 $(document).ready(function()
 {

//select2
    $(".js-example-tags").select2({
      tags: true
  	});

//append new countact 
    $("#add_cont").click(function()
      {      

	  	var row_count=$("#rowcount").val(); 
	    row_count++;

	  	$("#rowcount").val(row_count);
      
        cell='<div class="row contact-box" id="con'+row_count+'" >';

          cell+='<div class="col-xs-4 form-group"><label>Type</label></br><select class="form-control js-example-tags" name="type_'+row_count+'"><?php for ($i=0; $i <count($supp_cont_type); $i++) { ?><option> <?php echo $supp_cont_type[$i]->ContactType; ?> </option><?php } ?></select></div>';

          cell+='<div class="col-xs-5 form-group width-48"><label>Value</label><input type="text" class="form-control" name="value_'+row_count+'" /></div>';

          cell+='<div class="col-xs-2 form-check"><input type="checkbox" class="form-check-input"  name="active_check_'+row_count+'" value="1" checked ><label class="form-check-label" for="exampleCheck1">Active</label></div>';

          cell+='<div  class="col-xs-1 action-box" ><i class="fa fa-trash" onclick=\'delete_con("#con'+row_count+'");\'></i><br></div>';
         
        cell+='</div>';


        $( ".new-conn" ).append(cell);

          $(".js-example-tags").select2({
          	tags: true
     	 });

    });//end function for conatct 

  });//end document ready

 
 </script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_supplier.js"></script>




		  			
