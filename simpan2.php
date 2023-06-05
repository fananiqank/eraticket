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
	
	$data6 = array( 
			'headpeopleid' => $_SESSION['ID_LOGIN'],
			'headnotes' => $_POST['headnotes'],
			'headappdate' => $date,
			'headstatus' => $status,
		); 
	 $exec6= $con->update("people_dtl_approve", $data6,"peopledtlid = '$_POST[peopledtlid]'");

	$data7 = array( 
			'statusid' => $status,
			); 
	$exec7= $con->update("people_dtl_request", $data7,"id = '$_POST[peopledtlid]'");

	$data8 = array( 
			'headpeopleid' => $_SESSION['ID_LOGIN'],
			'headnotes' => $_POST['headnotes'],
			'headappdate' => $date,
			'headstatus' => $status,
		); 
	$exec8= $con->update("people_dtl_approve", $data8,"peopledtlid = '$_POST[peopledtlidparent]'");

	if($_POST['typerequest'] != '2'){
		$data9 = array( 
				'statusid' => $status,
				); 
		$exec9= $con->update("people_dtl_request", $data9,"id = '$_POST[peopledtlidparent]'");
	
		include "lib/phpmailer/pushemailapphead.php";
	} else {
		include "lib/phpmailer/pushemailapphead.php";
	}
	

		//die();
	if($exec6){
		echo "<script>alert('Success Approved')</script>";  
		//echo "<script>window.location='content.php'</script>";  
	} else {
		echo "<script>alert('Not Saved')</script>"; 
		//echo "<script>window.location='content.php'</script>";  
	}