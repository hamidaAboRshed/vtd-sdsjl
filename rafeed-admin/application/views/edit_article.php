<!-- css link -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style_article.css">
<link href="<?php echo base_url();?>assets/select2/select2.min.css" rel="stylesheet" />

<!-- scripts -->
<script src="<?php echo base_url();?>assets/standard_ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url();?>assets/select2/select2.min.js"></script>

<?php echo form_open_multipart('Article/update',$attributes=array('id'=>'updateForm'));?> 
<div class="row">
 	<div class="col-xs-12  form-group">
		<div class="row card" style="margin:4% 2%;">
			<div class="col-xs-8">
	  			<div class="form-group ">					  
				   <input type="text" name="ArticleTitle" placeholder ="Title"  class="form-control" id="ArticleTitle" value="<?php  echo $details_article[0]->Title; ?>"  />
				   <input type="hidden"  name="article_id" value="<?php  echo $details_article[0]->Article_id; ?>">
			  	</div>
	     	 </div>
 	  		<div class="col-xs-4">
		  		<div class="form-group">
				   <input type="file" class="form-control" name="SubImage" onchange="readURLImage(this,'#blahsub');" value="Article Sub Image" />
			   </div>
		  	</div>
	      	<div class="col-xs-8">
	      		<div class="form-group">
				 <textarea name="ArticleAbsrtact" cols="40" rows="10" class="form-control" id="ArticleAbsrtact" placeholder ="Article Absrtact"  ><?php  echo $details_article[0]->Abstract; ?></textarea>
	 		  </div>
	      	</div>
	      	<div class="col-md-4 text-center">
	      		<!-- article sub image  -->
      			<img class="img-shadow" id="blahsub" src="<?php echo base_url('../rafeed-includes/upload_files/blog/'); ?><?php echo $details_article[0]->Article_id;?>/<?php echo $details_article[0]->Sub_Image;?>" alt="your image"  width='300'   />
      			<!-- old name for article if not change -->
				<input type="hidden" class="form-control" name="old_sub_img" value="<?php  echo $details_article[0]->Sub_Image; ?>">
      		</div>
      		<!-- Main image  and keyword -->
      		<div class="col-xs-8">
		  		<div class="form-group">
				   <input type="file" class="form-control"  name="MainImage" onchange="readURLImage(this,'#blah');" value="Article Main Image" />
			   </div>
		  	</div>
			<div class="colxs-4" id="Keyword"></div>
  			<div class="col-md-8 text-center">
  				<!-- Article main image -->
  				<img class="img-shadow" id="blah" src="<?php echo base_url('../rafeed-includes/upload_files/blog/'); ?><?php echo $details_article[0]->Article_id;?>/<?php echo $details_article[0]->Main_Image;?>" alt="your image" />
  				<!-- old name of main image  -->
 	  			<input type="hidden" class="form-control" name="old_Main_img" value="<?php  echo $details_article[0]->Main_Image; ?>">
 				
  			</div>
  			<div class="col-md-4 text-center">
		       	<div  class="col-xs-12 keyword-box">
		       		<p>Keywords</p>
			 		<select class="js-example-tokenizer form-control" multiple="multiple">
				 		<?php foreach ($keyword as $key => $value) { ?>
				 			<option selected="selected"><?php echo $value['Value'] ?></option>
				 		<?php } ?>
					</select>
					<input type="hidden" id="select2-value" name="Keyword_from_select2" value="">
		       	</div>	
		    </div>	 
			<div id="ar_info" >
				<div class="col-xs-12 mar-3 ">
		       		 <button type="button" class="btn btn-primary" id='AddParagraph' >Add Paragraph</button>
		       	</div>
				<div class="col-xs-12 paragraph mar-5 " >
					<?php  $index=0;
				  	foreach ($paragraph as  $par => $value) 
				  	{ ?>
					  <!-- start edit paragraph  -->
					  <?php if ($value['Parent_id']==0) 
						{ ?>
							<div class="row body-par" id="edit_row_<?php echo $index; ?>">
								<div class=" head-par">
									<i class="fa fa-minus-circle" aria-hidden="true" onclick="delete_exists_par('#edit_row_<?php echo $index; ?>','<?php echo $value['ID']; ?>');">
									</i>
									<div class="col-xs-12">
										<div class="head-para ">
											<i class="fa fa-chevron-down" data-toggle="collapse" data-target="#collaps_edit_para<?php echo $index; ?>" ></i>
											Paragraph #
											<input class="col-xs-9 flaot-non " type="number" name="edit_OrderNumber_<?php echo $index; ?>" value="<?php echo $value['OrderNumber'];  ?>" min="1"/>
										</div>
									</div>
								</div>
								<div class="row par-content collapse" id="collaps_edit_para<?php echo $index; ?>">
									<div class="info-par" >
										<div class="row">
											<div class="col-xs-6">
												<div class="form-group ">
													<input type="text" name="edit_titlePar_<?php echo $index; ?>" class="form-control" value="<?php echo $value['Title']; ?>"  />
				  									<input type="hidden" class="form-control" name="edit_id_par<?php echo $index; ?>" value="<?php echo $value['ID']; ?>">									
												</div>
											</div>
											<div class="col-xs-6">
												<div class="form-group ">
									    			<input type="file" name="edit_new_ImagePar_<?php echo $index; ?>" class="form-control" onchange="readURLImage(this,'#edit_blah_par<?php echo $index; ?>');"/>
						  							<input type="hidden" class="form-control" name="edit_old_par_img<?php echo $index; ?>" value="<?php echo $value['Photo']; ?>">
												</div>
											</div>
										</div>
										<div class="row">
								    		<div class="col-xs-12">
								    			<div class="form-group ">
								    				 <textarea type="text" name="edit_textPar_<?php echo $index; ?>" class="form-control" >
								    				 <?php echo $value['Body']; ?> 
								    				 </textarea>
								    			</div>
								    		</div>
							    		</div>
							    		<div class="row">
								    		<div class="col-xs-6 text-center">
								    			<img class="img-shadow" id="edit_blah_par<?php echo $index; ?>" 
								    			src="<?php if($value['Photo']!='0')
								    			 {echo base_url() ?>../rafeed-includes/upload_files/blog/<?php echo $details_article[0]->Article_id;?>/<?php echo $value['Photo'];} 
								    			else {echo base_url().'assets/images/blog/image-them.png';}?> "  alt="image" width="380" height="280"/>
								    		</div>
											<div class="col-xs-6">
									    		<div class="col-xs-6  text-center padding-6">
									    			<img src="<?php echo base_url();?>assets/images/blog/them/thems1.png"/>
									    			<br>Them 1
									    			<input type="radio" name="edit_themPar_<?php echo $index; ?>" value='1' <?php if($value['Them']==1){echo 'checked="checked"';} ?> />
									    		</div>
									    		<div class="col-xs-6  text-center padding-6">
									    			<img src="<?php echo base_url();?>assets/images/blog/them/thems2.png"/>
									    			<br>Them 2
									    			<input type="radio" name="edit_themPar_<?php echo $index; ?>" value='2' <?php if($value['Them']==2){echo 'checked="checked"';} ?> />
									    		</div>
									    		<div class="col-xs-6  text-center padding-6">
									    			<img src="<?php echo base_url();?>assets/images/blog/them/thems3.png"/>
									    			<br>Them 3
									    			<input type="radio" name="edit_themPar_<?php echo $index; ?>" value='3' <?php if($value['Them']==3){echo 'checked="checked"';} ?>/>
									    		</div>
									    		<div class="col-xs-6  text-center padding-6">
									    			<img src="<?php echo base_url();?>assets/images/blog/them/thems4.png"/>
									    			<br>Them 4
									    			<input type="radio" name="edit_themPar_<?php echo $index; ?>" value='4' <?php if($value['Them']==4){echo 'checked="checked"';} ?>/>
									    		</div>
									    	</div>
									    </div>
									</div>
									<!-- edit for Sub Paragraph  -->
									<div class="all-sub">
										<input type="hidden" class="form-control" name="edit_count_sub_row<?php echo $index; ?>" value="<?php echo Count($value['sub_paragraph']); ?>">
										<?php foreach ($value['sub_paragraph'] as $key => $value)
								         { ?>
								           	<div class="body-sub-par row row_sub<?php echo $key; ?>" id="edit_row_sub_<?php echo $key; ?>">
								           		<div class="row head-sub">
									           		<i class="fa fa-minus-circle" aria-hidden="true" onclick="delete_exists_par('#edit_row_sub_<?php echo $index; ?>','<?php echo $value['ID']; ?>');">
									           		</i>
									           		<div class="col-xs-12">
									           			<div class="head-subpara">Sub Paragraph #
									           				<input class="col-xs-6 flaot-non-sub" type="number" name="SubOrderNumber_<?php echo $index ?><?php echo $key; ?>" value="<?php echo $value['OrderNumber'];  ?>" min="1"/>
									           			</div>
									           		</div>
								           		</div>
												<div class='info-sub'>
													<div class="row">
											    		<div class="col-xs-6 ">
											    			<div class="form-group ">
											    				<input type="text" name="edit_titleSubPar_<?php echo $index ?><?php echo $key; ?>" class="form-control" 
											    				value="<?php echo $value['Title']; ?>"/>
											    			</div>
											    		</div>
											    		<div class="col-xs-6 ">
											    			<div class="form-group ">
											    				<input type="file" name="edit_new_ImageSubPar_<?php echo $index ?><?php echo $key; ?>" class="form-control" onchange="readURLImage(this,'#edit_blah_subpar<?php echo $index; ?><?php echo $key; ?>');"/>
											    			</div>
											    		</div>
										    		</div>
										    		<div class="row">
											    		<div class="col-xs-12">
											    			<div class="form-group ">
											    				 <textarea type="text" name="edit_textSubPar_<?php echo $index ?><?php echo $key; ?>" class="form-control" rows='8' ><?php echo $value['Body']; ?>
											    				 </textarea>
											    			</div>
											    		</div>
										    		</div>
										    		<div class="row">
											    		<div class="col-xs-6">
												    		<div class="col-xs-6 text-center padding-6">
												    			<img src="<?php echo base_url();?>assets/images/blog/them/thems1.png"/>
												    			<br>Them 1
												    			<input type="radio" name="edit_themsubPar_<?php echo $index; ?><?php echo $key; ?>" value='1' <?php if($value['Them']==1){echo 'checked="checked"';} ?>/>
												    		</div>
												    		<div class="col-xs-6 text-center padding-6">
												    			<img src="<?php echo base_url();?>assets/images/blog/them/thems2.png"/>
												    			<br>Them 2
												    			<input type="radio" name="edit_themsubPar_<?php echo $index; ?><?php echo $key; ?>" value='2' <?php if($value['Them']==2){echo 'checked="checked"';} ?>/>
												    		</div>
												    		<div class="col-xs-6 text-center padding-6">
												    			<img src="<?php echo base_url();?>assets/images/blog/them/thems3.png"/>
												    			<br>Them 3
												    			<input type="radio" name="edit_themsubPar_<?php echo $index; ?><?php echo $key; ?>" value='3' <?php if($value['Them']==3){echo 'checked="checked"';} ?>/>
												    		</div>
												    		<div class="col-xs-6 text-center padding-6">
												    			<img src="<?php echo base_url();?>assets/images/blog/them/thems4.png"/>
												    			<br>Them 4
												    			<input type="radio" name="edit_themsubPar_<?php echo $index; ?><?php echo $key; ?>" value='4' <?php if($value['Them']==4){echo 'checked="checked"';} ?>/>
												    		</div>
												    	</div>
											    		<div class="col-xs-6 text-center">
											    			<img id="edit_blah_subpar<?php echo $index ?><?php echo $key; ?>" src="<?php if($value['Photo']!='0')
										    			 {echo base_url() ?>../rafeed-includes/upload_files/blog/<?php echo $details_article[0]->Article_id;?>/<?php echo $value['Photo'];} 
										    			else {echo base_url().'assets/images/blog/image-them.png';}?>" width="380" height="280"/>
										    			<!-- old sub image name -->
											    			<input type="hidden" class="form-control" name="edit_old_subpar_img<?php echo $index ?><?php echo $key; ?>" value="<?php echo $value['Photo']; ?>">

							  							<input type="hidden" class="form-control" name="edit_id_sub_par<?php echo $index; ?><?php echo $key; ?>" value="<?php echo $value['ID']; ?>">
								
											    		</div>
											    	</div>
												</div>
											</div>
									     <?php
									    } //end foreach subparagraph
									   ?>
									</div> <!-- all sub -->
								</div>
							</div>
					    	<input type="hidden" class="form-control" name="edit_count_par_row" value="<?php echo $index; ?>">

						<?php 
						$index++; 
						} //end if is parent 
						?> 

					<?php
					}  //end foreach paragraph
					?>

				   	<input type="hidden" name="rowcount" id="rowcount"  value="0" />
				</div>
			</div>

			<div class="modal-footer col-xs-12">
				<?php echo form_submit('submit', 'Save Changes',array("class"=>"btn btn-success","id"=>"submit","form"=>"updateForm"));?>
			</div>

 		</div> 
 	</div>
</div>
<?php echo form_close()?>

<script src="<?php echo base_url();?>assets/js/app/article.js"></script>
<script type="text/javascript">
window.base_url = <?php echo json_encode(base_url()); ?>;
</script>