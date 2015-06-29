<?php
	try {
		//if($_SERVER["SERVER_ADDR"] == "127.0.0.1")
            $db = new PDO ("mysql:host=127.0.0.1;dbname=dbwa","htluser","htluser");
        //else
        //  $db = new PDO ("mysql:host=db581505915.db.1and1.com;dbname=db581505915","dbo581505915","NeuRaph4130.98");
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}
	catch(PDOException $e) {
		header("HTTP/1.1 503 Service Unavailable");
		die();
	}
?>