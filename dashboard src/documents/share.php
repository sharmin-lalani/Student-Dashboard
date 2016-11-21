<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
exit();

}

else $username= $_SESSION['username'];
if(!isset($_GET['doc_id']))
{
	header('Location:documents_personal.php?no_doc_id=1');
	exit();
}
else {
	$doc_id=$_GET['doc_id'];
	$user_id=$_SESSION['userid'];
	$que=mysql_query("select doc_name,doc_desc,file_path,data_created,uploaded_by from document where
	uploaded_by=$user_id and doc_id=$doc_id");
	if(mysql_num_rows($que)==0)
	{
		echo 'You do not have rights to share file or the file does not exist!';
		header("refresh: 5; url=documents_personal.php");
		exit();
	}
	else
	{
		$res=mysql_fetch_assoc($que);
	}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Share Documents</title>

<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>


<!--header starts-->
	<div id="header">
		<div id="logo">
			<h1>VJTI</h1>
			<p>Student Dashboard</p>
		</div>
        
		<div id="toplink">
		<a href="../logout.php" >Logout</a>
		</div>
	</div>
 <!--header ends-->
  
<!--wrapper starts-->

<div id="wrapper">
<!--menu starts-->
	<div id="menu">
		<ul>
			<li ><a href="../index.php">Home</a></li>
            <li ><a href="../profile.php?user_id=<?php echo $_SESSION['userid'];?>">Profile</a></li>
			<li ><a href="../courses/course.php">Courses</a></li>
			<li  class="current_page_item"><a href="documents_personal.php">Documents</a></li>
            <li ><a href="../event/event.php">Events</a></li>
			<li><a href="../forum/forum.php">Forums</a></li>
			<li ><a href="../blog/blog.php">Blogs</a></li>
			<li><a href="../webmail/" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends-->

<div id="page1">
	<div id="page-bg1">
 <?php
include('get_sidebar2.php');
?>  
<!-- content starts-->
                
<?php

if(isset($_POST['branch']) and isset($_POST['year']) and isset($_POST['dept']))
{

	$branch = $_POST['branch'];
	$year = $_POST['year'];
	$dept = $_POST['dept'];
	
	if($branch=="all")
	{
		if($year=="all" || $year=="none")
		{
			$query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
			$user=mysql_query("select student_id from student where student_id!=$user_id" );
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
	
			}
		}
		else 
		{
			 $query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
			$user=mysql_query("select s.student_id from student as s inner join user as u on s.student_id=u.user_id
			where s.year=$year and student_id!=$user_id" );
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			
	
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
			}
		}
	}
	else if($branch=="none")
	{
		if($year=="all")
		{
			$query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
			$user=mysql_query("select student_id from student where student_id!=$user_id" );
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			
	
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
			}
			
		}
		else if($year!="none")
		{
			$query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
			$user=mysql_query("select s.student_id from student as s inner join user as u on s.student_id=u.user_id
			where s.year='$year' and student_id!=$user_id" );
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			
	
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
			}
		}
	}
	else
	{
		$query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
		$user=mysql_query("select s.student_id from student as s inner join user as u on s.student_id=u.user_id
			where s.year='$year' and s.branch='$branch' and student_id!=$user_id" );
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			
	
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
			}
	}
	
	if($dept=="all")
	{
		$query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
		$user=mysql_query("select teacher_id from teacher where teacher_id!=$user_id" );
		$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['teacher_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			
	
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
			}
	}
	
	else if($dept!="none")
	{
		$query = mysql_query("update document set is_private=0 where doc_id=$doc_id");
		$user=mysql_query("select t.teacher_id from teacher as t inner join user as u on t.teacher_id=u.user_id
			where t.dept='$dept' and teacher_id!=$user_id" );
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','5' ,'$doc_id')");
			$notif_id=mysql_insert_id();
	
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['teacher_id'];
				$invite = mysql_query("insert into shared_document (user_id, doc_id) values ($stu, $doc_id)");
				
				//send a notif
	
			
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$stu','$notif_id')");
			}
	}
	
	
	if($que)
	{
	?>
    <div id="content">
   
			
				<h1 class="title">Share a Document</h1> <br />
				<p> The Document has been successfully shared. </p>
            	<a href="documents_personal.php" >Go to back to Documents</a>
			
	</div>
	
	<?php
	}
	else
	{
		?>
            <div id="content">
			
				
				<h1 class="title">Share a Document</h1> <br />
				<p> An Error occurred while sharing the document. </p>
            	<a href="documents_personal.php">Go to back to Documents</a>
			
	</div>
    <?php
	}
	
}
else
{
?>
	<div id="content">
	<h1 class="title">Share a Document</h1> <br />
    
        <div id="eachcomment" style="text-align:left">  
        <?php
		$q=mysql_query("select doc_name, data_created, file_path, doc_desc from document where doc_id=$doc_id");
		if($q)
		{
			$res=mysql_fetch_assoc($q);
		?>     
        <p> <a href="<?php echo $res['file_path'];?>" target="_blank" style=" font-size:16px;"><?php echo $res['doc_name'];?></a>
        :<br />  
        <small > Added on 
		<?php 
		echo $res['data_created'];  ?></small></p>
        <p><b style="color:#004040;"> Description:</b><br />
        <?php echo $res['doc_desc']; ?>
        
        </div>
	
	<form name="myform" action="share.php?doc_id=<?php echo $doc_id;?>" method="post">
	
    
    <label style="color:#066; font-size:14px;"><b>Share Document with:</b></label><br /><br />
    <label style="color:#066; font-size:12px;"><b>Students:</b></label><br />
    
    <label>Select branch</label><br />
    <select name="branch" >
    <option value="none">None</option>
	<option value="I.T.">Information Technology</option>
	<option value="Computers">Computer Science</option>
	<option value="EXTC">Electronics and Telecommunication</option>
	<option value="Electrical">Electrical Engineering</option>
	<option value="Textile">Textiles Engineering</option>
	<option value="Electronics"> Electronics Engineering</option>
	<option value="Mechanics">Mechanical Engineering</option>
    <option value="all">All Branches</option>
    </select><br />
    
    <label >Select year</label><br />
   	<select name="year">
  	<option value="none">None</option>
	<option value="F.Y.">First Year</option>
	<option value="S.Y.">Second Year</option>
	<option value="T.Y."> Third Year</option>
	<option value="B.Tech">Final Year-BTech</option>
    <option value="all">All</option>
	</select><br /><br />
    
    
	
    
    <label style="color:#066; font-size:12px;"><b>Teachers:</b></label><br />
    <label>Select department</label><br />
    <select name="dept">
	<option value="none">None</option>
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
    <option value="all">All Departments</option>
	</select><br /><br />
    
    <input type="submit" id="button_current" value="Share" />
    <br /><br />
	</form>

	</div>
<?php
}
}
?>
	
<!-- end content -->
		
    <div style="clear: both;">&nbsp;</div>
	</div>
    </div>
	<!-- end page -->
</div>
<!--end wrapper-->
</div>
</div>
<?php
include('../footer.html');
?>


</body>
</html>


