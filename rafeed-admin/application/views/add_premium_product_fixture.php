	<style>
#_fixture .chosen-container {
    min-width: 150px !important;
}
#_fixture input[type="text"].unit {
    width: 18px !important;
}
#_fixture .btn-default.btn-xs{
	width: 66px;
    white-space: normal;
}
#_fixture .table input {
    width: 70%;
}
</style>
<div id="_fixture">
	<div class="hide">
		<select id="basic_CCT_option">
			<?php foreach ($CCT_option as $key => $value) {?>
				<option name="<?php echo($value['ID'])?>"><?php echo($value['value'])?></option>
			<?php } ?>
			<?php foreach ($CCT_static_option as $key => $value) {?>
				<option name="<?php echo($value)?>"  value="<?php echo($value)?>"><?php echo($key)?></option>
			<?php } ?>
		</select>
		<select id="basic_CRI_option">
			<?php foreach ($CRI_option as $key => $value) {?>
				<option name="<?php echo($value['ID'])?>"><?php echo($value['value'])?></option>
			<?php } ?>
		</select>
  	</div>
</div>

