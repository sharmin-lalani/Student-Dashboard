<?php
require_once('../connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: ../login.php');
exit();

}

//get the q parameter from URL
$q=$_GET["q"];
$hint="";


$a1=mysql_query("select tag_name from tag order by frequency desc");

if(mysql_num_rows($a1))
{
if (strlen($q) > 0)
  {
  $q2=explode(",", $q);
  $len=count($q2);
  $last=$len-1;
  $q=$q2[$last];
   while($res=mysql_fetch_assoc($a1))
    {
    if (strtolower($q)==strtolower(substr($res['tag_name'],0,strlen($q))))
      {
      if ($hint=="")
        $hint=$res['tag_name'];
        
      else
        $hint=$hint.",".$res['tag_name'];
      }
    }
  }

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
  {
  ;
  }
else
  {
  $response=$hint;
  echo $response;
  }
}
else
;
//output the response


?>