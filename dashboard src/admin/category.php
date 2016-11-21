<?php

require_once('check_admin_session.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../css/structure.css" media="screen">
<title>Forum Category</title>

<script language="javascript">
function edit(id,name)
{
	var edit = document.getElementById(id);
	var category = document.createElement("input");
  	category.type = "textbox";
   	category.value = name;
	category.name = id;
	category.id = id;
  	
	var save = document.createElement("input");
	save.type = "button";
   	save.value = "save";
	save.onclick = getCategory; 

	
	var cat = document.createElement("td");
	cat.appendChild(category);
	cat.appendChild(save);
	
	edit.parentNode.replaceChild(cat, edit);
}

function getCategory()

	{ category=  this.previousSibling;
      editCategory(category);
    } 

function createRequest() {
  try {
    request = new XMLHttpRequest();
  } catch (tryMS) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (otherMS) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }
  return request;
}

function editCategory(elem) {
  request = createRequest();
  if (request == null) {
    alert("Unable to Edit");
    return;
  }
  
  var url= "edit_category.php?id=" + elem.name + "&name=" +escape(elem.value);
  request.open("GET", url, true);
  request.onreadystatechange = displayNewCategory;
  request.send(null);
}

function displayNewCategory() {
  if (request.readyState == 4) {
    if (request.status == 200) {
		var text =request.responseText;
		var obj = eval ("(" + text + ")");
		var id= obj.id
		var name= obj.name;
		
		var box =document.getElementById(id).parentNode;
		var newname = document.createElement("td");
  		newname.type = "td";
   	 	newname.innerHTML = name;
		newname.id = id;
		box.parentNode.replaceChild(newname, box);
    }
  }
}
</script>
</head>

<body>
<?php
include('../header.html');
?>
<a style="color:#fff; padding:10px 0px 10px 150px; font-size:20px; text-decoration:underline;" href="index.php">Admin Center </a>
<div class="box" style="width:600px; margin-bottom:380px;">
   <br />
     <center><h2 style="color:#066;">Manage Categories</h2></center>
  
   <table cellpadding="5px" class="boxBody" style=" width:600px; text-align:left; font-size:15px; padding-left:70px; ">
   <tr>
    	<th style="font-size:17px;">Category</th>
    	<th style="font-size:17px;">Topics</th>
    	<th style="font-size:17px;">Action</th>
   </tr>
<?php
$row = mysql_query('select c.category_id, c.cat_name,  (select count(*) from forum as f where f.category_id=c.category_id) as topics  from category as c group by c.category_id order by c.cat_name asc');

while($res1 = mysql_fetch_array($row))
{
?>
	<tr>
    	<td id= "<?php echo $res1['category_id']; ?>">
		<?php echo $res1['cat_name']; ?></a>
        </td>
    	<td><?php echo $res1['topics']; ?></td>
    	<td>
		<img src="../images/edit.png" alt="Delete" title= "edit" onclick="edit(<?php echo $res1["category_id"]. ','.'\''.$res1["cat_name"].'\''; ?>);" />
        
        <a href="delete_category.php?id='<?php echo $res1["category_id"]; ?>'"><img src="../images/delete.png" alt="Delete" title="delete"/>
        </a>
        </td>
     </tr>
<?php
}
?>
	</table>
<a href="new_category.php" class="btnLogin" style="color:#fff; margin: 10px 400px 0 0;" >New Category</a>
</div>



<?php
include('../footer.html');
?>
</body>
</html>