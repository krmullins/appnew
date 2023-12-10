<?php
    $hooks_dir = dirname(__FILE__);
     include("$hooks_dir/lib.php");
     include_once("$hooks_dir/header.php");
 
    /* grant access to all users who have access to the orders table */
    $order_from = get_sql_from('orders');
    if(!$order_from) exit(error_message('Access denied!', false));
 
    /* get invoice */
    $order_id = intval($_REQUEST['OrderID']);
    if(!$order_id) exit(error_message('Invalid order ID!', false));

    /* retrieve order info */
	$order_fields = get_sql_fields('orders');
	$res = sql("select {$order_fields} from {$order_from} and OrderID={$order_id}", $eo);
	if(!($order = db_fetch_assoc($res))) exit(error_message('Order not found!', false));

    var_dump($order);

    include_once("$hooks_dir/footer.php");
?>