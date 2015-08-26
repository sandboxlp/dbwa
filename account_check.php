<?php
session_start();
if (!empty($_SESSION["uid"]) && !empty($_SESSION["token"])) {
    require("content/db.php");
    require("content/user.class.php");
    $user = new user($db);

    if ($user->checkToken($_SESSION["uid"], $_SESSION["token"]))
        header("Location: account.php");
    else
        header("Location: login.php");
    }
else
    header("Location: login.php");

?>