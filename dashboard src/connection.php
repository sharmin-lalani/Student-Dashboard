<?php

session_start();
$con=mysql_connect("localhost","root","") or die("Couldn't connect to server!");
$qr=mysql_select_db("dash",$con) or die("Couldn't select database!");

?>
