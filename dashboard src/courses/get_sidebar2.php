<div id="sidebar1" class="sidebar">
			<ul>
            
            <li>
					<form id="searchform" method="get" action="../profile.php">
						<div>
							<h3>Search User By ID</h3>
							<input type="text" name="user_id" id="s" pattern= "[0-9]*" maxlength= "10" size="10" value="" />
						</div>
					</form>
				</li>
            
             <li>
					<h2>Things To Do</h2>
					<ul>
						<li><a href="../event/create_event.php">Create an Event</a></li>
                        <li><a href="../event/event.php">View Events</a></li>
                        <li><a href="course.php">View Assignments</a></li>
						<li><a href="course.php">View Results</a></li>
						<li><a href="../documents/upload_doc.php">Upload a Document</a></li>
                        <li><a href="../blog/create_post.php">Write a Blog Post</a></li>
                        <li><a href="../forum/create_thread.php">Start a Discussion</a></li>
						
				   </ul>
			   </li>
    
                
              <li>
					<h2>Upcoming Deadlines</h2><br />
                     <?php
				$user_id = $_SESSION['userid'];
				date_default_timezone_set('Asia/Calcutta');
				$today = date('Y-m-d');
				$query = mysql_query("select * from event where user_id= $user_id and end_date >= '$today' order by start_date desc, end_date desc");

				while($res = mysql_fetch_assoc($query))
				{
				?>
                <div style="line-height:1.5; padding-left:12px; line-height:1.8">
               <b><?php echo $res['event_name']; ?></b> <br />
                From : <?php echo $res['start_date']; ?><br />
                To : <?php echo $res['end_date'];?><br /><br />
                </div>
                <?php
				}
				
				$query1 = mysql_query("select e.event_name, e.start_date, e.end_date, ei.user_id from event as e inner join
				event_invitee as ei on e.event_id=ei.event_id 
				where ei.user_id= $user_id and end_date >= '$today' order by start_date desc, end_date desc");
				
				while($res = mysql_fetch_assoc($query))
				{
				?>
                <div style="line-height:1.5; padding-left:12px; line-height:1.8">
               <b><?php echo $res['event_name']; ?></b> <br />
                From : <?php echo $res['start_date']; ?><br />
                To : <?php echo $res['end_date'];?><br /><br />
                </div>
                <?php
				}
				
				$query2 = mysql_query("select a.topic, a.deadline, c.course_name from assignment as a inner join course as c on a.course_id=c.course_id inner join student as s on s.branch=c.branch and s.year=c.year 
				
				where s.student_id=$user_id and
				 a.deadline >= '$today' order by a.deadline asc");
				
				while($res = mysql_fetch_assoc($query2))
				{
				?>
                <div style="line-height:1.5; padding-left:12px; line-height:1.8;">
               <b>Assignment : <?php echo $res['topic']; ?></b> <br />
                Course : <?php echo $res['course_name']; ?><br />
               Deadline :<?php echo $res['deadline'];?><br /><br />
                </div>
                <?php
				}
				
				if(!(mysql_num_rows($query) || mysql_num_rows($query1) || mysql_num_rows($query2)))
					
                echo "There are no upcoming deadlines";
				?>
					
				</li>
               
               
			</ul>
		</div>