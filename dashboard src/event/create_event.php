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
<link href="../css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
<script language="javascript">

function $$(id)
{
	return document.getElementById(id);
}
function insert(f, e, id)
{
	var scroll = $$(id).scrollTop;
	if(document.selection)
	{
		$$(id).focus();
		sel = document.selection.createRange();
		sel.text = f+sel.text+e;
	}
	else if($$(id).selectionStart || $$(id).selectionStart == '0')
	{
		var startPos = $$(id).selectionStart;
		var endPos = $$(id).selectionEnd;
		$$(id).value = $$(id).value.substring(0, startPos)+f+$$(id).value.substring(startPos, endPos)+e+$$(id).value.substring(endPos, $$(id).value.length);
		$$(id).selectionStart = startPos+f.length;
		$$(id).selectionEnd = startPos+f.length+(endPos-startPos);
	}
	else
	{
		$$(id).value += msg; 
	}
	$$(id).scrollTop = scroll;
	$$(id).focus();
}

$(document).ready(function() 
{
$("#datepicker").datepicker();
$("#datepicker2").datepicker();
});


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
                
<?php
if(isset($_POST['title']) and $_POST['start']!='' and $_POST['title']!='')
{
	include('../bbcode_function.php');
	$title = $_POST['title'];
	$message = $_POST['message'];
	$start1 = $_POST['start'];
	$start2= explode("/",$start1);
	$start= "$start2[2]-$start2[0]-$start2[1]";
	$end1 = $_POST['end'];
	$end2= explode("/", $end1);
	$end= "$end2[2]-$end2[0]-$end2[1]";
	$user_id = $_SESSION['userid'];
	date_default_timezone_set('Asia/Calcutta');
	$today = date('Y-m-d');
	$branch = $_POST['branch'];
	$year = $_POST['year'];
	$dept = $_POST['dept'];
	
	if(get_magic_quotes_gpc())
	{
		$title = stripslashes($title);
		$message = stripslashes($message);
	}
	$title = mysql_real_escape_string($title);
	$message = mysql_real_escape_string(bbcode_to_html($message));
	$query = mysql_query("insert into event (user_id, event_name, event_desc, date_created, start_date, end_date)
	 values ('$user_id', '$title', 	'$message' , '$today' , '$start' , '$end')");
	 $event_id=mysql_insert_id();
	 
	if($branch=="all")
	{
		if($year=="all" || $year=="none")
		{
			$user=mysql_query("select student_id from student where student_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
		}
		else 
		{
			$user=mysql_query("select s.student_id from student as s inner join user as u on s.student_id=u.user_id
			where s.year=$year and student_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
		}
	}
	else if($branch=="none")
	{
		if($year=="all")
		{
			$user=mysql_query("select student_id from student where student_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
			
		}
		else if($year!="none")
		{
			$user=mysql_query("select s.student_id from student as s inner join user as u on s.student_id=u.user_id
			where s.year='$year' and student_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
		}
	}
	else
	{
		$user=mysql_query("select s.student_id from student as s inner join user as u on s.student_id=u.user_id
			where s.year='$year' and s.branch='$branch' and student_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['student_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
	}
	
	if($dept=="all")
	{
		$user=mysql_query("select teacher_id from teacher where teacher_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['teacher_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
	}
	
	else if($dept!="none")
	{
		$user=mysql_query("select t.teacher_id from teacher as t inner join user as u on t.teacher_id=u.user_id
			where t.dept='$dept' and teacher_id!=$user_id" );
			while($res=mysql_fetch_assoc($user))
			{
				$stu=$res['teacher_id'];
				$invite = mysql_query("insert into event_invitee (user_id, event_id) values ($stu, $event_id)");
			}
	}
	
	
	if($query)
	{
	?>
    <div id="content">
			
				<h1 class="title">Create an Event</h1> <br />
				<p> The event has successfully been created. </p>
            	<a href="event.php">Go to back to Events</a>
			
	</div>
	
	<?php
	}
	else
	{
		?>
            <div id="content">
			
				<h1 class="title">Create an Event</h1> <br />
				<p> An error occurred while creating the event. </p>
            	<a href="event.php">Go to back to Events</a>
			
	</div>
    <?php
	}
	
}
else
{
?>
	<div id="content">
	<h1 class="title">Create an Event</h1> <br />
	<form name="myform" action="create_event.php" method="post">
	<label for="title">Name</label><br />
    <input type="text" name="title" id="title" required="required" />
    <br /><br />
    
   <label for="message">Message</label><br />
    <div>
        <input type="button" class="button_post" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" class="button_post" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" class="button_post" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Link" class="button_post" onclick="javascript:insert('[url]', '[/url]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea>
    <br /><br />
    
    <label for="start">Start Date</label><br />
    <input name="start" id="datepicker" required="required"/>
    <br /><br />
    
    <label for="end">End Date</label><br />
    <input name ="end" id="datepicker2" required="required"/>
    <br /><br />
    
    <label>Share event with</label><br /><br />
    <label>Students:</label><br />
    
    <label>Select branch</label><br />
    <select name="branch" >
    <option value="none">None</option>
	<option value="I.T.">Information Technology</option>
	<option value="Computers">Computer Science</option>
	<option value="EXTC">Electronics and Telecommunication</option>
	<option value="Electrical">Electrical Engineering</option>
	<option value="Textile">Textiles Engineering</option>
	<option value="Electronics"> Electronics Engineering</option>
	<option value="Mechanics">Mechanical Engineering</option>
    <option value="all">All Branches</option>
    </select><br />
    
    <label >Select year</label><br />
   	<select name="year">
  	<option value="none">None</option>
	<option value="F.Y.">First Year</option>
	<option value="S.Y.">Second Year</option>
	<option value="T.Y."> Third Year</option>
	<option value="B.Tech">Final Year-BTech</option>
    <option value="all">All</option>
	</select><br /><br />
    
    
	
    
    <label>Teachers:</label><br />
    <label>Select department</label><br />
    <select name="dept">
	<option value="none">None</option>
    <option value="I.T.">Information Technology</option>
	<option value="Computers">Computer Science</option>
	<option value="EXTC">Electronics and Telecommunication</option>
	<option value="Electrical">Electrical Engineering</option>
	<option value="Textile">Textiles Engineering</option>
	<option value="Electronics"> Electronics Engineering</option>
	<option value="Mechanics">Mechanical Engineering</option>
	<option value="HUMANITIES">Humanities Department</option>
	<option value="CHEMISTRY">Chemistry Department</option>
	<option value="MATH">Mathematics Department</option>
    <option value="all">All Departments</option>
	</select><br /><br />
    
    <input type="submit" class="button_post" id="create" value="Create" />
    <br /><br />
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