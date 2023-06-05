<?php 
error_reporting(0);
$date = date("Y-m-d H:i:s");
$date2 = date("Y-m-d_G-i-s");
$dateid = date("ymd");
$tabel = "trdata";
$problem = trim($_POST['problem']);
$analisis = trim($_POST['analisis']);
$solusi = trim($_POST['solusi']);
$refeedback = trim($_POST['remark_feedback']);
$redata = trim($_POST['remark_data']);
$reprowo = trim($_POST['remark_problem_wo']);
$noteagen = trim($_POST['noteagent']);
$selwos = $con->select("trwo","sla_date_wo","id_wo = $_POST[kode]");
foreach ($selwos as $wos) {}

if($_POST['jenis'] == 'edit') {
	if($_POST['status_wo'] == '4'){
		$data = array (
		'status_data' => $_POST['status_wo'],
		'dateupdate_data' => $date,
		'closed_date_data' => $date,
		);
		$exec = $con->update($tabel,$data,"id_data = '$_POST[iddata]'");
		if ($_POST['addkatop'] != ''){
			$idkattop = $con->idurut("mtkategoritopik","id_kattopik");
			$datatop = array (
			'id_kattopik' => $idkattop,
			'nama_kattopik' => $_POST['addkatop'],
			'status_kattopik' => 1,
			'dateupdate_kattopik' => $date,
			'jenis_kattopik' => 2,
			);
			$exec = $con->insert("mtkategoritopik",$datatop);

			$selkattopik = $con->select("mtkategoritopik","id_kattopik","","id_kattopik DESC","1");
			foreach ($selkattopik as $sktp) {}

			$idtop = $con->idurut("mttopik","id_topik");
			$datatop = array (
			'id_topik' => $idtop,
			'problem' => $problem,
			'analisis' => $analisis,
			'solusi' => $solusi,
			'status_topik' => 1,
			'id_wo' => $_POST['kode'],
			'id_kattopik' => $sktp['id_kattopik'],
			'jenis_topik' => 2,
			);
			$exec = $con->insert("mttopik",$datatop);
		} else {
			$idtop = $con->idurut("mttopik","id_topik");
			$datatop = array (
			'id_topik' => $idtop,
			'problem' => $problem,
			'analisis' => $analisis,
			'solusi' => $solusi,
			'status_topik' => 1,
			'id_wo' => $_POST['kode'],
			'id_kattopik' => $_POST['katop'],
			'jenis_topik' => 2,
			);
			$exec = $con->insert("mttopik",$datatop);
		} 
		
		$data5 = array (
		'status' => "Closed", 
		);
		$exec5 = $con2->update("tickets",$data5,"ticket = '$_POST[notiket]'");

	} else {
		$data = array (
		'status_data' => $_POST['status_wo'],
		'dateupdate_data' => $date,
		);
		$exec = $con->update($tabel,$data,"id_data = '$_POST[iddata]'");

		if($_POST['status_wo'] == 2){
			$statusontrack = "On Progress";
		} else if($_POST['status_wo'] == 3){
			$statusontrack = "Hold";
		} else {
			$statusontrack = "Assigned";
		}

		$data5 = array (
		'status' => $statusontrack, 
		);
		
		$exec5 = $con2->update("tickets",$data5,"ticket = '$_POST[notiket]'");
		
	}	

	if($_POST['assign'] != ''){
		$data3 = array (
		'priority_wo' => $_POST['priority'],
		'dateupdate_wo' => $date,
		'id_agent' => $_POST['assign'],
		);

		foreach($con->select("mtagent","id_people_ontrack","id_agent = '$_POST[assign]'") as $admontrack){}
		$data5 = array (
		'adminid' => $admontrack['id_people_ontrack'],  
		);
		$exec5 = $con2->update("tickets",$data5,"ticket = '$_POST[notiket]'");

	} else {
		$data3 = array (
		'priority_wo' => $_POST['priority'],
		'dateupdate_wo' => $date,
		);
	}
	$exec3 = $con->update("trwo",$data3,"id_wo = '$_POST[kode]'");

	if ($wos['sla_date_wo'] == ''){
		// $datasla = array (
		// 'dateupdate_sla' => $date,
		// 'jenis_sla' => $_POST['stsla2'],
		// );
		// $execsla = $con->insert("trsla",$datasla);
		$dataslas = array (
		'sla_date_wo' => $date,
		);
		$execslas = $con->update("trwo",$dataslas,"id_wo = '$_POST[kode]'");
	} 

	if ($_POST['remark_feedback'] != ''){
		$idfeed = $con->idurut("trfeedback","id_feedback");
		$data2 = array (
		'id_feedback' => $idfeed,
		'id_wo' => $_POST['kode'],
		'remark_feedback' => $refeedback,
		'dateupdate_feedback' => $date,
		);
		
		$exec2 = $con->insert("trfeedback",$data2);
	}


	//include "phpmailer/pushemail.php";
	//die;
	echo "<script>window.location='content.php?p=$_POST[getp]'</script>";

} else {
	$seldepart = $con->select("mtdept","inisial_dept","id_dept = '$_POST[dep]'");
			foreach ($seldepart as $depart) {}
			$inidept = $depart['inisial_dept'];

	$idgen=$con->nourut('no_ticket', 'trdata', $dateid, $inidept, date('Y-m-d'));

	$iddata = $con->idurut($tabel,"id_data");
	$data = array ( 
	 'id_data' => $iddata,
	 'no_ticket' => "Bypass-".$idgen,
	 'nama_data' => $_POST['nama'],
	 'departemen_data' => $_POST['dep'],
	 'asetid_data' => $_POST['asetid'],
	 'email_data' => $_POST['email'],
	 'remark_data' => $reprowo,
	 'dateupdate_data' => $date,
	 'created_date_data' => $date,
	 'status_data' => 2,
	); 
	$exec= $con->insert($tabel, $data);

	$idwo = $con->idurut("trwo","id_wo");
	$data2 = array (
	'id_wo' => $idwo,
	'id_data' => $iddata,
	'id_req' => '0',
	'no_ticket' => 'Bypass WO',
	'id_kategori' => $_POST['kategori'],
	'id_agent' => $_POST['assign'],
	'note_agent' => $noteagen,
	'created_date_wo' => $date,
	'dateupdate_wo' => $date,
	'jenis_wo' => '2',
	'priority_wo' => $_POST['priority'],
	);

	$exec2 = $con->insert("trwo",$data2);

	if ($_POST['remark_feedback'] != ''){
		$idfeed = $con->idurut("trfeedback","id_feedback");
		$data3 = array (
		'id_feedback' => $idfeed,
		'id_wo' => $idwo,
		'remark_feedback' => $refeedback,
		'dateupdate_feedback' => $date,
		);
		//var_dump($data3);
		$exec3 = $con->insert("trfeedback",$data3);
	}
	include "phpmailer/pushemailadmin.php";
	//die;
	echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
}
?>
