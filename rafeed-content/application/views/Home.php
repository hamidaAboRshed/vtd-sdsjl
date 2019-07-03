<!--<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/ken-burns-lib.css">
<!--<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/home products.css">-->

<style type="text/css">
body{
    overflow-x: hidden;
}
    .discover-title {
 overflow: hidden;
 text-align: center;
 color: #657983;
 text-align: center;
 font-size: 25px;
 font-family: "Helvetica-Neue-Light";
 padding: 0px 0 20px 0px;
}
    
    @media only screen and (max-width:425px)
    {
        .discover-title {
            width: 47%;
        text-align: center !important;
            font-size: 20px;
        }
        
        #carouselExampleControls {
        width: 50%;
        }
    }

    
.discover-title:before,
.discover-title:after {
 background-color: #657983;
 content: "";
 display: inline-block;
 height: 1px;
 position: relative;
 vertical-align: middle;
 width: 50%;
}
.discover-title:before {
 right: 0.5em;
 margin-left: -50%;
}
.discover-title:after {
 left: 0.5em;
 margin-right: -50%;
}
.full-screen {
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}
.kb_wrapper {
  max-height: 100vh !important;
}
  .container {
      padding-right:0 !important;
      padding-left:0 !important;
      max-width: initial !important;
  }
  .kb_elastic .carousel-item:first-child{
        max-width: 100% !important;
  }
  .kb_elastic .carousel-item {
    transform: none;
  }
  .butn {
 /* background: #dbae27;
  background-image: -webkit-linear-gradient(top, #dbae27, #907216 );
  background-image: -moz-linear-gradient(top, #dbae27, #907216  );
  background-image: -ms-linear-gradient(top, #dbae27, #907216 );
  background-image: -o-linear-gradient(top, #dbae27, #907216  );
  background-image: linear-gradient(to bottom, #dbae27, #907216 );
  -webkit-border-radius: 50;*/
  /*-moz-border-radius: 50;*/
  /*border-radius: 50px;*/
  color: #dbae27 !important;
    border: 1px solid;
  color: #dbae27 !important;
  font-size: 17px;
  padding: 15px 30px;;
  text-decoration: none;
  /*height: 60px;*/
}

.butn:hover {
  background: #dbae27 ;
  /*background-image: -webkit-linear-gradient(top, #907216  , #dbae27);
  background-image: -moz-linear-gradient(top, #907216 , #dbae27);
  background-image: -ms-linear-gradient(top, #907216  , #dbae27);
  background-image: -o-linear-gradient(top, #907216 , #dbae27);
  background-image: linear-gradient(to bottom, #907216  , #dbae27);*/
  text-decoration: none;
  color: #fff !important;
}
.kb_caption{
    left: 0;
    bottom: 0;
    background-color: #00000075;
    width: 100%;
    padding-left: 11%;
    padding-bottom: 5%;
    position: absolute;
}
.kb_caption h5 {
  width: 50%;
    text-align: left;
}



</style>


