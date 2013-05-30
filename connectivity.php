<?php
    $mysql_hostname = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_database = "ticket_system";
    
    $conn = mysql_connect($mysql_hostname, $mysql_user, $mysql_password,$mysql_database) or die("Could not connect database");
    mysql_select_db("$mysql_database", $conn); 
	

?>
