<p class="section-title">Collection Data</p>

<div align=center>

<table  border=1 class="bordered-table">
 <tr style='height:22.45pt'>
  <td>#</td>
  <td>Code</td>
  <!-- <td>Dimension</td>
  <td>Weight</td>
  <td>Adjustable Type</td> -->
  <td>Power</td>
  <td>Current</td>
  <td>Frequency</td>
  <td>Power Factor</td>
  <td>CCT</td>
  <td>CRI</td>
  <td>IP</td>
  <td>IK</td>
  <td>Lumen</td>
  <td>Beam Angle</td>
  <!-- <td>UGR</td>
  <td>Lighting Distribution</td>
  <td>Color</td> -->
  <td>Price</td>
 </tr>
 <?php foreach ($collection_data as $key => $value) {?>
  <tr>
    <td><?php echo ($key+1);?></td>
    <td><?php echo $value['product_code'];?></td><!-- 
    <td><?php echo (is_null($value['FittingShape']) ? '-' : $value['FittingShape'])?>
    <?php echo (is_null($value['Length']) ? "" : ' '.$value['Length'])?>
    <?php echo (is_null($value['Width']) ? "" : ' x '.$value['Width'])?>
    <?php echo (is_null($value['Height']) ? "" : ' x '.$value['Height'])?>
    <?php echo (is_null($value['Radius']) ? "" : ' x '.$value['Radius'])?></td>
    <td><?php echo $value['Weight'];?></td>
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
      
    </td> -->
    <td><?php echo $value['Power'].'w';?></td>
    <td><?php echo $value['Current'].'mA';?></td>
    <td><?php echo $value['frequency'].'Hz';?></td>
    <td><?php echo $value['PowerFactor'];?></td>
    <td><?php echo $value['CCT'].'k';?></td>
    <td><?php echo $value['CRI'];?></td>
    <td><?php echo $value['IP'];?></td>
    <td><?php echo $value['IK'];?></td>
    <td><?php echo $value['Lumen'];?></td>
    <td><?php echo ($value['SymmetricBeam'] ==1 ? $value['BeamAngleValue'].'°' : $value['BeamAngleH'].'°' .' x '. $value['BeamAngleV'].'°')  ;?></td>
    <!-- <td><?php echo $value['UGRRate'];?></td>
    <td><?php echo $value['LightingDisturbationKind'].' - '. $value['texture'];?></td>
    <td><?php echo $value['color'];?></td> -->
    <td><?php echo (is_null($value['price']) ? "-" : $value['price']."$");?></td>
  </tr>
 <?php } ?>
</table>

</div>