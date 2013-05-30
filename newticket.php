<?php
include('header.php');
include('include.php');
include('include/mailclass.php');

$user_id = $_SESSION['id'];
    $id = $_REQUEST['id'];
	if(isset($id)){
		$query_tickethead = mysql_query("SELECT * FROM ticket WHERE id = ".$id."");
		$row_tickethead   = mysql_fetch_array($query_tickethead);
	}

if(isset($_REQUEST['addcomments'])){
	
	//$file		 = $_REQUEST['file'];
	$comment     = $_REQUEST['comment'];
	$ticket_id	 = $_REQUEST['ticket_id'];

	$date 		 = time();
	
	move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
	
	if(($_REQUEST['comment']!='') || ($_FILES["file"]["name"]!='')){
		mysql_query("INSERT INTO  `ticket_comments` (
					`id` ,
					` ticket_id` ,
					`addedby` ,
					`date` ,
					`comment` ,
					`attachement`
					)
					VALUES (
					NULL,  '".$ticket_id."' ,  '".$user_id."',  '".$date."',  '".$comment."',  '".$_FILES["file"]["name"]."'
					);");
	}

	$comment_id = mysql_insert_id();
	
	mysql_query("UPDATE ticket SET status = '".$_REQUEST['status_comment']."',assignto = '".$_REQUEST['assignto_comment']."' WHERE id = '".$ticket_id."'");
	
	mailnotification_addcomment($ticket_id,$comment_id);
	
	
	

	}
if(isset($_REQUEST['addticket'])){	



	$date = time();
        move_uploaded_file($_FILES["file"]["tmp_name"],"upload/" . $_FILES["file"]["name"]);
	$project_id     = 1;
	$workedhours    = $_REQUEST['workedhours'];
	$estimatedtime  = $_REQUEST['estimatedtime'];
	$status 		= $_REQUEST['status'];
	$priority		= $_REQUEST['priority'];
	$reportedby 	= $_REQUEST['reportedby'];
	$assignto	    = $_REQUEST['assignto'];
	$milestone      = $_REQUEST['milestone'];
	$permission_type= $_REQUEST['permission_type'];
	$title 			= $_REQUEST['title'];
	$description    = $_REQUEST['description'];
	mysql_query("INSERT INTO `ticket` (`id`,
									   `date`,
									   `project_id`,
									   `workedhours`,
									   `estimatedtime`,
									   `status`,
									   `priority`,
									   `reportedby`,
									   `assignto`, 
									   `milestone`,
									   `permission_type`,
									   `title`,
									   `description`,
									   `file`) VALUES (
									   NULL,
									   '".$date."',
									   '".$project_id."',
									   '".$workedhours."',
									   '".$estimatedtime."',
									   '".$status."',
									   '".$priority."',
									   '".$reportedby."',
									   '".$assignto."',
									   '".$milestone."',
									   '".$permission_type."',
									   '".$title."',
								           '".$description."',
                                                                           '".$_FILES["file"]["name"]."');");
									   
		//addNewTicket();							   
		echo '<font color="#FF0000">New ticket added successfully</font>'; 
	}

?>
    <div id="content">
        <div id="archdev-navbar">
            
        </div><!-- #pkglist-search -->


<div id="pkglist-results" class="box">
    <!--<div class="pkglist-stats">
    
    <p>9609 packages found.
    Page 1 of 193.</p>

    <div class="pkglist-nav">
    <span class="prev">
        
        &lt; Prev
        
    </span>
    <span class="next">
        
        <a href="http://www.archlinux.org/packages/2/?" title="Go to next page">Next &gt;</a>
        
    </span>
    </div>
    
