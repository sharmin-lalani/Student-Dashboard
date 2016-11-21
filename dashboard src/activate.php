<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/structure.css" media="screen" />
<title>Login</title>
</head>

<body>

<!-- start header -->
<div id="header">
		<div id="logo">
			<h1>VJTI</h1>
			<p>Student Dashboard</p>
		</div>
</div>
    <!-- end header -->
    
<div id="wrapper">
<div class="box login" style="margin-bottom:600px;">
<?php 
include_once('connection.php');
$act = $_GET['act'];
$user_id = $_GET['user_id'];
$sql = "SELECT * from activation where user_id='$user_id' and random='$act'";
$res = mysql_query($sql);

if(!empty($res))
$num = mysql_num_rows($res);
else $num =0;

if($num == 1)
{
  mysql_query("Update user SET verified=1 WHERE user_id='$user_id'");
  mysql_query("Delete from activation WHERE user_id='$user_id'");
  echo '<b>Your account is activated.</b> <br /><br /> <a href="login.php">Login now</a>';
}
 else
  echo "Wrong link bro!";
?> 
    
</div>
   
   <div style="clear: both;"></div>
  
</div>
<!-- end wrapper -->
    
  <?php
include('footer.html');
?>
</body>
</html>







