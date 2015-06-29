<?php
	/* try {
		//if($_SERVER["SERVER_ADDR"] == "127.0.0.1")
            $db = new PDO ("mysql:host=127.0.0.1;dbname=dbwa","htluser","htluser");
        //else
        //  $db = new PDO ("");
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	catch(PDOException $e) {
		header("HTTP/1.1 503 Service Unavailable");
		die();
	} */

    $db = new mysqli("127.0.0.1", "phpstorm", "123456", "dbwa");
?>