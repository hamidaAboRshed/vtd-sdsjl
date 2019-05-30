<div class="modal fade" role="dialog" id="delete_supplier_con_Modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <?php echo form_open_multipart('supplier/delete_supplier_contact',$attributes=array('id'=>'DeleteForm','method'=>'post'));?>
      <div class="modal-body">        
    	 <div class="row">
        	<div class="col-xs-12">
    		    <h4 class="modal-title">Are sure you want to delete this article? </h4>
        	</div>
        </div>    
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" form="DeleteForm">NO</button>
 			<?php echo form_submit('submit', 'YES',array("class"=>"btn btn-danger","id"=>"submit", "form" => "DeleteForm"));?>
      </div>

	  <?php echo form_close()?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_supplier.js"></script>
<script type="text/javascript">
  
  $(document).ready(function() {
      $('#button-action').append('<a class="btn btn-default pull pull-right" href="<?php echo base_url();?>/index.php/supplier/add_supplier_contact/<?php echo $custom_modal_data; ?>">Add</a>');
  });
</script>