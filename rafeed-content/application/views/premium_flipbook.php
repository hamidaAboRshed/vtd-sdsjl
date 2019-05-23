<!doctype html>
<html lang="en">
<head>
<title>Rafeed Catalog Viewer</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"> 
<meta name="copyright"content="Rafeed">
<meta name="author" content="Hamida Abo Rshed, hamida.a@atclighting.co">
<meta name="owner" content="Rafeed Company">
<meta name="url" content="www.rafeed.co">
<meta name="category" content="First Arabic Brand in Middle East">

<link rel="shortcut icon" href="<?php echo base_url();?>/assets/images/home-product/logo-rafeed-dark.png" type="image/x-icon">
<!-- <script type="text/javascript" src="<?php echo base_url();?>/assets/flip/extras/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/flip/lib/hash.js"></script> -->
<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/custom.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap-grid.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/icons/font-awesome/css/font-awesome.min.css"/>

<!--  sweet alert  -->

<link href="<?php echo base_url();?>/assets/sweetalert/sweetalert.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/sweetalert/Swal-Forms/swal-forms.css">
<script type="text/javascript" src="<?php echo base_url();?>/assets/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/sweetalert/Swal-Forms/swal-forms.js"></script>

 
</head>

<body>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/flipbook-v1.0/css/lightbox.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/flipbook-v1.0/css/custom.css">
<!--  script for flipbook -->
<script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/html2canvas.min.js"></script>
<script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/three.min.js"></script>

<script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/pdf.min.js"></script>
<script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/3dflipbook.min.js"></script>
<script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/lightbox.js"></script>
<!-- bfgin wiew for book image  -->
<h1 class="hide">Rafeed Product Catalogue</h1>
<div class="flip-header row">
  <div class="col-md-5">
    <a class="brand" href="<?php echo $this->navigation->get_base_url()?>/Home">
        <img src="<?php echo base_url();?>/assets/images/logo/rafeed/rafeed-logo.png" alt="rafeed-logo" title="" 
        style="height: 1.3rem;">
     </a>
  </div>
  <div class="col-md-3">
    <p>
			Premium Catalogue Viewer
    </p>
  </div>
  <div class="col-md-4 soci"> 
    <?php  $this->load->view('includes/share_links');?>  

  </div>
</div>
 
 <!-- end header -->
<div class="container catalog">
<!-- begin grid  to show image book  -->
	<div class="grid ">
		<!-- grid item-->
	  <div class="grid-item gridtop">
	  		<div class="col">
				<div class="books">
	      			<div class="thumbnail" data-book-id="book6">
						<a href="#" class="catalog_link" data-row="street" id='6'>
							<img src="<?php echo base_url();?>/assets/flip/new_premium/cover/street light.png" width="200px" hight="200px"/>
							<h4 class="align">Street & Post top light</h4>
						</a>
					</div>
				</div>
		  </div>
		</div>
		<!-- two grid item-->
	  <div class="grid-item grid-item--width2 gridleft">
			<div class="col">
				<div class="books">
	      			<div class="thumbnail" data-book-id="book2">
						<a href="#" class="catalog_link" data-row="hospitality" id='2'>
							<input type='hidden' id='id_catl' value='6' />
							<img src="<?php echo base_url();?>/assets/flip/new_premium/cover/Hospitality.jpg" width="200px" hight="200px"/>
							<h4>Hospitality</h4>
						</a>
					</div>
				</div>
			</div>
			<!--  -->
			<div class="col">
			    <div class="books">
			      <div class="thumbnail" data-book-id="book3">
					<a href="#" class="catalog_link" data-row="outdoor" id='3'>
						<input type='hidden'  value='3' />
						<img src="<?php echo base_url();?>/assets/flip/new_premium/cover/outdoor.jpg" width="200px" hight="200px"/>
						<h4>Outdoor</h4>
					</a>
				  </div>
		   		</div>
			</div>
		</div>	
		<!-- two grid item-->
	 <div class="grid-item grid-item--width2">
		   	<div class="col">
		  	<div class="books">
	      			<div class="thumbnail" data-book-id="book4">
						<a href="#" class="catalog_link" data-row="industrial" id='4'>
							<img src="<?php echo base_url();?>/assets/flip/new_premium/cover/Industrial.jpg" width="200px" hight="200px"/>
							<h4>Industrial</h4>
						</a>
					</div>
				</div>
			</div>
			<!--  -->
		  <div class="col " >
				<div class="books">
	      			<div class="thumbnail" data-book-id="book1">
						<a href="#" class="catalog_link" data-row="fashion" id='1'>
							<img src="<?php echo base_url();?>/assets/flip/new_premium/cover/fashion & Retail.jpg" width="200px" height="200px"/>
							<h4>Fashion & Retail</h4>
						</a>
					</div>
				</div>
		   </div>
	</div>
	<!--  grid item-->
	 <div class="grid-item gridtop">	
		<div class="col">
				<div class="books">
	      			<div class="thumbnail" data-book-id="book5">
						<a href="#" class="catalog_link" data-row="offices" id='5'>
							<img src="<?php echo base_url();?>/assets/flip/new_premium/cover/Offies & Healthcare.jpg" width="200px" hight="200px"/>
							<h4 class="align">Offies & Healthcare</h4>
						</a>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- end grid for book images -->
