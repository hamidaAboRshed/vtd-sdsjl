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
<style>

body{
	background-color: #f6f6f6;
	background-image: linear-gradient(315deg, #f6f6f6 0%, #e9e9e9 74%);
    height: 100vh;	
    margin: 0px;
}

.catalog .col {
 display: inline-block;
  vertical-align: bottom;
  text-align: center;
}
.catalog .col img{
	bottom: 0;
	vertical-align: bottom;
    cursor: pointer;
    box-shadow: 1px 2px 4px rgba(0, 0, 0, 0.55);
    margin: 0 10px 0 10px;
}
.catalog {
    margin: 2% auto;
}
.flip-header, .flip-footer{
    background-color: #333333; 
    margin: 0px;
}
.flip-header p{
	margin: 0px;
    /*padding: 10px;*/
    padding: 13px 0px;
    color: #F5F5F5;
    font-family: "Helvetica-Neue-Light";
    font-size: 1.2rem;
}
.brand img{
	margin: 10px;
}

.zoom-icon{
	top: 10px;
    right: 10px;
}

.flip-footer{
    padding: 0px;
    bottom: 0;
    position: fixed;
    width: 100%;
}
.flip-footer p{
	margin: 0;
	font-family: "Helvetica-Neue-Light";
}
#share-buttons{
    margin-bottom: 5px;
}
.flip-footer a{
    color: #ddd;
    font-family: "Helvetica-Neue-Light";
    font-size: 1.1rem;
}
.flip-footer i{
	color: #ddd;
	border-color: #ddd;
}
#share-buttons {
    text-align: right;
    margin-bottom: 8px!important; 
    display: block;
    padding-top: 13px;
}	
@media only screen and (min-width:1320px) {
.grid{ margin: 0px 3%; }
.gridleft{    left: 235px !important;}
.gridtop {  top: 78px!important;}
}
@media only screen and (max-width:1320px) {
.grid-item { width: 80% !important; }
.grid{ margin: 0px 10%!important;    }
.grid img
{width:100%; height: auto!important; }
}
@media only screen and (max-width:767px) {
.col-md-3 , .col-md-5, .col-md-4
{
	text-align: center;

}
#share-buttons {
    text-align: center;

}

}
.grid-item { width: 200px; }
.grid-item--width2 { width: 400px; }


.soci
{
  text-align: right;
 
}
.soci a
{
  text-decoration: none;
 
}
.social-link i {
    font-size: 20px;
    color: #6D6E71;
    border: none !important;
    padding: 0!important;
    width: 35px!important;
}
.flip-footer a {
    font-size: 1.75rem;
}
</style>
<body>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/flipbook-v1.0/css/lightbox.css">
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
    <a class="brand" href="<?php echo $this->navigation->get_base_url()?>Home">
        <img src="<?php echo base_url();?>/assets/images/logo/rafeed/rafeed-logo.png" alt="rafeed-logo" title="" style="height: 1.3rem;">
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
							<h4>Street & Post top light</h4>
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
							<h4>Offies & Healthcare</h4>
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
<style>
.swal-form input{
	margin: 5px !important;
}
.swal-subtitle{
	color: #797979;
    font-size: 16px;
    text-align: center;
    font-weight: 300;
    position: relative;
    text-align: inherit;
    float: none;
    margin: 0;
    padding: 0;
    line-height: normal;
}
.fb3d-modal.light::before {
     background-color: transparent; 
}
.fb3d-modal {
     box-shadow: 0 0 0px #fff;
}
.fb3d-modal-shadow::before {
    opacity: 1;
}
body::before {
    background-color: #b1b0b0;
}
</style>
<!-- script for popup flipbooks  -->
<script type="text/javascript">
$(document).ready(function(){
		var styleClb = function() {
          $('.fb3d-modal').removeClass('dark').addClass('light');
        }, booksOptions = {
       /////////////////////////////////////book1
          book1: {

            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name1; ?>',
            template: {
              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view1.html',
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
            styleClb: styleClb
          },
             /////////////////////////////////////book2
          book2: {
            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name2; ?>',
            template: {
              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view2.html',
              styles: [
                '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-white-book-view.css'
              ],
              links: [{
                rel: 'stylesheet',
                href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
              }],
              script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
              sounds: {
                startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
                endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
              }
            },
            styleClb: styleClb
          },
             /////////////////////////////////////book3
              book3: {
            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name3; ?>',
            template: {
              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view3.html',
              styles: [
                '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-white-book-view.css'
              ],
              links: [{
                rel: 'stylesheet',
                href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
              }],
              script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
              sounds: {
                startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
                endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
              }
            },
            styleClb: styleClb
          },
              /////////////////////////////////////book4
           book4: {
            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name4; ?>',
            template: {
              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view4.html',
              styles: [
                '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-white-book-view.css'
              ],
              links: [{
                rel: 'stylesheet',
                href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
              }],
              script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
              sounds: {
                startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
                endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
              }
            },
            styleClb: styleClb
          },
               /////////////////////////////////////book5
                book5: {
            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name5; ?>',
            template: {
              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view5.html',
              styles: [
                '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-white-book-view.css'
              ],
              links: [{
                rel: 'stylesheet',
                href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
              }],
              script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
              sounds: {
                startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
                endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
              }
            },
            styleClb: styleClb
          },
               /////////////////////////////////////book6
            book6: {
            pdf: '<?php echo base_url(); ?>assets/flipbook-v1.0/books/pdf/<?php echo $book_name6; ?>',
            template: {
              html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view6.html',
              styles: [
                '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-white-book-view.css'
              ],
              links: [{
                rel: 'stylesheet',
                href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
              }],
              script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
              sounds: {
                startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
                endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
              }
            },
            styleClb: styleClb
          },
            /////////////////////////////////////end books
        };

    var instance = {
      scene: undefined,
      options: undefined,
      node: $('.fb3d-modal .mount-container')
    };
    /////// hide modal 
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
      while(target[0] && !target.attr('data-book-id')) {
        target = $(target[0].parentNode);
      }
      if(target[0]) {
        instance.options = booksOptions[target.attr('data-book-id')];
        //$('.fb3d-modal').fb3dModal('show');
      }
    });
        //click book 
	$('.catalog_link').click(function(){
		var catl_id = $(this).attr("id");//authentication

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
		      },function(isConfirm){ //if send data from swal
		      	if(isConfirm)
		      	{
		        $.ajax({
		             type: 'post',
		             async: false,
		             url: './Authentication',
		             data: {'username':this.swalForm.username,
		                    'password':this.swalForm.password,
							'catalog':catalog_type},
					dataType: 'json',
			             success: function(result)
			            { 
				            
			                if(result.success==0)
			                {
			                    swal('Sorry','username or password wrong.',"error");
			                    return false;
			                }
			                else
			                {
                        var url = "/Catalog/"+catalog_type;   
                      window.location = url;
                      //alert(catl_id);
				            //data to post to script.php
					            /*var post = {catl_id: catl_id};
					            $.ajax({
					                url: "<?php echo base_url(); ?>/index.php/Catalog/insert_read", //<-- PHP Script where you want to post your data
					                type: "POST",
					                data: post,
					                success: function(data){
					                   
					                    //alert(data);
					                }
					            });*/
					         
						        //$('.fb3d-modal').fb3dModal('show');


					      
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