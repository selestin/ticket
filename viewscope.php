<?php
include('include.php');
include('header.php');

#HEADER	
?>

<div id="content">
	<div id="archdev-navbar">
    	<div id="pkglist-about2" class="box">	
        <h2>Project Scope</h2>
		<?php
        $result = GetAllProjeccts($_REQUEST['id']);
        while($row = mysql_fetch_object($result)){
            echo '<table  align="center" ><tr><td>'.$row->details.'</td></tr></table>';;
            }
        ?>
        </div>
	</div>
</div>