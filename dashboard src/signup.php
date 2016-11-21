<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/structure.css" media="screen" />

<title>Sign Up</title>
<script language="javascript">
function validateForm()
{
	var x=document.forms["sign"]["email"].value;
	var y=document.forms["sign"]["cemail"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if(atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		alert("Not a valid E-mail Address");
		event.returnValue = false;
		return False;
	}
	if( x!=y)
	{
		alert(" Email Address does not match");
		event.returnValue = false;
		return False;
	}
}
</script>
	
</head>

<body>

<div id="header">
		<div id="logo">
			<h1>VJTI</h1>
			<p>Student Dashboard</p>
		</div>	
	</div>
    
    
<div id="wrapper">
<div id="error">
<?php
	if(isset($_GET['iderror'])) 
	echo "<h2>User-Id already Exists!</h2>";
	else if(isset($_GET['emailerror']))
	echo "<h2>Email-Address already Exists!</h2>";
	?>
    </div>

   <form class="box login" action="reg1.php"  method="post" name="sign" onsubmit="return validateForm();" >
    <br />
   
   <center><h2 style="color:#066 ">Sign Up</h2></center>
   <table class="boxBody" cellpadding="5px"  >
   <tr><td>Enter Your ID No:</td> </tr>
	<tr>  <td><input type="text"  name="id"  pattern="[0-9]*" maxlength="10" required value="<?php if(isset($_GET['id'])) echo $_GET['id'];?>"></td></tr>
	  <tr><td>Enter Email Address:</td> </tr>
	  <tr><td><input type="text"  name="email" required value="<?php if(isset($_GET['email'])) echo $_GET['email'];?>"></td></tr>
      <tr><td> Confirm Email Address:</label></td></tr>
      <tr><td> <input type="text" name="cemail"  required value="<?php if(isset($_GET['email'])) echo $_GET['email'];?>"></td></tr>
      <tr><td> Profession: </label></td></tr>
      <tr><td><input type="radio" name="prof" value="s" required="required">Student</input>
<input type="radio" name="prof" value="t"/>Teacher</input></td></tr>
	</table>
    
    <footer > 
	  <input type="submit" class="btnLogin" value="Proceed to next step" >
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
