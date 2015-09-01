<?php
    session_start();
    if (!empty($_SESSION["uid"])) {
        require("../content/db.php");
        require("../content/order.class.php");
        $order = new order($db);

        $ing = explode(",", $_POST["ing"]);
        if($ing[0] == "")
            $ing = array();

        echo $order->orderPizza($_SESSION["uid"], $_POST["size"], $_POST["takeaway"], $_POST["cut"], $ing);
    }
    else
        echo "2";
?>