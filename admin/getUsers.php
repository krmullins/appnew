<?php
// This script and data application were generated by AppGini 23.16
// Download AppGini for free from https://bigprof.com/appgini/download/

/*
	ajax-callable script that retrieves a list of users for admin, indicating which ones have
	access to supplied table.

	REQUEST parameters:
	===============
	t: table name
	id: optional, primary key value of current record
	p: page number (default = 1)
	s: search term
*/

	/* return json */
	header('Content-type: application/json');

	$start_ts = microtime(true);

	require(__DIR__ . '/incCommon.php');

	// how many results to return per call, in case of json output
	$results_per_page = 50;

	$id = from_utf8(Request::val('id'));
	$search_term = from_utf8(Request::val('s'));

	$page = intval(Request::val('p'));
	if($page < 1) $page = 1;
	$skip = $results_per_page * ($page - 1);

	$table_name = Request::val('t');
	if(!in_array($table_name, array_keys(getTableList()))) {
		/* invalid table */
		echo '{"results":[{"id":"","text":"Invalid table"}],"more":false,"elapsed":0}';
		exit;
	}

	/* if id is provided, get owner */
	$owner = false;
	if($id)
		$owner = sqlValue("SELECT `memberID` FROM `membership_userrecords` WHERE `tableName`='{$table_name}' AND `pkValue`='" . makeSafe($id) . "'");

	$prepared_data = [];
	$where = "g.`name`!='{$adminConfig['anonymousGroup']}' and p.`allowView`>0 ";
	if($search_term) {
		$search_term = makeSafe($search_term);
		$where .= "and (u.memberID like '%{$search_term}%' or g.name like '%{$search_term}%')";
	}

	$eo = ['silentErrors' => true];
	$res = sql("SELECT u.`memberID`, g.`name` FROM `membership_users` u LEFT JOIN `membership_groups` g ON u.`groupID`=g.`groupID` LEFT JOIN `membership_grouppermissions` p ON g.`groupID`=p.`groupID` AND p.`tableName`='{$table_name}' WHERE {$where} ORDER BY g.`name`, u.`memberID` LIMIT {$skip}, {$results_per_page}", $eo);
	while($row = db_fetch_row($res)) {
		$row = array_map('strip_tags', $row);
		$prepared_data[] = ['id' => to_utf8($row[0]), 'text' => to_utf8("<b>{$row[1]}</b>/{$row[0]}")];
	}

	echo json_encode([
		'results' => $prepared_data,
		'more' => ($res && db_num_rows($res) >= $results_per_page),
		'elapsed' => round(microtime(true) - $start_ts, 3),
	]);
