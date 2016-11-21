<?php

require_once('check_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/structure.css" media="screen" />
<title>Change Password</title>
<script language="javascript">
function validateForm()
{
	var z=document.forms["change"]["new"].value.length;
	if(z<6)
	{
		alert("Password length should be atleast 6 characters");
		event.returnValue = false;
		return False;
	}
	
	var x=document.forms["change"]["new"].value;
	var y=document.forms["change"]["cnew"].value;
	if(x!=y)
	{
		alert("Passwords do not match!");
		event.returnValue = false;
		return False;
	}
	
}
</script>
</head>

<body>

<!-- start header -->
<?php
include('header.html');
?>
    <!-- end header -->
    
   

<?php
 	if (isset($_POST['submit']))
	{
	$user_id= $_SESSION['userid'];
	$current= $_POST['current'];
	$current1=md5($current);
	$check = mysql_query("select password from user where user_id=$user_id");
	$pass=mysql_fetch_assoc($check);
	if($pass['password']==$current1)
	{
	$new1= $_POST['new'];
	$new= md5($new1);
	$query= "update user set password=\"$new\" where user_id=$user_id";
	$res = mysql_query($query);
	echo $res;
	if(!empty($res))
	{
		?>
		<div class="box login" style="margin-bottom:580px;">
		<center><h2 style="color:#066 ">Change Password</h2></center>
		<p> Password succesfully changed.</p>
        <p> <a href="index.php"> Go to Home </a></p>
		</div>
        <?php
	}
	
	else 
	{
		?>
        <div class="box login" style="margin-bottom:580px;">
		<center><h2 style="color:#066 ">Change Password</h2></center>
		<p> Password could not be changed due to an error</p>
        <p> <a href="index.php"> Go to Home </a></p>
		</div>
        <?php
	}
	}
    else 
	{
		?>
        <div class="box login" style="margin-bottom:580px;">
		<center><h2 style="color:#066 ">Change Password</h2></center>
		<p>  Password could not be changed. Enter correct current password!</p>
        <p> <a href="index.php"> Go to Home </a></p>
		</div>
        <?php
	}
	}
	else
	{
?> 
	
  
   
   <form class="box login"  name= "change" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" onSubmit="return validateForm();" style="margin-bottom:240px;">
   <br />
     <center><h2 style="color:#066 ">Change Password</h2></center>
   <table cellpadding="5px" class="boxBody">
   <tr><td>ID No: <?php echo $_SESSION['userid'];?></td></tr>
   <tr><td>Current Password: <div id="red">*</div> </td></tr>
	<tr><td><input type="password" name="current" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
    <tr><td>New Password: <div id="red">*</div> </td></tr>
	<tr><td><input type="password" name="new" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
    <tr><td>Confirm new Password: <div id="red">*</div> </td></tr>
	<tr><td><input type="password" name="cnew" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
	</table>
    
    <footer >
	  <input type="submit" name="submit" class="btnLogin" value="Send" >
	</footer>
</form>

<?php
	}
	?>
   
   
    
 <?php
include('footer.html');
?>
</body>
</html>
