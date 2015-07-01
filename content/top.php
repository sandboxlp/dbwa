<!DOCTYPE html>

<?php
include('content/db.php');
include('content/item.class.php');
include('content/order.class.php');

$item = new item($db);
$order = new order($db);
?>

<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/css/bootstrap.min.css" rel="stylesheet" />
<link href="imgs/logo_32.png" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" language="JavaScript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function(){
	if($("#btn_cookie_ok").length > 0)
	{
		$("#btn_cookie_ok").click(function(){
			$.ajax({
					url: "apis/btn_cookie_ok.php",
					success:function(data) {
						if(data) $("#btn_cookie_ok").hide();
					},
					error: function(jqXHR, status) {
						$(".body").append("<p>Ein unbekannter Fehler ist aufgetreten. Bitte laden Sie die Seite neu und überprüfen Sie Ihre Internetverbindung!</p>");
					}
			});
		});
	}
});
</script>