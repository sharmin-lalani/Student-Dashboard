<?php
session_start();
if(!isset($_SESSION['userid']))
{header("Location:signup.php");
exit();}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/structure.css" media="screen" />
</head>

<body>
<div id="header">
		<div id="logo">
			<h1>VJTI</h1>
			<p>Student Dashboard</p>
		</div>
</div>
<div class="box login" style="height:auto; line-height:1; margin-bottom:380px;">
<br />
     <center><h2 style="color:#066 "> Account Successfully created!</h2></center>
<br />
<p style="font-size:17px;"> To activate your account please follow the link that has been sent to you at: <br /> <br /> <?php echo '<span style= "font-size:20px;" >'. $_SESSION['email']. '</span>'; ?> </p> 
<p style="font-size:17px;"> The email may take some time to be delivered. If you do not receive any email from us within sometime click the "resend activation email" link on the Login page.</p>
</div>

   <?php
include('footer.html');
?>
</body>
</html>