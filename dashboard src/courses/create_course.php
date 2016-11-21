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
<title>Courses</title>
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
                
<?php
if(isset($_POST['title']) )
{
	$user_id = $_SESSION['userid'];
	
	$title = $_POST['title'];
	
	$branch = $_POST['branch'];
	$year = $_POST['year'];

	
		$title = stripslashes($title);
		
	
	$title = mysql_real_escape_string($title);
	
	
	$query = mysql_query("insert into course (teacher_id, course_name, branch,year)
	 values ('$user_id', '$title','$branch','$year'	)");
	 $course_id=mysql_insert_id();
	 if($query){
?>
    <div id="content">
			
				<h1 class="title">Create an Event</h1> <br />
				<p> The Course has successfully been created. </p>
            	<a href="course.php" style="color:#066; font-size:14px;"><b>Go to back to your Courses.</b></a>
			
	</div>
	
	<?php
	}
	else
	{
		?>
            <div id="content">
			
				<h1 class="title">Create a New Course</h1> <br />
				<p> An error occurred while creating the Course. </p>
            	<a href="course.php">Go to back to your Courses.</a>
			
	</div>
    <?php
	}
}

else
{
?>
	<div id="content">
	<h1 class="title">Create a new Course</h1> <br />
	<form name="myform" action="create_course.php" method="post">
	<label for="title">Course Name:</label><br />
    <input type="text" name="title" id="title" required="required" />
    <br /><br />
    
    
    
    
    <label>Select branch:</label><br />
    <select name="branch" >
    
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
   
	<option value="F.Y.">First Year</option>
	<option value="S.Y.">Second Year</option>
	<option value="T.Y."> Third Year</option>
	<option value="B.Tech">Final Year-BTech</option>
    <option value="all">All</option>
	</select><br /><br />
    
 
    <input type="submit" id="create" value="Create" />
    <br /><br />
	</form>

	</div>
<?php
}
?>
	
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