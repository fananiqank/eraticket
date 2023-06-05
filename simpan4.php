<?php 

require_once "funlibs.php";
$con = new Database();

// require_once "funlibs2.php";
// $con2 = new Database2();

$date = date("Y-m-d H:i:s");
$datej = date("Y-m-d");
$dateid = date("ymd");

if($_GET['tipe'] == '1'){
	$data5 = array( 
		'status' => 'Closed',
		'closedate' => $date,
		'closedipaddress' => $_POST['ipaddressfin'],
	); 
	$exec5= $con->update("tickets", $data5,"id = '$_GET[id]'");

	$data4 = array( 
				'ticketid' => $_GET['id'],
				'peopleid' => $_GET['usr'],
				'message' => 'Closed by user: '.$_POST['followup'],
				'timestamp' => $date,
				'typereplies' => 2,
				'statusreplies' => 'Closed',
				'ipaddress' => $_POST['ipaddressfin'],
				); 
	$exec4= $con->insert("tickets_replies", $data4);
	include "lib/phpmailer/pushemailupdateclose.php";

} else if($_GET['tipe'] == '2') {
	$data5 = array( 
		'status' => 'Reopened',
		'modifydate' => $date,
		'finishdate' => Null,
		'finishby' => Null,
	); 
	$exec5= $con->update("tickets", $data5,"id = '$_GET[id]'");

	$data4 = array( 
				'ticketid' => $_GET['id'],
				'peopleid' => $_GET['usr'],
				'message' => 'Reopened by user: '.$_POST['followup'],
				'timestamp' => $date,
				'typereplies' => 2,
				'statusreplies' => 'Reopened',
				'ipaddress' => $_POST['ipaddressfin'],
				); 
	$exec4= $con->insert("tickets_replies", $data4);
	include "lib/phpmailer/pushemailupdateclose.php";

} else if($_GET['tipe'] == '3') {
	
	$data4 = array( 
				'ticketid' => $_GET['id'],
				'peopleid' => $_GET['usr'],
				'message' => $_POST['followup'],
				'timestamp' => $date,
				'typereplies' => 2,
				'statusreplies' => $_POST['statusticketnow'],
				'ipaddress' => $_POST['ipaddressfin'],
				); 
	$exec4= $con->insert("tickets_replies", $data4);
	include "lib/phpmailer/pushemailfollowupuser.php";
}


?>