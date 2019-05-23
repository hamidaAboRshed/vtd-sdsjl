<meta name="keywords" content="<?php foreach ($keyword as $word => $value) { echo $value['Value']." ";  } ?>" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style_article.css" >

<div id="Article_page">
  <section class="mbr-fullscreen mbr-parallax-background" id="header" style="background-image: url('<?php echo $this->navigation->get_includes_url()."/upload_files/Blog/".$details_article[0]->Artic_id.'/'.$details_article[0]->Main_Image;?>' );" >
  </section >

  <!-- <div class="cat-nav-list">
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
    <!-- end cat nav  -->

 <section class="lightbackground" >


   <div class="container ">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 single-blog-title" style="margin-top: 3%;">
        <h1><?php  echo $details_article[0]->Title; ?></h1>
        
      </div>
    </div>
   </div>

  <!-- end blog title -->
  <!-- --------------------------------start paraghraph ------------------------------------------------ -->

  <div class="container container-article" style="text-align: center;">

    <div class="row">
       <div class=" col-md-12 single-blog-abstract">
          <p ><?php  echo $details_article[0]->Abstract; ?></p>
       </div>
    </div>
  
    <div class="col-xs-4 single-blog-abstract-line""></div>

  </div>

  <!-- end abstract -->
  <!-- Them1 -->
  <?php 
  foreach ($paragraph as  $par => $value) { ?>
   <!-- start Them1  -->
    <?php if ($value['Parent_id']==0)
     { ?>
        <?php if ($value['Them']==1  || $value['Them']==4 )
         { 
              $this->load->view('includes/paragraph_them1.php',$value);  ?>

                  <!------------ Sub Paragraph theme ------------>
                  <?php foreach ($value['sub_paragraph'] as $key => $value)
                   {
                            if($value['Them']==1 || $value['Them']==4 )
                          {
                            $this->load->view('includes/paragraph_them1.php',$value); 

                          }

                          if($value['Them']==2)
                          {
                            $this->load->view('includes/paragraph_them2.php',$value); 

                          }
                          if($value['Them']==3)
                          {
                            $this->load->view('includes/paragraph_them3.php',$value); 

                          } ?>

                 <?php } ?>
               <!------------ end Sub Paragraph Theme ------------>

         <?php } ?>
  <?php } ?>


  <!-- them2 -->
 <?php if ($value['Them']==2) 
 { 
            if ($value['Parent_id']==0)
             {  
               $this->load->view('includes/paragraph_them2',$value); ?>
                  <!------------ Sub Paragraph theme ------------>
                <?php foreach ($value['sub_paragraph'] as $key => $value)
                 {
                          if($value['Them']==1  || $value['Them']==4 )
                        {
                          $this->load->view('includes/paragraph_them1.php',$value); 

                        }

                        if($value['Them']==2)
                        {
                          $this->load->view('includes/paragraph_them2.php',$value); 

                        }
                        if($value['Them']==3)
                        {
                          $this->load->view('includes/paragraph_them3.php',$value); 

                        } ?>

                <?php } ?>
               <!------------ end Sub Paragraph Theme ------------>
         <?php  }  ?>
  <?php  }  ?>


  <!-- them3 -->
  <?php if ($value['Them']==3)
   { ?>

       <?php if ($value['Parent_id']==0) 
       { 
                $this->load->view('includes/paragraph_them3',$value); ?>
                  <!------------ Sub Paragraph theme ------------>
                <?php foreach ($value['sub_paragraph'] as $key => $value) 
                {
                          if($value['Them']==1  || $value['Them']==4 )
                        { 
                          $this->load->view('includes/paragraph_them1.php',$value); 

                        }

                        if($value['Them']==2)
                        { $sub='sub';
                          $this->load->view('includes/paragraph_them2.php',$value); 

                        }
                        if($value['Them']==3)
                        {
                          $this->load->view('includes/paragraph_them3.php',$value); 

                        } ?>

             <?php } ?>
                  <!------------ Sub Paragraph theme ------------>
      <?php } ?>

    <?php } ?>
  <!-- them3 -->

  <?php } ?>  <!--end forech  all paragraphs  -->

 </section> 

  <div class="container container-article article-key">
    <div class="col-xs-4 single-blog-abstract-line""></div>
    <div class="row">
      <div class=" col-md-12 single-blog-abstract" style="padding:4px 15px;">
        <p class="keyword-title" >
          In this article :<?php foreach ($keyword as $word => $value) { ?>

                <span class="key-word" > <?php echo $value['Value'];
                if ($word <(count($keyword)-1)) echo ","; ?>  </span>

            <?php } //end foreach key 
             ?>
          </p>
        </div>
    </div>
  
  </div>
<!-- --------------------------------------------end paraghraph----------------------------------------- -->

