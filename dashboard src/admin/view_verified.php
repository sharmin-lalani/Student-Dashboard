<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">
<title>Manage Users</title>
<style>
th, td
{
	padding:5px 10px;
}

</style>

</head>

<body>
<?php
include('../header.html');
?>
<a style="color:#fff; padding:10px 0px 10px 150px; font-size:20px; text-decoration:underline;" href="index.php">Admin Center </a>
<div class="box" style="width:900px; margin-bottom:500px;">
   <br />
     <center><h2 style="color:#066;">Manage Verified Accounts</h2></center>
  
   <table class="boxBody" style=" width:900px; text-align:left; font-size:15px; padding-left:2z0px; ">
   <tr>
    	<th style="font-size:17px;">User ID</th>
    	<th style="font-size:17px;">First Name</th>
        <th style="font-size:17px;">Last Name</th>
        <th style="font-size:17px;">Profession</th>
    	<th style="font-size:17px;">Action</th>
   </tr>
<?php
$row = mysql_query("select user_id, fname, lname, profession from user where verified=1 order by fname");
if(mysql_num_rows($row))
{
while($res = mysql_fetch_array($row))
{
?>
	<tr>
    	 <td><?php echo $res['user_id']; ?></td>
         <td><?php echo $res['fname']; ?></td>
         <td><?php echo $res['lname']; ?></td>
         <td><?php if($res['profession']=='s')echo "Student"; else echo "Teacher" ; ?></td>
         <td><a href="delete_user.php?id='<?php echo $res["user_id"]; ?>'"><img src="../images/delete.png" alt="Delete" title="delete"/></a>
        </td>
     </tr>
<?php
}
}
?>
	</table>
</div>



<?php
include('../footer.html');
?>
</body>
</html>