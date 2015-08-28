<?php
require("../content/db.php");
require("../content/order.class.php");
$order = new order($db);

session_start();
echo $order->setBillStatus($order->getCurrentBill($_SESSION["uid"]), "1");

?>