<?php

require_once('connection.php');

// is the one accessing this page logged in?
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {

// not logged in, move to login page
header('Location: login.php');
}

else $username= $_SESSION['username'];

?>
