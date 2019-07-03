<p class="section-title">Collection Data</p>

<div align=center>

<table  border=1 class="bordered-table">
 <tr style='height:22.45pt'>
  <td rowspan="2">#</td>
  <td rowspan="2">Code</td>
  <td rowspan="2">Number</td>
  <td rowspan="2">CCT</td>
  <td rowspan="2">CRI</td>
  <td rowspan="2">IP</td>
  <td rowspan="2">IK</td>
  <td rowspan="2">Power</td>
  <td rowspan="2">Lumen</td>
  <td rowspan="2">Beam Angle</td>
  <td rowspan="2">UGR</td>
  <td colspan="2">Lighting Distribution</td>
  <!-- <td rowspan="2">Installation way</td> -->
  <td rowspan="2">Color</td>
  <td rowspan="2">Driver</td>
  <td rowspan="2">Lifespan</td>
  <td rowspan="2">Warranty</td>
  <td rowspan="2">Price</td>
 </tr>
 <tr>
  <td>Kind</td>
  <td>Texture</td>
 </tr>
 <?php foreach ($collection_data as $key => $value) {?>
  <tr>
    <td><?php echo ($key+1);?></td>
    <td><?php echo $value['product_code'];?></td>
    <td><?php echo $value['product_number'];?></td>
    <td><?php echo $value['CCT'].'k';?></td>
    <td><?php echo $value['CRI'];?></td>
    <td><?php echo $value['IP'];?></td>
    <td><?php echo $value['IK'];?></td>
    <td><?php echo $value['Power'].'w';?></td>
    <td><?php echo $value['Lumen'];?></td>
    <td><?php echo ($value['SymmetricBeam'] ==1 ? $value['BeamAngleValue'].'°' : $value['BeamAngleH'].'°' .' x '. $value['BeamAngleV'].'°')  ;?></td>
    <td><?php echo $value['UGRRate'];?></td>
    <td><?php echo $value['LightingDisturbationKind'];?></td>
    <td><?php echo $value['texture'];?></td>
    <!-- <td><?php echo $value['Installation_way'];?></td> -->
    <td><?php echo '#'.$value['color_series'];?></td>
    <td><?php echo $value['driver'];?></td>
    <td><?php echo $value['LifeSpan'];?></td>
    <td><?php echo $value['Warranty'];?></td>
    <td><?php echo (is_null($value['price']) ? "-" : $value['price']."$");?></td>
  </tr>
 <?php } ?>
</table>

</div>