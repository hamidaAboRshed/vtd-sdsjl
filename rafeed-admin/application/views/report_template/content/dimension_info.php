
<p class="section-title">Dimension Data</p>


    
<div align=center>

<table class="bordered-table">
 <tr style='height:22.45pt'>
  <td>#</td>
  
  <td>Shape</td>

  <td>Length</td>

  <td>Width</td>

  <td>Height</td>

  <td>Radios</td>

  <td>Phases</td>

  <td>Wires</td>

  <td>Adjustable</td>

 </tr>
 <?php foreach ($dimension_data as $key => $value) {?>
 <tr>
  <td><?php echo $key+1?></td>

  <td><?php echo (is_null($value['FittingShape']) ? '-' : $value['FittingShape'])?></td>

  <td><?php echo (is_null($value['Length']) ? "-" : $value['Length'])?></td>

  <td><?php echo (is_null($value['Width']) ? "-" : $value['Width'])?></td>

  <td><?php echo (is_null($value['Height']) ? "-" : $value['Height'])?></td>

  <td><?php echo (is_null($value['Radius']) ? "-" : $value['Radius'])?></td>

  <td><?php echo (is_null($value['Phases']) ? "-" : $value['Phases'])?></td>

  <td><?php echo (is_null($value['Wires']) ? "-" : $value['Wires'])?></td>

  <td><?php echo $value['AdjustableType'];
  switch ($value['AdjustableType']) {
    case 'Tilted':
      echo ' '. $value['TiltedVMin'] .' - '. $value['TiltedVMax']. ' [V] /'. $value['TiltedHMin'] .' - '. $value['TiltedHMax'].' [H]';
      break;

    case 'Rotated':
      echo ' '. $value['RotatedVMin'] .' - '. $value['RotatedVMax']. ' [V] /'. $value['RotatedHMin'] .' - '. $value['RotatedHMax'].' [H]';
      break;
    case 'Tilted & Rotated':
      echo ' (Tilted) '. $value['TiltedVMin'] .' - '. $value['TiltedVMax']. ' [V] /'. $value['TiltedHMin'] .' - '. $value['TiltedHMax'].' [H]';
      echo ' (Rotated) '. $value['RotatedVMin'] .' - '. $value['RotatedVMax']. ' [V] /'. $value['RotatedHMin'] .' - '. $value['RotatedHMax'].' [H]';
      break;
  } ?>
    
  </td>
 </tr>
 <?php } ?>

</table>
<!-- <table>
  <?php foreach ($dimension_data as $key => $value) {?>
  <tr>
    <td colspan="2">
      <?php echo (is_null($value['FittingShape']) ? ' ' : $value['FittingShape']." ")?> 
      <?php echo (is_null($value['Length']) ? " " : $value['Length'])?>
      <?php echo (is_null($value['Width']) ? " " : " x ".$value['Width']." x ")?>
      <?php echo (is_null($value['Height']) ? " " : $value['Height'])?>
      <?php echo (is_null($value['Radius']) ? " " : " x ".$value['Radius'])?>
    </td>
  </tr>
  <?php if (is_array($value['product_photo'])){
          foreach ($value['product_photo'] as $key_multi => $value_multi) {?>
             <tr>
              <td>
                <img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$value['product_id'].'/'.$value_multi['FileName'];?>" width="50%">
              </td>
              <td>
                <img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$value['product_id'].'/'.$value['Dim_photo'][$key_multi]['FileName'];?>" width="50%">
              </td>
            </tr>
           <?php }
       }
       else{ ?>
  <tr>
    <td>
      <img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$value['product_id'].'/'.$value['product_photo'];?>" width="50%">
    </td>
    <td>
      <img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$value['product_id'].'/'.$value['Dim_photo'];?>" width="50%">
    </td>
  </tr>
<?php }?>
  <?php } ?>
</table> -->

</div>
