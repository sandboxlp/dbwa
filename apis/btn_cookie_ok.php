<?php
	if(setcookie("btn_cookie_ok", 1, time()+60*60*24*30, '/'))
		echo true;
	else
		echo false;
?>