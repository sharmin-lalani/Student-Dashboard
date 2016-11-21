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
<h2 style="font-size: 20px; padding: 40px 0 0 15px;">Categories</h2>
<ul>

<?php
$row = mysql_query('select c.cat_name,c.category_id from category as c order by c.cat_name asc');
if(mysql_num_rows($row))
{
while($res1 = mysql_fetch_array($row))
{
?>
    	<li><a href="list_topic.php?category_id=<?php echo $res1['category_id'];?>"><?php echo $res1['cat_name']; ?></a></li>
<?php
}
}
else 
{
?>

<p> No categories have been created yet. </p>
<?php
}
?>
</ul>
</li>


<li>
<h2 style="font-size: 20px; padding: 40px 0 0 15px;">Recent Comments</h2>
<ul>

<?php
$row = mysql_query('select c.user_id, u.fname as author, c.thread_id, f.topic 
		from forum_comment as c left join user as u on c.user_id= u.user_id
		left join forum as f on f.thread_id= c.thread_id 
		order by c.comment_id desc limit 5');
if(mysql_num_rows($row))
{
while($res1 = mysql_fetch_array($row))
{
?>
    	
        <li><a href="get_topic.php?thread_id=<?php echo $res1['thread_id'];?>"><?php echo $res1['author']; ?> on <?php echo $res1['topic']; ?></a></li>
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
			
