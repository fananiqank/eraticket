<?php 
error_reporting(0);
$date = date("Y-m-d H:i:s");
$date2 = date("Y-m-d_G-i-s");
$dateid = date("ymd");
$tabel = "trtasks";
$retasks = trim($_POST['remark_tasks']);
$refeedback = trim($_POST['remark_feedback']);

if($_POST['start_date'] != ''){
	$startdate = date("Y-m-d H:i:s",strtotime($_POST['start_date']));
} else {
	$startdate = '';
}

if($_POST['end_date'] != '') {
	$enddate = date("Y-m-d H:i:s",strtotime($_POST['end_date']));
} else {
	$enddate = '';	
}

//echo $_POST['status_tasks'];
if($_POST['jenis'] == 'edit') {
	if($_POST['status_tasks'] == '4'){
		$data = array (
		'priority_tasks' => $_POST['priority'],
		'status_tasks' => $_POST['status_tasks'],
		'dateupdate_tasks' => $date,
		'closed_date_tasks' => $date,
		);
	} else {
		if ($_POST['stopen'] == 1 && $sopen = $_POST['status_tasks'] == '') {
			$sopen = 1;
		} else {
			$sopen = $_POST['status_tasks'];
		}
		$data = array (
		'priority_tasks' => $_POST['priority'],
		'status_tasks' => $sopen,
		'dateupdate_tasks' => $date,
		'start_date_tasks' => $startdate,
		'end_date_tasks' => $enddate,
		);
		//var_dump($data);
	}	
	//die();
	$exec = $con->update($tabel,$data,"id_tasks = '$_POST[kode]'");

	if($_POST['remark_tasks'] != ''){
		$idfeed = $con->idurut("trfeedback","id_feedback");
		$data2 = array (
		'id_feedback' => $idfeed,
		'id_tasks' => $_POST['kode'],
		'remark_feedback' => $retasks,
		'dateupdate_feedback' => $date,
		);
		
		$exec2 = $con->insert("trfeedback",$data2);
	}
	include "phpmailer/pushemail.php";
	//die;
	echo "<script>window.location='content.php?p=$_POST[getp]'</script>";

} else {
	if ($_POST['start_date'] == ''){
		echo "<script>alert('Start Date Harus di isi')</script>";
		echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
	} else {
		$seldepart = $con->select("mtdept","inisial_dept","id_dept = '1'");
				foreach ($seldepart as $depart) {}
				$inidept = $depart['inisial_dept'];

		$idgentask=$con->nourut('no_tasks', $tabel, $dateid, 'TAS', date('Y-m-d'));

		$idtasks = $con->idurut($tabel,"id_tasks");
		$data = array ( 
		 'id_tasks' => $idtasks,
		 'no_tasks' => $idgentask,
		 'nama_tasks' => $_POST['nama'],
		 'remark_tasks' => $retasks,
		 'dateupdate_tasks' => $date,
		 'created_date_tasks' => $date,
		 'id_kategori' => $_POST['kategori'],
		 'id_agent' => $_POST['assign'],
		 'priority_tasks' => $_POST['priority'],
		 'status_tasks' => 1,
		 'start_date_tasks' => $startdate,
		 'end_date_tasks' => $enddate,
		); 
		$exec= $con->insert("trtasks", $data);
		//die();
		include "phpmailer/pushemail.php";
		if($exec){
				echo "<script>alert('Successfully')</script>";  
				echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
		} else {
				echo "<script>alert('Not Saved')</script>"; 
				echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
		}
	}
}
?>
