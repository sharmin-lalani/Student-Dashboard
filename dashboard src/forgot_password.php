<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/structure.css" media="screen" />
<title>Reset Password</title>
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
    
   

<?php
 	if (isset($_POST['submit']))
	{
	include("connection.php");
	$user_id= $_POST['userid'];
	$query= "select email, verified from user where user_id= $user_id";
	$res = mysql_query($query);
	
	if(!empty($res))
    $num = mysql_num_rows($res);
    else $num =0;
	
	if($num == 1)
    {
	$row = mysql_fetch_assoc($res);
	$email= $row['email'];
	$ver= $row['verified'];
	if($ver == 1)
	{
	$random = rand();
	$rand = md5($random);
	$que=mysql_query("update user SET password= '$rand' WHERE user_id=$user_id");
	
	$cont = "Your password has been reset. \n New password : $random. You can reset your password again after logging in from your profile page.";
		if(mail($email, "Password reset!", $cont))
			{echo "<h1>New password mailed to: $email</h1>";header("refresh: 3; url=login.php");}
			else {
				echo "<h1>Failed to send mail</h1>";
				header("refresh: 3; url=login.php");
			}
	}
	
   else{ echo "<h1>Verify your account first!</h1>";header("refresh: 3; url=login.php");}
	}
   else{ echo "<h1>Account not found!</h1>";header("refresh: 3; url=login.php");}
	}
?> 
	
  
   
   <form class="box login"  method="post" action="<?php echo $_SERVER['PHP_SELF']?>" style="margin-bottom:390px;">
   <br />
     <center><h2 style="color:#066 ">Reset Password</h2></center>
   <table cellpadding="5px" class="boxBody">
   <tr><td>ID No: <div id="red">*</div></td></tr>
	  <tr><td><input type="text" name="userid" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
	</table>
    
    <footer >
	  <input type="submit" name="submit" class="btnLogin" value="Send" >
	</footer>
</form>
   
   
    
 <?php
include('footer.html');
?>
</body>
</html>
