<?php

require_once('check_session.php');

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Contact Us</title>
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
			
      
				<h1 class="title">Contact Us</h1> <br />
                <div class="inner_content">
    <br/><br/>
      <!-- 1st div -->
    <div id="textinfo" width="960" height="200" align="center">
          <p style="text-align: center"> 
          <div id="textinfo" width="900" height="200" style=" ">
	  <p style=" color:#066; font-style:italic; font-size:18px; text-align:center;">
             Dr. O.G.Kakde<br/>
             Director,<br/>
             VJTI, Mumbai<br/>
             
          </p>
      </div>
	  <br/>
      <!-- 2nd div.1 -->
      
      <div id="textinfo" width="400" height="200" style="float:left;   margin-left:20px;">
	  <p style="float:left; color:#066; font-style:italic; font-size:16px; margin-left:50px">
	  Ms. Nidhi Shah<br/>
	  Web Co-ordinator<br/>
	  VJTI,Mumbai<br/>
	  
	  </p>
	  </div>
      <!-- 2nd div.2 -->
      <div id="textinfo" width="570" height="200" style="float:left;   margin-left:300px;">
	  <p style="float:left; color:#066; font-style:italic; font-size:16px; margin-right:10px">
	  Ms. Sharmin Lalani <br/>
	  Web Co-ordinator,<br/>
	  VJTI, Mumbai<br/>
	  
	  </p>
	  </div>
      </div>
      <br /><br /><br /><br />
      <center>
      <p style="color:#066; margin-left:50px;margin-top:55px; ">
      For any queries please contact site Admin at <u>vjtidashboard@gmail.com</u>
		</p></center>
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