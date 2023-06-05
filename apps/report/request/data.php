<?php
//error_reporting(0);
require( '../../../funlibs.php' );
$con=new Database;
session_start();
if($_GET['c']==''){
	$cat="";
}else{
	$cat="and d.id_kategori = $_GET[c]";
}

if($_GET['s']==''){
	$sub="";
}else{
	$sub="and d.id_kategori_sub='$_GET[s]'";
}

if($_GET['y']==''){
	$pri="";
}else{
	$pri="and d.priority_wo='$_GET[y]'";
}

if($_GET['t']==''){
	$sta="";
}else{
	$sta="and a.status_data='$_GET[t]'";
}

// if($_GET['a']==''){
// 	$ase="";
// }else{
// 	$ase="and a.asetid_data='$_GET[a]'";
// }

if($_GET['tg']== 'A' && $_GET['tg2']== 'A'){
	$tgl="";
}else{
	$tgl="and DATE(a.created_date_data) BETWEEN '$_GET[tg]' AND '$_GET[tg2]'";
}
					
$table = 'trrequest';
$primaryKey = 'id_req';
$joinQuery = "from trrequest b left join trdata a on a.id_data=b.id_data
left join mtdept c on a.departemen_data=c.id_dept
left join trwo d on b.id_req=d.id_req
left join mtkategori e on d.id_kategori=e.id_kategori
left join mtkategori_sub f on d.id_kategori_sub=f.id_kategori_sub";       
$extraWhere="b.id_req like '%' $cat $sub $pri $sta $ase $tgl";
//echo $extraWhere;
$columns = array(
	array( "db" => "b.id_req",     "dt" => 0, "field" => "id_req" ),
	array( "db" => "a.no_ticket", 	"dt" => 1, "field" => "no_ticket"),
	array( "db" => "a.nama_data",     "dt" => 2, "field" => "nama_data" ),
	array( "db" => "c.nama_dept",     "dt" => 3, "field" => "nama_dept" ),
	// array( "db" => "a.asetid_data", 	"dt" => 4, "field" => "asetid_data" ),
	array( "db" => "e.nama_kategori", 	"dt" => 4, "field" => "nama_kategori" ),
	array( "db" => "f.nama_kategori_sub", 	"dt" => 5, "field" => "nama_kategori_sub" ),
	array( "db" => "a.created_date_data", 	"dt" => 6, "field" => "created_date_data"),
	array( "db" => "d.priority_wo", 	"dt" => 7, "field" => "priority_wo",
	'formatter' => function( $d, $row ) {
					if($d == '1'){
						$isijum = "Low";
					} else if ($d == '2') {
						$isijum = "Medium";
					} else if ($d == '3') {
						$isijum = "High";
					}
					
				return "$isijum";
	}),
	array( "db" => "CONCAT(a.status_data,'_',b.id_req) as gab", 	"dt" => 8, "field" => "gab" ,
			'formatter' => function( $d, $row ) {
					$gab = explode("_",$d);
					$status = $gab[0];
					$idreq = $gab[1];
					if($status == '1'){
						$isijam = "Open";
					} else if ($status == '2') {
						$isijam = "On Progress";
					} else if ($status == '3') {
						$isijam = "Hold WO";
					} else if ($status == '4') {
						$isijam = "Closed";
					} else if ($status == '0') {
						$isijam = "Reject";
					} else if ($status == '5') {
						$isijam = "Hold Request";
					} else if ($status == '6') {
						$isijam = "Assigned";
					} 
					// $isijam = "<a href='javascript:void(0)' data-toggle='modal' data-target='#funModal' id='mod' onclick='mode($d)' class='label label-warning' style='cursor:pointer'>details</a>";
				/*return "
				<a href='javascript:void(0)' data-toggle='modal' id='mod' data-target='#datajaminan' onClick=detiljams('$d') class='label label-success' style='cursor:pointer'>Lihat Jaminan</a>
				";*/
				return "$isijam";

			}),
	array( "db" => "a.remark_data", 	"dt" => 9, "field" => "remark_data"),
);
//var_dump($columns);
$sql_details = array(	
); 
 
//echo "select * from $joinQuery where $extraWhere";
echo json_encode(
	Database::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);
