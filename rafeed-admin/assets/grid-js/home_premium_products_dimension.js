// global variable
var manageAccessoryMemberTable;
$(document).ready(function() {
	managePremiumProductMemberTable = $("#PremiumProductDimensionMemberTable").DataTable({
		/*dom: 'Bfrtip',*/
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
		'ajax': './Premium_product/fetchFamilyDimensionData',
		'order': []
	});	
});
