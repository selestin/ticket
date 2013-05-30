<?php 
//error_reporting(0);
session_start();
if(isset($_SESSION['id'])){
	$sessionid = $_SESSION['id'];
	}
else{
	header("Location:login.php");
	$sessionid ='';
	}

/*$asignto = $_SESSION['id'];
if($asignto == '')
	header("Location:login.php");*/
?>
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
<link rel="alternate" type="application/rss+xml" title="Arch Linux Package Updates" href="http://www.archlinux.org/feeds/packages/">



<!-- TINY MCE -->
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>

<!-- TINY MCE END -->
</head>
<body class="">
  
        <table bgcolor="#333333">
        <tr><td><h2><a href="#" title="Return to the main page">Ticket System</a></h2></td>
        <td><?php if(isset($_SESSION['id'])) { ?>
        	<table><tr >
            		<td width="9%"><a href="listticket.php"><font style="font:Verdana, Geneva, sans-serif; color:#FFF;font-size: 0.812em;">Home</font></a></td>
                    <td width="18%"><a href="newticket.php"><font style="font:Verdana, Geneva, sans-serif; color:#FFF;font-size: 0.812em;">Add new ticket</font></a></td>
                    <td width="73%"><a href="logout.php"><font style="font:Verdana, Geneva, sans-serif; color:#FFF;font-size: 0.812em;">Log Out</font></a></td>
                    </tr></table>
            <?php } ?>        
        </td></tr></table>
        
  