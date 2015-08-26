<?php
    require("../content/db.php");
    require("../content/user.class.php");
    $user = new user($db);

    $username = $_POST["username"];
    $password = $_POST["password"];

    if($user->checkLogin($user->getUserId($username), $password)) {
        $token = $user->setgetRandomToken($user->getUserId($username));
        session_start();
        $_SESSION["uid"] = $user->getUserId($username);
        $_SESSION["token"] = $token;
        $_SESSION["checked"] = true;
        if($user->setCookie($user->getUserID($username))) {
            setcookie("uid", $user->getUserId($username), time() + 31536000);
            setcookie("token", $token, time() + 31536000);
        }
        echo "true";
    }
    else
        echo "false";
?>