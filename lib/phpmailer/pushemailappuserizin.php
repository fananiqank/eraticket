<?php	

date_default_timezone_set('Asia/Jakarta');
include "../../funlibs.php";
require "PHPMailerAutoload.php";

session_start();
$con=new Database();
		$ctn = "Izin Akses Data"; 
		$preq = "newrequestaci";

		foreach($con->select("people","*","id = '$_SESSION[ID_LOGIN]'") as $headname){}

		foreach($con->select("people_izinakses a left join locations b on a.locationid=b.id","a.*,case when hak_akses = 1 then 'Full Akses' else 'Read Only' end as hakakses,b.peopleid","peopledtlid = '$_POST[peopledtlid]'") as $izi){}
		
				if ($_POST['useremail'] != ''){
					//Create a new PHPMailer instance
					$mail = new PHPMailer;
					//Tell PHPMailer to use SMTP
					$mail->isSMTP();
					//Enable SMTP debugging
					// 0 = off (for production use)
					// 1 = client messages
					// 2 = client and server messages
					$mail->SMTPDebug = 0;
					//Ask for HTML-friendly debug output
					$mail->Debugoutput = 'html';
					//Set the hostname of the mail server
					//$mail->Host = "ssl://smtp.eratex.co.id";
					$mail->Host = "192.168.31.7";
					//Set the SMTP port number - likely to be 25, 465 or 587
					//$mail->Port = 465;
					//Whether to use SMTP authentication
					$mail->SMTPAuth = true;
					//$mail->SMTPSecure = 'tls'; 
					//Username to use for SMTP authentication
					$mail->Username = "sby-helpdesk@eratex.co.id";
					//Password to use for SMTP authentication
					$mail->Password = "Veritas.ertx12#";
					//Set who the message is to be sent from
					$mail->setFrom('sby-helpdesk@eratex.co.id', 'IT Ticketing Eratex Djaja ,Tbk');
					//Set an alternative reply-to address
					$mail->addReplyTo('sby-helpdesk@eratex.co.id', 'IT Ticketing Eratex Djaja ,Tbk');
					//Set who the message is to be sent to
					$mail->addAddress($_POST['useremail'] ,$_POST['namepeoplex']);
					//Set the subject line
					$mail->Subject = 'Form Request '.$ctn.' : '.$_POST['namepeoplex'].'';
					//Read an HTML message body from an external file, convert referenced images to embedded,
					//convert HTML into a basic plain-text alternative body
					//--------- update pasword
					// $password = 'admin2019';
					// $data = array( 
					// 	'password' => md5($password) 
					// );		
					// $exec= $con->update("anggota", $data,"EMAIL = '$smail[EMAIL]'");	
					//---------- end update passwor

					//$isian = include 'detail_email.php';
						$text="Form Request ".$ctn.", here's the details : <br>
								<br>
									<table width='50%' cellpadding='0' cellspacing='0' border='0'>                   
									  <tr style='padding:5%;'>
									    <td align='left' width='20%'><strong>Name</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'><strong>$_POST[namepeoplex]</strong></td>
									  </tr>
									  <tr>
									    <td align='left'><strong>Dept</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>$_POST[departx]</td>
									  </tr>
									  <tr>
									    <td align='left'><strong>Jabatan</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>$_POST[jabatanx]</td>
									  </tr>
									  <tr>
									    <td align='left'><strong>Created Date</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>$_POST[createddatex]</td>
									  </tr>
									  <tr>
									    <td align='left'><strong>Head Approve</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>$headname[name]</td>
									  </tr>
									  <tr>
									    <td align='left'><strong>Approve Date</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>$date</td>
									  </tr>
									  <tr>
									    <td align='left'><strong>Status</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>$status</td>
									  </tr>
									  <tr>
									    <td align='left'><strong>File / Folder</strong></td>
									    <td align='left' width='2%'>:</td>
									    <td align='left'>
									    	<table class='table' border='1' cellspacing = '1' cellpadding = '1'>
									    		<tr>
									    			<td>File/Folder/Server</td>
									    			<td>Lokasi</td>
									    			<td>Hak Akses</td>
									    			<td>Remark</td>
									    		</tr>
									    		<tr>
									    			<td>$izi[filefolder]</td>
									    			<td>$izi[lokasi]</td>
									    			<td>$izi[hakakses]</td>
									    			<td>$izi[remark]</td>
									    		</tr>
									    	</table>
									    </td>
									  </tr>
									</table>

								 <br>
								<br>
								You can track progress of this request regularly through <a href='http://192.168.31.25/eraticket/index.php?x=viewnewreq&d=$_POST[peopledtlid]'>Link</a>.
								
								<br>
								<br>
								regards, <br>
								IT Ticketing Admin <br>
						   
							   ";
				
					$mail->msgHTML("$text");
					//Replace the plain text body with one created manually
					$mail->AltBody = 'This is a plain-text message body';
					//Attach an image file
					//$mail->addAttachment('images/phpmailer_mini.png');
					
					//send the message, check for errors
					
					if (!$mail->send()) {
						$row_set[] = array("status"=>$mail->ErrorInfo);
						//echo json_encode($row_set);
						//echo $_GET['callback']."(".json_encode($row_set).")";
					
					} else {
						//echo "b";
						$row_set[] = array("status"=>"Email Terkirim");
						//echo json_encode($row_set);
						//echo $_GET['callback']."(".json_encode($row_set).")";
					
					}

				}
				else if ($_POST['email'] == ''){
					$row_set[] = array("status"=>"Email Tidak Ditemukan");
					//echo json_encode($row_set);
					//echo $_GET['callback']."(".json_encode($row_set).")";

				}
        	
		
		
// <br><br>
// here's the Guide:
// <br>
// 1. Login. <br>
// 2. Check Request List ( <strong>$_POST[namepeople]</strong> ). <br>
// 3. Click Please Approve with orange colors. <br>
// 4. Click Approve.