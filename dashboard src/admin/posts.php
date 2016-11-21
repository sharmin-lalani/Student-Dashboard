<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">
<title>Manage Posts</title>
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
     <center><h2 style="color:#066;">Manage Posts</h2></center>
  
   <table class="boxBody" style=" width:900px; text-align:left; font-size:15px; padding-left:10px; ">
   <tr>
    	<th style="font-size:17px;">Titles</th>
    	<th style="font-size:17px;">Author</th>
        <th style="font-size:17px;">Date</th>
    	<th style="font-size:17px;">Action</th>
   </tr>
<?php
$row = mysql_query("select t.post_id, t.title, t.user_id, u.fname as author, t.date_time as date
				from blog as t inner join user as u on t.user_id=u.user_id 
				order by date desc");

while($res = mysql_fetch_array($row))
{
?>
	<tr>
    	 <td><a style= " color: #000;" href="view_post.php?post_id=<?php echo $res['post_id']; ?>"><?php echo $res['title']; ?></a></td>
         <td><?php echo $res['author']; ?></td>
         <td><?php echo $res['date']; ?></td>
         <td><a href="delete_post.php?id='<?php echo $res["post_id"]; ?>'"><img src="../images/delete.png" alt="Delete" title="delete"/></a>
        </td>
     </tr>
<?php
}
?>
	</table>
</div>



<?php
include('../footer.html');
?>
</body>
</html>