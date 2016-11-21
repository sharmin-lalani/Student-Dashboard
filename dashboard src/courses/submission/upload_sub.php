
<?php

require_once('../../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../../login.php');
}

else $username= $_SESSION['username'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>VJTI Dashboard</title>
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
			<li ><a href="../../courses/course.php">Courses</a></li>
			<li  class="current_page_item"><a href="../../documents/documents_personal.php">Documents</a></li>
            <li ><a href="../../event/event.php">Events</a></li>
			<li><a href="../../forum/forum.php">Forums</a></li>
			<li ><a href="../../blog/blog.php">Blogs</a></li>
			<li><a href="../../webmail/" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends-->

<div id="page1">
	<div id="page-bg1">

<!-- content starts-->
		<div id="content">

<?php

//The following array will hold all PHP error messages

$errors = array(1 => "The file exceeds the maximum file size specification.",

2 => "The file exceeds the maximum file size specification.",

3 => "The file was not fully uploaded.",

4 => "The file was not properly uploaded.",

6 => "An error occurred during uploading.",

7 => "An error occurred during uploading.",

8 => "An error occurred during uploading.");

$allowedExtensions = array("doc","docx","log","txt","tex","wps","csv","dat","ppt","pptx","tar","zip","vcf","xml","mp3","mid","mpa","wma","3gp","asf","avi","flv","mp4","mpg","srt","swf","wmv","psd","pdf","xlr","xls","xlsx","sql","apk","jar","vb","wsf","rar","zipx","jpeg","jpg","gif","png");

//This function will return the user to the form, displaying the proper error message

function uploadFail($error) {

header("location:course.php");

echo "<p>".$error."  You are now being returned to the upload form.</p>";

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
$user_id=$_SESSION['userid'];
$file['name']=$user_id;
$time=time();
$file['name'] = $file['name']."-".$time;


while (file_exists("submission/".$file['name'])) {
	
$time=time();
$file['name'] = $file['name']."-".$time;

}
$file['name']=$file['name'].".".$file['ext'];

//Finally move the file to the proper place

if(move_uploaded_file($file['tmp'],$file['name'])) {
	
	$path=$file['name'];
	$type=$_POST['type'];
	
	
	$size=$file['size'];
	$assign_id=$_POST['assign_id'];
	if($type==0)
	{
		$query = mysql_query("insert into submission (assign_id, student_id,file_path, file_size)
	 values ('$assign_id', '$user_id','$path','$size')");
	}
	else
	{
		if($type==1)
		{
			$que=mysql_fetch_assoc(mysql_query("select file_path from submission where assign_id=$assign_id and student_id=$user_id"));
			$file_path=$que['file_path'];
			unlink($file_path);
			
		$query = mysql_query("update submission set file_path='$path', file_size='$size'  where assign_id=$assign_id and student_id=$user_id");}
	}
		
	 if($query)
	 {
		 if($type==1)
		 echo 'Your previous Solution has been replaced by the uploaded one since evaluation is not yet done!';?><br /><?php
	 }
	 else {
	 ?><p>Your Solution File has been uploaded.<br /><?php }?>
     <?php 
     $que1=mysql_fetch_assoc(mysql_query("select course_id from assignment where assign_id=$assign_id"));?>

Wait for your teachers to evaluate and announce Results!</p>
<br /><b><a href="../get_course.php?course_id=<?php echo $que1['course_id'];?>" style="color:#066; text-decoration:underline; font-size:14px">Go Back to the Course. </a></b>
<?php 
}

else { uploadFail($errors[6]); }

}

}

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
include('../../footer.html');
?>


</body>
</html>






