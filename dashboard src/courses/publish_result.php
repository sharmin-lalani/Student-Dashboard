<?php
require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];

if(!isset( $_REQUEST['assign_id']))
			{
				header('Location:course.php');
				exit();
			}
			
			if($_SESSION['profession']!='T')
			{
				header("location:course.php");
				exit();
			}
			$user_id=$_SESSION['userid'];
		$assign_id=$_REQUEST['assign_id'];
	$q=mysql_query("update assignment set is_published=1 where assign_id=$assign_id ");		

 //send a notif to students
	$query4= mysql_query("select s.student_id from submission as s  where s.assign_id=$assign_id");
	if(mysql_num_rows($query4))
	{
		
		$add=mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','8' ,'$assign_id')");
			$notif2_id=mysql_insert_id();
		
		while($res=mysql_fetch_assoc($query4))
		{
			$com_id=$res['student_id'];
			$add=mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$com_id', '$notif2_id')");	
		}
		header("location:get_course.php");
	}
	
	?>