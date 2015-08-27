<?php
session_start();
if(!empty($_SESSION["uid"]) && !empty($_SESSION["token"])) {
    require("../content/db.php");
    require("../content/user.class.php");
    $user = new user($db);

    if($user->checkToken($_SESSION["uid"], $_SESSION["token"])) {
        if($user->payPlease($_SESSION["uid"]))
            echo "1";
        else
            echo "0";
    }
}
else
    echo "0";
?>