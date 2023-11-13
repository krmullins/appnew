<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function customers_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function customers_header($contentType, $memberInfo, &$args) {
		$header='';

		switch($contentType) {
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

	function customers_footer($contentType, $memberInfo, &$args) {
		$footer='';

		switch($contentType) {
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

	function customers_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function customers_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function customers_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function customers_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function customers_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function customers_after_delete($selectedID, $memberInfo, &$args) {

	}

	function customers_dv($selectedID, $memberInfo, &$html, &$args) {
		/* if this is the print preview, don't modify the detail view */
		if(isset($_REQUEST['dvprint_x'])) return;
		
		ob_start(); ?>

		<div id="form-tabs">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#customer-info" data-toggle="tab">Customer info</a></li>
				<li><a href="#address-info" data-toggle="tab">Address info</a></li>
			</ul>

			<ul class="tab-content">
				<div class="tab-pane active form-horizontal" id="customer-info"></div>
				<div class="tab-pane form-horizontal" id="address-info"></div>
			</ul>

		</div>

		<style>
			#form-tabs .nav-tabs a{ display:block !important ;}
		</style>

		<script>
			$j(function(){
				$j('#form-tabs').appendTo('#customers_dv_form');

				/* fields to move to the customer info tab */
				$j('#CustomerID').parents('.form-group').appendTo('#customer-info')
				$j('#CompanyName').parents('.form-group').appendTo('#customer-info')
				$j('#ContactName').parents('.form-group').appendTo('#customer-info')
				$j('#ContactTitle').parents('.form-group').appendTo('#customer-info')
				$j('#Phone').parents('.form-group').appendTo('#customer-info')
				$j('#Fax').parents('.form-group').appendTo('#customer-info')

				/* fields to move to the address info tab */
				$j('#Address').parents('.form-group').appendTo('#address-info')
				$j('#City').parents('.form-group').appendTo('#address-info')
				$j('#Region').parents('.form-group').appendTo('#address-info')
				$j('#PostalCode').parents('.form-group').appendTo('#address-info')
				$j('#Country').parents('.form-group').appendTo('#address-info')
			})
		</script>

		<?php 
		$tabs = ob_get_contents();
		ob_end_clean();

		$html .= $tabs;
		
	}

	function customers_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function customers_batch_actions(&$args) {

		return [];
	}
