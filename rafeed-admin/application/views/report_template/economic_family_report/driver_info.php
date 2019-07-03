<p class="section-title">Driver Data</p>

<p>This family used The drivers shown below</p>

<?php if (isset($driver_data)) {
 foreach ($driver_data as $key => $value) {?>
	<p class="section-subtitle"><?php echo $value['Code'];?></p>
	<table>
		<tr>
			<td>Driver Type : <?php echo $value['DriverType'];?> </td>
			<td>IP : <?php echo $value['IPRate'];?></td>
		</tr>
		<tr>
			<td>Power : <?php echo $value['Power'].' W';?> </td>
			<td>Power Factor : <?php echo $value['PowerFactor'];?> </td>
		</tr>
		<tr>
			<td>Input Voltage : <?php echo $value['InputVoltage'];?></td>
			<td>Output Voltage : <?php echo $value['OutputVoltage'];?></td>
		</tr>
		<tr>
			<td>Output Type : <?php echo $value['OutputType'];?> </td>
			<td>Output Current : <?php echo $value['OutputCurrent'];?> </td>
		</tr>
		<tr>
			<td>OriginCountry : <?php echo $value['OriginCountryID'];?></td>
			<td>Supplier : <?php echo $value['SupplierID'];?></td>
		</tr>
	</table>
	<p>Created by : <?php echo $value['CreatedBy'];?></p>
	<p>Created date : <?php echo $value['CreatedDate'];?></p>
	<p>Last edited by : <?php echo $value['EditedBy'];?></p>
	<p>Last edited date : <?php echo $value['EditedDate'];?></p>
	<br/>
	<p><a href="<?php echo (is_null($value['Datasheet_file']) ? ' ' : base_url().'assets/'.$value['Datasheet_file']).'" download="driver_datasheet_'.$value['Code']?>">download datasheet of this driver</a></p>

<?php }}?>

