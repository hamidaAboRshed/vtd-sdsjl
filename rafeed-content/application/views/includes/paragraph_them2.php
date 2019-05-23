
<!--  -->
 <section class="m-top3 lightbackground" >
  <!-- start thems2 -->
   <div class="container container-article">

      <div class="row" >

            <div class="col-md-6    blog-paragraph-text">

                 <div class="row no-margin" >
                     <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <h2 class="h2-them2" style="<?php if ($Parent_id==0) { echo "font-size: 1.8rem;";} else{echo "font-size: 1.1rem;width: 100%";} ?>"><?php  echo $Title; ?></h2>
                     </div>
                 </div>

                <div class="row no-margin" >
                     <div class="col-md-12 col-sm-12 col-xs-12 ">
                       <?php echo $Body;?> 
                    </div>
                </div>

             </div>

     <?php if($Photo!='0') { ?>
        <div class="col-md-6   them2 ">
            <img class='img-them2' src='<?php echo $this->navigation->get_includes_url()."/upload_files/blog/". $Artic_id."/".$Photo;?>'/>
        </div>
      <?php } ?>
    

  </div>
  <!-- end them2 -->
</section>