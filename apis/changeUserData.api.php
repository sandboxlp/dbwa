<?php
require("../content/db.php");
require("../content/user.class.php");
$user = new user($db);
session_start();

echo $user->changeUserData($_SESSION["uid"], $_POST["username"], $_POST["firstn"], $_POST["lastn"], $_POST["nickn"], $_POST["loc"], $_POST["pcode"], $_POST["street"], $_POST["house"], $_POST["country"], $_POST["email"], $_POST["birth"], $_POST["token"]);

?>