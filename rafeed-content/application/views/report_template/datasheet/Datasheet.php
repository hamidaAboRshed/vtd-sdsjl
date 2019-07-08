<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
<!--  <meta name="viewport" content="width=device-width, initial-scale=1">-->

<!--    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/report/datasheet.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/icons/rafeed/style.css">
    
</head>
<body>
<div class="row">
    <img src="<?php echo base_url();?>/assets/images/datasheet-images/DATASHEET-TRIAL-3.png"  style="width: 22cm; height: auto;  z-index: 600; margin:-60px -42px 0px -42px;">
<!--    <div style="position: absolute; bottom: 608px; right: 140px;"><h3>PN 000890</h3></div>-->
<!--    <div style="font-family: 'Helvetica-Neue-Light';position: absolute; bottom: 0px; right: 2px;"><h1>Ashhab</h1></div>-->
    
<!--    <div style="margin-top: -90px; margin-right: 2px; z-index: 999;"><h1 style="margin-left: 300px; font-weight: normal; font-size: 19pt;"><?php echo $description['English'][0]['Family_name'];?><div style="font-family:'Helvetica-Neue-Light-ar'; margin-left: 20px; margin-top: -12px;"><?php echo $description['Arabic'][0]['Family_name'];?></div></h1></div>-->
    
    <div style="margin-top: -75px; margin-right: 2px; z-index: 999;"><h1 style="margin-left: 300px; font-weight: normal; font-family:'Helvetica-Neue-Light-ar'; font-size: 20pt;"><?php echo $description['Arabic'][0]['Family_name'].'     '.$description['English'][0]['Family_name'];?></h1></div>

    
    <div style="margin-top: -52px; margin-right: 2px; z-index: 999;">
        <h3 style="margin-left: 590px;">PN <?php echo $product_serial;?></h3>
        <?php
        if($solution_data != null){
            if(gettype($solution_data) == string)
                            echo'<img src="'.base_url().'/assets/icons/datasheet/'.$solution_data.'.png" style=" margin-top: -37px; padding-right:10px; margin-left: 660px;">';
            else
            {
                if(sizeof($solution_data) == 1)
                    echo'<img src="'.base_url().'/assets/icons/datasheet/'.$solution_data[0]['Name'].'.png" style=" margin-top: -37px; padding-right:10px; margin-left: 660px;">';
                else if(sizeof($solution_data) == 2)
                {
                        echo'<img src="'.base_url().'/assets/icons/datasheet/'.$solution_data[0]['Name'].'.png" style=" margin-top: -37px; padding-right:10px; margin-left: 660px;">';
                        echo'<img src="'.base_url().'/assets/icons/datasheet/'.$solution_data[1]['Name'].'.png" style=" margin-top: -38px; padding-right:10px; margin-left: 737px;">'; 
                    
                }

            }
        }
        ?>

    </div>

    </div>
    
<div class="row" style="margin: 0px 3px -2px 3px !important;">
    <p style="margin-top: 23px; margin-bottom:5px;"><?php echo $product_code;?></p>
    </div>
    
  <div class="row" style="margin: 0px 3px 0px 3px !important;">
      
    <div class="col-lg-6" style="width:49.7%; ">
        <div style="border: 1px solid #0000003b;">
<?php if ($color_series_photo!= null) {?>
    <img src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/<?php echo $product_id;?>/<?php echo $color_series_photo;?>"  class="float-left" style="max-width: 100%; height: auto; ">
<?php } 
else{
?>
<img src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/<?php echo $product_id;?>/<?php echo $product_photo[0]['FileName'];?>"  class="float-left" style="max-width: 100%; height: auto; ">
<?php }?>
        </div>
    </div>
      
    <div class="col-lg-6" style="width:49.7%; float:right;" >
        <div style="border: 1px solid #0000003b;">
<img src="<?php echo $this->navigation->get_includes_url()?>/upload_files/Product/Premium/<?php echo $product_id;?>/<?php echo $Dim_photo[0]['FileName'];?>" class="float-right" style="max-width: 100%; height: auto;" >
            </div>
    </div>
      
  </div>
    
