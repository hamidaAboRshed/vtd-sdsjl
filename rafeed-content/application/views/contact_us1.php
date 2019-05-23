
<div id="Contact-us">
<div style="width: 100%">
    <!-- <iframe width='100%' height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=24.983544,55.093708&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=41.632176,79.013672&amp;t=h&amp;ie=UTF8&amp;z=14&amp;ll=24.983544,55.093708&amp;output=embed"></iframe> -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m10!1m3!1d28931.900405427798!2d55.093708!3d24.983544!2m1!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjTCsDU5JzAwLjgiTiA1NcKwMDUnMzcuNCJF!5e0!3m2!1sen!2sus!4v1540195297431" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
<!--Section: Contact v.2-->
<section class="contact-info-section content-one-column" >
    <div class='page_title'>
        <h1>CONTACT INFORMATION</h1>
    </div>

    <div class="row contact-info">
        <div class="col">
            <i class="fa fa-map-marker fa-4x"></i>
            <h5>
                BCW, JAFZA One , Tower A , 11th Floor 
            </h5>
            <h5>
                Jebel Ali Free Zone , Dubai, UAE
            </h5>
        </div>
        <div class="col">
            <i class="fa fa-phone fa-4x"></i>
            <h5>
                Tel +971 4 817 0229
            </h5>
            <h5>
                Mob: +971 553 307 153
            </h5>
            <h5>
                Fax: +971 4 817 0201
            </h5>
        </div>
        <div class="col">
            <i class="fa fa-envelope fa-4x"></i>
            <h5>
                info@atclighting.co
            </h5>
        </div>
    </div>
</section>
<section class="section contact-field-section">
<div class="row">
    <div class="col-lg-12">
    <!--Section heading-->
    <h2 class="text-center">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly.
        <br/>
     Our team will come back to you within
        matter of hours to help you.</p>

	</div>
</div>
    <div class="row">

      
<div class="row">
    <div class="col-lg-12">
        <?php if(isset($msg)){ ?>
            <div class="alert alert-success">
                <?php echo $msg; ?>
            </div>        
        <?php } ?>
        <?php if(validation_errors()) { ?>
          <div class="alert alert-danger">
            <?php echo validation_errors(); ?>
          </div>
        <?php } ?>
    </div>
</div>
<div class="row">

        <!--Grid column-->
        <div class="col-md-12">
            <form action="<?php echo base_url();?>index.php/Contact1/send" method="POST" class="add-emp" id="add-emp">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <label for="name" class="">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name">
                            
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <label for="email" class="">Your Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                            
                        </div>
                    </div>
                    <!--Grid column-->

                    <div class="col-md-4">
                        <div class="md-form mb-0">
                            <label for="phone" class="">Your phone</label>
                            <input type="text" name="contact_no" class="form-control" id="contact-no" placeholder="Contact No.">
                        </div>
                    </div>

                </div>

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="">
                            <label for="message">Your message</label>
                            <textarea name="comment" cols="3" rows="5" class="form-control" id="comment"></textarea>
                            
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            

            <div class="text-center text-md-center" style="padding: 20px 0;">
                <button class="btn btn-rafeed" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Send</button>
                <button class="btn " type="reset"><i class="fa fa-undo"></i>&nbsp;Reset</button>
            </div>
            <div class="status"></div>
		</form>
        </div>
        <!--Grid column-->

        

    </div>
 
        

    </div>

</section>
</div>
<!--Section: Contact v.2-->