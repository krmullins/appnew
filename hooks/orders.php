<?php
	// For help on using hooks, please refer to http://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function orders_init(&$options, $memberInfo, &$args){
		$options->FilterPage = 'hooks/orders_filter.php';
		return TRUE;
	}

	function orders_header($contentType, $memberInfo, &$args){
		$header='';

		switch($contentType){
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function orders_footer($contentType, $memberInfo, &$args){
		$footer='';

		switch($contentType){
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function orders_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function orders_after_insert($data, $memberInfo, &$args){
		/* send an email notification when a new order is placed */
		ob_start(); ?>
<h3>A new order has been placed, with the following data:</h3>
<hr>
<table>
	<tr><td><b>Order ID</b></td><td><?php echo $data['OrderID']; ?></td></tr>
	<tr><td><b>Order date</b></td><td><?php echo date('m/d/Y', strtotime($data['OrderDate'])); ?></td></tr>
	<tr><td><b>Required date</b></td><td><?php echo date('m/d/Y', strtotime($data['RequiredDate'])); ?></td></tr>
	<tr><td><b>Customer</b></td><td><?php echo sqlValue("select CompanyName from customers where CustomerID='" . makeSafe($data['CustomerID']) . "'"); ?></td></tr>
	<tr><td><b>Employee</b></td><td><?php echo sqlValue("select concat_ws(' ', FirstName, LastName) from employees where EmployeeID='" . makeSafe($data['EmployeeID']) . "'"); ?></td></tr>
</table>		
		<?php
		$mail_body = ob_get_contents();
		ob_end_clean();
		
		//$customer_email = sqlValue("select email from customers where CustomerID='" . makeSafe($data['CustomerID']) . "'");
		
		mail(
			'krmullins@gmail.com',
			'New order placed ' . $data['OrderID'],
			$mail_body,
			"From: kev@mullinsmail.com\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-type: text/html; charset=iso-8859-1\r\n"
		);
		return TRUE;
	}

	function orders_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function orders_after_update($data, $memberInfo, &$args){

		return TRUE;
	}

	function orders_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function orders_after_delete($selectedID, $memberInfo, &$args){

	}

	function orders_dv($selectedID, $memberInfo, &$html, &$args){
	/* if this is the print preview, don't modify the detail view */
		if(isset($REQUEST['dvprint_X'])) return;

		ob_start(); ?>

		<script>
			$j(function(){
				<?php if($selectedID){ ?>
					$j('#orders_dv_action_buttons .btn-toolbar').append(
						'<div class="btn-group-vertical btn-group-lg" style="width: 100%;">' +
							'<button type="button" class="btn btn-default btn-lg" onclick="print_invoice()">' +
								'<i class="glyphicon glyphicon-print"></i> Print Invoice</button>' +
							'<button type="button" class="btn btn-warning btn-lg" onclick="do_something_else()">' +
								'<i class="glyphicon glyphicon-ok"></i> Do Something Else</button>' +
						'</div>'
					);
				<?php } ?>
			});

			function print_invoice(){
				var selectedID = '<?php echo urldecode($selectedID); ?>';
				window.location = 'order_invoice.php?OrderID=' + selectedID;

			}

			function do_something_else(){
				alert("We are doing something else!");
			}
		</script>

				
		<script>
					$j(function(){
						$j('fieldset.form-horizontal').removeClass('form-horizontal').addClass('form-inline');
					})
		</script>

		<style>
				@media (min-width: 768px) {
						
					.form-inline .form-group{
						width: 48%;
						margin-bottom: 0.75em;
						vertical-align: top;
					}
				}
		</style>

		<?php 
		$form_code = ob_get_contents();
		ob_end_clean();

		$html .=$form_code;

	}

	function orders_csv($query, $memberInfo, &$args){

		return $query;
	}
	function orders_batch_actions(&$args){

		return array();
	}