<?php	
date_default_timezone_set('Asia/Jakarta');
//include "../../funlibs.php";
require "PHPMailerAutoload.php";

session_start();
 
 //echo "jem";
 //die;
 		//$jmldetail=$con->select("pj_penjualan_dtl a join m_barang b on a.id_barang=b.id_barang join m_satuan c on b.id_satuan=c.id_satuan","a.id_dtl_jual,a.id_barang,b.kode_barang,b.nama_barang,c.nama_satuan,a.harga_jual,a.dtl_total,a.qty_jual","a.id_pj='$_GET[id]'");				
					
$con=new Database();

	// $tabel = "trdata";
	// $fild  = "*"; 
	// $where = "email_data ='$smail[email_data]'";
	// $data=$con->select($tabel,$fild,$where);
	// //var_dump($data);
	// //die;
	// foreach($data as $val){}
	// //echo $val['EMAIL'];
	// //die;
	if ($_POST['kode'] != ''){
		//echo "a";
		//echo $_POST['kode'];
		$getek = $_POST['kode'];
	} else {
		//echo "b";
		//echo $idtasks;
		$getek = $idtasks;
	}
	//die;
        $jmldetail=$con->select("trtasks a  
        	left join mtagent d on a.id_agent = d.id_agent 
        	left join mtpegawai e on d.id_pegawai = e.id_pegawai
        	left join mtkategori f on a.id_kategori=f.id_kategori",
        	"a.*,e.nama_pegawai,f.nama_kategori",
        	"a.id_tasks='$getek'");   
       
        $no=1;
        foreach($jmldetail as $d){}                     
                        if ($d['status_tasks'] == '1'){
                          $statuse = "OPEN";
                        } else if ($d['status_tasks'] == '2'){
                          $statuse = "ON PROGRESS";
                        } else if ($d['status_tasks'] == '3'){
                          $statuse = "HOLD";
                        } else if ($d['status_tasks'] == '4'){
                          $statuse = "CLOSED";
                        } else if ($d['status_tasks'] == '5'){
                          $statuse = "HOLD REQUEST";
                        } else if ($d['status_tasks'] == '6'){
                          $statuse = "ASSIGNED";
                        } else if ($d['status_tasks'] == '0'){
                          $statuse = "REJECT";
                        }

                        if ($d['priority_tasks'] == '1'){
                          $prio = "Low";
                        } else if ($d['priority_tasks'] == '2'){
                          $prio = "Middle";
                        } else if ($d['priority_tasks'] == '3'){
                          $prio = "High";
                        } 
     // echo "select a.*,b.nama_dept from trdata a left join mtdept b on a.departemen_data=b.id_dept where a.no_ticket='$idgen'";            
   		
   								     
        $asign=$con->select("(
        	select d.id_agent as agent,e.email as email,e.nama_pegawai as nama FROM
			mtagent d left join mtpegawai e on d.id_pegawai = e.id_pegawai
			left join mauser_login f on e.id_pegawai = f.id_pegawai
     		where f.ID_ROLE = '1' and f.STATUS = '1') as b","agent,email,nama"); 
   //   		echo  "select agent,email,nama from (select '' as agent,a.email_data as email,nama_data as nama FROM
			// trdata a left join mtdept b on a.departemen_data=b.id_dept
   //      	left join trwo c on a.id_data = c.id_data 
   //      	left join mtagent d on c.id_agent = d.id_agent 
   //      	left join mtpegawai e on d.id_pegawai = e.id_pegawai
   //      	where a.id_data='$_POST[iddata]'
   //      	union
   //      	select d.id_agent as agent,e.email as email,e.nama_pegawai as nama FROM
			// mtagent d left join mtpegawai e on d.id_pegawai = e.id_pegawai
   //   		where d.id_agent='$_POST[assign]') as b";
   //   		die;
       
        foreach($asign as $is){
        
			if ($is['email'] != ''){
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
					$mail->Password = "Veritasertx";
					//Set who the message is to be sent from
					$mail->setFrom('sby-helpdesk@eratex.co.id', 'IT Ticketing Eratex Djaja ,Tbk');
					//Set an alternative reply-to address
					$mail->addReplyTo('sby-helpdesk@eratex.co.id', 'IT Ticketing Eratex Djaja ,Tbk');
					//Set who the message is to be sent to
					$mail->addAddress($is['email'] ,$is['nama']);
					//Set the subject line
						$mail->Subject = 'Tasks No.'.$d['no_tasks'].' : '.$statuse;
						$text="Tasks $d[no_tasks] status $statuse and Priority $prio, here's the details : <br>
							<br>
								<table width='50%' cellpadding='0' cellspacing='0' border='0'>                   
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Tasks No</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$d[no_tasks]</strong></td>
								  </tr>
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Name</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$d[nama_tasks]</strong></td>
								  </tr>
								  <tr style='padding:5%;'>
								    <td align='left' width='20%'><strong>Category</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'><strong>$d[nama_kategori]</strong></td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Created Date</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$d[created_date_tasks]</td>
								  </tr>
								   <tr>
								    <td align='left'><strong>Start Date</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$d[start_date_tasks]</td>
								  </tr>
								   <tr>
								    <td align='left'><strong>End Date</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$d[end_date_tasks]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>PIC</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$d[nama_pegawai]</td>
								  </tr>
								  <tr>
								    <td align='left'><strong>Remark</strong></td>
								    <td align='left' width='2%'>:</td>
								    <td align='left'>$d[remark_tasks]</td>
								  </tr>
								 
								</table>
 
							 <br>
							<br>
							View Tasks Click <a href='http://192.168.31.35/eraticket/content.php?p=ta2&d=$d[id_tasks]&e=1'>Here</a>
							<br>
							<br>
							<br>
							regards, <br>
							IT Ticketing Admin <br>
					   
						   ";	
					//$isian = include 'detail_email.php';
						
					$mail->msgHTML("$text");
					//Replace the plain text body with one created manually
					$mail->AltBody = 'This is a plain-text message body';
					//Attach an image file
					//$mail->addAttachment('images/phpmailer_mini.png');
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
			else if ($d['email_data'] == ''){
				$row_set[] = array("status"=>"Email Tidak Ditemukan");
				//echo json_encode($row_set);
				//echo $_GET['callback']."(".json_encode($row_set).")";

			}
}