<div class="row" style="margin: 0px 0px 0px 3px !important;">
        <div style="margin: 8px 3px 2px 3px;">
            <?php
        if($solution_data != null){
            if(gettype($solution_data) == string)
                            echo $solution_data.' - ';
            else
            {
                if(sizeof($solution_data) == 1)
                    echo $solution_data[0]['Name'].' - ';
                else if(sizeof($solution_data) == 2)
                        echo $solution_data[0]['Name'].' / '.$solution_data[1]['Name'].' - ';

            }
        }
            ?>  <?php echo $product_category;?></div>
        <div style="direction: rtl;    margin-bottom: 5px;" > <!--certification--> 
            
            
                    <?php foreach ($certification as $key => $value) {
          echo "<img src='".$this->navigation->get_includes_url()."/upload_files/Certification/".$value['Logo']."'style='max-width: 100%; height: 22px; margin-top: -18px; padding-right:10px '>";

      } ?>

        </div>
    </div> 
    <div class="row" style="margin: 0px 3px 0px 3px !important; background-color: black;">
    <h4 style="color: white;  margin: 1px 0px 1px 4px;">Description<div class="description-ar" style="direction: rtl; margin-top: -13px; margin-right: 4px;">الوصف</div></h4>
    </div>
    <div class="row" style="margin: 0px 3px 0px 3px !important;">
    <p style="margin: 3px 2px 8px 2px;" class="description">
        <?php echo $description['English'][0]['datasheet_description'] ?>
    </p>
    </div>
    <div class="row" style="margin: 0px 3px 0px 3px !important;"><p class="description-ar" style="margin: 3px 2px 8px 2px;  direction: rtl;">
        <?php echo $description['Arabic'][0]['datasheet_description'] ?>
    </p>
    </div>
    
    <div class="row" style="margin: 0px 3px 0px 3px !important;">
    <div class="col-lg-6" style="width:49.7%">
            <div style="background-color: black; margin-right: 1px;">
