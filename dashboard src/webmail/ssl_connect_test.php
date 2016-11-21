<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	/* ----------------------------- */

	$host = 'ssl://imap.gmail.com';
	$port = 993;
	$timeout = 5;
	
    $errno = 0;
    $errstr = '';
    
    /* ----------------------------- */
    
    echo 'connect to '.$host.':'.$port.' - ';
    if (fsockopen($host, $port, $errno, $errstr, $timeout))
    {
    	echo 'Ok';
     	if (strlen($errstr) > 0)
    	{
        	echo ' - '.$errstr;
    	}
    }
    else 
    {
        if (strlen($errstr) < 1)
    	{
        	$errstr = 'Unknown error';
    	}
    	
    	echo $errstr.' (code: '.$errno.')';
    }