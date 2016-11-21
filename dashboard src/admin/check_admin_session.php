<?php

require_once('../connection.php');

// is the admin logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['adminid']) ) {

// not logged in, move to login page
header('Location: admin_login.php');
exit();
}

?>
