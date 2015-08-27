<?php
require("../content/db.php");
require("../content/user.class.php");
$user = new user($db);

$reg = $user->newUser($_POST["firstn"], $_POST["lastn"], $_POST["username"], $_POST["loc"], $_POST["pcode"], $_POST["street"], $_POST["house"], $_POST["country"], $_POST["email"], $_POST["birth"], $_POST["password"]);

if($reg = "1") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($user->checkLogin($user->getUserId($username), $password)) {
        $token = $user->setgetRandomToken($user->getUserId($username));
        session_start();
        $_SESSION["uid"] = $user->getUserId($username);
        $_SESSION["token"] = $token;
        $_SESSION["checked"] = true;
        if($_POST["cookies"]) {
            setcookie("uid", $user->getUserId($username), time() + 31536000);
            setcookie("token", $token, time() + 31536000);
        }
        echo "1";
    }
    else
        echo "0";
}
else
    echo "0";

?>
