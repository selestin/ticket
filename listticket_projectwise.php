<?php 
include('include.php');
include('header.php');

#HEADER		
	if(isset($_REQUEST['search'])){
		 $asignto = $_REQUEST['searchby_user'];
	}else
		 $asignto = $_SESSION['id']; 

	$project_id = $_REQUEST['project_id'];
	if(isset($project_id)){
	
	$_SESSION['project_id'] = $project_id ;
	}
	$session_project_id     = $_SESSION['project_id'];
?>
    <div id="content">
     <div id="archdev-navbar">
      <div id="pkglist-search" class="box filter-criteria">

	<table width="100%"><tr>
     <td width="346">  <h2>Manage Project: (<?php echo get_projectname($session_project_id) ?>)</h2></td>
     <td width="925"> <img src="images/ico-add.png" /><a href="newticket.php"><font style="font:Verdana, Geneva, sans-serif; font-size: 12px;">Add new ticket</font></a></td>
    </tr></table>
    
   
   

  

</div><!-- #pkglist-search -->
</div>


<div id="pkglist-results" class="box">
    <div class="pkglist-stats">
    
   <table width="52%"><tr><td width="500"> <font size="4">Ticket List.</font></td><td> <!-- <h3>Package Search</h3>-->

    <form id="pkg-search" method="get" action="">
     <fieldset>
    	<table width="480"><td width="94"><legend>Enter search criteria</legend></td>
        		<td width="198">           <div style="float:left; margin-top:-8px;">
                <label for="id_q" title="Enter keywords as desired">
                    Keywords<br /></label><input id="id_q" type="text" name="q" size="30"></div></td>
                <td width="63">  <div style="float:left; margin-top:-8px;">
                <label for="id_maintainer" title="Limit results to a specific maintainer">
                    Assigned to</label><br /><select name="searchby_user" id="id_maintainer">
                                       <?php 
									   			  if($_SESSION['user_type'] !=0)
									   get_users_list(); ?>
                                        </select></div></td>
                <td width="80"><?php   if($_SESSION['user_type'] !=0) { ?>
            <label>&nbsp;</label><input title="Search for tickets using this criteria" type="submit" name="search" value="Search">
            
            <?php } ?></td></table>
       
            
        

         
			
        </fieldset>
    </form></td></tr></table>

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
			
			
			$query = get_all_tickets($asignto,$project_id);
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