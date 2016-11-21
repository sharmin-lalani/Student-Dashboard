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
<title>Blogs</title>
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
			<li ><a href="../forum/forum.php">Forums</a></li>
			<li class="current_page_item"><a href="blog.php">Blogs</a></li>
			<li><a href="../webmail"  target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends>


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
		
        
<!--sidebar1 starts-->
<?php
include('get_blog_sidebar.php');
?>        
<!--end sidebar1-->		
        
        <!-- content starts-->
		<div id="content">
			<?php
			if(!isset( $_GET['post_id']))
			{
				header('Location:blog.php');
				exit();
			}
			if(isset( $_GET['notif_id']))
			{
				$notif_id=$_GET['notif_id'];
				$me=$_SESSION['userid'];
				$seen=mysql_query("update notif_for set has_seen=1 where notif_id=$notif_id and user_id=$me");
			}
			$post_id=$_GET['post_id'];
			$query1 = mysql_query("select * from blog where post_id=$post_id");
			$exist_or_not = mysql_num_rows($query1);
			if ($exist_or_not == 1 )
			{
			$comment=mysql_query("select * from blog_comment where post_id=$post_id");
			$query=mysql_fetch_assoc($query1);
			$user_id=$query['user_id'];
			$tag=mysql_query("select b.tag_id, t.tag_name from blog_tag as b inner join tag as t on b.tag_id=t.tag_id
			 where b.post_id=$post_id");
			$author1=mysql_fetch_assoc(mysql_query("select fname from user where user_id=$user_id"));
			$author=$author1['fname'];
			 
			?>
      
				<h1 class="title"><?php echo $query['title']?></h1>
                <p class="byline">Posted on <?php echo $query['date_time']?> by 
                <a style="color:#008080; text-decoration:underline;" href="../profile.php?user_id=<?php echo $user_id;?>"><?php echo $author;?></a>
                <br /> 
                Tags :
                 <?php
				if(mysql_num_rows($tag))
				{
				while($tags = mysql_fetch_array($tag))
				{
				?>
                <a style="color:#008080; text-decoration:underline;" href="list_post.php?tag_id=<?php echo $tags['tag_id'];?>"><?php echo $tags['tag_name'];?></a>
         
                <?php
				}
				}
				else echo"No tags have been defined for this post";
				?>
                
                <div class="entry">
                <p>
                <?php echo $query['post'];?>
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
                <div id="button_doc" style="margin-right:200px;">
            	<a  href="add_comment.php?post_id=<?php echo $post_id;?>"> Comment </a>
                </div>
                
                <?php
			}
			else echo 'Post not found. Either the post does not exist or has been deleted.';

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