<h1 class="hide">Home page</h1>
<section class="section-one-page cid-2 mbr-fullscreen mbr-parallax-background" id="header2-0" style="">
    <div class="container align-center " style="width: 100%">
        <div class="justify-content-md-center " style="width: 100%">
            
            
            
            <div class="container  " style="width: 100%">
        <!-- ++++++++++++++++++++++++++ BOOTSTRAP CAROUSEL +++++++++++++++++++++++++++++ -->

        <div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="false" style="">
                <ol class="carousel-indicators">
      <li data-target="#kb" data-slide-to="0" class="active"></li>
      <li data-target="#kb" data-slide-to="1"></li>
      <li data-target="#kb" data-slide-to="2"></li>
      <li data-target="#kb" data-slide-to="3"></li>
      <li data-target="#kb" data-slide-to="4"></li>
      <li data-target="#kb" data-slide-to="5"></li>
    </ol>
            <!--======= Wrapper for Slides =======-->
            <div class="carousel-inner" role="listbox">

                <!--========= First Slide =========-->
                <div class="carousel-item active">
                    <img src="<?php echo base_url();?>/assets/images/home-product/application-slider/Hospitality_app.jpg" alt="slider 01" />
                    <div class="carousel-caption kb_caption kb_caption_left">
                        <h1 data-animation="animated flipInX">Hospitality</h1>
                        <h5 data-animation="animated flipInX">Light due to your mood and feel the place with our elegant and high class lights for hospitality spaces.</h5>
                    </div>
                </div>

                <!--========= Second Slide =========-->
                <div class="carousel-item min-vh-100">
                    <img src="<?php echo base_url();?>/assets/images/home-product/application-slider/Fashion_app.jpg" alt="slider 02">
                    <div class="carousel-caption kb_caption kb_caption_left">
                        <h1 data-animation="animated flipInX">Fashion & Retail</h1>
                        <h5 data-animation="animated flipInX">Retail lighting does much more than just illuminate your space. Get different moods and options with our various collection. </h5>
                    </div>
                </div>

                <!--========= Third Slide =========-->
                <div class="carousel-item min-vh-100">
                    <img src="<?php echo base_url();?>/assets/images/home-product/application-slider/Offices_app.jpg" alt="slider 03" />
                    <div class="carousel-caption kb_caption kb_caption_left">
                        <h1 data-animation="animated flipInX">Offices & Healthcare</h1>
                        <h5 data-animation="animated flipInX">Create your healthy and appropriate spaces with RAFEED offices and healthcare lighting solution.</h5>
                    </div>
                </div>
                
                                <div class="carousel-item min-vh-100">
                    <img src="<?php echo base_url();?>/assets/images/home-product/application-slider/Industrial_app.jpg" alt="slider 04" />
                    <div class="carousel-caption kb_caption kb_caption_left">
                        <h1 data-animation="animated flipInX">Industrial</h1>
                        <h5 data-animation="animated flipInX">Enhance your work places with sustainability and safety RAFEED industrial lighting solution.</h5>
                    </div>
                </div>
                
                                <div class="carousel-item min-vh-100">
                    <img src="<?php echo base_url();?>/assets/images/home-product/application-slider/Outdoor_app.jpg" alt="slider 05" />
                    <div class="carousel-caption kb_caption kb_caption_left">
                        <h1 data-animation="animated flipInX">Outdoor</h1>
                        <h5 data-animation="animated flipInX">Add a vivid and distinctive ambience to your exterior spaces 
With our unique weatherproof outdoor lighting collections.</h5>
                    </div>
                </div>
                
                <div class="carousel-item min-vh-100">
                    <img src="<?php echo base_url();?>/assets/images/home-product/application-slider/Street_app.jpg" alt="slider 06" />
                    <div class="carousel-caption kb_caption kb_caption_left">
                        <h1 data-animation="animated flipInX">Street Light</h1>
                        <h5 data-animation="animated flipInX">Improve the quality of your neighbourhood & feel safe with our distinctive Street & Post-Top lighting.</h5>
                    </div>
                </div>

            </div>
            </div>

            <!--======= Navigation Buttons =========-->

            <!--======= Left Button =========-->
            <a class="carousel-control-prev carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
                <span class="fa fa-angle-left kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!--======= Right Button =========-->
            <a class="carousel-control-next carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
                <span class="fa fa-angle-right kb_icons" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div> <!-- ++++++++++++++++++++++ END BOOTSTRAP CAROUSEL +++++++++++++++++++++++ -->

</div>

        </div>
        
        
                
    </div>
</section>

<section class="section-one-page cid-2 mbr-fullscreen mbr-parallax-background" id="header2-0" style="">
    <div class="container align-center" style="">
        <div class="row justify-content-md-center" style="margin: 0;">
        
          <div class="row premium_header">
            <div class="col">
            <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/1" style="padding: 2px">
              <img src="<?php echo base_url();?>/assets/images/home-product/premium_series_logo.png" style="" id="premium_larg_logo"/>
              <img src="<?php echo base_url();?>/assets/images/logo/series/premium_logo.svg" style="width: 232px;" id="premium_small_logo"/>
            </a>
            <!--  <h2>High Quality LED Components</h2> -->
              
              <p style="font-size: 1.9rem;color: #657983">New Luminaires Collection<br/>
              <span style="font-family: 'Helvetica-Neue-MdCn'; font-size: 2.0rem"> 2019 - 2020 </span></p>
              <div style="    margin: 20px;">
                <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/1" class="butn">Get Started</a>
              </div>
              <p style="font-family: 'Helvetica-Neue-MdCn'; font-size: 2.0rem;color: #657983">Light your Life with US!</p>
              <div class=""  id="premium_link">
                <a href="<?php echo $this->navigation->get_base_url()?>/Catalog/premium" style="color:#dbae27 !important;" >Open Catalogue ></a>
              </div>
              
              
            </div>
          </div>
