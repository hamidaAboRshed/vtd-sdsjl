<!-- MemberModal -->

<div class="modal fade" role="dialog" id="uploadPhotoModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload photos</h4>
      </div>
      <?php echo form_open_multipart($action,$attributes=array('id'=>'change_photoForm','method'=>'post'));?>
      <div class="modal-body">        
     <div class="row">
        <div class="col-xs-6">
          <div class="form-group ">
          <?php echo form_label('Photo','photo',$attributes=array());
            echo "<input type='file' name='photo' id='photo' class='form-control' ></input>";
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

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_index.js"></script>