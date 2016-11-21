<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Admin Center</title>
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../css/structure.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<?php
include('../header.html');
?>
 
<div class="box" style="width:600px; margin-bottom:290px;">
   <br />
     <center><h2 style="color:#066; font-size: 30px; ">Admin Center</h2></center>
	<div style="text-align:center; padding:10px;">
    <div class="boxBody" >
    <h2 style="color:#066; "> Manage Users </h2>
    <div style="font-size:15px; line-height:1.2;">
    <a href="view_student.php"> View Student Accounts </a> <br />
    <a href="view_teacher.php"> View Teacher Accounts </a> <br />
    <a href="view_verified.php"> View Verified Accounts </a> <br />
    <a href="view_unverified.php"> View Unverified Accounts </a> <br />
    </div> 
    </div>
    <br />
    <div class="boxBody" >
    <h2 style="color:#066; "> Manage Forums </h2>
    <div style="font-size:15px; line-height:1.2;">
    <a href="category.php"> Manage Categories </a> <br />
    <a href="threads.php"> Manage Threads </a> <br />
    </div> 
    </div>
    <br />
    <div class="boxBody" >
    <h2 style="color:#066; "> Manage Blogs </h2>  
    <div style="font-size:15px; line-height:1.2;">
    <a href="posts.php"> Manage Posts </a> <br />
    </div> 
    </div>    
</div> 
</div>

<?php
include('../footer.html');
?>

</body>
</html>