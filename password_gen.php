<?php
require("content/db.php");
require("content/user.class.php");
$user = new user($db);
echo $user->hashPassword($_GET["password"]);
echo "<br/>".strlen($user->hashPassword($_GET["password"]));
?>