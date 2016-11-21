<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];

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
			
      
				<h1 class="title">My Courses</h1> <br />
                <?php
				$prof=$_SESSION['profession'];
				$user_id=$_SESSION['userid'];
				if ($prof=='T')
				{
					
				$query = mysql_query("select course_id, course_name,branch,year
				from course
				where teacher_id=$user_id");
				
                if(mysql_num_rows($query))
			
				{
					?>
                    <table cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<th>Course Name</th>
    			<th>Branch</th>
    			<th>Year</th>
                
                </tr>
                <?php
				while($res = mysql_fetch_assoc($query))
				{
				?>
                <tr class="row">
                <td><a href="get_course.php?course_id=<?php echo $res['course_id'];?>"><?php echo $res['course_name']; ?></a></td>
                <td><?php echo $res['branch']; ?></td>
                <td><?php echo $res['year']; ?></td>
                
                </tr>
                
                <?php
				
				
				}//while closed
				?>
                </table>
                <?php
				}//if closed
				else echo "There are no courses to display right now.";
				?>
                <div id="button_doc" style="margin: 20px 20px;">
            	<a  href="create_course.php"> Create a Course </a>
                </div>
                <?php
				}//if closed
				else
				{
						
				$query = mysql_query("select c.course_id, c.course_name, c.branch, c.year, c.teacher_id, 
				t.fname as teacher_fname, t.lname as teacher_lname, s.branch, s.year
				from course as c inner join user as t on c.teacher_id=t.user_id
				inner join student as s on s.branch=c.branch and s.year=c.year
				where s.student_id=$user_id and s.branch=c.branch and s.year=c.year");
				
					
				if(mysql_num_rows($query))
			
				{
				?>
                <table cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<th>Course Name</th>
    			<th>Professor</th>
    			
                </tr>
                <?php
				while($res = mysql_fetch_assoc($query))
				{
				?>
                <tr class="row">
                <td><a href="get_course.php?course_id=<?php echo $res['course_id'];?>"><?php echo $res['course_name']; ?></a></td>
                <td>
                <a href="../profile.php?user_id=<?php echo $res['teacher_id'];?>">
				<?php echo $res['teacher_fname'].' '. $res['teacher_lname']; ?></a>
                </td> 
                
                </tr>
                
                <?php
				
				
				}//while closed
				}//if closed
				else echo "There are no courses to display right now."
				?>
                </table>
                <?php
				}//else closed
		
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