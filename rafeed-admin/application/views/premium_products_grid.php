<script src="<?php echo base_url();?>/assets/ckeditor/ckeditor.js"></script>
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
  background-color: #DBAE27 !important;
  border: 1px solid #DBAE27 !important;
}
.btn-primary:active,.btn-primary:active:focus, .btn-primary:visit{
  background-color: #DBAE27 !important;
  border: 1px solid #DBAE27 !important;
}
.btn-primary:hover{
  background-color: #DBAE27 !important;
  border: 1px solid #DBAE27 !important;
}
#error_msg{
    color: red;
    font-size: 11px; 
}
.check-icon{
    font-size: 20px;
    text-align: center;
}
.fa-check-circle{
	color: #DBAE27;
}
</style>

<div  id="row">
    <div class="card">
        <div class="card-body">
			<div class="messages"></div>
			<a class="btn btn-default pull pull-right" href="<?php echo base_url().index_page(); ?>/product/add_premium_product">Add</a>
			<div class="container-fluid"> <!-- If Needed Left and Right Padding in 'md' and 'lg' screen means use container class -->
				<h5>Filter by:</h5>
				<div class="filter-panel row">
					<div class="filter-block col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<span class="radio-wrapper"> 
							<input type="radio" name="filter" value="-2" id="filter_-2" onchange="family_filter(this,-2);" checked="true">
							<div>
							</div> 
						</span> 
						<span class="table-cell"> 
							<label for="filter_-2">Default</label> 
						</span> 
					</div>
				
				<?php foreach ($filter_options as $key => $value) {?>
					<div class="filter-block col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<span class="radio-wrapper"> 
							<input type="radio" name="filter" value="" id="filter_<?php echo($key)?>" onchange="family_filter(this,'<?php echo($value['ID'])?>');">
							<div>
							</div> 
						</span> 
						<span class="table-cell"> 
							<label for="filter_<?php echo($key)?>"><?php echo($value['Name'])?></label> 
						</span> 
					</div>
				<?php } ?>
					<div class="filter-block col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<span class="radio-wrapper"> 
							<input type="radio" name="filter" value="-1" id="filter_-1" onchange="family_filter(this,-1);">
							<div>
							</div> 
						</span> 
						<span class="table-cell"> 
							<label for="filter_-1">All</label> 
						</span> 
					</div>
				</div>
			</div>
			<table width="100%" class="display nowrap table table-hover table-striped table-bordered" id="PremiumProductMemberTable">
				<thead>
					<tr>
						<th>Family name</th>
						<th>Category</th>
						<th>Solution</th>
						<th>Premium Type</th>
						<th>LightingSource</th>
						<th>Working Temperature</th>
						<th>Life Span</th>
						<th>Warranty</th>
						<th>Supplier</th>
						<th>Review Check</th>
						<th>Options</th>	
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Family name</th>
						<th>Category</th>
						<th>Solution</th>
						<th>Premium Type</th>
						<th>LightingSource</th>
						<th>Working Temperature</th>
						<th>Life Span</th>
						<th>Warranty</th>
						<th>Supplier</th>
						<th>Review Check</th>
						<th>Options</th>		
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>


<!-- removeMember -->
<div class="modal fade" tabindex="-1" role="dialog" id="deletePremiumProductModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Premium Product</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" id="removeMemberBtn" class="btn btn-primary">Yes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- removeMember -->

<!-- checkMember -->
<div class="modal fade" tabindex="-1" role="dialog" id="checkPremiumProductModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Check Premium Family</h4>
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

<!-- upload MemberModal -->
<div class="modal fade" role="dialog" id="uploadPhotosModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload family files</h4>
      </div>
      <?php echo form_open_multipart('Premium_product/change_family_photo',$attributes=array('id'=>'change_product_photoForm','method'=>'post'));?>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Upload application files</h4>
      </div>
      <?php echo form_open_multipart('Premium_product/change_family_application_photo',$attributes=array('id'=>'change_application_photoForm','method'=>'post'));?>
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

<!-- color series MemberModal -->
<div class="modal fade" role="dialog" id="colorSeriesPhotoModal">
  <div class="modal-dialog" role="document" style="width: 700px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Family color series</h4>
      </div>
     
      <div class="modal-body">        
     <div id="color_data">
      
        </div>    
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- family order MemberModal -->
<div class="modal fade" role="dialog" id="premiumFamilyOrderModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change family display order</h4>
      </div>
      <?php echo form_open('Premium_product/change_family_display_order',$attributes=array('id'=>'change_premium_display_orderForm','method'=>'post'));?>
      <div class="modal-body">        
     <div class="">
      <div class="col">
        <div class="form-group ">
          <?php echo form_label('Family order','family_order',$attributes=array());?>
          <input type="number" name="family_order" id="family_order">
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

<!-- family description MemberModal -->
<div class="modal fade" role="dialog" id="premiumFamilyDescriptionModal">
  <div class="modal-dialog" role="document" style="width: 600px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change family description</h4>
      </div>
      <?php echo form_open('Premium_product/change_product_family_description',$attributes=array('id'=>'change_premium_display_descriptionForm','method'=>'post'));?>
      <div class="modal-body">        
     <div class="">
      <div class="col question-main">
        <div class="form-group ">
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
                        <input type="hidden" name="ProductFamily_language_id[]" value="0"/>
                        <div class="col1">
                            <label>Family name</label><span class="text-danger">*</span>
                        </div>
                        <div class="col2">
                            <input type="text" class=" required" name="ProductFamily[]" required />
                        </div>
                        <div class="col1">
                            <label>Family description</label><span class="text-danger">*</span>
                        </div>
                        <div class="col2">
                            <textarea name="ProductFamilyDescription[]" minlength="300" rows="10" cols="60" id="ProductFamilyDescription<?php echo $rec['ID']?>"></textarea>
                        </div>
                    </div>
                </div>
                <?php $home_active='';?>
                <?php endforeach; ?>
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
<script type="text/javascript" src="<?php echo base_url();?>/assets/grid-js/home_premium_products.js"></script>
