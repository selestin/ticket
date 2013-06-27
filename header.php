<!DOCTYPE html>
<!--http://www.archlinux.org/packages/update/-->
<!-- saved from url=(0034)http://www.archlinux.org/packages/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Project Management System</title>
    
    <link rel="stylesheet" type="text/css" href="images/archweb.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="images/archweb-print.css" media="print">
<!--    <link rel="icon" type="image/x-icon" href="http://www.archlinux.org/static/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="http://www.archlinux.org/static/favicon.ico">
    <link rel="apple-touch-icon" href="http://www.archlinux.org/static/logos/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://www.archlinux.org/static/logos/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://www.archlinux.org/static/logos/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://www.archlinux.org/static/logos/apple-touch-icon-144x144.png">
    <link rel="search" type="application/opensearchdescription+xml" href="http://www.archlinux.org/opensearch/packages/" title="Arch Linux Packages">-->
    

<link rel="stylesheet" type="text/css" href="images/widgets.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/custom.css">




<!-- TINY MCE -->
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
	width : 500
 });
<!-- TINY MCE END -->

<!-- POPUP-->
	function openWin(url)
	{	//myWindow=window.open(windowname,'','scrollbars=yes,menubar=yes,resizable=yes,left=30,top=30,height=500,width=650');
		//myWindow.document.write("<p>This is 'myWindow'</p>");
		//myWindow.focus();
		popupWindow = window.open(
			url,'popUpWindow','height=400,width=400,left=10,top=10,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=no')
	}
	
</script>
<!--CALEDER -->
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />

</head>
<body class="">
  
        <table bgcolor="#3B5A9B">
        <tr><td width="22%"><a href="#" title="Return to the main page"><font color="#FFFFFF" size="+3">Ticket System</font></a></td>
        <td width="78%"><?php if(isset($_SESSION['id'])) { ?>
        	<table><tr>
            		<td width="10%" valign="middle"><a href="listticket.php"><font style="font:Verdana, Geneva, sans-serif; color:#FFF;font-size: 0.812em;">
                    <img style="float: left; margin: 5px 5px 0px 0px;" src="images/Home-icon.png" align="bottom">Home</font></a></td>
                    <?php 
					if(GetUserPermisionStatus($_SESSION['id'],$id=1)==1)
					echo '<td width="18%"><img src="images/User-Clients-icon.png" style="float: left; margin: 4px 5px 5px 0px;"><a href="addnewuser.php"><font style="font:Verdana, Geneva, sans-serif; color:#FFF;font-size: 0.812em;">Manage Users</font></a></td>';
					?>
                    
                    <td width="50%"><img style="float: left;padding: 3px 5px 0px 0px;" src="images/logout.png"><a href="logout.php"><font style="font:Verdana, Geneva, sans-serif; color:#FFF;font-size: 0.812em;">Log Out</font></a></td>
                    
                    <td width="35%"><font color="#FFFFFF">Search&nbsp;</font><input type="text" name="search" class="inputtext16" style="height:20px;" ></td>
                    <td width="25%" align="left"><select name="projectname">
                    	<option  >Select Project</option>
                    </select></td>
                    
                    </tr></table>
            <?php } ?>        
        </td></tr></table>
        
  