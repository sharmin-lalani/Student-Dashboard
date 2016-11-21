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
<script type="text/javascript" src="../js/functions.js"></script>
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />

<script language="javascript">
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your Browser Sucks!");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var searchReq = getXmlHttpRequestObject();

//Called from keyup on the search textbox.
//Starts the AJAX request.
function showHint(str) {
	if (str.length==0)
  	return;
  
	
	if (searchReq.readyState == 4 || searchReq.readyState == 0) {
		searchReq.open("GET","get_hint.php?q="+str,true);
		searchReq.onreadystatechange = handleSearchSuggest; 
		searchReq.send(null);
	}		
}

//Called when the AJAX response is returned.
function handleSearchSuggest() {
	if (searchReq.readyState == 4) {
	    var ss = document.getElementById('layer2');
		var str1 = document.getElementById('tags');
		var curLeft=0;
		if (str1.offsetParent){
		    while (str1.offsetParent){
			curLeft += str1.offsetLeft;
			str1 = str1.offsetParent;
		    }
		}
		var str2 = document.getElementById('tags');
		var curTop=20;
		if (str2.offsetParent){
		    while (str2.offsetParent){
			curTop += str2.offsetTop;
			str2 = str2.offsetParent;
		    }
		}
		var str =searchReq.responseText.split(",");
		if(str.length==0 || (str.length==1 && str[0]==""))
		    document.getElementById('layer2').style.visibility = "hidden";
		else
		    ss.setAttribute('style','position:absolute;top:'+curTop+';left:'+curLeft+';width:325px;z-index:1;padding:5px;border: 1px solid #000000; overflow:auto; height:105; color:#000; background-color:#F5F5FF;');
		ss.innerHTML = '';
		for(i=0; i < str.length; i++) {
			//Build our element string.  This is cleaner using the DOM, but
			//IE doesn't support dynamically added attributes.
			var suggest = '<div onmouseover="javascript:suggestOver(this);" ';
			suggest += 'onmouseout="javascript:suggestOut(this);" ';
			suggest += 'onclick="javascript:setSearch(this.innerHTML);" ';
			suggest += 'class="small">' + str[i] + '</div>';
			ss.innerHTML += suggest;
		}
	}
}

//Mouse over function
function suggestOut(div_value) {
	div_value.style.backgroundColor = '#F5F5FF';
	div_value.style.color = '#000;';
}
//Mouse out function
function suggestOver(div_value) {
	div_value.style.backgroundColor = '#ddd';
	div_value.style.color = '#066';
	div_value.style.cursor= 'pointer';
}
//Click function
function setSearch(value) {
	var tag=document.getElementById('tags');
	var val= tag.value;
	var newval="";
	var str =val.split(",");
	var index=str.length-1;
	var last=str[index];
	for(i=0; i < index; i++)
	{
		newval+=str[i];
		newval+=',';
	}
		
	tag.value = newval + value;
	document.getElementById('layer2').innerHTML = '';
	document.getElementById('layer2').style.visibility = "hidden";
}
</script>

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
                
<?php
if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
	include('../bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	$tags = $_POST['tags'];
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysql_real_escape_string($title);
	$message = mysql_real_escape_string(bbcode_to_html($message));
	$user_id= $_SESSION['userid'];
	date_default_timezone_set('Asia/Calcutta');
	$date = date('Y-m-d h:i:s', time());
	$query = mysql_query("insert into blog (user_id, title, post, date_time) values ('$user_id', '$title', '$message' , '$date')");
	$tag= explode(",", $tags);
	$len=count($tag);
	$post_id=mysql_insert_id();
	
	if($_POST['tags']!='')
	{
	for ($i=0; $i<$len; $i++)
	{
	$t=$tag[$i];
	$q=mysql_query("select * from tag where tag_name='$t'");
	if(mysql_num_rows($q))
	{
		$q2=mysql_fetch_assoc($q);
		$q3=$q2['tag_id'];
		$q4=$q2['frequency'];
		$q4=$q4+1;
		$query1 = mysql_query("insert into blog_tag (post_id, tag_id) values ('$post_id', '$q3')");
		$query2 = mysql_query("update tag set frequency=$q4 where tag_id=$q3");
	}
	else
	{
		$query1 = mysql_query("insert into tag (tag_name) values ('$t')");
		$tag_id=mysql_insert_id();
		$query2 = mysql_query("insert into blog_tag (post_id, tag_id) values ('$post_id', '$tag_id')");
	}
	}
	}
	
	if($query)
	{
	?>
    <div id="content">
			
				<h1 class="title">Create a Post</h1> <br />
				<p> The post has successfully been created. </p>
            	<a href="blog.php">Go to Blogs</a>
			
	</div>
	
	<?php
	}
	else
	{
		?>
            <div id="content">
			
				<h1 class="title">Create a Post</h1> <br />
				<p> An error occurred while creating the post. </p>
            	<a href="blog.php">Go to Blogs</a>
			
	</div>
    <?php
	}
}
else
{
?>
	<div id="content">
	<h1 class="title">Create a Post</h1> <br />
	<form action="create_post.php" method="post">
	<label for="title">Title</label><br />
    <input type="text" size="50" name="title" id="title"  />
    <br /><br />
    
    <label for="tags">Tags (Enter tags separated by commas, don't leave any whitespace)</label><br />
    <input type="text" size="50" name="tags" id="tags" autocomplete = "off" onkeyup="showHint(this.value)">
    <div id="layer2"></div>
    <br />
    
    <label for="message">Content</label><br />
    <div>
        <input type="button" class="button_post" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" class="button_post" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" class="button_post" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Link" class="button_post" onclick="javascript:insert('[url]', '[/url]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="20"></textarea><br />
    <input type="submit" class="button_post" value="Create" />
	</form>

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