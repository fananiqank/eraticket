<?php 
session_start();
error_reporting(0);
$date = date("Y-m-d H:i:s");
$date2 = date("Y-m-d_G-i-s");
$tabel = "trdata";
$tabel3 = "trrequest";
$noteagen = trim($_POST['noteagent']);
$noteuser = trim($_POST['noteuser']);
	//echo "asss";

if ($_POST['simpan'] == 'app'){
	//include "phpmailer/pushemailadmin.php";
	$data = array (
	'status_data' => '6',
	'dateupdate_data' => $date,
	);
	$exec = $con->update($tabel,$data,"id_data = '$_POST[iddata]'");
	
	$data3 = array (
	'note_user' => $noteuser 
	);
	$exec3 = $con->update($tabel3,$data3,"id_req = '$_POST[kode]'");
	
	$idwo = $con->idurut("trwo","id_wo");
	$data2 = array (
	'id_wo' => $idwo,
	'id_req' => $_POST['kode'],
	'id_data' => $_POST['iddata'],
	'no_ticket' => $_POST['notiket'],
	'id_kategori' => $_POST['kategori'],
	'id_kategori_sub' => $_POST['subkategori'],
	'id_agent' => $_POST['assign'],
	'note_agent' => $noteagen,
	'created_date_wo' => $date,
	'dateupdate_wo' => $date,
	'jenis_wo' => '1',
	'priority_wo' => $_POST['priority'],
	);

	$exec2 = $con->insert("trwo",$data2);

	$idapp = $con->idurut("trapprove","id_approve");
	$data4 = array (
	'id_approve' => $idapp,
	'id_req' => $_POST['kode'],  
	'id_pegawai' => $_POST['appr'],
	'dateupdate_approve' => $date,
	);
	
	$exec4 = $con->insert("trapprove",$data4);
	
	foreach($con->select("mtagent","id_people_ontrack","id_agent = '$_POST[assign]'") as $admontrack){}
	$data5 = array (
	'status' => "Assigned",
	'adminid' => $admontrack['id_people_ontrack'],  
	);
	$exec5 = $con2->update("tickets",$data5,"ticket = '$_POST[notiket]'");
	

	//include "phpmailer/pushemail.php";
	echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
} 
else if ($_POST['simpan'] == 'hold'){
	$data = array (
	'status_data' => '5',
	'dateupdate_data' => $date,
	);
	$exec = $con->update($tabel,$data,"id_data = '$_POST[iddata]'");

	$data3 = array (
	'note_user' => $noteuser 
	);
	$exec3 = $con->update($tabel3,$data3,"id_req = '$_POST[kode]'");
	include "phpmailer/pushemail.php";
	echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
} 
else if ($_POST['simpan'] == 'rej'){
	$data = array (
	'status_data' => '0',
	'dateupdate_data' => $date,
	);
	$exec = $con->update($tabel,$data,"id_data = '$_POST[iddata]'");

	$data3 = array (
	'note_user' => $noteuser
	);
	$exec3 = $con->update($tabel3,$data3,"id_req = '$_POST[kode]'");
	include "phpmailer/pushemail.php";
	echo "<script>window.location='content.php?p=$_POST[getp]'</script>";
} 


?>
