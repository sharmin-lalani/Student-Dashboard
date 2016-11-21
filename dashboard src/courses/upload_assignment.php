<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
exit();
}

else $username= $_SESSION['username'];
$user_id=$_SESSION['userid'];
if(!isset($_REQUEST['course_id']))
{
	header("location:course.php?succes=0");
	exit();
}
if($_SESSION['profession']!='T')
{
	header("location:course.php");
	exit();
}
else $course_id=$_REQUEST['course_id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Assignment</title>
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="../css/structure.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
<script language="javascript">
$(document).ready(function() 
{
$("#datepicker").datepicker();

});


</script>

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
		if(isset($_POST['topic']))
		{
		
			$topic=$_POST['topic'];
			$eval=$_POST['eval'];
			$marks=$_POST['marks'];
			$deadline1 = $_POST['deadline'];
	$deadline2= explode("/",$deadline1);
	$deadline= "$deadline2[2]-$deadline2[0]-$deadline2[1]";
	/*file upload*/

//The following array will hold all PHP error messages

$errors = array(1 => "The file exceeds the maximum file size specification.",

2 => "The file exceeds the maximum file size specification.",

3 => "The file was not fully uploaded.",

4 => "The file was not properly uploaded.",

6 => "An error occurred during uploading.",

7 => "An error occurred during uploading.",

8 => "An error occurred during uploading.");

$allowedExtensions = array("doc","docx","txt","tex","wps","csv","ppt","pptx","pdf","xlr","xls","xlsx","zipx","jpeg","jpg","gif","png");

//This function will return the user to the form, displaying the proper error message

function uploadFail($error) {

header("refresh: 5; url=get_course.php");

echo "<p>".$error."  You are now being returned to the Courses.</p>";

}

//This function will get the file's extension

function getExtension($file) {

$file = explode(".",$file);

return strtolower($file[count($file)-1]);

}

//The following array will hold all of our file information

$file = array("tmp" => $_FILES['file']['tmp_name'],

"name" => $_FILES['file']['name'],

"type" => $_FILES['file']['type'],

"size" => $_FILES['file']['size'],

"error" => $_FILES['file']['error']);

$file['ext'] = getExtension($file['name']);

//Processing begins here

//Make sure the page is accessed through the form

if (!isset($_POST['submit'])) { uploadFail("You may only access this page through the form."); }

else {

if ($file['error'] != 0) { uploadFail($errors[$file['error']]); } //Check for PHP errors

else {

//Check file extension

if (!in_array($file['ext'],$allowedExtensions)) { uploadFail("Uploaded file (".$file['name'].") is of a disallowed type."); }

else { //Now the file is fine; let's finish the upload

//Make sure file name is not already in use
$filename=$file['name'];
/*$file['name']=$file['name'].".".$file['ext'];*/
while (file_exists("assignments/".$file['name'])) {
$time=time();
$file['name'] = $time."-".$file['name'];

}

//Finally move the file to the proper place

if(move_uploaded_file($file['tmp'],"assignments/".$file['name'])) {
	
	$path="assignments/".$file['name'];
	
	$size=$file['size'];
	
	$query = mysql_query("insert into assignment (course_id,teacher_id,eval_criteria,topic,total_marks,deadline, file_path, file_size)
	 values ('$course_id', '$user_id','$eval','$topic','$marks','$deadline','$path','$size')");
	 $assign_id=mysql_insert_id();
	 
	 //send a notif to students
	$query4= mysql_query("select s.student_id from student as s inner join course as c on s.branch=c.branch and s.year=c.year where c.course_id=$course_id");
	if(mysql_num_rows($query4))
	{
		
		$add=mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','7' ,'$course_id')");
			$notif2_id=mysql_insert_id();
		
		while($res=mysql_fetch_assoc($query4))
		{
			$com_id=$res['student_id'];
			$add=mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$com_id', '$notif2_id')");	
		}
	}
	
echo 'Your Assignment has been uploaded';


header("refresh: 5; url=get_course.php?course_id=$course_id");
}

else { uploadFail($errors[6]);
header("refresh: 5; url=get_course.php?course_id=$course_id"); }

}

}

}

	/*file upload done*/
	
	
		}
		
		else
		{
			
		
		
		?>
        
                  <h1 class="title" > Assignment</h1>
          
             <form class="box login"  style="margin-top:50px; margin-left:-05px; background-color:#378484;" method="post" action="upload_assignment.php" enctype="multipart/form-data">
             <center><h2 style="color:#eee ">Add an  Assignment</h2></center>
   <table cellpadding="5px"  align="center"class="boxBody">
   
   <tr><td><input type="hidden" name="MAX_FILE_SIZE" value="5000000000" /></td></tr>
   <tr><td><input type="hidden" name="course_id" value="<?php echo $course_id;?>" /></td></tr>
   <tr><td><label >Assignment Topic</label> </td></tr>
   <tr><td><input type="text" name="topic" required="required"   /></td></tr>
   <tr><td><label >Evaluation Criteria:</label> </td></tr>
   <tr><td><input type="text" name="eval"   /></td></tr>
   <tr><td><label >Total Marks:</label> </td></tr>
	  <tr><td><input type="text" name="marks" pattern="[0-9]*" maxlength="3" required="required"  /></td></tr>
      <tr><td><label>Deadline:</label></td></tr>
   <tr><td> <input name="deadline" id="datepicker" required="required"/></td></tr>
   <tr><td><input type="file" name="file"   required   /></td></tr>
	  
	  <tr><td><footer ><input type="submit" name="submit" class="btnLogin" value="Upload" ></footer></td></tr>
  
	</table>
  
</form>
<?php
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
</div>
<?php
include('../footer.html');
?>


</body>
</html>