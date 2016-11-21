<?php

session_start();

// if the user is logged in, destroy the session

if (isset($_SESSION['logged_in'])) 
{

session_destroy();
header('Location: login.php');

}


?>