<h4 style="color: white;  margin: 1px 0px 1px 4px;">Specifications</h4>
        </div>
            <div>
                <?php
    
                if($FamilyType == 2)
                {
                if($Power_up != null && $Power_up != 0)//W
                        echo "<p style='margin: 1px 0px 0px 0px;'>Max Power</p><div style='direction: rtl; margin-top: -13px;'>".$Power_up.'/'.$Power." w</div>";
        
                if(($Power_up == null || $Power_up == 0) && ($Power != null && $Power != 0))
                        echo "<p style='margin: 1px 0px 0px 0px;'>Max Power</p><div style='direction: rtl; margin-top: -13px;'>".$Power." w</div>";
                        
                }
                else
                {
                    if($Power_up != null && $Power_up != 0)//W
                        echo "<p style='margin: 1px 0px 0px 0px;'>Power Up/Down</p><div style='direction: rtl; margin-top: -13px;'>".$Power_up.'/'.$Power." w</div>";
        
                    if(($Power_up == null || $Power_up == 0) && ($Power != null && $Power != 0))
                        echo "<p style='margin: 1px 0px 0px 0px;'>Power</p><div style='direction: rtl; margin-top: -13px;'>".$Power." w</div>";
                }

                ?>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <?php if($Input_Voltage){ ?>
                <p style="margin: 1px 0px 0px 0px; ">Voltage</p><div style="direction: rtl; margin-top: -13px;"><?php echo $Input_Voltage;?> V<?php if($PowerType) echo $PowerType; ?></div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                    <?php }?>
                <p style="margin: 1px 0px 0px 0px; ">Lumen</p><div style="direction: rtl; margin-top: -13px;">
                <?php
                if($Lumen != null)
                    echo $Lumen.' lm';
                else
                    echo "-";
                ?> 
                </div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <p style="margin: 1px 0px 0px 0px; ">CCT</p><div style="direction: rtl; margin-top: -13px;">
                <?php
                if($CCT != null)
                    echo $CCT.' k';
                else
                    echo "-";
                ?>
                </div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <p style="margin: 1px 0px 0px 0px; ">CRI</p><div style="direction: rtl; margin-top: -13px;">
                <?php
                if($CRI != null)
                    echo '>='.$CRI;
                else
                    echo "-";
                    
                ?>
                </div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <p style="margin: 1px 0px 0px 0px; ">Beam angle</p><div style="direction: rtl; margin-top: -13px;">
                <?php 
    			if($SymmetricBeam ==1){
                    if($BeamAngleValue != null)
                        $beamanle = $BeamAngleValue; 
                    else
                        $beamanle = "-";  
                }
                    
			  	
			else{
                if($BeamAngleH!=0 && $BeamAngleV !=0)
                    $beamanle= $BeamAngleH .' x '. $BeamAngleV ;
                else if($BeamAngleH!=0)
                    $beamanle=$BeamAngleH;
                else if($BeamAngleV !=0)
                    $beamanle=$BeamAngleV;    
            }
    echo $beamanle
                ?></div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <?php if($PowerFactor){ ?>
                <p style="margin: 1px 0px 0px 0px; ">Power factor</p><div style="direction: rtl; margin-top: -13px;"><?php echo $PowerFactor ?></div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                    <?php }?>
                <p style="margin: 1px 0px 0px 0px; ">Working temperature</p><div style="direction: rtl; margin-top: -13px;"><?php echo $MinWorkingTemperature.' to '.$MaxWorkingTemperature?></div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <p style="margin: 1px 0px 0px 0px; ">Life span</p><div style="direction: rtl; margin-top: -13px;"><?php echo $LifeSpan ?> HRS</div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
               <p style="margin: 1px 0px 0px 0px; ">IP</p><div style="direction: rtl; margin-top: -13px;"><?php echo $IP?></div>
                <hr style="margin-top: -1px; margin-bottom: 0px; border-top: 0px dotted;">
                <?php if($IK){ ?>
                <p style="margin: 1px 0px 0px 0px; ">IK</p><div style="direction: rtl; margin-top: -13px;"><?php echo '0'.$IK ?></div>
            <?php }?>
    </div>
                    <div style="background-color: black; margin-right: 1px;">
                        <h4 style="color: white;  margin: 1px 0px 1px 4px;">Technical features</h4>
        </div>
                            <div>
                <p style="margin: 4px 0px 0px 0px;">Materials</p>
                <hr style="margin-top: -1px; margin-bottom: 1px;">
                <?php foreach ($color as &$value) echo '<p style="margin: 0px">'.ucfirst(strtolower($value['part'])).'-'.ucfirst(strtolower($value['color'])).'-'.ucfirst(strtolower($value['material'])).'</p><div style="direction: rtl; margin-top: -11px;"><img src="'.$this->navigation->get_includes_url().'/upload_files/Texture/'.$value['Texture_photo'].'" style="width: 30px; height:11px;"></div>'?>   

              
                <p style="margin: 4px 0px 0px 0px;">Installation </p>
                <hr style="margin-top: -1px; margin-bottom: 1px;">
                <p style="margin: 0px"><?php foreach ($installation_way as &$value) echo $value['Name'].'<br>';?></p>
                         
                <p style="margin: 4px 0px 0px 0px;">Adjustability </p>
                <hr style="margin-top: -1px; margin-bottom: 1px;">
                                
                                
                  <?php              
                if($AdjustableType == 'Tilted'){
               if($TiltedVMax != null && $TiltedHMax!=null)
                    $Adj ='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .', vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>';
               else if ($TiltedVMax != null && $TiltedHMax==null)
                    $Adj ='<p style="margin: 0px"> Tilted vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>';
               else if ($TiltedVMax == null && $TiltedHMax != null)
                    $Adj ='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .'</p>';  
           }

           else if($AdjustableType == 'Rotated'){
                if($RotatedVMax != null && $RotatedHMax!=null)
                    $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .', vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
               else if ($RotatedVMax != null && $$RotatedHMax==null)
                    $Adj ='<p style="margin: 0px"> Rotated vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';  
               else if ($RotatedVMax == null && $$RotatedHMax != null)
                    $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .'</p>'; 
           }

           else if($AdjustableType == 'Tilted & Rotated'){
                if ($TiltedVMax!=null && $TiltedHMax!=null && $RotatedVMax!=null && $RotatedHMax!=null){
                    $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .', vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
                    $Adj .='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .', vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>'; 
                }

                else if ($TiltedVMax==null && $TiltedHMax!=null && $RotatedVMax!=null && $RotatedHMax!=null){
                    $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .', vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
                    $Adj .='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .'</p>';
                }

                else if ($TiltedVMax!=null && $TiltedHMax==null && $RotatedVMax!=null && $RotatedHMax!=null){
                        $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .', vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
                        $Adj .='<p style="margin: 0px"> Rotated vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
                }

                else if ($TiltedVMax!=null && $TiltedHMax!=null && $RotatedVMax==null && $RotatedHMax!=null){
                       $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .'</p>';  
                        $Adj .='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .', vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>';   
                }
                else if ($TiltedVMax!=null && $TiltedHMax!=null && $RotatedVMax!=null && $RotatedHMax==null){
                        $Adj ='<p style="margin: 0px"> Rotated vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';  
                        $Adj .='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .', vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>'; 
                }
               
               
                else if ($TiltedVMax==null && $TiltedHMax!=null && $RotatedVMax==null && $RotatedHMax!=null){
                    $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .'</p>';
                    $Adj .='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .'</p>';
                }
                else if ($TiltedVMax==null && $TiltedHMax!=null && $RotatedVMax!=null && $RotatedHMax==null){
                    $Adj ='<p style="margin: 0px"> Rotated vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
                    $Adj .='<p style="margin: 0px"> Tilted horizontally'.$TiltedHMin. '/'.$TiltedHMax .'</p>';
                }
                else if ($TiltedVMax!=null && $TiltedHMax==null && $RotatedVMax==null && $RotatedHMax!=null){
                    $Adj ='<p style="margin: 0px"> Rotated horizontally'.$RotatedHMin. '/'.$RotatedHMax .'</p>';
                      $Adj .=  '<p style="margin: 0px"> Tilted vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>';
                    
                }
                else if ($TiltedVMax!=null && $TiltedHMax==null && $RotatedVMax!=null && $RotatedHMax==null){
                    $Adj ='<p style="margin: 0px"> Rotated vertically'.$RotatedVMin . '/'.$RotatedVMax.'</p>';
                    $Adj .='<p style="margin: 0px"> Tilted vertically'.$TiltedVMin . '/'.$TiltedVMax.'</p>';
                } 
           }
           
           else if($AdjustableType == 'Not Adjustable'){
                    $Adj ='<p style="margin: 0px">Not Adjustable</p>';
           }
                                echo $Adj;
           ?>                     
                                
