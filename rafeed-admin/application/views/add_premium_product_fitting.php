<div id="_fitting">
  <div class="row">
    <div class="col-xs-6 form-group ">
      <div class="">
        <p class="form_title">Lighting source type<span class="text-danger">*</span></p>
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
    </div>
    <div class="col-xs-6 form-group ">
      <div id="Socket" class="question-main" style="<?php echo ((isset($fitting->SocketTypeID) && !is_null($fitting->SocketTypeID)) ? '' : 'display: none;')?>">
           <div class="required">
              <label class="">Socket Type<span class="text-danger">*</span></label>
              <select data-placeholder="Select" class="type-selector chosen-select"  id="socket_type" name="SocketTypeID[]" multiple>
                  <option value=""></option>
                    <?php 
                      $val='';
                      $val= isset($fitting->SocketTypeID) ? $fitting->SocketTypeID : '';
                      foreach ($SocketType as $rec) {
                      $selected='';
                      if($rec['ID'] == $val)
                           $selected='selected';
                      echo '<option value="'.$rec['ID'].'" '.$selected .'>'.$rec['Name'].'</option>';
                    } ?>
              </select>
              <a class="btn btn-default btn sweet-prompt" onclick="open_popup('socket_type',0);"><i class="fa fa-plus"></i></a>
          </div>
      </div>
      <div id="Pin" class="question-main " style="<?php echo ((isset($fitting->PinTypeID) && !is_null($fitting->PinTypeID)) ? '' : 'display: none;')?>">
          <div class="required">
              <label class="">Pin Type<span class="text-danger">*</span></label>
              <select data-placeholder="Select" class="type-selector chosen-select"  id="pin_type" name="PinTypeID[]" multiple>
                  <option value=""></option>
                  <?php 
                  $val='';
                  $val= isset($fitting->PinTypeID) ? $fitting->PinTypeID : '';
                  foreach ($PinType as $rec) {
                      $selected='';
                      if($rec['ID'] == $val)
                           $selected='selected';
                      echo '<option value="'.$rec['ID'].'" '.$selected .'>'.$rec['Name'].'</option>';
                  }?>
              </select>
              <a class="btn btn-default btn sweet-prompt" onclick="open_popup('pin_type',0);"><i class="fa fa-plus"></i></a>
          </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6 form-group ">
      <p class="form_title">Fitting firerated state</p>  <br/>
      <input type="hidden" name="Firerated" value="0" />
      <input type="checkbox" id="firerated" name="Firerated" value="1" <?php echo isset($fitting->Firerated) ? ($fitting->Firerated == '1' ? 'checked' : '') : ''; ?> />
      <label for="firerated"> firerated </label>
    </div>
    <div class="col-xs-6 form-group ">
      <p class="form_title">Driver mode</p>
      <br/>
      <!-- <input type="hidden" name="IsExternal" value="0" />
      <input type="checkbox" name="IsExternal" value="1" checked="true" />  
      <label for="IsExternal"> Is External </label>  -->
      <div class="col ">
        <span class="radio-wrapper"> 
            <input type="radio" name="IsExternal" id="External" value="1">
            <div>
                
            </div> 
        </span> 
        <span class="table-cell"> 
            <label for="External"> External </label> 
        </span> 
    </div>

    <div class="col ">
        <span class="radio-wrapper"> 
            <input type="radio" name="IsExternal" id="Internal" value="0">
            <div>
                
            </div> 
        </span> 
        <span class="table-cell"> 
            <label for="Internal"> Internal </label> 
        </span> 
    </div>
    </div>
  </div> 
  <div class="row">
    <div class="col-xs-6 form-group ">
      <p class="form_title">Fitting supplier<span class="text-danger">*</span></p><br/>
      <select data-placeholder="Select" class="text_field chosen-select"  id="Supplier" name="Fitting_supplierID" value="<?php echo isset($fitting->SupplierID) ? $fitting->SupplierID : ''; ?>">
          <option value=""></option>
          <?php foreach ($Supplier as $rec) : ?>
              <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="col-xs-6 form-group ">
      <!-- <p class="form_title">What is the cost?</p><br/>
      <input type="number" class="text_field" name="FittingCost"/> -->
      <p class="form_title">Installation way<span class="text-danger">*</span></p><br/>
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
    <div class="col-xs-6">
      <div class="question-main">
        <div class="table-responsive form-group">
          <table class="table table-bordered" id="ip_table">
            <tr>
              <th></th>
              <th>IP value</th>
              <th></th>
            </tr>
            <tr>
                <td>
                <div style="display: inline-flex;border: none;">
                  <span class="radio-wrapper" style="margin-top: 7px"> 
                      <input type="checkbox" name="IP_check_checkbox" id="IP_type0" onchange="changeIPType(this);"/>
                      <div>
                      
                      </div> 
                      <input type="hidden" name="IP_check[]" value="0" />
                  </span>
                  <span class="table-cell"> 
                    <label for="IP_type0">Muliple IP</label> 
                  </span> 
                  </div>
                </td>
                <td>
                  <div id="s_ip">
                    <p class="form_title">Single IP<span class="text-danger">*</span></p>
                    <input type="number" class="text_field required" min=0 name="FittingSingleIP[]" value="0"/>
                  </div>
                  <div id="m_ip" class="hide">
                    <p class="form_title">Front IP<span class="text-danger">*</span></p>
                    <input type="number" class="text_field required" min=0 name="FittingFrontIP[]" value="0"/>
                    <p class="form_title">Back IP<span class="text-danger">*</span></p>
                    <input type="number" class="text_field required" min=0 name="FittingBackIP[]" value="0"/>
                  </div>
                </td>
                <td></td>
            </tr>
          </table>
          <div align="right">
            <button type="button" name="add" id="add_IP_value" class="btn btn-success btn-xs">+</button>
          </div>
        </div>
      </div>
      </div>
      <div class="col-xs-6 form-group ">
        <div class="question-main">
          <p class="form_title">Product IK</p>
          <input type="text" class="text_field" min="0" name="FittingIK" value="<?php echo isset($fitting->IK) ? $fitting->IK : ''; ?>"/>
        </div>
      </div>
    </div>
  
  <!-- Dimension -->

  <fieldset class="form-group">
    <legend>Dimension section</legend>
    <div id="dimension-filedset">
      <form>
      <div class="row">
        <div class="col-xs-6 form-group">
          <p class="form_title">Shape</p>
          <select data-placeholder="Select" class="text_field chosen-select required" id="shape" name="form_Shape" onchange="changeShape(this);">
            <option value=""></option>
              <?php foreach ($Shape as $way) : ?>
                  <?php echo '<option value="'.$way['ID'].'">'.$way['Name'].'</option>'?>
              <?php endforeach; ?>
          </select>
          <a class="btn btn-default btn sweet-prompt" onclick="open_popup('shape',1);"><i class="fa fa-plus"></i></a>
        </div>

        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Type</p>
          <input type="hidden" name="form_Adjustable" value="0" />
          <?php foreach ($AdjustableType as $key => $value) {if($value==0)$checked="checked"; else $checked="";?>

              <div class="col ">
                  <span class="radio-wrapper"> 
                      <input type="radio" name="form_AdjustableType" id="form_AdjustableType<?php echo($value)?>" <?php echo $checked; ?> value="<?php echo($value)?>" onchange="changeAdjustableType(this);">
                      <div>
                          
                      </div> 
                  </span> 
                  <span class="table-cell"> 
                      <label for="form_AdjustableType<?php echo($value)?>"> <?php echo($key)?> </label> 
                  </span> 
              </div>
              
          <?php } ?>
        </div>
      </div>
      
      <div class="row">
        <div class="col-xs-6 form-group" id="dim_diameter">
          <p class="form_title">Diameter (˚) </p>
          <input type="number" name="form_diameter" class="form-control-sm required">
        </div>
        <div class="col-xs-6 form-group" id="dim_width">
          <p class="form_title">Width (mm)</p>
          <input type="number" name="form_width" class="form-control-sm required">
        </div>
        <div class="col-xs-6 form-group" id="dim_length">
          <p class="form_title">Length (mm)</p>
          <input type="number" name="form_length" class="form-control-sm required">
        </div>
        <div class="col-xs-6 form-group" id="dim_height">
          <p class="form_title">Height (mm)</p>
          <input type="number" name="form_height" class="form-control-sm required">
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6 form-group" id="dim_diameter">
          <p class="form_title">Cut out (˚) </p>
          <input type="number" name="form_cut_out" class="form-control-sm required">
        </div>
      </div>

      <div class="row" id="ProductType_details" style="display: none;"><!-- style="display: none;" -->
        <div class="col-xs-6 form-group">
             <div class="question-main">
                <p class="form_title">Phases</p>
                <input type="number" min="0" name="form_Phases"/>
            </div>
        </div>
        <div class="col-xs-6 form-group">
             <div class="question-main">
                <p class="form_title">Wires</p>
                <input type="number" min="0" name="form_Wires"/>
            </div>
        </div>
      </div>
      
      <div class="row" id="tilted_adjustable_values" style="display: none;">
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Tilted-Horizental</p>
          <div class=" required">
            <input type="number" class="form-control-sm required" placeholder="From" min="0" name="form_THMin" />
            <input type="number" class="form-control-sm required" placeholder="To" min="0" name="form_THMax" /> 
          </div>
        </div>
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Tilted-Vertical</p>
          <div class="required">
            <input type="number" class="form-control-sm required" placeholder="From" min="0" name="form_TVMin" />
            <input type="number" class="form-control-sm required" placeholder="To" min="0" name="form_TVMax" />
          </div>
        </div>
      </div>

      <div class="row" id="rotated_adjustable_values" style="display: none;">
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Rotated-Horizental</p>
          <div class=" required">
            <input type="number" class="form-control-sm required" placeholder="From" min="0" name="form_RHMin" />
            <input type="number" class="form-control-sm required" placeholder="To" min="0" name="form_RHMax" /> 
          </div>
        </div>
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Rotated-Vertical</p>
          <div class="required">
            <input type="number" class="form-control-sm required" placeholder="From" min="0" name="form_RVMin" />
            <input type="number" class="form-control-sm required" placeholder="To" min="0" name="form_RVMax" />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6 form-group">
            <p class="form_title">Weight</p>
            <input type="number" min="0" name="form_Weight" />
        </div>
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload dimension photo ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="form_dimension_photo[]" multiple>
          
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload product photo ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="form_product_photo[]" multiple>
          
        </div>
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload dailog study photo ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="form_dailog_study_file">
          
        </div>
      </div>
      <div class="row">
        <div class="form-group col-xs-6">
          <input type="hidden" name="form_is_head" value="0" />
          <input type="checkbox" name="form_is_head" id="is_head" value="1" onchange="change_is_head(this);" />
          <label for="is_head">Is head</label>
          <p class="form_title">Head count</p>
          <input type="number" name="form_head_count" value="0" min="0" id="head_count" disabled />
        </div>
      </div>
       <div class="row hidden" id="power_fitting_mixer">
        <div class="form-group col-xs-6">
          <p class="form_title">Max power</p>
          <input type="number" name="form_max_power" value="0" min="0" id="max_power" />
        </div>
        <div class="form-group col-xs-6">
          <p class="form_title">Fitting price</p>
          <input type="number" name="form_fitting_price" value="0" min="0" id="fitting_price" />
        </div>
      </div>
      <div class="row">
        <div class="form-group col-xs-6">
          <p class="form_title">Accessory</p>
          <select data-placeholder="Select" class="text_field chosen-select" id="PrivateFittingAccessory" name="form_AccessoryID" multiple>
              <option value=""></option>
              <?php foreach ($FittingAccessory as $rec) : ?>
                  <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
              <?php endforeach; ?>
          </select>
          <a class="btn btn-default btn" onclick="refresh_accessory_datasource(<?php echo Enums::AccessoryType['private']?>,'PrivateFittingAccessory');"><i class="fa fa-refresh"></i></a>
        </div>
        <div class="form-group col-xs-6">
          <input type="hidden" name="public_accessory" value="0" />
          <input type="checkbox" name="public_accessory" id="public_accessory" value="1" onchange="changePublicAccessory(this);" />
          <label for="public_accessory">use public accessory</label>
          <p class="form_title"></p>
          <select data-placeholder="Select" class="text_field chosen-select" id="PublicFittingAccessory" name="form_PublicAccessoryID" multiple disabled="true">
              <option value=""></option>
              <?php foreach ($FittingAccessory as $rec) : ?>
                  <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
              <?php endforeach; ?>
          </select>
          <a class="btn btn-default btn" onclick="refresh_accessory_datasource(<?php echo Enums::AccessoryType['public']?>,'PublicFittingAccessory');"><i class="fa fa-refresh"></i></a>
        </div>
      </div>

      
      <button type="button" class="btn btn-primary mb-2" id="add_dimension">Save</button>
      </form>
    </div>
  </fieldset>

  <div id="dimension_controls">
    
  </div>

  <div class="table-responsive form-group">
    <table class="table table-bordered" id="dimension_table">
      <tr>
        <th>Shape</th>
        <th>Diameter</th>
        <th>Width</th>
        <th>Length</th>
        <th>Height</th>
        <th>Weight</th>
        <th>Cut out</th>
        <th>Adjustable</th>
        <th colspan="2">Tilted</th>
        <th colspan="2">Rotated</th>
        <th></th>
      </tr>
    </table>
  </div>

  <br/>
  <hr>
  <br/>

  <!-- fitting color -->

  <fieldset>
    <legend>Fitting color section <h5><a onclick="add_ColorSeries()">Add color series</a> / <a type="button" data-toggle="modal" data-target="#add_texture_modal" onclick="addTextureMemberModel()">Add texture</a></h5></legend>
        
    <?php $this->load->view('texture-grid.php');?> 

  </fieldset>
  <div id="color_series">
    <select data-placeholder="Select" class="form-control-sm hide"  id="form_fitting_part" name="PlaceID[]">
      <?php foreach ($Place as $rec) : ?>
          <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
      <?php endforeach; ?>
    </select>
    <select data-placeholder="Select" class="form-control-sm hide"  id="form_texture" name="Texture[]">
      <?php foreach ($Texture as $rec) : ?>
          <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
      <?php endforeach; ?>
    </select>
    <input type="hidden" name="color_series_count" value="0">
   <!--  <div class="table-responsive" id="color_series1">
      Color series #1
      <table class="table table-bordered" id="colorSeries_table">
        <tr>
          <th width="45%">part</th>
          <th width="45%">Texture</th>
          <th width="10%"></th>
        </tr>
         <tr>
          <td>
            <div class="form-group">
              <select data-placeholder="Select" class="form-control-sm required"  id="fitting_part" name="PlaceID[]">
                <?php foreach ($Place as $rec) : ?>
                    <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                <?php endforeach; ?>
              </select>
            </div>
          </td>
          <td>
            <select data-placeholder="Select" class="form-control-sm required"  id="texture" name="Texture[]">
              <?php foreach ($Texture as $rec) : ?>
                  <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
              <?php endforeach; ?>
            </select>
          </td>
          <td></td>
        </tr>
      </table>

      <div align="right">
        <button type="button" name="add" id="add_ColorSeries1" class="btn btn-success btn-xs">+</button>
      </div>

      <div class="custom-file form-group">
        <input type="file" class="custom-file-input" id="validatedCustomFile" required>
        <label class="custom-file-label" for="validatedCustomFile">upload product photo with selected color...</label>
      </div>
    </div> -->
  </div>
  <br/>
  <hr>
  <br/>

  <fieldset>
    <legend>Lighting distribution section</legend>
    <a onclick="add_lightingDistributorSeries()">Add lighting distributor series</a>
  </fieldset>
  <input type="hidden" name="lightingDistributor_series_count" value="1">

  <div id="lightingdistributor_series">
    <h4>Lighting Distributor series #1</h4>
    <div class="table-responsive">
      <table class="table table-bordered" id="lightingDistributorSeries_table1">
        <tr>
          <th width="45%">Kind</th>
          <th width="45%">Texture</th>
          <th width="10%"></th>
        </tr>
        <tr>
          <td>
            <select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="form_lighting_distribution_kind" name="LightingDistributionKindID1[]">
                <?php foreach ($LightingDistributionKind as $rec) : ?>
                    <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                <?php endforeach; ?>
            </select>
            <a class='btn btn-default btn sweet-prompt' onclick='open_popup("lighting_distribution_kind",1);'><i class='fa fa-plus'></i></a>
            <a class="btn btn-default btn" onclick="refresh_datasource('lighting_distribution_kind',1,'form_lighting_distribution_kind');"><i class="fa fa-refresh"></i></a>
          </td>
          <td>
            <select data-placeholder="Select" class=" chosen-select required"  id="form_lighting_distribution_texture" name="LightingDisturbationTextureID1[]">
              <?php foreach ($Texture as $rec) : ?>
                    <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                <?php endforeach; ?>
            </select>
            <a class="btn btn-default btn" onclick="refresh_texture('form_lighting_distribution_texture');"><i class="fa fa-refresh"></i></a>
            <!-- <select data-placeholder="Select" class="form-control-sm  chosen-select  required"  id="lighting_distribution_material" name="LightingDisturbationTextureID[]">
                <?php foreach ($Material as $rec) : ?>
                    <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                <?php endforeach; ?>
            </select> -->
            <!-- <a class='btn btn-default btn sweet-prompt' onclick='open_popup("material",1);'><i class='fa fa-plus'></i></a>
            <a class="btn btn-default btn" onclick="refresh_datasource('material',1,'lighting_distribution_material');"><i class="fa fa-refresh"></i></a> -->
          </td>
          <td></td>
        </tr>
      </table>

      <div align="right">
       <button type="button" name="add" id="add_lightingdistribution" onclick="add_lightingdistributor(1);" class="btn btn-success btn-xs">+</button>
      </div>
    </div>
  </div>

  <br/>
  
</div>
