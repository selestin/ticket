<?php
include('include.php');
include('header.php');

#HEADER	
?>

<div id="content">
	<div id="archdev-navbar">
    	<div id="pkglist-about2" class="box">	
        
		<table>
        <tr><td><h2>Enter your time for this space</h2></td></tr>
        
        <tr><td height="88"><table>
        			 <tr bgcolor="#EAF3FA"><td> <strong>Date:</strong></td><td><strong>Project:</strong></td><td><strong>Ticket:</strong></td><td><strong>Hours:</strong></td><td><strong>Description:</strong></td><td></td></tr>
                          <tr><td height="10"></td></tr> 
                      <tr><td><input type="text" name="date" class="inputtext16" style="width: 165px;" /></td>
                      	  <td>Project Name</td>
                          <td>#3459</td>
                          <td><input type="text"  class="inputtext16" style="width: 65px;"  name="hours"/></td>
                          <td><input type="text"  name="description" class="inputtext16" style="width: 465px;" /></td>
                          <td><input type="submit" name="addtime" class="button-link" value="Add Entry"  /></td>
                      </tr>
                </table>
        
        
       </td></tr>
        <tr><td height="20"></td></tr>    
        <tr><td><h2>Report for Time entry</h2></td></tr>
        </table>
        
        </div>
	</div>
</div>