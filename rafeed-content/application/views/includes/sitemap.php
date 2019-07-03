<div class="container" style="padding-bottom: 30px;">
    <div class="media-container-row" style="padding-bottom: 30px;">
    <div class=" col-md-10 col-sm-10">
        <div class="mbr-fonts-style foot-logo display-7">
            <a href="<?php echo $this->navigation->get_base_url()?>Home" style="display: -webkit-inline-box;">
                <img src="<?php echo base_url();?>/assets/images/logo/rafeed/logo-rafeed-mini.png" alt="rafeed" title="">
				<!--<p class="mb-3 mbr-fonts-style foot-title display-7  footer-title" style="margin: 0;padding-top: 5px;padding-left: 5px;">
					Refeed
				</p>-->
            </a>
        </div>
        
    </div>
    </div>
    <div class="media-container-row">
        
        <?php foreach ($this->session->userdata('navdata') as $key => $value) {
            if($value['Name']!='LED Screen')
                echo '<div class="col-md-2 col-sm-3">';
            echo '<p class="mb-3 mbr-fonts-style foot-title display-7 footer-title">
                        '.$value['Name'].'
                    </p>
                     <p class="mbr-text mbr-links-column mbr-fonts-style display-7 footer-link">';
                foreach ($value["category"] as $key2 => $value2) {
                    if($value2["ID"]==22)
                        echo '<a href="'.$this->navigation->get_base_url().'/Product/Product_series_list/5" class="text-black">'.$value2["Name"].'</a><br/>';
                    else 
                        echo '<a href="'.$this->navigation->get_base_url()."/Product/Product_category_list/".$value2["ID"].'" class="text-black">'.$value2["Name"].'</a><br/>';
                }
                echo '</p>';
                if($value['Name']!='Electric')
                    echo '</div>';
            }
        ?>
         <div class="col-md-2 col-sm-3">
            <p class="mb-3 mbr-fonts-style foot-title display-7  footer-title">
                About
            </p>
            <p class="mbr-text mbr-links-column mbr-fonts-style display-7 footer-link">
                <a href="<?php echo $this->navigation->get_base_url()?>/Home" class="text-black footer-link">Home Page</a>
                <br><a href="<?php echo $this->navigation->get_base_url()?>/Home/about" class="text-black footer-link">About us</a>
                <br><a href="<?php echo $this->navigation->get_base_url()?>/Home/agents" class="text-black footer-link">Agents</a>
                <br><a href="<?php echo $this->navigation->get_base_url()?>/Home/cct_info" class="text-black footer-link">Knowledge</a>

                <!-- <br><a href="<?php echo base_url();?>/index.php/Home/cct" class="text-black footer-link">Color Temperature</a>
                <br><a href="<?php echo base_url();?>/index.php/Home/services" class="text-black footer-link">Services</a> -->
                
                <br><a href="<?php echo $this->navigation->get_base_url()?>/Home/contact_us" class="text-black footer-link">Get In Touch</a>
                <!-- <br><a href="#" class="text-black">Join US</a> -->
            </p>
                <p class="mb-3 mbr-fonts-style foot-title display-7  footer-title">
                    JOIN OUR MAILING LIST
                </p>
                <p class="mbr-text mbr-links-column mbr-fonts-style display-7 footer-link">
                    <a href="https://www.facebook.com/AtcLighting/" class="text-black footer-link">
                        <img src="<?php echo base_url();?>\assets\images\icon\facebook.jpg" >
                        Follow us on facebook
                    </a>
                </p>
            </div>
        </div>
     
    </div>

</div>