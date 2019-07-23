
<!-- MemberModal -->

<div class="modal fade" role="dialog" id="addEconomicProductModal">
  <div id="E-series" class="modal-dialog" role="document" style="    height: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Economic Product</h4>
      </div>
      <?php echo form_open('Economic_product/add_family',$attributes=array('id'=>'add_productForm','method'=>'post'));?>
      <div class="modal-body">        
		  
      <?php $this->load->view('add_economic_product.php'); ?>  
		   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-primary","id"=>"submit"));?>
      </div>
	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- upload MemberModal -->
<div class="modal fade" role="dialog" id="uploadPhotosModal">
  <div id="E-series" class="small modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload family files</h4>
      </div>
      <?php echo form_open_multipart('Economic_product/change_family_photo',$attributes=array('id'=>'change_product_photoForm','method'=>'post'));?>
      <div class="modal-body">        
     <div class="">
      <div class="col">
            <div class="form-group ">
          <?php echo form_label('File type','attachment_type',$attributes=array());
          echo "<select name='AttachmentTypeID'>";
          foreach ($AttachmentType as $rec) : ?>
            <option value="<?php echo $rec['ID']; ?>"><?php echo $rec['Name']; ?></option>
          <?php endforeach;?>
          </select>
           </div>
          </div>
          <div class="col">
            <div class="form-group ">
            <?php echo form_label('Photos','product_photo',$attributes=array());
              echo "<input type='file' name='product_photo' id='product_photo' class='form-control' ></input>";
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

<!-- upload MemberModal -->
<div class="modal fade" role="dialog" id="uploadApplicationPhotosModal">
  <div id="E-series" class="small modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload application files</h4>
      </div>
      <?php echo form_open_multipart('Economic_product/change_family_application_photo',$attributes=array('id'=>'change_application_photoForm','method'=>'post'));?>
      <div class="modal-body">        
     <div class="">
      <div class="col">
            <div class="form-group ">
          <?php echo form_label('Installation way','installation_id',$attributes=array());?>
          <select name='installation_id' id="Installation_way_id">
          </select>
           </div>
          </div>
          <div class="col">
            <div class="form-group ">
            <?php echo form_label('Photo','application_photo',$attributes=array());
              echo "<input type='file' name='application_photo' id='application_photo' class='form-control' ></input>";
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

<!-- checkMember -->
<div class="modal fade" tabindex="-1" role="dialog" id="checkEconomicProductModal">
  <div id="E-series" class="small modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Check Economic Family</h4>
      </div>
      <div class="modal-body">
        <p>Do you want to recoding all product options in this family ?</p>
        <div class="form-group " id="error_msg"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" id="checkMemberBtn" class="btn btn-primary">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- checkMember -->

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_economic_products.js"></script>
<script src="<?php echo base_url();?>/assets/js/app/index_popup.js"></script>
<script type="text/javascript">
  
  $(document).ready(function() {
      $('#button-action').append('<a class="btn btn-default pull pull-right" href="#" onclick="addEconomicProduct()" data-toggle="modal" data-target="#addEconomicProductModal" >Add</a>');
  });
</script>
