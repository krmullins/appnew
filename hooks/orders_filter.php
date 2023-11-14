<!-- load bootstrap datepicker -->
<link rel="stylesheet" href="resources/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
<script src="resources/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<div class="page-header"><h1><img src="resources/table_icons/cash_register.png"> Search orders</h1></div>

<div style="margin-top: 20px;">
	Show orders placed between
	<input type="hidden" name="FilterField[1]" value="5">
	<input type="hidden" name="FilterOperator[1]" value="greater-than-or-equal-to">
	<input type="text" name="FilterValue[1]" id="from-date" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="10">
	
	and
	<input type="hidden" name="FilterAnd[2]" value="and">
	
	<input type="hidden" name="FilterField[2]" value="5">
	<input type="hidden" name="FilterOperator[2]" value="less-than-or-equal-to">
	<input type="text" name="FilterValue[2]" id="to-date" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="10">
</div>

<div style="margin-top: 10px;"><button class="btn btn-success btn-lg">Apply</button></div>

<script>
	$j(function(){
		$j('#from-date, #to-date').datepicker({
			autoclose: true,
			format: 'mm/dd/yyyy',
			orientation: 'bottom'
		});
		
		$j('#from-date').change(function(){
			$j('#to-date').datepicker('setStartDate', $j('#from-date').val());
			
			var df = new Date($j('#from-date').datepicker('getDate'));
			df.setMonth(df.getMonth() + 1);
			$j('#to-date').datepicker('setDate', df);
		});
	})
</script>

<style>
	#from-date, #to-date{ display: inline !important; }
</style>