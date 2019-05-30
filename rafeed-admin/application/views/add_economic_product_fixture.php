<!-- <style>
#_fixture .chosen-container {
    min-width: 150px !important;
}
#_fixture input[type="text"].unit {
    width: 18px !important;
}
#_fixture .btn-default.btn-xs{
	width: 66px;
    white-space: normal;
}
#_fixture .table input {
    width: 70%;
}
</style> -->
<div id="_fixture">
	<div class="hide">
		
		
  	</div>
  	<div class="row">
        <div class="col-xs-6 form-group">
            <div class="">
                <label style="display: -webkit-box;"><p class="form_title">Power</p><span class="text-danger">*</span></label>
                <div class="form-mgroup" ><!-- style="display: -webkit-inline-box" -->
				   	<div class="form-group question-main">
		                <label for="LuminaryPowerUp">UP</label>
		                <input type="number" class="dimentionValue required" value="0" min="0" name="LuminaryPowerUp" data-id="1" id="LuminaryPowerUp" /><input type="text" class="unit" value="W " disabled/><br/>
		            </div><!-- style="display: -webkit-inline-box" -->
				   	<div class="form-group question-main">
                        <p class="form_title">Down<span class="text-danger">*</span></p>
                        <input type="number" class="dimentionValue required" min="0" name="LuminaryPowerDown" data-id="1" id="LuminaryPowerDown" required/>
		            	<input type="text" class="unit" value="W " disabled/>
		            </div>
		        </div>
            </div>
        </div>
        <div class="col-xs-6">
	   		<?php echo form_label('Input Voltage','InputVoltage',$attributes=array("style"=>"display: block;"));?>
		   	<div class="form-mgroup" ><!-- style="display: -webkit-inline-box" -->
			   	<div class="form-group question-main"><!--   -->
				   	<?php echo form_label('Min','InputVoltageMin',$attributes=array());?>
				   	<?php echo form_input(array('name' => 'InputVoltageMin', 'step'=>".00", 'value' => set_value('InputVoltageMin'), 'type'=>'number' ,'class' =>"","id"=>"InputVoltageMin"));?>
			   </div>
			   <!-- <div  class="form-group" style="width: 10%">
			   		
			   </div> -->
			   <div class="form-group question-main"><!--  -->
				   	<?php echo form_label('Max','InputVoltageMax',$attributes=array());?>
				   	<?php echo form_input(array('name' => 'InputVoltageMax', 'step'=>".00", 'value' => set_value('InputVoltageMax'), 'type'=>'number' ,'class' =>"","id"=>"InputVoltageMax"));?>
			   </div>
		   </div>
		</div>
        
    </div>
    <div class="row">
	   	<div class="col-xs-6 form-group question-main">
        	<p class="form_title">Current</p>
        	<input type="number" class="dimentionValue required" min="0" name="LuminaryCurrent" id="LuminaryCurrent"/><input type="text" class="unit" value="mA " disabled/>
        </div>
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Power Frequency</p>
                <input type="text" class="required" name="frequency" data-id="1" id="frequency" />
            </div>
        </div>
    </div>
     <div class="row">
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Lumen<span class="text-danger">*</span></p>
                <input type="number" class="required" min="0" name="LuminaryLumen" data-id="1" id="LuminaryLumen" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 form-group">
            <div class="">
                <label style="display: -webkit-box;"><p class="form_title">CCT</p><span class="text-danger">*</span></label>
                <select id="basic_CCT_option" data-placeholder="Select" class="form-control-sm chosen-select required" name="CCT" required>
					<?php foreach ($CCT_option as $key => $value) {?>
						<option name="<?php echo($value['ID'])?>"><?php echo($value['value'])?></option>
					<?php } ?>
					<?php foreach ($CCT_static_option as $key => $value) {?>
						<option name="<?php echo($value)?>"  value="<?php echo($value)?>"><?php echo($key)?></option>
					<?php } ?>
				</select>
            </div>
        </div>

        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">CRI<span class="text-danger">*</span></p>
                <select id="basic_CRI_option" data-placeholder="Select" class="form-control-sm chosen-select required" name="CRI" required>
					<?php foreach ($CRI_option as $key => $value) {?>
						<option name="<?php echo($value['ID'])?>"><?php echo($value['value'])?></option>
					<?php } ?>
				</select>
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-xs-6">
      		<div class="form-group ">
			   	<p class="form_title"><?php echo form_label('LightSource Type','LightSourceTypeID',$attributes=array());?><span class="text-danger">*</span></p>
			   	<?php $option =array();
			   		foreach ($LightSourceType as $key => $value) {
			   			$option[$value['ID']]=$value['Name'];
			   		}
			   	?>
				<?php echo form_dropdown('LightSourceTypeID', $option,set_value('LightSourceTypeID'),array("class"=>"form-control-sm chosen-select" ,"id"=>"LightSourceTypeID","onchange"=>"changeLightSourceType(this,false)" )); ?>
 		  </div>
      	</div>
		<div class="col-xs-6">
			<div class="form-group">
				 <p class="form_title"><?php echo form_label('Type','type',$attributes=array());?><span class="text-danger">*</span></p>
		   	
		   	<?php $option =array();

		   		foreach ($LEDType as $key => $value) {
		   			$option[$value['ID']]=$value['Name'];
		   		}
		   	?>
		   	<div  class="form-inline hide" id="led_type_div">
			<?php echo form_dropdown('led_type', $option,set_value('led_type'),array("class"=>"form-control-sm chosen-select" ,"id"=>"led_type_ID" )); ?>
			<?php $option =array();
		   		foreach ($PinType as $key => $value) {
		   			$option[$value['ID']]=$value['Name'];
		   		}
		   	?>
                <a class='btn btn-default btn sweet-prompt' onclick='open_popup("led_type",0);'><i class='fa fa-plus'></i></a>
                <a class="btn btn-default btn" onclick="refresh_datasource('led_type',0,'led_type_ID');"><i class="fa fa-refresh"></i></a>
		   </div>
		   	<div  class="form-inline hide" id="LED_pin_type_div">
				<?php echo form_dropdown('LED_pin_type', $option,set_value('LED_pin_type'),array("class"=>"form-control-sm chosen-select" ,"id"=>"LED_pin_type" )); ?>
				<a class='btn btn-default btn sweet-prompt' onclick='open_popup("pin_type",0);'><i class='fa fa-plus'></i></a>
	      		<a class="btn btn-default btn" onclick="refresh_datasource('pin_type',0,'LED_pin_type');"><i class="fa fa-refresh"></i></a>
	  		</div>
			
			<?php $option =array();
		   		foreach ($SocketType as $key => $value) {
		   			$option[$value['ID']]=$value['Name'];
		   		}
		   	?>
		   	<div  class="form-inline hide" id="LED_socket_type_div">
				<?php echo form_dropdown('LED_socket_type', $option,set_value('LED_socket_type'),array("class"=>"form-control chosen-select" ,"id"=>"LED_socket_type" )); ?>
				<a class='btn btn-default btn sweet-prompt' onclick='open_popup("socket_type",0);'><i class='fa fa-plus'></i></a>
	      		<a class="btn btn-default btn" onclick="refresh_datasource('socket_type',0,'LED_socket_type');"><i class="fa fa-refresh"></i></a>
	  		</div>
			
			<?php echo form_input('LED_strips_m', set_value('LED_strips_m'),$attributes = array('class' =>"form-control hide","id"=>"LED_strips_m"));?>
			  </div>
	  	</div>
    </div>
    <div class="row">
        <div class="col-xs-6 form-group">
        	<p class="form_title">Driver</p>
            <input type="hidden" name="driver_isnull" value="0" />
            <input type="checkbox" id="driver_isnull" name="driver_isnull" value="1" onchange="changeIsnull(this,'driver');"/>
            <label for="driver_isnull"> is null </label><br/>
    		<select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="driver" name="driver"></select>
    		<a class="btn btn-default btn" onclick="refresh_fixture_datasource('Driver',this);">
    			<i class="fa fa-refresh"></i>
    		</a>
    		<a class="btn btn-default btn" onclick="open_popup_info('Driver',this);">
    			<i class="fa fa-info"></i>
    		</a>
    	</div>
    	<div class="col-xs-6 form-group">
            <p class="form_title">LED</p>
            <input type="hidden" name="led_isnull" value="0" />
            <input type="checkbox" id="led_isnull" name="led_isnull" value="1" onchange="changeIsnull(this,'led');"/>
            <label for="led_isnull"> is null </label>
    		<br/>
    		<select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="led" name="led"></select>
    		<a class="btn btn-default btn" onclick="refresh_fixture_datasource('LED',this);">
    			<i class="fa fa-refresh"></i>
    		</a>
    		<a class="btn btn-default btn" onclick="open_popup_info('LED',this);">
    			<i class="fa fa-info"></i>
    		</a>
    	</div>
    </div>
     <div class="row">
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <label style="display: -webkit-box;"><p class="form_title">Power Factor</p></label>
                <input type="number" name="power_factor" id="power_factor" step=".00">
            </div>
        </div>

        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Price<span class="text-danger">*</span></p>
                <input type="number" name="price" id="price" step=".00">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <label style="display: -webkit-box;"><p class="form_title">Serial</p><span class="text-danger">*</span></label>
                <input type="number" name="serial_num" id="serial_num" required>
            </div>
        </div>

        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Code<span class="text-danger">*</span></p>
                <input type="text" name="Code" id="Code" required onchange="change_code(this)">
            </div>
        </div>
    </div>
</div>

