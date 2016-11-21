<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">

<title>Manage Threads</title>
<style>
th, td
{
	padding:5px 10px;
}

</style>

</head>

<body>
<?php
include('../header.html');
?>
<a style="color:#fff; padding:10px 0px 10px 150px; font-size:20px; text-decoration:underline;" href="threads.php">Go back to threads </a>
<div class="box" style="width:900px; margin-bottom:400px; padding:40px;">
   <br />

     
     <?php
			if(!isset( $_GET['thread_id']))
			{
				header('Location:admin.php');
				exit();
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
      			 <center><h2 class="title" style="color:#066;"><?php echo $query['topic']?></h2></center>
				
                <p class="byline">Posted on <?php echo $query['date_time']?> by 
                <a href="../profile.php?user_id=<?php echo $user_id;?>"><?php echo $author;?></a>
                <br /> Category : <?php echo $category; ?> </p>
                
                <div class="entry">
                <p>
                <?php echo $query['content'];?>
                </p>
                </div>
             
                 <!-- start comments-->
                 <br />
				<h1 style="text-align:left;"> Comments: </h1>
                <br />
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
					echo 'No comments have been posted yet.';
				}
				
				?>
                <br />
                
                <?php
			}
			else echo 'Thread not found.';

				?>
  
   
</div>
</div>


<?php
include('../footer.html');
?>
</body>
</html>