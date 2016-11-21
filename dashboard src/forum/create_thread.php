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
<title>Forums</title>
<script type="text/javascript" src="../js/functions.js"></script>
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
			<li ><a href="../courses/course.php">Courses</a></li>
			<li ><a href="../documents/documents_personal.php">Documents</a></li>
            <li ><a href="../event/event.php">Events</a></li>
			<li class="current_page_item"><a href="forum.php">Forums</a></li>
			<li ><a href="../blog/blog.php">Blogs</a></li>
			<li><a href="../webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends>


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
		
        
<!--sidebar1 starts-->
<?php
include('get_forum_sidebar.php');
?>        
<!--end sidebar1-->		
        
<!-- content starts-->
                
<?php
if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
	include('../bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	$cat_id = $_POST['cat_id'];
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysql_real_escape_string($title);
	$message = mysql_real_escape_string(bbcode_to_html($message));
	$user_id= $_SESSION['userid'];
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d h:i:s', time());
	$query = mysql_query("insert into forum (category_id, user_id, topic, content, date_time) values ( '$cat_id', '$user_id', '$title', 	'$message' , '$date')");
	
	if($query)
	{
	?>
    <div id="content">
			
				<h1 class="title">Start a Discussion</h1> <br />
				<p> The thread has successfully been created. </p>
            	<a href="forum.php">Go to the forum</a>
			
	</div>
	
	<?php
	}
	else
	{
		?>
            <div id="content">
			
				<h1 class="title">Start a Discussion</h1> <br />
				<p> An error occurred while creating the thread. </p>
            	<a href="forum.php">Go to the forum</a>
			
	</div>
    <?php
	}
}
else
{
?>
	<div id="content">
	<h1 class="title">Start a Discussion</h1> <br />
	<form action="create_thread.php" method="post">
	<label for="title">Title</label><br />
    <input type="text" name="title" id="title"  />
    <br /><br />
    
    <label for="cat_id">Category</label><br />
    <select name="cat_id">
    <?php
	$row = mysql_query('select c.category_id, c.cat_name from category as c order by c.category_id desc');
	while($res1 = mysql_fetch_array($row))
	{
	?>
    	<option value="<?php echo $res1['category_id']; ?>"><?php echo $res1['cat_name']; ?></option>
	<?php
	}
	?>
 	 </select>
    <br /><br />
    
    <label for="message">Content</label><br />
    <div>
        <input type="button" class="button_post" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" class="button_post" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" class="button_post" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Link" class="button_post" onclick="javascript:insert('[url]', '[/url]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input type="submit" class="button_post" value="Create" />
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