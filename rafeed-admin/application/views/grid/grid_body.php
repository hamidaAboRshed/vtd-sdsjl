<div class="messages"></div>
<div id="button-action"></div>
<table width="100%" class="display nowrap table table-hover table-striped table-bordered" id="MemberTable">
	<thead>
		<tr>
			<?php foreach ($grid_header as $key => $value) {
				echo "<th>".$value."</th>";
			} ?>	
		</tr>
	</thead>
	<tfoot>
		<tr>
			<?php foreach ($grid_header as $key => $value) {
				echo "<th>".$value."</th>";
			} ?>	
		</tr>
	</tfoot>
</table>

<?php if (isset($custom_modal_file)) {
	$this->load->view($custom_modal_file,$custom_modal_data);
}
?>

<script type="text/javascript">
	var manageMemberTable;
	$(document).ready(function() {
		manageMemberTable = $("#MemberTable").DataTable({
			/*dom: 'Bfrtip',*/
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
	        ],
			'ajax': '<?php echo "$read_action"?>',
			'order': []
		});	
	});
</script>