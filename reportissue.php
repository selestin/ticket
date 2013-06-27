<?php
include('connectivity.php');
include('header.php');


if(isset($_POST['reportissue']))
{
	 $email = $_POST['email'];
	 $name  = $_REQUEST['name'];
	 $comment=$_REQUEST['comment'];
	 
	 $feildName1="Name field is required";
	 $feildName ="Email field is required";
	 $feildName2="Enter correct email";
	 $feildName3="Comment field is required";
	 
if($email=='') 
	     {
		
		 $errmsg='<tr><td></td>
					  <td><blink><font color="red">' .$feildName.'</font></blink></td>
				</tr>';
		 		$err=1; 
		 }
		else if($email!=$var['email'])
				{ 
		$errmsg='<tr><td></td>
					  <td><blink><font color="red">' .$feildName2.'</font></blink></td>
				</tr>';
		 		$err=1; 
				}

if($name=='') 
	     {
		
		 $errmsg1='<tr><td></td>
					  <td><blink><font color="red">' .$feildName1.'</font></blink></td>
				</tr>';
		 		$err=1; 
		 }
if($comment=='') 
	     {
		
		 $errmsg3='<tr><td></td>
					  <td><blink><font color="red">' .$feildName3.'</font></blink></td>
				</tr>';
		 		$err=1; 
		 }
		 
		 


}
?>

<div id="content">
	<div id="archdev-navbar">
    	<div id="pkglist-about2" class="box">	
        <h2>Report Issue</h2>
        <form action="reportissue.php?reportissue=yes" method="post">
		<table>
        	<tr><td height="35">Name</td><td><input class="inputtext16" style="width:300px;" type="text" name="name" /></td>
            			<?php if( isset($_POST['reportissue']) )
					{ echo $errmsg1;
					}?></tr>
            <tr><td height="19"></td><td></td></tr>
        	<tr><td height="35">Email</td><td><input class="inputtext16" style="width:300px;" type="text" name="email" /></td>
            					<?php if( isset($_POST['reportissue']) )
					{ echo $errmsg;
					}?> </tr>
            <tr><td height="19"></td><td></td></tr>
          	<tr><td>Comment/Issue</td><td><input class="inputtext16" type="text"  name="comment" size="100" style="height:50px;" /></td>
            <?php if( isset($_POST['reportissue']) )
					{ echo $errmsg3;
					}?></tr>
            <tr><td height="19"></td><td></td></tr>
            <tr><td>Attachements</td><td><input type="file" name="file" /></td></tr>
            <tr><td height="19"></td><td></td></tr>
        	<tr><td></td><td><input type="submit" name="reportissue" value="Report" class="button-link" /></td></tr>
        	<tr><td></td><td></td></tr>
          	<tr><td></td><td></td></tr>
        	<tr><td></td><td></td></tr>
         </table>
         </form>
        </div>
	</div>
</div>