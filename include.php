<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['id'])){
	$sessionid = $_SESSION['id'];
	}
else{
	header("Location:login.php");
	$sessionid ='';
	}

/*$asignto = $_SESSION['id'];
if($asignto == '')
	header("Location:login.php");*/

include("connectivity.php");

# TICKETS

function get_all_tickets($assignto='',$project_id=''){
	
	$addon = 1;
	if($assignto)
		$addon = " WHERE assignto = '$assignto'";
	if($project_id)
		$addon = " WHERE project_id = '$project_id'";	
	
	if($assignto!='' && $project_id!='')
		$addon = " WHERE project_id = '$project_id' AND assignto = '$assignto'";	
	return $query = mysql_query("SELECT * FROM ticket  $addon");
	
}

function priority_selectbox(){
	$options = '<option value="1">Highest (1)</option>																																																																																									                <option value="2">High (2)</option>																																																																																																	                <option selected value="3">Normal (3)</option>																																																																																																	                <option value="4">Low (4)</option>																																																																																																	                <option value="5">Lowest (5)</option>
				';
	return $options;
	}
function privacytype_selectbox(){
	
	$options = '<option value="0">None</option>
				<option value="1">Private</option>
				<option selected="selected" value="2">Public</option>';
	return $options;
	}	
function milestone_selectbox(){
	$options = '<option value="1">Design Bug</option>
                <option value="2">Programing Bug</option>
                <option value="3">New Upgrade</option>
				<option value="4">Questions</option>';
	return $options;			
	}	
	
function status_selectbox($id){
	
	$options = '<option  value="1" '.($id== 1 ? 'selected' : '').'>New</option>
				<option  value="2" '.($id== 2 ? 'selected' : '').'>Accepted</option>
				<option  value="3" '.($id== 3 ? 'selected' : '').'>Test</option>
				<option  value="4" '.($id== 4 ? 'selected' : '').'>On Hold</option>
				<option  value="5" '.($id== 5 ? 'selected' : '').'>Invalid</option>
				<option  value="6" '.($id== 6 ? 'selected' : '').'>Fixed</option>';
	return $options;					
	}

function get_count_tickets($userid,$project_id=''){
	if($project_id!='')
		$addon = "AND project_id = '".$project_id."'";
	$query = mysql_query("SELECT * FROM ticket WHERE assignto ='$userid' $addon ");
	return mysql_num_rows($query);
	}	

# GENERAL FUNCTIONS 
function get_selectbox($id,$table='ticket_status'){
	$query = mysql_query("SELECT * FROM $table");
		while($row = mysql_fetch_array($query)){
			$options .= '<option  value="'.$row['id'].'" '.($row['id']== $id ? 'selected' : '').'>'.$row['name'].'</option>';
		}
	return $options;					
	}

function get_select_name($table,$id){
	$query = mysql_query("SELECT * FROM ".$table." WHERE id ='".$id."'");
	$row   = mysql_fetch_array($query);
	return $row['name'];
	}



