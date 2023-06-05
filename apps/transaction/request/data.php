<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'trrequest';
$primaryKey = 'id_req';
$joinQuery = "from trrequest b left join trdata a on a.id_data=b.id_data
left join mtdept c on a.departemen_data=c.id_dept
left join trwo d on b.id_req=d.id_req";  

if ($_GET['d'] != ''){
	$extraWhere="a.id_data = '$_GET[d]'";
}  else {
	$extraWhere="";
}

$columns = array(
	array( "db" => "b.id_req",     "dt" => 0, "field" => "id_req" ),
	array( "db" => "a.no_ticket", 	"dt" => 1, "field" => "no_ticket"),
	array( "db" => "a.namaaset_data",     "dt" => 2, "field" => "namaaset_data" ),
	array( "db" => "c.nama_dept",     "dt" => 3, "field" => "nama_dept" ),
	array( "db" => "a.nama_data", 	"dt" => 4, "field" => "nama_data" ),
	array( "db" => "a.dateupdate_data", 	"dt" => 5, "field" => "dateupdate_data"),
	array( "db" => "(CASE WHEN d.priority_wo = 1 THEN 'Low' 
						  WHEN d.priority_wo = 2 THEN 'Middle'
						  WHEN d.priority_wo = 3 THEN 'High' END) as priorit", 	"dt" => 6, "field" => "priorit",
	'formatter' => function( $d, $row ) {
					if($d == 'Low'){
						$isijum = "<font style='color:#50C54B'><b>$d</b></font>";
					} else if ($d == 'Middle') {
						$isijum = "<font style='color:#DAA520'><b>$d</b></font>";
					} else if ($d == 'High') {
						$isijum = "<font style='color:#B22222'><b>$d</b></font>";
					}

				return "$isijum";
	}),
	array( "db" => "CONCAT(a.status_data,'_',b.id_req,'_',(CASE WHEN a.status_data = 1 THEN 'Open' 
						  WHEN a.status_data = 2 THEN 'On Progress'
						  WHEN a.status_data = 3 THEN 'Hold'
						  WHEN a.status_data = 4 THEN 'Closed'
						  WHEN a.status_data = 5 THEN 'Hold Request'
						  WHEN a.status_data = 6 THEN 'Assigned'
						  WHEN a.status_data = 0 THEN 'Reject' 
						  END)) as gab", 	"dt" => 7, "field" => "gab" ,
			'formatter' => function( $d, $row ) {
					$gab = explode("_",$d);
					$status = $gab[0];
					$idreq = $gab[1];
					$isist = $gab[2];
					if($status == '1'){
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-danger' style='font-size:12px;'>$isist</a>";
					} else if ($status == '2') {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-info' style='font-size:12px;'>$isist</a>";
					} else if ($status == '3') {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-warning' style='font-size:12px;'>$isist</a>";
					} else if ($status == '4') {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-success' style='font-size:12px;'>$isist</a>";
					} else if ($status == '0') {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-default' style='font-size:12px;'>$isist</a>";
					} else if ($status == '5') {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-warning' style='font-size:12px;color: #000000;'>$isist</a>";
					} else if ($status == '6') {
						$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-warning' style='font-size:12px;background-color:#0000FF'>$isist</a>";
					} 
					// $isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($d)' class='label label-warning' style='cursor:pointer'>details</a>";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
);
//var_dump($columns);
$sql_details = array(	
); 
 
//echo "select * from $joinQuery where $extraWhere";
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
