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
			
		$assign_id=$_REQUEST['assign_id'];
			
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Submissions</title>
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
<!--menu ends>


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
		 <?php
include('get_sidebar2.php');
?>  
        
<!--sidebar1 starts-->
        
<!--end sidebar1-->		
        
        <!-- content starts-->
		<div id="content">
			<?php
			if(isset($_POST['submit']))
			{
				$student_id=$_POST['student_id'];
				$marks=$_POST['marks'];
				$remarks=$_POST['remarks'];
				$assign_id=$_POST['assign_id'];
				$que=mysql_query("	update submission set marks_obtained ='$marks', remarks ='$remarks'
				where student_id=$student_id and assign_id=$assign_id");
				
				header("Location:view_submission.php?assign_id=$assign_id");		
				
			}
			
			
            ?>
      
				<h1 class="title">View Submissions</h1> <br />
                <?php
				$query = mysql_query("select * from submission where assign_id=$assign_id and marks_obtained is NULL");
				
				
				if(mysql_num_rows($query))
				{
				?>
                <table cellpadding="5px" style="text-align:left; margin-left:-25px; text-align:center; font-size:15px; ">
				<tr class="row">
    			<th>Student ID</th>
    			<th>View Submission</th>
                <th>Marks and Reamarks</th>
                
                
    			
          
                </tr>
                
                <?php
				while($res = mysql_fetch_array($query))
				{
				?>
                <tr class="row">
                <td><a href="../profile.php?user_id=<?php echo $res['student_id'];?>"><?php echo $res['student_id']; ?></a></td>
                <td><a href="submission/<?php echo $res['file_path'];?>" target="_blank">Solution</a></td>

                <td><form action="view_submission.php" method="post"> 
                <input type="text" name="marks" placeholder="Marks" size="3" />
                <input type="text" name="remarks" placeholder="Remarks" />
                <input type="hidden" name="student_id" value="<?php echo $res['student_id'];?>" />
                <input type="hidden" name="assign_id" value="<?php echo $assign_id;?>" />
                <input type="submit" name="submit" value="Evaluate" />
                </form></td>
                
                </tr>
                
                <?php
				}
				?>
                </table>
                <?php
				}
				else
				{
				?>
                
                 <p> There are no Submissions to evaluate right now.
                 </p>
                 <?php
				 header("refresh: 5; url=get_course.php");
				}
				?>
				
			
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