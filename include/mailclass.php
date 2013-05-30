<?php 

$siteurl = 'http://freeclassifads.com/ticket';
include('mailer.php');
function mailnotification_addcomment($ticket_id,$comment_id){
$query = mysql_query("
SELECT ticket.id, ticket.date AS ticket_date, ticket.status, ticket.reportedby, ticket.priority, ticket.assignto, ticket.milestone, ticket.estimatedtime, ticket.title, ticket.second_responsible, ticket.third_responsible, ticket.duedate, ticket_comments.addedby, ticket_comments.comment,ticket.project_id
FROM ticket_comments, ticket, user,project
WHERE ticket.id = ticket_comments.` ticket_id` 
AND ticket.assignto = user.id
AND ticket.id =".$ticket_id." AND ticket_comments.id = ".$comment_id."");

$result = mysql_fetch_array($query);




$body = '<div style="width:600px;padding:1em">
  <div class="adM"> </div>
  <strong>Ticket</strong> alert by <a href="#" style="color:blue" target="_blank">'.get_username($result['addedby']).'</a> in space <a href="'.$siteurl.'" style="color:blue" target="_blank">'.get_projectname($result['project_id']).'</a> ( reply ABOVE this line )
  <div style="background-color:#fff8a6;padding:10px 20px;margin-top:12px;font-family:arial;font-size:10pt;border:1px solid #d4dce8;border-top:4px solid #d4dce8">
    <div style="font-family:arial;font-size:10pt">
      <h1 style="font-family:arial;font-size:15pt;color:#15478c;text-align:left">#'.$result['id'].': '.$result['title'].'</h1>
      <table border="0" cellpadding="0" cellspacing="0" width="580" style="margin-bottom:20p">
        <tbody>
          <tr>
            <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top"> Created on: 2013-04-18<br>
              Reported by: '.get_username($result['reportedby']).'<br>
              Assigned to: '.get_username($result['assignto']).'<br>
              Milestone: '.get_select_name('ticket_milestone',$result['milestone']).'<br>
            </td>
            <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top"> Status: '.get_select_name('ticket_status',$result['status']).'<br>
              Priority: '.get_select_name('ticket_priority',$result['priority']).'<br>
              Component: <br>
              Support view: Public </td>
          </tr>
          <tr>
            <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top"> Estimated Time: '.$result['estimatedtime'].'</td>
            <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top"> Second Responsible: '.get_username($result['second_responsible']).'</td>
          </tr>
          <tr>
            <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top"> Third Responsible:'.get_username($result['third_responsible']).' </td>
            <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top"> Due Date: '.$result['duedate'].'</td>
          </tr>
        </tbody>
      </table>
     
      <p>Changes (by '.get_username($result['addedby']).'):</p>
     
      <p>Comment:</p>
     '.$result['comment'].'.<br>
      <br>
<p><a href="http://freeclassifads.com/ticket/newticket.php?id='.$ticket_id.'" style="color:blue" target="_blank">More details</a></p>
      <p></p>
    </div>
  </div>
 
';
/* 
  <br>
  <div style="color:gray;font-size:8pt;font-family:arial;padding:10px 20px;background:#e7fabb;text-align:center"> If you no longer wish to receive these emails or if you would like to change the default frequency, <a href="#" target="_blank">click here to change your email notification settings for QFB Project Management</a> </div>
  <p style="text-align:center;color:#15478c;font-size:10pt;font-family:arial"> <strong>TICKETSYSTEM</strong> | Workspaces to accelerate software teams </p>
  <div class="yj6qo"></div>
  <div class="adL"> </div>
</div>*/
/*sendMail('Selestin@gmail.com','Selestin','selestinthomas@gmail.com',get_username($result['assignto']),'['.get_projectname($result['project_id']).']#'.$result['id'].': '.$result['title'],$body,$body);*/

sendMail(get_useremail($result['addedby']),get_username($result['addedby']),'selestinthomas@gmail.com',get_username($result['assignto']),'['.get_projectname($result['project_id']).']#'.$result['id'].': '.$result['title'],$body,$body);

sendMail(get_useremail($result['addedby']),get_username($result['addedby']),'aniltejomaya@gmail.com',get_username($result['assignto']),'['.get_projectname($result['project_id']).']#'.$result['id'].': '.$result['title'],$body,$body);

sendMail(get_useremail($result['addedby']),get_username($result['addedby']),'mahesh25242@gmail.com',get_username($result['assignto']),'['.get_projectname($result['project_id']).']#'.$result['id'].': '.$result['title'],$body,$body);

sendMail(get_useremail($result['addedby']),get_username($result['addedby']),'hellojosejohny@gmail.com',get_username($result['assignto']),'['.get_projectname($result['project_id']).']#'.$result['id'].': '.$result['title'],$body,$body);

/*sendMail(get_useremail($result['addedby']),get_username($result['addedby']),get_useremail($result['assignto']),get_username($result['assignto']),'['.get_projectname($result['project_id']).']#'.$result['id'].': '.$result['title'],$body,$body);*/

}

function sendMail($From,$FromName,$to,$toName,$Subject,$Body,$AltBody=''){
	$fakemail = explode("_",$to);
	$pieces = explode("@",$to);
	if(!is_numeric($pieces[0]) || !is_numeric($fakemail[0])){
		$mail = new PHPMailer(); //Initialize
		$mail->Host     = "localhost"; // SMTP servers
		$mail->IsSendmail();
		$mail->IsHTML(true);   // send as HTML
		$mail->From     = $From;
		$mail->FromName = $FromName;
		$mail->AddAddress($to,$toName); 		
		$mail->Subject  = $Subject;
		$mail->Body     = $Body;
		if(strlen($AltBody)>0) $mail->AltBody  = $AltBody;
		/*
		echo $mail->From."<br>";
		echo $mail->FromName."<br>";
		echo $to."<br>";
		echo $toName."<br>";
		echo $mail->Subject."<br>";
		echo $mail->Body;
		exit;
		*/
		$mail->Send();
		$mail->ClearAddresses();
	}
}
?>