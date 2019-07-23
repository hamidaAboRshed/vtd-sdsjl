<div  id="row">
    <div class="card">
        <div class="card-body">
<div class="led-messages"></div>

<!--from hamida -->
<a class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addLED" onclick="addMemberModel()">Add 
</a>
		
<br /> <br />

<table width="100%" class="display nowrap table table-hover table-striped table-bordered" id="manageMemberTable">
	<thead>
		<tr>
			<th>LightSourceType</th>
			<th>Type</th>
			<th>Size</th>
			<th>Code</th>
			<th>OriginCountry</th>
			<th>Supplier</th>
			<th>Datasheet</th>
			<th>Options</th>	
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>LightSourceType</th>
			<th>Type</th>
			<th>Size</th>
			<th>Code</th>
			<th>OriginCountry</th>
			<th>Supplier</th>
			<th>Datasheet</th>
			<th>Options</th>	
		</tr>
	</tfoot>
</table>

<div class="modal fade" role="dialog" id="addLED">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add LED</h4>
  </div>

  <?php echo form_open('LED/create_led',$attributes=array('id'=>'createForm'));?>
  <div class="modal-body">  
      <div class="row">
      	<div class="col-xs-6">
      		<div class="form-group ">
			   	<?php echo form_label('Lighting Source','LightSourceTypeID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($LightSourceType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
				<?php echo form_dropdown('LightSourceTypeID', $option,set_value('LightSourceTypeID'),array("class"=>"form-control" ,"id"=>"LightSourceTypeID","onchange"=>"changeLightSourceType(this,false)" )); ?>
 		  </div>
      	</div>
      	<div class="col-xs-6">
      		<div class="form-group">
			   	<?php echo form_label('Type','type',$attributes=array());?>
			   	<?php $option =array();

			   		foreach ($LEDType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
				<?php echo form_dropdown('led_type', $option,set_value('led_type'),array("class"=>"form-control" ,"id"=>"led_type" )); ?>
				<?php $option =array();
			   		foreach ($TubeModel as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline hide" id="LED_tube_model_div">
					<?php echo form_dropdown('LED_tube_model', $option,set_value('LED_tube_model'),array("class"=>"form-control" ,"id"=>"LED_tube_model" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("tube_model",0);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('tube_model',0,'LED_tube_model');"><i class="fa fa-refresh"></i></a>
          		</div>
				
				<?php $option =array();
			   		foreach ($SocketType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline hide" id="LED_socket_type_div">
					<?php echo form_dropdown('LED_socket_type', $option,set_value('LED_socket_type'),array("class"=>"form-control" ,"id"=>"LED_socket_type" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("socket_type",0);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('socket_type',0,'LED_socket_type');"><i class="fa fa-refresh"></i></a>
          		</div>
				
				<?php echo form_input('LED_strips_m', set_value('LED_strips_m'),$attributes = array('class' =>"form-control hide","id"=>"LED_strips_m"));?>
 		  </div>
      	</div>
      </div>      
	  <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group">
	  			<?php echo form_label('Size','Size',$attributes=array());?>
	  			<?php echo form_input('Size', set_value('Size'),$attributes = array('class' =>"form-control","id"=>"Size"));?>
	  		</div>
	  	</div>
	  	<div class="col-xs-6">
	  		<div class="form-group">
			   	<?php echo form_label('Code','LEDCode',$attributes=array());?>
			   	<?php echo form_input('LEDCode', set_value('LEDCode'),$attributes = array('class' =>"form-control","id"=>"LEDCode"));?>
		   </div>
	  	</div>
	  	<div class="col-xs-6">
	  	</div>
	  </div>
	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group ">
			   	<?php echo form_label('Origin Country','LEDOriginCountryID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($Country as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline">
					<?php echo form_dropdown('LEDOriginCountryID', $option,set_value('LEDOriginCountryID'),array("class"=>"form-control" ,"id"=>"LEDOriginCountryID" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("country",1);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('country',1,'LEDOriginCountryID');"><i class="fa fa-refresh"></i></a>
	          	</div>
				
 		  </div>
 		</div>
 		<div class="col-xs-6">
 		  <div class="form-group">
			   	<?php echo form_label('Supplier','LEDSupplierID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($Supplier as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
				<?php echo form_dropdown('LEDSupplierID', $option,set_value('LEDSupplierID'),array("class"=>"form-control" ,"id"=>"LEDSupplierID" )); ?>
 		  </div>
 		</div>
	   </div>
		   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" form="createForm">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit","form"=>"createForm"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="editMemberModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit LED</h4>
      </div>
      <?php echo form_open('LED/edit',$attributes=array('id'=>'editForm','method'=>'post'));?>
      <div class="modal-body">        
		 <div class="row">
	      	<div class="col-xs-6">
	      		<div class="form-group ">
				   	<?php echo form_label('Lighting Source','editLightSourceTypeID',$attributes=array());?>
				   	<?php $option =array();
				   		foreach ($LightSourceType as $key => $value) {
				   			$option[$value['ID']]=$value['Name'];
				   		}
				   	?>
					<?php echo form_dropdown('editLightSourceTypeID', $option,set_value('editLightSourceTypeID'),array("class"=>"form-control" ,"id"=>"editLightSourceTypeID","onchange"=>"changeLightSourceType(this,true)" )); ?>
	 		  </div>
	      	</div>
	      	<div class="col-xs-6">
	      		<div class="form-group">
				   	<?php echo form_label('Type','editType',$attributes=array());?>
				   	<?php $option =array();

				   		foreach ($LEDType as $key => $value) {
				   			$option[$value['ID']]=$value['Name'];
				   		}
				   	?>
					<?php echo form_dropdown('editled_type', $option,set_value('editled_type'),array("class"=>"form-control" ,"id"=>"editled_type" )); ?>
					<?php $option =array();
				   		foreach ($PinType as $key => $value) {
				   			$option[$value['ID']]=$value['Name'];
				   		}
				   	?>
					<div  class="form-inline hide" id="editLED_tube_model_div">
					<?php echo form_dropdown('editLED_tube_model', $option,set_value('editLED_tube_model'),array("class"=>"form-control" ,"id"=>"editLED_tube_model" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("tube_model",0);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('tube_model',0,'editLED_tube_model');"><i class="fa fa-refresh"></i></a>
          		</div>
				
				<?php $option =array();
			   		foreach ($SocketType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline hide" id="editLED_socket_type_div">
					<?php echo form_dropdown('editLED_socket_type', $option,set_value('editLED_socket_type'),array("class"=>"form-control" ,"id"=>"editLED_socket_type" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("socket_type",0);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('socket_type',0,'editLED_socket_type');"><i class="fa fa-refresh"></i></a>
          		</div>
					<?php echo form_input('editLED_strips_m', set_value('editLED_strips_m'),$attributes  = array('class' =>"form-control hide","id"=>"editLED_strips_m"));?>
	 		  </div>
	      	</div>
	      </div>      
		  <div class="row">
		  	<div class="col-xs-6">
		  		<div class="form-group">
		  			<?php echo form_label('Size','editSize',$attributes=array());?>
		  			<?php echo form_input('editSize', set_value('editSize'),$attributes = array('class' =>"form-control","id"=>"editSize"));?>
		  		</div>
		  	</div>
		  	<div class="col-xs-6">
		  		<div class="form-group">
				   	<?php echo form_label('Code','editLEDCode',$attributes=array());?>
				   	<?php echo form_input('editLEDCode', set_value('editLEDCode'),$attributes  = array('class' =>"form-control","id"=>"editLEDCode"));?>

			   </div>
		  	</div>
		  </div>
		  <input type="hidden" name="editLEDCodeOldVal" id="editLEDCodeOldVal">
		   <div class="row">
		   	<div class="col-xs-6">
			   	<div class="form-group ">
				   	<?php echo form_label('Origin Country','editLEDOriginCountryID',$attributes=array());?>
				   	<?php $option =array();
				   		foreach ($Country as $key => $value) {
				   			$option[$value['ID']]=$value['Name'];
				   		}
				   	?>
				   	<div  class="form-inline">
						<?php echo form_dropdown('editLEDOriginCountryID', $option,set_value('editLEDOriginCountryID'),array("class"=>"form-control" ,"id"=>"editLEDOriginCountryID" )); ?>
						<a class='btn btn-default btn sweet-prompt' onclick='open_popup("country",1);'><i class='fa fa-plus'></i></a>
		          		<a class="btn btn-default btn" onclick="refresh_datasource('country',1,'editLEDOriginCountryID');"><i class="fa fa-refresh"></i></a>
		          	</div>
					
	 		  </div>
	 		</div>
	 		<div class="col-xs-6">
	 		  <div class="form-group">
				   	<?php echo form_label('Supplier','editLEDSupplierID',$attributes=array());?>
				   	<?php $option =array();
				   		foreach ($Supplier as $key => $value) {
				   			$option[$value['ID']]=$value['Name'];
				   		}
				   	?>
					<?php echo form_dropdown('editLEDSupplierID', $option,set_value('editLEDSupplierID'),array("class"=>"form-control" ,"id"=>"editLEDSupplierID" )); ?>
	 		  </div>
	 		</div>
		   </div>
		   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" form="editForm">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit", "form"=>"editForm"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	<!-- /edit mmebers -->


<!-- uploadLEDDatasheet -->

<div class="modal fade" role="dialog" id="uploadLEDDatasheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload LED Datasheet</h4>
      </div>
      <?php echo form_open_multipart('LED/upload_datasheet',$attributes=array('id'=>'uploadLEDDatasheetForm','method'=>'post'));?>
      <div class="modal-body">        
		 <div class="row">
      	<div class="col-xs-6">
      		<div class="form-group ">
			   	<?php echo form_label('Datasheet file','datasheet_file',$attributes=array());
			   		echo "<input type='file' name='datasheet_file' id='datasheet_file' class='form-control' />";
			   		//form_input("datasheet_file",set_value('datasheet_file'),$attributes=array("id"=>"datasheet_file","type"=>"file"));
			   	 ?>
 		  </div>
      	</div>
      </div>    
		   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" form="uploadLEDDatasheetForm">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit", "form" => "uploadLEDDatasheetForm"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /uploadLEDDatasheet -->

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

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_led.js"></script>
<script src="<?php echo base_url();?>/assets/js/app/index_popup.js"></script>