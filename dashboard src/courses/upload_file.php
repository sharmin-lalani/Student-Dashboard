<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
exit();
}

else $username= $_SESSION['username'];

if ( !isset($_GET['assign_id']))
{
	header('Location: course.php');
exit();
}
	
$assign_id=$_GET['assign_id'];
$user_id=$_SESSION['userid'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Documents</title>
<link href="../css/structure.css" rel="stylesheet" type="text/css" media="screen" />
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

<div id="page1">
	<div id="page-bg1">
 <?php
include('get_sidebar2.php');
?>  
<!-- content starts-->
		<div id="content">
        <?php 
		$type=0;
        $query1 = mysql_query("select * from assignment where assign_id=$assign_id");
			$exist_or_not = mysql_num_rows($query1);
			if ($exist_or_not == 1 )
			{
				$query=mysql_fetch_assoc($query1);
				$course_id=$query['course_id'];
				$topic=$query['topic'];
				$deadline=$query['deadline'];
				$todays_date = date("Y-m-d");
				$today = strtotime($todays_date);
				$expiration_date = strtotime($deadline);
				if ($expiration_date < $today)
				 {
     echo "The Deadline for this Assignment is over!";
	 ?><br /><b><a href="course.php" style="color:#066; text-decoration:underline; font-size:14px">Go Back to the Courses</a></b><?php 
		} 
else {
     
			$que = mysql_query("select * from course where course_id=$course_id");
			$num= mysql_num_rows($que);
			if ($num == 1 )
			{
				$res=mysql_fetch_assoc($que);
				$course_name=$res['course_name'];
			
			?>
        
			<div class="post">
            
				<h1 class="title" ><a href="#"><?php echo $course_name;?></a></h1>
				<div style="margin-bottom:10px;margin-top:10px;">
				<div id="doc">
					<strong>Assignment: <?php echo $topic;?></strong>
			   </div>
               <?php
			   $check = mysql_query("select * from submission where student_id=$user_id and assign_id=$assign_id");
			$no= mysql_num_rows($check);
			
			if($no==1)
			{
				$check1=mysql_fetch_assoc($check);
				
				if($check1['marks_obtained']==NULL)
				{
					$type=1;
				}
				else $type=3;
			}?>
			   
               <?php if($type==0||$type==1)
			   {
				   ?>
          
             <form class="box login"  style="margin-top:50px; margin-left:-05px; background-color:#378484;" method="post" action="submission/upload_sub.php" enctype="multipart/form-data">
             <center><h2 style="color:#eee ">Upload Submission</h2></center>
   <table cellpadding="5px"  align="center"class="boxBody">
   
   <tr><td><input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></td></tr>
   <tr><td><label for="file">Solution File:</label> </td></tr>
	  <tr><td><input type="file" name="file"   required   /></td></tr>
	  <tr><td><input type="hidden" value=<?php echo $type; ?> name="type"/></td></tr>
      <tr><td><input type="hidden" value=<?php echo $assign_id; ?> name="assign_id"/></td></tr>
	  
	  <tr><td><footer ><input type="submit" name="submit" class="btnLogin" value="Upload" ></footer></td></tr>
      

     
	</table>
             
                 
                    
			
</form>
<?php
			   }
			
			   else
			   {
				   ?>
              <p>
               The previously uploaded solution is already evaluated, you cannot upload solution now!
               <br />
               Check your results.</p>
               <br /><b><a href="course.php" style="color:#066; text-decoration:underline; font-size:14px">Go Back to the Courses</a></b>
             
             
             <?php } } } }?>
         
			</div>
	
<!-- end content -->
		
    <div style="clear: both;">&nbsp;</div>
	</div>
    </div>
	<!-- end page -->
</div>
<!--end wrapper-->
</div>
<?php
include('../footer.html');
?>


</body>
</html>