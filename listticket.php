<?php 
include('header.php');
include('include.php');
#HEAD		
	if(isset($_REQUEST['search'])){
		 $asignto = $_REQUEST['searchby_user'];
	}else
		 $asignto = $_SESSION['id']; 

?>
    <div id="content">
        <div id="archdev-navbar">
          <div id="pkglist-about2" class="box">
            <table><tr>
            		<td width="9%" align="center"><img  align="middle"src="images/no-picture-hover.png"></td>
                    <td width="91%">
                    	<table>
                        	<tr>
               	      <td><font size="+1">Hi <?php echo ucfirst($_SESSION['name']); ?></font></td></tr>
                            <tr><td>Followed Tickets (<?php echo get_count_tickets($_SESSION['id']) ?>)  </td></tr>
                            <tr><td>&nbsp;</td></tr>
                        </table>
                    </td>
              	   </tr>
            </table>
          </div>
            
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

<script type="text/javascript" src="images/jquery.min.js"></script>
<script type="text/javascript" src="images/saved_resource"></script>
<script type="text/javascript">
	window.__admin_media_prefix__ = "/static/admin/";
	var django = {"jQuery": jQuery};
</script>
<script type="text/javascript" src="images/core.js"></script>
<script type="text/javascript" src="images/calendar.js"></script>
<script type="text/javascript" src="images/DateTimeShortcuts.js"></script>

        <div id="footer">
            <p>Copyright © 2002-2012 <a href="#" title="Contact Judd Vinet">Finelab Webservices</a> </p>

            <p>The Arch Linux name and logo are recognized
            <a href="#" title="Arch Linux Trademark Policy">trademarks</a>. Some rights reserved.</p>

            <p>The registered trademark Linux® is used pursuant to a sublicense from LMI,
            the exclusive licensee of Linus Torvalds, owner of the mark on a world-wide basis.</p>
        </div>
    </div>


<div style="position: absolute; left: 848px; top: 93px; display: none; " class="calendarbox module" id="calendarbox0"><div><a href="javascript:DateTimeShortcuts.drawPrev(0);" class="calendarnav-previous">&lt;</a><a href="javascript:DateTimeShortcuts.drawNext(0);" class="calendarnav-next">&gt;</a></div><div id="calendarin0" class="calendar"><table><caption>June 2012</caption><tbody><tr><th>S</th><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th></tr><tr><td style="background-color: rgb(243, 243, 243); "> </td><td style="background-color: rgb(243, 243, 243); "> </td><td style="background-color: rgb(243, 243, 243); "> </td><td style="background-color: rgb(243, 243, 243); "> </td><td style="background-color: rgb(243, 243, 243); "> </td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,1));">1</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,2));">2</a></td></tr><tr><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,3));">3</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,4));">4</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,5));">5</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,6));">6</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,7));">7</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,8));">8</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,9));">9</a></td></tr><tr><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,10));">10</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,11));">11</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,12));">12</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,13));">13</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,14));">14</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,15));">15</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,16));">16</a></td></tr><tr><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,17));">17</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,18));">18</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,19));">19</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,20));">20</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,21));">21</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,22));">22</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,23));">23</a></td></tr><tr><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,24));">24</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,25));">25</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,26));">26</a></td><td class="today"><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,27));">27</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,28));">28</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,29));">29</a></td><td class=""><a href="javascript:void(function(y, m, d) { DateTimeShortcuts.calendarInputs[0].value = new Date(y, m-1, d).strftime('%Y-%m-%d');DateTimeShortcuts.calendarInputs[0].focus();document.getElementById(DateTimeShortcuts.calendarDivName1+0).style.display='none';}(2012,6,30));">30</a></td></tr></tbody></table></div><div class="calendar-shortcuts"><a href="javascript:DateTimeShortcuts.handleCalendarQuickLink(0, -1);">Yesterday</a>&nbsp;|&nbsp;<a href="javascript:DateTimeShortcuts.handleCalendarQuickLink(0, 0);">Today</a>&nbsp;|&nbsp;<a href="javascript:DateTimeShortcuts.handleCalendarQuickLink(0, +1);">Tomorrow</a></div><p class="calendar-cancel"><a href="javascript:DateTimeShortcuts.dismissCalendar(0);">Cancel</a></p></div></body></html>