<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];
$thread_id = $_REQUEST['thread_id'];

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
if(isset($_POST['message']) and $_POST['message']!='')
{
	include('../bbcode_function.php');
	$message = $_POST['message'];
	$thread_id = $_POST['thread_id'];
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	$message = mysql_real_escape_string(bbcode_to_html($message));
	$user_id= $_SESSION['userid'];
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d h:i:s', time());
	
	$query = mysql_query("insert into forum_comment (user_id, thread_id, content, date_time) 
		values ('$user_id','$thread_id' ,'$message' ,'$date')");
		
		//send a notif to the author of the thread
	$query3= mysql_fetch_assoc(mysql_query("select user_id from forum where thread_id=$thread_id"));
	$author_id = $query3['user_id'];
	if($author_id!=$user_id)
	{
	$query1 = mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
		values ('$user_id','2' ,'$thread_id')");
	$notif_id=mysql_insert_id();
	
	$query2 = mysql_query("insert into notif_for (user_id, notif_id) 
		values ('$author_id','$notif_id')");
	}
		
		//send a notif to everyone who commented on this thread
	$query4= mysql_query("select user_id from forum_comment where thread_id=$thread_id and user_id!=$user_id and user_id!=$author_id");
	if(mysql_num_rows($query4))
	{
		$add=mysql_query("insert into notif_by (user_id, notif_type_id, object_id) 
			values ('$user_id','4' ,'$thread_id')");
			$notif2_id=mysql_insert_id();
		
		while($res=mysql_fetch_assoc($query4))
		{
			$com_id=$res['user_id'];
			$add=mysql_query("insert into notif_for (user_id, notif_id) 
			values ('$com_id', '$notif2_id')");	
		}
	}
	
	if($query)
	{
	?>
    <div id="content">
			
				<h1 class="title">Post a Comment</h1> <br />
				<p> The comment has successfully been posted. </p>
            	<a href="get_topic.php?thread_id=<?php echo $thread_id;?>">Go back to the Discussion</a>
			
	</div>
	
	<?php
	}
	else
	{
		?>
            <div id="content">
			
				<h1 class="title">Post a Comment</h1> <br />
				<p> An error occurred while posting the comment. </p>
            	<a href="get_topic.php?thread_id=<?php echo $thread_id;?>">Go back to the Discussion</a>
			
	</div>
    <?php
	}
}
else
{
?>
	<div id="content">
	<h1 class="title">Post a Comment</h1> <br />
	<form action="add_comment.php" method="post">
	
     <label for="message">Content</label><br />
    <div>
        <input type="button" class="button_post" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" class="button_post" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" class="button_post" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Link" class="button_post" onclick="javascript:insert('[url]', '[/url]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input type="hidden" name="thread_id" value="<?php echo $_REQUEST['thread_id'];?>" />
    <input type="submit" class="button_post" value="Send" />

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