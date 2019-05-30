<style type="text/css">
	.form-mgroup{
		display: -webkit-box;
	}

	.form-mgroup p{
        display: table-caption;
    	padding: 6px;
	}
</style>
<div  id="row">
    <div class="card">
        <div class="card-body">
<div class="driver-messages"></div>

<!--from hamida -->
<a class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addDriverMadal" onclick="addDriverMemberModel()">Add 
</a>
		
<br /> <br />

<table width="100%" class="display nowrap table table-hover table-striped table-bordered" id="driverManageMemberTable">
	<thead>
		<tr>
			<th>Driver Type</th>
			<th>Code</th>
			<th>Power</th>
			<th>Current</th>
			<th>Input Voltage</th>
			<th>Output Voltage</th>
			<th>IP Rate</th>
			<th>Origin Country</th>
			<th>Supplier</th>
			<th>Datasheet</th>
			<th>Options</th>	
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Driver Type</th>
			<th>Code</th>
			<th>Power</th>
			<th>Current</th>
			<th>Input Voltage</th>
			<th>Output Voltage</th>
			<th>IP Rate</th>
			<th>Origin Country</th>
			<th>Supplier</th>
			<th>Datasheet</th>
			<th>Options</th>		
		</tr>
	</tfoot>
</table>

<div class="modal fade" role="dialog" id="addDriverMadal">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Add Driver</h4>
  </div>

  <?php echo form_open('Driver/create_driver',$attributes=array('id'=>'createDriverForm'));?>
  <div class="modal-body">  
      <div class="row">
      	<div class="col-xs-6">
      		<div class="form-group ">
			   	<?php echo form_label('Type','DriverType',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   		<!-- <input type="hidden" value="true" name="DriverType"> -->
			   	<?php foreach ($DriverType as $key => $value) {
			   		echo form_radio(array("name"=>"DriverType","id"=>$key,"value"=>$value, 'checked'=>set_radio('DriverType', $value, FALSE)));
			   		echo form_label($key, $key, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
 		  </div>
      	</div>
      	<div class="col-xs-6">
      		<div class="form-group">
			   	<?php echo form_label('Output Type','OutputType',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   	<?php foreach ($DriverOutputType as $key => $value) {
			   		
			   		echo form_radio(array("name"=>"OutputType","id"=>$key,"value"=>$value, 'checked'=>set_radio('OutputType', $value, FALSE)));
			   		echo form_label($key, $key, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
		   </div>
      	</div>
      </div>      
	  <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group">
			   	<?php echo form_label('Code','Code',$attributes=array());?>
			   	<?php echo form_input('Code', set_value('Code'),$attributes  = array('class' =>"form-control","id"=>"Code"));?>
		   </div>
	  	</div>
	  	<div class="col-xs-6">
	  		<div class="form-group">
		   	<?php echo form_label('Power','Power',$attributes=array());?>
		   	<?php echo form_input('Power', set_value('Power'),$attributes  = array('class' =>"form-control","id"=>"Power"));?>
		   </div>
	  	</div>
	  </div>
	  <div class="row">
	  	<div class="col-xs-6">
		  	<div class="form-group ">
			   	<?php echo form_label('Dimmable','Dimmable[]',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($DimmableType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline">
					<?php echo form_dropdown('Dimmable[]', $option,set_value('Dimmable'),array("class"=>"form-control  chosen-select" ,"id"=>"Dimmable" ,"multiple" => "multiple")); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("dimmable_type",1);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('dimmable_type',1,'Dimmable');"><i class="fa fa-refresh"></i></a>
	          	</div>
 		  </div>
		</div>
		<div class="col-xs-6">
			<?php echo form_label('Output Current','OutputCurrent',$attributes=array("style"=>"display: block;"));?>
		   <div class="form-mgroup">
		   		<div class="form-group"><!--   -->
				   	<?php echo form_label('Min','OutputCurrentMin',$attributes=array());?>
				   	<?php echo form_input('OutputCurrentMin', set_value('OutputCurrentMin'),$attributes  = array('class' =>"form-control","id"=>"OutputCurrentMin"));?>
			   </div>
			   <div class="form-group"><!--   -->
				   	<?php echo form_label('Max','OutputCurrentMax',$attributes=array());?>
				   	<?php echo form_input('OutputCurrentMax', set_value('OutputCurrentMax'),$attributes  = array('class' =>"form-control","id"=>"OutputCurrentMax"));?>
			   </div>
		   </div>
		</div>
	  </div>
	   <div class="row">
	   	<div class="col-xs-6">
	   		<?php echo form_label('Input Voltage','InputVoltage',$attributes=array("style"=>"display: block;"));?>
		   	<div class="form-mgroup" ><!-- style="display: -webkit-inline-box" -->
			   	<div class="form-group"><!--   -->
				   	<?php echo form_label('Min','InputVoltageMin',$attributes=array());?>
				   	<?php echo form_input('InputVoltageMin', set_value('InputVoltageMin'),$attributes  = array('class' =>"form-control","id"=>"InputVoltageMin"));?>
			   </div>
			   <!-- <div  class="form-group" style="width: 10%">
			   		
			   </div> -->
			   <div class="form-group"><!--  -->
				   	<?php echo form_label('Max','InputVoltageMax',$attributes=array());?>
				   	<?php echo form_input('InputVoltageMax', set_value('InputVoltageMax'),$attributes  = array('class' =>"form-control","id"=>"InputVoltageMax"));?>
			   </div>
		   </div>
		</div>
		<div class="col-xs-6">
			<?php echo form_label('Output Voltage','',$attributes=array("style"=>"display: block;"));?>
		   <div class="form-mgroup"><!--  style="display: -webkit-inline-box" -->
		   	<div class="form-group"><!--  -->
		   		<?php echo form_label('Min','OutputVoltageMin',$attributes=array());?>
			   	<?php echo form_input('OutputVoltageMin', set_value('OutputVoltageMin'),$attributes  = array('class' =>"form-control","id"=>"OutputVoltageMin"));?>
		    </div>
		    <!-- <div  class="form-group" style="width: 10%">
			   		
			   </div> -->
			   <div class="form-group">
			   	<?php echo form_label('Max','OutputVoltageMax',$attributes=array());?>
			   	<?php echo form_input('OutputVoltageMax', set_value('OutputVoltageMax'),$attributes  = array('class' =>"form-control","id"=>"OutputVoltageMax"));?>
			   </div>
		   </div>
		</div>
	   </div>

	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group">
			   	<?php echo form_label('Power Factor','PowerFactor',$attributes=array());?>
			   	<?php echo form_input('PowerFactor', set_value('PowerFactor'),$attributes  = array('class' =>"form-control","id"=>"PowerFactor"));?>
		   </div>
		</div>
		<div class="col-xs-6">
		   <div class="form-group">
			   	<?php echo form_label('IP Rate','IPRate',$attributes=array());?>
			   	<?php echo form_input('IPRate', set_value('IPRate'),$attributes  = array('class' =>"form-control","id"=>"IPRate"));?>
		   </div>
		</div>
	   </div>

	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group ">
			   	<?php echo form_label('Origin Country','OriginCountryID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($Country as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline">
					<?php echo form_dropdown('OriginCountryID', $option,set_value('OriginCountryID'),array("class"=>"form-control" ,"id"=>"OriginCountryID" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("country",1);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('country',1,'OriginCountryID');"><i class="fa fa-refresh"></i></a>
	          	</div>
 		  </div>
 		</div>
 		<div class="col-xs-6">
 		  <div class="form-group">
			   	<?php echo form_label('Supplier','SupplierID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($Supplier as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
				<?php echo form_dropdown('SupplierID', $option,set_value('SupplierID'),array("class"=>"form-control" ,"id"=>"SupplierID" )); ?>
 		  </div>
 		</div>
	   </div>
		  <!-- <input type="file" name="userfile" size="20" />  -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="editDriverMemberModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Driver</h4>
      </div>
      <?php echo form_open('Driver/edit',$attributes=array('id'=>'editDriverForm','method'=>'post'));?>
      <div class="modal-body">        
		 <div class="row">
      	<div class="col-xs-6">
      		<div class="form-group ">
			   	<?php echo form_label('Type','editDriverType',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   	<?php foreach ($DriverType as $key => $value) {
			   		
			   		echo form_radio(array("name"=>"editDriverType","id"=>"editDriverType".$value,"value"=>$value));
			   		echo form_label($key, "editDriverType".$value, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
 		  </div>
      	</div>
      	<div class="col-xs-6">
      		<div class="form-group">
			   	<?php echo form_label('Output Type','editOutputType',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   	<?php foreach ($DriverOutputType as $key => $value) {
			   		
			   		echo form_radio(array("name"=>"editOutputType","id"=>"editOutputType".$value,"value"=>$value));
			   		echo form_label($key, "editOutputType".$value, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
		   </div>
      	</div>
      </div>
      <input type="hidden" name="editCodeOldVal" id="editCodeOldVal">     
	  <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group">
			   	<?php echo form_label('Code','editCode',$attributes=array());?>
			   	<?php echo form_input('editCode', set_value('editCode'),$attributes  = array('class' =>"form-control","id"=>"editCode"));?>
		   </div>
	  	</div>
	  	<div class="col-xs-6">
	  		<div class="form-group">
			   	<?php echo form_label('Power','editPower',$attributes=array());?>
			   	<?php echo form_input('editPower', set_value('editPower'),$attributes  = array('class' =>"form-control","id"=>"editPower"));?>
		   </div>
	  	</div>
	  </div>
	  <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group ">
			   	<?php echo form_label('Dimmable','editDimmable[]',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($DimmableType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline">
					<?php echo form_dropdown('editDimmable[]', $option,set_value('editDimmable'),array("class"=>"form-control chosen-select" ,"id"=>"editDimmable" ,"multiple" => "multiple")); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("dimmable_type",1);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('dimmable_type',1,'editDimmable');"><i class="fa fa-refresh"></i></a>
          		</div>
 		  </div>
		</div>
		<div class="col-xs-6">
		   <div class="form-group">
		   		<?php echo form_label('Output Current','editOutputCurrent',$attributes=array("style"=>"display: block;"));?>
			   <div class="form-mgroup">
			   		<div class="form-group"><!--   -->
					   	<?php echo form_label('Min','editOutputCurrentMin',$attributes=array());?>
					   	<?php echo form_input('editOutputCurrentMin', set_value('editOutputCurrentMin'),$attributes  = array('class' =>"form-control","id"=>"editOutputCurrentMin"));?>
				   </div>
				   <div class="form-group"><!--   -->
					   	<?php echo form_label('Min','editOutputCurrentMax',$attributes=array());?>
					   	<?php echo form_input('editOutputCurrentMax', set_value('editOutputCurrentMax'),$attributes  = array('class' =>"form-control","id"=>"editOutputCurrentMax"));?>
				   </div>
			   </div>
		   </div>
		</div>
	  </div>
	   <div class="row">
	   	<div class="col-xs-6">
	   		<?php echo form_label('Input Voltage','editInputVoltage',$attributes=array("style"=>"display: block;"));?>
		   	<div class="form-mgroup"><!--  style="display: -webkit-inline-box" -->
			   	<div class="form-group">
				   	<?php echo form_label('Min','editInputVoltageMin',$attributes=array());?>
				   	<?php echo form_input('editInputVoltageMin', set_value('editInputVoltageMin'),$attributes  = array('class' =>"form-control","id"=>"editInputVoltageMin"));?>
			   </div>
			   <div class="form-group">
				   	<?php echo form_label('Max','editInputVoltageMax',$attributes=array());?>
				   	<?php echo form_input('editInputVoltageMax', set_value('editInputVoltageMax'),$attributes  = array('class' =>"form-control","id"=>"editInputVoltageMax"));?>
			   </div>
		   </div>
		</div>
		<div class="col-xs-6">
			<?php echo form_label('Output Voltage','',$attributes=array("style"=>"display: block;"));?>
		   <div class="form-mgroup"><!--  style="display: -webkit-inline-box" -->
		   	<div class="form-group"> 
		   		<?php echo form_label('Min','editOutputVoltageMin',$attributes=array());?>
			   	<?php echo form_input('editOutputVoltageMin', set_value('editOutputVoltageMin'),$attributes  = array('class' =>"form-control","id"=>"editOutputVoltageMin"));?>
		    </div>
			   <div class="form-group">
			   	<?php echo form_label('Max','editOutputVoltageMax',$attributes=array());?>
			   	<?php echo form_input('editOutputVoltageMax', set_value('editOutputVoltageMax'),$attributes  = array('class' =>"form-control","id"=>"editOutputVoltageMax"));?>
			   </div>
		   </div>
		</div>
	   </div>

	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group">
			   	<?php echo form_label('Power Factor','editPowerFactor',$attributes=array());?>
			   	<?php echo form_input('editPowerFactor', set_value('editPowerFactor'),$attributes  = array('class' =>"form-control","id"=>"editPowerFactor"));?>
		   </div>
		</div>
		<div class="col-xs-6">
		   <div class="form-group">
			   	<?php echo form_label('IP Rate','editIPRate',$attributes=array());?>
			   	<?php echo form_input('editIPRate', set_value('editIPRate'),$attributes  = array('class' =>"form-control","id"=>"editIPRate"));?>
		   </div>
		</div>
	   </div>

	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group ">
			   	<?php echo form_label('Origin Country','editOriginCountryID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($Country as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
			   	<div  class="form-inline">
					<?php echo form_dropdown('editOriginCountryID', $option,set_value('editOriginCountryID'),array("class"=>"form-control" ,"id"=>"editOriginCountryID" )); ?>
					<a class='btn btn-default btn sweet-prompt' onclick='open_popup("country",1);'><i class='fa fa-plus'></i></a>
	          		<a class="btn btn-default btn" onclick="refresh_datasource('country',1,'editOriginCountryID');"><i class="fa fa-refresh"></i></a>
          		</div>
 		  </div>
 		</div>
 		<div class="col-xs-6">
 		  <div class="form-group">
			   	<?php echo form_label('Supplier','editSupplierID',$attributes=array());?>
			   	<?php $option =array();
			   		foreach ($Supplier as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
				<?php echo form_dropdown('editSupplierID', $option,set_value('editSupplierID'),array("class"=>"form-control" ,"id"=>"editSupplierID" )); ?>
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
<!-- /edit mmebers -->


<!-- uploadDriverDatasheet -->

<div class="modal fade" role="dialog" id="uploadDriverDatasheetModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload Driver Datasheet</h4>
      </div>
      <?php echo form_open_multipart('Driver/upload_datasheet',$attributes=array('id'=>'uploadDriverDatasheetForm','method'=>'post'));?>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- /uploadDriverDatasheet -->

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
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_driver.js"></script>
<script src="<?php echo base_url();?>/assets/js/app/index_popup.js"></script>