# USERS
function AddNewUser(){
	
	
	$name 		= $_REQUEST['name'];
	$lname		= $_REQUEST['lname'];
	$email		= $_REQUEST['email'];
	$password	= $_REQUEST['password'];
	$type 		= $_REQUEST['type'];
	$edit_id    = $_REQUEST['edit_id'];
	
	$activationtime = time();
	if($edit_id>0){		
		mysql_query("UPDATE user SET 
					name = '".$name."', 
					lname= '".$lname."',
					email= '".$email."',
					password= '".$password."',
					type= '".$type."' WHERE id = ".$edit_id."");
		$lastInsertedId  = $edit_id;
		}
	else{

	mysql_query("INSERT INTO `user` (
				`id` ,
				`name` ,
				`lname` ,
				`email` ,
				`password` ,
				`type` ,
				`activationtime`
				)
				VALUES (
				NULL , '".$name."', '".$lname."', '".$email."', '".$password."', '".$type."', '".$activationtime."'
				);");
	
	$lastInsertedId = mysql_insert_id();
	
	}
	# SET PERMISION
	if(isset($lastInsertedId)){
		# DELETE ALL EXISTING PERMISSION
		mysql_query("DELETE  FROM user_permission_type_list WHERE user_id='".$lastInsertedId."'");
		# ADD NEW PERMISION SET
		foreach($permission=$_POST["permission"] as $values){
		mysql_query("INSERT INTO user_permission_type_list(id,user_id,user_permission_type_id)VALUES (NULL , $lastInsertedId, $values)");

		}
	
	}
	
	
	}
function get_users_list($id=0){
	$query = mysql_query("SELECT * FROM user");
	while($row = mysql_fetch_array($query)){
	
	if($id==$row["id"])
			echo  '<option value="'.$row["id"].'" selected>'.$row["name"].'</option>';
	else
			echo  '<option value="'.$row["id"].'">'.$row["name"].'</option>';
		}
	
	}
function get_username($id){
	$query = mysql_query("SELECT * FROM user WHERE id = '$id'");
	$row   = mysql_fetch_array($query);
	return $row['name'];
	
	}	
function get_useremail($id){
	$query = mysql_query("SELECT * FROM user WHERE id = '$id'");
	$row   = mysql_fetch_array($query);
	return $row['email'];
	
	}	
function ListAllUsers(){
	return mysql_query("SELECT * FROM user");
	}
function GetUserDetails($user_id){
	return mysql_query("SELECT * FROM user WHERE id=".$user_id."");
	}	

# PROJECT

function get_projectname($id){
	$query = mysql_query("SELECT * FROM  project WHERE id = '$id'");
	$row   = mysql_fetch_array($query);
	return $row['project_name'];
	}
function AddNewProject(){
	$project_name   = $_REQUEST['project_name'];
	$startdate	    = $_REQUEST['startdate'];
	$enddate  		= $_REQUEST['enddate'];
	$details  	    = $_REQUEST['details'];
	$deliverydate  	= $_REQUEST['deliverydate'];
	$edit_id        = $_REQUEST['edit_id'];
	
	
	if(isset($edit_id)){
		
	/*	echo "UPDATE project SET 
				project_name = '".$project_name."',
				startdate    = '".$startdate."' ,
				enddate      = '".$enddate."' ,
				details      = '".$details."' ,
				deliverydate = '".$deliverydate."'  WHERE id =".$edit_id."";
				exit;*/
		mysql_query("UPDATE project SET 
				project_name = '".$project_name."',
				startdate    = '".$startdate."' ,
				enddate      = '".$enddate."' ,
				details      = '".$details."' ,
				deliverydate = '".$deliverydate."'  WHERE id =".$edit_id."");
		
		

		
		}
	else	
		mysql_query("INSERT INTO  `project` (
				`id` ,
				`project_name` ,
				`startdate` ,
				`enddate` ,
				`details` ,
				`deliverydate`
				)
				VALUES (
				NULL ,  '".$project_name."',  '".$startdate."',  '".$enddate ."',  '".$details."',  '".$deliverydate."'
				);
				");
	}	
function GetAllProjeccts($id=''){
	
	if($id!='')
		$addon = 'WHERE id ='.$id;
	return $query = mysql_query("SELECT * FROM project ".$addon."");
	/*while($row   = mysql_fetch_array($query)){
		echo '<li>'.$row['project_name'].'</li>';
		}*/
	}	
function GetProjectDetails(){
	
	
	
	}	
	
# PERMISION
function GetAllPermissiontype(){
	return mysql_query("SELECT * FROM user_permission_type");
	}
function  GetUserPermisionStatus($userid,$permission){
	$query = mysql_query("SELECT * FROM user_permission_type_list WHERE user_id	=$userid AND  user_permission_type_id = $permission");
	return mysql_num_rows($query);
	}	
	
?>