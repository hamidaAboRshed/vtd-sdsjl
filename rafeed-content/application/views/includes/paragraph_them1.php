
<!-- start thems1  -->
<section class="lightbackground" id='thems1'>
  <div class="container container-article">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 ">
        <h2 style="<?php if ($Parent_id==0) { echo "font-size: 1.8rem";} else{echo "font-size: 1.1rem;";} ?>">
          <?php  echo $Title; ?>
        </h2>
      </div>
    </div>

    <?php if($Body!="") { ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 ">
        <div class="blog-paragraph-text">
        
          <?php echo $Body;?>	
        </div>
      </div>
    </div>
   
    <?php } ?>

   <?php if($Photo!='0') { ?>
   </br>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12 " id='them1'>
         <img  src='<?php echo $this->navigation->get_includes_url()."/upload_files/Blog/". $Artic_id."/".$Photo;?>' class="img-them"/>
      </div>
    </div>
  <?php } ?>

  </div>
</section>
