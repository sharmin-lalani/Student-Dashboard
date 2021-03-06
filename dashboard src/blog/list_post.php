<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];

$exist=0;

if(isset( $_GET['tag_id']))
			{
				$tag_id=$_GET['tag_id'];
				$tag1=mysql_fetch_assoc(mysql_query("select tag_name from tag where tag_id=$tag_id"));
				$tag=$tag1['tag_name'];
				$exist=1;
			}
			
else if(isset( $_GET['tag_name']))
{
	$tag=$_GET['tag_name'];
	$tag1=mysql_query("select tag_id from tag where tag_name='$tag'");
	if(mysql_num_rows($tag1))
	{
		$tag2= mysql_fetch_assoc($tag1);
		$tag_id=$tag2['tag_id'];
		$exist=1;
	}
}
else
{
				header('Location:blog.php');
				exit();
			}
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
			<li><a href="../webmail" target="_blank">Email</a></li>
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
			
      
				<h1 class="title"><?php echo $tag; ?></h1> <br />
                <?php
				if($exist)
				{
				$query = mysql_query("select p.post_id, p.title, p.user_id, u.fname as author, p.date_time as date
				from blog_tag as b inner join blog as p on b.post_id=p.post_id 
                inner join user as u on p.user_id=u.user_id  
				where b.tag_id=$tag_id 
				order by date desc");
				
				
				if(mysql_num_rows($query))
				{
				?>
                <table cellpadding="5px" style="text-align:left; font-size:15px; ">
				<tr class="row">
    			<th>Title</th>
    			<th>Author</th>
    			<th>Date</th>
                </tr>
                
                <?php
				while($res = mysql_fetch_array($query))
				{
				?>
                <tr class="row">
                <td><a href="get_post.php?post_id=<?php echo $res['post_id'];?>"><?php echo $res['title']; ?></a></td>
                <td><a href="../profile.php?user_id=<?php echo $res['user_id'];?>"><?php echo $res['author']; ?></a></td>
                <td><?php echo $res['date']; ?></td>
                </tr>
                
                <?php
				}
				?>
                </table>
                <?php
				}
				}
				else
				{
				?>
                
                 <p> There are no Posts belonging to this tag. </p>
                 <?php
				}
				?>
				<div id="button_doc" style="margin: 20px 20px;">
            	<a  href="create_post.php"> Create a Post </a>
                </div>
			
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