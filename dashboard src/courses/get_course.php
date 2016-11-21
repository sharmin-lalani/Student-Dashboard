<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];

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
		<div id="content" >
			
      <?php
			if(!isset( $_GET['course_id']))
			{
				header('Location:course.php');
				exit();
			}
			$course_id=$_GET['course_id'];
			$query1 = mysql_query("select * from course where course_id=$course_id");
			$exist_or_not = mysql_num_rows($query1);
			if ($exist_or_not == 1 )
			{
				$query=mysql_fetch_assoc($query1);
				$course_name=$query['course_name'];
				$branch=$query['branch'];
				$year=$query['year'];
				$file_path=$query['file_path']
			
			?>
				<h1 class="title"><?php echo $course_name ;?></h1> <br />
               
                <table cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<td><b>Course Name:</b></td>
    			<td><?php echo $course_name; ?></td>
    			</tr>
                <tr class="row">
    			<td><b>Branch:</b></td>
    			<td><?php echo $branch; ?></td>
    			</tr>
                <tr class="row">
    			<td><b>Year:</b></td>
    			<td><?php echo $year ; ?></td>
                </tr>
                
                <?php if($file_path!= NULL)
				{
					?>
                    <tr>
                    <td><b>Syllabus:</b></td>
    			<td><a style="text-decoration:underline; color:#066;" target="_blank" href="syllabus/<?php echo $file_path;?>">Download File</a></td> 
                </tr>
                    <?php
				}?>
    			
                </table><br />
                
                <?php
				$prof=$_SESSION['profession'];
				if ($prof=='T')
				{
					if($file_path==NULL)
					{
						
					?>
                    <div id="button_doc"><a href="syllabus/upload_syllabus.php?course_id=<?php echo $course_id;?>"  style=" font-size:16px;"><span>Upload Syllabus</span></a></div><br /><br />
                    <?php
					}
					else{
					?>
                     <div id="button_doc"><a href="syllabus/upload_syllabus.php?course_id=<?php echo $course_id;?>"  style=" font-size:16px;"><span>Update Syllabus</span></a></div><br /><br />
                     <?php }?>
                    
                     <h2>Assignments</h2>
					<?php
					$assign=mysql_query("select * from assignment where course_id=$course_id order by deadline desc ");
					if(mysql_num_rows($assign))
					{
					while($res = mysql_fetch_array($assign))
					{
						
					?>
                <table cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<td><b>Assignment Topic:</b></td>
    			<td><a href="<?php echo $res['file_path'] ;?>" target="_blank" style="text-decoration:underline;""><?php echo $res['topic']; ?></a></td>
    			</tr>
                <tr class="row">
    			<td><b>Total marks:</b></td>
    			<td><?php echo $res['total_marks']; ?></td>
    			</tr>
                <tr class="row">
                <?php if($res['eval_criteria']!='')
				{
					?>
    			<td><b>Evaluation Criteria:</b></td>
    			<td><?php echo $res['eval_criteria']; ?></td>
    			</tr>
                <?php } ?>
                <tr class="row">
    			<td><b>Deadline:</b></td>
    			<td><?php echo $res['deadline'] ; ?></td>
    			</tr>
             
                </table><br />
                <div style="margin-bottom:50px; margin-top:0px;" align="center">
                <div id="button_doc"><a href="view_submission.php?assign_id=<?php echo $res['assign_id'];?>"  style=" font-size:16px;"><span>View Submissions</span></a></div>
               <?php $deadline=$res['deadline'];
			   $assign_id=$res['assign_id'];
			   $publish=$res['is_published'];
			   $count=mysql_num_rows(mysql_query("select * from submission where assign_id=$assign_id and marks_obtained is NULL"));
				$todays_date = date("Y-m-d");
				$today = strtotime($todays_date);
				$expiration_date = strtotime($deadline);
				if ($expiration_date < $today && $publish==0 && $count==0)
								 {?>
                                 <div id="button_doc"><a href="publish_result.php?assign_id=<?php echo $res['assign_id'];?>"  style=" font-size:16px;"><span>Publish Results</span></a></div>
                                <?php 
								}
								else
								{
								?>
                                 <div id="button_doc"><a href="check_result.php?assign_id=<?php echo $res['assign_id'];?>"  style=" font-size:16px;"><span>View Results</span></a></div>
                                <?php	
								}
								?>
                </div>
					<?php
						
					}
					}
					else echo "There are no Assignments to display right now.";?>
					<div id="button_current" style="margin-top:25px; margin-left:250px;	width:180px; float:left"><a href="upload_assignment.php?course_id=<?php echo $course_id;?>">Add an Assignment</a></div>
			<?php	}
				
					
				
				else
				{
					
					$assign=mysql_query("select * from assignment where course_id=$course_id order by deadline desc");
					if(mysql_num_rows($assign))
					{
					while($res = mysql_fetch_array($assign))
					{
						
					?>
                    <h2>Assignments</h2>
                <table cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<td><b>Assignment Topic:</b></td>
    			<td><a href="<?php echo $res['file_path'] ;?>" target="_blank" style="text-decoration:underline;""><?php echo $res['topic']; ?></a></td>
    			</tr>
                <tr class="row">
    			<td><b>Total marks:</b></td>
    			<td><?php echo $res['total_marks']; ?></td>
    			</tr>
                <tr class="row">
                <?php if($res['eval_criteria']!='')
				{
					?>
    			<td><b>Evaluation Criteria:</b></td>
    			<td><?php echo $res['eval_criteria']; ?></td>
    			</tr>
                <?php } ?>
                <tr class="row">
    			<td><b>Deadline:</b></td>
    			<td><?php echo $res['deadline'] ; ?></td>
    			</tr>
                
                
                <?php
				$assign_id=$res['assign_id'];
				$user_id=$_SESSION['userid'];
				$sub=mysql_query("select * from submission where assign_id= $assign_id and student_id=$user_id");
				if(mysql_num_rows($sub)==1)
				{
					$res1=mysql_fetch_array($sub);
					if($res1['marks_obtained']!=NULL)
					{
						?>
						<tr class="row">
    			<td><b>Marks Obtained:</b></td>
    			<td><?php echo $res1['marks_obtained'] ; ?></td>
    			</tr>
						
                            <tr class="row">
    			<td><b>Remarks:</b></td>
    			<td><?php echo $res1['remarks'] ; ?></td>
    			</tr>
                <?php 
				
				}
				
				}?>
                            
				
				
                </table><br />
                <div style="margin-bottom:50px; margin-top:0px;" align="center">
                <div id="button_doc"><a href="<?php echo $res['file_path'];?>"  target="_blank"style=" font-size:16px;"><span>Download</span></a></div>
                <div id="button_doc" style="float:left"><a href="upload_file.php?assign_id=<?php echo $res['assign_id'];?>"><span>Upload Submission</span></a></div>
                <div id="button_doc" style="float:left"><a href="check_result.php?assign_id=<?php echo $res['assign_id'];?>"><span>Check Results</span></a></div>
                </div>
					<?php
						
					}
					}
					else echo "There are no Assignments to display right now.";
				}
				
			}
			            
		
				?>
               <br /><br /><br /> 
             <a href="course.php" style="float:right; text-decoration:underline; color:#066;" ><b>Go Back</b> </a>  
				
			
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