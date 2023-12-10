<?php
    $hooks_dir = dirname(__FILE__);
     include("$hooks_dir/lib.php");
     include_once("$hooks_dir/header.php");
 
    /* grant access to all users who have access to the orders table */
    $order_from = get_sql_from('orders');
    if(!$order_from) exit(error_message('Access denied!', false));
    
    /* grant access to all users who have access to the customers table */
    $customer_from = get_sql_from('customers');
    if(!$customer_from) exit(error_message('Access denied!', false));

    /* get invoice */
    $order_id = intval($_REQUEST['OrderID']);
    if(!$order_id) exit(error_message('Invalid order ID!', false));

    /* retrieve order info */
	$order_fields = get_sql_fields('orders');
	$res = sql("select {$order_fields} from {$order_from} and OrderID={$order_id}", $eo);
	
    /* retrieve customer info */
    $customer_id = 'ALFKI';
    $customer_fields = get_sql_fields('customers');
    $custres = sql("select {$customer_fields} from customers and CustomerID={$customer_id}", $eo);
    $customer = db_fetch_assoc($custres);

    var_dump($customer_from);

 
    /* retrieve order items
    $items = array();
    $order_total = 0;
    $item_fields = get_sql_fields('order_details');
    $item_from = get_sql_from('order_details');
    $res = sql("select {$item_fields} from {$item_from} and order_details.OrderID={$order_id}", $eo);
    while($row = db_fetch_assoc($res)){
        $row['LineTotal'] = str_replace('$', '', $row['UnitPrice']) * $row['Quantity'];
        $items[] = $row;
        $order_total +=$row['LineTotal'];
    }

    //var_dump($items);

    ?>
<!-- Container -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
	  <div class="row align-items-center gy-3">
		<div class="row align-items-center">
		  <img id="logo" src="images/cmri.jpg" title="Test" alt="Test" />
		</div>
	  </div>
	  <hr>
  </header>
  <div class="row">
		<div class="col-sm-6"><strong>Date:</strong> <?php echo $order['OrderDate']; ?></div>
		<div class="col-sm-6 text-sm-end"> <strong>Invoice No:</strong> <?php echo $order_id; ?></div>
		  
	  </div>
	  <hr>
	  <div class="row">
		<div class="col-sm-6 text-sm-end order-sm-1"> <strong>From:</strong>
		  <address>
		  Children Ministries Resources International<br />
          13501 NE 12th Pl <br />
		  Bellevue, WA 98005-2762 <br />
		  (425) 283-7425 <br />
          www.childrenministries.org <br />
		  </address>
		</div>
		<div class="col-sm-6 order-sm-0"> <strong>Received By:</strong>
		  <address>
		  Smith Rhodes<br />
		  15 Hodges Mews, High Wycombe<br />
		  HP12 3JL<br />
		  United Kingdom
		  </address>
		</div>
    <hr>

    <!-- order items -->
    <table class="table table-striped table-bordered">
        <thead>
            <th class="text-center">#</th>
            <th>Item</th>
            <th class="text-center">Unit Price</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Line Total</th>
        </thead>

        <tbody>
            <?php foreach($items as $i => $item) {?>
                <tr>
                    <td class="text-center"><?php echo ($i + 1); ?></td>
                    <td><?php echo $item['ProductID']; ?></td>
                    <td class="text-right"><?php echo $item['UnitPrice']; ?></td>
                    <td class="text-right"><?php echo $item['Quantity']; ?></td>
                    <td class="text-right">$<?php echo number_format($item['LineTotal'], 2); ?></td>
                </tr>
            <?php } ?>
        </tbody>

        <tfoot>
            <tr>
                <th colspan="4" class="text-right">Subtotal</th>
                <th class="text-right">$<?php echo number_format($order_total, 2); ?></th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Shipping</th>
                <th class="text-right">$<?php echo number_format($order['Freight'], 2); ?></th>
            </tr>
            <tr>
                <th colspan="4" class="text-right">Total</th>
                <th class="text-right">$<?php echo number_format($order_total + $order['Freight'], 2); ?></th>
            </tr>
        </tfoot>
    </table>


    <?php 


    include_once("$hooks_dir/footer.php");*/
?> 