<?php 

include ('mailer.php');

sendMail();

function sendMail($From,$FromName,$to,$toName,$Subject,$Body,$AltBody='',$attachement='',$loss_id=0){
	
	$From = 'selestin@gmail.com';
	$FromName = 'Selestin';
	$to = 'selestinthomas@gmail.com'
	$toName = 'Admin'
	$Subject = 'Test' 
	$Body    = '<div style="background-color:#fff8a6;padding:10px 20px;margin-top:12px;font-family:arial;font-size:10pt;border:1px solid #d4dce8;border-top:4px solid #d4dce8">
  <div style="font-family:arial;font-size:10pt"><div class="im">      <h1 style="font-family:arial;font-size:15pt;color:#15478c;text-align:left">#381: Independent Adjuster not printing on loss PDF</h1>
      </div><table border="0" cellpadding="0" cellspacing="0" width="580" style="margin-bottom:20p">
        
      <tbody><tr>
        <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top"><div class="im">
          Created on: 2013-04-18<br>
          Reported by: QFBreporter<br></div>
          Assigned to: selestin<br>
          Milestone: QFB Bugs<br>
          
        </td>
        <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top">
          Status: New<br>
          Priority: Normal (3)<br>
          Component: <br>
          Support view: Public
        </td>
      </tr>
    
        
            <tr>
              <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top">
                Estimated Time: 0.0
              </td>
              <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top">
                Second Responsible: 
              </td>
            </tr>
          
            <tr>
              <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top">
                Third Responsible: 
              </td>
              <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top">
                Due Date: 
              </td>
            </tr>
          
      </tbody></table>
<p align="left"><strong>Comment:</strong><br>asdasdasd</p><p>Changes (by Cristina Waldbott):</p><ul><li> <strong>Assigned to:</strong> cwaldbott =&gt; selestin </li></ul><div class="yj6qo ajU"><div id=":1gx" class="ajR" role="button" tabindex="0" data-tooltip="Show trimmed content" aria-label="Show trimmed content"><img class="ajT" src="images/cleardot.gif"></div></div><div class="adL"><p></p></div></div><div class="adL">
</div></div>';
	
	$AltBody ='<div style="background-color:#fff8a6;padding:10px 20px;margin-top:12px;font-family:arial;font-size:10pt;border:1px solid #d4dce8;border-top:4px solid #d4dce8">
  <div style="font-family:arial;font-size:10pt"><div class="im">      <h1 style="font-family:arial;font-size:15pt;color:#15478c;text-align:left">#381: Independent Adjuster not printing on loss PDF</h1>
      </div><table border="0" cellpadding="0" cellspacing="0" width="580" style="margin-bottom:20p">
        
      <tbody><tr>
        <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top"><div class="im">
          Created on: 2013-04-18<br>
          Reported by: QFBreporter<br></div>
          Assigned to: selestin<br>
          Milestone: QFB Bugs<br>
          
        </td>
        <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top">
          Status: New<br>
          Priority: Normal (3)<br>
          Component: <br>
          Support view: Public
        </td>
      </tr>
    
        
            <tr>
              <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top">
                Estimated Time: 0.0
              </td>
              <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top">
                Second Responsible: 
              </td>
            </tr>
          
            <tr>
              <td width="290" style="border-right:2px dotted #cccccc;font-family:arial;font-size:10pt;vertical-align:top">
                Third Responsible: 
              </td>
              <td width="290" style="padding-left:10px;font-family:arial;font-size:10pt;vertical-align:top">
                Due Date: 
              </td>
            </tr>
          
      </tbody></table>
<p align="left"><strong>Comment:</strong><br>asdasdasd</p><p>Changes (by Cristina Waldbott):</p><ul><li> <strong>Assigned to:</strong> cwaldbott =&gt; selestin </li></ul><div class="yj6qo ajU"><div id=":1gx" class="ajR" role="button" tabindex="0" data-tooltip="Show trimmed content" aria-label="Show trimmed content"><img class="ajT" src="images/cleardot.gif"></div></div><div class="adL"><p></p></div></div><div class="adL">
</div></div>'


	$fakemail = explode("_",$to);
	$pieces = explode("@",$to);
	if(!is_numeric($pieces[0]) || !is_numeric($fakemail[0])){
		//$AltBody .= "\n"."\n"."We prefer if you respond to this message by login into the system, however if you are unable to login Please reply to this message by emailing: ##Email_address##"; 
		//$Body .= "\n"."\n"."We prefer if you respond to this message by login into the system, however if you are unable to login Please reply to this message by emailing: ##Email_address##"; 
		$AltBody .= "\n"."\n"."We prefer if you respond to this message by login into the system, however if you are unable to login Please reply to this message by emailing: ".$From.""; 
		$Body .= "\n"."\n"."We prefer if you respond to this message by login into the system, however if you are unable to login Please reply to this message by emailing: ".$From.""; 
		$AdminEmailAddress = getSettingsValue("fromemail");
		$Body = str_replace("##Email_address##",$AdminEmailAddress,$Body);
		$AltBody = str_replace("##Email_address##",$AdminEmailAddress,$AltBody);
		$mail = new PHPMailer(); //Initialize
		$mail->Host     = "localhost"; // SMTP servers
		$mail->IsSendmail();
		$mail->IsHTML(true);   // send as HTML
		$mail->From     = $From;
		$mail->FromName = $FromName;
		$mail->AddAddress($to,$toName); 	
		if($attachement!='')
		foreach($attachement as $link){
			$mail->AddAttachment($link); 
		}
		$mail->Subject  = $Subject;
		$mail->Body     = stripslashes($Body);
		if(strlen($AltBody)>0) $mail->AltBody  = stripslashes($AltBody);
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