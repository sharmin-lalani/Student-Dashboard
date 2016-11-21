<div id="sidebar1" class="sidebar">
		<ul>
		<li>
					<h2>Recent Posts</h2>
					<ul>
                    <?php
$row = mysql_query('select post_id, title from blog order by date_time desc limit 5');
if(mysql_num_rows($row))
{
while($res1 = mysql_fetch_array($row))
{
?>
    	
        <li><a href="blog/get_post.php?post_id=<?php echo $res1['post_id'];?>"> <?php echo $res1['title']; ?></a></li>
<?php
}
}
else 
{
?>

<li> No Posts have been created yet.</li>
<?php
}
?>
                    
     </ul>
     </li>
				
                
<li>
<h2 style="font-size: 20px; padding: 40px 0 0 15px;">Recent Discussions</h2>
<ul>

<?php
$row = mysql_query('select thread_id, topic from forum order by date_time desc limit 5');
if(mysql_num_rows($row))
{
while($res1 = mysql_fetch_array($row))
{
?>
    	
        <li><a href="forum/get_topic.php?thread_id=<?php echo $res1['thread_id'];?>"> <?php echo $res1['topic']; ?></a></li>
<?php
}
}
else 
{
?>

<li> No Discussions have been started yet.</li>
<?php
}
?>
</ul>
</li>

</li>
</ul>
</div>
                
                
                
                