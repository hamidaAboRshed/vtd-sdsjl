<div id="_fitting">
<!-- Dimension -->
<input type="hidden" name="economic_product_id" value="<?php echo $economic_product_id ?>">
<input type="hidden" name="economic_product_collection_id" id="economic_product_collection_id" value="<?php echo $economic_product_collection_id ?>">
  <fieldset class="form-group">
    <legend>Dimension section</legend>
    <div id="">
      <div class="row">
        <div class="col-xs-6 form-group">
          <p class="form_title" for="shape">Shape</p>
          <select data-placeholder="Select" class="text_field chosen-select required" id="shape" name="shape" onchange="changeShape(this);" value="<?php echo(isset($shape)? $shape : '')?>" required>
            <option value=""></option>
              <?php foreach ($Shape as $way) : ?>
                  <?php echo '<option value="'.$way['ID'].'">'.$way['Name'].'</option>'?>
              <?php endforeach; ?>
          </select>
          <a class="btn btn-default btn sweet-prompt" onclick="open_popup('shape',1);"><i class="fa fa-plus"></i></a>
        </div>

        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Type</p>
          <input type="hidden" name="Adjustable" value="0" />
          <?php foreach ($AdjustableType as $key => $value) {if($value==0)$checked="checked"; else $checked="";?>

              <div class="col ">
                  <span class="radio-wrapper"> 
                      <input type="radio" name="AdjustableType" id="form_AdjustableType<?php echo($value)?>" <?php echo $checked; ?> value="<?php echo($value)?>" onchange="changeAdjustableType(this);">
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
        <div class="col-xs-6 form-group " id="dim_diameter">
          <p class="form_title">Diameter (˚) </p>
          <input type="number" step=".00" name="diameter" class="form-control-sm required">
        </div>
        <div class="col-xs-6 form-group" id="dim_width">
          <p class="form_title">Width (mm)</p>
          <input type="number" step=".00" name="width" id="width" class="form-control-sm required" required="required">
        </div>
        <div class="col-xs-6 form-group" id="dim_length">
          <p class="form_title">Length (mm)</p>
          <input type="number" step=".00" name="length" id="length" class="form-control-sm required" required>
        </div>
        <div class="col-xs-6 form-group" id="dim_height">
          <p class="form_title">Height (mm)</p>
          <input type="number" step=".00" name="height" id="height" class="form-control-sm required" required>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6 form-group" id="dim_diameter">
          <p class="form_title">Cut out (˚) </p>
          <input type="number" step=".00" name="cut_out" class="form-control-sm required">
        </div>
      </div>

      <!-- style="display: none;" -->
      <!-- <div class="row" id="ProductType_details" style="display: none;">
        <div class="col-xs-6 form-group">
             <div class="question-main">
                <p class="form_title">Phases</p>
                <input type="number" min="0" name="Phases"/>
            </div>
        </div>
        <div class="col-xs-6 form-group">
             <div class="question-main">
                <p class="form_title">Wires</p>
                <input type="number" min="0" name="Wires"/>
            </div>
        </div>
      </div> -->
      
     <div class="row" id="tilted_adjustable_values" style="display: none;">
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Tilted-Horizental</p>
          <div class=" required">
            <input type="number" step=".00" class="form-control-sm required" placeholder="From" min="0" name="THMin" />
            <input type="number" step=".00" class="form-control-sm required" placeholder="To" min="0" name="THMax" /> 
          </div>
        </div>
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Tilted-Vertical</p>
          <div class="required">
            <input type="number" step=".00" class="form-control-sm required" placeholder="From" min="0" name="TVMin" />
            <input type="number" step=".00" class="form-control-sm required" placeholder="To" min="0" name="TVMax" />
          </div>
        </div>
      </div>

      <div class="row" id="rotated_adjustable_values" style="display: none;">
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Rotated-Horizental</p>
          <div class=" required">
            <input type="number" step=".00" class="form-control-sm required" placeholder="From" min="0" name="RHMin" />
            <input type="number" step=".00" class="form-control-sm required" placeholder="To" min="0" name="RHMax" /> 
          </div>
        </div>
        <div class="col-xs-6 form-group">
          <p class="form_title">Adjustable Rotated-Vertical</p>
          <div class="required">
            <input type="number" step=".00" class="form-control-sm required" placeholder="From" min="0" name="RVMin" />
            <input type="number" step=".00" class="form-control-sm required" placeholder="To" min="0" name="RVMax" />
          </div>
        </div>
      </div>
     
      <div class="row">
        <div class="col-xs-6 form-group">
            <p class="form_title">Weight</p>
            <input type="number" min="0" name="Weight" id="Weight" />
        </div>
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload dimension photo ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="dimension_photo[]" multiple>
          
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload product photo ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="product_photo[]" multiple>
          
        </div>
        <div class="col-xs-6 form-group">
          <label class="custom-file-label" for="validatedCustomFile">Upload dailog study photo ...</label>
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="dailog_study_file">
          
        </div>
      </div>
       <!-- <div class="row">
        <div class="form-group col-xs-6">
          <input type="hidden" name="is_head" value="0" />
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
      </div> -->
      <div class="row">
        <div class="form-group col-xs-6">
          <p class="form_title">Accessory</p>
          <select data-placeholder="Select" class="text_field chosen-select" id="PrivateFittingAccessory" name="AccessoryID[]" multiple>
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
          <select data-placeholder="Select" class="text_field chosen-select" id="PublicFittingAccessory" name="AccessoryID[]" multiple disabled="true">
              <option value=""></option>
              <?php foreach ($FittingAccessory as $rec) : ?>
                  <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
              <?php endforeach; ?>
          </select>
          <a class="btn btn-default btn" onclick="refresh_accessory_datasource(<?php echo Enums::AccessoryType['public']?>,'PublicFittingAccessory');"><i class="fa fa-refresh"></i></a>
        </div>
      </div>
    </div>
  </fieldset>

  


  

  <!-- fitting color -->

  <fieldset>
    <legend>Fitting color section <h5><!-- <a onclick="add_ColorSeries()">Add color series</a>  /--> <a type="button" data-toggle="modal" data-target="#add_texture_modal" onclick="addTextureMemberModel()">Add texture</a></h5></legend>
        
    <?php $this->load->view('texture-grid.php');?> 

  </fieldset>
  <div id="color_series">
    <div id="edit_economic_color"></div>
    <div id="add_economic_color">
    <select data-placeholder="Select" class="form-control-sm hide"  id="form_fitting_part">
      <?php foreach ($Place as $rec) : ?>
          <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
      <?php endforeach; ?>
    </select>
    <select data-placeholder="Select" class="form-control-sm hide"  id="form_texture">
      <?php foreach ($Texture as $rec) : ?>
          <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
      <?php endforeach; ?>
    </select>
    <div class="table-responsive" id="color_series1">
      <table class="table table-bordered" id="colorSeries_table">
        <tr>
          <th width="45%">Part</th>
          <th width="45%">Texture</th>
          <th width="10%"></th>
        </tr>
         <tr>
          <td>
            <div class="form-group">
              <select data-placeholder="Select" class="form-control-sm chosen-select required"  id="fitting_part1" name="PlaceID[]">
                <?php foreach ($Place as $rec) : ?>
                    <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                <?php endforeach; ?>
              </select>
              <a class='btn btn-default btn sweet-prompt' onclick='open_popup("fitting_part",1);'><i class='fa fa-plus'></i></a>
              <a class="btn btn-default btn" onclick="refresh_datasource('fitting_part',1,'fitting_part1');"><i class="fa fa-refresh"></i></a>
            </div>
          </td>
          <td>
            <select data-placeholder="Select" class="form-control-sm chosen-select required"  id="texture" name="TextureID[]">
              <?php foreach ($Texture as $rec) : ?>
                  <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
              <?php endforeach; ?>
            </select>
            <a class="btn btn-default btn" onclick="refresh_texture('texture1');"><i class="fa fa-refresh"></i></a>
          </td>
          <td></td>
        </tr>
      </table>

      <div align="right">
        <button type="button" name="add" id="add_ColorSeries1" class="btn btn-success btn-xs"  onclick="add_color(1)">+</button>
      </div>

      <div class="custom-file form-group">
        <input type="file" class="custom-file-input" id="validatedCustomFile" required>
        <label class="custom-file-label" for="validatedCustomFile">upload product photo with selected color...</label>
      </div>
    </div>
    </div>
  </div>
  <br/>
  <hr>
  <br/>

  <fieldset>
    <legend>Lighting distributor section</legend>
    <!-- <a onclick="add_lightingDistributorSeries()">Add lighting distributor series</a> -->
  </fieldset>
  <div id="edit_economic_lighting_distribution"></div>
  <div id="add_economic_lighting_distribution">
  <input type="hidden" name="lightingDistributor_series_count" value="1">
  <div id="lightingdistributor_series">
    <div class="table-responsive">
      <table class="table table-bordered" id="lightingDistributorSeries_table">
        <tr>
          <th width="45%">Kind</th>
          <th width="45%">Texture</th>
          <th width="10%"></th>
        </tr>
        <tr>
          <td>
            <select data-placeholder="Select" class="form-control-sm  chosen-select required"  id="form_lighting_distribution_kind" name="LightingDistributionKindID[]">
                <?php foreach ($LightingDistributionKind as $rec) : ?>
                    <?php echo '<option value="'.$rec['ID'].'">'.$rec['Name'].'</option>'?>
                <?php endforeach; ?>
            </select>
            <a class='btn btn-default btn sweet-prompt' onclick='open_popup("lighting_distribution_kind",1);'><i class='fa fa-plus'></i></a>
            <a class="btn btn-default btn" onclick="refresh_datasource('lighting_distribution_kind',1,'form_lighting_distribution_kind');"><i class="fa fa-refresh"></i></a>
          </td>
          <td>
            <select data-placeholder="Select" class=" chosen-select required"  id="form_lighting_distribution_texture" name="LightingDisturbationTextureID[]">
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
</div>
  <br/>

  <fieldset>
    <legend>Additional Information</legend>
    <!-- <a onclick="add_lightingDistributorSeries()">Add lighting distributor series</a> -->
  </fieldset>
  <div class="row">
    <div class="col-xs-6">
      <div class="question-main">
        <div class="form-group">
          <p class="form_title">Product IP<span class="text-danger">*</span></p>
          
          <div style="display: inline-flex;border: none;">
            <span class="radio-wrapper" style="margin-top: 7px"> 
                <input type="checkbox" name="IP_check_checkbox" id="IP_type0" onchange="changeIPType(this);"/>
                <div>
                
                </div> 
                <input type="hidden" name="IP_check_checkbox" value="0" />
            </span>
            <span class="table-cell"> 
              <label for="IP_type0">Muliple IP</label> 
            </span> 
          </div>

          <div id="s_ip">
            <p class="form_title">Single IP<span class="text-danger">*</span></p>
            <input type="number" class="text_field required" min=0 name="FittingSingleIP" value="0"/>
          </div>
          <div id="m_ip" class="hide">
            <p class="form_title">Front IP<span class="text-danger">*</span></p>
            <input type="number" class="text_field required" min=0 name="FittingFrontIP" value="0"/>
            <p class="form_title">Back IP<span class="text-danger">*</span></p>
            <input type="number" class="text_field required" min=0 name="FittingBackIP" value="0"/>
          </div>
        </div>
      </div>
      </div>
      <div class="col-xs-6 form-group ">
        <div class="question-main">
          <p class="form_title">Product IK</p>
          <input type="number" class="text_field" min="0" name="FittingIK" value="<?php echo isset($fitting->IK) ? $fitting->IK : ''; ?>"/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-6 form-group">
        <p class="form_title">Beam angle (°)</p>
            <input type="hidden" name="SymmetricBeam" value="0" />
            <input type="checkbox" id="SymmetricBeam" name="SymmetricBeam" value="1" checked="true" onchange="changeSymmetricBeam(this);"/>  
            <label for="SymmetricBeam">Symmetric</label><br/>
        <div class="question-main" id="SymmetricDiv" >
            <div class="details-row">
                <input type="number" placeholder="" class="" name="BeamAngleValue" />

            </div>
        </div>
        <div class="question-main" id="AsymmetricDiv" style="display: none;">
            <div class="inline">
                <label class="rang-label">H</label>
            </div>
            <div class="inline">
                <input type="number" placeholder="" class=""  name="BeamAngleH" />
            </div>
            <div class="inline">
                <label class="rang-label">V</label>
            </div>
            <div class="inline">
                <input type="number" placeholder="" class=""  name="BeamAngleV" />
            </div>
        </div>
      </div>
        <div class="col-xs-6 form-group" id="IES_files">
            <label class="custom-file-label" for="validatedCustomFile">Upload IES files ...</label>
            <input type="file" class="custom-file-input" id="validatedCustomFile" name="ies_file">
        </div>
    </div>
    <div class="row">
      <div class="col-xs-6 form-group">
          <div class="question-main">
              <p class="form_title">UGR rate</p>
              <input type="number" class="text_field" min="0" name="UGRRate" />
          </div>
      </div>
      
      <div class="col-xs-6 form-group ">
        
      </div>
    </div> 
  
</div>
