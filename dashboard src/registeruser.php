<? ob_start(); ?>
<?php
include("connection.php");
if(!isset($_SESSION['userid']))
{header("Location:signup.php");
exit();}

$errors = '';
$user_id=$_SESSION['userid'];
$email=$_SESSION['email'];
$prof=$_SESSION['profession'];
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$password1=$_REQUEST['password'];
$password=md5($password1);
$mobile=$_REQUEST['mobileno'];
$gender=$_REQUEST['gender'];
$random = rand();
$date = date("Y-m-d");

$fname=filter_var($fname, FILTER_SANITIZE_STRING);
$lname=filter_var($lname, FILTER_SANITIZE_STRING);

/*if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || ($_REQUEST['captcha']) != $_SESSION['captcha']) {
        $captcha_message = "Invalid captcha";
        $style = "background-color: #FF606C";
    } 
}
if(!(empty($captcha_message)))
{
header("Location: register.php?name=".$b."&username=".$a."&email=".$c."&college=".$d."&course=".$f."&mobileno=".$g."&city=".$h."&gender=".$i."&error=".$error."&error1=".$error1."&captcha=".$captcha_message);

}*/
if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The captcha code does not match!";
	}
	if(empty($errors))
	{

$query="INSERT INTO user (fname, lname, gender, email, password, mobile, user_id, profession, verified) VALUES ('$fname', '$lname', '$gender', '$email', '$password', '$mobile','$user_id', '$prof', 0)";
$ins=mysql_query($query) or die("Query failed" . mysql_error() );

$query="INSERT INTO activation (user_id, random) VALUES ('$user_id', '$random')";
$ins=mysql_query($query) or die("Query failed" . mysql_error() );

if($prof=="s")
{
	
	$year=$_REQUEST['year'];
$branch=$_REQUEST['branch'];
	$query="INSERT INTO student (student_id, branch, year) VALUES ('$user_id', '$branch', '$year')";
$ins=mysql_query($query) or die("Query failed" . mysql_error() );
}
else
{
	if(!(empty($captcha_message)))
{
header("Location: register_teacher.php?captcha=".$captcha_message);

}
	$dept=$_REQUEST['dept'];
	$post=$_REQUEST['post'];
	$qual=$_REQUEST['qual'];
$qual=filter_var($qual, FILTER_SANITIZE_STRING);
	
	$query="INSERT INTO teacher (teacher_id, dept, post, qualification) VALUES ('$user_id', '$dept', '$post','$qual')";
$ins=mysql_query($query) or die("Query failed" . mysql_error() );

}

$url = "localhost/cs/dashboard/activate.php?act=$random&user_id=$user_id";
$cont = "click this link $url To activate your account.\n Your password:$password1";

mail($email, "Activate Account!", $cont);
header("Location:register_success.php");
	}
	else
	{
		if($prof=="s")
		{
		 header("Location:register.php?captcha=1");
		}
		else
		header("Location:register_teacher.php?captcha=1");
		
	}
?>


