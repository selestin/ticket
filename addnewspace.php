<?php 
include('include.php');
include('header.php');

#HEADER		
if(isset($_REQUEST['addproject']))
AddNewProject();

if((isset($_REQUEST['id']))){
	$result = GetAllProjeccts($_REQUEST['id']);
	$row    = mysql_fetch_object($result);
}
?>
<form name="srs" method="post">
<input type="hidden" name="edit_id" value="<?php echo $row->id; ?>" />
<div id="content">
        <div id="archdev-navbar">
          <div id="pkglist-about2" class="box">
          <table>
          <tr><td width="60%">
                <table align="center" width="50%">
                <tr><td colspan="2"><h2>Project Details</h2></td></tr>
                <tr><td width="15%" height="37">Project Name</td><td width="83%">
                        <input type="text" class="inputtext16" name="project_name" value="<?php echo $row->project_name;?>"></td></tr>
                <tr><td height="37">Project Scope</td><td><textarea name="details" class="inputtext16" style="width:200px;"><?php echo $row->details;?></textarea></td></tr>
                <tr><td height="37">Start Date</td><td><input type="text" name="startdate" class="inputtext16" id="startdate" value="<?php echo $row->startdate;?>" /></td></tr>
                <tr><td height="37">End  Date</td><td><input type="text" name="enddate" class="inputtext16" id="enddate" value="<?php echo $row->enddate;?>"/></td></tr>
                <tr><td height="37">Delivery  Date</td><td><input type="text" class="inputtext16" name="deliverydate" value="<?php echo $row->deliverydate;?>" id="deliverydate"/></td></tr>
                <tr><td></td><td><input class="button-link" type="submit" name="addproject" value="Add New Project"></td></tr>
                        
                </table>
          	 </td>
           <td><table>
           			<tr><td colspan="2"><h2>Assigen Users</h2></td></tr>
                    <tr><td height="36"><select class="selestusers" id="from_select_list" multiple="multiple" name="from_select_list"> 
       							 <?php get_users_list($row_tickethead['assignto']); ?>
       						 </select>
                             <select class="selestusers" id="to_select_list" multiple="multiple" name="to_select_list"> 
       							
      						 </select>
      				</td></tr>  
                    <tr><td colspan="2" height="10px;"></td></tr>
                    <tr><td>
                        <input id="moveright" type="button" value="Add User"  class="button-link" onclick="move_list_items('from_select_list','to_select_list');" />
                        <input id="moverightall" type="button" value="Add All Users" class="button-link" onclick="move_list_items_all('from_select_list','to_select_list');" />
                        <input id="moveleft" type="button" value="Delete User" class="button-link" onclick="move_list_items('to_select_list','from_select_list');" />
                        <input id="moveleftall" type="button" value="Delete All User" class="button-link" onclick="move_list_items_all('to_select_list','from_select_list');" />
             </td></tr>       
               </table>
           </td></tr></table> 
          </div>
            
        </div>
        
</form>        
<script>
  $(function() {
    $( "#startdate" ).datepicker();
		$( "#enddate" ).datepicker();
	$( "#deliverydate" ).datepicker();
  });
  </script>
  
  <style type="text/css">
.selestusers {
	width:200px;
	height:100px;
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script language="javascript" type="text/javascript">
    /*
    Auther :: Dharmendra Patri
    Email  :: dharam.new@gmail.com
    Site   :: http://lovewithbug.com
              http://forthera.com
    */
    
    /*
		@param1 - sourceid - This is the id of the multiple select box whose item has to be moved.
		@param2 - destinationid - This is the id of the multiple select box to where the iterms should be moved.
	*/
	
	//this will move selected items from source list to destination list			
	function move_list_items(sourceid, destinationid)
	{
		$("#"+sourceid+"  option:selected").appendTo("#"+destinationid);
	}

	//this will move all selected items from source list to destination list
	function move_list_items_all(sourceid, destinationid)
	{
		$("#"+sourceid+" option").appendTo("#"+destinationid);
	}
    
</script>