<!--
                <p style="margin: 0px">Rotated °180</p>
                <p style="margin: 0px">Tilted horizontally °60   Tilted vertically °60</p>
-->

    </div>
    </div>
        
    <div class="col-lg-6" style="width:49.7%; float:right;">
            <div style="background-color: black;">
                <h4 style="color: white;  margin: 1px 0px 1px 4px;">Electrical features</h4>
    </div>
                    <div>
                <p style="margin: 1px 0px 0px 0px;">Light source</p>
                <hr style="margin-top: -1px; margin-bottom: 1px;">
                <p style="margin: 0px;"><?php echo $LED_supplier.' '.$LightSource.' - '.$type?></p>
                        <br>
                <p style="margin: 8px 0px 0px 0px;">Powered By </p>
                <hr style="margin-top: -1px; margin-bottom: 1px;">
                <p style="margin: 0px">
                <?php
                   if($Driver_supplier != null)
                        echo $Driver_supplier;
                    else
                        echo "-";    
                    ?> 
                </p>
                        <br>
            <div style="background-color: black;">
                <h4 style="color: white;  margin: 1px 0px 1px 4px;">Applications</h4>
                
                
    </div>
               <p style="    margin: 1px 0px 0px 0px;"> <?php
                   foreach($application as $key_ => $value_) {
                       echo $value_['Name'];
                       		if($key_ !== count($application) -1 )
			echo ', ';
                   }?></p> 
                        <br>
<!--                        <hr>-->

    </div>
  <!-- <div class="row" style="margin: 0px 3px 0px 3px !important;">
    <div class="col-lg-6" >
        <div style="border: 1px solid #0000003b;">
<img src="<?php echo base_url();?>/assets/images/datasheet-images/attachment_file7.jpg" class="float-left" style="max-width: 100%; height: auto;">
            </div>
    </div>
    <div class="col-lg-6" >
        <div style="border: 1px solid #0000003b;">
<img src="<?php echo base_url();?>/assets/images/datasheet-images/dimension_photo0.jpg" class="float-right" style="max-width: 100%; height: auto;">
        </div>
    </div>
  </div> -->
    </div>
  </div>
    <br>
    <div style="    position: fixed;bottom: 0;">
                <hr style="margin-top: 0px; margin-bottom: 0px; border-top: 0px dotted;">
    <p class="row" style="margin: 0px 3px 0px 3px !important; font-size: 7px;">
        Luminous flux and connected electrical load are subject to an initial tolerance of +/-  %10. Tolerance of color temperature +/- 150 K. Unless stated otherwise, the values apply to an ambient temperature of 25° C.
        <br>
        We reserve the right to make technicale changes without prior notice. 2019/23/5 Rafeed -3-years guarantee in compliance with the terms of guarantee at <a style="color: #565353" href="https://www.rafeed.co">www.rafeed.co</a>
    </p>
    </div>
    
</body>
</html>
