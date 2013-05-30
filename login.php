<?php
ob_start();
include_once("connectivity.php");
//error_reporting(0);

session_start();
if(isset($_POST['submit']))
{
 $email=$_POST['email'];
 $pass=$_POST['password'];
 //$email=strtolower($user);
 //$email=trim($_POST['email']);
// $pass=trim($_POST['password']);


	$sql= "SELECT * FROM user where email='$email' AND password='$pass'";
	$result = mysql_query($sql);
	$var = mysql_fetch_array($result);
 
	$_SESSION['name'] 		 = $var['name'];
	$_SESSION['id']   		 = $var['id'];	
	$_SESSION['user_type']   = $var['type'];
 
	$feildName="email Field is required";
	$feildName1="Password Field is required";
	$feildName2="Enter Correct email";
	$feildName3="Enter Correct password";

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

if($pass=='') 
	     {
		
		 $errmsg1='<tr><td></td>
					  <td><blink><font color="red">' .$feildName1.'</font></blink></td>
				</tr>';
		 		$err=1; 
		 }
		 else if($pass!=$var['password'])
		 {
		 $errmsg1='<tr><td></td>
					  <td><blink><font color="red">' .$feildName3.'</font></blink></td>
				</tr>';
		 		$err=1; 
		 }
		if($err!==1) 
		{
		 if(($var['email']==$email) and ($var['password']==$pass))
			{
   				/*if($var['type']=='administrator')
			    	{header('location:adminhome.php');}	
	  			if($var['type']=='user')*/
				{header('location:listticket.php');}	
			}
			else
			{
				header('location:listticket.php');
				$alert="Invalid email or Password.";
				header('location:login.php?lout=1');
			}
		}

 
} 

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


</head>
<body class="">
  
        <table bgcolor="#333333">
        <tr><td><h2><a href="#" title="Return to the main page">Ticket System</a></h2></td>
        <td>
        </td></tr></table>

<div id="content">
<div id="archdev-navbar">
  <div id="pkglist-about2" class="box">
<form id="form1" name="form1" method="POST" action="login.php"><br />


  <table width="50%" border="0" cellspacing="0" cellpadding="0">
    <tr>
     
      <td align="center"  class="boxcolor" height="150px;">
	  <div align="center">
        <table width="70%" border="0" align="center" >
          <tr>
		  <tr><td><h3>Login</h3></td></tr>
            <td><b>User Name</b></td>
            <td><input name="email" type="text" id="email"  class="textbox"/></td>
			<?php if( isset($_POST['submit']) )
					{ echo $errmsg;
					}?> 

          </tr>
          <tr>
            <td><b>Password</b></td>
            <td><input name="password" type="password" id="password" class="textbox"/></td>
			<?php if( isset($_POST['submit']) )
					{ echo $errmsg1;
					}?> 

          </tr>
          <tr>
		  <td></td>
            <td><input align="center" name="submit" type="submit"  value="submit"  class="button" /></td>
          </tr>
        </table></div></td>
     
    </tr>
   
  </table>

</form>
  </div>
</div>

 <?php           
include("footer.php"); ?>