<!--           <div class="row">
            <div class="col" style="text-align: left;padding: 1% 11%;color: #657983;">
              <p style="font-size: 1.9rem;">New Luminaires collection, 2019 - 2020 <br/>Light your Life with US !</p>
              <div style="margin-top: 30px">
                
              </div>
            </div>
            
            <div class="col" style="    padding-top: 63px;">
              <a href="#" class="butn">Get Started</a>
              
            </div>
          </div> -->

<script type="text/javascript">
  var $item = $('.carousel-item');
var $wHeight = $(window).height();

$item.height($wHeight);
$item.addClass('full-screen');

$('.carousel img').each(function() {
  var $src = $(this).attr('src');
  var $color = $(this).attr('data-color');
  $(this).parent().css({
    'background-image' : 'url(' + $src + ')',
    'background-color' : $color
  });
  $(this).remove();
});

$(window).on('resize', function (){
  $wHeight = $(window).height();
  $item.height($wHeight);
});
</script>

<div class="products3" style="">
<div class="container" style="width: 900px !important;padding: 0px 50px;    margin-top: 60px;">
    <p class ='discover-title'>you can discover our products in one click</p>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="row">
           <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/145"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/145/attachment_file1.jpg" alt="First slide"></a></div>
            <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/267"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/267/attachment_file_2.jpg" alt="First slide"></a></div>
            <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/48"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/48/attachment_file_2.jpg" alt="First slide"></a></div>
            <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/40"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/40/attachment_file_01.jpg" alt="First slide"></a></div>
           
        </div>
    </div>
    <div class="carousel-item">
              <div class="row">
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/138"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/138/attachment_file_2.jpg" alt="First slide"></a></div>
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/271"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/271/attachment_file_01.jpg" alt="First slide"></a></div>
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/239"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/239/attachment_file_01.jpg" alt="First slide"></a></div>
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/80"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/80/attachment_file_01.jpg" alt="First slide"></a></div>
        </div>
    </div>
    <div class="carousel-item">
              <div class="row">
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/24"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/24/attachment_file7.jpg" alt="First slide"></a></div>
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/191"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/191/attachment_file_2.jpg" alt="First slide"></a></div>
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/193"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/193/attachment_file1.jpg" alt="First slide"></a></div>
                  <div class="col-3"><a href="<?php echo $this->navigation->get_base_url()?>/Product/home_product_view/81"><img class="d-block w-100" src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/81/attachment_file_2.jpg" alt="First slide"></a></div>
        </div>
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="margin-left: -103px;">
<!--    <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span>-->
      <i class="fa fa-angle-left" style="font-size:33px"></i>
      
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="margin-right: -111px;">
<!--    <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span>-->
            <i class="fa fa-angle-right" style="font-size:33px"></i>

    <span class="sr-only">Next</span>
  </a>
</div>
    </div>

</div>


        </div>
      </div>
    </section>


<!-- <div class="premium_header">
            <div>
                <a href="<?php echo base_url();?>index.php/Product/Product_series_list/1" >
                <img src="<?php echo base_url();?>/assets/images/home-product/premium_series_logo.png" style="margin-bottom: 40px;" id="premium_larg_logo"/>
                <img src="<?php echo base_url();?>/assets/images/logo/series/premium_logo.svg" style="margin-bottom: 40px;width: 232px;" id="premium_small_logo"/>
                    </a>
            </div>
            <h2>High Quality LED Components</h2>
                    <div class=""  id="premium_link">
                <a href="http://rafeed-srv5/rafeed_website_v3/index.php/Catalog/premium" style="color:#dbae27 !important;" >Open Catalogue ></a>
            </div>

        </div> -->



<!--
<div class="products3">
<div class="container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="row">
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
        </div>
    </div>
    <div class="carousel-item">
              <div class="row">
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
            <div class="col-3"><img class="d-block w-100" src="<?php echo base_url();?>/assets/images/home-products/attachment_file7.jpg" alt="First slide"></div>
        </div>
    </div>

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>

</div>
-->




