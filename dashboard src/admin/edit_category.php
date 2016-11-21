<?php

require_once('check_admin_session.php');

$name= $_REQUEST['name'];
$id= $_REQUEST['id'];
$query= mysql_query("Update category SET cat_name='$name' WHERE category_id='$id'");
if(!empty($query))
{
	$arr= array('id' => $id, 'name' => $name);
	echo json_encode($arr);
}
?>
