<?php 
include('header.php');
include('include.php');
#HEADER		
	if(isset($_REQUEST['search'])){
		 $asignto = $_REQUEST['searchby_user'];
	}else
		 $asignto = $_SESSION['id']; 

?>
    <div id="content">
        
          <div id="pkglist-about2" class="box">
            <table width="97%"><tr>
            		<td width="8%" align="center"><img  align="middle"src="images/no-picture-hover.png"></td>
                    <td width="17%">
                    	<table>
                        	<tr>
               	      <td><font size="+1">Hi <?php echo ucfirst($_SESSION['name']); ?></font></td></tr>
                            <tr><td>Followed Tickets (<?php echo get_count_tickets($_SESSION['id']) ?>)  </td></tr>
                            <tr> 
                              <td><a href="addnewspace.php">Add New Space</a> <!--onclick="openWin('addnewspace.php')"--></td></tr>
                        </table>
                    </td>
                    <td width="75%" align="center" valign="top"> <strong>Spaces you are get Involved</strong>
          
                    
                    
                    <style>
					ul.a {list-style-type:circle;}
					ul.b {list-style-type:square; !Important}
					ol.c {list-style-type:upper-roman;}
					ol.d {list-style-type:lower-alpha;}
					</style>
                  
						<table >
						<?php 
						$query = GetAllProjeccts(); 
						while($row = mysql_fetch_array($query)){
							
							echo '<tr><td width="20%">
											<a href="listticket_projectwise.php?id='.$row['id'].'">'.$row['project_name'].'('.get_count_tickets($_SESSION['id'],$row['id']).')</a></td>
											<td  align="left" width="80%">
											<a href="addnewspace.php?id='.$row['id'].'">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a target="blank" href="viewscope.php?id='.$row['id'].'">View</a></td></tr>';
						}
				?>
                		</table>
                     </td>
              	   </tr>
            </table>
   
            
        </div>
        
        
<div id="pkglist-search" class="box filter-criteria">

    <h2>Search Tickets</h2>

   <!-- <h3>Package Search</h3>-->

    <form id="pkg-search" method="get" action="">
        <fieldset>
            <legend>Enter search criteria</legend>
         <!--  <div>
                <label for="id_arch" title="Limit results a specific CPU architecture">
                    Arch</label><select multiple="multiple" name="arch" id="id_arch">
<option value="any">any</option>
<option value="i686">i686</option>
<option value="x86_64">x86_64</option>
</select></div>-->
           <!--<div>
                <label for="id_repo" title="Limit results to a specific respository">
                    Repository</label></div>-->
           <div>
                <label for="id_q" title="Enter keywords as desired">
                    Keywords</label><input id="id_q" type="text" name="q" size="30"></div>
           <div>
                <label for="id_maintainer" title="Limit results to a specific maintainer">
                    Assigned to</label><select name="searchby_user" id="id_maintainer">
                                       <?php 
									   			  if($_SESSION['user_type'] !=0)
									   get_users_list(); ?>
                                        </select></div>
<!--       <div>
                <label for="id_last_update" title="Limit results to a date after the date entered">
                    Last Updated After</label><input id="id_last_update" type="text" class="vDateField" name="last_update" size="10"><span class="datetimeshortcuts">&nbsp;<a href="javascript:DateTimeShortcuts.handleCalendarQuickLink(0, 0);">Today</a>&nbsp;|&nbsp;<a href="javascript:DateTimeShortcuts.openCalendar(0);" id="calendarlink0"><img src="images/icon_calendar.gif" alt="Calendar"></a></span></div>-->
<!--       <div>
                <label for="id_flagged" title="Limit results based on out-of-date status">
                    Flagged</label><select name="flagged" id="id_flagged">
<option value="" selected="selected">All</option>
<option value="Flagged">Flagged</option>
<option value="Not Flagged">Not Flagged</option>
</select></div>-->
<!--       <div>
                <label for="id_limit" title="Select the number of results to display per page">
                    Per Page</label><select name="limit" id="id_limit">
