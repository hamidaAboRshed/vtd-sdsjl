<div  id="row">
    <div class="card">
        <div class="card-body">
<div class="accessory-messages"></div>

<!--from hamida -->
<a class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addAccessoryMadal" onclick="addAccessoryMemberModel()">Add 
</a>
		
<br /> <br />

<table width="100%" class="display nowrap table table-hover table-striped table-bordered" id="AccessoryManageMemberTable">
	<thead>
		<tr>
			<th>Photo</th>
			<th>Code</th>
			<th>Code/ Supplier</th>
			<?php foreach ($Language as $rec) {?>
			<th>Description / <?php echo $rec['Name']?></th><?php }?>
			<th>Type</th>
			<th>Series</th>
			<th>Supplier</th>
			<th>Price</th>
			<th>Options</th>	
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Photo</th>
			<th>Code</th>
			<th>Code/ Supplier</th>
			<?php foreach ($Language as $rec)   {?>
			<th>Description / <?php echo $rec['Name']?></th><?php }?>
			<th>Type</th>
			<th>Series</th>
			<th>Supplier</th>
			<th>Price</th>
			<th>Options</th>	
		</tr>
	</tfoot>
</table>

<div class="modal fade" role="dialog" id="addAccessoryMadal">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Accessory</h4>
  </div>

  <?php echo form_open_multipart('Accessory/create_accessory',$attributes=array('id'=>'createAccessoryForm'));?>
  <div class="modal-body">  
      <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group">
			   	<?php echo form_label('Supplier Code','AccessoryCode',$attributes=array());?>
			   	<?php echo form_input('AccessoryCode', set_value('AccessoryCode'),$attributes = array('class' =>"form-control","id"=>"AccessoryCode","name"=>"AccessoryCode"));?>
		   </div>
	  	</div>
  		<div class="col-xs-6">
			<div class="form-group">
			   	<?php echo form_label('Price','price',$attributes=array());?>
			   	<?php echo form_input('price', set_value('price'),$attributes = array('class' =>"form-control","id"=>"price","name"=>"price"));?>
		   </div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
			<div class="form-group">
				<?php echo form_label('Type','AccessoryType',$attributes=array());?><br>
				<select data-placeholder="Select" class="form-control"  id="AccessoryType" name="AccessoryType">
					<?php foreach ($AccessoryType as $key => $value) : ?>
						<?php echo '<option value="'.$value.'">'.$key.'</option>'?>
					<?php endforeach; ?>
				</select> 
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6">
  			<div class="form-group">
			   	<?php echo form_label('Supplier','accessory_supplier',$attributes=array());?><br>
			   	<select data-placeholder="Select" class="form-control chosen-select"  id="accessory_supplier" name="accessory_supplierID">
			   		<?php foreach ($Supplier as $rec) : ?>
		              	<?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
		          	<?php endforeach; ?>
			   	</select>
		   </div>
		</div>
		<div class="col-xs-6">
			<div class="form-group">
				<label style="display: -webkit-box;"><p class="form_title">Series</p><span class="text-danger">*</span></label>
                <?php foreach ($series as $val) {?>
                    <div class="col ">
                        <span class="radio-wrapper"> 
                            <input type="radio" name="series" id="series<?php echo($val['ID'])?>" value="<?php echo($val['ID'])?>">
                            <div>
                                
                            </div> 
                        </span> 
                        <span class="table-cell"> 
                            <label for="series<?php echo($val['ID'])?>"> <?php echo $val['Name']?> </label> 
                        </span> 
                    </div>
                <?php } ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 question-main form-group">
            <!-- <p class="form_title">Family name<span class="text-danger">*</span></p> -->
            <ul class="nav nav-tabs" role="tablist">
                <?php $home_active='active';
                foreach ($Language as $rec) : ?>
                <li class="nav-item <?php echo($home_active);?>"> 
                    <a class="nav-link " data-toggle="tab" href="#<?php echo $rec['Name']?>_fitting" role="tab">
                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
                        <span class="hidden-xs-down"><?php echo $rec['Name']?></span>
                    </a> 
                </li>
                <?php $home_active='';?>
                <?php endforeach; ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content  tabcontent-border">
                <?php $home_active='active';
                foreach ($Language as $rec) : ?>
                <div class="tab-pane <?php echo($home_active);?>" id="<?php echo $rec['Name']?>_fitting" role="tabpanel"  style="min-height: 24vh;">
                    <div class="p-20" style="display: inline-grid;">
                        <input type="hidden" name="accessory_Language_id[]" value="<?php echo $rec['ID']?>"/>
                        <?php echo form_label('Description','accessory_description_'.$rec['ID'],$attributes=array());?>
  						<textarea class="form-control" rows="4" cols="40" id="accessory_description_<?php echo $rec['ID']?>" name="accessory_description[]"></textarea>
                    </div>
                </div>
                <?php $home_active='';?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-xs-6 question-main form-group">
        	<label for="accessory_photo">Upload photo</label>
			<!--<div id="accessory_product_photo" style="background-image: url('<?php echo base_url();?>/assets/images/8.png');" ></div>-->
			<input type="file" name="upload_photo[]" multiple /> <!-- onchange="readURL(this);"/>-->
	  	</div>
	   </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<div class="modal fade" role="dialog" id="editAccessoryMemberModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Accessory</h4>
      </div>
      <?php echo form_open('Accessory/edit',$attributes=array('id'=>'editAccessoryForm','method'=>'post'));?>
      <div class="modal-body">        
		 <div class="row">
		  	<div class="col-xs-6">
		  		<div class="form-group">
				   	<?php echo form_label('Code','editAccessoryCode',$attributes=array());?>
				   	<?php echo form_input('editAccessoryCode', set_value('editAccessoryCode'),$attributes = array('class' =>"form-control","id"=>"editAccessoryCode"));?>
			   </div>
		  	</div>

	  		<div class="col-xs-6">
				<div class="form-group">
				   	<?php echo form_label('Price','editprice',$attributes=array());?>
				   	<?php echo form_input('editprice', set_value('editprice'),$attributes = array('class' =>"form-control","id"=>"editprice","name"=>"editprice"));?>
			   </div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
				<?php echo form_label('Type','editAccessoryType',$attributes=array());?><br>
					   	<select data-placeholder="Select" class="form-control"  id="editAccessoryType" name="editAccessoryType_ID" value="<?php echo set_value('editAccessoryType')?>">
						<?php foreach ($AccessoryType as $key => $value) : ?>
							<?php echo '<option value="'.$value.'">'.$key.'</option>'?>
						<?php endforeach; ?>
					</select> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
	  			<div class="form-group">
				   	<?php echo form_label('Supplier','editAccessory_supplier',$attributes=array());?><br>
				   	<select data-placeholder="Select" class="form-control chosen-select"  id="editAccessory_supplier" name="editAccessory_supplierID">
				   		<?php foreach ($Supplier as $rec) : ?>
			              	<?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
			          	<?php endforeach; ?>
				   	</select>
			   </div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
				<label style="display: -webkit-box;"><p class="form_title">Series</p><span class="text-danger">*</span></label>
                <?php foreach ($series as $val) {?>
                    <div class="col ">
                        <span class="radio-wrapper"> 
                            <input type="radio" name="edit_series" id="edit_series<?php echo($val['ID'])?>" value="<?php echo($val['ID'])?>">
                            <div>
                                
                            </div> 
                        </span> 
                        <span class="table-cell"> 
                            <label for="edit_series<?php echo($val['ID'])?>"> <?php echo $val['Name']?> </label> 
                        </span> 
                    </div>
                <?php } ?>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 question-main form-group">
	            <!-- <p class="form_title">Family name<span class="text-danger">*</span></p> -->
	            <ul class="nav nav-tabs" role="tablist">
	                <?php $home_active='active';
	                foreach ($Language as $rec) : ?>
	                <li class="nav-item <?php echo($home_active);?>"> 
	                    <a class="nav-link " data-toggle="tab" href="#<?php echo $rec['Name']?>_edit_accessory" role="tab">
	                        <span class="hidden-sm-up"><i class="ti-home"></i></span> 
	                        <span class="hidden-xs-down"><?php echo $rec['Name']?></span>
	                    </a> 
	                </li>
	                <?php $home_active='';?>
	                <?php endforeach; ?>
	            </ul>
	            <!-- Tab panes -->
	            <div class="tab-content  tabcontent-border">
	                <?php $home_active='active';
	                foreach ($Language as $rec) : ?>
	                <div class="tab-pane <?php echo($home_active);?>" id="<?php echo $rec['Name']?>_edit_accessory" role="tabpanel"  style="min-height: 24vh;">
	                    <div class="p-20" style="display: inline-grid;">
	                        <input type="hidden" name="editAccessory_Language_id[]" value="<?php echo $rec['ID']?>"/>
	                        <?php echo form_label('Description','editAccessory_description_'.$rec['ID'],$attributes=array());?>
	  						<textarea class="form-control" rows="4" cols="40" id="editAccessory_description_<?php echo $rec['ID']?>" name="editAccessory_description[]"></textarea>
	                    </div>
	                </div>
	                <?php $home_active='';?>
	                <?php endforeach; ?>
	            </div>
	        </div>
	        <div class="col-xs-6 question-main form-group">
	        	<!-- <label for="accessory_photo">Upload photo</label>
				<div id="accessory_product_photo" style="background-image: url('<?php echo base_url();?>assets/images/4.jpg');" ></div>
				<input type="file" name="editUpload_photo" onchange="readURL(this);"/> -->
		  	</div>
			
		  </div>
	   </div>
	   
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- /edit mmebers -->


<!-- changeImageMemberModal -->

<div class="modal fade" role="dialog" id="changeImageMemberModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">change accessory image</h4>
      </div>
      <?php echo form_open_multipart('Accessory/change_image',$attributes=array('id'=>'changeAccessoryImageForm','method'=>'post'));?>
      <div class="modal-body">        
		 <div class="row">
      	<div class="col-xs-6">
      		<div class="form-group ">
			   	<?php echo form_label('Accessory photo','change_accessory_photo',$attributes=array());
			   		echo "<input type='file' name='change_accessory_photo[]' id='change_accessory_photo' class='form-control' multiple />";
			   		//form_input("datasheet_file",set_value('datasheet_file'),$attributes=array("id"=>"datasheet_file","type"=>"file"));
			   	 ?>
 		  </div>
      	</div>
      </div>    
		   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- removeMember -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="removeMemberBtn" class="btn btn-primary">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- removeMember -->
	</div>
</div>
</div>

<script type="text/javascript">
function readURL(input) 
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#accessory_product_photo').css('background-image','url('+ e.target.result+')');
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_accessory.js"></script>