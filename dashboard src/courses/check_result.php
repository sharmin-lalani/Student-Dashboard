<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];
if ( !isset($_GET['assign_id']))
{
	header('Location: course.php');
exit();
}
if(isset( $_GET['notif_id']))
			{
				$notif_id=$_GET['notif_id'];
				$me=$_SESSION['userid'];
				$seen=mysql_query("update notif_for set has_seen=1 where notif_id=$notif_id and user_id=$me");
			}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Courses</title>
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
			<li  class="current_page_item"><a href="course.php">Courses</a></li>
			<li ><a href="../documents/documents_personal.php">Documents</a></li>
            <li ><a href="../event/event.php">Events</a></li>
			<li><a href="../forum/forum.php">Forums</a></li>
			<li ><a href="../blog/blog.php">Blogs</a></li>
			<li><a href="../webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends-->


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
		
         <?php
include('get_sidebar2.php');
?>  
		
        
        <!-- content starts-->
		<div id="content">
			
      <?php
	  $assign_id=$_GET['assign_id'];
	   $que = mysql_query("select * from assignment where assign_id=$assign_id");
	   $exist_or_not = mysql_num_rows($que);
			if ($exist_or_not == 1 )
			{$que1=mysql_fetch_assoc($que);
				$course_id=$que1['course_id'];
				$topic=$que1['topic'];?>
                <div class="post">
            
				<h1 class="title" >Results of Assignment : <?php echo $topic;?></h1>
                <br />
                </div>
                <?php
			
			
			$query1 = mysql_query("select * from submission where assign_id=$assign_id and marks_obtained IS NOT NULL");
			
			
					if(mysql_num_rows($query1))
					{?>
                    
						<table  cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<th>UserID</th>
    			<th>Marks Obtained</th>
    			
                </tr>
                <?php
					while($res = mysql_fetch_array($query1))
					{
						
					?>
				<tr class="row">
    			<td><?php echo $res['student_id']; ?></td>
    			<td><?php echo $res['marks_obtained']; ?></td>
    			</tr>
               <?php 
			   		}
					}
					else{
					echo 'Your Assignments have not yet been Evaluated!
                    Teachers will put up the results soon.';}
			}
			else header("location:course.php");
					
			
			
			    ?>
                </table><br />
                
                   
                    <br /><b><a href="course.php" style="color:#066; text-decoration:underline; font-size:14px">Go Back to the Courses</a></b>
                    
                
            
				
			
				</div>
		
<!-- end content -->
		
    <div style="clear: both;">&nbsp;</div>
	</div>
    </div>
	<!-- end page -->
</div>
<!--end wrapper-->

<?php
include('../footer.html');
?>

</body>
</html>