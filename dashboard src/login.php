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

     <div id="error">
   <?php
 
	if(isset($_GET['error'])) 
	echo "<br/><br/><h2>Incorrect login information. Please try again.</h2>"
	?>
    </div>
   
   <form class="box login"  method="post" action="checklogin.php">
   <br />
     <center><h2 style="color:#066 ">Login</h2></center>
   <table cellpadding="5px" class="boxBody">
   <tr><td>ID No: <div id="red">*</div></td></tr>
	  <tr><td><input type="text" name="userid" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
	  <tr><td><a href="forgot_password.php" class="rLink" >Forgot your password?</a> Password :<div id="red">*</div></td></tr>
	  <tr><td><input type="password" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee';" name="password"  required></td></tr>
      <tr><td> Select Option : <div id="red">*</div></td></tr><br />
      <tr><td><select name="profession" style="margin-left:5px; margin-bottom:5px; ">
      <option value="S">Student</option>
  <option value="T">Teacher</option>
  </select></td></tr>
	</table>
    
    <footer >
	  <input type="submit" class="btnLogin" value="Login" >
      <div style="margin-top: -10px;">
      Don't have an account yet? <br />
       <a href="signup.php" style="color:#555; font-size:12px;" ><b>Sign Up</b> </a> <br />
      Already registered? <br />
       <a href="resend_link.php" style="color:#555; font-size:12px;" ><b>Resend activation email</b> </a>
       </div>
	</footer>
</form>
   
   <div style="clear: both;"></div>
  
</div>
<!-- end wrapper -->
    
   <?php
include('footer.html');
?>
</body>
</html>
