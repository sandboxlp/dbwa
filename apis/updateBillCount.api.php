<?php
require("../content/db.php");
require("../content/order.class.php");
$order = new order($db);

echo $order->updateBillCount($order->get_bpid($_POST["bid"], $_POST["pid"]), $_POST["count"]);

?>