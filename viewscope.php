<?php 
include('header.php');
include('include.php');
#HEADER	

echo $_REQUEST['id'];

$result = GetAllProjeccts($_REQUEST['id']);
while($row = mysql_fetch_object($result)){
	echo '<table style="width:500px" align="center" width="80%"><tr><td>'.$row->details.'</td></tr></table>';;
	}
?>

