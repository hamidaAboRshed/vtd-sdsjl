<script src="<?php echo base_url();?>/assets/ckeditor/ckeditor.js"></script>
<div  id="_series">
    <div class="row">
        <div class="col-xs-6 form-group ">
            <p class="form_title">Manufacturing Technique<span class="text-danger">*</span></p>
            <div style="display: inline-block;">
            <!-- <input type="hidden" value="true" name="DriverType"> -->
            <?php foreach ($ManufacturingTechnique as $key => $value) {?>
                <div class="col ">
                    <span class="radio-wrapper"> 
                        <input type="radio" name="ManufacturingTechnique" id="ManufacturingTechnique<?php echo($value)?>" value="<?php echo($value)?>">
                        <div>
                            
                        </div> 
                    </span> 
                    <span class="table-cell"> 
                        <label for="ManufacturingTechnique<?php echo($value)?>"> <?php echo($key)?> </label> 
                    </span> 
                </div>
            <?php } ?>
           </div>
        </div>
        <!-- <div class="col-xs-6 form-group ">
            <p class="form_title">Product Fixture Base<span class="text-danger">*</span></p>
            <div style="display: inline-block;">
            
            <?php foreach ($LightingSource as $key => $value) {?>
                <div class="col ">
                    <span class="radio-wrapper"> 
                        <input type="radio" name="LightingSource" id="LightingSource<?php echo($value)?>" value="<?php echo($value)?>" onchange="changeLightingSource(this);">
                        <div>
                            
                        </div> 
                    </span> 
                    <span class="table-cell"> 
                        <label for="LightingSource<?php echo($value)?>"> <?php echo($key)?> </label> 
                    </span> 
                </div>
                
            <?php } ?>
           </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-xs-6 form-group">
            <div class="">
                <label style="display: -webkit-box;"><p class="form_title">Product type</p><span class="text-danger">*</span></label>
                <?php foreach ($ProductType as $key => $value) {?>
                    <div class="col ">
                        <span class="radio-wrapper"> 
                            <input type="radio" name="ProductTypeID" id="ProductTypeID<?php echo($value)?>" value="<?php echo($value)?>" onchange="changeProductType(this.value);">
                            <div>
                                
                            </div> 
                        </span> 
                        <span class="table-cell"> 
                            <label for="ProductTypeID<?php echo($value)?>"> <?php echo($key)?> </label> 
                        </span> 
                    </div>
                    
                <?php } ?>
            </div>
        </div>

        <div class="col-xs-6 form-group">
            <div class="question-main">
                <p class="form_title">Product Category<span class="text-danger">*</span></p>
                <select data-placeholder="Select" class="text_field chosen-select required" id="product_cat" name="ProductCatID" onchange="changeCategory(this);" >

                </select>
                <a class="btn btn-default btn sweet-prompt" onclick="open_category_addPopup('product_category',1);"><i class="fa fa-plus"></i></a>
                <a class="btn btn-default btn" onclick="refresh_category();"><i class="fa fa-refresh"></i></a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 form-group ">
            <div class="question-main">
                <p class="form_title">Application<span class="text-danger">*</span></p>
                <select data-placeholder="Select" class="text_field chosen-select required" multiple id="application" name="ApplicationID[]">
                    <?php foreach ($Application as $rec) : ?>
                        <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                    <?php endforeach; ?>
                </select>
                <a class="btn btn-default btn sweet-prompt" onclick="open_popup('application',1);"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="col-xs-6 form-group ">
            <div class="question-main">
                <p class="form_title">Certifications<span class="text-danger">*</span></p>
                <select data-placeholder="Select" class="text_field chosen-select required" multiple id="certification" name="CertificationID[]">
                    <?php foreach ($Certification as $rec) : ?>
                        <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                    <?php endforeach; ?>
                </select>
                <a class="btn btn-default btn sweet-prompt" onclick="open_popup('certification',0);"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 form-group">
            <p class="form_title">Working temperature</p>
            <div class="question-main" >
                <div class="inline">
                    <label class="rang-label">from</label>
                </div>
                <div class="inline">
                    <input type="number" class="dimentionValue"  name="LuminaryMinWorkingTemperature" /><input type="text" class="unit" value="˚C " disabled/>
                </div>
                <div class="inline">
                    <label class="rang-label">to</label>
                </div>
                <div class="inline">
                    <div><input type="number" class="dimentionValue" name="LuminaryMaxWorkingTemperature" /><input type="text" class="unit" value="˚C " disabled/></div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 form-group ">
          <!-- <p class="form_title">What is the cost?</p><br/>
          <input type="number" class="text_field" name="FittingCost"/> -->
          <p class="form_title">Installation way<span class="text-danger">*</span></p>
          <select data-placeholder="Select" class="form-control-sm  chosen-select required" id="installation_way" multiple name="InstallationWayID[]" >
                <?php foreach ($InstallationWay as $way) : ?>
                    <?php echo '<option value="'.$way['ID'].'">'.$way['Name'].'</option>'?>
                <?php endforeach; ?>
              </select>
              <a class='btn btn-default btn sweet-prompt' onclick='open_popup("installation_way",1);'><i class='fa fa-plus'></i></a>
              <a class="btn btn-default btn" onclick="refresh_datasource('installation_way',1,'installation_way');"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-xs-6 form-group">
            <label style="display: -webkit-box;"><p class="form_title">Product power type</p><span class="text-danger">*</span></label>
            <?php foreach ($ProductPowerType as $key => $value) {?>
                <div class="col ">
                    <span class="radio-wrapper"> 
                        <input type="radio" name="ProductPowerTypeID" id="ProductPowerTypeID<?php echo($value)?>" value="<?php echo($value)?>" 
                        <?php echo $value==1 ? "checked" : "" ?> onchange="changeProductPowerType(this)">
                        <div>
                            
                        </div> 
                    </span> 
                    <span class="table-cell"> 
                        <label for="ProductPowerTypeID<?php echo($value)?>"><?php echo($key)?></label> 
                    </span> 
                </div>
                
            <?php } ?>
        </div>
        <div class="col-xs-6 form-group ">
            <?php echo form_label('Driver Type','DriverType',$attributes=array());?>
            <br/>
            <div style="display: inline-block;">
                <!-- <input type="hidden" value="true" name="DriverType"> -->
            <?php foreach ($DriverType as $key => $value) {?>
                <div class="col ">
                    <span class="radio-wrapper"> 
                        <input type="radio" name="DriverType" id="DriverType<?php echo($value)?>" value="<?php echo($value)?>">
                        <div>
                            
                        </div> 
                    </span> 
                    <span class="table-cell"> 
                        <label for="DriverType<?php echo($value)?>"> <?php echo($key)?> </label> 
                    </span> 
                </div>
            <?php } ?>
           </div>
      </div>
    </div>
    <div class="row hide" id="AC_row">
        <div class="col-xs-6 form-group ">
            <p class="form_title">Product function</p>
            <div style="display: inline-block;">
                <!-- <input type="hidden" value="true" name="DriverType"> -->
            <?php foreach ($ACProductFunction as $key => $value) {?>
                <div class="col ">
                    <span class="radio-wrapper"> 
                        <input type="radio" name="ACProductFunction" id="ACProductFunction<?php echo($value)?>" value="<?php echo($value)?>" onchange="changeACProductFunction(this)" checked >
                        <div>
                            
                        </div> 
                    </span> 
                    <span class="table-cell"> 
                        <label for="ACProductFunction<?php echo($value)?>"><?php echo($key)?></label> 
                    </span> 
                </div>
            <?php } ?>
           </div>
        </div>
        <div class="col-xs-6 form-group ">
            <div id="Socket" class="question-main" style="display: none;">
            <p class="form_title">Base Type</p>
           <div class="required">
              <label class="">Socket<span class="text-danger">*</span></label>
              <select data-placeholder="Select" class="type-selector chosen-select"  id="socket_type" name="SocketTypeID" multiple>
                  <option value=""></option>
                     <?php 
                  foreach ($SocketType as $rec) {
                      echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>';
                  }?>
              </select>
              <a class="btn btn-default btn sweet-prompt" onclick="open_popup('socket_type',0);"><i class="fa fa-plus"></i></a>
          </div>
      </div>
      <div id="Pin" class="question-main " style="display: none;">
            <p class="form_title">Base Type</p>
          <div class="required">
              <label class="">Pin<span class="text-danger">*</span></label>
              <select data-placeholder="Select" class="type-selector chosen-select"  id="pin_type" name="PinTypeID" multiple>
                  <option value=""></option>
                   <?php 
                  foreach ($PinType as $rec) {
                      echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>';
                  }?>
              </select>
              <a class="btn btn-default btn sweet-prompt" onclick="open_popup('pin_type',0);"><i class="fa fa-plus"></i></a>
          </div>
      </div>
      <div id="TubeModel" class="question-main " style="display: none;">
            <p class="form_title">Base Type</p>
          <div class="required">
              <label class="">Model<span class="text-danger">*</span></label>
              <select data-placeholder="Select" class="type-selector chosen-select"  id="tube_model" name="TubeModelID" multiple>
                  <option value=""></option>
                  <?php 
                  foreach ($TubeModel as $rec) {
                      echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>';
                  }?>
              </select>
              <a class="btn btn-default btn sweet-prompt" onclick="open_popup('tube_model',0);"><i class="fa fa-plus"></i></a>
          </div>
      </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group ">
                <div style="display: inline-block;">
                <?php echo form_label('Lighting Source Type','LightingSourceTypeID',$attributes=array());?>
                <!-- <input type="hidden" value="true" name="DriverType"> -->
                <?php foreach ($LightingSourceType as $key => $value) {?>
                    <div class="col ">
                        <span class="radio-wrapper"> 
                            <input type="radio" name="LightingSourceTypeID" id="LightingSourceTypeID<?php echo($value)?>" value="<?php echo($value)?>" onchange="changeLightSourceType(this)" checked >
                            <div>
                                
                            </div> 
                        </span> 
                        <span class="table-cell"> 
                            <label for="LightingSourceTypeID<?php echo($value)?>"><?php echo($key)?></label> 
                        </span> 
                    </div>
                <?php } ?>
               </div>
          </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <div style="display: inline-block;" id="led_type_div" class="hide">

                <?php echo form_label('LED Type','type',$attributes=array());?>
                <!-- <input type="hidden" value="true" name="DriverType"> -->
                <?php foreach ($LEDType as $key => $value) {?>
                    <div class="col ">
                        <span class="radio-wrapper"> 
                            <input type="radio" name="led_type" id="led_type<?php echo($value['ID'])?>" value="<?php echo($value['ID'])?>" >
                            <div>
                                
                            </div> 
                        </span> 
                        <span class="table-cell"> 
                            <label for="led_type<?php echo($value['ID'])?>"><?php echo($value['Name'])?></label> 
                        </span> 
                    </div>
                <?php } ?>
               </div>
          </div>
        </div>
    </div>      
    <div class="row">
        <div class="col-xs-6 form-group">
            <p class="form_title">Fitting fire rated state</p>
            <input type="hidden" name="Firerated" value="0" />
            <input type="checkbox" id="firerated" name="Firerated" value="1" <?php echo isset($fitting->Firerated) ? ($fitting->Firerated == '1' ? 'checked' : '') : ''; ?> />
            <label for="firerated"> fire rated </label>
      </div>
      <div class="col-xs-6 form-group">
        <p class="form_title">Family shortcut code</p>
        <input type="text" class=" required" name="FamilyShortcut" maxlength="2"/>
      </div>

    </div>
    <div class="row">
        <div class="col-xs-6 question-main form-group">
            <!-- <p class="form_title">Family name<span class="text-danger">*</span></p> -->
            <ul class="nav nav-tabs" role="tablist">
                <?php $home_active='active';
                foreach ($Language as $rec) : ?>
                <li class="nav-item <?php echo($home_active);?>"> 
                    <a class="nav-link " data-toggle="tab" href="#<?php echo $rec['Name']?>_family" role="tab">
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
                <div class="tab-pane <?php echo($home_active);?>" id="<?php echo $rec['Name']?>_family" role="tabpanel">
                    <div class="p-20" style="display: inline-grid;">
                        <input type="hidden" name="Language_id[]" value="<?php echo $rec['ID']?>"/>
                        <div class="col1">
                            <label>Family name</label><span class="text-danger">*</span>
                        </div>
                        <div class="col2">
                            <input type="text" class=" required" name="ProductFamily[]" onchange="change_family(this)" />
                        </div>
                        <div class="col1">
                            <label>Family description</label><span class="text-danger">*</span>
                        </div>
                        <div class="col2">
                            <textarea name="ProductFamilyDescription[]" rows="10" cols="60"></textarea>
                        </div>
                    </div>
                </div>
                <?php $home_active='';?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
      
</div>

<script type="text/javascript">
    $('[name="ProductFamilyDescription[]"]').each(function() {
        CKEDITOR.replace(this);
    });
</script>