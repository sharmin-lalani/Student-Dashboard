<?php

require_once('check_session.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>VJTI Dashboard</title>
<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<?php
include('header.html');
?>
    
<!--wrapper starts-->

<div id="wrapper">
<!--menu starts-->
	<div id="menu">
		<ul>
			<li class="current_page_item" ><a href="index.php">Home</a></li>
            <li ><a href="profile.php?user_id=<?php echo $_SESSION['userid'];?>">Profile</a></li>
			<li ><a href="courses/course.php">Courses</a></li>
			<li ><a href="documents/documents_personal.php">Documents</a></li>
            <li ><a href="event/event.php">Events</a></li>
			<li ><a href="forum/forum.php">Forums</a></li>
			<li ><a href="blog/blog.php">Blogs</a></li>
			<li><a href="webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends>


<!-- page starts-->
	<div id="page">
	<div id="page-bg">
		

        
<!--sidebar1 starts-->
        <?php 
		include "get_sidebar1.php";
		?>
<!--end sidebar1-->		
        
        
<!-- start sidebar2 -->
		<?php 
		include "get_sidebar2.php";
		?>
		
<!-- end sidebar2 -->

        <!-- content starts-->
		<div id="content" style="margin-right: 500px;">
			
      
				<h1 class="title">Welcome <?php echo $username; ?>!</h1><br />
                <h2> Notifications: </h2>
                <?php
				$query=mysql_query("select nf.notif_id, nb.user_id as creator, u.fname as name, 
				nf.has_seen , nb.notif_type_id as type , nb.object_id, n.notif_desc
				from notif_for as nf inner join notif_by as nb on nf.notif_id=nb.notif_id
				inner join user as u on nb.user_id=u.user_id
				inner join notif_type as n on n.notif_type_id=nb.notif_type_id 
				where nf.has_seen=0 and nf.user_id=$user_id order by notif_id desc");
				
				if(mysql_num_rows($query))
				{
					while($res=mysql_fetch_assoc($query))
					{
						switch($res['type'])
						{
							
							case 1: 
							?>
                            <div style="padding: 5px 0px;">
							<a  style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php  echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select title from blog where post_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['title'];
							}
							else $q2=NULL;
							?>
                            <a href="forum/get_post.php?post_id=<?php echo $object_id;?>&notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							
							case 2: 
							?>
                            <div style="padding: 5px 0px;">
							<a  style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>">
                            <?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select topic from forum where thread_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['topic'];
							}
							else $q2=NULL;
							?>
                            <a href="forum/get_topic.php?thread_id=<?php echo $res['object_id'];?>&notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							
							case 3: 
							?>
                            <div style="padding: 5px 0px;">
							<a   style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select title from blog where post_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['title'];
							}
							else $q2=NULL;
							?>
                            <a href="forum/get_post.php?post_id=<?php echo $object_id;?>&notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							
							case 4: 
							?>
                            <div style="padding: 5px 0px;">
							<a   style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select topic from forum where thread_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['topic'];
							}
							else $q2=NULL;
							?>
                            <a href="forum/get_topic.php?thread_id=<?php echo $res['object_id'];?>&notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							
							case 5: 
							?>
                            <div style="padding: 5px 0px;">
							<a  style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select doc_name from document where doc_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['doc_name'];
							}
							else $q2=NULL;
							?>
                            <a href="documents/documents_shared.php?notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							
							case 6: 
							?>
                            <div style="padding: 5px 0px;">
							<a  style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select doc_name from document where doc_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['doc_name'];
							}
							else $q2=NULL;
							?>
                            <a href="documents/documents_shared.php?notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							case 7: 
							?>
                            <div style="padding: 5px 0px;">
							<a  style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select course_name from course where course_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['course_name'];
							}
							else $q2=NULL;
							?>
                            <a  href="courses/get_course.php?course_id=<?php echo $object_id;?>&notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
							
							
							case 8: 
							?>
                            <div style="padding: 5px 0px;">
							<a  style="color:#008080; text-decoration:underline;" href="profile.php?user_id=<?php echo $res['creator'];?>"><?php echo $res['name'];?></a>
                            <?php 
							$object_id=$res['object_id'];
							$q=mysql_query("select topic from assignment where assign_id=$object_id");
							if(mysql_num_rows($q))
							{
								$q1=mysql_fetch_assoc($q);
								$q2=$q1['topic'];
							}
							else $q2=NULL;
							?>
                            <a href="courses/check_result.php?assign_id=<?php echo $object_id;?>&notif_id=<?php echo $res['notif_id'];?>">
                            
                            <?php echo ' '.$res['notif_desc'].' : '.$q2.'.';?></a></div>
                            <?php
                            break;
						}
					}
				}
				else
				{
				?>
                
				<p> There are no Notifications to display right now. </p>
                
                <?php
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
include('footer.html');
?>

</body>
</html>
