<?php	

date_default_timezone_set('Asia/Jakarta');
include "../../funlibs.php";
require "PHPMailerAutoload.php";

session_start();
 
 //echo "jem";
 //die;
 		//$jmldetail=$con->select("pj_penjualan_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.id_dtl_jual,a.id_barang,b.kode_barang,b.nama_barang,c.nama_satuan,a.harga_jual,a.dtl_total,a.qty_jual","a.id_pj='$_GET[id]'");				
					
$con=new Database();
		//departemen
		//foreach($con->select("clients","name","id = '$_POST[depnew]'") as $dpt){}
		foreach($con->select("locations a join clients b on a.clientid=b.id","a.clientid,b.name as namedept,a.name as locationname,a.peopleid as appid","a.id = '$_POST[depnew]'") as $dpt){}

		if($_POST['typereq'] == 1) {$ctn = "Permintaan Akun"; $preq = "newrequestacc";}
		else if($_POST['typereq'] == 2) {$ctn = "Izin Akses Data"; $preq = "newrequestaci";}
		else if($_POST['typereq'] == 4) {$ctn = "Penutupan Akun"; $preq = "newrequestacp";}

        //$asign=$con->select("people","email","id in (1,2)");   
        $expmail = explode(';', $dpt['appid']);
        $jmlappid = count($expmail);
        for($i=0;$i<$jmlappid;$i++){
        	//echo $expmail[$i];

        	foreach($con->select("people","name,email","id = '$expmail[$i]'") as $appname){}
        //foreach($asign as $is){
			if ($appname['email'] != ''){
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
				$mail->addAddress($appname['email'] ,$appname['name']);
				//Set the subject line
				$mail->Subject = 'Form Request '.$ctn.' : '.$_POST['namepeople'].'';
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
								  <tr>
								    <td align='left' width='20%'><strong>No Req</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$norequest</strong></td>
								  </tr>
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Name</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$_POST[namepeople]</strong></td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Dept</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$dpt[namedept] - $dpt[locationname]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Jabatan</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$_POST[jabatan]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Created Date</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$date</td>
								  </tr>
								  
								</table>

							 <br>
							<br>
							Please Approve this Request follow <a href='http://192.168.31.25/eraticket/login.php'>Link</a>, check request list of <strong>$_POST[namepeople]</strong> then click approve (Orange Color button).<br> You can track progress of this request regularly through <a href='http://192.168.31.25/eraticket/index.php?x=viewnewreq&d=$exec6'>Link</a>.
							
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

	}
	
		foreach($kk as $akk => $vals){
		//foreach($asign as $is){
			if ($vals != ''){
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
				$mail->addAddress($vals);
				//Set the subject line
				$mail->Subject = 'Form Request '.$ctn.' : '.$_POST['namepeople'].'';
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
					$text="New Form Request ".$ctn." Created, here's the details : <br>
							<br>
								<table width='50%' cellpadding='0' cellspacing='0' border='0'>                   
								  <tr>
								    <td align='left' width='20%'><strong>No Req</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$norequest</strong></td>
								  </tr>
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Name</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$_POST[namepeople]</strong></td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Dept</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$dpt[namedept] - $dpt[locationname]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Jabatan</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$_POST[jabatan]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Created Date</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$date</td>
								  </tr>
								  
								</table>

							 <br>
							 You can check new request <a href='http://192.168.31.25/eraticket/index.php?x=viewnewreq&d=$exec6'>Link</a>
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
		}	
// <br><br>
// here's the Guide:
// <br>
// 1. Login. <br>
// 2. Check Request List ( <strong>$_POST[namepeople]</strong> ). <br>
// 3. Click Please Approve with orange colors. <br>
// 4. Click Approve.