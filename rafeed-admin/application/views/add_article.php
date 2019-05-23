<script src="<?php echo base_url();?>assets/standard_ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style_article.css">
<link href="<?php echo base_url();?>assets/select2/select2.min.css" rel="stylesheet" />
<script src="<?php echo base_url();?>assets/select2/select2.min.js"></script>


<?php echo form_open_multipart('article/create_article',$attributes=array('id'=>'createForm'));?> 

<div class="row">
    <div class="col-xs-12  form-group">
 
		<div class="row card" style="margin:4% 2%;">
	      	<div class="col-xs-8">

	      		<div class="form-group ">					  
				   <input type="text" name="ArticleTitle" placeholder ="Title"  class="form-control" id="ArticleTitle" required />

	 		  </div>
	      	</div>


	  		<div class="col-xs-4">
		  		<div class="form-group">
				   <input type="file" class="form-control" name="SubImage" onchange="readURLImage(this,'#blahsub');" value="Article Sub Image" required/>
			   </div>
		  	</div>


	      	<div class="col-xs-8">
	      		<div class="form-group">
				 <textarea name="ArticleAbsrtact" cols="40" rows="10" class="form-control" id="ArticleAbsrtact" placeholder ="Article Absrtact" required >Abstract</textarea>
	 		  </div>
	      	</div>


	      	<div class="col-md-4 text-center">
      			<img class="img-shadow" id="blahsub" src="<?php echo base_url('assets/images/blog/sub-image.png'); ?>" alt="your image"  width='300' height='300'  />
     
      		</div>

      		<!-- Main image  and keyword -->
      		<div class="col-xs-8">
		  		<div class="form-group">

				   <input type="file" class="form-control"  name="MainImage" onchange="readURLImage(this,'#blah');" value="Article Main Image" required/>
			   </div>
		  	</div>

			<div class="colxs-4" id="Keyword"></div>

  			<div class="col-md-8 text-center">
  				<img class="img-shadow" id="blah" src="<?php echo base_url('assets/images/blog/main-image.png'); ?>" alt="your image" />
  			</div>

  			<div class="col-md-4 text-center">
		       	<div  class="col-xs-12 keyword-box">
		       		<p>Keywords</p>
			 		<select class="js-example-tokenizer form-control" multiple="multiple">

				 		<?php foreach ($Keyword as $key => $value) { ?>

				 			<option><?php echo $value['Value'] ?></option>

				 		<?php } ?>

					</select>

					<input type="hidden" id="select2-value" name="Keyword_from_select2" value="">
		       	</div>	
		     </div>	 


		  	<div class="col-xs-12 mar-3">
		       	 <button type="button" class="btn btn-primary" id='AddParagraph' >Add Paragraph</button>
		       	 <input type="hidden" name="rowcount" id="rowcount"  value="0"	 />
	       	</div>


			<div id="ar_info">
				  
				 <div class="col-xs-12 paragraph mar-5 " >
					
				</div>

			</div>

		   <div class="modal-footer col-xs-12">
	 			<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-success","id"=>"submit","form"=>"createForm"));?>
	       </div>


		</div> 
		      
	</div>
</div>
 <?php echo form_close()?>

  <script src="<?php echo base_url();?>assets/js/app/article.js"></script>
<script type="text/javascript">
window.base_url = <?php echo json_encode(base_url()); ?>;
</script>