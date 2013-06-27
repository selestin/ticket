<?php
include('include.php'); 
include('header.php');

#HEADER		
if(isset($_REQUEST['adduser']))
AddNewUser();

if((isset($_REQUEST['id']))){
	$user_id = $_REQUEST['id'];
	$result  = GetUserDetails($_REQUEST['id']);
	$row     = mysql_fetch_object($result);
}
?>
<form name="srs" method="post">
<input type="hidden" name="edit_id" value="<?php echo $row->id; ?>" />

<!-- ADD NEW USER -->
<div id="content">
    <div id="archdev-navbar">
      <div id="pkglist-about2" class="box">
      <table><tr><td>
                    <table align="center">
                    <tr><td height="37" colspan="2"><h2>Add new User</h2></td></tr>
                    <tr><td height="37">First Name</td><td><input type="text" name="name" value="<?php echo $row->name;?>"></td></tr>
                    <tr><td height="37">Last Name</td><td><input type="text" name="lname" value="<?php echo $row->lname;?>"></td></tr>
                    <tr><td height="37">Email</td><td><input type="text" name="email" value="<?php echo $row->email;?>"></td></tr>
                    <tr><td height="37">Password</td><td><input type="text" name="password" value="<?php echo $row->password;?>"></td></tr>
                    <tr><td height="37">Permission Type</td><td><select name="type"><?php echo get_selectbox($row->type,'user_type');?>
                    </select></td></tr>
                    <tr><td></td><td><input class="button-link" type="submit" name="adduser" value="Mange User"></td></tr>
                    </table>
                </td>
        <td><h2>Set Permission</h2>
           	<ul>
					<?php 
							$result = GetAllPermissiontype();
							while($row = mysql_fetch_array($result)){
								if($user_id)
								$checked = GetUserPermisionStatus($user_id,$row['id']) ?  'checked="checked"' : '' ;
								echo '<li><input name=permission[] value="'.$row['id'].'" type="checkbox" '.$checked.' />'.$row['name'].'</li>';
							}
					 ?>
               <li>
             </ul>
                
          </td>
            </tr></table>
      </div>
   </div>
       
<!-- LIST USERS -->       
     <div id="pkglist-results" class="box">
        <div class="pkglist-stats">
        <p>Users List.</p>
        </div>
        <form id="pkglist-results-form" method="post" action="#">
            <table class="results">
                <thead>
                    <tr >
                        <th><a href="#" title="User Details">#</a></th>
                        <th><a href="#" title="User Details">Fname</a></th>
                        <th><a href="#" title="User Details">Lname</a></th>
                        <th><a href="#" title="User Details">Email</a></th>
                        <th><a href="#" title="User Details">Password</a></th>
                        <th><a href="#" title="User Details">Type</a></th>
                        <th><a href="#" title="User Details">Activation Time</a></th>
                        <th><a href="#" title="User Details">Edit</a></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = ListAllUsers();
                $countoftikets = mysql_num_rows($query);
                while($row   = mysql_fetch_array($query)){
                   echo ' <tr bgcolor="#FFFFFF">
                                <td><a href=addnewuser.php?id='.$row['id'].'>#'.$row['id'].'</a></td>
                                <td><a href=addnewuser.php?id='.$row['id'].'>'.$row['name'].'</a></td>
								<td><a href=addnewuser.php?id='.$row['id'].'>'.($row['lname']).'</a></td>
                                <td><a href=addnewuser.php?id='.$row['id'].'>'.$row['email'].'</a></td>
								<td><a href=addnewuser.php?id='.$row['id'].'>'.$row['password'].'</a></td>
								<td><a href=addnewuser.php?id='.$row['id'].'>'.get_select_name('user_type',$row['type']).$row['type'].'</a></td>
                                <td><a href=addnewuser.php?id='.$row['id'].'>'.date('Y-m-d H:i:s',$row['activationtime']).'</a></td>
								<td><a href=addnewuser.php?id='.$row['id'].'>Edit</a></td>
                               </tr>';
                    
                    }
                if($countoftikets == 0)	
                    echo ' <tr class="odd">
                                <td align="center" colspan="7"><font color="#FF0000">Not having any assinged tickets</font></td>
                                </tr>';
                
                ?>
    
                </tbody>
            </table>
         </form>
     </div><!-- USERS LIST END -->       
</form>        
<script>
  $(function() {
    $( "#startdate" ).datepicker();
		$( "#enddate" ).datepicker();
	$( "#deliverydate" ).datepicker();
  });
  </script>