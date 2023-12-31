<div class="page-header"><h1><img src="resources/table_icons/handbag.png"> Search products</h1></div>

<div style="margin-top: 20px;">
	Show products with prices between $
	<input type="hidden" name="FilterField[1]" value="6">
	<input type="hidden" name="FilterOperator[1]" value="greater-than-or-equal-to">
	<input type="text" name="FilterValue[1]" value="<?php echo htmlspecialchars($FilterValue[1]); ?>" size="3">
	
	and $
	<input type="hidden" name="FilterAnd[2]" value="and">
	
	<input type="hidden" name="FilterField[2]" value="6">
	<input type="hidden" name="FilterOperator[2]" value="less-than-or-equal-to">
	<input type="text" name="FilterValue[2]" value="<?php echo htmlspecialchars($FilterValue[2]); ?>" size="3">
</div>

<div style="margin-top: 20px;">
	<label>Category</label>
	<div style="max-width: 350px;"><span id="CategoryDropDown"></span></div>
	
	<input type="hidden" name="FilterAnd[3]" value="and">
	
	<input type="hidden" name="FilterField[3]" value="4">
	<input type="hidden" name="FilterOperator[3]" value="equal-to">
	<input type="hidden" name="FilterValue[3]" id="CategoryID" value="<?php echo htmlspecialchars($FilterValue[3]); ?>">
</div>

<script>
	$j(function(){
		/* display a drop down of categories that populates its contents from ajax_combo.php */
		$j('#CategoryDropDown').select2({
			ajax: {
				url: 'ajax_combo.php',
				dataType: 'json',
				cache: true,
				data: function(term, page){ return { s: term, p: page, t: 'products', f: 'CategoryID' }; },
				results: function(resp, page){ return resp; }
			},
			width: 350
		}).on('change', function(e){
			$j('#CategoryID').val(e.added.text);
		});
		
		/* preserve the applies category filter and show it when re-opening the filters page */
		if($j('#CategoryID').val().length){
			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { s: $j('#CategoryID').val(), p: 1, t: 'products', f: 'CategoryID' }
			}).done(function(resp){
				if(resp.results.length){
					$j('#CategoryDropDown').select2('data', {
						id: resp.results[1].id,
						text: resp.results[1].text
					});
				}
			});
		}
	})
</script>

<div style="margin-top: 10px;"><button class="btn btn-success btn-lg">Apply</button></div>