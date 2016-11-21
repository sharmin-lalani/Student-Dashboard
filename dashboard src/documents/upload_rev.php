<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
exit();
}

else $username= $_SESSION['username'];

if ( !isset($_GET['doc_id']))
{
	header('Location: documents_personal.php');
exit();
}
	
$doc_id=$_GET['doc_id'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Documents</title>
<link href="../css/structure.css" rel="stylesheet" type="text/css" media="screen" />
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
			<li  class="current_page_item"><a href="documents_personal.php">Documents</a></li>
            <li ><a href="../event/event.php">Events</a></li>
			<li><a href="../forum/forum.php">Forums</a></li>
			<li ><a href="../blog/blog.php">Blogs</a></li>
			<li><a href="../webmail/" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends-->

<div id="page1">
	<div id="page-bg1">
 <?php
include('get_sidebar2.php');
?>  
<!-- content starts-->
		<div id="content">
        
			<div class="post">
            
				<h1 class="title" ><a href="#">My Documents</a></h1>
				<div style="margin-bottom:10px;margin-top:10px;">
				<div id="button_current"><a href="documents_personal.php"><span>Personal Documents</span></a></div>
               <div id="button" style="float:left;margin-left:25px;">
               <a href="documents_shared.php"><span>Shared Documents</span></a></div>
             </div>
          
             <form class="box login" style="margin-top:100px; margin-left:-05px; background-color:#378484;" method="post" action="files/upload_revfile.php" enctype="multipart/form-data">
             <center><h2 style="color:#eee ">Upload Revision</h2></center>
   <table cellpadding="5px" class="boxBody">
   
   <tr><td><input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></td></tr>
   <tr><td><label for="file">Filename:</label> </td></tr>
	  <tr><td><input type="file" name="file"   required   /></td></tr>
	  
      <tr><td><input type="hidden" value=<?php echo $doc_id; ?> name="doc_id"/></td></tr>
	  
	  <tr><td><footer ><input type="submit" name="submit" class="btnLogin" value="Upload" ></footer></td></tr>
      

     
	</table>
             
                 
                    
			
</form>
             
             
             
         
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