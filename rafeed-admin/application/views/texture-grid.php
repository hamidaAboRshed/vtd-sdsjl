<link rel="stylesheet" href="<?php echo base_url();?>/assets/image-crop/css/jquery.Jcrop.css" type="text/css" />
<script src="<?php echo base_url();?>/assets/image-crop/js/jquery.Jcrop.js"></script>
<script src="<?php echo base_url();?>/assets/js/app/crop-img.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_texture.js"></script>

<style type="text/css">
  #texture_img {
    background-color: #ccc;
    width: 600px;
    height: 400px;
    font-size: 24px;
    display: block;
  }
.jcrop-keymgr{
  display: none !important;
}
/* Apply these styles only when #preview-pane has
   been placed within the Jcrop widget */
.jcrop-holder #preview-pane {
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;

  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;

  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}

/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
#preview-pane .preview-container {
  width: 250px;
  height: 250px;
  overflow: hidden;
}


</style>

<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_texture_modal" onclick="addTextureMemberModel()">
  add texture
</button> -->
<!-- Modal -->
<div class="modal fade" id="add_texture_modal" role="dialog" aria-labelledby="TextureModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TextureModalLabel">Add Texture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open_multipart('Fitting_color/create_texture',$attributes=array('id'=>'createTextureForm'));?>
      <div class="modal-body">
        
        <div class="row">
           <div class="form-group col-xs-6">
            <label class="form_title" for="color">Color<span class="">*</span></label>
            <select data-placeholder="Select" class="form-control text_field chosen-select" id="color" name="ColorID">
              <?php foreach ($Color as $key => $value) {
                echo '<option value="'.$value['ID'].'">'.$value['Name'].'</option>';
              } ?>
            </select>
            <a class="btn btn-default btn sweet-prompt" onclick="open_popup('color',1);"><i class="fa fa-plus"></i></a>
          </div>
          <div class="form-group col-xs-6">
            <label class="form_title" for="material">Material<span class="">*</span></label>
            <select data-placeholder="Select" class="form-control text_field chosen-select" id="material" name="MaterialID">
              <?php foreach ($Material as $key => $value) {
                echo '<option value="'.$value['ID'].'">'.$value['Name'].'</option>';
              } ?>
            </select>
            <a class="btn btn-default btn sweet-prompt" onclick="open_popup('material',1);"><i class="fa fa-plus"></i></a>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-xs-6">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="Texture_file" name="Texture" >
              <label class="custom-file-label" for="validatedCustomFile">Upload product photo to get texture...</label>
              <!-- <input type="button" name="crop" onclick="crop_image()"> -->
            </div>
          </div>  
        </div>
        
       <div class="row">
        <div class="form-group col-xs-7">
          <img id="texture_img" src="<?php echo base_url();?>/assets/images/nature.jpg">
          <input type="hidden" id="x" name="x" />
          <input type="hidden" id="y" name="y" />
          <input type="hidden" id="w" name="w" />
          <input type="hidden" id="h" name="h" />
        </div>
        <div class="col-xs-4">
          <div id="preview-pane">
            <div class="preview-container">
              <img src="<?php echo base_url();?>/assets/images/nature.jpg" class="jcrop-preview" alt="Preview" />
            </div>
          </div>
        </div>
        
      </div>
      
     </div>
        
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
    </div>
    <?php echo form_close()?>
  </div>
</div>
</div>