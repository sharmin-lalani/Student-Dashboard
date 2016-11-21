<?php

require_once('../../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../../login.php');
exit();
}

else $username= $_SESSION['username'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Upload Revision</title>
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
			<li  class="current_page_item"><a href="../documents_personal.php">Documents</a></li>
            <li ><a href="../../event/event.php">Events</a></li>
			<li><a href="../../forum/forum.php">Forums</a></li>
			<li ><a href="../../blog/blog.php">Blogs</a></li>
			<li><a href="../../webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends-->

<div id="page1">
	<div id="page-bg1">

<!-- content starts-->
		<div id="content">
        <h1 class="title" >My Documents</h1>
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

header("refresh: 15; url=../documents_personal.php");

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
$doc_id=$_POST['doc_id'];

$query1 = mysql_query("select file_path from document where doc_id=$doc_id");
$exist_or_not = mysql_num_rows($query1);
if ($exist_or_not == 1 )
			{
				$query=mysql_fetch_assoc($query1);
				$file_path=$query['file_path'];
				$file_path1=explode("/",$file_path);
				$count=count($file_path1);
				$filename=$file_path1[$count-1];
				
			}
unlink($filename);
$file['name']=md5($file['name']);
$file['name']=$file['name'].".".$file['ext'];


while (file_exists("files/".$file['name'])) 
{
$time=time();
$file['name'] = $time."-".$file['name'];

}

//Finally move the file to the proper place

if(move_uploaded_file($file['tmp'],$file['name'])) {
	
	$path="files/".$file['name'];
	
	
	$user_id=$_SESSION['userid'];
	$size=$file['size'];
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d h:i:s', time());
	$query = mysql_query("update document set file_path='$path', file_size='$size' ,revised_by='$user_id',
	 revision_date='$date' where doc_id=$doc_id");
	 
	 //check if its a shared doc
	 $que=mysql_fetch_assoc(mysql_query("select is_private, uploaded_by from document where doc_id=$doc_id"));
	 if($que['is_private']==0)
	 {
		$notify=mysql_query("select user_id from shared_document where doc_id=$doc_id");
		if(mysql_num_rows($notify))
		{
			$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','6' ,'$doc_id')");
			$notif_id=mysql_insert_id();
			
			//send a notif to author
			$author= $que['uploaded_by'];
			if($user_id!=$author)
			{
				$query2 = mysql_query("insert into notif_for (user_id, notif_id) values ('$author','$notif_id')");
			}
			
			while($notify1=mysql_fetch_assoc($notify))
			{
				//send a notif to others
			$notif_for=$notify1['user_id'];
			if($notif_for!=$user_id)
			$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$notif_for','$notif_id')");	
			}
		}
	 }
	 
	echo 'Your file has been updated';
	echo '<br/><a href="../documents_personal.php">Go back to Documents</a><br/>';



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