<option value="50" selected="selected">50</option>
<option value="100">100</option>
<option value="250">250</option>
<option value="all">All</option>
</select></div>-->
			<?php   if($_SESSION['user_type'] !=0) { ?>
            <div><label>&nbsp;</label><input title="Search for tickets using this criteria" type="submit" name="search" value="Search"></div>
            
            <?php } ?>
        </fieldset>
    </form>

</div><!-- #pkglist-search -->


<div id="pkglist-results" class="box">
    <div class="pkglist-stats">
    
    <p>Ticket List.</p>

    <div class="pkglist-nav">
      <!--  <span class="prev">
            
            &lt; Prev
            
        </span>-->
  <!--  <span class="next">
        
        <a href="#" title="Go to next page">Next &gt;</a>
        
    </span>-->
    </div>
    
</div>

    <form id="pkglist-results-form" method="post" action="#"><div style="display:none"><input type="hidden" name="csrfmiddlewaretoken" value="dLvm7ouB5Gk8QjvfJD6ww1wcWWFkRFEE"></div>

        <table class="results">
            <thead>
                <tr >
                    
                    <th><a href="#" title="Sort packages by architecture">#</a></th>
                    <th><a href="#" title="Sort packages by repository">Reported by</a></th>
                    <th><a href="#" title="Sort packages by package name">Date</a></th>
                    <th>Assigned to</th>
                    <th>Description</th>
                    <th><a href="#" title="Sort packages by last update">Milestone</a></th>
                    <th><a href="#" title="Sort tikets by last priority">Priority</a></th>
                    <th><a href="#" title="Sort packages by when marked-out of-date">Status</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
			
			
			$query = get_all_tickets($asignto);
			$countoftikets = mysql_num_rows($query);
			while($row   = mysql_fetch_array($query)){
				
				if($row['priority']== 1) 
					$bgcolor = "bgcolor='#F2CBC4'";
				else if($row['priority']== 2) 
					$bgcolor = "bgcolor='#FFFF99'";	
				else if($row['priority']== 3) 
					$bgcolor = "bgcolor='#FFFFFF'";	
				else if($row['priority']== 4) 
					$bgcolor = "bgcolor='#FFFFFF'";	
				else if($row['priority']== 5) 
					$bgcolor = "bgcolor='#FFFFFF'";	
				
				//class="odd"
				echo ' <tr '.$bgcolor.'>
							<td><a href=newticket.php?id='.$row['id'].'>#'.$row['id'].'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.get_username($row['reportedby']).'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.date('Y-m-d H:i:s',$row['date']).'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.get_username($row['assignto']).'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.$row['title'].'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.get_select_name('ticket_milestone',$row['milestone']).'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.get_select_name('ticket_priority',$row['priority']).'</a></td>
							<td><a href=newticket.php?id='.$row['id'].'>'.get_select_name('ticket_status',$row['status']).'</a></td></tr>';
				
				}
			if($countoftikets == 0)	
				echo ' <tr class="odd">
							<td align="center" colspan="7"><font color="#FF0000">Not having any assinged tickets</font></td>
							</tr>';
			
			?>
            <hr>
               
               <br>
            </tbody>
        </table>
        <div class="pkglist-stats">
    
   <!-- <p>9609 packages found.
    Page 1 of 193.</p>-->

    <div class="pkglist-nav">
   <!-- <span class="prev">
        
        &lt; Prev
        
    </span>
    <span class="next">
        
        <a href="#" title="Go to next page">Next &gt;</a>
        
    </span>-->
    </div>
    
</div>


        

    </form>
    

</div><!-- #pkglist-results -->


<div id="pkglist-about" class="box">
    <p>Easy ticket system to track the project </p>
</div>


        <div id="footer">
            <p>Copyright © 2002-2012 <a href="#" title="Contact Judd Vinet">Finelab Webservices</a> </p>

            <p>The Arch Linux name and logo are recognized
            <a href="#" title="Arch Linux Trademark Policy">trademarks</a>. Some rights reserved.</p>

            <p>The registered trademark Linux® is used pursuant to a sublicense from LMI,
            the exclusive licensee of Linus Torvalds, owner of the mark on a world-wide basis.</p>
        </div>
    </div>


</body></html>