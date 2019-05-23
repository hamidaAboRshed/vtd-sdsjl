<link rel="stylesheet" href="<?php echo base_url();?>/assets/lightbox/css/lightbox.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/image-gallery/src/simplegallery.demo1.min.css" />
<h1 class="hide">Product view</h1>
<div id="ESeries">
	<div class="page-header" style="">
		<?php foreach ($product_data as $key => $value) {?>
			<p class="product-name"><?php  echo $value['Name'] ?></p>
			<p class="product-desc"><?php echo strtoupper($product_cat) ?></p>
			<p class="product-desc"><?php echo strtoupper($value['Lighting_Type']) ?></p>
		<?php }?>
		
	</div>
	<div class="product-main-photo">
		<img src="<?php echo base_url();?>/assets/images/products/<?php echo $product_data[0]['ID'] ?>.png">
	</div>
	<div>
		<?php if(!is_null($product_data[0]['ledby'])) {?>
			<img src="<?php echo base_url();?>/assets/images/logo/ledby/<?php echo $product_data[0]['ledby'] ?>.png">
		<?php }?>
	</div>
	<div class="blank-row"></div>
	<div class="main-feature row">
		<div id="" class="col">
			<span><i class="icon-power cat-icon"></i></span>
			<p><?php echo $product_basicFeature['Voltage_HZ']; ?></p>
		</div>
		<div id="" class="col">
			<span><i class="icon-work_hours cat-icon"></i></span>
			<p><?php echo $product_basicFeature['lifespan']; ?></p>
		</div>
		<!-- <div id="" class="col">
			<span><i class="icon-cri cat-icon"></i></span>
			<p>15,000hrs</p>
		</div> -->
		<div id="" class="col">
			<span><i class="icon-ip cat-icon"></i></span>
			<p><?php echo $product_basicFeature['IP']; ?></p>
		</div>
		<div id="" class="col">
			<span><i class="icon-beam_angel cat-icon"></i></span>
			<p><?php echo $product_basicFeature['Beam_angle']; ?></p>
		</div>
		<!-- <div id="" class="col">
			<span><i class="icon-pf cat-icon"></i></span>
			<p>15,000hrs</p>
		</div> -->
		<div id="" class="col">
			<span><i class="icon-Indoor cat-icon"></i></span>
			<p><?php echo $product_basicFeature['Lighting_Type']; ?></p>
		</div>
		<div id="" class="col">
			<span><i class="icon-led cat-icon"></i></span>
			<p><?php echo $product_basicFeature['LEDType']; ?></p>
		</div>
		<div id="" class="col">
			<span><img src="<?php echo base_url();?>/assets/images/icon/lighting/<?php echo $product_basicFeature['Installation_way']; ?>.png" class="cat-icon"/></span>
			<p>Installation way</p>
		</div>
		<div id="" class="col">
			<span><img src="<?php echo base_url();?>/assets/icons/rafeed/image/lm_80.png" class="cat-icon"/></span>
		</div>
		<div id="" class="col">
			<span><i class="icon-ce cat-icon"></i></span>
		</div>
		<div id="" class="col">
			<span><i class="icon-rohs cat-icon"></i></span>
		</div>
	</div>
	<div class="product-description row" style="border-color: transparent;">
		<div class="col no-padding">
			<p class="title">Description</p>
			<p class="body">
				<?php echo $product_data[0]['description'] ?>
			</p>
		</div>
	</div>
	<div class="row">
		<div class="col no-padding">
			<p class="title"><span class="icon-share" style="padding: 8px;padding-left: 0px;"></span>share</p>
			<?php $this->load->view('includes/share_links');?>	
			<div class="boder-top">
				<p class="tri-down">Family Technical Data</p>
			</div>

			<div class="family-tech">
				<table class="table table-hover" id="product_dimension_table"> 
				    <thead>
				      <tr>
				        <th>#</th>
				        <th>Shape</th>
				        <th>Dimension</th>
				        <th>Cutting size</th>
				      </tr>
				    </thead>
				    <tbody>
				     <?php 
				     	foreach ($product_dimension as $key => $value) {
				     		echo "<tr class='clickable-row dim_row' id='".$value['ID']."'><td>".($key+1)."</td>".
				     			"<td>".$value['shape']."</td>".
				     			"<td>".$value['size']."</td>".
				     			"<td>".$value['cutting_size']."</td></tr>";
				     	}
				     ?>
				    </tbody>
				  </table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col no-padding">
			<p class="title">Application</p>
			<p class="body">
				<?php echo $product_data[0]['application'] ?>
			</p>
		</div>
	</div>
