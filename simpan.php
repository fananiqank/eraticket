<?php	

	//error_reporting(1);
	require_once "funlibs.php";
	$con = new Database();
	
	// require_once "funlibs2.php";
	// $con2 = new Database2();

	$date = date("Y-m-d H:i:s");
	$datej = date("Y-m-d");
	$dateid = date("ymd");
	if($_POST['statuspost'] == 1){
		if($_POST['idasetontrack'] == ''){
			echo "<script>alert('Not Saved! Asset ID Not Found')</script>";
			echo "<script>window.location='index.php'</script>";
		} else {

			 $seldepart = $con->select("clients","inisial_client","id = '$_POST[dep]'");
			 foreach ($seldepart as $depart) {}
			 	$inidept = $depart['inisial_client'];

			 	//$idgen=$con->nourut('tickets', 'ticket', $dateid, $inidept, date('Y-m-d'));

				foreach($con->select("tickets","count(id) jumreq","DATE(timestamp) = DATE(now())") as $jumreq){}
				$jumurut = $jumreq['jumreq']+1;
				$idgen = $inidept."/".$dateid."/".sprintf("%03s", $jumurut);
				
				$image   = file_get_contents($_FILES['imgprob']['tmp_name']);
			    $image_name = $_FILES['imgprob']['name'];
			    $image_size = $_FILES['imgprob']['size'];
			    $image_type = $_FILES['imgprob']['type'];
		if($image_name != ""){
			if ($image_size < 2048000 and ($image_type =='image/jpeg' or $image_type == 'image/png' or $image_type =='image/jpg'))
        		{
		//input ke ontract
					$data3 = array( 
								'ticket' => $idgen,
								'departmentid' => 1,
								'clientid' => $_POST['depontrack'],
								'userid' => $_POST['user_id'],
								'adminid' => 0,
								'assetid' => $_POST['idasetontrack'],
								'projectid' => 0,
								'email' => $_POST['email'],
								'subject' => $_POST['remark'],
								'status' => 'Open',
								'priority' => 'Normal',
								'timestamp' => $date,
								'timespent' => 0,
								'reported' => $_POST['report_name'],
								'reported_ip' => $_POST['compid'],
								'ticketroom' => $_POST['ticketroom'],
								'typeasset' => 1,
								'reported_email' => $_POST['report_email'],
								'typeticket' => 1,
								'notes' => $_POST['remark'],
								'ccs' => '',
								'slaid' => 2,
								'ticketimg' => $image,
								'ticketimgtype' => $image_type
							); 
					//var_dump($data3);
					//die();
					$exec3= $con->insertID("tickets", $data3);
					$data4 = array( 
								'ticketid' => $exec3,
								'peopleid' => $_POST['user_id'],
								'message' => $_POST['remark'],
								'timestamp' => $date,
								'typereplies' => 1,
								'statusreplies' => 'Open',
								'ipaddress' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
							); 
					$exec4= $con->insert("tickets_replies", $data4);
		//end input ke ontract

					include "lib/phpmailer/pushemailticket.php";
					//die();		
					if($exec3){
						echo "<script>alert('No Ticket : $idgen')</script>";  
						echo "<script>window.location='index.php'</script>";  
					} else {
						echo "<script>alert('Not Saved')</script>"; 
						echo "<script>window.location='index.php'</script>";  
					}
				} else {
					echo "<script>alert('Not Saved! Image size is too large / Image type not supported')</script>";
					echo "<script>window.location='index.php'</script>"; 
				}
		} else {
			$data3 = array( 
						'ticket' => $idgen,
						'departmentid' => 1,
						'clientid' => $_POST['depontrack'],
						'userid' => $_POST['user_id'],
						'adminid' => 0,
						'assetid' => $_POST['idasetontrack'],
						'projectid' => 0,
						'email' => $_POST['email'],
						'subject' => $_POST['remark'],
						'status' => 'Open',
						'priority' => 'Normal',
						'timestamp' => $date,
						'timespent' => 0,
						'reported' => $_POST['report_name'],
						'reported_ip' => $_POST['compid'],
						'ticketroom' => $_POST['ticketroom'],
						'typeasset' => 1,
						'reported_email' => $_POST['report_email'],
						'typeticket' => 1,
						'notes' => $_POST['remark'],
						'ccs' => '',
						'slaid' => 2
					); 
					$exec3= $con->insertID("tickets", $data3);
					$data4 = array( 
						'ticketid' => $exec3,
						'peopleid' => $_POST['user_id'],
						'message' => $_POST['remark'],
						'timestamp' => $date,
						'typereplies' => 1,
						'statusreplies' => 'Open',
						'ipaddress' => gethostbyaddr($_SERVER['REMOTE_ADDR']),
					); 
					$exec4= $con->insert("tickets_replies", $data4);
		//end input ke ontract

					include "lib/phpmailer/pushemailticket.php";
					//die();		
					if($exec3){
						echo "<script>alert('No Ticket : $idgen')</script>";  
						echo "<script>window.location='index.php'</script>";  
					} else {
						echo "<script>alert('Not Saved')</script>"; 
						echo "<script>window.location='index.php'</script>";  
					}
		}
			    
		}
	} else if($_POST['statuspost'] == 2) {
		foreach($con->select("locations","peopleid","id = '$_POST[depnew]'") as $cekhead){}
		if($cekhead['peopleid'] == ''){
			echo "<script>alert('Failed!! Dept. Head belum di Set, Anda dapat menghubungi IT')</script>"; 
			echo "<script>window.location='index.php?x=newreq'</script>";  
		} else {
			if(strtoupper($_POST['nogm']) == '0'){
				echo "<script>alert('Failed!! No Pegawai harus sesuai dengan Payroll')</script>"; 
				echo "<script>window.location='index.php?x=newreq'</script>";  
			} else {
				//if($_POST['typereq'] == 1) {
					if($_POST['tglbutuh1'] == '') {
						$tglbutuh1 = $datej;
						$tglbutuh2 = NULL;
					} else {
						$tglbutuh1 = $_POST['tglbutuh1'];
						$tglbutuh2 = $_POST['tglbutuh2'];
					}
				//echo $tglbutuh1."_".$tglbutuh2;
				//die();
					for($i=1;$i<=$_POST['jmlakunminta'];$i++){
						$coy = $_POST['akun'.$i]; 
						if($coy){
						$vb[].= $coy;
						
						}
					}
					$vv = implode(";",$vb);

		//mendapatkan email PIC		
					foreach($vb as $key => $val){
						//echo $val;
						foreach($con->select("akunminta","peopleid","idakunminta = '$val'") as $am){
							$vm[].= $am[peopleid];
						}
					}
					$vx = implode(";",$vm);
					$exvx = explode(";", $vx);
					$jj = array_unique($exvx);
					
					foreach($jj as $key => $val){
						foreach($con->select("people","email","id = '$val'") as $aemail){}
							$kk[].= $aemail['email'];
					}
		//=====================

		//mendapatkan aset dari pemohon
					for($y=1;$y<=$_POST['jumaset'];$y++){
						$ciy = $_POST['idaset'.$y]; 
						if($ciy){
							$vc[].= $ciy;
						}
					}
					$pp = implode(";",$vc);
		//=============================
					
					if($_POST['typereq'] == 1){ $alasbut = $_POST['alasanbutuh1']; $headin="P/"; }
					else if($_POST['typereq'] == 2){ $alasbut = $_POST['alasanbutuh2']; $headin="I/"; }
					else if($_POST['typereq'] == 4){ $alasbut = $_POST['alasanbutuh2']; $headin="T/"; }
					
			//norequest permintaan
					foreach($con->select("locations","clientid","id = '$_POST[depnew]'") as $deptid){}
					$seldepart = $con->select("clients","inisial_client","id = '$deptid[clientid]'");
					foreach ($seldepart as $depart) {}
					$inidept = $depart['inisial_client'];
					foreach($con->select("people_dtl_request","count(id) jumreq","DATE(created_date) = DATE(now())") as $jumreq){}
					$jumurut = $jumreq['jumreq']+1;
					// $norequest=$con->nourut('people_dtl_request','id', $dateid, $headin.$inidept, date('Y-m-d'));
					$norequest = $headin.$inidept."/".$dateid."/".sprintf("%03s", $jumurut);
					
					if($_POST['approvetype'] > 0) {
						$hdstatus = "Approve";
						$hdpeopleid = $_POST['peopleid'];
						$hdnotes = "Head Approve";
						$hddate = date("Y-m-d H:i:s");
						$stid = "Approve";
					} else {
						$hdstatus = NULL;
						$hdpeopleid = NULL;
						$hdnotes = NULL;
						$hddate = NULL;
						$stid = "Request";
					}
					//die();

					if($_POST['jenispermin'] == 1 && $_POST['trep'] == 2){

						$data6 = array( 
								'peopleid' => $_POST['peopleid'],
								'typereq' => $_POST['typereq'],
								'nogm' => strtoupper($_POST['nogm']),
								'clientid' => $deptid['clientid'],
								'title' => $_POST['jabatan'],
								'mobile' => $_POST['mobile'],
								'websiteakses' => $_POST['websiteakses'],
								'tgl_butuh1' => $tglbutuh1,
								'tgl_butuh2' => $tglbutuh2,
								'akunakses' => $vv,
								'alasanbutuh' => $alasbut,
								'statusid' => $stid,
								'assetid' => $pp,
								'hasilpengecekanaset' => $_POST['notescek'],
								'ipaddress_reported' => $_POST['ipaddressreport'],
								'locationid' => $_POST['depnew'],
								'norequest' => $norequest
							); 
						
						 $exec6= $con->insertID("people_dtl_request", $data6);

						 $data8 = array( 
									'peopledtlid' => $exec6,
									'headpeopleid' => $hdpeopleid,
									'headnotes' => $hdnotes,
									'headappdate' => $hddate,
									'headstatus' => $hdstatus,
								); 
						 $exec8= $con->insertID("people_dtl_approve", $data8);

					} else {
			//New people not replace
						if($_POST['typereq'] == 1 && $_POST['trep'] == 2 ){
							$data5 = array( 
									'type' => 'user',
									'roleid' => '2',
									'clientid' => $deptid['clientid'],
									'nogm' => strtoupper($_POST['nogm']),
									'name' => strtoupper($_POST['namepeople']),
									'email' => '',
									'password' => 'a48a49bf2d9071db4f458f73da855f1874e8b5f0',
									'theme' => 'skin-blue',
									'sidebar' => 'opened',
									'autorefresh' => '0',
									'lang' => 'en',
									'ticketsnotification' => '0',
									'title' => $_POST['jabatan'],
									'websiteakses' => $_POST['websiteakses'],
									'tgl_butuh1' => $tglbutuh1,
									'tgl_butuh2' => $tglbutuh2,
									'akunakses' => $vv,
									'alasanbutuh' => $alasbut,
									'statusid' => 'Request',
									'mobile' => $_POST['mobile'],
									'locationid' => $_POST['depnew'],
								); 
							$exec5= $con->insertID("people", $data5);

							$data6 = array( 
									'peopleid' => $exec5,
									'typereq' => $_POST['typereq'],
									'nogm' => strtoupper($_POST['nogm']),
									'clientid' => $deptid['clientid'],
									'title' => $_POST['jabatan'],
									'mobile' => $_POST['mobile'],
									'websiteakses' => $_POST['websiteakses'],
									'tgl_butuh1' => $tglbutuh1,
									'tgl_butuh2' => $tglbutuh2,
									'akunakses' => $vv,
									'alasanbutuh' => $alasbut,
									'statusid' => 'Request',
									'assetid' => $pp,
									'hasilpengecekanaset' => $_POST['notescek'],
									'ipaddress_reported' => $_POST['ipaddressreport'],
									'locationid' => $_POST['depnew'],
									'norequest' => $norequest
								); 
							$exec6= $con->insertID("people_dtl_request", $data6);

							$data8 = array( 
									'peopledtlid' => $exec6,
									'headpeopleid' => $hdpeopleid,
									'headnotes' => $hdnotes,
									'headappdate' => $hddate,
									'headstatus' => $hdstatus,
								); 
							$exec8= $con->insertID("people_dtl_approve", $data8);	
						} 
			//Replacement
						else if ($_POST['typereq'] == 1 && $_POST['trep'] == 1) {
							$data5 = array( 
									'type' => 'user',
									'roleid' => '2',
									'clientid' => $deptid['clientid'],
									'nogm' => strtoupper($_POST['nogm2']),
									'name' => strtoupper($_POST['namepeople']),
									'email' => '',
									'password' => 'a48a49bf2d9071db4f458f73da855f1874e8b5f0',
									'theme' => 'skin-blue',
									'sidebar' => 'opened',
									'autorefresh' => '0',
									'lang' => 'en',
									'ticketsnotification' => '0',
									'title' => $_POST['jabatan'],
									'websiteakses' => $_POST['websiteakses'],
									'tgl_butuh1' => $tglbutuh1,
									'tgl_butuh2' => $tglbutuh2,
									'akunakses' => $vv,
									'alasanbutuh' => $alasbut,
									'statusid' => 'Request',
									'mobile' => $_POST['mobile'],
									'locationid' => $_POST['depnew'],
								); 
							//	var_dump($data5);
							//	die();
							$exec5= $con->insertID("people", $data5);

							$data6 = array( 
									'peopleid' => $exec5,
									'typereq' => $_POST['typereq'],
									'nogm' => strtoupper($_POST['nogm2']),
									'clientid' => $deptid['clientid'],
									'title' => $_POST['jabatan'],
									'mobile' => $_POST['mobile'],
									'websiteakses' => $_POST['websiteakses'],
									'tgl_butuh1' => $tglbutuh1,
									'tgl_butuh2' => $tglbutuh2,
									'akunakses' => $vv,
									'alasanbutuh' => $alasbut,
									'statusid' => 'Request',
									'assetid' => $pp,
									'hasilpengecekanaset' => $_POST['notescek'],
									'ipaddress_reported' => $_POST['ipaddressreport'],
									'locationid' => $_POST['depnew'],
									'norequest' => $norequest
								); 
							$exec6= $con->insertID("people_dtl_request", $data6);

							$data8 = array( 
									'peopledtlid' => $exec6,
									'headpeopleid' => $hdpeopleid,
									'headnotes' => $hdnotes,
									'headappdate' => $hddate,
									'headstatus' => $hdstatus,
								); 
							$exec8= $con->insertID("people_dtl_approve", $data8);
					
							//reference replace
							$dat=$con->select("(select a.name,a.id,a.email,a.nogm,
							case when IFNULL(b.clientid,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01')  then b.clientid else a.clientid end clientid,
							case when IFNULL(b.title,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01') then b.title else a.title end as title,
							case when IFNULL(b.mobile,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01') then b.mobile else a.mobile end as mobile,
							case when IFNULL(b.locationid,'0')<>'0' and b.created_date > IFNULL(a.modify_date,'1970-01-01 01:01:01') then b.locationid else a.locationid end as locationid,
							approval_type,a.akunakses from people a left join (select clientid,title,mobile,locationid,a.peopleid,a.created_date 
							from people_dtl_request a join (select peopleid,max(id) as id from people_dtl_request GROUP BY peopleid) b on a.id=b.id) b 
							on a.id=b.peopleid where a.nogm = '$_POST[nogm]' and a.statusid = 'Active') a","*","");
		    				foreach($dat as $row){}

		    		//norequest penutupan			
					foreach($con->select("people_dtl_request","count(id) jumreq","DATE(created_date) = DATE(now())") as $jumreq){}
					$jumurut = $jumreq['jumreq']+1;
					$norequest = $headin.$inidept."/".$dateid."/".sprintf("%03s", $jumurut);

							$data9 = array( 
									'peopleid' => $row['id'],
									'typereq' => 4,
									'nogm' => strtoupper($_POST['nogm']),
									'clientid' => $row['clientid'],
									'title' => $row['title'],
									'mobile' => $row['mobile'],
									'websiteakses' => $_POST['websiteakses'],
									'tgl_butuh1' => $tglbutuh1,
									'tgl_butuh2' => $tglbutuh2,
									'akunakses' => $row['akunakses'],
									'alasanbutuh' => "Penutupan Akun",
									'statusid' => 'Request',
									'assetid' => $pp,
									'hasilpengecekanaset' => $_POST['notescek'],
									'ipaddress_reported' => $_POST['ipaddressreport'],
									'locationid' => $row['locationid'],
									'peopledtlidparent' => $exec6,
									'norequest' => $norequest
								); 
							$exec9= $con->insertID("people_dtl_request", $data9);

							$data10 = array( 
									'peopledtlid' => $exec9,
									'headpeopleid' => $hdpeopleid,
									'headnotes' => $hdnotes,
									'headappdate' => $hddate,
									'headstatus' => $hdstatus,
								); 
							$exec10= $con->insertID("people_dtl_approve", $data10);

						}
						//penutupan akun
						else if($_POST['typereq'] == 4 && $_POST['jenispermin'] == 4){
							if($_POST['peopleidreference'] != ''){$pparent = $_POST['peopleidreference'];}else{$pparent=0;}
							$data6 = array( 
								'peopleid' => $_POST['peopleid'],
								'typereq' => $_POST['typereq'],
								'nogm' => strtoupper($_POST['nogm']),
								'clientid' => $deptid['clientid'],
								'title' => $_POST['jabatan'],
								'mobile' => $_POST['mobile'],
								'tgl_butuh1' => date('Y-m-d'),
								'akunakses' => $vv,
								'alasanbutuh' => $alasbut,
								'statusid' => $stid,
								'assetid' => $pp,
								'hasilpengecekanaset' => $_POST['notescek'],
								'ipaddress_reported' => $_POST['ipaddressreport'],
								'locationid' => $_POST['depnew'],
								'peopleidparent' => $pparent,
								'norequest' => $norequest
							); 
						 	$exec6= $con->insertID("people_dtl_request", $data6);

							$data8 = array( 
										'peopledtlid' => $exec6,
										'headpeopleid' => $hdpeopleid,
										'headnotes' => $hdnotes,
										'headappdate' => $hddate,
										'headstatus' => $hdstatus,
									); 
							$exec8= $con->insertID("people_dtl_approve", $data8);
							
						}
					}

					if($_POST['typereq'] == 2 && $_POST['jenispermin'] == 2) {
							$data6 = array( 
									'peopleid' => $_POST['peopleid'],
									'typereq' => $_POST['typereq'],
									'nogm' => strtoupper($_POST['nogm']),
									'clientid' => $deptid['clientid'],
									'title' => $_POST['jabatan'],
									'mobile' => $_POST['mobile'],
									'websiteakses' => $_POST['websiteakses'],
									'tgl_butuh1' => $tglbutuh1,
									'tgl_butuh2' => $tglbutuh2,
									'akunakses' => '15',
									'alasanbutuh' => $alasbut,
									'statusid' => 'Request',
									'assetid' => $pp,
									'hasilpengecekanaset' => $_POST['notescek'],
									'ipaddress_reported' => $_POST['ipaddressreport'],
									'locationid' => $_POST['depnew'],
									'norequest' => $norequest
								); 
							$exec6= $con->insertID("people_dtl_request", $data6);

							$data8 = array( 
									'peopledtlid' => $exec6,
									'headpeopleid' => $hdpeopleid,
									'headnotes' => $hdnotes,
									'headappdate' => $hddate,
									'headstatus' => $hdstatus,
								); 
							$exec8= $con->insertID("people_dtl_approve", $data8);

						foreach($con->select("people_izinakses_tmp","*","ipaddress = '$_POST[ipaddressreport]'") as $colik){
							$data7 = array(
										'peopledtlid' => $exec6,
										'filefolder' => $colik['filefolder'],
										'lokasi' => $colik['lokasi'],
										'remark' => $colik['remark'],
										'assetid' => $colik['assetid'],
										'hak_akses' => $colik['hak_akses'],
										'locationid' => $colik['locationid'],
									);
							
							$exec7 = $con->insertID("people_izinakses",$data7);
						}

						$where7 = array('ipaddress' => $_POST[ipaddressreport]);
						$con->delete("people_izinakses_tmp",$where7);
					}
					
					
				//==========
				
				//die();
				if($exec6){
					if($_POST['approvetype'] > 0) {
						include "lib/phpmailer/pushemailapphead2.php";
					} else {
						include "lib/phpmailer/pushemailnewreq.php";
					}
					echo "<script>alert('Success silahkan hubungi IT')</script>";  
					echo "<script>window.location='index.php?x=viewnewreq'</script>";  
				} else {
					echo "<script>alert('Not Saved')</script>"; 
					echo "<script>window.location='index.php?x=newreq'</script>";  
				}
			}
		}
	} 

