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
<title>Events</title>
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
			<li ><a href="../documents/documents_personal.php">Documents</a></li>
            <li class="current_page_item"><a href="event.php">Events</a></li>
			<li ><a href="../forum/forum.php">Forums</a></li>
			<li ><a href="../blog/blog.php">Blogs</a></li>
			<li><a href="../webmail" target="_blank">Email</a></li>
		</ul>
        
	</div>
<!--menu ends>


<!-- page starts-->
	<div id="page1">
	<div id="page-bg1">
		 <?php
include('get_sidebar2.php');
?>  
        
<!--sidebar1 starts-->
     
<!--end sidebar1-->		
        
        <!-- content starts-->
		<div id="content">
			
      
				<h1 class="title">Recent Events</h1> <br />
                <h2>Events created by you</h2>
                <?php
				$user_id = $_SESSION['userid'];
				$today = date('Y-m-d');
				$query = mysql_query("select * from event where user_id= $user_id and end_date >= $today 
				order by start_date desc, end_date desc");
				
				
			
				if(mysql_num_rows($query))
				{
				?>
                
                
                <?php
				while($res = mysql_fetch_assoc($query))
				{
				?>
                <table style="text-align:left; font-size:15px; margin-bottom:20px;" >
                <tr class="row">
                <td><b> Event Name :</b> </td>
                <td> <?php echo $res['event_name']; ?> </td>
                </tr>
                
                <tr class="row">
                <td> <b>Event Description :</b> </td>
                <td> <?php echo $res['event_desc']; ?> </td>
                </tr>
                
                <tr class="row">
                <td><b> Start Date :</b> </td>
                <td> <?php echo $res['start_date']; ?> </td>
                </tr>
                
                <tr class="row">
                <td><b> End Date : </b></td>
                <td> <?php echo $res['end_date']; ?> </td>
                </tr>
                </table>
                
                <?php
				}
				?>
                
                <?php
				}
				else
				{
				?>
                
                 <p> There are no Events to display right now. </p>
                 <?php
				}
				?>
                
                <br /><br />
                <h2>Events shared with you</h2> 
                 <?php
				$query = mysql_query("select e.event_name, e.user_id as creator, e.event_desc, e.date_created, e.start_date, 
				e.end_date, ei.user_id from event as e inner join event_invitee as ei on e.event_id=ei.event_id 
				where ei.user_id= $user_id and end_date >= $today order by start_date desc, end_date desc");
				
				
				if(mysql_num_rows($query))
				{
				?>
                
                
                <?php
				while($res = mysql_fetch_assoc($query))
				{
				?>
                <table style="text-align:left; font-size:15px; margin-bottom:20px;">
                <tr class="row">
                <td> Event Name : </td>
                <td> <?php echo $res['event_name']; ?> </td>
                </tr>
                
                <tr class="row">
                <td> Created by : </td>
                <td> <?php echo $res['creator']; ?> </td>
                </tr>
                
                <tr class="row">
                <td> Event Description : </td>
                <td> <?php echo $res['event_desc']; ?> </td>
                </tr>
                
                <tr class="row">
                <td> Start Date : </td>
                <td> <?php echo $res['start_date']; ?> </td>
                </tr>
                
                <tr class="row">
                <td> End Date : </td>
                <td> <?php echo $res['end_date']; ?> </td>
                </tr>
                </table>
                
                <?php
				}
				?>
               
                <?php
				}
				else
				{
				?>
                
                 <p> There are no Events to display right now. </p>
                 <?php
				}
				?>
				<div id="button_doc" style="margin: 20px 20px;">
            	<a  href="create_event.php"> Create an Event </a>
                </div>
			
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