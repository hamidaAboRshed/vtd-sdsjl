<link rel="stylesheet" href="<?php echo base_url();?>/assets/lightbox/css/lightbox.min.css">
<script src="<?php echo base_url();?>/assets/lightbox/js/lightbox-plus-jquery.min.js"></script>
<h1 class="hide">Product information page</h1>
<div class="electric-product-container">
	<div class="row">
	    <div class="col electric-product-big-img">
	    	<img src="<?php echo base_url();?>/assets/images/products/<?php echo $tech_data[0]['Item_id']?>.png">
	    </div>
	    <div class="col" style="padding: 0 30px;">
			<table class="tbl-specs-mini electric-table" >
				<tr style="border-bottom: 1px solid #6d6e71;">
		          <td colspan="2" width="70%">
		            <p class="product-name"><?php echo $product_data[0]['Name'];?></p>
		          </td>
		          <td width="30%" style="vertical-align: bottom;">
		            <p class="product-subcat"><?php echo $product_data[0]['Lighting_Type'];?></p>
		          </td>
		        </tr>
				<?php foreach ($feature_data as $key => $value) {
					if (!is_null($feature_data[$key]["title"])) {
						echo '<tr>
					          <td rowspan="2" width="10%" class="electric-feature-icon-td">
					            <img class="electric-feature_icon" src="'.base_url().'/assets/images/icon/'.$feature_data[$key]["icon"].'.png" />
					          </td>
					          <td  colspan="2" width="70%">
					          	<p class="electric-feature_title">
					          		'.$feature_data[$key]["title"].'
					          	</p>
					          </td>
					        </tr>
					        <tr>
					          <td colspan="2">
					          	<p class="electric-feature_description">
						          	'.$feature_data[$key]["description"].'
								</p>
					          </td>
					        </tr>';
					    }
			        else echo '<tr style="height: 7px;"></tr>
		        			<tr>
			        		<td width="10%" class="smart-feature-icon-td"><span><i class="icon-check cat-icon"></i></span></td>
					          <td colspan="2" width="70%">

					          	<p class="electric-feature_description">
						          	'.$feature_data[$key]["description"].'
								</p>
					          </td>
					        </tr>';
						} ?>
		        
	      	</table>
	    </div>
	</div>

	<?php if($product_data[0]['ID'] ==60 || $product_data[0]['ID'] ==61)
		echo '<div class="row">
			    <div class="col" id="blank-col"></div>
			    <div class="col" id="specs-col" style="padding: 0 30px;">
			    	<table class="tbl-specs-mini electric-table table-responsive" >
				        <tr style="border-bottom: 1px solid #6d6e71;">
				          <td colspan="8" width="70%">
				            <p class="product-name">Some uses</p>
				          </td>
				        </tr>
			        </table>
				        <div class=" row" style="padding-top: 5px;">
				        	<div id="" class="col">
				        		<span><i class="icon-screen cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-fax cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-music_player cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-play_station cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-computer cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-printer cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-stereo_system cat-icon"></i></span>
			        		</div>
			        		<div id="" class="col">
				        		<span><i class="icon-iron cat-icon"></i></span>
			        		</div>
		        		</div>
			    </div>
			</div>
		';
		?>
	<div class="blank-row-10x" id="product_spec"></div>
	<div class="row">
		<div class="col" id="blank-col"></div>
		<div class="col" style="padding: 0 30px;">
			<p class="title text" style=" font-size: 25px;font-family: Helvetica-Neue-Bd;border-bottom: 1px solid #6d6e71;"><span class="icon-share" style="padding: 8px;padding-left: 0px;"></span>share</p>
			<?php $this->load->view('includes/share_links');?>
		</div>
	</div>
	<div class="row" style="background-color: #fff;">
	    <div class="col">
	    	<div>
	    		<p class="Premium-Quality">Premium Quality</p>
	    	</div>
	    	<div>
	    		<p class="series-bar"></p>
	    		<!-- <p class="green-bar">British Standard BS1363-2 &nbsp;&nbsp;&nbsp;&nbsp; 13A 3250W </p> -->
	    	</div>
	    	<div class="electric-technical-table">
	    		<p  class="product-name">Technical data</p>
	    		
	    			<?php 
	    				//foreach ($option_data as $key => $value) {
	    				if(!is_null($option_data['title']))
		    				{
		    					echo '<div class="product_options">';
		    					echo "<h5>".$option_data['title']."</h5>";
		    					echo('<div class="row">
										<div class="col-8 ">');
								foreach ($option_data['data'] as $key2 => $value2) {
	    							echo '<div class="filter-block">
											<div class="col ">
												<span class="radio-wrapper"> 
													<input type="radio" name="power" id="'.$key2.'">
													<div>
														
													</div> 
												</span> 
												<span class="table-cell"> 
													<label for="'.$key2.'">'.$value2.'</label> 
												</span> 
											</div>
										</div>';
									}
							 	echo '</div></div>';

			    				/*foreach ($option_data['data'] as $key2 => $value2) {
			    					echo '<div class="custom-control custom-radio">
											  <input type="radio" class="custom-control-input" id="'.$key2.'" name="defaultExampleRadios">
											  <label class="custom-control-label" for="'.$key2.'">'.$value2.'</label>
											</div>';
			    				}*/
			    				echo '</div>';
			    			}
		    			//}
	    			?>
	    			<div id="electic_tech_data" style="max-height: 410px;overflow: auto;">
	    			<?php foreach ($tech_data as $key => $value) {
	    				echo "<table class='table hide table-responsive' id=tbl_".$key.">";
	    				foreach ($value as $key2 => $value2) {
	    					if(!is_null($value2))
		    					echo "<tr class='".(($key2=="ID" || $key2=="Item_id") ? "hide": "" )."'>
						          	<td>
						          		".str_replace("_", " ", $key2)."
						          	</td>
							        <td>
							          	".$value2."
						          	</td>
						        </tr>";
	    				}
	    				echo "</table>";
	    			} ?>
	    			</div>
	    	</div>
	    </div>
	    <div class="col">
			<?php if($product_data[0]['ID'] ==60 || $product_data[0]['ID'] ==61)
	    			echo '<img src="'.base_url().'/assets/images/products-dimension/'.$tech_data[0]['Item_id'].'.png" class="electric-dimension-img">';
	    		else
	    			echo '<img src="'.base_url().'/assets/images/products-dimension/'.$tech_data[0]['Item_id'].'.png" class="electric-dimension-img" style="width:220px;">';?>

	    </div>
	</div>
	<div class="blank-row-10x" id="product_spec"></div>
	<?php $electric_array = array(60 ,61,73,74);
	if($tech_data[0]['Item_id'])
		if(in_array($tech_data[0]['Item_id'], $electric_array))
			echo '<div class="row">
					<div class="application-img">
						<img src="'.base_url().'/assets/images/products-application/'.$tech_data[0]['Item_id'].'.jpg">
					</div>
				</div>';
	?>
	
</div>

<script>
	$(document).ready(function () {
		$('input[type=radio]').change(function() {
		    $('table[id^=tbl_]').addClass("hide");
		    $('table[id=tbl_'+this.id+']').removeClass( "hide" );
		});
		$('input[id=0]').prop("checked",true);
		$('table[id=tbl_0]').removeClass( "hide" );
	});
</script>