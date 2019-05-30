<p class="section-title">Family Data</p>
<div style="text-align: center;">
	<img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$Product_id.'/'.$family_photo;?>" width="100%" >
</div>
<!-- <div>

<p class="section-subtitle"> Data</p>

</div>
 --> 
<p>Category: <?php echo $Category?></p>

<p>Premium Type: <?php echo $PremiumType?> / <?php echo $FinishedPremium?> product</p>

<?php foreach ($Family_language as $key => $value) {?>
<table cellspacing="0pt" cellpadding="0pt" style='page-break-after:always'>
  <tr >
    <td style="background-color: #EEEEEE"><?php echo $value['Family_name'];?></td>  
  </tr>
  <tr>
  	<td class=""><?php echo $value['Family_description']?></td>
  </tr>
</table>	
	<?php } ?>

  <pagebreak/>
<p>Lighting Source: <?php echo $LightingSource;
 if(empty($SocketType)) echo ""; else echo ' / '.$SocketType;
 if(empty($PinType)) echo ""; else echo ' / '.$PinType; ?></p>

<p>This product is <?php echo $Firerated?> fire rated</p>

<p>Working Temperature: <?php echo $WorkingTemperature?></p>

<p>Supplier: <?php echo $Supplier['Name']?></p> 

<p class="section-subtitle">Application</p>
<?php foreach ($application as $key_ => $value_) {
		echo $value_['Name'];
		if($key_ !== count($application) -1 )
			echo ', ';
	
} ?>
<?php if(!empty($application_photo)){?>
<div style="text-align: center;">
	<img src="<?php echo base_url().'/assets/App_files/Product/Premium/'.$Product_id.'/'.$application_photo;?>" width="100%">
</div>
<?php }?>

<p class="section-subtitle">Certification</p>
<?php foreach ($certification as $key => $value) {
	echo $value['Name'];
	if($key !== count($certification) -1 )
		echo ', ';
} ?>

<p class="section-subtitle">Installation way</p>
<?php foreach ($installation_way as $key => $value) {
	echo $value['Name'];
	/*if($key !== count($installation_way) -1 )
		echo ', ';*/
	echo '<div style="text-align: center;">'
		.'<img src="'.base_url().'/assets/App_files/Product/Premium/'.$Product_id.'/'.$value['application_photo'].'" width="100%">'
		.'</div>';
		
} ?>