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
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/structure.css" media="screen" />


<title>Register</title>
<script language="javascript">
function validateForm()
{
	var z=document.forms["reg"]["password"].value.length;
	if(z<6)
	{
		alert("Password length should be atleast 6 characters");
		event.returnValue = false;
		return False;
	}
	
	var x=document.forms["reg"]["password"].value;
	var y=document.forms["reg"]["cpassword"].value;
	if(x!=y)
	{
		alert("Passwords do not match!");
		event.returnValue = false;
		return False;
	}
}

</script>
<script language="JavaScript" src="gen_validatorv31.js" type="text/javascript"></script>
</head>




<body>
<div id="header">
		<div id="logo">
			<h1>VJTI</h1>
			<p>Student Dashboard</p>
		</div>
</div>

<div id="wrapper" >
    
    <form class="box login" action="registeruser.php" method="post" name="reg"  style="height:845px; width: 480px;" enctype="application/x-www-form-urlencoded" onSubmit="return validateForm(this);">
    <br />
<center><h2 style="color:#066 ">Step II: Fill in the Details</h2></center>
<div id="alert">

<?php 
 if(isset($_GET['captcha'])){?>
 <center><b style="color:#A00; font-size:14px;"  >Captcha did not match!</b></center>
  
<?php }
?>
</div>
<table class="boxBody" cellpadding="5px" style="color:#444; padding:20px 20px;">
<tr>
<td>First Name:<div id="red">*</div></td>
<td><input type="text" name="fname" id="tbox" required="required" value="" /></td><!--<?php if(isset($_GET['name'])) echo $_GET['name'];?>-->
</tr>
<tr>
<td>Last Name:<div id="red">*</div></td>
<td><input type="text" name="lname" id="tbox" required="required" value="" /></td>
</tr>
<tr>
<td>Password:<div id="red">*</div></td>
<td><input type="password" name="password" id="tbox" required="required" /></td>
</tr>
<tr>
<td>Confirm Password:<div id="red">*</div></td>
<td><input type="password" name="cpassword" id="tbox" required="required" /></td>
</tr>
<tr>
<td>Mobile No:</td>
<td><input type="text" name="mobileno" pattern="[0-9]{10}" maxlength="10" id="tbox" value=""/></td><!--<?php if(isset($_GET['mobileno'])) echo $_GET['mobileno'];?>-->
</tr>

<tr style="margin-bottom:10px">
<td> Select Department:<div id="red">*</div></td>
<td>
<select name="dept">
<option value="I.T.">Information Technology</option>
<option value="Computers">Computer Science</option>
<option value="EXTC">Electronics and Telecommunication</option>
<option value="Electrical">Electrical Engineering</option>
<option value="Textile">Textiles Engineering</option>
<option value="Electronics"> Electronics Engineering</option>
<option value="Mechanics">Mechanical Engineering</option>
<option value="HUMANITIES">Humanities Department</option>
<option value="CHEMISTRY">Chemistry Department</option>
<option value="MATH">Mathematics Department</option>
</select></td>
</tr>
<tr>

<td>Post:<div id="red">*</div></td>
<td> <select name="post" >
<option value="Teacher">Teacher</option>
<option value="Assistant Teacher">Teacher's Assistant</option>
<option value="Supporting staff">Supporting staff</option>
<option value="H.O.D.">Head of Department</option>
<option value="Director">Director</option>

</select></td>
</tr>

<tr>
<td>Qualification:</td>
<td><input type="text"  name="qual" >
</td>
</tr>

<tr>
<td>Gender:</td>
<td><input type="radio" required="required" name="gender" value="m">Male
<input type="radio"  required="required" name="gender" value="f"/>Female</input></td>
</tr>
</table>
<p>
<img src="captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
<label for='message'>Enter the code above here :</label><br>
<input id="6_letters_code" name="6_letters_code" type="text"><br>
<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
</p>


<footer>
<input type="submit" class="btnLogin"value="Submit"/><input type="reset"class="btnLogin" style="float:left" value="Clear"/>
</footer>
</form>
   
   <div style="clear: both;"></div>
  
</div>
<!-- end wrapper -->
    
   <?php
include('footer.html');
?>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</body>
</html>