</div>

<div class="application-img">
	<img src="<?php echo base_url();?>/assets/images/products-application/<?php echo $product_data[0]['ID']?>.jpg">
</div>
<div class="blank-row-10x" id="product_spec"></div>
<div id="ESeries">
	<div class="row">
		<div class="boder-top" >
			<p class="tri-down">Product Specification</p>	
		</div>
		
	</div>

	<div class="filter row">
		<div class="filter-panel col-8 ">
		<?php 
		foreach ($product_dimension as $key => $value) {
		foreach ($value['Power_option'] as $key2 => $value2) {?>
			<div id="dim_<?php echo($value['ID'])?>" class="filter-block">
				<div class="col ">
					<span class="radio-wrapper"> 
						<input type="radio" name="power" id="power<?php echo($key.'_'.$key2)?>" value="" onchange="power_filter(this,'dim_<?php echo($value['ID'])?>');">
						<div>
							
						</div> 
					</span> 
					<span class="table-cell"> 
						<label for="power<?php echo($key.'_'.$key2)?>"><?php echo($value2)?> 
						<?php $strips_array = array(59 ,58,25,24,23 ); if(in_array($product_data[0]['ID'], $strips_array)) echo ''; else echo "Watt";?></label> 
					</span> 
				</div>
			</div>
			<?php } }
	 	?>
		</div>
		<div class="col-4 filter-panel-blank ">
			
		</div>
	</div>
	<div class="blank-row"></div>
	<div class="row">
		<div class="col gallery">
			<section id="gallery" class="simplegallery" style="width: 100%;height: auto;">
	            <?php 
	            		foreach ($product_dimension as $key => $value) {
	            			echo '<div class="content" id="dim_'. $value['ID'].'">';
	            			foreach ($value['photos'] as $key2 => $value2) {?>
	            				<a class="example-image-link image_<?php echo $key.'_'.$key2; ?>" href="<?php echo base_url().'/assets/images/product-gallary/'.$product_data[0]['ID'].'/'.$value2['file_name']; ?>" data-lightbox="example-set<?php echo $key;?>" data-title="<?php echo($value2['description'])?>" style="display: none;">
									<img class="example-image " src="<?php echo base_url().'/assets/images/product-gallary/'.$product_data[0]['ID'].'/'.$value2['file_name']; ?>" alt="" />
								</a>
	            			<?php }
	            			echo '</div>';
	            		}
	            	?>
	            

	            <div class="clear"></div>

	            
	            	<?php 
	            		foreach ($product_dimension as $key => $value) {
	            			echo '<div class="thumbnail" id="dim_'. $value['ID'].'">';
	            			foreach ($value['photos'] as $key2 => $value2) {?>
	            				<div class="thumb" >
				                    <a href="#" rel="1" >
				                        <img src="<?php echo base_url();?>/assets/images/product-gallary/<?php echo $product_data[0]['ID'].'/'.$value2['file_name']; ?>" id="thumb_<?php echo $key.'_'.$key2; ?>" alt="" />
				                    </a>
				                </div>
	            			<?php }
	            			echo '</div>';
	            		}
	            	?>
	            
	        </section>
		</div>
		<div class="col spec-tbl">
			<?php $value=$product_dimension[0]['option'][0]; ?>
				<div class="spec-row row" style="margin-top: 0px !important;">
					<div class="spec-col-header col">
						Fitting material
					</div>
					<div class="spec-col-data col">
						<?php echo $product_data[0]['Housing'] ?>
					</div>

				</div>
				<div class="spec-row row">
					<div class="spec-col-header col">
						Working temperature
					</div>
					<div class="spec-col-data col">
						<?php echo $product_data[0]['Working_temperature'] ?>
					</div>

				</div>
				<div class="spec-row row">
					<div class="spec-col-header col">
						Power supply
					</div>
					<div class="spec-col-data col">
						<?php echo $value['Voltage_HZ']; ?>
					</div>

				</div>
				<div class="spec-row row">
					<div class="spec-col-header col">
						LED base
					</div>
					<div class="spec-col-data col">
						<?php echo $product_basicFeature['LEDType']; ?>
					</div>

				</div>
				<div class="spec-row row">
					<div class="spec-col-header col">
						LED type
					</div>
					<div class="spec-col-data col">
						<?php echo $value['Led_Type']; ?>
					</div>

				</div>
				
				<div class="spec-row row">
					<div class="spec-col-header col">
						Lifespan
					</div>
					<div class="spec-col-data col">
						<?php echo $value['lifespan']." hrs"; ?>
					</div>

				</div>
				<div class="spec-row row">
					<div class="spec-col-header col">
						Beam angle
					</div>
					<div class="spec-col-data col">
						<?php echo $value['Beam_angle']."º"; ?>
					</div>

				</div>
				<div class="spec-row row last-spec-row">
					<div class="spec-col-header col">
						Guarantee
					</div>
					<div class="spec-col-data col">
						<?php echo $value['Guarantee']." years"; ?>
					</div>

				</div>
				
			<?php  ?>
		</div>
	</div>
	<div class="blank-row-10x"></div>
	<div class="row">

		<table class="table table-hover" id="product_option"> 
		    <thead>
		      <tr id="header">
		        <th>Item code</th>
		        <th>Power</th>
		        <th>CCT</th>
		        <th>CRI</th>
		        <th>Lumen</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<?php foreach ($product_dimension as $key => $value) {
		    		# code... get all dimension and in each one We need to add id of dimension and set the option 
		    		foreach ($value['option'] as $key2 => $value2) {
		    			echo "<tr id='dim_".$value['ID']."' class='clickable-row'>".
		    				"<td>".$value2['Item_Code']."</td>".
		    				"<td id='power'>".$value2['Power']."</td>".
		    				"<td>".$value2['CCT']."</td>".
		    				"<td>".$value2['CRI']."</td>".
		    				"<td>".$value2['lumen']."</td>".
		    				"</tr>";
		    		}
		    	} ?>
		    </tbody>
		  </table>
	</div>
	<div class="row">
		<div class="col no-padding">
		<ul class="nav nav-tabs customtab" role="tablist">
	       <!--  <li class="nav-item"> 
		        <a class="nav-link active" data-toggle="tab" href="#basic_tab" role="tab"><span class="hidden-sm-up"></span> 
	            	<span class="hidden-xs-down">Documents</span>
        		</a> 
	        </li> -->
	        <li class="nav-item"> 
		        <a class="tab-link active" data-toggle="tab" href="#basic_tab2" role="tab"><span class="hidden-sm-up"></span> 
	            	<span class="hidden-xs-down">Accessories</span>
        		</a> 
	        </li>
	        <!-- <li class="nav-item"> 
		        <a class="nav-link" data-toggle="tab" href="#basic_tab3" role="tab"><span class="hidden-sm-up"></span> 
	            	<span class="hidden-xs-down">Planning aids</span>
        		</a> 
	        </li> -->
	    </ul>
	    <div class="tab-content tabcontent-border">
            <!-- <div class="tab-pane p-20 active" id="basic_tab" role="tabpanel">
            	<?php foreach ($document as $key => $value) {
            		echo "<div class='row col no-padding'>";
            		echo '<a href="#"><b> '.$value['file_name'].
            		'</b> /  '.$value['type'].' '.$value['size'].'</a>';
            		echo "</div>";
            	} ?>
            </div> -->
             <div class="tab-pane p-20 active" id="basic_tab2" role="tabpanel">
             	<?php
             	if(empty($accessories))
             		{
             			echo "<div class='row col no-padding'>";
             			echo "No available accessories for this product.";
             			echo "</div>";
             		}
             		else
	             	 foreach ($accessories as $key => $value) {
			    		echo "<div class='row col no-padding'>";
	            		//echo '<a href="#"><b>'.($key+1).'</b>. '.$value['code'].' - '.$value['description'].'</a>';
	            		echo '<a>'.$value['code'].' - '.$value['description'].'</a>';
	            		echo "</div>";
			    	} ?>
             	<!-- <table class="table table-hover"> 
				    <thead>
				      <tr id="header">
				        <th>Item Code</th>
				        <th>Name</th>
				        <th>Description</th>
				      </tr>
				    </thead>
				    <tbody>
				    	<?php foreach ($accessories as $key => $value) {
				    		echo "<tr><td>".$value['code']."</td>".
				    			"<td>".$value['name']."</td><td>".$value['description']."</td></tr>";
				    	} ?>
				    </tbody>
				</table> -->
            </div>
             <!-- <div class="tab-pane p-20" id="basic_tab3" role="tabpanel">
             	3
            </div> -->
        </div>
	</div>
</div>
</div>
<div class="blank-row"></div>

<script src="<?php echo base_url();?>/assets/lightbox/js/lightbox-plus-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/image-gallery/src/simplegallery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/theme/js/product-filter.js"></script>