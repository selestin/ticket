<?php
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
			$options .= '<option  value="1" '.($row['id']== $id ? 'selected' : '').'>'.$row['name'].'</option>';
		}
	return $options;					
	}

function get_select_name($table,$id){
	$query = mysql_query("SELECT * FROM ".$table." WHERE id ='".$status."'");
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
	if(isset($edit_id)){
		
		mysql_query("UPDATE user SET 
					name = '".$name."', 
					lname= '".$lname."',
					email= '".$email."',
					password= '".$password."',
					type= '".$type."' WHERE id = ".$edit_id."");
		}
	else
	
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
				);
				
				");
	
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
?>