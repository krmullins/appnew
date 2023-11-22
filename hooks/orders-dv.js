function show_error(field, msg){
	modal_window({
		message: '<div class="alert alert-danger">' + msg + '</div>',
		title: 'Error in ' + field,
		close: function(){
			$j('#' + field).focus();
			$j('#' + field).parents('.form-group').addClass('has-error');
		}
	});
	
	return false;
}


$j(function(){
	$j('#update, #insert').click(function(){
		/* Make sure freight, if provided, is between 0 and 500 */
		var freight = $j('#Freight').val();
		
		if(isNaN(freight) || freight < 0 || freight > 500){
			return show_error('Freight', 'Freight must be a number between 0 and 500.');
		}
	});
	
	$j('#update').click(function(){
		/* Make sure shipped date is today or older, but not older than order date */
		var now = new Date();
		var OrderDate = get_date('OrderDate');
		var ShippedDate = get_date('ShippedDate');
		
		if(ShippedDate && (ShippedDate < OrderDate || ShippedDate > now)){
			return show_error('ShippedDate', 'Shipped date must be set to today or earlier, but not earlier than order date.');
		}
	});
	
	$j('#insert').click(function(){
		var OrderDate = get_date('OrderDate');
		var today = new Date();
		var yesterday = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 1);
		var tomorrow = new Date(today.getFullYear(), today.getMonth(), today.getDate() + 1);
		
		/* Make sure order date is yesterday, today or tomorrow */
		if(OrderDate < yesterday || OrderDate > tomorrow){
			return show_error('OrderDate', 'Order date can only be yesterday, today or tomorrow');
		}
		
		/* Make sure required date is at least one day after order date */
		var RequiredDate = get_date('RequiredDate');
		var min_date = new Date(OrderDate.getFullYear(), OrderDate.getMonth(), OrderDate.getDate() + 1);
		
		if(RequiredDate && RequiredDate < min_date){
			return show_error('RequiredDate', 'Required date must be at least one day after order date.');
		}
	});
	
	$j('#ShipVia-container').on('change', function(){
		if($j('#ShipVia-container').select2('val') == '{empty_value}'){
			$j('#Freight').parents('.form-group').hide();
		}else{
			$j('#Freight').parents('.form-group').show();
			$j('#Freight').focus().select();
		}
	})
})