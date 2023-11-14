Show products with prices between $
<input type="hidden" name="FilterField[1]" value="6">
<input type="hidden" name="FilterOperator[1]" value="greater-than-or-equal-to">
<input type="text" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
	
and $
<input type="hidden" name="FilterAnd[2]" value="and">
	
<input type="hidden" name="FilterField[2]" value="6">
<input type="hidden" name="FilterOperator[2]" value="less-than-or-equal-to">
<input type="text" name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
	
<div style="margin-top: 10px;"><button class="btn btn-success btn-lg">Apply</button></div>