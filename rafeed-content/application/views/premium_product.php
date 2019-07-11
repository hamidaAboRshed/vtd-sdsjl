<link rel="stylesheet" href="<?php echo base_url();?>/assets/lightbox/css/lightbox.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/image-gallery/src/simplegallery.demo1.min.css" />


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/datatables/datatables.min.css"/>


<link rel="stylesheet" href="<?php echo base_url();?>/assets/panel/css/style.css">


<link rel="stylesheet" href="<?php echo base_url();?>/assets/modal/css/style.css">


<link rel="stylesheet" href="<?php echo base_url();?>/assets/accessory/css/style.css">

<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/premium_product_style.css">

<!--<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/Back.css">-->




<h1 class="hide">Product view</h1>



<div id="ESeries">
    
<!--
    <div class="backBtn ">
      <span class="line tLine"></span>
      <span class="line mLine"></span>
      <p class="label" onclick="window.history.go(-1)"><?php echo $product_category ?>s</p>
      <span class="line bLine"></span>
	</div>
-->
    <div style="margin-top: 10px;">
    <p style="cursor: pointer;color: rgb(115, 115, 115);font-size: 14px;font-family: Helvetica-Neue-Bd;" onclick="window.history.go(-1)">&lt;&lt; Back To <?php echo $product_category ?></p>
    </div>
        
    
	<div class="page-header" style="">
		<p class="product-name"><?php $family_name2=strtolower($family_name); echo ucfirst($family_name2) ?></p>
		<p class="product-desc"><?php echo strtoupper($product_category) ?></p>
		<p class="product-desc"><?php echo strtoupper($product_solution) ?></p>
		
	</div>
	<input type="hide" id="product_id" value="<?php echo $Product_id?>" style="display:none"/>
	<div class="product-main-photo">
		<img src="<?php echo $this->navigation->get_includes_url().'/upload_files/Product/Premium/'.$Product_id.'/'.$family_photo;?>"  class="img-fluid">
	</div>
	 <div>
            
	</div> 
    
	<div class="blank-row"></div>
    
    
  
  <div class="prmium-main-feature">
  <div class="row">
    <div class="col" style="text-align: left;">
        <table class='table borderless' style="width: fit-content;    margin: 0;" >
            <tr style="border: none; padding-bottom: 0px; ">
              <?php foreach ($installation_way as $key => $value) 
      echo "<td style='border: none; padding: 5px;text-align: center;'><img src='".$this->navigation->get_includes_url()."/upload_files/Installation_way/".$value['Logo']."' style=''></td>"
        ?>
      </tr>
      <tr style="border: none; padding-bottom: 0px;">
          <?php foreach ($installation_way as $key => $value)
        echo "<td style='border: none;padding: 5px;'><span style='font-size: 13px;'>".$value['Name']."</span></td>"
            ?>
      </tr>
      </table>
     
    </div>
      <div class="col" style="text-align: right;">
      <?php foreach ($certification as $key => $value) {
      echo "<span id='".$value['Name']."' class='' >
      <img src='".$this->navigation->get_includes_url()."/upload_files/Certification/".$value['Logo']."' style='width:30px; margin: 5px 5px;' ></span>";

  } ?>
    </div>
    </div>
  </div>
    
	<div class="product-description row" style="border-color: transparent;">
		<div class="col no-padding">
			<p class="title">Description</p>
			<p class="body">
				<?php echo $description?>
			</p>
		</div>
	</div> 
    
	<div class="row">
		<div class="col no-padding">
			<p class="title"><span class="icon-share" style="padding: 8px;padding-left: 0px;"></span>share</p>
			<?php $this->load->view('includes/share_links');?>	
 
            	<div class="product-description row" style="border-color: transparent;">
		<div class="col no-padding">
			<p class="title">Family Technical Data</p>
		</div>
	</div>
			<div class="family-tech">
                 <div id="accordion">
      <div id="product_dimension_table" style="border-bottom: none;">
  <div id='accordion' class='panel-group'>
      				     <?php 
				     	foreach ($dimension_data as $key => $value) {

                            echo "<div class='panel'>
      <div class='panel-heading'>
      <h4 class='panel-title' style='margin: 0;'>
        <a id='".$value['ID']."' href='#panelBody".$value['ID']."' class='accordion-toggle collapsed  clickable-row  dim_row' data-toggle='collapse' data-parent='#accordion'>".$value['FittingShape']."    ".(is_null($value['Radius']) ? " " : $value['Radius']).
      							(is_null($value['Width']) ? " " : $value['Width']).
                                (is_null($value['Length']) ? " " :" x ".$value['Length']).
      							(is_null($value['Height']) ? " " :" x ".$value['Height'])."</a>
        </h4>
      </div>
      <div id='panelBody".$value['ID']."' class='panel-collapse collapse'>
      <div class='panel-body' style='overflow-y: auto;'>
              <table id=\"product_option".$value['ID']."\" class='display table table-striped no-wrap' style='width:100%;'>
        <thead>
            <tr>
                <th style='padding-bottom: 32px;'>Model</th>
                <th >Power</th>
                <th>CCT</th>
                <th >CRI</th>
                <th >IP</th>
                <th >Beam Angle</th>
                <th  style='padding-bottom: 32px;'>Lumen</th>
                <th style='padding-bottom: 32px;  padding-left: 10px;'>Color</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
        
        </div>
      </div>
    </div>";}?>   
  </div>
   </div> 
       </div>

			</div>
            		</div>
	</div>
<br>
    <br>
    
    
    
<!--TRACK-->
        
  <?php 
    if($accessory_data != null){
               echo '<div class="row">
            <p class="title">Track Rails</p>
            </div>
            <div class="row">
                <p class="body">Aluminium track rail system designed for easy surface mounting on ceiling or walls, or recessed in false ceilings to suite all applications. 
I,L,X and T connectors are available for all tracks, with a pendant option for different designs and mounting methods. </p>
            </div>
            <div class="row">
  <div class="col-sm-6">
    <div class="card">
            <img class="card-img-top" src="'.base_url().'/assets/images/Track Rails/Surface mounted track rail.jpg" alt="Card image" style="width:50%">
      <div class="card-body">
        <h5 class="card-text">Surface mounted</h5>
          <ul style="color: rgba(0,0,0,0.525);">';
          foreach ($accessory_data as &$value)
              if($value['rail_installation_way']=='Surface'){
                  $length=$value['rail_length'] * 1000;
                  echo '<li>'.$value['Code'].'<span style="padding-left:20px">Length: '.$length.'</span></li>';
              }
                  
        echo '</ul></div></div></div>';
    

        echo '<div class="col-sm-6">
                <div class="card">
                    <img class="card-img-top" src="'.base_url().'/assets/images/Track Rails/Recessed track rail.jpg" alt="Card image" style="width:50%">
                    <div class="card-body">
                        <h5 class="card-text">Recessed</h5>
                        <ul style="color: rgba(0,0,0,0.525);">';
                        foreach ($accessory_data as &$value)
                            if($value['rail_installation_way']=='Recessed'){
                                $length=$value['rail_length'] * 1000;                               
                                echo '<li>'.$value['Code'].'<span style="padding-left:20px">Length: '.$length.'</span></li>';
                            }

        echo '</ul></div></div></div></div>';  
        
    }     
        
?>
    
    
    
    
   	<div class="row">
		<div class="col no-padding">
			<p class="title">Application</p>
			<p class="body">
				<?php foreach ($application as $key_ => $value_) {
						echo $value_['Name'];
						if($key_ !== count($application) -1 )
							echo ', ';
				} ?>
			</p>
		</div>
	</div> 
</div>

<?php 
$active="active"; 
$active2="active"; 
$i=0
?>
<div class="application-img">
    <div id="demo" class="carousel slide" data-ride="carousel">
        
          <ul class="carousel-indicators">
              	<?php foreach ($installation_way as $key => $value) {
        if ($value['application_photo']!=null)
        {
                  echo '<li data-target="#demo" data-slide-to="'.$i.'" class="'.$active.'"></li>';
		$active="";	
        $i += 1 ;
        }

	} ?>

  </ul>
        
        <div class="carousel-inner">
            
	<?php foreach ($installation_way as $key => $value) {
        if ($value['application_photo']!=null)
        {
      echo '<div class="carousel-item '.$active2.'">
      <img src="'.$this->navigation->get_includes_url().'/upload_files/Product/Premium/'.$Product_id.'/'.$value['application_photo'].'" width="100%" >
    </div>';
		$active2="";
        }	
	} ?>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon" style="width: 2rem; height: 1.5rem;"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon" style="width: 2rem; height: 1.5rem;"></span>
  </a>
</div>
</div>
</div>



		<div id="myModal" class="modal animate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
			<div class="modal-dialog-centered a-flipY" role="document" style="width: 80%; margin:auto;">
				<div class="modal-content" style="padding-bottom: 35px;">
					<div class="modal-header" style="padding: 0rem 0rem 0rem 2rem; !important">
						<h2 class="modal-title product-name"  id="exampleModalLabel" style="font-family: Helvetica-Neue-Bd;font-size: 32px; padding: 10px 0px;     width: 50%;"> <?php  echo $family_name ?></h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding: 2rem 2rem 0rem 0rem; " onmouseover = "this.style.outline = 'none'">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="row modal-body text-center p-lg" style="margin-left: 23px;">
                        
                            <div class="col-md-6">
                                <div class="col gallery">
			<section id="gallery" class="simplegallery" style="width: 100%;height: auto;">
	            
	            	<div class="content" id="dim_1">
	            				<a class="example-image-link image_1" href="<?php echo base_url();?>/assets/images/product-gallary/1/dim_1.png" data-lightbox="example-set1" data-title="test">
									<img class="example-image " src="<?php echo base_url();?>/assets/images/product-gallary/1/dim_1.png" alt="" />
								</a>
	            			</div>
	            	
	            

	            <div class="clear"></div>

	            
            <div class="thumbnail" id="dim_'. $value['ID'].'">
                    <div class="thumb" >
                        <a href="#" rel="1" >
                            <img src="<?php echo base_url();?>/assets/images/product-gallary/1/dim_1.png" id="thumb_1" alt="" />
                        </a>
                    </div>
                </div>
	            
	        </section>
		</div>
                            </div>

                            <div class="col-md-6">
                                
                                
                                <section style="background-color: transparent;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
                <nav class="nav-justified" >
                  <div class="nav nav-tabs " id="nav-tab" role="tablist">
                      
                    <a class="nav-item nav-link active" id="product_info_0_tab" data-toggle="tab" href="#product_info_0" role="tab" aria-controls="pop1" aria-selected="true" style="padding-top: 0px;">General</a>
                    <a class="nav-item nav-link " id="product_info_2_tab" data-toggle="tab" href="#product_info_2" role="tab" aria-controls="pop2" aria-selected="false" style="padding-top: 0px;">Technical</a>

                    <a class="nav-item nav-link" id="product_info_3_tab" data-toggle="tab" href="#product_info_3" role="tab" aria-controls="pop2" aria-selected="false" style="padding-top: 0px;">Accessories</a>
                    <a class="nav-item nav-link" id="product_info_4_tab" data-toggle="tab" href="#product_info_4" role="tab" aria-controls="pop2" aria-selected="false" style="padding-top: 0px;">Downloads</a> 
 
                  </div>
                </nav>
        <div class="tab-content" id="nav-tabContent" style="overflow: auto; height:400px">
                              <div class="tab-pane fade  show active" id="product_info_0" role="tabpanel" aria-labelledby="product_info_0_tab" >
                                  <div id="product_info"></div>
                                  <div style="text-align: justify; padding-left: 4%;padding-right: 10px;"><?php echo $datasheet_description ?></div>
                  </div>
                  <div class="tab-pane fade" id="product_info_2" role="tabpanel" aria-labelledby="product_info_2_tab">
                       <div class="pt-3"></div>  
                  </div>
  
                  <div class="tab-pane fade" id="product_info_3" role="tabpanel" aria-labelledby="product_info_3_tab">
                       <div class="pt-3"></div>   
                  </div>
            
                              <div class="tab-pane fade" id="product_info_4" role="tabpanel" aria-labelledby="product_info_4_tab">
                       <div class="pt-3"></div>  
                  </div>

                  
                </div>
            </div>
        </div>
    </div>
</section>
                                
                                
                            </div>
                        
                        
					</div>

				</div>
			</div>
		</div>





<!--
		<div class="modal animate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
			<div class="modal-dialog-centered a-flipY" role="document" style="width: 80%; margin:auto;">
				<div class="modal-content" style="padding-bottom: 35px;">
					<div class="row modal-body text-center p-lg" style="margin-left: 23px;">

                                
                                
                                <section style="background-color: transparent;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ">
                <nav class="nav-justified" >
                  <div class="nav nav-tabs " id="nav-tab" role="tablist">
                      
                    <a class="nav-item nav-link active" id="info_0_tab" data-toggle="tab" href="#info_0" role="tab" aria-controls="pop1" aria-selected="true" style="padding-top: 0px;">Register</a>
                    <a class="nav-item nav-link " id="info_2_tab" data-toggle="tab" href="#info_2" role="tab" aria-controls="pop2" aria-selected="false" style="padding-top: 0px;">Sign in</a>
 
                  </div>
                </nav>
        <div class="tab-content" id="nav-tabContent" style="">
                              <div class="tab-pane fade  show active" id="info_0" role="tabpanel" aria-labelledby="info_0_tab" >
                                  
<div class="signup-form">
    <form action="/examples/actions/confirmation.php" method="post">
		<h2>Register</h2>
		<p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
			<div class="row">
				<div class="col-6"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
				<div class="col-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
			</div>        	
        </div>
                <div class="form-group">
			<div class="row">
				<div class="col-6"><input type="text" class="form-control" name="first_name" placeholder="Company" required="required"></div>
				<div class="col-6"><input type="text" class="form-control" name="last_name" placeholder="Phone" required="required"></div>
			</div>        	
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
        </div>        
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="#">Sign in</a></div>
</div>
                                  
                  </div>
                  <div class="tab-pane fade" id="info_2" role="tabpanel" aria-labelledby="info_2_tab">
                      
                      
                      
                      <div class="signup-form">
    <form action="/examples/actions/confirmation.php" method="post">
		<h2>Register</h2>
		<p class="hint-text">Create your account. It's free and only takes a minute.</p>
        <div class="form-group">
			<div class="row">
				<div class="col-6"><input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"></div>
				<div class="col-6"><input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"></div>
			</div>        	
        </div>
                <div class="form-group">
			<div class="row">
				<div class="col-6"><input type="text" class="form-control" name="first_name" placeholder="Company" required="required"></div>
				<div class="col-6"><input type="text" class="form-control" name="last_name" placeholder="Phone" required="required"></div>
			</div>        	
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required="required">
        </div>        
		<div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
    </form>
	<div class="text-center">Already have an account? <a href="#">Sign in</a></div>
</div>
                      
                      
                      
                  </div>

                  
                </div>
            </div>
        </div>
    </div>
</section>
                                
                                

                        
                        
					</div>

				</div>
			</div>
		</div>
-->



<!--        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<script src="<?php echo base_url();?>/assets/lightbox/js/lightbox-plus-jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/image-gallery/src/simplegallery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/theme/js/premium-product-filter.js"></script>


<script type="text/javascript" src="<?php echo base_url();?>/assets/datatables/datatables.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>/assets/modal/js/index.js"></script>


<link href="<?php echo base_url();?>/assets/sweetalert/sweetalert.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/sweetalert/Swal-Forms/swal-forms.css">
<script type="text/javascript" src="<?php echo base_url();?>/assets/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/sweetalert/Swal-Forms/swal-forms.js"></script>


<script>

$(document).on('click', 'click00', function(){/*.click2*/
          //authentication
//	       	var form=[{
//                name: "First name",
//                placeholder:"First name",
//                required: true,
//        				id:"firstname",
//        				value:""
//            },
//
//            {
//                name: "Last name",
//                placeholder:"Last name",
//                required: true,
//                id:'lastname',
//                value:""
//            },
//             {
//                name: "Phone",
//                placeholder:"Phone",
//                required: true,
//        				id:"phone",
//        				value:""
//            },
//            {
//                name: "Company",
//                placeholder:"Company",
//                required: true,
//        				id:"company",
//        				value:""
//            },
//            {
//                name: "Job title",
//                placeholder:"Job title",
//                required: true,
//        				id:"job",
//        				value:""
//            },
//            {
//                name: "Email",
//                placeholder:"Email",
//                required: true,
//        				id:"email",
//        				value:""
//            },
//            {
//                name: "Password",
//                placeholder:"Password",
//                type:"password",
//                required: true,
//        				id:"password",
//        				value:""
//            },
//
//
//                     ];
    
    var form=[{
                        name: "Email",
                placeholder:"Email",
                required: true,
        				id:"email",
        				value:""
            },
            {
                name: "Password",
                placeholder:"Password",
                type:"password",
                required: true,
        				id:"password",
        				value:""
            }];

        var catalog_type=$(this).data('row');
        swal.withForm({
				title: 'Log in<br/>',
				text: 'This has different types of inputs',
				showCancelButton: true,
				confirmButtonColor: '#DBAE27',
				confirmButtonText: 'Send',
				closeOnConfirm: true,
			 	closeOnCancel: true,
	    		formFields: form
		     	 },
		     	 function(isConfirm)
		     	 { //if send data from swal
			      	if(isConfirm)
			      	{  
                        $('#myModal').modal('show');
				        }//if isConfirm
				}//function

			);//swal
    
//    .done(function (data) {
//    swal({
//        title: 'Thank you for your order',
//        type: 'success',
//        html: data
//    });
    
	  });

</script>









