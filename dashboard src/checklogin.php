<?php
require_once('connection.php');

$user_id = $_POST['userid'];
$password = $_POST['password'];
$user_id= stripslashes($user_id);
$password= stripslashes($password);
$user_id= mysql_real_escape_string($user_id);
$password= mysql_real_escape_string($password);
$password = md5($password);

if(!isset($_GET['admin']))
{
	$profession = $_POST['profession'];
	$query = "select user_id, fname, password, profession  from user where user_id = '$user_id' and password = '$password' and verified='1' and profession='$profession'";
	$runquery = mysql_query($query);
	$exist_or_not = mysql_num_rows($runquery);

	if ($exist_or_not == 1 )
	{
		$row = mysql_fetch_assoc($runquery);
		$_SESSION['logged_in'] = true;
		$_SESSION['userid'] = $user_id;
		$_SESSION['profession'] = $profession;
		$_SESSION['username'] = $row['fname'];
		header("location: index.php");
	}

	else
	{
		header("location: login.php?error=1");
	}
}

else
{
	$query = "select admin_id, password from admin where admin_id = '$user_id' and password = '$password' ";
	$runquery = mysql_query($query);
	$exist_or_not = mysql_num_rows($runquery);

	if ($exist_or_not == 1 )
	{
		$row = mysql_fetch_assoc($runquery);
		$_SESSION['logged_in'] = true;
		$_SESSION['adminid'] = $user_id;
		header("location: admin/index.php");
	}

	else
	{
		header("location: admin/admin_login.php?error=1");
	}
}
?>