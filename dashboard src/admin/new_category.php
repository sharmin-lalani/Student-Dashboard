<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">
<title>New Category</title>
</head>

<body>
<?php
include('../header.html');

if(isset($_POST['name']) and $_POST['name']!='')
{
	$name = $_POST['name'];
	$name = stripslashes($name);
	$name = mysql_real_escape_string($name);
	if(mysql_query("insert into category (cat_name) values('$name')"))
	{
	?>
    <div class="box" style="width:600px; margin-bottom:520px;">
    <br />
    <center><h2 style="color:#066 ">Category Created</h2></center>
	<div style="font-size:15px;">The category has successfully been created.<br /><br />
	<a href="<?php echo "category.php"; ?>">Go back to Categories</a></div>
    </div>
	<?php
	}
	else
	{
		?>
    <div class="box" style="width:600px; margin-bottom:520px;">
    <br />
    <center><h2 style="color:#066 ">Category Not Created</h2></center>
	<div style="font-size:15px;">An error occured while creating the category<br /><br />
	<a href="<?php echo "category.php"; ?>">Go back to Categories</a></div>
    </div>
	<?php
	}
}
else
{
?>
<form class="box"  action="new_category.php" method="post" style=" margin-bottom:390px;">
   <br />
     <center><h2 style="color:#066 ">Create Category</h2></center>
   <table cellpadding="5px" class="boxBody">
   <tr><td><label for="name">Category Name:</label></td></tr>
	  <tr><td><input type="text" name="name" onFocus="this.style.background = '#ffffff';" onBlur="this.style.background = '#eeeeee'; "  required></td></tr>
	  </table>
    
    <footer >
	  <input type="submit" class="btnLogin" value="Create" >
	</footer>
</form>

<?php
}
?>

<?php
include('../footer.html');
?>
</body>
</html>