<?php
if(!empty($_POST["pid"]) && !empty($_POST["count"])) {
    session_start();
    if (!empty($_SESSION["uid"])) {
        require("../content/db.php");
        require("../content/order.class.php");
        $order = new order($db);

        echo $order->orderProduct($_SESSION["uid"], $_POST["pid"], $_POST["count"]);
    }
    else
        echo "2";
}
else
    echo "false";
?>