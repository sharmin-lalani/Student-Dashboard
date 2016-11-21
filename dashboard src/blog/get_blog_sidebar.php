<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];
?>

<div id="sidebar1" class="sidebar">


<ul>
<li>
<h2 style="font-size: 20px; padding: 40px 0 0 15px;">Popular Tags</h2>
<ul>

<?php
$row = mysql_query('select * from tag order by frequency desc limit 5');
if(mysql_num_rows($row))
{
while($res1 = mysql_fetch_array($row))
{
?>
    	<li><a href="list_post.php?tag_id=<?php echo $res1['tag_id'];?>"><?php echo $res1['tag_name']; ?></a></li>
<?php
}
}
else 
{
?>

<p> No Tags have been created yet. </p>
<?php
}
?>
</ul>
</li>

 <li>
					<form id="searchform" method="get" action="list_post.php">
						<div>
							<h3>Search Posts by Tag</h3>
							<input type="text" name="tag_name" id="s" size="10" value="" />
						</div>
					</form>
</li>

<li>
<h2 style="font-size: 20px; padding: 40px 0 0 15px;">Recent Comments</h2>
<ul>

<?php
$row = mysql_query("select c.user_id, u.fname as author, c.post_id, p.title 
		from blog_comment as c left join user as u on c.user_id= u.user_id
		left join blog as p on p.post_id= c.post_id 
		order by c.comment_id desc limit 5");
if(mysql_num_rows($row))
{
while($res1 = mysql_fetch_array($row))
{
?>
    	
        <li><a href="get_post.php?post_id=<?php echo $res1['post_id'];?>"><?php echo $res1['author']; ?> on <?php echo $res1['title']; ?></a></li>
<?php
}
}
else 
{
?>

<p> No comments have been posted yet.</p>
<?php
}
?>
</ul>
</li>

</li>
</ul>
</div>
			
