<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
exit();
}

else $username= $_SESSION['username'];
if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name']))
{
	echo 'Could not upload file!.';
	exit();
	
}

?>
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

header("refresh: 3; url=documents_personal.php");

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
$file['name']=md5($file['name']);
$file['name']=$file['name'].".".$file['ext'];
while (file_exists("files/".$file['name'])) {
$time=time();
$file['name'] = $time."-".$file['name'];

}

//Finally move the file to the proper place

if(move_uploaded_file($file['tmp'],"files/".$file['name'])) {
	
	$path="files/".$file['name'];
	$filename=$_POST['filename'];
	$filename=filter_var($filename, FILTER_SANITIZE_STRING);
	$desc=$_POST['desc'];
	$desc=filter_var($desc, FILTER_SANITIZE_STRING);
	$user_id=$_SESSION['userid'];
	$size=$file['size'];
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d h:i:s', time());
	$query = mysql_query("insert into document (doc_name, doc_desc, is_private,file_path, file_size,uploaded_by,data_created)
	 values ('$filename', '$desc','1','$path','$size','$user_id','$date')");
	
echo 'Your File has been uploaded';
header("Location: documents_personal.php");

}

else { uploadFail($errors[6]); }

}

}

}


?>
