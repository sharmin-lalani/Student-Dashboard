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
			
      
				<h1 class="title">Recent Discussions</h1> <br />
                <?php
				$query = mysql_query('select t.thread_id, t.topic, t.user_id, u.fname as author, t.date_time as date, 
				(select count(*) from forum_comment as fc where fc.thread_id=t.thread_id) as replies,
				c.cat_name as category ,c.category_id
				from forum as t inner join user as u on t.user_id=u.user_id 
				inner join  category as c on t.category_id=c.category_id 
				order by date desc');
				
				
			
				if(mysql_num_rows($query))
				{
				?>
                
                <table cellpadding="5px" style="text-align:left; font-size:15px;">
				<tr class="row">
    			<th>Topic</th>
    			<th>Author</th>
    			<th>Date</th>
                <th>Replies</th>
                <th>Category</th>
                </tr>
                
                <?php
				while($res = mysql_fetch_assoc($query))
				{
				?>
                <tr class="row">
                <td><a href="get_topic.php?thread_id=<?php echo $res['thread_id'];?>"><?php echo $res['topic']; ?></a></td>
                <td><a href="../profile.php?user_id=<?php echo $res['user_id'];?>"><?php echo $res['author']; ?></a></td>
                <td><?php echo $res['date']; ?></td>
                <td><?php echo $res['replies']; ?></td>
                <td><a href="list_topic.php?category_id=<?php echo $res['category_id'];?>"><?php echo $res['category']; ?></a></td>
                </tr>
                
                <?php
				}
				?>
                </table>
                <?php
				}
				else
				{
				?>
                
                 <p> There are no Discussions to display right now. </p>
                 <?php
				}
				?>
				<div id="button_doc" style="margin: 20px 20px;">
            	<a  href="create_thread.php"> Start a Discussion </a>
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