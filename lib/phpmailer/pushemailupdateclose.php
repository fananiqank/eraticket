<?php	

date_default_timezone_set('Asia/Jakarta');
include "../../funlibs.php";
require "PHPMailerAutoload.php";

session_start();
 
 //echo "jem";
 //die;
 		//$jmldetail=$con->select("pj_penjualan_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.id_dtl_jual,a.id_barang,b.kode_barang,b.nama_barang,c.nama_satuan,a.harga_jual,a.dtl_total,a.qty_jual","a.id_pj='$_GET[id]'");				
					
$con=new Database();
		if($_GET['tipe'] == '1'){$statusijo = "Closed";}else{$statusijo = "Reopened";}
		foreach($con->select("tickets","*","id = '$_GET[id]'") as $ast){}  
		//foreach($con->select("people","*","id = $ast[adminid]") as $adm){}
		
		$expem = explode(';',$ast[adminid]);
      foreach($expem as $key => $value){
        	foreach($con->query("select email,name from people where id = '$value'") as $adm){}
            	//echo $adm['email']; 
			if ($adm['email'] != ''){
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
				$mail->addAddress($adm['email'] ,$adm['name']);
				
				//Set the subject line
				$mail->Subject = 'Ticket No.'.$ast['ticket'].' : '.$statusijo;
				//Read an HTML message body from an external file, convert referenced images to embedded,
			
				//$isian = include 'detail_email.php';
					$text="Ticket $ast[ticket] has been Confirmed, here's the details : <br>
							<br>
								<table width='50%' cellpadding='0' cellspacing='0' border='0'>                   
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Ticket No</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>".$ast['ticket']."</strong></td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Status</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><b>".$statusijo."</b></td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Remark</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>Confirmed by User, ".$_POST['followup']."</td>
								  </tr>
								</table>

							 <br>
							<br>
							Please check your ticket task in <a href='http://192.168.31.25/ontrack'>Erassets</a><br>
							<br>
							<br>
							<br>
							regards, <br>
							IT Ticketing Admin <br>
					   
						   ";
			
				$mail->msgHTML("$text");
				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';
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
			
		}