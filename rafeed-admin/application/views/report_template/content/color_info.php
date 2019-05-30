
<p class="section-title">Color Data</p>

<?php if(isset($color_series_data)){
	$id=0;
 foreach ($color_series_data as $key => $value) {$id++;?>

<p class="section-subtitle">Color Series #<?php echo $key+1// $id;?></p>


<div align="center">

<table  border=1 class="bordered-table">
 <tr>
  <td>#</td>
  <td>Part</td>
  <td>Color</td>
  <td>Material</td>
  <td>Texture</td>
 </tr>
 	<?php foreach ($value as $key_color => $value_color) {?>
 		<tr>
			<td><?php echo ($key_color+1);?></td>
			<td><?php echo $value_color['part'];?></td>
			<td><?php echo $value_color['color'];?></td>
			<td><?php echo $value_color['material'];?></td>
			<td><img hight=30 width=30 src="<?php echo base_url().'assets/App_files/Texture/'.$value_color['Texture_photo'];?>" /></td>
		</tr>
 	<?php }?>
	

</table>
<?php if(isset($color_series_photo_data)) 
	if(!is_null($color_series_photo_data[$key])) {?>
	<img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$Product_id.'/'.$color_series_photo_data[$key];?>" width="50%" >
<?php }?>
</div>

<?php }} ?>