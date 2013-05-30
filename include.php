<?php
include("connectivity.php");

# TICKETS
function get_all_tickets($addon=''){
	if($addon)
		$addon = " WHERE assignto = '$addon'";
	
	return $query = mysql_query("SELECT * FROM ticket $addon");
	
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

function get_count_tickets($userid){
	
	$query = mysql_query("SELECT * FROM ticket WHERE assignto ='$userid'");
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
	$query = mysql_query("SELECT * FROM ".$table." WHERE id ='".$id."'");
	$row   = mysql_fetch_array($query);
	return $row['name'];
	}



# USERS
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
	

# PROJECT

function get_projectname($id){
	$query = mysql_query("SELECT * FROM  project WHERE id = '$id'");
	$row   = mysql_fetch_array($query);
	return $row['project_name'];
	}
?>