</div>
<!-- end book body  -->
<!-- footer -->
<div class="flip-footer row" style="padding:5px 4px;">
	<div class="col" >
		<a class="brand" href="<?php echo $this->navigation->get_base_url()?>/Home">
			<i class="fa fa-home" > </i>
		</a>
	</div>

</div>
<!-- end html page -->

<!-- script for popup flipbooks  -->
<script type="text/javascript">
  $(document).ready(function(){
		var styleClb = function() {
          $('.fb3d-modal').removeClass('dark').addClass('light');
        }, 
        booksOptions ={
        //start loading books
	       <?php for ($i=0; $i < count($book_name) ; $i++) {  ?>

	          book<?php echo $i+1; ?>: {

	            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/compressed_pdf/<?php echo $book_name[$i]->Path; ?>',
	            template:
	             {

		              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-popup.html',
		              styles: [
		                '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-white-book-view.css'
		              ],

		              links: [{
		                rel: 'stylesheet',
		                href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
		              }],
		                script:'<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
		               
		              sounds: {
		                startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
		                endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
		              }

	             },

	            styleClb: styleClb,
	            controlsProps:
	             {
		              downloadURL: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name[$i]->Path; ; ?>',
		              actions: {
		                cmdToc: {
		                  //enabled: 0,
		                  active:true
		                },
		                cmdSave: {
		                  code: 68,
		                  flags: 1,
		                }
		              }
	              }

	          },
	       <?php } ?>
	           //end loading book
             
      	};//end booksOptions

      var instance = 
      {
        scene: undefined,
        options: undefined,
        node: $('.fb3d-modal .mount-container')
      };
      // hide modal 
      var modal = $('.fb3d-modal');
      modal.on('fb3d.modal.hide', function() {
        instance.scene.dispose();
      });
      //show modal
      modal.on('fb3d.modal.show', function() {
        instance.scene = instance.node.FlipBook(instance.options);
        instance.options.styleClb();
      });

      $('.books').find('.thumbnail').click(function(e) {
	        var target = $(e.target);
	        while(target[0] && !target.attr('data-book-id')) 
	        {
	          target = $(target[0].parentNode);
	        }
	        if(target[0])
	         {
	          instance.options = booksOptions[target.attr('data-book-id')];
	          //$('.fb3d-modal').fb3dModal('show');
	        }
      });

  	  //click book action
      $('.catalog_link').click(function()
      {
      		var catl_id = $(this).attr("id");
          //authentication
	       	var form=[{
                name: "username",
                placeholder:"Username",
                required: true,
        				id:"username",
        				value:""
            },

            {
                name: "password",
                placeholder:"password",
                type:"password",
                required: true,
                id:'password',
                value:""
            }];	

        var catalog_type=$(this).data('row');
        swal.withForm({
				title: 'Authentication<br/><span class="swal-subtitle">If you don\'t have account, <a href="/Home/contact_us" >contact us!</a></span>',
				text: 'This has different types of inputs',
				showCancelButton: true,
				confirmButtonColor: '#DBAE27',
				confirmButtonText: 'send',
				closeOnConfirm: true,
			 	closeOnCancel: true,
	    		formFields: form
		     	 },
		     	 function(isConfirm)
		     	 { //if send data from swal
			      	if(isConfirm)
			      	{
				        $.ajax({
				             type: 'post',
				             async: false,
				             url: './Authentication',
				             data: { 'username':this.swalForm.username,
				                    'password':this.swalForm.password,
									'catalog':catalog_type },
							 dataType: 'json',
					             success: function(result)
					            { 
						            
					                if(result.success==0)
					                {
					                    swal('Sorry','username or password wrong.',"error");
					                    return false;
					                }
					                else
					                { 	//alert(catl_id);
						            //data to post to script.php
							            var post = {catl_id: catl_id};
							            $.ajax({
							                url: "<?php echo $this->navigation->get_base_url()?>/Catalog/insert_read", //<-- PHP Script where you want to post your data
							                type: "POST",
							                data: post,
							                success: function(data){
							                   
							                    //alert(data);
							                }
							            });
							            //update after integration 27-3-2019
							         	PDFJS.workerSrc ='<?php echo base_url(); ?>assets/flipbook-v1.0/js/pdf.worker.js';
								        $('.fb3d-modal').fb3dModal('show');
									}

								}//secussful
						  });//ajax
				        }//if isConfirm
				}//function
			);//swal
	  }); //on click catalog_link
		
  });//document ready


</script>

<!-- or -->
<script src="<?php echo base_url();?>assets/masonry/masonry.pkgd.min.js"></script>
<!-- script for grig item -->
<script type="text/javascript">
	$('.grid').masonry({
  // options
  itemSelector: '.grid-item',left:10,
  columnWidth: 200
});
</script>
<!-- end off all -->
</body>
</html>