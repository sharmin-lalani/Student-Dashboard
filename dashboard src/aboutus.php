<?php

require_once('check_session.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>About Us</title>
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
			<li  class="current_page_item" ><a href="index.php">Home</a></li>
            <li  ><a href="profile.php?user_id=<?php echo $_SESSION['userid'];?>">Profile</a></li>
			<li ><a href="courses/course.php">Courses</a></li>
			<li ><a href="documents/documents_personal.php">Documents</a></li>
            <li ><a href="event/event.php">Events</a></li>
			<li><a href="forum/forum.php">Forums</a></li>
			<li ><a href="blog/blog.php">Blogs</a></li>
			<li><a href="webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends>


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
    <?php
include('get_sidebar.php');
?>  
    
    <div id="content">
			
      
				<h1 class="title">About Us</h1> <br />
		
    <div class="inner_content" style="width:650px;"><br/><br/>
      <!--<h2> VJTI </h2>-->
      <p style="text-align:left; line-height:1.8; text-indent:60px;">  <b style=" color:#066;font-size:26px;"> VJTI</b>, one of the oldest Engineering Institutes in Asia, has had a glorious history, in the 125 years of its existence. Over the years the Institute has produced great Engineers who have gone on to achieve great success in various fields both as technocrats and managers all over the world. The list of VJTI Alumni comprises the who-is-who in the field of Engineering and Technology.

Today VJTI is the first choice for aspiring engineers in Maharashtra and it is the cream of students who get into the portals of this great institution. The Institute produces high quality engineers, inculcating in the students, not only the comprehensive knowledge of engineering principles, but also teaching them lessons on innovation, character, leadership and values. This all round knowledge helps students successfully make their mark in their chosen field of Academics or Industry.

Besides academics the Institute encourages all round development of the students by making them conduct various activities throughout the year. One such event is Technovanza, the annual Technomanagement Event. Technovanza which was first held in the year 2001 provides a great canvas for students to apply their knowledge and exhibit their capabilities.</p>
<br/><br/>     
        </div>
        
        
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