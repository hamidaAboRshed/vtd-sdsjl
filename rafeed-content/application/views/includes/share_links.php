 <?php if(isset($URL))
 { ?>

    <div id="share-buttons">
                        
        <!-- Email -->
        <a class="social-link" href="mailto:?Subject=Rafeed%20<?php if(isset($text))echo $text; ?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo $URL;?>">
            <span alt="Email"><i class="fa fa-envelope"></i></span>
        </a>
     
        <!-- Facebook -->
        <a  class="social-link" href="javascript:void(0)" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo $URL;?>')" ><span alt="Facebook" >
                <i class="fa fa-facebook"></i>
            </span>
        </a>
        
        <!-- Google+ -->
        <a  class="social-link" href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo $URL;?>')" >
            <span alt="Google" ><i class="fa fa-google-plus"></i></span>
        </a>
        
        <!-- LinkedIn -->
        <a  class="social-link" href="javascript:void(0)" onclick="javascript:genericSocialShare('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $URL;?>')" >
            <span alt="LinkedIn"><i class="fa fa-linkedin"></i></span>
        </a>

        <!-- Pinterest -->
         <a  class="social-link" href="javascript:void(0)" onclick="javascript:genericSocialShare('javascript:void((function()%7Bvar%20e=document.createElement(\'script\');e.setAttribute(\'type\',\'text/javascript\');e.setAttribute(\'charset\',\'UTF-8\');e.setAttribute(\'src\',\'http://assets.pinterest.com/js/pinmarklet.js?r=\'+Math.random()*99999999);document.body.appendChild(e)%7D)());')" >
             <span alt="Pinterest" ><i class="fa fa-pinterest"></i></span>
        </a>
      
        <!-- Twitter -->
        <a  class="social-link" href="javascript:void(0)" onclick="javascript:genericSocialShare('https://twitter.com/share?text=Rafeed%20<?php if(isset($text))echo $text; ?>&amp;hashtags=Rafeed&url=<?php echo $URL;?>')" >
            <span alt="Twitter" ><i class="fa fa-twitter"></i></span>
        </a>    

        <script type="text/javascript">
        function genericSocialShare(url){
            window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
            return true;
        }
        </script>


    </div>

<?php }
else 
{ ?>
    <div id="share-buttons">
                        
        <!-- Email -->
        <a class="social-link" href="mailto:?Subject=Rafeed Product&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>">
            <span alt="Email"><i class="fa fa-envelope"></i></span>
        </a>
     
        <!-- Facebook -->
        <a class="social-link" href="http://www.facebook.com/sharer.php?u=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" target="_blank">
            <span alt="Facebook" >
                <i class="fa fa-facebook"></i>
            </span>
        </a>
        
        <!-- Google+ -->
        <a class="social-link" href="https://plus.google.com/share?url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" target="_blank">
            <span alt="Google" ><i class="fa fa-google-plus"></i></span>
        </a>
        
        <!-- LinkedIn -->
        <a class="social-link" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" target="_blank">
            <span alt="LinkedIn"><i class="fa fa-linkedin"></i></span>
        </a>
        
        <!-- Pinterest -->
        <a class="social-link" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
            <span alt="Pinterest" ><i class="fa fa-pinterest"></i></span>
        </a>
      
        <!-- Twitter -->
        <a class="social-link" href="https://twitter.com/share?url=<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>&amp;text=Rafeed%20Product&amp;hashtags=Rafeed" target="_blank">
            <span alt="Twitter" ><i class="fa fa-twitter"></i></span>
        </a>

    </div>
 <?php 
} ?>
