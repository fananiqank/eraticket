<?php 

require_once "funlibs.php";
$con = new Database();

// require_once "funlibs2.php";
// $con2 = new Database2();

$date = date("Y-m-d H:i:s");
$datej = date("Y-m-d");
$dateid = date("ymd");
if($_GET['p'] == 'filefolder') {
	//for($y=1;$y<=$_POST['jumaset2'];$y++){
	//	$ciy = $_POST['idaset'.$y]; 
	//	if($ciy){
			$data5 = array( 
				'ipaddress' => $_POST['ipaddressreport'],
				'filefolder' => $_POST['filefolder'],
				'lokasi' => $_POST['lokasi'],
				'remark' => $_POST['remarkfilefolder'],
				'assetid' => $_POST['idaset1'],
				'hak_akses'=> $_POST['hakaksesfilefolder'],
				'locationid'=> $_POST['depizin']
			); 
			$exec5= $con->insertID("people_izinakses_tmp", $data5);
	//	}
	//}
	
	
} else if($_GET['p'] == 'del') {

	$where = array('id' => $_GET[id]);
	$con->delete("people_izinakses_tmp",$where);

} 

?>