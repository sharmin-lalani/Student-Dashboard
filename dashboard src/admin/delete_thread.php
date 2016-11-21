<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">
<title>Delete Thread</title>
</head>

<body>
<?php
include('../header.html');
$id = $_GET['id'];
if(isset($_POST['confirm']))
{if(mysql_query("delete from forum where thread_id=$id"))
	{
	?>
    <div class="box" style="width:600px; margin-bottom:580px;">
    <br />
    <center><h2 style="color:#066 ">Thread Deleted</h2></center>
	<div style="font-size:15px;">The thread has successfully been deleted.<br /><br />
	<a href="<?php echo "threads.php"; ?>">Go back to Threads</a></div>
    </div>
	<?php
	}
	else
	{
		?>
    <div class="box" style="width:600px; margin-bottom:580px;">
    <br />
    <center><h2 style="color:#066 ">Thread Not Deleted</h2></center>
	<div style="font-size:15px;">An error occured while deleting the thread.<br /><br />
	<a href="<?php echo "threads.php"; ?>">Go back to Threads</a></div>
    </div>
	<?php
	}
}
else
{
?>	


<div class="box" style="width:600px; margin-bottom:530px;">
   <br />
     <center><h2 style="color:#066 ">Delete Thread</h2></center>
  <form action="delete_thread.php?id=<?php echo $id; ?>" method="post" style="padding: 10px;">
	<p style="font-size:16px;">Are you sure you want to delete this thread?</p>
    <input type="hidden" name="confirm" value="true" />
    <input type="submit" style="padding: 5px 30px;" value="Yes" />
    <input type="button" style="padding: 5px 35px;" value="No" onclick="javascript:history.go(-1);" />
</form>
  
</div>

<?php
}

?>


<?php
include('../footer.html');
?>
</body>
</html>