<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style_article.css" >

    <section>
       <div class="cover" style="background-image: url(<?php echo base_url(); ?>assets/images/blog/blog-2.png);">
        <div class="">
          <div >
            <h1> ARTICLES</h1>
          </div>    
        </div>
      </div> 
       <!-- end cover  -->
        <!--    <div class="cat-nav-list">
             <div class="container">
              <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <a href='#'>Lighting Basic <i class="fa fa-arrow-right"></i></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <a href='#'>Lighting Design Concepts <i class="fa fa-arrow-right"></i></a>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                  <a href='#'>Lighting Management<i class="fa fa-arrow-right"></i></a>
                </div>
             </div>
            </div>
          </div> -->

    </section>

   <!-- end cat nav  -->
   <section class="light-back">
     <div class='container '>
      <!-- begin article ------------------------------->
      <?php for ($i=0; $i <count($atricle) ; $i++) {  ?>
       
       <div class="row cont-art <?php  if ($i%2) {echo 'pull-right';} ?>">
      
          <div class="col-md-6  content" >
            <img src='<?php echo $this->navigation->get_includes_url()?>/upload_files/Blog/<?php echo $atricle[$i]->Artic_id."/".$atricle[$i]->Sub_Image; ?>'  style="margin-bottom: 5px;" />
          </div>

          <div class="col-md-6  content ">
            <article>
              <!-- share icons -->
              
                  <i class="fa fa-share-alt fa-share"  aria-expanded="false" data-toggle="collapse" 
                  data-target="#demo<?php echo $i; ?>"></i>
                 
                  <div id="demo<?php echo $i; ?>" class="collapse" >
           
                      <?php  $this->load->view('includes/share_links');?>  
               
                  </div>
                  <!-- title -->
                  <div class="art-title">
                    <a href='<?php echo $this->navigation->get_base_url()."/article/article_page/".$atricle[$i]->Artic_id;?>' dir='ltr'>
                      <h1><?php echo $atricle[$i]->Title; ?></h1></a>
                  </div>

                  <div class="art-line"></div>

                  <!-- text article -->
                   <div class="art-abstract">
                    <p> <?php echo character_limiter($atricle[$i]->Abstract,200); ?><br> <a href='<?php echo $this->navigation->get_base_url()."/article/article_page/".$atricle[$i]->Artic_id;?>' dir='ltr' style="color: #f00!important;font-weight: bold;font-size: small;"> <p>Read more <i class="fa fa-angle-double-right"></i></p></p> </a>
                  </div>

                  <div id="footer-card">
               <!--        <auther class='auther'>
                        <i class="fa fa-user"> <?php echo $atricle[$i]->CreatedBy; ?></i>
                      </auther> -->

                      <date class='date'>
                        <?php  $nowaday=date("Y-m-d");  ;
                        $date_article=$atricle[$i]->CreatedDate; 
                        $dayofarticle=explode(' ',$date_article) ;
                       
                        if ($dayofarticle[0]!=$nowaday){ ?>
                           <i class="fa fa-calendar"><?php echo $dayofarticle[0]; ?></i>
                            <?php }

                             else  {
                             $timeformate=strtotime($dayofarticle[1]);
                             $time=date("h:i a", $timeformate) ;?>
                            <i class="fa fa-calendar"><?php echo 'Today in '.$time; ?></i>
                            <?php  } ?>
                     
                      </date>
                  </div>

            </article>
         </div>
      </div>  <!-- end article -->

      <?php } ?> <!-- end for -->
      <!-- --------------------------------------------------------- -->
         
      </div>
    </section>