<!-- E-series section -->
<section class="section-one-page header9 cid-3 mbr-fullscreen" id="header9-1">
    <div class="row" style="padding-bottom: 20px;margin: 0;">
        <div id="E-SERIES" class="middle align-center col-lg-5 col-md-12">
            <div class="section-logo align-center">
                <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/2" >
                    <img src="<?php echo base_url();?>/assets/images/home-product/logo-Eseries.png" id="eseries_logo" style="">
                </a>
            </div>
            <div class="section-p led-economic">
                <h3>Rafeed Brand LED Lighting Technology...</h3>
            </div>
            <div class="section-logo">
                <img src="<?php echo base_url();?>/assets/images/home-product/led-economic.png" id="eseries_led" style="">
            </div>
            <div class ="align-center">
                <a class="display-4" href="<?php echo $this->navigation->get_base_url()?>/Catalog/economic">Open Catalogue > </a><br/>
                <a class="display-4" href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/2">Read More > </a>
            </div>
        </div>

        <div class="align-right col-lg-6 col-md-12">
            <div class="row" style="overflow: initial;">
                <div class="col">
                    <img src="<?php echo base_url();?>/assets/images/home-product/products-eseries.png" id="eseries_product" style="">
                </div>
                <div id="real-guarantee" class="section-logo col">
                    <img src="<?php echo base_url();?>/assets/images/home-product/real-guarantee.png" id="eseries_guarntee" style="">
                </div>
            </div>
        </div>
        <!-- <div class="align-right col">
             
        </div>  -->
    </div>
</section>

<!-- All Brand -->
<!--<section class="section-one-page header10 cid-4 mbr-fullscreen" id="header10-2">
    <div class="container ">
        <div class="row mrg-top-5x" style="height: -webkit-fill-available">
            <div class="section-logo align-left">
                <img src="<?php echo base_url();?>/assets/images/home-product/brand-all-lights.png" id="allbrand_text" >
            </div>
        </div>
    </div>
</section>-->



<section class="header10 cid-5 row" id="header10-3" style="margin: 0">
    <!-- electric 5 -->
    <div class="col" id="electric-col" style=" border: 10px solid #fff;background-size: cover;background-image:url('<?php echo base_url();?>/assets/images/home-product/electric-bg.png');">
        <div class="row mrg-top-5x" id="electric_panel" style="">
            <div class="section-logo align-left col" style="padding-left: 0px;">
                <img src="<?php echo base_url();?>/assets/images/home-product/products-electric.png" id="electric_img" style="width: 300px;">
            </div>
            <div class="align-center col" id="electric-container" style="margin-bottom: 25px;">
                <div class="section-logo" style="margin-bottom: 55px;" id="elctric_logo">
                    <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/3" >
                        <img src="<?php echo base_url();?>/assets/images/home-product/electric-logo.png" style="width: 255px;">
                    </a>
                </div>
                <!-- <div class="section-p" id="electic-accessory-btn">
                    <p>Electric Accessories</p>
                </div> -->
                <div class="section-p row">
                    <p id="heigh-quality">High Quality Products</p>
                    <p id="handredpre">100%</p>
                </div>
                <div class="section-logo">
                    <img src="<?php echo base_url();?>/assets/images/home-product/5-years-warranty-electric-icon.png">
                </div>
                <div class="section-p row center"  id="premium_link">
                    <div  class="col" style="padding: 20px 0;text-align: center;">
                        <a href="<?php echo $this->navigation->get_base_url();?>/Product/Product_series_list/3" >Read More ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- smart home 6 -->
    <div class="col" id="smart-col" style="border: 10px solid #fff;background-size: cover;background-image:url('<?php echo base_url();?>/assets/images/home-product/smart-bg.png');">
        <div class="row mrg-top-5x">
            <!-- <div class="col " style=""> -->
                <div class="col" style="padding-top: 4%;" id="smart_link">
                    <a href="<?php echo $this->navigation->get_base_url()?>/Catalog/smart" style="padding-left: 95px;">Open Catalogue ></a>
                </div>
                <div class="col section-logo smart-logo">
                    <a  href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/4" >
                        <img src="<?php echo base_url();?>/assets/images/home-product/logo-smart.png" style="height: 45px;" >
                    </a>
                </div>
                
            <!-- </div> -->
        </div>
        <div class="row">
            <div class="col mrg-top-4x" style="">
                <div class="md-auto smart-icons" style="text-align: center;">
                    <img src="<?php echo base_url();?>/assets/images/home-product/products-smart1.png" id="smart_larg_img">
                    <img src="<?php echo base_url();?>/assets/images/home-product/products-smart.png" id="smart_small_img">
                </div>
                <div>
                    <div class="align-left smart-content">
                        
                        <img src="<?php echo base_url();?>/assets/images/home-product/5-years-warranty-smart-icon.png">
                        <a href="https://itunes.apple.com/RO/app/id1165236460?mt=8">
                            <img src="<?php echo base_url();?>/assets/images/home-product/app-store-black.png">
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.sunricher.rafeedsmart">
                            <img src="<?php echo base_url();?>/assets/images/home-product/google-play-black.png" style="padding: 0;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-p row center" style="text-align: center;">
            <p class="col" style="margin: 0;">Professional Solutions Systems, Controller with Smart Home</p>
        </div>
        <div class="section-p row center"  id="premium_link">
            <div  class="col" style="padding-bottom: 15px;text-align: center;">
                <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/4" >Read More ></a>
            </div>
        </div>
            
    </div>
