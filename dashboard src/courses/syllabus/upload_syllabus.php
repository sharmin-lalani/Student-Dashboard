<?php

require_once('../../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../../login.php');
exit();
}


else $username= $_SESSION['username'];
$user_id=$_SESSION['userid'];
if(!isset($_REQUEST['course_id']))
{
	header("location:../course.php?succes=0");
	exit();
}
if($_SESSION['profession']!='T')
{
	header("location:../course.php");
	exit();
}
else $course_id=$_REQUEST['course_id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Syllabus</title>

<link href="../../css/structure.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../../css/default.css" rel="stylesheet" type="text/css" media="screen" />



</head>

<body>

<!--header starts-->
	<div id="header">
		<div id="logo">
			<h1>VJTI</h1>
			<p>Student Dashboard</p>
		</div>
        
		<div id="toplink">
		<a href="../../logout.php" >Logout</a>
		</div>
	</div>
 <!--header ends-->

<!--wrapper starts-->
<div id="wrapper">
<!--menu starts-->
	<div id="menu">
		<ul>
			<li ><a href="../../index.php">Home</a></li>
            <li ><a href="../../profile.php?user_id=<?php echo $_SESSION['userid'];?>">Profile</a></li>
			<li  class="current_page_item"><a href="../course.php">Courses</a></li>
			<li ><a href="../../documents/documents_personal.php">Documents</a></li>
            <li ><a href="../../event/event.php">Events</a></li>
			<li><a href="../../forum/forum.php">Forums</a></li>
			<li ><a href="../../blog/blog.php">Blogs</a></li>
			<li><a href="../../webmail" target="_blank">Email</a></li>
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
		if(isset($_POST['submit']))
		{
		
			/*$topic=$_POST['topic'];
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

$allowedExtensions = array("doc","docx","txt","ppt","pptx","pdf","xlr","xls","xlsx","jpeg","jpg","gif","png");

//This function will return the user to the form, displaying the proper error message

function uploadFail($error) {

header("refresh: 5; url=../get_course.php");

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
while (file_exists($file['name'])) {
$time=time();
$file['name'] = $time."-".$file['name'];

}

//Finally move the file to the proper place

if(move_uploaded_file($file['tmp'],$file['name'])) {
	
	$path=$file['name'];
	
	$size=$file['size'];
	$query1 = mysql_query("select file_path from course where course_id=$course_id"); 
	if(mysql_num_rows($query1))
	{
		$res1=mysql_fetch_assoc($query1);
		$file_path=$res1['file_path'];
		if($file_path!=NULL)
		{
			unlink($file_path);
		}
	$query = mysql_query("update course set file_path='$path' where course_id=$course_id"); 
	 
	}
	
echo 'Your Syllabus has been uploaded';


header("refresh: 4; url=../get_course.php?course_id=$course_id");
}

else { uploadFail($errors[6]);
header("refresh: 5; url=../get_course.php?course_id=$course_id"); }

}

}

}

	/*file upload done*/
	
	
		}
		
		else
		{
			
		
		
		?>
        
                  <h1 class="title" >Syllabus</h1>
          
             <form class="box login"  style="margin-top:50px; margin-left:-05px; background-color:#378484;" method="post" action="upload_syllabus.php" enctype="multipart/form-data">
             <center><h2 style="color:#eee ">Add Syllabus</h2></center>
   <table cellpadding="5px"  align="center"class="boxBody">
   
   <tr><td><input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></td></tr>
   <tr><td><input type="hidden" name="course_id" value="<?php echo $course_id;?>" /></td></tr>
   
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
include('../../footer.html');
?>


</body>
</html>