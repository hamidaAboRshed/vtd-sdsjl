<!DOCTYPE html>
<html>
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
<link rel="stylesheet" href="<?php echo base_url();?>/assets/bootstrap/css/bootstrap-grid.min.css">

    <style>


body{
  background-color: #f6f6f6;
  background-image: linear-gradient(315deg, #f6f6f6 0%, #e9e9e9 74%);
    height: 100vh;
    margin: 0;
     padding: 0;"
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
    position: absolute;
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
    text-align: center;
    margin-bottom: 8px!important; 
    display: block;
    padding-top: 13px;
}
.soci ,.col-md-1
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
.fa-home
{
  font-size: 35px!important;
    margin-top: 6px!important;
    color:#ccc!important;

}

@media only screen and (max-width:767px) {
.col-md-2 , .col-md-5, .col-md-4
{
  text-align: center;

}
#share-buttons {
    text-align: center;

}
.fa-home
{
  font-size: 1.75rem!important;
 

}
.col-md-1{
    position: absolute;
}

}

</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/icons/rafeed/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>/assets/icons/font-awesome/css/font-awesome.min.css"/>

<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/custom.css">


<link rel="stylesheet" href="<?php echo base_url();?>/assets/theme/css/theme.css">

       <script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/html2canvas.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/three.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/pdf.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/flipbook-v1.0/js/3dflipbook.min.js"></script>

  </head>
  <body id='catalogue'>

<div class="flip-header row">
  <div class="col-md-5">
    <a class="brand" href="<?php echo $this->navigation->get_base_url()?>/Home">
        <img src="<?php echo base_url();?>/assets/images/logo/rafeed/rafeed-logo.png" alt="rafeed-logo" title="" style="height: 1.3rem;">
      </a>
  </div>
  <div class="col-md-2">
    <p>
      Catalogue Viewer
    </p>
  </div>
   <div class="col-md-4 soci"> 
    <?php  $this->load->view('includes/share_links');?>  

  </div>
    <div class="col-md-1"> 
   
    <a href="<?php echo $this->navigation->get_base_url()?>/Home">
      <i class="fa fa-home" > </i>
    </a>
  
  </div>
</div>
    <style type="text/css">
 
      .container {
  height: 91vh;
    width: 100%;
    margin: 4px auto;
  
      }
      .fullscreen {
        background-color: #333;
      }

     
      @media (min-width: 1200px)
      {
          .container {
          max-width: 1360px;
          }
      }
    </style>



<?php  if($book_name=='smart') { ?>
<div class="container" id="container">

    </div>


 
     <script type="text/javascript">
         function theKingIsBlackPageCallback(n) {
        return {
          type: 'image',
          src: '<?php echo base_url(); ?>assets/flip/smart/pages/'+(n+1)+'-large.jpg',
          interactive: false
        };
      }

      $('#container').FlipBook({
        pageCallback: theKingIsBlackPageCallback,
        pages: 42,
        
        propertiesCallback: function(props) {
          props.cssLayersLoader = function(n, clb) {// n - page number
            clb([{
             
              js: function (jContainer) {
                console.log(jContainer);
                return {
                  hide: function() {console.log('hide');},
                  hidden: function() {console.log('hidden');},
                  show: function() {console.log('show');},
                  shown: function() {console.log('shown');},
                  dispose: function() {console.log('dispose');}
                };
              }
            }]);
          };
          props.cover.color = 0x000000;
          return props;
        },
        template: {
          html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view.html',
          styles: [
             '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-black-book-view.css'  
          ],
          links: [
            {
              rel: 'stylesheet',
              href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
            }
          ],
          script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
          sounds: {
            startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
            endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
          }
        },
        controlsProps:
         {
            downloadURL: '../../assets/flipbook-v1.0/books/pdf/Smart Home 2018-2019.pdf',
          }
      });
 
    </script>
  <?php }else{ ?>
 <div class="container" id="container">

    </div>


 
     <script type="text/javascript">
         function theKingIsBlackPageCallback(n) {
        return {
          type: 'image',
          src: '<?php echo base_url(); ?>assets/flip/e-series/pages/'+(n+1)+'-L.jpg',
          interactive: false
        };
      }

      $('#container').FlipBook({
        pageCallback: theKingIsBlackPageCallback,
        pages: 54,
        
        propertiesCallback: function(props) {
          props.cssLayersLoader = function(n, clb) {// n - page number
            clb([{
             
              js: function (jContainer) {
                console.log(jContainer);
                return {
                  hide: function() {console.log('hide');},
                  hidden: function() {console.log('hidden');},
                  show: function() {console.log('show');},
                  shown: function() {console.log('shown');},
                  dispose: function() {console.log('dispose');}
                };
              }
            }]);
          };
          props.cover.color = 0x000000;
          return props;
        },
        template: {
          html: '<?php echo base_url(); ?>assets/flipbook-v1.0/templates/default-book-view.html',
          styles: [
             '<?php echo base_url(); ?>assets/flipbook-v1.0/css/short-black-book-view.css'
          ],
          links: [
            {
              rel: 'stylesheet',
              href: '<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css'
            }
          ],
          script: '<?php echo base_url(); ?>assets/flipbook-v1.0/js/default-book-view.js',
          sounds: {
            startFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/start-flip.mp3',
            endFlip: '<?php echo base_url(); ?>assets/flipbook-v1.0/sounds/end-flip.mp3'
          },
        },
        controlsProps:
         {
            downloadURL: '../../assets/flipbook-v1.0/books/pdf/ES 2018-2019.pdf',
          }
      });
 
    </script>
    <?php } ?>

  </body>
</html>
