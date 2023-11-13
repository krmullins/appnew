<?php
	/*
	 * You can add custom links in the home page by appending them here ...
	 * The format for each link is:
		$homeLinks[] = [
			'url' => 'path/to/link', 
			'title' => 'Link title', 
			'description' => 'Link text',
			'groups' => ['group1', 'group2'], // groups allowed to see this link, use '*' if you want to show the link to all groups
			'grid_column_classes' => '', // optional CSS classes to apply to link block. See: https://getbootstrap.com/css/#grid
			'panel_classes' => '', // optional CSS classes to apply to panel. See: https://getbootstrap.com/components/#panels
			'link_classes' => '', // optional CSS classes to apply to link. See: https://getbootstrap.com/css/#buttons
			'icon' => 'path/to/icon', // optional icon to use with the link
			'table_group' => '' // optional name of the table group you wish to add the link to. If the table group name contains non-Latin characters, you should convert them to html entities.
		];
	 */

$res = sql("SELECT * FROM membership_userrecords WHERE tableName='orders' ORDER BY dateAdded DESC LIMIT 1", $eo);
if($row = db_fetch_assoc($res)){
	$last_order_id =$row['pkValue'];
	$last_order_ts = $row['dateAdded'];
	$last_order_date = date('j/n/Y', $last_order_ts);
}


	 $homeLinks[] = [
	'url' => 'http://localhost/appnew/orders_view.php?SortField=&SortDirection=&FilterAnd%5B1%5D=and&FilterField%5B1%5D=8&FilterOperator%5B1%5D=is-empty&FilterValue%5B1%5D=', 
	'title' => 'Unshipped Orders', 
	'description' => 'Show all orders that are not yet shipped.<br><br>' . 
						'<a href="orders_view.php?SelectedID=' . urldecode($last_order_id) . '">Most Recent order </a> was placed on '. $last_order_date,
	'groups' => ['*'], // groups allowed to see this link, use '*' if you want to show the link to all groups
	'grid_column_classes' => 'col-md-4 col-lg-3', // optional CSS classes to apply to link block. See: https://getbootstrap.com/css/#grid
	'panel_classes' => 'panel-danger', // optional CSS classes to apply to panel. See: https://getbootstrap.com/components/#panels
	'link_classes' => 'btn-danger', // optional CSS classes to apply to link. See: https://getbootstrap.com/css/#buttons
	'icon' => '', // optional icon to use with the link
	'table_group' => 'Operations' // optional name of the table group you wish to add the link to. If the table group name contains non-Latin characters, you should convert them to html entities.
];
