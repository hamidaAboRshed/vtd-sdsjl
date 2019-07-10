<meta name="keywords" content="<?php foreach ($keyword as $word => $value) { echo $value['Value']." ";  } ?>" >
<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/style_article.css" >
<style type="text/css">
.fa
{
  color: #fff;
}
.fa:hover
{
  color: #333;
}
.fa-share-alt
{
  font-size: 22px;
  padding: 6px;
}
.fa-share-alt:hover
{
  color: #fff;
}
</style>

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

  <!-- share icons --> 
  <div class="container fixed-share">
    <input type="checkbox" id="control"/>
    <label id="main-menu" for="control">
      <li class="fa fa-share-alt"></li>
    </label>
    <div class="icon-container">
        <a  href="mailto:?Subject=Rafeed%20Atricle%20-%20<?php  echo $details_article[0]->Title; ?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo $this->navigation->get_base_url().'/article/article_page/'.$details_article[0]->Artic_id;?>">
          <i class="fa fa-envelope"></i>
        </a>
    </div>
     <div class="icon-container">
      <a href="javascript:void(0)" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo $this->navigation->get_base_url(); ?>/article/article_page/<?php echo $details_article[0]->Artic_id; ?>')">
           <i class="fa fa-facebook"></i>
       </a>
    </div>
    <div class="icon-container">
      <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo $this->navigation->get_base_url(); ?>/article/article_page/<?php echo $details_article[0]->Artic_id; ?>')">
        <i class="fa fa-google-plus"></i>
      </a>
    </div>
    <div class="icon-container">
      <a href="javascript:void(0)" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $this->navigation->get_base_url(); ?>/article/article_page/<?php echo $details_article[0]->Artic_id; ?>')">
        <i class="fa fa-linkedin"></i>
      </a>
    </div>
    <div class="icon-container">
         <a  href="javascript:void(0)" onclick="javascript:genericSocialShare('javascript:void((function()%7Bvar%20e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)%7D)());')" >
            <i class="fa fa-pinterest"></i>
        </a>
    </div>
    <div class="icon-container twit">
      <a href="javascript:void(0)" onclick="javascript:genericSocialShare('https://twitter.com/share?text=Rafeed%20Atricle%20-%20<?php  echo $details_article[0]->Title; ?>&amp;hashtags=Rafeed&url=<?php echo $this->navigation->get_base_url(); ?>/article/article_page/<?php echo $details_article[0]->Artic_id; ?>')">
        <i class="fa fa-twitter"></i> 
        </a>   
    </div>
  </div>
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

<script type="text/javascript">
function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
</script>