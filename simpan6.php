<?php	
	//error_reporting(0);
	session_start();
	require_once "funlibs.php";
	$con = new Database();
	$date = date("Y-m-d H:i:s");
	$datej = date("Y-m-d");
	$dateid = date("ymd");
	
	if($_GET['id'] == '1'){
		$status = "Approve";
	} else {
		$status = "Reject";
	}
	
	$data7 = array( 
			'headizinpeopleid' => $_SESSION['ID_LOGIN'],
			'headizinnotes' => $_POST['headnotes'],
			'headizinappdate' => $date,
			'headizinstatus' => $status,
		); 
	$exec7= $con->update("people_izinakses", $data7,"id = '$_POST[idizin]'");

	foreach($con->select("people_izinakses","count(id) jmlizin","peopledtlid = '$_POST[peopledtlid]'") as $jmlijin){}
	foreach($con->select("people_izinakses","count(id) jmlizin","peopledtlid = '$_POST[peopledtlid]' 
		and id not in (select id from people_izinakses where headizinstatus != '')") as $jmlblmijin){}
	foreach($con->select("people_izinakses","count(id) jmlizin","peopledtlid = '$_POST[peopledtlid]' 
		and headizinstatus == 'Reject')") as $jmlijinreject){}
	if($jmlblmijin == 0) {
		if($jmlijin == $jmlijinreject) { 
			$data9 = array( 
				'statusid' => 'Reject',
				); 
			$exec9= $con->update("people_dtl_request", $data9,"id = '$_POST[peopledtlid]'");
		}
		else {
			include "lib/phpmailer/pushemailapphead.php";
		}
		
	}

	include "lib/phpmailer/pushemailappuserizin.php";
	//include "lib/phpmailer/pushemailappheadizin.php";
		//die();
	if($exec7){
		echo "<script>alert('Success Approved')</script>";  
		//echo "<script>window.location='content.php'</script>";  
	} else {
		echo "<script>alert('Not Saved')</script>"; 
		//echo "<script>window.location='content.php'</script>";  
	}