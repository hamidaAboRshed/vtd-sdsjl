<p class="section-title">LED Data</p>

<p>This family used The LEDs shown below</p>
<?php if(isset($led_data)){
 foreach ($led_data as $key => $value) {?>
	<p class="section-subtitle"><?php echo $value['Code'];?></p>
	<table>
		<tr>
			<td>LightSourceType : <?php echo $value['LightSourceTypeID'];?> </td>
			<td>OriginCountry : <?php echo $value['OriginCountryID'];?></td>
		</tr>
		<!-- <tr>
			<td>CCT : <?php echo $value['CCT'].'K';?> </td>
			<td>CRI : <?php echo $value['CRI'];?></td>
		</tr> -->
	</table>
	<p>Created by : <?php echo $value['CreatedBy'];?></p>
	<p>Created date : <?php echo $value['CreatedDate'];?></p>
	<p>Last edited by : <?php echo $value['EditedBy'];?></p>
	<p>Last edited date : <?php echo $value['EditedDate'];?></p>
	<br/>
	<p><a href="<?php echo (is_null($value['Datasheet_file']) ? ' ' : base_url().'assets/'.$value['Datasheet_file']).'" download="led_datasheet_'.$value['Code']?>">download datasheet of this LED</a></p>

<?php } }?>
