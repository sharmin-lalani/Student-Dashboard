<?php

require_once('check_session.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<?php
include('header.html');
?>

<!--wrapper starts-->

<div id="wrapper">
<!--menu starts-->
	<div id="menu">
		<ul>
			<li ><a href="index.php">Home</a></li>
            <li  class="current_page_item" ><a href="profile.php?user_id=<?php echo $_SESSION['userid'];?>">Profile</a></li>
			<li ><a href="courses/course.php">Courses</a></li>
			<li ><a href="documents/documents_personal.php">Documents</a></li>
            <li ><a href="event/event.php">Events</a></li>
			<li><a href="forum/forum.php">Forums</a></li>
			<li ><a href="blog/blog.php">Blogs</a></li>
			<li><a href="webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends>


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
    <?php
include('get_sidebar.php');
?>  
    
    <div id="content">
			
      
				<h1 class="title">User Profile</h1> <br />
		
    <?php  
	   if($_SESSION['userid']==$_GET['user_id'])
		$edit=1;
		else $edit=0;
		$user_id=$_GET['user_id'];
        $query1=mysql_query("select fname,lname,profession,gender from user where user_id=$user_id");
		if(mysql_num_rows($query1))
		{ 
			
		$query=mysql_fetch_assoc($query1);
		?>
        <table class="profile" cellpadding="5px" style="text-align:left; font-size:15px; ">
		<tr class="row">
        <td><b>ID No:</b> </td>
        <td><?php echo $user_id;?></td>
        </tr>
        
        <tr class="row">
        <td><b>First name:</b></td>
        <td><?php echo $query['fname'];?></td>
        </tr>
        
        <tr class="row">
        <td><b>Last name:</b></td>
        <td><?php echo $query['lname'];?></td>
        </tr>
        
        <tr class="row">
        <td><b>Gender:</b></td>
        <td><?php if( $query['gender']=="f")
					echo "Female" ;
					else echo "Male"; ?></td>
        </tr>
        
        <?php
		if($query['profession']=="s")
		{
			$stu1=mysql_query("select branch,year from student where student_id=$user_id");
			$stu=mysql_fetch_assoc($stu1);
			?>
           
        <tr class="row">
        <td><b>Profession:</b></td>
        <td>Student</td>
        </tr>
        
        <tr class="row">
        <td><b>Branch:</b></td>
        <td><?php echo $stu['branch'];?></td>
        </tr>
          
        <tr class="row">
        <td><b>Year:</b></td>
        <td><?php echo $stu['year']; ?></td>
        </tr>
			<?php
		}
		else {
			$teacher1=mysql_query("select dept,post,qualification from teacher where teacher_id=$user_id");
			$teacher=mysql_fetch_assoc($teacher1);
			?>
            
        <tr class="row">
        <td><b>Profession:</b></td>
        <td>Teacher</td>
        </tr>
        
        <tr class="row">
        <td><b>Department:</b></td>
        <td><?php echo $teacher['dept']; ?></td>
        </tr>
        
        <tr class="row">
        <td><b>Post:</b></td>
        <td><?php echo $teacher['post']; ?></td>
        </tr>
        
        <tr class="row">
        <td><b>Qualification:</b></td>
        <td><?php echo $teacher['qualification']; ?></td>
        </tr>
       
        <?php
		
		}
		?>
        </table>
        <?php 
		if($edit==1)
		{
		?>
        <div id="button_doc" style="margin: 20px 20px;">
        <a href="change_password.php">Change Password</a>
        </div>
        <?php
		}
		}
		
		else echo "Invalid User ID";
		?>
        
        
        </div>
        
        
    <div style="clear: both;">&nbsp;</div>
	</div>
    </div>
	<!-- end page -->
</div>
<!--end wrapper-->

<?php
include('footer.html');
?>

</body>
</html>