</section>


<!-- IOS 7-->

<section class="section-one-page header10 cid-7 mbr-fullscreen" style="background-image:url('<?php echo base_url();?>/assets/images/home-product/ios-bg.png');">
    <div class="container ">
        <div class="row mrg-top-5x">
            <div class="align-left">
                <img src="<?php echo base_url();?>/assets/images/home-product/control-by-ios.png" id="ios_text">
            </div>
        </div>
    </div>
</section>

<!-- Easy Home -->
<section class="mbr-section header6 cid-8" id="header10-2" style="height: 315.141px;">    <!-- height: 315.141px; -->
    <div class="container">
        <div class="media-container-row">
        </div>
    </div>
</section>

<!-- Smart Application -->

<section class="section-one-page header10 cid-9 mbr-fullscreen" id="header10-2">
    <div class="container">
        <div class="media-container-column mbr-white col-lg-8 col-md-10" id="EasyHome_panel">
             <div class="section-p smart-application-p green ">
                <p style="font-family: 'Helvetica-Neue-ThEx'">Rafeed&nbsp;<span style="font-family: 'Helvetica-Neue-Bd'">EasyHome </span></p>
                
            </div>
             <div class="section-p smart-application-px2 red font-5x">
                <p style="font-family: 'Helvetica-Neue-Bd'">Smart Application</p>
            </div>
            <div class="section-p row" style="">
                <div class="section-logo col" style="padding: 13px;">
                    <a href="https://itunes.apple.com/RO/app/id1165236460?mt=8">
                        <img src="<?php echo base_url();?>/assets/images/home-product/app-store-gray.png" style="box-shadow: 3px 5px 8px 1px #160e0b59;">
                    </a>
                </div>
                <div class="section-logo  col" style="padding: 13px;">
                    <a href="https://play.google.com/store/apps/details?id=com.sunricher.rafeedsmart">
                        <img src="<?php echo base_url();?>/assets/images/home-product/google-play-gray.png" style="box-shadow: 3px 5px 8px 1px #160e0b59;">
                    </a>
                </div>
                <div class="section-logo align-left col-4" style="padding: 14px;"></div>
                <div class="section-logo align-left col-2" style="padding: 14px;"></div>
                <div class="section-logo align-left col-2" style="padding: 14px;"></div>
            </div>
        </div>
    </div>
</section>



<!-- LED Screen 10 -->
<section class="section-one-page header9 cid-10 mbr-fullscreen no-padding" id="header9-b">
    <div class="container rtl" style="margin-right: 0px">
        <div class="row">
            <div id="led-screen-container" class="right-content ml-auto" style="height: -webkit-fill-available;background-image:url('<?php echo base_url();?>/assets/images/home-product/led-screen-section-bg.png');background-size: cover;">
                <div id ="led-screen-content">
                    <div class="section-logo" id="led-screen-logo" style="padding: 40px 0;">
                        <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/5" >
                            <img src="<?php echo base_url();?>/assets/images/home-product/led-screen-logo.png" >
                        </a>
                    </div>
                    <div class="ml-auto" style="text-align: center;">
                        <p class="section-p led-screen-title">Turnkey solutions</p>
                        <div class="section-row">
                            <p class="led-screen-p">for media   &nbsp; </p>
                            <p class="led-screen-btn">displays</p>
                        </div>
                        <p class="led-screen-p-small">for both indoor & outdoor applications</p>
                        <div class="section-p row center"  id="premium_link">
                            <div  class="col" style="padding: 20px 0;text-align: center;">
                                <a href="<?php echo $this->navigation->get_base_url()?>/Product/Product_series_list/5" >< Read More ></Read></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
        <script src="<?php echo base_url();?>/assets/ken_burns_slider_effect/js/custom.js"></script>
      <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    
    <script>
    
$('#carouselExample').on('slide.bs.carousel', function (e) {

  
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
    
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});


  $('#carouselExample').carousel({ 
                interval: 2000
        });


  $(document).ready(function() {
/* show lightbox when clicking a thumbnail */
    $('a.thumb').click(function(event){
      event.preventDefault();
      var content = $('.modal-body');
      content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);        
        content.html($(this).html());
        $(".modal-profile").modal({show:true});
    });

  });
    </script>