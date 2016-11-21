<?php

require_once("connection.php");
$error = '';
$id=$_REQUEST["id"];
$email=$_REQUEST["email"];
$cemail=$_REQUEST["cemail"];
$prof=$_REQUEST["prof"];

$query = "SELECT user_id FROM user WHERE user_id = '$id' LIMIT 1";
$result = mysql_query($query);
$num = mysql_num_rows($result);

 if($num == 1)
{
	$error = "User-id already used";
	header("Location: signup.php?iderror=1&email=".$email."&prof=".$prof);
	exit();
}


$query = "SELECT email FROM user WHERE email = '$email' LIMIT 1";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if($num == 1)
{
	$error = "Email-id already used";
	header("Location: signup.php?emailerror=1&id=".$id."&prof=".$prof);
	exit();
}


	
$id=filter_var($id, FILTER_SANITIZE_NUMBER_INT);
$email=filter_var($email, FILTER_SANITIZE_STRING);
$prof=filter_var($prof, FILTER_SANITIZE_STRING);

/*$query="INSERT INTO user (user_id, email,profession,verified) VALUES ('$id', '$email', '$prof', 0)";
$ins=mysql_query($query) or die("Query failed" . mysql_error() );*/
$_SESSION['userid']=$id;
$_SESSION['email']=$email;
$_SESSION['profession']=$prof;
echo $_SESSION['userid'];

if($prof=="s")
{
header("Location: register.php");

}
else
{
	header("Location: register_teacher.php");
}

?>

