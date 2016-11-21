<?php

require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
}

else $username= $_SESSION['username'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Personal Documents</title>

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
            
				<h1 class="title" >My Documents</h1>
				<div style="margin-bottom:10px;margin-top:10px;">
				<div id="button_current"><a href="#"><span>Personal Documents</span></a></div>
                				<div id="button" style="float:left;margin-left:25px;"><a href="documents_shared.php"><span>Shared Documents</span></a></div>
                                </div>
                                
                <div id="doc">
					<strong>Personal Documents:</strong>
			   </div>
                                
         <?php
		 $user_id=$_SESSION['userid'];
		 $query=mysql_query("select doc_id,doc_name,doc_desc, file_path, file_size, data_created, revision_date
		 from document
		 where uploaded_by = $user_id and is_private=1
		 order by data_created desc");
		
		$exist_or_not = mysql_num_rows($query);
	
		
		 if($exist_or_not>=1)
		  {
			 
				while($res = mysql_fetch_assoc($query))
				{
				?>
		
		<div id="documents">
        <div id="eachcomment" style="text-align:left">       
        <p> <a href="<?php echo $res['file_path'];?>" target="_blank" style=" font-size:16px;"><?php echo $res['doc_name'];?></a>
        :<br />  
        <small > Added on 
		<?php 
		echo $res['data_created'];  ?></small></p>
        <p><b style="color:#004040;"> Description:</b><br />
        <?php echo $res['doc_desc']; ?>
        <div style="margin-bottom:10px; margin-top:10px;" align="center">
		<div id="button_doc"><a href="<?php echo $res['file_path'];?>"  target="_blank"style=" font-size:16px;"><span>Download</span></a></div>
                <div id="button_doc" style="float:left"><a href="upload_rev.php?doc_id=<?php echo $res['doc_id'];?>"><span>Upload Revision</span></a></div>
                <div id="button_doc"><a href="share.php?doc_id=<?php echo $res['doc_id'];?>"style=" font-size:16px;"><span>Share</span></a></div>
                                </div><br />
        </div>
        <!--end eachcomment-->
        <?php }}
		else {?>
        <div id="eachcomment" style=" height:200px; text-align:left"> 
        <p>
        There are no Personal documents!
        </p>
        </div>
        <?php }?>
        
        </div>
        <!--end document-->
        <div id="button_current" style=" margin-left:200px;	width:180px; float:left"><a href="upload_doc.php">Upload a new Document</a></div>
        
        </div>
			</div>
				</div>
		
<!-- end content -->
		
    <div style="clear: both;"></div>
	</div>
    </div>
	<!-- end page -->
</div>
<!--end wrapper-->
</div>
</div>
</div>
<?php
include('../footer.html');
?>


</body>
</html>


