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

    //var_dump($order);
 
    /* retrieve order items */
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

    <div class="row">
        <div class="col-sm-6">
            <!-- company info -->
            <h1>Northwind Co.</h1>
            <h5>1 Infinite Loop,<br>Cupertino, CA 95014<br>USA</h5>
        </div>
        <div class="col-sm-6 text-right">
            <!-- invoice info -->
            <h1>INVOICE</h1>
            <h5>Date: <?php echo $order['OrderDate']; ?></h5>
            <h5>Invoice No. <?php echo $order_id; ?></h5>
        </div>
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


    include_once("$hooks_dir/footer.php");
?>