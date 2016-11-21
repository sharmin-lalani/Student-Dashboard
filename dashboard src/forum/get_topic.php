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
		<div id="content">
			<?php
			if(!isset( $_GET['thread_id']))
			{
				header('Location:forum.php');
				exit();
			}
			if(isset( $_GET['notif_id']))
			{
				$notif_id=$_GET['notif_id'];
				$me=$_SESSION['userid'];
				$seen=mysql_query("update notif_for set has_seen=1 where notif_id=$notif_id and user_id=$me");
			}
			$thread_id=$_GET['thread_id'];
			$query1 = mysql_query("select * from forum where thread_id=$thread_id");
			$exist_or_not = mysql_num_rows($query1);
			if ($exist_or_not == 1 )
			{
			$comment=mysql_query("select * from forum_comment where thread_id=$thread_id");
			$query=mysql_fetch_assoc($query1);
			$user_id=$query['user_id'];
			$category_id=$query['category_id'];
			$author1=mysql_fetch_assoc(mysql_query("select fname from user where user_id=$user_id"));
			$author=$author1['fname'];
			$category1=mysql_fetch_assoc(mysql_query("select cat_name from category where category_id=$category_id"));
			$category=$category1['cat_name'];
			 
			?>
      
				<h1 class="title"><?php echo $query['topic']?></h1>
                <p class="byline">Posted on <?php echo $query['date_time']?> by 
                <a style="color:#008080; text-decoration:underline;" href="../profile.php?user_id=<?php echo $user_id;?>"><?php echo $author;?></a>
                <br /> Category : <a style="color:#008080; text-decoration:underline;" href="list_topic.php?category_id=<?php echo $category_id;?>"><?php echo $category; ?></a> </p>
                
                <div class="entry">
                <p>
                <?php echo $query['content'];?>
                </p>
                </div>
             
                 <!-- start comments-->
                 <br />
				<h1 style="text-align:left;"> Comments: </h1>
                
                <div id="comments">
                <?php
				if(mysql_num_rows($comment))
				{
				while($com = mysql_fetch_array($comment))
				{
					$commenter_id=$com['user_id'];
					$commenter=mysql_fetch_assoc(mysql_query("select fname from user where user_id=$commenter_id"));
				?>
                
                <div id="eachcomment">
                <p> <a href="../profile.php?user_id=<?php echo $commenter_id;?>"><?php echo $commenter['fname'];?></a>:
                <?php echo $com['content'];?>
                <br />
                <small> Posted on <?php echo $com['date_time']; ?> </small>
                </p> 
                </div>
                
                
                <?php 
				}
				
				}
				else
				{
					echo '<br />';
					echo 'No comments have been posted yet.';
					echo '<br />';
				}
				
				?>
                <br />
                </div>
        
                 <!-- end comments-->
                <div id="button_doc" style="margin-right:200px; padding:3px 12px;">
            	<a  href="add_comment.php?thread_id=<?php echo $thread_id;?>"> Reply </a>
                </div>
                
                <?php
			}
			else echo 'Thread not found. Either the thread does not exist or has been deleted.';

				?>
                
                
       <a onclick="javascript:history.go(-1);" style="float:right; text-decoration:underline; color:#066; cursor:pointer;" ><b>Go Back</b> </a>   
			
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