</div>-->

    <form id="pkglist-results-form" method="post" action="" enctype="multipart/form-data">
    <div style="display:none"><input type="hidden" name="csrfmiddlewaretoken" value="dLvm7ouB5Gk8QjvfJD6ww1wcWWFkRFEE"></div>
      <table>
        <tr>
          <td width="32%" align="center" bgcolor="#FFFFFF">
	          <table border="1" cellspacing="0" cellpadding="0" id="statusbar">
            <?php if($_REQUEST['id']!=''){
            
			echo '<tr>
              <th scope="row"><div class="label">Created On</div></th>
              <td>'.date('Y-m-d',$row_tickethead['date']).'</td>
            </tr>  ';
			}
			?>
            <tr>
              <th height="26" scope="row"><div class="label">Reported by</div></th>
              <td><?php echo $_SESSION['name'];?><input type="hidden" name="reportedby" value="<?php echo $_SESSION['id'];?>" /></td>
            </tr>
            <tr>
              <th height="25" scope="row"><div class="label">Status</div></th>
              <td><select name="status">
                 <?php echo status_selectbox($row_tickethead['status']);?>
              </select></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Priority</div></th>
              <td>&nbsp;<select name="priority">
			  <?php  echo priority_selectbox(); ?></select></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Assigned to</div></th>
              <td><select name="assignto">
               <?php get_users_list($row_tickethead['assignto']); ?>
              </select></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Milestone</div></th>
              <td><select name="milestone"><?php echo milestone_selectbox(); ?></select>
              </td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Permission type</div></th>
              <td><select name="permission_type"><?php echo privacytype_selectbox(); ?></select></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Estimated Time </div></th>
              <td><input type="text" name="estimatedtime" /></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Second Responsible</div></th>
              <td><select name="second_responsible">
                <?php 
                                                                            $query = mysql_query("SELECT * FROM user");
                                                                            while($row = mysql_fetch_array($query)){
                                                                              echo  '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                                                            }
             					                                            ?>
              </select></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Third Responsible</div></th>
              <td><select name="third_responsible">
                <?php 
                                                                            $query = mysql_query("SELECT * FROM user");
                                                                            while($row = mysql_fetch_array($query)){
                                                                              echo  '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                                                                            }
             					                                            ?>
              </select></td>
            </tr>
            <tr>
              <th scope="row"><div class="label">Due Date</div></th>
              <td><input type="text" name="duedate" placeholder="mm/dd/yy" /></td>
            </tr>
          </table>
          </td>
          <td width="3%"></td>
          <td width="65%" align="center">
         	 <table>
          	 <tr><td>
             			
					<?php 
                    if($_REQUEST['id']!=''){
                  
                    ?>
                    <table>
                    <tr>
                      <td style="border-style:solid;border-width:1px;"  bgcolor="#DBEAF9" height="38">&nbsp;&nbsp;&nbsp;<font size="+1"><?php echo $row_tickethead['title'];?></font></td>
                    </tr>
                    <tr>
                      <td height="38"  bgcolor="#DBEAF9" >&nbsp;&nbsp;&nbsp;<?php echo $row_tickethead['description']; ?></td>
                    </tr>
                     <tr>
                      <td height="38"  bgcolor="#DBEAF9"  align="center"><?php if($row_tickethead['file']) echo '<img src="upload/'.$row_tickethead['file'].'" width="500" height="500">'; ?></td>
                    </tr><tr>
                      <td height="38" ><hr></td>
                    </tr>
                    </table>
                    <?php } ?>
                     	
             		</td>
              </tr>
             
            
        <!-- DISPLAY IF HAVING COMMENTS -->
        <tr><td>
            
            <?php 
            $ticket = 0;
            $ticket = $_REQUEST['ticket_id'] ? $_REQUEST['ticket_id'] : $_REQUEST['id'];
            if($ticket!=0){
            $query_comments = mysql_query("SELECT * FROM `ticket_comments` WHERE ` ticket_id` = ".$ticket."");
            while($row_comments = mysql_fetch_array($query_comments)){?>
                
            <table width="100%">
              <tr>
                <td width="50" valign="top"><img src="images/no-picture-hover.png" width="48" height="44" border="1px" style="border-style:solid;border-width:1px;" /></td>
                <td width="640" height="38" bgcolor="#FFFFFF"
                                          align="left" style=" background: linear-gradient(to bottom, white 0px, #F4F4F4 100%) repeat scroll 0 0 transparent;
                                        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                                        border-image: none;
                                        border-radius: 3px 3px 3px 3px;
                                        border-style: solid;
                                        border-width: 1px;
                                        padding: 10px 10px 10px 10px;
                                        overflow: hidden;
                                        position: relative;" >
                                       
										
               							 
                                         <table width="100%">
                                         	<tr bgcolor="#FFFFFF">
                                            	<td width="76%" > <font style="font-size:10px">By <?php echo get_username($row_comments['addedby']); ?></font></td>
                                                <td width="24%" align="right"><font style="font-size:10px"> On <?php echo date('Y-m-d H:i:s',$row_comments['date']);  ?> </font> <br /></td>
                                            </tr>
                                            <tr><td colspan="2"><?php echo $row_comments['comment'] ;?><br />
													
									  <?php if($row_comments['attachement']) {
									  echo '<a target="_blank" href="upload/'.$row_comments['attachement'].'">
									   For Full image CLICK HERE</a><br />';
									  echo '<img src="upload/'.$row_comments['attachement'].'" width="500" height="500">'; 
									  }?>
                                           		</td>
                                            </tr>
                                         </table>
                 </td>
              </tr>
              
           </table><table>
             <tr><td height="2" bgcolor="#ECF2F5">&nbsp;</td></tr></table>
            <?php	
                }?>
				
          <?php  }
            
            ?>
           
        </td></tr>
            
           
        <?php 
			 if($_REQUEST['id']=='') { ?>
             	<tr><td align="center">
                        <table width="70%"  
                        		style=" background: linear-gradient(to bottom, white 0px, #F4F4F4 100%) repeat scroll 0 0 transparent;
                                        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                                        border-image: none;
                                        border-radius: 3px 3px 3px 3px;
                                        border-style: solid;
                                        border-width: 1px;
                                        padding: 10px 10px 10px 10px;
                                        overflow: hidden;
                                        position: relative;">
                        <tr>
                            <td valign="top"><img src="images/no-picture-hover.png" width="50" height="50" /></td>
            <td><table><tr><td height="38"  >&nbsp;&nbsp;&nbsp;<br />
                                      <input type="text" name="title" width="1000" placeholder="Enter Summery for the ticket"></td>
                                           </tr>
                                           <tr><td>&nbsp;&nbsp;&nbsp;
                                      <textarea name="description" rows="10" cols="120" placeholder="Enter Description" ></textarea></td>
                                          </tr>
                                          <tr>
                                            <td height="59"><table>
                                                <tr><td>&nbsp;</td>
                                                     <td>&nbsp;</td>
                                                     <td><input type="file" name="file" /></td>
                                                    
                                                     <td width="9%"><input type="submit" name="addticket" value="Submit"></td></tr>
                                                </table>
                                            </td>
                              </tr>              
                                    </table></td>
                        </tr>
                        </table>
                    </td>
                </tr>
			<?php  }else { ?>
			 
			   <tr>
             	 <td>
                 
                     &nbsp;&nbsp;&nbsp;<input type="hidden" name="ticket_id" value="<?php echo $_REQUEST['id'];?>">
                     
                     
                 </td>
              </tr>
               <tr>
               		<td width="9%"><table width="70%"  
                        		style=" background: linear-gradient(to bottom, white 0px, #F4F4F4 100%) repeat scroll 0 0 transparent;
                                        border-color: #D4D4D4 #D4D4D4 #BCBCBC;
                                        border-image: none;
                                        border-radius: 3px 3px 3px 3px;
                                        border-style: solid;
                                        border-width: 1px;
                                        padding: 10px 10px 10px 10px;
                                        overflow: hidden;
                                        position: relative;">
                        <tr>
                            <td valign="top"><img src="images/no-picture-hover.png" width="50" height="50" /></td>
            <td><table><tr><td height="38"  ></td>
                                           </tr>
                                           <tr><td>&nbsp;&nbsp;&nbsp;
                                     <textarea name="comment" rows="15" cols="110" placeholder="Enter Comments" ></textarea></td>
                                          </tr>
                                          <tr>
                                            <td height="59"><table width="97%">
                                                <tr><td height="49"><strong>Status</strong><br /><select name="status_comment">
                                                           <?php echo status_selectbox($row_tickethead['status']);?>
                                                          </select></td>
<td><strong>Assign to </strong><br /><select name="assignto_comment">
																			<?php get_users_list($row_tickethead['assignto']); ?>
            		  																</select>
            					  </td>
                                                     <td>Worked Hours<br /><input type="text" name="workedhours"  style="width:50px;"/></td>
                                                    
                                                    <td><input type="file" name="file"  /></td> <td width="9%"><input type="submit" name="addcomments" value="Submit" /></td></tr>
                                                </table>
                                            </td>
                              </tr>              
                                    </table></td>
                        </tr>
                        </table>
                      </td>
               </tr>                                      
                                                    
               <tr><td width="9%">&nbsp;</td></tr>
                 </table>
          </td>
       </tr><?php } ?>
      </table>
    </form>

</div><!-- #pkglist-results -->

<?php include('footer.php');?>