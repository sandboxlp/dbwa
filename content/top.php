<?php // Kontrolle - nur 10.* und 127.* - Adressen ?>

<!DOCTYPE html>

<?php
include('content/db.php');
include('content/item.class.php');
include('content/order.class.php');
include('content/user.class.php');
include('content/webwirth.class.php');
$item = new item($db);
$order = new order($db);
$user = new user($db);
$webwirth = new webwirth();

session_start();

//echo "<h3>".$_SESSION["uid"]."</h3><h3>".$_SESSION["token"]."</h3><h3>".$_SESSION["checked"]."</h3><h3>".$user->checkToken($_SESSION["uid"], $_SESSION["token"])."</h3>";

if(!empty($_SESSION["checked"])) {
    if (!empty($_COOKIE["uid"]) && !empty($_COOKIE["token"])) {
        $_SESSION["uid"] = $_COOKIE["uid"];
        $_SESSION["token"] = $_COOKIE["token"];
    }
    $_SESSION["checked"] = true;
}

if(isset($_SESSION["uid"]) && isset($_SESSION["token"])) {
    if (!$user->checkToken($_SESSION["uid"], $_SESSION["token"])) {
        session_destroy();
        session_start();
        $_SESSION["checked"] = true;
        if (!empty($_COOKIE["uid"])) {
            unset($_COOKIE["uid"]);
            setcookie("uid", null, -1);
        }
        if (!empty($_COOKIE["token"])) {
            unset($_COOKIE["uid"]);
            setcookie("uid", null, -1);
        }
    }
}


?>

<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="imgs/logo_32.png" rel="shortcut icon" type="image/x-icon"/>
    <!--<script type="text/javascript" language="JavaScript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>-->
    <script type="text/javascript" language="JavaScript" src="script/jquery-1.11.3.min.js"></script>
    <script src="script/jquery.mobile.custom.min.js"></script>
    <script src="script/jquery.color-2.1.2.min.js"></script>

    <script src="script/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="script/jquery-ui-1.11.4/jquery-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="script/jquery-ui-1.11.4/jquery-ui.structure.min.css"/>
    <link rel="stylesheet" type="text/css" href="script/jquery-ui-1.11.4/jquery-ui.theme.min.css"/>

    <script>
        $(document).ready(function () {
            if ($("#btn_cookie_ok").length > 0) {
                $("#btn_cookie_ok").click(function () {
                    $.ajax({
                        url: "apis/btn_cookie_ok.php",
                        success: function (data) {
                            if (data) $("#btn_cookie_ok").hide();
                        },
                        error: function (jqXHR, status) {
                            $(".body").append("<p>Ein unbekannter Fehler ist aufgetreten. Bitte laden Sie die Seite neu und überprüfen Sie Ihre Internetverbindung!</p>");
                        }
                    });
                });
            }
        });
    </script>