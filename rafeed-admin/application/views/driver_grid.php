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
			<th>Power Method</th>
			<th>Code</th>
			<th>Power</th>
			<th>Current</th>
			<th>Frequency</th>
			<th>Voltage Type</th>
			<th>Input Voltage</th>
			<th>Output Voltage</th>
			<th>IP Rate</th>
			<th>Origin Country</th>
			<th>Supplier</th>
			<th>Dimension</th>
			<th>Datasheet</th>
			<th>Options</th>	
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Power Method</th>
			<th>Code</th>
			<th>Power</th>
			<th>Current</th>
			<th>Frequency</th>
			<th>Voltage Type</th>
			<th>Input Voltage</th>
			<th>Output Voltage</th>
			<th>IP Rate</th>
			<th>Origin Country</th>
			<th>Supplier</th>
			<th>Dimension</th>
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
			   	<?php echo form_label('Power Method','PowerMethod',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   		<!-- <input type="hidden" value="true" name="DriverType"> -->
			   	<?php foreach ($PowerMethod as $key => $value) {
			   		echo form_radio(array("name"=>"PowerMethod","id"=>$key,"value"=>$value, 'checked'=>set_radio('PowerMethod', $value, FALSE)));
			   		echo form_label($key, $key, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
 		  </div>
      	</div>
      	<div class="col-xs-6">
      		<!-- <div class="form-group">
			   	<?php echo form_label('Type','DriverType',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   	
			   	<?php foreach ($DriverType as $key => $value) {
			   		echo form_radio(array("name"=>"DriverType","id"=>"DriverType".$value,"value"=>$value, 'checked'=>set_radio('DriverType', $value, FALSE)));
			   		echo form_label($key, "DriverType".$value, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
		   </div> -->
      	</div>
      </div>  
      <div class="row">
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
      	<div class="col-xs-6">
	  		<div class="form-group">
				<?php echo form_label('Voltage Type','VoltageTypeID',$attributes=array());?><br/>
				<div style="display: inline-block;">
			   	<?php foreach ($VoltageType as $key => $value) {
			   		echo form_radio(array("name"=>"VoltageTypeID","id"=>"VoltageTypeID".$value['ID'],"value"=>$value['ID'], 'checked'=>set_radio('VoltageTypeID', $value['ID'], FALSE)));
			   		echo form_label($value['Name'], "VoltageTypeID".$value['ID'], $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   	</div>
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
	  		<div class="form-group">
			   	<?php echo form_label('Code','Code',$attributes=array());?>
			   	<?php echo form_input('Code', set_value('Code'),$attributes  = array('class' =>"form-control","id"=>"Code"));?>
		   </div>
	  	</div>
	  	
	  </div>
	  <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group">
		   	<?php echo form_label('Power','Power',$attributes=array());?>
		   	<?php echo form_input(array('class' =>"form-control","id"=>"Power",'type' => 'number', 'name' => 'Power'));?>
		   </div>
	  	</div>
		<div class="col-xs-6">
	  		<div class="form-group">
		   	<?php echo form_label('Frequency','frequency',$attributes=array());?>
		   	<?php echo form_input('frequency', set_value('frequency'),$attributes  = array('class' =>"form-control","id"=>"frequency"));?>
		   </div>
	  	</div>
	  </div>
	  <!-- <div class="row">
	  	
	  </div> -->
	   <div class="row">
	   	<div class="col-xs-6">
	   		<?php echo form_label('Input Voltage','InputVoltage',$attributes=array("style"=>"display: block;"));?>
		   	<div class="form-mgroup" ><!-- style="display: -webkit-inline-box" -->
			   	<div class="form-group"><!--   -->
				   	<?php echo form_label('Min','InputVoltageMin',$attributes=array());?>
				   	<?php echo form_input(array('class' =>"form-control","id"=>"InputVoltageMin","type" => "number","name" => 'InputVoltageMin'));?>
			   </div>
			   <!-- <div  class="form-group" style="width: 10%">
			   		
			   </div> -->
			   <div class="form-group"><!--  -->
				   	<?php echo form_label('Max','InputVoltageMax',$attributes=array());?>
				   	<?php echo form_input(array('class' =>"form-control","id"=>"InputVoltageMax",'type' => 'number','name' => 'InputVoltageMax'));?>
			   </div>
		   </div>
		</div>
		<div class="col-xs-6">
			<?php echo form_label('Output Voltage','',$attributes=array("style"=>"display: block;"));?>
		   <div class="form-mgroup"><!--  style="display: -webkit-inline-box" -->
		   	<div class="form-group"><!--  -->
		   		<?php echo form_label('Min','OutputVoltageMin',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"OutputVoltageMin",'type' => 'number','name' => 'OutputVoltageMin'));?>
		    </div>
		    <!-- <div  class="form-group" style="width: 10%">
			   		
			   </div> -->
			   <div class="form-group">
			   	<?php echo form_label('Max','OutputVoltageMax',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"OutputVoltageMax",'type' => 'number','name'=> 'OutputVoltageMax'));?>
			   </div>
		   </div>
		</div>
	   </div>
	   <div class="row">
	  	<div class="col-xs-6">
			<?php echo form_label('Output Current','OutputCurrent',$attributes=array("style"=>"display: block;"));?>
		   <div class="form-mgroup">
		   		<div class="form-group">
				   	<?php echo form_label('Min','OutputCurrentMin',$attributes=array());?>
				   	<?php echo form_input(array('class' =>"form-control","id"=>"OutputCurrentMin",'type' => 'number','name' => 'OutputCurrentMin'));?>
			   </div>
			   <div class="form-group">
				   	<?php echo form_label('Max','OutputCurrentMax',$attributes=array());?>
				   	<?php echo form_input(array('class' =>"form-control","id"=>"OutputCurrentMax",'type' => 'number','name' => 'OutputCurrentMax'));?>
			   </div>
		   </div>
		</div>
		<div class="col-xs-6">
		   <div class="form-group">
		   		<?php echo form_label('Dimension','editdimension',$attributes=array("style"=>"display: block;"));?>
			   <div class="form-mgroup" style="display: flex;">
			   		<div class="form-group">
					   	<?php echo form_label('Length','Length',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"Length",'type' => 'number','name' => 'Length'));?>
				   	</div>
				   	<div class="form-group">
					   	<?php echo form_label('Width','Width',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"Width",'type' => 'number','name' => 'Width'));?>
				   	</div>
				   	<div class="form-group">
					   	<?php echo form_label('Height','Height',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"Height",'type' => 'number','name' => 'Height'));?>
				   	</div>
			   </div>
		   </div>
		</div>
	  </div>
	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group">
			   	<?php echo form_label('Power Factor','PowerFactor',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"PowerFactor",'type' => 'number','step' => ".00",'name' => 'PowerFactor'));?>
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
			   	<?php echo form_label('Power Method','editPowerMethod',$attributes=array());?>
			   	<br/>
			   	<div style="display: inline-block;">
			   	<?php foreach ($PowerMethod as $key => $value) {
			   		
			   		echo form_radio(array("name"=>"editPowerMethod","id"=>"editPowerMethod".$value,"value"=>$value));
			   		echo form_label($key, "editPowerMethod".$value, $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   </div>
 		  </div>
      	</div>
      	<div class="col-xs-6">
      		<div class="form-group">

		   </div>
      	</div>
      </div>
      <div class="row">
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
      	<div class="col-xs-6">
	  		<div class="form-group">
				<?php echo form_label('Voltage Type','editVoltageTypeID',$attributes=array());?><br/>
				<div style="display: inline-block;">
			   	<?php foreach ($VoltageType as $key => $value) {
			   		echo form_radio(array("name"=>"editVoltageTypeID","id"=>"editVoltageTypeID".$value['ID'],"value"=>$value['ID'], 'checked'=>set_radio('editVoltageTypeID', $value['ID'], FALSE)));
			   		echo form_label($value['Name'], "editVoltageTypeID".$value['ID'], $attributes = array('style' =>'padding-right: 14px;'));
			   	} ?>
			   	</div>
			</div>
		</div>
      </div>
      <input type="hidden" name="editCodeOldVal" id="editCodeOldVal">     
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
			   	<?php echo form_label('Code','editCode',$attributes=array());?>
			   	<?php echo form_input('editCode', set_value('editCode'),$attributes  = array('class' =>"form-control","id"=>"editCode"));?>
		   </div>
	  	</div>
	  </div>
	  <div class="row">
	  	<div class="col-xs-6">
	  		<div class="form-group">
			   	<?php echo form_label('Power','editPower',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"editPower",'type' => 'number', 'name' => 'editPower'));?>
		   </div>
	  	</div>
	  	<div class="col-xs-6">
	  		<div class="form-group">
		   	<?php echo form_label('Frequency','editFrequency',$attributes=array());?>
		   	<?php echo form_input('editFrequency', set_value('editFrequency'),$attributes  = array('class' =>"form-control","id"=>"editFrequency"));?>
		   </div>
	  	</div>
	  </div>
	   <div class="row">
	   	<div class="col-xs-6">
	   		<?php echo form_label('Input Voltage','editInputVoltage',$attributes=array("style"=>"display: block;"));?>
		   	<div class="form-mgroup"><!--  style="display: -webkit-inline-box" -->
			   	<div class="form-group">
				   	<?php echo form_label('Min','editInputVoltageMin',$attributes=array());?>
				   	<?php echo form_input(array('class' =>"form-control","id"=>"editInputVoltageMin",'type' => 'number','name' => 'editInputVoltageMin'));?>
			   </div>
			   <div class="form-group">
				   	<?php echo form_label('Max','editInputVoltageMax',$attributes=array());?>
				   	<?php echo form_input(array('class' =>"form-control","id"=>"editInputVoltageMax",'type' => 'number','name' => 'editInputVoltageMax'));?>
			   </div>
		   </div>
		</div>
		<div class="col-xs-6">
			<?php echo form_label('Output Voltage','',$attributes=array("style"=>"display: block;"));?>
		   <div class="form-mgroup"><!--  style="display: -webkit-inline-box" -->
		   	<div class="form-group"> 
		   		<?php echo form_label('Min','editOutputVoltageMin',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"editOutputVoltageMin",'type' => 'number','name' =>'editOutputVoltageMin'));?>
		    </div>
			   <div class="form-group">
			   	<?php echo form_label('Max','editOutputVoltageMax',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"editOutputVoltageMax",'type' => 'number','name' => 'editOutputVoltageMax'));?>
			   </div>
		   </div>
		</div>
	   </div>
	  <div class="row">
		<div class="col-xs-6">
		   <div class="form-group">
		   		<?php echo form_label('Output Current','editOutputCurrent',$attributes=array("style"=>"display: block;"));?>
			   <div class="form-mgroup">
			   		<div class="form-group"><!--   -->
					   	<?php echo form_label('Min','editOutputCurrentMin',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"editOutputCurrentMin",'type' => 'number','name' => 'editOutputCurrentMin'));?>
				   </div>
				   <div class="form-group"><!--   -->
					   	<?php echo form_label('Min','editOutputCurrentMax',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"editOutputCurrentMax",'type' => 'number','name' => 'editOutputCurrentMax'));?>
				   </div>
			   </div>
		   </div>
		</div>
		<div class="col-xs-6">
		   <div class="form-group">
		   		<?php echo form_label('Dimension','editdimension',$attributes=array("style"=>"display: block;"));?>
			   <div class="form-mgroup" style="display: flex;">
			   		<div class="form-group">
					   	<?php echo form_label('Length','editLength',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"editLength",'type' => 'number','name' => 'editLength'));?>
				   	</div>
				   	<div class="form-group">
					   	<?php echo form_label('Width','editWidth',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"editWidth",'type' => 'number','name' => 'editWidth'));?>
				   	</div>
				   	<div class="form-group">
					   	<?php echo form_label('Height','editHeight',$attributes=array());?>
					   	<?php echo form_input(array('class' =>"form-control","id"=>"editHeight",'type' => 'number','name' => 'editHeight'));?>
				   	</div>
			   </div>
		   </div>
		</div>
	  </div>
	   <div class="row">
	   	<div class="col-xs-6">
		   	<div class="form-group">
			   	<?php echo form_label('Power Factor','editPowerFactor',$attributes=array());?>
			   	<?php echo form_input(array('class' =>"form-control","id"=>"editPowerFactor",'type' => 'number','step' => ".00",'name' => 'editPowerFactor'));?>
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