<?php
    $hooks_dir = dirname(__FILE__);
     include("$hooks_dir/lib.php");
     include_once("$hooks_dir/header.php");

    /* grant access to all users who have access to the customer table */
    $customer_from = get_sql_from('customers');
    if(!$customer_from) exit(error_message('Access denied!', false));
 
    /* get customer */
    $customer_id ='ALFKI';
    if(!$customer_id) exit(error_message('Invalid customer ID!', false));

    /* retrieve customer info */
	$customer_fields = get_sql_fields('customers');
	$res = sql("select {$customer_fields} from {$customer_from} and CustomerID={$customer_id}", $eo);
   if(!($customer =db_fetch_assoc($res))) exit(error_message('Customer not found!', false));
    
    var_dump($customer);



     include_once("$hooks_dir/footer.php");
     ?>