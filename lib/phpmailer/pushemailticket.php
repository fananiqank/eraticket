<?php	

date_default_timezone_set('Asia/Jakarta');
include "../../funlibs.php";
require "PHPMailerAutoload.php";

session_start();
 
 //echo "jem";
 //die;
 		//$jmldetail=$con->select("pj_penjualan_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.id_dtl_jual,a.id_barang,b.kode_barang,b.nama_barang,c.nama_satuan,a.harga_jual,a.dtl_total,a.qty_jual","a.id_pj='$_GET[id]'");				
					
$con=new Database();
		
		foreach($con->select("assets","*","id = '$_POST[idasetontrack]'") as $ast){}  
		foreach($con->select("tickets_departments","email","id=1") as $picticket){}
			if ($_POST['email'] != ''){
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
				$mail->addAddress($_POST['email'] ,$_POST['nama']);
				$mail->addAddress($_POST['report_email'] ,$_POST['report_name']);
				$mail->addAddress($picticket['email'] ,'IT Support Team');
				//Set the subject line
				$mail->Subject = 'Ticket No.'.$idgen.' : Open';
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
					$text="Ticket $idgen has been created, here's the details : <br>
							<br>
								<table width='50%' cellpadding='0' cellspacing='0' border='0'>                   
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Ticket No</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$idgen</strong></td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Created Date</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$date</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Created By</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$_POST[report_name]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Machine ID</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$ast[machine_id] / $ast[nodenumber]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Dept</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$_POST[showdep]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Problem</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$_POST[remark]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Status</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>Open</strong></td>
								  </tr>
								</table>

							 <br>
							<br>
							View Ticket Click <a href='http://192.168.31.25/eraticket/index.php?x=view&d=$exec3'>Here</a>
							<br>
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
				
				

			}
			
