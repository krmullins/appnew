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
				window.location = 'hooks/order_invoice.php?OrderID=' + selectedID;

			}

			function do_something_else(){
				alert("We are doing something else!");
			}
		</script>

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