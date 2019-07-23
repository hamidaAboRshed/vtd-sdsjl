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
                <label style="display: -webkit-box;"><p class="form_title">Power(W)</p><span class="text-danger">*</span></label>
                <div class="form-mgroup row"><!-- style="display: -webkit-inline-box" -->
				   	<div class="col-xs-5">
		                <label for="LuminaryPowerUp">UP</label>
		                <input type="number" class="required" value="0" min="0" name="LuminaryPowerUp" data-id="1" id="LuminaryPowerUp" />
		            </div><!-- style="display: -webkit-inline-box" -->
				   	<div class="col-xs-5" style="padding-left: 2px;">
                        <label for="LuminaryPowerDown">Down</label>
                        <input type="number" class="required" min="0" name="LuminaryPowerDown" data-id="1" id="LuminaryPowerDown" required/>
		            	
		            </div>
		        </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <?php echo form_label('Voltage Type','VoltageTypeID',$attributes=array());?><br/>
                <div style="display: inline-block;">
                    <!-- <input type="hidden" value="true" name="DriverType"> -->
                <?php foreach ($VoltageType as $key => $value) { ?>
                    <div class="col ">
                      <span class="radio-wrapper"> 
                          <input type="radio" name="VoltageTypeID" id="VoltageTypeID<?php echo($value['ID'])?>" value="<?php echo($value['ID'])?>">
                          <div>
                              
                          </div> 
                      </span> 
                      <span class="table-cell"> 
                          <label for="VoltageTypeID<?php echo($value['ID'])?>"> <?php echo($value['Name'])?> </label> 
                      </span> 
                  </div>
                    <!-- echo form_radio(array("name"=>"VoltageTypeID","id"=>"VoltageTypeID".$value['ID'],"value"=>$value['ID'], 'checked'=>set_radio('VoltageTypeID', $value['ID'], FALSE)));
                    echo form_label($value['Name'], "VoltageTypeID".$value['ID'], $attributes = array('style' =>'padding-right: 14px;')); -->
                <?php } ?>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-xs-6">
            <?php echo form_label('Input Voltage','InputVoltage',$attributes=array("style"=>"display: block;"));?>
            <div class="form-mgroup row"><!-- style="display: -webkit-inline-box" -->
                <div class="col-xs-5"><!--   -->
                    <?php echo form_label('Min','InputVoltageMin',$attributes=array());?>
                    <?php echo form_input(array('name' => 'InputVoltageMin', 'step'=>".00", 'value' => set_value('InputVoltageMin'), 'type'=>'number' ,'class' =>"","id"=>"InputVoltageMin"));?>
               </div>
               <div class="col-xs-5" style="padding-left: 11px;"><!--  -->
                    <?php echo form_label('Max','InputVoltageMax',$attributes=array());?>
                    <?php echo form_input(array('name' => 'InputVoltageMax', 'step'=>".00", 'value' => set_value('InputVoltageMax'), 'type'=>'number' ,'class' =>"","id"=>"InputVoltageMax"));?>
               </div>
           </div>
        </div>
	   	<div class="col-xs-6 form-group question-main">
        	<p class="form_title">AC Current(mA)</p>
        	<input type="number" class=" required" min="0" name="LuminaryCurrent" id="LuminaryCurrent"/>
        </div>
        
    </div>
     <div class="row">
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Power Frequency</p>
                <input type="text" class="required" name="frequency" data-id="1" id="frequency" />
            </div>
        </div>
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Lumen<span class="text-danger">*</span></p>
                <input type="number" class="required" min="0" name="LuminaryLumen" data-id="1" id="LuminaryLumen" required/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">PCB description</p>
                <input type="text" class="required" name="PCB_description" id="PCB_description" required/>
            </div>
        </div>
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload PCB design file ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="pcb_design_file" multiple>
          
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
                <p class="form_title">Referance Code<span class="text-danger">*</span></p>
                <input type="text" name="Code" id="Code" required onchange="change_code(this)">
            </div>
        </div>
    </div>
</div>

