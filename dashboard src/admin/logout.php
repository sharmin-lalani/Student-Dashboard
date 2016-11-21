<?php

session_start();


if(isset($_SESSION['logged_in']) &&isset($_SESSION['adminid']))
		{
			unset($_SESSION['adminid']);
			$_SESSION['logged_in']="false";
			header('Location: admin_login.php');
		}



?>