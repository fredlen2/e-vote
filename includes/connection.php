<?php
	$connect = mysql_connect("localhost","root","PASSword1") or die("Couldn't connect to server");
	$db = mysql_select_db("election",$connect) or die("Couldn't connect to database");
?>