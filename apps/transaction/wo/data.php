<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'trwo';
$primaryKey = 'id_wo';
$joinQuery = "from trwo a left join trdata b on a.id_data=b.id_data
left join trrequest g on a.id_req=g.id_req 
left join mtdept c on b.departemen_data=c.id_dept
left join mtkategori d on a.id_kategori = d.id_kategori
left join mtagent e on a.id_agent = e.id_agent
left join mtpegawai f on e.id_pegawai = f.id_pegawai
";       
$extraWhere="";
$columns = array(
	// array( "db" => "a.id_wo",     "dt" => 0, "field" => "id_wo" ,
	// 		'formatter' => function( $d, $row ) {
	// 		 $isijums = "<a style='margin-bottom: 2%;' data-toggle='collapse' data-target='#remak'><i class='fa fa-plus'></i></a>";
	// 		 return "$isijums";
	// }),
	array( "db" => "a.id_wo",     "dt" => 0, "field" => "id_wo" ),
	array( "db" => "b.no_ticket", 	"dt" => 1, "field" => "no_ticket"),
	array( "db" => "b.namaaset_data",     "dt" => 2, "field" => "namaaset_data" ),
	array( "db" => "c.nama_dept",     "dt" => 3, "field" => "nama_dept" ),
	array( "db" => "b.nama_data",     "dt" => 4, "field" => "nama_data" ),
	array( "db" => "f.nama_pegawai", 	"dt" => 5, "field" => "nama_pegawai" ),
	array( "db" => "concat((DATEDIFF(CURDATE(),a.sla_date_wo) - 2),'_',b.status_data,'_',IFNULL((DATEDIFF(b.closed_date_data,a.sla_date_wo) - 2),0)) as sla", 	"dt" => 6, "field" => "sla", 
	'formatter' => function( $d, $row ) {
					$exsla = explode('_',$d);
					$sla = $exsla[0];
					$st = $exsla[1]; 
					$clo = $exsla[2];
					if ($st == 4) {
						if ($clo > 0){
							$isijum = "<font style='font-size:14px;color:#FF0000'><b>+ $clo</b></font>";
						} else if ($clo == 0){
							$isijum = "<font style='font-size:14px;color:#0AB84D'><b>$clo</b></font>";
						} else if ($clo < 0){
							$isijum = "<font style='font-size:14px;color:#0A98B8'><b>$clo</b></font>";
						}
					} else {
						if ($sla > 0){
							$isijum = "<font style='font-size:14px;color:#FF0000'><b>+ $sla</b></font>";
						} else if ($sla == 0){
							$isijum = "<font style='font-size:14px;color:#0AB84D'><b>$sla</b></font>";
						} else if ($sla < 0){
							$isijum = "<font style='font-size:14px;color:#0A98B8'><b>$sla</b></font>";
						}
					}
					
				return "$isijum";

	}),
	array( "db" => "(CASE WHEN a.priority_wo = 1 THEN 'Low' 
						  WHEN a.priority_wo = 2 THEN 'Middle'
						  WHEN a.priority_wo = 3 THEN 'High' END) as priorit", 	"dt" => 7, "field" => "priorit",
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
	array( "db" => "CONCAT(b.status_data,'_',a.id_wo,'_',(CASE WHEN b.status_data = 1 THEN 'Open' 
						  WHEN b.status_data = 2 THEN 'On Progress'
						  WHEN b.status_data = 3 THEN 'Hold'
						  WHEN b.status_data = 4 THEN 'Closed'
						  WHEN b.status_data = 5 THEN 'Hold Request'
						  WHEN b.status_data = 6 THEN 'Assigned'
						  WHEN b.status_data = 0 THEN 'Reject' 
						  END)) as gab", 	"dt" => 8, "field" => "gab" ,
			'formatter' => function( $d, $row ) {
					$gab = explode("_",$d);
					$status = $gab[0];
					$idwo = $gab[1];
					$isist = $gab[2];
					if($status == '1'){
						$isijam = "<a href='content.php?p=wo2&id=$idwo' class='label label-danger' style='font-size:12px;' id='mod' >$isist</a>";
					} else if ($status == '2') {
						$isijam = "<a href='content.php?p=wo2&d=$idwo' class='label label-info' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '3') {
						$isijam = "<a href='content.php?p=wo2&d=$idwo' class='label label-warning' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '4') {
						$isijam = "<a href='content.php?p=wo2&d=$idwo' class='label label-success' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '0') {
						$isijam = "<a href='content.php?p=wo2&d=$idwo' class='label label-default' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '5') {
						$isijam = "<a href='content.php?p=wo2&d=$idwo' class='label label-warning' style='font-size:12px;color: #000000;' id='mod'>$isist</a>";
					} else if ($status == '6') {
						$isijam = "<a href='content.php?p=wo2&d=$idwo' class='label label-warning' style='font-size:12px;background-color:#0000FF' id='mod'>$isist</a>";
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
