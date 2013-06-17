<?php 
include('header.php');
include('include.php');
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
            <table align="center">
            <tr><td height="37">Project Name</td><td><input type="text" name="project_name" value="<?php echo $row->project_name;?>"></td></tr>
            <tr><td height="37">SRS</td><td><textarea name="details"><?php echo $row->details;?></textarea></td></tr>
            <tr><td height="37">Start Date</td><td><input type="text" name="startdate" id="startdate" value="<?php echo $row->startdate;?>" /></td></tr>
            <tr><td height="37">End  Date</td><td><input type="text" name="enddate" id="enddate" value="<?php echo $row->enddate;?>"/></td></tr>
            <tr><td height="37">Delivery  Date</td><td><input type="text" name="deliverydate" value="<?php echo $row->deliverydate;?>" id="deliverydate"/></td></tr>
            <tr><td></td><td><input class="button-link" type="submit" name="addproject" value="Add New Project"></td></tr>
            		
            </table>
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