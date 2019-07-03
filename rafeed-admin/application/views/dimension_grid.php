<style>
.modal-dialog {
    width: 460px;
  }
.modal-header {
    background-color: #DBAE27;
    padding:16px 16px;
    color:#FFF;
    border-bottom:2px dashed #DBAE27;
  }
.modal-title{
  color:#FFF;
}
.btn-primary{
  background-color: #DBAE27;
  border: 1px solid #DBAE27;
}
.btn-primary:active{
  background-color: #DBAE27 !important;
  border: 1px solid #DBAE27 !important;
}
.btn-primary:hover{
  background-color: #DBAE27 !important;
  border: 1px solid #DBAE27 !important;
}
</style>

<!-- MemberModal -->

<div class="modal fade" role="dialog" id="uploadPhotosModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload product photos</h4>
      </div>
      <?php echo form_open_multipart('Premium_product/change_product_photo',$attributes=array('id'=>'change_product_photoForm','method'=>'post'));?>
      <div class="modal-body">        
     <div class="row">
        <div class="col-xs-6">
          <div class="form-group ">
          <?php echo form_label('Photos','product_photo',$attributes=array());
            echo "<input type='file' name='product_photo[]' id='product_photo' class='form-control' multiple ></input>";
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

<!-- MemberModal -->

<div class="modal fade" role="dialog" id="updatePricesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Product Prices </h4>
      </div>
      <?php echo form_open('Premium_product/change_product_dimension_price',$attributes=array('id'=>'change_product_pricesForm','method'=>'post'));?>
      <div class="modal-body">
      <div class="form-group " id="error_msg">

      </div>        
      <table class="table table-bordered" id="power_table">
        <tr>
          <th>Power</th>
          <th>Price</th>
        </tr>
      </table>   
       
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
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_premium_dimension.js"></script>
