<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function shippers_init(&$options, $memberInfo, &$args) {

		return TRUE;
	}

	function shippers_header($contentType, $memberInfo, &$args) {
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

	function shippers_footer($contentType, $memberInfo, &$args) {
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

	function shippers_before_insert(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function shippers_after_insert($data, $memberInfo, &$args) {

		return TRUE;
	}

	function shippers_before_update(&$data, $memberInfo, &$args) {

		return TRUE;
	}

	function shippers_after_update($data, $memberInfo, &$args) {

		return TRUE;
	}

	function shippers_before_delete($selectedID, &$skipChecks, $memberInfo, &$args) {

		return TRUE;
	}

	function shippers_after_delete($selectedID, $memberInfo, &$args) {

	}

	function shippers_dv($selectedID, $memberInfo, &$html, &$args) {
        /* change the layout only if this is not the print preview */
        if(isset($_REQUEST['dvprint_x'])) return;
        ob_start(); ?>
        
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
        $new_layout = ob_get_contents();
        ob_end_clean();
        $html .=$new_layout;


	}

	function shippers_csv($query, $memberInfo, &$args) {

		return $query;
	}
	function shippers_batch_actions(&$args) {

		return [];
	}
