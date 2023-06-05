<?php
//error_reporting(0);
require( 'funlibs.php' );
$con=new Database;

require( 'funlibs2.php' );
$con2=new Database2;

session_start();
$table = 'trdata';
$primaryKey = 'id_data';
$joinQuery = "from trdata a join trrequest b on a.id_data=b.id_data
left join mtdept c on a.departemen_data=c.id_dept
left join trwo d on a.id_data = d.id_data
left join mtagent e on d.id_agent = e.id_agent
left join mtpegawai f on e.id_pegawai = f.id_pegawai";   

if ($_GET['d'] != '') {    
	$extraWhere="a.id_data = '$_GET[d]'"; 
} else {
	$extraWhere=""; 
}

$columns = array(
	array( "db" => "b.id_req",     "dt" => 0, "field" => "id_req" ),
	array( "db" => "CONCAT(a.no_ticket,'_',b.id_req) as gab", 	"dt" => 1, "field" => "gab", 
			'formatter' => function( $d, $row ) {
				$gab = explode("_",$d);
				$idreq = $gab[1];
				$notick = $gab[0];
					$isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='model($idreq)' class='label label-warning' style='cursor:pointer;font-size:12px;background-color:#FF4500'>$notick</a>";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
	array( "db" => "a.namaaset_data",     "dt" => 2, "field" => "namaaset_data" ),
	array( "db" => "a.user_assets",     "dt" => 3, "field" => "user_assets" ),
	array( "db" => "a.nama_data",     "dt" => 4, "field" => "nama_data" ),
	array( "db" => "c.nama_dept", 	"dt" => 5, "field" => "nama_dept" ),
	array( "db" => "f.nama_pegawai", 	"dt" => 6, "field" => "nama_pegawai" ),
	array( "db" => "a.dateupdate_data", 	"dt" => 7, "field" => "dateupdate_data" ),
	array( "db" => "CONCAT(a.status_data,'_',(CASE WHEN a.status_data = 1 THEN 'Open' 
						  WHEN a.status_data = 2 THEN 'On Progress'
						  WHEN a.status_data = 3 THEN 'Hold'
						  WHEN a.status_data = 4 THEN 'Closed'
						  WHEN a.status_data = 5 THEN 'Hold Request'
						  WHEN a.status_data = 6 THEN 'Assigned'
						  WHEN a.status_data = 0 THEN 'Reject' 
						  END)) as gabus", 	"dt" => 8, "field" => "gabus" ,
			'formatter' => function( $d, $row ) {
					$gabus = explode("_",$d);
					$status = $gabus[0];
					$isist = $gabus[1];
					if($status == '1'){
						$isijam = "<a href='javascript:void(0)' class='label label-danger'>$isist</a>";
					} else if ($status == '2') {
						$isijam = "<a href='javascript:void(0)' class='label label-info'>$isist</a>";
					} else if ($status == '3') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning'>$isist</a>";
					} else if ($status == '4') {
						$isijam = "<a href='javascript:void(0)' class='label label-success'>$isist</a>";
					} else if ($status == '0') {
						$isijam = "<a href='javascript:void(0)' class='label label-default'>$isist</a>";
					} else if ($status == '5') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='color: #000000;'>$isist</a>";
					} else if ($status == '6') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='background-color:#0000FF'>$isist</a>";
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
