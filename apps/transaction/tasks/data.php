<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
$table = 'trtasks';
$primaryKey = 'id_tasks';
$joinQuery = "from trtasks a
left join mtkategori d on a.id_kategori = d.id_kategori
left join mtagent e on a.id_agent = e.id_agent
left join mtpegawai f on e.id_pegawai = f.id_pegawai
";       
$extraWhere="";
$columns = array(
	array( "db" => "a.id_tasks",     "dt" => 0, "field" => "id_tasks" ),
	array( "db" => "a.nama_tasks", 	"dt" => 1, "field" => "nama_tasks"),
	array( "db" => "d.nama_kategori",     "dt" => 2, "field" => "nama_kategori" ),
	array( "db" => "f.nama_pegawai", 	"dt" => 3, "field" => "nama_pegawai" ),
	array( "db" => "(CASE WHEN a.priority_tasks = 1 THEN 'Low' 
						  WHEN a.priority_tasks = 2 THEN 'Middle'
						  WHEN a.priority_tasks = 3 THEN 'High' END) as priorit", 	"dt" => 4, "field" => "priorit" ,
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
	array( "db" => "CONCAT(a.status_tasks,'_',a.id_tasks,'_',(CASE WHEN a.status_tasks = 1 THEN 'Open' 
						  WHEN a.status_tasks = 2 THEN 'On Progress'
						  WHEN a.status_tasks = 3 THEN 'Hold WO'
						  WHEN a.status_tasks = 4 THEN 'Closed'
						  WHEN a.status_tasks = 5 THEN 'Hold Request'
						  WHEN a.status_tasks = 6 THEN 'Assigned'
						  WHEN a.status_tasks = 0 THEN 'Reject' 
						  END)) as gab", 	"dt" => 5, "field" => "gab" ,
			'formatter' => function( $d, $row ) {
					$gab = explode("_",$d);
					$status = $gab[0];
					$idwo = $gab[1];
					$isist = $gab[2];
					if($status == '1'){
						$isijam = "<a href='content.php?p=ta2&d=$idwo' class='label label-danger' style='font-size:12px;' id='mod' >$isist</a>";
					} else if ($status == '2') {
						$isijam = "<a href='content.php?p=ta2&d=$idwo' class='label label-info' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '3') {
						$isijam = "<a href='content.php?p=ta2&d=$idwo' class='label label-warning' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '4') {
						$isijam = "<a href='content.php?p=ta2&d=$idwo' class='label label-success' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '0') {
						$isijam = "<a href='content.php?p=ta2&d=$idwo' class='label label-default' style='font-size:12px;' id='mod'>$isist</a>";
					} else if ($status == '5') {
						$isijam = "<a href='content.php?p=ta2&d=$idwo' class='label label-warning' style='font-size:12px;color: #000000;' id='mod'>$isist</a>";
					} 
					
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
