<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">
<title>Admin Login</title>
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
	if(isset($_GET['error'])) 
	echo "<br/><br/><h2>Incorrect login information. Please try again.</h2>"
	?>
   
   <form class="box"  method="post" action="../checklogin.php?admin=true" style=" margin-bottom:300px;">
   <br />
     <center><h2 style="color:#066 ">Admin Login</h2></center>
   <table cellpadding="5px" class="boxBody">
   <tr><td>Admin ID: <div id="red">*</div></td></tr>
	  <tr><td><input type="text" name="userid" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
	  <tr><td>Password :<div id="red">*</div></td></tr>
	  <tr><td><input type="password" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee';" name="password"  required></td></tr>
	</table>
    
    <footer >
	  <input type="submit" class="btnLogin" value="Login" >
	</footer>
</form>
    
   <?php
include('../footer.html');
?>
</body>
</html>
