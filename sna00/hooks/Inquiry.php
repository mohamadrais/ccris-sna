<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function Inquiry_init(&$options, $memberInfo, &$args){
		/* Inserted by Search Page Maker for AppGini on 2019-01-14 11:54:34 */
		$options->FilterPage = 'hooks/Inquiry_filter.php';
		/* End of Search Page Maker for AppGini code */


		return TRUE;
	}

	function Inquiry_header($contentType, $memberInfo, &$args){
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

	function Inquiry_footer($contentType, $memberInfo, &$args){
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

	function Inquiry_before_insert(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_after_insert($data, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_after_update($data, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function Inquiry_after_delete($selectedID, $memberInfo, &$args){

	}

	function Inquiry_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function Inquiry_csv($query, $memberInfo, &$args){

		return $query;
	}
	function Inquiry_batch_actions(&$args){

		return array();
	}
