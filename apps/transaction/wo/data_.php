<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'trwo';
$primaryKey = 'id_wo';
$joinQuery = "from trwo a left join trrequest b on a.id_req=b.id_req 
left join mtdept c on b.departemen_req=c.id_dept
left join mtkategori d on a.id_kategori = d.id_kategori
left join mtagent e on a.id_agent = e.id_agent
left join mtpegawai f on e.id_pegawai = f.id_pegawai
";       
$extraWhere="";
$columns = array(
	array( "db" => "a.id_wo",     "dt" => 0, "field" => "id_wo" ),
	array( "db" => "b.no_ticket", 	"dt" => 1, "field" => "no_ticket"),
	array( "db" => "b.nama_req",     "dt" => 2, "field" => "nama_req" ),
	array( "db" => "c.nama_dept",     "dt" => 3, "field" => "nama_dept" ),
	array( "db" => "f.nama_pegawai", 	"dt" => 4, "field" => "nama_pegawai" ),
	array( "db" => "a.priority_wo", 	"dt" => 5, "field" => "priority_wo",
	'formatter' => function( $d, $row ) {
					if($d == '1'){
						$isijum = "<font style='color:#50C54B'><b>Low</b></font>";
					} else if ($d == '2') {
						$isijum = "<font style='color:#DAA520'><b>Medium</b></font>";
					} else if ($d == '3') {
						$isijum = "<font style='color:#B22222'><b>High</b></font>";
					}
					
				return "$isijum";

	}),
	array( "db" => "CONCAT(b.status_data,'_',a.id_wo) as gab", 	"dt" => 6, "field" => "gab" ,
			'formatter' => function( $d, $row ) {
					$gab = explode("_",$d);
					$status = $gab[0];
					$idwo = $gab[1];
					if($status == '1'){
						$isijam = "<a href='javascript:void(0)' class='label label-danger' style='font-size:12px;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelwo($idwo)'>Open</a>";
					} else if ($status == '2') {
						$isijam = "<a href='javascript:void(0)' class='label label-info' style='font-size:12px;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelwo($idwo)'>On Progress</a>";
					} else if ($status == '3') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='font-size:12px;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelwo($idwo)'>Hold WO</a>";
					} else if ($status == '4') {
						$isijam = "<a href='javascript:void(0)' class='label label-success' style='font-size:12px;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelwo($idwo)'>Closed</a>";
					} else if ($status == '0') {
						$isijam = "<a href='javascript:void(0)' class='label label-default' style='font-size:12px;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelwo($idwo)'>Reject</a>";
					} else if ($status == '5') {
						$isijam = "<a href='javascript:void(0)' class='label label-warning' style='font-size:12px;color: #000000;' data-toggle='modal' data-target='#funModal' id='mod' onclick='modelwo($idwo)'>Hold Request</a>";
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
